<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Contact Us";

if(isset($_SESSION['UserID'])){
    $UserID = $_SESSION['UserID'];
    $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
}
if(isset($_POST['Send']) && !isset($_SESSION['AdminID'])){
    $UsersQuestion = $_POST['UsersQuestion'];

    if(empty($Email)){
        $Email = $row['Email'];

    }else{
        $Email = $_POST['Email'];

    }
    $InsertMessage = "INSERT INTO `q&a` (Email , UsersQuestion) VALUES( '$Email' ,'$UsersQuestion') ";
    $InsertQuery = mysqli_query($con , $InsertMessage);

    if($InsertQuery){
        echo "<div class='alert alert-success'>";
            echo "Inserted Successfuly";
        echo "</div>";
    }
}elseif(isset($_POST['Send']) && isset($_SESSION['AdminID'])){
    echo "<div class='alert alert-danger'>";
        echo "You are Admin Why do you Need That !!";
    echo "</div>";
}

?>
        <?php include "../NavUser.php" ; ?>

        <section class="inner-banner">
            <div class="container">
                <h2 class="inner-banner__title">Contact Us</h2>
                <p class="inner-banner__text">We're always here to help you with anything you might need.</p><!-- /.inner-banner__text -->
                <ul class="list-unstyled thm-breadcrumb">
                    <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Home</a></li>
                    <li><a href="about.php">The Museum</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </section>

        <section class="contact-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-one__main">
                            <div class="contact-one__image">
                                <img src="images/resources/contact-1-1.jpeg" class="img-fluid" alt="" />
                            </div>
                            <div class="contact-one__content">
                                <div class="row no-gutters">
                                    <div class="col-lg-6">
                                        <h3 class="contact-one__title">Egypt</h3>
                                        <p class="contact-one__text">Alexandria Desert Rd, Haram, Giza Governorate X4VF+V3F</p><!-- /.contact-one__text -->
                                        <p class="contact-one__text"><a href="tel:321-888-789-0123">TEL: +20-23-531-7344</a></p><!-- /.contact-one__text -->
                                        <p class="contact-one__text"><a href="mailto:egyptmuseum@example.com">E-mail: gem@example.com</a></p><!-- /.contact-one__text -->
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="contact-one__list list-unstyled">
                                            <li><span class="contact-one__list-name">Sa & Su <span class="contact-one__list-colon">:</span></span>10am to 10.00pm</li>
                                            <li><span class="contact-one__list-name">Mo & Tu <span class="contact-one__list-colon">:</span></span>10am to 10.00pm</li>
                                            <li><span class="contact-one__list-name">We & Th <span class="contact-one__list-colon">:</span></span>10am to 10.00pm</li>
                                            <li><span class="contact-one__list-name">FR <span class="contact-one__list-colon">:</span></span>Closed</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form method="POST" class="contact-one__form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="contact-one__field">
                                    <input type="hidden" name="UserID" value="<?php echo $User['ID'] ?>">
                                        <label>First Name:</label>
                                        <input type="text" name="FirstName"  value="<?php if(isset($row['Name'])){ echo $row['Name']; } ?>" <?php if(isset($row['Name'])){ echo "disabled" ;} ?>  >
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="contact-one__field">
                                        <label>Last Name:</label>
                                        <input type="text" name="LastName"  value="<?php if(isset($row['LastName'])){ echo $row['LastName']; } ?>" <?php if(isset($row['LastName'])){ echo "disabled" ;} ?> >
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="contact-one__field">
                                        <label>Email:</label>
                                        <input type="email" name="Email" value="<?php if(isset($row['Email'])){ echo $row['Email']; } ?>" <?php if(isset($row['Email'])){ echo "disabled" ;} ?> required>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="contact-one__field">
                                        <label>Phone:</label>
                                        <input type="text" name="phone" value="<?php if(isset($row['Phone'])){ echo $row['Phone']; } ?>" <?php if(isset($row['Phone'])){ echo "disabled" ;} ?> >
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <p class="contact-one__field">
                                        <label>Subject:</label>
                                        <input type="text" name="subject" required>
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <p class="contact-one__field">
                                        <label>Message:</label>
                                        <textarea name="UsersQuestion" required></textarea>
                                        <button type="submit" name='Send' class="thm-btn contact-one__btn">Send Message</button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="contact-map-one" id="map">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13821.875835399496!2d31.122688!3d29.994688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584534984a8ad1%3A0x45764c5bc4ec261a!2sGrand%20Egyptian%20Museum!5e0!3m2!1sen!2seg!4v1681483362521!5m2!1sen!2seg" class="google-map__home" allowfullscreen></iframe>
            </div>
        </div>
        
        <br>
        <br>
        
        <footer class="site-footer">
            <div class="container">
            <a class="site-footer__logo" href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">
                <img src="images/resources/footer-logo-imentet-gem.png" alt=""/>
            </a>
            <form action="#" class="site-footer__form">
                <div class="site-footer__form-icon">
                <i class="egypt-icon-email"></i>
                </div>
                <input type="text" placeholder="Enter Email Address..." />
                <button type="submit">
                <i class="egypt-icon-right-arrow1"></i>
                </button>
            </form>
            <div class="site-footer__social">
                <a href="#"><i class="egypt-icon-logo"></i></a>
                <a href="#"><i class="egypt-icon-twitter"></i></a>
                <a href="#"><i class="egypt-icon-instagram"></i></a>
                <a href="#"><i class="egypt-icon-play"></i></a>
            </div>
            <p class="site-footer__copy">
                Copyrights &copy; 2023 <a href="#">Egypt</a>, All Rights Reserved.
            </p>
            </div>
        </footer>
    </div>

    <div class="side-menu__block">
        <div class="side-menu__block-overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower">

            </div>
        </div>
        <div class="side-menu__block-inner ">
            <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php">
                <img src="images/resources/dark-logo.png" alt="Awesome Image" />
            </a>
            <div class="side-menu__block-about">
                <h3 class="side-menu__block__title">About Us</h3>
                <p class="side-menu__block-about__text">
                    Grand Egyptian Museum is the world's leading museum of history & culture, housing a
                    permanent collection of over 2.3 million objects that span over 5,000
                    which is toil and pain these cases are perfectly.
                </p>
                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php" class="thm-btn side-menu__block-about__btn">Get Consultation</a>
            </div>
            <hr class="side-menu__block-line" />
            <div class="side-menu__block-contact">
                <h3 class="side-menu__block__title">Contact Us</h3>
                <ul class="side-menu__block-contact__list">
                    <li class="side-menu__block-contact__list-item">
                        <i class="fa fa-map-marker"></i>
                        Rock St 12, Cairo, EGY
                    </li>
                    <li class="side-menu__block-contact__list-item">
                        <i class="fa fa-phone"></i>
                        <a href="tel:526-236-895-4732">(526) 236-895-4732</a>
                    </li>
                    <li class="side-menu__block-contact__list-item">
                        <i class="fa fa-envelope"></i>
                        <a href="mailto:example@mail.com">example@mail.com</a>
                    </li>
                    <li class="side-menu__block-contact__list-item">
                        <i class="fa fa-clock-o"></i>
                        Week Days: 09.00 to 18.00 Sunday: Closed
                    </li>
                </ul>
            </div>
            <p class="side-menu__block__text site-footer__copy-text"><a href="#">Egypt</a> <i class="fa fa-copyright"></i> 2023 All Right Reserved</p>
        </div>
    </div>

    <div class="search-popup">
        <div class="search-popup__overlay custom-cursor__overlay">
            <div class="cursor"></div>
            <div class="cursor-follower"></div>
        </div><!-- /.search-popup__overlay -->
        <div class="search-popup__inner">
            <form action="#" class="search-popup__form">
                <input type="text" name="search" placeholder="Type here to Search....">
                <button type="submit"><i class="egypt-icon-search"></i></button>
            </form>
        </div><!-- /.search-popup__inner -->
    </div>
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
        <i class="egypt-icon-arrow-2"></i>
    </a>

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