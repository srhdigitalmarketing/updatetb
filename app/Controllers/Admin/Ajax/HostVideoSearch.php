<?php

namespace App\Controllers\Admin\Ajax;

use App\Controllers\BaseAjax;
use App\Models\ThirdPartyApi;
use CodeIgniter\HTTP\CURLRequest;
use Throwable;

/**
 * Searches the enabled video-host accounts without exposing API tokens to the
 * browser. It supports the standard XVideoSharing File List response used by
 * Vidhide and compatible hosts.
 */
class HostVideoSearch extends BaseAjax
{
    private const RESULTS_PER_HOST = 6;
    private const MAX_RESULTS = 12;

    public function index()
    {
        $title = trim((string) $this->request->getGet('title'));

        if (mb_strlen($title) < 3 || mb_strlen($title) > 160) {
            $this->addError('Enter at least 3 characters to search video hosts.');

            return $this->jsonResponse();
        }

        $apis = [];
        foreach ((new ThirdPartyApi())->where('status', 'active')->findAll() as $api) {
            if (trim((string) $api->api_token) !== '') {
                $apis[] = $api;
            }
        }

        $items = [];

        foreach ($apis as $api) {
            if (count($items) >= self::MAX_RESULTS) {
                break;
            }

            try {
                $search = $this->searchHostFiles($api, $title);
                if ($search === null) {
                    continue;
                }

                foreach ($search['files'] as $file) {
                    if (count($items) >= self::MAX_RESULTS) {
                        break 2;
                    }

                    if (! is_array($file) || (isset($file['canplay']) && ! filter_var($file['canplay'], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE))) {
                        continue;
                    }

                    $playerUrl = $this->safeExternalUrl(
                        $file['link'] ?? $file['player_url'] ?? $file['video_url'] ?? $file['embed_url'] ?? $file['url'] ?? ''
                    );
                    if ($playerUrl === null) {
                        continue;
                    }

                    $posterUrl = $this->safeExternalUrl(
                        $file['thumbnail'] ?? $file['player_img'] ?? $file['thumb'] ?? $file['poster'] ?? $file['poster_url'] ?? ''
                    );
                    $fileCode = trim((string) ($file['file_code'] ?? $file['filecode'] ?? $file['id'] ?? ''));

                    // File List normally includes thumbnail. File Info is used
                    // only as a small fallback for hosts that expose player_img
                    // separately (such as some XVideoSharing installations).
                    if ($posterUrl === null && $fileCode !== '') {
                        $posterUrl = $this->posterFromFileInfo($api, $search['api_root'], $fileCode);
                    }

                    $items[] = [
                        'source' => (string) $api->name,
                        'provider' => (string) $api->provider,
                        'title' => trim((string) ($file['title'] ?? $file['file_title'] ?? $file['name'] ?? $title)),
                        'player_url' => $playerUrl,
                        'poster_url' => $posterUrl,
                        'file_code' => $fileCode,
                    ];
                }
            } catch (Throwable $exception) {
                // A single unavailable host must not break the Add/Edit form.
                log_message('warning', 'Video-host search failed for API access {api}: {message}', [
                    'api' => (string) $api->id,
                    'message' => $exception->getMessage(),
                ]);
            }
        }

        $this->addData([
            'items' => $items,
            'configured_hosts' => count($apis),
        ]);

        return $this->jsonResponse();
    }

    /** @return array{files: array<int, array<string, mixed>>, api_root: string}|null */
    private function searchHostFiles(object $api, string $title): ?array
    {
        foreach ($this->apiRoots($api) as $apiRoot) {
            $host = $this->getSafeHostConfig($apiRoot);
            if ($host === null) {
                continue;
            }

            $response = $this->httpClient($host)->get($apiRoot . '/file/list', [
                'query' => [
                    'key' => (string) $api->api_token,
                    'title' => $title,
                    'per_page' => self::RESULTS_PER_HOST,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    // UPNShare-compatible servers may use the token header.
                    'api-token' => (string) $api->api_token,
                ],
            ]);

            if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
                continue;
            }

            $payload = json_decode($response->getBody(), true);
            if (! is_array($payload) || ! $this->isFileListPayload($payload)) {
                continue;
            }

            return [
                'files' => $this->filesFromPayload($payload),
                'api_root' => $apiRoot,
            ];
        }

        return null;
    }

    /**
     * Admins commonly enter either a host origin or its /api root. Try both
     * forms safely so an otherwise valid API Access does not silently miss
     * XVideoSharing's standard endpoint.
     *
     * @return array<int, string>
     */
    private function apiRoots(object $api): array
    {
        $base = rtrim((string) $api->api_base_url, '/');
        $roots = [$base];

        if (! preg_match('#/api(?:/v1)?$#i', $base)) {
            array_unshift($roots, $base . '/api');

            if ((string) $api->provider === 'upnshare') {
                $roots[] = $base . '/api/v1';
            }
        } elseif (preg_match('#/api/v1$#i', $base)) {
            $roots[] = substr($base, 0, -3);
        }

        return array_values(array_unique($roots));
    }

    private function isFileListPayload(array $payload): bool
    {
        return isset($payload['result']['files'])
            || isset($payload['files'])
            || isset($payload['data']['files'])
            || isset($payload['data']['items']);
    }

    /** @return array<int, array<string, mixed>> */
    private function filesFromPayload(array $payload): array
    {
        $files = $payload['result']['files']
            ?? $payload['files']
            ?? $payload['data']['files']
            ?? $payload['data']['items']
            ?? [];

        return is_array($files) ? $files : [];
    }

    /** @return array{host: string, port: int, ip: string}|null */
    private function getSafeHostConfig(string $baseUrl): ?array
    {
        $parts = parse_url($baseUrl);
        $scheme = strtolower((string) ($parts['scheme'] ?? ''));
        $host = strtolower((string) ($parts['host'] ?? ''));

        if (! in_array($scheme, ['http', 'https'], true) || $host === '' || $host === 'localhost' || substr($host, -10) === '.localhost') {
            return null;
        }

        $ip = filter_var($host, FILTER_VALIDATE_IP) ? $host : gethostbyname($host);
        if (! filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return null;
        }

        return [
            'host' => $host,
            'port' => (int) ($parts['port'] ?? ($scheme === 'https' ? 443 : 80)),
            'ip' => $ip,
        ];
    }

    private function httpClient(array $host): CURLRequest
    {
        return service('curlrequest', [
            'timeout' => 8,
            'http_errors' => false,
            'allow_redirects' => false,
            // Pin the verified public address for this request. This prevents a
            // configured host from resolving to an internal address mid-request.
            'curl' => [CURLOPT_RESOLVE => ["{$host['host']}:{$host['port']}:{$host['ip']}"]],
        ], false);
    }

    private function posterFromFileInfo(object $api, string $apiRoot, string $fileCode): ?string
    {
        $host = $this->getSafeHostConfig($apiRoot);
        if ($host === null) {
            return null;
        }

        $response = $this->httpClient($host)->get(
            $apiRoot . '/file/info',
            [
                'query' => [
                    'key' => (string) $api->api_token,
                    'file_code' => $fileCode,
                ],
                'headers' => [
                    'Accept' => 'application/json',
                    'api-token' => (string) $api->api_token,
                ],
            ]
        );

        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            return null;
        }

        $payload = json_decode($response->getBody(), true);
        if (! is_array($payload)) {
            return null;
        }

        $info = $payload['result'] ?? $payload['data'] ?? $payload;
        if (is_array($info) && $this->isListArray($info)) {
            $info = $info[0] ?? [];
        }

        return is_array($info)
            ? $this->safeExternalUrl($info['player_img'] ?? $info['thumbnail'] ?? $info['poster'] ?? '')
            : null;
    }

    private function isListArray(array $value): bool
    {
        return $value === [] || array_keys($value) === range(0, count($value) - 1);
    }

    private function safeExternalUrl($url): ?string
    {
        if (! is_string($url) || filter_var($url, FILTER_VALIDATE_URL) === false) {
            return null;
        }

        $scheme = strtolower((string) parse_url($url, PHP_URL_SCHEME));

        return in_array($scheme, ['http', 'https'], true) ? $url : null;
    }
}
