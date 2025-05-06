class DeliveryChallans{
    load_listing_table(){
        "use strict";
        var listing_table = $('#listing-table').DataTable({
            ajax: {
                url  : '/api/delivery-challans',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }
            },
            columns: [
                { name: 'delivery_challans.delivery_challan_number' },
                { name: 'delivery_challans.delivery_challan_reference' },
                { name: 'delivery_challans.bill_to' },
                { name: 'delivery_challans.bill_to_name' },
                { name: 'delivery_challans.delivery_challan_date' },
                { name: 'delivery_challans.delivery_due_date' },
                { name: 'delivery_challans.total_order_amount' },
                { name: 'master_status.label' },
                { name: 'delivery_challans.created_at' },
                { name: 'delivery_challans.updated_at' },
                { name: 'user_created.fullname' },
                { name: 'actions', orderable: false, searchable: false }
            ],
            order: [[ 8, "desc" ]],
            columnDefs: [
                { "orderable": false, "targets": [11] }
            ],
            scrollX: true,
            scrollY: false,
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            searching: true,
            responsive: true
        });
    }
}