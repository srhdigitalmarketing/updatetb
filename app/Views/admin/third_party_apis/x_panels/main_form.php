


<?php
$providerOptions = [
    'earnvids' => 'EarnVids',
    'upnshare' => 'UPNShare',
    'vidhide' => 'Vidhide',
    'xvideosharing' => 'XVideoSharing compatible',
    'custom' => 'Custom host',
];
$isExisting = ! empty($tpAPI->id);
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
                    'selected' => old('provider', $tpAPI->provider ?: 'earnvids'),
                ]) ?>
            </div>
        </div>

        <?= form_input([
            'id' => 'host-api-base-url',
            'type' => 'hidden',
            'name' => 'api_base_url',
            'value' => old('api_base_url', $tpAPI->api_base_url ?: 'https://earnvidsapi.com/api'),
        ]) ?>
        <div class="host-api-fixed-endpoint">
            <strong>EarnVids data scope</strong>
            <span>Endpoint mengikuti dokumentasi EarnVids secara otomatis. Hanya API key yang perlu disimpan.</span>
        </div>

        <section class="provider-api-structure" aria-labelledby="earnvids-api-structure-title">
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

        <div class="form-group">
            <label class="control-label" for="host-api-token">EarnVids API key</label>
            <?= form_input($tokenAttributes) ?>
            <small>The token is never displayed after it has been saved.</small>
        </div>

        <div class="host-api-test" data-api-id="<?= $isExisting ? (int) $tpAPI->id : 0 ?>">
            <div>
                <strong><i class="fa fa-plug"></i> Connection check</strong>
                <small>Tests the saved API key without saving. File List and File Info results are shown when EarnVids responds.</small>
            </div>
            <button type="button" class="btn btn-outline-primary" id="host-api-test"><i class="fa fa-refresh"></i> Test connection</button>
        </div>
        <div id="host-api-test-result" aria-live="polite"></div>

        <div class="host-api-permissions">
            <span class="host-api-permissions__label">Enabled EarnVids scopes</span>
            <span><i class="fa fa-check-circle"></i> File List</span>
            <span><i class="fa fa-check-circle"></i> Direct Link</span>
            <span><i class="fa fa-check-circle"></i> Thumbnail / player image</span>
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
