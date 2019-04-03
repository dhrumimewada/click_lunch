<?php
$address_type = $this->config->item("address_type");
?>
<!-- Add New Address Modal -->
<div class="modal fade modal-with-logo" id="addNewAddressModal" tabindex="-1" role="dialog" aria-labelledby="addNewAddressModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header justify-content-center position-relative">
				<img src="<?php echo $assets; ?>images/click-lunch-logo-white.png" width="130" />
			</div>
			<div class="modal-body">
				<form class="add-new-address-block" id="addNewAddress" method="post" action="<?php echo $add_address_link; ?>">

					<input type="hidden" name="address_id" id="address_id" value="">
					<div class="row white-bg modalform">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="housernum" placeholder="House/Office Number" name="housernum" autocomplete="off">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="street" placeholder="Street/Locality" name="street" autocomplete="off">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="city" placeholder="City" name="city" autocomplete="off">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="zipcode" placeholder="ZipCode Ex: 10001" name="zipcode" autocomplete="off">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="delivery_instruction" placeholder="Any delivery instructions" name="delivery_instruction" autocomplete="off">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" class="form-control" id="nickname" placeholder="Nickname" name="nickname" autocomplete="off">
							</div>
						</div>
						<div class="col-md-12">
							<label>Address Type</label>
							<div class="row m-0 mb-2 d-flex">
								<?php
								if(isset($address_type) && is_array($address_type) && !empty($address_type)){
									foreach ($address_type as $key => $value) {
									$checked = ($key == 1)?'checked':'';
								?>
									<div class="form-check mb-1">
										<input class="form-check-input" type="radio" name="addresstype" id="<?php echo $key; ?>" value="<?php echo $key; ?>" <?php echo $checked; ?> >
										<label class="form-check-label" for="<?php echo $key; ?>"><?php echo ucwords($value); ?></label>
									</div>
								<?php	
									}
								?>
								<?php	
								}else{
								?>
								<div class="form-check mb-1">
									<label>Address Type not found</label>
								</div>
								<?php
								}
								?>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12 p-0 text-center">
							<button type="submit" name="submit" class="new-add-btn transparent-btn pointer" id="new-add-btn"><img src="<?php echo $assets; ?>images/popup-checked.png"></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo base_url().'assets/js/mask/jquery.inputmask.bundle.js'; ?>"></script>
<script type="text/javascript" charset="utf-8" async defer>

	$("#zipcode").inputmask("99999",{"placeholder": ""});

	var validator = $("#addNewAddress").validate({

        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        // Different components require proper error label placement
        errorPlacement: function(error, element) {
                if (element.hasClass('form-check-input')) {
                    error.appendTo(element.parent().parent());
                }else{
                    error.insertAfter(element);
                }
        },
        validClass: "validation-valid-label",
        rules: {
            housernum: {
                required:true,
                minlength: 1,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            street: {
                required:true,
                minlength: 1,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            city: {
                required:true,
                minlength: 1,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            zipcode: {
                required:true,
                digits: true,
                maxlength:5,
                minlength:5,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            latitude: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            longitude: {
                required:true,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            delivery_instruction: {
                required:false,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            nickname: {
                required:false,
                maxlength:255,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            addresstype: {
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }
        },
        messages: {

            housernum: {
                required: "The house/office number field is required.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            street: {
                required: "The street/locality field is required.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            city: {
                required: "The street/locality field is required.",
                minlength: jQuery.validator.format("At least {0} characters required"),
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            zipcode: {
                required: "The zipcode field is required.",
                digits: "Enter only numeric value",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed"),
                minlength: jQuery.validator.format("At least {0} characters required")
            },
            latitude: {
                required: "The latitude field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            longitude: {
                required: "The longitude field is required.",
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            delivery_instruction: {
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            nickname: {
                maxlength: jQuery.validator.format("Maximum {0} characters allowed")
            },
            addresstype: {
                required: "The address type field is required."
            }
        },
        submitHandler: function(form) {
            form.submit();
           //console.log('SUBMIT ADDRESS');
        }
    });
</script>