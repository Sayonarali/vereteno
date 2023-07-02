<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'description' => fake()->paragraph(),
            'slug' => fake()->word(),
            'category_id' => fake()->numberBetween(1,50),
            'discount_id' => fake()->numberBetween(1,30),
            'vendor_code_id' => fake()->numberBetween(1,30),
            'price' => fake()->randomFloat(2, 2500,10000),
            'quantity' => fake()->numberBetween(1,15),
        ];
    }
}
