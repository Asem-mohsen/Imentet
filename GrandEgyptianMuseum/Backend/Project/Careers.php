<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Careers";

if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];
  $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
  $Select = mysqli_query($con, $SelectQuery);
  $row = mysqli_fetch_assoc($Select);


  $SelectQuery = "SELECT applications.* , COUNT(UserID) AS CountedUserID , careers.Careers AS Career FROM `applications` 
                  JOIN careers ON applications.CareerID = careers.ID
                  WHERE UserID = $UserID ";
  $Select = mysqli_query($con, $SelectQuery);
  $ApplicationRow = mysqli_fetch_assoc($Select);
  $CountRow = mysqli_num_rows($Select);

  $InterviewDate = $ApplicationRow['Date'];
  $After6MonthDate =date('Y-m-d', strtotime($InterviewDate. ' + 6 Month'));

  $FormError = array();

  if(isset($_POST['Submit'])){
    $UserID = $_POST['UserID'];
    $CareerID = $_POST['Career'];
    
    if(empty($CareerID)){
        $FormError[] = 'Must Select a Careers';
    }
    if(empty($FormError)){
        if($ApplicationRow['CountedUserID'] < 1 ){
            $InsertMessage = "INSERT INTO `applications`(UserID , CareerID) VALUES( $UserID ,$CareerID) ";
            $InsertQuery = mysqli_query($con , $InsertMessage);
            if($InsertQuery){
                $SuccessMsg =  "<div class='alert alert-success text-center'> Wait for Your Interview Soon </div>";
            }
        }else{
          $AlreadyEnrolled =  "<div class='alert alert-warning text-center'> You already Enrolled </div>";
        }
    }
  }

}
?>
      <?php include "../NavUser.php" ; ?>

      <section class="inner-banner">
        <div class="container">
          <h2 class="inner-banner__title">Careers</h2>
            <p class="inner-banner__text">
              Join our team now
            </p>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Home</a></li>
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/about.php">The Museum</a></li>
            <li>Careers</li>
          </ul>
        </div>
      </section>

      <!-- Display Errors -->
      <?php 

        if(isset($SuccessMsg)){
          header('Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Careers.php');
          echo $SuccessMsg ;
        }
        if(isset($AlreadyEnrolled)){ echo $AlreadyEnrolled ; }

        if(isset($FormError)){
          foreach($FormError as $Error){
            echo "<div class='alert alert-danger text-center'>";
                echo $Error ;
            echo "</div>" ;
        }
        }

      ?>
      
      <section class="contact-one">
        <div class="container">

          <?php if(isset($CountRow) > 0 && isset($ApplicationRow['UserID']) && $InterviewDate < $After6MonthDate){ ?>
            <div class="row">
              <div class="col-lg-6">
                <div class="contact-one__main">
                  <div class="contact-one__image">
                    <img src="images/resources/contact-1-1.jpeg" class="img-fluid" alt="" />
                  </div>
                  <div class="contact-one__content">
                    <div class="row no-gutters">
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-md-6">
                <form class="contact-one__form">
                  <div class="row">
                    <div class="col-md-6">
                      <p class="contact-one__field">
                          <label>First Name:</label>
                          <input type="text" name="FirstName"  value="<?php if(isset($row['Name'])){ echo $row['Name']; } ?>" <?php if(isset($row['Name'])){ echo "disabled" ;} ?>  >
                      </p>
                    </div>
                    <div class="col-md-6">
                        <p class="contact-one__field">
                            <label>Last Name:</label>
                            <input type="text" name="LastName"  value="<?php if(isset($row['LastName'])){ echo $row['LastName']; } ?>" <?php if(isset($row['LastName'])){ echo "disabled" ;} ?> >
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p class="contact-one__field">
                            <label>Email:</label>
                            <input type="email" name="Email" value="<?php if(isset($row['Email'])){ echo $row['Email']; } ?>" <?php if(isset($row['Email'])){ echo "disabled" ;} ?> required>
                        </p>
                    </div>
                    <div class="col-md-6">
                      <p class="subject-picker contact-one__field">
                        <label>Career:</label>
                        <select class="selectpicker" name="Career" >
                          <option value="<?php echo $ApplicationRow['CareerID']?>" selected disabled ><?php echo $ApplicationRow['Career']?></option>
                        </select>
                      </p>
                    </div>
                    <div class="col-md-6">
                        <p class="contact-one__field">
                          <label>Process:</label>
                          <input type="text" value="<?php 
                            if($ApplicationRow['Approved'] == 1){
                                echo "You are Accepted"; 
                            }elseif($ApplicationRow['Approved'] == 0 && $ApplicationRow['UserID'] != NULL){
                                echo "Rejected";
                            }elseif($ApplicationRow['Approved'] == 2 && $ApplicationRow['Date'] ){
                                echo "Your Interview is determined on " . date('d M - Y' ,strtotime($ApplicationRow['Date'])) ;
                            }elseif($ApplicationRow['Date'] == NULL && $ApplicationRow['ID'] != NULL){
                                echo "Wait for your interview soon";
                            }?>"
                            disabled >
                        </p>
                    </div>
                    <?php if($ApplicationRow['Approved'] == 0 && $ApplicationRow['UserID'] != NULL){
                      echo "<p>You'll have another chance to Apply again after 6 month In " . date('d M Y' , strtotime($After6MonthDate)) . "</p>";
                    } ?>
                    <div class="col-md-12">
                      <p class="contact-one__field" style="text-align: center;">
                        <button type="submit" disabled class="thm-btn contact-one__btn">
                          Wish You A Good Luck
                        </button>
                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php }elseif(isset($InterviewDate) > isset($After6MonthDate)){ ?>
            
            <div class="row">
              <div class="col-lg-6">
                <div class="contact-one__main">
                  <div class="contact-one__image">
                    <img src="images/resources/contact-1-1.jpeg" class="img-fluid" alt="" />
                  </div>
                  <div class="contact-one__content">
                    <div class="row no-gutters">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <form method="POST" class="contact-one__form">
                  <div class="row">
                    <div class="col-md-6">
                      <p class="contact-one__field">
                      <input type="hidden" name="UserID" value="<?php echo $UserID ?>">
                          <label>First Name:</label>
                          <input type="text" name="FirstName"  value="<?php if(isset($row['Name'])){ echo $row['Name']; } ?>" <?php if(isset($row['Name'])){ echo "disabled" ;} ?>  >
                      </p>
                    </div>
                    <div class="col-md-6">
                        <p class="contact-one__field">
                            <label>Last Name:</label>
                            <input type="text" name="LastName"  value="<?php if(isset($row['LastName'])){ echo $row['LastName']; } ?>" <?php if(isset($row['LastName'])){ echo "disabled" ;} ?> >
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p class="contact-one__field">
                            <label>Email:</label>
                            <input type="email" name="Email" value="<?php if(isset($row['Email'])){ echo $row['Email']; } ?>" <?php if(isset($row['Email'])){ echo "disabled" ;} ?> required>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="contact-one__field">
                            <label>Phone:</label>
                            <input type="number" name="Phone" pattern="[0-9]*" value="<?php if(isset($row['Phone']) && $row['Phone'] != 0 ){ echo "0" . $row['Phone']; } ?>" <?php if(isset($row['Phone']) && $row['Phone'] != 0){ echo "disabled" ;} ?> required>
                        </p>
                    </div>
                    <div class="col-md-6">
                      <p class="subject-picker contact-one__field">
                        <label>Career:</label>
                        <select class="selectpicker" name="Career" required>
                          <option value="0" selected>Select a Career</option>
                          <?php
                            $SelectCareer = "SELECT * FROM careers WHERE PlaceID = 2";
                              $RunQuery = mysqli_query($con , $SelectCareer);
                              $row = mysqli_fetch_assoc($RunQuery);
                              foreach($RunQuery as $Career){ ?>
                                  <option value="<?php echo $Career['ID'] ?>"><?php echo $Career['Careers'] ?></option>
                              <?php } ?>
                        </select>
                      </p>
                    </div>
                    <div class="col-md-12">
                      <p class="contact-one__field">
                        <label>What Makes You the Ideal Candidate for this Position :</label>
                        <textarea name="Question" required></textarea>
                        <?php if(isset($_SESSION['UserID'])){ ?> 
                          <button type="submit" name="Submit" class="thm-btn contact-one__btn">
                            Confirm
                          </button>
                        <?php }elseif(isset($_SESSION['AdminID'])){ ?>
                          <button disabled class="thm-btn contact-one__btn">
                            You Already Work With Us !!
                          </button>
                        <?php }else{ ?>
                          <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php" class="thm-btn contact-one__btn">
                            Sign In To Continue
                          </a>  
                        <?php } ?>

                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php }else{ ?>
            <div class="row">
              <div class="col-lg-6">
                <div class="contact-one__main">
                  <div class="contact-one__image">
                    <img src="images/resources/contact-1-1.jpeg" class="img-fluid" alt="" />
                  </div>
                  <div class="contact-one__content">
                    <div class="row no-gutters">
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <form method="POST" class="contact-one__form">
                  <div class="row">
                    <div class="col-md-6">
                      <p class="contact-one__field">
                      <input type="hidden" name="UserID" value="<?php echo $UserID ?>">
                          <label>First Name:</label>
                          <input type="text" name="FirstName"  value="<?php if(isset($row['Name'])){ echo $row['Name']; } ?>" <?php if(isset($row['Name'])){ echo "disabled" ;} ?>  >
                      </p>
                    </div>
                    <div class="col-md-6">
                        <p class="contact-one__field">
                            <label>Last Name:</label>
                            <input type="text" name="LastName"  value="<?php if(isset($row['LastName'])){ echo $row['LastName']; } ?>" <?php if(isset($row['LastName'])){ echo "disabled" ;} ?> >
                        </p>
                    </div>
                    <div class="col-md-12">
                        <p class="contact-one__field">
                            <label>Email:</label>
                            <input type="email" name="Email" value="<?php if(isset($row['Email'])){ echo $row['Email']; } ?>" <?php if(isset($row['Email'])){ echo "disabled" ;} ?> required>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p class="contact-one__field">
                            <label>Phone:</label>
                            <input type="number" name="Phone" pattern="[0-9]*" value="<?php if(isset($row['Phone']) && $row['Phone'] != 0 ){ echo "0" . $row['Phone']; } ?>" <?php if(isset($row['Phone']) && $row['Phone'] != 0){ echo "disabled" ;} ?> required>
                        </p>
                    </div>
                    <div class="col-md-6">
                      <p class="subject-picker contact-one__field">
                        <label>Career:</label>
                        <select class="selectpicker" name="Career" required>
                          <option value="0" selected>Select a Career</option>
                          <?php
                            $SelectCareer = "SELECT * FROM careers WHERE PlaceID = 2";
                              $RunQuery = mysqli_query($con , $SelectCareer);
                              $row = mysqli_fetch_assoc($RunQuery);
                              foreach($RunQuery as $Career){ ?>
                                  <option value="<?php echo $Career['ID'] ?>"><?php echo $Career['Careers'] ?></option>
                              <?php } ?>
                        </select>
                      </p>
                    </div>
                    <div class="col-md-12">
                      <p class="contact-one__field">
                        <label>What Makes You the Ideal Candidate for this Position :</label>
                        <textarea name="Question" required></textarea>
                        <?php if(isset($_SESSION['UserID'])){ ?> 
                          <button type="submit" name="Submit" class="thm-btn contact-one__btn">
                            Confirm
                          </button>
                        <?php }elseif(isset($_SESSION['AdminID'])){ ?>
                          <button disabled class="thm-btn contact-one__btn">
                            You Already Work With Us !!
                          </button>
                        <?php }else{ ?>
                          <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php" class="thm-btn contact-one__btn">
                            Sign In To Continue
                          </a>  
                        <?php } ?>

                      </p>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          <?php } ?>
          
        </div>
      </section>

<?php include "../UserFooter.php"; ?>
