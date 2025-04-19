@extends('layout.template.gem-template')

@section('title' , 'Collections')

@section('content')

    <section class="slider-one">

        @foreach($categories as $category)

                <section class="collection-three">
                    <div class="container">
                        <div class="block-title text-center"> 
                            <p><a href="{{route('gem.collections.category' , $category->slug)}}" class="block-title__tag-line">{{$category->name}}</a></p>
                            <h1 class="block-title__title" id="C1" ></h1>
                        </div>
                        <div class="row masonary-layout">
                            @foreach($category->collections as $collection)
                                <div class="col-lg-4 col-md-6 col-sm-12 masonary-item wow fadeInUp" data-wow-duration="1500ms"data-wow-delay="000ms">
                                    <div class="collection-three__single">
                                        <img src="{{$collection->getFirstMediaUrl('collection_media')}}" alt="{{$category->name}}" />
                                        <div class="collection-three__content">
                                            <h3 class="collection-three__title">
                                                <a href="{{route('gem.collections.show' , $collection->id)}}">
                                                    {{$collection->name}}
                                                </a>
                                            </h3>
                                            <a href="{{route('gem.collections.show' , $collection->id)}}" class="collection-three__link"><span>+</span></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
        @endforeach
        
    </section>

@endsection