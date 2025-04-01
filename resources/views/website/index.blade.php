@extends('layout.template.auth-template.auth-template')

@section('title' , 'Imentet')

@section('content')

    <section class="welcome-section">
        <div class="grid-wrapper">
            <div class="box">
                <div class="container text-center">
                    <p class="slider-one__tag-line text-uppercase">
                    GRAND EGYPTIAN MUSEUM
                    </p>
                    <h2 class="slider-one__title">
                    The World's Largest Museum Dedicated To <br />
                    Egyptian Civilization.
                    </h2>
                    <p class="slider-one__text text-uppercase">Open Now</p>
                    <div class="content">
                    <a href="{{route('gem.home')}}" target="_blank" class="thm-btn slider-one__btn">
                        Find Out More</a>
                    </div>
                </div>
            </div>
            <div class="box">
            <div class="container text-center">
                <p class="slider-one__tag-line text-uppercase">
                PYRAMIDS OF GIZA
                </p>
                <h2 class="slider-one__title">
                One of <br>
                The Seven Wonders<br>
                of The World.
                </h2>
                <p class="slider-one__text text-uppercase">Visit Us</p>
                <div class="content">
                <a href="{{route('pyramids.home')}}" target="_blank" class="thm-btn slider-one__btn">Find Out More</a>
                </div>
            </div>
            </div>
        </div>
    </section>

@endsection