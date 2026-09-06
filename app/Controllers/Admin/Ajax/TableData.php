<?php

namespace App\Controllers\Admin\Ajax;

use App\Controllers\BaseController;
use CodeIgniter\Database\BaseBuilder;

/**
 * Supplies the high-volume administration tables in small DataTables pages.
 *
 * Rendering thousands of records into an HTML table made the Videos and Links
 * screens slow before the user could search or filter them.  This endpoint
 * keeps the existing DataTables controls while letting the database do the
 * search, sorting, and pagination work.
 */
class TableData extends BaseController
{
    private const PAGE_LENGTHS = [10, 25, 50, 100];

    public function videos()
    {
        $filter = (string) $this->request->getGet('filter');
        $total = $this->movieBuilder($filter)->countAllResults();

        $builder = $this->movieBuilder($filter);
        $this->applySearch($builder, ['title', 'imdb_id'], $this->searchTerm());
        $filtered = $builder->countAllResults();

        $builder = $this->movieBuilder($filter);
        $this->applySearch($builder, ['title', 'imdb_id'], $this->searchTerm());
        $this->applyPage($builder, ['id', 'title', 'imdb_id', 'created_at', 'updated_at', 'views'], 'id', 'desc');

        $rows = [];
        foreach ($builder->get()->getResultArray() as $movie) {
            $id = (int) $movie['id'];
            $rows[] = [
                (string) $id,
                '<span class="video-title">' . esc($movie['title']) . '</span>',
                esc($movie['imdb_id']),
                format_date_time($movie['created_at']),
                format_date_time($movie['updated_at']),
                number_format((int) $movie['views']),
                '<div class="table-actions">'
                    . '<a href="' . admin_url("/movies/edit/{$id}") . '" class="btn btn-sm btn-primary"><i class="fa fa-pencil"></i> Edit</a>'
                    . '<a href="javascript:void(0)" data-url="' . admin_url("/movies/delete/{$id}") . '" class="btn btn-sm btn-danger del-item"><i class="fa fa-trash"></i> Delete</a>'
                    . '</div>',
            ];
        }

        return $this->dataTableResponse($total, $filtered, $rows);
    }

    public function links()
    {
        $filter = (string) $this->request->getGet('filter');
        $total = $this->linkBuilder($filter)->countAllResults();

        $builder = $this->linkBuilder($filter);
        $this->applySearch($builder, ['link', 'type'], $this->searchTerm());
        $filtered = $builder->countAllResults();

        $builder = $this->linkBuilder($filter);
        $this->applySearch($builder, ['link', 'type'], $this->searchTerm());
        $this->applyPage($builder, ['id', 'link', 'type', 'requests', 'created_at', 'updated_at'], 'updated_at', 'desc');

        $rows = [];
        foreach ($builder->get()->getResultArray() as $link) {
            $rows[] = $this->linkRow($link);
        }

        return $this->dataTableResponse($total, $filtered, $rows);
    }

    public function reportedLinks()
    {
        $total = $this->reportedLinkBuilder()->countAllResults();

        $builder = $this->reportedLinkBuilder();
        $this->applySearch($builder, ['link'], $this->searchTerm());
        $filtered = $builder->countAllResults();

        $builder = $this->reportedLinkBuilder();
        $this->applySearch($builder, ['link'], $this->searchTerm());
        $this->applyPage(
            $builder,
            ['id', 'link', 'requests', 'reports_not_working', 'reports_not_working', 'updated_at'],
            'reports_not_working',
            'desc'
        );
        $builder->orderBy('reports_wrong_link', 'DESC');

        $rows = [];
        foreach ($builder->get()->getResultArray() as $link) {
            $id = (int) $link['id'];
            $reason = (int) $link['reports_not_working'] >= (int) $link['reports_wrong_link'] ? 'Not working' : 'Wrong video';
            $reasonClass = $reason === 'Not working' ? 'is-broken' : 'is-wrong';
            $reports = (int) $link['reports_not_working'] + (int) $link['reports_wrong_link'];

            $rows[] = [
                '<span class="link-id">#' . $id . '</span>',
                $this->linkDestination($link['link']),
                '<span class="link-request-count">' . number_format((int) $link['requests']) . '</span>',
                '<span class="report-reason-badge ' . $reasonClass . '">' . $reason . '</span>',
                '<span class="report-count"><i class="fa fa-flag"></i> ' . number_format($reports) . '</span>',
                '<span class="link-date">' . format_date_time($link['updated_at']) . '</span>',
                '<div class="table-actions link-table-actions">'
                    . '<a href="' . admin_url("/links/edit/{$id}") . '" class="btn btn-sm link-action-btn link-action-btn--edit"><i class="fa fa-pencil"></i> Edit</a>'
                    . '<a href="' . admin_url('/movies/edit/' . (int) $link['movie_id']) . '" class="btn btn-sm link-action-btn link-action-btn--video"><i class="fa fa-play"></i> Video</a>'
                    . '<a href="' . admin_url("/links/clear/{$id}") . '" class="btn btn-sm link-action-btn link-action-btn--clear"><i class="fa fa-check"></i> Clear</a>'
                    . '<a href="javascript:void(0)" class="btn btn-sm link-action-btn link-action-btn--delete del-item" data-url="' . admin_url("/links/delete/{$id}") . '"><i class="fa fa-trash"></i> Delete</a>'
                    . '</div>',
            ];
        }

        return $this->dataTableResponse($total, $filtered, $rows);
    }

    private function movieBuilder(string $filter): BaseBuilder
    {
        $builder = db_connect()->table('movies')->where('type', 'movie');

        if ($filter === 'with_st_links') {
            $builder->whereIn('id', static function ($query) {
                return $query->select('movie_id')->from('links')->where('type', 'stream');
            });
        } elseif ($filter === 'without_st_links') {
            $builder->whereNotIn('id', static function ($query) {
                return $query->select('movie_id')->from('links')->where('type', 'stream');
            });
        } elseif ($filter === 'with_dl_links') {
            $builder->whereIn('id', static function ($query) {
                return $query->select('movie_id')->from('links')->where('type !=', 'stream');
            });
        } elseif ($filter === 'without_dl_links') {
            $builder->whereNotIn('id', static function ($query) {
                return $query->select('movie_id')->from('links')->where('type !=', 'stream');
            });
        }

        return $builder;
    }

    private function linkBuilder(string $filter): BaseBuilder
    {
        $builder = db_connect()->table('links');

        if (in_array($filter, ['stream', 'direct_download', 'torrent_download'], true)) {
            $builder->where('type', $filter);
        }

        return $builder;
    }

    private function reportedLinkBuilder(): BaseBuilder
    {
        return db_connect()->table('links')
            ->groupStart()
                ->where('reports_wrong_link >', 0)
                ->orWhere('reports_not_working >', 0)
            ->groupEnd();
    }

    /** @param array<int, string> $columns */
    private function applySearch(BaseBuilder $builder, array $columns, string $term): void
    {
        if ($term === '') {
            return;
        }

        $builder->groupStart();
        foreach ($columns as $index => $column) {
            $index === 0 ? $builder->like($column, $term) : $builder->orLike($column, $term);
        }
        $builder->groupEnd();
    }

    /** @param array<int, string> $columns */
    private function applyPage(BaseBuilder $builder, array $columns, string $defaultColumn, string $defaultDirection): void
    {
        $order = (array) $this->request->getGet('order');
        $order = $order[0] ?? [];
        $columnIndex = isset($order['column']) ? (int) $order['column'] : -1;
        $column = $columns[$columnIndex] ?? $defaultColumn;
        $direction = strtolower((string) ($order['dir'] ?? $defaultDirection)) === 'asc' ? 'ASC' : 'DESC';

        $length = (int) $this->request->getGet('length');
        $length = in_array($length, self::PAGE_LENGTHS, true) ? $length : 25;
        $start = max(0, (int) $this->request->getGet('start'));

        $builder->orderBy($column, $direction)->limit($length, $start);
    }

    private function searchTerm(): string
    {
        $search = (array) $this->request->getGet('search');
        return mb_substr(trim((string) ($search['value'] ?? '')), 0, 120);
    }

    /** @param array<string, mixed> $link */
    private function linkRow(array $link): array
    {
        $id = (int) $link['id'];
        $typeLabels = ['stream' => 'Stream', 'direct_download' => 'Direct', 'torrent_download' => 'Torrent'];
        $type = (string) $link['type'];

        return [
            '<span class="link-id">#' . $id . '</span>',
            $this->linkDestination($link['link']),
            '<span class="link-type-badge link-type-badge--' . esc($type) . '">' . esc($typeLabels[$type] ?? 'Other') . '</span>',
            '<span class="link-request-count">' . number_format((int) $link['requests']) . '</span>',
            '<span class="link-date">' . format_date_time($link['created_at']) . '</span>',
            '<span class="link-date">' . format_date_time($link['updated_at']) . '</span>',
            '<div class="table-actions link-table-actions">'
                . '<a href="' . admin_url("/links/edit/{$id}") . '" class="btn btn-sm link-action-btn link-action-btn--edit"><i class="fa fa-pencil"></i> Edit</a>'
                . '<a href="' . admin_url('/movies/edit/' . (int) $link['movie_id']) . '" class="btn btn-sm link-action-btn link-action-btn--video"><i class="fa fa-play"></i> Video</a>'
                . '<a href="javascript:void(0)" class="btn btn-sm link-action-btn link-action-btn--delete del-item" data-url="' . admin_url("/links/delete/{$id}") . '"><i class="fa fa-trash"></i> Delete</a>'
                . '</div>',
        ];
    }

    private function linkDestination(string $url): string
    {
        $host = parse_url($url, PHP_URL_HOST) ?: 'External link';
        $safeUrl = esc($url);

        return '<div class="link-destination text-left">'
            . '<a href="' . $safeUrl . '" class="link-destination__url" target="_blank" rel="noopener noreferrer" title="' . $safeUrl . '">'
            . $safeUrl . ' <i class="fa fa-external-link"></i></a>'
            . '<span class="link-destination__host">' . esc($host) . '</span></div>';
    }

    /** @param array<int, array<int, string>> $rows */
    private function dataTableResponse(int $total, int $filtered, array $rows)
    {
        return $this->response->setJSON([
            'draw' => (int) $this->request->getGet('draw'),
            'recordsTotal' => $total,
            'recordsFiltered' => $filtered,
            'data' => $rows,
        ]);
    }
}
