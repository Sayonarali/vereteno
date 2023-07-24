<?php

namespace Database\Factories;

use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AttributeValueFactory extends Factory
{
    protected $model = AttributeValue::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'value' => fake()->word(),
            'attribute_id' => fake()->numberBetween(1,25),
        ];
    }
}
