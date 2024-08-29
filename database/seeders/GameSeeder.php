<?php

namespace Database\Seeders;

use App\Models\Game;
use File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $gameTitle = [];

        $gameFiles = File::files(public_path('\assets\game\\'));

        $gameFilesLength = count($gameFiles);

        for($i = 0; $i < $gameFilesLength; $i++) {
            $gameName = explode('\\', $gameFiles[$i]);

            $gameName = end($gameName);

            $gameFile = $gameName;

            $gameName = explode('.', $gameFile)[0];

            $gameName = implode(" ", explode('-', $gameName));

            Game::create([
                'name' => $gameName,
                'desc' => fake()->paragraph(5),
                'price' => fake()->numberBetween(20000, 1000000),
                'rating' => fake()->randomFloat(1, 0, 5),
                'games_pic' => $gameFile,
                'genre_id' => rand(1, 13),
            ]);
        }
    }
}
