<?php

namespace App\Controllers;

use App\Models\LiveTrafficModel;

class Traffic extends BaseController
{
    public function embed()
    {
        $visitorKey = trim((string) $this->request->getPost('visitor_key'));

        if (! preg_match('/^[a-zA-Z0-9_-]{16,64}$/', $visitorKey)) {
            return $this->response
                ->setStatusCode(422)
                ->setJSON(['ok' => false]);
        }

        try {
            if (! db_connect()->tableExists('live_traffic')) {
                return $this->response->setJSON(['ok' => false, 'tracking' => 'unavailable']);
            }

            (new LiveTrafficModel())->touchEmbedVisitor($visitorKey);
        } catch (\Throwable $exception) {
            log_message('error', 'Live traffic heartbeat could not be saved: {message}', [
                'message' => $exception->getMessage(),
            ]);

            return $this->response
                ->setStatusCode(503)
                ->setJSON(['ok' => false]);
        }

        return $this->response->setJSON(['ok' => true]);
    }
}
