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


  $SelectQuery = "SELECT  applications.* , COUNT(UserID) AS CountedUserID  FROM `applications` WHERE UserID = $UserID ";
  $Select = mysqli_query($con, $SelectQuery);
  $ApplicationRow = mysqli_fetch_assoc($Select);


      // Appointment and  Status show
    if($ApplicationRow['Approved'] == 1){
        echo "You are Accepted";
    }elseif($ApplicationRow['Approved'] == 0 && $ApplicationRow['UserID'] != NULL){
        echo "Rejected Work on Yourself and try to submit again after 6 months";
    }elseif($ApplicationRow['Approved'] == 2 && $ApplicationRow['Date'] ){
        echo "Your Interview is determined on " . $ApplicationRow['Date'] ;
    }elseif($ApplicationRow['Date'] == NULL && $ApplicationRow['ID'] != NULL){
        echo "Wait for your interview soon";
    }

  $FormError = array();

  if(isset($_POST['Submit'])){
    $UserID = $_POST['UserID'];
    $CareerID = $_POST['Career'];
    
    if(empty($CareerID)){
        $FormError[] = 'Must Select Value For Careers';
    }
    if(empty($FormError)){
        if($ApplicationRow['CountedUserID'] < 1 ){
            $InsertMessage = "INSERT INTO `applications`(UserID , CareerID) VALUES( $UserID ,$CareerID) ";
            $InsertQuery = mysqli_query($con , $InsertMessage);
            if($InsertQuery){
                echo "<div class='alert alert-success'>";
                    echo "Inserted Successfuly";
                echo "</div>";
            }
        }else{
            echo "You have already enrolled";
        }
    }else{
        foreach($FormError as $Error){
            echo "<div class='alert alert-dark'>";
                echo $Error ;
            echo "</div>" ;
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

      <section class="contact-one">
        <div class="container">
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
            <div class="col-lg-6">
              <form action="#" method="POST" class="contact-one__form">
                <div class="row">
                  <div class="col-lg-6">
                    <p class="contact-one__field">
                    <input type="hidden" name="UserID" value="<?php echo $UserID ?>">
                        <label>First Name:</label>
                        <input type="text" name="FirstName"  value="<?php if(isset($row['Name'])){ echo $row['Name']; } ?>" <?php if(isset($row['Name'])){ echo "disabled" ;} ?>  >
                    </p>
                  </div>
                  <div class="col-lg-6">
                      <p class="contact-one__field">
                          <label>Last Name:</label>
                          <input type="text" name="LastName"  value="<?php if(isset($row['LastName'])){ echo $row['LastName']; } ?>" <?php if(isset($row['LastName'])){ echo "disabled" ;} ?> >
                      </p>
                  </div>
                  <div class="col-lg-6">
                      <p class="contact-one__field">
                          <label>Email:</label>
                          <input type="email" name="Email" value="<?php if(isset($row['Email'])){ echo $row['Email']; } ?>" <?php if(isset($row['Email'])){ echo "disabled" ;} ?> required>
                      </p>
                  </div>
                  <div class="col-lg-6">
                      <p class="contact-one__field">
                          <label>Phone:</label>
                          <input type="number" name="Phone" pattern="[0-9]" value="<?php if(isset($row['Phone'])){ echo $row['Phone']; } ?>" <?php if(isset($row['Phone'])){ echo "disabled" ;} ?> required>
                      </p>
                  </div>
                  <div class="col-lg-12">
                      <div class="donation-form__form-field">
                        <select class="selectpicker" name="Career" required>
                          <option value="0">Select a Career</option>
                          <?php
                           $SelectCareer = "SELECT * FROM careers WHERE PlaceID = 2";
                            $RunQuery = mysqli_query($con , $SelectCareer);
                            $row = mysqli_fetch_assoc($RunQuery);
                            foreach($RunQuery as $Career){ ?>
                                <option value="<?php echo $Career['ID'] ?>"><?php echo $Career['Careers'] ?></option>
                            <?php } ?>
                        </select>
                      </div>
                    </div>
                  <div class="col-lg-12">
                    <p class="contact-one__field">
                      <label>What Makes You the Ideal Candidate for this Position :</label>
                      <textarea name="Question" required></textarea>
                      <button type="submit" name="Submit" class="thm-btn contact-one__btn">
                        Confirm
                      </button>
                    </p>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </section>

<?php include "../UserFooter.php"; ?>
