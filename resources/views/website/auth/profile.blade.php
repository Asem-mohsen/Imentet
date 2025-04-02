@extends('layout.template.gem-template')

@section('title' , 'Profile')

@section('content')

  <section class="inner-banner">
      <div class="container">
          <h2 class="inner-banner__title">Profile</h2>
      </div>
  </section>

  <section class="profile">
    <div class="container">
      <div class="row">
        <div class="col-md-4 details">
          <div class="testimonials-one__image">
            <img src="{{ $user->getFirstMediaUrl('user_profile_image') ?: asset('assets/GEM/images/team/avatar.png') }}" id="Image" style="width: 100px !important" height="100px" alt="{{$user->fullName}}"/>
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
                  <input type="text" name="first_name" placeholder="Your First Name" value="{{ old('first_name') ?? $user->first_name}}" />
                  <i class="fa fa-user"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="text" name="last_name" placeholder="Your Last Name" value="{{ old('last_name') ?? $user->last_name }}" />
                  <i class="fa fa-user"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="email" name="email" placeholder="Email Address" value="{{old('email') ?? $user->email }}" />
                  <i class="fa fa-envelope-o"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="text" name="dob" placeholder="Date Of Birth" class="datepicker normal-datepicker"  value="{{ old('dob') ?? $user->dob }}" />
                  <i class="fa fa-id-card-o"></i>
                </div>
              </div>
              <div class="col-md-6">
                <div class="login-form__field">
                  <input type="number" name="phone" pattern="[0-9]*" placeholder="Phone Number" value="{{ old('phone') ?? $user->phone }}"/>
                  <i class="fa fa-phone"></i>
                </div>
              </div>
            </div>
            <div class="login-form__field password-input">
              <input type="password" name="password" value="{{ old('password') }}" placeholder="Enter Password" />
              <i class="fa fa-eye toggler"></i>
            </div>
            <div class="login-form__field">
              <input type="file" name="image" placeholder="Profile Picture" id="UserImage" accept=".jpg , .png , .jpeg" />
              <i class="fa fa-image"></i>
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

  <script>
    document.getElementById('UserImage').onchange = function(){
    document.getElementById('Image').src = URL.createObjectURL(UserImage.files[0]); //Preview New Image
    }
  </script>
@endsection

@section('js')

<script>
  document.querySelector('form').addEventListener('submit', function(event) {
      let dobInput = document.querySelector('input[name="dob"]');
      let dobValue = dobInput.value;

      // Attempt to format the date
      let date = new Date(dobValue);
      if (!isNaN(date)) {
          dobInput.value = date.toLocaleDateString('en-US'); // 'm/d/Y' format
      } else {
          // Handle invalid date
          alert('Please enter a valid date.');
          event.preventDefault();
      }
  });

</script>
@endsection