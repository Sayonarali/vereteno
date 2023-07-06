<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,100),
            'status' => fake()->randomElement(['new', 'process', 'delivered', 'cancel']),
            'total' => fake()->randomFloat(2, 1500, 20000),
            'payment_status' => fake()->randomElement(['paid', 'unpaid']),
            'payment_method' => fake()->randomElement(['online', 'offline']),
        ];
    }
}
