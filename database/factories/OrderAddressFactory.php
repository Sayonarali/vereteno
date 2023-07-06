<?php

namespace Database\Factories;

use App\Models\OrderAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class OrderAddressFactory extends Factory
{
    protected $model = OrderAddress::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'country' => fake()->country(),
            'region' => fake()->address(),
            'city' => fake()->city(),
            'street' => fake()->streetName(),
            'postcode' => fake()->postcode()
        ];
    }
}
