@extends('layouts.app')
@section('content')

    <div class="d-flex justify-content-lg-start justify-content-sm-center flex-wrap post-index">
        @foreach ($posts as $post)
            <div class="card shadow  my-4 mx-3 align-self-start card-container">
                <div class="card-body d-flex flex-column">
                    <div>
                        <h5 class="card-title post-title" style="padding-right:40px">
                            {{ $post->title }}
                            @if ($post->public_post == 0)
                                <i class="fas fa-lock private-post-icon"></i>
                            @endif
                        </h5>
                        @if ($post->user->id === Auth::id() || (Auth()->user() ? Auth()->user()->role == 1 : false))
                            <div class="action-btn-wrapper">
                                <a class="action-btn" href="{{ route('posts.edit', $post->id) }}">
                                    <i class="fas fa-edit edit-icon"></i></a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteConfirmation" data-table="posts"
                                    class=" action-btn btn-delete" data-item="{{ $post->id }}" type="submit">
                                    <i class="fas fa-trash del-icon"></i>
                                </a>
                            </div>
                        @endif

                        @foreach ($post->categories as $tag)
                            <a href="{{ route('categories.show', $tag->id) }}"
                                class="bg-secondary tag">{{ $tag->name }}</a>
                        @endforeach
                        <hr>
                    </div>
                    <div style="flex: 1" onclick="clickHandler({{ $post->id }})">
                        <p class="card-text post-content">
                            {{ Str::limit($post->content, 80, $end = ' ...') }} </p>
                        <div class="author-container">
                            <i class="fas fa-user user-icon"></i>
                            <a class="author-name" href="{{ route('user.profile', $post->user->id) }}">
                                {{ $post->user->name }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if (method_exists($posts, 'links'))
        {{ $posts->links('vendor.pagination.cust_pagination') }}
    @endif

    <script>
        function clickHandler(id) {
            console.log('aa', id);
            let url = "{{ route('posts.show', ':id') }}";
            url = url.replace(':id', id);
            document.location.href = url;
        }
    </script>
@endsection
