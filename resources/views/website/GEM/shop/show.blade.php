@extends('layout.template.gem-template')

@section('title' , $product->name)

@section('content')

    <!-- Upper Part -->
    <div class="container">
        <ul class="list-unstyled thm-breadcrumb thm-breadcrumb__two">
            <li><a href="{{route('gem.home')}}">Home</a></li>
            <li><a href="{{route('gem.shop.index')}}">Shop</a></li>
            <li>{{$product->name}}</li>
        </ul>
    </div>

    <!-- Item Details -->
    <section class="product-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-details__image">
                        <img class="img-fluid" src="{{$product->getFirstMediaUrl('shop_item')}}" width="500px" height="500px" alt="{{$product->name}}" />
                        <a href="{{$product->getFirstMediaUrl('shop_item')}}" class="product-details__img-popup img-popup">
                            <i class="fa fa-search"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product-details__content">
                        <form method="POST" action="{{ route('gem.cart.add') }}" id="add-to-cart-form">
                            @csrf
                            <input type="hidden" name="shop_item_id" value="{{ $product->id }}">
                            <h3 class="product-details__title">{{$product->name}}</h3>
                            <p class="product-details__price">{{$product->price . ' EGP'}}</p>
                            <p class="product-details__text">
                                {{$product->description}}
                            </p>
                            <p class="product-details__categories">
                                <span class="text-uppercase">Category : </span>
                                <a href="">{{$product->category->name}}</a>
                            </p>
                            <div class="product-details__button-block d-flex">
                                @if ($product->stock_quantity > 0)
                                    <input class="quantity-spinner Quantity" type="number" value="1" min="1" max="{{ $product->stock_quantity }}" name="quantity"  />
                                    <button class="thm-btn product-details__cart-btn">Add to Cart <span>+</span></button>
                                @else
                                    Out Of Stock
                                @endif
                            </div>
                            <p class="product-details__availabelity">
                                <span>Availability:</span>
                                {{ $product->stock_quantity . " In stock" }}
                            </p>
                            <p class="product-details__social">
                                <span><i class="egypt-icon-share"></i></span>
                                <a href="https://www.facebook.com/GrandEgyptianMuseum/" target="_blank"><i class="fa fa-facebook-f"></i></a>
                                <a href="https://twitter.com/EgyptMuseumGem"  target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.instagram.com/grandegyptianmuseum/?hl=en" target="_blank"><i class="fa fa-instagram"></i></a>
                            </p>
                        </form>
                        <div class="accrodion-grp" data-grp-name="product-details__accrodion">
                            <div class="accrodion ">
                                <div class="accrodion-title">
                                    <h4>Description</h4>
                                </div>
                                <div class="accrodion-content">
                                    <div class="inner">
                                        <p>
                                            {{$product->description}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="accrodion active">
                                <div class="accrodion-title">
                                    <h4>Comment</h4>
                                </div>
                                <div class="accrodion-content">
                                    <div class="inner">
                                        <div class="product-details__review-form">
                                            <!-- Reviews -->
                                            <div class="product-details__review" style="margin-bottom: 40px;">
                                                @foreach ($product->reviews as $review)
                                                    <form action="" method="post" class="mb-5">
                                                        <div class="product-details__review-single">
                                                            <div class="product-details__review-left">
                                                                <img src="{{$review->user->getFirstMediaUrl('user_profile_image') ?: asset('assets/GEM/images/team/avatar.png')}}" width="70px" height="70px" alt="{{$review->user->fullName}}" />
                                                            </div>
                                                            <div class="product-details__review-right">
                                                                <div class="product-details__review-top">
                                                                    <div class="product-details__review-top-left">
                                                                        <h3 class="product-details__review-title">{{$review->user->fullName}}</h3>
                                                                        <span class="product-details__review-sep">–</span>
                                                                        <span class="product-details__review-date">{{ date('M d, Y' ,strtotime( $review->created_at))}}</span>
                                                                    </div>
                                                                    @if(auth()->user()?->id === $review->user->id)
                                                                        <div class="product-details__review-top-right" style="position:absolute; right:37px">
                                                                            <button class="remove-review-btn" data-review-id="{{ $review->id }}" style="background-color: #d99578; border:none ; color:white ; border-radius: 7px; padding: 5px 14px;"> 
                                                                                Remove
                                                                            </button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                                <p class="product-details__review-text">{{$review->user->review}}</p>
                                                            </div>
                                                        </div>
                                                    </form>
                                                @endforeach
                                            </div>

                                            <h3 class="product-details__review-form__title">Add Your Comment</h3>
                                            <p class="product-details__review-form__text mb-5">Your Email address will not be published.</p>
                                            <form method="post" class="contact-one__form" id="review-form">
                                                @csrf
                                                <input type="hidden" name="shop_item_id" value="{{ $product->id }}">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <p class="contact-one__field">
                                                            <label>Your Rating</label>
                                                            
                                                            <div id="full-stars-example">
                                                                <div class="rating-group">
                                                                    <label aria-label="1 star" class="rating__label" for="rating-1"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                    <input class="rating__input" name="rating" id="rating-1" value="1" type="radio">
                                                                    <label aria-label="2 stars" class="rating__label" for="rating-2"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                    <input class="rating__input" name="rating" id="rating-2" value="2" type="radio">
                                                                    <label aria-label="3 stars" class="rating__label" for="rating-3"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                    <input class="rating__input" name="rating" id="rating-3" value="3" type="radio" checked>
                                                                    <label aria-label="4 stars" class="rating__label" for="rating-4"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                    <input class="rating__input" name="rating" id="rating-4" value="4" type="radio">
                                                                    <label aria-label="5 stars" class="rating__label" for="rating-5"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                                                    <input class="rating__input" name="rating" id="rating-5" value="5" type="radio">
                                                                </div>
                                                            </div>

                                                        </p>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <p class="contact-one__field">
                                                            <label>Your Name</label>
                                                            <input type="text" name="first_name" placeholder="Your Full Name" value="{{old('first_name') ?? auth()->user()->fullName}}" />
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <p class="contact-one__field">
                                                            <label>Email</label>
                                                            <input type="email" name="email" placeholder="Email Address" value="{{old('email') ?? auth()->user()->email }}" />
                                                        </p>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <p class="contact-one__field">
                                                            <label>Your Comment</label>
                                                            <textarea name="review" required>{{old('review')}}</textarea>

                                                            @if(auth()->user())
                                                                <button type="submit" class="thm-btn contact-one__btn"> Submit Review </button>
                                                            @else
                                                                <a href="{{route('auth.login.index')}}" class="thm-btn contact-one__btn"> Sign In to Countine </a>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    <section class="related-product">
        <div class="container">
            <h3 class="related-product__title">Related Products</h3>
            <div class="related-product__carousel owl-carousel owl-theme">
                @foreach($products as $product)
                    <div class="item">
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="product-one__single">
                                <div class="product-one__image">
                                    <img src="{{$product->getFirstMediaUrl('shop_item')}}" height="270px" alt="{{$product->name}}" />
                                </div>
                                <div class="product-one__content">
                                    <div class="product-one__content-left">
                                        <h3 class="product-one__title">
                                            <a href="{{route('gem.shop.products.show' , $product->id)}}">{{$product->name}}</a>
                                        </h3>
                                        <p class="product-one__text">EGP  {{$product->price}}</p>
                                        <p class="product-one__stars">
                                            {{"Available ". $product->stock_quantity . " In Stock"}}
                                        </p>
                                    </div>
                                    <div class="product-one__content-right">
                                        @if($product->stock_quantity > 0)
                                            <button data-toggle="tooltip" data-placement="top" title="Add to Cart" class="product-one__cart-btn"><i class="egypt-icon-supermarket"></i></button>
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
        </div>
    </section>

@endsection

@section('js')

<script>
    $(document).ready(function() {
        $('#add-to-cart-form').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('gem.cart.add') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error("Something went wrong! Please try again.");
                }
            });
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#review-form').submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "{{ route('reviews.store') }}",
                method: "POST",
                data: $(this).serialize(),
                success: function(response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error("Something went wrong! Please try again.");
                }
            });
        });

        $('.remove-review-btn').click(function(event) {
            event.preventDefault();
            let reviewId = $(this).data('review-id');

            $.ajax({
                url: "/reviews/" + reviewId,
                method: "DELETE",
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    if (response.status === "success") {
                        toastr.success(response.message);
                        location.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr) {
                    toastr.error("Unable to delete review.");
                }
            });
        });
    });
</script>

@endsection