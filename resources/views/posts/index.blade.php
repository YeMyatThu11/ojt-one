@extends('layouts.app')
@section('content')
<h1>Post CRUD</h1>

<div class="d-flex justify-content-between flex-wrap">
    @foreach ($posts as $post)
        <div class="card m-3 align-self-start" style="width:300px;min-height:150px">
            <div class="card-body">
                <h5 class="card-title">{{$post->title}}</h5>
                <hr>
                <p class="card-text" style="margin-bottom: 50px">{{$post->content}}</p>
                <div class="d-flex " style="position: absolute;bottom:17px;">
                    <button class="btn mx-3 btn-primary btn-sm" type="button"><a style="text-decoration: none;color:#fff" href="/posts/{{$post->id}}/edit">Edit</a></button>
                    <form action="{{route('posts.destroy',$post->id)}}" method="post">
                        @csrf
                        @method('delete')
                        <button class="btn mx-3 btn-danger btn-sm" type="submit">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
