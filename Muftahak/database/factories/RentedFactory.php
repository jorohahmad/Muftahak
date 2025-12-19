<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rented>
 */
class RentedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'birthday' => fake()->date(),
            'phoneNumber' => fake()->unique()->numerify('09########'),
            'personalImage' => fake()->imageUrl(640, 480, 'persons', true),
            'personalIdImage' => fake()->imageUrl(640, 480, 'ids', true),
            'role' => 'rented',
            'password' => Hash::make('1111'),
            'remember_token' => Str::random(10),

        ];
    }
}
