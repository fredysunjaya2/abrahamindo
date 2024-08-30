<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(10)->create([
            'profile_pic' => "assets/profile_pic/" . rand(1, 19) . ".png"
        ]);

        $this->call([
            GenreSeeder::class,
            GameSeeder::class,
            UserGameSeeder::class,
            FriendSeeder::class,
        ]);
    }
}
