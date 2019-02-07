<?php include('header.php'); ?>
             
            <div id="content">
                <div class="favourites-order-wrapper order-history-wrapper grey-bg">
                    <div class="container">
                        <div class="favourites-order-block white-bg">         
                            <div class="contact-us-inner"> 
                                <div class="contact-inner-title">
                                    <h3>Contact us</h3>
                                </div>
                                <div class="row center-us ">                                    
                                    <div class="modal-body">
                                        <form class="contact-form" id="contact-form">                                            
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        
                                                        <input type="text" class="form-control" id="contactname" placeholder="Full Name">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        
                                                        <input type="email" class="form-control" id="contatcemail" placeholder="E-mail">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        
                                                        <input type="text" class="form-control" id="contactphone" placeholder="Phone Number">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        
                                                        <input type="text" class="form-control" id="contatcsubject" placeholder="Subject">
                                                    </div>
                                                </div>
                                                 <div class="col-sm-12">
                                                    <div class="form-group">
                                                        
                                                        <textarea class="form-control" rows="5" id="contatcmessage" placeholder="Message"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">                                                
                                                <div class="col-sm-12 cont-sub">
                                                    <input type="submit" name="register" class="register red-btn" id="contatc-btn" value="Submit">
                                                </div>
                                            </div>                                            
                                        </form>
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


