<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BankAccount;

class BankAccountFactory extends Factory
{
    protected $model = BankAccount::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'bank_name' => fake()->company(),
            'account_type' => 'checking',
            'balance_amount' => fake()->numberBetween(500, 100000)
        ];
    }
}
