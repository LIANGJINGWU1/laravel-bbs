<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as FakerFactory;
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
        $createAt = $this->faker->dateTimeBetween('-1 years', 'now');
        $updateAt = $this->faker->dateTimeBetween($createAt, 'now');
        //生成一个随机的一句话（一般是标题用途）

        $fakerJa = FakerFactory::create('ja_JP');
        $title = $fakerJa->realText(30);
        $body = $fakerJa->realText(600);

        return [
            'title' => $title,
            'body' => $body,
            'user_id' => DB::table('users')->inRandomOrder()->value('id'),
            'category_id' => DB::table('categories')->inRandomOrder()->value('id'),
            'excerpt' => Str::limit($body, 50),
            'slug' => rawurlencode(Str::replace(' ', '-', $title)),
            'created_at' => $createAt,
            'updated_at' => $updateAt,
        ];
    }
}
