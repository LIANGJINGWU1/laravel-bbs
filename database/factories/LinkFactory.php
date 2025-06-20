<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Link>
 */
class LinkFactory extends Factory
{
    protected static int $index = 0;
    protected static array $data = [
        [
            'title' => 'Laravel - The PHP Framework For Web Artisans',
            'link' => 'https://laravel.com/',
        ],
        [
            'title' => 'A Dependency Manager for PHP',
            'link' => 'https://getcomposer.org/',
        ],
        [
            'title' => 'Develop faster. Run anywhere.',
            'link' => 'https://www.docker.com/',
        ],
        [
            'title' => 'Rapidly build modern websites without ever leaving your HTML.',
            'link' => 'https://tailwindcss.com/',
        ],
        [
            'title' => 'Life is short, you need Python',
            'link' => 'https://www.python.org/',
        ],
        [
            'title' => 'Compress the complexity of modern web apps.',
            'link' => 'https://rubyonrails.org/',
        ],
        ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //每次调用取出一个真实数据
        $index = static::$index ?? 0;
        //把索引加 1，存回去，相当于“指针后移”。
        static::$index = $index + 1;
        //尝试返回 static::$data 数组中第 $index 项；
        //如果那项不存在（可能越界），就返回第一项（0号元素）兜底。
        return static::$data[$index] ?? static::$data[0];
    }
}
