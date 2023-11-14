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


                 // Computer Accessories Keyboard Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 3,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 3,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 3,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 3,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 3,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 3,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 3,
                    'category_specification_label' => 'Warranty',
                ],



                 // Computer Accessories Mouse Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 4,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 4,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 4,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 4,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 4,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 4,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 4,
                    'category_specification_label' => 'Warranty',
                ],




                 // Computer Accessories Combo Keyboard/Mouse Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 5,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 5,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 5,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 5,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 5,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 5,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 5,
                    'category_specification_label' => 'Warranty',
                ],



                 // Computer Accessories Graphic Card Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 11,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 11,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 11,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 11,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 11,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 11,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 11,
                    'category_specification_label' => 'Warranty',
                ],


                 // Computer Accessories Power Cable Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 8,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 8,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 8,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 8,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 8,
                    'category_specification_label' => 'Length',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 8,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 8,
                    'category_specification_label' => 'Warranty',
                ],



                 // Computer Accessories Power Cable Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 9,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 9,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 9,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 9,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 9,
                    'category_specification_label' => 'Length',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 9,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 9,
                    'category_specification_label' => 'Warranty',
                ],

                 // Computer Accessories WebCam Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 15,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 15,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 15,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 15,
                    'category_specification_label' => 'Ports',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 15,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 15,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 15,
                    'category_specification_label' => 'Warranty',
                ],




                 // Computer Accessories Headphone Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 16,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 16,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 16,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 16,
                    'category_specification_label' => 'Ports',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 16,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 16,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 16,
                    'category_specification_label' => 'Warranty',
                ],


                 // Computer Accessories External HDD/SSD Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 12,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 12,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 12,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 12,
                    'category_specification_label' => 'Ports',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 12,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 12,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 12,
                    'category_specification_label' => 'Warranty',
                ],

                 // Computer Accessories SSD SATA 2.5 Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 18,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 18,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 18,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 18,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 18,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 18,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 18,
                    'category_specification_label' => 'Warranty',
                ],



                 // Computer Accessories Convertor Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 14,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 14,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 14,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 14,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 14,
                    'category_specification_label' => 'TO',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 14,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 14,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 14,
                    'category_specification_label' => 'Warranty',
                ],




                  // Computer Accessories CD DRIVE / CD-ROM Specification Labels

                  [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 19,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 19,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 19,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 19,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 19,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 19,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 19,
                    'category_specification_label' => 'Warranty',
                ],




                 // Computer Accessories Netwrok Card / Lan Card Specification Labels

                 [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 13,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 13,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 13,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 13,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 13,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 13,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 13,
                    'category_specification_label' => 'Warranty',
                ],


















                
                // Laptop specification value 

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Core',
                ],


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Ram',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Generation',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'SSD',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'HDD',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],

               

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Screen Size',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Keyboard',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Fingerprint',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Battery Backup',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 7,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],






                // Laptop Accesories (RAM)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 22,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 22,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 22,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 22,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 22,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 22,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 22,
                    'category_specification_label' => 'Warranty',
                ],



              

                // Laptop Accesories (HDD)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 29,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 29,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 29,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 29,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 29,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 29,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 29,
                    'category_specification_label' => 'Warranty',
                ],






                // Laptop Accessories (SSD)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 30,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 30,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 30,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 30,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 30,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 30,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 30,
                    'category_specification_label' => 'Warranty',
                ],





                // Laptop Accessories (Keyboard)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 23,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 23,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 23,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 23,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 23,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 23,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 23,
                    'category_specification_label' => 'Warranty',
                ],





                //Laptop Accessories (Battery)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 20,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 20,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 20,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 20,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 20,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 20,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 20,
                    'category_specification_label' => 'Warranty',
                ],





                //Laptop Accessories (ABCD Panel)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 32,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 32,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 32,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 32,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 32,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 32,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 32,
                    'category_specification_label' => 'Warranty',
                ],





                // Laptop Accessories (Hinges)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 33,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 33,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 33,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 33,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 33,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 33,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 33,
                    'category_specification_label' => 'Warranty',
                ],





                //Laptop Accessories (Chargers)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 25,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 25,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 25,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 25,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 25,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 25,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 25,
                    'category_specification_label' => 'Warranty',
                ],





                //Laptop Accessories (BAGS)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 34,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 34,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 34,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 34,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 34,
                    'category_specification_label' => 'Size',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 34,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 34,
                    'category_specification_label' => 'Warranty',
                ],





                //Laptop Accessories (Power Cable)


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 26,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 26,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 26,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 26,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 26,
                    'category_specification_label' => 'Length',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 26,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 26,
                    'category_specification_label' => 'Warranty',
                ],




                //Laptop Accessories (Display Cable)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 27,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 27,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 27,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 27,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 27,
                    'category_specification_label' => 'Size',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 27,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 27,
                    'category_specification_label' => 'Warranty',
                ],





                //Laptop Accessories (Mouse Panel)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 24,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 24,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 24,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 24,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 24,
                    'category_specification_label' => 'Size',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 24,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 24,
                    'category_specification_label' => 'Warranty',
                ],




                //Laptop Accessories (Motherboard)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 28,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 28,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 28,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 28,
                    'category_specification_label' => 'Core',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 28,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 28,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 28,
                    'category_specification_label' => 'Warranty',
                ],




                // LAPTOP ACCESSORIES (LCD/LED)

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 21,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 21,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 21,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 21,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 21,
                    'category_specification_label' => 'Size',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 21,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 21,
                    'category_specification_label' => 'Warranty',
                ],







                //Laptop Accessories (CD ROM)



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 31,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 31,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 31,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 31,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 31,
                    'category_specification_label' => 'Size',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 31,
                    'category_specification_label' => 'Codition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 31,
                    'category_specification_label' => 'Warranty',
                ],






                //LAPTOP Accessories (Dock Staion & COoling PAD not in the panel list)
                
                
                

                //NETWORK LIST

                // NETWORK SWITCHES



                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Switch Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Switch Ports',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Ethernet Uplink Port',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Fiber Uplink',
                ],
                
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Sub Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 9,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],

                
                //Firewall


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 10,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 10,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 10,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 10,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 10,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 10,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],

                

                //Access POINT


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 11,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 11,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 11,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 11,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 11,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 11,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],


                //ROUTER 


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 12,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 12,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 12,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 12,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 12,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 12,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                //LOAD BALANCER

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 13,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 13,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 13,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 13,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 13,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 13,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                //KVM SWITCHES


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 16,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 16,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 16,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 16,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 16,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 16,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                //GATEWAY


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 14,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 14,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 14,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 14,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 14,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 14,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],




                //NETWORK ACCESSORIES

                //PATCH CABLE


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 35,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 35,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 35,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 35,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 35,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 35,
                    'category_specification_label' => 'Warranty',
                ],


                // I/O JACK


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 36,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 36,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 36,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 36,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 36,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 36,
                    'category_specification_label' => 'Warranty',
                ],


                // FACE PLATE


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 37,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 37,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 37,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 37,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 37,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 37,
                    'category_specification_label' => 'Warranty',
                ],





                //BACK BOX


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 38,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 38,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 38,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 38,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 38,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 38,
                    'category_specification_label' => 'Warranty',
                ],



                //RJ-45 COnector


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 39,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 39,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 39,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 39,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 39,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 39,
                    'category_specification_label' => 'Warranty',
                ],


                //Media COnverter


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 40,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 40,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 40,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 40,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 40,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 40,
                    'category_specification_label' => 'Warranty',
                ],




                //CABLE ROLL



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 41,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 41,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 41,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 41,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 41,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 41,
                    'category_specification_label' => 'Warranty',
                ],



                //NETWORK RACK


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 42,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 42,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 42,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 42,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 42,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 42,
                    'category_specification_label' => 'Warranty',
                ],




                //PoE INJECTOR


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 43,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 43,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 43,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 43,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 43,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 43,
                    'category_specification_label' => 'Warranty',
                ],




                //Patch Panel



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 44,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 44,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 44,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 44,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 44,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 44,
                    'category_specification_label' => 'Warranty',
                ],



                //CABLE TIE



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 45,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 45,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 45,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 45,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 45,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 45,
                    'category_specification_label' => 'Warranty',
                ],



                //CABLE MANAGER


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 46,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 46,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 46,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 46,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 46,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 46,
                    'category_specification_label' => 'Warranty',
                ],



                //CABLE TRAY



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 47,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 47,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 47,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 47,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 47,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 47,
                    'category_specification_label' => 'Warranty',
                ],



                //PVC DUCT



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 48,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 48,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 48,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 48,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 48,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 48,
                    'category_specification_label' => 'Warranty',
                ],


                //PVC PIPE


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 49,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 49,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 49,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 49,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 49,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 49,
                    'category_specification_label' => 'Warranty',
                ],



                //Flexible Pipe



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 50,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 50,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 50,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 50,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 50,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 50,
                    'category_specification_label' => 'Warranty',
                ],



                //Screw Box



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 51,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 51,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 51,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 51,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 51,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 51,
                    'category_specification_label' => 'Warranty',
                ],



                //RAWAL PLUG BOX


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 52,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 52,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 52,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 52,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 52,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 52,
                    'category_specification_label' => 'Warranty',
                ],



                //SFP MODULE


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 53,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 53,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 53,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 53,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 53,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 53,
                    'category_specification_label' => 'Warranty',
                ],




                //PRINTER MAIN CATEGORY

                //PRINTER TYPE  LASER JET


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 18,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 18,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 18,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 18,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 18,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 18,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 18,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],


                //PRINTER TYPE DOTMATIRX


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 19,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 19,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 19,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 19,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 19,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 19,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 19,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],


                //PRINTER TYPE  DESKJET


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 21,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 21,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 21,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 21,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 21,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 21,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 21,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],


                //PRITNER TYPE LABEL PRINTER


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 20,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 20,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 20,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 20,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 20,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 20,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 20,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],


                //PRINTER ACCCESSORIES
                // TONER


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 54,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 54,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 54,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 54,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 54,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 54,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 54,
                    'category_specification_label' => 'Warranty',
                ],


                //SCANNER


                
                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 55,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 55,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 55,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 55,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 55,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 55,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 55,
                    'category_specification_label' => 'Warranty',
                ],



                //Tray


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 56,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 56,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 56,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 56,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 56,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 56,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 56,
                    'category_specification_label' => 'Warranty',
                ],




                //Formatter Card


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 57,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 57,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 57,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 57,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 57,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 57,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 57,
                    'category_specification_label' => 'Warranty',
                ],



                //Sleeve


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 58,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 58,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 58,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 58,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 58,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 58,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 58,
                    'category_specification_label' => 'Warranty',
                ],



                //Heating Unit


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 59,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 59,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 59,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 59,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 59,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 59,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 59,
                    'category_specification_label' => 'Warranty',
                ],



                //Gear Set



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 60,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 60,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 60,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 60,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 60,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 60,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 60,
                    'category_specification_label' => 'Warranty',
                ],



                //Printer HEad


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 61,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 61,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 61,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 61,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 61,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 61,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 61,
                    'category_specification_label' => 'Warranty',
                ],



                //Printer Cable


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 62,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 62,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 62,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 62,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 62,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 62,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 62,
                    'category_specification_label' => 'Warranty',
                ],




                //Roller



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 63,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 63,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 63,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 63,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 63,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 63,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 63,
                    'category_specification_label' => 'Warranty',
                ],


                //Pickup Roller


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 64,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 64,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 64,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 64,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 64,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 64,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 64,
                    'category_specification_label' => 'Warranty',
                ],



                //Front Panel


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 65,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 65,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 65,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 65,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 65,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 65,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 65,
                    'category_specification_label' => 'Warranty',
                ],






                //SECURITY EQUIPMENTS MAIN CATEGORY
                

                //CCTV CAMERA



                [
                    'category_id'                  => null,
                    'sub_category_id'              => 23,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 23,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 23,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 23,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 23,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 23,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 23,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                //DVR / NVR CAMERA



                [
                    'category_id'                  => null,
                    'sub_category_id'              => 24,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 24,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 24,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 24,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 24,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 24,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 24,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                //SURVEILLENCE CAMERA


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 25,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 25,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 25,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 25,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 25,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 25,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 25,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                //WALKTHROUGH GATE


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 26,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 26,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 26,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 26,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 26,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 26,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 26,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                //METAL DETECTOR


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 27,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 27,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 27,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 27,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 27,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 27,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 27,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                //BAGGAGE SCANNER


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 28,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 28,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 28,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 28,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 28,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 28,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 28,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],


                //BIOMETRIC DEVICE


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 29,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 29,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 29,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 29,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 29,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 29,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 29,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],




                //ROAD BLOCKERS


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 30,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 30,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 30,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 30,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 30,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 30,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => 30,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                // SECURITY DEVICES ACCESSORIES


                //BNC CONNECTOR


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 66,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 66,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 66,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 66,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 66,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 66,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 66,
                    'category_specification_label' => 'Warranty',
                ],


                //CCTV CABLE


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 67,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 67,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 67,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 67,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 67,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 67,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 67,
                    'category_specification_label' => 'Warranty',
                ],


                //PUSH BUTTON


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 69,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 69,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 69,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 69,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 69,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 69,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 69,
                    'category_specification_label' => 'Warranty',
                ],


                //PTZ CONTROLLER


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 70,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 70,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 70,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 70,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 70,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 70,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 70,
                    'category_specification_label' => 'Warranty',
                ],


                //LOCKS



                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 71,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 71,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 71,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 71,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 71,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 71,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 71,
                    'category_specification_label' => 'Warranty',
                ],



                //POWER SUPPLY


                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 68,
                    'category_specification_label' => 'Brand',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 68,
                    'category_specification_label' => 'Model',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 68,
                    'category_specification_label' => 'Product Name',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 68,
                    'category_specification_label' => 'Type',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 68,
                    'category_specification_label' => 'Capacity',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 68,
                    'category_specification_label' => 'Condition',
                ],

                [
                    'category_id'                  => null,
                    'sub_category_id'              => null,
                    'child_category_id'            => 68,
                    'category_specification_label' => 'Warranty',
                ],








                

                // Projectors (Projectors) SubCategories Values


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 31,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 31,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 31,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 31,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 31,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Lumens',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 31,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 31,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],




                
                // Projectors (Projector Screen) SubCategories Values


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 32,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 32,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 32,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 32,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 32,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Size',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 32,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 32,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                
                // Projectors (Projector Stand) SubCategories Values


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 33,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 33,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 33,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 33,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 33,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Size',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 33,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 33,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],











                 // Scanners (Scanner) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 34,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 34,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 34,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 34,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 34,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Size',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 34,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 34,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                 // Mobile/Tablet (Mobile/Tablet) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 35,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 35,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 35,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 35,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 35,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Size',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 35,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 35,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],







                 // Tools (Tools) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 36,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 36,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 36,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 36,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 36,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Size',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 36,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 36,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],





                 // Electronics (TV) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 37,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 37,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 37,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 37,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 37,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Size',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 37,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 37,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                 // Electronics (Air Purifier) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 38,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 38,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 38,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 38,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 38,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Size',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 38,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 38,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                // Electronics (Digital Cameras) SubCategories Values


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 39,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 39,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 39,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 39,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 39,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Pixel',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 39,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 39,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],









                 // PA SYSTEMS (PA Speakers) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 40,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 40,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 40,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 40,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 40,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Watt',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 40,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 40,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],







                // PA SYSTEMS (Apmlifier) SubCategories Values


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 41,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 41,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 41,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 41,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 41,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Watt',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 41,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 41,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],



                // PA SYSTEMS (MIC) SubCategories Values


                [
                    'category_id'                  => null,
                    'sub_category_id'              => 42,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 42,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 42,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 42,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 42,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Watt',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 42,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Conditions',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 42,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],














                 // Telephony (Exchange) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 43,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 43,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 43,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 43,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 43,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 43,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 43,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],





                 // Telephone (Telephone Set) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 44,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 44,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 44,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 44,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 44,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 44,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 44,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],





                 // Telephony (Video Conference) SubCategories Values


                 [
                    'category_id'                  => null,
                    'sub_category_id'              => 45,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Brand',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 45,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Model',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 45,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Product Name',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 45,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Type',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 45,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Capacity',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 45,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Condition',
                ],
                [
                    'category_id'                  => null,
                    'sub_category_id'              => 45,
                    'child_category_id'            => null,
                    'category_specification_label' => 'Warranty',
                ],











































            ]);



            
       
                
                






               
    }
}
