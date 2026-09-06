<div class="x_panel">
    <div class="x_title">
        <h2>Stream Links</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="x_content" id="st-group-content">

        <?php if(! empty($streamLinks)): ?>
            <?php foreach ($streamLinks as $key => $link):
                $key += 1; ?>
                <div class="form-group st-group">

                    <?= form_label("Link {$key}:", "", ['class'=>'font-weight-bold']) ?>

                    <div class="link-meta-info mb-1">
                        <span class="requests-count">Requests :  <?= $link->requests ?></span>
                        <span class="status float-right">Status : <?= format_links_status( $link->is_broken ) ?> </span>
                    </div>


                    <div class="input-group">
                        <?php $fields = [
                            'type' => 'url',
                            'name' => "st_links[{$key}][url]",
                            'class' => 'form-control link',
                            'value' => old("st_links.{$key}.url", $link->link)
                        ]; if( $link->isApiBased() ) $fields['readonly'] = 'readonly' ?>
                        <?= form_input($fields) ?>

                        <span class="input-group-btn ml-2">
                                <?= form_button( [
                                    'class' => 'btn btn-light clone-st-group'
                                ],
                                    '<i class="fa fa-plus"></i>'
                                ) ?>
                            </span>
                    </div>
                    <div class="row mt-2 stream-health-fields">
                        <div class="col-md-4">
                            <?= form_label('Host priority', '') ?>
                            <?= form_input([
                                'type' => 'number',
                                'min' => '0',
                                'max' => '65535',
                                'name' => "st_links[{$key}][host_priority]",
                                'class' => 'form-control stream-priority',
                                'value' => old("st_links.{$key}.host_priority", $link->host_priority ?? 100)
                            ]) ?>
                            <small class="form-text text-muted">Higher values are tried first; the next link is used automatically if playback fails.</small>
                        </div>
                        <div class="col-md-8">
                            <?= form_label('Provider video ID (optional)', '') ?>
                            <?= form_input([
                                'type' => 'text',
                                'name' => "st_links[{$key}][upnshare_video_id]",
                                'class' => 'form-control upnshare-video-id',
                                'value' => old("st_links.{$key}.upnshare_video_id", $link->upnshare_video_id ?? ''),
                                'placeholder' => 'Used for API availability checks (UPNShare/VidHide)'
                            ]) ?>
                        </div>
                    </div>

                    <?= form_hidden("st_links[{$key}][id]", $link->id); ?>
                    <?=  ! empty($link->api_id) ?  form_hidden("st_links[{$key}][api_id]", $link->api_id) : '' ?>


                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <?php for($i = 1; $i <= 3; $i++) : ?>
                <div class="form-group st-group" >
                    <?= form_label("Link {$i}:") ?>
                    <div class="input-group">
                        <?= form_input([
                            'type' => 'url',
                            'name' => "st_links[{$i}][url]",
                            'class' => 'form-control link',
                            'value' => old("st_links.{$i}.url")
                        ]) ?>

                        <span class="input-group-btn ml-2">
                                <?= form_button( [
                                    'class' => 'btn btn-light clone-st-group'
                                ],
                                    '<i class="fa fa-plus"></i>'
                                ) ?>
                        </span>
                    </div>
                    <div class="row mt-2 stream-health-fields">
                        <div class="col-md-4">
                            <?= form_label('Host priority', '') ?>
                            <?= form_input([
                                'type' => 'number',
                                'min' => '0',
                                'max' => '65535',
                                'name' => "st_links[{$i}][host_priority]",
                                'class' => 'form-control stream-priority',
                                'value' => old("st_links.{$i}.host_priority", 100)
                            ]) ?>
                            <small class="form-text text-muted">Higher values are tried first; the next link is used automatically if playback fails.</small>
                        </div>
                        <div class="col-md-8">
                            <?= form_label('Provider video ID (optional)', '') ?>
                            <?= form_input([
                                'type' => 'text',
                                'name' => "st_links[{$i}][upnshare_video_id]",
                                'class' => 'form-control upnshare-video-id',
                                'value' => old("st_links.{$i}.upnshare_video_id"),
                                'placeholder' => 'Used for API availability checks (UPNShare/VidHide)'
                            ]) ?>
                        </div>
                    </div>



                </div>
            <?php endfor; ?>
        <?php endif; ?>




    </div>
</div>
