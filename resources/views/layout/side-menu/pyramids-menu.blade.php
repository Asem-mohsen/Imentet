<!-- Side Menu -->
<div class="side-menu__block">
    <div class="side-menu__block-overlay custom-cursor__overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div>
    <div class="side-menu__block-inner">
        <a href="{{route('pyramids.home')}}">
        <img src="{{asset('assets/GEM/images/resources/dark-logo-imentet.png')}}" alt="Pyramids Imentet" />
        </a>
        <div class="side-menu__block-about">
            <h3 class="side-menu__block__title">About Us</h3>
            <p class="side-menu__block-about__text">
            The pyramids of Egypt have a rich and fascinating history 
            that dates back over 4,500 years. These monumental structures were built as
            tombs for the pharaohs, the ancient Egyptian kings, who believed in an afterlife
            and wanted to ensure their eternal journey
            </p>
            <a href="{{route('pyramids.tickets.index')}}" class="thm-btn side-menu__block-about__btn">Get Tickets</a>
        </div>

        <hr class="side-menu__block-line" />
        <div class="side-menu__block-contact">
        <h3 class="side-menu__block__title">Contact Us</h3>
        <ul class="side-menu__block-contact__list">
            <li class="side-menu__block-contact__list-item">
            <i class="fa fa-map-marker"></i>
            El Haram St, Giza City, EGY
            </li>
            <li class="side-menu__block-contact__list-item">
            <i class="fa fa-phone"></i>
            <a href="tel:526-236-895-4732">(526) 236-895-4732</a>
            </li>
            <li class="side-menu__block-contact__list-item">
            <i class="fa fa-envelope"></i>
            <a href="mailto:Imentet@mail.com">Imentet@mgail.com</a>
            </li>
            <li class="side-menu__block-contact__list-item">
            <i class="fa fa-clock-o"></i>
            Week Days: 09.00 to 18.00 Sunday: Closed
            </li>
        </ul>
        </div>
        <p class="side-menu__block__text site-footer__copy-text">
        <a href="#">Imentet</a> 
        <i class="fa fa-copyright"></i>{{ date('Y') }} All Right
        Reserved
        </p>
    </div>
</div>

<!-- Search -->
<div class="search-popup">
    <div class="search-popup__overlay custom-cursor__overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
    </div>
    <div class="search-popup__inner">
        <form action="#" class="search-popup__form">
        <input type="text" name="search" placeholder="Type here to Search...." />
        <button type="submit">
            <i class="egypt-icon-search"></i>
        </button>
        </form>
    </div>
</div>

<!-- to Up -->
<a href="#" data-target="html" class="scroll-to-target scroll-to-top">
    <i class="egypt-icon-arrow-2"></i>
</a>