<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="background: #fff">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('auth.loginForm'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('auth.loginForm') }}">Login</a>
                                </li>
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('posts.index') }}">Home</a></li>
                            @endif

                            @if (Route::has('auth.registerForm'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('auth.registerForm') }}">Register</a>
                                </li>

                            @endif
                        @else
                            @if (Auth::user()->role == 1)
                                <li class="nav-item"><a class="nav-link"
                                        href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            @endif
                            <li class="nav-item"><a class="nav-link"
                                    href="{{ route('posts.index') }}">Home</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="{{ route('posts.create') }}">Add
                                    Post</a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="{{ route('categories.index') }}">Category</a></li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.profile', Auth()->user()->id) }}">
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('auth.logout') }}"
                                        onclick="event.preventDefault();
                                                                                                                                document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4 container  mt-2">
            @yield('content')
        </main>
        <!-- Modal -->
        <div class="modal fade" id="promoteConfirmation" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered model-dialog-adm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Confirm</h5>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form class="user-promote-form" action="" method="post">
                            @csrf
                            @method('put')
                            <button type="button" class="btn btn-secondary action-promote-btn">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered model-dialog-adm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Delete User</h5>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <form class="del-icon-form " action="" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-secondary action-delete-btn">Yes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(() => {
        var dataId;
        var tableName;
        $(document).on("click", ".btn-promote", function() {
            dataId = $(this).attr('data-item');
            var username = $(this).attr('data-name');
            var userRole = $(this).attr('data-role') == 1 ? 'user' : 'admin';
            $('.modal-body').text(
                `Are you sure about changing  ${username}'s role to ${userRole}?`);
        });
        $(document).on("click", ".action-promote-btn", () => {
            $('.user-promote-form').attr("action", `/user/${dataId}/changeRole`);
            $('.user-promote-form').submit();
        });
        $(document).on("click", ".btn-delete", function() {
            dataId = $(this).attr('data-item');
            var username = $(this).attr('data-name');
            tableName = $(this).attr('data-table');
            console.log(username, tableName);
            $('.modal-body').text(
                `Are you sure about deleting ${tableName?"this post?":"user "+username+" ?"}`);
        });
        $(document).on("click", ".action-delete-btn", () => {
            $('.del-icon-form').attr("action", `${tableName ? "/posts/" +dataId : "/user/" +dataId}`);
            $('.del-icon-form').submit();
        });
    });
</script>

</html>
