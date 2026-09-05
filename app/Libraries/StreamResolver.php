<?php

namespace App\Libraries;

use App\Entities\Link;
use App\Models\LinkModel;
use Config\UpnShare;

/**
 * Chooses an available stream host, remembers the outcome and rotates the next
 * request to a different healthy link. All probing occurs server-side, so the
 * browser never needs cross-origin access to a host.
 */
class StreamResolver
{
    /** @var LinkModel */
    private $links;
    /** @var UpnShare */
    private $config;
    /** @var UpnShareClient */
    private $upnShare;

    public function __construct(?LinkModel $links = null, ?UpnShareClient $upnShare = null)
    {
        $this->links = $links ?: new LinkModel();
        $this->config = config('UpnShare');
        $this->upnShare = $upnShare ?: new UpnShareClient($this->config);
    }

    public function resolve(int $movieId, ?int $preferredId = null, array $excludedIds = []): ?Link
    {
        $excludedIds = array_values(array_filter(array_map('intval', $excludedIds)));
        $candidates = $this->links->findByMovieId($movieId, 'stream', false);

        if (! empty($preferredId) && ! in_array($preferredId, $excludedIds, true)) {
            usort($candidates, function (Link $left, Link $right) use ($preferredId) {
                return ($left->id === $preferredId ? 0 : 1) <=> ($right->id === $preferredId ? 0 : 1);
            });
        }

        foreach ($candidates as $link) {
            if (in_array((int) $link->id, $excludedIds, true)) {
                continue;
            }

            if (! $this->isHealthy($link)) {
                continue;
            }

            $this->recordSuccess($link);
            return $link;
        }

        return null;
    }

    public function recordPlayerFailure(int $linkId, string $reason = 'Player did not load'): void
    {
        $link = $this->links->getLink($linkId);
        if ($link === null || $link->type !== 'stream') {
            return;
        }

        $count = (int) $link->failure_count + 1;
        $this->links->protect(false)->update($linkId, [
            'failure_count' => $count,
            'last_checked_at' => date('Y-m-d H:i:s'),
            'last_failure_at' => date('Y-m-d H:i:s'),
            'last_error' => substr($reason, 0, 255),
            'is_broken' => $count >= $this->config->failureThreshold ? 1 : 0,
        ]);
    }

    private function isHealthy(Link $link): bool
    {
        $lastCheck = $link->last_checked_at ? strtotime($link->last_checked_at) : 0;
        if ($lastCheck && (time() - $lastCheck) < $this->config->healthCacheSeconds) {
            return ! (bool) $link->is_broken && empty($link->last_error);
        }

        $healthy = $this->isSafePublicUrl($link->link) && $this->probeHost($link->link);
        if ($healthy && ! empty($link->upnshare_video_id)) {
            $healthy = $this->upnShare->videoIsAvailable($link->upnshare_video_id);
        }

        if (! $healthy) {
            $this->recordPlayerFailure((int) $link->id, 'Host health check failed');
        } else {
            $this->links->protect(false)->update($link->id, [
                'last_checked_at' => date('Y-m-d H:i:s'),
                'last_error' => null,
            ]);
        }

        return $healthy;
    }

    private function recordSuccess(Link $link): void
    {
        $now = date('Y-m-d H:i:s');
        $this->links->protect(false)->update($link->id, [
            'failure_count' => 0,
            'is_broken' => 0,
            'last_checked_at' => $now,
            'last_success_at' => $now,
            'last_served_at' => $now,
            'last_error' => null,
        ]);
    }

    private function probeHost(string $url): bool
    {
        try {
            $response = service('curlrequest', [
                'timeout' => $this->config->requestTimeoutSeconds,
                'http_errors' => false,
                'allow_redirects' => true,
                'headers' => ['Range' => 'bytes=0-1'],
            ])->get($url);

            $status = $response->getStatusCode();
            return $status >= 200 && $status < 400;
        } catch (\Throwable $exception) {
            log_message('warning', 'Stream host probe failed: {message}', ['message' => $exception->getMessage()]);
            return false;
        }
    }

    private function isSafePublicUrl(string $url): bool
    {
        $parts = parse_url($url);
        if (! is_array($parts) || empty($parts['host']) || empty($parts['scheme'])) {
            return false;
        }

        if (! in_array(strtolower($parts['scheme']), ['http', 'https'], true)) {
            return false;
        }

        $host = strtolower($parts['host']);
        if ($host === 'localhost' || substr($host, -10) === '.localhost') {
            return false;
        }

        $ip = filter_var($host, FILTER_VALIDATE_IP) ? $host : gethostbyname($host);
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false;
    }
}
