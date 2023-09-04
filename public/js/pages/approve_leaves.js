class leaves{
    load_leave_table(){
        "use strict";
        $('#leave_type').DataTable();

       
    }
    load_leave_listing_table(){
        "use strict";
        var table = $('#approve_leaves').DataTable({
           
            processing: true,
            serverSide: true,
            ajax: {
                url: '/api/approve_leaves_listing',
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
                    data: 'staff_id'
                },
                {
                    data: 'line_manager'
                },
                {
                    data: 'leave_type_id'
                },
                {
                    data: 'leave_from'
                },  
                {
                    data: 'leave_to'
                },  
                {
                    data: 'leave_days'
                },
                {
                    data: 'leave_status'
                },   
                     
                {
                    data: 'action'
                },            
                
               
            ],
            order: [
                [1, 'desc']
            ]
        })
    }   


}