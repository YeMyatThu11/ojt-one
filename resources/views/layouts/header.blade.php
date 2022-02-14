<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        @if (Request::segment(1) == 'posts')
            {{ Form::open(['route' => ['posts.index'], 'method' => 'get']) }}
            <div class="form-inline my-2 my-lg-0">
                {{ Form::search('s', isset($term) ? $term : '', ['class' => 'form-control mr-sm-2','placeholder' => 'Search Posts','aria-label' => 'Search']) }}
            </div>
            {{ Form::close() }}
        @endif

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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
                        <li class="nav-item"><a class="nav-link" href="{{ route('posts.index') }}">Home</a>
                        </li>
                    @endif

                    @if (Route::has('auth.registerForm'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.registerForm') }}">Register</a>
                        </li>
                    @endif
                @else
                    @if (Auth::user()->role == 1)
                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('admin.posts') }}">Dashboard</a></li>
                    @endif
                    <li class="nav-item"><a class="nav-link" href="{{ route('posts.index') }}">Home</a>
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
                            {{ Form::open(['route' => 'auth.logout', 'method' => 'post', 'id' => 'logout-form']) }}
                            {{ Form::close() }}
                        </div>
                    </li>

                @endguest
            </ul>
        </div>
    </div>
</nav>
