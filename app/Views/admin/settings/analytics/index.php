<?php
$token = old('cloudflare_web_analytics_token', get_config('cloudflare_web_analytics_token'));
$isConfigured = trim((string) $token) !== '';
?>
<?php $this->extend('admin/__layout/default') ?>

<?php $this->section('content') ?>

<div class="row">
    <div class="col-lg-10 col-xxl-8">
        <?= form_open('/admin/settings/analytics/update', ['method' => 'post', 'class' => 'form-horizontal form-label-left']) ?>

        <section class="x_panel analytics-settings-panel">
            <div class="x_title">
                <h2>Cloudflare Web Analytics</h2>
                <ul class="nav navbar-right panel_toolbox"><li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li></ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="analytics-settings-intro">
                    <span class="analytics-settings-intro__icon"><i class="fa fa-cloud"></i></span>
                    <div>
                        <span class="analytics-settings-eyebrow">PRIVACY-FIRST ANALYTICS</span>
                        <h3>Audience dan perangkat tanpa database aplikasi</h3>
                        <p>Token ini memasang Cloudflare beacon pada seluruh halaman publik dan embed player. Cloudflare menyajikan page views, audience, serta device breakdown pada dashboardnya; aplikasi ini tidak menyimpan statistik tersebut di MySQL.</p>
                    </div>
                    <span class="analytics-settings-status <?= $isConfigured ? 'is-connected' : '' ?>"><i class="fa fa-<?= $isConfigured ? 'check-circle' : 'exclamation-circle' ?>"></i> <?= $isConfigured ? 'Terhubung' : 'Belum terhubung' ?></span>
                </div>

                <div class="form-group row analytics-settings-field">
                    <label class="control-label col-md-3" for="cloudflare-web-analytics-token">Site tag token</label>
                    <div class="col-md-9">
                        <?= form_input([
                            'type' => 'text',
                            'class' => 'form-control',
                            'id' => 'cloudflare-web-analytics-token',
                            'name' => 'cloudflare_web_analytics_token',
                            'value' => $token,
                            'maxlength' => 128,
                            'autocomplete' => 'off',
                            'placeholder' => 'Paste Cloudflare Web Analytics token',
                        ]) ?>
                        <small>Di Cloudflare: <strong>Analytics &amp; Logs → Web Analytics</strong>, pilih situs lalu salin token dari JavaScript snippet. Token ini bersifat publik dan hanya dipakai oleh beacon di browser.</small>
                    </div>
                </div>

                <div class="analytics-settings-links">
                    <a href="https://dash.cloudflare.com/" target="_blank" rel="noopener noreferrer"><i class="fa fa-external-link"></i> Buka Cloudflare dashboard</a>
                    <a href="https://developers.cloudflare.com/web-analytics/" target="_blank" rel="noopener noreferrer"><i class="fa fa-book"></i> Dokumentasi pemasangan</a>
                </div>
            </div>
        </section>

        <div class="text-right mb-3">
            <?= form_button(['type' => 'submit', 'class' => 'btn btn-primary'], 'Save Cloudflare Analytics') ?>
        </div>
        <?= form_close() ?>
    </div>
</div>

<?php $this->endSection() ?>
