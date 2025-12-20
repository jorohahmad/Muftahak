<?php

namespace Database\Seeders;

use App\Models\Rented;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RentedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rented::factory()->count(5)->create();
    }
}
