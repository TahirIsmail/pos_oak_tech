<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'Laptop#101',
                'label' => 'LAPTOPS',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'Tablets#101',
                'label' => 'TABLETS',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'Computers#101',
                'label' => 'COMPUTERS',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'printer#101',
                'label' => 'PRINTERS',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'cctvCamera#101',
                'label' => 'CCTV CAMERA',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'networks#101',
                'label' => 'NETWORKS',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'scanner#101',
                'label' => 'SCANNERS',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'projector#101',
                'label' => 'PROJECTORS',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'accessories#101',
                'label' => 'ACCESSORIES',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    function generate_slack($table)
    {
        do{
            $slack = str_random(25);
            $exist = DB::table($table)->where("slack", $slack)->first();
        }while($exist);
        return $slack;
    }
}
