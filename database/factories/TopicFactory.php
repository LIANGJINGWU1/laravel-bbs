<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDateTime = $this->faker->dateTimeBetween('-1 years', 'now');

        $sentence = $this->faker->sentence();
        return [
            'title' => $sentence,
            'body' => $this->faker->paragraph(5),
            'user_id' => User::all()->random()->id,
            'category_id' => Category::all()->random()->id,
            'excerpt' => Str::limit($sentence, 50),
            'slug' => Str::slug($sentence),
            'created_at' => $randomDateTime,
            'updated_at' => $randomDateTime,
        ];
    }
}
