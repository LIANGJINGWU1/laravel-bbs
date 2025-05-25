<?php


namespace App\Listeners;

use Illuminate\Auth\Events\Verified;

class EmailVerified
{

    public function __construct()
    {

    }

    public function handle(Verified $event): void
    {
        session()->flash('success', '已成功验证');
    }
}
