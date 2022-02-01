@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between flex-wrap">
        <div class="card m-3 align-self-start show-card-container">
            <div class="card-body">
                <h2 class="card-title">
                    {{ $post->title }}
                </h2>
                @if ($post->user->id === Auth::id())
                    <div class="action-btn-wrapper">
                        <a class="action-btn" href="{{ route('posts.edit', $post->id) }}">
                            <i class="fas fa-edit edit-icon"></i></a>
                        <form class="del-icon-form" action="{{ route('posts.destroy', $post->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="action-del-btn" type="submit"><i class="fas fa-trash del-icon"></i></button>
                        </form>
                    </div>
                @endif
                @foreach ($post->categories as $tag)
                    <a href="{{ route('categories.show', $tag->id) }}" class="bg-secondary tag">{{ $tag->name }}</a>
                @endforeach
                <hr>
                <p class="card-text post-content">
                    {{ $post->content }}
                </p>
                <i class="fas fa-user user-icon"></i><span class="author-name">{{ $post->user->name }}</span>
            </div>
        </div>
    </div>
@endsection
