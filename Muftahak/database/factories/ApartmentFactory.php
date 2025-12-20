<?php

namespace Database\Factories;

use App\Models\Rented;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Apartment>
 */
class ApartmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'rented_id'=>Rented::inRandomOrder()->first()->id,
            'title' => fake()->sentence(3),
            'governorate' => fake()->state(),
            'city' => fake()->city(),
            'price' => fake()->numberBetween(1000, 10000),
            'description' => fake()->paragraph(),
            'details' => fake()->paragraph(),
            'status' => fake()->randomElement(['Available', 'notAvailable']),
            'image1' => fake()->imageUrl(640, 480, 'apartments', true),
            'image2' => fake()->imageUrl(640, 480, 'apartments', true),
            'image3' => fake()->imageUrl(640, 480, 'apartments', true),
            'image4' => fake()->imageUrl(640, 480, 'apartments', true),
            'image5' => fake()->imageUrl(640, 480, 'apartments', true)            

        ];
    }
}
