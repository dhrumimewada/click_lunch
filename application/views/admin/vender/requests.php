<?php
$edit_link = base_url().'vender-request-update';
?>
<style type="text/css" media="screen">
    .validation-error-label{
        margin-top: 0;
     }
</style>
<div class="modal fade" id="myModal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Message From <b><span id="shop-name"></span></b></h4>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body" id="message">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
</div>
<div class="modal fade" id="accept-modal">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Restaurant <b><span id="shop-name"></span></b></h4>
        </div>
        
        <form action="" id="accept-data" method="post" class="form-validate">
            <!-- Modal body -->
            <div class="modal-body">
                    <div class="col-12">
                        <div class="form-group">
                            <label class="required">Minimum Mile</label>
                            <div>
                                <input type="number" name="minimum_mile" class="form-control demo3" id="minimum_mile" placeholder="Ex: 2.50" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="required">Flat Charges Of Minimum Mile</label>
                            <div>
                                <input type="number" name="charges_of_minimum_mile" class="form-control demo2" id="charges_of_minimum_mile" placeholder="Ex: 3.50" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label class="required">Delivery Charges Per Mile</label>
                            <div>
                                <input type="number" name="delivery_charges" class="form-control demo2" id="delivery_charges" placeholder="Enter delivery charges amount" value="">
                            </div>
                        </div>
                    </div>
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="submit" name="submit" class="btn btn-success waves-effect waves-light">Accept</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>

        </form>
        
      </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Restaurant Pending Requests</h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="vendor-request-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap vendor_request_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Restaurant Name</th>
                                <th>Conatct Person Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th class="text-center">Location</th>
                                <th class="text-center">Action</th>
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
<script src="<?php echo base_url().'assets/js/custom/admin/vender_requests.js'; ?>"></script>

<script type="text/javascript">


    var delete_url = "<?php echo base_url().'vender-request-delete'; ?>";
    var accept_url = "<?php echo base_url().'vender-request-accept'; ?>";

    $(document).ready(function () {

        $(".demo3").TouchSpin({
            forcestepdivisibility: 'none',
            max: 1000000000,
            decimals: 2,
            buttondown_class: 'btn btn-primary',
            buttonup_class: 'btn btn-primary'
        });

        $(".demo2").TouchSpin({
            forcestepdivisibility: 'none',
            max: 1000000000,
            decimals: 2,
            prefix: '$',
            buttondown_class: 'btn btn-primary',
            buttonup_class: 'btn btn-primary'
        });

        $(document).on('click',".delete_vendor_request", function(){

            $this = $(this);
            var data_id = get_dataid($this);

            if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){

                swal({
                    title: 'Are you sure you want to delete?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes, delete it!'
                }).then(
                    function () {

                    $.ajax({
                        url: delete_url,
                        type: "POST",
                        data:{id:data_id},
                        success: function (returnData) {
                            returnData = $.parseJSON(returnData);
                            if (typeof returnData != "undefined")
                            {
                                swal(
                                    'Deleted!',
                                    'Restaurant request has been deleted.',
                                    'success'
                                )
                                remove_row($this);
                            } 
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log('error');
                        },
                        complete: function () {
                            $(this).removeAttr("disabled");
                        }
                    });    
                })
            }    
        });

        $(document).on('click',".accept_vendor_request", function(){

            var shopname = $(this).attr("data-shopname");
            $('#accept-modal #shop-name').text(shopname);
            return false;

            $this = $(this);
            var data_id = get_dataid($this);

            if (typeof data_id != "undefined" && data_id != null && data_id.length > 0){

                swal({
                    title: 'Are you sure you want to accept?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes, accept it!'
                }).then(
                    function () {

                    $.ajax({
                        url: accept_url,
                        type: "POST",
                        data:{id:data_id},
                        success: function (returnData) {
                            returnData = $.parseJSON(returnData);
                            if (typeof returnData != "undefined")
                            {
                                swal(
                                    'Accepted!',
                                    'Restaurant request has been accepted.',
                                    'success'
                                )
                                remove_row($this);
                            } 
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log('error');
                        },
                        complete: function () {
                            $(this).removeAttr("disabled");
                        }
                    });    
                })
            }    
        });

        $(document).on('click',".view-msg", function(){

            var shopname = $(this).attr("data-shopname");
            var msg = $(this).attr("data-msg");
            //console.log(shopname);
            $('#myModal #shop-name').text(shopname);
            $('#myModal #message').text(msg);
        });

    });
</script>