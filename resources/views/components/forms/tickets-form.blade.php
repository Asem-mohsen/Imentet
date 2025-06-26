<form method='POST' action="{{ route('imentet.tickets.storeSelections') }}" id="ticketForm">
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
                                        <input class="quantity-spinner Quantity" max="10" min="0" type="number" name="quantity[]" />
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
                        <button type="submit" class="thm-btn cart-update__btn cart-update__btn-three">
                            Next
                        </button>
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
                                        <input class="quantity-spinner Quantity" max="10" min="0" type="number"  name="quantity[]" />
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
                        <button type="submit" class="thm-btn cart-update__btn cart-update__btn-three">
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>