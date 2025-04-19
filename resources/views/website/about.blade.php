@extends('layout.template.auth-template.auth-template')

@section('title' , 'About Imentet')

@section('content')

    <section class="inner-banner index-page" style="background-image: url('{{ asset('assets/GEM/images/new/slider/slider-1-new.jpg') }}') ;">
        <div class="container">
            <h2 class="inner-banner__title">About Us </h2>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="{{route('index')}}">Home</a></li>
                <li>The Museum</li>
            </ul>
        </div>
    </section>

    <section class="about-three">
        <div class="container">
            <div class="block-title text-center">
            <p class="block-title__tag-line">About Us</p>
            <h2 class="block-title__title" style="font-size: 38px;">
                Meet the Team Behind IMENTET: <br/> Innovating Web Systems <BR/> for <br/> Egypt's Archaeological Sites
            </h2>
            </div>
            <div class="row">
            <div class="col-lg-6">
                <div class="about-three__content">
                <h3 class="about-three__content-title">Established in 2022</h3>
                <p class="about-three__content-text">
                    Welcome to <a style="color:#d99578;">IMENTET</a>, a team of passionate professionals dedicated to creating cutting-edge web systems for archaeological sites in Egypt. <br/> <br/>
                    Our team is made up of experts in web and business development, archaeology, 
                    and digital media, who work together to connect the past to the future through innovative technology.
                </p>
                <a href="{{ url()->current() }}" class="about-three__content-link">
                    <i class="egypt-icon-download"></i>
                    <span>Download Story in PDF</span>
                </a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-three__tab">
                <ul
                    class="list-unstyled nav nav-tabs about-three__tab-list"
                    role="tablist"
                >
                    <li class="nav-item">
                    <a
                        data-toggle="tab"
                        href="#year-1"
                        role="tab"
                        class="nav-link active"
                        >Current Projects</a
                    >
                    </li>
                    <li class="nav-item">
                    <a
                        data-toggle="tab"
                        href="#year-2"
                        role="tab"
                        class="nav-link"
                        >Future Plans</a
                    >
                    </li>
                </ul>
                <div class="tab-content">
                    <div
                    class="tab-pane animated fadeInUp show active"
                    id="year-1"
                    >
                    <div class="about-three__tab-content">
                        <p class="about-three__tab-text">
                        At IMENTET, we kicked off our website with our most notable projects. The first was our work for <a href="home.html" target="_blank" style="color: #d99578;">the Grand Egyptian Museum</a>,
                        where we created a state-of-the-art web system that allows visitors to explore the museum's collections and exhibits online.
                        <br/> We also worked on a project for <a href="{{route('pyramids.home')}}" target="_blank" style="color: #d99578;">The Pyramids of Egypt</a>, 
                        creating a web system that allows visitors to explore the Pyramids and learn about their history and significance. 
                        </p>
                    </div>
                    </div>
                    <div class="tab-pane animated fadeInUp" id="year-2">
                    <div class="about-three__tab-content">
                        <p class="about-three__tab-text">
                        We are excited to continue our work in Egypt and expand our services to other archaeological sites around the world.
                        Our goal is to use technology to connect people with the past in a meaningful way,
                        and we are always looking for new and innovative ways to achieve this.
                        </p>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

    <div class="department-one__bottom">
        <div class="container">
            <div class="inner-container wow fadeInRight" data-wow-duration="1500ms">
                <div class="row">
                    <div class="col-lg-4">
                        <ul class="department-one__list list-unstyled">
                            <li>
                                <a href="{{ url()->current() }}">Department of <br />Ancient Collection</a>
                            </li>
                            <li>
                                <a href="{{ url()->current() }}">Department of Information Technology</a>
                            </li>
                            <li>
                                <a href="{{ url()->current() }}">Department of Public </br>Relations</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <ul class="department-one__list list-unstyled">
                            <li>
                                <a href="{{ url()->current() }}">Department of Exhibitions, <br />Communication and Events</a>
                            </li>
                            <li>
                                <a href="{{ url()->current() }}">Department of Customer Support</a>
                            </li>
                            <li>
                                <a href="{{ url()->current() }}">Department of Administrative and <br/> Financial </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <div class="department-one__carrer">
                            <div class="department-one__carrer-inner">
                                <i class="egypt-icon-career"></i>
                                <h3 class="department-one__carrer-title">
                                    Find Your Career
                                </h3>
                                <a href="{{route('gem.careers.index')}}" class="department-one__carrer-link">Job Oppurtunities <span>+</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="video-two">
    </section>

    <section class="team-one">
    <div class="container">
        <div class="block-title text-center">
        <p class="block-title__tag-line">Behind IMENTET</p>
        <h2 class="block-title__title">Board of Directors</h2>
        </div>
        <div class="row">
        <div class="col-lg-3 col-md-6">
            <div
            class="team-one__single wow fadeInUp"
            data-wow-duration="1500ms"
            data-wow-delay="000ms"
            >
            <div class="team-one__image">
                <img loading="lazy" src="images/team/team-1-1.jpg" alt="Awesome Image" />
            </div>
            <div class="team-one__content">
                <h3 class="team-one__name">Rawan Ayman</h3>
                <p class="team-one__designation">IT Desginer</p>
                <div class="team-one__social">
                <p class="team-one__social-text text-uppercase">
                    <i class="egypt-icon-share"></i>Get Touch With Me
                </p>
                <div class="team-one__social-links">
                    <a href="{{ url()->current() }}" class="fa fa-facebook-f"></a>
                    <a href="{{ url()->current() }}" class="fa fa-twitter"></a>
                    <a href="{{ url()->current() }}" class="fa fa-linkedin"></a>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div
            class="team-one__single wow fadeInUp"
            data-wow-duration="1500ms"
            data-wow-delay="100ms"
            >
            <div class="team-one__image">
                <img loading="lazy" src="images/team/team-1-2.jpg" alt="Awesome Image" />
            </div>
            <div class="team-one__content">
                <h3 class="team-one__name">Ruqaya Amr</h3>
                <p class="team-one__designation">Financial Director</p>
                <div class="team-one__social">
                <p class="team-one__social-text text-uppercase">
                    <i class="egypt-icon-share"></i>Get Touch With Me
                </p>
                <div class="team-one__social-links">
                    <a href="{{ url()->current() }}" class="fa fa-facebook-f"></a>
                    <a href="{{ url()->current() }}" class="fa fa-twitter"></a>
                    <a href="{{ url()->current() }}" class="fa fa-linkedin"></a>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div
            class="team-one__single wow fadeInUp"
            data-wow-duration="1500ms"
            data-wow-delay="200ms"
            >
            <div class="team-one__image">
                <img loading="lazy" src="images/team/team-1-3.jpg" alt="Awesome Image" />
            </div>
            <div class="team-one__content">
                <h3 class="team-one__name">Farah Khaled</h3>
                <p class="team-one__designation">Financial Director</p>
                <div class="team-one__social">
                <p class="team-one__social-text text-uppercase">
                    <i class="egypt-icon-share"></i>Get Touch With Me
                </p>
                <div class="team-one__social-links">
                    <a href="{{ url()->current() }}" class="fa fa-facebook-f"></a>
                    <a href="{{ url()->current() }}" class="fa fa-twitter"></a>
                    <a href="{{ url()->current() }}" class="fa fa-linkedin"></a>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div
            class="team-one__single wow fadeInUp"
            data-wow-duration="1500ms"
            data-wow-delay="300ms"
            >
            <div class="team-one__image">
                <img loading="lazy" src="images/team/team-1-4.jpg" alt="Awesome Image" />
            </div>
            <div class="team-one__content">
                <h3 class="team-one__name">Assem Mohsen</h3>
                <p class="team-one__designation">IT Developer</p>
                <div class="team-one__social">
                <p class="team-one__social-text text-uppercase">
                    <i class="egypt-icon-share"></i>Get Touch With Me
                </p>
                <div class="team-one__social-links">
                    <a href="{{ url()->current() }}" class="fa fa-facebook-f"></a>
                    <a href="{{ url()->current() }}" class="fa fa-twitter"></a>
                    <a href="{{ url()->current() }}" class="fa fa-linkedin"></a>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div
            class="team-one__single wow fadeInUp"
            data-wow-duration="1500ms"
            data-wow-delay="100ms"
            >
            <div class="team-one__image">
                <img loading="lazy" src="images/team/team-1-2.jpg" alt="Awesome Image" />
            </div>
            <div class="team-one__content">
                <h3 class="team-one__name">Amgad Mahmoud</h3>
                <p class="team-one__designation">System Designer</p>
                <div class="team-one__social">
                <p class="team-one__social-text text-uppercase">
                    <i class="egypt-icon-share"></i>Get Touch With Me
                </p>
                <div class="team-one__social-links">
                    <a href="{{ url()->current() }}" class="fa fa-facebook-f"></a>
                    <a href="{{ url()->current() }}" class="fa fa-twitter"></a>
                    <a href="{{ url()->current() }}" class="fa fa-linkedin"></a>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div
            class="team-one__single wow fadeInUp"
            data-wow-duration="1500ms"
            data-wow-delay="100ms"
            >
            <div class="team-one__image">
                <img loading="lazy" src="images/team/team-1-2.jpg" alt="Awesome Image" />
            </div>
            <div class="team-one__content">
                <h3 class="team-one__name">Ziad Mahmoud</h3>
                <p class="team-one__designation">Web Designer</p>
                <div class="team-one__social">
                <p class="team-one__social-text text-uppercase">
                    <i class="egypt-icon-share"></i>Get Touch With Me
                </p>
                <div class="team-one__social-links">
                    <a href="{{ url()->current() }}" class="fa fa-facebook-f"></a>
                    <a href="{{ url()->current() }}" class="fa fa-twitter"></a>
                    <a href="{{ url()->current() }}" class="fa fa-linkedin"></a>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </section>

    <footer class="site-footer">
    <div class="container">
        <a class="site-footer__logo" href="https://gem.infinityfreeapp.com/GrandEgyptianMuseum/Backend/Project/index.php"
        ><img loading="lazy" src="https://gem.infinityfreeapp.com/GrandEgyptianMuseum/Backend/Images/resources/footer-logo-imentet-gem.svg" class="footer-logo"

alt=""
        /></a>
        <form action="#" class="site-footer__form">
        <div class="site-footer__form-icon">
            <i class="egypt-icon-email"></i
            ><!-- /.egypt-icon-email -->
        </div>
        <!-- /.site-footer__form-icon -->
        <input type="text" placeholder="Enter Email Address..." />
        <button type="submit">
            <i class="egypt-icon-right-arrow1"></i
            ><!-- /.egypt-icon-right-arrow1 -->
        </button>
        </form>
        <!-- /.site-footer__form -->
        <div class="site-footer__social">
        <a href="{{ url()->current() }}"><i class="egypt-icon-logo"></i></a>
        <a href="{{ url()->current() }}"><i class="egypt-icon-twitter"></i></a>
        <a href="{{ url()->current() }}"><i class="egypt-icon-instagram"></i></a>
        <a href="{{ url()->current() }}"><i class="egypt-icon-play"></i></a>
        </div>
        <!-- /.site-footer__social -->
        <p class="site-footer__copy">
        Copyrights &copy; 2023 <a href="{{ url()->current() }}">Egypt</a>, All Rights Reserved.
        </p>
        <!-- /.site-footer__copy -->
    </div>
    <!-- /.container -->
    </footer>

@endsection