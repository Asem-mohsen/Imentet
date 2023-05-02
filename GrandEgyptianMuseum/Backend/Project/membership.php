<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Membership";

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

  <?php include "../NavUser.php" ;?>
        
        <!-- Become a Member Section -->
        <section class="cta-one cta-one__membership-page">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-12">
                        <div class="cta-one__block">
                            <div class="cta-one__icon">
                                <i class="egypt-icon-membership"></i>
                            </div>
                            <div class="cta-one__content">
                                <h3 class="cta-one__title">Become a <br>
                                    Member of Egypt</h3>
                                <p class="cta-one__text">Museum Members provide essential funding for us and <br> receive great
                                    benefits in return!</p>
                                <ul class="list-unstyled cta-one__list">
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                        Free Tickets to Special Exhibitions
                                    </li>
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                        Members-only exhibition previews & events
                                    </li>
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                        Access to a Member Entrance
                                    </li>
                                </ul>
                                <a href="" class="cta-one__link">
                                    <i class="fa fa-angle-right"></i>
                                    Become a Member
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <img src="images/resources/contact-1-1.jpeg" alt="" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Membership Options -->
        <section class="pricing-one">
            <div class="container">
                <div class="row">
                  <?php 
                  $SelectMembership = "SELECT membership.* ,  membershipperiod.Period AS PeriodTime  FROM membership
                                        JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
                                        WHERE membership.ID != 12 AND membership.ID != 13";
                  $RunQuery = mysqli_query($con , $SelectMembership);
                  $MembershipRow = mysqli_fetch_assoc($RunQuery);
                  foreach($RunQuery as $Membership){ ?>
                      <div class="col-lg-3 col-md-6">
                        <div class="pricing-one__single wow fadeInUp" data-wow-duration="1500ms" data-wow-delay="000ms">
                            <p class="pricing-one__name">Plan</p>
                            <h3 class="pricing-one__type"><?php echo $Membership['Type'] ?></h3>
                            <p class="pricing-one__amount"><?php echo $Membership['Price'] ?></p>
                            <p class="pricing-one__time">$ / <?php echo $Membership['PeriodTime'] ?></p>
                            <div class="pricing-one__bottom">
                                <ul class="list-unstyled cta-one_list">
                                    <p class="pricing-one__text">Benefits</p> </br>
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                          Free entry for <?php echo $Membership['Entry'] ?> times
                                    </li>
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                        <?php
                                            if($Membership['AccessKidsArea'] == 1 ){ 
                                                echo "Free Access to Kids Area" ;   
                                            }elseif($Membership['AccessMuseumLib'] == 1){
                                                echo "Free Access to The Grand Egyptian Museum Library" ; 
                                            }
                                        ?>
                                    </li>
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                        <?php
                                          if($Membership['VouchersMuseum'] == 1){ 
                                              echo "Free Voucher for the Official Restaurant" ;   
                                          }elseif($Membership['ChildernMuseum'] != 1 || $Membership['ChildernMuseum'] != NULL){ 
                                            echo $Membership['ChildernMuseum'] . " Free Entries to Childern Museum " ;   
                                          }
                                        ?>
                                    </li>
                                </ul>
                                <a href="#" class="pricing-one__btn thm-btn">Join</a>
                            </div>
                        </div>
                    </div>
                  <?php } ?>
                </div>
            </div>
        </section>

  <?php include "../UserFooter.php"; ?>
