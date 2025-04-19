@extends('layout.template.pyramids-template')

@section('title' , 'Memberships')

@section('content')

    <section class="inner-banner">
        <div class="container">
            <h2 class="inner-banner__title">Membership</h2>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="{{route('pyramids.home')}}">Home</a></li>
                <li>Membership</li>
            </ul>
        </div>
    </section>
    
    <!-- Become a Member Section -->
    <section class="cta-one cta-one__membership-page" style="background-color:#302e2f ;">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <div class="cta-one__block">
                        <div class="cta-one__icon">
                            <i class="egypt-icon-membership"></i>
                        </div>
                        <div class="cta-one__content">
                        <h3 class="cta-one__title" style="color:white;">Become a <br>
                                Member of The Pyramids</h3>
                            <p class="cta-one__text" style="color:white;">Gain Access to Exclusive Features and Resources
                                with Our Membership Program!</p>
                            <ul class="list-unstyled cta-one__list">
                                <li>
                                    <i class="egypt-icon-check"></i>
                                    Unlimited General Admission
                                </li>
                                <li>
                                    <i class="egypt-icon-check"></i>
                                    Free Tickets to Special Exhibitions
                                </li>
                                <li>
                                    <i class="egypt-icon-check"></i>
                                    Access to The Museum's Library
                                </li>
                            </ul>
                            <a href="{{route('pyramids.memberships.index')}}" class="cta-one__link" style="color:white;">
                                <i class="fa fa-angle-right"></i>
                                Become a Member
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-12">
                    <img loading="lazy" src="{{asset('assets/GEM/images/resources/membership-1.png')}}" alt="GEM Memberships" class="img-fluid" />
                </div>
            </div>
        </div>
    </section>

    <!-- Membership Options -->
    <section class="pricing-one" style="background-color:#302e2f ;">
        <div class="container">
            <div class="row">
                @foreach($memberships as $membership)

                    @php
                        $prices = $membership->prices->pluck('price');
                        $durations = $membership->prices->pluck('duration');
                    @endphp

                    <div class="col-lg-3 col-md-6">
                        <div class="pricing-one__single wow fadeInUp" style="height: 560px;" data-wow-duration="1500ms" data-wow-delay="000ms">
                            <p class="pricing-one__name">Plan</p>
                            <h3 class="pricing-one__type" style="color:white;">{{ $membership->name }}</h3>
                                @if($durations->unique()->count() > 1)
                                    <div class="multiprice">
                                        <span class="start-from" style="color:white;"> Start from </span> <p class="pricing-one__amount"> {{ $prices->min() }} </p>
                                    </div>
                                @else
                                    <p class="pricing-one__amount"> {{ $prices->min() }}  </p>
                                @endif
                            </p>
                            <p class="pricing-one__time" style="color:white;">
                                EGP / 
                                @if($durations->unique()->count() > 1)
                                    {{ ucfirst($durations->sortDesc()->first()->value) }} 
                                @else
                                    {{ ucfirst($durations->first()?->value) }} 
                                @endif
                            </p>
                            <div class="pricing-one__bottom">
                                <ul class="list-unstyled cta-one_list" style='line-height: 33px;'>

                                    <p class="pricing-one__text" style="color:white;">{{$membership->title}}</p> </br>

                                    @foreach ($membership->features->take(4) as $feature)
                                        <li class="MembershipLi text-left">
                                            <i class="egypt-icon-check" style="color: #d99578;"></i>
                                            {{$feature->name}}
                                        </li>
                                    @endforeach
                                    
                                </ul>
                                <a href="{{route('pyramids.memberships.show' , $membership->id)}}" class="pricing-one__btn thm-btn">Join</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection