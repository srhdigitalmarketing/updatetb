<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-film "></i></div>
        <div class="count">
            <?= number_format( $anytc->movies->total ) ?>
        </div>
        <h3>Movies</h3>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-desktop"></i></div>
        <div class="count">
            <?= number_format( $anytc->series->total ) ?>
        </div>
        <h3>TV Shows</h3>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-video-camera"></i></div>
        <div class="count">
            <?= number_format( $anytc->episodes->completed ) ?>
        </div>
        <h3>Episodes</h3>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-trophy"></i></div>
        <div class="count"><span class="<?= $anytc->coverage->color_class ?>">
                        <?= number_format( $anytc->coverage->value ) ?>
                    </span>%</div>
        <h3>Coverage</h3>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-eye"></i></div>
        <div class="count">
            <?= number_format( $anytc->movies->views + $anytc->episodes->views ) ?>
        </div>
        <h3>Views</h3>
        <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item">Movies :
                <span class="float-right px-1">
                            <?= number_format( $anytc->movies->views ) ?>
                        </span>
            </li>
            <li class="list-group-item">Episodes :
                <span class="float-right  px-1">
                            <?= number_format( $anytc->episodes->views ) ?>
                        </span>
            </li>
        </ul>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-link"></i></div>
        <div class="count">
            <?= number_format( $anytc->links->total ) ?>
        </div>
        <h3>Links</h3>
        <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item">Streaming  :
                <span class="float-right px-1">
                            <?= number_format( $anytc->links->stream ) ?>
                        </span>
            </li>
            <li class="list-group-item">Direct Download :
                <span class="float-right  px-1">
                            <?= number_format( $anytc->links->direct_dl ) ?>
                        </span>
            </li>
            <li class="list-group-item">Torrent Download :
                <span class="float-right  px-1">
                            <?= number_format( $anytc->links->torrent_dl ) ?>
                        </span>
            </li>
        </ul>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-exchange"></i></div>
        <div class="count">
            <?= number_format( $anytc->links_requests->total ) ?>
        </div>
        <h3>Requests <small>to links</small> </h3>
        <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item">Streaming  :
                <span class="float-right px-1">
                            <?= number_format( $anytc->links_requests->stream ) ?>
                        </span>
            </li>
            <li class="list-group-item">Direct Download :
                <span class="float-right  px-1">
                            <?= number_format( $anytc->links_requests->direct_dl ) ?>
                        </span>
            </li>
            <li class="list-group-item">Torrent Download :
                <span class="float-right  px-1">
                            <?= number_format( $anytc->links_requests->torrent_dl ) ?>
                        </span>
            </li>
        </ul>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-unlink"></i></div>
        <div class="count red">
            <?= number_format( $anytc->reported_links->total ) ?>
        </div>
        <h3>Reported <small>links</small></h3>
        <ul class="list-group list-group-flush mt-2">
            <li class="list-group-item">Streaming  :
                <span class="float-right px-1">
                            <?= number_format( $anytc->reported_links->stream ) ?>
                        </span>
            </li>
            <li class="list-group-item">Direct Download :
                <span class="float-right  px-1">
                            <?= number_format( $anytc->reported_links->direct_dl ) ?>
                        </span>
            </li>
            <li class="list-group-item">Torrent Download :
                <span class="float-right  px-1">
                            <?= number_format( $anytc->reported_links->torrent_dl ) ?>
                        </span>
            </li>
        </ul>
    </div>
</div>