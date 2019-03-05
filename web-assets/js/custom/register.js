 var validator = $("#register-form").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
        		if (element.hasClass('form-check-input')) {
                    error.insertAfter(element.parent().parent().parent());
                }else{
                	error.insertAfter(element);
                }     
        },
        validClass: "validation-valid-label",
        rules: {
            register_email: {
                required:true,
                emailValidation:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            register_username:{
                required: true,
                alpha:true,
                minlength:3,
                maxlength:20,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            register_password:{
                required: true,
                minlength: 6
            },
            register_confpassword:{
                required: true,
                equalTo: "#register_password"
            },
            acceptTerms:{
                required: true
            }
        },
        messages: {

            register_email: {
                required: "The e-mail field is required.",
                emailValidation: "The e-mail field is invalid."
            },
            register_username: {
                required: "The username field is required.",
                alpha: "The username field is not in the correct format.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            register_password: {
                required: "The password field is required.",
                minlength: jQuery.validator.format("At least {0} characters required")
            },
            register_confpassword: {
                required: "The confirm password field is required.",
                equalTo: "Please enter the same password as above."
            },
            acceptTerms:{
                required: "The accept terms field is required."
            }
        },
        submitHandler: function(form) {
           if(validate_email()){
           		console.log("form Submit");
                //form.submit();
            }else{
            	console.log("no email availability");
            	//$(".validation-availibality").append('<label class="validation-error-label" style="">The restaurant availability time field is invalid.</label>');
            
            }
        }
    });

    $.validator.addMethod("emailValidation", function (value, element) {
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });
    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/);
    });
    $.validator.addMethod("is_available", function (value, element) {
        var email = value;
        var check_email_url = 'email-check-availability';
        var return_val = true;
        $.ajax({
            url: check_email_url,
            type: "POST",
            data:{email:email},
            success: function (returnData) {
            	console.log(returnData);
            	return_val = false;
            }
        });
        return return_val;
    });

function validate_email() {
     	var email =$('#register_email').val();
     	var check_email_url = 'email-check-availability';
     	var return_val = false;
     	$.ajax({
            url: check_email_url,
            type: "POST",
            data:{email:email},
            success: function (returnData) {
            	console.log(returnData);
            	if(returnData == '1'){
            		return_val = true;
            	}else{
            		return_val = false;
            	}
            }
        });

     	return return_val;
     }

$( document ).ready(function() {
     console.log("register");
     
});

