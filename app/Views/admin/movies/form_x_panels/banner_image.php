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
            <div class="input-group banner-remote-url-group">
                <?= form_input([
                    'type' => 'url',
                    'name' => 'banner_url',
                    'class' => 'form-control',
                    'value' => old('banner_url')
                ]) ?>
                <span class="input-group-btn banner-remote-url-delete" hidden>
                    <button type="button" class="btn btn-danger" data-clear-banner-url><i class="fa fa-trash"></i> Delete</button>
                </span>
            </div>
        </div>
        <?php if (! empty($movie->id)): ?>
            <div class="form-group banner-host-poster">
                <button type="button" class="btn btn-outline-primary btn-sm stream-poster-fetch" data-movie-id="<?= (int) $movie->id ?>">
                    <i class="fa fa-image"></i> Use image from stream host
                </button>
                <small class="form-text text-muted">Checks available stream hosts first, then retrieves a thumbnail from its API or page metadata.</small>
                <div class="stream-poster-result" aria-live="polite"></div>
            </div>
        <?php endif; ?>
        <div class="separator"> or </div>
        <div class="form-group">
            <?= form_label('Select from PC:') ?>
            <?= form_input([
                'type' => 'file',
                'name' => 'banner_file',
                'accept' => 'image/*'
            ]) ?>
        </div>

    </div>
</div>
