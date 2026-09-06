<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>


<div class="dashboard-page">
    <div class="dashboard-command-bar">
        <div class="dashboard-command-copy">
            <span class="dashboard-eyebrow">VIDEO OPERATIONS</span>
            <h2>Video Command Center</h2>
            <p>Manage your library, monitor link quality, and act on the metrics that need attention.</p>
        </div>
        <div class="dashboard-command-actions">
            <a class="dashboard-primary-action" href="<?= admin_url('/movies/new') ?>">
                <i class="fa fa-plus"></i> Add Video
            </a>
            <a class="dashboard-secondary-action" href="<?= admin_url('/movies') ?>">
                View Library <i class="fa fa-arrow-right"></i>
            </a>
        </div>
    </div>

    <div class="dashboard-metrics-grid">
        <?= $this->include('admin/dashboard/x_panel/top_tiles') ?>
    </div>

    <div class="dashboard-charts-grid">
    <div class="dashboard-chart-cell dashboard-chart-cell--wide">
        <?= $this->include('admin/dashboard/x_panel/charts/links_completion') ?>
    </div>
    </div>

    <div class="dashboard-tables-grid">
    <div class="dashboard-table-cell">
        <?= $this->include('admin/dashboard/x_panel/most_viewed_movies') ?>
    </div>
    </div>
</div>


<?php $this->endSection() ?>



<?php $this->section('scripts'); ?>

<!-- ChartJs -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<?= $this->include('admin/dashboard/charts_js') ?>

<script>
(function () {
    var endpoint = <?= json_encode(admin_url('/dashboard/live-traffic')) ?>;
    var count = document.querySelector('.js-active-now');
    var caption = document.querySelector('.js-live-traffic-caption');
    if (! count || ! window.fetch) return;

    function refreshLiveTraffic() {
        fetch(endpoint, {credentials: 'same-origin'})
            .then(function (response) { return response.ok ? response.json() : null; })
            .then(function (data) {
                if (! data) return;
                count.textContent = Number(data.active_now || 0).toLocaleString();
                if (caption && data.tracking_ready) {
                    caption.textContent = 'Visitors using the embed player in the last 3 minutes.';
                }
            })
            .catch(function () {});
    }

    window.setInterval(refreshLiveTraffic, 30000);
})();
</script>

<?php $this->endSection() ?>
