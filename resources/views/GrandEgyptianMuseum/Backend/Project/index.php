<?php
include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Imentet";
if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];
  $Select = "SELECT * FROM user WHERE ID = $UserID";
  $Run = mysqli_query($con , $Select);
  $UserRow = mysqli_fetch_assoc($Run);

  $Name = $UserRow['Name'];
}
if(isset($_SESSION['AdminID'])){
  $AdminID = $_SESSION['AdminID'];
  $Select = "SELECT * FROM admin WHERE ID = $AdminID";
  $RunAdmin = mysqli_query($con , $Select);
  $AdminRow = mysqli_fetch_assoc($RunAdmin);

  $Name = $AdminRow['Name'];
  
}
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i%7CPrata&display=swap" />
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
    <title><?php echo $PageTitle; ?></title>
  </head>

  <body>
    <div class="preloader">
      <span></span>
    </div>
    <div class="page-wrapper">

      <header class="site-header site-header__header-one">
        <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
          <div class="container clearfix">
            <div class="logo-box">
              <a class="navbar-brand" href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php">
                <img src="images/resources/imentet-logo.svg" class="main-logo" alt="Awesome Image" />
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
                    <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Pyramids</a></li>
                  </ul>
                </li>
                <li>
                  <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php">About Us</a>
                </li>
                <?php if(isset($_SESSION['UserID'])){ ?>
                <li>
                  <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/profile.php" class="thm-btn topbar-one__btn">
                    <i class="fa fa-user" style="margin-left: 0; margin-right: 8px" ></i>
                      <?php  echo "Hi, " . strtoupper($UserRow['Name']) ; ?>
                  </a>
                </li>
                <?php }elseif(isset($_SESSION['AdminID'])){ ?>
                  <li>
                  <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Profile.php?action=Manage&AdminID=<?php echo $AdminID ?>" class="thm-btn topbar-one__btn">
                    <i class="fa fa-user" style="margin-left: 0; margin-right: 8px" ></i>
                      <?php  echo "Hi, " . $AdminRow['Name'] ; ?>
                  </a>
                </li>
                <?php }else{ ?>
                  <li>
                      <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/register.php" class="thm-btn topbar-one__btn">Join Us</a>
                  </li>
                <?php } ?>
                
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

      <section class="welcome-section">
        <div class="grid-wrapper">
          <div class="box">
            <div class="container text-center">
              <p class="slider-one__tag-line text-uppercase">
                GRAND EGYPTIAN MUSEUM
              </p>
              <h2 class="slider-one__title">
                The World's Largest Museum Dedicated To <br />
                Egyptian Civilization.
              </h2>
              <p class="slider-one__text text-uppercase">Open Now</p>
              <div class="content">
                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php" target="_blank" class="thm-btn slider-one__btn">
                  Find Out More</a>
              </div>
            </div>
          </div>
          <div class="box">
            <div class="container text-center">
              <p class="slider-one__tag-line text-uppercase">
                PYRAMIDS OF GIZA
              </p>
              <h2 class="slider-one__title">
                One of <br>
                The Seven Wonders<br>
                of The World.
              </h2>
              <p class="slider-one__text text-uppercase">Visit Us</p>
              <div class="content">
                <a href="http://localhost/imentet-1/Pyramids/pyramids/index.php" target="_blank" class="thm-btn slider-one__btn">Find Out More</a>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
    <div class="side-menu__block">
      <div class="side-menu__block-overlay custom-cursor__overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
      </div>
      <div class="side-menu__block-inner">
        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php">
          <img src="images/resources/dark-logo-imentet.png" alt="Awesome Image" />
        </a>
        <div class="side-menu__block-about">
          <h3 class="side-menu__block__title">About Us</h3>
          <p class="side-menu__block-about__text">
            Imentet, She was the ancient Egyptian goddess of the West 
            and thus the protector of the necropolises west of the Nile.
          </p>
          <a href="" class="thm-btn side-menu__block-about__btn">
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
          <a href="./AboutImentet">Imentet</a>
            <i class="fa fa-copyright"></i> <?php echo date('Y') ?> All Right
          Reserved
        </p>
      </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/isotope.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/TweenMax.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/nouislider.js"></script>
    <script src="js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="js/theme.js"></script>
  </body>
</html>
