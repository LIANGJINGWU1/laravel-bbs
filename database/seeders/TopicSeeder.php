<?php

namespace Database\Seeders;

use App\Models\Topic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    //如果模型事件的触发会消耗太多时间，可以使用下面的代码跳过它们。但是需要注意你生成的数据是否符合预期。
    //// use WithoutModelEvents;
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Topic::factory()->count(random_int(100,200))->create();
    }
}
