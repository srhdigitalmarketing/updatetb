<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src=" <?= site_url('/admin-assets/images/avatar.jpg') ?> " alt="">
                        <?= esc( get_admin_user()->display_name ) ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="<?= admin_url('/settings/profile') ?>"> Profile</a>
                        <a class="dropdown-item"  href="<?= admin_url('/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>
                <li class="nav-item mt-1">
                    <a href="<?= site_url('/home') ?>" target="_blank" >
                        <i class="fa fa-globe"></i> view site
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>