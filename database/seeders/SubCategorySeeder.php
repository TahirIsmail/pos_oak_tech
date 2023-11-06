<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sub_categories')->insert([
             // COMPUTER SUB CATEGORIES

             [                
                'category_id' => 1,
                'sub_category_name' => 'Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'sub_category_name' => 'Desktop',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'sub_category_name' => 'Tower',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'sub_category_name' => 'Server',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 1,
                'sub_category_name' => 'Unbranded',
                'created_at' => now(),
                'updated_at' => now(),
            ],


            // Laptop SUB CATEGORIES
            [                
                'category_id' => 2,
                'sub_category_name' => 'Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 2,
                'sub_category_name' => 'Laptops',
                'created_at' => now(),
                'updated_at' => now(),
            ],



             // Networks SUB CATEGORIES
            
             [                
                'category_id' => 3,
                'sub_category_name' => 'Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'sub_category_name' => 'Network Switches',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'category_id' => 3,
                'sub_category_name' => 'Firewall',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'sub_category_name' => 'Access Point',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [                
                'category_id' => 3,
                'sub_category_name' => 'Router',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'sub_category_name' => 'Load Balancer',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [                
                'category_id' => 3,
                'sub_category_name' => 'Gateway',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'sub_category_name' => 'Wireless Device',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 3,
                'sub_category_name' => 'KVM Switches',
                'created_at' => now(),
                'updated_at' => now(),
            ],

             // Printer SUB CATEGORIES


             [                
                'category_id' => 4,
                'sub_category_name' => 'Printer Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'sub_category_name' => 'LaserJet',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'category_id' => 4,
                'sub_category_name' => 'Dotmatrix',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 4,
                'sub_category_name' => 'Label Printer',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [                
                'category_id' => 4,
                'sub_category_name' => 'Deskjet',
                'created_at' => now(),
                'updated_at' => now(),
            ],



            // Security Equipment SUB CATEGORIES


            [                
                'category_id' => 5,
                'sub_category_name' => 'Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'sub_category_name' => 'CCTV Camera',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'category_id' => 5,
                'sub_category_name' => 'DVR-NVR-XVR',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'sub_category_name' => 'Surveillance HDD',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [                
                'category_id' => 5,
                'sub_category_name' => 'walkthrough Gate',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'category_id' => 5,
                'sub_category_name' => 'Metal Detector',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [                
                'category_id' => 5,
                'sub_category_name' => 'Bagagge Scanner',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 5,
                'sub_category_name' => 'BioMetric Devices',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [                
                'category_id' => 5,
                'sub_category_name' => 'Road Blockers',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
    }
}
