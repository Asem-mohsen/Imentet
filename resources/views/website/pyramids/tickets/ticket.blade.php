@extends('layout.template.pyramids-template')

@section('title', 'Your Ticket')

@section('content')
<div class="container py-5">
    <div class="ticket-container">
        <div class="ticket">
            <div class="ticket-header">
                <img src="{{ asset('assets/GEM/images/resources/CairoEgMuseumTaaMaskMostlyPhotographed.jpg') }}" alt="Tutankhamun Mask" class="ticket-logo">
                <h1>Grand Egyptian Museum</h1>
                <p class="ticket-date">{{ now()->format('d F Y') }}</p>
            </div>

            <div class="ticket-body">
                <div class="ticket-info">
                    <div class="info-row">
                        <span class="label">Visitor Name:</span>
                        <span class="value">{{ $user->fullName }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Email:</span>
                        <span class="value">{{ $user->email }}</span>
                    </div>
                    <div class="info-row">
                        <span class="label">Visit Date:</span>
                        <span class="value">{{ $tickets->first()->visit_date->format('d F Y') }}</span>
                    </div>
                </div>

                <div class="ticket-details">
                    <h2>Ticket Details</h2>
                    <table class="ticket-table">
                        <thead>
                            <tr>
                                <th>Ticket Type</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket->type }}</td>
                                <td>{{ $ticket->quantity }}</td>
                                <td>{{ $ticket->price }} EGP</td>
                                <td>{{ $ticket->total }} EGP</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right"><strong>Total Amount:</strong></td>
                                <td><strong>{{ $total }} EGP</strong></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="ticket-footer">
                    <div class="qr-code">
                        <!-- QR Code will be generated here -->
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $tickets->first()->id }}" alt="Ticket QR Code">
                    </div>
                    <div class="ticket-terms">
                        <p>This ticket is non-refundable and non-transferable.</p>
                        <p>Please present this ticket at the museum entrance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.ticket-container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.ticket {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 0 20px rgba(0,0,0,0.1);
    overflow: hidden;
    position: relative;
}

.ticket::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 10px;
    background: linear-gradient(90deg, #d4af37, #f1c40f, #d4af37);
}

.ticket-header {
    background: #2c3e50;
    color: #fff;
    padding: 30px;
    text-align: center;
    position: relative;
}

.ticket-logo {
    width: 100px;
    height: 100px;
    margin-bottom: 20px;
}

.ticket-header h1 {
    font-size: 2.5rem;
    margin: 0;
    font-family: 'Times New Roman', serif;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.ticket-date {
    font-size: 1.2rem;
    margin: 10px 0 0;
    opacity: 0.8;
}

.ticket-body {
    padding: 30px;
}

.ticket-info {
    margin-bottom: 30px;
}

.info-row {
    display: flex;
    margin-bottom: 15px;
    font-size: 1.1rem;
}

.label {
    font-weight: bold;
    width: 150px;
    color: #2c3e50;
}

.value {
    flex: 1;
}

.ticket-details h2 {
    color: #2c3e50;
    margin-bottom: 20px;
    font-size: 1.5rem;
    text-align: center;
}

.ticket-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.ticket-table th,
.ticket-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #eee;
}

.ticket-table th {
    background: #f8f9fa;
    font-weight: bold;
    color: #2c3e50;
}

.ticket-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #eee;
}

.qr-code {
    flex: 0 0 150px;
}

.ticket-terms {
    flex: 1;
    margin-left: 30px;
    font-size: 0.9rem;
    color: #666;
}

@media print {
    .ticket {
        box-shadow: none;
    }
    
    .ticket::before {
        display: none;
    }
}
</style>
@endsection 