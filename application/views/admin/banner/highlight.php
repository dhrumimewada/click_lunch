 <!-- Start content -->
<?php
$edit_link = base_url().'highlight-update';
?>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <div class="page-title-box">
                    <h4 class="page-title">Highlights</h4>
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
                            <table class="table table-hover dt-responsive nowrap admin_list">
                            <thead>
                            <tr>
                                <th class='text-center'>Text1</th>
                                <th class='text-center'>Text2</th>
                                <th class='text-center'>Text3</th>
                                <th>Updated Date</th>
                                <th class='text-center'>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if (isset($highlight_list) && !empty($highlight_list) && count($highlight_list) > 0){
                                foreach ($highlight_list as $key => $value){
                                    $id = $value["id"];

                                    echo '<tr data-id="' . $id . '">';
                                    echo "<td class='text-center'>" . $value["txt1"] . "</td>";
                                    echo "<td class='text-center'>" . $value["txt2"] . "</td>";
                                    echo "<td class='text-center'>" . $value["txt3"] . "</td>";
                                    echo "<td>" . $value["updated_at"] . "</td>";
                                    echo "<td class='text-center'><a href='".$edit_link."/".encrypt($id)."' class='btn btn-outline-primary waves-effect waves-light btn-sm' title='Edit' data-popup='tooltip' > Edit</a></td>";
                                    echo '</tr>';
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div> 

            </div> <!-- end row -->
        </form>

    </div>
</div>
<script type="text/javascript">
    var admin_list = $('.admin_list').DataTable({
            keys: true,
            "order": [[3, "desc"]],
            columnDefs: [{orderable: false, targets: [4]},{visible: false,targets: [3]}],
            'iDisplayLength': 10
    });
</script>