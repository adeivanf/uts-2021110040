<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomFloat(2, 1, 10000),
            'type' => $this->faker->randomElement(['income', 'expense']),
            'category' => $this->faker->randomElement(['wage', 'bonus', 'gift', 'food & drinks', 'shopping', 'charity', 'housing', 'insurance', 'taxes', 'transportation']),
            'notes' => $this->faker->sentence,
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => $this->faker->dateTimeThisYear,
        ];
    }
}
