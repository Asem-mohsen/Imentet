<section class="topbar-one">
    <div class="container">
        <div class="inner-container">
            <div class="topbar-one__left">
                <a href="{{route('gem.tickets.plan-visit')}}" class="topbar-one__link">
                    <i class="egypt-icon-clock"></i> Plan Your Visit Today :
                    <span class="topbar-one__time-wrap">
                        <span class="topbar-one__time">
                            {{ date('h'  , strtotime('+1 hour')) }} <span class="topbar-one__minute">{{ date('i') }}</span>
                        </span>

                        <span class="topbar-one__sep"></span>
                        <span class="topbar-one__time">
                            7 <span class="topbar-one__minute">30</span></span>
                    </span>
                </a>
                <a href="{{route('gem.contact.index')}}" class="topbar-one__link">
                    <i class="egypt-icon-maps-and-location"></i>
                    Get Direction
                </a>
            </div>
            <ul class="topbar-one__right list-unstyled">
                <li>
                    <div class="topbar-one__social">
                        <a href="https://www.facebook.com/GrandEgyptianMuseum/" target="_blank"><i class="egypt-icon-logo"></i></a>
                        <a href="https://twitter.com/EgyptMuseumGem"  target="_blank"><i class="egypt-icon-twitter"></i></a>
                        <a href="https://www.instagram.com/grandegyptianmuseum/?hl=en"  target="_blank"><i class="egypt-icon-instagram"></i></a>
                    </div>
                </li>
                <li>
                    <a href="#" class="topbar-one__search search-popup__toggler">
                        <i class="egypt-icon-search"></i>
                    </a>
                </li>
                <li>
                    <select class="selectpicker">
                        <option>EN</option>
                        <option>AR</option>
                        <option>FR</option>
                    </select>
                </li>
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
                <li>
                    <a href="{{route('gem.tickets.index')}}" class="thm-btn topbar-one__btn">Tickets</a>
                </li>
            </ul>
        </div>
    </div>
</section>

<header class="site-header site-header__header-one">
    <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
        <div class="container clearfix">
            <div class="logo-box">
                <a class="navbar-brand" href="{{route('index')}}">
                    <img loading="lazy" src="{{asset('assets/GEM/images/resources/imentet-gem-logo.svg')}}" class="main-logo" alt="Imentent" />
                </a>
                <button class="menu-toggler" data-target=".main-navigation">
                    <span class="fa fa-bars"></span>
                </button>
            </div>
            <div class="main-navigation">
                <ul class="navigation-box @@extra_class">
                    <li>
                        <a href="{{route('gem.home')}}">Home</a>
                    </li>
                    <li>
                        <a href="{{route('gem.about')}}">The Museum</a>
                        <ul class="submenu">
                            <li><a href="{{route('gem.about')}}">About Us </a></li>
                            <li><a href="{{route('gem.contact.index')}}">Contact</a></li>
                            <li><a href="{{route('gem.donations.index')}}">Donation</a></li>
                            <li><a href="{{route('gem.careers.index')}}">Careers</a></li>
                            <li><a href="{{route('gem.memberships.index')}}">Membership</a></li>
                            <li><a href="{{route('gem.faqs')}}">FAQ's</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="{{route('gem.tickets.plan-visit')}}">Visit</a>
                        <ul class="submenu">
                            <li>
                                <a href="{{route('gem.tickets.plan-visit')}}#open-hrs">Opening Hours</a>
                            </li>
                            <li>
                                <a href="{{route('gem.tickets.plan-visit')}}#admission">Admission Cost</a>
                            </li>
                            <li>
                                <a href="{{route('gem.tickets.plan-visit')}}#how-to-get">How to Get Here</a>
                            </li>
                            <li>
                                <a href="{{route('gem.tickets.plan-visit')}}#anenities">Amenities</a>
                            </li>
                            <li>
                                <a href="{{route('gem.tickets.plan-visit')}}#interior">Interior Map</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">What's On</a>
                        <ul class="submenu">
                            <li>
                                <a href="{{ route('gem.events.index') }}">Events</a>
                                <ul class="submenu">
                                    @foreach ($data['events'] as $event)
                                        <li>
                                            <a href="{{ route('gem.events.show', $event->id) }}">
                                                {{ Illuminate\Support\Str::limit($event->title, 15) }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('gem.events.index', ['event_category' => 'exhibitions']) }}">Exhibition</a>
                            </li>
                            <li>
                                <a>Museums</a>
                                <ul class="submenu">
                                    @foreach ($data['museums'] as $museum)
                                        <li>
                                            <a href="{{ route('gem.events.show', $museum->id) }}">
                                                {{ $museum->title }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        </ul>
                    </li>
                    
                    <li>
                        <a href="{{ route('gem.collections.index') }}">Collections</a>
                        <ul class="submenu">
                            @foreach ($data['categories'] as $category)
                                <li>
                                    <a href="{{ route('gem.collections.category', $category->slug) }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('gem.shop.index') }}">Shop</a>
                    </li>
                </ul>
            </div>
            <div class="right-side-box">
                
                <a href="{{ $data['cartItemCount'] > 0 ? route('gem.cart.index') : route('gem.shop.index') }}" class="site-header__cart">
                    <i class="egypt-icon-supermarket"></i>
                    <span class="count" id="cart-count">
                        {{ $data['cartItemCount'] ?? 0 }}
                    </span>
                </a>

                <a href="#" class="site-header__sidemenu-nav side-menu__toggler">
                    <span class="site-header__sidemenu-nav-line"></span>
                    <span class="site-header__sidemenu-nav-line"></span>
                    <span class="site-header__sidemenu-nav-line"></span>
                </a>
            </div>
        </div>
    </nav>
</header>