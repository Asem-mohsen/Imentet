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
                <input type="text" name="first_name" placeholder="Your Full Name" value="{{old('first_name') ?? auth()->user()?->fullName}}" />
            </p>
        </div>
        <div class="col-lg-6">
            <p class="contact-one__field">
                <label>Email</label>
                <input type="email" name="email" placeholder="Email Address" value="{{old('email') ?? auth()->user()?->email }}" />
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