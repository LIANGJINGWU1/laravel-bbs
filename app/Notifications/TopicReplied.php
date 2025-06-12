<?php

namespace App\Notifications;

use App\Models\Reply;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Log;

class TopicReplied extends Notification implements ShouldQueue
{
    use Queueable;

//    public Reply $reply;
    protected int $replyId;

    /**
     * Create a new notification instance.
     */
    public function __construct(int $replyId)
    {

        $this->replyId = $replyId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        //保存一条通知到 notifications 表（database 通道）
        //
        //发送一封邮件（mail 通道），使用你在 toMail() 中定义的内容
        return ['database', 'mail'];
    }

    /**
     * @return Reply|null
     * 安全地获取 reply 模型，避免队列中找不到时报错
     */
    protected function getReply(): ?Reply
    {
//        return Reply::with('user', 'topic')->findOrFail($this->replyId);
        $reply = Reply::with('user', 'topic')->find($this->replyId);
        if (!$reply) {
            Log::warning("[TopicReplied] 回复 ID {$this->replyId} 未找到，通知跳过。");
        }
        return $reply;
    }

    /**
     * Use database send notifiable when topic have new reply.
     *
     * @param $notifiable
     * @return array
     */
    public function toDatabase($notifiable): array
    {
        $reply = $this->getReply();
//        $topic = $this->reply->topic;
//        $topic = $reply->topic;
//        $link = $topic->link(['#reply' . $reply->id]);
        if (!$reply || !$reply->topic || !$reply->user) {
            return [
                'error' => '通知数据丢失，reply 或其关联数据不存在。',
                'reply_id' => $this->replyId,
            ];
        }
        $link = $reply->topic->link(['#reply' . $reply->id]);
        return [
            'reply_id' => $reply->id,
            'reply_content' => $reply->content,
            'user_id' => $reply->user->id,
            'user_name' => $reply->user->name,
            'user_avatar' => $reply->user->avatar,
            'topic_link' => $link,
            'topic_id' => $reply->topic->id,
            'topic_title' => $reply->topic->title,
        ];
//        return [
//            'reply_id' => $this->reply->id,
//            'reply_content' => $this->reply->content,
//            'user_id' => $this->reply->user->id,
//            'user_name' => $this->reply->user->name,
//            'user_avatar' => $this->reply->user->avatar,
//            'topic_link' => $link,
//            'topic_id' => $topic->id,
//            'topic_title' => $topic->title,
//        ];
    }

    /**
     * Send notifiable to email when topic have new reply.
     *
     * @param $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable): MailMessage
    {
        Log::info('[TopicReplied] toMail 被调用，收件人：' . ($notifiable->email ?? '无'));
//        $url = $this->reply->topic->link(['#reply' . $this->reply->id]);
        $reply = $this->getReply();
        $url = $reply->topic->link(['#reply' . $reply->id]);
        return (new MailMessage)
            ->line('新しい返信があります。')
            ->action('返信を確認', $url);
    }
}
