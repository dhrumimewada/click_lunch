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
            register_number:{
                required: true,
                digits: false,
                greaterThanZero:false,
                minlength: 12,
                maxlength: 12,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            register_dob:{
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            register_gender:{
                required: true
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
            register_number: {
                required: "The contact number field is required.",
                digits: "Enter only numeric value",
                greaterThanZero: "The contact number field is invalid.",
                minlength: "At least 10 digit required",
                maxlength: "Maximum 10 digit allowed"
            },
            register_dob: {
                required: "The date of birth field is required."
            },
            register_gender: {
                required: "The gender field is required."
            },
            acceptTerms:{
                required: "The accept terms field is required."
            }
        },
        submitHandler: function(form) {
        	var result = register();
        	console.log(result);
        }
    });

    $.validator.addMethod("emailValidation", function (value, element) {
    	$(".validation-email").html('');
        return this.optional(element) || /^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i.test(value);
    });
    $.validator.addMethod("alpha", function(value, element) {
        return this.optional(element) || value == value.match(/^[a-zA-Z][\sa-zA-Z]*/);
    });
    $.validator.addMethod("greaterThanZero", function(value, element) {
    	$(".validation-number").html('');
        return this.optional(element) || value > 0;
    });

function register() {
	
	$("#wait").css("display", "block");
	//$("#register-btn").attr("disabled", true);

	var register_customer_url = 'register-customer';

	var name =$('#register_username').val();
	var email =$('#register_email').val();
	var password =$('#register_password').val();
	var mobile_number =$('#register_number').val();
	var dob =$('#register_dob').val();
	var gender =$('#register_gender').val();

	$.ajax({
            url: register_customer_url,
            type: "POST",
            data:{
            	name:name,
            	email:email,
            	password:password,
            	mobile_number:mobile_number,
            	dob:dob,
            	gender:gender
            },
            success: function (returnData) {
            	//returnData = $.parseJSON(returnData);
            	$("#wait").css("display", "none");
            	if(returnData == '1'){
            		console.log('email exists');
            		$(".validation-email").append('<label id="register_email-error" class="validation-error-label" for="register_email">This e-mail is already in use.</label>');
            	}else if(returnData == '2'){
            		console.log('mobile exists');
            		$(".validation-number").append('<label id="register_number-error" class="validation-error-label" for="register_email">This mobile number is already in use.</label>');
            	}else if(returnData == '3'){
            		console.log('email template not found');
            	}else if(returnData == '4'){
            		console.log('error into sending mail');
            	}else{
            		console.log(returnData);
            		$('#registerFormModal').modal('toggle');
            		swal(
                        'Account Created Successfully!',
                        'Account activation mail is sent on your email address.',
                        'success'
                    )
                    $('#register-form')[0].reset();
                    $('#loginFormModal').modal('show');
                    return true;
            	}
            	
            }
        });

	return false;

}

 $( document ).ready(function(){
 	$("#register_number").inputmask("999 999 9999",{"placeholder": ""});

 	$('.datepicker-autoclose').datepicker({
            format: 'dd-mm-yyyy',
            endDate: '0',
            autoclose: true,
            todayHighlight: false,
            orientation: "top auto"
        });
 });