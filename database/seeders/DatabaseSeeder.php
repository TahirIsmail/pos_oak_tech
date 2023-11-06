<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ComplaintsSeeder;
use Database\Seeders\ChildCategorySeeder;
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
            ChildCategorySeeder::class,
        ]);
    }
}