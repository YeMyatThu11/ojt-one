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
    <form action="{{ route('posts.update', $post->id) }}" method="post">
        @csrf
        @method('put')
        <input type="text" name="title" class="form-control mb-3" placeholder="Enter Title" value="{{ $post->title }}">
        <textarea type="text" name="content" rows="4" class="form-control mb-3"
            placeholder="Content">{{ $post->content }}</textarea>
        <select class="form-select form-select-sm my-3" name="public_post" style="width: 100px"
            aria-label=".form-select-sm example">
            <option value=1 {{ $post->public_post == 1 ? 'selected' : '' }}>Public </option>
            <option value=0 {{ $post->public_post == 0 ? 'selected' : '' }}>Private</option>
        </select>

        @foreach ($allCatg as $tag)
            <input class="form-check-input" type="checkbox" @if (in_array($tag->id, $selectedCatg)) checked @endif value="{{ $tag->id }}"
                name="category_list[]">
            <label class="form-check-label">
                {{ $tag->name }}
            </label>
        @endforeach
        <a href="{{ route('categories.create', ['redirect' => "posts/$post->id/edit"]) }}"><i class="fas fa-plus"
                style="margin-left:10px;background: rgb(151, 150, 150);color:#fff;width:25px;height:25px;border-radius:50%; padding: 5px 0px 0px 6px;"></i></a>
        <button class="btn btn-primary float-end px-5">Submit</button>
    </form>
@endsection
