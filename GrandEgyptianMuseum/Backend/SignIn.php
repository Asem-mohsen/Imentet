<?php
ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Sign In";

include './init.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $Email = $_POST['Email'];
    $Password = $_POST['Password'];


    $SelectAdmin = "SELECT * FROM admin WHERE Email = '$Email' AND IsAdmin = 1 LIMIT 1";
    $Select = mysqli_query($con , $SelectAdmin);
    $count = mysqli_num_rows($Select);
    $AdminRow = mysqli_fetch_assoc($Select) ; 

        if(isset($AdminRow['IsAdmin']) == 1 ){
                if($count > 0){
                    if($AdminRow['Active'] == 0){
                        echo "<div class='container'>";
                            echo "<div class='alert alert-danger'> Your Account Is Deactiveted </div>";
                        echo "</div>";
                    }elseif(password_verify( $Password, $AdminRow['Password'])) {

                        $_SESSION['AdminID'] = $AdminRow['ID'];     //Register Sesstion ID
                        $_SESSION['AdminPassword'] = $_POST['Password'];     //Register Sesstion ID
                        header('Location: Dashboard.php');
                        exit();
                    
                    }else{
                                echo "<div class='container'>";
                                    echo "<div class='alert alert-danger'> Password or Email is Not Correct </div>";
                                echo "</div>";
                    }
                    
                }
        }elseif(isset($AdminRow['IsAdmin']) != 1 ){
                $SelectUser = "SELECT * FROM user WHERE Email = '$Email' AND Password = '$Password' LIMIT 1";
                $Select = mysqli_query($con , $SelectUser);
                $count = mysqli_num_rows($Select);
                if($count > 0){
                    // $_SESSION['AdminID'] = $row['ID'];     //Register Sesstion ID

                    // header('Location: Dashboard.php');

                    echo "Is User but i cannot redirect now";
                }
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

    <h1 class="PageTitle"> Sign In</h1>
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
            <p class="c-white">Doesn't have an Account ? .. <a href="./SignUp.php">  Sign Up Now </a></p>
        </div>
</div>

<?php
    include "./Includes/PageContent/Footer.php";

?>