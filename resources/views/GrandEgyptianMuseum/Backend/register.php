<?php
include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";
ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Sign Up";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    if(isset($_POST['submit'])){

        $Name = mysqli_real_escape_string($con, $_POST['Name']);
        $Email = mysqli_real_escape_string($con, $_POST['Email']);
        $Password = mysqli_real_escape_string($con,  $_POST['Password']);
        $hashedPassword = password_hash($Password , PASSWORD_DEFAULT);

    
        $Select = " SELECT * FROM user WHERE Email = '$Email'  ";
    
        $Result = mysqli_query($con, $Select);
    
        if(mysqli_num_rows($Result) > 0){
        
            $error[] = 'User Already Exist!';
        
        }else{
          $FormErrors = array();

          if(empty($Name)){
            $FormErrors[] = "Must Type Name";
          }
          if(empty($Email)){
            $FormErrors[] = "Must Type Email";
          }
          if(empty($Password)){
            $FormErrors[] = "Must Type Password";
          }
          if(strlen($Password) < 8){
            $FormErrors[] = "Strength Your Password";
          }
          if(strlen($Name) < 3){
            $FormErrors[] = "Type Your Full Name";
          }

          $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";  
          if (!preg_match ($pattern, $Email) ){  
            $FormErrors[] = "Email is not valid";  
          }
              if(empty($FormErrors)){

                $SplitedName = split_name($Name);
                $FirstName = $SplitedName[0];
                $LastName = $SplitedName[1];
                if (!preg_match ("/^[a-zA-z]*$/", $FirstName) ) {  
                  $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                }
                if (!preg_match ("/^[a-zA-z]*$/", $LastName) ) {  
                  $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                } 
                $Insert = "INSERT INTO user(Name, LastName , Email, Password) VALUES('$FirstName' , '$LastName' , '$Email' , '$hashedPassword')";
                $RunQuery = mysqli_query($con, $Insert);
                
                $Image = "avatar.png";

                $InsertImgQuery = "INSERT INTO `userimages` Values( Null , '". mysqli_insert_id($con) . "' , '$Image' )";
                $Insert = mysqli_query($con, $InsertImgQuery);

                if($RunQuery && $Insert){
                  $SelectUser = "SELECT * FROM user WHERE Email = '$Email' LIMIT 1";
                  $Select = mysqli_query($con , $SelectUser);
                  $count = mysqli_num_rows($Select);
                  $UserRow = mysqli_fetch_assoc($Select);
                    if($count > 0){
                    $_SESSION['UserID'] = $UserRow['ID'];     //Register Sesstion ID
                    $_SESSION['UserPassword'] = $_POST['Password'];     //Register Sesstion Password
    
                    header('location:http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php');
                  }
                }
                

              }
        }
    
    }
}

if(isset($_SESSION['UserID'])){
  header('Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php');
}elseif(isset($_SESSION['AdminID'])){
  header('Location: ./Dashboard.php');
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
    <!-- Captcha -->
    <script src="https://hcaptcha.com/1/api.js" async defer></script>
    <!-- Captcha -->
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
      
      <header class="site-header site-header__header-one">
        <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky" >
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
                  <ul class="submenu">
                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php">Our Story </a></li>
                  </ul>
                </li>
                <li>
                  <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php" class="thm-btn topbar-one__btn">
                    Sign In
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

      <section class="auth">
        <div class="container">
          <div class="row">
            <div class="wrapper">
              <div class="col-md-6 box details">
                <h1>Join our group in few minutes! <br /></h1>
                <p>Sign up with your details to get started</p>
              </div>
              <div class="col-md-5 offset-md-1 box">
                <div class="form">
                  <div class="content">
                    <h3 class="login-form__title">Create an Account</h3>

                    <p>
                      Already have an account? <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php">Sign In</a>
                    </p>
                  </div>
                  <!-- Error Display -->
                  <?php
                    if(isset($FormErrors)){
                      foreach($FormErrors as $Error){ ?>
                        <div class="alert alert-danger" role="alert" style="text-align: center;">
                          <i class="fa fa-times fa-lg"></i>
                            <?php echo $Error; ?>
                        </div>
                      <?php  }
                    }
                  ?> 
                  <form method='POST'>
                    <div class="inputs login-form__form">
                      <div class="login-form__field">
                        <input type="text" name="Name" placeholder="Username" required/>
                        <i class="fa fa-user"></i>
                      </div>
                      <div class="login-form__field">
                        <input type="email" name="Email" placeholder="Email Address" required />
                          <i class="fa fa-envelope-o"></i>
                      </div>
                      <div class="login-form__field password-input">
                        <input type="password" name="Password" placeholder="Enter Password" required/>
                        <i class="fa fa-eye toggler"></i>
                      </div>
                      <button type="submit" name='submit' class="thm-btn contact-one__btn">
                        Create Account
                      </button>
                    </div>
                  </form>
                </div>
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
            Grand Egyptian Museum is the world's leading museum of history & culture, housing a
            permanent collection of over 2.3 million objects that span over 5,000
            which is toil and pain these cases are perfectly. 
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
          <a href="#">Imentet</a>
            <i class="fa fa-copyright"></i> <?php echo date('Y') ?> All Right
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
          <input type="text" name="search" placeholder="Type here to Search...." />
          <button type="submit"><i class="egypt-icon-search"></i></button>
        </form>
      </div>
    </div>

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
      <i class="egypt-icon-arrow-2"></i>
    </a>

    <script src="JS/jquery.min.js"></script>
    <script src="JS/bootstrap.bundle.min.js"></script>
    <script src="JS/bootstrap-datepicker.min.js"></script>
    <script src="JS/bootstrap-select.min.js"></script>
    <script src="JS/isotope.js"></script>
    <script src="JS/jquery.counterup.min.js"></script>
    <script src="JS/jquery.magnific-popup.min.js"></script>
    <script src="JS/jquery.validate.min.js"></script>
    <script src="JS/owl.carousel.min.js"></script>
    <script src="JS/TweenMax.min.js"></script>
    <script src="JS/waypoints.min.js"></script>
    <script src="JS/wow.min.js"></script>
    <script src="JS/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="JS/nouislider.js"></script>
    <script src="JS/jquery.bootstrap-touchspin.min.js"></script>
    <script src="JS/theme.js"></script>
  </body>
</html>
