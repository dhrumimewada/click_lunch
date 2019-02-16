$(document).on('click','#add-to-cart',function(){
	//console.log($(".required"));
	$(".required").each(function(index, value) {
	    console.log($(this).attr('id'));
	});
	//$("#form-item").submit();
});