<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddStreamHealthFields extends Migration
{
    public function up()
    {
        $fields = [
            'host_priority' => ['type' => 'SMALLINT', 'unsigned' => true, 'default' => 100, 'after' => 'type'],
            'failure_count' => ['type' => 'SMALLINT', 'unsigned' => true, 'default' => 0, 'after' => 'host_priority'],
            'last_checked_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'failure_count'],
            'last_success_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'last_checked_at'],
            'last_failure_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'last_success_at'],
            'last_served_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'last_failure_at'],
            'last_error' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true, 'after' => 'last_served_at'],
            'upnshare_video_id' => ['type' => 'VARCHAR', 'constraint' => 128, 'null' => true, 'after' => 'last_error'],
        ];

        $this->forge->addColumn('links', $fields);
        // CodeIgniter 4.1 derives index names from the indexed columns.
        $this->forge->addKey(['movie_id', 'type', 'is_broken', 'last_served_at']);
        $this->forge->processIndexes('links');
    }

    public function down()
    {
        $this->forge->dropKey('links', 'links_movie_id_type_is_broken_last_served_at');
        $this->forge->dropColumn('links', [
            'host_priority', 'failure_count', 'last_checked_at', 'last_success_at',
            'last_failure_at', 'last_served_at', 'last_error', 'upnshare_video_id',
        ]);
    }
}
