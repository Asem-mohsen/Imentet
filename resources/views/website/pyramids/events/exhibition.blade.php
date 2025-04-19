@extends('layout.template.pyramids-template')

@section('title' , 'Exhibition')

@section('content')

  <section class="inner-banner">
      <div class="container">
        <h2 class="inner-banner__title">Exhibition</h2>
        <ul class="list-unstyled thm-breadcrumb">
          <li><a href="{{route('pyramids.home')}}">Home</a></li>
          <li><a href="{{route('pyramids.events.index')}}">What's On</a></li>
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
              @foreach($currentExhibitions as $currentExhibition)
                <x-cards.exhibhition-card :event="$currentExhibition" :route="route('pyramids.events.show', $currentExhibition->id)" />
              @endforeach
          </div>
        </div>

        <!-- Upcoming -->
        <div class="tab-pane animated fadeInUp" id="upcoming">
          <div class="row">
              @foreach($upcomingExhibitions as $upcomingExhibition)
                <x-cards.exhibhition-card :event="$upcomingExhibition" :route="route('pyramids.events.show', $upcomingExhibition->id)" />
              @endforeach
          </div>
        </div>

        <!-- Archive -->
        <div class="tab-pane animated fadeInUp" id="arc-1">
          <div class="row">
            @foreach($pastExhibitions as $pastExhibition)
              <x-cards.exhibhition-card :event="$pastExhibition" :route="route('pyramids.events.show', $pastExhibition->id)" />
            @endforeach
          </div>
        </div>

      </div>
    </div>
  </section>

@endsection