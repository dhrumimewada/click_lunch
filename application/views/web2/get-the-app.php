<?php include('header.php'); ?>
             
            <div id="content">
                <div class="favourites-order-wrapper order-history-wrapper grey-bg">
                    <div class="container">
                        <div class="favourites-order-block white-bg">         
                            <div class="get-app"> 
                                <div class="row center-xs app-row-new">
                                    <div class="col-sm-8 app-text text-left">
                                        <h1 class="txt-red text-uppercase"><b>GET THE CLICKLUNCH APP</b></h1>
                                        <h4>Your next great meal is at your fingertips.</h4>
                                        <h4>See menus and photos for nearby restaurants and bookmark your favorite places on the go</h4>
                                        <h4>We'll send you a link, open it on your phone to download the app</h4>
                                        <div class="mt-4">
                                            <a href="#"><img src="http://13.58.201.178/assets/images/home-page/Apple-Play-Store.png" alt="Apple Play Store" class="mr-3"></a>
                                            <a href="#"><img src="http://13.58.201.178/assets/images/home-page/Google-Play-Store.png" alt="Google Play Store" class="mr-3"></a>
                                        </div>
                                    </div>                       
                                </div>
                            </div>
                            <div class="form-actions d-flex justify-content-center">
                                <a href="<?php echo BASE_URL(); ?>web/home" class="white-btn back-home-btn text-center" id="back-home-btn">Back to home</a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>

        <div class="row pt-5 white-bg mr-0 ml-0 justify-content-center">
            <div class="mail-subscription-block">
                <div class="mail-subscription-custom-text text-center"><p>Be the lucky winner to get FREE meals for one week. <br> We are also offer you latest deal in your inbox</p></div>
                <form class="mail-subscription d-flex align-items-center" id="mailSubscription">
                    <input type="email" name="email" class="form-control" id="mailSubscriptionId" placeholder="Enter your e-mail address here" />
                    <input type="submit" name="subscribe" value="Subscribe" class="subscribe-btn red-btn" />
                </form>
            </div>
        </div>
<?php include('footer.php'); ?>

<script type="text/javascript">
$(document).ready(function() {
var owl = $('#simple');
    owl.owlCarousel({
        loop:true,
        responsiveClass:true,
        nav:true,
        margin:20,
        dots:true,
        items:1,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:1,
                nav:true,
                loop:true
            },
            600:{
                items:2,
                nav:true
            },
            1000:{
                items:3,
                nav:true,
                loop:true
            }
        }
    });

    // owl.on('mousewheel', '.owl-stage', function (e) {
    //     if (e.deltaY>0) {
    //         owl.trigger('next.owl');
    //     } else {
    //         owl.trigger('prev.owl');
    //     }
    //     e.preventDefault();
    // });
             
});
</script>


