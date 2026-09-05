<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>


<div class="dashboard-page">
    <div class="dashboard-intro">
        <div>
            <span class="dashboard-eyebrow">VIDEO OPERATIONS</span>
            <p>Monitor your content library, link coverage, and audience activity in one place.</p>
        </div>
        <span class="dashboard-live-indicator"><i class="fa fa-circle"></i> Live overview</span>
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

<?php $this->endSection() ?>
