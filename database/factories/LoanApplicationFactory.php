<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\LoanApplication;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LoanApplication>
 */
class LoanApplicationFactory extends Factory
{
    protected $model = LoanApplication::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'loan_application_number' => fake()->numerify('APP-####'),
            'loan_amount' => fake()->numberBetween(1000, 100000)
        ];
    }
}
