@extends('layouts.app')

@section('content')
    <div class="container">
        @foreach ($errors->all() as $err)
            <p class="alert alert-danger" role="alert">{{ $err }}</p>
        @endforeach
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        {{ Form::open(['route' => 'auth.register']) }}
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Name</label>

                            <div class="col-md-6">
                                {{ Form::text('name', '', ['id' => 'name','class' => 'form-control' . ($errors->has('name') ? 'is-invalid' : ''),'required' => 'required','auto-complete' => 'email']) }}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                            <div class="col-md-6">
                                {{ Form::email('email', old('email'), ['class' => 'form-control' . ($errors->has('email') ? 'is-invalid' : ''),'id' => 'email','required' => 'required','auto-complete' => 'email']) }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                            <div class="col-md-6">
                                {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? 'is-invalid' : ''),'id' => 'password','required' => 'required','auto-complete' => 'new-password']) }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm
                                Password</label>

                            <div class="col-md-6">
                                {{ Form::password('password_confirmation', ['class' => 'form-control','id' => 'password-confirm','required' => 'required']) }}
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{ Form::submit('Register', ['class' => 'btn btn-secondary']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
