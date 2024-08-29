<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $gameGenres = [
            "Action",
            "Adventure",
            "Role-Playing",
            "Simulation",
            "Strategy",
            "Sports",
            "Puzzle",
            "Shooter",
            "Racing",
            "Fighting",
            "Platformer",
            "Horror",
            "Survival"
        ];

        $dataLength = count($gameGenres);
        
        for($i = 0; $i < $dataLength; $i++) {
            Genre::create([
                'name' => $gameGenres[$i],
            ]);
        }
    }
}
