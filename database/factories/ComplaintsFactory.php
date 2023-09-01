<?php

namespace Database\Factories;

use App\Models\Complaints;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class ComplaintsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Complaints::class;
    protected $complaintStatuses = ['Processed', 'In Process', 'Pending'];
    public function definition()
    {
        return [
            'slack' => $this->faker->unique()->word,
            'complaint_ref' => $this->faker->randomNumber(),
            'descriptions' => $this->faker->paragraph,
            'store_id' => 1,
            'complaint_status' => $this->complaintStatuses[rand(0,2)],
            'created_by' => User::inRandomOrder()->first()->id,
            'updated_by' => User::inRandomOrder()->first()->id,
            'complaint_by' => Customer::inRandomOrder()->first()->id,
            'assigned_to' => User::inRandomOrder()->first()->id,
        ];
    }
}
