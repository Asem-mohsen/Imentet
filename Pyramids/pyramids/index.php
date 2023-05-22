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
          <div class="item slider-two__slider-1" style="background-image: url(images/slider/slider-2-1.jpg)">
            <div class="container text-left">
              <p class="slider-two__tag-line">Awesome of Collection of</p>
              <h2 class="slider-two__title">Mercenary Soldiers</h2>
              <p class="slider-two__text">
                Egypt is the world's leading museum of history & culture,
                housing a <br />
                permanent collection of over 2.3 million objects.
              </p>
              <a href="#" class="thm-btn slider-two__btn">Find Out More</a>
            </div>
          </div>
          <div class="item slider-two__slider-2" style="background-image: url(images/slider/slider-2-2.jpg)">
            <div class="container text-center">
              <p class="slider-two__tag-line">Greatest Collection of</p>
              <h2 class="slider-two__title">Egyptian Artifacts</h2>
              <p class="slider-two__text">
                Egypt is the world's leading museum of history & culture,
                housing a <br />
                permanent collection of over 2.3 million objects.
              </p>
              <a href="#" class="thm-btn slider-two__btn">Find Out More</a>
            </div>
          </div>
          <div class="item slider-two__slider-3" style="background-image: url(images/slider/slider-2-3.jpg)">
            <div class="container text-left">
              <div class="row justify-content-end">
                <div class="col-xl-7 col-lg-9">
                  <p class="slider-two__tag-line">A Montage of History</p>
                  <h2 class="slider-two__title">Proof of Evolution</h2>
                  <p class="slider-two__text">
                    Egypt is the world's leading museum of history & culture,
                    housing a
                    <br />
                    permanent collection of over 2.3 million objects.
                  </p>
                  <a href="#" class="thm-btn slider-two__btn">Find Out More</a>
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
                      The World's Leading Museum of <br />
                      Histrory & Culture.
                    </h2>
                  </div>
                  <p class="about-one__text">
                    Desires to obtain pain of itself, because it is pain because
                    occasionally.
                  </p>
                  <p class="about-one__text">
                    Explain to you how all this mistaken idea of denouncing
                    pleasure and praising pain was born and I will give you a
                    complete account of the system, and the actual teachings of
                    the great explorer of the truth.
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
                      <h3 class="about-one__feature-title">Egypt Museum</h3>
                      <p class="about-one__feature-text">
                        Flat A, 20/7, Reynolds Neck <br />
                        Helenaville 08745.
                      </p>
                      <a href="#" class="about-one__feature-link">
                        Get Direction <span>+</span>
                      </a>
                    </div>
                  </div>
                  <div class="about-one__feature-single">
                    <div class="about-one__feature-icon">
                      <i class="egypt-icon-ticket"></i>
                    </div>
                    <div class="about-one__feature-content">
                      <h3 class="about-one__feature-title">Free Admission</h3>
                      <p class="about-one__feature-text">
                        Exhibitions are free for our <br />
                        museum members.
                      </p>
                      <a href="#" class="about-one__feature-link">
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

      <!-- Collections -->
      <section class="collection-one">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">Categories</p>
            <h2 class="block-title__title">On View At Our Museum</h2>
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
                    <a href="collection-antiquties.html">Antiquities</a>
                  </h3>
                  <a href="collection-antiquties.html"  class="collection-one__link">
                    Explore The Collection
                  </a>
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
                    <a href="collection-drawing.html">Drawing</a>
                  </h3>
                  <a href="collection-drawing.html" class="collection-one__link">
                    Explore The Collection
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
                  <h3 class="collection-one__title"><a href="#">Virtual</a></h3>
                  <a href="#" class="collection-one__link">
                    Explore The Collection
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
                    <a href="collection-cultural.html">Cultural</a>
                  </h3>
                  <a  href="collection-cultural.html" class="collection-one__link">
                    Explore The Collection
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
                    <a href="collection-painting.html">Painting</a>
                  </h3>
                  <a href="collection-painting.html" class="collection-one__link">
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
                    <a href="collection-sculpture.html">Sculpture</a>
                  </h3>
                  <a href="collection-sculpture.html" class="collection-one__link">
                    Explore The Collection
                  </a>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center">
            <a href="#" class="thm-btn collection-one__more-btn">More Categories</a>
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
            $SelectEvents= "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName ,place.Name AS PlaceName  FROM entertainmnet 
                            JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                            JOIN place ON place.ID = entertainmnet.PlaceID 
                            WHERE PlaceID = 1 
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
                          <img src="images/<?php echo $Events['Image'] ?>" width="90px" height="90px" alt="" />
                        </div>
                        <div class="event-one__image-hover"><?php echo $Events['RegularPrice'] . " LE" ?></div>
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
                          <span>Venue</span>
                          Al Giza, EGY
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

      <!-- Blog -->
      <section class="blog-one">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">News Blog</p>
            <!-- /.block-title__tag-line -->
            <h2 class="block-title__title">Latest From Our Blog</h2>
            <!-- /.block-title__title -->
          </div>
          <!-- /.block-title -->
          <div class="row">
            <div
              class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="0ms"
            >
              <div class="blog-one__single">
                <div class="blog-one__image">
                  <img src="images/blog/blog-1-1.jpg" alt="" />
                  <a href="blog-details.html"
                    ><i class="egypt-icon-add"></i
                    ><!-- /.egypt-icon-add --></a
                  >
                </div>
                <!-- /.blog-one__image -->
                <div class="blog-one__content">
                  <div class="blog-one__top">
                    <div class="blog-one__date">
                      <span>
                        5 <br />
                        Oct
                      </span>
                    </div>
                    <!-- /.blog-one__date -->
                    <div class="blog-one__meta">
                      <a href="#">Admin</a>
                      <a href="#">Press Release</a>
                    </div>
                    <!-- /.blog-one__meta -->
                  </div>
                  <!-- /.blog-one__top -->
                  <h3 class="blog-one__title">
                    <a href="blog-details.html"
                      >New visual identity for our egypt museum</a
                    >
                  </h3>
                  <!-- /.blog-one__title -->
                  <a href="blog-details.html" class="blog-one__link"
                    >Read More <span>+</span></a
                  >
                  <!-- /.blog-one__link -->
                </div>
                <!-- /.blog-one__content -->
              </div>
              <!-- /.blog-one__single -->
            </div>
            <!-- /.col-lg-3 col-md-6 -->
            <div
              class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="100ms"
            >
              <div class="blog-one__single">
                <div class="blog-one__image">
                  <img src="images/blog/blog-1-2.jpg" alt="" />
                  <a href="blog-details.html"
                    ><i class="egypt-icon-add"></i
                    ><!-- /.egypt-icon-add --></a
                  >
                </div>
                <!-- /.blog-one__image -->
                <div class="blog-one__content">
                  <div class="blog-one__top">
                    <div class="blog-one__date">
                      <span>
                        21 <br />
                        Aug
                      </span>
                    </div>
                    <!-- /.blog-one__date -->
                    <div class="blog-one__meta">
                      <a href="#">Admin</a>
                      <a href="#">Photography</a>
                    </div>
                    <!-- /.blog-one__meta -->
                  </div>
                  <!-- /.blog-one__top -->
                  <h3 class="blog-one__title">
                    <a href="blog-details.html"
                      >Earlier water color of palace save for the nation</a
                    >
                  </h3>
                  <!-- /.blog-one__title -->
                  <a href="blog-details.html" class="blog-one__link"
                    >Read More <span>+</span></a
                  >
                  <!-- /.blog-one__link -->
                </div>
                <!-- /.blog-one__content -->
              </div>
              <!-- /.blog-one__single -->
            </div>
            <!-- /.col-lg-3 col-md-6 -->
            <div
              class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="200ms"
            >
              <div class="blog-one__single">
                <div class="blog-one__image">
                  <img src="images/blog/blog-1-3.jpg" alt="" />
                  <a href="blog-details.html"
                    ><i class="egypt-icon-add"></i
                    ><!-- /.egypt-icon-add --></a
                  >
                </div>
                <!-- /.blog-one__image -->
                <div class="blog-one__content">
                  <div class="blog-one__top">
                    <div class="blog-one__date">
                      <span>
                        10 <br />
                        Aug
                      </span>
                    </div>
                    <!-- /.blog-one__date -->
                    <div class="blog-one__meta">
                      <a href="#">Admin</a>
                      <a href="#">Information</a>
                    </div>
                    <!-- /.blog-one__meta -->
                  </div>
                  <!-- /.blog-one__top -->
                  <h3 class="blog-one__title">
                    <a href="blog-details.html"
                      >The first ever production car and flying car</a
                    >
                  </h3>
                  <!-- /.blog-one__title -->
                  <a href="blog-details.html" class="blog-one__link"
                    >Read More <span>+</span></a
                  >
                  <!-- /.blog-one__link -->
                </div>
                <!-- /.blog-one__content -->
              </div>
              <!-- /.blog-one__single -->
            </div>
            <!-- /.col-lg-3 col-md-6 -->
            <div
              class="col-lg-3 col-md-6 col-sm-12 wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="300ms"
            >
              <div class="blog-one__single">
                <div class="blog-one__image">
                  <img src="images/blog/blog-1-4.jpg" alt="" />
                  <a href="blog-details.html"
                    ><i class="egypt-icon-add"></i
                    ><!-- /.egypt-icon-add --></a
                  >
                </div>
                <!-- /.blog-one__image -->
                <div class="blog-one__content">
                  <div class="blog-one__top">
                    <div class="blog-one__date">
                      <span>
                        24 <br />
                        Jun
                      </span>
                    </div>
                    <!-- /.blog-one__date -->
                    <div class="blog-one__meta">
                      <a href="#">Admin</a>
                      <a href="#">Technology</a>
                    </div>
                    <!-- /.blog-one__meta -->
                  </div>
                  <!-- /.blog-one__top -->
                  <h3 class="blog-one__title">
                    <a href="blog-details.html"
                      >Food: Bigger than the plate exhibition highlights</a
                    >
                  </h3>
                  <!-- /.blog-one__title -->
                  <a href="blog-details.html" class="blog-one__link"
                    >Read More <span>+</span></a
                  >
                  <!-- /.blog-one__link -->
                </div>
                <!-- /.blog-one__content -->
              </div>
              <!-- /.blog-one__single -->
            </div>
            <!-- /.col-lg-3 col-md-6 -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>

      <!-- Collections -->
      <section class="collection-two">
        <div class="container">
          <div class="collection-two__top">
            <div class="block-title text-left">
              <p class="block-title__tag-line">Collections</p>
              <h2 class="block-title__title">Special Collections</h2>
            </div>

            <div class="collection-two__more-links-wrap">
              <a href="#" class="collection-two__more-links">
                <i class="fa fa-angle-right"></i>
                View More Collections 
              </a>
            </div>
          </div>

          <div class="row masonary-layout">
            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="0ms">
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/collections/collections-1-1.jpg" alt="" />
                  <div class="collection-two__hover">
                    <a class="img-popup" href="images/collections/collections-1-1.jpg">
                      <i class="egypt-icon-focus"></i>
                    </a>
                  </div>
                </div>
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a href="collection-details.html">Painting</a>
                  </p>
                  <h3 class="collection-two__title">
                    <a href="collection-details.html">Alexandria in Prison</a>
                  </h3>
                </div>
              </div>
            </div>
            <div
              class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item"
              data-wow-duration="1500ms"
              data-wow-delay="100ms"
            >
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/collections/collections-1-2.jpg" alt="" />
                  <div class="collection-two__hover">
                    <a
                      class="img-popup"
                      href="images/collections/collections-1-2.jpg"
                      ><i class="egypt-icon-focus"></i>
                      <!-- /.egypt-icon-focus --></a
                    >
                  </div>
                  <!-- /.collection-two__hover -->
                </div>
                <!-- /.collection-two__image -->
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a href="collection-details.html">Sculpture</a>
                  </p>
                  <!-- /.collection-two__category -->
                  <h3 class="collection-two__title">
                    <a href="collection-details.html">The Lascaux Cave</a>
                  </h3>
                  <!-- /.collection-two__title -->
                </div>
                <!-- /.collection-two__content -->
              </div>
              <!-- /.collection-two__single -->
            </div>
            <!-- /.col-lg-4 masonary-item -->
            <div
              class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item"
              data-wow-duration="1500ms"
              data-wow-delay="200ms"
            >
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/collections/collections-1-3.jpg" alt="" />
                  <div class="collection-two__hover">
                    <a
                      class="img-popup"
                      href="images/collections/collections-1-3.jpg"
                      ><i class="egypt-icon-focus"></i>
                      <!-- /.egypt-icon-focus --></a
                    >
                  </div>
                  <!-- /.collection-two__hover -->
                </div>
                <!-- /.collection-two__image -->
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a href="collection-details.html">Drawing</a>
                  </p>
                  <!-- /.collection-two__category -->
                  <h3 class="collection-two__title">
                    <a href="collection-details.html">Mare and Foal</a>
                  </h3>
                  <!-- /.collection-two__title -->
                </div>
                <!-- /.collection-two__content -->
              </div>
              <!-- /.collection-two__single -->
            </div>
            <!-- /.col-lg-4 masonary-item -->

            <div
              class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item"
              data-wow-duration="1500ms"
              data-wow-delay="300ms"
            >
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/collections/collections-1-5.jpg" alt="" />
                  <div class="collection-two__hover">
                    <a
                      class="img-popup"
                      href="images/collections/collections-1-5.jpg"
                      ><i class="egypt-icon-focus"></i>
                      <!-- /.egypt-icon-focus --></a
                    >
                  </div>
                  <!-- /.collection-two__hover -->
                </div>
                <!-- /.collection-two__image -->
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a href="collection-details.html">Painting</a>
                  </p>
                  <!-- /.collection-two__category -->
                  <h3 class="collection-two__title">
                    <a href="collection-details.html"
                      >Tower of Babel (Babylon)</a
                    >
                  </h3>
                  <!-- /.collection-two__title -->
                </div>
                <!-- /.collection-two__content -->
              </div>
              <!-- /.collection-two__single -->
            </div>
            <!-- /.col-lg-4 masonary-item -->
            <div
              class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item"
              data-wow-duration="1500ms"
              data-wow-delay="400ms"
            >
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/collections/collections-1-4.jpg" alt="" />
                  <div class="collection-two__hover">
                    <a
                      class="img-popup"
                      href="images/collections/collections-1-4.jpg"
                      ><i class="egypt-icon-focus"></i>
                      <!-- /.egypt-icon-focus --></a
                    >
                  </div>
                  <!-- /.collection-two__hover -->
                </div>
                <!-- /.collection-two__image -->
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a href="collection-details.html">Antiquities</a>
                  </p>
                  <!-- /.collection-two__category -->
                  <h3 class="collection-two__title">
                    <a href="collection-details.html">Mercenary Soldiers</a>
                  </h3>
                  <!-- /.collection-two__title -->
                </div>
                <!-- /.collection-two__content -->
              </div>
              <!-- /.collection-two__single -->
            </div>
            <!-- /.col-lg-4 masonary-item -->
            <div
              class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item"
              data-wow-duration="1500ms"
              data-wow-delay="500ms"
            >
              <div class="collection-two__single">
                <div class="collection-two__image">
                  <img src="images/collections/collections-1-6.jpg" alt="" />
                  <div class="collection-two__hover">
                    <a
                      class="img-popup"
                      href="images/collections/collections-1-6.jpg"
                      ><i class="egypt-icon-focus"></i>
                      <!-- /.egypt-icon-focus --></a
                    >
                  </div>
                  <!-- /.collection-two__hover -->
                </div>
                <!-- /.collection-two__image -->
                <div class="collection-two__content">
                  <p class="collection-two__category">
                    <a href="collection-details.html">Sculpture</a>
                  </p>
                  <!-- /.collection-two__category -->
                  <h3 class="collection-two__title">
                    <a href="collection-details.html">Alexandria in Prison</a>
                  </h3>
                  <!-- /.collection-two__title -->
                </div>
                <!-- /.collection-two__content -->
              </div>
              <!-- /.collection-two__single -->
            </div>
            <!-- /.col-lg-4 masonary-item -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
      </section>

      <!-- Visitors Section -->
      <section class="testimonials-two">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">Feedback</p>
            <!-- /.block-title__tag-line -->
            <h2 class="block-title__title">Words From Visitors</h2>
            <!-- /.block-title__title -->
          </div>
          <!-- /.block-title -->
          <div class="row">
            <div
              class="col-lg-4 wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="0ms"
            >
              <div class="testimonials-two__single">
                <div class="testimonials-two__image">
                  <img src="images/resources/testi-2-1.jpg" alt="" />
                </div>
                <!-- /.testimonials-two__image -->
                <h3 class="testimonials-two__name">Jeffrin Melina</h3>
                <!-- /.testimonials-two__name -->
                <p class="testimonials-two__designation">California</p>
                <!-- /.testimonials-two__designation -->
                <div class="testimonials-two__content">
                  <div class="testimonials-two__qoute"></div>
                  <!-- /.testimonials-two__qoute -->
                  <h3 class="testimonials-two__title">Good worth to visit</h3>
                  <!-- /.testimonials-two__title -->
                  <p class="testimonials-two__text">
                    Wonderful Exhibit.Great presentation lot of interestting
                    things I did not know about Egypt, it is awesome.
                  </p>
                  <!-- /.testimonials-two__text -->
                  <div class="testimonials-two__stars">
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                  </div>
                  <!-- /.testimonials-two__stars -->
                </div>
                <!-- /.testimonials-two__content -->
              </div>
              <!-- /.testimonials-two__single -->
            </div>
            <!-- /.col-lg-4 -->
            <div
              class="col-lg-4 wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="100ms"
            >
              <div class="testimonials-two__single">
                <div class="testimonials-two__image">
                  <img src="images/resources/testi-2-2.jpg" alt="" />
                </div>
                <!-- /.testimonials-two__image -->
                <h3 class="testimonials-two__name">Duke Frederick</h3>
                <!-- /.testimonials-two__name -->
                <p class="testimonials-two__designation">Newyork</p>
                <!-- /.testimonials-two__designation -->
                <div class="testimonials-two__content">
                  <div class="testimonials-two__qoute"></div>
                  <!-- /.testimonials-two__qoute -->
                  <h3 class="testimonials-two__title">Guide was fabulous</h3>
                  <!-- /.testimonials-two__title -->
                  <p class="testimonials-two__text">
                    There are some interesting historical pictures and
                    information dating back to the cattle ranches here.
                  </p>
                  <!-- /.testimonials-two__text -->
                  <div class="testimonials-two__stars">
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star-o"></i
                    ><!-- /.fa fa-star -->
                  </div>
                  <!-- /.testimonials-two__stars -->
                </div>
                <!-- /.testimonials-two__content -->
              </div>
              <!-- /.testimonials-two__single -->
            </div>
            <!-- /.col-lg-4 -->
            <div
              class="col-lg-4 wow fadeInUp"
              data-wow-duration="1500ms"
              data-wow-delay="200ms"
            >
              <div class="testimonials-two__single">
                <div class="testimonials-two__image">
                  <img src="images/resources/testi-2-3.jpg" alt="" />
                </div>
                <!-- /.testimonials-two__image -->
                <h3 class="testimonials-two__name">Hugh Isadore</h3>
                <!-- /.testimonials-two__name -->
                <p class="testimonials-two__designation">California</p>
                <!-- /.testimonials-two__designation -->
                <div class="testimonials-two__content">
                  <div class="testimonials-two__qoute"></div>
                  <!-- /.testimonials-two__qoute -->
                  <h3 class="testimonials-two__title">The great history</h3>
                  <!-- /.testimonials-two__title -->
                  <p class="testimonials-two__text">
                    You’re immediately welcomed and included. And then if you
                    don’t want to it’s easy enough to close.
                  </p>
                  <!-- /.testimonials-two__text -->
                  <div class="testimonials-two__stars">
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                    <i class="fa fa-star"></i
                    ><!-- /.fa fa-star -->
                  </div>
                  <!-- /.testimonials-two__stars -->
                </div>
                <!-- /.testimonials-two__content -->
              </div>
              <!-- /.testimonials-two__single -->
            </div>
            <!-- /.col-lg-4 -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container -->
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
                    Be one of our Pyramids Members  <br />
                    and Enjoy our benefits !
                  </p>
                  <ul class="list-unstyled cta-one__list">
                    <li>
                      <i class="egypt-icon-check"></i>
                      Free Entries to the pyramids and Grand Egyptian Museum
                    </li>
                    <li>
                      <i class="egypt-icon-check"></i>
                      Enjoy a Free access to Childen Museum
                    </li>
                    <li>
                      <i class="egypt-icon-check"></i>
                      Subscription to Library
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
