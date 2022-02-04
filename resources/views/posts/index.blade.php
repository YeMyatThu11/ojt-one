@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-between flex-wrap post-index">
        @foreach ($posts as $post)
            <div class="card shadow  my-4 mx-3 align-self-start card-container" onclick="clickHandler({{ $post->id }})">
                <div class="card-body">
                    <h5 class="card-title">
                        {{ $post->title }}
                        @if ($post->public_post == 0)
                            <i class="fas fa-lock private-post-icon"></i>
                        @endif
                    </h5>

                    @if ($post->user->id === Auth::id() || (Auth()->user() ? Auth()->user()->role == 1 : false))
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
                        <a href="{{ route('categories.show', $tag->id) }}"
                            class="bg-secondary tag">{{ $tag->name }}</a>
                    @endforeach
                    <hr>
                    <p class="card-text post-content"> {{ Str::limit($post->content, 80, $end = ' ...') }} </p>
                    <div class="author-container">
                        <i class="fas fa-user user-icon"></i><span class="author-name">{{ $post->user->name }}</span>
                    </div>

                </div>
            </div>
        @endforeach

    </div>
    {{ $posts->links('vendor.pagination.cust_pagination') }}
@endsection
<script>
    function clickHandler(id) {
        console.log('aa', id);
        let url = "{{ route('posts.show', ':id') }}";
        url = url.replace(':id', id);
        document.location.href = url;
    }
</script>
