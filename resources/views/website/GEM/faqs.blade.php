@extends('layout.template.gem-template')

@section('title' , 'FAQs')

@section('content')

    <section class="inner-banner">
        <div class="container">
            <h2 class="inner-banner__title">FAQ's</h2>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="{{route('gem.home')}}">Home</a></li>
                <li><a href="{{route('gem.about')}}">About</a></li>
                <li>FAQ's</li>
            </ul>
        </div>
    </section>

    <section class="faq-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs faq-page__links">
                        @foreach($categories as $index => $category)
                            <li class="nav-item">
                                <a data-toggle="tab" href="#tab-{{ $category->id }}" 
                                class="nav-link {{ $index === 0 ? 'active' : '' }}">
                                    {{ $category->getTranslation('name', app()->getLocale()) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="tab-content">
                        @foreach($categories as $index => $category)
                            <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }} animated fadeInRight" id="tab-{{ $category->id }}">
                                <div class="accrodion-grp" data-grp-name="faq-page__accrodion" >
                                    @foreach($category->faqs as $i => $faq)
                                        <div class="accrodion {{ $i === 0 ? 'active' : '' }}">
                                            <div class="accrodion-title">
                                                <h4>{{ $faq->getTranslation('question', app()->getLocale()) }}</h4>
                                            </div>
                                            <div class="accrodion-content">
                                                <div class="inner">
                                                <p>
                                                    {{ $faq->getTranslation('answer', app()->getLocale()) }}
                                                </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection