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
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a></li>
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
                    <a data-toggle="tab" href="#year-1" role="tab" class="nav-link active">Khufu</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-2" role="tab" class="nav-link">Khafre</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-3" role="tab" class="nav-link">Menkaure</a>
                  </li>
                  <li class="nav-item">
                    <a data-toggle="tab" href="#year-4" role="tab" class="nav-link">Sphinx</a>
                  </li>
                </ul>
                <div class="tab-content">
                  <div class="tab-pane animated fadeInUp show active" id="year-1">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        The Great Pyramid of Khufu (also known as the Pyramid of Cheops) was built around 2560 BC.
                      </p>
                      <a href="https://en.wikipedia.org/wiki/Egyptian_pyramids" target="_blank"  class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-2">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        The Pyramid of Khafre (also known as the Pyramid of Chephren) was built around 2530 BC.
                      </p>
                      <a href="https://en.wikipedia.org/wiki/Egyptian_pyramids" target="_blank"  class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-3">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        The Pyramid of Menkaure was built around 2510 BC..
                      </p>
                      <a href="https://en.wikipedia.org/wiki/Egyptian_pyramids" target="_blank"  class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                  <div class="tab-pane animated fadeInUp" id="year-4">
                    <div class="about-three__tab-content">
                      <p class="about-three__tab-text">
                        The Great Sphinx of Giza is believed to have been constructed during the reign of the Pharaoh Khafre, around 2500 BC.
                      </p>
                      <a href="https://en.wikipedia.org/wiki/Egyptian_pyramids" target="_blank"  class="about-three__tab-link">Read Full story <span>+</span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- Video -->
      <section class="video-two" style="background: #302e2f;">
        <div class="container">
          <div class="inner-container wow fadeInUp" data-wow-duration="1500ms">
            <a href="https://www.youtube.com/watch?v=hO1tzmi1V5g"  class="video-popup video-two__btn">
              <i class="egypt-icon-circular"></i>
            </a>
            <h3 class="video-two__title">
              Great Art and Great Art Experiences
            </h3>
            <p class="video-two__tag-line">2580 BC</p>
          </div>
        </div>
      </section>

    
      <section class="team-one" style="background-color: #302e2f;">
      </section>

    <?php include "./UserFooterPyramids.php" ; ?>