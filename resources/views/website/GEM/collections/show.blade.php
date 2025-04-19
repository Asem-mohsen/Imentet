@extends('layout.template.gem-template')

@section('title' , $collection->name)

@section('content')

    <section class="inner-banner">
        <div class="container">
            <h2 class="inner-banner__title">{{$collection->name}}</h2>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="{{route('gem.home')}}">Home</a></li>
                <li><a href="{{route('gem.collections.index')}}">Collections</a></li>
                <li>{{$collection->name}}</li>
            </ul>
        </div>
    </section>
    <!-- Colletion Details -->
    <div class="collection-details">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="collection-details__content">
                        <h3 class="collection-details__title">{{$collection->name}}</h3>
                        <br>
                        <img loading="lazy" src="{{$collection->getFirstMediaUrl('collection_media')}}" alt="{{$collection->name}}" class="img-fluid" />
                        @php 
                            $imagePath = $collection->getFirstMediaPath('collection_media');
                            $imageSize = getimagesize($imagePath); 
                        @endphp
                        <br>
                        <br>
                        <a href="{{ url()->current() }}" class="collection-details__link"><i class="fa fa-download"></i> Download Image</a>
                        <br>
                        <p class="collection-details__text">{{$collection->description}}</p>
                        <br>
                        <p class="collection-details__text"></p>
                        <br>
                        <h3 class="collection-details__subtitle">Highlights</h3>
                        <br>
                        <ul class="collection-details__list list-unstyled">
                            <li>
                                <i class="egypt-icon-check"></i>
                                This Piece of Art is considerd one of the main artifacts displayed in {{ $collection->places->pluck('name')->join(' - ') }}
                            </li>
                            <li>
                                <i class="egypt-icon-check"></i>
                                The Colors are still the same 
                            </li>
                            <li>
                                <i class="egypt-icon-check"></i>
                                One of the main pieces in the {{$collection->category->name}} Catgeory
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 collection-details__sidebar-wrap">
                    <div class="collection-details__sidebar">
                        <div class="collection-details__sidebar-single">
                            <h3 class="collection-details__sidebar-title"><span>Details of Collection</span></h3>
                            <ul class="collection-details__sidebar-list list-unstyled">
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Artist
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">Ancient Egyptians</span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Year
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">2500BC - 2700BC</span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Style
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">{{$collection->category->name}}</span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Locations
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">{{ $collection->places->pluck('name')->join(' - ') }}</span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Dimension
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">{{ $imageSize[0] }} x {{ $imageSize[1] }} px</span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Type
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">{{$collection->category->name}}</span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Object Num
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">{{ rand(100 , 100000) }}</span>
                                </li>
                            </ul>
                        </div>
                        <div class="collection-details__sidebar-single">
                            <h3 class="collection-details__sidebar-subtitle">Share With Friends</h3>
                            <div class="collection-details__sidebar-social">
                                <a href="https://www.facebook.com/GrandEgyptianMuseum/" target="_blank" class="fa fa-facebook-f"></a>
                                <a href="https://twitter.com/EgyptMuseumGem" target="_blank" class="fa fa-twitter"></a>
                                <a href="{{ url()->current() }}" class="fa fa-rss"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="collection-details__paginations">
        <div class="container">
            <div class="row">
                <!-- Prev -->
                @if ($prevCollection)
                    <div class="col-sm-3 text-center">
                        <a href="{{ route('gem.collections.show', $prevCollection->id) }}"> Prev <span>-</span></a>
                    </div>
                @else
                    <div class="col-sm-3 text-center">
                        <a href="{{ route('gem.collections.index') }}"> Collections Page <span>-</span></a>
                    </div>
                @endif

                <div class="col-sm-6 text-center">
                    <a href="{{ route('gem.collections.index') }}"><i class="egypt-icon-menu"></i></a>
                </div>

                <!-- NEXT  -->
                @if ($nextCollection)
                    <div class="col-sm-3 text-center">
                        <a href="{{ route('gem.collections.show', $nextCollection->id) }}">Next <span>+</span></a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Similar Collectons -->
    <section class="similar-collection collection-two__collection-page">
        <div class="container">
            <h3 class="text-center similar-collection__title">
                Similar Collections
            </h3>
            <div class="row masonary-layout">
                @foreach($collections as $collection)
                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="collection-two__single">
                            <div class="collection-two__image">
                                <img loading="lazy" src="{{$collection->getFirstMediaUrl('collection_media')}}" height="200px" alt="{{$collection->name}}">
                                <div class="collection-two__hover">
                                    <a class="img-popup" href="{{$collection->getFirstMediaUrl('collection_media')}}"><i class="egypt-icon-focus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="collection-two__content">
                                <p class="collection-two__category"><a href="{{route('gem.collections.category' , $collection->category->slug)}}">{{$collection->category->name}}</a></p>
                                
                                <h3 class="collection-two__title">
                                    <a href="{{route('gem.collections.show' , $collection->id)}}">
                                        {{$collection->name}}
                                    </a>
                                </h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection