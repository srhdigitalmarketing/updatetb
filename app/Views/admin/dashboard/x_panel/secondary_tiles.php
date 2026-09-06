<div class="dashboard-metric metric-coverage">
    <div class="tile-stats metric-card">
        <div class="icon"><i class="fa fa-trophy"></i></div>
        <div class="count"><span class="<?= $anytc->coverage->color_class ?>"><?= number_format($anytc->coverage->value) ?></span>%</div>
        <h3>Coverage</h3>
    </div>
</div>
<div class="dashboard-metric metric-views">
    <div class="tile-stats metric-card">
        <div class="icon"><i class="fa fa-eye"></i></div>
        <div class="count"><?= number_format($anytc->movies->views) ?></div>
        <h3>Views</h3>
    </div>
</div>
<div class="dashboard-metric metric-links">
    <div class="tile-stats metric-card">
        <div class="icon"><i class="fa fa-link"></i></div>
        <div class="count"><?= number_format($anytc->links->total) ?></div>
        <h3>Links</h3>
    </div>
</div>
<div class="dashboard-metric metric-requests">
    <div class="tile-stats metric-card">
        <div class="icon"><i class="fa fa-exchange"></i></div>
        <div class="count"><?= number_format($anytc->links_requests->total) ?></div>
        <h3>Requests <small>to links</small></h3>
    </div>
</div>
<div class="dashboard-metric metric-reported">
    <div class="tile-stats metric-card">
        <div class="icon"><i class="fa fa-unlink"></i></div>
        <div class="count red"><?= number_format($anytc->reported_links->total) ?></div>
        <h3>Reported <small>links</small></h3>
    </div>
</div>
