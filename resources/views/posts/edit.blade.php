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
        {{ Form::text('title', $post->title, ['class' => 'form-control mb-3', 'placeholder' => 'Enter Title']) }}
        {{ Form::textarea('content', $post->content, ['class' => 'form-control mb-3','rows' => 4,'placeholder' => 'Content']) }}
        {{ Form::select('public_post', ['1' => 'Public', '0' => 'Private'], $post->public_post == 1 ? '1' : '0', ['class' => 'form-select form-select-sm my-3 pb-select-box']) }}
        {{ Form::hidden('author_id', Auth::id(), ['class' => 'form-control mb-3']) }}
        @foreach ($allCatg as $tag)
            {{ Form::checkbox('category_list[]', $tag->id, in_array($tag->id, $selectedCatg) ? true : false, ['class' => 'form-check-input']) }}
            {{ Form::label($tag->name, $tag->name, null, ['class' => 'form-check-label']) }}
        @endforeach
        <a href="{{ route('categories.create', ['redirect' => "posts/$post->id/edit"]) }}">
            <i class="fas fa-plus add-category-icon"></i>
        </a>
        {{ Form::submit('Submit', ['class' => 'btn btn-primary float-end px-5']) }}
    </div>
    {!! Form::close() !!}
@endsection
