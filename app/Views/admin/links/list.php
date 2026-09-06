<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>

<?php
$activeFilter = $filter ?: 'all';
$typeLabels = [
    'stream' => 'Stream',
    'direct_download' => 'Direct',
    'torrent_download' => 'Torrent',
];
?>

<div class="link-workspace-header">
    <div>
        <span class="link-workspace-header__eyebrow">LINK OPERATIONS</span>
        <h4>All links</h4>
        <p>Review destinations, request volume, and recent changes from one organized table.</p>
    </div>
    <nav class="link-filter-pills" aria-label="Link type filter">
        <?php foreach (['all' => 'All', 'stream' => 'Stream', 'direct_download' => 'Direct', 'torrent_download' => 'Torrent'] as $value => $label): ?>
            <a class="<?= $activeFilter === $value ? 'is-active' : '' ?>" href="<?= admin_url('/links') ?><?= $value === 'all' ? '' : '?filter=' . $value ?>">
                <?= esc($label) ?>
            </a>
        <?php endforeach; ?>
    </nav>
</div>

<div class="x_panel link-table-panel">
    <div class="card-box table-responsive">

        <table id="links-list-datatable" class="table link-operations-table data-list-table" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Link</th>
                <th>Type</th>
                <th>Requests</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>


            <tbody>

            <?php foreach ($links as $link) : ?>
                <?php $host = parse_url($link->link, PHP_URL_HOST) ?: 'External link'; ?>
                <tr>
                    <td><span class="link-id">#<?= $link->id ?></span></td>
                    <td class="text-left link-destination">
                        <a href="<?= esc($link->link) ?>" class="link-destination__url" target="_blank" rel="noopener noreferrer" title="<?= esc($link->link) ?>">
                            <?= esc($link->link) ?> <i class="fa fa-external-link"></i>
                        </a>
                        <span class="link-destination__host"><?= esc($host) ?></span>
                    </td>
                    <td><span class="link-type-badge link-type-badge--<?= esc($link->type) ?>"><?= esc($typeLabels[$link->type] ?? 'Other') ?></span></td>
                    <td><span class="link-request-count"><?= number_format($link->requests) ?></span></td>
                    <td><span class="link-date"><?= format_date_time($link->created_at) ?></span></td>
                    <td><span class="link-date"><?= format_date_time($link->updated_at) ?></span></td>
                    <td>
                        <div class="table-actions link-table-actions">
                            <a href="<?= admin_url("/links/edit/{$link->id}") ?>" class="btn btn-sm link-action-btn link-action-btn--edit"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="<?= admin_url("/movies/edit/{$link->movie_id}") ?>" class="btn btn-sm link-action-btn link-action-btn--video"><i class="fa fa-play"></i> Video</a>
                            <a href="javascript:void(0)" class="btn btn-sm link-action-btn link-action-btn--delete del-item" data-url="<?= admin_url("/links/delete/{$link->id}") ?>"><i class="fa fa-trash"></i> Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<?php $this->endSection() ?>


<?php $this->section('scripts'); ?>

    <!-- Datatables -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

<?php $this->endSection(); ?>
