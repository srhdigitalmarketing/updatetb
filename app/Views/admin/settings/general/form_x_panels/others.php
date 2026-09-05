<div class="x_panel">
    <div class="x_title">
        <h2>Others</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">

        <div class="form-group row">
            <label class="control-label col-md-3">Stream Quality Formats</label>
            <div class="col-md-9">
                <?= form_textarea([
                    'name' => 'stream_quality_formats',
                    'class' => 'form-control',
                    'rows' => 2
                ], implode(', ', get_config('stream_quality_formats'))) ?>
                <small>Separate each resolution format by comma. <br> Ex: HD , SD , CAM </small>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-3">Download Quality Formats</label>
            <div class="col-md-9">
                <?= form_textarea([
                    'name' => 'download_quality_formats',
                    'class' => 'form-control',
                    'rows' => 2
                ], implode(', ', get_config('download_quality_formats'))) ?>
                <small>Separate each quality format by comma. <br> Ex: HDRip , CAM </small>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-3">Download Resolution Formats</label>
            <div class="col-md-9">
                <?= form_textarea([
                    'name' => 'download_resolution_formats',
                    'class' => 'form-control',
                    'rows' => 2
                ], implode(', ', get_config('download_resolution_formats'))) ?>
                <small>Separate each resolution format by comma. <br> Ex: 720p.xxx , 480p.xxx </small>

            </div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-3">Links Report</label>
            <div class="col-md-9">
                <div class="checkbox  mt-2">
                    <label>
                        <?= form_checkbox('is_links_report','', get_config('is_links_report')) ?>
                        Enable/ Disable
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group row">
            <label class="control-label col-md-3">Download System</label>
            <div class="col-md-9">
                <div class="checkbox  mt-2">
                    <label>
                        <?= form_checkbox('download_system','', get_config('download_system')) ?>
                        Enable/ Disable
                    </label>
                </div>
            </div>
        </div>

        <div class="text-right">
            <?= form_button([
                'type' => 'submit',
                'class' => 'btn btn-primary'
            ], 'update') ?>
        </div>



    </div>
</div>