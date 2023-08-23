class Suppliers{
    load_listing_table(){
        "use strict";
        var listing_table = $('#listing-table').DataTable({
            ajax: {
                url  : '/api/suppliers',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }
            },
            columns: [
                { name: 'suppliers.name' },
                { name: 'suppliers.supplier_code' },
                { name: 'master_status.label' },
                { name: 'suppliers.created_at' },
                { name: 'suppliers.updated_at' },
                { name: 'user_created.fullname' },
            ],
            order: [[ 3, "desc" ]],
            columnDefs: [
                { "orderable": false, "targets": [6] }
            ]
        });
    }
    load_suppliers_performance_listing_table(){
        "use strict";
        var table = $('#listing_performance_table').DataTable({
           
            processing: true,
            serverSide: true,
            ajax: {
                url: '/api/suppliers_performance',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }
               
            },
            
            
            columns: [
               
                {
                    data: 'supplier_id'
                },
                {
                    data: 'delivery_timeline'
                },
                {
                    data: 'product_quality'
                },
                {
                    data: 'responsiveness'
                },                
                
               
            ],
            order: [
                [1, 'asc']
            ]
        })
    }
}