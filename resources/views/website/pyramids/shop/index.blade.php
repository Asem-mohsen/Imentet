@extends('layout.template.pyramids-template')

@section('title' , 'Shop')

@section('content')

    <section class="inner-banner" style="background-image: url('{{ asset('assets/GEM/images/Background/inner-banner-bg-2-2.png') }}'">
        <div class="container">
            <h2 class="inner-banner__title">Our Store</h2>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="{{route('pyramids.home')}}">Home</a></li>
                <li>Store</li>
            </ul>
        </div>
    </section>

    <div class="product-sorting">
        <div class="container">
            <form action="{{ route('pyramids.shop.index') }}" method="get">
                <div class="inner-container">
                    <div>
                        <select class="selectpicker" id='SelectSort' name="Sort">
                            <option value="default" {{ request('Sort') == 'default' ? 'selected' : '' }}>Default Sorting</option>
                            <option value="1" {{ request('Sort') == '1' ? 'selected' : '' }}>Top Selling</option>
                            <option value="DESC" {{ request('Sort') == 'DESC' ? 'selected' : '' }}>Highest Price</option>
                            <option value="ASC" {{ request('Sort') == 'ASC' ? 'selected' : '' }}>Lowest Price</option>
                        </select>
                        <button class="thm-btn topbar-one__btn" style="background-color: #d99578; color:white; height: 50px;" name="Search" > Search</button>
                    </div>
                    <p class="product-sorting__text">
                        Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} results
                    </p>
                </div>
            </form>
        </div>
    </div>

    <!-- Products -->
    <section class="product-one">
        <div class="container">
            <div class="row">
                @foreach ($products as $product)
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-duration="1500ms">
                        <form method="POST" action="{{ route('pyramids.cart.add') }}">
                            @csrf
                            <input type="hidden" name="shop_item_id" value="{{ $product->id }}">
                            <input type="hidden" name="quantity" value="1">
                            <div class="product-one__single">
                                <div class="product-one__image">
                                    <img src="{{$product->getFirstMediaUrl('shop_item')}}" height="270px" alt="{{$product->name}}" />
                                </div>
                                <div class="product-one__content">
                                    <div class="product-one__content-left">
                                        <h3 class="product-one__title">
                                            <a href="{{route('pyramids.shop.products.show' , $product->id)}}"> {{$product->name}} </a>
                                        </h3>
                                        <p class="product-one__text">{{'EGP' . $product->price}}</p>
                                        <p class="product-one__stars">
                                            Available {{$product->stock_quantity . ' Items'}}
                                        </p>
                                    </div>
                                    <div class="product-one__content-right">
                                        @if($product->stock_quantity > 0)
                                            <button data-toggle="tooltip" class="product-one__cart-btn add-to-cart" data-id="{{ $product->id }}"
                                                data-id="{{ $product->id }}">
                                                <i class="egypt-icon-supermarket"></i>
                                            </button>
                                        @else
                                            Out of Stock
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endforeach
            </div>

            <!-- Pagination  -->
            <div class="post-pagination post-pagination__two">
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <a href="{{ $url }}" class="{{ $products->currentPage() === $page ? 'active' : '' }}">
                        {{ $page }}
                    </a>
                @endforeach
            </div>

        </div>
    </section>

@endsection

@section('js')
    @include('components.scripts.cart-actions')
@endsection
