<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Donation";
if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];
  $SelectUser = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
  $RunQuery = mysqli_query($con , $SelectUser);
  $User = mysqli_fetch_assoc($RunQuery);

  $FullName = $User['Name'] . " " . $User['LastName']; 
}

?>


  <?php include "../NavUser.php" ?>

      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title">Donations</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php">Home</a></li>
            <li>Donations</li>
          </ul>
        </div>
      </section>

      <!-- Donate -->
      <section class="cta-one cta-one__donation-page">
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-12">
              <div class="cta-one__block">
                <div class="cta-one__icon">
                  <i class="egypt-icon-gift"></i>
                </div>
                <div class="cta-one__content">
                  <h3 class="cta-one__title">
                    Donate for <br />
                    Achive Our Goal
                  </h3>
                  <p class="cta-one__text">
                    Thank you for considering giving to the museum. Your gift
                    <br />
                    will allow future generations to discover.
                  </p>
                  <p class="cta-one__text">
                    <span>Ways to Contribute to Our Museum:</span>
                  </p>
                  <ul class="list-unstyled cta-one__list">
                    <li>
                      <i class="egypt-icon-check"></i>
                      Financial Donation
                    </li>
                    <li>
                      <i class="egypt-icon-check"></i>
                      Donate the Historical Artifacts
                    </li>
                  </ul>
                  <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/contact.php" class="cta-one__link">
                    <i class="fa fa-angle-right"></i>
                    Questions ? Contact Us Now </a>
                </div>
              </div>
            </div>
            <div class="col-xl-6 col-lg-12">
              <img src="images/resources/donation-1.png" alt="" class="img-fluid" />
            </div>
          </div>
        </div>
      </section>

      <!-- Donate Section Form -->
      <section class="donation-form">
        <div class="container">

          <div class="inner-container">
            <h3 class="donation-form__title text-center">Make a Donation</h3>
            <ul class="nav nav-tabs donation-form__tab">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab">
                  Financial Donation
                </a>
              </li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane show active animated fadeInUp" id="money">
                <form method='POST' action="./Payment.php?Donations" class="donation-form__form">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="donation-form__form-field">
                        <input type="text" name="Name" placeholder="Your Full Name*" value="<?php if(isset($FullName)){ echo $FullName ;} ?>" required/>
                        <input type="hidden" name="UserID" placeholder="Your Full Name*" value="<?php if(isset($_SESSION['UserID'])){ echo $UserID ; } ?>"/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="donation-form__form-field">
                        <input type="email" name="Email" placeholder="Email Address*" value="<?php if(isset($User['Email'])){ echo $User['Email'] ;} ?>" required />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="donation-form__form-field">
                        <input type="number" name="Phone" pattern="[0-9]*" placeholder="Phone Number" value="<?php if(isset($User['Phone']) && $User['Phone'] != 0 ){ echo $User['Phone'] ;} ?>" />
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="donation-form__form-field">
                        <input type="number" name="Amount" placeholder="$ Custom Amount" required/>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="donation-form__form-field">
                        <select class="selectpicker" name="Place">
                          <option value="0">Donation For</option>
                          <?php
                           $SelectPlace = "SELECT * FROM place";
                            $RunQuery = mysqli_query($con , $SelectPlace);
                            $row = mysqli_fetch_assoc($RunQuery);
                            foreach($RunQuery as $Place){ ?>
                                <option value="<?php echo $Place['ID'] ?>"><?php echo $Place['Name'] ?></option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-lg-12">
                      <div class="text-center">
                        <button type="submit" name="Donate" class="thm-btn donation-form__form-btn" >
                          Make Donation
                        </button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Donated Successed -->
      <?php if(isset($_GET['DonatedDone'])){ ?>
        <div id="success" class="modal fade" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="success-content-message">
                  <i class="fa fa-check"></i>
                  <h2>success</h2>
                  <p>Your support helps us Improveing our services, Much Obliged for being a part of our Supporters. </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php  }elseif(isset($_GET['DonateWithMembership'])){ ?>
        <div id="success" class="modal fade" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <button  type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="success-content-message">
                  <i class="fa fa-check"></i>
                  <h2>success</h2>
                  <p> You have donated a very large amount of money, and in order to show gratitude and thanks
                        , you have been added to Our Membership Plan 
                        <a href='http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/VIPmembership.php?MembershipID=12'> Supporting Membership </a> , Check Your Email For More Details. </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

  <?php include "../UserFooter.php" ; ?>

  <script>
    jQuery(window).load(function () {
      jQuery("#success").modal("show");
    });
  </script>
