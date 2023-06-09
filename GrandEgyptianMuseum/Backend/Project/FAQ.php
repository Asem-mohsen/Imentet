<?php 
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "FAQ";

if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];
  $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
  $Select = mysqli_query($con, $SelectQuery);
  $row = mysqli_fetch_assoc($Select);
}
if(isset($_SESSION['AdminID'])){
  $AdminID = $_SESSION['AdminID'];
}

include "../NavUser.php";
?>
      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title">FAQ's</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Home</a></li>
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php">About</a></li>
            <li>FAQ's</li>
          </ul>
        </div>
      </section>

      <section class="faq-page">
        <div class="container">
          <div class="row">
            <div class="col-lg-3">
              <ul class="nav nav-tabs faq-page__links">
                <li class="nav-item">
                  <a data-toggle="tab" href="#manage" class="nav-link active"
                    >Management</a
                  >
                </li>
                <li class="nav-item">
                  <a data-toggle="tab" href="#museum" class="nav-link"
                    >Museum</a
                  >
                </li>
                <li class="nav-item">
                  <a data-toggle="tab" href="#memebership" class="nav-link"
                    >Membership</a
                  >
                </li>
                <li class="nav-item">
                  <a data-toggle="tab" href="#donation" class="nav-link"
                    >Donation</a
                  >
                </li>
                <li class="nav-item">
                  <a data-toggle="tab" href="#exhibhition" class="nav-link"
                    >Exhibition</a
                  >
                </li>
              </ul>
              <!-- /.faq-page__links nav nav-tabs -->
            </div>
            <!-- /.col-lg-3 -->
            <div class="col-lg-9">
              <div class="tab-content">
                <div
                  class="tab-pane show active animated fadeInRight"
                  id="manage"
                >
                  <div
                    class="accrodion-grp"
                    data-grp-name="faq-page__accrodion"
                  >
                    <div class="accrodion active">
                      <div class="accrodion-title">
                        <h4>How much does Museum admission cost?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          What are the Library hours, and do I need an
                          appointment?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Can I call to book tickets if I'm visiting today?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>What is the best time to visit the Museum?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Does my admission to the Museum also give me access to
                          Egypt Garden?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          How do I get to the Museum by car, bus, or subway?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /#manage.tab-pane show active animated fadeInRight -->
                <div class="tab-pane animated fadeInRight" id="museum">
                  <div
                    class="accrodion-grp"
                    data-grp-name="faq-page__accrodion"
                  >
                    <div class="accrodion active">
                      <div class="accrodion-title">
                        <h4>How much does Museum admission cost?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          What are the Library hours, and do I need an
                          appointment?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Can I call to book tickets if I'm visiting today?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>What is the best time to visit the Museum?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Does my admission to the Museum also give me access to
                          Egypt Garden?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          How do I get to the Museum by car, bus, or subway?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /#museum.tab-pane animated fadeInRight -->
                <div class="tab-pane animated fadeInRight" id="memebership">
                  <div
                    class="accrodion-grp"
                    data-grp-name="faq-page__accrodion"
                  >
                    <div class="accrodion active">
                      <div class="accrodion-title">
                        <h4>How much does Museum admission cost?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          What are the Library hours, and do I need an
                          appointment?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Can I call to book tickets if I'm visiting today?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>What is the best time to visit the Museum?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Does my admission to the Museum also give me access to
                          Egypt Garden?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          How do I get to the Museum by car, bus, or subway?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /#memebership.tab-pane animated fadeInRight -->
                <div class="tab-pane animated fadeInRight" id="donation">
                  <div
                    class="accrodion-grp"
                    data-grp-name="faq-page__accrodion"
                  >
                    <div class="accrodion active">
                      <div class="accrodion-title">
                        <h4>How much does Museum admission cost?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          What are the Library hours, and do I need an
                          appointment?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Can I call to book tickets if I'm visiting today?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>What is the best time to visit the Museum?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Does my admission to the Museum also give me access to
                          Egypt Garden?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          How do I get to the Museum by car, bus, or subway?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /#donation.tab-pane animated fadeInRight -->
                <div class="tab-pane animated fadeInRight" id="exhibhition">
                  <div
                    class="accrodion-grp"
                    data-grp-name="faq-page__accrodion"
                  >
                    <div class="accrodion active">
                      <div class="accrodion-title">
                        <h4>How much does Museum admission cost?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          What are the Library hours, and do I need an
                          appointment?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Can I call to book tickets if I'm visiting today?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>What is the best time to visit the Museum?</h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          Does my admission to the Museum also give me access to
                          Egypt Garden?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
                          </p>
                        </div>
                        <!-- /.inner -->
                      </div>
                    </div>
                    <div class="accrodion">
                      <div class="accrodion-title">
                        <h4>
                          How do I get to the Museum by car, bus, or subway?
                        </h4>
                      </div>
                      <div class="accrodion-content">
                        <div class="inner">
                          <p>
                            We denounce with righteous indignation and dislike
                            men who are so beguiled and demoralized by the
                            charms of pleasure of the moment, so blinded by
                            desire foresee.
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
      </section>


  <?php  include "../UserFooter.php"; ?>
