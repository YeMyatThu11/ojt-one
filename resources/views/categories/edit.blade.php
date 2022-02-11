@extends('layouts.app')
@section('content')
    <h1 class="mt-2">Category Edit</h1>
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
    {!! Form::open(['route' => ['categories.update', $category->id], 'method' => 'put']) !!}
    <div>
        <input type="text" name="name" value="{{ $category->name }}" class="form-control mb-3" placeholder="Enter Name">
        <button class="btn btn-primary float-end px-5">Submit</button>
    </div>
    {!! Form::close() !!}
@endsection
