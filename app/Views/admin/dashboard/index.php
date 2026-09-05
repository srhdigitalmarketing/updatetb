<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>


<div class="row" style="display: inline-block;width: 100%;">
    <div class="top_tiles">
        <?= $this->include('admin/dashboard/x_panel/top_tiles') ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-md-6">
        <?= $this->include('admin/dashboard/x_panel/charts/series_completion') ?>
    </div>
    <div class="col-lg-4 col-md-6">
        <?= $this->include('admin/dashboard/x_panel/charts/episodes_completion') ?>
    </div>
    <div class="col-lg-4 col-md-6">
        <?= $this->include('admin/dashboard/x_panel/charts/links_completion') ?>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <?= $this->include('admin/dashboard/x_panel/most_viewed_movies') ?>
    </div>
    <div class="col-lg-6">
        <?= $this->include('admin/dashboard/x_panel/most_viewed_episodes') ?>
    </div>
</div>


<?php $this->endSection() ?>



<?php $this->section('scripts'); ?>

<!-- ChartJs -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<?= $this->include('admin/dashboard/charts_js') ?>

<?php $this->endSection() ?>
