<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>

<div class="link-workspace-header link-workspace-header--reported">
    <div>
        <span class="link-workspace-header__eyebrow">LINK HEALTH</span>
        <h4>Reported links</h4>
        <p>Prioritize links with the most visitor reports, then clear or correct them quickly.</p>
    </div>
    <span class="reported-links-summary"><i class="fa fa-exclamation-circle"></i> <?= number_format(count($links)) ?> need review</span>
</div>

<div class="x_panel link-table-panel">
    <div class="card-box table-responsive">

        <table id="reported-links-datatable" class="table link-operations-table link-operations-table--reported data-list-table" style="width:100%">
            <thead>
            <tr>
                <th>ID</th>
                <th>Link</th>
                <th>Req.</th>
                <th>Reason</th>
                <th>Reports</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>


            <tbody>

            <?php foreach ($links as $link) : ?>
                <?php
                $reason = $link->reports_not_working >= $link->reports_wrong_link ? 'Not working' : 'Wrong video';
                $host = parse_url($link->link, PHP_URL_HOST) ?: 'External link';
                ?>
                <tr>
                    <td><span class="link-id">#<?= $link->id ?></span></td>
                    <td class="text-left link-destination">
                        <a href="<?= esc($link->link) ?>" class="link-destination__url" target="_blank" rel="noopener noreferrer" title="<?= esc($link->link) ?>">
                            <?= esc($link->link) ?> <i class="fa fa-external-link"></i>
                        </a>
                        <span class="link-destination__host"><?= esc($host) ?></span>
                    </td>
                    <td><span class="link-request-count"><?= number_format($link->requests) ?></span></td>
                    <td><span class="report-reason-badge <?= $reason === 'Not working' ? 'is-broken' : 'is-wrong' ?>"><?= esc($reason) ?></span></td>
                    <td><span class="report-count"><i class="fa fa-flag"></i> <?= number_format($link->countReports()) ?></span></td>
                    <td><span class="link-date"><?= format_date_time($link->updated_at) ?></span></td>
                    <td>
                        <div class="table-actions link-table-actions">
                            <a href="<?= admin_url("/links/edit/{$link->id}") ?>" class="btn btn-sm link-action-btn link-action-btn--edit"><i class="fa fa-pencil"></i> Edit</a>
                            <a href="<?= admin_url("/movies/edit/{$link->movie_id}") ?>" class="btn btn-sm link-action-btn link-action-btn--video"><i class="fa fa-play"></i> Video</a>
                            <a href="<?= admin_url("/links/clear/{$link->id}") ?>" class="btn btn-sm link-action-btn link-action-btn--clear"><i class="fa fa-check"></i> Clear</a>
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


