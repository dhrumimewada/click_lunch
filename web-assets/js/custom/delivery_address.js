$( document ).ready(function() {

 	$(document).on('click','.delivery-address .form-check-label',function(){
 		var address_id = $(this).data("id");
 		console.log(address_id);
 		//return false;
 		window.location = my_delievry_address+'/'+address_id;
 	});

 	$(document).on('click','.delivery-address-delete',function(){
 		$this = $(this);
 		var data_id = $this.parent().data("id");
 		console.log(data_id);
 		if (typeof data_id != "undefined" && data_id != null){

 			swal({
                    title: 'Are you sure you want to delete?',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger m-l-10',
                    confirmButtonText: 'Yes, delete it!'
                }).then(
                    function () {

			 			$.ajax({
			                url: delete_url,
			                type: "POST",
			                data:{id:data_id},
			                success: function (returnData) {
			                	console.log(returnData);
			                    returnData = $.parseJSON(returnData);
			                    if (typeof returnData != "undefined"){
			                        if(returnData.is_success == true){
			                        	$this.closest('.delivery-address-card').remove();
			                            swal(
	                                        'Deleted!',
	                                        'Delivery address has been deleted.',
	                                        'success'
	                                    )
			                        }else{
			                        	swal(
	                                        'Please Try again later',
	                                        'Server encounter error',
	                                        'warning'
	                                    )
			                        }
			                    }
			                },
			                error: function (xhr, ajaxOptions, thrownError) {
			                    console.log('error');
			                }
			            });
			        });

 		}
 	});

 	$(document).on('click','.delivery-address-edit',function(){
 		$this = $(this);
 		var data_id = $this.parent().data("id");
 		console.log(data_id);
 		var house_no = $this.parent().attr("data-house_no");
 		var street = $this.parent().attr("data-street");
 		var city = $this.parent().attr("data-city");
 		var zipcode = $this.parent().attr("data-zipcode");
 		var delivery_instruction = $this.parent().attr("data-delivery_instruction");
 		var address_type = $this.parent().attr("data-address_type");

 		$('#housernum').val(house_no);
 		$('#street').val(street);
 		$('#city').val(city);
 		$('#zipcode').val(zipcode);
 		$('#delivery_instruction').val(delivery_instruction);
 		$('#address_id').val(data_id);
 		
 		$('input:radio[name="addresstype"]').attr('checked', false);
 		$('input:radio[name="addresstype"]').filter('[value="'+address_type+'"]').attr('checked', true);

 		$('#addNewAddressModal').modal('show');
 	});

 });