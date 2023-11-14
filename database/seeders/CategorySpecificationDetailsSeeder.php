<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class CategorySpecificationDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // computer desktop-> id = 1   brand values
        $computercategory_brand_values = [
            'HP',
            'Dell',
            'Acer',
            'Lenovo',
            'Fujitsu',
            'Samsung',
            'Ease',
            'Nonbranded'
        ];

        $computercategory_brand_data = [];
        foreach ($computercategory_brand_values as $brand) {
            $computercategory_brand_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 1,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_brand_data);


        $computercategory_product_name_values = [
            'Computer'
        ];

        $computercategory_product_name_data = [];
        foreach ($computercategory_product_name_values as $product_name) {
            $computercategory_product_name_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 3,
                'values' => $product_name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_product_name_data);



        // computer desktop 1 type values
        $computercategory_type_values = [
            'Tower',
            'Desktop',
            'NonBranded',
            'Server',
        ];

        $computercategory_type_data = [];
        foreach ($computercategory_type_values as $type) {
            $computercategory_type_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 4,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_type_data);





        // computer desktop 1   Core values
        $computercategory_core_values = [
            'Core i3',
            'Core i5',
            'Core i7',
            'Core i9',
            'Core i11'
        ];

        $computercategory_core_data = [];
        foreach ($computercategory_core_values as $type) {
            $computercategory_core_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 5,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_core_data);




        // computer desktop 1 Ram values
        $computercategory_ram_values = [
            '2GB',
            '4GB',
            '6GB',
            '8GB',
            '12GB',
            '16GB',
            '32GB',
            '64GB',
            '128GB'
        ];

        $computercategory_ram_data = [];
        foreach ($computercategory_ram_values as $type) {
            $computercategory_ram_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 6,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_ram_data);




        // computer desktop 1 Generations values
        $computercategory_generation_values = [
            '1st',
            '2nd',
            '3rd',
            '4th',
            '5th',
            '6th',
            '7th',
            '8th',
            '9th',
            '10th',
            '11th',
            '12th',
            '13th',
            '14th',
            '15th',
            '16th',
            '17th',
            '18th'
        ];

        $computercategory_generation_data = [];
        foreach ($computercategory_generation_values as $type) {
            $computercategory_generation_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 7,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_generation_data);

        // computer desktop 1 SSD values
        $computercategory_ssd_values = [
            '120GB',
            '128GB',
            '160GB',
            '240GB',
            '256GB',
            '480GB',
            '512GB',
            '1TB',
            '2TB',
            '3TB',
            '4TB',
            '5TB',
            '6TB',
            '8TB',
            '10TB',
            'N/A'
        ];

        $computercategory_ssd_data = [];
        foreach ($computercategory_ssd_values as $type) {
            $computercategory_ssd_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 8,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_ssd_data);





        // computer desktop 1 HDD values
        $computercategory_hdd_values = [
            '250GB',
            '320GB',
            '500GB',
            '750GB',
            '1TB',
            '2TB',
            '3TB',
            '4TB',
            '5TB',
            '6TB',
            '8TB',
            '10TB',
            'N/A'
        ];

        $computercategory_hdd_data = [];
        foreach ($computercategory_hdd_values as $type) {
            $computercategory_hdd_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 9,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_hdd_data);



        // computer desktop 1 Conditions values
        $computercategory_condition_values = [
            'USED',
            'NEW',
            'refurbished',
            'open Box'
        ];

        $computercategory_condition_data = [];
        foreach ($computercategory_condition_values as $type) {
            $computercategory_condition_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 10,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_condition_data);




        // computer desktop 1   warranty values
        $computercategory_warranty_values = [
            'Check warranty',
            '15 Days',
            '1 Month',
            '3 Months',
            '6 Months',
            '9 Months',
            '1 Year',
            '2 Years',
            '3 Years',
            'International Warranty'
        ];

        $computercategory_warranty_data = [];
        foreach ($computercategory_warranty_values as $type) {
            $computercategory_warranty_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 11,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_warranty_data);

















        // computer tower 
        // computer tower -> id = 2   brand values
        $computercategory_brand_values = [
            'HP',
            'Dell',
            'Acer',
            'Lenovo',
            'Fujitsu',
            'Samsung',
            'Ease',
            'Nonbranded'
        ];

        $computercategory_brand_data = [];
        foreach ($computercategory_brand_values as $brand) {
            $computercategory_brand_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 12,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_brand_data);




        $computercategory_product_name_values = [
            'Computer'
        ];

        $computercategory_product_name_data = [];
        foreach ($computercategory_product_name_values as $product_name) {
            $computercategory_product_name_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 14,
                'values' => $product_name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_product_name_data);

        // computer tower 1 type values
        $computercategory_type_values = [
            'Tower',
            'Desktop',
            'NonBranded',
            'Server',
        ];

        $computercategory_type_data = [];
        foreach ($computercategory_type_values as $type) {
            $computercategory_type_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 15,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_type_data);





        // computer tower 1   Core values
        $computercategory_core_values = [
            'Core i3',
            'Core i5',
            'Core i7',
            'Core i9',
            'Core i11'
        ];

        $computercategory_core_data = [];
        foreach ($computercategory_core_values as $type) {
            $computercategory_core_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 16,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_core_data);




        // computer tower 1 Ram values
        $computercategory_ram_values = [
            '2GB',
            '4GB',
            '6GB',
            '8GB',
            '12GB',
            '16GB',
            '32GB',
            '64GB',
            '128GB'
        ];

        $computercategory_ram_data = [];
        foreach ($computercategory_ram_values as $type) {
            $computercategory_ram_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 17,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_ram_data);




        // computer tower 1 Generations values
        $computercategory_generation_values = [
            '1st',
            '2nd',
            '3rd',
            '4th',
            '5th',
            '6th',
            '7th',
            '8th',
            '9th',
            '10th',
            '11th',
            '12th',
            '13th',
            '14th',
            '15th',
            '16th',
            '17th',
            '18th'
        ];

        $computercategory_generation_data = [];
        foreach ($computercategory_generation_values as $type) {
            $computercategory_generation_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 18,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_generation_data);

        // computer tower 1 SSD values
        $computercategory_ssd_values = [
            '120GB',
            '128GB',
            '160GB',
            '240GB',
            '256GB',
            '480GB',
            '512GB',
            '1TB',
            '2TB',
            '3TB',
            '4TB',
            '5TB',
            '6TB',
            '8TB',
            '10TB',
            'N/A'
        ];

        $computercategory_ssd_data = [];
        foreach ($computercategory_ssd_values as $type) {
            $computercategory_ssd_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 19,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_ssd_data);





        // computer tower 1 HDD values
        $computercategory_hdd_values = [
            '250GB',
            '320GB',
            '500GB',
            '750GB',
            '1TB',
            '2TB',
            '3TB',
            '4TB',
            '5TB',
            '6TB',
            '8TB',
            '10TB',
            'N/A'
        ];

        $computercategory_hdd_data = [];
        foreach ($computercategory_hdd_values as $type) {
            $computercategory_hdd_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 20,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_hdd_data);



        // computer tower 1 Conditions values
        $computercategory_condition_values = [
            'USED',
            'NEW',
            'refurbished',
            'open Box'
        ];

        $computercategory_condition_data = [];
        foreach ($computercategory_condition_values as $type) {
            $computercategory_condition_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 21,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_condition_data);




        // computer tower 1   warranty values
        $computercategory_warranty_values = [
            'Check warranty',
            '15 Days',
            '1 Month',
            '3 Months',
            '6 Months',
            '9 Months',
            '1 Year',
            '2 Years',
            '3 Years',
            'International Warranty'
        ];

        $computercategory_warranty_data = [];
        foreach ($computercategory_warranty_values as $type) {
            $computercategory_warranty_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 22,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_warranty_data);
















        // compouer nonbranded 
        // computer nonbranded-> id = 3  brand values
        $computercategory_brand_values = [
            'HP',
            'Dell',
            'Acer',
            'Lenovo',
            'Fujitsu',
            'Samsung',
            'Ease',
            'Nonbranded'
        ];

        $computercategory_brand_data = [];
        foreach ($computercategory_brand_values as $brand) {
            $computercategory_brand_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 23,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_brand_data);



        $computercategory_product_name_values = [
            'Computer'
        ];

        $computercategory_product_name_data = [];
        foreach ($computercategory_product_name_values as $product_name) {
            $computercategory_product_name_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 25,
                'values' => $product_name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_product_name_data);

        // computer nonbranded 1 type values
        $computercategory_type_values = [
            'Tower',
            'Desktop',
            'NonBranded',
            'Server',
        ];

        $computercategory_type_data = [];
        foreach ($computercategory_type_values as $type) {
            $computercategory_type_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 26,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_type_data);





        // computer nonbranded 1 Core values
        $computercategory_core_values = [
            'Core i3',
            'Core i5',
            'Core i7',
            'Core i9',
            'Core i11'
        ];

        $computercategory_core_data = [];
        foreach ($computercategory_core_values as $type) {
            $computercategory_core_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 27,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_core_data);




        // computer nonbranded 3 Ram values
        $computercategory_ram_values = [
            '2GB',
            '4GB',
            '6GB',
            '8GB',
            '12GB',
            '16GB',
            '32GB',
            '64GB',
            '128GB'
        ];

        $computercategory_ram_data = [];
        foreach ($computercategory_ram_values as $type) {
            $computercategory_ram_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 28,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_ram_data);




        // computer nonbranded 3 Generations values
        $computercategory_generation_values = [
            '1st',
            '2nd',
            '3rd',
            '4th',
            '5th',
            '6th',
            '7th',
            '8th',
            '9th',
            '10th',
            '11th',
            '12th',
            '13th',
            '14th',
            '15th',
            '16th',
            '17th',
            '18th'
        ];

        $computercategory_generation_data = [];
        foreach ($computercategory_generation_values as $type) {
            $computercategory_generation_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 29,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_generation_data);

        // computer nonbranded 3 SSD values
        $computercategory_ssd_values = [
            '120GB',
            '128GB',
            '160GB',
            '240GB',
            '256GB',
            '480GB',
            '512GB',
            '1TB',
            '2TB',
            '3TB',
            '4TB',
            '5TB',
            '6TB',
            '8TB',
            '10TB',
            'N/A'
        ];

        $computercategory_ssd_data = [];
        foreach ($computercategory_ssd_values as $type) {
            $computercategory_ssd_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 30,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_ssd_data);





        // computer nonbranded 3 HDD values
        $computercategory_hdd_values = [
            '250GB',
            '320GB',
            '500GB',
            '750GB',
            '1TB',
            '2TB',
            '3TB',
            '4TB',
            '5TB',
            '6TB',
            '8TB',
            '10TB',
            'N/A'
        ];

        $computercategory_hdd_data = [];
        foreach ($computercategory_hdd_values as $type) {
            $computercategory_hdd_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 31,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_hdd_data);



        // computer nonbranded 3 Conditions values
        $computercategory_condition_values = [
            'USED',
            'NEW',
            'refurbished',
            'open Box'
        ];

        $computercategory_condition_data = [];
        foreach ($computercategory_condition_values as $type) {
            $computercategory_condition_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 32,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_condition_data);




        // computer nonbranded 3   warranty values
        $computercategory_warranty_values = [
            'Check warranty',
            '15 Days',
            '1 Month',
            '3 Months',
            '6 Months',
            '9 Months',
            '1 Year',
            '2 Years',
            '3 Years',
            'International Warranty'
        ];

        $computercategory_warranty_data = [];
        foreach ($computercategory_warranty_values as $type) {
            $computercategory_warranty_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 33,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_warranty_data);




















        // computer Server -> id = 5   brand values
        $computercategory_brand_values = [
            'HP',
            'Dell',
            'Acer',
            'Lenovo',
            'Fujitsu',
            'Samsung',
            'Ease',
            'Nonbranded'
        ];

        $computercategory_brand_data = [];
        foreach ($computercategory_brand_values as $brand) {
            $computercategory_brand_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 34,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_brand_data);




        $computercategory_product_name_values = [
            'Computer'
        ];

        $computercategory_product_name_data = [];
        foreach ($computercategory_product_name_values as $product_name) {
            $computercategory_product_name_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 36,
                'values' => $product_name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_product_name_data);

        // computer Server 1 type values
        $computercategory_type_values = [
            'Tower',
            'Desktop',
            'NonBranded',
            'Server',
        ];

        $computercategory_type_data = [];
        foreach ($computercategory_type_values as $type) {
            $computercategory_type_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 37,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_type_data);





        // computer Server 1   Core values
        $computercategory_core_values = [
            'Core i3',
            'Core i5',
            'Core i7',
            'Core i9',
            'Core i11'
        ];

        $computercategory_core_data = [];
        foreach ($computercategory_core_values as $type) {
            $computercategory_core_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 38,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_core_data);




        // computer Server 1 Ram values
        $computercategory_ram_values = [
            '2GB',
            '4GB',
            '6GB',
            '8GB',
            '12GB',
            '16GB',
            '32GB',
            '64GB',
            '128GB'
        ];

        $computercategory_ram_data = [];
        foreach ($computercategory_ram_values as $type) {
            $computercategory_ram_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 39,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_ram_data);




        // computer Server Generations values
        $computercategory_generation_values = [
            '1st',
            '2nd',
            '3rd',
            '4th',
            '5th',
            '6th',
            '7th',
            '8th',
            '9th',
            '10th',
            '11th',
            '12th',
            '13th',
            '14th',
            '15th',
            '16th',
            '17th',
            '18th'
        ];

        $computercategory_generation_data = [];
        foreach ($computercategory_generation_values as $type) {
            $computercategory_generation_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 40,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_generation_data);

        // computer Server 1 SSD values
        $computercategory_ssd_values = [
            '120GB',
            '128GB',
            '160GB',
            '240GB',
            '256GB',
            '480GB',
            '512GB',
            '1TB',
            '2TB',
            '3TB',
            '4TB',
            '5TB',
            '6TB',
            '8TB',
            '10TB',
            'N/A'
        ];

        $computercategory_ssd_data = [];
        foreach ($computercategory_ssd_values as $type) {
            $computercategory_ssd_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 41,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_ssd_data);





        // computer Server 1 HDD values
        $computercategory_hdd_values = [
            '250GB',
            '320GB',
            '500GB',
            '750GB',
            '1TB',
            '2TB',
            '3TB',
            '4TB',
            '5TB',
            '6TB',
            '8TB',
            '10TB',
            'N/A'
        ];

        $computercategory_hdd_data = [];
        foreach ($computercategory_hdd_values as $type) {
            $computercategory_hdd_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 42,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_hdd_data);



        // computer Server 1 Conditions values
        $computercategory_condition_values = [
            'USED',
            'NEW',
            'refurbished',
            'open Box'
        ];

        $computercategory_condition_data = [];
        foreach ($computercategory_condition_values as $type) {
            $computercategory_condition_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 43,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_condition_data);




        // computer Server 1   warranty values
        $computercategory_warranty_values = [
            'Check warranty',
            '15 Days',
            '1 Month',
            '3 Months',
            '6 Months',
            '9 Months',
            '1 Year',
            '2 Years',
            '3 Years',
            'International Warranty'
        ];

        $computercategory_warranty_data = [];
        foreach ($computercategory_warranty_values as $type) {
            $computercategory_warranty_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 44,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computercategory_warranty_data);





        // ========================= computer Accessories    warranty values Start =========


        // computer Accessories LCD/LED ID = 1   warranty values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujistu",
            "Samsung",
            "Ease",
            "Nonbranded",
            "AOC",
        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 45,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "LED",
            "LCD",
            "IPS",
            "2K",
            "4K",
            "8K"
        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 47,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Ports values 

        $computer_accessories_ports_values = [
            "HDMI VGA",
            "VGA DVI",
            "D-Port VGA",

        ];

        $computer_accessories_ports_values_data = [];
        foreach ($computer_accessories_ports_values as $ports) {
            $computer_accessories_ports_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 48,
                'values' => $ports,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_ports_values_data);




        //   SIZE values 

        $computer_accessories_size_values = [
            "15",
            "17",
            "19",
            "20",
            "21",
            "22",
            "23",
            "24",
            "27",
            "29",
            "30",
            "31",
            "33",
            "37",
        ];

        $computer_accessories_size_values_data = [];
        foreach ($computer_accessories_size_values as $size) {
            $computer_accessories_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 49,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_size_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 50,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 51,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // computer Accessories WEBCAM ID = 1  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "A4-Tech",
            "LogiTech",
            "Samsung",
            "Sony",
            "Ease",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 128,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Screen Mount",
            "Stand Mount",
            "Desktop",

        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 130,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Ports values 

        $computer_accessories_ports_values = [
            "Type-C",
            "USB",
            "Bluetooth",

        ];

        $computer_accessories_ports_values_data = [];
        foreach ($computer_accessories_ports_values as $ports) {
            $computer_accessories_ports_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 131,
                'values' => $ports,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_ports_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "480Pixels",
            "720Pixels",
            "1080Pixels",
            "HD",
            "FHD",
            "UHD",

        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 132,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 133,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 134,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // computer Accessories HDPHONES ID = 1  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "A4-Tech",
            "LogiTech",
            "Samsung",
            "Sony",
            "Ease",
            "Others",
            "Jabra",
            "Plantronics",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 135,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Bluetooth",
            "Aux",
            "USB",
            "Type-C",
            "Wireless",


        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 137,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Ports values 

        $computer_accessories_ports_values = [
            "With Mic",
            "without Mic",
            "Single Headphones",
            "Double Headphones",
            "Rechargable",
            "Noise Cancelling",

        ];

        $computer_accessories_ports_values_data = [];
        foreach ($computer_accessories_ports_values as $ports) {
            $computer_accessories_ports_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 138,
                'values' => $ports,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_ports_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "HD",
            "Non HD",


        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 139,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 140,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 141,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // computer Accessories EXTERNAL HDD SSD ID = 1  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "WD",
            "SeaGate",
            "Samsung",
            "Sony",
            "Ease",
            "Others",


        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 142,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "External HDD",
            "External SSD",



        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 144,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Ports values 

        $computer_accessories_ports_values = [
            "Type-C",
            "USB 2.0",
            "USB 3.0",
            "USB 4.0",


        ];

        $computer_accessories_ports_values_data = [];
        foreach ($computer_accessories_ports_values as $ports) {
            $computer_accessories_ports_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 145,
                'values' => $ports,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_ports_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "250 GB",
            "500 GB",
            "750 GB",
            "1 TB",
            "2 TB",
            "3 TB",
            "4 TB",
            "5 TB",
            "6 TB",


        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 146,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 147,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 148,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // computer Accessories SSD SATA 2.5  ID = 1  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "SanDisk",
            "Westren Digital",
            "Samsung",
            "Crucial",
            "Kingston",
            "Others",


        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 149,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "SATA 2.5",



        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 152,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Computer SSD",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 151,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "120 GB",
            "128 GB",
            "240 GB",
            "250 GB",
            "500 GB",
            "1 TB",
            "2 TB",
            "3 TB",
            "4 TB",
            "6 TB",


        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 153,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 154,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 155,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // computer Accessories CD DRIVE  ID = 1  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Samsung",
            "Sony",
            "Others",


        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 164,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "DVD Rom",
            "DVD R-W",



        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 167,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Computer CD Drive",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 166,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "N/A",



        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 168,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 169,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 170,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // computer Accessories CONVERTER  ID = 1  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Samsung",
            "Sony",
            "Apple",
            "Others",


        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 156,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "VGA",
            "HDMI",
            "LAN",
            "USB",
            "DVI",
            "TYPE-C",
            "D-Port",
            "APPLE PORT",



        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 159,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Converter",
            "Splitter",
            "Hub",





        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 158,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   To values 

        $computer_accessories_to_values = [
            "VGA",
            "HDMI",
            "LAN",
            "USB",
            "DVI",
            "TYPE-C",
            "D-Port",
            "3 Port Hub",
            "4 Port Hub",
            "5 Port Hub",
            "7 Port Hub",
            "9 Port Hub",
            "Apple Port",



        ];

        $computer_accessories_to_values_data = [];
        foreach ($computer_accessories_to_values as $to) {
            $computer_accessories_to_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 160,
                'values' => $to,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_to_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 162,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 163,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);



        // computer Accessories SPEAKERS  ID = 1  values Start   missing




        // Laptop subcategory values start
        //   Brand values 

        $laptop_subcategory_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Other"

        ];

        $laptop_subcategory_brand_values_data = [];
        foreach ($laptop_subcategory_brand_values as $brand) {
            $laptop_subcategory_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 178,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_brand_values_data);



        //   product values 

        $laptop_subcategory_product_values = [
            "Laptops",

        ];

        $laptop_subcategory_product_values_data = [];
        foreach ($laptop_subcategory_product_values as $product) {
            $laptop_subcategory_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 180,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_product_values_data);




        //   core values 

        $laptop_subcategory_core_values = [
            "Core i3",
            "Core i5",
            "Core i7",
            "Core i9",
            "Core i11"

        ];

        $laptop_subcategory_core_values_data = [];
        foreach ($laptop_subcategory_core_values as $core) {
            $laptop_subcategory_core_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 181,
                'values' => $core,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_core_values_data);



        //   ram values 

        $laptop_subcategory_ram_values = [
            "2GB",
            "4GB",
            "6GB",
            "8GB",
            "12GB",
            "16GB",
            "32GB",
            "64GB",
            "128GB"

        ];

        $laptop_subcategory_ram_values_data = [];
        foreach ($laptop_subcategory_ram_values as $ram) {
            $laptop_subcategory_ram_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 182,
                'values' => $ram,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_ram_values_data);



        //   generation values 

        $laptop_subcategory_generation_values = [
            "1st",
            "2nd",
            "3rd",
            "4th",
            "5th",
            "6th",
            "7th",
            "8th",
            "9th",
            "10th",
            "11th",
            "12th",
            "13th",
            "14th",
            "15th",
            "16th",
            "17th",
            "18th"

        ];

        $laptop_subcategory_generation_values_data = [];
        foreach ($laptop_subcategory_generation_values as $generation) {
            $laptop_subcategory_generation_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 183,
                'values' => $generation,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_generation_values_data);



        //   ssd values 

        $laptop_subcategory_ssd_values = [
            "120GB",
            "128GB",
            "160GB",
            "240GB",
            "256GB",
            "480GB",
            "512GB",
            "1TB",
            "2TB",
            "3TB",
            "4TB",
            "5TB",
            "6TB",
            "8TB",
            "10TB",
            "N/A"

        ];

        $laptop_subcategory_ssd_values_data = [];
        foreach ($laptop_subcategory_ssd_values as $ssd) {
            $laptop_subcategory_ssd_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 184,
                'values' => $ssd,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_ssd_values_data);




        //   hdd values 

        $laptop_subcategory_hdd_values = [
            "250GB",
            "320GB",
            "500GB",
            "750GB",
            "1TB",
            "2TB",
            "3TB",
            "4TB",
            "5TB",
            "6TB",
            "8TB",
            "10TB",
            "N/A"

        ];

        $laptop_subcategory_hdd_values_data = [];
        foreach ($laptop_subcategory_hdd_values as $hdd) {
            $laptop_subcategory_hdd_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 185,
                'values' => $hdd,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_hdd_values_data);





        //   condition values 

        $laptop_subcategory_condition_values = [
            "USED",
            "NEW",
            "Refurbished",
            "Open Box",
            "Used A+",
            "Used A",
            "Used B",
            "Minor Broken",
            "Minor Issue"

        ];

        $laptop_subcategory_condition_values_data = [];
        foreach ($laptop_subcategory_condition_values as $condition) {
            $laptop_subcategory_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 186,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_condition_values_data);




        //   warranty values 

        $laptop_subcategory_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",
            "International Warranty"

        ];

        $laptop_subcategory_warranty_values_data = [];
        foreach ($laptop_subcategory_warranty_values as $warranty) {
            $laptop_subcategory_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 187,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_warranty_values_data);



        //   screen_size values 

        $laptop_subcategory_screen_size_values = [
            "13",
            "13.3",
            "14",
            "14.2",
            "14.6",
            "15",
            "15.6",
            "16",
            "17"

        ];

        $laptop_subcategory_screen_size_values_data = [];
        foreach ($laptop_subcategory_screen_size_values as $screen_size) {
            $laptop_subcategory_screen_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 188,
                'values' => $screen_size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_screen_size_values_data);



        //   keyboard values 

        $laptop_subcategory_keyboard_values = [
            "Normal",
            "Backlit"

        ];

        $laptop_subcategory_keyboard_values_data = [];
        foreach ($laptop_subcategory_keyboard_values as $keyboard) {
            $laptop_subcategory_keyboard_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 189,
                'values' => $keyboard,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_keyboard_values_data);



        //   fingerprint values 

        $laptop_subcategory_fingerprint_values = [
            "Yes",
            "No"

        ];

        $laptop_subcategory_fingerprint_values_data = [];
        foreach ($laptop_subcategory_fingerprint_values as $fingerprint) {
            $laptop_subcategory_fingerprint_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 190,
                'values' => $fingerprint,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_fingerprint_values_data);




        //   battery values 

        $laptop_subcategory_battery_values = [
            "15 Min",
            "30 Min",
            "45 Min",
            "1 Hour",
            "1.30 Hours",
            "2 Hours",
            "2.30 Hours",
            "3 Hours",
            "3 Hours +"

        ];

        $laptop_subcategory_battery_values_data = [];
        foreach ($laptop_subcategory_battery_values as $battery) {
            $laptop_subcategory_battery_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 191,
                'values' => $battery,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_battery_values_data);




        //   type values 

        $laptop_subcategory_type_values = [
            "Touch",
            "Convertible",
            "Convertible & Touch",
            "Standard"

        ];

        $laptop_subcategory_type_values_data = [];
        foreach ($laptop_subcategory_type_values as $type) {
            $laptop_subcategory_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 192,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($laptop_subcategory_type_values_data);



        // Laptop subcategory values end



        // NEW LAPTOP Accessories RAM  ID = 22  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Smasung",
            "Toshiba",
            "Kingston",
            "Team Group",
            "Dahua",
            "Lexar",
            "Skylink",
            "HP",
            "COrsair",
            "Sonic",
            "XPG",
            "Hikvision",
            "Transcend",
            "Crucial",
            "G.skill",
            "Adata",
            "Skk hynix",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 193,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "DDR 1",
            "DDR 2",
            "DDR 3",
            "DDR 4",
            "DDR 5",
            "DDR 6",
            "DDR 7",
            "DDR 8",



        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 196,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Ram",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 195,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "2 GB",
            "4 GB",
            "8 GB",
            "16 GB",
            "32 GB",
            "64 GB",



        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 197,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 198,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 199,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // NEW LAPTOP Accessories HHD  ID = 22  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Seagate",
            "Toshiba",
            "Western Digital",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 200,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "SATA",




        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 203,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "HHD",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 202,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "120 GB",
            "250 GB",
            "500 GB",
            "750 GB",
            "1 TB",
            "2 TB",
            "4 TB",
            "320 GB",



        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 204,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 205,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 206,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // NEW LAPTOP Accessories SSD  ID = 30  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "ADATA",
            "Asus",
            "Hik Vision",
            "Kingston",
            "Lexar",
            "PNY",
            "Samsung",
            "Western Digital",
            "Dahua",
            "Team Group",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 207,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "M1 SATA",
            "M2 SATA",
            "Nvme",




        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 210,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop SSD",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 209,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "80 GB",
            "120 GB",
            "128 GB",
            "256 GB",
            "512 GB",
            "1 TB",
            "2 TB",
            "3 TB",
            "4 TB",
            "5 TB",


        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 211,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 212,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 213,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // NEW LAPTOP Accessories KEYBOARD  ID = 23  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 214,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Qwerty",
            "Numeric",
            "Ergonomic",
            "Backlite",
            "Membran",




        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 217,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop Keyboard",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 216,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "14",
            "15.6",


        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 218,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 219,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 220,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // NEW LAPTOP Accessories Battery  ID = 20  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 221,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Nickel Cadmium",
            "Nickel Metal Hydride",
            "Lethium",





        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 224,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop Keyboard",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 223,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "2 Cell",
            "3 Cell",
            "4 Cell",
            "6 Cell",
            "8 Cell",
            "9 Cell",
            "10 Cell",
            "12 Cell",


        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 225,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",

        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 226,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 227,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // NEW LAPTOP Accessories ABCD PANEL  ID = 32  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 228,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "A Panel",
            "B Panel",
            "C Panel",
            "D Panel",
            "ABCD Panel",





        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 231,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop Panel",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 230,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Size values 

        $computer_accessories_capacity_values = [
            "12.1 inch",
            "13.3 inch",
            "14 inch",
            "14.3 inch",
            "15.2 inch",
            "15.4 inch",
            "16.1 inch",
            "17 inch",
            "18.4 inch",





        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 232,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 223,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years",

        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 227,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // NEW LAPTOP Accessories Hinges  ID = 33  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 235,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Free Swinging",
            "concealed",
            "Removable",
            "Detent",
            "Torque",
            "Others",





        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 238,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Hinges",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 237,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "Single",
            "Pair",






        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 239,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 240,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",


        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 241,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // NEW LAPTOP Accessories Chargers (Power Adapters)  ID = 25  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",

        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 242,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "DC jack 4.50 mm",
            "DC jack 2.50 mm",
            "Usb Type-C",
            "Lightning",
            "Usb Type-A",
            "Usb",
            "Usb 2.0",
            "Usb 1.1",
            "HP Blue Pin",
            "Others",





        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 245,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop Chargers",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 244,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "30W",
            "45W",
            "60W",
            "65W",
            "90W",
            "120W",






        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 246,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 247,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",


        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 248,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NEW LAPTOP Accessories BAGS  ID = 34  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Cool Bag",
            "Zunwei",
            "Bossda",
            "MI",
            "Targus",
            "Local",


        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 249,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Backpack",
            "Sleeve",
            "OAK Logo",





        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 252,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Bags",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 251,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Size values 

        $computer_accessories_capacity_values = [
            "12 inch",
            "14 inch",
            "15.6 inch",
            "17.6 inch",






        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 253,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 254,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 255,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NEW LAPTOP Accessories Power Cable  ID = 26  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Branded",
            "Chinese",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 256,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "2 Pin to butterfly",
            "3 Pin to butterfly",
            "2 Pin Tape Led",
            "2 Pin Tape Led",





        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 259,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop Power cable",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 258,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Length values 

        $computer_accessories_length_values = [
            "1 M",
            "2 M",
            "3 M",
            "4 M",
            "5 M",






        ];

        $computer_accessories_length_values_data = [];
        foreach ($computer_accessories_length_values as $length) {
            $computer_accessories_length_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 260,
                'values' => $length,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_length_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 261,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 262,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NEW LAPTOP Accessories DISPLAY CABLE  ID = 27  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 263,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "10 Pin",
            "12 Pin",
            "13 Pin",
            "15 Pin",
            "17 Pin",
            "19 Pin",





        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 266,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop DIsplay Cable",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 265,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Size values 

        $computer_accessories_capacity_values = [
            "13",
            "14",
            "15",
            "16",
            "17",






        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 267,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 268,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 269,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // NEW LAPTOP Accessories MOuse Panel  ID = 24  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 270,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Standard",






        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 273,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop mouse panel",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 272,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Size values 

        $computer_accessories_capacity_values = [
            "Normal",







        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 274,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 275,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 276,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NEW LAPTOP Accessories MOtherBoard  ID = 28  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 277,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Standard",






        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 281,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop motherboard",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 279,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   CORE values 

        $computer_accessories_core_values = [
            "core i3",
            "core i5",
            "core i7",
            "core i9",
            "core i11",







        ];

        $computer_accessories_core_values_data = [];
        foreach ($computer_accessories_core_values as $core) {
            $computer_accessories_core_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 280,
                'values' => $core,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_core_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 282,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 276,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NEW LAPTOP Accessories LCD / LED  ID = 21  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 284,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "720 Pixel",
            "HD",
            "FHD",
            "UHD",






        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 287,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop screen",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 286,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Size values 

        $computer_accessories_size_values = [
            "13",
            "14",
            "15",
            "16",
            "17",







        ];

        $computer_accessories_size_values_data = [];
        foreach ($computer_accessories_size_values as $size) {
            $computer_accessories_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 288,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_size_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 289,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 290,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);



        // NEW LAPTOP Accessories CD ROM  ID = 31  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 291,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "CD ROM",
            "DVD ROM",
            "DVD RW",







        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 294,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop CD ROM",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 293,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Size values 

        $computer_accessories_size_values = [
            "Normal",








        ];

        $computer_accessories_size_values_data = [];
        foreach ($computer_accessories_size_values as $size) {
            $computer_accessories_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 295,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_size_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 296,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 297,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NEW LAPTOP Accessories CD ROM  ID = 31  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Dell",
            "Acer",
            "Lenovo",
            "Fujitsu",
            "Samsung",
            "Ease",
            "IBM",
            "Toshiba",
            "Apple",
            "Google Chrome",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 291,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "CD ROM",
            "DVD ROM",
            "DVD RW",







        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 294,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Laptop CD ROM",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 293,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Size values 

        $computer_accessories_size_values = [
            "Normal",








        ];

        $computer_accessories_size_values_data = [];
        foreach ($computer_accessories_size_values as $size) {
            $computer_accessories_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 295,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_size_values_data);



        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Refurb",


        ];

        $computer_accessories_condition_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 296,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);





        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 297,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NETWORK MAIN CATEGORIES NETWORK SWITCHES  ID = 9  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 298,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "100/100 Switch",
            "Giga Switch",
            "PoE Switch Gigabit",
            "10 Giga Ethernet Switch",
            "10 Giga Poe Switch",
            "SFP Giga Switch",
            "SFP10 Giga Switch",







        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 301,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Network Switches",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 300,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);





        //   Ports values 

        $computer_accessories_ports_values = [
            "4 Ports",
            "5 Ports",
            "6 Ports",
            "8 Ports",
            "9 Ports",
            "12 Ports",
            "16 Ports",
            "24 Ports",
            "48 Ports",



        ];

        $computer_accessories_ports_values_data = [];
        foreach ($computer_accessories_ports_values as $ports) {
            $computer_accessories_ports_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 302,
                'values' => $ports,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_ports_values_data);



        //   Ethernet Uplink Ports values 

        $computer_accessories_uplinkport_values = [
            "1 Ethernet 100/100",
            "2 Ethernet 100/100",
            "1 Ethernet Giga",
            "2 Ethernet Giga",
            "4 Ethernet Giga",
            "1 Ethernet 10Giga",
            "2 Ethernet 10Giga",
            "4 Ethernet 10Giga",


        ];

        $computer_accessories_uplinkport_values_data = [];
        foreach ($computer_accessories_uplinkport_values as $uplinkport) {
            $computer_accessories_uplinkport_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 303,
                'values' => $uplinkport,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_uplinkport_values_data);





        //  Fiber Uplink values 

        $computer_accessories_fiber_values = [
            "1 SFP GIGA",
            "2 SFP GIGA",
            "4 SFP GIGA",
            "1 SFP 10 GIGA",
            "2 SFP 10 GIGA",
            "4 SFP 10 GIGA",


        ];

        $computer_accessories_fiber_values_data = [];
        foreach ($computer_accessories_fiber_values as $fiber) {
            $computer_accessories_fiber_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 304,
                'values' => $fiber,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_fiber_values_data);




        //   Sub Type values 

        $computer_accessories_subtype_values = [
            "Manageable",
            "Non Manageable",
            "Websmart",




        ];

        $computer_accessories_subtype_values_data = [];
        foreach ($computer_accessories_subtype_values as $subtype) {
            $computer_accessories_subtype_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 305,
                'values' => $subtype,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_subtype_values_data);



        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",
            "2 YEars",
            "3 YEars",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 306,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);













        // NETWORK MAIN CATEGORIES  FIREWALL  ID = 10  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "Juniper",
            "Sophos",
            "Sonicwall",
            "Forti Gate",
            "Forti Net",
            "Huawei",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 307,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Hardware Firewall",








        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 310,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Firewall",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 309,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "Giga Port",
            "100/100 Port",








        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 311,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);









        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 312,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK MAIN CATEGORIES  Access Point  ID = 11  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 313,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Ceiling AP",
            "Outdoor AP",
            "Outdoor AP pair",
            "Indoor AP",








        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 316,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Access Point",
            "Ap Controller",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 315,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "100 Mbps",
            "1000 Mbps",
            "3 Gps",
            "5 Gps",
            "9.6 Gps",
            "4.5 Gps",








        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 317,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);









        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 318,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // NETWORK MAIN CATEGORIES  Router Gateway  ID = 12  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 319,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Wired Router",
            "Core Router",
            "VPN Router",
            "Wireless Router",
            "Edge Router",








        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 322,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Router",
            "Gateway",



        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 321,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "150",
            "300",
            "450",
            "600",
            "900",
            "1300",








        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 323,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);









        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 324,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NETWORK MAIN CATEGORIES  Load Balancer  ID = 13  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 325,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Core Load Balancer",









        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 328,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Load Balancer",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 327,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "100/100",
            "1 Giga",
            "10 Giga",









        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 329,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);









        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 330,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK MAIN CATEGORIES  KVM SWITCH  ID = 16  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Adder",
            "Aten",
            "Avocent",
            "Belkin",
            "Black Box",
            "Cables to go",
            "Cyber View",
            "Dataprobe",
            "Gefen",
            "Icron",
            "Iogear",
            "Kramer Electronics",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 331,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Core Load Balancer",









        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 334,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Router",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 333,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);




        //   Capacity values 

        $computer_accessories_capacity_values = [
            "100/100",
            "1 Giga",
            "10 Giga",









        ];

        $computer_accessories_capacity_values_data = [];
        foreach ($computer_accessories_capacity_values as $capacity) {
            $computer_accessories_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 335,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_capacity_values_data);









        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 336,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // NETWORK Accesories Patch Cable  ID = 16  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 343,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Handmade 6 Inch",
            "Handmade 12 Inch",
            "1 Meter",
            "2 Meters",
            "3 Meters",
            "5 Meters",
            "10 Meters",









        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 346,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Patch Cable",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 345,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 348,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NETWORK Accesories i/o Jack  ID = 36  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 349,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Cat 6",
            "Cat 7",
            "Cat 5",
            "Rj 11",










        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 352,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "i/o Jack",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 351,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 354,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK Accesories Face Plate  ID = 37  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 355,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Single Face",
            "Double Face",











        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 358,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Face Plate",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 357,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 360,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NETWORK Accesories Back Box  ID = 38  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 361,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "3x3",
            "6x6",











        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 364,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Back Box",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 363,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 366,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NETWORK Accesories RJ-45 Connector  ID = 39  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 367,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Cat 6",
            "Cat 5",
            "Cat 7",











        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 370,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "RJ-45 Connector",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 369,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 372,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // NETWORK Accesories Media Converter  ID = 40  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 373,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Fiber to RJ45 100/100",
            "Fiber to RJ45 Giga",
            "Fiber Converter AB 100/100",
            "Fiber Converter AB Giga",











        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 376,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Media Converter",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 375,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 378,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK Accesories Cable Roll  ID = 41  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 379,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Manual in Feet",
            "Cat 6",
            "Cat 5",
            "Cat 7",











        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 382,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Cable Roll",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 381,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 384,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NETWORK Accesories Network Rack  ID = 42  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 385,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Wall Mount 2U",
            "Wall Mount 4U",
            "Wall Mount 6U",
            "Wall Mount 8/9U",
            "Wall Mount 12U",
            "Floor Rack 19U",
            "Floor Rack 19U",
            "Floor Rack 22U",
            "Floor Rack 27U",
            "Floor Rack 32U",
            "Floor Rack 37U",
            "Floor Rack 42U",











        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 388,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Network Rack",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 387,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 390,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK Accesories POE INjector  ID = 43  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 391,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "100/100",
            "Giga",












        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 394,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Network Rack",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 393,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 396,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // NETWORK Accesories Patch Panel  ID = 44  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 397,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "8 Port Loaded",
            "8 Port Unloaded",
            "16 Ports Loaded",
            "16 Ports Unloaded",
            "24 Ports Loaded",
            "24 Ports Unloaded",













        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 400,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Patch Panel",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 399,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 402,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);





        // NETWORK Accesories Cable Tie  ID = 45  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 403,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "3",
            "6",
            "9",
            "12",














        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 406,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Cable Tie",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 405,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 408,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK Accesories Cable Manager  ID = 46  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 409,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "1 U",
            "2 U",















        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 412,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Cable Manager",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 411,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 414,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);










        // NETWORK Accesories Cable Tray  ID = 47  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 415,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "Manual",















        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 418,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Cable Tray",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 417,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 420,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK Accesories PVC DUCT  ID = 48  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 421,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "16 x 16 mm",
            "16 x 25 mm",
            "25 x 25 mm",
            "25 x 38 mm",
            "40 x 40 mm",
            "40 x 60 mm",
            "80 x 60 mm",















        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 424,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "PVC DUCT",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 423,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 426,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK Accesories PVC PIPE  ID = 49  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 427,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "1 Inch",
            "2 Inch",
            "3 Inch",
            "4 Inch",
            "5 Inch",
            "6 Inch",
            "8 Inch",
            "10 Inch",
            "12 Inch",















        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 430,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "PVC DUCT",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 429,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 432,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // NETWORK Accesories SFP MODULE  ID = 53  values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "HP",
            "Cisco",
            "D-Link",
            "TP-Link",
            "HIK-Vision",
            "Dhaua",
            "HT Network",
            "Ubiquiti",
            "Linksys",
            "IP-Com",
            "TG-Net",
            "Aruba",
            "Others",



        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 451,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   type values 

        $computer_accessories_type_values = [
            "1 Giga Single Mode",
            "1 Giga Dual Mode",
            "10 Giga Single Mode",
            "10 Giga Dual Mode",
















        ];

        $computer_accessories_type_values_data = [];
        foreach ($computer_accessories_type_values as $type) {
            $computer_accessories_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 454,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_type_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "PVC DUCT",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 453,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 456,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);








        // Printer Accessories  ID= 17  Toner ID = 54     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 485,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_toner_condition_values = [
            "New",
            "Used",
            "Pulled",
        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_toner_condition_values as $condition) {
            $computer_accessories_conditon_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 490,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_conditon_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Toner",];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 487,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 491,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // Printer Accessories  ID= 17  Scanner ID = 55     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",
         ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 492,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",
        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 497,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Scanner",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 494,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 498,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // Printer Accessories  ID= 17  Tray ID = 56     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 499,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 504,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Tray",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 501,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 505,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // Printer Accessories  ID= 17  Formatter Card ID = 57     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 506,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",
        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 511,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Formatter Card",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 508,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 512,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);








        // Printer Accessories  ID= 17  Sleeve ID = 58     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 513,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 518,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Sleeve",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 515,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 519,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // Printer Accessories  ID= 17  Heating Unit ID = 59     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 520,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",
        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 525,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Heating Unit",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 522,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 526,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);






        // Printer Accessories  ID= 17  Gear Set ID = 60     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 527,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 532,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Gear Set",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 529,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 533,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);









        // Printer Accessories  ID= 17  Printer Head ID = 61     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 534,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",
        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 539,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Printer Head",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 536,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 540,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // Printer Accessories  ID= 17  Printer Cable ID = 62     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 541,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",


        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 546,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Printer Cable",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 543,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 547,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);








        // Printer Accessories  ID= 17  Roller ID = 63     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 548,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 553,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Roller",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 550,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 554,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // Printer Accessories  ID= 17  Pickup Roller ID = 64     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 555,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",

        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 560,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Pickup Roller",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 557,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 561,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);







        // Printer Accessories  ID= 17  Front Panel ID = 65     values Start 

        //   Brand values 

        $computer_accessories_brand_values = [
            "Samsung",
            "Hp",
            "Epson",
            "Canon",
            "Plustek",
            "Others",




        ];

        $computer_accessories_brand_values_data = [];
        foreach ($computer_accessories_brand_values as $brand) {
            $computer_accessories_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 562,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_brand_values_data);




        //   Condition values 

        $computer_accessories_condition_values = [
            "New",
            "Used",
            "Pulled",
        ];

        $computer_accessories_conditon_values_data = [];
        foreach ($computer_accessories_condition_values as $condition) {
            $computer_accessories_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 567,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_condition_values_data);



        //   Product Name values 

        $computer_accessories_product_values = [
            "Front Panel",




        ];

        $computer_accessories_product_values_data = [];
        foreach ($computer_accessories_product_values as $product) {
            $computer_accessories_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 564,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_product_values_data);








        //   Warranty values 

        $computer_accessories_warranty_values = [
            "Check Warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "1 YEar",



        ];

        $computer_accessories_warranty_values_data = [];
        foreach ($computer_accessories_warranty_values as $warranty) {
            $computer_accessories_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 568,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($computer_accessories_warranty_values_data);




        // ========================= printer Accessories   warranty values end =========





        // ========================== from security start here =========================

        // CCTV Camera 
        // brand name 

        $security_brand_values = [
            "HT- Network",
            "Hikvision",
            "Dahua",
            "Uniview",
            "CP-Plus",
            "D-Link",
            "Samsung",
            "Honeywell",
            "Panasonic"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 569,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);



        // product name 

        $security_product_values = [
            "Analog Camera",
            "IP Camera"
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 571,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);






        // type name 

        $security_type_values = [
            "Dome Camera",
            "Bullet Camera",
            "PTZ Camera",
            "WiFi Camera",
            "Hidden Camera",
            "Fish Eye Camera",
            "Dashboard Camera"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 572,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);





        // capacity name 

        $security_capacity_values = [
            "1 Megapixel",
            "2 Megapixel",
            "3 Megapixel",
            "4 Megapixel",
            "5 Megapixel",
            "6 Megapixel",
            "8 Megapixel",
            "10 Megapixel",
            "12 Megapixel",
            "14 Megapixel",
            "16 Megapixel",
            "18 Megapixel"
        ];

        $security_capacity_values_data = [];
        foreach ($security_capacity_values as $capacity) {
            $security_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 573,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_capacity_values_data);





        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 574,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);






        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 575,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);









        // DVR/NVR Camera 


        // brand name 

        $security_brand_values = [
            "HT- Network",
            "Hikvision",
            "Dahua",
            "Uniview",
            "CP-Plus",
            "D-Link",
            "Samsung",
            "Honeywell",
            "Panasonic"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 576,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);





        // product name 

        $security_product_values = [
            "DVR",
            "NVR",
            "XVR"
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 578,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);









        // type name 

        $security_type_values = [
            "4 Port",
            "8 Port",
            "9 Port",
            "12 Port",
            "16 Port",
            "24 Port",
            "32 Port",
            "64 Port",
            "128 Port"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 579,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);








        // capacity name 

        $security_capacity_values = [
            "1 Megapixel",
            "2 Megapixel",
            "3 Megapixel",
            "4 Megapixel",
            "5 Megapixel",
            "6 Megapixel",
            "8 Megapixel",
            "10 Megapixel",
            "12 Megapixel",
            "14 Megapixel",
            "16 Megapixel",
            "18 Megapixel"
        ];

        $security_capacity_values_data = [];
        foreach ($security_capacity_values as $capacity) {
            $security_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 580,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_capacity_values_data);









        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 581,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);








        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 582,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);




        // Surveillance HDD


        // brand name 

        $security_brand_values = [
            "Seagate",
            "Toshiba",
            "Western Digital",
            "HIKVision",
            "Dahua",
            "Others"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 583,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);





        // product name 

        $security_product_values = [
            "Surveillance HDD",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 585,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);





        // type name 

        $security_type_values = [
            "SATA",
            "E-SATA"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 586,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);




        // capacity name 

        $security_capacity_values = [
            "500GB",
            "750GB",
            "1TB",
            "2TB",
            "4TB",
            "8TB",
            "16TB",
            "32TB"
        ];

        $security_capacity_values_data = [];
        foreach ($security_capacity_values as $capacity) {
            $security_capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 587,
                'values' => $capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_capacity_values_data);





        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 588,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);







        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 589,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);





        // walkthrough Gate


        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "Black Copper",
            "Garrett",
            "Others"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 590,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);




        // product name 

        $security_product_values = [
            "Metal Detectors Gates",
            "Turnstile Gates",
            "Swing Gates",
            "Sliding Gates",
            "Barrier Gates"
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 592,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);




        // Capacity name 

        $security_Capacity_values = [
            "500GB",
            "750GB",
            "1TB",
            "2TB",
            "4TB",
            "8TB",
            "16TB",
            "32TB"
        ];

        $security_Capacity_values_data = [];
        foreach ($security_Capacity_values as $Capacity) {
            $security_Capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 594,
                'values' => $Capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_Capacity_values_data);




        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 595,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);




        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 596,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);




        // Metal Detector 

        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "Black Copper",
            "Garrett",
            "Others"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 597,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);



        // product name 

        $security_product_values = [
            "Hand Held",
            "For Vehicle"
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 599,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);



        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 602,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);




        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 603,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);



        // Baggage Scanner 


        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "Black Copper",
            "Garrett",
            "Others"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 604,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);




        // product name 

        $security_product_values = [
            "Baggage Scanner",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 606,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);



        // type name 

        $security_type_values = [
            "X-ray Scanner",
            "Single View",
            "Dual View",
            "CT-Scanner"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 607,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);




        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 609,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);




        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 610,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);






        // Biometric Device 



        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "AMT",
            "Garrett",
            "Digital Persona"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 611,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);




        // product name 

        $security_product_values = [
            "BioMetric Device",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 613,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);





        // type name 

        $security_type_values = [
            "Secure Access",
            "Attendance Device",
            "Sub Access Device",
            "USB Bio Scanner",
            "Others"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 614,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);





        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 616,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);




        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 617,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);






        // Road Blockers 

        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "AMT",
            "Garrett",
            "Digital Persona",
            "Local"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 618,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);



        // product name 

        $security_product_values = [
            "Raod Blocker",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 620,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);





        // type name 

        $security_type_values = [
            "Manual Road Blocker",
            "Hydraulic Road Blocker"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 621,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);



        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 623,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);




        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 624,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);








        // security Accessories 




        // BNC Connector


        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "AMT",
            "Garrett",
            "Digital Persona",
            "Local"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 625,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);

        // product name 

        $security_product_values = [
            "BNC Connector",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 627,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);

        // type name 

        $security_type_values = [
            "BNC Connector Single",
            "BNC Cable"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 628,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);

        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 630,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);


        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 631,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);










        // CCTV Cable


        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "AMT",
            "Garrett",
            "Digital Persona",
            "Local"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 632,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);

        // product name 

        $security_product_values = [
            "CCTV Cable",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 634,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);

        // type name 

        $security_type_values = [
            "RG-6",
            "RG-7",
            "RG-9",
            "2 Core CCTV Cable"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 635,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);

        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 637,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);


        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 638,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);






        //Push Button


        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "AMT",
            "Garrett",
            "Digital Persona",
            "Local"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 639,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);

        // product name 

        $security_product_values = [
            "Push Button",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 641,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);

        // type name 

        $security_type_values = [
            "Plastic Button",
            "Metal Button"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 642,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);

        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 644,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);


        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 645,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);








        // PTZ Controller


        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "AMT",
            "Garrett",
            "Digital Persona",
            "Local"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 646,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);

        // product name 

        $security_product_values = [
            "PTZ Controller",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 648,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);

        // type name 

        $security_type_values = [
            "IP Based",
            "Analogue Base"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 649,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);

        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 651,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);


        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 652,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);













        // Locks


        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "AMT",
            "Garrett",
            "Digital Persona",
            "Local"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 653,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);

        // product name 

        $security_product_values = [
            "Locks",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 655,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);

        // type name 

        $security_type_values = [
            "Magnetic Lock",
            "Bullet Lock"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 656,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);

        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 658,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);


        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 659,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);








        // Power Supply


        // brand name 

        $security_brand_values = [
            "ZK Teco",
            "AMT",
            "Garrett",
            "Digital Persona",
            "Local"
        ];

        $security_brand_values_data = [];
        foreach ($security_brand_values as $brand) {
            $security_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 660,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_brand_values_data);

        // product name 

        $security_product_values = [
            "Power Supply",
        ];

        $security_product_values_data = [];
        foreach ($security_product_values as $product) {
            $security_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 662,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_product_values_data);

        // type name 

        $security_type_values = [
            "1 Amp",
            "2 Amp",
            "3 Amp",
            "4 Amp",
            "5 Amp",
            "10 Amp",
            "15 Amp",
            "20 Amp"
        ];

        $security_type_values_data = [];
        foreach ($security_type_values as $type) {
            $security_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 663,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_type_values_data);

        // condition name 

        $security_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $security_condition_values_data = [];
        foreach ($security_condition_values as $condition) {
            $security_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 665,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_condition_values_data);


        // warranty name 

        $security_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $security_warranty_values_data = [];
        foreach ($security_warranty_values as $warranty) {
            $security_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 666,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($security_warranty_values_data);




        // ========================== from security end here =========================









        // ========================== from Projectors start here =========================


        // brand name 

        $projector_brand_values = [
            "Samsung",
            "Toshiba",
            "Epson",
            "Optoma",
            "Panasonic",
            "Viewsonic",
            "Sony",
            "HP",
            "Canon",
            "LG",
            "Acer",
            "Infocus"
        ];

        $projector_brand_values_data = [];
        foreach ($projector_brand_values as $brand) {
            $projector_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 667,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_brand_values_data);






        // product name 

        $projector_product_values = [
            "Projector"
        ];

        $projector_product_values_data = [];
        foreach ($projector_product_values as $product_name) {
            $projector_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 669,
                'values' => $product_name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_product_values_data);




        // type name 

        $projector_type_values = [
            "DLP",
            "LCD",
            "LED",
            "LCOS",
            "LASER"
        ];

        $projector_type_values_data = [];
        foreach ($projector_type_values as $type) {
            $projector_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 670,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_type_values_data);






        // Lumens name 

        $projector_lumens_values = [
            "1000",
            "1200",
            "1500",
            "1800",
            "2000",
            "2200",
            "2400",
            "2600",
            "2800",
            "3000",
            "3200",
            "3400",
            "5000",
            "6000",
            "7000"
        ];

        $projector_lumens_values_data = [];
        foreach ($projector_lumens_values as $type) {
            $projector_lumens_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 671,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_lumens_values_data);





        // condition name 

        $projector_condition_values = [
            "USED",
            "NEW",
            "Pulled",
        ];

        $projector_condition_values_data = [];
        foreach ($projector_condition_values as $type) {
            $projector_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 672,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_condition_values_data);





        // warranty name 

        $projector_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Months",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Year",
            "3 Year"

        ];

        $projector_warranty_values_data = [];
        foreach ($projector_warranty_values as $type) {
            $projector_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 673,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_warranty_values_data);




        //               projector scree 



        // brand name 

        $projector_brand_values = [
            "Samsung",
            "Toshiba",
            "Epson",
            "Optoma",
            "Panasonic",
            "Viewsonic",
            "Sony",
            "HP",
            "Canon",
            "LG",
            "Acer",
            "Infocus",
            "Others"

        ];

        $projector_brand_values_data = [];
        foreach ($projector_brand_values as $type) {
            $projector_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 674,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_brand_values_data);


        // product name 

        $projector_product_values = [
            "Projector Screen",

        ];

        $projector_product_values_data = [];
        foreach ($projector_product_values as $type) {
            $projector_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 676,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_product_values_data);








        // type name 

        $projector_type_values = [
            "Tripods",
            "Fix Screen",
            "Floor Screen",
            "Retractable Screen",
            "Electric Screen"

        ];

        $projector_type_values_data = [];
        foreach ($projector_type_values as $type) {
            $projector_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 677,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_type_values_data);






        // size name 

        $projector_size_values = [
            "6x6",
            "6x8",
            "6x10",
            "6x12",
            "8x8",
            "8x10",
            "8x12"

        ];

        $projector_size_values_data = [];
        foreach ($projector_size_values as $size) {
            $projector_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 678,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_size_values_data);





        // condition name 

        $projector_condition_values = [
            "USED",
            "NEW",
            "Pulled"

        ];

        $projector_condition_values_data = [];
        foreach ($projector_condition_values as $condition) {
            $projector_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 679,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_condition_values_data);






        // warranty name 

        $projector_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"

        ];

        $projector_warranty_values_data = [];
        foreach ($projector_warranty_values as $warranty) {
            $projector_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 680,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_warranty_values_data);





        // Projector Stands


        // brand name 

        $projector_brand_values = [
            "Branded",
            "Local",
            "Others"

        ];

        $projector_brand_values_data = [];
        foreach ($projector_brand_values as $brand) {
            $projector_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 681,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_brand_values_data);




        // product name 

        $projector_product_values = [
            "Projector Stands",

        ];

        $projector_product_values_data = [];
        foreach ($projector_product_values as $product) {
            $projector_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 683,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_product_values_data);



        // type name 

        $projector_type_values = [
            "Tripods",
            "Wall Mount",
            "Ceiling Mount"

        ];

        $projector_type_values_data = [];
        foreach ($projector_type_values as $type) {
            $projector_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 684,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_type_values_data);





        // condition name 

        $projector_condition_values = [
            "USED",
            "NEW",
            "Pulled"

        ];

        $projector_condition_values_data = [];
        foreach ($projector_condition_values as $condition) {
            $projector_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 686,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_condition_values_data);




        // warranty name 

        $projector_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month"

        ];

        $projector_warranty_values_data = [];
        foreach ($projector_warranty_values as $warranty) {
            $projector_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 687,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($projector_warranty_values_data);


        // ========================== from Projectors end here =========================














        // ========================== from Scanners start here =========================

        // brand name 

        $scanner_brand_values = [
            "Samsung",
            "Plustek",
            "Epson",
            "HP",
            "Canon",
            "Others"

        ];

        $scanner_brand_values_data = [];
        foreach ($scanner_brand_values as $brand) {
            $scanner_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 688,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($scanner_brand_values_data);





        // product name 

        $scanner_product_values = [
            "Scanners",

        ];

        $scanner_product_values_data = [];
        foreach ($scanner_product_values as $product) {
            $scanner_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 690,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($scanner_product_values_data);






        // type name 

        $scanner_type_values = [
            "Flatbed Scanners",
            "Sheetfed Scanners",
            "Negative Scanners",
            "Iris Scanners",
            "Handheld Portable Scanners",
            "Barcode Scanners",
            "Book Scanners"
        ];

        $scanner_type_values_data = [];
        foreach ($scanner_type_values as $type) {
            $scanner_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 691,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($scanner_type_values_data);




        // size name 

        $scanner_size_values = [
            "A4",
            "A3",
            "Legal",
            "Others"
        ];

        $scanner_size_values_data = [];
        foreach ($scanner_size_values as $size) {
            $scanner_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 692,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($scanner_size_values_data);




        // condition name 

        $scanner_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $scanner_condition_values_data = [];
        foreach ($scanner_condition_values as $condition) {
            $scanner_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 693,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($scanner_condition_values_data);






        // warranty name 

        $scanner_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $scanner_warranty_values_data = [];
        foreach ($scanner_warranty_values as $warranty) {
            $scanner_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 694,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($scanner_warranty_values_data);

        // ========================== from Scanners end here =========================















        // ========================== from Mobile/Tablet start here =========================

        // brand name 

        $mobile_tablet_brand_values = [
            "Samsung",
            "Huawei",
            "Nokia",
            "Apple",
            "Sony",
            "Others"
        ];

        $mobile_tablet_brand_values_data = [];
        foreach ($mobile_tablet_brand_values as $brand) {
            $mobile_tablet_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 695,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($mobile_tablet_brand_values_data);




        // product name 

        $mobile_tablet_product_values = [
            "Mobile",
            "Tablets"
        ];

        $mobile_tablet_product_values_data = [];
        foreach ($mobile_tablet_product_values as $product) {
            $mobile_tablet_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 697,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($mobile_tablet_product_values_data);





        // type name 

        $mobile_tablet_type_values = [
            "Touch Screen",
            "Keypad",
            "Wifi Only",
            "4G",
            "5G"
        ];

        $mobile_tablet_type_values_data = [];
        foreach ($mobile_tablet_type_values as $type) {
            $mobile_tablet_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 698,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($mobile_tablet_type_values_data);





        // size name 

        $mobile_tablet_size_values = [
            "Touch Screen",
            "Keypad",
            "Wifi Only",
            "4G",
            "5G"
        ];

        $mobile_tablet_size_values_data = [];
        foreach ($mobile_tablet_size_values as $size) {
            $mobile_tablet_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 699,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($mobile_tablet_size_values_data);





        // condition name 

        $mobile_tablet_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $mobile_tablet_condition_values_data = [];
        foreach ($mobile_tablet_condition_values as $condition) {
            $mobile_tablet_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 700,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($mobile_tablet_condition_values_data);





        // warranty name 

        $mobile_tablet_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $mobile_tablet_warranty_values_data = [];
        foreach ($mobile_tablet_warranty_values as $warranty) {
            $mobile_tablet_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 701,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($mobile_tablet_warranty_values_data);



        // ========================== from Mobile/Tablet end here =========================












        // ========================== from Tools start here =========================

        // brand name 

        $tool_brand_values = [
            "Hilti",
            "Bosch",
            "Local",
            "Others"
        ];

        $tool_brand_values_data = [];
        foreach ($tool_brand_values as $brand) {
            $tool_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 702,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($tool_brand_values_data);





        // product name 

        $tool_product_values = [
            "Tools",
        ];

        $tool_product_values_data = [];
        foreach ($tool_product_values as $product) {
            $tool_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 704,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($tool_product_values_data);




        // type name 

        $tool_type_values = [
            "Wire Stripper",
            "Wire Cutter",
            "Crimping Tool",
            "Cable Tester",
            "Cable Punching",
            "Cable Tracer",
            "Multimeter",
            "Plier",
            "Nose Plier",
            "Screw Driver",
            "Insert Key",
            "L Key Set",
            "Multi Bits Tool Set",
            "Tuser",
            "Tuser Set",
            "Paper Cutter",
            "Other"
        ];

        $tool_type_values_data = [];
        foreach ($tool_type_values as $type) {
            $tool_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 705,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($tool_type_values_data);





        // size name 

        $tool_size_values = [
            "Long",
            "Medium",
            "Small",
            "Others"
        ];

        $tool_size_values_data = [];
        foreach ($tool_size_values as $size) {
            $tool_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 706,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($tool_size_values_data);




        // condition name 

        $tool_condition_values = [
            "USED",
            "NEW",
        ];

        $tool_condition_values_data = [];
        foreach ($tool_condition_values as $condition) {
            $tool_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 707,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($tool_condition_values_data);




        // warranty name 

        $tool_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $tool_warranty_values_data = [];
        foreach ($tool_warranty_values as $warranty) {
            $tool_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 708,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($tool_warranty_values_data);


        // ========================== from Tools end here =========================






        // ========================== from Electronics start here =========================


        // tv category of electronic

        // brand name 

        $electronics_brand_values = [
            "Samsung",
            "Ecostar",
            "Sony",
            "TCL",
            "Panasonic",
            "LG",
            "Others"
        ];

        $electronics_brand_values_data = [];
        foreach ($electronics_brand_values as $brand) {
            $electronics_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 709,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_brand_values_data);




        // product name 

        $electronics_product_values = [
            "TV",
        ];

        $electronics_product_values_data = [];
        foreach ($electronics_product_values as $product) {
            $electronics_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 711,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_product_values_data);





        // type name 

        $electronics_type_values = [
            "Normal TV",
            "Smart TV",
            "Android TV"
        ];

        $electronics_type_values_data = [];
        foreach ($electronics_type_values as $type) {
            $electronics_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 712,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_type_values_data);





        // size name 

        $electronics_size_values = [
            "22\"",
            "27\"",
            "32\"",
            "37\"",
            "39\"",
            "40\"",
            "41\"",
            "42\"",
            "43\"",
            "47\"",
            "50\"",
            "55\"",
            "60\"",
            "65\"",
            "70\"",
            "75\"",
            "85\"",
            "90\"",
            "100\""
        ];

        $electronics_size_values_data = [];
        foreach ($electronics_size_values as $size) {
            $electronics_size_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 713,
                'values' => $size,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_size_values_data);




        // condition name 

        $electronics_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $electronics_condition_values_data = [];
        foreach ($electronics_condition_values as $condition) {
            $electronics_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 714,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_condition_values_data);





        // warranty name 

        $electronics_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $electronics_warranty_values_data = [];
        foreach ($electronics_warranty_values as $warranty) {
            $electronics_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 715,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_warranty_values_data);




        // Air Purifier


        // brand name 

        $electronics_brand_values = [
            "Samsung",
            "Ecostar",
            "Sony",
            "Blueair",
            "MI",
            "Philips",
            "Others"
        ];

        $electronics_brand_values_data = [];
        foreach ($electronics_brand_values as $brand) {
            $electronics_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 716,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_brand_values_data);




        // product name 

        $electronics_product_values = [
            "Air Purifier",
            "Filter"
        ];

        $electronics_product_values_data = [];
        foreach ($electronics_product_values as $product) {
            $electronics_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 718,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_product_values_data);






        // type name 

        $electronics_type_values = [
            "HEPA Purifiers",
            "Adsorbent Purifiers",
            "UV Purifiers",
            "Ionic Purifiers",
            "Ozone Generators"
        ];

        $electronics_type_values_data = [];
        foreach ($electronics_type_values as $type) {
            $electronics_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 719,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_type_values_data);





        // condition name 

        $electronics_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $electronics_condition_values_data = [];
        foreach ($electronics_condition_values as $condition) {
            $electronics_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 721,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_condition_values_data);




        // warranty name 

        $electronics_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $electronics_warranty_values_data = [];
        foreach ($electronics_warranty_values as $warranty) {
            $electronics_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 722,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_warranty_values_data);







        // Digital Cameras 


        // brand name 

        $electronics_brand_values = [
            "Samsung",
            "Sony",
            "LG",
            "Philips",
            "Canon",
            "Nikon",
            "Others"
        ];

        $electronics_brand_values_data = [];
        foreach ($electronics_brand_values as $brand) {
            $electronics_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 723,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_brand_values_data);







        // product name 

        $electronics_product_values = [
            "Digital Camera",
            "DSLR"
        ];

        $electronics_product_values_data = [];
        foreach ($electronics_product_values as $product) {
            $electronics_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 725,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_product_values_data);





        // pixel name 

        $electronics_pixel_values = [
            "2 Mega",
            "4 Mega",
            "6 Mega",
            "8 Mega",
            "10 Mega",
            "12 Mega"
        ];

        $electronics_pixel_values_data = [];
        foreach ($electronics_pixel_values as $pixel) {
            $electronics_pixel_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 727,
                'values' => $pixel,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_pixel_values_data);





        // condition name 

        $electronics_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $electronics_condition_values_data = [];
        foreach ($electronics_condition_values as $condition) {
            $electronics_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 728,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_condition_values_data);





        // warranty name 

        $electronics_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $electronics_warranty_values_data = [];
        foreach ($electronics_warranty_values as $warranty) {
            $electronics_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 729,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($electronics_warranty_values_data);











        // ========================== from Electronics end here =========================
















        // ========================== from PA SYSTEMS START here =========================


        // PA SPEAKERS 

        // brand name 

        $pa_system_brand_values = [
            "Samsung",
            "TOA",
            "Bosch",
            "Honeywell",
            "ITC",
            "Others"
        ];

        $pa_system_brand_values_data = [];
        foreach ($pa_system_brand_values as $brand) {
            $pa_system_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 730,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_brand_values_data);





        // product name 

        $pa_system_product_values = [
            "PA SPEAKERS",
        ];

        $pa_system_product_values_data = [];
        foreach ($pa_system_product_values as $product) {
            $pa_system_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 732,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_product_values_data);



        // type name 

        $pa_system_type_values = [
            "Ceiling Speaker",
            "Column Speaker",
            "Wall Mount Speaker",
            "Outdoor Speaker",
            "Horn Speaker",
            "IP Speakers",
            "Loud Speakers"
        ];

        $pa_system_type_values_data = [];
        foreach ($pa_system_type_values as $type) {
            $pa_system_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 733,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_type_values_data);






        // watt name 

        $pa_system_watt_values = [
            "3W",
            "5W",
            "6W",
            "9W",
            "12W",
            "20W",
            "25W",
            "30W",
            "60W",
            "120W",
            "200W"
        ];

        $pa_system_watt_values_data = [];
        foreach ($pa_system_watt_values as $watt) {
            $pa_system_watt_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 734,
                'values' => $watt,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_watt_values_data);







        // condition name 

        $pa_system_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $pa_system_condition_values_data = [];
        foreach ($pa_system_condition_values as $condition) {
            $pa_system_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 735,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_condition_values_data);






        // warranty name 

        $pa_system_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $pa_system_warranty_values_data = [];
        foreach ($pa_system_warranty_values as $warranty) {
            $pa_system_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 736,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_warranty_values_data);




        // Amplifier 



        // brand name 

        $pa_system_brand_values = [
            "Samsung",
            "TOA",
            "Bosch",
            "Honeywell",
            "ITC",
            "Others"
        ];

        $pa_system_brand_values_data = [];
        foreach ($pa_system_brand_values as $brand) {
            $pa_system_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 737,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_brand_values_data);





        // product name 

        $pa_system_product_values = [
            "Amplifier",
        ];

        $pa_system_product_values_data = [];
        foreach ($pa_system_product_values as $product) {
            $pa_system_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 739,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_product_values_data);




        // type name 

        $pa_system_type_values = [
            "PA Amplifier",
            "BGM Amplifier",
            "Zone Controller Amplifier",
            "Multimedia Amplifier",
            "Others"
        ];

        $pa_system_type_values_data = [];
        foreach ($pa_system_type_values as $type) {
            $pa_system_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 740,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_type_values_data);





        // watt name 

        $pa_system_watt_values = [
            "45W",
            "60W",
            "90W",
            "120W",
            "180W",
            "240W",
            "280W",
            "320W",
            "420W",
            "480W",
            "500W",
            "540W",
            "620W",
            "700W",
            "880W"
        ];

        $pa_system_watt_values_data = [];
        foreach ($pa_system_watt_values as $watt) {
            $pa_system_watt_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 741,
                'values' => $watt,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_watt_values_data);





        // condition name 

        $pa_system_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $pa_system_condition_values_data = [];
        foreach ($pa_system_condition_values as $condition) {
            $pa_system_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 742,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_condition_values_data);





        // warranty name 

        $pa_system_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $pa_system_warranty_values_data = [];
        foreach ($pa_system_warranty_values as $warranty) {
            $pa_system_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 743,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_warranty_values_data);




        // MIC 
        // brand name 

        $pa_system_brand_values = [
            "Samsung",
            "TOA",
            "Bosch",
            "Honeywell",
            "ITC",
            "Others"
        ];

        $pa_system_brand_values_data = [];
        foreach ($pa_system_brand_values as $brand) {
            $pa_system_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 744,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_brand_values_data);





        // product name 

        $pa_system_product_values = [
            "MIC",
        ];

        $pa_system_product_values_data = [];
        foreach ($pa_system_product_values as $product) {
            $pa_system_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 746,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_product_values_data);





        // type name 

        $pa_system_type_values = [
            "Stand Alone",
            "Zone Controller Mic",
            "LAN Mic",
            "Others"
        ];

        $pa_system_type_values_data = [];
        foreach ($pa_system_type_values as $type) {
            $pa_system_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 747,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_type_values_data);





        // watt name 

        $pa_system_watt_values = [
            "45W",
            "60W",
            "90W"
        ];

        $pa_system_watt_values_data = [];
        foreach ($pa_system_watt_values as $watt) {
            $pa_system_watt_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 748,
                'values' => $watt,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_watt_values_data);





        // condition name 

        $pa_system_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $pa_system_condition_values_data = [];
        foreach ($pa_system_condition_values as $condition) {
            $pa_system_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 749,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_condition_values_data);





        // warranty name 

        $pa_system_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year"
        ];

        $pa_system_warranty_values_data = [];
        foreach ($pa_system_warranty_values as $warranty) {
            $pa_system_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 750,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($pa_system_warranty_values_data);




        // ========================== from PA SYSTEMS end here =========================







        // ========================== from Telephony start here =========================




        // Exchange


        // brand name 

        $telephony_brand_values = [
            "Panasonic",
            "Alcatel",
            "Avaya",
            "Grandstream",
            "Yeastar",
            "Cisco",
            "Yealink",
            "Others"
        ];

        $telephony_brand_values_data = [];
        foreach ($telephony_brand_values as $brand) {
            $telephony_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 751,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_brand_values_data);



        // product name 

        $telephony_product_values = [
            "Telephonce Exchange",
        ];

        $telephony_product_values_data = [];
        foreach ($telephony_product_values as $product) {
            $telephony_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 753,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_product_values_data);





        // type name 

        $telephony_type_values = [
            "Analogue",
            "IP Exchange"
        ];

        $telephony_type_values_data = [];
        foreach ($telephony_type_values as $type) {
            $telephony_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 754,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_type_values_data);





        // condition name 

        $telephony_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $telephony_condition_values_data = [];
        foreach ($telephony_condition_values as $condition) {
            $telephony_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 756,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_condition_values_data);





        // warranty name 

        $telephony_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $telephony_warranty_values_data = [];
        foreach ($telephony_warranty_values as $warranty) {
            $telephony_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 757,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_warranty_values_data);







        // Telephone Set 

        // brand name 

        $telephony_brand_values = [
            "Panasonic",
            "Alcatel",
            "Avaya",
            "Grandstream",
            "Yeastar",
            "Cisco",
            "D-Link",
            "Fanvil",
            "Yealink",
            "Others"
        ];

        $telephony_brand_values_data = [];
        foreach ($telephony_brand_values as $brand) {
            $telephony_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 758,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_brand_values_data);





        // product name 

        $telephony_product_values = [
            "Telephone Set",
        ];

        $telephony_product_values_data = [];
        foreach ($telephony_product_values as $product) {
            $telephony_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 760,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_product_values_data);





        // type name 

        $telephony_type_values = [
            "Analogue",
            "IP Exchange"
        ];

        $telephony_type_values_data = [];
        foreach ($telephony_type_values as $type) {
            $telephony_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 761,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_type_values_data);





        // Capacity name 

        $telephony_Capacity_values = [
            "Audio Phone",
            "Video Phone",
            "Audio Conference"
        ];

        $telephony_Capacity_values_data = [];
        foreach ($telephony_Capacity_values as $Capacity) {
            $telephony_Capacity_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 762,
                'values' => $Capacity,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_Capacity_values_data);





        // condition name 

        $telephony_condition_values = [
            "USED",
            "NEW",
            "Pulled"
        ];

        $telephony_condition_values_data = [];
        foreach ($telephony_condition_values as $condition) {
            $telephony_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 763,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_condition_values_data);







        // warranty name 

        $telephony_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $telephony_warranty_values_data = [];
        foreach ($telephony_warranty_values as $warranty) {
            $telephony_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 764,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($telephony_warranty_values_data);





        // Video Conference

        // brand name 

        $video_conference_brand_values = [
            "Panasonic",
            "Alcatel",
            "Avaya",
            "Grandstream",
            "Yeastar",
            "Cisco",
            "D-Link",
            "Fanvil",
            "Yealink",
            "Logitech",
            "Others"
        ];

        $video_conference_brand_values_data = [];
        foreach ($video_conference_brand_values as $brand) {
            $video_conference_brand_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 765,
                'values' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($video_conference_brand_values_data);





        // product name 

        $video_conference_product_values = [
            "Video Conference",
        ];

        $video_conference_product_values_data = [];
        foreach ($video_conference_product_values as $product) {
            $video_conference_product_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 767,
                'values' => $product,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($video_conference_product_values_data);






        // type name 

        $video_conference_type_values = [
            "IPBAsed",
            "Software based"

        ];

        $video_conference_type_values_data = [];
        foreach ($video_conference_type_values as $type) {
            $video_conference_type_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 768,
                'values' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($video_conference_type_values_data);





        // condition name 

        $video_conference_condition_values = [
            "USED",
            "NEW",
            "Pulled"

        ];

        $video_conference_condition_values_data = [];
        foreach ($video_conference_condition_values as $condition) {
            $video_conference_condition_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 770,
                'values' => $condition,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($video_conference_condition_values_data);







        // warranty name 

        $video_conference_warranty_values = [
            "Check warranty",
            "15 Days",
            "1 Month",
            "3 Months",
            "6 Months",
            "9 Months",
            "1 Year",
            "2 Years",
            "3 Years"
        ];

        $video_conference_warranty_values_data = [];
        foreach ($video_conference_warranty_values as $warranty) {
            $video_conference_warranty_values_data[] = [
                'category_id'                  => null,
                'sub_category_id'              => null,
                'child_category_id'            => null,
                'category_specification_id'    => 771,
                'values' => $warranty,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specification_details')->insert($video_conference_warranty_values_data);





        // ========================== from Telephony end here =========================













    }
}
