<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Customer::class;
    public function definition()
    {
        return [
            //
            'slack' => $this->faker->unique()->word(10),
            'customer_type' => $this->faker->randomElement(['DEFAULT', 'CUSTOM', 'WALKIN']),
            'password' => bcrypt('password'), // You can change this default password
            'init_password' => $this->generateRandomPassword(9),
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'dob' => $this->faker->date,
            'status' => 1,
            'created_by' => 1,
            'updated_by' => 1,
        ];
    }
    private function generateRandomPassword($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+';
        $password = '';
        
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, strlen($characters) - 1)];
        }
        
        return $password;
    }
}
