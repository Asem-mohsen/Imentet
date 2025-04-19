@extends('layout.template.pyramids-template')

@section('title' , 'Donations')

@section('content')

  <section class="inner-banner">
    <div class="container">
      <h2 class="inner-banner__title">Donations</h2>
      <ul class="list-unstyled thm-breadcrumb">
        <li><a href="{{route('pyramids.home')}}">Home</a></li>
        <li>Donations</li>
      </ul>
    </div>
  </section>

  <!-- Donate -->
  <section class="cta-one cta-one__donation-page" style="background: #302e30;">
    <div class="container">
      <div class="row">
        <div class="col-xl-6 col-lg-12">
          <div class="cta-one__block">
            <div class="cta-one__icon">
              <i class="egypt-icon-gift"></i>
            </div>
            <div class="cta-one__content">
              <h3 class="cta-one__title" style="color: #fff;">
                Donate for <br />
                Achive Our Goal
              </h3>
              <p class="cta-one__text" style="color: #fff;">
                Thank you for considering giving to the Pyramids of Egypt.
              <br />
                Your gift will allow future generations to discover.                    
              </p>
              <p class="cta-one__text" style="color: #fff;">
                <span>Ways to Contribute to The Pyramids:</span>
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
                <li>
                  <i class="egypt-icon-check"></i>
                  Adopt an Artifact & Support the Pyramids
                </li>
              </ul>
              <a href="{{route('pyramids.contact.index')}}" class="cta-one__link" style="color: #fff;">
                <i class="fa fa-angle-right"></i>
                Questions ? Contact Us Now </a>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-12">
          <img loading="lazy" src="{{asset('assets/GEM/images/resources/donation-pyramids.png')}}" alt="Donations for Pyramids" class="img-fluid" />
        </div>
      </div>
    </div>
  </section>

  <!-- Donate Section Form -->
  <section class="donation-form" style="background: #302e30;">
    <div class="container">

      <div class="inner-container">
        <h3 class="donation-form__title text-center" style="color: #fff;">Make a Donation</h3>
        <ul class="nav nav-tabs donation-form__tab">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab">
              Financial Donation
            </a>
          </li>
        </ul>
        <x-forms.donation-form :route="route('imentet.donations.store')" :places="$places" :dark="true" />
      </div>
    </div>
  </section>

@endsection
