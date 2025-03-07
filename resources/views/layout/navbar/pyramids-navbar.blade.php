<section class="topbar-two">
    <div class="container">
        <div class="inner-container">
        <div class="topbar-two__left">
            <a class="topbar-two__logo" href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">
                <img src="images/resources/dark-logo-pyramids.svg" alt="" />
            </a>
            <div class="topbar-two__info">
            <div class="topbar-two__icon">
                <i class="egypt-icon-clock1"></i>
            </div>
            <div class="topbar-two__text">
                <p>
                Plan Your Visit <br />
                <?php echo date('h.i'  , strtotime('+1 hour')) ?> - 07.30 
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
            <?php if (isset($_SESSION["UserID"])){ ?>
                <span class="top-wrapper">
                    <li>
                        <a href="http://localhost/imentet-1/Pyramids/pyramids/Profile.php" class="user-icon topbar-one__search">
                            <i class="fa fa-user"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/Profile.php">Edit Profile </a></li>
                            <li><a href='http://localhost/imentet-1/GrandEgyptianMuseum/Backend/logout.php'>Log out</a></li>
                        </ul>
                    </li>
                </span>
            <?php }elseif(isset($_SESSION["AdminID"])){
                $AdminID = $_SESSION["AdminID"] ;
                ?>
                <span class="top-wrapper">
                    <li>
                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Profile.php?action=Manage&AdminID=<?php echo $AdminID ?>" class="user-icon topbar-one__search">
                            <i class="fa fa-user"></i>
                        </a>
                        <ul class="submenu">
                            <li><a href="hhttp://localhost/imentet-1/GrandEgyptianMuseum/Backend/Profile.php?action=Manage&AdminID=<?php echo $AdminID ?>">Edit Profile </a></li>
                            <li><a href='http://localhost/imentet-1/GrandEgyptianMuseum/Backend/logout.php'>Log out</a></li>
                        </ul>
                    </li>
                </span>
            <?php }  ?>

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
                <a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a>
            </li>
            <li>
                <a href="http://localhost/Imentet-1/Pyramids/pyramids/AboutUs.php">The Pyramids</a>
                <ul class="submenu">
                <li><a href="http://localhost/Imentet-1/Pyramids/pyramids/AboutUs.php">About Us </a></li>
                <li><a href="http://localhost/imentet-1/Pyramids/pyramids/ContactUs.php">Contact</a></li>
                <li><a href="http://localhost/imentet-1/Pyramids/pyramids/Donation.php">Donation</a></li>
                <li><a href="http://localhost/imentet-1/Pyramids/pyramids/Membership.php">Membership</a></li>
                <li><a href="http://localhost/imentet-1/Pyramids/pyramids/Careers.php">Careers</a></li>
                <li><a href="contact.html">FAQ's</a></li>
                </ul>
            </li>

            <li>
                <a href="http://localhost/imentet-1/Pyramids/pyramids/PlanVisit.php">Visit</a>
                <ul class="submenu">
                    <li>
                        <a href="http://localhost/imentet-1/Pyramids/pyramids/PlanVisit.php#open-hrs">Opening Hours</a>
                    </li>
                    <li>
                        <a href="http://localhost/imentet-1/Pyramids/pyramids/PlanVisit.php#admission">Admission Cost</a>
                    </li>
                    <li>
                        <a href="http://localhost/imentet-1/Pyramids/pyramids/PlanVisit.php#how-to-get">How to Get Here</a>
                    </li>
                    <li>
                        <a href="http://localhost/imentet-1/Pyramids/pyramids/PlanVisit.php#anenities">Amenities</a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="#">What's On</a>
                <ul class="submenu">
                <li>
                    <a href="http://localhost/imentet-1/Pyramids/pyramids/Events.php?Page=1">Events </a>
                </li>
                <li><a href="http://localhost/imentet-1/Pyramids/pyramids/Exhibition.php">Exhibition</a></li>
                </ul>
            </li>
            <li>
                <a href="http://localhost/imentet-1/Pyramids/pyramids/OnlineShop.php?Page=1">Shop</a>
            </li>
            </ul>
        </div>

        <div class="right-side-box">
            <?php  if(isset($_SESSION['cart'])){ 
                        if(count($_SESSION['cart']) > 0 ){?>
                            <a href="http://localhost/imentet-1/Pyramids/pyramids/Cart.php" class="site-header__cart" style="margin: 28px;">
                                <i class="egypt-icon-supermarket"  style="color:#302e2f ;"></i>
                            
                        <?php }
                    }else{ ?>
                            <a href="http://localhost/imentet-1/Pyramids/pyramids/OnlineShop.php?Page=1" class="site-header__cart" style="margin: 28px;">
                                <i class="egypt-icon-supermarket"  style="color:#302e2f ;"></i>
                            
                    <?php }
                    if(isset($_SESSION['cart'])){ 
                        if(count($_SESSION['cart']) > 0 ){ ?>
                            <span class="count"><?php echo count($_SESSION['cart']) ; ?> </span>
                        <?php }
                    } ?>
            </a>

            <!-- Search Icon -->
            <a href="#" class="site-header__header-two__search search-popup__toggler">
                <i class="egypt-icon-search"></i>
            </a>
          

            <a href="http://localhost/imentet-1/Pyramids/pyramids/VisitTickets.php" class="thm-btn site-header__header-two__btn">Buy Tickets</a>
        </div>
        </div>
    </nav>
</header>
