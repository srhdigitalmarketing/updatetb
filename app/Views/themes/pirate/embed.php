<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <?php if( has_site_favicon() ): ?>
        <link rel="shortcut icon" href="<?= site_favicon() ?>" type="image/x-icon">
        <link rel="icon" href="<?= site_favicon() ?>" type="image/x-icon">
    <?php endif; ?>

    <link href="<?= theme_assets('/css/template.min.css?v=1.2') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= theme_assets('/css/custom.css?v=20260906') ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous">
    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>


    <title><?= ! empty($links) ? $movie->getMovieTitle() : 'video not found' ?> </title>
    <style>
        body{
            background-color: var(--dm-card-bg-color) !important;
        }
    </style>

    <!-- header custom codes-->
    <?= header_custom_codes() ?>

</head>
<body  class="dark-mode overflow-y-hidden">
    <?php if(! empty($links)): ?>
    <div id="embed-player" data-movie-id="<?= encode_id( $movie->id ) ?>">
    <div class="sticky-alerts bottom-0 top-auto mb-15"></div>
    <div class="top-bar" style="display: none">

    <div class="d-sm-flex align-items-center">

    <?php if ( is_direct_access() ): ?>
    <a href="<?= $movie->getViewLink(true) ?>" class="btn mr-10" target="_parent">
    <i class="fa fa-home" aria-hidden="true"></i>
    </a>
    <?php endif; ?>
    <button type="button" class="btn btn-dark sliderbar_bg" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <i class="bi bi-code-slash"></i>
    </button>    
    &nbsp;
    <div class="dropdown mr-5 <?= count( $links ) == 1 ? 'd-none' : '' ?>" id="servers" >
    <button class="btn sliderbar_bg active-server" data-toggle="dropdown"  type="button" id="dropdown-toggle-btn-1" aria-haspopup="true" aria-expanded="false">
    <i class="fa fa-server" aria-hidden="true"></i>&nbsp;
    <span class="name"><?= reset( $links ) ?></span>&nbsp;
    <i class="fa fa-angle-down ml-5" aria-hidden="true"></i> <!-- ml-5 = margin-left: 0.5rem (5px) -->
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdown-toggle-btn-1">
    <?php
    foreach ($links as $id => $link) {
    echo '<a href="javascript:void(0)" onClick="Player.play(false, this)" class="server dropdown-item" data-id="' . $id . '"> ' . esc( $link ) . ' </a>';
    }
    ?>
    </div>
    </div>


                <?php if( is_links_report_enabled() ): ?>

                <div class="dropdown">
                    <button class="btn sliderbar_bg mr-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right w-250 w-sm-250" aria-labelledby="sign-in-dropdown-toggle-btn">
                        <div class="dropdown-content p-10">

                            <h3 class="content-title font-size-16 text-danger">
                               <?= lang('Report.report_server') ?>
                            </h3>

                            <form action="">
                                <div class="mb-20">
                                    <?= lang('Report.select_reason') ?>:&nbsp;
                                    <select class="form-control d-inline-block w-auto" name="reason">
                                        <option value="not_working" selected="selected" ><?= lang('Report.not_working') ?></option>
                                        <option value="wrong_video"><?= lang('Report.wrong_video') ?></option>
                                    </select>
                                </div>
                                <div class="dropdown-divider"></div>
                                <div class="text-right mt-10">
                                    <button class="btn btn-danger" id="report-st-link" type="button"><?= lang('Report.report_btn') ?></button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>

                <?php endif; ?>
                <button class="btn toggle-top-bar sliderbar_bg">
                    <i class="fa fa-times" aria-hidden="true"></i>
                </button>
                
    
    </div>

    <div class="d-inline-block d-sm-none"></div>
    <div class=" d-flex align-items-center">

            </div>
        </div>
        <button class="toggle-top-bar sliderbar toggle-btn-short btn position-fixed font-weight-bold top-0 left-0  z-10"><i class="fa fa-server bx-flashing" aria-hidden="true"></i>
        </button>
  
        <div class="main-content">
            <div class="cover" style="background: linear-gradient( rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3) ), url(<?= banner_uri(
                $movie->banner
            ) ?>);"></div>
            <div class="play-btn" onclick="Player.play()">
            <img src="<?= theme_assets('/images/icons/play-icons.svg') ?>" class="h-25" alt="play-btn">
            </div>
            <div class="frame">
                <iframe id="ve-iframe"   width="100%" scrolling="no" allowfullscreen="true" frameborder="0"></iframe>
            </div>
            <div class="loader">
            <div class="lds-ripple"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
            <div class="ve-text">
            <?= lang('Embed.please_wait') ?>
            </div>
            </div>
            <div class="error">
                <span class="lbl font-size-14"> <?= lang('Embed.unknown_error_occurred') ?> </span>
                <span class="msg"></span>
            </div>
            <div class="g-recaptcha" data-sitekey="<?= esc( get_config('gcaptcha_site_key') ) ?>"
                 data-badge="inline" data-size="invisible" data-callback="set_captcha_response"></div>

        </div>
    </div>

<?php else: ?>

    <div class="movie-not-found">
        <div class="img-wrap text-center">
            <img src="<?= theme_assets('/images/icons/cat.png') ?>" class="w-100" alt="">
            <h3 class="font-size-24 text-muted">
                <?php if( $serverNotFound ){
                    echo lang('Embed.server_not_found');
                }else if(empty( $movie )){
                    echo lang('Embed.movie_not_found');
                }else {
                    echo lang('Embed.streaming_links_not_found');
                } ?>
            </h3>
            <hr>
            <?php if( $serverNotFound ): ?>
                <a href="<?= $movie->getEmbedLink(true) ?>?load-server=1"> <?= lang('Embed.load_another_server') ?> </a>
            <?php endif; ?>
        </div>
    </div>

    <?php endif; ?>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content we-embedlinks">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Embed Links</h5>
    </div>
    <div class="modal-body">
        
    <!-- First button group -->
<div class="tabs p-5 bg-dark-light font-weight-semi-bold mb-20 w-auto d-inline-flex">
    <a href="#" class="btn" data-target="direct-links-content">
        <i class="fa fa-link" aria-hidden="true"></i>
        &nbsp; Direct Links
    </a>
    <a href="#" class="nav-link d-inline-block" data-target="embed-code-content">
        <i class="fa fa-code" aria-hidden="true"></i>
        &nbsp; Embed Code
    </a>
</div>

    <div class="tab-content active" id="direct-links-content">

    <div class="form-group">
    <label for="basic-url">Direct Links 1</label> 
    <!-- Another input group with stacked buttons (appended) -->
    <div class="input-group">
    <input type="text" class="form-control" value="<?= esc( $movie->getEmbedLink(true) ) ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>
    </div>
    <div class="form-group mb-0">
    <label for="basic-url">Direct Links 2</label> 
    <!-- Another input group with stacked buttons (appended) -->
    <div class="input-group">
    <input type="text" class="form-control" value="<?= esc( $movie->getEmbedLink() ) ?>" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
    </div>
    </div>
    </div>
    <div class="tab-content" id="embed-code-content">
    <div class="position-relative">
        <textarea name="" id="embed-code" class="form-control embed-code"  rows="8" readonly="readonly"><iframe id="ve-iframe" src="<?= esc( $movie->getEmbedLink() ) ?>" width="100%" height="100%" allowfullscreen="allowfullscreen" frameborder="0"></iframe></textarea>
        <button class="btn position-absolute bottom-0 right-0 m-5 " type="button" onclick="copyToClipboard('#embed-code')"><i class="fa fa-copy"></i></button>
    </div>
    </div>
    </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script> const BASE_URL = '<?= site_url() ?>'; </script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<?php if( get_config('is_stream_gcaptcha_enabled') ): ?>
    <script  src="https://www.google.com/recaptcha/api.js" async defer></script>
<?php endif; ?>

<script src="<?= theme_assets('js/template.min.js?v=1.2') ?>"></script>
<script src="<?= theme_assets('js/custom.min.js?v=1.2') ?>"></script>
<script src="<?= theme_assets('js/player.js?v=20260906') ?>"></script>

<!--footer custom codes-->
<?= footer_custom_codes () ?>

<!--popAds-->
<?php if(isset( $ads )) {
    echo display_pop_ad( $ads );
}  ?>

</body>
</html>
