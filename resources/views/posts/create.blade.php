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
        <input type="hidden" name="public_post" value=1 class="form-control mb-3">
        <input type="hidden" name="author_id" class="form-control mb-3" value={{ Auth::id() }}>

        @foreach ($categories as $tag)
            <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" name="category_list[]">
            <label class="form-check-label">
                {{ $tag->name }}
            </label>
        @endforeach
        <a href="{{ route('categories.create') }}"><i class="fas fa-plus" style="margin-left:10px;background: rgb(151, 150, 150);color:#fff;width:25px;height:25px;border-radius:50%;
                                padding: 5px 0px 0px 6px;"></i></a>
        <button class="btn btn-secondary float-end px-5">Submit</button>
    </form>
@endsection
