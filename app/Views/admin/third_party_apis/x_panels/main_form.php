


<?php
$providerOptions = [
    'earnvids' => 'EarnVids',
    'upnshare' => 'UPNShare',
    'vidhide' => 'Vidhide',
    'xvideosharing' => 'XVideoSharing compatible',
    'custom' => 'Custom host',
];
$isExisting = ! empty($tpAPI->id);
$selectedProvider = old('provider', $tpAPI->provider ?: 'earnvids');
$tokenAttributes = [
    'id' => 'host-api-token',
    'type' => 'password',
    'name' => 'api_token',
    'class' => 'form-control',
    'value' => '',
    'placeholder' => $isExisting && ! empty($tpAPI->api_token) ? 'Saved — leave blank to keep the current token' : 'Paste the API token supplied by the host',
    'maxlength' => 255,
    'autocomplete' => 'new-password',
];
if (! $isExisting) {
    $tokenAttributes['required'] = 'required';
}
?>

<div class="x_panel host-api-form-panel">
    <div class="x_content">
        <div class="host-api-form-grid">
            <div class="form-group">
                <label class="control-label" for="host-api-name">Display name</label>
                <?= form_input([
                    'id' => 'host-api-name',
                    'name' => 'name',
                    'class' => 'form-control',
                    'value' => old('name', $tpAPI->name),
                    'placeholder' => 'Example: EarnVids Primary',
                    'maxlength' => 128,
                    'required' => 'required',
                ]) ?>
            </div>
            <div class="form-group">
                <label class="control-label" for="host-api-provider">Provider</label>
                <?= form_dropdown([
                    'id' => 'host-api-provider',
                    'name' => 'provider',
                    'class' => 'form-control',
                    'options' => $providerOptions,
                    'selected' => $selectedProvider,
                ]) ?>
            </div>
        </div>

        <?= form_input([
            'id' => 'host-api-base-url',
            'type' => 'hidden',
            'name' => 'api_base_url',
            'value' => old('api_base_url', $tpAPI->api_base_url ?: 'https://earnvidsapi.com/api'),
        ]) ?>
        <div class="host-api-fixed-endpoint" data-provider-note="earnvids"<?= $selectedProvider !== 'earnvids' ? ' hidden' : '' ?>>
            <strong>EarnVids data scope</strong>
            <span>Endpoint mengikuti dokumentasi EarnVids secara otomatis. Hanya API key yang perlu disimpan.</span>
        </div>
        <div class="host-api-fixed-endpoint" data-provider-note="upnshare"<?= $selectedProvider !== 'upnshare' ? ' hidden' : '' ?>>
            <strong>UPNShare data scope</strong>
            <span>Endpoint <code>/api/v1/video/manage</code> dan header <code>api-token</code> mengikuti dokumentasi UPNShare secara otomatis.</span>
        </div>

        <section class="provider-api-structure" data-provider-structure="earnvids" aria-labelledby="earnvids-api-structure-title"<?= $selectedProvider !== 'earnvids' ? ' hidden' : '' ?>>
            <div class="provider-api-structure__header">
                <span>EARNVIDS · DOCUMENTED DATA FLOW</span>
                <h3 id="earnvids-api-structure-title">File List → Direct Link → Artwork</h3>
                <p>Endpoint disimpan di aplikasi, bukan di form. API key selalu dikirim dari penyimpanan aman server.</p>
            </div>
            <div class="provider-api-structure__grid">
                <article>
                    <span class="provider-api-structure__step">01</span>
                    <h4>File List</h4>
                    <code>GET /api/file/list</code>
                    <p><b>Input:</b> key, title, per_page, page, fld_id, public, adult, created.</p>
                    <p><b>Data dibaca:</b> title, file_code, link, thumbnail, canplay, length, views, uploaded.</p>
                </article>
                <article>
                    <span class="provider-api-structure__step">02</span>
                    <h4>Direct Link</h4>
                    <code>GET /api/file/direct_link</code>
                    <p><b>Input:</b> key, file_code, IP penonton.</p>
                    <p><b>Output:</b> URL putar sementara yang diminta saat video mulai diputar.</p>
                </article>
                <article>
                    <span class="provider-api-structure__step">03</span>
                    <h4>Gambar</h4>
                    <code>GET /api/file/info</code>
                    <p><b>Input:</b> key dan file_code dari File List.</p>
                    <p><b>Data dibaca:</b> thumbnail atau player_img untuk banner video.</p>
                </article>
            </div>
        </section>

        <section class="provider-api-structure" data-provider-structure="upnshare" aria-labelledby="upnshare-api-structure-title"<?= $selectedProvider !== 'upnshare' ? ' hidden' : '' ?>>
            <div class="provider-api-structure__header">
                <span>UPNSHARE · DOCUMENTED DATA FLOW</span>
                <h3 id="upnshare-api-structure-title">Video Manage → Video Detail → Artwork</h3>
                <p>UPNShare memakai header <code>api-token</code>. Root API, endpoint, dan parameter dikelola aplikasi agar konsisten dengan dokumentasi provider.</p>
            </div>
            <div class="provider-api-structure__grid">
                <article>
                    <span class="provider-api-structure__step">01</span>
                    <h4>Video List</h4>
                    <code>GET /api/v1/video/manage</code>
                    <p><b>Input:</b> page, perPage, status, search.</p>
                    <p><b>Data dibaca:</b> id, name, poster, preview, duration, resolution, width, height, bitrate.</p>
                </article>
                <article>
                    <span class="provider-api-structure__step">02</span>
                    <h4>Video Detail</h4>
                    <code>GET /api/v1/video/manage/{id}</code>
                    <p><b>Input:</b> id dari Video List.</p>
                    <p><b>Data dibaca:</b> URL video jika disediakan provider serta status ketersediaan video.</p>
                </article>
                <article>
                    <span class="provider-api-structure__step">03</span>
                    <h4>Gambar</h4>
                    <code>poster / preview</code>
                    <p><b>Sumber:</b> field poster dan preview pada respons UPNShare.</p>
                    <p><b>Data dipakai:</b> artwork/bannner video tanpa menyimpan API key pada browser.</p>
                </article>
            </div>
        </section>

        <section class="provider-api-structure provider-api-structure--pending" data-provider-structure="other"<?= in_array($selectedProvider, ['earnvids', 'upnshare'], true) ? ' hidden' : '' ?>>
            <div class="provider-api-structure__header">
                <span>PROVIDER STRUCTURE</span>
                <h3>Dokumentasi provider belum dipetakan</h3>
                <p>Konfigurasi yang telah tersimpan tetap aman. Struktur endpoint untuk provider ini akan ditambahkan berdasarkan dokumentasi resminya, seperti EarnVids dan UPNShare.</p>
            </div>
        </section>

        <div class="form-group">
            <label class="control-label" for="host-api-token">Provider API key</label>
            <?= form_input($tokenAttributes) ?>
            <small>The token is never displayed after it has been saved.</small>
        </div>

        <div class="host-api-test" data-api-id="<?= $isExisting ? (int) $tpAPI->id : 0 ?>">
            <div>
                <strong><i class="fa fa-plug"></i> Connection check</strong>
                <small>Tests the saved API key without saving and displays the documented list/detail response for the selected provider.</small>
            </div>
            <button type="button" class="btn btn-outline-primary" id="host-api-test"><i class="fa fa-refresh"></i> Test connection</button>
        </div>
        <div id="host-api-test-result" aria-live="polite"></div>

        <div class="host-api-permissions">
            <span class="host-api-permissions__label">Enabled provider scopes</span>
            <span><i class="fa fa-check-circle"></i> List / inventory</span>
            <span><i class="fa fa-check-circle"></i> Video delivery</span>
            <span><i class="fa fa-check-circle"></i> Poster / preview image</span>
            <small>Movie metadata, series metadata, and URL-template automation remain disabled.</small>
        </div>

        <div class="form-group host-api-status">
            <?= form_label('Status', 'host-api-status', ['class' => 'control-label']) ?>
            <?= form_dropdown([
                'id' => 'host-api-status',
                'name' => 'status',
                'options' => ['active' => 'Active', 'paused' => 'Paused'],
                'selected' => old('status', $tpAPI->status ?: 'active'),
                'class' => 'form-control',
            ]) ?>
        </div>
    </div>
</div>

<div class="text-right">
    <button type="submit" class="btn btn-primary d-inline-block px-5">Save API access</button>
</div>
