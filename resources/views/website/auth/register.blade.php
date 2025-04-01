@extends('layout.template.auth-template.auth-template')

@section('title' , 'Imentet')

@section('content')

    <section class="auth">
        <div class="container">
          <div class="row">
            <div class="wrapper">
              <div class="col-md-6 box details">
                <h1>Join our group in few minutes! <br /></h1>
                <p>Sign up with your details to get started</p>
              </div>
              <div class="col-md-5 offset-md-1 box">
                <div class="form">
                  <div class="content">
                    <h3 class="login-form__title">Create an Account</h3>

                    <p>
                      Already have an account? <a href="{{route('auth.login.index')}}">Sign In</a>
                    </p>
                  </div>

                  @if ($errors->any())
                    <div class="alert alert-danger" style="text-align: center;">
                        <i class="fa fa-times fa-lg"></i>
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                  @endif

                  <form action="{{route('auth.register.store')}}" method='POST'>
                      @csrf
                      <div class="inputs login-form__form">
                      <div class="login-form__field">
                              <input type="text" name="first_name" placeholder="First Name" required/>
                              <i class="fa fa-user"></i>
                      </div>
                      <div class="login-form__field">
                              <input type="text" name="last_name" placeholder="Last Name" required/>
                              <i class="fa fa-user"></i>
                          </div>
                      <div class="login-form__field">
                          <input type="email" name="email" placeholder="Email Address" required />
                          <i class="fa fa-envelope-o"></i>
                      </div>
                      <div class="login-form__field password-input">
                          <input type="password" name="password" placeholder="Enter Password" required/>
                          <i class="fa fa-eye toggler"></i>
                      </div>
                      <button type="submit" name='submit' class="thm-btn contact-one__btn">
                          Create Account
                      </button>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
@endsection