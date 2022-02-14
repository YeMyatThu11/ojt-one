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
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {!! Form::open(['route' => 'categories.store']) !!}
    @isset($redirect)
        {{ Form::hidden('redirect', $redirect) }}
    @endisset
    {{ Form::text('name', '', ['class' => 'form-control mb-3', 'placeholder' => 'Enter Name']) }}
    {{ Form::submit('Submit', ['class' => 'btn btn-secondary float-end px-5']) }}
    {!! Form::close() !!}
@endsection
