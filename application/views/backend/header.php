<!-- Topbar Start -->
<div class="navbar-custom topnav-navbar topnav-navbar-dark">
    <div class="container-fluid">

        <!-- LOGO -->
        <a href="<?php echo site_url($this->session->userdata('login_type')); ?>" class="topnav-logo" style = "min-width: unset;">
            <span class="topnav-logo-lg">
                <img src="<?php echo base_url('assets/global/light_logo.png');?>" alt="" height="40">
            </span>
                <!-- <span class="topnav-logo-sm">
                    <img src="<?php echo base_url('assets/global/logo-sm.png');?>" alt="" height="40">
                </span> -->
        </a>
        <?php if($logged_in_user_role == 'admin'){ ?>
        <ul class="list-unstyled topbar-right-menu float-right mb-0">

            <li class="dropdown notification-list">
                <a class="nav-link dropdown-toggle nav-user arrow-none mr-0" data-toggle="dropdown" id="topbar-userdrop"
                href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <span class="account-user-avatar">
                    <img src="<?php echo $this->user_model->get_user_thumbnail($this->session->userdata('user_id')); ?>" alt="user-image" class="rounded-circle">
                </span>
                <span  style="color: #fff;">
                    <?php
                    $admin_details = $this->user_model->get_all_users($this->session->userdata('user_id'))->row_array();;
                    ?>
                    <span class="account-user-name"><?php echo $admin_details['name']; ;?></span>
                    <span class="account-position"><?php echo ucfirst($this->session->userdata('role')); ?></span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-right dropdown-menu-animated topbar-dropdown-menu profile-dropdown"
            aria-labelledby="topbar-userdrop">
            <!-- item-->
            <div class=" dropdown-header noti-title">
                <h6 class="text-overflow m-0"><?php echo get_phrase('welcome'); ?> !</h6>
            </div>

            <!-- Account -->
            <a href="<?php echo site_url(strtolower($this->session->userdata('role')).'/manage_profile'); ?>" class="dropdown-item notify-item">
                <i class="mdi mdi-account-circle mr-1"></i>
                <span><?php echo get_phrase('my_account'); ?></span>
            </a>

            <?php if (strtolower($this->session->userdata('role')) == 'admin'): ?>
                <!-- settings-->
                <a href="<?php echo site_url('admin/system_settings'); ?>" class="dropdown-item notify-item">
                    <i class="mdi mdi-settings mr-1"></i>
                    <span><?php echo get_phrase('settings'); ?></span>
                </a>

            <?php endif; ?>


            <!-- Logout-->
            <a href="<?php echo site_url('login/logout'); ?>" class="dropdown-item notify-item">
                <i class="mdi mdi-logout mr-1"></i>
                <span><?php echo get_phrase('logout'); ?></span>
            </a>

        </div>
    </li>

</ul>
<?php } ?>
<a class="button-menu-mobile disable-btn">
    <div class="lines">
        <span></span>
        <span></span>
        <span></span>
    </div>
</a>
<div class="app-search">
    <!-- <h4 style="color: #fff; float: left;"> <?php echo $this->db->get_where('settings' , array('type'=>'website_title'))->row()->description; ?></h4> -->
    <?php if($logged_in_user_role == 'admin'){ ?>
    <a href="<?php echo site_url('home'); ?>" target="_blank" class="btn btn-outline-light ml-3"><?php echo get_phrase('visit_website'); ?></a>
<?php }?>
</div>
</div>
</div>
<!-- end Topbar -->
