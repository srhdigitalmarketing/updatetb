<div class="x_panel">
    <div class="x_title">
        <h2>Banner Image</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content">


            <div class="banner-wrap ">
                <?php if($movie->hasBanner()): ?>
                <img src="<?= banner_uri( $movie->banner ) ?>" class="w-100 mb-2" alt="banner image">
                <?php endif; ?>
            </div>


        <div class="form-group">
            <?= form_label('Select from remote URL:') ?>
            <?= form_input([
                'type' => 'url',
                'name' => 'banner_url',
                'class' => 'form-control',
                'value' => old('banner_url')
            ]) ?>
        </div>
        <div class="separator"> or </div>
        <div class="form-group">
            <?= form_label('Select from PC:') ?>
            <?= form_input([
                'type' => 'file',
                'name' => 'banner_file',
                'accept' => 'image/*'
            ]) ?>
        </div>
        <?= form_hidden('remove_banner', old('remove_banner', '0')) ?>
        <div class="banner-image-actions">
            <button type="submit" name="upload_banner" value="1" class="btn btn-primary" data-upload-banner-to-r2><i class="fa fa-cloud-upload"></i> Upload to R2</button>
            <button type="button" class="btn btn-danger" data-clear-banner-image disabled><i class="fa fa-trash"></i> Delete image</button>
        </div>
        <small class="banner-image-actions__hint">Select a file or remote URL, then upload it to the configured Cloudflare R2 storage.</small>

    </div>
</div>
