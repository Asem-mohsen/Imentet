@props(['event'])

<div class="event-details__form">
    <form method="POST" action="{{ route('imentet.events.store', $event->id) }}">
      @csrf
      <h3 class="event-details__form-title">Online Booking</h3>
        <div class="row">

            <div class="col-sm-12">
                <input type="text" name="email" placeholder="Email Address" value="{{old('email')}}"/>
            </div>

            <div class="col-sm-12">
              <select id="categorySelect" class="selectpicker" name="selected_categories[]" multiple onchange="toggleQuantities()">
                <option hidden disabled>Select Ticket Category</option>
                @foreach($event->prices as $price)
                    <option value="{{ $price->category }}" 
                            data-egyptian="{{ $price->price_egyptian }}" 
                            data-arab="{{ $price->price_arab }}" 
                            data-foreigner="{{ $price->price_foreigner }}">
                        {{ $price->category }}
                    </option>
                @endforeach
              </select>
            </div>

            <!-- Quantities (Initially Hidden) -->
            <div id="quantitiesContainer" style="display:none;">
              @foreach($event->prices as $price)
                  <div class="category-quantity" id="category-{{ Str::slug($price->category) }}" style="display:none;">
                      <h4>{{ $price->category }}</h4>
                      
                      <div class="row">
                          <!-- Egyptians -->
                          <div class="col-sm-4">
                              <label>Egyptians</label>
                              <input class="quantity-spinner Quantity" type="text" value="0" min="0" max="10" 
                                     name="quantities[{{ $price->category }}][egyptian]" 
                                     data-price="{{ $price->price_egyptian }}" 
                                     onchange="subTotal()"/>
                          </div>
  
                          <!-- Arabs -->
                          <div class="col-sm-4">
                              <label>Arabs</label>
                              <input class="quantity-spinner Quantity" type="text" value="0" min="0" max="10" 
                                     name="quantities[{{ $price->category }}][arab]" 
                                     data-price="{{ $price->price_arab }}" 
                                     onchange="subTotal()"/>
                          </div>
  
                          <!-- Foreigners -->
                          <div class="col-sm-4">
                              <label>Foreigners</label>
                              <input class="quantity-spinner Quantity" type="text" value="0" min="0" max="10" 
                                     name="quantities[{{ $price->category }}][foreigner]" 
                                     data-price="{{ $price->price_foreigner }}" 
                                     onchange="subTotal()"/>
                          </div>
                      </div>
                  </div>
              @endforeach
            </div>
            
            <div class="col-sm-12">
              <strong>Total:</strong>
              <span class="text-capitalize cart-total__highlight" id="TotalPrice">0</span> EGP
            </div>

            <div class="col-sm-12">
                @if(!$event->isHappening())
                    @if(now() > $event->start_time)
                        <button type="submit" class="thm-btn event-details__form-btn" disabled>
                            Event Date has Passed
                        </button>
                    @elseif($event->status === 'cancelled')
                        <button type="submit" class="thm-btn event-details__form-btn" disabled>
                            Event Cancelled
                        </button>
                    @elseif($event->status === 'postponed')
                        <button type="submit" class="thm-btn event-details__form-btn" disabled>
                            Event Postponed
                        </button>
                    @endif
                @else
                    @if(auth()->user())
                        <button type="submit" class="thm-btn event-details__form-btn" >
                            Proceed to Book
                        </button>
                    @else
                        <a href="{{route('auth.login.index')}}" class="thm-btn event-details__form-btn" >
                            Sign In to Continue
                        </a>
                    @endif
                @endif
            </div>
        </div>
    </form>
</div>