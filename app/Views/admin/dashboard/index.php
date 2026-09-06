<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>


<div class="dashboard-page">
    <div class="dashboard-metrics-grid">
        <?= $this->include('admin/dashboard/x_panel/top_tiles') ?>
    </div>

    <div class="dashboard-visitor-grid">
        <?= $this->include('admin/dashboard/x_panel/charts/visitor_statistics') ?>
    </div>

    <div class="dashboard-tables-grid">
        <div class="dashboard-table-cell">
            <?= $this->include('admin/dashboard/x_panel/most_viewed_movies') ?>
        </div>
        <div class="dashboard-table-cell">
            <?= $this->include('admin/dashboard/x_panel/daily_player_analytics') ?>
        </div>
    </div>

    <section class="dashboard-secondary-metrics" aria-labelledby="library-health-title">
        <div class="dashboard-secondary-metrics__heading">
            <div>
                <span class="dashboard-eyebrow">OPERATIONS</span>
                <h2 id="library-health-title">Library health</h2>
            </div>
            <a href="<?= admin_url('/movies') ?>">View library <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="dashboard-secondary-metrics__grid">
            <?= $this->include('admin/dashboard/x_panel/secondary_tiles') ?>
        </div>
    </section>
</div>


<?php $this->endSection() ?>



<?php $this->section('scripts'); ?>

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

(function () {
    var endpoint = <?= json_encode(admin_url('/dashboard/revenue-today')) ?>;
    var total = document.querySelector('.js-revenue-total');
    var caption = document.querySelector('.js-revenue-caption');
    var updated = document.querySelector('.js-revenue-updated');
    if (! total || ! window.fetch) return;

    fetch(endpoint, {credentials: 'same-origin'})
        .then(function (response) { return response.ok ? response.json() : null; })
        .then(function (data) {
            if (! data) return;
            total.textContent = data.display_total || '—';
            if (caption) caption.textContent = data.message || '';
            if (updated && data.updated_at) {
                var time = new Date(data.updated_at);
                updated.textContent = 'Terakhir diperbarui ' + time.toLocaleTimeString([], {hour: '2-digit', minute: '2-digit'});
            }
        })
        .catch(function () {
            if (caption && caption.textContent === 'Memuat pendapatan hari ini…') {
                caption.textContent = 'Pendapatan belum dapat dimuat. Coba segarkan halaman.';
            }
        });
})();
</script>

<?php $this->endSection() ?>
