<?php

namespace App\Controllers\Admin\Settings;


use App\Models\LinkModel;
use CodeIgniter\Model;

class Servers extends BaseSettings
{

    public function index()
    {
        $title = 'Servers Settings';

        $linksModel = new LinkModel();
        $distLinks = $linksModel->select('link')
                                ->distinct()
                                ->findAll();

        $servers = get_config('renamed_servers');

        if(! empty($distLinks)){

            foreach ($distLinks as $link) {
                $host = $link->getHost();
                if(! empty($host)){
                    if(! isset( $servers[$host] )){
                        $servers[$host] = '';
                    }
                }
            }

        }

        $serverOptions = [];
        if(! empty( $servers )){
            foreach ($servers as $key => $val) {
                if(! empty($val)){
                    $serverOptions[$val] = $val;
                }else{
                    $serverOptions[$key] = $key;
                }
            }
        }


        return view('admin/settings/servers', compact('title', 'servers', 'serverOptions'));
    }


    public function update()
    {


        if($this->request->getMethod() == 'post'){

            if($this->validate([
                'default_server' => 'permit_empty|max_length[120]'
            ])){

                $submittedServers = $this->request->getPost('renamed_servers');
                $servers = [];

                if (is_array($submittedServers)) {
                    foreach ($submittedServers as $host => $label) {
                        $host = trim((string) $host);
                        if ($host === '') {
                            continue;
                        }

                        // A server record is only a display-name mapping. Empty values
                        // deliberately keep the original host visible to visitors.
                        $servers[$host] = mb_substr(trim(strip_tags((string) $label)), 0, 80);
                    }
                }

                $default_server = trim((string) $this->request->getPost('default_server'));
                $currentServers = (array) get_config('renamed_servers');

                // Keep the default selection attached to the same host when its
                // display name is edited or removed in this submission.
                foreach ($currentServers as $host => $label) {
                    $currentName = $label !== '' ? $label : $host;
                    if ($default_server === $currentName && array_key_exists($host, $servers)) {
                        $default_server = $servers[$host] !== '' ? $servers[$host] : $host;
                        break;
                    }
                }

                $serverNames = array_map(static function ($label, $host) {
                    return $label !== '' ? $label : $host;
                }, $servers, array_keys($servers));

                if ($default_server !== '' && ! in_array($default_server, $serverNames, true)) {
                    $default_server = '';
                }

                $servers = json_encode($servers);

                $data = [
                    'renamed_servers' => $servers,
                    'default_server' => $default_server
                ];

                return $this->save( $data );

            }

        }


        return redirect()->back();

    }

}
