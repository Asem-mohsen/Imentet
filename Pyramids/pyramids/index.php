<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Pyramids";
?>
  <?php include "./NavUserPyramids.php"; ?>

      <!-- Slider Section -->
      <section class="slider-two">
        <div class="slider-one__carousel owl-carousel owl-theme">
          <div class="item slider-two__slider-1"  style="background-image: url(images/new/slider/slider-1-1.png); background-blend-mode: overlay;">
            <div class="container text-left">
              <p class="slider-two__tag-line">The Pyramids of Egypt:</p>
              <h2 class="slider-two__title">A Wonder of the World</h2>
              <p class="slider-two__text">
                The Pyramids of Egypt, built over 4,500 years ago, <br />
                are iconic and enigmatic structures that captivate people worldwide.
              </p>
              <a href="./AboutUs.php" class="thm-btn slider-two__btn">Find Out More</a>
            </div>
          </div>
          <div class="item slider-two__slider-2" style="background-image: url(images/new/slider/slider-2-2.png); background-blend-mode: overlay;" >
            <div class="container text-center">
              <p class="slider-two__tag-line">The Enigmatic Legacy of</p>
              <h2 class="slider-two__title">The Ancient World</h2>
              <p class="slider-two__text">
                Visiting the Pyramids of Egypt is an opportunity to unravel the mysteries of  <br />
                the ancient world and discover the secrets of the pharaohs.
              </p>
              <a href="./VisitTickets.php" class="thm-btn slider-two__btn">Visit Now</a>
            </div>
          </div>
          <div class="item slider-two__slider-3" style="background-image: url(images/new/slider/slider-2-3.png); background-blend-mode: overlay;" >
            <div class="container text-left">
              <div class="row justify-content-end">
                <div class="col-xl-7 col-lg-9">
                  <p class="slider-two__tag-line">Rock the Pyramids:</p>
                  <h2 class="slider-two__title" >Endless Adventure</h2>
                  <p class="slider-two__text">
                    Join us on this unforgettable adventure and discover the magic of the Pyramids of Egypt. Book your tickets now and experience the wonder for yourself!
                  </p>
                  <a href="./PlanVisit.php" class="thm-btn slider-two__btn">Find Out More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="slider-two__nav">
          <a class="slider-two__nav-left slide-one__left-btn" href="#">
            <i class="egypt-icon-right-angle"></i>
          </a>
          <a class="slider-two__nav-right slide-one__right-btn" href="#">
            <i class="egypt-icon-left-angle"></i>
          </a>
        </div>
      </section>

      <!-- About Us -->
      <section class="about-one">
        <div class="container">
          <div class="inner-container wow fadeInUp" data-wow-duration="1500ms">
            <div class="row">
              <div class="col-lg-7">
                <div class="about-one__content">
                  <div class="block-title">
                    <p class="block-title__tag-line">About Us</p>
                    <h2 class="block-title__sub-title">
                      Built around  <br />
                      2500-2600 BCE
                    </h2>
                  </div>
                  <p class="about-one__text">
                    <a style="color: #d99578;" href="./AboutUs.php">The Pyramids of Egypt </a> are an enigmatic wonder that have fascinated people for centuries. 
                    These ancient structures were built over 4,500 years ago and still stand tall today, 
                    a testament to the ingenuity and skill of the ancient Egyptians.
                  </p>
                  <p class="about-one__text">
                    Each pyramid was built as a tomb for a pharaoh and their consorts, with the largest and most famous being the Great Pyramid of Giza. 
                    This incredible feat of engineering is the oldest of the Seven Wonders of the Ancient World and continues to amaze visitors from all over the globe.
                  </p>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="about-one__feature">
                  <div class="about-one__feature-single">
                    <div class="about-one__feature-icon">
                      <i class="egypt-icon-place"></i>
                    </div>
                    <div class="about-one__feature-content">
                      <h3 class="about-one__feature-title">Pyramids Of Giza</h3>
                      <p class="about-one__feature-text">
                        Al Haram, Nazlet El-Semman <br />
                        Al Giza Desert, Giza Governorate 3512201 
                      </p>
                      <a href="https://www.google.com.eg/maps/place/Giza+Necropolis/@29.9773008,31.1299206,17z/data=!3m1!4b1!4m6!3m5!1s0x14584f7de239bbcd:0xca7474355a6e368b!8m2!3d29.9772962!4d31.1324955!16s%2Fm%2F07s6gb8?entry=ttu" target="_blank" class="about-one__feature-link">
                        Get Direction <span>+</span>
                      </a>
                    </div>
                  </div>
                  <div class="about-one__feature-single">
                    <div class="about-one__feature-icon">
                      <i class="egypt-icon-ticket"></i>
                    </div>
                    <div class="about-one__feature-content">
                      <h3 class="about-one__feature-title">Membership Benefits</h3>
                      <p class="about-one__feature-text">
                        Enjoy our Benefits for our <br />
                        Pyramids and GEM Members.
                      </p>
                      <a href="./Membership.php" class="about-one__feature-link">
                        Become a Member <span>+</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Activites -->
      <section class="collection-one">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">Activites</p>
            <h2 class="block-title__title">At The Pyramids</h2>
          </div>
          <div class="row">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
              <div class="collection-one__single">
                <div class="collection-one__icon">
                  <div class="collection-one__icon-img">
                    <img src="images/icons/collection-icon-1-1.png" alt="" />
                  </div>
                </div>
                <div class="collection-one__content">
                  <h3 class="collection-one__title">
                    <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=74">Khufu Pyramid</a>
                  </h3>
                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=74" class="collection-one__link">Explore The Activity</a>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
              <div class="collection-one__single">
                <div class="collection-one__icon">
                  <div class="collection-one__icon-img">
                    <img src="images/icons/collection-icon-1-2.png" alt="" />
                  </div>
                </div>
                <div class="collection-one__content">
                  <h3 class="collection-one__title">
                    <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=41">Horse Riding</a>
                  </h3>
                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=41" class="collection-one__link">
                    Explore The Activity
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
              <div class="collection-one__single">
                <div class="collection-one__icon">
                  <div class="collection-one__icon-img">
                    <img src="images/icons/collection-icon-1-3.png" alt="" />
                  </div>
                </div>
                <div class="collection-one__content">
                  <h3 class="collection-one__title">
                    <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=71">Sound And Light</a>
                  </h3>
                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=71" class="collection-one__link">
                    Explore The Activity
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
              <div class="collection-one__single">
                <div class="collection-one__icon">
                  <div class="collection-one__icon-img">
                    <img src="images/icons/collection-icon-1-4.png" alt="" />
                  </div>
                </div>
                <div class="collection-one__content">
                  <h3 class="collection-one__title">
                    <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=26">Sky Diving</a>
                  </h3>
                  <a  href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=26" class="collection-one__link">
                    Explore The Activity
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="400ms">
              <div class="collection-one__single">
                <div class="collection-one__icon">
                  <div class="collection-one__icon-img">
                    <img src="images/icons/collection-icon-1-5.png" alt="" />
                  </div>
                </div>
                <div class="collection-one__content">
                  <h3 class="collection-one__title">
                    <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=75">Khafre Pyramid</a>
                  </h3>
                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=75" class="collection-one__link">
                    Explore The Activity
                  </a>
                </div>
              </div>
            </div>
            <div  class="col-xl-4 col-lg-6 col-md-6 col-sm-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="500ms">
              <div class="collection-one__single">
                <div class="collection-one__icon">
                  <div class="collection-one__icon-img">
                    <img src="images/icons/collection-icon-1-6.png" alt="" />
                  </div>
                </div>
                <div class="collection-one__content">
                  <h3 class="collection-one__title">
                    <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=44">Air Ballon</a>
                  </h3>
                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=44" class="collection-one__link">
                    Explore The Activity
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <a href="./Events.php?Page=1" class="thm-btn collection-one__more-btn">Explore Now</a>
          </div>
        </div>
      </section>

      <!-- Events -->
      <section class="event-one">
        <div class="container">
          <div class="event-one__top">
            <div class="block-title text-left">
              <p class="block-title__tag-line">Events</p>
              <h2 class="block-title__title">Exhibition & Events</h2>
            </div>

            <div class="event-one__more-links-wrap">
              <a href="./Events.php?Page=1" class="event-one__more-links">
                <i class="fa fa-angle-right"></i>
                View More Events 
              </a>
            </div>
          </div>

          <?php
          $TodaysDate = date('Y-m-d');
            $SelectEvents= "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName ,place.Name AS PlaceName  FROM entertainmnet 
                            LEFT JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                            LEFT JOIN place ON place.ID = entertainmnet.PlaceID 
                            WHERE PlaceID = 1 AND entertainmnet.ID NOT IN (26 , 41 , 44 , 71 , 74 ,75 ) AND entertainmnet.Date > '$TodaysDate'
                            ORDER BY ID DESC LIMIT 3";
            $Query = mysqli_query($con , $SelectEvents);
            $EventsRow = mysqli_fetch_assoc($Query);
            foreach($Query as $Events){
              $Date = $Events['Date'] ;
              $StartDate = date('M-d-Y' , strtotime($Date));
              list($Month, $Day, $Year)=explode('-', $StartDate); 
              ?>
              <div class="event-one__single wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="0ms">
                <div class="row">
                  <div class="col-xl-6">
                    <div class="event-one__content">
                      <div class="event-one__image">
                        <div class="event-one__image-inner">
                          <img src="images/<?php echo $Events['Image'] ?>" width="100px" height="100px" alt="" />
                        </div>
                        <div class="event-one__image-hover"><?php echo $Events['EgyptianPrice'] . " EGP" ?></div>
                      </div>
                      <div class="event-one__text">
                        <div class="event-one__content-top">
                          <div class="event-one__date">
                            <div class="event-one__date-num"><?php echo $Day ?></div>
                            <div class="event-one__date-text">
                              <span><?php echo $Month ?></span>
                              <?php echo $Year ?>
                            </div>
                          </div>
                        </div>
                        <h3 class="event-one__title">
                          <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Events['ID'] ?>"><?php echo $Events['Name']?></a>
                        </h3>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-6">
                    <div class="event-one__right">
                      <ul class="event-one__list list-unstyled">
                        <li>
                          <i class="egypt-icon-clock"></i>
                          <span>Clock</span>
                          10.00am to 6.00pm
                        </li>
                        <li>
                          <i class="egypt-icon-place-1"></i>
                          <span>Location</span>
                            Pyramids of Giza, Egypt
                        </li>
                      </ul>

                      <div class="event-one__button-block">
                        <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Events['ID'] ?>" class="event-one__btn thm-btn">Book Online</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php } ?>


        </div>
      </section>

      <!-- Gallery -->
      <section class="collection-two">
        <div class="container">
          <div class="collection-two__top" style="display: block;">
          <div class="block-title text-center">
            <p class="block-title__tag-line">Gallery</p>
            <h2 class="block-title__title">The Pyramids of Giza</h2>
          </div>
          </div>
          <div class="row masonary-layout">
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="0ms">
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/new/gallery/gallery-1.png" alt="" />
                  <div class="collection-two__hover">
                    <a class="img-popup" href="images/new/gallery/gallery-1.png">
                      <i class="egypt-icon-focus"></i>
                    </a>
                  </div>
                </div>
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a>Egypt</a>
                  </p>
                  <h3 class="collection-two__title">
                    <a>Sphinx</a>
                  </h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="100ms">
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/new/gallery/gallery-2.png" alt="" />
                  <div class="collection-two__hover">
                    <a class="img-popup" href="images/new/gallery/gallery-2.png">
                      <i class="egypt-icon-focus"></i>
                    </a>
                  </div>
                </div>
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a>Egypt</a>
                  </p>
                  <h3 class="collection-two__title">
                    <a>Pyramids of Giza</a>
                  </h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="200ms">
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/new/gallery/gallery-3.png" alt="" />
                  <div class="collection-two__hover">
                    <a class="img-popup" href="images/new/gallery/gallery-3.png">
                      <i class="egypt-icon-focus"></i>
                    </a>
                  </div>
                </div>
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a>Egypt</a>
                  </p>
                  <h3 class="collection-two__title">
                    <a>Pyramids of Giza</a>
                  </h3>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="300ms">
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/new/gallery/gallery-5.png" alt="" />
                  <div class="collection-two__hover">
                    <a class="img-popup" href="images/new/gallery/gallery-5.png">
                      <i class="egypt-icon-focus"></i>
                    </a>
                  </div>
                </div>
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a>Egypt</a>
                  </p>
                  <h3 class="collection-two__title">
                    <a>Khufu Pyramids</a>
                  </h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="400ms">
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/new/gallery/gallery-4.png" alt="" />
                  <div class="collection-two__hover">
                    <a href="images/new/gallery/gallery-4.png" class="img-popup">
                      <i class="egypt-icon-focus"></i>
                    </a>
                  </div>
                </div>
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a>Egypt</a>
                  </p>
                  <h3 class="collection-two__title">
                    <a>Sphinx</a>
                  </h3>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="500ms">
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/new/gallery/gallery-6.png" alt="" />
                  <div class="collection-two__hover">
                    <a class="img-popup" href="images/new/gallery/gallery-6.png">
                      <i class="egypt-icon-focus"></i>
                    </a>
                  </div>
                </div>
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a>Egypt</a>
                  </p>
                  <h3 class="collection-two__title">
                    <a>Khufu Pyramid</a>
                  </h3>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Membership -->
      <section class="cta-one">
        <div class="container">
          <img src="images/resources/cta-1-person.png" class="cta-one__person wow fadeInRight" data-wow-duration="1500ms"/>
          <div class="row">
            <div class="col-xl-6 col-lg-8">
              <div class="cta-one__block">
                <div class="cta-one__icon">
                  <i class="egypt-icon-membership"></i>
                </div>
                <div class="cta-one__content">
                  <h3 class="cta-one__title">
                    Become a <br />
                    Member of Pyramids
                  </h3>
                  <p class="cta-one__text">
                    Gain Access to Exclusive Features and Resources<br />
                    with Our Membership Program!
                  </p>
                  <ul class="list-unstyled cta-one__list">
                    <li>
                      <i class="egypt-icon-check"></i>
                      Free Entries to the pyramids and Grand Egyptian Museum
                    </li>
                    <li>
                      <i class="egypt-icon-check"></i>
                      Access to Exclusive Activities
                    </li>
                    <li>
                      <i class="egypt-icon-check"></i>
                      Free Tickets to Special Exhibitions
                    </li>
                  </ul>
                  <a href="./Membership.php" class="cta-one__link">
                    <i class="fa fa-angle-right"></i>
                    Become a Member 
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

  <?php include "./UserFooterPyramids.php"; ?>
