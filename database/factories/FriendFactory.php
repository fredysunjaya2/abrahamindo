<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Friend>
 */
class FriendFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['pending', 'declined', 'accepted'];

        return [
            //
            'user_id' => rand(1, 10),
            'friend_id' => rand(1, 10),
            'status' => $status[rand(0, 2)],
        ];
    }
}
