<?php

namespace Database\Factories;

use App\Models\CartItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartItem>
 */
class CartItemFactory extends Factory
{
    protected $model = CartItem::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fake()->numberBetween(1,100),
            'product_vendor_code_id' => fake()->numberBetween(1,100),
            'quantity' => fake()->numberBetween(1,100),
        ];
    }
}
