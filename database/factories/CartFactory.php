<?php

namespace Database\Factories;

use App\Models\Cart;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    protected $model = Cart::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,100),
            'product_id' => fake()->numberBetween(1,100),
            'price' => fake()->randomFloat(2, 1500,6000),
            'amount' => fake()->randomFloat(2, 1500, 20000),
            'quantity' => fake()->numberBetween(1,100),
        ];
    }
}
