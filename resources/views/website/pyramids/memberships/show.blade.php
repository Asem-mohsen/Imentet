@extends('layout.template.pyramids-template')

@section('title' , $membership->name)

@section('content')

  <section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title">Membership Subscription</h2>
        <ul class="list-unstyled thm-breadcrumb">
          <li><a href="{{route('pyramids.home')}}">Home</a></li>
          <li><a href="{{route('pyramids.memberships.index')}}">Memberships</a></li>
          <li>{{$membership->nmae . " Membership"}}</li>
        </ul>
    </div>
  </section>

  <section class="event-details" style="background-color: #302e2f;">
    <div class="container">
      <div class="row">
        <div class="col-lg-8">
          <div class="event-details__content">   
            <div class="event-details__single" id="about-event">
                <div class="row">
                  <div class="col-md-12">
                    <div class="pricing-one__single wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                      <p class="pricing-one__name">Plan</p>
                      <h3 class="pricing-one__type" style="color: white;">For {{$membership->name}}</h3>
                      <p>Start from</p>
                      <p class="pricing-one__amount">{{ $minPrice }} EGP</p>
                      <p class="pricing-one__time" style="color: white;">EGP / {{ $formattedDurations }}</p>
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
                              <tr>
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
                                  <td>
                                    <input type="radio" name="selected_price" value="{{ $price->id }}" onchange="updatePrice(this.value)">
                                  </td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                  @endif

                    <h3 class="event-details__title" style="color: white;">Details About Plan</h3>

                    <p class="event-details__text">
                      {{$membership->description}}
                      <br/>
                      As a member, you'll enjoy a host of benefits designed to 
                      provide you with unparalleled access and immersive encounters.
                    </p>

                    <span class="mb-5" style="color: #d99578">
                        *Please be aware that this is a {{ $formattedDurations }} membership.
                    </span>

                    <h3 class="collection-details__subtitle mb-3 mt-4" style="color: white;">Plan Benefits</h3>
                     
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
          <div class="event-details__form">
            <h3 class="event-details__form-title">Membership Payement</h3>
            <form action="{{ route('pyramids.memberships.checkout' , $membership->id) }}" method="post">
              @csrf
              @if ($userMembership)
                <div class="row">
                  <div class="col-sm-12">
                    <p>
                      You Already Enrolled In <span style="color: #d99578"> {{ $userMembership->membership->name }} Plan </span>
                    </p>
                  </div>
                  <div class="col-sm-6">
                    <label for="started_at">Started At</label>
                    <input type="text" id="start_date" value="{{ $userMembership->start_date->format('d M Y') }}" disabled/>
                  </div>
                  <div class="col-sm-6">
                    <label for="ends_at">Ends At</label>
                    <input type="text" id="end_date" value="{{ $userMembership->end_date->format('d M Y') }}" disabled/>
                  </div>
                  <div class="col-sm-12">
                    <button class="thm-btn event-details__form-btn" disabled>
                      You can Renew it Soon
                    </button>
                  </div>
                </div>
              @else
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="text" name="name" placeholder="Your Name" value="{{old('name')}}"/>
                      <input type="hidden" id="price_id" name="price_id" value="{{ $membership->prices->first()->id }}"/>
                    </div>
                    <div class="col-sm-12">
                      <input type="text" name="email" placeholder="Email Address" value="{{old('email')}}"/>
                    </div>
                    <div class="col-sm-12">
                      <input type="text" name="start_date" placeholder="Start Date" class="datepicker normal-datepicker" value="{{old('start_date')}}"/>
                    </div>
                    <div class="col-sm-12">
                      @if(auth()->user())
                          <button class="thm-btn event-details__form-btn" >
                            Proceed to Book
                          </button>
                      @else
                        <a href="{{route('auth.login.index')}}" class="thm-btn event-details__form-btn" >
                          Sign In to Continue
                        </a>
                      @endif
                    </div>
                  </div>
              @endif
            </form>
          </div>
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