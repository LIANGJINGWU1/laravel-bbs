<?php

namespace App\Jobs;

use App\Models\Topic;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GenerateSlug implements ShouldQueue
{
    use Queueable;
    protected Topic $topic;
    /**
     * Create a new job instance.
     */
    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $slug = rawurlencode(Str::replace(' ', '-', $this->topic->title));
        //save
        DB::table('topics')->where('id', $this->topic->id)->update(['slug' => $slug]);
    }
}
