@extends('layouts.app')
@section('content')

    <div class="row">
        @if ($user->id !== Auth()->user()->id)
            <p class="alert alert-secondary" role="alert">Your are viewing {{ $user->name }}'s Profile</p>
        @endif
        <div class="user-siderbar col-lg-2">
            <div class="user-profile">
                <div class="profile-container">
                    <i class="fas fa-user user-logo-circle"></i>
                </div>
                <h5 class="user-name">{{ $user->name }}</h5>
                <p class="user-mail txt-grey">{{ $user->email }}</p>
                <div class="user-info mt-3 d-flex justify-content-center">
                    <div class="total-posts">
                        <h4 class="post-count">{{ $user->posts->count() }}</h4>
                        <p class="post-label">Total Posts</p>
                    </div>
                    <div class="join-date">
                        <h4 class="join-date-no">{{ date('d-m-y', strtotime($user->created_at)) }}</h4>
                        <p class="date-label">Joined Date</p>
                    </div>
                </div>
                @if ($user->id == Auth::id() || Auth()->user()->role == 1)
                    <div class="change-btn">
                        <a href="{{ route('user.edit', $user->id) }}" class="href-txt">Change Profile</a>
                    </div>
                    <div class="change-btn">
                        <a class="href-txt" href="{{ route('user.resetPWForm', $user->id) }}">Update Password</a>
                    </div>
                    @if ($user->id == Auth::id())
                        <div class="change-btn">
                            <a class="href-txt" href="{{ route('auth.logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="user-posts col-lg-8 offset-lg-1">
            <div class="d-flex  justify-content-center flex-wrap post-index">
                @foreach ($user->posts as $post)
                    <div class="card shadow  my-4 mx-3 align-self-start card-container"
                        onclick="clickHandler({{ $post->id }})">
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
                                    <form class="del-icon-form" action="{{ route('posts.destroy', $post->id) }}"
                                        method="post">
                                        @csrf
                                        @method('delete')
                                        <button class="action-del-btn" type="submit"><i
                                                class="fas fa-trash del-icon"></i></button>
                                    </form>
                                </div>
                            @endif

                            @foreach ($post->categories as $tag)
                                <a href="{{ route('categories.show', $tag->id) }}"
                                    class="bg-secondary tag">{{ $tag->name }}</a>
                            @endforeach
                            <hr>
                            <p class="card-text post-content"> {{ Str::limit($post->content, 90, $end = ' ...') }} </p>
                            <i class="fas fa-user user-icon"></i><span
                                class="author-name">{{ $post->user->name }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
<script>
    function clickHandler(id) {
        console.log('aa', id);
        let url = "{{ route('posts.show', ':id') }}";
        url = url.replace(':id', id);
        document.location.href = url;
    }
</script>
<style>
    .profile-container {
        margin: 0 auto;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.651);
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 12px;
    }

    .user-logo-circle {
        font-size: 30px;
        color: #fff;
        padding-bottom: 13px;
    }

    .user-name,
    .user-mail,
    .post-count,
    .post-label,
    .date-label,
    .join-date-no {
        text-align: center;
        margin-bottom: 0;
    }

    .txt-grey {
        color: #808080;
    }

    .total-posts {
        padding: 5px 10px 5px 0;
        border-right: 1px solid #808080;
    }

    .join-date {
        padding: 5px 0px 5px 10;
    }

    .change-btn {
        background: rgba(0, 0, 0, 0.651);
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        margin: 20px 0;
    }

    .href-txt {
        display: block;
        color: #fff;
        text-decoration: none;
        text-align: center;
    }

    .href-txt:hover {
        color: #fff
    }

</style>
