@extends('layout.template.email.email')

@section('title','Complete Your Membership Registration')

@section('content')

<td class="content-cell">
    <div class="f-fallback">
        <h1>Congratulations on your membership!</h1>
        <p>To complete your registration, please submit the required documents using the link below:</p>

            <a href="{{ $submissionLink }}">Submit Documents</a>
        <br>
        <p>For security purposes, this link will expire in 7 days.</p>

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