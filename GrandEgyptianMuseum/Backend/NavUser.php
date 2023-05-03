<?php
include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-touch-icon.png" />
    <meta name="theme-color" content="#d99578" />
    <meta name="msapplication-navbutton-color" content="#d99578" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#d99578" />
    <link href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i%7CPrata&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="css/animate.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="css/bootstrap-select.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/hover-min.css" />
    <link rel="stylesheet" href="css/magnific-popup.css" />
    <link rel="stylesheet" href="css/owl.carousel.min.css" />
    <link rel="stylesheet" href="css/owl.theme.default.min.css" />
    <link rel="stylesheet" href="plugins/egypt-icons/style.css" />
    <link rel="stylesheet" href="css/nouislider.css" />
    <link rel="stylesheet" href="css/nouislider.pips.css" />
    <link rel="stylesheet" href="css/jquery.bootstrap-touchspin.min.css" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/responsive.css" />

    <title><?php echo $PageTitle ?></title>
</head>

<body>
    <div class="preloader">
        <span></span>
    </div>                      
    <div class="page-wrapper">
        <section class="topbar-one">
            <div class="container">
                <div class="inner-container">
                    <div class="topbar-one__left">
                        <a href="contact.html" class="topbar-one__link">
                            <i class="egypt-icon-clock"></i> Plan Your Visit Today :
                            <span class="topbar-one__time-wrap">
                                <span class="topbar-one__time">
                                    9 <span class="topbar-one__minute">00</span>
                                </span>

                                <span class="topbar-one__sep"></span>
                                <span class="topbar-one__time">
                                    7 <span class="topbar-one__minute">30</span></span>
                            </span>
                        </a>
                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/contact.php#map" class="topbar-one__link">
                            <i class="egypt-icon-maps-and-location"></i>
                            Get Direction
                        </a>
                        <?php if (isset($_SESSION["UserID"]) || isset($_SESSION['AdminID'])) {
                            echo "<a href='http://localhost/imentet-1/GrandEgyptianMuseum/Backend/logout.php' class='Logout'>";
                            echo "<i class='fa-solid fa-arrow-right-from-bracket'></i>";
                            echo " Logout </a>";
                        }
                        ?>
                    </div>
                    <ul class="topbar-one__right list-unstyled">
                        <li>
                            <div class="topbar-one__social">
                                <a href="#"><i class="egypt-icon-logo"></i></a>
                                <a href="#"><i class="egypt-icon-twitter"></i></a>
                                <a href="#"><i class="egypt-icon-instagram"></i></a>
                                <a href="#"><i class="egypt-icon-play"></i></a>
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
                        <?php if (isset($_SESSION["UserID"])){ ?>
                            <li>
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/profile.php" class="user-icon topbar-one__search">
                                    <i class="fa fa-user"></i>
                                </a>
                            </li>
                        <?php }elseif(isset($_SESSION["AdminID"])){
                            $AdminID = $_SESSION["AdminID"] ;
                            ?>
                            <li>
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Profile.php?action=Manage&AdminID=<?php echo $AdminID ?>" class="user-icon topbar-one__search">
                                    <i class="fa fa-user"></i>
                                </a>
                            </li>
                        <?php }  ?>
                        <li>
                            <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/product-details.php" class="thm-btn topbar-one__btn">Tickets</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <header class="site-header site-header__header-one">
            <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
                <div class="container clearfix">
                    <div class="logo-box">
                        <a class="navbar-brand" href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php">
                            <img src="images/resources/imentet-gem-logo.svg" class="main-logo" alt="Awesome Image" />
                        </a>
                        <button class="menu-toggler" data-target=".main-navigation">
                            <span class="fa fa-bars"></span>
                        </button>
                    </div>
                    <div class="main-navigation">
                        <ul class="navigation-box @@extra_class">
                            <li class="current">
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php">Home</a>
                                <ul class="submenu">
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Grand Egyptian Museum</a></li>
                                    <li><a href="">Pyramids</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php">The Museum</a>
                                <ul class="submenu">
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php">About Us </a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/team.php">Meet Our Team</a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Venues.php">Venues</a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/contact.php">Contact</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="request-visit.php">Visit</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="request-visit.php#open-hrs">Opening Hours</a>
                                    </li>
                                    <li>
                                        <a href="request-visit.php#admission">Admission Cost</a>
                                    </li>
                                    <li>
                                        <a href="request-visit.php#how-to-get">How to Get Here</a>
                                    </li>
                                    <li>
                                        <a href="request-visit.php#anenities">Amenities</a>
                                    </li>
                                    <li>
                                        <a href="request-visit.php#interior">Interior Map</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">What’s On</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/events.php">Events </a>
                                        <ul class="submenu">
                                            <?php 
                                                $SelectEvent = "SELECT * FROM entertainmnet ORDER BY ID DESC LIMIT 4 ";
                                                $SpecificEvent = mysqli_query($con , $SelectEvent);
                                                $SpecificRow = mysqli_fetch_assoc($SpecificEvent); 
                                                foreach ($SpecificEvent as $RowEvent){ ?>
                                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $RowEvent['ID'] ?>"><?php echo $RowEvent['Name'] ?> </a></li>
                                                <?php } ?>
                                        </ul>
                                    </li>
                                    <li><a href="exhibhition.php">Exhibition</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Collections</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="collection-antiquties.php">Antiquities</a>
                                    </li>
                                    <li><a href="collection-cultural.html">Cultural</a></li>
                                    <li><a href="collection-drawing.html">Drawing</a></li>
                                    <li><a href="collection-painting.html">Painting</a></li>
                                    <li><a href="collection-sculpture.html">Sculpture</a></li>
                                    <li>
                                        <a href="collection-details.html">Single Collection</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">Pages</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="blog-masonry.html">Blog</a>
                                        <ul class="submenu right-align">
                                            <li><a href="blog-masonry.html">Masonry View</a></li>
                                            <li><a href="blog-grid.html">Grid View</a></li>
                                            <li><a href="blog-large.html">Large Image</a></li>
                                            <li><a href="blog-details.html">Single Post</a></li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="./Project/proudcts.php">Shop</a>
                                        <ul class="submenu right-align">
                                            <li><a href="./Project/proudcts.php">Products</a></li>
                                            <li>
                                                <a href="product-details.html">Single Product</a>
                                            </li>
                                            <li><a href="cart.php">Shopping Cart</a></li>
                                            <li><a href="checkhout.php">Checkout</a></li>
                                            <li><a href="my-account.php">My Account</a></li>
                                        </ul>
                                        <!-- /.submenu -->
                                    </li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/donation.php">Donation</a></li>
                                    <li><a href="faq.php">FAQ’s</a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/membership.php">Membership</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="right-side-box">
                        <a href="cart.html" class="site-header__cart">
                            <i class="egypt-icon-supermarket"></i>
                            <span class="count">3</span>
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