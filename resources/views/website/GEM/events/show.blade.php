@extends('layout.template.gem-template')

@section('title' , $event->title)

@section('content')

    <!-- Top Part -->
    <section class="inner-banner">
      <div class="container">
        <h2 class="inner-banner__title">{{$event->title}}</h2>
        <ul class="list-unstyled thm-breadcrumb">
          <li><a href="{{route('gem.home')}}">Home</a></li>
          <li><a href="{{route('gem.events.index')}}">Events</a></li>
          <li>{{$event->title}}</li>
        </ul>
      </div>
    </section>

      <!-- Event Details -->
      <section class="event-details">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="event-details__content">
                <ul class="nav nav-tabs plan-visit__tab-links">
                  <li class="nav-item">
                    <a href="#open-hrs" data-target="#about-event"class="nav-link active">About Event</a>
                  </li>
                  <li class="nav-item">
                    <a href="#schedule" data-target="#schedule" class="nav-link">Schedule</a>
                  </li>
                  <li class="nav-item">
                    <a href="#contact" data-target="#contact" class="nav-link">Contact</a>
                  </li>
                  @if($event->hasMedia('gallery'))
                    <li class="nav-item">
                        <a href="#gallery" data-target="#gallery" class="nav-link">Gallery</a>
                    </li>
                  @endif
                </ul>
                <div class="event-details__single" id="about-event">
                  <div class="event-details__event-info">
                    <div class="row">
                      <div class="col-lg-6 d-flex py-4 px-0">
                        <div class="my-auto">
                          <ul class="list-unstyled event-details__event-info__list">
                            <li>
                              <span>Date & Time</span>
                              <p>
                                <i class="fa fa-clock-o"></i>
                                {{$event->end_time ? $event->start_time->format('M d, Y'). ' - ' . $event->end_time->format('M d, Y') : $event->start_time->format('M d, Y') }}
                              </p>
                            </li>
                            <li>
                              <span>Location</span>
                              <p>
                                <i class="fa fa-location-arrow"></i>
                                {{$event->place->name}}
                              </p>
                            </li>
                            <li>
                              <span>Organizer</span>
                              <p>
                                <i class="fa fa-user"></i>
                                {{ $event->getSponsorNames(true) }} 
                              </p>
                            </li>
                            <li>
                                <span>Ticket Cost</span>
                                <p>
                                    @foreach ($event->prices as $price)
                                        <i class="fa fa-money"></i>
                                        {{ $price->category }} - 
                                        Egyptians: {{ $price->price_egyptian }} EGP,
                                        Arabs: {{ $price->price_arab }} EGP,
                                        Foreigners: {{ $price->price_foreigner }} EGP 
                                        <br>
                                    @endforeach
                                </p>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-6 clearfix">
                        <img loading="lazy" src="{{$event->getFirstMediaUrl('event_media')}}"  class="float-right w-100 h-100" alt="{{$event->title}}" />
                      </div>
                    </div>
                  </div>
                  <h3 class="event-details__title">Details About Event</h3>
                  <p class="event-details__text">
                    {{$event->description}}>
                  </p>
                </div>
                <div id="schedule" class="event-details__single">
                  <h3 class="event-details__title">Event Schedule</h3>
                  <ul class="event-details__schedule-list list-unstyled">
                    <li>
                      <div class="event-details__schedule-time">
                        10am - 1pm
                      </div>
                      <div class="event-details__schedule-content">
                        <h3>Doors Open</h3>
                        <p> The Time may change, keep checking it </p>
                      </div>
                    </li>
                    <li>
                      <div class="event-details__schedule-time">2pm - 5pm</div>
                      <div class="event-details__schedule-content">
                        <h3>Sart the Event</h3>
                        <p>This Event will take place in {{$event->place->name}}</p>
                      </div>
                    </li>
                  </ul>
                </div>

                <!-- Gallery -->
                @if($event->hasMedia('gallery'))
                  <div id="gallery" class="event-details__single">
                    <h3 class="event-details__title">Gallery</h3>
                    <div class="row masonary-layout">
                      @foreach($event->getMedia('gallery') as $image)
                          <div class="col-md-6 masonary-item">
                              <img loading="lazy" class="img-fluid" src="{{ $image->getUrl() }}" width="370px" style="height: 270px" alt="{{$event->title}}"/>
                          </div>
                      @endforeach
                    </div>
                  </div>
                @endif

                <!-- Contact And Feedback-->
                <div id="contact" class="event-details__single">
                  <div class="event-details__contact">
                    <div class="row">
                      <div class="product-details">
                        <div class="accrodion-grp" data-grp-name="product-details__accrodion">
                          <div class="accrodion active">
                            <div class="accrodion-title">
                              <h4>Address</h4>
                            </div>
                            <div class="accrodion-content">
                              <div class="inner">
                                <div id="contact" class="event-details__single">
                                  <div class="event-details__contact">
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <h3 class="event-details__title">
                                          Contact Information
                                        </h3>
                                        <p class="event-details__text">
                                          If you have any question about this Event pleas contact our
                                          team.
                                        </p>
                                        <ul class="event-details__contact-list list-unstyled">
                                          <li>
                                            <span>Address:</span>
                                            <p>
                                              Alexandria Desert Rd, Haram,
                                              <br />
                                              Giza Governorate X4VF+V3F
                                            </p>
                                          </li>
                                          <li>
                                            <span>Phone:</span>
                                            <p>
                                              <a href="tel:+20-23-531-7344">+20-23-531-7344</a>
                                            </p>
                                          </li>
                                          <li>
                                            <span>Email: </span>
                                            <p>
                                              <a href="gem@example.com">Imentet@example.com</a>
                                            </p>
                                          </li>
                                        </ul>
                                      </div>
                                      <div class="col-lg-6">
                                        @if ($event->place->name === "Grand Egyptian Museum")
                                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13821.875835399496!2d31.122688!3d29.994688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584534984a8ad1%3A0x45764c5bc4ec261a!2sGrand%20Egyptian%20Museum!5e0!3m2!1sen!2seg!4v1681483362521!5m2!1sen!2seg" class="google-map__home" allowfullscreen></iframe>
                                        @else
                                            <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.006641777741!2d31.13162697553705!3d29.979239121657272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584587ac8f291b%3A0x810c2f3fa2a52424!2sThe%20Great%20Pyramid%20of%20Giza!5e0!3m2!1sen!2seg!4v1685319609844!5m2!1sen!2seg" class="google-map__home" allowfullscreen ></iframe>
                                        @endif
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Feedback -->
                          @if(auth()->user() && $event->isHappening())
                            <div class="accrodion active">
                              <div class="accrodion-title">
                                <h4>Feedback</h4>
                              </div>
                              <div class="accrodion-content pt-0">
                                <div class="inner">
                                  <div class="product-details__review-form">
                                    <h3 class="product-details__review-form__title">
                                      Share with us your Feedback!
                                    </h3>
                                    <p class="product-details__review-form__text">
                                      Your email address will not be published.
                                    </p>
                                    <br>

                                    <x-forms.event-review-form :event="$event" />
                                    
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Online Booking -->
            <div class="col-lg-4">
              <x-forms.event-form :event="$event" />
            </div>
            
          </div>
      </section>

      <!-- Pagination -->
    <div class="event-details__pagination">
      <div class="container">
          <div class="row">
              <!-- Prev Event -->
              <div class="col-lg-6">
                  @if(isset($prevEvent))
                      <a href="{{ route('gem.events.show', $prevEvent->id) }}" class="event-details__pagination__left">
                          <div class="event-details__pagination-icon">
                              <i class="fa fa-angle-left"></i>
                          </div>
                          <div class="event-details__pagination-content">
                              <span>Prev Event</span>
                              <h3>{{ $prevEvent->title }}</h3>
                          </div>
                      </a>
                  @else
                      <a href="{{ route('gem.events.index') }}" class="event-details__pagination__left">
                          <div class="event-details__pagination-icon">
                              <i class="fa fa-angle-left"></i>
                          </div>
                          <div class="event-details__pagination-content">
                              <span>Events Page</span>
                              <h3>Back</h3>
                          </div>
                      </a>
                  @endif
              </div>
  
              <!-- Next Event -->
              <div class="col-lg-6">
                  @if(isset($nextEvent))
                      <a href="{{ route('gem.events.show', $nextEvent->id) }}" class="event-details__pagination__right">
                          <div class="event-details__pagination-icon">
                              <i class="fa fa-angle-right"></i>
                          </div>
                          <div class="event-details__pagination-content">
                              <span>Next Event</span>
                              <h3>{{ $nextEvent->title }}</h3>
                          </div>
                      </a>
                  @endif
              </div>
          </div>
      </div>
    </div>

@endsection

@section('js')
  @include('components.scripts.events-script')
@endsection