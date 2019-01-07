<?php
$edit_link = base_url().'inventory-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Inventory</h4>
                </div>
                <?php echo get_msg();  ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap inventory_list table-hover" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Product Name</th>
                                <th>Cuisine</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Notify Stock</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->

    </div> <!-- container-fluid -->

</div> <!-- content -->
<script src="<?php echo base_url() . 'assets/js/custom/dynamic_datatable.js'; ?>"></script>
<script src="<?php echo base_url() . 'assets/js/custom/custom.js'; ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>
    var stock_update_url = "<?php echo base_url().'item-quantity-stock-update'; ?>";

    $(document).ready(function () {

        //Ajax
        $(document).on('click',".quantity-stock-update", function()  {

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
                                    url: stock_update_url,
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