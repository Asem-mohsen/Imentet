@extends('layout.template.auth-template.auth-template')

@section('title' , 'Imentet')

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
                                <h3 class="login-form__title">Sign In</h3>
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

                            <form action="{{route('auth.login.store')}}" method="POST">
                                @csrf
                                <div class="inputs login-form__form">
                                    <div class="login-form__field">
                                        <input type="email" name="email" placeholder="Email" required/>
                                        <i class="fa fa-user"></i>
                                    </div>

                                    <div class="login-form__field password-input">
                                        <input type="password" name="password" placeholder="Enter Password" required />
                                        <i class="fa fa-eye toggler"></i>
                                    </div>

                                    <p>
                                        <a href="{{route('auth.password.request')}}">Forgot Password?</a>
                                    </p>

                                    <button type="submit" name="sumbit" class="thm-btn contact-one__btn">
                                        Sign In
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