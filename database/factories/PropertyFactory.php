<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Property;
use App\Models\PropertyType;
use App\Models\PropertyImages;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PropertyFactory extends Factory
{
    public function configure(): static
    {
        return $this->afterMaking(function (Property $property) {
            // ...
        })->afterCreating(function (Property $property) {

            for ($x = 1; $x <= rand(1, 3); $x++) {
                $image = fake()->image('public/images/thumbnails', 360, 360, 'animals', false);

                PropertyImages::create([
                    'property_id' => $property->id,
                    'thumbnail' => $image
                ]);
            }
        });
    }
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //->image(null, 360, 360, 'animals', true)
        return [
            'user_id' => User::all()->random(),
            'approved' => true,
            'name' => fake()->word(2),
            'street' => fake()->word(1),
            'town_or_city' => fake()->word(1),
            'available' => now(),
            'deposit' => fake()->numberBetween(200, 1250),
            'price' => fake()->numberBetween(450, 1500),
            'min_tenancy' => '6 Months',
            'furnished' => fake()->boolean(),
            'property_type_id' => PropertyType::all()->random(),
            'bedrooms' => fake()->numberBetween(1, 4),
            'bathrooms' => fake()->numberBetween(1, 3),
            'garden' => fake()->boolean(),
            'parking' => fake()->boolean(),
            'body' => fake()->paragraph(3),
            'created_at' => fake()->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = null)
        ];
    }
}
