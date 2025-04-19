@extends('layout.template.email.email')

@section('title','Submit Your Membership Documents')

@section('content')
<td class="content-cell">
    <div class="f-fallback">

        <h1>Welcome to Your Membership!</h1>

        <p>Thank you for purchasing your membership. To complete your registration, please submit the required documents by clicking the button below:</p>

        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ $submissionLink }}" style="background-color: rgb(217, 149, 120); color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px;">
                Submit Documents
            </a>
        </p>

        <p>Please note that you have 7 days to submit your documents. After this period, your membership will be suspended.</p>

        <p>If you have any questions, please don't hesitate to contact us.</p>

        <p>Best regards,<br>The GEM Team</p>

    </div>
</td>
@endsection 