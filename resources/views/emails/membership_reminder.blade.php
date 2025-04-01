@extends('layout.template.email.email')

@section('title','Reminder: Submit Your Membership Documents')

@section('content')

<td class="content-cell">
    <div class="f-fallback">
        <h1>Dear {{ $user->name }},</h1>
        <p>This is a reminder to submit your required membership documents. The deadline for submission is <strong>{{ $deadline }}</strong>.</p>
        <p>If you do not submit your documents by the deadline, your membership will be suspended.</p>
        <br>
        <p>Click the link below to upload your documents:</p>
            <a href="{{ $submissionLink }}">Submit Documents</a>
        <br>

        <p>Thank you.</p>

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