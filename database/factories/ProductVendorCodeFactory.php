<?php

namespace Database\Factories;

use App\Models\ProductVendorCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ProductVendorCodeFactory extends Factory
{
    protected $model = ProductVendorCode::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => fake()->numberBetween(1,100),
            'vendor_code_id' => fake()->numberBetween(1,30),
            'discount_id' => fake()->numberBetween(1,30),
            'price' => fake()->randomFloat(2, 2500,10000),
            'quantity' => fake()->numberBetween(1,15),
        ];
    }
}
