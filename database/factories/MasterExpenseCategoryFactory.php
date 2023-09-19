<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;
class MasterExpenseCategoryFactory extends Factory
{
    protected $expenses = ['Office', 'Marketing', 'Travel', 'Project','Misscellaneous'];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userIds = User::pluck('id')->toArray();
        $name = $this->faker->unique->randomElement($this->expenses);
        return [
            //
            'slack' => $this->faker->unique()->regexify('[A-Za-z0-9]{30}'),
            'label' => Str::upper($name),
            'name' => $name,
            'created_by' => $this->faker->randomElement($userIds), // You can customize this as needed
            'updated_by' => $this->faker->randomElement($userIds), // You can customize this as needed
        ];
    }
}
