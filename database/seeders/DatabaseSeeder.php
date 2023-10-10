<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ComplaintsSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            // sample_values_seeder::class
            // ComplaintsSeeder::class,
        ]);
    }
}