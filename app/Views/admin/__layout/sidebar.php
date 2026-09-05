<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style=" background: #172d44;">
            <a href="<?= site_url('/admin') ?>" class="site_title logoadmin">
                <span class="brand-mark"><i class="fa fa-play"></i></span>
                <span class="brand-copy"><b>StreamAPI</b><small>VIDEO CONTROL CENTER</small></span>
            </a>
        </div>

        <div class="clearfix"></div>
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li class="sidebar-menu-label"><span>Workspace</span></li>
                    <li><a href="<?= admin_url('/dashboard') ?>"><i class="fa fa-dashboard"></i> Dashboard </a></li>

                    <li><a><i class="fa fa-play-circle"></i> Video <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= admin_url('/movies/new') ?>">Add Video</a></li>
                            <li><a href="<?= admin_url('/movies') ?>">All Videos</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-dollar"></i> Advertisement <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= admin_url('/ads/home_page') ?>">Home page</a></li>
                            <li><a href="<?= admin_url('/ads/view_page') ?>">View page</a></li>
                            <li><a href="<?= admin_url('/ads/download_page') ?>">Download page</a></li>
                            <li><a href="<?= admin_url('/ads/link_page') ?>">Link page</a></li>
                            <li><a href="<?= admin_url('/ads/embed_page') ?>">Embed page</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-unlink"></i> Links <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= admin_url('/links') ?>">View All</a></li>
                            <li><a href="<?= admin_url('/links/reported') ?>">Reported</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-files-o"></i> Pages <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= admin_url('/pages') ?>">View All</a></li>
                            <li><a href="<?= admin_url('/pages/new') ?>">New Page</a></li>
                        </ul>
                    </li>

                    <li><a><i class="fa fa-magic"></i> Third Party APIs <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= admin_url('/third-party-apis') ?>">View All</a></li>
                            <li><a href="<?= admin_url('/third-party-apis/new') ?>">Add New</a></li>
                        </ul>
                    </li>

                    <li class="sidebar-menu-label sidebar-menu-label--system"><span>System</span></li>
                    <li><a><i class="fa fa-gear"></i> Settings <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="<?= admin_url('/settings/site') ?>">Site</a></li>
                            <li><a href="<?= admin_url('/settings/profile') ?>">Profile</a></li>
                            <li><a href="<?= admin_url('/settings/general') ?>">General</a></li>
                            <li><a href="<?= admin_url('/settings/servers') ?>">Servers</a></li>
                            <li><a href="<?= admin_url('/settings/firewall') ?>">Firewall</a></li>
                            <li><a href="<?= admin_url('/settings/cache') ?>">Cache</a></li>
                            <li><a href="<?= admin_url('/settings/email') ?>">Email</a></li>
                            <li><a href="<?= admin_url('/settings/api') ?>">Dev API</a></li>
                            <li><a href="<?= admin_url('/settings/translations') ?>">Translations</a></li>
                        </ul>
                    </li>


                </ul>
            </div>
        </div>
        <!-- /sidebar menu -->

        <div class="sidebar-footer hidden-small">
            <a href="<?= admin_url('/settings/general') ?>"  data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
            </a>
            <a href="<?= admin_url('/movies/new') ?>" data-toggle="tooltip" data-placement="top" title="Add Video" data-original-title="Add Video">
                <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
            </a>
            <a data-toggle="tooltip" data-placement="top" title="" href="<?= admin_url('/logout') ?>" data-original-title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
        </div>


    </div>
</div>
