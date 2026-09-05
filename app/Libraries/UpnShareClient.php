<?php

namespace App\Libraries;

use Config\UpnShare;

class UpnShareClient
{
    /** @var UpnShare */
    private $config;

    public function __construct(?UpnShare $config = null)
    {
        $this->config = $config ?: config('UpnShare');
    }

    /**
     * Confirms that a UPNShare video is still available. The documented API
     * authenticates with an `api-token` request header.
     */
    public function videoIsAvailable(string $videoId): bool
    {
        if (empty($this->config->apiToken) || empty($videoId)) {
            // A normal host probe remains available when the optional API token
            // is not configured yet.
            return true;
        }

        try {
            $response = service('curlrequest', [
                'timeout' => $this->config->requestTimeoutSeconds,
                'http_errors' => false,
                'headers' => ['api-token' => $this->config->apiToken],
            ])->get($this->config->baseUrl . '/api/v1/video/manage/' . rawurlencode($videoId));

            if ($response->getStatusCode() !== 200) {
                return false;
            }

            $payload = json_decode($response->getBody(), true);
            return is_array($payload) && ! empty($payload['id']);
        } catch (\Throwable $exception) {
            log_message('warning', 'UPNShare health check failed: {message}', ['message' => $exception->getMessage()]);
            return false;
        }
    }
}
