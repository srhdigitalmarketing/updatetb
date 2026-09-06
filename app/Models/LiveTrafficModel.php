<?php

namespace App\Models;

use CodeIgniter\Model;

class LiveTrafficModel extends Model
{
    protected $table = 'live_traffic';
    protected $returnType = 'array';
    protected $allowedFields = ['page', 'visitor_key', 'last_seen_at'];

    public function touchEmbedVisitor(string $visitorKey): void
    {
        $existing = $this->where('page', 'embed')
            ->where('visitor_key', $visitorKey)
            ->first();

        $data = [
            'page' => 'embed',
            'visitor_key' => $visitorKey,
            'last_seen_at' => date('Y-m-d H:i:s'),
        ];

        if ($existing === null) {
            $this->insert($data);
            return;
        }

        $this->update($existing['id'], $data);
    }

    public function activeEmbedVisitors(int $withinSeconds = 180): int
    {
        $since = date('Y-m-d H:i:s', time() - $withinSeconds);

        return $this->where('page', 'embed')
            ->where('last_seen_at >=', $since)
            ->countAllResults();
    }

    /**
     * Store one anonymous visitor per calendar day for the dashboard chart.
     * The unique index prevents heartbeat requests from inflating totals.
     */
    public function recordDailyEmbedVisitor(string $visitorKey, string $platform): void
    {
        if (! $this->db->tableExists('traffic_daily_visitors')) {
            return;
        }

        $today = date('Y-m-d');
        $builder = $this->db->table('traffic_daily_visitors');
        $exists = $builder->where('visit_date', $today)
            ->where('visitor_key', $visitorKey)
            ->countAllResults();

        if ($exists > 0) {
            return;
        }

        // The unique key is the final guard when the same browser opens two
        // players at exactly the same time. A duplicate is harmless.
        try {
            $this->db->table('traffic_daily_visitors')->insert([
                'visit_date' => $today,
                'visitor_key' => $visitorKey,
                'platform' => $platform === 'mobile' ? 'mobile' : 'desktop',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]);
        } catch (\Throwable $exception) {
            // A concurrent insert for the same visitor/day is expected.
        }
    }
}
