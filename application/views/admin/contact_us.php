<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title m-0">
            From: <span id="modal-fullname"></span>
        </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body p-0">
        <table class="table table-hover"> 
            <tbody>
                <tr>
                    <td>Email</td>
                    <td id="modal-email">dhrumi.m@gmail.com</td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td id="modal-number">88 55684511</td>
                </tr>
                <tr>
                    <td>Subject</td>
                    <td id="modal-subject">Hello sdf</td>
                </tr>
                <tr>
                    <td>Message</td>
                    <td id="modal-msg">However, it is possible to only scroll inside the modal, instead of the page itself, by adding .modal-dialog-scrollable to .modal-dialog:</td>
                </tr>
            </tbody>
        </table>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Contact Us</h4>
                </div>
                <?php echo get_msg(); ?>
            </div>
        </div>
        <!-- end row -->

        <div class="row" id="contact-us-list">
            <div class="col-12">
                <div class="card m-b-20">
                    <div class="card-body">
                        <table class="table table-hover dt-responsive nowrap contact_us_list" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact Number</th>
                                <th>Subject</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($contact_us) && !empty($contact_us) && count($contact_us) > 0){
                                foreach ($contact_us as $key => $value){
                                    $id = $value["id"];
                                    $created_date_ts = strtotime($value["created_at"]);
                                    $created_date = date("j M, Y", $created_date_ts);
                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td>" . stripslashes($value["name"]). "</td>";

                                    echo "<td>" . $value["email"] . "</td>";
                                    echo "<td>+1 " . $value["contact_no"] . "</td>";
                                    echo "<td>" . stripslashes($value["subject"]). "</td>";
                                    
                                    echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
 
                                    echo "<td class='text-center'><button type='button' class='btn btn-primary btn-sm waves-effect waves-light' title='View' data-toggle='modal' data-target='#myModal' data-fullname='".$value["name"]."' data-email='".$value["email"]."' data-number='".$value["contact_no"]."' data-subject='".stripslashes($value["subject"])."' data-msg='".stripslashes($value["message"])."' id='view'>View</button>
                                        <button type='button' class='btn btn-danger btn-sm waves-effect waves-light delete_contact_us' title='Delete' data-popup='tooltip'>Delete</button></td>";
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
    var contact_us_list = $('.contact_us_list').DataTable({
            keys: true,
            "order": [[4, "desc"]],
            'iDisplayLength': 10,
            columnDefs: [{orderable: false, targets: [5]},{visible: false,targets: [4]}],
    });

    var delete_url = "<?php echo base_url().'contact-us-delete'; ?>";

    $(document).ready(function () {

        $(document).on('click',"#view", function(){
            $('#modal-fullname').html($(this).data("fullname"));
            $('#modal-email').html($(this).data("email"));
            $('#modal-number').html('+1 '+$(this).data("number"));
            $('#modal-subject').html($(this).data("subject"));
            $('#modal-msg').html($(this).data("msg"));
        });

        $(document).on('click',".delete_contact_us", function(){

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
                            console.log(returnData);
                            if (typeof returnData != "undefined")
                            {
                                swal(
                                    'Deleted!',
                                    'Record has been deleted.',
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
    });
</script>