<header class="site-header site-header__header-one">
    <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky" >
      <div class="container clearfix">
        <div class="logo-box">
          <a class="navbar-brand" href="{{route('gem.home')}}">
            <img src="{{ asset('assets/GEM/images/resources/imentet-logo.svg') }}" class="main-logo" alt="Imentet" />
          </a>
          <button class="menu-toggler" data-target=".main-navigation">
            <span class="fa fa-bars"></span>
          </button>
        </div>
        <div class="main-navigation">
          <ul class="navigation-box @@extra_class">
            <li class="current">
              <a href="{{route('gem.home')}}">Home</a>
              <ul class="submenu">
                <li><a href="{{route('gem.home')}}">Grand Egyptian Museum</a></li>
                <li><a href="{{route('pyramids.home')}}">Pyramids</a></li>
              </ul>
            </li>
            <li>
              <a href="{{route('gem.about')}}">About Us</a>
            </li>
            <li>
              <a href="{{route('auth.register.index')}}" class="thm-btn topbar-one__btn">
                Join Us
              </a>
            </li>
          </ul>
        </div>
        <div class="right-side-box">
          <a href="#" class="site-header__sidemenu-nav side-menu__toggler">
            <span class="site-header__sidemenu-nav-line"></span>
            <span class="site-header__sidemenu-nav-line"></span>
            <span class="site-header__sidemenu-nav-line"></span>
            </a>
        </div>
      </div>
    </nav>
</header>