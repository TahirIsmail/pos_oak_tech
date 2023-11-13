<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ChildCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Computer Child Categories (Accessories) Seeders Start
        $childComputerCategories = [
            'LCD/LED',
            'Ram',
            'Keyboard',
            'Mouse',
            'Combo Keyboard/Mouse',
            'Processor',
            'Power Supply',
            'Power Cable',
            'VGA Cable',
            'Motherboard',
            'Graphic Cards',
            'External Hdd/Sdd',
            'Lan Card',
            'Convertors',
            'Webcam',
            'Headphones',
            'Hard Disk',
            'SSD SATA 2.5',
            'CD-Rom',
        ];
        $ComputerChildcategoryData = [];
        foreach ($childComputerCategories as $category) {
            $ComputerChildcategoryData[] = [
                'sub_category_id' => 1,
                'child_category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('child_categories')->insert($ComputerChildcategoryData);


        // Computer Child Categories (Accessories) Seeders End




        // Laptop Child Categories (Accessories) Seeders Start
        $childLaptopCategories = [
            'Batteries',
            'LCD/LED',
            'Ram',
            'Keyboard',
            'Mouse Pad',
            'Power Adopter',
            'Power Cable',
            'Display Cable',
            'Motherboard',
            'Hard Disk',
            'SSD SATA Nvme',
            'CD-Rom',
            'ABCD Panel',
            'Hangies',
            'Bags',
        ];
        $LaptopChildcategoryData = [];
        foreach ($childLaptopCategories as $category) {
            $LaptopChildcategoryData[] = [
                'sub_category_id' => 6,
                'child_category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('child_categories')->insert($LaptopChildcategoryData);
        // Laptop Child Categories (Accessories) Seeders End






        // Network Child Categories (Accessories) Seeders Start
        $childNetworkCategories = [
            'Patch Cable',
            'i/o jack',
            'Faceplate',
            'Back Box',
            'Rj-45 Connector',
            'Media Convertor',
            'Cable Roll',
            'Network Rack',
            'PoE Injector',
            'Patch Panel',
            'Cable Tie',
            'Cable Manager',
            'Cable Tray',
            'PVC Duct',
            'PVC Pipe',
            'Flexible Pipe',
            'Screw Box',
            'Rawal Plug Box',
            'SFP Module',
        ];
        $NetworkChildcategoryData = [];
        foreach ($childNetworkCategories as $category) {
            $NetworkChildcategoryData[] = [
                'sub_category_id' => 8,
                'child_category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('child_categories')->insert($NetworkChildcategoryData);
        // Network Child Categories (Accessories) Seeders End




        // Printer Child Categories (Accessories) Seeders Start
        $childPrinterCategories = [
            'Toner',
            'Scanner',
            'Tray',
            'Formatter Card',
            'Sleeve',
            'Heating Unit',
            'Gear Set',
            'Printer Head',
            'Printer Cable',
            'Roller',
            'Pickup Roller',
            'Front Panel',
        ];
        $PrinterChildcategoryData = [];
        foreach ($childPrinterCategories as $category) {
            $PrinterChildcategoryData[] = [
                'sub_category_id' => 17,
                'child_category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('child_categories')->insert($PrinterChildcategoryData);
        // Printer Child Categories (Accessories) Seeders End





        // Security Child Categories (Accessories) Seeders Start
        $childSecurityCategories = [
            "BNC Connector",
            "CCTV Cable",
            "Power Supply",
            "Push Button",
            "PTZ Controller",
            "Locks"
        ];
        $SecurityChildcategoryData = [];
        foreach ($childSecurityCategories as $category) {
            $SecurityChildcategoryData[] = [
                'sub_category_id' => 22,
                'child_category' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('child_categories')->insert($SecurityChildcategoryData);
        // Security Child Categories (Accessories) Seeders End

    }
}
