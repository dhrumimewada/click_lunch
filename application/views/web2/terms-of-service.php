<?php include('header.php'); ?>
             
            <div id="content">
                <div class="favourites-order-wrapper order-history-wrapper grey-bg">
                    <div class="container">
                        <div class="favourites-order-block white-bg">         
                            <div class="contact-us-inner"> 
                                <div class="row center-us ">
                                    <div class="col-sm-12 app-text text-left">
                                        <h3 class="txt-red ">Terms of Service</h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur tincidunt tortor at lectus imperdiet egestas. Morbi feugiat posuere nulla, id venenatis nulla gravida efficitur. Curabitur bibendum tortor eu risus gravida dignissim. Vestibulum suscipit blandit pellentesque. Nulla posuere ligula nec nunc consectetur hendrerit. Nunc pulvinar lacus at velit fringilla aliquam. Fusce est tortor, finibus sed suscipit sit amet, scelerisque a tortor. In lorem neque, rhoncus in dapibus nec, ullamcorper et risus. In iaculis, est ac consequat gravida, nunc sapien consectetur turpis, eu aliquam augue diam vitae ex. Nunc fermentum, elit et congue viverra, ligula elit consequat sem, eget feugiat nibh purus feugiat nisl. Maecenas aliquet aliquet metus, vel dignissim lacus dapibus fringilla. Duis tincidunt nisi sapien, sit amet consequat sem ultricies non. In rhoncus sollicitudin justo, vel mattis nisi dapibus quis.</p>
                                        <p>Quisque velit justo, fringilla ut mattis nec, pharetra ac risus. Vivamus accumsan et libero in porttitor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed facilisis nisi odio, at fermentum diam iaculis vel. Pellentesque sed porttitor ligula. Morbi orci nisi, bibendum ac leo non, luctus molestie massa. Nunc vel egestas nisi, ac elementum enim. Aenean rutrum ligula non ipsum fermentum lobortis. Aenean leo eros, posuere vitae enim sit amet, feugiat sagittis dui.</p>
                                        <p>Nulla suscipit tellus nisi, quis lobortis ex aliquet non. Etiam malesuada, mauris sit amet dapibus pellentesque, nisi ante feugiat libero, vel varius est metus quis diam. Curabitur sit amet justo nec nibh tristique euismod. Nulla imperdiet diam sit amet lacus blandit, quis ultricies enim maximus. Suspendisse quis augue a dui tempor porta eu a orci. Quisque molestie, enim sed luctus mollis, velit ipsum elementum nisl, nec accumsan orci turpis ut mauris. Etiam augue lectus, eleifend tristique urna vitae, tincidunt mattis nunc. Etiam eget neque cursus, auctor enim imperdiet, blandit orci. Quisque lectus urna, porttitor at leo nec, pretium pharetra ipsum.</p>
                                        <p>Curabitur tristique sit amet metus at lobortis. Fusce imperdiet lorem vitae lacus ultricies, at iaculis justo placerat. Nulla sit amet justo ut massa gravida cursus nec nec arcu. Aliquam erat volutpat. Mauris mollis mauris a pulvinar varius. Nullam vitae dignissim lectus. Pellentesque congue sapien dui, nec malesuada enim imperdiet vitae. Cras dapibus, neque quis vehicula ultricies, ligula lectus condimentum neque, a pulvinar eros risus quis odio.</p>
                                        <p>Sed sollicitudin neque quis cursus volutpat. Sed auctor tempus sollicitudin. Maecenas lobortis diam sed mauris sagittis tempor. Quisque eget quam fringilla, pulvinar massa a, aliquam lectus. Aenean a leo felis. Pellentesque consectetur diam massa. In vulputate ligula lectus, eget commodo tellus congue pharetra. Donec convallis risus ut lectus mollis venenatis.</p>
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


