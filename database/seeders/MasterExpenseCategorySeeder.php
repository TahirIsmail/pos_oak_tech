<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterExpenseCategory;

class MasterExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        MasterExpenseCategory::factory()->count(5)->create();
    }
}
