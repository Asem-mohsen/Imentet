@props(['route', 'places', 'dark' => false])

<div class="tab-content">
    <div class="tab-pane show active animated fadeInUp" id="money">
        <form method='POST' action="{{ $route }}" class="donation-form__form">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="donation-form__form-field">
                        <input type="text" name="first_name" placeholder="Your First Name*" value="{{ old('first_name') }}" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="donation-form__form-field">
                        <input type="text" name="last_name" placeholder="Your Last Name*" value="{{ old('last_name') }}" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="donation-form__form-field">
                        <input type="email" name="email" placeholder="Email Address*" value="{{ old('email') }}" required />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="donation-form__form-field">
                        <input type="number" name="phone" pattern="[0-9]*" placeholder="Phone Number" value="{{ old('phone') }}" />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="donation-form__form-field">
                        <input type="number" name="amount" placeholder="$ Custom Amount" required/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="donation-form__form-field">
                        <select class="selectpicker" name="place_id">
                            <option selected disabled hidden>Donation For</option>
                            @foreach($places as $place)
                                <option value="{{$place->id}}">{{$place->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="donation-form__form-field">
                        <textarea name="message" rows="5" placeholder="Leave a Message for us"></textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="text-center">
                        <button type="submit" class="thm-btn donation-form__form-btn" @if($dark) style="background-color: white; color: black;" @endif>
                            Make Donation
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div> 