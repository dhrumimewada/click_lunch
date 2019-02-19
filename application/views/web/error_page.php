<?php $assets = base_url().'assets/' ?>
<style type="text/css" media="screen">
   .btn{
        background-color: #ff0000;
        color: white;
        border: none;
        font-size: .9rem;
   }
   a:hover{
        color: white !important;
   }
</style>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <title>Click Lunch</title>
        <meta content="Admin Dashboard" name="description" />
        <meta content="Themesbrand" name="author" />
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo $assets; ?>css/style.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo $assets; ?>js/bootstrap.bundle.min.js"></script>
    </head>

    <body>

        <!-- Begin page -->
        <div class="wrapper-page">
            <div class="card">
                <div class="card-block">

                    <div class="ex-page-content text-center">
                        <h1 class="text-dark">404!</h1>
                        <h4 class="">Sorry, data not found</h4><br>

                        <a class="btn mb-5 waves-effect waves-light" href="<?php echo base_url(); ?>welcome"><i class="mdi mdi-home"></i> Back to Website</a>
                    </div>

                </div>
            </div>

            <div class="m-t-40 text-center">
                <span>&copy; 2018 - www.<a href="<?php echo BASE_URL(); ?>web/home">ClickLunch</a>.com. All rights reserved</span>
            </div>

        </div>

    </body>

</html>