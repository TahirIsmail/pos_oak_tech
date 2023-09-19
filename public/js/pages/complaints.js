class Complaints{
    load_customer_complaint_listing_table(){
        "use strict";
       console.log("processing");
        var table = $('#listing').DataTable({
           
            processing: true,
            serverSide: true,
            ajax: {
                url: '/api/customer_complaints',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }
               
            },
            
            
            columns: [               
                
                {
                    data: 'complaint_ref'
                },
                
                {
                    data: 'order_id'
                },
                {
                    data:'product_id'
                },
                {
                    data:'customer_id'
                }, 
                {
                    data:'complaint_status'
                },
                {
                    data: 'action'
                }         
                
               
            ]
        });
    }
}