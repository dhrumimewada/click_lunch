var protocol = window.location.protocol;
var host = window.location.host;
var base_url = protocol+'//'+host+'/click_lunch/';
//var base_url = protocol+'//'+host+'/';

$( document ).ready(function() {
	var delivery_dispatcher_url = base_url+ 'admin/delivery_dispatcher/delivery_dispatcher_list/';
    $('.delivery_dispatcher_list').DataTable( {
        "ajax": {
            url : delivery_dispatcher_url,
            type : 'GET'
        },
        "order":[[ 0, "desc" ]],
        createdRow: function(row, data, dataIndex ) {
                   $(row).attr("data-id",data[0]);
              },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            },
            { "orderable": false, "targets": 4 }
        ]
    });

    var inventory_url = base_url+ 'vender/inventory/inventory_list/';
    $('.inventory_list').DataTable( {
        "ajax": {
            url : inventory_url,
            type : 'GET'
        },
        "order":[[ 0, "desc" ]],
        createdRow: function(row, data, dataIndex ) {
                   $(row).attr("data-id",data[0]);
              },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            },
            { "orderable": false, "targets": 6 }
        ]
    });

});