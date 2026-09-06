<section class="dashboard-visitor-panel dashboard-cloudflare-panel" aria-labelledby="latest-statistics-title">
    <header class="dashboard-visitor-panel__header">
        <div>
            <span class="dashboard-eyebrow">AUDIENCE</span>
            <h2 id="latest-statistics-title">Web Analytics</h2>
            <p>Audience dikelola langsung oleh Cloudflare, tanpa disimpan di database aplikasi.</p>
        </div>
        <span class="dashboard-period-chip <?= $cloudflareAnalyticsConfigured ? 'is-connected' : '' ?>"><i class="fa fa-<?= $cloudflareAnalyticsConfigured ? 'check-circle' : 'plug' ?>"></i> <?= $cloudflareAnalyticsConfigured ? 'Terhubung' : 'Perlu diatur' ?></span>
    </header>
    <div class="dashboard-cloudflare-panel__body">
        <span class="dashboard-cloudflare-panel__icon"><i class="fa fa-cloud"></i></span>
        <div>
            <strong>Traffic, page views, dan audience</strong>
            <p>Gunakan dashboard Cloudflare untuk metrik aktual, filter periode, dan ringkasan pengunjung.</p>
        </div>
    </div>
    <div class="dashboard-cloudflare-panel__actions">
        <a class="btn btn-primary btn-sm" href="https://dash.cloudflare.com/" target="_blank" rel="noopener noreferrer"><i class="fa fa-external-link"></i> Buka Cloudflare Analytics</a>
        <a class="btn btn-default btn-sm" href="<?= admin_url('/settings/analytics') ?>"><i class="fa fa-gear"></i> <?= $cloudflareAnalyticsConfigured ? 'Atur token' : 'Hubungkan' ?></a>
    </div>
</section>

<section class="dashboard-visitor-panel dashboard-cloudflare-panel" aria-labelledby="platform-title">
    <header class="dashboard-visitor-panel__header">
        <div>
            <span class="dashboard-eyebrow">DEVICES</span>
            <h2 id="platform-title">Device breakdown</h2>
            <p>Desktop, mobile, dan device browser tersedia pada dimensi Cloudflare.</p>
        </div>
        <span class="dashboard-period-chip"><i class="fa fa-mobile"></i> Cloudflare</span>
    </header>
    <div class="dashboard-cloudflare-panel__body">
        <span class="dashboard-cloudflare-panel__icon dashboard-cloudflare-panel__icon--purple"><i class="fa fa-mobile"></i></span>
        <div>
            <strong>Tidak ada profil perangkat lokal</strong>
            <p>Aplikasi tidak lagi menyimpan platform atau identitas pengunjung. Semua agregasi perangkat berada di Cloudflare.</p>
        </div>
    </div>
    <div class="dashboard-cloudflare-panel__note"><i class="fa fa-shield"></i> Tidak ada tabel audience baru yang ditulis oleh embed player.</div>
</section>
