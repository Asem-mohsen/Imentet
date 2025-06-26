@extends('layout.template.pyramids-template')

@section('title' , 'Tickets')

@section('content')

    <section class="donation-form spacing">
        <div class="container">
            <div class="inner-container">
                <h3 class="donation-form__title text-center">Book your Ticket</h3>
                <ul class="nav nav-tabs donation-form__tab">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#tickets">Tickets</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#contact" >Contact Details</a>
                    </li>
                    @if (auth()->user())
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#payment">Payment</a>
                        </li>
                    @endif
                </ul>

                <div class="tab-content">
                    
                    <!-- Tickets -->
                    <div class="tab-pane show active animated fadeInUp" id="tickets">
                        <x-forms.tickets-form :egyptians="$egyptians" :foreigners="$foreigners" />
                    </div>

                    <!-- Contact -->
                    <div class="tab-pane animated fadeInUp" id="contact">
                        <x-forms.contact-form :route="route('imentet.contact.store')" />
                    </div>
            
                    <!-- Payment -->
                    <x-forms.tickets-pay-form :redirectTo="route('pyramids.tickets.index')" :user="$user" :selectedTickets="$selectedTickets" />

                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    @include('components.scripts.tickets-script', ['ticketsIndexRoute' => route('pyramids.tickets.index')])
@endsection