<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_specifications')->insert([
            // LABPTOP category specification
            [    
                'category_id' => 1,
                'sub_category_id' => null,
                'category_specification_label' => 'Ram', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [    
                'category_id' => 1,
                'sub_category_id' => null,
                'category_specification_label' => 'Hard Disk', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [    
                'category_id' => 1,
                'sub_category_id' => null,
                'category_specification_label' => 'Processor', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [    
                'category_id' => 1,
                'sub_category_id' => null,
                'category_specification_label' => 'Graphic Card', 
                'created_at' => now(),
                'updated_at' => now(),
            ],


             // Tablets category specification
             [    
                'category_id' => 2,
                'sub_category_id' => null,
                'category_specification_label' => 'Ram', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [    
                'category_id' => 2,
                'sub_category_id' => null,
                'category_specification_label' => 'Hard Disk', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [    
                'category_id' => 2,
                'sub_category_id' => null,
                'category_specification_label' => 'Processor', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [    
                'category_id' => 2,
                'sub_category_id' => null,
                'category_specification_label' => 'Graphic Card', 
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
