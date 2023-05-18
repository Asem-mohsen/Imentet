<?php
ob_start();

$PageTitle = "Profile";

include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";

session_start();
session_regenerate_id();

if (isset($_SESSION["AdminID"])) { 

    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID LIMIT 1";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);

    include './NavAdmin.php';
        $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;

        if($do == 'Manage'){
            $IDAdmin =  filter_var($_GET['AdminID'], FILTER_SANITIZE_NUMBER_INT);
            if(empty($IDAdmin)){
                echo "<div class='NoData'>";
                    echo "<p>Sorry, We don't have Ghosts </p>";
                echo "</div>";
            }elseif($AdminID != $IDAdmin){
                echo "<div class='NoData'>";
                    echo "<p>Trying to Access another profile ! GET BACK NOW </p>";
                echo "</div>";
            }else{
                        $SelectAdmins = "SELECT admin . * , adminrole.Role AS RoleName ,adminimage.Image AS Image FROM admin 
                                        INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                        LEFT JOIN adminimage ON admin.ID = adminimage.AdminID
                                        WHERE admin.ID = $AdminID";
                        $Admins = mysqli_query($con, $SelectAdmins);
                        $Admin = mysqli_fetch_assoc($Admins);
                        ?>

                        <section class="profile">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 details">
                                    <div class="testimonials-one__image">
                                        <img src="./Images/AdminImages/<?php echo $Admin['Image'] ?>" id="Image" style="width: 100px !important" height="100px" alt=""/>
                                    </div>
                                    <div class="testimonials-one__info">
                                        <h3 class="testimonials-one__name"><?php echo $Admin['Name'] ;?></h3>
                                        <p class="testimonials-one__designation"><?php echo $Admin['Email'] ?></p>
                                    </div>
                                    </div>
                                    <div class="col-md-8 has-seperator">
                                    <h3 class="login-form__title">Profile</h3>
                                    <form action="#" method='POST' class="login-form__form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="login-form__field">
                                                <input type="text" name="Name"  value="<?php echo $Admin['Name'] ?>" disabled />
                                                <i class="fa fa-user"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="login-form__field">
                                                <input type="email" name="Email" value="<?php echo $Admin['Email'] ?>"disabled />
                                                <i class="fa fa-envelope-o"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="login-form__field">
                                                    <input type="text"  value="<?php echo $Admin['Address']?>" disabled>
                                                    <i class="fa fa-id-card-o"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="login-form__field">
                                                <input type="number" name="Phone"  value="<?php echo "0" . $Admin['Phone'] ;  ?>" disabled/>
                                                <i class="fa fa-phone"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="login-form__field" style="margin-bottom: 20px">
                                                    <input type="text" disabled value="<?php echo $Admin['RoleName']?>">
                                                </div>
                                            </div>
                                        </div>
                                            <div class="login-form__bottom">
                                                <div class="gap-4">
                                                    <a href="./Dashboard.php"  class="thm-btn login-form__btn">
                                                    Cancel
                                                    </a>
                                                    <a href="./Profile.php?action=Edit&AdminID=<?php echo $Admin['ID'] ?>" class="thm-btn login-form__btn login-form__btn-two" >
                                                    Edit
                                                    </a>
                                                </div>
                                            </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </section>
            <?php
            }
        }elseif($do == "Edit"){
            $IDAdmin =  filter_var($_GET['AdminID'], FILTER_SANITIZE_NUMBER_INT);
            
            if(empty($IDAdmin)){
                echo "<div class='NoData'>";
                    echo "<p>Sorry, We don't have Ghosts </p>";
                echo "</div>";
            }elseif($AdminID != $IDAdmin){
                echo "<div class='NoData'>";
                    echo "<p>Trying to Access another profile ! GET BACK NOW </p>";
                echo "</div>";
            }else{
                $SelectAdmins = "SELECT admin . * , adminrole.Role AS RoleName , adminrole.ID AS RoleID, adminimage.Image AS Image FROM admin 
                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole
                                LEFT JOIN adminimage ON admin.ID = adminimage.AdminID
                                WHERE admin.ID = $AdminID";
                $Admins = mysqli_query($con, $SelectAdmins);
                $Admin = mysqli_fetch_assoc($Admins);
                ?>
                        <section class="profile">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-4 details">
                                        <div class="ProfileInfo">
                                            <img class="rounded-circle mt-5" width="150px" height="150px" id="image" src="./Images/AdminImages/<?php echo $Admin['Image']?>">
                                            <div class="RightRound" id="upload">
                                                <input type="file" name="AdminImage" id="AdminImage" accept=".jpg , .png , .jpeg">
                                                <i class="fa fa-camera"></i>
                                            </div>
                                            <div class="LeftRound" id="Cancel"  style="display: none;">
                                                <i class="fa fa-times"></i>
                                            </div>
                                            <div class="RightRound" id="Confirm" style="display: none;">
                                                <input type="submit" name="" id="">
                                                <i class="fa fa-check"></i>
                                            </div>
                                        </div>
                                        <div class="mt-50 testimonials-one__info ">
                                            <h3 class="testimonials-one__name"><?php echo $Admin['Name'] ;?></h3>
                                            <p class="testimonials-one__designation"><?php echo $Admin['Email'] ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-8 has-seperator">
                                    <h3 class="login-form__title">Edit Profile</h3>
                                    <form action="?action=Update" method="POST" class="login-form__form" enctype="multipart/form-data">
                                        <div class="row">
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                            <input type="text" name="Name" value="<?php echo $Admin['Name']?>">
                                            <input type="hidden" name="AdminID" value="<?php echo $AdminID?>">
                                            <input type="hidden" name="RoleID" value="<?php echo $Admin['RoleID']?>">
                                            <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                            <input type="email" name="Email" value="<?php echo $Admin['Email'] ?>" />
                                            <i class="fa fa-envelope-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                                <input type="text" name="Address" value="<?php echo $Admin['Address']?>" >
                                                <i class="fa fa-id-card-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                            <input type="number" name="Phone"  value="<?php echo "0" . $Admin['Phone'] ;  ?>"/>
                                            <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field password-input">
                                            <input type="password" name="Password"  value="<?php echo  $_SESSION['AdminPassword'];  ?>"/>
                                            <i class="fa fa-eye toggler"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field" style="margin-bottom: 20px">
                                                <input type="text" disabled value="<?php echo $Admin['RoleName']?>">
                                                <p class="fs-13 c-gray ml-1">You Cannot Edit Your Position</p>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="login-form__bottom">
                                            <div class="gap-4">
                                                <a href="./Profile.php?action=Manage&AdminID=<?php echo $Admin['ID'] ?>"  class="thm-btn login-form__btn">
                                                Cancel
                                                </a>
                                                <button type="submit" class="thm-btn login-form__btn login-form__btn-two" >
                                                Update
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    
                <?php

            }
        }elseif($do == "Update"){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $AdminID   = $_POST['AdminID'];
                    $Name      = $_POST['Name'];
                    $Phone     = $_POST['Phone'];
                    $Address   = $_POST['Address'];
                    $Email     = $_POST['Email'];
                    $Password  = $_POST['Password'];
                    $Role      = $_POST['RoleID'];
                    $hashedPassword = password_hash($Password , PASSWORD_DEFAULT);

                    $FormErrors = array();

                    if (empty($Name)) {
                        $FormErrors[] = "Name Cannot be Empty";
                    }
                    if (empty($Phone)) {
                        $FormErrors[] =  "Phone Cannot be Empty";
                    }
                    if (empty($Address)) {
                        $FormErrors[] = "Address Cannot be Empty";
                    }
                    if (empty($Email)) {
                        $FormErrors[] = "Email Cannot be Empty";
                    }
                    if (empty($Password)) {
                        $FormErrors[] = "Password Cannot be Empty";
                    }

                    if (empty($FormErrors)) {

                        if (isset($_FILES['AdminImage']['name'])){
                            $AdminID    = $_POST['AdminID'];
                            $AdminImage = $_FILES['AdminImage']['name'];
                            $imageTmp = $_FILES['AdminImage']['tmp_name'];

                            $folder       = "Images\Uploads\\".$AdminImage;
                            move_uploaded_file($imageTmp,$folder);  
                            $UpdateQuery = "UPDATE admin SET Name = '$Name' , Phone = $Phone , Address = '$Address' , Email = '$Email' , Password = '$hashedPassword' , AdminRole = '$Role'  WHERE ID = $AdminID ";
                            $Update = mysqli_query($con, $UpdateQuery);

                            $UpdateImgQuery = "UPDATE adminimage SET Image = '$AdminImage' WHERE AdminID = $AdminID";
                            $UpdateImg = mysqli_query($con, $UpdateImgQuery);  
                            header("Location: ./Profile.php?action=Manage&AdminID=$AdminID");
                        }else{
                            
                            $UpdateQuery = "UPDATE admin SET Name = '$Name' , Phone = $Phone , Address = '$Address' , Email = '$Email' , Password = '$hashedPassword' , AdminRole = '$Role'  WHERE ID = $AdminID ";
                            $Update = mysqli_query($con, $UpdateQuery);
                            header("Location: ./Profile.php?action=Manage&AdminID=$AdminID");
                        }

                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='container'>";
                                echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                            echo "</div>";
                        }
                    }
                    
                } else {

                    echo "<div class='container'>";
                    echo "<div class='alert alert-danger txt-center'>" . "Unuthorized access"  . "</div>";
                    RedirectIndex("Back" , 1);
                    echo "</div>";
                } 
        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger txt-center'>" . "This Page Does Not Exist"  . "</div>";
            RedirectIndex($TheMsg);
            echo "</div>";
        }
    include "./AdminFooter.php";

}else{
    if(!isset($_SESSION["AdminID"])){
        header("Location: login.php");
        exit();
    }
}

ob_end_flush();
?>