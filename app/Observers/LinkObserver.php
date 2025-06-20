<?php

namespace App\Observers;

use App\Models\Link;
use Illuminate\Support\Facades\Cache;

class LinkObserver
{
    /**
     * @param Link $link
     * @return void
     * 在保存时清空cache_key 对应的缓存
     */
    public function saved(Link $link):void
    {
        Cache::forget($link->cache_ley);
    }
}
