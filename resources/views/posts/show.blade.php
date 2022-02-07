@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between flex-wrap">
        <div class="card m-3 align-self-start shadow show-card-container">
            <div class="card-body">
                <h2 class="card-title">
                    {{ $post->title }}
                </h2>
                @if ($post->user->id === Auth::id() || (Auth()->user() ? Auth()->user()->role == 1 : false))
                    <div class="action-btn-wrapper">
                        <a class="action-btn" href="{{ route('posts.edit', $post->id) }}">
                            <i class="fas fa-edit edit-icon"></i></a>
                        <a data-bs-toggle="modal" data-bs-target="#deleteConfirmation" data-table="posts"
                            class=" action-btn btn-delete" data-item="{{ $post->id }}" type="submit">
                            <i class="fas fa-trash del-icon"></i>
                        </a>
                    </div>
                @endif
                @foreach ($post->categories as $tag)
                    <a href="{{ route('categories.show', $tag->id) }}" class="bg-secondary tag">{{ $tag->name }}</a>
                @endforeach
                <hr>
                <p class="card-text post-content">
                    {{ $post->content }}
                </p>
                <div style="margin-top: 60px">
                    <i class="fas fa-user user-icon"></i>
                    <a class="author-name" href="{{ route('user.profile', $post->user->id) }}">
                        {{ $post->user->name }}
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
