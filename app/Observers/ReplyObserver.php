<?php

namespace  App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

class ReplyObserver
{
    public function created(Reply $reply):void
    {
//        $reply->topic->reply_count = $reply->topic->replies()->count();
//        $reply->topic->save();
        $reply->topic->updateReplyCount();
        //通知话题作者有新的回复
//        $reply->topic->user->notify(new TopicReplied($reply));
        // 避免 reply->topic->user 为 null，先判断一下
        if ($reply->topic && $reply->topic->user && $reply->user_id !== $reply->topic->user_id) {
            $reply->topic->user->notify(new TopicReplied($reply->id));  // ✅ 改为传 ID
        }
    }

    public function creating(Reply $reply): void
    {
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function deleted(Reply $reply): void
    {
        $reply->topic->updateReplyCount();
    }

}
