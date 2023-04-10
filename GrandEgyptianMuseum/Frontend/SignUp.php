<?php
ob_start();
session_start();

$PageTitle = "Sign Up";

include './init.php';

if (isset($_POST['SignUp'])) {
    $Name =     $_POST['Name'];
    $Email =     $_POST['Email'];
    $Password = $_POST['Password'];
  
    $FormErrors = array();

    if (empty($Name)) {
        $FormErrors[] = "Name Cannot be Empty";
    }
    if (empty($Email)) {
        $FormErrors[] = "Email Cannot be Empty";
    }
    if (empty($Password)){
        $FormErrors[] = "Password Cannot be Empty";
    }
    if(strlen(trim($Password)) > 8){
        $FormErrors[] = "Password Must Be more than 8 Characters ";
    }

    //LOOP into error array and print the error
    foreach ($FormErrors as $error) {
        echo "<div class='alert alert-danger'>" . $error . "</div>";
    }

    if (empty($FormErrors)) {    
    $InsertUser = "INSERT INTO `user` VALUES( Null, '$Name' , Null,Null , Null, '$Email' , '$Password' , 1 , Null, Null )";
    $Query = mysqli_query($con, $InsertUser);
  
  
    header("location:./SignIn.php");
    }
  }

?>

<h1 class="text-center text-dark" style="font-family: 'Times New Roman', Times, serif; padding-top: 50px;">Create Your Own Account</h1>
  <div class="container col-7 mt-5">
    <form method="POST">
      <div class="form-group">
        <label for="Name">Name</label>
        <input type="text" required name="Name" class="form-control" id="Name" placeholder="Ex: Assem Mohsen">
      </div>
      <div class="form-group">
        <label for="Email">Email</label>
        <input type="email" required name="Email" class="form-control" id="Email" placeholder="Assem@example.com">
      </div>
      <div class="form-group">
        <label for="Password">Password</label>
        <input type="password" name="Password" id='Password' class="form-control" />
      </div>
      <button type="submit" name="SignUp" class="btn-lg btn-block btn-primary"> Sign Up </button>
      <p class="login">Already Have an Account ? .. <a href="./SignIn.php"> Sign In Now </a></p>

    </form>
  </div>