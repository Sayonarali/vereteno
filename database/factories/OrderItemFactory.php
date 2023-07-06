<?php

namespace Database\Factories;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1,100),
            'price' => fake()->randomFloat(2, 1500,6000),
            'amount' => fake()->randomFloat(2, 1500, 20000),
            'quantity' => fake()->numberBetween(1,100),
        ];
    }
}
