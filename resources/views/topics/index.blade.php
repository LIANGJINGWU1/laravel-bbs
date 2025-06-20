@php use Illuminate\Support\Facades\Request;

$routeIsTopicsIndex = Request::routeIs('topics.index');//判断当前访问的是否是 topics.index 这个路由,比如只在话题列表页显示排序按钮：
$routeHasQueryOrder = Request::has('order');//判断当前 URL 是否包含 order 这个查询参数
$currentOrder = Request::get('order', 'default'); //获取 URL 中的 order 参数值，如果没有就返回 'default'。
$settings = \App\Models\Setting::getSettingsFromCache();
$titlePart1 = $settings['site_name']->value ?? env('APP_NAME');
$titlePart2 = isset($category) ? $category->name : __('Topics');
$title = "$titlePart1 - $titlePart2";

@endphp
@extends('layouts.app')

@section('title', $title)

@section('content')

    <div class="row mb-5">
        <div class="col-lg-9 col-md-9 topic-list">
            @if(isset($category))
                <div class = "alert alert-info" role = "alert">
                    {{ $category->name }} : {{ $category->description }}
                </div>
            @endif
            <div class="card ">
                <div class="card-header bg-transparent">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            @if($routeHasQueryOrder)
                                <a class="nav-link {{ $currentOrder == 'default' ? 'active' : ''}}"
                                   href="{{ Request::url() }}?order=default">{{ __('Last Replied') }}</a>
                            @else
                                <a class="nav-link active"
                                   href="{{ Request::url() }}?order=default">{{ __('Last Replied') }}</a>
                            @endif
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $routeHasQueryOrder && $currentOrder == 'recent' ? 'active' : '' }}"
                               href="{{ Request::url() }}?order=recent">{{ __('New published') }}</a>
                        </li>
                    </ul>
                </div>

                <div class="card-body">
                    {{-- 话题列表 --}}
                    @include('topics._topic_list', ['topics' => $topics])
                    {{-- 分页 --}}
                    <div class="mt-5">
                        {!! $topics->appends(Request::except('page'))->render() !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-3 sidebar">
            @include('topics._sidebar')
        </div>
    </div>

@endsection
