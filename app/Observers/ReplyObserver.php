<?php

namespace  App\Observers;

use App\Models\Reply;

class ReplyObserver
{
    public function created(Reply $reply):void
    {
//        $reply->topic->reply_count = $reply->topic->replies()->count();
//        $reply->topic->save();
        $reply->topic->updateReplyCount();
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
