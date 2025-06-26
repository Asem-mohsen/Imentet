@if($user)
<div class="tab-pane animated fadeInUp" id="payment">
    <form method="POST" action="{{route('imentet.payments.tickets')}}" class="donation-form__form">
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
                            <a href="{{ route('imentet.payments.tickets') }}" class="thm-btn cart-update__btn cart-update__btn-three">
                                Pay Now
                            </a>
                        @else
                            <a href="{{ $redirectTo }}" class="thm-btn cart-update__btn cart-update__btn-three">
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