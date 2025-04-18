<footer class="site-footer">
    <div class="container">
        <a class="site-footer__logo" href="{{route('pyramids.home')}}">
            <img loading="lazy" src="{{ asset('assets/GEM/images/resources/IMENTET-DARK-PYRAMIDS.png') }}" width="240px" alt="Imentet"/>
        </a>
        <form class="site-footer__form">
            <div class="site-footer__form-icon">
                <i class="egypt-icon-email"></i>
            </div>
            <input type="email" required placeholder="Enter Email Address..." />
            <button type="submit">
                <i class="egypt-icon-right-arrow1"></i>
            </button>
        </form>
        <div class="site-footer__social">
            <a href="https://www.facebook.com/giza.pyramids/"><i class="egypt-icon-logo"></i></a>
            <a href="https://twitter.com/PyramidsGiza"><i class="egypt-icon-twitter"></i></a>
            <a href="https://www.instagram.com/explore/locations/250717230/great-pyramids-of-giza/"><i class="egypt-icon-instagram"></i></a>
        </div>
        <p class="site-footer__copy">
            Copyrights &copy; {{ date('Y') }} <a href="{{route('pyramids.about')}}">Imentet</a>, All Rights Reserved.
        </p>
    </div>
</footer>