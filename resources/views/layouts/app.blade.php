<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Post CRUD</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    </head>
    <body>
        <div class="container  mt-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('posts.index')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('posts.create')}}">Create</a></li>
                </ol>
            </nav>
            @yield('content')
        </div>
    </body>
    <script src="{{ asset('js/app.js') }}"></script>
</html>
