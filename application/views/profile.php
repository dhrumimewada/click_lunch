 <!-- Start content -->
 <style type="text/css">
    .profile-avatar {
      width: 200px;
      position: relative;
      margin: 0px auto;
      border: 4px solid #f3f3f3;
      border-radius: 50%;
    }
 </style>
<div class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12">
                <div class="page-title-box">
                    <h4 class="page-title">Profile</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active">
                            Welcome to your Profile
                        </li>
                    </ol>
                    <div class="state-information d-none d-sm-block">
                        <div class="state-graph">
                            <div id="header-chart-1"></div>
                            <div class="info">Balance $ 2,317</div>
                        </div>
                        <div class="state-graph">
                            <div id="header-chart-2"></div>
                            <div class="info">Item Sold 1230</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">

            <div class="col-lg-10">
                <div class="card m-b-20">
                    <div class="card-body text-center ">

                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle profile-avatar" alt="User avatar">

                    </div>
                </div>
            </div> <!-- end col -->


            <div class="col-lg-10">
                <div class="card m-b-20">
                    <div class="card-body">

                        <h4 class="mt-0 header-title">User info</h4>
                        <form action="#">

                            <div class="form-group">
                                <label>Min Length</label>
                                <div>
                                    <input type="text" class="form-control" required
                                            data-parsley-minlength="6" placeholder="Min 6 chars."/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Max Length</label>
                                <div>
                                    <input type="text" class="form-control" required
                                            data-parsley-maxlength="6" placeholder="Max 6 chars."/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Range Length</label>
                                <div>
                                    <input type="text" class="form-control" required
                                            data-parsley-length="[5,10]"
                                            placeholder="Text between 5 - 10 chars length"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Min Value</label>
                                <div>
                                    <input type="text" class="form-control" required
                                            data-parsley-min="6" placeholder="Min value is 6"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Max Value</label>
                                <div>
                                    <input type="text" class="form-control" required
                                            data-parsley-max="6" placeholder="Max value is 6"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Range Value</label>
                                <div>
                                    <input class="form-control" required type="text range" min="6"
                                            max="100" placeholder="Number between 6 - 100"/>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Regular Exp</label>
                                <div>
                                    <input type="text" class="form-control" required
                                            data-parsley-pattern="#[A-Fa-f0-9]{6}"
                                            placeholder="Hex. Color"/>
                                </div>
                            </div>

                            <div class="form-group m-b-0">
                                <div>
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">
                                        Submit
                                    </button>
                                    <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                        Cancel
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->


    </div>
</div>
<script src="<?php echo base_url() . 'assets/pages/dashboard.js'; ?>"></script>
