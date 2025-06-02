<?php

namespace App\Http\Controllers;

use App\Handlers\ImageUploadHandler;
use App\Models\Category;
use App\Models\Topic;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateTopicRequest;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Topic $topic): Factory|Application|View
    {
        $topics = $topic->withOrder($request->order)
            ->with(['user', 'category'])
            ->paginate($this->perPage);
        return view('topics.index', compact('topics'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Topic $topic):View
    {
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     * StoreTopicRequest：是一个表单请求类，自动带有验证功能（相当于 validate() 的高级封装）。
     * Topic $topic：这是 Laravel 的模型自动注入机制，提前准备一个空的 Topic 实例（不是已有记录）。
     * RedirectResponse：返回的是一个重定向响应，浏览器最终跳转页面。
     */
    public function store(StoreTopicRequest $request, Topic $topic):RedirectResponse
    {
        //$request->validated()：只获取验证通过的数据。
        $topic->fill($request->validated());//fill()：批量赋值，用来给 $topic->title、$topic->body 等字段赋值。
        $topic->user()->associate($request->user());//把当前登录的用户（从 $request->user() 拿到）和 $topic 建立关系。
        $topic->save();

        return redirect()->route('topics.show', $topic)->with('success', 'Topic created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic): View
    {
        return view('topics.show', compact('topic'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic): View
    {
        $this->authorize('update', $topic);
        $categories = Category::all();
        return view('topics.create_and_edit', compact('topic', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTopicRequest $request, Topic $topic):RedirectResponse
    {
        $this->authorize('update', $topic);

        $topic->fill($request->validated());
        $topic->save();

        return redirect()->route('topics.show', $topic)->with('success', 'Topic updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        //
    }

    public function uploadImage(Request $request, ImageUploadHandler $uploader): JsonResponse
    {
        //初始化，默认上传失败
        $data = [
            'success' => false,
            'message' => 'upload failed',
            'file_path' => ''
        ];

        //判断是否有上传文件。并赋值给$file
        if($file = $request->upload_file)
        {
            //保存图片到本地
            $result = $uploader->save($file, 'topics', auth()->user()->id, 1024);

            //如果上传成功
            if($result)
            {
                $data['success'] = true;
                $data['file_path'] = $result['path'];
                $data['message'] = 'upload success';
            }
            else{
                $data['message'] = 'upload failed';
            }
        }
        return response()->json($data);
    }

}
