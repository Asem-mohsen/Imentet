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
    <link rel="stylesheet" href="css/style.css?v=11" />
    <link rel="stylesheet" href="css/responsive.css" />
    <link rel="stylesheet" href="css/payment.css" />

    <title><?php if(isset($PageTitle)){echo $PageTitle ; }else{ echo "Defult";} ?></title>
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
                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/PlanVisit.php" class="topbar-one__link">
                            <i class="egypt-icon-clock"></i> Plan Your Visit Today :
                            <span class="topbar-one__time-wrap">
                                <span class="topbar-one__time">
                                    <?php echo date('h'  , strtotime('+1 hour')) ?> <span class="topbar-one__minute"><?php echo date('i') ?></span>
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
                        <?php if (isset($_SESSION["UserID"])){ ?>
                            <span class="top-wrapper">
                                <li>
                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/profile.php" class="user-icon topbar-one__search">
                                        <i class="fa fa-user"></i>
                                    </a>
                                    <ul class="submenu">
                                        <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/profile.php">Edit Profile </a></li>
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
                                        <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Profile.php?action=Manage&AdminID=<?php echo $AdminID ?>">Edit Profile </a></li>
                                        <li><a href='http://localhost/imentet-1/GrandEgyptianMuseum/Backend/logout.php'>Log out</a></li>
                                    </ul>
                                </li>
                            </span>
                        <?php }  ?>
                        <li>
                            <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/VisitTickets.php" class="thm-btn topbar-one__btn">Tickets</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <header class="site-header site-header__header-one">
            <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
                <div class="container clearfix">
                    <div class="logo-box">
                        <a class="navbar-brand" href="http://localhost/imentet-1/Pyramids/pyramids/index.php">
                            <img src="images/resources/imentet-gem-logo.svg" class="main-logo" alt="Awesome Image" />
                        </a>
                        <button class="menu-toggler" data-target=".main-navigation">
                            <span class="fa fa-bars"></span>
                        </button>
                    </div>
                    <div class="main-navigation">
                        <ul class="navigation-box @@extra_class">
                            <li>
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Home</a>
                            </li>
                            <li>
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php">The Museum</a>
                                <ul class="submenu">
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php">About Us </a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/contact.php">Contact</a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/donation.php">Donation</a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Careers.php">Careers</a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/membership.php">Membership</a></li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/FAQ.php">FAQ's</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/PlanVisit.php">Visit</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/PlanVisit.php#open-hrs">Opening Hours</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/PlanVisit.php#admission">Admission Cost</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/PlanVisit.php#how-to-get">How to Get Here</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/PlanVisit.php#anenities">Amenities</a>
                                    </li>
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/PlanVisit.php#interior">Interior Map</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">What's On</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/events.php?Page=1">Events </a>
                                        <ul class="submenu">
                                            <?php 
                                                $SelectEvent = "SELECT * FROM entertainmnet ORDER BY ID ASC LIMIT 4 ";
                                                $SpecificEvent = mysqli_query($con , $SelectEvent);
                                                $SpecificRow = mysqli_fetch_assoc($SpecificEvent); 
                                                foreach ($SpecificEvent as $RowEvent){ ?>
                                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $RowEvent['ID'] ?>"><?php echo $RowEvent['Name'] ?> </a></li>
                                                <?php } ?>
                                        </ul>
                                    </li>
                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Exhibition.php">Exhibition</a></li>
                                    <li>
                                        <a >Museums </a>
                                        <ul class="submenu">
                                            <?php 
                                                $SelectEvent = "SELECT * FROM entertainmnet WHERE CatID = 10 AND ID != 82 LIMIT 4 ";
                                                $SpecificEvent = mysqli_query($con , $SelectEvent);
                                                $SpecificRow = mysqli_fetch_assoc($SpecificEvent); 
                                                foreach ($SpecificEvent as $RowEvent){ ?>
                                                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $RowEvent['ID'] ?>"><?php echo $RowEvent['Name'] ?> </a></li>
                                                <?php } ?>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Collections.php">Collections</a>
                                <ul class="submenu">
                                        <?php 
                                            $SelectCollections = "SELECT * FROM collectionscategories LIMIT 5 ";
                                                                    
                                            $SpecificCategory = mysqli_query($con , $SelectCollections);
                                            $SpecificRow = mysqli_fetch_assoc($SpecificCategory); 
                                            foreach ($SpecificCategory as $RowCat){ ?>
                                                <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Antiquities.php?CatID=<?php echo $RowCat['ID'] ?>"><?php echo $RowCat['Category'] ?> </a></li>
                                            <?php } ?>
                                </ul>
                            </li>
                            <li>
                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/OnlineShop.php?Page=1">Shop</a>
                            </li>
                        </ul>
                    </div>
                    <div class="right-side-box">
                    <?php  if(isset($_SESSION['cart'])){ 
                                if(count($_SESSION['cart']) > 0 ){?>
                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Cart.php" class="site-header__cart">
                                        <i class="egypt-icon-supermarket"></i>
                                <?php }
                            }else{ ?>
                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/OnlineShop.php?Page=1" class="site-header__cart">
                                        <i class="egypt-icon-supermarket"></i>
                            <?php }
                            if(isset($_SESSION['cart'])){ 
                                        if(count($_SESSION['cart']) > 0 ){ ?>
                                            <span class="count"><?php echo count($_SESSION['cart']) ; ?> </span>
                                        <?php }
                                    } ?>
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


