<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

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

                // Computer Desktop Specification Labels
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Core',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Ram',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Generations',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'SSD',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'HDD',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 2,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],





                  // Computer Tower Specification Labels
                  [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Core',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Ram',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Generations',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'SSD',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'HDD',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 3,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                  // Computer NonBranded Specification Labels
                  [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Core',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Ram',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Generations',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'SSD',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'HDD',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 4,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],

                  // Computer Server Specification Labels
                  [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Core',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Ram',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Generations',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'SSD',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'HDD',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 5,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],






                 // Computer Accessories LCD/LED Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 1,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 1,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 1,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 1,
                    'category_specification_label' => 'Ports',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 1,
                    'category_specification_label' => 'Size',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 1,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 1,
                    'category_specification_label' => 'Warranty',
                ],



                 // Computer Accessories Ram Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 2,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 2,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 2,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 2,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 2,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 2,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 2,
                    'category_specification_label' => 'Warranty',
                ],




                // Computer Accessories HardDisk Specification Labels

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 17,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 17,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 17,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 17,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 17,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 17,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 17,
                    'category_specification_label' => 'Warranty',
                ],


                // Computer Accessories Processor Specification Labels

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 6,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 6,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 6,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 6,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 6,
                    'category_specification_label' => 'Generation',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 6,
                    'category_specification_label' => 'Warranty',
                ],



                // Computer Accessories MotherBoard Specification Labels

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 10,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 10,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 10,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 10,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 10,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 10,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 10,
                    'category_specification_label' => 'Warranty',
                ],





                // Computer Accessories Power Supply Specification Labels

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 7,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 7,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 7,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 7,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 7,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 7,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 7,
                    'category_specification_label' => 'Warranty',
                ],


                







            ]);



            
       
                
                






               
    }
}
