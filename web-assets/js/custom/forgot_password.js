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
        	// var result = forgot();
        	// console.log(result);
        }
    });

    $.validator.addMethod("emailValidation", function (value, element) {
    	$(".validation-login-email").html('');
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });

    function login() {
    
        $("#wait").css("display", "block");
        //$("#register-btn").attr("disabled", true);

        var login_customer_url = 'login-customer';

        var email =$('#login_email').val();
        var password =$('#login_password').val();

        $.ajax({
                url: login_customer_url,
                type: "POST",
                data:{
                    email:email,
                    password:password
                },
                success: function (returnData) {
                    //returnData = $.parseJSON(returnData);
                    //console.log(returnData);
                    $("#wait").css("display", "none");
                    if(returnData == '1'){
                        console.log('account does not exists');
                        $(".validation-login-email").append('<label id="login_email-error" class="validation-error-label" for="register_email">Your account is does not exists. Click on <b>Register</b> to create your account.</label>');
                    }else if(returnData == '2'){
                        console.log('password incorrect');
                        $(".validation-login-password").append('<label id="login_password-error" class="validation-error-label" for="register_email">Inncorrect password. Click on <b>Forgot password</b> to recover your password.</label>');
                    }else{
                        console.log(returnData);
                        console.log('else');
                        $('#loginFormModal').modal('toggle');
                        swal(
                            'Logged in!',
                            'You are successfully logged in into clicklunch',
                            'success'
                        )
                        $('#login-form')[0].reset();
                        return true;
                    }
                    
                }
            });

        return true;

    }