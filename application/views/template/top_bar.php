<?php
$is_admin = $this->auth->is_admin();
$is_employee = $this->auth->is_employee();
$is_vender = $this->auth->is_vender();
$is_dispatcher = $this->auth->is_dispatcher();
$user_id = $this->auth->get_user_id();
$user_data = get_loggedin_detail($user_id);

$profile_picture = 'https://bootdey.com/img/Content/avatar/avatar6.png';
if($is_vender){
    $name =  $user_data->vender_name;
    if($user_data->profile_picture != ''){
        $profile_picture = base_url().$this->config->item("profile_path") . '/'.$user_data->profile_picture;
    }
}elseif($is_employee){
    $name =  $user_data->first_name.' '.$user_data->last_name;
    if($user_data->profile_picture != ''){
        $profile_picture = base_url().$this->config->item("profile_path") . '/'.$user_data->profile_picture;
    }
}elseif($is_admin){
    $name =  $user_data->username;
    if($user_data->profile_picture != ''){
        $profile_picture = base_url().$this->config->item("profile_path") . '/'.$user_data->profile_picture;
    } 
}elseif($is_dispatcher){
    $name =  $user_data->full_name;
    if($user_data->profile_picture != ''){
        $profile_picture = base_url().$this->config->item("profile_path") . '/'.$user_data->profile_picture;
    }
}else{
    $name = '';
}


?>
<div class="topbar">

    <!-- LOGO -->
    <div class="topbar-left">
        <a href="<?php echo base_url(); ?>" class="logo">
            <span>
                <img src="<?php echo base_url().'assets/images/logo-white.png'; ?>" alt="" height="50">
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
                        <img src="<?=$profile_picture?>" alt="user" class="rounded-circle">
                        <span class="topbar-name" ><?=$name?></span>
                    </a> 
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                        <!-- item-->

                        <?php
                        if($is_admin){
                            $profile_url = base_url().'my-profile';
                            $changepw_url = base_url().'change-password';
                            $logout_url = base_url().'logout-admin';
                        }else if($is_vender){
                            $profile_url = base_url().'vender-profile';
                            $changepw_url = base_url().'vender-change-password';
                            $logout_url = base_url().'vender-logout';
                        }elseif($is_employee){
                            $emp_profile_url = base_url().'employee-profile';
                            $changepw_url = base_url().'employee-change-password';
                            $logout_url = base_url().'employee-logout';
                            $profile_url = base_url().'employee-profile';
                        }else if($is_dispatcher){
                            $profile_url = base_url().'dispatcher-profile';
                            $changepw_url = base_url().'dispatcher-change-password';
                            $logout_url = base_url().'dispatcher-logout';
                        }else{
                            $profile_url = $changepw_url = $logout_url = $emp_profile_url = '#';
                        }
                        ?>

                        <a class="dropdown-item" href="<?php echo $profile_url; ?>"><i class="mdi mdi-account-circle m-r-5"></i> Account Profile</a>
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