<?php
$edit_link = base_url().'vender-perc-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Percentage of Restaurants</h4>
                    <div class="state-information d-none d-sm-block">
                        <a class="btn btn-primary waves-effect waves-light btn-bg" href="<?php echo base_url().'vender-add'; ?>">Add New Restaurant</a>
                    </div>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="vender-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap vender_perc_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Restaurant Name</th>
                                <th>Restaurant Code</th>
                                <th>Percentage</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($vender_perc_list) && !empty($vender_perc_list) && count($vender_perc_list) > 0){
                                foreach ($vender_perc_list as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["shop_name"]) . "</td>";
                                    echo "<td>" . $value["shop_code"] . "</td>";
                                    $percentage = ($value["percentage"] == '')?'-':$value["percentage"].' %';
                                    echo "<td><label id='".$id."' class='label-perc'> " . $percentage . "</label></td>";
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";

                                    echo "<td class='text-center'><label class='btn btn-outline-primary btn-sm waves-effect waves-light perc-update' title='Edit' data-popup='tooltip' data-perc='".$value["percentage"]."'> Edit</label></td>";
                                    
                                    echo '</tr>';
                                }
                            }
                            ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script src="<?php echo base_url() . 'assets/js/custom/custom.js'; ?>"></script>
<script type="text/javascript">
    var vender_perc_list = $('.vender_perc_list').DataTable({
            keys: true,
            "order": [[3, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [4]},{visible: false,targets: [3]}],
    });

    var perc_update_url = "<?php echo base_url().'vender-perc-update'; ?>";

    $(document).ready(function () {

        //Ajax
        $(document).on('click',".perc-update", function()  {

            var old_perc = $(this).attr("data-perc");
            $this = $(this);
            var data_id = get_dataid($this);
            //console.log($('#'+data_id).attr("data-perc"));

            swal({
                title: 'Update Percentage (%)',
                input: 'number',
                inputValue: old_perc,
                inputAttributes: {
                    min: '0',
                    max: '100',
                    step: '0.01'
                  },
                showCancelButton: true,
                confirmButtonText: 'Save',
                showLoaderOnConfirm: true,
                confirmButtonClass: 'btn btn-success',
                cancelButtonClass: 'btn btn-danger m-l-10',
                preConfirm: function (perc) {
                    return new Promise(function (resolve, reject) {
                        setTimeout(function () {
                            var perc_num = parseFloat(perc);
                            if (perc_num < 0 || perc_num > 100 || isNaN(parseFloat(perc_num))){
                                reject('Invalid Percentage')
                            }else{

                                    $.ajax({
                                    url: perc_update_url,
                                    type: "POST",
                                    data:{
                                        id:data_id,
                                        perc_num:perc_num
                                        },
                                    success: function (returnData) {
                                        returnData = $.parseJSON(returnData);
                                        if (typeof returnData != "undefined")
                                        {
                                            $('#'+data_id).text(perc_num.toFixed(2)+' %');
                                            $this.attr('data-perc', perc_num.toFixed(2));
                                            resolve()
                                            
                                        } 
                                    },
                                    error: function (xhr, ajaxOptions, thrownError) {
                                        console.log('error');
                                    },
                                    complete: function () {
                                        $(this).removeAttr("disabled");
                                    }
                                });    
                                
                            }
                        }, 2000)
                    })
                },
                allowOutsideClick: false
            }).then(function (perc) {
                swal({
                    type: 'success',
                    title: 'Percentage saved!',
                    html: 'Percentage: ' + perc + '%'
                })
            })
        });
    });
</script>