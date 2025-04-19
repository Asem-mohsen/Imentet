@extends('layout.template.gem-template')

@section('title' , $membership->name)

@section('content')

  <section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title">Membership Subscription</h2>
        <ul class="list-unstyled thm-breadcrumb">
          <li><a href="{{route('gem.home')}}">Home</a></li>
          <li><a href="{{route('gem.memberships.index')}}">Memberships</a></li>
          <li>{{$membership->name . " Membership"}}</li>
        </ul>
    </div>
  </section>

  <section class="event-details">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="event-details__content">   
            <div class="event-details__single" id="about-event">
                <div class="row">
                  <div class="col-md-12">
                    <div class="pricing-one__single wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                      <p class="pricing-one__name">Plan</p>
                      <h3 class="pricing-one__type">For {{$membership->name}}</h3>
                      <p>Start from</p>
                      <p class="pricing-one__amount">{{ $minPrice }} EGP</p>
                      <p class="pricing-one__time">EGP / {{ $formattedDurations }}</p>
                    </div>
                  </div>
                </div>             
                <div class="event-details__single" id="about-event">

                  @if ($isMultipleDurations)
                    <h3 class="event-details__title">Plan Pricing</h3>
                    
                    <table class="cart-table mb-5 min-width-0">
                      <thead class="cart-header">
                          <tr>
                              <th>Nationality</th>
                              <th>Price</th>
                              <th>Duration</th>
                              <th>Select</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach ($membership->prices as $price)
                              <tr class="price-row">
                                  <td style="white-space: nowrap">
                                      <div class="column-box">
                                          <h3 class="prod-title padd-top-20">
                                            {{$price->visitorType->name}}
                                          </h3>
                                      </div>
                                  </td>
                                  <td style="white-space: nowrap">
                                      {{$price->price . ' EGP'}}
                                  </td>
                                  <td>
                                    {{$price->duration}}
                                  </td>
                                  <td class="text-center">
                                    <label class="custom-radio">
                                        <input type="radio" name="selected_price" value="{{ $price->id }}" onchange="updatePrice(this.value)">
                                        <span class="radio-checkmark"></span>
                                    </label>
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  @endif

                    <h3 class="event-details__title">Details About Plan</h3>

                    <p class="event-details__text">
                      {{$membership->description}}
                      <br/>
                      As a member, you'll enjoy a host of benefits designed to 
                      provide you with unparalleled access and immersive encounters.
                    </p>

                    <span class="mb-5" style="color: #d99578">
                        *Please be aware that this is a {{ $formattedDurations }} membership.
                    </span>

                    <h3 class="collection-details__subtitle mb-3 mt-4">Plan Benefits</h3>
                     
                    <ul class="collection-details__list list-unstyled">
                      @foreach($membership->features as $feature)
                        <li><i class="egypt-icon-check"></i> {{ $feature->name }}</li>
                      @endforeach
                    </ul>
                </div>
              </div>
          </div>
        </div>

        <!-- Payment -->
        <div class="col-lg-4">
            <x-forms.membership-form 
                :route="route('imentet.memberships.checkout', $membership->id)"
                :userMembership="$userMembership"
                :membership="$membership"
            />
        </div>
      </div>
    </div>
  </section>

@endsection

@section('js')
  <script>
    function updatePrice(priceId) {
        document.getElementById('price_id').value = priceId;
    }
  </script>
@endsection