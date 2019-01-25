 <!-- Start content -->
<?php
$put_link = base_url().'highlight-put';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-box">
                    <h4 class="page-title">Update Highlights</h4>
                </div>
            </div>
        </div>
        <!-- end row -->
        <div class="row">
            <div class="col-lg-12">
                <?php echo get_msg(); ?>
            </div>
        </div>

        <form class="form-validate"  method="post" action="<?php echo $put_link; ?>">

            <div class="row">

                <div class="col-lg-12">

                    <div class="card m-b-20">
                        <div class="card-body">

                            <?php
                            if (isset($highlight_list) && !empty($highlight_list) && count($highlight_list) > 0){
                                foreach ($highlight_list as $key => $value){
                            ?>

                            <div class="row">
                                <div class="col-lg-12 mt-2 mb-1">
                                    <h4 class="mt-0 mb-0 header-title">Highlight Slide <?php echo $key+1; ?></h4>
                                    <hr class="mt-1 mb-3">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="required">Text 1</label>
                                        <div>
                                            <input type="text" name="highlight<?php echo $key;?>[<?php echo $key;?>]" class="form-control" placeholder="Ex: 99.90" value="<?php echo $value['txt1']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="required">Text 2</label>
                                        <div>
                                            <input type="text" name="highlight<?php echo $key;?>[<?php echo $key+1;?>]" class="form-control" placeholder="Ex: RESTAURANT" value="<?php echo $value['txt2']; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label class="required">Text 3</label>
                                        <div>
                                            <input type="text" name="highlight<?php echo $key;?>[<?php echo $key+2;?>]" class="form-control" placeholder="Ex: OPTIONS PER WEEK" value="<?php echo $value['txt3']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                                }
                            }
                            ?>

                            <div class="form-group m-b-0">
                                <div>
                                    <button type="submit" name="submit" class="btn btn-primary waves-effect waves-light">
                                        Submit
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> 

            </div> <!-- end row -->
        </form>

    </div>
</div>