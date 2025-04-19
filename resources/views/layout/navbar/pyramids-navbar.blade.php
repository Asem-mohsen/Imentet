<section class="topbar-two">
    <div class="container">
        <div class="inner-container">
        <div class="topbar-two__left">
            <a class="topbar-two__logo" href="{{route('index')}}">
                <img loading="lazy" src="{{asset('assets/GEM/images/resources/dark-logo-pyramids.svg')}}" alt="Imentet Pyramids" />
            </a>
            <div class="topbar-two__info">
            <div class="topbar-two__icon">
                <i class="egypt-icon-clock1"></i>
            </div>
            <div class="topbar-two__text">
                <p>
                Plan Your Visit <br />
                {{ date('h:i'  , strtotime('+1 hour')) }} -  05.00
                </p>
            </div>
            </div>
        </div>
        <ul class="topbar-two__right list-unstyled">
            <li>
            <div class="topbar-two__language">
                <i class="egypt-icon-global"></i>
                <select class="selectpicker">
                <option>EN</option>
                <option>BN</option>
                <option>FR</option>
                <option>RU</option>
                </select>
            </div>
            </li>

            <!-- Profile Icon -->
            @if(auth()->user())
                <span class="top-wrapper">
                    <li>
                        <a href="{{route('profile.index')}}" class="user-icon topbar-one__search">
                            <i class="fa fa-user"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="{{route('profile.index')}}">Edit Profile </a></li>
                            <li><a href='{{route('auth.logout.all')}}'>Log out</a></li>
                        </ul>
                    </li>
                </span>
            @endif

            <!-- Social Media Icons -->
            <li>
                <div class="topbar-two__social">
                    <a href="https://www.facebook.com/giza.pyramids/" target="_blank" data-toggle="tooltip" data-placement="top"  title="Facebook">
                    <i class="fa fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/PyramidsGiza" data-toggle="tooltip" data-placement="top" title="Twitter">
                    <i class="fa fa-twitter"></i>
                    </a>
                    <a href="https://www.instagram.com/explore/locations/250717230/great-pyramids-of-giza/" data-toggle="tooltip" data-placement="top" title="Instagram">
                    <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </li>

            <li>
                <a href="#" class="topbar-two__sidemenu-nav side-menu__toggler">
                    <span class="topbar-two__sidemenu-nav-line"></span>
                    <span class="topbar-two__sidemenu-nav-line"></span>
                    <span class="topbar-two__sidemenu-nav-line"></span>
                </a>
            </li>
        </ul>
        </div>
    </div>
</section>

<header class="site-header site-header__header-two">
    <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
        <div class="container clearfix">
            
            <div class="logo-box">
                <button class="menu-toggler" data-target=".main-navigation">
                <span class="fa fa-bars"></span>
                </button>
            </div>

            <div class="main-navigation">
                <ul class="navigation-box @@extra_class">
                    <li>
                        <a href="{{route('pyramids.home')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('pyramids.about')}}">The Pyramids</a>
                        <ul class="submenu">
                        <li><a href="{{route('pyramids.about')}}">About Us </a></li>
                        <li><a href="{{route('pyramids.contact.index')}}">Contact</a></li>
                        <li><a href="{{route('pyramids.donations.index')}}">Donation</a></li>
                        <li><a href="{{route('pyramids.memberships.index')}}">Membership</a></li>
                        <li><a href="{{route('pyramids.careers.index')}}">Careers</a></li>
                        <li><a href="{{route('pyramids.faqs')}}">FAQ's</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('pyramids.tickets.plan-visit')}}">Visit</a>
                        <ul class="submenu">
                            <li>
                                <a href="{{route('pyramids.tickets.plan-visit')}}#open-hrs">Opening Hours</a>
                            </li>
                            <li>
                                <a href="{{route('pyramids.tickets.plan-visit')}}#admission">Admission Cost</a>
                            </li>
                            <li>
                                <a href="{{route('pyramids.tickets.plan-visit')}}#how-to-get">How to Get Here</a>
                            </li>
                            <li>
                                <a href="{{route('pyramids.tickets.plan-visit')}}#anenities">Amenities</a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#">What's On</a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('pyramids.events.index') }}">Events </a>
                            </li>
                            <a href="{{ route('pyramids.events.index', ['event_category' => 'exhibitions']) }}">Exhibition</a>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('pyramids.shop.index') }}">Shop</a>
                    </li>
                </ul>
            </div>

            <div class="right-side-box">

                <a href="{{ $data['cartItemCount'] > 0 ? route('pyramids.cart.index') : route('pyramids.shop.index') }}" class="site-header__cart">
                    <i class="egypt-icon-supermarket"></i>
                    <span class="count" id="cart-count">
                        {{ $data['cartItemCount'] ?? 0 }}
                    </span>
                </a>

                <!-- Search Icon -->
                <a href="#" class="site-header__header-two__search search-popup__toggler">
                    <i class="egypt-icon-search"></i>
                </a>
            

                <a href="{{route('pyramids.tickets.index')}}" class="thm-btn site-header__header-two__btn">Buy Tickets</a>
            </div>
        </div>
    </nav>
</header>
