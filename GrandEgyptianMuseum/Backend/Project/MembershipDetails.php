<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();



if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];
  $SelectUser = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
  $RunQuery = mysqli_query($con , $SelectUser);
  $User = mysqli_fetch_assoc($RunQuery);

  $FullName = $User['Name'] . " " . $User['LastName']; 
}
if(isset($_POST['JoinUs'])){

  $SelectUsers = "SELECT membershippayemnts .* , COUNT(UserID) AS CountedUsers FROM `membershippayemnts`  WHERE UserID = $UserID";
  $Query = mysqli_query($con , $SelectUsers);
  $CountedRow = mysqli_fetch_assoc($Query);

  $date = date('y-m-d');
  $EndDate = date('Y-m-d', strtotime($date. ' +1 month'));
  
  if($CountedRow['CountedUsers'] < 1){
      $UserID = $_POST['UserID'];
      $MembershipID = $_POST['MembershipID']; 
      $PaymentID = 1;
      $Cost = $_POST['Cost'];

      

      $InsertDonate = "INSERT INTO `membershippayemnts`  VALUES( NULL , $UserID , $MembershipID , $Cost , $PaymentID , now() , '$EndDate' ) ";
      $InsertQuery = mysqli_query($con , $InsertDonate);
      if($InsertQuery){
          echo "<div class='alert alert-success'>";
              echo "You are joined ";
          echo "</div>";
      }else{
          echo "not yet";
      }
  }else{
      echo "Already Enrolled Your membership will ends in " . $EndDate;
  }
}

  $MembershipID = $_GET['MembershipID'];
  $SelectMembership = "SELECT membership.* ,  membershipperiod.Period AS PeriodTime  FROM membership
  JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
  WHERE membership.ID != 12 AND membership.ID != 13 AND membership.ID = $MembershipID";
  $RunQuery = mysqli_query($con , $SelectMembership);
  $MembershipRow = mysqli_fetch_assoc($RunQuery);

  $PageTitle = $MembershipRow['Type'];

  $MembershipID =  filter_var($_GET['MembershipID'], FILTER_SANITIZE_NUMBER_INT);
  if(empty($MembershipID)){
      header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php");
  }else{
    ?>
    <?php include "../NavUser.php" ; ?>

      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title">Membership Subscription</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Home</a></li>
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/membership.php">Membership</a></li>
            <li><?php echo $MembershipRow['Type'] . " Membership" ?></li>
          </ul>
        </div>
      </section>

      <section class="event-details">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="event-details__content">   
                <div class="event-details__single" id="about-event">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="pricing-one__single wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                          <p class="pricing-one__name">Plan</p>
                          <h3 class="pricing-one__type">For <?php echo $MembershipRow['Type'] ?></h3>
                          <p class="pricing-one__amount"><?php echo $MembershipRow['Price'] ?></p>
                          <p class="pricing-one__time"> LE / Month</p>
                        </div>
                      </div>
                    </div>             
                    <div class="event-details__single" id="about-event">
                        <h3 class="event-details__title">Details About Plan</h3>
                      <p class="event-details__text">
                        Equal blame belongs to those who fail in their duty through
                        weakness of will, which is the same as saying through
                        shrinking from toil and pain.
                      </p>
                      <p class="event-details__text">
                        These cases are perfectly simple and easy to distinguish. In
                        a free hour, when our power of choice is untrammelled and
                        when nothing every pleasure is to be welcomed and every pain
                        avoided. But in cer- tain circumstances and owing to the
                        claims of duty or the obligations of business.
                      </p>
                      <br>
                      <h3 class="collection-details__subtitle">Plan Benefits</h3>
                        <br>
                        <ul class="collection-details__list list-unstyled">
                            <li>
                                <?php if($MembershipRow['Entry'] == 0 ){ 
                                          echo "<i class='egypt-icon-check'></i>";
                                          echo "Unlimited Entry" ;
                                      }else{
                                          echo "<i class='egypt-icon-check'></i>";
                                          echo "Free entry for ".$MembershipRow['Entry'] . " times per Month" ;
                                      } 
                                  ?>
                            </li>
                            <li>
                                <?php if($MembershipRow['DiscountOnTours'] == 1 ){ 
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo "Discounts on tours conducted by team hospitality" ;   
                                    }elseif($MembershipRow['DiscountOnTours'] > 1){
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo $MembershipRow['DiscountOnTours'] . " Discounts on tours conducted by team hospitality" ;                                                       
                                    } 
                                ?>
                            </li>
                            <li>
                                <?php
                                  if($MembershipRow['ChildernMuseum'] == 1 ){ 
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo "Free Access To Childern Museum" ;   
                                  }elseif($MembershipRow['ChildernMuseum'] > 1){
                                      echo "<i class='egypt-icon-check'></i>";
                                      echo $MembershipRow['ChildernMuseum'] . " Free Entries to Childern Museum " ;
                                  }
                              ?>
                            </li>
                            <li>
                                <?php
                                    if($MembershipRow['DiscountOnKidsClasses'] == 1){ 
                                      echo "<i class='egypt-icon-check'></i>";
                                      echo "Discounts on Kid's Historical Classes & Activities" ;   
                                    }
                                ?>
                            </li>
                            <li>
                                <?php
                                  if($MembershipRow['SubsMuseumLib'] == 1){ 
                                    echo "<i class='egypt-icon-check'></i>";
                                    echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                  }
                              ?>
                            </li>
                            <li>
                                <?php
                                    if($MembershipRow['AccessMuseumLib'] == 1){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Access to The Grand Egyptian Museum Library" ; 
                                    }  
                                ?>
                            </li>
                            <li>
                              <?php
                                  if($MembershipRow['AccessKidsArea'] == 1 ){ 
                                    echo "<i class='egypt-icon-check'></i>";
                                    echo "Free Access to Kids Area" ;   
                                  }
                                ?>
                            </li>
                        </ul>
                    </div>
                  </div>
              </div>
            </div>

            <!-- Payment -->
            <div class="col-lg-4">
              <div class="event-details__form">
                <h3 class="event-details__form-title">Membership Payement</h3>
                <form method="post">
                  <div class="row">
                    <div class="col-sm-12">
                      <input type="hidden" name="UserID" value="<?php if(isset($UserID)){ echo $UserID ; } ?>" />
                      <input type="hidden" name="MembershipID" value="<?php echo $MembershipID ;  ?>" />
                      <input type="hidden" name="Cost" value="<?php echo $MembershipRow['Price'] ;  ?>" />
                      <input type="text" name="Name" placeholder="Your Name" value="<?php if(isset($FullName)){ echo $FullName ; } ?>"/>
                    </div>
                    <div class="col-sm-12">
                      <input type="text" name="Email" placeholder="Email Address" value="<?php if(isset($User['Email'])){ echo $User['Email'] ; } ?>"/>
                    </div>
                    <div class="col-sm-12">
                      <?php if(isset($UserID)){ ?>
                          <button type="submit" name="JoinUs" class="thm-btn event-details__form-btn" >
                          Proceed to Book
                        </button>
                      <?php }else{ ?>
                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php" class="thm-btn event-details__form-btn" >
                          Sign In to Continue
                        </a>
                      <?php } ?>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
  <?php } ?>
    <?php include "../UserFooter.php"; ?>