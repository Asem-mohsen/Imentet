<?php
ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Sign In";

include './init.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    if(isset($_POST['submit'])){

        $Name = mysqli_real_escape_string($con, $_POST['Name']);
        $Email = mysqli_real_escape_string($con, $_POST['Email']);
        $Pass = md5($_POST['Password']);
        $Cpass = md5($_POST['Cpassword']);
        $UserRole = $_POST['UserRole'];
     
        $Select = " SELECT * FROM user WHERE Email = '$Email' && Password = '$Pass' ";
     
        $Result = mysqli_query($con, $Select);
     
        if(mysqli_num_rows($Result) > 0){
        
            $error[] = 'User Already Exist!';
        
        }else{

            if($Pass != $Cpass){
                $error[] = 'Password Not Matched!';
            }else{
                $Insert = "INSERT INTO user(Name, Email, Password, RoleID) VALUES('$Name','$Email','$Pass', $UserRole)";
                mysqli_query($con, $Insert);
                header('location:SignIn.php');
            }
        }
    
    }
}


?>


<div class="form-container">
    <?php
        if(isset($error)){
            foreach($error as $error){
                echo '<div class="alert alert-danger txt-center">'.$error.'</div>';
            };
        };
    ?>
    <h1 class="PageName">Sign Up Now</h1>
        <div class="container">
            <form action="" method="post" class="form-horizontal">
                <div class="form-group mb-0">
                    <div class="m-auto w-50 inputastrick">
                        <input type="text" name="Name" class="form-control" required placeholder="Enter Your Name">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="m-auto w-50 inputastrick">
                        <input type="email" name="Email" class="form-control" required placeholder="Enter Your Email">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="m-auto w-50 inputastrick">
                        <input type="password" name="Password" class="form-control" required placeholder="Enter Your Password">
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="m-auto w-50 inputastrick">
                        <input type="password" name="Cpassword" class="form-control" required placeholder="Confirm Your Password">
                    </div>
                </div>
                <div class="form-group insertInput">
                    <div class="m-auto">
                        <select name="UserRole" class="custom-select user_type">
                            <option value="0"> Role </option>
                            <?php
                            $SelectQuery = "SELECT * From `userrole` ";
                            $Select = mysqli_query($con, $SelectQuery);
                            $fetchquery = mysqli_fetch_assoc($Select);
                            foreach ($Select as $Roles) {
                                echo "<option value='" . $Roles['ID'] . "' >" . $Roles['RoleName'] . " </option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="SignInButton mt-20">
                        <input type="submit" name="submit" value="Sign Up Now" class="btn btn-danger">
                    </div>
                </div>
            </form>
            <p>Already have an Account ? .. <a href="./SignIn.php"> Sign In Now </a> </p>
        </div>
</div>


<?php
    include "./Includes/PageContent/Footer.php";

?>
