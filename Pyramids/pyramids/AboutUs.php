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

    <?php include "./NavUserPyramids.php" ; ?>

      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title">About Pyramids</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/pyramids.php">Home</a></li>
            <li>The Pyramids</li>
          </ul>
        </div>
      </section>

      <!-- About Our Time -->
      <section class="about-three">
        <div class="container">
          <div class="block-title text-center">
            <p class="block-title__tag-line">About Us</p>
            <h2 class="block-title__title">
              The Pyramids: <br />
              Standing Tall as One of the Seven <br />
              Wonders of the World
            </h2>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="about-three__content">
              <h3 class="about-three__content-title">Built around 2580-2560 BCE</h3>
                <p class="about-three__content-text">
                  The pyramids of Egypt have a rich and fascinating history that dates back over 4,500 years.
                  These monumental structures were built as tombs for the pharaohs, 
                  the ancient Egyptian kings, who believed in an afterlife and wanted to ensure their eternal journey. <br />
                  The construction of pyramids began during the Old Kingdom period, with the Step Pyramid of Djoser being the first major pyramid built by the architect Imhotep. <br />
                </p>
                <a href="file:///Users/rawansakr/Desktop/Cover%20Letter%20for%20UX%20researched%20Position.pdf" class="about-three__content-link">
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
                      <a href="http://localhost/imentet-1/Pyramids/pyramids/Careers.php" class="department-one__carrer-link"
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
            <!-- /.video-two__title -->
            <p class="video-two__tag-line">Since 1969</p>
            <!-- /.video-two__tag-line -->
          </div>
          <!-- /.inner-container -->
        </div>
        <!-- /.container -->
      </section>

      <br>
      <br>
      <br>

    <?php include "./UserFooterPyramids.php" ; ?>