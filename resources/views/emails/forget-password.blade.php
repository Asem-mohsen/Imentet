@extends('layout.template.email.email')

@section('title','Reset Password')

@section('content')

<td class="content-cell">
    <div class="f-fallback">
        <h1>Hi, {{ $name }}!</h1>
        <p>We received a request to reset your password for your {{config('app.name')}} account. Click the link below to create a new password:</p>
            <a href="{{ $resetUrl }}">Reset Password Link</a>
        <br>
        <p>For security purposes, this link will expire in 24 hours. If you didn’t request a password reset, please ignore this email or contact us immediately at <a href="mailto:{{ $supportMail }}">{{ $supportMail }}</a>.</p>

        <!-- Sub copy -->
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