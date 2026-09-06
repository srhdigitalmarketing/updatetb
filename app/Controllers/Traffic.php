<?php

namespace App\Controllers;

use App\Libraries\PopupAdSelector;
use App\Models\LiveTrafficModel;

class Traffic extends BaseController
{
    public function popup_ad()
    {
        try {
            $id = (new PopupAdSelector())->selectId();
            return $this->response->setJSON(['id' => $id]);
        } catch (\Throwable $exception) {
            log_message('warning', 'Popup ad selection failed: {message}', ['message' => $exception->getMessage()]);
            return $this->response->setStatusCode(503)->setJSON(['id' => null]);
        }
    }

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

            $traffic = new LiveTrafficModel();
            $traffic->touchEmbedVisitor($visitorKey);

            if ($this->request->getPost('record_daily') === '1') {
                $agent = $this->request->getUserAgent();
                $traffic->recordDailyEmbedVisitor(
                    $visitorKey,
                    $agent && $agent->isMobile() ? 'mobile' : 'desktop'
                );
            }
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
