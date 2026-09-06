<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddCloudflareWebAnalyticsSetting extends Migration
{
    public function up()
    {
        if (! $this->db->tableExists('settings')) {
            return;
        }

        $settings = $this->db->table('settings');
        if ($settings->where('name', 'cloudflare_web_analytics_token')->countAllResults() === 0) {
            $this->db->table('settings')->insert([
                'name' => 'cloudflare_web_analytics_token',
                'value' => '',
                'data_type' => 'string',
            ]);
        }
    }

    public function down()
    {
        if ($this->db->tableExists('settings')) {
            $this->db->table('settings')->where('name', 'cloudflare_web_analytics_token')->delete();
        }
    }
}
