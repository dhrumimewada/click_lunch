<?php
$setting_save_link = base_url().'setting';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-1">
            </div>
            <div class="col-sm-10">
                <div class="page-title-box">
                    <h4 class="page-title">Setting</h4>
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
                                    <th>Name</th>
                                    <th>Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (isset($settings) && !empty($settings) && count($settings) > 0){
                                        foreach ($settings as $key => $value){
                                            echo '<tr scope="row"><td>'. $value['value'] .'</td>';
                                            echo '<td><input type="textbox" name="'.$value['name'].'" class="form-control" value="'.$value['data'].'">';
                                            ?>
                                            <div class="validation-error-label">
                                                <?php echo form_error($value['name']); ?>
                                            </div>
                                            </td>
                                            <?php
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
<script src="<?php echo base_url().'assets/js/custom/admin/setting.js'; ?>"></script>
