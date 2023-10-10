<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_names')->insert([

            // LAPTOPS PRODUCT NAMES 
            [
                'store_id' => 1,
                'product_name' => 'HP,Laptop',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Dell,Laptop',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Apple,Laptop',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Lenovo,Laptop',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Asus,Laptop',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Microsoft,Laptop',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Acer,Laptop',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'MSI,Laptop',
                'category_id' => 1,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // TABLETS PRODUCT NAMES 
            [
                'store_id' => 1,
                'product_name' => 'Samsung,Tablet',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Apple,Tablet',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Kindle,Tablet',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Huawei,Tablet',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Microsoft,Tablet',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Alcatel,Tablet',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Xiaomi,Tablet',
                'category_id' => 2,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // Computer product names 

            //Desktop Computers product names

            [
                'store_id' => 1,
                'product_name' => 'Dell,Computer',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'HP,Computer',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Lenovo,Computer',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Acer,Computer',
                'category_id' => null,
                'sub_category_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // LCD/LED Monitors product names 

            [
                'store_id' => 1,
                'product_name' => 'MSI,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Gigabyte,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Samsung,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Dell,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'HP,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'View Sonic,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Asus,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Benq,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'AOC,Computer',
                'category_id' => null,
                'sub_category_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Server product name 
            [
                'store_id' => 1,
                'product_name' => 'Dell,Server',
                'category_id' => null,
                'sub_category_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // PRINTERS PRODUCT NAMES 

            [
                'store_id' => 1,
                'product_name' => 'Laser Printers',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Inkjet Printers',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Photo Printers',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Multifunction Printers',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Toners and Cartridges',
                'category_id' => 4,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // CCTV CAMERA PRODUCT NAMES 

            [
                'store_id' => 1,
                'product_name' => 'DVRs',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'NVRs',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'IP Cameras',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'PTZ Cameras',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Analog Cameras',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'BNC Connectors',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'RJ7 Cables',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'CCTV Cables',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'RJ7 Cables',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Cat 6 Cables',
                'category_id' => 5,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],



              // Network ProductsBrand NAMES 
              
              [
                'store_id' => 1,
                'product_name' => 'Access Points',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Outdoor Access Points',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'PoE Switches',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Non PoE Switches',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Giga Switches',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => ' Manageable switches',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Enterprise Switches',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Nano Stations',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'WiFiRouters',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Network Cables',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Patch Cables',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Fiber Cables',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Fiber Patch Cards',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'PoE Injectors',
                'category_id' => 6,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],



             // scanners PRODUCT NAMES 

             [
                'store_id' => 1,
                'product_name' => 'Epson Scanners',
                'category_id' => 7,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'HP Scanners',
                'category_id' => 7,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Plus Tek',
                'category_id' => 7,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

             // PROJECTORS PRODUCT NAMES 

             [
                'store_id' => 1,
                'product_name' => 'Projector',
                'category_id' => 8,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Lens',
                'category_id' => 8,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Projector Stands',
                'category_id' => 8,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Projector Screen',
                'category_id' => 8,
                'sub_category_id' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // ACCESSORIES PRODUCT NAMES 
             // Laptop Accessories Brand
            [
                'store_id' => 1,
                'product_name' => 'Keyboards',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'ABCD Panels',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Rams',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'HDD',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'SSD',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Batteries',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Hinges',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Speakers',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Power leads',
                'category_id' => null,
                'sub_category_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            
             // Desktop Accessories Brand
             [
                'store_id' => 1,
                'product_name' => 'Processor',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'MotherBoard',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Rams',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Computer Casing',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'SSD',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'HDD',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'CPU Cooler',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Graphic Card',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Screen / Monitor',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Wireless Keyboard Mouse',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'USB Keyboard Mouse',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Network Cards',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Speakers',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Headphones',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'USB Storage',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'External HDD',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'Power Cable',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'VGA Cable',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'store_id' => 1,
                'product_name' => 'HDMI Cable',
                'category_id' => null,
                'sub_category_id' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
    }
}
