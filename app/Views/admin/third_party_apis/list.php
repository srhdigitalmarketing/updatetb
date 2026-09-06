<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>

<div class="host-api-overview">
    <section>
        <span class="host-api-guide__eyebrow">API ACCESS</span>
        <h4>Video host access</h4>
        <p>Manage credentials for video delivery, artwork metadata, and Cloudflare R2 banner storage.</p>
        <a href="<?= admin_url('/third-party-apis/new') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add API access</a>
    </section>
    <section class="host-api-overview__docs">
        <h5>Supported platform</h5>
        <p>UPNShare, Vidhide, EarnVids, XVideoSharing hosts, and Cloudflare R2 storage.</p>
        <a href="https://vidhide.com/api.html" target="_blank" rel="noopener noreferrer">Read provider documentation <i class="fa fa-external-link"></i></a>
    </section>
</div>

<div class="x_panel host-api-list-panel">
    <div class="x_content">
        <table class="table host-api-table">
            <thead>
            <tr>
                <th>API access</th>
                <th>Provider</th>
                <th>Data scopes</th>
                <th>Created At</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($apis as $api) : ?>
            <tr>
                <td>
                    <strong><?= esc($api->name) ?></strong>
                    <small><?= $api->provider === 'earnvids' ? 'File list and direct playback enabled' : ($api->provider === 'cloudflare_r2' ? 'Banner uploads are stored in R2' : 'Provider connection configured') ?></small>
                </td>
                <td><span class="host-api-provider-badge"><?= esc(ucfirst(str_replace('xvideosharing', 'XVideoSharing', $api->provider ?: 'custom'))) ?></span></td>
                <td><?php if ($api->provider === 'cloudflare_r2'): ?><span class="host-api-scope"><i class="fa fa-cloud-upload"></i> Banner storage</span><?php else: ?><span class="host-api-scope"><i class="fa fa-play-circle"></i> Video</span><span class="host-api-scope"><i class="fa fa-image"></i> Poster</span><?php endif; ?></td>
                <td><?= format_date_time($api->created_at) ?></td>
                <td>
                    <span class="host-api-status-badge <?= $api->status == 'active' ? 'is-active' : 'is-paused' ?>">
                        <i class="fa fa-circle"></i> <?= esc($api->status) ?>
                    </span>
                </td>
                <td class="text-center">
                    <div class="table-actions">
                        <a href="<?= admin_url("/third-party-apis/edit?id={$api->id}") ?>" class="btn btn-sm link-action-btn link-action-btn--edit"><i class="fa fa-pencil"></i> Edit</a>
                        <a href="javascript:void(0)" data-url="<?= admin_url("/third-party-apis/delete?id={$api->id}") ?>" class="btn btn-sm link-action-btn link-action-btn--delete del-item"><i class="fa fa-trash"></i> Delete</a>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <?php if (empty($apis)): ?>
            <div class="host-api-empty"><i class="fa fa-plug"></i><strong>No API access configured</strong><span>Add a host token to prepare video and poster synchronization.</span></div>
        <?php endif; ?>
    </div>
</div>

<?php $this->endSection() ?>
