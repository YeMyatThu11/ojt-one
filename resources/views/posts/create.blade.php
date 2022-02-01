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
    <form action="{{ route('posts.store') }}" method="post">
        @csrf
        <input type="text" name="title" class="form-control mb-3" placeholder="Enter Title">
        <textarea type="text" name="content" rows="4" class="form-control mb-3" placeholder="Content"></textarea>
        <select class="form-select form-select-sm my-3 pb-select-box" name="public_post"
            aria-label=".form-select-sm example">
            <option value=1>Public </option>
            <option value=0>Private</option>
        </select>
        <input type="hidden" name="author_id" class="form-control mb-3" value={{ Auth::id() }}>

        @foreach ($categories as $tag)
            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="category_list[]">
            <label class="form-check-label">
                {{ $tag->name }}
            </label>
        @endforeach
        <a href="{{ route('categories.create', ['redirect' => 'posts/create']) }}">
            <i class="fas fa-plus add-category-icon"></i>
        </a>
        <button class="btn btn-secondary float-end px-5">Submit</button>
    </form>
@endsection
