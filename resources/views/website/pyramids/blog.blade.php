@extends('layout.template.pyramids-template')

@section('title', 'Pyramids Blog')

@section('content')

<section class="inner-banner">
    <div class="container">
        <h2 class="inner-banner__title">Blog</h2>
        <ul class="list-unstyled thm-breadcrumb">
            <li><a href="{{route('pyramids.home')}}">Home</a></li>
            <li>Blog</li>
        </ul>
    </div>
</section>

<section class="blog-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <ul class="nav nav-tabs blog-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#reels">
                                <i class="fas fa-video"></i> Reels & Videos
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#articles">
                                <i class="fas fa-newspaper"></i> Articles & News
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="reels" class="tab-pane fade show active">
                            <div class="row">
                              @foreach($reels as $reel)
                                <div class="col-lg-4 col-md-6">
                                    <div class="blog-card">
                                        <div class="blog-card__image">
                                            <img src="{{ $reel['thumbnail'] }}" alt="{{ $reel['title'] }}">
                                        </div>
                                        <div class="blog-card__content">
                                            <h3 class="blog-card__title">
                                                <a href="https://www.youtube.com/watch?v={{ $reel['videoId'] }}" target="_blank">{{ $reel['title'] }}</a>
                                            </h3>
                                            <p class="blog-card__text">{{ Str::limit($reel['description'], 100) }}</p>
                                            <a href="https://www.youtube.com/watch?v={{ $reel['videoId'] }}" class="blog-card__link" target="_blank">
                                                <span>Watch Now</span>
                                                <i class="fa fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                                <!-- Reel Item 1 -->
                                {{-- <div class="col-lg-4 col-md-6">
                                    <div class="blog-card">
                                        <div class="blog-card__image">
                                            <img src="{{ asset('assets/images/pyramids/reel1.jpg') }}" alt="Pyramids Reel">
                                            <div class="blog-card__date">
                                                <span class="day">15</span>
                                                <span class="month">Mar</span>
                                            </div>
                                        </div>
                                        <div class="blog-card__content">
                                            <h3 class="blog-card__title">
                                                <a href="#">Sunset at the Pyramids</a>
                                            </h3>
                                            <p class="blog-card__text">Experience the magical sunset over the Great Pyramids</p>
                                            <a href="#" class="blog-card__link">
                                                <span>Watch Now</span>
                                                <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div> --}}
                                <!-- Add more reel items as needed -->
                            </div>
                        </div>

                        <div id="articles" class="tab-pane fade">
                            <div class="row">
                                @foreach($articles['articles'] ?? [] as $article)
                                    <div class="col-lg-12 col-md-12">
                                        <div class="blog-card">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="blog-card__image">
                                                        @php
                                                            $imageUrl = 'https://via.placeholder.com/600x400';
                                                            if (!empty($article['multimedia']) && isset($article['multimedia']['default']['url'])) {
                                                                $imageUrl = $article['multimedia']['default']['url'];
                                                            }
                                                        @endphp
                                                        <img src="{{ $imageUrl }}" alt="{{ $article['headline']['main'] ?? 'No Title' }}" class="img-fluid">
                                                        
                                                        <div class="blog-card__date">
                                                            <span class="month">
                                                                {{ isset($article['pub_date']) ? \Carbon\Carbon::parse($article['pub_date'])->format('M Y') : 'Unknown Date' }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="blog-card__content">
                                                        <div class="blog-card__meta">
                                                            <span class="section-badge">{{ $article['section_name'] ?? 'Unknown Section' }}</span>
                        
                                                            @if(!empty($article['keywords']))
                                                                <div class="keywords-container">
                                                                    @foreach($article['keywords'] as $keyword)
                                                                        <span class="keyword-badge">{{ $keyword['value'] ?? '' }}</span>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                        
                                                        <h3 class="blog-card__title">
                                                            <a href="{{ $article['web_url'] ?? '#' }}" target="_blank">
                                                                {{ $article['headline']['main'] ?? 'No Title Available' }}
                                                            </a>
                                                        </h3>
                        
                                                        <p class="blog-card__text">{{ $article['abstract'] ?? 'No summary available.' }}</p>
                        
                                                        <div class="blog-card__footer">
                                                            <span class="blog-card__author">{{ $article['byline']['original'] ?? 'Unknown Author' }}</span>
                                                            <a href="{{ $article['web_url'] ?? '#' }}" class="blog-card__link" target="_blank">
                                                                <span>Read More</span>
                                                                <i class="fa fa-arrow-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        
                            <!-- Pagination -->
                            <div class="pagination-container">
                                @if(($articles['total'] ?? 0) > 0)
                                    <nav aria-label="Page navigation">
                                        <ul class="pagination justify-content-center">
                                            @for($i = 1; $i <= ceil(($articles['total'] ?? 0) / ($articles['per_page'] ?? 10)); $i++)
                                                <li class="page-item {{ ($articles['current_page'] ?? 1) == $i ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ route('pyramids.blog.index', ['page' => $i]) }}">{{ $i }}</a>
                                                </li>
                                            @endfor
                                        </ul>
                                    </nav>
                                @endif
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection