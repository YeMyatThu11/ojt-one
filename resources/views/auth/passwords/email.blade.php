@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Reset Password') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        {{ Form::open(['route' => 'auth.forgot-password']) }}
                        <div class="row mb-3">
                            {{ Form::label('email', 'Email', ['class' => 'col-md-4 col-form-label text-md-end', 'for' => 'password']) }}

                            <div class="col-md-6">
                                {{ Form::email('email', '', ['class' => 'form-control' . ($errors->has('email') ? 'is-invalid' : ''),'id' => 'email','required' => 'required','auto-complete' => 'email']) }}

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                {{ Form::submit('Send Password Reset Link', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
