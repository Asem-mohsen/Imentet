<?php
    ob_start();

    $PageTitle = "Contact Us";

    include './init.php';

    session_start();
    session_regenerate_id();


    if(isset($_SESSION['UserID'])){
        $UserID = $_SESSION['UserID'];
        $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);
    }
    if(isset($_POST['Send'])){
        $UsersQuestion = $_POST['UsersQuestion'];

        if(empty($Email)){
        $Email = $row['Email'];

        }else{
            $Email = $_POST['Email'];

        }
        $InsertMessage = "INSERT INTO `q&a` (Email , UsersQuestion) VALUES( '$Email' ,'$UsersQuestion') ";
        $InsertQuery = mysqli_query($con , $InsertMessage);

        if($InsertQuery){
            echo "<div class='alert alert-success'>";
                echo "Inserted Successfuly";
            echo "</div>";
        }else{
            echo "not yet";
        }
    }   

    $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;
    // include "Nav.php";
    if($do == 'Manage'){
                    
                    ?>

            <h1 class="PageName"> Contact Us </h1>
            <div class="container">
                <form class="form-horizontal" action="" method="POST">
                    <input type="hidden" name="UserID" value="<?php echo $User['ID'] ?>">
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type="text" name="FirstName" placeholder="First Name" class="form-control" value="<?php if(isset($row['Name'])){ echo $row['Name']; } ?>" <?php if(isset($row['Name'])){ echo "disabled" ;} ?> />
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type="text" name="LastName" placeholder="Last Name" class="form-control" value="<?php if(isset($row['LastName'])){ echo $row['LastName']; } ?>"  <?php if(isset($row['LastName'])){ echo "disabled" ;} ?>  />
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type="number" name="Phone" placeholder="Phone" class="form-control" value="<?php if(isset($row['Phone'])){ echo $row['Phone']; } ?>" <?php if(isset($row['Phone'])){ echo "disabled" ;} ?>  />
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type="email" name="Email" placeholder="Email" class="form-control" value="<?php if(isset($row['Email'])){ echo $row['Email']; } ?>" <?php if(isset($row['Email'])){ echo "disabled" ;} ?> required />
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <textarea name="UsersQuestion" rows="3" placeholder="Type Your Message" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="InsertButton">
                            <input type="submit" name="Send" value="Send" class="btn btn-success btn-md w-10" />
                        </div>
                    </div>
                </form>
            </div>
        <?php
        
    }else{
        echo "<div class='container'>";
        $TheMsg = "<div class='alert alert-danger'>" . "This Page Does Not Exist"  . "</div>";
        RedirectIndex($TheMsg);
        echo "</div>";
    }

    include "./Includes/PageContent/Footer.php";




    


    ob_end_flush();
?>