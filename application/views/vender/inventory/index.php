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
                                <th>Product Name</th>
                                <th>Cuisine</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Notify Stock</th>
                                <th>Created Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                <td>Product test</td>
                                <td>Pizza</td>
                                <td>$33</td>
                                <td>90</td>
                                <td>10</td>
                                <td>1</td>
                                <td class='text-center'><a href='' class='btn btn-outline-primary btn-sm waves-effect waves-light' title='Edit' data-popup='tooltip' >View</a></td>
                            <?php
                            if (isset($inventory_list) && !empty($inventory_list) && count($inventory_list) > 0){
                                foreach ($inventory_list as $key => $value){
                                    // $id = $value["id"];
                                    // $created_date_ts = strtotime($value["created_at"]);
                                    // $created_date = date("j M, Y", $created_date_ts);
                                    // echo '<tr data-id="' . $id . '">';
                                    // echo "<td>" . stripslashes($value["first_name"].' '.$value["last_name"]) . "</td>";
                                    // echo "<td>" . stripslashes($value["email"]) . "</td>";
                                    // echo "<td>" . $value["role_name"] . "</td>";
                                    
                                    // if($value["status"] == 1){
                                    //     $btn_name = 'Active';
                                    // }else{
                                    //     $btn_name = 'Deactive';
                                    // }
                                    // echo "<td data-id='" . $value["id"] . "' class='text-center'><button type='button' class='btn btn-outline-primary waves-effect waves-light deactive_inventory' status-id='" . $value["status"] . "' title='".$btn_name."' data-popup='tooltip' >" . $btn_name . "</button></td>";
                                    
                                    
                                    // echo "<td data-order='" . $created_date_ts . "'>" . $created_date . "</td>";
 
                                    // echo "<td class='text-center'><a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary waves-effect waves-light title='Edit' data-popup='tooltip' > Edit</a>
                                    //     <button type='button' class='btn btn-outline-primary waves-effect waves-light delete_inventory' title='Delete' data-popup='tooltip'>Delete</button></td>
                                    //     </td>";
                                    // echo '</tr>';
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
    var inventory_list = $('.inventory_list').DataTable({
            keys: true,
            "order": [[4, "desc"]],
            'iDisplayLength': 10,
            dom: 'Bfrtip',
            buttons: [
                'print'
            ],
            columnDefs: [{orderable: false, targets: [5]},{visible: false,targets: [5]}],
    });
</script>