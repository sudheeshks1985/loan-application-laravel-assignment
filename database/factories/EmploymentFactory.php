<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Employment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employment>
 */
class EmploymentFactory extends Factory
{
    protected $model = Employment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'employer_name' => fake()->company(),
            'employer_address' => fake()->sentence(),
            'annual_income' => fake()->numberBetween(1000, 100000)
        ];
    }
}
