@extends('layouts.app')

@extends('title', ['title' => $topic->title])

@section('content')
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="card-title">{{ $topic->title }}</h5>
        </div>
        <div class="card-body">
            <p class="card-text">{{ $topic->content }}</p>
            <p class="card-text"><small class="text-muted">{{ __('Created at') }}
                    : {{ $topic->created_at->format('Y-m-d H:i') }}</small></p>
        </div>
    </div>
@endsection
