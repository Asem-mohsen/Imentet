@extends('layout.template.gem-template')

@section('title' , 'Profile')

@section('content')

  <section class="inner-banner">
      <div class="container">
          <h1 class="inner-banner__title">Profile</h1>
      </div>
  </section>

  <section class="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-4 details">
          <div class="testimonials-one__image">
            <img loading="lazy" src="{{ $user->getFirstMediaUrl('user_profile_image') ? $user->getFirstMediaUrl('user_profile_image') : asset('assets/GEM/images/team/avatar.png') }}" id="Image" style="width: 100px !important" height="100px" alt="{{$user->fullName}}"/>
          </div>
          <div class="testimonials-one__info">
            <h3 class="testimonials-one__name">{{$user->fullName}}</h3>
            <p class="testimonials-one__designation">{{$user->email}}</p>
          </div>
        </div>
        <div class="col-md-8 has-seperator">
          <h3 class="login-form__title">Edit Profile</h3>
          <form action="{{route('profile.update' , $user->id)}}" method='POST' class="login-form__form" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="text" name="first_name" placeholder="Your First Name" value="{{ $user->first_name ?? old('first_name')}}" />
                  <i class="fa fa-user"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="text" name="last_name" placeholder="Your Last Name" value="{{$user->last_name ?? old('last_name')  }}" />
                  <i class="fa fa-user"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="email" name="email" placeholder="Email Address" value="{{ $user->email ?? old('email')}}" />
                  <i class="fa fa-envelope-o"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="text" name="dob" placeholder="Date Of Birth" class="datepicker normal-datepicker"  value="{{ $user->dob ?? old('dob') }}" />
                  <i class="fa fa-id-card-o"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="number" name="phone" pattern="[0-9]*" placeholder="Phone Number" value="{{ $user->phone ?? old('phone')}}"/>
                  <i class="fa fa-phone"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field custom-file">
                  <input type="file" class="custom-file-input" name="image" placeholder="Profile Picture" id="personal_photo" accept=".jpg , .png , .jpeg" />
                  <label class="custom-file-label" for="personal_photo">Upload Personal Photo</label>
                </div>
              </div>
            </div>
            <div class="login-form__field password-input">
              <input type="password" name="password" value="{{ old('password') }}" placeholder="Enter Password" />
              <i class="fa fa-eye toggler"></i>
            </div>

            <div class="login-form__bottom">
              <div class="gap-4">
                <a href="{{route('gem.home')}}" class="thm-btn login-form__btn">
                  Cancel
                </a>
                <button type="submit" class="thm-btn login-form__btn login-form__btn-two" >
                  Save
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>

  @php
    $latestMembership = $user->latestActiveMembership();
  @endphp

  @if($latestMembership)
    <div class="container py-2">
      <div class="membership-container">
          <div class="ticket">
              <div class="ticket-header">
                  <img src="{{ $user->getFirstMediaUrl('user_profile_image') ? $user->getFirstMediaUrl('user_profile_image') : asset('assets/GEM/images/resources/CairoEgMuseumTaaMaskMostlyPhotographed.jpg') }}" alt="Tutankhamun Mask" class="ticket-logo">
                  <h2>Your Membership</h2>
                  <p class="ticket-date">{{ $latestMembership->status === 'pending_documents' ? 'Pending Documents' : $latestMembership->status }}</p>

                  <div class="ticket-footer">
                    <div class="qr-code">
                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data={{ $latestMembership->id }}" alt="Membership QR Code">
                    </div>
                    <div class="ticket-terms">
                        <p>Please present this membership card at the museum entrance.</p>
                    </div>
                </div>
              </div>

              <div class="ticket-body">
                  <div class="ticket-info">
                      <div class="info-row">
                          <span class="label">Membership:</span>
                          <span class="value">{{ $latestMembership->membership->name }}</span>
                      </div>
                      <div class="info-row">
                          <span class="label">Start Date:</span>
                          <span class="value">{{ $latestMembership->start_date->format('d M Y') }}</span>
                      </div>
                      <div class="info-row">
                          <span class="label">End Date:</span>
                          <span class="value">{{ $latestMembership->end_date->format('d M Y') }}</span>
                      </div>
                  </div>

                  <div class="ticket-details">
                    <h2>Membership Information</h2>
                    @if($latestMembership->status === 'pending_documents')
                      <div class="alert alert-warning">
                        <p>Please submit your required documents to activate your membership.</p>
                        <a href="{{ route('gem.memberships.upload-documents', ['token' => encrypt($latestMembership->id)]) }}" 
                          class="thm-btn login-form__btn">
                            Submit Documents
                        </a>
                      </div>
                    @endif
                    <ul class="list-unstyled cta-one_list">
                      @foreach($latestMembership->membership->features as $feature)
                          <li> <i class="egypt-icon-check" style="color: #d99578;"></i> {{ $feature->name }}</li>
                      @endforeach
                    </ul>
                  </div>               
              </div>
          </div>
      </div>
    </div>
  @endif 

@endsection

@section('js')

  <script>
    document.querySelector('form').addEventListener('submit', function(event) {
        let dobInput = document.querySelector('input[name="dob"]');
        let dobValue = dobInput.value;

        let date = new Date(dobValue);
        if (!isNaN(date)) {
            dobInput.value = date.toLocaleDateString('en-US');
        } else {
            alert('Please enter a valid date.');
            event.preventDefault();
        }
    });

  </script>

@endsection