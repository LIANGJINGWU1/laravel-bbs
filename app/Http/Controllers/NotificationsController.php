<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class NotificationsController extends Controller
{
    public function index():View
    {
        $notifications = auth()->user()->notifications()->paginate(20);

        //标记所有通知为已读
        auth()->user()->markAsRead();

        return view('notifications.index', compact('notifications'));
    }
}
