<div class="side-menu__block">
    <div class="side-menu__block-overlay custom-cursor__overlay">
      <div class="cursor"></div>
      <div class="cursor-follower"></div>
    </div>
    <div class="side-menu__block-inner">
      <a href="{{route('gem.home')}}">
        <img loading="lazy" src="{{ asset('assets/GEM/images/resources/dark-logo-imentet.png') }}" alt="Imentet" />
      </a>
      <div class="side-menu__block-about">
        <h3 class="side-menu__block__title">About Us</h3>
        <p class="side-menu__block-about__text">
          Grand Egyptian Museum is the world's leading museum of history & culture, housing a
          permanent collection of over 2.3 million objects that span over 5,000
          which is toil and pain these cases are perfectly.
        </p>
        <a href="{{route('about')}}" class="thm-btn side-menu__block-about__btn">
          More About Us
        </a>
      </div>
      <hr class="side-menu__block-line" />
      <div class="side-menu__block-contact">
        <h3 class="side-menu__block__title">Contact Us</h3>
        <ul class="side-menu__block-contact__list">
          <li class="side-menu__block-contact__list-item">
            <i class="fa fa-map-marker"></i>
            Giza, Egypt
          </li>
          <li class="side-menu__block-contact__list-item">
            <i class="fa fa-phone"></i>
            <a href="tel:+20-1098656413">(526) 236-895-4732</a>
          </li>
          <li class="side-menu__block-contact__list-item">
            <i class="fa fa-envelope"></i>
            <a href="mailto:example@mail.com">Imentet@mail.com</a>
          </li>
          <li class="side-menu__block-contact__list-item">
            <i class="fa fa-clock-o"></i>
            Week Days: 09.00 to 18.00 Fridays: Closed
          </li>
        </ul>
      </div>
      <p class="side-menu__block__text site-footer__copy-text">
        <a href="{{route('about')}}">Imenet</a>
          <i class="fa fa-copyright"></i> {{ date('Y') }} All Right
        Reserved
      </p>
    </div>
  </div>

  <div class="search-popup">
    <div class="search-popup__overlay custom-cursor__overlay">
      <div class="cursor"></div>
      <div class="cursor-follower"></div>
    </div>
    <div class="search-popup__inner">
      <form action="#" class="search-popup__form">
        <input  type="text" name="search" placeholder="Type here to Search...." />
        <button type="submit">
          <i class="egypt-icon-search"></i>
        </button>
      </form>
    </div>
  </div>

  <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
    <i class="egypt-icon-arrow-2"></i>
  </a>