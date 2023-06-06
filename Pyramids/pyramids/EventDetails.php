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
if(isset($_POST['Book'])){
  $Email = $_POST['Email'];
  $SelectEmail = "SELECT * FROM user WHERE Email = '$Email' LIMIT 1";
  $RunQuery = mysqli_query($con , $SelectEmail);
  $Count = mysqli_num_rows($RunQuery);
    if($Count > 0){
      for($i = 0 ; $i < count($_POST['Price']) ; $i++){
        $Quantity = $_POST['Quantity'][$i];
        $EventID = $_POST['EventID'];
        $Price = $_POST['Price'][$i];
        $Email = $_POST['Email'];
        $UserID = $_POST['UserID'];
        
        $TotalValue[$i] = 0 ;
        $TotalValue[$i] += $Price * $Quantity ; 

      }
      $FinalQuan = array_sum($_POST['Quantity']);
      $Total = array_sum($TotalValue);

        if($Total > 0 ){
          $InsertEventTicket = "INSERT INTO eventticketcart VALUES(NULL , $EventID ,$UserID , $Total , $FinalQuan)";
          $InsertRun = mysqli_query($con , $InsertEventTicket);
          header("Location: http://localhost/imentet-1/Pyramids/pyramids/Payment.php?EventTicket");
          exit();
        }else{
          $MustSelectQuantity = "Must Select Quantity to Continue";
        }
    }
}

if(isset($_POST['SubmitFeedback'])){
  $EventID = $_POST['EventID'];
  $UserID = $_POST['UserID'];
  $Feedback = mysqli_real_escape_string($con , $_POST['Feedback']);

  if(!empty($Feedback)){
    $InsertFeedback = "INSERT INTO feedback VALUES(NULL , $UserID ,$EventID , '$Feedback')";
    $RunFeedback = mysqli_query($con , $InsertFeedback);

  }else{
    $FeedbackCannotEmpty = "Feedback Cannot be Empty ";
  }
}

  $EventID =  filter_var($_GET['EventID'], FILTER_SANITIZE_NUMBER_INT);
if(empty($EventID)){
    header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php");
}else{

  $SelectEvent = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName, sponsorship.Name AS SponsorshipName , feedback.Description AS Feedback, user.Name AS UserName ,user.ID AS UserID
                  ,eventstatus.Status AS EventStatus ,eventstatus.Reason AS EventReason 
                  FROM entertainmnet 
                  JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                  JOIN place ON place.ID = entertainmnet.PlaceID
                  JOIN eventsponsor ON eventsponsor.EventID = entertainmnet.ID 
                  LEFT JOIN feedback ON entertainmnet.ID = feedback.EntertainmnetID
                  LEFT JOIN user ON feedback.UserID = user.ID
                  LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                  JOIN sponsorship ON eventsponsor.ContractID = sponsorship.ContractID
                  WHERE entertainmnet.ID = $EventID LIMIT 1 ";
  $Events = mysqli_query($con , $SelectEvent);
  $row = mysqli_fetch_assoc($Events);

  $PageTitle = $row['Name'] . " Event";
  
  $StartDate = date('d M Y', strtotime($row['Date'])); 
  $EndDate = date('d M Y', strtotime($row['DateTo'])); 
  $TodaysDate = date("Y-m-d");
  $StartDateInTime = date("Y-m-d" , strtotime($row['Date']));


  if($EventID != $row['ID']){
    header("Location: http://localhost/imentet-1/Pyramids/pyramids/Events.php?Page=1");
    exit();
  }
  ?>


  <?php include "./NavUserPyramids.php"; ?>

      <!-- Top Part -->
      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title"><?php echo $row['Name'] ?></h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a></li>
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/Events.php?Page=1">Events</a></li>
            <li><?php echo $row['Name'] ?></li>
          </ul>
        </div>
      </section>

      <!-- Event Details -->
      <section class="event-details">
        <div class="container">
          <div class="row">
            <div class="col-lg-8">
              <div class="event-details__content">
                <ul class="nav nav-tabs plan-visit__tab-links">
                  <li class="nav-item">
                    <a href="#open-hrs" data-target="#about-event"class="nav-link active">About Event</a>
                  </li>
                  <li class="nav-item">
                    <a href="#schedule" data-target="#schedule" class="nav-link">Schedule</a>
                  </li>
                  <li class="nav-item">
                    <a href="#contact" data-target="#contact" class="nav-link">Contact</a>
                  </li>
                  <?php 
                    $SelectGallery = "SELECT * FROM eventgallery WHERE EventID = $EventID ";
                    $SelectRun = mysqli_query($con , $SelectGallery);
                    $Gallery = mysqli_fetch_assoc($SelectRun); 
                    if(isset($Gallery['ID']) && $Gallery['EventID'] == $EventID){ ?>
                    <li class="nav-item">
                      <a href="#gallery" data-target="#gallery" class="nav-link" >Gallery</a>
                    </li>
                  <?php } ?>
                </ul>
                <div class="event-details__single" id="about-event">
                  <div class="event-details__event-info">
                    <div class="row">
                      <div class="col-lg-6 d-flex">
                        <div class="my-auto">
                          <ul class="list-unstyled event-details__event-info__list">
                            <li>
                              <span>Date & Time</span>
                              <p>
                                <i class="fa fa-clock-o"></i>
                                <?php echo $StartDate ; ?>  
                                <?php if(isset($EndDate) && $row['Everyday'] != "Daily" && $row['DateTo'] != '0000-00-00' && $row['DateTo'] != '1970-01-01' && $row['DateTo'] != Null){
                                          echo " - ". $EndDate ; 
                                      }elseif($row['Everyday'] == "Daily"){
                                        echo " - Happens Daily" ;
                                      }else{
                                        echo ", 10.00 to 7.00" ;
                                      }
                                  ?>
                              </p>
                            </li>
                            <li>
                              <span>Location</span>
                              <p>
                                <i class="fa fa-location-arrow"></i>
                                <?php echo $row['PlaceName'] ?>
                              </p>
                            </li>
                            <li>
                              <span>Organizer</span>
                              <p>
                                <i class="fa fa-user"></i>
                                <?php echo $row['SponsorshipName'] ?>
                              </p>
                            </li>
                            <li>
                              <span>Ticket Cost</span>
                              <p>
                                <i class="fa fa-money"></i>
                                Egyptians - <?php echo $row['EgyptianPrice'] ." EGP"?> <br>

                                <i class="fa fa-money"></i>
                                Foreginers - <?php if(isset($row['ForeignPrice']) && $row['ForeignPrice'] != 0 ){ echo $row['ForeignPrice'] ." EGP" ;}else{ echo $row['EgyptianPrice'] ." EGP" ;}?> <br>
                                
                              </p>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="col-lg-6 clearfix">
                        <img src="images/<?php echo $row['Image'] ?>" width="300px" height="330px"  class="float-right" alt="Awesome Image" />
                      </div>
                    </div>
                  </div>
                  <h3 class="event-details__title">Details About Event</h3>
                  <p class="event-details__text">
                    <?php echo $row['Description'] ?>
                  </p>
                </div>
                <div id="schedule" class="event-details__single">
                  <h3 class="event-details__title">Event Schedule</h3>
                  <ul class="event-details__schedule-list list-unstyled">
                    <li>
                      <div class="event-details__schedule-time">
                        10am - 1pm
                      </div>
                      <div class="event-details__schedule-content">
                        <h3>Doors Open</h3>
                        <p> The Time may change, keep checking it </p>
                      </div>
                    </li>
                    <li>
                      <div class="event-details__schedule-time">2pm - 5pm</div>
                      <div class="event-details__schedule-content">
                        <h3>Sart the Event</h3>
                        <p>This Event will take place in <?php echo $row['PlaceName'] ?></p>
                      </div>
                    </li>
                  </ul>
                </div>

                <!-- Gallery -->
                <?php 
                  if(isset($Gallery['ID']) && $Gallery['EventID'] == $EventID){
                    ?>
                    <div id="gallery" class="event-details__single">
                      <h3 class="event-details__title">Gallery</h3>
                      <div class="row masonary-layout">
                        <?php foreach($SelectRun as $Image){ ?>
                          <div class="col-md-6 masonary-item">
                            <img class="img-fluid" src="./Images/<?php echo $Image['Image'] ?>" width="370px" style='height: 270px' alt="Awesome Image"/>
                          </div>
                        <?php } ?>
                      </div>
                    </div>
                  <?php }
                ?>

                <!-- Contact And Feedback-->
                <div id="contact" class="event-details__single">
                  <div class="event-details__contact">
                    <div class="row">
                      <div class="product-details">
                        <div class="accrodion-grp" data-grp-name="product-details__accrodion">
                          <div class="accrodion active">
                            <div class="accrodion-title">
                              <h4>Address</h4>
                            </div>
                            <div class="accrodion-content">
                              <div class="inner">
                                <div id="contact" class="event-details__single">
                                  <div class="event-details__contact">
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <h3 class="event-details__title">
                                          Contact Information
                                        </h3>
                                        <p class="event-details__text">
                                          If you have any question about this Event pleas contact our
                                          team.
                                        </p>
                                        <ul class="event-details__contact-list list-unstyled">
                                          <li>
                                            <span>Address:</span>
                                            <p>
                                              Alexandria Desert Rd, Haram,
                                              <br />
                                              Giza Governorate X4VF+V3F
                                            </p>
                                          </li>
                                          <li>
                                            <span>Phone:</span>
                                            <p>
                                              <a href="tel:+20-23-531-7344">+20-23-531-7344</a>
                                            </p>
                                          </li>
                                          <li>
                                            <span>Email: </span>
                                            <p>
                                              <a href="Imentet@example.com">Imentet@example.com</a>
                                            </p>
                                          </li>
                                        </ul>
                                      </div>
                                      <div class="col-lg-6">
                                        <?php if($row['PlaceName'] == "Grand Egyptian Museum"){ ?>
                                          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13821.875835399496!2d31.122688!3d29.994688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584534984a8ad1%3A0x45764c5bc4ec261a!2sGrand%20Egyptian%20Museum!5e0!3m2!1sen!2seg!4v1681483362521!5m2!1sen!2seg" class="google-map__home" allowfullscreen></iframe>
                                        <?php }else{ ?>
                                          <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3456.006641777741!2d31.13162697553705!3d29.979239121657272!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584587ac8f291b%3A0x810c2f3fa2a52424!2sThe%20Great%20Pyramid%20of%20Giza!5e0!3m2!1sen!2seg!4v1685319609844!5m2!1sen!2seg" class="google-map__home" allowfullscreen ></iframe>
                                        <?php } ?>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                          <!-- Feedback -->
                          <?php if(isset($_SESSION['UserID'])){
                                    if($TodaysDate >= $StartDateInTime || $row['Everyday'] == 'Daily'){ 
                                      $SelectUser = "SELECT * FROM entertainmnetticket WHERE UserID = $UserID AND EventID = $EventID";
                                      $RunQuery = mysqli_query($con , $SelectUser);
                                      $UserPaid = mysqli_fetch_assoc($RunQuery);
                                      $CountUserPaid = mysqli_num_rows($RunQuery);

                                      if($CountUserPaid >= 1 ){ ?>
                                        <div class="accrodion active">
                                          <div class="accrodion-title">
                                            <h4>Feedback</h4>
                                          </div>
                                          <div class="accrodion-content" style="padding-top: 0">
                                            <div class="inner">
                                              <div class="product-details__review-form">
                                                  <?php if(isset($FeedbackCannotEmpty)){
                                                    echo "<div class='TicketsBooked' style='margin-bottom: 20px; color:red'>";
                                                      echo "<i class='egypt-icon-remove'></i>";
                                                      echo "<p>" . $FeedbackCannotEmpty . "</p>" ;
                                                    echo "</div>";
                                                  } ?>
                                                  <?php if(isset($RunFeedback)){
                                                    echo "<div class='TicketsBooked' style='margin-bottom: 20px;'>";
                                                      echo "<i class='egypt-icon-check'></i>";
                                                      echo "<p> Feedback Sent Successfully </p>" ;
                                                    echo "</div>";
                                                  } ?>
                                                <h3 class="product-details__review-form__title">
                                                  Share with us your Feedback!
                                                </h3>
                                                <p class="product-details__review-form__text">
                                                  Your email address will not be published.
                                                </p>
                                                <br>
                                                <form method="POST" class="contact-one__form">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <p class="contact-one__field">
                                                                <label>Your Name </label>
                                                                <input type="hidden" name="UserID"  value="<?php  echo $UserID ?>" >
                                                                <input type="hidden" name="EventID"  value="<?php  echo $EventID ?>" >
                                                                <input type="text" name="Name"  value="<?php if(isset($FullName )){ echo $FullName ; } ?>" <?php if(isset($FullName )){ echo "disabled" ;} ?>  >
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="contact-one__field">
                                                                <label>Email</label>
                                                                <input type="email" name="Email" value="<?php if(isset($User['Email'])){ echo $User['Email']; } ?>" <?php if(isset($User['Email'])){ echo "disabled" ;} ?>>
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <p class="contact-one__field">
                                                                <label>Your Feedback</label>
                                                                <textarea name="Feedback" required></textarea>
                                                                <button type="submit" name="SubmitFeedback" class="thm-btn contact-one__btn"> Submit </button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </form>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      <?php  } 
                                    } 
                                  } ?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Online Booking -->
            <div class="col-lg-4">
              <div class="event-details__form">
                <form method="post">
                  <h3 class="event-details__form-title">Online Booking</h3>
                    <div class="row">
                        <?php 
                              if( ($TodaysDate <= $StartDateInTime || $row['Everyday'] == 'Daily' || $row['DateTo'] > $TodaysDate) && $row['EventStatus'] != 'Postponed' && $row['EventStatus'] != 'Cancelled'){ ?>
                                <!-- If the date is not passed The form Will Open -->
                                <div class="col-sm-12">
                                  <input type="hidden" name="UserID" value="<?php if(isset($UserID)){ echo $UserID ; } ?>" />
                                  <input type="hidden" name="EventID" value="<?php echo $EventID ;  ?>" />
                                  <input type="hidden" name="Price[]" value="<?php echo $row['EgyptianPrice'] ;  ?>" class="EventPrice"/>
                                  <input type="hidden" name="Price[]" value="<?php echo $row['ForeignPrice'] ;  ?>" class="EventPrice"/>
                                  <input type="text" name="Name" placeholder="Your Name" value="<?php if(isset($FullName)){ echo $FullName ; } ?>"/>
                                </div>
                                <div class="col-sm-12">
                                  <input type="text" name="Email" placeholder="Email Address" value="<?php if(isset($User['Email'])){ echo $User['Email'] ; } ?>"/>
                                </div>
                                <div class="col-sm-6">
                                  <label>Egyptians</label>
                                  <input class="quantity-spinner Quantity" type="text" value="0" max='10' name="Quantity[]" onchange="subTotal()"/>
                                </div>
                                <div class="col-sm-6">
                                  <label>Foreigners</label>
                                  <input class="quantity-spinner Quantity" type="text" value="0" max='10' name="Quantity[]" onchange="subTotal()"/>
                                </div>
                                <div class="col-sm-12">
                                  Total
                                  <span class="text-capitalize cart-total__highlight" id="TotalPrice">
                                  
                                  </span>
                                </div>
                                <div class="col-sm-12">
                                  <?php if(isset($UserID)){ ?>
                                      <button type="submit" name="Book" class="thm-btn event-details__form-btn" >
                                      Proceed to Book
                                    </button>
                                  <?php }elseif(isset($_SESSION['AdminID'])){?>
                                    <button class="thm-btn event-details__form-btn" disabled>
                                      Not Authorized 
                                  </button>
                                  <?php }else{ ?>
                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php" class="thm-btn event-details__form-btn" >
                                      Sign In to Continue
                                    </a>
                                  <?php } ?>
                                </div>
                              <?php }else{ ?>
                                  <!-- The date of the event has passed -->
                                  <input type="hidden" name="Price[]" value="<?php echo $row['EgyptianPrice'] ;  ?>" class="EventPrice"/>
                                  <input type="hidden" name="Price[]" value="<?php echo $row['ForeignPrice'] ;  ?>" class="EventPrice"/>
                                  <div class="col-sm-12">
                                    <input type="text" name="Name" placeholder="Your Name" disabled/>
                                  </div>
                                  <div class="col-sm-12">
                                    <input type="text" name="Email" placeholder="Email Address" disabled/>
                                  </div>
                                  <div class="col-sm-6">
                                    <label>Egyptians</label>
                                    <input class="quantity-spinner Quantity" name="Quantity[]" type="text" value="0" max='10' onchange="subTotal()"/>
                                  </div>
                                  <div class="col-sm-6">
                                    <label>Foreigners</label>
                                    <input class="quantity-spinner Quantity" name="Quantity[]" type="text" value="0" max='10' onchange="subTotal()"/>
                                  </div>
                                  <div class="col-sm-12">
                                    Total
                                    <span class="text-capitalize cart-total__highlight" id="TotalPrice">
                                    
                                    </span>
                                  </div>
                                  <div class="col-sm-12">
                                    <?php if($TodaysDate > $StartDateInTime){ ?>
                                        <button type="submit" name="Book" class="thm-btn event-details__form-btn" disabled >
                                            Event Date has Passed
                                        </button>
                                    <?php }elseif($row['EventStatus'] == 'Cancelled'){ ?>
                                        <button type="submit" name="Book" class="thm-btn event-details__form-btn" disabled >
                                            Event Cancelled
                                        </button>
                                    <?php }elseif($row['EventStatus'] == 'Postponed'){ ?>
                                        <button type="submit" name="Book" class="thm-btn event-details__form-btn" disabled >
                                            Event Postponed
                                        </button>
                                    <?php } ?>
                                  </div>
                              <?php } 
                          ?>
                    </div>
                </form>
              </div>
            </div>
        </div>
      </section>

      <!-- Pagination -->
      <div class="event-details__pagination">
        <div class="container">
          <div class="row">

            <!-- Prev -->
            <?php
              $SelectEvent = "SELECT * FROM entertainmnet WHERE ID < $EventID ORDER BY ID DESC LIMIT 1 ";
              $Events = mysqli_query($con , $SelectEvent);
              $Prev = mysqli_fetch_assoc($Events);
              $CountADD =mysqli_num_rows($Events);
              
            ?>
            <?php if($CountADD >= 1 ){ ?>
              <div class="col-lg-6">
                <a href="./EventDetails.php?EventID=<?php echo $Prev['ID'] ?>" class="event-details__pagination__left">
                  <div class="event-details__pagination-icon">
                    <i class="fa fa-angle-left"></i>
                  </div>
                  <div class="event-details__pagination-content">
                    <span>Prev Event</span>
                    <h3><?php echo $Prev['Name'] ?></h3>
                  </div>
                </a>
              </div>
            <?php }else{ ?>
              <div class="col-lg-6">
                <a href="./events.php?Page=1" class="event-details__pagination__left">
                  <div class="event-details__pagination-icon">
                    <i class="fa fa-angle-left"></i>
                  </div>
                  <div class="event-details__pagination-content">
                    <span>Events Page</span>
                    <h3>Back</h3>
                  </div>
                </a>
              </div>
            <?php } ?>            
            <!-- NEXT  -->
            <?php
              $SelectEvent = "SELECT * FROM entertainmnet WHERE ID > $EventID ORDER BY ID ASC LIMIT 1 ";
              $Events = mysqli_query($con , $SelectEvent);
              $Next = mysqli_fetch_assoc($Events);
              $CountNum =mysqli_num_rows($Events);
              if($CountNum >= 1 ){
            ?>
            <div class="col-lg-6">
              <a href="./EventDetails.php?EventID=<?php echo $Next['ID'] ?>" class="event-details__pagination__right">
                <div class="event-details__pagination-icon">
                  <i class="fa fa-angle-right"></i>
                </div>
                <div class="event-details__pagination-content">
                  <span>Next Event</span>
                  <h3><?php echo $Next['Name'] ?></h3>
                </div>
              </a>
            </div>
            <?php } ?>
            <div>
            </div>
          </div>
        </div>
      </div>

      <!-- Success Msg -->
      <?php if(isset($_GET['PaymentDone'])){ ?>
        <div id="success" class="modal fade" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <div class="success-content-message">
                  <i class="fa fa-check"></i>
                  <h2>success</h2>

                  <p>Your payment has been completed successfully.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php  } ?>

      <script>
        var TotalPrice = 0;
        var Price = document.getElementsByClassName('EventPrice');
        var Quantity = document.getElementsByClassName('Quantity');
        var FullTotalOne = document.getElementById('TotalPrice');
        function subTotal(){
          TotalPrice = 0;   
            for(i=0 ; i <Price.length ; i++){
                TotalPrice = TotalPrice + (Price[i].value)*(Quantity[i].value) ;
            }
            FullTotalOne.innerText = TotalPrice + " EGP";
        }
        subTotal(); 
      </script>

  <?php include "./UserFooterPyramids.php" ;  ?>

  <script>
        jQuery(window).load(function () {
          jQuery("#success").modal("show");
        });
  </script>
<?php }
?>