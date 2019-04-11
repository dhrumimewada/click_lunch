 var validator = $("#forgot-form").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
        		error.insertAfter(element);
        },
        validClass: "validation-valid-label",
        rules: {
            forgot_email: {
                required:true,
                emailValidation:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {

            forgot_email: {
                required: "The e-mail field is required.",
                emailValidation: "The e-mail field is invalid."
            }
        },
        submitHandler: function(form) {
        	 var result = forgot();
        	// console.log(result);
        }
    });

    $.validator.addMethod("emailValidation", function (value, element) {
    	$(".validation-login-email").html('');
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });

    function forgot() {
    
        $(".overlay").css("display", "block");
        var forgot_password_customer_url = 'forgot-password-customer';
        var email =$('#forgot_email').val();

        $.ajax({
                url: forgot_password_customer_url,
                type: "POST",
                data:{
                    email:email
                },
                success: function (returnData) {
                    //returnData = $.parseJSON(returnData);
                    //console.log(returnData);
                    $(".overlay").css("display", "none");
                    if(returnData == '1'){
                        console.log('account does not exists');
                        $(".validation-forgot-email").append('<label id="forgot_email-error" class="validation-error-label" for="forgot_email">Your account is does not exists. Click on <b>Register</b> to create your account.</label>');
                    }else if(returnData == '2'){
                        $(".validation-forgot-email").append('<label id="forgot_email-error" class="validation-error-label" for="forgot_email">Error into sending mail. Please try again later.</label>');
                    }else{
                        $('#forgotFormModal').modal('toggle');
                        swal(
                            'Mail sent!',
                            'Recovery mail is sent to your e-mail',
                            'success'
                        )
                        $('#forgot-form')[0].reset();
                        return true;
                    }
                    
                }
            });

        return true;

    }