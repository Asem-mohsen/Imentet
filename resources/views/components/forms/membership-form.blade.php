@props(['route', 'userMembership', 'membership'])

<div class="event-details__form">
    <h3 class="event-details__form-title">Membership Payement</h3>
    <form action="{{ $route }}" method="post">
        @csrf
        @if ($userMembership)
            <div class="row">
                <div class="col-sm-12">
                    <p>
                        You Already Enrolled In <span style="color: #d99578"> {{ $userMembership->membership->name }} Plan </span>
                    </p>
                </div>
                <div class="col-sm-6">
                    <label for="started_at">Started At</label>
                    <input type="text" id="start_date" value="{{ $userMembership->start_date->format('d M Y') }}" disabled/>
                </div>
                <div class="col-sm-6">
                    <label for="ends_at">Ends At</label>
                    <input type="text" id="end_date" value="{{ $userMembership->end_date->format('d M Y') }}" disabled/>
                </div>
                <div class="col-sm-12">
                    <button class="thm-btn event-details__form-btn" disabled>
                        You can Renew it Soon
                    </button>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-12">
                    <input type="text" name="name" placeholder="Your Name" value="{{ auth()->user()->fullName ?? old('name')}}"/>
                    <input type="hidden" id="price_id" name="price_id" value="{{ $membership->prices->first()->id }}"/>
                </div>
                <div class="col-sm-12">
                    <input type="text" name="email" placeholder="Email Address" value="{{ auth()->user()->email ?? old('email')}}"/>
                </div>
                <div class="col-sm-12">
                    <input type="text" name="start_date" placeholder="Start Date" class="datepicker normal-datepicker" value="{{old('start_date')}}"/>
                </div>
                <div class="col-sm-12">
                    @if(auth()->user())
                        <button type="submit" class="thm-btn event-details__form-btn">
                            Proceed to Payment
                        </button>
                    @else
                        <a href="{{route('auth.login.index')}}" class="thm-btn event-details__form-btn">
                            Sign In to Continue
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </form>
</div> 