<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Profile";

if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];
  $UserPassword = $_SESSION['UserPassword'];

  $SelectQuery = "SELECT user.* , userrole.RoleName AS RoleName , userimages.Image AS Image FROM user 
                  LEFT JOIN userrole ON user.RoleID = userrole.ID
                  LEFT JOIN userimages ON user.ID = userimages.UserID
                  WHERE user.ID = $UserID LIMIT 1";
  $Select = mysqli_query($con, $SelectQuery);
  $row = mysqli_fetch_assoc($Select);
  $FullName = $row['Name'] . " " . $row['LastName'];

  if(isset($_POST['Cancel'])){
    header('Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php ');
  }

  if(isset($_POST['Save'])){
    $UserID    = $_POST['UserID'];
    $FirstName = $_POST['FirstName'];
    $LastName  = $_POST['LastName'];
    $Email     = $_POST['Email'];
    $Phone     = $_POST['Phone'];
    $Age       = $_POST['Age'];
    $RoleID    = $_POST['Role'];
    $Password  = $_POST['Password'];
      $hashedPassword = password_hash($Password , PASSWORD_DEFAULT);

    $FormErrors = array();

    if (empty($FirstName)) {
        $FormErrors[] = "You Should Write Your Name";
    }
    if (empty($Email)) {
        $FormErrors[] = "Please Enter an Email ";
    }
    if (empty($Password)) {
        $FormErrors[] = "The Password Cannot be Empty";
    }
    if ($RoleID == 0) {
        $FormErrors[] = "You Must Select a Correct Role";
    }

    if(empty($FormErrors)) {
      if (isset($_FILES['Image']['name'])){
          $UserID    = $_POST['UserID'];
          $Image     = $_FILES['Image']['name'];
          $imageTmp  = $_FILES['Image']['tmp_name'];
          $folder    = "Images\Uploads\\".$Image;
          move_uploaded_file($imageTmp,$folder);

          $UpdateInfo = "UPDATE user SET Name = '$FirstName' , LastName = '$LastName' , Email = '$Email' , Phone = $Phone , Age = $Age , Password = '$hashedPassword' , RoleID = $RoleID
                          WHERE ID = $UserID ";
          $RunQuery = mysqli_query($con , $UpdateInfo);

          $UpdateImage = "UPDATE userimages SET Image = '$Image' WHERE UserID = $UserID ";
          $RunImgQuery = mysqli_query($con , $UpdateImage);

          header('Location: ./profile.php ');
      }
    }else{
        foreach ($FormErrors as $error) {
          echo "<div class='alert alert-danger'>" . $error . "</div>";
        }
    }

  }
  ?>
      <?php include "../NavUser.php" ?>

          <section class="inner-banner">
            <div class="container">
              <h2 class="inner-banner__title">Profile</h2>
            </div>
          </section>

          <section class="profile">
            <div class="container">
              <div class="row">
                <div class="col-md-4 details">
                  <div class="testimonials-one__image">
                    <img src="../Images/AdminImages/<?php echo $row['Image'] ?>" id="Image" style="width: 100px !important" alt=""/>
                  </div>
                  <div class="testimonials-one__info">
                    <h3 class="testimonials-one__name"><?php echo $FullName ;?></h3>
                    <p class="testimonials-one__designation"><?php echo $row['Email'] ?></p>
                  </div>
                </div>
                <div class="col-md-8 has-seperator">
                  <h3 class="login-form__title">Edit Profile</h3>
                  <form action="#" method='POST' class="login-form__form" enctype="multipart/form-data">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="login-form__field">
                          <input type="hidden" name="UserID" value="<?php echo $UserID ?>">
                          <input type="text" name="FirstName" placeholder="Your First Name" value="<?php echo $row['Name'] ?>" />
                          <i class="fa fa-user"></i>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="login-form__field">
                          <input type="text" name="LastName" placeholder="Your Last Name" value="<?php if(isset($row['LastName'])){echo $row['LastName'] ;} ?>" />
                          <i class="fa fa-user"></i>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="login-form__field">
                          <input type="email" name="Email" placeholder="Email Address" value="<?php echo $row['Email'] ?>" />
                          <i class="fa fa-envelope-o"></i>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="login-form__field">
                          <input type="number" name="Age" placeholder="Age" value="<?php if(isset($row['Age'])){ echo $row['Age'] ;} ?>" />
                          <i class="fa fa-id-card-o"></i>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="login-form__field">
                          <input type="number" name="Phone" placeholder="Phone Number" value="<?php if(isset($row['Phone'])){ echo "0" . $row['Phone'] ;}  ?>"/>
                          <i class="fa fa-phone"></i>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="login-form__field" style="margin-bottom: 20px">
                          <div class="checkout-one__form">
                            <select class="selectpicker" name="Role">
                              <option value="<?php if(isset($row['RoleID'])){echo $row['RoleID'] ;}else{ echo 0 ;} ?>"><?php if(isset($row['RoleID'])){echo $row['RoleName'] ;}else{ echo "Role" ;} ?></option>
                              <?php
                               $SelectRole = "SELECT * FROM userrole " ; 
                                $RunQuery = mysqli_query($con , $SelectRole);
                                $row = mysqli_fetch_assoc($RunQuery);
                                foreach($RunQuery as $Role){ ?>
                                  <option value="<?php echo $Role['ID'] ?>"><?php echo $Role['RoleName'] ?></option>
                                <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="login-form__field">
                      <input type="password" name="Password" value="<?php echo $UserPassword ?>" placeholder="Enter Password" />
                      <i class="fa fa-lock"></i>
                    </div>
                    <div class="login-form__field">
                      <input type="file" name="Image" placeholder="Profile Picture" id="UserImage" accept=".jpg , .png , .jpeg" />
                      <i class="fa fa-image"></i>
                    </div>
                    <div class="login-form__bottom">
                      <div class="gap-4">
                        <button type="submit" name='Cancel' class="thm-btn login-form__btn">
                          Cancel
                        </button>
                        <button type="submit" name="Save" class="thm-btn login-form__btn login-form__btn-two" >
                          Save
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </section>

          <script>
            document.getElementById('UserImage').onchange = function(){
            document.getElementById('Image').src = URL.createObjectURL(UserImage.files[0]); //Preview New Image
            }
          </script>
  <?php include "../UserFooter.php";

    }else{
  header("Location: ../login.php ");
} ?>