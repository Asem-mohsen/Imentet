<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Plan Your Visit";
?>

  <?php include "./NavUserPyramids.php"; ?>

      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title">Plan Your Visit</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/pyramids.php">Home</a></li>
            <li>Visit</li>
          </ul>
        </div>
      </section>
      
      <section class="plan-visit">
        <div class="container">
          <ul class="nav nav-tabs plan-visit__tab-links">
            <li class="nav-item">
              <a href="#open-hrs" data-target="#open-hrs" class="nav-link active">Opening Hours</a>
            </li>
            <li class="nav-item">
              <a href="#admission" data-target="#admission" class="nav-link" >Admission Cost</a>
            </li>
            <li class="nav-item">
              <a href="#how-to-get" data-target="#how-to-get" class="nav-link">Get Here</a>
            </li>
            <li class="nav-item">
              <a href="#anenities" data-target="#amenities" class="nav-link">Amenities</a>
            </li>
            <li class="nav-item">
              <a href="#interior" data-target="#interior" class="nav-link">Interior Map</a>
            </li>
          </ul>
          <div class="inner-container">
            <div class="tab-content">
              <div class="plan-visit__tab-main">
                <div class="row">
                  <div class="col-lg-6">
                    <img src="images/resources/visit-1-1.jpg" class="plan-visit__tab-main-image" alt="Awesome Image" />
                  </div>
                  <div class="col-lg-6">
                    <div class="plan-visit__content">

                      <!-- Opening Hours -->
                      <div class="plan-visit__single" id="open-hrs">
                        <div class="plan-visit__block-title">
                          <h3 class="plan-visit__block-title__title">
                            Museum Opening Hours
                          </h3>
                        </div>
                        <h3 class="plan-visit__subtitle">Pyramids Hours</h3>
                        <p class="plan-visit__text">
                          <span>Friday</span>: 11:30 – 21:00
                        </p>
                        <p class="plan-visit__text">
                          <span>Saturday until Thursday</span>: 09:00 – 20:00
                        </p>
                        <br />
                        <h3 class="plan-visit__subtitle">Pyramids Store Hours</h3>
                        <p class="plan-visit__text">
                          <span>Friday</span>: 12:00 – 20:00
                        </p>
                        <p class="plan-visit__text">
                          <span>Saturday until Thursday</span>: 10:00 – 19:00
                        </p>
                        <br />
                      </div>

                      <!-- Admission Cost  -->
                      <div class="plan-visit__single" id="admission">
                        <div class="plan-visit__block-title">
                          <h3 class="plan-visit__block-title__title">
                            Admission Cost
                          </h3>
                        </div>
                        <h3 class="plan-visit__subtitle">General Visit</h3>
                        <div class="plan-visit__price-carousel owl-carousel owl-theme" >
                          <div class="item">
                            <ul class="list-unstyled plan-visit__price-list">
                                <?php 
                                  $SelectVisitPrice = "SELECT visitpricing. *, userrole.RoleName AS UserRole , visitpricing.UserRole AS RoleID ,place.Name AS PlaceName FROM visitpricing 
                                                    JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                                    JOIN place ON visitpricing.PlaceID = place.ID 
                                                    WHERE PlaceID = 1 AND UserRole != 2 AND UserRole != 3 
                                                    ORDER BY visitpricing.ID DESC";
                                  $RunQuery = mysqli_query($con , $SelectVisitPrice);
                                  $VisitRow = mysqli_fetch_assoc($RunQuery);
                                  foreach($RunQuery as $Visit){ ?>
                                    <li>
                                      <span><?php echo $Visit['UserRole']  ?> :</span>
                                      <span><?php echo $Visit['EntranceFee'] . "$" ?></span>
                                    </li>
                                  <?php } ?>
                            </ul>
                            <p style="padding-left: 20px;"> Valid ID or Passport is Must</p>
                          </div>
                          <div class="item">
                            <ul class="list-unstyled plan-visit__price-list">
                                <?php 
                                  $SelectVisitPrice = "SELECT visitpricing. *, userrole.RoleName AS UserRole , visitpricing.UserRole AS RoleID ,place.Name AS PlaceName FROM visitpricing 
                                              JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                              JOIN place ON visitpricing.PlaceID = place.ID 
                                              WHERE PlaceID = 1 AND UserRole != 1 AND UserRole != 5 ";
                                  $RunQuery = mysqli_query($con , $SelectVisitPrice);
                                  $VisitRow = mysqli_fetch_assoc($RunQuery);
                                  foreach($RunQuery as $VisitForegin){ ?>
                                    <li>
                                      <span><?php echo $VisitForegin['UserRole']  ?> :</span>
                                      <span><?php echo $VisitForegin['EntranceFee'] . "$" ?></span>
                                    </li>
                                <?php } ?>
                            </ul>
                            <p style="padding-left: 20px;"> Valid ID or Passport is Must</p>
                          </div>
                        </div>
                        <br />
                      </div>

                      <!-- How to Get Here  -->
                      <div class="plan-visit__single plan-visit__address" id="how-to-get">
                        <div class="plan-visit__block-title">
                          <h3 class="plan-visit__block-title__title">
                            How to Get Here
                          </h3>
                        </div>
                        <h3 class="plan-visit__subtitle">Address</h3>
                        <p class="plan-visit__text">
                          Grang Egyptian Museum, Alexandria Desert Rd,<br />
                          Haram, Giza Governorate X4VF+V3F
                        </p>
                        <br />
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13821.875835399496!2d31.122688!3d29.994688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584534984a8ad1%3A0x45764c5bc4ec261a!2sGrand%20Egyptian%20Museum!5e0!3m2!1sen!2seg!4v1681483362521!5m2!1sen!2seg" class="google-map__home" allowfullscreen ></iframe>
                        <br />
                        <div class="row">
                          <div class="col-md-6">
                            <p class="plan-visit__text">
                              <span>Metro:</span> <br />
                              Line 4 Metro
                            </p>
                          </div>
                          <div class="col-md-6">
                            <p class="plan-visit__text">
                              <span>Bus:</span> <br />
                              From Tahrir Square G12 & B14
                            </p>
                          </div>
                          <div class="col-md-6">
                            <p class="plan-visit__text">
                              <span>Electric Train:</span> <br />
                              Monorail
                            </p>
                          </div>
                          <div class="col-md-6">
                            <p class="plan-visit__text">
                              <span>Bike & Car:</span> <br />
                              GEM City & Parking at Museum
                            </p>
                          </div>
                        </div>
                      </div>
                      
                      <!-- Amentities -->
                      <div class="plan-visit__single" id="amenities">
                        <div class="plan-visit__block-title">
                          <h3 class="plan-visit__block-title__title">
                            Amenities
                          </h3>
                        </div>
                        <div class="accrodion-grp" data-grp-name="plan-visit__accrodion">
                          <div class="accrodion active">
                            <div class="accrodion-title">
                              <h4>Dining</h4>
                            </div>
                            <div class="accrodion-content">
                              <div class="inner">
                                <p>
                                  Dining is Only Available in designated areas (Food Court), In order to preserve the
                                  cleanliness of the Museum  
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="accrodion">
                            <div class="accrodion-title">
                              <h4>Restrooms</h4>
                            </div>
                            <div class="accrodion-content">
                              <div class="inner">
                                <p>
                                  There are More than 16 different Restroom 
                                  distrbuited in the Museum area to serve you.
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="accrodion">
                            <div class="accrodion-title">
                              <h4>Internet Access</h4>
                            </div>
                            <div class="accrodion-content">
                              <div class="inner">
                                <p>
                                  We Offer a free access to the internet and wireless network 5g in the Museum, Sponsored 
                                  by Vodafone Egypt
                                </p>
                              </div>
                            </div>
                          </div>
                          <div class="accrodion">
                            <div class="accrodion-title">
                              <h4>Wheelchairs</h4>
                            </div>
                            <div class="accrodion-content">
                              <div class="inner">
                                <p>
                                  For Seniors and Disabilities, for the best stay and experience
                                  no need for previous booking 
                                </p>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Museum Interior -->
                      <div class="plan-visit__single" id="interior">
                        <div class="plan-visit__block-title">
                          <h3 class="plan-visit__block-title__title">
                            Pyramids Interior
                          </h3>
                        </div>
                        <ul class="nav nav-tabs plan-visit__map-tab-links" role="tablist" >
                          <li class="nav-item">
                            <a role="tab" data-toggle="tab" href="#first-floor" class="nav-link active">Main Museum</a>
                          </li>
                          <li class="nav-item">
                            <a role="tab" data-toggle="tab"  href="#second-floor" class="nav-link">Commercial Area</a>
                          </li>
                          <li class="nav-item">
                            <a role="tab" data-toggle="tab" href="#third-floor" class="nav-link">Third Floor</a>
                          </li>
                        </ul>
                        <div class="tab-content">
                          <div class="tab-pane animated fadeInUp show active" id="first-floor">
                            <div class="plan-visit__map-content">
                              <img class="img-fluid" src="images/resources/int-map.jpg"  alt="Awesome Image" />
                            </div>
                          </div>
                          <div class="tab-pane animated fadeInUp" id="second-floor">
                            <div class="plan-visit__map-content">
                              <img class="img-fluid" src="images/resources/int-map.jpg"  alt="Awesome Image" />
                            </div>
                          </div>
                          <div class="tab-pane animated fadeInUp" id="third-floor">
                            <div class="plan-visit__map-content">
                              <img class="img-fluid" src="images/resources/int-map.jpg"  alt="Awesome Image" />
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
 
  <?php include "./UserFooterPyramids.php" ?>