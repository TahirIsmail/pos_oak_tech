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
                    data: 'complaint_status'
                },
                {
                    data:'assigned_to'
                },
                {
                    data:'complaint_by'
                }, 
                {
                    data:'created_by'
                },
                {
                    data:'updated_by'
                },
                {
                    data: 'action'
                }         
                
               
            ]
        });
    }
}