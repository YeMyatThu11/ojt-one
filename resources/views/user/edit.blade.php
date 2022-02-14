@extends('layouts.app')
@section('content')

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile Update</div>
                <div class="card-body">
                    {{ Form::open(['route' => ['user.update', $user->id], 'method' => 'put']) }}
                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                        <div class="col-md-6">
                            {{ Form::text('name', $user->name, ['class' => 'form-control','placeholder' => 'Enter Title','required' => 'required']) }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                        <div class="col-md-6">
                            {{ Form::email('email', $user->email, ['class' => 'form-control', 'id' => 'email', 'required' => 'required']) }}
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-8 offset-md-4">
                            {{ Form::submit('Change', ['class' => 'btn btn-secondary']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
