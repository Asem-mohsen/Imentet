@extends('layout.template.gem-template')

@section('title' , 'Grand Egyption Museum')

@section('content')

  <!-- Sliders Home Page -->
  <section class="slider-one">
    <div class="slider-one__carousel owl-carousel owl-theme">
      <div class="item slider-one__slider-1" style="background-image: url('{{ asset('assets/GEM/images/new/slider/slider-1-new.jpg') }}'); background-blend-mode: overlay;" >
        <div class="container text-center">
          <p class="slider-one__tag-line text-uppercase">
            Celebrate tradition!
          </p>
          <h2 class="slider-one__title">
            One of the Finest Collections of <br/>
            Egyptian Art.
          </h2>
          <p class="slider-one__text text-uppercase">
            Through November 12 (Tuesday) - 18 (Monday), 2023.
          </p>
          <a href="{{route('gem.tickets.plan-visit')}}" class="thm-btn slider-one__btn">Find Out More</a>
        </div>
      </div>
      <div class="item slider-one__slider-2" style="background-image: url('{{ asset('assets/GEM/images/new/slider/slider-2-new.jpg') }}'); background-blend-mode: overlay;" >
      <div class="container text-center">
          <p class="slider-one__tag-line text-uppercase">
            Get your grip on history
          </p>
          <h2 class="slider-one__title">
            Discover the Treasures of a Egypt <br />
            Grand Museum
          </h2>
          <p class="slider-one__text">
            The Birth of the GRAND EGYPTIAN MUSEUM - 2002
          </p>
          <a href="{{ route('gem.about') }}" class="thm-btn slider-one__btn">Find Out More</a>
        </div>
      </div>
      <div class="item slider-one__slider-3" style="background-image: url('{{ asset('assets/GEM/images/new/slider/slider-3-new.jpg') }}'); background-blend-mode: overlay;">
        <div class="container text-center">
          <p class="slider-one__tag-line text-uppercase">
            The Past is our Future
          </p>
          <h2 class="slider-one__title">
            Experience Art, Science, and Innovation <br />
            Come To Life At Our Museum
          </h2>
          <p class="slider-one__text">
            Let Your Inner Light Grow With the Silence of History
          </p>
          <a href="{{ route('gem.events') }}" class="thm-btn slider-one__btn">Find Out More</a>
        </div>
      </div>
    </div>
    <div class="slider-one__nav">
      <a class="slider-one__nav-left slide-one__left-btn" href="#">
        <i class="egypt-icon-right-angle"></i>
        <span class="slider-one__nav-text">Prev</span>
      </a>
      <a class="slider-one__nav-right slide-one__right-btn" href="#">
        <i class="egypt-icon-left-angle"></i>
        <span class="slider-one__nav-text">Next</span>
      </a>
    </div>
  </section>

  <!-- About Us -->
  <section class="about-two">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="about-two__content">
            <div class="block-title text-left">
              <p class="block-title__tag-line">About Us</p>
              <h2 class="block-title__title">History of Egypt</h2>
              <h3 class="block-title__sub-title">
                The World's Leading Museum of <br/>
                Histrory & Culture.
              </h3>
            </div>
            <p class="about-two__text">
              Egypt is the world's leading museum of history & culture,
              and it is <br />
              home to the world's largest archaeological museum,
              <a href="{{ route('gem.about') }}" style="color: #d99578;">the Grand Egyptian Museum [GEM],</a> which will house ancient Egyptian artefacts, <br/>
              including the entire Tutankhamun collection.
            </p>
            <a href="{{ route('gem.about') }}" class="thm-btn about-two__btn">More Details</a>
          </div>
        </div>
        <div class="col-lg-6 d-flex align-items-end justify-content-center wow fadeInRight" data-wow-duration="1500ms">
          <div class="about-two__image">
            <img src="{{ asset('assets/GEM/images/new/about-home/about-2-new.png') }}" class="about-two__image--1" alt="Grand Egyption Museum" />
            <img src="{{ asset('assets/GEM/images/new/about-home/about-1-new.png') }}" class="about-two__image--2" alt="Grand Egyption Museum" />
            <div class="about-two__image-content">
              <div class="about-two__image-decor"></div>
              <div class="about-two__image-content-main">
                <div class="about-two__image-content-left">E</div>
                <div class="about-two__image-content-right">
                  <span>stablished</span>
                  <span class="about-two__year counter">2003</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Exhibition Section  -->
  <section class="exhibhition-one">
    <div class="container">
      <div class="block-title text-center">
        <p class="block-title__tag-line">Exhibition</p>
        <h2 class="block-title__title">Ongoing Exhibitions</h2>
      </div>
      <div class="row">

          @foreach($exhibitions as $exhibition)
            <div class="col-lg-4">
              <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
                <div class="exhibhition-one__image">
                  <div class="exhibhition-one__image-inner" style="max-height: 270px;">
                    <span class="exhibhition-one__image-border-1"></span>
                    <span class="exhibhition-one__image-border-2"></span>
                    <span class="exhibhition-one__image-border-3"></span>
                    <span class="exhibhition-one__image-border-4"></span>

                    <img src="{{ $exhibition->getFirstMediaUrl() }}" alt="{{ $exhibition->title }}"/>
                    <a href="{{route('gem.events.show' , $exhibition->id )}}" class="exhibhition-one__image-link">
                      <i class="egypt-icon-arrow-1"></i>
                    </a>
                  </div>
                </div>
                <div class="exhibhition-one__content">
                  <a href="{{route('gem.events.show' , $exhibition->id )}}" class="exhibhition-one__category">{{$exhibition->category->name}}</a>
                  <h3 class="exhibhition-one__title">
                    <a href="{{route('gem.events.show' , $exhibition->id )}}">{{$exhibition->title}}</a>
                  </h3>
                  <div class="exhibhition-one__bottom">
                    <div class="exhibhition-one__bottom-left">
                      <span> {{ date('M d, Y' , strtotime($exhibition->start_time)) }}</span>
                      <span>
                        {{ date('M d, Y' , strtotime($exhibition->end_time)) }} <i class="fa fa-angle-double-left"></i>
                      </span>
                    </div>
                    <div class="exhibhition-one__bottom-right">
                      <a href="{{route('gem.events.show' , $exhibition->id )}}" class="thm-btn exhibhition-one__btn">Read More</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach

      </div>
    </div>
  </section>

  <!-- Events Section -->
  <section class="event-two">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 d-flex">
          <div class="my-auto">
            <div class="event-two__block">
              <div class="block-title text-left">
                <p class="block-title__tag-line">Events</p>
                <h2 class="block-title__title">
                  Events & <br />
                  Program Schedule
                </h2>
              </div>
              <ul class="list-unstyled event-two__list nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#current" role="tab" >
                    <span class="number">01.</span>
                    Current
                    <i class="fa fa-angle-right"></i>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#upcoming" role="tab">
                    <span class="number">02.</span>
                    Upcoming
                    <i class="fa fa-angle-right"></i>
                  </a>
                </li>
                <li class="nav-item"> 
                  <a class="nav-link" data-toggle="tab" href="#past" role="tab" >
                    <span class="number">03.</span>
                    Past
                    <i class="fa fa-angle-right"></i>
                  </a>
                </li>
              </ul>
              <a href="{{route('gem.events')}}" class="event-two__more-link">
                View All Upcoming Events 
                <span>+</span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-7">
          <div class="tab-content">

            <!-- Current Events -->
            <div class="event-two__main tab-pane animated fadeInRight show active" id="current" role="tabpanel">
                @foreach($currentEvents as $currentEvent)
                  <div class="event-two__single">
                    <div class="event-two__image">
                      <div class="event-two__time">
                        {{$currentEvent->category->name}}
                      </div>
                      <div class="event-two__image-inner">
                        <div class="event-two__price">
                          <span>{{$currentEvent->prices->min('egyption_price')}}</span>
                        </div>
                        <img src="{{ $currentEvent->getFirstMediaUrl('event_media') }}" width="170px" height="170px" alt="{{ $currentEvent->title }}" />
                      </div>
                    </div>
                    <div class="event-two__content">
                      <div class="event-two__content-top">
                        <div class="event-two__date">
                          <div class="event-two__date-num">{{ \Carbon\Carbon::parse($currentEvent->start_time)->format('d') }}</div>
                          <div class="event-two__date-text">
                              <span>{{ \Carbon\Carbon::parse($currentEvent->start_time)->format('F') }}</span>
                              {{ \Carbon\Carbon::parse($currentEvent->start_time)->format('Y') }}
                          </div>
                      </div>
                      </div>
                      <h3 class="event-two__title">
                        <a href="{{route('gem.events.show' , $currentEvent->id )}}">
                          {{ $currentEvent->title }}
                        </a>
                      </h3>
                      <p class="event-two__text">
                        {{ $currentEvent->place->name }}
                      </p>
                      <a href="{{route('gem.events.show' , $currentEvent->id )}}" class="event-two__link">
                        <span>
                          <i class="fa fa-angle-right"></i>More Details</span>
                      </a>
                    </div>
                  </div>
                @endforeach
            </div>

            <!-- Upcoming Events -->
            <div class="event-two__main tab-pane animated fadeInRight" id="upcoming" role="tabpanel" >
              @foreach($upcomingEvents as $upcomingEvent)
                  <div class="event-two__single">
                    <div class="event-two__image">
                      <div class="event-two__time">
                        {{$upcomingEvent->category->name}}
                      </div>
                      <div class="event-two__image-inner">
                        <div class="event-two__price">
                          <span>{{$upcomingEvent->prices->egyption_price}}</span>
                        </div>
                        <img src="{{ $upcomingEvent->getFirstMediaUrl('event_media') }}" width="170px" height="170px" alt="{{ $upcomingEvent->title }}" />
                      </div>
                    </div>
                    <div class="event-two__content">
                      <div class="event-two__content-top">
                        <div class="event-two__date">
                          <div class="event-two__date-num">{{ \Carbon\Carbon::parse($upcomingEvent->start_time)->format('d') }}</div>
                          <div class="event-two__date-text">
                              <span>{{ \Carbon\Carbon::parse($upcomingEvent->start_time)->format('F') }}</span>
                              {{ \Carbon\Carbon::parse($upcomingEvent->start_time)->format('Y') }}
                          </div>
                      </div>
                      </div>
                      <h3 class="event-two__title">
                        <a href="{{route('gem.events.show' , $upcomingEvent->id )}}">
                          {{ $upcomingEvent->title }}
                        </a>
                      </h3>
                      <p class="event-two__text">
                        {{ $upcomingEvent->place->name }}
                      </p>
                      <a href="{{route('gem.events.show' , $upcomingEvent->id )}}" class="event-two__link">
                        <span>
                          <i class="fa fa-angle-right"></i>More Details</span>
                      </a>
                    </div>
                  </div>
              @endforeach
            </div>

            <!-- Past Events -->
            <div class="event-two__main tab-pane animated fadeInRight" id="past" role="tabpanel" >
              @foreach($pastEvents as $pastEvent)
                  <div class="event-two__single">
                    <div class="event-two__image">
                      <div class="event-two__time">
                        {{$pastEvent->category->name}}
                      </div>
                      <div class="event-two__image-inner">
                        <div class="event-two__price">
                          <span>{{$pastEvent->prices->min('egyption_price')}}</span>
                        </div>
                        <img src="{{ $pastEvent->getFirstMediaUrl('event_media') }}" width="170px" height="170px" alt="{{ $pastEvent->title }}" />
                      </div>
                    </div>
                    <div class="event-two__content">
                      <div class="event-two__content-top">
                        <div class="event-two__date">
                          <div class="event-two__date-num">{{ \Carbon\Carbon::parse($pastEvent->start_time)->format('d') }}</div>
                          <div class="event-two__date-text">
                              <span>{{ \Carbon\Carbon::parse($pastEvent->start_time)->format('F') }}</span>
                              {{ \Carbon\Carbon::parse($pastEvent->start_time)->format('Y') }}
                          </div>
                      </div>
                      </div>
                      <h3 class="event-two__title">
                        <a href="{{route('gem.events.show' , $pastEvent->id )}}">
                          {{ $pastEvent->title }}
                        </a>
                      </h3>
                      <p class="event-two__text">
                        {{ $pastEvent->place->name }}
                      </p>
                      <a href="{{route('gem.events.show' , $pastEvent->id )}}" class="event-two__link">
                        <span>
                          <i class="fa fa-angle-right"></i>More Details</span>
                      </a>
                    </div>
                  </div>
              @endforeach
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>
  
  <!-- MemberShip Section -->
  <section class="video-one">
    <div class="video-one__box wow fadeInLeft" data-wow-duration="1500ms">
      <a href="https://www.youtube.com/watch?v=GiMbVa6XzTw" class="video-popup video-one__play-btn">
        <i class="fa fa-play"></i>
      </a> 
      <a href="https://www.youtube.com/watch?v=GiMbVa6XzTw" class="video-popup">
        <img src="{{ asset('assets/GEM/images/new/about-home/video-1-1.png') }}" alt="Awesome Image"/>
      </a>
    </div>
    <div class="container">
      <div class="row justify-content-xl-end">
        <div class="col-xl-5 col-lg-7">
          <div class="video-one__content">
            <h3 class="video-one__title">
              Become a <br />
              Member of The Grand Egyptian Museum
            </h3>
            <ul class="list-unstyled video-one__list">
              <li>
                <i class="egypt-icon-tick"></i>
                Unlimited General Admission
              </li>
              <li>
                <i class="egypt-icon-tick"></i>
                Free Tickets to Special Exhibitions
              </li>
              <li>
                <i class="egypt-icon-tick"></i>
                Access to The Museum's Library
              </li>
            </ul>
            <a href="{{route('gem.memberships.index')}}" class="thm-btn video-one__btn">Become a Member</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Statistics -->
  <section class="funfact-one">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1500ms"  data-wow-delay="0ms">
          <div class="funfact-one__single">
            <div class="funfact-one__icon">
              <i class="egypt-icon-art-museum"></i>
            </div>
            <div class="funfact-one__content">
              <div class="funfact-one__count">
                <span class="counter">100</span>k
              </div>
              <div class="funfact-one__text">
                <span class="text-uppercase">Artifacts</span>
                GEM Houses
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
          <div class="funfact-one__single">
            <div class="funfact-one__icon">
              <i class="egypt-icon-smile"></i>
            </div>
            <div class="funfact-one__content">
              <div class="funfact-one__count">
                <span class="counter">5</span>
                k
              </div>
              <div class="funfact-one__text">
                <span class="text-uppercase">Workers</span>
                In GEM
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
          <div class="funfact-one__single">
            <div class="funfact-one__icon">
              <i class="egypt-icon-medal"></i>
            </div>
            <div class="funfact-one__content">
              <div class="funfact-one__count">
                <span class="counter">480</span>k
              </div>
              <div class="funfact-one__text">
                <span class="text-uppercase">sqm</span>
                Covered GEM
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
          <div class="funfact-one__single">
            <div class="funfact-one__icon">
              <i class="egypt-icon-jar"></i>
            </div>
            <div class="funfact-one__content">
              <div class="funfact-one__count">
                <span class="counter">2</span>km
                
              </div>
              <div class="funfact-one__text">
                <span class="text-uppercase">Distance</span>
                From Pyramids
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Collections Section -->
  <section class="collection-three">
    <div class="container">
      <div class="block-title text-center">
        <p class="block-title__tag-line">Collections</p>
        <h2 class="block-title__title">Discover The Collection</h2>
      </div>
      <div class="row masonary-layout">

        @foreach ($collections as $collection)
          <div class="col-lg-4 col-md-6 col-sm-12 masonary-item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
            <div class="collection-three__single">
              <img src="{{ $collection->getFirstMediaUrl('collection_media') }}" alt="Awesome Image"/>
              <div class="collection-three__content">
                <h3 class="collection-three__title">
                  <a href="{{ route('gem.collections.show' , $collection->id )}}">
                    {{ $collection->name }}
                  </a>                      
                </h3>
                <a href="{{ route('gem.collections.show' , $collection->id )}}" class="collection-three__link"><span>+</span></a>
              </div>
            </div>
          </div>
        @endforeach

      <div class="text-center">
        <a href="{{ route('gem.collections.index' )}}" class="collection-three__more-link">
          <span><i class="fa fa-angle-right"></i>View All Collections</span>
        </a>
      </div>
    </div>
  </section>
      
@endsection