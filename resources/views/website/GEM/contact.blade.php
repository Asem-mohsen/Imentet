@extends('layout.template.gem-template')

@section('title' , 'Contact Us')

@section('content')

    <section class="inner-banner">
        <div class="container">
            <h2 class="inner-banner__title">Contact Us</h2>
            <p class="inner-banner__text">We're always here to help you with anything you might need.</p>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="{{route('gem.home')}}">Home</a></li>
                <li><a href="{{route('gem.about')}}">The Museum</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </section>

    <section class="contact-one">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="contact-one__main">
                        <div class="contact-one__image">
                            <img src="{{ asset('assets/GEM/images/resources/contact-1-1.jpeg') }}" class="img-fluid" alt="" />
                        </div>
                        <div class="contact-one__content">
                            <div class="row no-gutters">
                                <div class="col-lg-6">
                                    <h3 class="contact-one__title">Egypt</h3>
                                    <p class="contact-one__text">Alexandria Desert Rd, Haram, Giza Governorate X4VF+V3F</p>
                                    <p class="contact-one__text"><a href="tel:321-888-789-0123">TEL: +20-23-531-7344</a></p>
                                    <p class="contact-one__text"><a href="mailto:egyptmuseum@example.com">E-mail: gem@example.com</a></p>
                                </div>
                                <div class="col-lg-6">
                                    <ul class="contact-one__list list-unstyled">
                                        <li><span class="contact-one__list-name">Sa & Su <span class="contact-one__list-colon">:</span></span>10am to 10.00pm</li>
                                        <li><span class="contact-one__list-name">Mo & Tu <span class="contact-one__list-colon">:</span></span>10am to 10.00pm</li>
                                        <li><span class="contact-one__list-name">We & Th <span class="contact-one__list-colon">:</span></span>10am to 10.00pm</li>
                                        <li><span class="contact-one__list-name">FR <span class="contact-one__list-colon">:</span></span>Closed</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{ route('gem.contact.store') }}" method="POST" class="contact-one__form">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <p class="contact-one__field">
                                    <label>First Name:</label>
                                    <input type="text" name="first_name" value="{{ old('first_name') }}" required>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="contact-one__field">
                                    <label>Last Name:</label>
                                    <input type="text" name="last_name"  value="{{ old('last_name') }}" required>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="contact-one__field">
                                    <label>Email:</label>
                                    <input type="email" name="email" value="{{ old('email') }}" required>
                                </p>
                            </div>
                            <div class="col-lg-6">
                                <p class="contact-one__field">
                                    <label>Phone:</label>
                                    <input type="number" name="phone" pattern="[0-9]*" value="{{ old('phone') }}" required>
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <p class="contact-one__field">
                                    <label>Subject:</label>
                                    <input type="text" name="subject" value="{{ old('subject') }}" required>
                                </p>
                            </div>
                            <div class="col-lg-12">
                                <p class="contact-one__field">
                                    <label>Message:</label>
                                    <textarea name="message" required>{{old('message')}}</textarea>
                                    <button type="submit" class="thm-btn contact-one__btn">Send Message</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="contact-map-one mb-5" id="map">
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13821.875835399496!2d31.122688!3d29.994688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584534984a8ad1%3A0x45764c5bc4ec261a!2sGrand%20Egyptian%20Museum!5e0!3m2!1sen!2seg!4v1681483362521!5m2!1sen!2seg" class="google-map__home" allowfullscreen></iframe>
        </div>
    </div>

@endsection

@section('js')

    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}", "Success", {
            "closeButton": true,
            "progressBar": true,
            "timeOut": 5000
        });
    </script>
    @endif

    @if (session('error'))
    <script>
        toastr.error("{{ session('error') }}", "Error", {
            "closeButton": true,
            "progressBar": true,
            "timeOut": 5000
        });
    </script>
    @endif

@endsection