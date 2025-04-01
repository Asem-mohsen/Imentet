@extends('layout.template.gem-template')

@section('title' , 'Donations')

@section('content')

    <section class="inner-banner">
        <div class="container">
            <h2 class="inner-banner__title">Donations</h2>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="{{route('gem.home')}}">Home</a></li>
                <li>Donations</li>
            </ul>
        </div>
    </section>

  <!-- Donate -->
  <section class="cta-one cta-one__donation-page">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-lg-12">
          <div class="cta-one__block">
            <div class="cta-one__icon">
              <i class="egypt-icon-gift"></i>
            </div>
            <div class="cta-one__content">
              <h3 class="cta-one__title">
                Donate for <br />
                Achive Our Goal
              </h3>
              <p class="cta-one__text">
                Thank you for considering giving to the museum. Your gift
                <br />
                will allow future generations to discover.
              </p>
              <p class="cta-one__text">
                <span>Ways to Contribute to Our Museum:</span>
              </p>
              <ul class="list-unstyled cta-one__list">
                <li>
                  <i class="egypt-icon-check"></i>
                  Financial Donation
                </li>
                <li>
                  <i class="egypt-icon-check"></i>
                  Donate the Historical Artifacts
                </li>
              </ul>
              <a href="{{route('gem.contact.index')}}" class="cta-one__link">
                <i class="fa fa-angle-right"></i>
                Questions ? Contact Us Now </a>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-12">
          <img src="{{asset('assets/GEM/images/resources/donation-1.png')}}" alt="donations" class="img-fluid" />
        </div>
      </div>
    </div>
  </section>

  <!-- Donate Section Form -->
  <section class="donation-form">
    <div class="container">

      <div class="inner-container">
        <h3 class="donation-form__title text-center">Make a Donation</h3>
        <ul class="nav nav-tabs donation-form__tab">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab">
              Financial Donation
            </a>
          </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active animated fadeInUp" id="money">
                <form method='POST' action="{{route('gem.donations.store')}}" class="donation-form__form">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="donation-form__form-field">
                                <input type="text" name="first_name" placeholder="Your First Name*" value="{{ old('first_name') }}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="donation-form__form-field">
                            <input type="text" name="last_name" placeholder="Your Last Name*" value="{{ old('last_name') }}" required/>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="donation-form__form-field">
                                <input type="email" name="email" placeholder="Email Address*" value="{{ old('email') }}" required />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="donation-form__form-field">
                                <input type="number" name="phone" pattern="[0-9]*" placeholder="Phone Number" value="{{ old('phone') }}" />
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="donation-form__form-field">
                              <input type="number" name="amount" placeholder="$ Custom Amount" required/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="donation-form__form-field">
                              <select class="selectpicker" name="place_id">
                              <option selected disabled hidden>Donation For</option>
                                  @foreach($places as $place)
                                      <option value="{{$place->id}}">{{$place->name}}</option>
                                  @endforeach
                              </select>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="donation-form__form-field">
                            <textarea name="message" rows="5" placeholder="Leave a Message for us"></textarea>
                          </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="text-center">
                                <button type="submit" class="thm-btn donation-form__form-btn" >
                                Make Donation
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection
