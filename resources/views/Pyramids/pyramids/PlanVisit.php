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
          <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a></li>
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
        </ul>
        <div class="inner-container">
          <div class="tab-content">
            <div class="plan-visit__tab-main">
              <div class="row">
                <div class="col-lg-6">
                  <img src="./images/resources/visit-1.png" class="plan-visit__tab-main-image" alt="Awesome Image" />
                </div>
                <div class="col-lg-6">
                  <div class="plan-visit__content">

                    <!-- Opening Hours -->
                    <div class="plan-visit__single" id="open-hrs">
                      <div class="plan-visit__block-title">
                        <h3 class="plan-visit__block-title__title">
                          Pyramids Opening Hours
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
                        <span>Friday</span>: 9:00 – 17:00
                      </p>
                      <p class="plan-visit__text">
                        <span>Saturday until Thursday</span>: 8:00 – 17:00
                      </p>
                      <br />
                      <p class="plan-visit__text">
                        <span>
                          *We're closed
                          <a href="https://en.wikipedia.org/wiki/Eid_al-Adha" target="_blank">Eid Al-Adha,</a>
                          <a href="https://en.wikipedia.org/wiki/Eid_al-Fitr" target="_blank"> Eid Al-Fitr</a>
                          <a> & </a>
                          <a href="https://en.wikipedia.org/wiki/Christmas" target="_blank">Christmas.</a>
                        </span>
                      </p>
                    </div>

                    <!-- Admission Cost  -->
                    <div class="plan-visit__single" id="admission">
                      <div class="plan-visit__block-title">
                        <h3 class="plan-visit__block-title__title">
                          Admission Cost
                        </h3>
                      </div>
                      <h3 class="plan-visit__subtitle">Pyramids of Giza</h3>
                      <div class="plan-visit__price-carousel owl-carousel owl-theme" >

                        <!-- Area Entry -->
                        <div class="item">
                          <ul class="list-unstyled plan-visit__price-list">
                            <li>
                              <span style="font-weight: bold;">Area Entry:</span>
                            </li>
                              <?php 
                                $SelectVisitPrice = "SELECT visitpricing. *, userrole.RoleName AS UserRole , visitpricing.UserRole AS RoleID ,place.Name AS PlaceName FROM visitpricing 
                                                  JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                                  JOIN place ON visitpricing.PlaceID = place.ID 
                                                  WHERE PlaceID = 1 AND visitpricing.UserRole NOT IN (4 , 7)
                                                  ORDER BY visitpricing.ID DESC";
                                $RunQuery = mysqli_query($con , $SelectVisitPrice);
                                $VisitRow = mysqli_fetch_assoc($RunQuery);
                                foreach($RunQuery as $Visit){ ?>
                                  <li>
                                    <span><?php echo $Visit['UserRole']  ?> :</span>
                                    <span><?php echo $Visit['EntranceFee'] . " EGP" ?></span>
                                  </li>
                                <?php } ?>
                          </ul>
                          <p style="padding-left: 20px;"> Valid ID or Passport is a Must</p>
                        </div>

                        <!-- khufu Pyramid -->
                        <div class="item">
                          <ul class="list-unstyled plan-visit__price-list">
                            <li>
                              <span style="font-weight: bold;">Khufu Pyramid:</span>
                            </li>
                                  <li>
                                    <span>Egyptians :</span>
                                    <span> 100 EGP</span>
                                  </li>
                                  <li>
                                    <span>Egyptian Students:</span>
                                    <span> 50 EGP</span>
                                  </li>
                                  <li>
                                    <span>Foreginers :</span>
                                    <span> 440 EGP</span>
                                  </li>
                                  <li>
                                    <span>Foreginer Students:</span>
                                    <span> 220 EGP</span>
                                  </li>
                          </ul>
                          <p style="padding-left: 20px;"> Valid ID or Passport is a Must</p>
                        </div>

                        <!-- Khafre Pyramid -->
                        <div class="item">
                          <ul class="list-unstyled plan-visit__price-list">
                            <li>
                              <span style="font-weight: bold;">Khafre Pyramid:</span>
                            </li>
                                  <li>
                                    <span>Egyptians :</span>
                                    <span> 30 EGP</span>
                                  </li>
                                  <li>
                                    <span>Egyptian Students:</span>
                                    <span> 10 EGP</span>
                                  </li>
                                  <li>
                                    <span>Foreginers :</span>
                                    <span> 100 EGP</span>
                                  </li>
                                  <li>
                                    <span>Foreginer Students:</span>
                                    <span> 50 EGP</span>
                                  </li>
                          </ul>
                          <p style="padding-left: 20px;"> Valid ID or Passport is a Must</p>
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
                        Al Haram, Nazlet El-Semman,<br />
                        Al Giza Desert, Giza 3512201
                      </p>
                      <br />
                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.006641777741!2d31.13162697553705!3d29.979239121657272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584587ac8f291b%3A0x810c2f3fa2a52424!2sThe%20Great%20Pyramid%20of%20Giza!5e0!3m2!1sen!2seg!4v1685319609844!5m2!1sen!2seg" class="google-map__home" allowfullscreen ></iframe>
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
                                Dozens of different cuisines and luxury restaurants are located near the Egyptian pyramids.
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
                                Restrooms, family rooms, and accessible restrooms are located throughout the site.
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
                                Wheelchairs are available upon request, either through the amenities checklist on the tickets page or by requesting for one at the gate.
                              </p>
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
      </div>
    </section>

  <?php include "./UserFooterPyramids.php" ?>