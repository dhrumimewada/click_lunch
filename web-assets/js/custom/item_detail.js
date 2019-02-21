$(document).on('click','#add-to-cart',function(){
    var groups = [];
    var error = false;
    var error_str = 'Please Choose At Least One ';
    // Get all required checkboxes
    $.each($('.required:checkbox'), function (key, val){
        if(!groups.includes($(val).attr("name"))){
            groups.push($(val).attr("name"));
        }
    });
    // Get all required radios
    $.each($('.required:radio'), function (key, val){
        if(!groups.includes($(val).attr("name"))){
            groups.push($(val).attr("name"));
        }
    });
    // for each for required groups
    $.each(groups, function (key, val){
        // if group select elelemts length is 0 - genrate error
        if($("input[name='"+val+"']:checked").length == 0){
            error_str += $("input[name='"+val+"']").first().closest('table').siblings().children().html();
            error = true;
            return false;
        } 
    });
    if(error == true){
        swal(
                'Required',
                error_str,
                'warning'
            )
    }else{
        $('#form-item').submit();
    }
    
});


