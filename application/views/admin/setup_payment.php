<?php
$setting_save_link = base_url().'app-setting-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
                <div class="page-title-box">
                    <h4 class="page-title">Setup Payment</h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-1">
            </div>
            <div class="col-10">
                <div class="card m-b-20">
                    <div class="card-body">
                        <form class="form-validate"  method="post" action="<?php echo $setting_save_link; ?>" >
                            <table class="table table-hover table-bordered mb-0">
                                <thead>
                                <tr>
                                    <th>App Name</th>
                                    <th>App Version</th>
                                    <th class="text-center">Updates</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($settings) && !empty($settings) && count($settings) > 0){
                                        foreach ($settings as $key => $value){
                                            echo '<tr scope="row"><td>'. $value['app_label'] .'</td>';

                                            echo '<td><input type="textbox" name="appname_'.$value['id'].'" class="form-control" value="'.$value['app_version'].'"></td>';

                                            $checked = ($value['updates'] == 1)?'checked':'';
                                            echo '<td class="text-center"><input type="checkbox" id="'. $value['app_name'] .'"  name="'. $value['app_name'] .'" switch="primary" '. $checked .' value="1"/><label class="mb-0" data-on-label="Yes" data-off-label="No" for="'. $value['app_name'] .'"></label></td></tr>';
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <div class="form-group m-b-0 mt-3">
                                <div>
                                    <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
            <div class="col-1">
            </div>
        </div> <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script src="<?php //echo base_url().'assets/js/custom/admin/app_setting.js'; ?>"></script>
