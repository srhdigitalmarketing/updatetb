<?php $this->extend( 'admin/__layout/default' ) ?>


<?php $this->section('content') ?>

<div class="row">
    <div class="col-lg-9">

        <?= form_open_multipart('/admin/settings/site/update', [ 'method' => 'post', 'class' => 'form-horizontal form-label-left' ] ) ?>


        <?= $this->include('admin/settings/site/form_x_panels/general.php') ?>
        <?= $this->include('admin/settings/site/form_x_panels/page_url.php') ?>
        <?= $this->include('admin/settings/site/form_x_panels/custom_codes.php') ?>

        <div class="text-right mb-3">
            <?= form_button([
                'type' => 'submit',
                'class' => 'btn btn-primary'
            ], 'update') ?>
        </div>

        <?= form_close() ?>

    </div>
</div>


<?php $this->endSection() ?>
