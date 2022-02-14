@extends('layouts.app')
@section('content')

    <div class="row justify-content-center">

        <div class="col-md-8">
            @if ($errors->any())
                <div>
                    @foreach ($errors->all() as $err)
                        <p class="alert alert-danger" role="alert">{{ $err }}</p>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">Change Password </div>
                <div class="card-body">
                    {{ Form::open(['route' => ['user.updatePW', $user->id], 'method' => 'put']) }}
                    <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" required
                                autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Confirm
                            Password</label>

                        <div class="col-md-6">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                                required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Change
                            </button>
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
