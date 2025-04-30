@extends('layout.template.pyramids-template')

@section('title' , 'Careers')

@section('content')

    <section class="inner-banner">
        <div class="container">
        <h2 class="inner-banner__title">Careers</h2>
            <p class="inner-banner__text">
                Join our team now
            </p>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{route('pyramids.home')}}">Home</a></li>
            <li><a href="{{route('pyramids.about')}}">The Museum</a></li>
            <li>Careers</li>
        </ul>
        </div>
    </section>
  
  <section class="contact-one">
    <div class="container">

        <div class="row">
          <div class="col-lg-6">
            <div class="contact-one__main">
              <div class="contact-one__image">
                <img loading="lazy" src="{{asset('assets/GEM/images/resources/membership-1.png')}}" class="img-fluid" alt="GEM Contact Us" />
              </div>
              <div class="contact-one__content">
                <div class="row no-gutters">
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <x-forms.career-form :careers="$careers"/>
          </div>
        </div>
        
    </div>
  </section>

@endsection