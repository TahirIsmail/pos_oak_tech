<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\MasterExpenseCategory;

class ExpensesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        //
        $createdByUserIds = User::pluck('id')->toArray();
        $updatedByUserIds = User::pluck('id')->toArray();

        // Get random expense category IDs from the MasterExpenseCategory model
        $expenseCategoryIds = MasterExpenseCategory::pluck('id')->toArray();
        $status = [1,0];
        return [
            'slack' => $this->faker->unique()->regexify('[A-Za-z0-9]{30}'),
            'expense_name' => $this->faker->name,
            'expense_category' => $this->faker->randomElement($expenseCategoryIds),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'receipt_upload' => $this->faker->imageUrl(640, 480, 'cats'), // Example: Generate a random image URL
            'expense_date' => $this->faker->date,
            'notes' => $this->faker->text,
            'status' => $this->faker->randomElement($status),
            'created_by' => $this->faker->randomElement($createdByUserIds),
            'updated_by' => $this->faker->randomElement($updatedByUserIds),
        ];
    }
}
