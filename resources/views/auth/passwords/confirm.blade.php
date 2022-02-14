@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Confirm Password') }}</div>

                    <div class="card-body">
                        {{ __('Please confirm your password before continuing.') }}
                        {{ Form::open(['route' => 'password.confirm']) }}
                        <div class="row mb-3">
                            {{ Form::label('password', 'Password', ['class' => 'col-md-4 col-form-label text-md-end', 'for' => 'password']) }}


                            <div class="col-md-6">
                                {{ Form::password('password', '', ['class' => 'form-control' . ($errors->has('password') ? 'is-invalid' : ''),'id' => 'password','required' => 'required','auto-complete' => 'current-password']) }}
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
