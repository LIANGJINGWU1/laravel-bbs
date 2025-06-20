<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // ✅ 把定时任务放这里
        $schedule->command('pandaria:calculate-active-user')->hourly();
        $schedule->command('pandaria:sync-user-active-at')->dailyAt('00:00');
    }

    protected function commands(): void
    {
        // 加载 routes/console.php 中的 Artisan 命令
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
