@extends('layout.template.email.email')

@section('title','Reminder: Submit Your Membership Documents')

@section('content')
<td class="content-cell">
    <div class="f-fallback">
        <h1>Membership Document Submission Reminder</h1>
        
        <p>We noticed that you haven't submitted your required documents for your membership yet. Your membership is currently suspended until you submit the necessary documents.</p>
        
        <p style="text-align: center; margin: 30px 0;">
            <a href="{{ $submissionLink }}" style="background-color: rgb(217, 149, 120); color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px;">
                Submit Documents
            </a>
        </p>
        
        <p>Please submit your documents as soon as possible to activate your membership and enjoy all the benefits.</p>
        
        <p>If you have any questions or need assistance, please don't hesitate to contact us.</p>
        
        <p>Best regards,<br>The GEM Team</p>
    </div>
</td>
@endsection 