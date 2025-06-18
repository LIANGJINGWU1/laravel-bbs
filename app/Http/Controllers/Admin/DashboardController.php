<?php

namespace App\Http\Controllers\Admin;

use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    /**
     * @return View
     * 显示管理员仪表盘
     */
    public function index():View
    {
        //首页
        $userCount = User::count();
        $topicCount = Topic::count();
        $replyCount = Reply::count();

        //最新10条
        $latestPosts = Topic::latest()->take(10)->get();
        $latestReplies = Reply::latest()->take(10)->get();
        //活跃用户
        $activeUsers = User::withCount('topics', 'replies')
            ->orderBy('topics_count', 'desc')
            ->orderBy('replies_count', 'desc')
            ->take(10)
            ->get();
        return view('admin.dashboard', [
            'userCount' => $userCount,
            'topicCount' => $topicCount,
            'replyCount' => $replyCount,
            'latestPosts' => $latestPosts,
            'latestReplies' => $latestReplies,
            'activeUsers' => $activeUsers,
        ]);
    }
}
