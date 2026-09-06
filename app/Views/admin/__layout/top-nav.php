<?php $adminUser = get_admin_user(); ?>
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <div class="admin-workspace-heading">
            <span>STREAMAPI CONTROL</span>
            <strong>Video operations workspace</strong>
        </div>
        <div class="admin-top-search" role="search">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="search" placeholder="Search" aria-label="Search" readonly tabindex="-1">
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src=" <?= site_url('/admin-assets/images/avatar.jpg') ?> " alt="">
                        <?= esc($adminUser->display_name ?? 'Admin') ?>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item"  href="<?= admin_url('/settings/profile') ?>"> Profile</a>
                        <a class="dropdown-item"  href="<?= admin_url('/logout') ?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>
                <li class="nav-item mt-1">
                    <a class="admin-quick-link" href="<?= site_url('/home') ?>" target="_blank" >
                        <i class="fa fa-globe"></i><span>View site</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</div>
