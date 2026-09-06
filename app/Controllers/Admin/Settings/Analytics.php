<?php

namespace App\Controllers\Admin\Settings;

class Analytics extends BaseSettings
{
    public function index()
    {
        $title = 'Analytics Settings';

        return view('admin/settings/analytics/index', compact('title'));
    }

    public function update()
    {
        if ($this->request->getMethod() !== 'post') {
            return redirect()->back();
        }

        if (! $this->validate([
            'cloudflare_web_analytics_token' => 'permit_empty|max_length[128]',
        ])) {
            return redirect()->back()
                ->with('errors', $this->validator->getErrors())
                ->withInput();
        }

        return $this->save([
            'cloudflare_web_analytics_token' => trim((string) $this->request->getPost('cloudflare_web_analytics_token')),
        ]);
    }
}
