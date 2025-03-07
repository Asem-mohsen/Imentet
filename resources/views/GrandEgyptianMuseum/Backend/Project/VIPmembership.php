<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();


$MembershipID =  filter_var($_GET['MembershipID'], FILTER_SANITIZE_NUMBER_INT);
  if(empty($MembershipID)){
    header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php");
  }

  $SelectMembership = "SELECT membership.* ,  membershipperiod.Period AS PeriodTime  FROM membership
  JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
  WHERE membership.ID = $MembershipID";
  $RunQuery = mysqli_query($con , $SelectMembership);
  $MembershipRow = mysqli_fetch_assoc($RunQuery);

  $PageTitle = $MembershipRow['Type'];


  if($MembershipID != $MembershipRow['ID']){
    header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/membership.php");
  }else{
    if(isset($_SESSION['UserID'])){
      $UserID = $_SESSION['UserID'];
      $SelectUser = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
      $RunQuery = mysqli_query($con , $SelectUser);
      $User = mysqli_fetch_assoc($RunQuery);
    
      $FullName = $User['Name'] . " " . $User['LastName']; 
    
      $SelectEnrolled = "SELECT membershippayemnts.* , membership.Type AS Type FROM `membershippayemnts`
                        JOIN membership ON membershippayemnts.MembershipID = membership.ID
                        WHERE UserID = $UserID LIMIT 1 ";
      $EnrolledRun = mysqli_query($con , $SelectEnrolled);
      $Enrolled = mysqli_fetch_assoc($EnrolledRun);
      $Count = mysqli_num_rows($EnrolledRun);
    
      // Deleting Membership when It ends 
      $TodaysDate = date('Y-m-d');
      if(isset($Enrolled['EndsIn']) < $TodaysDate){
        $DeleteMembership = "DELETE FROM membershippayemnts WHERE UserID = $UserID ";
        $DeleteRun = mysqli_query($con, $DeleteMembership);
      }
    }
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
                            <p class="pricing-one__amount"></p>
                            <p class="pricing-one__time"> Year </p>
                            </div>
                        </div>
                        </div>             
                        <div class="event-details__single" id="about-event">
                            <h3 class="event-details__title">Details About Plan</h3>
                        <p class="event-details__text">
                            This Membership is created for our supporters who have been
                            Donated by 1 Millon LE or Higher as an expression of gratitude
                            to them
                        </p>
                        <p class="event-details__text">
                            We Can't thank you enough but we can offer you a lot of benefits
                            that you will enjoy by this Membership.  
                        </p>
                        <br>
                        <h3 class="collection-details__subtitle">Plan Benefits</h3>
                            <br>
                            <ul class="collection-details__list list-unstyled">
                                <li>
                                    <?php if($MembershipRow['Entry'] == 0 ){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Free Limited Admission Entry" ;
                                        }else{
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Unlimited Admission Entry" ;
                                        } 
                                    ?>
                                </li>
                                <li>
                                    <?php if($MembershipRow['DiscountGiftShop'] == 1 ){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Discounts in Museum Gift Shop Purchases" ;   
                                        }
                                    ?>
                                </li>
                                <li>
                                    <?php
                                    if($MembershipRow['ChildernMuseum'] == 1 ){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Access to The GEM Children Museum" ;   
                                    }
                                ?>
                                </li>
                                <li>
                                    <?php
                                        if($MembershipRow['DiscountParking'] == 1){ 
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo "Discounted Parking" ;   
                                        }
                                    ?>
                                </li>
                                <li>
                                    <?php
                                    if($MembershipRow['VouchersMuseum'] == 1){ 
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo "Voucher in Restaurants" ; 
                                    }
                                ?>
                                </li>
                                <li>
                                    <?php
                                        if($MembershipRow['AccessMuseumLib'] == 1){ 
                                                echo "<i class='egypt-icon-check'></i>";
                                                echo "Free Access to the GEM Library" ; 
                                        }  
                                    ?>
                                </li>
                                <li>
                                <?php
                                    if($MembershipRow['SpecialExhibtions'] == 1 ){ 
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo "Special Exhibition Screening" ;   
                                    }
                                    ?>
                                </li>
                                <li>
                                <?php
                                    if($MembershipRow['MembersNewsletter'] == 1 ){ 
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo "Exclusive Member's Newsletter" ;   
                                    }
                                    ?>
                                </li>
                                <li>
                                <?php
                                    if($MembershipRow['InvatationsToActivites'] == 1 ){ 
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo "Invitations to activities day in GEM" ;   
                                    }
                                    ?>
                                </li>
                                <li>
                                <?php
                                    if($MembershipRow['AccessToEvents'] == 1 ){ 
                                        echo "<i class='egypt-icon-check'></i>";
                                        echo "Members-only Events" ;   
                                    }
                                    ?>
                                </li>
                                <li>
                                    <?php
                                        if($MembershipRow['PriorityAccessToEvents'] == 1 ){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Priority Access to Special Events" ;   
                                        }
                                    ?>
                                </li>
                                <li>
                                    <?php
                                        if($MembershipRow['StudentsEvents'] == 1 ){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Exclusive Student Events" ;   
                                        }
                                    ?>
                                </li>
                                <li>
                                    <?php
                                        if($MembershipRow['AccessHologram'] == 1 ){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Access to Tutankhamon Hologram" ;   
                                        }
                                    ?>
                                </li>
                                <li>
                                    <?php
                                        if($MembershipRow['AccessTutankhamun'] == 1 ){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Access to Tutankhamon Museum" ;   
                                        }
                                    ?>
                                </li>
                                <li>
                                    <?php
                                        if($MembershipRow['AccessToMonuments'] == 1 ){ 
                                            echo "<i class='egypt-icon-check'></i>";
                                            echo "Access to Exclusive Monuments" ;   
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
                    <h3 class="event-details__form-title">Membership</h3>
                    <form method="post">
                    <?php 
                        
                        if(isset($Count) > 0 && isset($Enrolled['UserID'])){ ?>
                            <div class="row">
                            <div class="col-sm-12">
                                <p>You have been Added to <?php echo $Enrolled['Type'] ?> Membership</p>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Started At</label>
                                <input type="text" value="<?php echo date('d M - Y' , strtotime($Enrolled['Date'])) ; ?>" disabled/>
                            </div>
                            <div class="col-sm-6">
                                <label for="">Ends At</label>
                                <input type="text" value="<?php echo date('d M - Y' , strtotime($Enrolled['EndsIn'])) ; ?>" disabled/>
                            </div>
                            <div class="col-sm-12">
                                <button class="thm-btn event-details__form-btn" disabled>
                                We are truly grateful
                                </button>
                            </div>
                            </div>
                        <?php } ?>
                    </form>
                </div>
                </div>
            </div>
            </div>
        </section>
  <?php } ?>
    <?php include "../UserFooter.php"; ?>