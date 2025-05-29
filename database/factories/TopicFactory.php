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
        $createAt = $this->faker->dateTimeBetween('-1 years', 'now');
        $updateAt = $this->faker->dateTimeBetween($createAt, 'now');
        //生成一个随机的一句话（一般是标题用途）
        $sentence = $this->faker->sentence();
        return [
            'title' => $sentence,
            'body' => $this->faker->paragraph(5),//正文内容，这里是由 5 个句子组成的一段话。
            'user_id' => User::all()->random()->id,//随机选一个已存在的用户 ID，表示这条数据由哪个用户发布
            'category_id' => Category::all()->random()->id,//随机选一个分类 ID，表示这条内容属于哪个分类。
            'excerpt' => Str::limit($sentence, 50),//摘要/简介，取标题的前 50 个字符（太长就截断）
            'slug' => Str::slug($sentence),//URL 友好的版本，例如："Hello World!" 会变成 "hello-world"。
            'created_at' => $createAt,
            'updated_at' => $updateAt,
        ];
    }
}
