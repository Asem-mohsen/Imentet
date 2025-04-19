@extends('layout.template.email.email')

@section('title','Password Reset Request')

@section('content')

<td class="content-cell">
    <div class="f-fallback">

        <h1>Password Reset Request</h1>

        <p>You are receiving this email because we received a password reset request for your account.</p>

        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ route('auth.password.reset', ['token' => $token]) }}" style="background-color: rgb(217, 149, 120); color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px;">
                Reset Password
            </a>
        </p>

        <p>This password reset link will expire in 60 minutes.</p>

        <p>If you did not request a password reset, no further action is required.</p>

        <table class="body-sub" role="presentation">
            <tr>
                <td>
                    <p class="f-fallback sub">
                        Best regards, <br>
                        The {{config('app.name')}} Team
                    </p>
                </td>
            </tr>
        </table>
    </div>
</td>

@endsection