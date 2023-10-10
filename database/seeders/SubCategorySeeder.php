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
                'category_id' => 3,
                'sub_category_name' => 'Desktop Computers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'sub_category_name' => 'LCD/LED Monitors',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 3,
                'sub_category_name' => 'Servers',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // ACCESSORIES SUB CATEGORIES
            [                
                'category_id' => 9,
                'sub_category_name' => 'Laptop Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => 9,
                'sub_category_name' => 'Desktop Accessories',
                'created_at' => now(),
                'updated_at' => now(),
            ],

           
        ]);
    }
}
