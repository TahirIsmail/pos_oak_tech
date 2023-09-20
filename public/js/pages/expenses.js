class Expenses{
    load_expenses_listing_table(){
        "use strict";
       
        var table = $('#Expense_listing').DataTable({
           
            processing: true,
            serverSide: true,
            ajax: {
                url: '/api/expenses/list',
                type : 'POST',
                data : {
                    access_token : window.settings.access_token
                }
               
            },
            
            
            columns: [               
                
                {
                    data:'expense_date'
                },                
                {
                    data:'expense_name'
                },
                {
                    data:'expense_category'
                },
                
                {
                    data:'amount'
                }, 
                
                {
                    data:'notes'
                },
                {
                    data:'created_by'
                },
                {
                    data:'updated_by'
                },
                {
                    data:'created_at'
                },
                {
                    data: 'action'
                }         
                
               
            ]
        });
    }
}