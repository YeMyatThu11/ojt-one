@extends('layouts.app')
@section('content')
    <h1 class="mt-2">Post Create</h1>
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
    {{ Form::open(['route' => 'posts.store']) }}
    <div>
        {{ Form::text('title', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter Title']) }}
        {{ Form::textarea('content', '', ['class' => 'form-control mb-3', 'rows' => 4, 'placeholder' => 'Content']) }}
        {{ Form::select('public_post', ['1' => 'Public', '0' => 'Private'], '1', ['class' => 'form-select form-select-sm my-3 pb-select-box']) }}
        {{ Form::hidden('author_id', Auth::id(), ['class' => 'form-control mb-3']) }}
        @foreach ($categories as $tag)
            {{ Form::checkbox('category_list[]', $tag->id, null, ['class' => 'form-check-input']) }}
            {{ Form::label($tag->name, $tag->name, null, ['class' => 'form-check-label']) }}
        @endforeach
        <a href="{{ route('categories.create', ['redirect' => 'posts/create']) }}">
            <i class="fas fa-plus add-category-icon"></i>
        </a>
        {{ Form::submit('Submit', ['class' => 'btn btn-secondary float-end px-5']) }}
    </div>
    {{ Form::close() }}
@endsection
