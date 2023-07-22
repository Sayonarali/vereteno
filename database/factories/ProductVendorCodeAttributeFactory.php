<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVendorCodeAttribute>
 */
class ProductVendorCodeAttributeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_vendor_code_id' => fake()->numberBetween(1,100),
            'attribute_id' => fake()->numberBetween(1, 25)
        ];
    }
}
