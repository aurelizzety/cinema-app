<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Movie::create([
            'title' => 'Ride Your Wave',
            'description' => 'In search of her own calling, Hinako begins her journey of self-discovery, keeping Minato by her side as she gradually attempts to find her purpose and ride her own wave.',
            'duration' => 95,
            'genre' => 'Romance',
        ]);

        Movie::create([
            'title' => 'Josee, the Tiger and the Fish',
            'description' => 'Through their time together, the two begin to realize that the traits that bind them may be vital toward fulfilling their respective aspirations.',
            'duration' => 98,
            'genre' => 'Romance',
        ]);
    }
}
