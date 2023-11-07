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
                'category_specification_label' => $brand,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_brand_data);



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
                'category_specification_label' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_type_data);





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
                'category_specification_label' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_core_data);




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
                'category_specification_label' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_ram_data);




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
                'category_specification_label' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_generation_data);

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
                'category_specification_label' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_ssd_data);





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
                'category_specification_label' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_hdd_data);



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
                'category_specification_label' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_condition_data);




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
                'category_specification_label' => $type,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('category_specifications')->insert($computercategory_warranty_data);
    }
}
