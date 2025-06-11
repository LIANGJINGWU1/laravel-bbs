@extends('layouts.app')

@section('title',  $topic->title)
@section('description', $topic->excerpt)

@section('content')
    <div class="card mb-3">
        <div class="row">
            <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
                <div class="card ">
                    <div class="card-body">
                        <div class="text-center">
                            {{ __('Author') }}：{{ $topic->user->name }}
                        </div>
                        <hr>
                        <div class="media">
                            <div align="center">
                                <a href="{{ route('users.show', $topic->user->id) }}">
                                    <img class="thumbnail img-fluid" src="{{ $topic->user->avatar }}" width="300px" height="300px" alt="{{ $topic->user->name }}">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
                <div class="card ">
                    <div class="card-body">
                        <h1 class="text-center mt-3 mb-3">
                            {{ $topic->title }}
                        </h1>
                        <div class="article-meta text-center text-secondary">
                            {{ $topic->created_at->diffForHumans() }}
                            <i class="far fa-comment"></i>
                            {{ $topic->reply_count }}
                        </div>
                        <div class="topic-body mt-4 mb-4">
                            {!! $topic->body !!}
                        </div>
                        @can('update', $topic)
                        <div class="operate d-flex gap-2 align-items-center">
                            <hr>
                            <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-outline-secondary btn-sm" role="button">
                                <i class="far fa-edit"></i> {{ __('Edit') }}
                            </a>
                            <form action="{{ route('topics.destroy', $topic->id) }}" method="post"
                                  style="display: inline-block;"
                                  onsubmit="return confirm('{{ __('Are you sure you want to delete this?') }}');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-secondary btn-sm">
                                    <i class="far fa-trash-alt"></i> {{ __('Delete') }}
                                </button>
                            </form>
{{--                            <form action ="{{ route('topics.destroy',$topic->id) }}" method="POST" onsubmit="return confirm('确定删除吗？');">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <button class="btn btn-outline-secondary btn-sm">--}}
{{--                                    <i class="far fa-trash-alt"></i> {{ __('Delete') }}--}}
{{--                                </button>--}}
{{--                            </form>--}}
                        </div>
                        @endcan
{{--                        @if($topic->replies->isNotEmpty())--}}
{{--                            @foreach($topic->replies as $reply)--}}
{{--                                <div class="border rounded p-2 mb-2 d-flex gap-3">--}}
{{--                                    --}}{{-- 用户头像 --}}
{{--                                    --}}{{--asset() 帮你补全完整的路径前缀它默认指向 public/目录--}}
{{--                                    <img src="{{ $reply->user->avatar ?? asset('images/default-avatar.png') }}"--}}
{{--                                         alt="用户头像" width="40" height="40" class="rounded-circle">--}}

{{--                                    <div>--}}
{{--                                        --}}{{-- 用户名称 --}}
{{--                                        <strong><a href="{{ route('users.show', $reply->user->id) }}" class="text-dark fw-bold text-decoration-none">--}}
{{--                                            {{ $reply->user->name ?? '匿名用户' }}--}}
{{--                                            </a>--}}
{{--                                        </strong>--}}
{{--                                        <p class="mb-1">{{ $reply->content }}</p>--}}
{{--                                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endforeach--}}
{{--                        @else--}}
{{--                            <p>暂无回复</p>--}}
{{--                        @endif--}}
                    </div>
                </div>
                {{-- 用户回复列表 --}}
                <div class="card topic-reply mt-4">
                    <div class="card-body">
                        @includeWhen(auth()->check(),'topics._reply_box', ['topic' => $topic])
                        @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
                    </div>
                </div>
        </div>
    </div>
@stop
