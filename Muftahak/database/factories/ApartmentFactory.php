<?php

namespace Database\Factories;

use App\Models\Rented;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
        $imagepath=['a1.jpg','a2.jpg','a3.jpg','a4.jpg','b1.jpg','b2.jpg','b3.jpg','c1.jpg','c2.jpg','c3.jpg','d1.jpg','d2.jpg','d3.jpg','e1.jpg','e2.jpg'];
        $values=[
            'Damascus'=>['Mizah','Douma','Harasta','Moadamiyet Al Sham','Tishreen','Qaboun'],
            'Latakia'=>['Jablah','Tishreen','AL Basiat', 'AL Ramel','Qardaha','Al-Kasab','Al-Haffa'],
            'Homs'=>['Al Hadarah','Al Zahra','Al Hamra','Wadi Al Dahab','Palmyra'],
            'Aleppo'=>['Hamadanieh','Furqan','Shahba New City','Sif al-Dowla'],
            'Tartus'=>['Al Qadmus','Banyas','Al-Dreikish','Safita','Shadaam','Bleesaan'],
            'As-Suwayda'=>['Dhahr al-Jabal','Shahba','Salakhid','Sasa'],
            'Daraa'=>['Nawa','Tafas','Al-Harak','Al-Sanamayn','Al-Lajat'],
            'Quneitra'=>['Khan Arnabah','Jibata al-Khashab','Majdal Shams','Hader'],
            'Hama'=>['Salamiya','Muhardah','Masyaf','Al-Houla','Al-Mukharram'],
            'Deir ez-Zor'=>['Al-Mayadin','Al-Bukamal','Hajin','Al-Salihiyah'],
            'Al-Hasakah'=>['Qamishli','Ras al-Ayn','Al-Malikiyah','Tal Tamr'],
            'Raqqa'=>['Al-Thawrah','Al-Mansurah','Al-Rafiqah','Al-Jazrah']
        ];
        $firstvalue=fake()->randomElement(array_keys($values));
        $secondvalue=fake()->randomElement($values[$firstvalue]);
        return [
            'rented_id'=>Rented::inRandomOrder()->first()->id,
            'title' => fake()->sentence(3),
            'governorate' => $firstvalue,
            'city' => $secondvalue,
            'price' => fake()->numberBetween(1000, 10000),
            'description' => fake()->paragraph(),
            'details' => fake()->paragraph(),
            'status' => 'Available',
            'image1' => fake()->randomElement($imagepath),
            'image2' => fake()->randomElement($imagepath),
            'image3' =>fake()->randomElement($imagepath),
            'image4' => fake()->randomElement($imagepath),
            'image5' => fake()->randomElement($imagepath)
            
        ];
    }
}
