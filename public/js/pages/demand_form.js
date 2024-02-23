class DemandForm{
    load_listing_table(){
        "use strict";
        var listing_table = $('#listing-table').DataTable({
            ajax: {
                url  : '/api/demand_form_data_fetch',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }
            },
            columns: [
                {
                    data: 'id'
                },               
                {
                    data: 'suppliers_id'
                },
                {
                    data: 'details'
                },
              
                           
                
               
            ],
            order: [
                [1, 'desc']
            ]
            
        });
    }



    load_quotation_request_data(){
        "use strict";
        var listing_table = $('#quotation_request').DataTable({
            ajax: {
                url  : '/api/load_quotation_request_data',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }
            },
            columns: [
                {
                    data: 'customer_id'
                },  
                {
                    data: 'ref_no'
                },             
                {
                    data: 'items_details'
                },
                {
                    data: 'qty'
                },
                {
                    data: 'payment_terms'
                },
                {
                    data: 'delivery_terms'
                },
              
                           
                
               
            ],
            order: [
                [1, 'desc']
            ]
            
        });
    }
}