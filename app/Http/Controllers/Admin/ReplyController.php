<?php
namespace App\Http\Controllers\Admin;

use App\Models\Reply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReplyController extends Controller
{
    public function index(Request $request):View
    {
        //获取所有回复
        $replies = Reply::with('user','topic')->latest()->paginate($this->perPage);
        $query = Reply::query()->with('user','topic');

        if($search = $request->input('search')){
            $query->where(function($query) use ($search){
                $query->where('content', 'like', "%{$search}%")
                    ->orWhere('body', 'like', "%{$search}%");
            })->orWhereHas('user', function($query) use ($search){
                $query->where('name', 'like', "%{$search}%");
            })->orWhereHas('category', function($query) use ($search){
                $query->where('title', 'like', "%{$search}%");
            });
        }
        // 回复通常按创建时间倒序排序
        $query->orderBy('created_at', 'desc');
        // 每页显示15个回复并进行分页
        $replies = $query->paginate(15)->appends(request()->query());
        // 返回回复列表视图
        return view('admin.reply.index', compact('replies'));
    }

    /**
     * 显示单个回复
     */
    public function show(Reply $reply):View
    {
        $reply->load('user','topic');
        return view('admin.reply.show', compact('reply'));
    }

    public function edit(Request $request, Reply $reply):RedirectResponse
    {
        //定义规则
        $rules = [
            'content' => ['required', 'string'],
        ];
        //执行验证
        $validatedData = $request->validate($rules);
        //更新回复内容
        $reply->content = $validatedData['content'];
        //自动更新
        $reply->save();
        return redirect()->route('admin.replies.edit', $reply)->with('success', __('Reply updated successfully.'));
    }

    public function destroy(Reply $reply): RedirectResponse
    {
        // 重定向回回复列表页，并带上成功消息
        return redirect()->route('admin.replies.index')->with('success', __('Reply deleted successfully.'));
    }

}
