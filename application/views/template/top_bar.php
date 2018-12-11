Top Bar Start -->
<?php
$is_admin = $this->auth->is_admin();
$is_employee = $this->auth->is_employee();
$is_vender = $this->auth->is_vender();
?>
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="<?php echo base_url(); ?>" class="logo">
            <span>
                <img src="<?php echo base_url().'assets/images/click-lunch.png'; ?>" alt="" height="60">
            </span>
            <i>
                <img src="<?php echo base_url().'assets/images/logo-sm.png'; ?>" alt="" height="22">
            </i>
        </a>
    </div>

    <nav class="navbar-custom">

        <ul class="navbar-right d-flex list-inline float-right mb-0">
            <li class="dropdown notification-list">
                <div class="dropdown notification-list nav-pro-img">
                    <a class="dropdown-toggle nav-link arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="user" class="rounded-circle">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->

                        <?php
                        if($is_admin){
                            $profile_url = base_url().'my-profile';
                            $changepw_url = base_url().'change-password';
                            $logout_url = base_url().'logout-admin';
                        }
                        else if($is_vender){
                            $profile_url = base_url().'vender-profile';
                            $changepw_url = base_url().'vender-change-password';
                            $logout_url = base_url().'vender-logout';
                        }else{
                            $emp_profile_url = base_url().'employee-profile';
                            $changepw_url = base_url().'employee-change-password';
                            $logout_url = base_url().'employee-logout';
                            $profile_url = base_url().'vender-profile';
                        }
                        ?>

                        <?php
                        if($is_employee){ ?>
                        <a class="dropdown-item" href="<?php echo $emp_profile_url; ?>"><i class="mdi mdi-account-circle m-r-5"></i> My Profile</a>
                        <?php } ?>
                        <?php if(($is_admin) || ($is_vender) || ( ($is_employee) && (is_allowed($this->auth->get_role_id(), 'profile')) ) )
                        { ?>
                        <a class="dropdown-item" href="<?php echo $profile_url; ?>"><i class="mdi mdi-account-circle m-r-5"></i> Account Profile</a>
                        <?php }?>
                        <a class="dropdown-item" href="<?php echo $changepw_url; ?>"><i class="mdi mdi-key-variant m-r-5"></i> Change Password</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" href="<?php echo $logout_url; ?>"><i class="mdi mdi-power text-danger"></i> Logout</a>
                    </div>                                                                    
                </div>
            </li>

        </ul>

        <ul class="list-inline menu-left mb-0">
            <li class="float-left">
                <button class="button-menu-mobile open-left waves-effect">
                    <i class="mdi mdi-menu"></i>
                </button>
            </li>
        </ul>

    </nav>

</div>
<!-- Top Bar End