<?php
ob_start();

$PageTitle = "Profile";

include './init.php';

session_start();
session_regenerate_id();

if (isset($_SESSION["AdminID"])) { 

    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);

    $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;
    include "Nav.php";
    if($do == 'Manage'){
                    $SelectAdmins = "SELECT admin . * , adminrole.Role AS RoleName FROM admin INNER JOIN adminrole ON adminrole.ID = admin.AdminRole WHERE admin.ID = $AdminID";
                    $Admins = mysqli_query($con, $SelectAdmins);
                    $Admin = mysqli_fetch_assoc($Admins);
                    ?>


                    <div class="container rounded bg-white mt-5 mb-5">
                        <div class="row">
                            <div class="col-md-3 border-right">
                                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                    <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">

                                    <span class="font-weight-bold"><?php echo $Admin['Name']?></span>
                                    <span class="text-black-50"><?php echo $Admin['Email']?></span>
                                    <span> </span>
                                </div>
                            </div>
                            <div class="col-md-5 border-right">
                                <div class="p-3 py-5">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 class="text-right"><?php echo $Admin['Name']?> Profile</h4>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-12">
                                            <label class="labels">Name</label>
                                            <input type="text" class="form-control" placeholder="first name" disabled value="<?php echo $Admin['Name']?>">
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-12">
                                            <label class="labels">Phone Number</label>
                                            <input type="number" class="form-control" placeholder="enter phone number" disabled value="<?php echo $Admin['Phone']?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Address</label>
                                            <input type="text" class="form-control" placeholder="enter address line 1" disabled value="<?php echo $Admin['Address']?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Email</label>
                                            <input type="text" class="form-control" placeholder="enter email id" disabled value="<?php echo $Admin['Email']?>">
                                        </div>
                                        <div class="col-md-12">
                                            <label class="labels">Position</label>
                                            <input type="text" class="form-control" placeholder="Position" disabled value="<?php echo $Admin['RoleName']?>">
                                        </div>
                                    </div>
                                    <div class="mt-5 text-center">
                                        <a href="./Profile.php?action=Edit&AdminID=<?php echo $Admin['ID'] ?>" class="btn btn-success profile-button">Edit</a>
                                        <a href="./Dashboard.php" class="btn btn-primary profile-button">Back</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

        <?php
    }elseif($do == "Edit"){
        $SelectAdmins = "SELECT admin . * , adminrole.Role AS RoleName , adminrole.ID AS RoleID, adminimage.Image AS Image FROM admin 
                        INNER JOIN adminrole ON adminrole.ID = admin.AdminRole
                        LEFT JOIN adminimage ON admin.ID = adminimage.AdminID
                        WHERE admin.ID = $AdminID";
        $Admins = mysqli_query($con, $SelectAdmins);
        $Admin = mysqli_fetch_assoc($Admins);
        ?>
        <form action="?action=Update" method="POST">
            <div class="container rounded bg-white mt-5 mb-5">
                    <div class="row">
                        <div class="col-md-3 border-right">
                            <div class="ProfileInfo d-flex flex-column align-items-center text-center p-3 py-5">
                                <img class="rounded-circle mt-5" width="150px" height="150px" id="image" src="<?php $Admin['Image']?>">
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
                                <span class="font-weight-bold mt-40"><?php echo $Admin['Name']?></span>
                                <span class="text-black-50"><?php echo $Admin['Email']?></span>
                                <span> </span>
                            </div>
                        </div>
                        <div class="col-md-5 border-right">
                            <div class="p-3 py-5">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h4 class="text-right"><?php echo $Admin['Name']?> Profile</h4>
                                </div>
                                <div class="row mt-2">
                                    <input type="hidden" name="AdminID" value="<?php echo $Admin['ID'] ?>">
                                    <input type="hidden" name="RoleID" value="<?php echo $Admin['RoleID'] ?>">

                                    <div class="col-md-12">
                                        <label class="labels">Name</label>
                                        <input type="text" name="Name" class="form-control"  value="<?php echo $Admin['Name']?>">
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <label class="labels">Phone Number</label>
                                        <input type="number" name="Phone" class="form-control" value="<?php echo $Admin['Phone']?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Address</label>
                                        <input type="text" name="Address" class="form-control" value="<?php echo $Admin['Address']?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Email</label>
                                        <input type="email" name="Email" class="form-control" value="<?php echo $Admin['Email']?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Password</label>
                                        <input type="password" name="Password" class="form-control" value="<?php echo $Admin['Password']?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="labels">Position</label>
                                        <input type="text" name="Position" class="form-control" disabled value="<?php echo $Admin['RoleName']?>">
                                        <p class="fs-13 c-gray ml-1">You Cannot Edit Your Position</p>
                                    </div>
                                </div>

                                <div class="mt-5 text-center">
                                    <button class="btn btn-success profile-button" type="submit">Update</button>
                                    <a href="./Profile.php?action=Manage" class="btn btn-primary profile-button" type="button">Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php
    }elseif($do == "Update"){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $AdminID   = $_POST['AdminID'];
                $Name      = $_POST['Name'];
                $Phone     = $_POST['Phone'];
                $Address   = $_POST['Address'];
                $Email     = $_POST['Email'];
                $Password  = $_POST['Password'];
                $Role      = $_POST['RoleID'];

                $AdminImage        = $_FILES['Image']['name'];
                $folder       = "Images\Uploads\\".$image;
                if (isset($AdminImage)) {
                    $imageName = $_FILES['Image']['name'];
                    $imageType = $_FILES['Image']['type'];
                    $imageTmp = $_FILES['Image']['tmp_name'];
                    move_uploaded_file($imageTmp,$folder);              
                }

                $hashedPassword = password_hash($Password , PASSWORD_DEFAULT);

                //Validate The form 
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

                //Loop into error array and print the error
                foreach ($FormErrors as $error) {
                    echo "<div class='container'>";
                        echo "<div class='alert alert-danger'>" . $error . "</div>";
                    echo "</div>";
                }

                if (empty($FormErrors)) {
                    // Update DB with this info
                    $UpdateQuery = "UPDATE admin SET Name = '$Name' , Phone = $Phone , Address = '$Address' , Email = '$Email' , Password = '$hashedPassword' , AdminRole = '$Role'  WHERE ID = $AdminID ";
                    $Update = mysqli_query($con, $UpdateQuery);

                    $InsertQuery = "INSERT INTO adminimage VALUES(NULL , $AdminID , '$Image')";
                    $Insert = mysqli_query($con, $InsertQuery);
                    header("Location: ./Profile.php?action=Manage");
                }
            } else {

                echo "<div class='container'>";
                echo "<div class='alert alert-danger'>" . "Unuthorized access"  . "</div>";
                // RedirectIndex($TheMsg, "Back", 5);
                echo "</div>";
            } 
    }else{
        echo "<div class='container'>";
        $TheMsg = "<div class='alert alert-danger'>" . "This Page Does Not Exist"  . "</div>";
        RedirectIndex($TheMsg);
        echo "</div>";
    }

    include "./Includes/PageContent/Footer.php";



}else{
    if(!isset($_SESSION["AdminID"])){
        header("Location: SignIn.php");
        exit();
    }
}

ob_end_flush();
?>