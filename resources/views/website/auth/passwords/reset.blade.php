@extends('layout.template.auth-template.auth-template')

@section('title' , 'Reset Password')

@section('content')

    <section class="auth">
        <div class="container">
            <div class="row">
                <div class="wrapper">
                    <div class="col-md-6 box details">
                        <h1>We are glad to see you again! <br /></h1>
                        <p>Sign In with your details to get started</p>
                    </div>
                    <div class="col-md-5 offset-md-1 box">
                        <div class="form">
                            <div class="content">
                                <h3 class="login-form__title">Reset Password</h3>
                                <p>
                                    New to Imentet ?
                                    <a href="{{route('auth.register.index')}}">Create an Account</a>
                                </p>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger" role="alert" style="text-align: center;">
                                    @foreach ($errors->all() as $error)
                                        <p><i class="fa fa-times fa-lg"></i> {{ $error }}</p>
                                    @endforeach
                                </div>
                            @endif

                            <form method="POST" action="{{ route('auth.password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <div class="inputs login-form__form">

                                    <div class="login-form__field">
                                        <input type="email" id="email" name="email" class="@error('email') is-invalid @enderror" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                                        <i class="fa fa-user"></i>
                                    </div>

                                    <div class="login-form__field password-input">
                                        <input type="password" name="password" class="@error('password') is-invalid @enderror" placeholder="Enter Password" required />
                                        <i class="fa fa-eye toggler"></i>
                                    </div>

                                    <div class="login-form__field password-input">
                                        <input type="password" id="password-confirm" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password" />
                                        <i class="fa fa-eye toggler"></i>
                                    </div>

                                    <button type="submit" name="sumbit" class="thm-btn contact-one__btn">
                                        Reset Password
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