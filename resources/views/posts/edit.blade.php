@extends('layouts.app')
@section('content')
    <h1 class="mt-2">Post Update</h1>
    <hr>
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="/posts/{{ $post->id }}" method="post">
        @csrf
        @method('put')
        <input type="text" name="title" class="form-control mb-3" placeholder="Enter Title" value="{{ $post->title }}">
        <textarea type="text" name="content" rows="4" class="form-control mb-3"
            placeholder="Content">{{ $post->content }}</textarea>

        @foreach ($allCatg as $tag)
            <input class="form-check-input" type="checkbox" @if (in_array($tag->id, $selectedCatg)) checked @endif value="{{ $tag->id }}"
                name="category_list[]">
            <label class="form-check-label">
                {{ $tag->name }}
            </label>
        @endforeach
        <button class="btn btn-primary float-end px-5">Submit</button>
    </form>
@endsection
