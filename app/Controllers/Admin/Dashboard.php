<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Libraries\Analytics;
use App\Libraries\AdRevenueToday;
use App\Models\LiveTrafficModel;
use App\Models\MovieModel;


class Dashboard extends BaseController
{
    public function index()
    {
        $title = 'Dashboard';

        $analytics = new Analytics();
        $anytc = $analytics->init()
                            ->getData();

        $movieModel = new MovieModel();
        $topMovies = $movieModel->movies()
                                ->where('views > ', 0)
                                ->orderBy('views', 'DESC')
                                ->findAll(10);

        $liveTraffic = $this->liveTrafficSummary();
        $visitorStats = $this->visitorStatistics();
        $revenueSummary = (new AdRevenueToday())->cachedSummary();

        $data = compact('title', 'anytc', 'topMovies', 'liveTraffic', 'visitorStats', 'revenueSummary');

        return view('admin/dashboard/index', $data);
    }

    public function live_traffic()
    {
        return $this->response->setJSON($this->liveTrafficSummary());
    }

    public function revenue_today()
    {
        return $this->response->setJSON((new AdRevenueToday())->synchronize());
    }

    private function liveTrafficSummary(): array
    {
        try {
            if (! db_connect()->tableExists('live_traffic')) {
                return ['active_now' => 0, 'tracking_ready' => false];
            }

            return [
                'active_now' => (new LiveTrafficModel())->activeEmbedVisitors(),
                'tracking_ready' => true,
            ];
        } catch (\Throwable $exception) {
            log_message('error', 'Live traffic summary could not be loaded: {message}', [
                'message' => $exception->getMessage(),
            ]);

            return ['active_now' => 0, 'tracking_ready' => false];
        }
    }

    /**
     * Build a compact, 30-day view of anonymous embed-player visitors.
     * Each visitor is counted once per day, which makes the chart useful
     * without storing personal details or creating one row per heartbeat.
     */
    private function visitorStatistics(): array
    {
        $start = new \DateTimeImmutable('-29 days');
        $labels = [];
        $daily = [];
        $byDate = [];

        for ($day = 0; $day < 30; $day++) {
            $date = $start->modify("+{$day} days");
            $key = $date->format('Y-m-d');
            $labels[] = $date->format('d M');
            $daily[] = 0;
            $byDate[$key] = $day;
        }

        $result = [
            'labels' => $labels,
            'daily' => $daily,
            'total' => 0,
            'platforms' => ['desktop' => 0, 'mobile' => 0],
            'tracking_ready' => false,
        ];

        try {
            $db = db_connect();
            if (! $db->tableExists('traffic_daily_visitors')) {
                return $result;
            }

            $from = $start->format('Y-m-d');
            $dailyRows = $db->table('traffic_daily_visitors')
                ->select('visit_date, COUNT(*) AS visitors')
                ->where('visit_date >=', $from)
                ->groupBy('visit_date')
                ->get()
                ->getResultArray();

            foreach ($dailyRows as $row) {
                $date = (string) $row['visit_date'];
                if (isset($byDate[$date])) {
                    $result['daily'][$byDate[$date]] = (int) $row['visitors'];
                }
            }

            $platformRows = $db->table('traffic_daily_visitors')
                ->select('platform, COUNT(*) AS visitors')
                ->where('visit_date >=', $from)
                ->groupBy('platform')
                ->get()
                ->getResultArray();

            foreach ($platformRows as $row) {
                $platform = (string) $row['platform'];
                if (array_key_exists($platform, $result['platforms'])) {
                    $result['platforms'][$platform] = (int) $row['visitors'];
                }
            }

            $totalRow = $db->table('traffic_daily_visitors')
                ->select('COUNT(DISTINCT visitor_key) AS visitors', false)
                ->where('visit_date >=', $from)
                ->get()
                ->getFirstRow();

            $result['total'] = $totalRow ? (int) $totalRow->visitors : 0;
            $result['tracking_ready'] = true;
        } catch (\Throwable $exception) {
            log_message('error', 'Visitor statistics could not be loaded: {message}', [
                'message' => $exception->getMessage(),
            ]);
        }

        return $result;
    }
}
