//Get data id in datatable 
function get_dataid(this_element) {
    //console.log(this_element);
    if (this_element.closest("tr").hasClass("child")){
        var data_id = this_element.closest("tr").prev("tr").attr("data-id");
        
    }else{
        var data_id = this_element.closest("tr").attr("data-id");
    }
    return data_id;
}

function remove_row(this_element) {
   if (this_element.closest("tr").hasClass("child")){
    //console.log("in");
        this_element.closest("tr").prev("tr").slideUp(300, function () {
            this_element.closest("tr").prev("tr").remove();
            this_element.closest("tr").remove();
        });
    }else{
        //console.log("innn");
        this_element.closest("tr").slideUp(300, function () {
            this_element.closest("tr").remove();
        });
    }
    return true;
}