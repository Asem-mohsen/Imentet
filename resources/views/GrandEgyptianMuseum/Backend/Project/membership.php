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
                                    Member of Grand Egyptian Museum</h3>
                                <p class="cta-one__text">Gain Access to Exclusive Features and Resources
                                    with Our Membership Program!</p>
                                <ul class="list-unstyled cta-one__list">
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                        Unlimited General Admission
                                    </li>
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                        Free Tickets to Special Exhibitions
                                    </li>
                                    <li>
                                        <i class="egypt-icon-check"></i>
                                        Access to The Museum's Library
                                    </li>
                                </ul>
                                <a href="./membership.php" class="cta-one__link">
                                    <i class="fa fa-angle-right"></i>
                                    Become a Member
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-12">
                        <img src="images/resources/membership-1-1.jpg" alt="" class="img-fluid" />
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
                                <div class="pricing-one__single wow fadeInUp" style="height: 560px;" data-wow-duration="1500ms" data-wow-delay="000ms">
                                    <p class="pricing-one__name">Plan</p>
                                    <h3 class="pricing-one__type"><?php echo $Membership['Type'] ?></h3>
                                    <p class="pricing-one__amount"><?php echo $Membership['Price'] ?></p>
                                    <p class="pricing-one__time">EGP / <?php echo $Membership['PeriodTime'] ?></p>
                                    <div class="pricing-one__bottom">
                                        <ul class="list-unstyled cta-one_list" style='line-height: 33px;'>
                                            <?php if($Membership['ID'] == 6 ){ ?>
                                                <p class="pricing-one__text">Benefits for One Person</p> </br>
                                            <?php }elseif($Membership['ID'] == 8){ ?>
                                                <p class="pricing-one__text">2 Adults & Under 18 Children</p> </br>
                                            <?php }elseif($Membership['ID'] == 16){ ?>
                                                <p class="pricing-one__text">School & colleage</p> </br>
                                            <?php }elseif($Membership['ID'] == 17){ ?>
                                                <p class="pricing-one__text">60 and Above</p> </br>
                                            <?php } ?>

                                            <li class="MembershipLi">
                                                <i class="egypt-icon-check" style="color: #d99578;"></i>
                                                    <?php if(isset($Membership['Entry']) && $Membership['Entry'] == 0){ 
                                                            echo "Limited Admission Entry" ;
                                                    } ?>
                                            </li>
                                            <li class="MembershipLi">
                                                <i class="egypt-icon-check" style="color: #d99578;"></i>
                                                <?php
                                                    if($Membership['ChildernMuseum'] == 1 ){ 
                                                        echo "Access to Children Museum" ;   
                                                    }elseif($Membership['AccessMuseumLib'] == 1 && $Membership['ID'] != 6){
                                                        echo "Access to The GEM Library";
                                                    }elseif($Membership['AccessToEvents'] == 1){
                                                        echo "Members-only Events";
                                                    }elseif($Membership['SpecialExhibtions'] == 1 && $Membership['ID'] == 6){
                                                        echo "Special Exhibition Screening";
                                                    }
                                                ?>
                                            </li>
                                            <li class="MembershipLi">
                                                <i class="egypt-icon-check" style="color: #d99578;"></i>
                                                <?php
                                                    if($Membership['DiscountGiftShop'] == 1 && ($Membership['ID'] == 6 || $Membership['ID'] == 16)  ){ 
                                                        echo "Discounts in Gift Shop" ;   
                                                    }elseif($Membership['VouchersMuseum'] == 1 && ($Membership['ID'] == 8 || $Membership['ID'] == 17) ){ 
                                                        echo "Voucher in Restaurants" ;   
                                                    }
                                                ?>
                                            </li>
                                        </ul>
                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/MembershipDetails.php?MembershipID=<?php echo $Membership['ID'] ?>" class="pricing-one__btn thm-btn">Join</a>
                                    </div>
                                </div>
                            </div>
                        <?php } 
                    ?>
                </div>
            </div>
        </section>

  <?php include "../UserFooter.php"; ?>
