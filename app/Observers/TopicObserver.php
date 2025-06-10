<?php

namespace App\Observers;

use App\Jobs\GenerateSlug;
use App\Models\Topic;
use Illuminate\Support\Str;

class TopicObserver
{
    /**
     * When a topic is being created or updated, generate an excerpt from the body.
     *
     * @param Topic $topic
     * @return void
     */
    public function saving(Topic $topic): void
    {
        //过滤话题内容的特殊标签
        $topic->body = clean($topic->body, 'user_topic_body');
        //生成摘要
        $topic->excerpt = make_excerpt($topic->body);
        //如果没有slug，使用标题生成slug
        if(!$topic->slug){
            $topic->slug = rawurlencode(Str::replace(' ', '-', $topic->title));
        }
    }

    public function saved(Topic $topic): void
    {
        if(!$topic->slug)
        {   //推送生成的slug的任务到队列
            dispatch(new GenerateSlug($topic));
        }
    }
}
