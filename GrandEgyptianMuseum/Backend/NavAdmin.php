<?php
// include "./DatabaseConnection/Connection.php";

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
    <link rel="stylesheet"  href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="css/jquery.bootstrap-touchspin.min.css" />
    <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="./css/style.css?v=4" />
    <link rel="stylesheet" href="Style///main.css">
    <link rel="stylesheet" href="Style///framework.css">
    <link rel="stylesheet" href="css/responsive.css" />

    <title><?php if(isset($PageTitle)){echo $PageTitle ; }else{ echo "Defult";} ?></title>
</head>
<?php 
    // if (isset($_SESSION["AdminID"])) {
        $AdminID = $_SESSION['AdminID'];
        $SelectQuery = "SELECT admin .* , adminrole.Role AS RoleName , adminimage.Image AS Image FROM admin
                        LEFT JOIN adminrole ON admin.AdminRole = adminrole.ID 
                        LEFT JOIN adminimage ON admin.ID = adminimage.AdminID
                        WHERE admin.ID = $AdminID";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);
        $AdminRole =$row['AdminRole'] ;
        ?>
        
        <body>                  
                <header class="site-header site-header__header-one">
                    <nav class="navbar navbar-expand-lg navbar-light header-navigation stricky">
                        <div class="container clearfix">
                            <div class="logo-box">
                                <a class="navbar-brand" href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Dashboard.php">
                                    <img src="images/resources/imentet-logo.svg" class="main-logo" alt="Awesome Image" />
                                </a>
                                <button class="menu-toggler" data-target=".main-navigation">
                                    <span class="fa fa-bars"></span>
                                </button>
                            </div>
                            <div class="main-navigation">
                                <ul class="navigation-box @@extra_class">

                                    <!-- Home Part -->
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Dashboard.php">Dashboard</a>
                                    </li>

                                    <!-- Users Part -->
                                    <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Users.php?action=Manage">Users</a>
                                        <ul class="submenu">
                                            <li>
                                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Users.php?action=CheckAllMembership">Membership Plans</a>
                                            </li>
                                            <?php if($row['AdminRole'] == 1 || $row['AdminRole'] == 2){ ?>
                                                <li>
                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Users.php?action=Subscribers">Membership Subscribers</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($row['AdminRole'] == 4 || $row['AdminRole'] == 1) { ?>
                                                <li>
                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Q&A.php?action=Manage">Messages</a>
                                                </li>
                                            <?php } ?>
                                        </ul>
                                    </li>

                                    <!-- Settings part -->
                                    <?php if($row['AdminRole'] == 1 || $row['AdminRole'] == 2){ ?>
                                        <li>
                                            <a href="">Settings</a>
                                            <ul class="submenu">
                                                <?php if ($row['AdminRole'] == 1) { ?>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Admins.php?action=Manage">Admin</a>
                                                        <ul class="submenu right-align">
                                                            <li>
                                                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Admins.php?action=Manage">Admins</a>
                                                            </li>
                                                            <li>
                                                                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Admins.php?action=Status">Admin Status </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                <?php } ?>
                                                <?php if($row['AdminRole'] == 1 || $row['AdminRole'] == 2){ ?>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Careers.php?action=Manage">Applications</a>
                                                    </li>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Pricing.php?action=Manage">Pricing System</a>
                                                    </li>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Sponsorship.php?action=Manage">Sponsorships</a>
                                                    </li>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Donatiton.php?action=Manage">Donations</a>
                                                    </li>
                                                <?php } ?> 
                                            </ul>
                                        </li>
                                    <?php } ?>

                                    <!-- Events Part  -->
                                    <li>
                                        <a href="#">What's On</a>
                                        <ul class="submenu">
                                            <?php if ($row['AdminRole'] != 4) { ?>
                                                <li>
                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Entertainments.php?action=Manage">Events </a>
                                                    <ul class="submenu">
                                                        <?php 
                                                            $SelectEvent = "SELECT * FROM entertainmnet ORDER BY ID DESC LIMIT 4 ";
                                                            $SpecificEvent = mysqli_query($con , $SelectEvent);
                                                            $SpecificRow = mysqli_fetch_assoc($SpecificEvent); 
                                                            foreach ($SpecificEvent as $RowEvent){ ?>
                                                                <li>
                                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Entertainments.php?action=MoreInfo&EventID=<?php echo $RowEvent['ID'] ?>"><?php echo $RowEvent['Name'] ?> </a>
                                                                </li>
                                                            <?php } ?>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Collections.php?action=Manage">Collections</a>
                                                </li>
                                            <?php } ?>
                                            <?php if ($row['AdminRole'] == 4 || $row['AdminRole'] == 1) { ?>
                                                <li>
                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Feedback.php?action=Manage">Feedback</a>
                                                </li>
                                            <?php } ?> 
                                        </ul>
                                    </li>
                                    <!-- GiftShop -->
                                    <?php if ($row['AdminRole'] != 4) { ?>
                                        <li>
                                            <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/GiftShop.php?action=Manage">GiftShop</a>
                                            <ul class="submenu">
                                                <?php if($row['AdminRole'] == 1 || $row['AdminRole'] == 2){ ?>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/GiftShop.php?action=ItemsSold">Items Sold</a>
                                                    </li>
                                                <?php } ?>
                                                <li>
                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/GiftShop.php?action=CheckAll">All Products</a>
                                                </li>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                    
                                    <!-- Tickets -->
                                    <?php if ($row['AdminRole'] != 4) { ?>
                                        <li>
                                            <a href="#">Tickets</a>
                                            <ul class="submenu">
                                                <?php if ($row['AdminRole'] != 4) { ?>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Tickets.php?action=Visit">Visit Tickets </a>
                                                    </li>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Tickets.php?action=Entertainment">Entertainments Tickets </a>
                                                    </li>
                                                <?php } ?>
                                                <?php if($row['AdminRole'] == 1 || $row['AdminRole'] == 2){ ?>
                                                    <li>
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Transportation.php?action=Manage">Transportation</a>
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </div>

                            <div class="right-side-box">
                                <ul class="topbar-one__right list-unstyled">
                                    <span class="top-wrapper">
                                        <li>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Profile.php?action=Manage&AdminID=<?php echo $AdminID ?>" class="user-icon topbar-one__search">
                                            <img src="images/AdminImages/<?php echo $row['Image'] ?>" width="30px" height="30px" alt="" />
                                        </a>
                                        <ul class="submenu">
                                            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Profile.php?action=Edit&AdminID=<?php echo $AdminID ?>">Edit Profile </a></li>
                                            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/logout.php">Log out</a></li>
                                        </ul>
                                        </li>
                                    </span>
                                </ul>
                                <a href="#" class="site-header__sidemenu-nav side-menu__toggler">
                                    <span class="site-header__sidemenu-nav-line"></span>
                                    <span class="site-header__sidemenu-nav-line"></span>
                                    <span class="site-header__sidemenu-nav-line"></span>
                                </a>
                            </div>
                        </div>
                    </nav>
                </header>
    <?php //} ?>

    
    