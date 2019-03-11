$(document).ready(function (){
	$(document).on('click',".card-buttons .delete", function(){
		$this = $(this);
		var data_id = $(this).data("id");
		var card_lock = $(this).closest(".card-block");
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
                            returnData = $.parseJSON(returnData);

                            if (typeof returnData != "undefined")
                            {
                                swal(
                                        'Deleted!',
                                        'Payment card has been deleted.',
                                        'success'
                                    );

                                card_lock.remove();
                                if(returnData.empty == true){
                                	$('.empty').removeClass('d-none');
                                }
                            } 
                        },
                        error: function (xhr, ajaxOptions, thrownError) {
                            console.log('error');
                        }
                    });    
                })
		}
	});
});