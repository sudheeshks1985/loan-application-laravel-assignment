<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Borrower;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrower>
 */
class BorrowerFactory extends Factory
{
    protected $model = Borrower::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
