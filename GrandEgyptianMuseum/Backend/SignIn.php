<?php
ob_start();
session_start();

$PageTitle = "Sign In";

include './init.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $AdminEmail = $_POST['Email'];
    $AdminPassword = $_POST['Password'];

    //Check If ADMIN Exist

    $SelectQuery = "SELECT * FROM admin WHERE Email = '$AdminEmail' AND Active = 1 LIMIT 1 ";
    $Select = mysqli_query($con , $SelectQuery);
    $count = mysqli_num_rows($Select);
    
    if($count > 0){
        while($row = mysqli_fetch_assoc($Select)){
            if (password_verify( $AdminPassword, $row['Password'])) {
                
                    $_SESSION['AdminID'] = $row['ID'];     //Register Sesstion ID
                    header('Location: Dashboard.php');
                    exit();
                
            }else{
                echo "<div class='container'>";
                    echo "<div class='alert alert-danger'> Password or Email is Not Correct </div>";
                echo "</div>";
            }
        }
    }elseif(isset($row['Active']) != 1) {
        echo "<div class='container'>";
            echo "<div class='alert alert-danger'> You have Submitted Your Resignation Or Your Account Is Deactiveted  </div>";
        echo "</div>";    
    }
}

?>
<style>
    body{
    background-image: url("./Images/backgroundImageSignin.jpg");
    background-size: inherit;

}
</style>
<div class="SignIn">

  <h1 class="PageTitle"> Admins Platform </h1>
        <div class="container">
            <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
                <div class="form-group mb-0">
                    <div class="m-auto w-50 inputastrick">
                        <input type="email" name="Email" id="Email" class="form-control" placeholder="Email" required="required" />
                    </div>
                </div>
                <div class="form-group mb-0">
                    <div class="m-auto w-50 inputastrick">
                        <input type="password" name="Password" id="Password" class="form-control" placeholder="Password" required="required" />
                    </div>
                </div>
                <div class="form-group">
                    <div class="SignInButton">
                        <input type="submit" value="Sign in Now" class="btn btn-primary btn-md" />
                    </div>
                </div>
            </form>
        </div>
</div>

<?php
    include "./Includes/PageContent/Footer.php";

?>