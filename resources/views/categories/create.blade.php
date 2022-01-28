@extends('layouts.app')
@section('content')
    <h1 class="mt-2">Category Create</h1>
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
    <form action="{{ route('categories.store') }}" method="post">
        @csrf
        <input type="text" name="name" class="form-control mb-3" placeholder="Enter Name">
        <button class="btn btn-primary float-end px-5">Submit</button>
    </form>
@endsection
