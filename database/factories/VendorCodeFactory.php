<?php

namespace Database\Factories;

use App\Models\VendorCode;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VendorCode>
 */
class VendorCodeFactory extends Factory
{
    protected $model = VendorCode::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => fake()->unique()->numberBetween(10000, 99999),
            'material_id' => fake()->numberBetween(1,20),
            'color_id' => fake()->numberBetween(1,20),
            'size_id' => fake()->numberBetween(1,8)
        ];
    }
}
