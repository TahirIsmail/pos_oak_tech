<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_companies')->insert([

            // LABPTOP COMPANIES
            [                
                'store_id' => 1,
                'category_company_name' => 'HP',
                'category_id' => 1,
                'sub_category_id' => null, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Apple',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Dell',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Lenovo',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Asus',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Microsoft',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Acer',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'MSI',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // TABLETS COMPANIES

            [
                'store_id' => 1,
                'category_company_name' => 'Apple',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Samsung',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Microsoft Corporation',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Kindle',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Huawei',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Alcatel',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Xiaomi',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
            // COMPUTERS COMPANIES
 
             //Desktop Computers
            [
                'store_id' => 1,
                'category_company_name' => 'Dell',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'HP',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Apple',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Lenovo',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Acer',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
             // lcd/led monitors

             [
                'store_id' => 1,
                'category_company_name' => 'MSI',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Gigabyte',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Samsung',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Dell',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'HP',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'View Sonic',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Asus',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Benq',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'AOC',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

             // SERVERS
             [
                'store_id' => 1,
                'category_company_name' => 'Dell',
                'category_id' => null,
                'sub_category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // PRINTERS COMPANIES 

            [
                'store_id' => 1,
                'category_company_name' => 'HP',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Epson',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Canon',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Samsung',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Xerox',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'category_company_name' => 'Ricoh',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
               'category_company_name' => 'Dell',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Kyocera',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Toshiba',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 


            // CCTV CAMERAS COMPANIES 

            [
                'store_id' => 1,
               'category_company_name' => 'Hikvision',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Dahua',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'HT',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 



            // NETWORKS COMPANIES

            [
                'store_id' => 1,
               'category_company_name' => 'Cisco',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'D-Link',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'TP-Link',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'HT',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'HP',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Huawei',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'H3C',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 


            // SCANNERS COMPANIES 

            [
                'store_id' => 1,
               'category_company_name' => 'Epson',
                'category_id' => 7,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'HP',
                'category_id' => 7,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Plus Tek',
                'category_id' => 7,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 


            // PROJECTORS COMPANIES 
            

            [
                'store_id' => 1,
               'category_company_name' => 'Sony',
                'category_id' => 8,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Epson',
                'category_id' => 8,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Panasonic',
                'category_id' => 8,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Hitachi',
                'category_id' => 8,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ], 


            // Accessories companies


            //  LAPTOP ACCESSORIES COMPANIES 
            [
                'store_id' => 1,
               'category_company_name' => 'HP',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ], 

            [
                'store_id' => 1,
               'category_company_name' => 'Dell',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Lenovo',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Acer',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'MSI',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Asus',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Apple',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ], 


            //  Computer ACCESSORIES COMPANIES 
            [
                'store_id' => 1,
               'category_company_name' => 'HP',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 

            [
                'store_id' => 1,
               'category_company_name' => 'Dell',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Lenovo',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Acer',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'MSI',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Asus',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 
            [
                'store_id' => 1,
               'category_company_name' => 'Non Branded',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ], 


        ]);
    }
}
