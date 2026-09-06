<?php

namespace App\Commands;

use App\Libraries\StreamResolver;
use App\Models\LinkModel;
use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CheckStreamHealth extends BaseCommand
{
    protected $group = 'Streams';
    protected $name = 'streams:health-check';
    protected $description = 'Checks a rotating batch of stream links using provider APIs first, then HTTP fallback.';
    protected $usage = 'streams:health-check [--limit 100]';
    protected $options = [
        '--limit' => 'Maximum stream links to check in one run (1-500; default: 100).',
    ];

    public function run(array $params)
    {
        $links = new LinkModel();
        if (! $links->supportsStreamHealthFields()) {
            CLI::error('Stream health fields are unavailable. Run php spark migrate first.');
            return;
        }

        $limit = (int) (CLI::getOption('limit') ?: 100);
        $limit = max(1, min(500, $limit));
        $batch = $links->where('type', 'stream')
            ->orderBy('last_checked_at', 'ASC')
            ->limit($limit)
            ->findAll();

        $resolver = new StreamResolver($links);
        $healthy = 0;
        $unavailable = 0;

        foreach ($batch as $link) {
            if ($resolver->check($link)) {
                $healthy++;
            } else {
                $unavailable++;
            }
        }

        CLI::write(
            'Checked ' . count($batch) . ' stream link(s): ' . $healthy . ' available, ' . $unavailable . ' unavailable.',
            $unavailable > 0 ? 'yellow' : 'green'
        );
    }
}
