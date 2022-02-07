@component('mail::message')
    # Reset Password

    Please Click the button below to reset password
    {{ $token }}

    @component('mail::button', ['url' => 'localhost:8000/reset-password/{{ $token }}'])
        Reset Password
    @endcomponent

    Admin Team,
@endcomponent
