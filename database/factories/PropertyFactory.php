<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\PropertyFrequency;
use App\Models\PropertyType;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::all()->random(),
            'approved' => true,
            'name' => fake()->word(2),
            'street' => fake()->word(1),
            'town_or_city' => fake()->word(1),
            'available' => now(),
            'deposit' => fake()->numberBetween(200, 1250),
            'price' => fake()->numberBetween(450, 1500),
            'property_frequency_id' => PropertyFrequency::all()->random(),
            'min_tenancy' => '6 Months',
            'furnished' => fake()->boolean(),
            'property_type_id' => PropertyType::all()->random(),
            'bedrooms' => fake()->numberBetween(1, 4),
            'bathrooms' => fake()->numberBetween(1, 3),
            'garden' => fake()->boolean(),
            'parking' => fake()->boolean(),
            'body' => fake()->paragraph(3)
        ];
    }
}
