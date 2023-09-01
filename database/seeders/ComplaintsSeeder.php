<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Complaints;
class ComplaintsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Complaints::factory()->count(10)->create();
    }
}
