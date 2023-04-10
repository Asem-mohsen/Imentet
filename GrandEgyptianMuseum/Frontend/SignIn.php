<?php
ob_start();
session_start();

$PageTitle = "Sign In";

include './init.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $UserEmail = $_POST['Email'];
    $UserPassword = $_POST['Password'];
    $hashedPassword = sha1($AdminPassword);

    //Check If ADMIN Exist
    $SelectQuery = "SELECT * FROM user WHERE Email = '$UserEmail' AND Password = '$UserPassword' LIMIT 1 ";
    $Select = mysqli_query($con , $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
    $count = mysqli_num_rows($Select);
    
    if($count > 0){
        $_SESSION['UserID'] = $row['ID']; 
        // header('Location: ');
        exit();
    }
}

?>
    <h1 class="ImentetName"> Imentet </h1>
        <div class="SignPage">
            <div class="container col-4 mt-5">
                <form action="<?php echo $_SERVER['PHP_SELF']?>"  method="POST">
                    <div class="form-group">
                        <label for="Email">Email</label>
                            <input type="email" required name="Email" id="Email" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="Password">Password</label>
                        <input type="password" required name="Password" id="Password" class="form-control" />
                    </div>
                        <button type="submit" name="SignIn" class=" btn-lg btn-block btn-primary"> Sign In Now </button>
                        <p class="login">Don't Have an Account ? .. <a href="./SignUp.php"> Sign Up Now </a></p>
                </form>
            </div>
        </div>
        