<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reply>
 */
class ReplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-1 years', 'now');
        $updatedAt = $this->faker->dateTimeBetween($createdAt, 'now');
        return [
            'content' => $this->faker->realText(150),
            'topic_id' => DB::table('topics')->inRandomOrder()->value('id'),
            'user_id' => DB::table('users')->inRandomOrder()->value('id'),
            'created_at' => $createdAt,
            'updated_at' => $updatedAt,
            ];
    }
}
