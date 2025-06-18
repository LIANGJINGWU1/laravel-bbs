<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Topic;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    public function index(Request $request):View
    {
        //预加载关联模型
        $query = Topic::query()->with(['user','category']);

        if($search = $request->input('search')){
            $query->where(function($query) use ($search){
                $query->where('title', 'like', "%{$search}%")
                ->orWhere('body', 'like', "%{$search}%");
            })->orWhereHas('user', function($query) use ($search){
                $query->where('name', 'like', "%{$search}%");
            })->orWhereHas('category', function($query) use ($search){
                 $query->where('name', 'like', "%{$search}%");
            });
        }
        //排序
        $sortBy = $request->input('sortBy', 'recent_replied');

        switch($sortBy){
            case 'recent':
                $query->recent();
                break;
            case 'view_count':
                $query->orderBy('view_count', 'desc');
                break;
            case 'recent_replied':
            default:$query->recentReplied();// 使用 Topic 模型中的 scopeRecentReplied (按 updated_at 排序)
            break;
        }

        $topics = $query->paginate($this->perPage)->appends(request()->query());
        return view('admin.topic.index', compact('topics'));
    }

    public function create():View
    {
        //获取所有分类下拉表
        $categories = Category::all();
        return view('admin.topic.create', compact('categories'));
    }

    public function store(Request $request):RedirectResponse
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
        //执行验证
        $validatedData = $request->validate($rules);
        $topic = new Topic();
        $topic->title = $validatedData['title'];
        $topic->body = $validatedData['body'];
        //user_id 应该设置为当前登录的管理员id作为话题作者
        $topic->user_id = auth()->id();
        $topic->category_id = $validatedData['category_id'];

        $topic->save();

        //重新定向回话题列表
        return redirect()->route('admin.topic.index')->with('success', __('messages.create.success'));

    }

    public function show(Topic $topic): View
    {
        return view('admin.topic.show', compact('topic'));
    }

    public function edit(Topic $topic): View
    {
        //获取所有分类下拉选责
        $categories = Category::all();
        return view('admin.topic.edit', compact('topic', 'categories'));
    }

    public function update(Request $request, Topic $topic): RedirectResponse
    {
        $rules = [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'category_id' => ['required', 'exists:categories,id'],
            'excerpt' => ['nullable', 'string', 'max:255'],
            'order' => ['required', 'integer', 'min:0'],
        ];
        $validatedData = $request->validate($rules);
        $topic->title = $validatedData['title'];
        $topic->body = $validatedData['body'];
        $topic->category_id = $validatedData['category_id'];
        $topic->excerpt = $validatedData['excerpt'] ?? Str::limit(strip_tags($validatedData['body']), 200);
        $topic->order = $validatedData['order'];

        $topic->save();
        return redirect()->route('admin.topics.edit', $topic)->with('success', __('Topic updated successfully.'));
    }

    public function destroy(Topic $topic): RedirectResponse
    {
        $topic->delete();
        return redirect()->route('admin.topics.index')->with('success', __('Topic deleted successfully.'));
    }
}
