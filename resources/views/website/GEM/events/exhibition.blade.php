@extends('layout.template.gem-template')

@section('title' , 'Exhibition')

@section('content')

  <section class="inner-banner">
      <div class="container">
        <h2 class="inner-banner__title">Exhibition</h2>
        <ul class="list-unstyled thm-breadcrumb">
          <li><a href="{{route('gem.home')}}">Home</a></li>
          <li><a href="{{route('gem.events.index')}}">What's On</a></li>
          <li>Exhibition</li>
        </ul>

        <ul class="nav nav-tabs exhibhition-one__menu">
          @if(!empty($currentExhibitions) && count($currentExhibitions) > 0)
              <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#current">Ongoing</a>
              </li>
          @endif
          
          @if(!empty($upcomingExhibitions) && count($upcomingExhibitions) > 0)
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#upcoming">Upcoming</a>
              </li>
          @endif
          
          @if(!empty($pastExhibitions) && count($pastExhibitions) > 0)
              <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#arc-1">Past</a>
              </li>
          @endif
      </ul>

      </div>
  </section>

  <section class="exhibhition-one exhibhition-one__page">
    <div class="container">
      <div class="tab-content">

        <!-- Current -->
        <div class="tab-pane show active animated fadeInUp" id="current">
          <div class="row">
              @foreach($currentExhibitions as $event)
                <div class="col-lg-4">
                  <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
                    <div class="exhibhition-one__image">
                      <div class="exhibhition-one__image-inner" style='max-height:210px'>
                        <span class="exhibhition-one__image-border-1"></span>
                        <span class="exhibhition-one__image-border-2"></span>
                        <span class="exhibhition-one__image-border-3"></span>
                        <span class="exhibhition-one__image-border-4"></span>
                        <img src="{{$event->getFirstMediaUrl('event_media')}}" alt="{{$event->title}}" />
                        <a href="{{route('gem.events.show' , $event->id)}}" class="exhibhition-one__image-link">
                          <i class="egypt-icon-arrow-1"></i>
                        </a>
                      </div>
                    </div>
                    <div class="exhibhition-one__content">
                      <a href="{{ route('gem.events.index', ['event_category' => 'exhibitions']) }}" class="exhibhition-one__category">{{$event->category->name}}</a>
                      <h3 class="exhibhition-one__title">
                        <a href="{{route('gem.events.show' , $event->id)}}">
                          {{$event->title}}
                        </a>
                      </h3>
                      <div class="exhibhition-one__bottom">
                        <div class="exhibhition-one__bottom-left">
                          <span>{{$event->start_time->format('M d, Y')}} </span>
                          <span>
                            {{$event->end_time->format('M d, Y')}} <i class="fa fa-angle-double-left"></i>
                          </span>
                        </div>
                        <div class="exhibhition-one__bottom-right">
                          <a href="{{route('gem.events.show' , $event->id)}}" class="thm-btn exhibhition-one__btn">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>

        <!-- Upcoming -->
        <div class="tab-pane animated fadeInUp" id="upcoming">
          <div class="row">
              @foreach($upcomingExhibitions as $event)
                <div class="col-lg-4">
                  <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
                    <div class="exhibhition-one__image">
                      <div class="exhibhition-one__image-inner" style='max-height:210px'>
                        <span class="exhibhition-one__image-border-1"></span>
                        <span class="exhibhition-one__image-border-2"></span>
                        <span class="exhibhition-one__image-border-3"></span>
                        <span class="exhibhition-one__image-border-4"></span>
                        <img src="{{$event->getFirstMediaUrl('event_media')}}" alt="{{$event->title}}" />
                        <a href="{{route('gem.events.show' , $event->id)}}" class="exhibhition-one__image-link">
                          <i class="egypt-icon-arrow-1"></i>
                        </a>
                      </div>
                    </div>
                    <div class="exhibhition-one__content">
                      <a href="{{ route('gem.events.index', ['event_category' => 'exhibitions']) }}" class="exhibhition-one__category">{{$event->category->name}}</a>
                      <h3 class="exhibhition-one__title">
                        <a href="{{route('gem.events.show' , $event->id)}}">
                          {{$event->title}}
                        </a>
                      </h3>
                      <div class="exhibhition-one__bottom">
                        <div class="exhibhition-one__bottom-left">
                          <span>{{$event->start_time->format('M d, Y')}} </span>
                          <span>
                            {{$event->end_time->format('M d, Y')}} <i class="fa fa-angle-double-left"></i>
                          </span>
                        </div>
                        <div class="exhibhition-one__bottom-right">
                          <a href="{{route('gem.events.show' , $event->id)}}" class="thm-btn exhibhition-one__btn">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endforeach
          </div>
        </div>

        <!-- Archive -->
        <div class="tab-pane animated fadeInUp" id="arc-1">
          <div class="row">
            @foreach($pastExhibitions as $event)
              <div class="col-lg-4">
                <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
                  <div class="exhibhition-one__image">
                    <div class="exhibhition-one__image-inner" style='max-height:210px'>
                      <span class="exhibhition-one__image-border-1"></span>
                      <span class="exhibhition-one__image-border-2"></span>
                      <span class="exhibhition-one__image-border-3"></span>
                      <span class="exhibhition-one__image-border-4"></span>
                      <img src="{{$event->getFirstMediaUrl('event_media')}}" alt="{{$event->title}}" />
                      <a href="{{route('gem.events.show' , $event->id)}}" class="exhibhition-one__image-link">
                        <i class="egypt-icon-arrow-1"></i>
                      </a>
                    </div>
                  </div>
                  <div class="exhibhition-one__content">
                    <a href="{{ route('gem.events.index', ['event_category' => 'exhibitions']) }}" class="exhibhition-one__category">{{$event->category->name}}</a>
                    <h3 class="exhibhition-one__title">
                      <a href="{{route('gem.events.show' , $event->id)}}">
                        {{$event->title}}
                      </a>
                    </h3>
                    <div class="exhibhition-one__bottom">
                      <div class="exhibhition-one__bottom-left">
                        <span>{{$event->start_time->format('M d, Y')}} </span>
                        <span>
                          {{$event->end_time->format('M d, Y')}} <i class="fa fa-angle-double-left"></i>
                        </span>
                      </div>
                      <div class="exhibhition-one__bottom-right">
                        <a href="{{route('gem.events.show' , $event->id)}}" class="thm-btn exhibhition-one__btn">Read More</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>

        <!-- Load More -->
        {{-- @if($Count >= $NumOfRecords)
          <div class="text-center">
            <a href="?MoreData=8" class="exhibhition-one__more-link">
              <i class="exhibhition-one__more-link__icon">+</i>
              <span class="text-uppercase">Load More</span>
            </a>
          </div>
        @endif --}}

      </div>
    </div>
  </section>

@endsection