@extends('layout.template.gem-template')

@section('title' , 'Events')

@section('content')

    <!-- Search By Date Section -->
    <section class="event-page-header">
        <section class="event-sorting event-page-three">
            <div class="container">
            <div class="tab-content">
                <div id="searchByMonth-tab" class="event-sorting__tab-content tab-pane show active animated fadeInUp" >
                <input type="text" name="searchByMonth-datepicker" class="searchByMonth-datepicker" value="{{ date('M - Y') }}" readonly />
                </div>
                <div id="searchByDate-tab" class="event-sorting__tab-content tab-pane animated fadeInUp" >
                <input type="text" name="searchByDate-datepicker" class="searchByDate-datepicker" value="{{ date('d - M - Y') }}" readonly />
                </div>
            </div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                <a href="#searchByMonth-tab" data-toggle="tab" class="nav-link active">Search By Month</a>
                </li>
                <li class="nav-item">
                <a href="#searchByDate-tab" data-toggle="tab" class="nav-link">Search By Date 
                    <i class="fa fa-calendar-o"></i>
                </a>
                </li>
            </ul>
            </div>
        </section>
    
        <!-- Search Options -->
        <form method="GET" action="{{ route('gem.events') }}">
            <div class="collection-search event-page">
                <div class="container">
                    <div class="inner-container">
                        <div class="collection-search__outer">
                            <div class="collection-search__field">
                            <select class="selectpicker" name="event_category_id">
                                <option value="0">Categories</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected($category->id == old('category_id', $categoryId))>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                            </select>
                            </div>
                            <div class="collection-search__field">
                                <select class="selectpicker" name="place_id">
                                    <option value="0">Location</option>
                                    @foreach ($places as $place)
                                        <option value="{{ $place->id }}" @selected($place->id == old('place_id', $placeId))>
                                            {{ $place->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="thm-btn collection-search__btn">
                            Find Event
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

    <!-- Search Data -->
    <section class="event-three">
        <div class="container">
            <div class="row">
                @foreach($events as $event)
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="event-three__single">
                            <div class="event-three__image">
                            <img src="{{$event->getFirstMediaUrl('event_media')}}" alt="{{$event->title}}" height="200px"/>
                            <h3 class="event-three__title">
                                <a href="{{route('gem.events.show' , $event->id)}}">{{$event->title}}</a>
                            </h3>
                            <a href="{{route('gem.events.show' , $event->id)}}" class="event-three__cat">{{$event->category->name}}</a>
                            </div>
                            <div class="event-three__content">
                            <p class="event-three__text"  style="overflow: hidden; max-height: 182px; min-height: 182px;">
                                {{$event->description}}
                            </p>
                            <ul class="event-three__list list-unstyled">
                                <li>
                                <span>Date & Time</span>
                                <p>
                                    <i class="fa fa-clock-o"></i> 
                                    {{date('d M Y', strtotime($event->start_time)) }}
                                </p>
                                </li>
                                <li>
                                <span>Location</span>
                                <p>
                                    <i class="fa fa-location-arrow"></i> 
                                    {{$event->place->name}}
                                </p>
                                </li>
                            </ul>
                            <a href="{{route('gem.events.show' , $event->id)}}" class="thm-btn event-three__btn">
                                <span class="main-text">Start from EGP {{ $event->prices->min('egyption_price') }} / Person</span>
                                <span class="hover-text">More Details</span>
                            </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination  -->
            <div class="post-pagination post-pagination__two">
                {{ $events instanceof \Illuminate\Pagination\LengthAwarePaginator ? $events->links() : '' }}
            </div>
        </div>
    </section>

@endsection