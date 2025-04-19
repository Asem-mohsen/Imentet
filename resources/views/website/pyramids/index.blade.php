@extends('layout.template.pyramids-template')

@section('title' , 'Pyramids')

@section('content')

  <!-- Slider Section -->
  <section class="slider-two">
    <div class="slider-one__carousel owl-carousel owl-theme">
      <div class="item slider-two__slider-1" style="background-image: url('{{ asset('assets/GEM/images/new/slider/slider-1-1.png') }}'); background-blend-mode: overlay;">
        <div class="container text-left">
          <p class="slider-two__tag-line">The Pyramids of Egypt:</p>
          <h2 class="slider-two__title">A Wonder of the World</h2>
          <p class="slider-two__text">
            The Pyramids of Egypt, built over 4,500 years ago, <br />
            are iconic and enigmatic structures that captivate people worldwide.
          </p>
          <a href="{{route('pyramids.about')}}" class="thm-btn slider-two__btn">Find Out More</a>
        </div>
      </div>
      <div class="item slider-two__slider-2" style="background-image: url('{{ asset('assets/GEM/images/new/slider/slider-2-2.png') }}'); background-blend-mode: overlay;" >
        <div class="container text-center">
          <p class="slider-two__tag-line">The Enigmatic Legacy of</p>
          <h2 class="slider-two__title">The Ancient World</h2>
          <p class="slider-two__text">
            Visiting the Pyramids of Egypt is an opportunity to unravel the mysteries of  <br />
            the ancient world and discover the secrets of the pharaohs.
          </p>
          <a href="{{route('pyramids.tickets.index')}}" class="thm-btn slider-two__btn">Visit Now</a>
        </div>
      </div>
      <div class="item slider-two__slider-3" style="background-image: url('{{ asset('assets/GEM/images/new/slider/slider-2-3.png') }}'); background-blend-mode: overlay;" >
        <div class="container text-left">
          <div class="row justify-content-end">
            <div class="col-xl-7 col-lg-9">
              <p class="slider-two__tag-line">Rock the Pyramids:</p>
              <h2 class="slider-two__title" >Endless Adventure</h2>
              <p class="slider-two__text">
                Join us on this unforgettable adventure and discover the magic of the Pyramids of Egypt. Book your tickets now and experience the wonder for yourself!
              </p>
              <a href="{{route('pyramids.tickets.plan-visit')}}" class="thm-btn slider-two__btn">Find Out More</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="slider-two__nav">
      <a class="slider-two__nav-left slide-one__left-btn" href="{{ url()->current() }}">
        <i class="egypt-icon-right-angle"></i>
      </a>
      <a class="slider-two__nav-right slide-one__right-btn" href="{{ url()->current() }}">
        <i class="egypt-icon-left-angle"></i>
      </a>
    </div>
  </section>

  <!-- About Us -->
  <section class="about-one">
    <div class="container">
      <div class="inner-container wow fadeInUp" data-wow-duration="1500ms">
        <div class="row">
          <div class="col-lg-7">
            <div class="about-one__content">
              <div class="block-title">
                <p class="block-title__tag-line">About Us</p>
                <h2 class="block-title__sub-title">
                  Built around  <br />
                  2500-2600 BCE
                </h2>
              </div>
              <p class="about-one__text">
                <a style="color: #d99578;" href="{{route('pyramids.about')}}">The Pyramids of Egypt </a> are an enigmatic wonder that have fascinated people for centuries. 
                These ancient structures were built over 4,500 years ago and still stand tall today, 
                a testament to the ingenuity and skill of the ancient Egyptians.
              </p>
              <p class="about-one__text">
                Each pyramid was built as a tomb for a pharaoh and their consorts, with the largest and most famous being the Great Pyramid of Giza. 
                This incredible feat of engineering is the oldest of the Seven Wonders of the Ancient World and continues to amaze visitors from all over the globe.
              </p>
            </div>
          </div>
          <div class="col-lg-5">
            <div class="about-one__feature">
              <div class="about-one__feature-single">
                <div class="about-one__feature-icon">
                  <i class="egypt-icon-place"></i>
                </div>
                <div class="about-one__feature-content">
                  <h3 class="about-one__feature-title">Pyramids Of Giza</h3>
                  <p class="about-one__feature-text">
                    Al Haram, Nazlet El-Semman <br />
                    Al Giza Desert, Giza Governorate 3512201 
                  </p>
                  <a href="https://www.google.com.eg/maps/place/Giza+Necropolis/@29.9773008,31.1299206,17z/data=!3m1!4b1!4m6!3m5!1s0x14584f7de239bbcd:0xca7474355a6e368b!8m2!3d29.9772962!4d31.1324955!16s%2Fm%2F07s6gb8?entry=ttu" target="_blank" class="about-one__feature-link">
                    Get Direction <span>+</span>
                  </a>
                </div>
              </div>
              <div class="about-one__feature-single">
                <div class="about-one__feature-icon">
                  <i class="egypt-icon-ticket"></i>
                </div>
                <div class="about-one__feature-content">
                  <h3 class="about-one__feature-title">Membership Benefits</h3>
                  <p class="about-one__feature-text">
                    Enjoy our Benefits for our <br />
                    Pyramids and GEM Members.
                  </p>
                  <a href="{{route('pyramids.memberships.index')}}" class="about-one__feature-link">
                    Become a Member <span>+</span>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Activites -->
  <section class="collection-one">
    <div class="container">
      <div class="block-title text-center">
        <p class="block-title__tag-line">Activites</p>
        <h2 class="block-title__title">At The Pyramids</h2>
      </div>
      <div class="row">
        @foreach ($eventCategories as $index => $category)
          <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="{{ $index * 100 }}ms">
            <div class="collection-one__single">
              <div class="collection-one__icon">
                <div class="collection-one__icon-img">
                  <img loading="lazy" src="{{$category->getFirstMediaUrl('event_category_media')}}" alt="{{$category->name}}" />
                </div>
              </div>
              <div class="collection-one__content">
                <h3 class="collection-one__title">
                  <a href="{{route('pyramids.events.show' , $category->id)}}">{{$category->name}}</a>
                </h3>
                <a href="{{route('pyramids.events.show' , $category->id)}}" class="collection-one__link">Explore The Activity</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      <div class="text-center">
        <a href="{{route('pyramids.events.index')}}" class="thm-btn collection-one__more-btn">Explore Now</a>
      </div>
    </div>
  </section>

  <!-- Events -->
  <section class="event-one">
    <div class="container">
      <div class="event-one__top">
        <div class="block-title text-left">
          <p class="block-title__tag-line">Events</p>
          <h2 class="block-title__title">Exhibition & Events</h2>
        </div>

        <div class="event-one__more-links-wrap">
          <a href="{{route('pyramids.events.index')}}" class="event-one__more-links">
            <i class="fa fa-angle-right"></i>
            View More Events 
          </a>
        </div>
      </div>

      @foreach($events as $index => $event)
        <div class="event-one__single wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="{{ $index * 100 }}ms">
          <div class="row">
            <div class="col-xl-6">
              <div class="event-one__content">
                <div class="event-one__image">
                  <div class="event-one__image-inner">
                    <img loading="lazy" src="{{$event->getFirstMediaUrl('event_media')}}" width="100px" height="100px" alt="{{$event->title}}" />
                  </div>
                  <div class="event-one__image-hover">{{$event->prices->min('price_egyptian')}}  EGP</div>
                </div>
                <div class="event-one__text">
                  <div class="event-one__content-top">
                    <div class="event-one__date">
                      <div class="event-one__date-num">{{$event->start_time->format('d') }}</div>
                      <div class="event-one__date-text">
                        <span>{{$event->start_time->format('F') }}</span>
                        {{$event->start_time->format('Y') }}
                      </div>
                    </div>
                  </div>
                  <h3 class="event-one__title">
                    <a href="{{route('pyramids.events.show' , $event->id )}}">{{$event->title}}</a>
                  </h3>
                </div>
              </div>
            </div>
            <div class="col-xl-6">
              <div class="event-one__right">
                <ul class="event-one__list list-unstyled">
                  <li>
                    <i class="egypt-icon-clock"></i>
                    <span>Clock</span>
                    10.00am to 6.00pm
                  </li>
                  <li>
                    <i class="egypt-icon-place-1"></i>
                    <span>Location</span>
                    {{ $event->place->name }}
                  </li>
                </ul>

                <div class="event-one__button-block">
                  <a href="{{route('pyramids.events.show' , $event->id )}}" class="event-one__btn thm-btn">Book Online</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach

    </div>
  </section>

  <!-- Gallery -->
  <section class="collection-two">
    <div class="container">
      <div class="collection-two__top" style="display: block;">
      <div class="block-title text-center">
        <p class="block-title__tag-line">Gallery</p>
        <h2 class="block-title__title">The Pyramids of Giza</h2>
      </div>
      </div>
      <div class="row masonary-layout">
        @foreach ($collections as $index => $collection)
          <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="{{ $index * 100 }}ms">
            <div class="collection-two__single">
              <div class="collection-two__image">
                <img src="{{$collection->getFirstMediaUrl('collection_media')}}" alt="{{$collection->name}}"/>
                <div class="collection-two__hover">
                  <a class="img-popup" href="{{$collection->getFirstMediaUrl('collection_media')}}">
                    <i class="egypt-icon-focus"></i>
                  </a>
                </div>
              </div>
              <div class="collection-two__content">
                <p class="collection-two__category">
                  <a>Egypt</a>
                </p>
                <h3 class="collection-two__title">
                  <a>{{$collection->name}}</a>
                </h3>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>

  <!-- Membership -->
  <section class="cta-one">
    <div class="container">
      <img loading="lazy" src="{{ asset('assets/GEM/images/resources/cta-1-person.png') }}" class="cta-one__person wow fadeInRight" data-wow-duration="1500ms"/>
      <div class="row">
        <div class="col-xl-6 col-lg-8">
          <div class="cta-one__block">
            <div class="cta-one__icon">
              <i class="egypt-icon-membership"></i>
            </div>
            <div class="cta-one__content">
              <h3 class="cta-one__title">
                Become a <br />
                Member of Pyramids
              </h3>
              <p class="cta-one__text">
                Gain Access to Exclusive Features and Resources<br />
                with Our Membership Program!
              </p>
              <ul class="list-unstyled cta-one__list">
                <li>
                  <i class="egypt-icon-check"></i>
                  Free Entries to the pyramids and Grand Egyptian Museum
                </li>
                <li>
                  <i class="egypt-icon-check"></i>
                  Access to Exclusive Activities
                </li>
                <li>
                  <i class="egypt-icon-check"></i>
                  Free Tickets to Special Exhibitions
                </li>
              </ul>
              <a href="{{route('pyramids.memberships.index')}}" class="cta-one__link">
                <i class="fa fa-angle-right"></i>
                Become a Member 
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

@endsection
