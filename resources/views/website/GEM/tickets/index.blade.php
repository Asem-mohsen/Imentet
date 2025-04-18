@extends('layout.template.gem-template')

@section('title' , 'Tickets')

@section('content')

<style>
    #phone-cell {
        display: flex;
        justify-content: space-between;
    }
    #phone-edit-form{
        width: 100%;
    }
    .save-phone-btn{
        background-color: #d99578;
        border-color: #d99578;
    }
    .save-phone-btn:hover{
        background-color: #e5926f;
        border-color: #e5926f;
    }
    #phone-edit-form .form-control:focus {
        box-shadow: none;
    }
    .edit-phone-btn {
        color: #302e2f;
        border-color: #302e2f;
    }
    .edit-phone-btn:hover {
        background-color: #d99578;
        border-color: #d99578;
    }
    .cancel-phone-btn{
        background-color: #302e2f;
        border-color: #302e2f;
    }
    .cancel-phone-btn:hover{
        background-color: #302e2f;
        border-color: #302e2f;
    }
</style>
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
                        <form method='POST' action="{{ route('gem.tickets.storeSelections') }}" id="ticketForm">
                            @csrf
                            <div class="top-tabs">
                                <ul class="nav nav-tabs plan-visit__map-tab-links" role="tablist">
                                    <li class="nav-item">
                                        <a role="tab" data-toggle="tab" href="#egyptian" class="nav-link active">Egyptian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a role="tab" data-toggle="tab" href="#other" class="nav-link">Other Nationalities</a>
                                    </li>
                                </ul>
                                <div class="select-date">
                                    <div>
                                        <i class="fa fa-calendar-o"></i> Select Date
                                    </div>
                                    <div id="searchByDate-tab" class="event-sorting__tab-content tab-pane animated fadeInUp">
                                        <input type="text" name="visit_date" class="searchByDate-datepicker" value="{{date('Y-m-d')}}" readonly />                        
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div class="tab-pane animated fadeInUp show active" id="egyptian">
                                    <div class="plan-visit__map-content">
                                        <div class="table-outer table-responsive">
                                            <table class="cart-table">
                                                <thead class="cart-header">
                                                    <tr>
                                                        <th class="prod-column">Type</th>
                                                        <th class="price">Price</th>
                                                        <th>Quantity</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($egyptians as $egyptian)
                                                        <tr>
                                                            <td class="prod-column">
                                                                <div class="column-box">
                                                                    <h3 class="prod-title padd-top-20">
                                                                        GEM - {{ $egyptian->ticket_type }}
                                                                    </h3>
                                                                </div>
                                                            </td>
                                                            <td class="price">
                                                                {{ $egyptian->price }} EGP
                                                            </td>
                                                            <td class="qty">
                                                                <input type="hidden" name="ticket_id[]" value="{{ $egyptian->id }}">
                                                                <input class="quantity-spinner Quantity" max="10" min="0" value="0" type="number" name="quantity[]" />
                                                            </td>
                                                            <td class="SubTotal"></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="cart-total custom-cart-total">
                                                <h3 class="cart-total__text text-uppercase">
                                                    Total Price:
                                                    <span class="text-capitalize cart-total__highlight GrandTotal">
                                                    
                                                    </span>
                                                </h3>
                                                @if (auth()->user())
                                                    <button type="submit" class="thm-btn cart-update__btn cart-update__btn-three">
                                                        Next
                                                    </button>
                                                @else
                                                    <a href="{{route('auth.login.index')}}" class="thm-btn donation-form__form-btn" >
                                                        Sign In To Continue
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane animated fadeInUp" id="other">
                                    <div class="plan-visit__map-content">
                                        <div class="table-outer table-responsive">
                                            <table class="cart-table">
                                                <thead class="cart-header">
                                                    <tr>
                                                        <th class="prod-column">Type</th>
                                                        <th class="price">Price</th>
                                                        <th>Quantity</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Forigeners -->
                                                    @foreach($foreigners as $foreigner)
                                                        <tr>
                                                            <td class="prod-column">
                                                                <div class="column-box">
                                                                    <h3 class="prod-title padd-top-20">
                                                                        GEM - {{ $foreigner->ticket_type}}
                                                                    </h3>
                                                                </div>
                                                            </td>
                                                            <td class="price">
                                                                {{ $foreigner->price }} EGP
                                                            </td>
                                                            <td class="qty">
                                                                <input type="hidden" name="ticket_id[]" value="{{ $foreigner->id }}">
                                                                <input class="quantity-spinner Quantity" max="10" min="0" value="0" type="number"  name="quantity[]" />
                                                            </td>
                                                            <td class="SubTotal"></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>

                                            <div class="cart-total custom-cart-total">
                                                <h3 class="cart-total__text text-uppercase">
                                                    Total Price:
                                                    <span class="text-capitalize cart-total__highlight GrandTotal">
                                                    
                                                    </span>
                                                </h3>
                                                @if (auth()->user())
                                                    <button type="submit" class="thm-btn cart-update__btn cart-update__btn-three">
                                                        Next
                                                    </button>
                                                @else
                                                    <a href="{{route('auth.login.index')}}" class="thm-btn donation-form__form-btn" >
                                                        Sign In To Continue
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Contact -->
                    <div class="tab-pane animated fadeInUp" id="contact">
                        <form method='POST' action="{{ route('imentet.contact.store') }}" class="donation-form__form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="donation-form__form-field">
                                        <input type="text" name="first_name" placeholder="First Name" value="{{old('first_name')}}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="donation-form__form-field">
                                        <input type="text" name="last_name" placeholder="Last Name" value="{{old('last_name')}}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="donation-form__form-field">
                                        <input type="email" name="email" placeholder="Your Email Address" value="{{old('email')}}"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="donation-form__form-field">
                                        <input type="number" name="phone" placeholder="Your Phone Number" value="{{old('phone')}}" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="donation-form__form-field">
                                        <input type="text" name="subject" placeholder="Subject" value="{{ old(key: 'subject') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="donation-form__form-field">
                                        <textarea name="message"placeholder="Leave your message here..." rows="5" required>{{old('message')}}</textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="text-center">
                                        @if (auth()->user())
                                            <button type="submit" class="thm-btn donation-form__form-btn" >
                                                Next
                                            </button>
                                        @else
                                            <a href="{{route('auth.login.index')}}" class="thm-btn donation-form__form-btn" >
                                                Sign In To Continue
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
            
                    <!-- Payment -->
                    @if($user)
                        <div class="tab-pane animated fadeInUp" id="payment">
                            <form method="POST" action="{{route('gem.payments.tickets')}}" class="donation-form__form">
                                <div class="row">
                                    <div class="col-md-12 mb-4">
                                        <h3>Payment Summary</h3>
                                        <div class="table-outer table-responsive">
                                            <table class="cart-table custom">
                                                <thead class="cart-header">
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Phone Number</th>
                                                        <th>Email</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>{{$user->fullName}}</td>
                                                        <td id="phone-cell">
                                                            @if($user->phone)
                                                                <span id="phone-display">{{$user->phone}}</span>
                                                                <button type="button" class="btn btn-sm btn-outline-primary edit-phone-btn" data-toggle="tooltip" title="Edit phone number">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                            @else
                                                                <span id="phone-display">No phone number</span>
                                                                <button type="button" class="btn btn-sm btn-primary add-phone-btn">
                                                                    Add Phone Number
                                                                </button>
                                                            @endif
                                                            <div id="phone-edit-form" class="d-none">
                                                                <div class="input-group">
                                                                    <input type="tel" id="phone-input" class="form-control" placeholder="Enter your phone number" value="{{$user->phone}}">
                                                                    <div class="input-group-append">
                                                                        <button type="button" class="btn btn-success save-phone-btn">Save</button>
                                                                        <button type="button" class="btn btn-secondary cancel-phone-btn">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>{{$user->email}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Cart -->
                                    <div class="col-md-12 mt-8">
                                        <h3>Your Cart</h3>

                                        @if($selectedTickets->isNotEmpty())
                                            <p>Selected ticket date: {{ $selectedTickets->first()->visit_date->format('d F Y') }}</p>
                                        @endif

                                        <div class="table-outer table-responsive">
                                            <table class="cart-table custom">
                                                <thead class="cart-header">
                                                    <tr>
                                                    <th class="prod-column">Type</th>
                                                    <th class="price">Price</th>
                                                    <th>Quantity</th>
                                                    <th>Subtotal</th>
                                                    <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse($selectedTickets as $ticket)
                                                        <tr data-ticket-id="{{ $ticket->id }}">
                                                            <td>{{ $ticket->type }}</td>
                                                            <td>{{ $ticket->price }} EGP</td>
                                                            <td class="qty">{{ $ticket->quantity }}</td>
                                                            <td class="sub-total">{{ $ticket->total }} EGP</td>
                                                            <td class="remove">
                                                                <button type="button" class="remove-ticket-btn" data-ticket-id="{{ $ticket->id }}">
                                                                    <span class="egypt-icon-remove"></span> 
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <tr><td colspan="5" style="text-align: center">No tickets selected.</td></tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                            <div class="cart-total custom-cart-total">
                                                @if($selectedTickets->isNotEmpty())
                                                    <a href="{{ route('gem.tickets.payment') }}" class="thm-btn cart-update__btn cart-update__btn-three">
                                                        Pay Now
                                                    </a>
                                                @else
                                                    <a href="{{route('gem.tickets.index')}}" class="thm-btn cart-update__btn cart-update__btn-three">
                                                        Select Tickets
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection

@section('js')
    @include('website.gem.tickets.scripts.tickets-script')
@endsection