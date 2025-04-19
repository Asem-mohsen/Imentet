@component('mail::message')
# Order Confirmation

Dear {{ $payment->user->name }},

Thank you for your order from the Grand Egyptian Museum Shop. Here are your order details:

@component('mail::table')
| Item | Quantity | Price |
|:-----|:--------:|------:|
@foreach($items as $item)
| {{ $item->payable->name }} | {{ $item->quantity }} | {{ number_format($item->price * $item->quantity, 2) }} EGP |
@endforeach
@endcomponent

**Total Amount: {{ number_format($total, 2) }} EGP**

Payment Method: {{ ucfirst($payment->payment_method) }}
@if($payment->payment_method === 'cash')
Status: Pending (Cash on Delivery)
@else
Status: Completed
Transaction ID: {{ $payment->transaction_id }}
@endif

@component('mail::button', ['url' => route('profile.orders')])
View Order Details
@endcomponent

Thank you for shopping with us!

Best regards,<br>
{{ config('app.name') }}
@endcomponent 