<?php

namespace App\Providers;

use App\Listeners\EmailVerified;
use App\Models\Topic;
use App\Observers\TopicObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        //注册事件监听
        Event::listen(
            EmailVerified::class,
        );

        //注册观察者模型
        Topic::observe(TopicObserver::class);

        //使用bootstrap分页器
        Paginator::useBootstrap();
    }
}
