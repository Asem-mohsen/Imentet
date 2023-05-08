<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();
$PageTitle = "About";

if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];
  $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
  $Select = mysqli_query($con, $SelectQuery);
  $row = mysqli_fetch_assoc($Select);
}
if(isset($_SESSION['AdminID'])){
  $AdminID = $_SESSION['AdminID'];

}
?>

    <?php include "../NavUser.php" ;?>
      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title">About Our Museum</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php">Home</a></li>
            <li>The Museum</li>
          </ul>
        </div>
      </section>

      <!-- About Our Time -->
      <section class="about-three">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">About Us</p>
            <h2 class="block-title__title">
              World's Largest <br />
              Archaeological Museum Complex <br />
              With 10,000 Artifacts
            </h2>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="about-three__content">
                <h3 class="about-three__content-title">Established in 1969</h3>
                <p class="about-three__content-text">
                  Egypt is the world's leading museum of history & culture,
                  housing a <br />
                  permanent collection of over 2.3 million objects that span
                  over 5,000 <br />
                  which is toil and pain these cases are perfectly.
                </p>
                <a href="#" class="about-three__content-link">
                  <i class="egypt-icon-download"></i>
                  <span>Download Story in PDF</span>
                </a>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="about-three__tab">
                <ul class="list-unstyled nav nav-tabs about-three__tab-list" role="tablist">
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-1" role="tab" class="nav-link active"> 2002</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-2" role="tab" class="nav-link">2003</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-3" role="tab" class="nav-link">2011</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-4" role="tab" class="nav-link">2014</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane animated fadeInUp show active" id="year-1">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        In January of 2002, the Egyptian government announced a
                        worldwide competition for the design of a new museum
                        complex to house, display, and preserve some of the
                        world's greatest ancient treasures with which the modern
                        country of Egypt has the privilege of being entrusted.
                      </p>
                      <a href="#" class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-2">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        In 2003, the winner of the architectural design
                        competition was announced at a press conference in
                        Cairo, with the Irish firm Heneghan Peng Architects
                        securing the contract to turn their ultra-modern concept
                        into the new Grand Egyptian Museum.
                      </p>
                      <a href="#" class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-3">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        As the outbreak of the Arab Spring reached Egypt in
                        early 2011, work on the project ground to a halt as the
                        country experienced several years of unfortunate
                        political instability and uncertainty. <br />
                        Tourism to Egypt also dwindled during these years,
                        drying up the government's coffers and jeopardizing the
                        grand new museum's future.
                      </p>
                      <a href="#" class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-4">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        But following the restabilization of the government in
                        2014 and the preservation of that stability ever since,
                        the project soon got back on track and construction
                        resumed with the help of international loans to cover
                        the financial shortfalls caused by the lingering effects
                        of the tourism downturn.
                      </p>
                      <a href="#" class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Museum Departments -->
      <section class="department-one">
        <div class="department-one__top">
          <div class="container">
            <div class="block-title text-center">
              <p class="block-title__tag-line">Departments</p>
              <h2 class="block-title__title">Departments of The Museum</h2>
            </div>
          </div>
        </div>
        <div class="department-one__bottom">
          <div class="container">
            <div class="inner-container wow fadeInRight" data-wow-duration="1500ms">
              <div class="row">
                <div class="col-lg-4">
                  <ul class="department-one__list list-unstyled">
                    <li>
                      <a href="#">
                        Department of <br />
                        Sculpture Collection
                      </a>
                    </li>
                    <li>
                      <a href="#"
                        >Department of Vases, Metalwork & <br />
                        Minor Arts Collections</a
                      >
                    </li>
                    <li>
                      <a href="#"
                        >Department of Prehistoric, Egyptian, <br />
                        Cypriot and Antiquities
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-lg-4">
                  <ul class="department-one__list list-unstyled">
                    <li>
                      <a href="#"
                        >Department of Exhibitions, <br />
                        Communication and Education</a
                      >
                    </li>
                    <li>
                      <a href="#"
                        >Department of Technical Support <br />
                        and Museography</a
                      >
                    </li>
                    <li>
                      <a href="#"
                        >Department of Administrative and <br />
                        Financial Support</a
                      >
                    </li>
                  </ul>
                </div>
                <div class="col-lg-4">
                  <div class="department-one__carrer">
                    <div class="department-one__carrer-inner">
                      <i class="egypt-icon-career"></i>
                      <h3 class="department-one__carrer-title">
                        Find Your Career
                      </h3>
                      <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Careers.php" class="department-one__carrer-link"
                        >Job Oppurtunities <span>+</span></a
                      >
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Video -->
      <section class="video-two">
        <div class="container">
          <div class="inner-container wow fadeInUp" data-wow-duration="1500ms">
            <a
              href="https://www.youtube.com/watch?v=hO1tzmi1V5g"
              class="video-popup video-two__btn"
              ><i class="egypt-icon-circular"></i
            ></a>
            <h3 class="video-two__title">
              Great Art and Great Art Experiences
            </h3>
            <p class="video-two__tag-line">Since 1969</p>
          </div>
        </div>
      </section>

      <!-- Directors -->
      <section class="team-one">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">Behind Our Museum</p>
            <h2 class="block-title__title">Board of Directors</h2>
          </div>
          <div class="row">
            <div class="col-lg-3 col-md-6">
              <div class="team-one__single wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                <div class="team-one__image">
                  <img src="images/team/team-1-1.jpg" alt="Awesome Image" />
                </div>
                <div class="team-one__content">
                  <h3 class="team-one__name">Shirleen Morace</h3>
                  <p class="team-one__designation">Chairman</p>
                  <div class="team-one__social">
                    <p class="team-one__social-text text-uppercase">
                      <i class="egypt-icon-share"></i>Get Touch With Me
                    </p>
                    <div class="team-one__social-links">
                      <a href="#" class="fa fa-facebook-f"></a>
                      <a href="#" class="fa fa-twitter"></a>
                      <a href="#" class="fa fa-linkedin"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div
                class="team-one__single wow fadeInUp"
                data-wow-duration="1500ms"
                data-wow-delay="100ms"
              >
                <div class="team-one__image">
                  <img src="images/team/team-1-2.jpg" alt="Awesome Image" />
                </div>
                <div class="team-one__content">
                  <h3 class="team-one__name">Bernie Beane</h3>
                  <p class="team-one__designation">Curator</p>
                  <div class="team-one__social">
                    <p class="team-one__social-text text-uppercase">
                      <i class="egypt-icon-share"></i>Get Touch With Me
                    </p>
                    <div class="team-one__social-links">
                      <a href="#" class="fa fa-facebook-f"></a>
                      <a href="#" class="fa fa-twitter"></a>
                      <a href="#" class="fa fa-linkedin"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="team-one__single wow fadeInUp"  data-wow-duration="1500ms" data-wow-delay="200ms">
                <div class="team-one__image">
                  <img src="images/team/team-1-3.jpg" alt="Awesome Image" />
                </div>
                <div class="team-one__content">
                  <h3 class="team-one__name">Joshua Mishaw</h3>
                  <p class="team-one__designation">VP & Counsel</p>
                  <div class="team-one__social">
                    <p class="team-one__social-text text-uppercase">
                      <i class="egypt-icon-share"></i>Get Touch With Me
                    </p>
                    <div class="team-one__social-links">
                      <a href="#" class="fa fa-facebook-f"></a>
                      <a href="#" class="fa fa-twitter"></a>
                      <a href="#" class="fa fa-linkedin"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6">
              <div class="team-one__single wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
                <div class="team-one__image">
                  <img src="images/team/team-1-4.jpg" alt="Awesome Image" />
                </div>
                <div class="team-one__content">
                  <h3 class="team-one__name">Glinda Nishikawa</h3>
                  <p class="team-one__designation">Administrator</p>
                  <div class="team-one__social">
                    <p class="team-one__social-text text-uppercase">
                      <i class="egypt-icon-share"></i>Get Touch With Me
                    </p>
                    <div class="team-one__social-links">
                      <a href="#" class="fa fa-facebook-f"></a>
                      <a href="#" class="fa fa-twitter"></a>
                      <a href="#" class="fa fa-linkedin"></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

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
      </div>
      <!-- /.search-popup__overlay -->
      <div class="search-popup__inner">
        <form action="#" class="search-popup__form">
          <input
            type="text"
            name="search"
            placeholder="Type here to Search...."
          />
          <button type="submit"><i class="egypt-icon-search"></i></button>
        </form>
      </div>
    </div>
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"
      ><i class="egypt-icon-arrow-2"></i
    ></a>
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
