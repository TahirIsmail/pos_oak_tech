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
                'category_code' => 'Computers#101',
                'label' => 'Computers',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'Laptops#101',
                'label' => 'Laptops',
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
                'category_code' => 'Security Equipment#101',
                'label' => 'Security Equipment',
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
                'category_code' => 'Mobiles/Tablets#101',
                'label' => 'Mobiles/Tablets',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'Tools#101',
                'label' => 'Tools',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'Electronics#101',
                'label' => 'Electronics',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'PA System#101',
                'label' => 'PA System',
                'display_on_qr_menu' => 1,
                'status' => 0,
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'slack' => $this->generate_slack('category'),
                'store_id' => 1,
                'category_code' => 'Telephony Equipement#101',
                'label' => 'Telephony Equipement',
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
