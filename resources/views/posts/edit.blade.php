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
    {!! Form::open(['route' => ['posts.update', $post->id], 'method' => 'put']) !!}
    <div>
        <input type="text" name="title" class="form-control mb-3" placeholder="Enter Title" value="{{ $post->title }}">
        <textarea type="text" name="content" rows="4" class="form-control mb-3"
            placeholder="Content">{{ $post->content }}</textarea>
        <select class="form-select form-select-sm my-3 pb-select-box" name="public_post"
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
        <a href="{{ route('categories.create', ['redirect' => "posts/$post->id/edit"]) }}">
            <i class="fas fa-plus add-category-icon"></i>
        </a>
        <button class="btn btn-primary float-end px-5">Submit</button>
    </div>
    {!! Form::close() !!}
@endsection
