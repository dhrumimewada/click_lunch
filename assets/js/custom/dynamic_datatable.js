var protocol = window.location.protocol;
var host = window.location.host;
var base_url = protocol+'//'+host+'/click_lunch/';
//var base_url = protocol+'//'+host+'/';

if(!promocode_id){
    var promocode_id = '';
}

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

    var customer_url = base_url+ 'admin/customer/customer_list/';
    $('.customer_list').DataTable( {
        "ajax": {
            url : customer_url,
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
            { "orderable": false, "targets": 5 }
        ]
    });

    var promocode_url = base_url+ 'promocode/promocode/promocode_list/';
    $('.promocode_list').DataTable( {
        "ajax": {
            url : promocode_url,
            type : 'GET'
        },
        "order":[[ 0, "desc" ]],
        createdRow: function(row, data, dataIndex ) {
                   $(row).attr("data-id",data[0]);

                   // from date
                   var $fromDate_dateCell = $(row).find('td:eq(3)');
                   var fromDate = $fromDate_dateCell.text();
                   var full_date = get_full_date(fromDate);
                   $fromDate_dateCell.data('order', fromDate).text(full_date);

                   // To date
                   var $toDate_dateCell = $(row).find('td:eq(4)');
                   var toDate = $toDate_dateCell.text();
                   var full_date = get_full_date(toDate);
                   $toDate_dateCell.data('order', toDate).text(full_date);
              },
        "columnDefs": [
            {
                "targets": [ 0 ],
                "visible": false
            },
            { "orderable": false, "targets": 7 },
            { "orderable": false, "targets": 6 }
        ]
    });

    var eligible_customer_url = base_url+ 'promocode/promocode/eligible_customer_list/'+promocode_id;
    $('.eligible_customer_list').DataTable( {
        "ajax": {
            url : eligible_customer_url,
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
            }
        ],
        "pageLength": 50
    });

    var vendor_request_url = base_url+ 'admin/vender/vendor_request_list/';
    $('.vendor_request_list').DataTable( {
        "ajax": {
            url : vendor_request_url,
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

});

const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul","Aug", "Sep", "Oct", "Nov", "Dec"];

function get_full_date(my_date){

    // This function convert YYYY-MM-DD to j M, Y date format
    var my_date = new Date(my_date);
    var day = my_date.getDate();
    var month = monthNames[my_date.getMonth()];
    var year = my_date.getFullYear();
    var full_date = day+' '+month+', '+year;
    return full_date;
}