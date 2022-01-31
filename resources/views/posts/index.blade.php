@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between flex-wrap">
        @foreach ($posts as $post)
            <div class="card m-3 align-self-start" style="width:300px;min-height:150px">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $post->title }}
                        @if ($post->public_post == 0)

                            <i class="fas fa-lock private-post-icon"></i>

                        @endif
                    </h5>

                    @if ($post->user->id === Auth::id())
                        <div style="display:flex;position: absolute;right:6px;top:6px">
                            <a style="text-decoration: none;color:#fff;padding:3px"
                                href="{{ route('posts.edit', $post->id) }}">
                                <i class="fas fa-edit" style="color: rgb(151, 150, 150)"></i></a>
                            <form style="padding:3px" action="{{ route('posts.destroy', $post->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button style="background: #fff;border: 0;padding:0;" class="btn mr-3 btn-danger btn-sm"
                                    type="submit"><i class="fas fa-trash" style="color: rgb(151, 150, 150)"></i></button>

                            </form>
                        </div>
                    @endif

                    @foreach ($post->categories as $tag)
                        <a href="{{ route('categories.show', $tag->id) }}" class="bg-secondary"
                            style="color: #fff;padding:5px;border-radius:6px;font-size:9px;text-decoration:none">{{ $tag->name }}</a>
                    @endforeach
                    <hr>
                    <p class="card-text" style="margin-bottom: 50px">{{ $post->content }}</p>
                    <i class="fas fa-user" style="color: #808080;font-size:11px"></i><span
                        style="margin-left:5px;;font-size:11px;color:#808080">{{ $post->user->name }}</span>
                </div>
            </div>
        @endforeach

    </div>
    {{ $posts->links('vendor.pagination.cust_pagination') }}
@endsection

<style>
    .private-post-icon {
        font-size: 11px;
        color: #808080;
        padding-left: 11px;
        position: absolute;
        top: 19px;
    }

</style>
