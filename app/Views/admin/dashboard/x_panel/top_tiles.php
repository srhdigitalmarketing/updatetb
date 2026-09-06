<div class="col-12 col-md-6 col-xl-4 dashboard-metric dashboard-live-traffic">
    <div class="live-traffic-card">
        <div class="live-traffic-card__header">
            <div>
                <span class="live-traffic-card__eyebrow">LIVE ACTIVITY</span>
                <h3>Live Traffic</h3>
            </div>
            <span class="live-traffic-card__status <?= $liveTraffic['tracking_ready'] ? '' : 'is-pending' ?>">
                <i class="fa fa-circle"></i> <?= $liveTraffic['tracking_ready'] ? 'Live' : 'Setup required' ?>
            </span>
        </div>
        <div class="live-traffic-card__count js-active-now"><?= number_format($liveTraffic['active_now']) ?></div>
        <p class="live-traffic-card__caption js-live-traffic-caption">
            <?= $liveTraffic['tracking_ready'] ? 'Visitors active in the last 3 minutes.' : 'Import the latest database update to start tracking.' ?>
        </p>
        <div class="live-traffic-card__footer"><i class="fa fa-refresh"></i> Updates every 30 seconds</div>
    </div>
</div>

<div class="col-12 col-md-6 col-xl-4 dashboard-metric metric-video">
    <div class="tile-stats metric-card">
        <div class="icon"><i class="fa fa-film"></i></div>
        <div class="count">
            <?= number_format( $anytc->movies->total ) ?>
        </div>
        <h3>Videos</h3>
        <p class="metric-card__context">Total videos in your library</p>
    </div>
</div>
<div class="col-12 col-md-6 col-xl-4 dashboard-metric metric-revenue">
    <div class="tile-stats metric-card metric-card--revenue">
        <div class="icon"><i class="fa fa-line-chart"></i></div>
        <div class="count js-revenue-total"><?= esc($revenueSummary['display_total']) ?></div>
        <h3>Pendapatan hari ini</h3>
        <p class="js-revenue-caption"><?= esc($revenueSummary['message']) ?></p>
        <small class="js-revenue-updated">
            <?= ! empty($revenueSummary['updated_at']) ? 'Terakhir diperbarui ' . esc(date('H:i', strtotime($revenueSummary['updated_at']))) : '' ?>
        </small>
        <a href="<?= admin_url('/ads/embed_page') ?>">Konfigurasi monetisasi <i class="fa fa-arrow-right"></i></a>
    </div>
</div>
