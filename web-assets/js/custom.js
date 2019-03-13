jQuery(function() {
    jQuery("input[name='deliveroption']:checked").parent().addClass('active');
    jQuery(document).on('change','input[name="deliveroption"]',function() {
        jQuery('.form-check-input').parent().removeClass('active');
        jQuery(this).parent().addClass('active');
    });



    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
	  if (!$(this).next().hasClass('show')) {
	    $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
	  }
	  var $subMenu = $(this).next(".dropdown-menu");
	  $subMenu.toggleClass('show');


	  $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function(e) {
	    $('.dropdown-submenu .show').removeClass("show");
	  });


	  return false;
	});

/*    $('.review-star select').ddslick();*/

 
        

});



jQuery(function() {

		function showDialog2() {
        	$("#forgotFormModal").addClass("fade").modal("show");
            $("#loginFormModal").removeClass("fade").modal("hide");            
        }
        $(function () {
            $("#loginFormModal").modal("hide");
            $("#dialog-forgot").on("click", function () {
                showDialog2();
            });
        });

        function showDialog3() {
            $("#registerFormModal").addClass("fade").modal("show");
            $("#loginFormModal").removeClass("fade").modal("hide");            
        }
        $(function () {
            $("#loginFormModal").modal("hide");
            $("#dialog-register").on("click", function () {
                showDialog3();
            });
        });

        function showDialog4() {
            $("#loginFormModal").addClass("fade").modal("show");
            $("#registerFormModal").removeClass("fade").modal("hide");            
        }
        $(function () {
            $("#forgotFormModal").modal("hide");
            $("#dialog-login").on("click", function () {
                showDialog4();
            });
        });

});

jQuery(function() {

    if($('#userdob').length)
    {
        $('#userdob').datepicker();
    }
});


$(function () {
                var startDate = new Date();
                var fechaFin = new Date();
                var FromEndDate = new Date();
                var ToEndDate = new Date();

                 if($("#expiry_date").length)
                {
                    $('#expiry_date').datepicker({
                        autoclose: true,
                        minViewMode: 1,
                        format: 'mm/yyyy'
                    }).on('changeDate', function(selected){
                            startDate = new Date(selected.date.valueOf());
                            startDate.setDate(startDate.getDate(new Date(selected.date.valueOf())));
                            $('.to').datepicker('setStartDate', startDate);
                        }); 
                }
});


