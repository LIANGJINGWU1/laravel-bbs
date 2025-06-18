@php use Illuminate\Support\Str; @endphp
@extends('admin.layouts.app')

{{-- 页面标题 --}}
@section('title', __('admin.dashboard.title'))

{{-- 页面描述 --}}
@section('description', __('admin.dashboard.description'))

@section('content')
    {{-- 顶部数据统计卡片 --}}
    <div class="tw-grid tw-grid-cols-1 tw-gap-5 sm:tw-grid-cols-2 lg:tw-grid-cols-3">
        {{-- 用户总数 --}}
        <div class="tw-overflow-hidden tw-rounded-lg tw-bg-white tw-shadow">
            <div class="tw-p-5">
                <div class="tw-flex tw-items-center">
                    <div class="tw-flex-shrink-0">
                        <svg class="tw-h-6 tw-w-6 tw-text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M15 21a6 6 0 00-9-5.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-3-5.197M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                    <div class="tw-ml-5 tw-w-0 tw-flex-1">
                        <dl>
                            <dt class="tw-truncate tw-text-sm tw-font-medium tw-text-gray-500">{{ __('admin.dashboard.users_count') }}</dt>
                            <dd class="tw-text-3xl tw-font-bold tw-text-gray-900">{{ $userCount }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        {{-- 话题总数 --}}
        <div class="tw-overflow-hidden tw-rounded-lg tw-bg-white tw-shadow">
            <div class="tw-p-5">
                <div class="tw-flex tw-items-center">
                    <div class="tw-flex-shrink-0">
                        <svg class="tw-h-6 tw-w-6 tw-text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <div class="tw-ml-5 tw-w-0 tw-flex-1">
                        <dl>
                            <dt class="tw-truncate tw-text-sm tw-font-medium tw-text-gray-500">{{ __('admin.dashboard.topics_count') }}</dt>
                            <dd class="tw-text-3xl tw-font-bold tw-text-gray-900">{{ $topicCount }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        {{-- 回复总数 --}}
        <div class="tw-overflow-hidden tw-rounded-lg tw-bg-white tw-shadow">
            <div class="tw-p-5">
                <div class="tw-flex tw-items-center">
                    <div class="tw-flex-shrink-0">
                        <svg class="tw-h-6 tw-w-6 tw-text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 10h10a8 8 0 018 8v2M3 10l6-6m-6 6l6 6"/>
                        </svg>
                    </div>
                    <div class="tw-ml-5 tw-w-0 tw-flex-1">
                        <dl>
                            <dt class="tw-truncate tw-text-sm tw-font-medium tw-text-gray-500">{{ __('admin.dashboard.replies_count') }}</dt>
                            <dd class="tw-text-3xl tw-font-bold tw-text-gray-900">{{ $replyCount }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 主要内容区域 --}}
    <div class="tw-mt-8 tw-grid tw-grid-cols-1 tw-gap-8 lg:tw-grid-cols-3">
        {{-- 左侧两列合并: 最新帖子和回复 --}}
        <div class="tw-space-y-8 lg:tw-col-span-2">
            {{-- 最新帖子 --}}
            <div class="tw-overflow-hidden tw-rounded-lg tw-bg-white tw-shadow">
                <div class="tw-p-6">
                    <h3 class="tw-text-base tw-font-medium tw-text-gray-900">{{ __('admin.dashboard.latest_posts') }}</h3>
                    <ul role="list" class="tw-mt-4 tw-divide-y tw-divide-gray-200">
                        @forelse ($latestPosts as $post)
                            <li class="tw-py-4">
                                <div class="tw-flex tw-space-x-3">
                                    <div class="tw-flex-1 tw-space-y-1">
                                        <div class="tw-flex tw-items-center tw-justify-between">
                                            <h4 class="tw-text-sm tw-font-medium">{{ $post->title }}</h4>
                                            <p class="tw-text-sm tw-text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                        </div>
                                        <p class="tw-text-sm tw-text-gray-500">{!! Str::limit($post->body, 100) !!}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="tw-py-4 tw-text-sm tw-text-gray-500">{{ __('admin.dashboard.no_posts') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>

            {{-- 最新回复 --}}
            <div class="tw-overflow-hidden tw-rounded-lg tw-bg-white tw-shadow">
                <div class="tw-p-6">
                    <h3 class="tw-text-base tw-font-medium tw-text-gray-900">{{ __('admin.dashboard.latest_replies') }}</h3>
                    <ul role="list" class="tw-mt-4 tw-divide-y tw-divide-gray-200">
                        @forelse ($latestReplies as $reply)
                            <li class="tw-py-4">
                                <div class="tw-flex tw-space-x-3">
                                    <img class="tw-h-6 tw-w-6 tw-rounded-full"
                                         src="{{ $reply->user->avatar }}" alt="{{ $reply->user->name }}">
                                    <div class="tw-flex-1 tw-space-y-1">
                                        <div class="tw-flex tw-items-center tw-justify-between">
                                            <h4 class="tw-text-sm tw-font-medium">{{ $reply->user->name ?? 'N/A' }}</h4>
                                            <p class="tw-text-sm tw-text-gray-500">{{ $reply->created_at->diffForHumans() }}</p>
                                        </div>
                                        <p class="tw-text-sm tw-text-gray-500">{{ __('admin.dashboard.replied_to') }} <a
                                                href="#"
                                                class="tw-font-medium tw-text-indigo-600">{{ $reply->topic->title ?? 'N/A' }}</a>
                                        </p>
                                        <p class="tw-text-sm tw-text-gray-700">{!! Str::limit($reply->content, 120) !!}</p>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="tw-py-4 tw-text-sm tw-text-gray-500">{{ __('admin.dashboard.no_replies') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>

        {{-- 右侧一列: 活跃用户 --}}
        <div class="lg:tw-col-span-1">
            <div class="tw-overflow-hidden tw-rounded-lg tw-bg-white tw-shadow">
                <div class="tw-p-6">
                    <h3 class="tw-text-base tw-font-medium tw-text-gray-900">{{ __('admin.dashboard.active_users') }}</h3>
                    <ul role="list" class="tw-mt-4 tw-divide-y tw-divide-gray-200">
                        @forelse ($activeUsers as $user)
                            <li class="tw-py-4 tw-flex">
                                <img class="tw-h-10 tw-w-10 tw-rounded-full"
                                     src="{{ $user->avatar }}" alt="{{ $user->name }}">
                                <div class="tw-ml-3">
                                    <p class="tw-text-sm tw-font-medium tw-text-gray-900">{{ $user->name }}</p>
                                    <p class="tw-text-sm tw-text-gray-500">{{ $user->email }}</p>
                                    <p class="tw-text-xs tw-text-gray-500">
                                        {{ $user->topics_count }} {{ __('admin.dashboard.topics') }}
                                        / {{ $user->replies_count }} {{ __('admin.dashboard.replies') }}
                                    </p>
                                </div>
                            </li>
                        @empty
                            <li class="tw-py-4 tw-text-sm tw-text-gray-500">{{ __('admin.dashboard.no_active_users') }}</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
