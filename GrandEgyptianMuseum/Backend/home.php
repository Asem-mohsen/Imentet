<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Grand Egyptian Museum";

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

  <?php include "./NavUser.php"; ?>

      <!-- Sliders Home Page -->
      <section class="slider-one">
        <div class="slider-one__carousel owl-carousel owl-theme">
          <div class="item slider-one__slider-1" style="background-image: url(images/slider/slider-1-1.jpeg)">
            <div class="container text-center">
              <p class="slider-one__tag-line text-uppercase">
                Celebrate tradition!
              </p>
              <h2 class="slider-one__title">
                One of the Finest Collections of <br/>
                Egyptian Art.
              </h2>
              <p class="slider-one__text text-uppercase">
                Through November 12 (Tuesday) - 18 (Monday), 2023.
              </p>
              <a href="#" class="thm-btn slider-one__btn">Find Out More</a>
            </div>
          </div>
          <div class="item slider-one__slider-2" style="background-image: url(images/slider/slider-1-2.jpeg)" >
            <div class="container text-center">
              <p class="slider-one__tag-line text-uppercase">
                Get your grip on history
              </p>
              <h2 class="slider-one__title">
                Discover the Treasures of a Egypt <br />
                Historical Museum
              </h2>
              <p class="slider-one__text">
                US Based Historical & Art Musium Founded By Jorge Mckey in 1969
              </p>
              <a href="#" class="thm-btn slider-one__btn">Find Out More</a>
            </div>
          </div>
          <div class="item slider-one__slider-3" style="background-image: url(images/slider/slider-1-3.jpeg)">
            <div class="container text-center">
              <p class="slider-one__tag-line text-uppercase">
                The Past is our Future
              </p>
              <h2 class="slider-one__title">
                World’s Leading Museum of History <br />
                Over 2.3 k Collection
              </h2>
              <p class="slider-one__text">
                Let Your Inner Light Grow With the Silence of History
              </p>
              <a href="#" class="thm-btn slider-one__btn">Find Out More</a>
            </div>
          </div>
        </div>
        <div class="slider-one__nav">
          <a class="slider-one__nav-left slide-one__left-btn" href="#">
            <i class="egypt-icon-right-angle"></i>
            <span class="slider-one__nav-text">Prev</span>
          </a>
          <a class="slider-one__nav-right slide-one__right-btn" href="#">
            <i class="egypt-icon-left-angle"></i>
            <span class="slider-one__nav-text">Next</span>
          </a>
        </div>
      </section>

      <!-- About Us -->
      <section class="about-two">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="about-two__content">
                <div class="block-title text-left">
                  <p class="block-title__tag-line">About Us</p>
                  <h2 class="block-title__title">History of Egypt</h2>
                  <h3 class="block-title__sub-title">
                    The World's Leading Museum of <br/>
                    Histrory & Culture.
                  </h3>
                </div>
                <p class="about-two__text">
                  Grand Egyptian Museum is the world's leading museum of history & culture,
                  housing a <br />
                  permanent collection of over 2.3 million objects that span
                  over 5,000 <br />
                  years of human creativity.
                </p>
                <p class="about-two__text">
                  Desires to obtain pain of itself, because it is pain, but
                  because occa- <br />
                  sionally circumstances occur some great pleasure.
                </p>
                <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php" class="thm-btn about-two__btn">More Details</a>
              </div>
            </div>
            <div class="col-lg-6 d-flex align-items-end justify-content-center wow fadeInRight" data-wow-duration="1500ms">
              <div class="about-two__image">
                <img src="images/resources/about-2-1.jpeg" class="about-two__image--1" alt="Awesome Image" />
                <img src="images/resources/about-2-2.jpeg" class="about-two__image--2" alt="Awesome Image" />
                <div class="about-two__image-content">
                  <div class="about-two__image-decor"></div>
                  <div class="about-two__image-content-main">
                    <div class="about-two__image-content-left">E</div>
                    <div class="about-two__image-content-right">
                      <span>stablished</span>
                      <span class="about-two__year counter">1956</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Exhibition Section  -->
      <section class="exhibhition-one">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">Exhibition</p>
            <h2 class="block-title__title">Ongoing Exhibitions</h2>
          </div>
          <div class="row">
            <?php 
              $SelectExhibitions = "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                    JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                    WHERE CatID = 9 ORDER BY ID DESC LIMIT 3";
              $Query = mysqli_query($con , $SelectExhibitions);
              $ExhibitionsRow = mysqli_fetch_assoc($Query);
              foreach($Query as $Exhibitions){ 
                $StartDate = $Exhibitions['Date'] ;
                $EndDate = $Exhibitions['DateTo'] ;
                $StartDateInMonth = date('M d, Y' , strtotime($StartDate));
                $EndDateInMonth = date('M d, Y' , strtotime($EndDate));
                ?>
                <div class="col-lg-4">
                  <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
                    <div class="exhibhition-one__image">
                      <div class="exhibhition-one__image-inner">
                        <span class="exhibhition-one__image-border-1"></span>
                        <span class="exhibhition-one__image-border-2"></span>
                        <span class="exhibhition-one__image-border-3"></span>
                        <span class="exhibhition-one__image-border-4"></span>

                        <img src="Images/<?php echo $Exhibitions['Image'] ?>" alt="Awesome Image"/>
                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="exhibhition-one__image-link">
                          <i class="egypt-icon-arrow-1"></i>
                        </a>
                      </div>
                    </div>
                    <div class="exhibhition-one__content">
                      <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="exhibhition-one__category"><?php echo $Exhibitions['CatName'] ?></a>
                      <h3 class="exhibhition-one__title">
                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>"><?php echo $Exhibitions['Name'] ?></a>
                      </h3>
                      <div class="exhibhition-one__bottom">
                        <div class="exhibhition-one__bottom-left">
                          <span> <?php echo $StartDateInMonth ?> </span>
                          <span>
                          <?php echo $EndDateInMonth ?> <i class="fa fa-angle-double-left"></i>
                          </span>
                        </div>
                        <div class="exhibhition-one__bottom-right">
                          <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="thm-btn exhibhition-one__btn">Read More</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              <?php } ?>
          </div>
        </div>
      </section>

      <!-- Events Section -->
      <section class="event-two">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 d-flex">
              <div class="my-auto">
                <div class="event-two__block">
                  <div class="block-title text-left">
                    <p class="block-title__tag-line">Events</p>
                    <h2 class="block-title__title">
                      Events & <br />
                      Program Schedule
                    </h2>
                  </div>
                  <ul class="list-unstyled event-two__list nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" data-toggle="tab" href="#current" role="tab" >
                        <span class="number">01.</span>
                        Current
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" data-toggle="tab" href="#upcoming" role="tab">
                        <span class="number">02.</span>
                        Upcoming
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                    <li class="nav-item"> 
                      <a class="nav-link" data-toggle="tab" href="#past" role="tab" >
                        <span class="number">03.</span>
                        Past
                        <i class="fa fa-angle-right"></i>
                      </a>
                    </li>
                  </ul>
                  <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/events.php?Page=1" class="event-two__more-link">
                    View All Upcoming Events 
                    <span>+</span>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-lg-7">
              <div class="tab-content">
                <!-- Current Events -->
                <div class="event-two__main tab-pane animated fadeInRight show active" id="current" role="tabpanel">
                  <?php
                    $SelectEvents= "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName ,place.Name AS PlaceName  FROM entertainmnet 
                                          JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                          JOIN place ON place.ID = entertainmnet.PlaceID 
                                          WHERE CatID != 9 AND PlaceID = 2  AND Date BETWEEN '2023-6-1' AND '2023-12-30'
                                          ORDER BY ID DESC LIMIT 3";
                    $Query = mysqli_query($con , $SelectEvents);
                    $EventsRow = mysqli_fetch_assoc($Query);
                    foreach($Query as $Event){ 
                      $Date = $Event['Date'] ;
                      $StartDate = date('M-d-Y' , strtotime($Date));
                      list($Month, $Day, $Year)=explode('-', $StartDate); 
                      ?>
                      <div class="event-two__single">
                        <div class="event-two__image">
                          <div class="event-two__time">
                            <?php echo $Event['CatName'] ?>
                          </div>
                          <div class="event-two__image-inner">
                            <div class="event-two__price">
                              <span><?php echo $Event['RegularPrice'] . " $" ?></span>
                            </div>
                            <img src="./Images/<?php echo $Event['Image'] ?>" width="200px" height="200px" alt="Awesome Image" />
                          </div>
                        </div>
                        <div class="event-two__content">
                          <div class="event-two__content-top">
                            <div class="event-two__date">
                              <div class="event-two__date-num"><?php echo $Day ?></div>
                              <div class="event-two__date-text">
                                <span><?php echo $Month ?></span>
                                <?php echo $Year ?>
                              </div>
                            </div>
                          </div>
                          <h3 class="event-two__title">
                            <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Event['ID'] ?>">
                              <?php echo $Event['Name'] ?>
                            </a>
                          </h3>
                          <p class="event-two__text">
                            <?php echo $Event['PlaceName'] ?>
                          </p>
                          <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="event-two__link">
                            <span>
                              <i class="fa fa-angle-right"></i>More Details</span>
                          </a>
                        </div>
                      </div>
                    <?php } ?>
                </div>

                  <!-- Upcoming Events -->
                <div class="event-two__main tab-pane animated fadeInRight" id="upcoming" role="tabpanel" >
                  <?php
                    $SelectEvents= "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName ,place.Name AS PlaceName  FROM entertainmnet 
                                    JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                    JOIN place ON place.ID = entertainmnet.PlaceID 
                                    WHERE CatID != 9 AND PlaceID = 2  AND Date BETWEEN '2023-12-30' AND '2024-12-30'
                                    ORDER BY ID DESC LIMIT 3";
                    $Query = mysqli_query($con , $SelectEvents);
                    $EventsRow = mysqli_fetch_assoc($Query);
                    foreach($Query as $UpcomingEvents){
                      $Date = $UpcomingEvents['Date'] ;
                      $StartDate = date('M-d-Y' , strtotime($Date));
                      list($Month, $Day, $Year)=explode('-', $StartDate); 
                      ?>
                      <div class="event-two__single">
                        <div class="event-two__image">
                          <div class="event-two__time">
                            <?php echo $UpcomingEvents['CatName'] ?>
                          </div>
                          <div class="event-two__image-inner">
                            <div class="event-two__price">
                              <span><?php echo $UpcomingEvents['RegularPrice'] . " $" ?></span>
                            </div>
                            <img src="./Images/<?php echo $UpcomingEvents['Image'] ?>" width="200px" height="200px"  alt="Awesome Image" />
                          </div>
                        </div>
                        <div class="event-two__content">
                          <div class="event-two__content-top">
                            <div class="event-two__date">
                              <div class="event-two__date-num"><?php echo $Day ?></div>
                              <div class="event-two__date-text">
                                <span><?php echo $Month ?></span>
                                <?php echo $Year ?>
                              </div>
                            </div>
                          </div>
                          <h3 class="event-two__title">
                            <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $UpcomingEvents['ID'] ?>">
                              <?php echo $UpcomingEvents['Name'] ?>
                            </a>
                          </h3>
                          <p class="event-two__text">
                            <?php echo $UpcomingEvents['PlaceName'] ?>
                          </p>
                          <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $UpcomingEvents['ID'] ?>" class="event-two__link">
                            <span>
                              <i class="fa fa-angle-right"></i>More Details</span>
                          </a>
                        </div>
                      </div>
                    <?php } ?>
                </div>

                <!-- Past Events -->
                <div class="event-two__main tab-pane animated fadeInRight" id="past" role="tabpanel" >
                  <?php 
                    $SelectPastEvents= "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName ,place.Name AS PlaceName  FROM entertainmnet 
                                    JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                    JOIN place ON place.ID = entertainmnet.PlaceID 
                                    WHERE CatID != 9 AND PlaceID = 2  AND Date BETWEEN '2020-10-10' AND '2023-6-25'
                                    ORDER BY ID DESC LIMIT 3";
                    $Query = mysqli_query($con , $SelectPastEvents);
                    $EventsRow = mysqli_fetch_assoc($Query);
                    foreach($Query as $PastEvents){
                      $Date = $PastEvents['Date'] ;
                      $StartDate = date('M-d-Y' , strtotime($Date));
                      list($Month, $Day, $Year)=explode('-', $StartDate); 
                      ?>
                      <div class="event-two__single">
                        <div class="event-two__image">
                          <div class="event-two__time">
                            <?php echo $PastEvents['CatName'] ?>
                          </div>
                          <div class="event-two__image-inner">
                            <div class="event-two__price">
                              <span><?php echo $PastEvents['RegularPrice'] ."$" ?></span>
                            </div>
                            <img src="./Images/<?php echo $PastEvents['Image'] ?>" width="200px" height="200px" alt="Awesome Image" />
                          </div>
                        </div>
                        <div class="event-two__content">
                          <div class="event-two__content-top">
                            <div class="event-two__date">
                              <div class="event-two__date-num"><?php echo $Day ?></div>
                              <div class="event-two__date-text">
                                <span><?php echo $Month ?></span>
                                <?php echo $Year ?>
                              </div>
                            </div>
                          </div>
                          <h3 class="event-two__title">
                            <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $PastEvents['ID'] ?>">
                              <?php echo $PastEvents['Name'] ?>
                            </a>
                          </h3>
                          <p class="event-two__text">
                            <?php echo $PastEvents['PlaceName'] ?>
                          </p>
                          <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $PastEvents['ID'] ?>" class="event-two__link"
                            ><span
                              ><i class="fa fa-angle-right"></i>More Details</span
                            ></a
                          >
                        </div>
                      </div>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- MemberShip Section -->
      <section class="video-one">
        <div class="video-one__box wow fadeInLeft" data-wow-duration="1500ms">
          <a href="https://www.youtube.com/watch?v=GiMbVa6XzTw" class="video-popup video-one__play-btn">
            <i class="fa fa-play"></i>
          </a> 
          <a href="https://www.youtube.com/watch?v=GiMbVa6XzTw" class="video-popup">
            <img src="images/resources/video-1-1.jpeg" alt="Awesome Image"/>
          </a>
        </div>
        <div class="container">
          <div class="row justify-content-xl-end">
            <div class="col-xl-5 col-lg-7">
              <div class="video-one__content">
                <h3 class="video-one__title">
                  Become a <br />
                  Member of Egypt
                </h3>
                <ul class="list-unstyled video-one__list">
                  <li>
                    <i class="egypt-icon-tick"></i>
                    Unlimited General Admission
                  </li>
                  <li>
                    <i class="egypt-icon-tick"></i>
                    Free Tickets to Special Exhibitions
                  </li>
                  <li>
                    <i class="egypt-icon-tick"></i>
                    Access to a Member Entrance
                  </li>
                </ul>
                <a href="./Project/membership.php" class="thm-btn video-one__btn">Become a Member</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Collections Section -->
      <section class="collection-three">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">Collections</p>
            <h2 class="block-title__title">Discover The Collection</h2>
          </div>
          <div class="row masonary-layout">
            <?php 
              $SelectCollections = "SELECT * FROM `collections` WHERE PlaceID = 2 LIMIT 7";
              $RunQuery = mysqli_query($con , $SelectCollections);
              $CollectionRow = mysqli_fetch_assoc($RunQuery);
              foreach($RunQuery as $Collection){ ?>
                <div class="col-lg-4 col-md-6 col-sm-12 masonary-item wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                  <div class="collection-three__single">
                    <img src="Images/<?php echo $Collection['Image'] ?>" alt="Awesome Image" />
                    <div class="collection-three__content">
                      <h3 class="collection-three__title">
                        <a href="collection-details.html">
                          <?php echo $Collection['Collection'] ?>
                        </a>
                      </h3>
                      <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>" class="collection-three__link">
                        <span>+</span>
                      </a>
                    </div>
                  </div>
                </div>
            <?php } ?>
          </div>

          <div class="text-center">
            <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Collections.php" class="collection-three__more-link">
              <span><i class="fa fa-angle-right"></i>View All Collections</span>
            </a>
          </div>
        </div>
      </section>

      <!-- Statistics -->
      <section class="funfact-one">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1500ms"  data-wow-delay="0ms">
              <div class="funfact-one__single">
                <div class="funfact-one__icon">
                  <i class="egypt-icon-art-museum"></i>
                </div>
                <div class="funfact-one__content">
                  <div class="funfact-one__count">
                    <span class="counter">246</span>
                  </div>
                  <div class="funfact-one__text">
                    <span class="text-uppercase">Exhibitions</span>
                    Has Been Held
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="100ms">
              <div class="funfact-one__single">
                <div class="funfact-one__icon">
                  <i class="egypt-icon-smile"></i>
                </div>
                <div class="funfact-one__content">
                  <div class="funfact-one__count">
                    <span class="counter">93</span>
                    k
                  </div>
                  <div class="funfact-one__text">
                    <span class="text-uppercase">Visitors</span>
                    In Last Year
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="200ms">
              <div class="funfact-one__single">
                <div class="funfact-one__icon">
                  <i class="egypt-icon-medal"></i>
                </div>
                <div class="funfact-one__content">
                  <div class="funfact-one__count">
                    <span class="counter">106</span>
                  </div>
                  <div class="funfact-one__text">
                    <span class="text-uppercase">Awards</span>
                    Have Received
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="300ms">
              <div class="funfact-one__single">
                <div class="funfact-one__icon">
                  <i class="egypt-icon-jar"></i>
                </div>
                <div class="funfact-one__content">
                  <div class="funfact-one__count">
                    <span class="counter">15</span>
                    k
                  </div>
                  <div class="funfact-one__text">
                    <span class="text-uppercase">Collections</span>
                    Of Art & Designs
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Reviews -->
      <section class="testimonials-one">
        <div class="container">
          <div class="testimonials-one__carousel owl-carousel owl-theme" data-carousel-margin="0">
            <div class="item">
              <div class="testimonials-one__single">
                <div class="testimonials-one__image">
                  <img src="images/resources/testi-1-1.jpeg" alt="" />
                </div>
                <div class="testimonials-one__info">
                  <h3 class="testimonials-one__name">Glen Ford</h3>
                  <p class="testimonials-one__designation">California</p>
                </div>
                <p class="testimonials-one__text">
                  Wonderful Exhibit. Great presentation with <br />
                  a lotof interesting things I did not know about Egypt. There
                  <br />
                  is always something to learn!
                </p>
              </div>
            </div>
            <div class="item">
              <div class="testimonials-one__single">
                <div class="testimonials-one__image">
                  <img src="images/resources/testi-1-2.jpeg" alt="" />
                </div>
                <div class="testimonials-one__info">
                  <h3 class="testimonials-one__name">Calvin Curtis</h3>
                  <p class="testimonials-one__designation">California</p>
                </div>
                <p class="testimonials-one__text">
                  Wonderful Exhibit. Great presentation with <br />
                  a lotof interesting things I did not know about Egypt. There
                  <br />
                  is always something to learn!
                </p>
              </div>
            </div>
            <div class="item">
              <div class="testimonials-one__single">
                <div class="testimonials-one__image">
                  <img src="images/resources/testi-1-3.jpeg" alt="" />
                </div>
                <div class="testimonials-one__info">
                  <h3 class="testimonials-one__name">Tillie Buchanan</h3>
                  <p class="testimonials-one__designation">California</p>
                </div>
                <p class="testimonials-one__text">
                  Wonderful Exhibit. Great presentation with <br />
                  a lotof interesting things I did not know about Egypt. There
                  <br />
                  is always something to learn!
                </p>
              </div>
            </div>
            <div class="item">
              <div class="testimonials-one__single">
                <div class="testimonials-one__image">
                  <img src="images/resources/testi-1-1.jpeg" alt="" />
                </div>
                <div class="testimonials-one__info">
                  <h3 class="testimonials-one__name">Isabella Henry</h3>
                  <p class="testimonials-one__designation">California</p>
                </div>
                <p class="testimonials-one__text">
                  Wonderful Exhibit. Great presentation with <br />
                  a lotof interesting things I did not know about Egypt. There
                  <br />
                  is always something to learn!
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- /.testimonials-one -->
      <section class="blog-two">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">News Blog</p>
            <!-- /.block-title__tag-line -->
            <h2 class="block-title__title">Latest From Our Blog</h2>
            <!-- /.block-title__title -->
          </div>
          <!-- /.block-title -->
          <div class="row masonary-layout">
            <div
              class="col-lg-4 col-md-6 col-sm-12 masonary-item wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="0ms"
            >
              <div class="blog-two__single">
                <div class="blog-two__image">
                  <img src="images/blog/blog-2-1.jpeg" alt="" />
                  <a href="blog-details.html"
                    ><i class="egypt-icon-add"></i
                    ><!-- /.egypt-icon-add --></a
                  >
                </div>
                <!-- /.blog-two__image -->
                <div class="blog-two__content">
                  <div class="blog-two__meta">
                    <a href="blog-details.html">Admin</a>
                    <span class="blog-two__meta-sep">_</span
                    ><!-- /.blog-two__meta-sep -->
                    <a href="blog-details.html ">Press Release</a>
                  </div>
                  <!-- /.blog-two__meta -->
                  <h3 class="blog-two__title">
                    <a href="blog-details.html"
                      >Celebrating Authentic Marathon at Our Egypt Museum</a
                    >
                  </h3>
                  <!-- /.blog-two__title -->
                  <p class="blog-two__text">
                    Explain to you how all this mistaken idea of denouncing
                    pleasure...
                  </p>
                  <!-- /.blog-two__text -->
                  <div class="blog-two__bottom">
                    <a href="blog-details.html" class="blog-two__link"
                      >Read More <span>+</span></a
                    >
                    <!-- /.blog-two__link -->
                    <a href="blog-details.html" class="blog-two__date"
                      >21.10.2023</a
                    >
                  </div>
                  <!-- /.blog-two__bottom -->
                </div>
                <!-- /.blog-two__content -->
              </div>
              <!-- /.blog-two__single -->
            </div>
            <!-- /.col-lg-4 col-md-6 -->
            <div
              class="col-lg-4 col-md-6 col-sm-12 masonary-item wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="100ms"
            >
              <div class="blog-two__single blog-two__qoute-post">
                <h3 class="blog-two__qoute">
                  “While I stand & regard it, the indifference to myself shown
                  by a work of art in itself is art”
                </h3>
                <!-- /.blog-two__qoute -->
                <a href="blog-details.html" class="blog-two__link"
                  >Read More <span>+</span></a
                >
                <!-- /.blog-two__link -->
                <i class="egypt-icon-quote blog-two__qoute-icon"></i
                ><!-- /.egypt-icon-quote -->
              </div>
              <!-- /.blog-two__single -->
            </div>
            <!-- /.col-lg-4 col-md-6 -->
            <div
              class="col-lg-4 col-md-6 col-sm-12 masonary-item wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="200ms"
            >
              <div class="blog-two__single">
                <div class="blog-two__image">
                  <img src="images/blog/blog-2-3.jpeg" alt="" />
                  <a href="blog-details.html"
                    ><i class="egypt-icon-add"></i
                    ><!-- /.egypt-icon-add --></a
                  >
                </div>
                <!-- /.blog-two__image -->
                <div class="blog-two__content">
                  <div class="blog-two__meta">
                    <a href="blog-details.html">Admin</a>
                    <span class="blog-two__meta-sep">_</span
                    ><!-- /.blog-two__meta-sep -->
                    <a href="blog-details.html ">Press Release</a>
                  </div>
                  <!-- /.blog-two__meta -->
                  <h3 class="blog-two__title">
                    <a href="blog-details.html"
                      >Celebrating Authentic Marathon at Our Egypt Museum</a
                    >
                  </h3>
                  <!-- /.blog-two__title -->
                  <p class="blog-two__text">
                    Explain to you how all this mistaken idea of denouncing
                    pleasure...
                  </p>
                  <!-- /.blog-two__text -->
                  <div class="blog-two__bottom">
                    <a href="blog-details.html" class="blog-two__link"
                      >Read More <span>+</span></a
                    >
                    <!-- /.blog-two__link -->
                    <a href="blog-details.html" class="blog-two__date"
                      >21.10.2023</a
                    >
                  </div>
                  <!-- /.blog-two__bottom -->
                </div>
                <!-- /.blog-two__content -->
              </div>
              <!-- /.blog-two__single -->
            </div>
            <!-- /.col-lg-4 col-md-6 -->
            <div
              class="col-lg-4 col-md-6 col-sm-12 masonary-item wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="300ms"
            >
              <div class="blog-two__single">
                <div class="blog-two__image">
                  <img src="images/blog/blog-2-2.jpeg" alt="" />
                  <a href="blog-details.html"
                    ><i class="egypt-icon-add"></i
                    ><!-- /.egypt-icon-add --></a
                  >
                </div>
                <!-- /.blog-two__image -->
                <div class="blog-two__content">
                  <div class="blog-two__meta">
                    <a href="blog-details.html">Admin</a>
                    <span class="blog-two__meta-sep">_</span
                    ><!-- /.blog-two__meta-sep -->
                    <a href="blog-details.html ">Press Release</a>
                  </div>
                  <!-- /.blog-two__meta -->
                  <h3 class="blog-two__title">
                    <a href="blog-details.html"
                      >Celebrating Authentic Marathon at Our Egypt Museum</a
                    >
                  </h3>
                  <!-- /.blog-two__title -->
                  <div class="blog-two__bottom">
                    <a href="blog-details.html" class="blog-two__link"
                      >Read More <span>+</span></a
                    >
                    <!-- /.blog-two__link -->
                    <a href="blog-details.html" class="blog-two__date"
                      >21.10.2019</a
                    >
                  </div>
                  <!-- /.blog-two__bottom -->
                </div>
                <!-- /.blog-two__content -->
              </div>
              <!-- /.blog-two__single -->
            </div>
            <!-- /.col-lg-4 col-md-6 -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>
      
      <?php include "./UserFooter.php"; ?>
