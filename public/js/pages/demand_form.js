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
}