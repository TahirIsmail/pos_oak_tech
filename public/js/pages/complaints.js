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
                    data: 'ticket'
                },
                
                {
                    data: 'date'
                },
                {
                    data:'user_name'
                },
                // {
                //     data:'equipment_type'
                // }, 
                // {
                //     data:'equipment_make'
                // },
                {
                    data: 'model'
                },
                {
                    data: 'serial_no'
                },
                // {
                //     data: 'complaint_details'
                // },
                // {
                //     data: 'end_user_details'
                // },
                {
                    data: 'c_status'
                },
                {
                    data: 'action'
                }  
                
               
            ]
        });
    }

    load_complaints_listing_table(){
        "use strict";
       console.log("processing");
        var table = $('#complaints_listing').DataTable({
           
            processing: true,
            serverSide: true,
            ajax: {
                url: '/api/complaints',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }              
            },                      
            columns: [
                {
                    data: 'ticket'
                },                
                {
                    data: 'date'
                },
                {
                    data:'user_name'
                },
                {
                    data: 'model'
                },
                {
                    data: 'serial_no'
                },
                {
                    data: 'c_status'
                },
                {
                    data: 'action'
                }         
               
            ]
        });
    }
    load_lab_complaints_listing_table(){
        "use strict";
       console.log("processing");
        var table = $('#lab_complaints_listing').DataTable({
           
            processing: true,
            serverSide: true,
            ajax: {
                url: '/api/lab_complaints_listing',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }              
            },                      
            columns: [
                {
                    data: 'ticket'
                },                
                {
                    data: 'date'
                },
                {
                    data:'user_name'
                },
                {
                    data: 'model'
                },
                {
                    data: 'serial_no'
                },
                {
                    data: 'c_status'
                },
                {
                    data: 'action'
                }         
               
            ]
        });
    }
}