<?php
ob_start();

$PageTitle = "Application";

include './init.php';

session_start();
session_regenerate_id();

if (isset($_SESSION["UserID"])) { 

    $UserID = $_SESSION['UserID'];
    
        $do = isset($_GET['action']) ? $_GET['action'] : "Manage" ;

        if($do == "Manage"){
            $SelectQuery = "SELECT * FROM user WHERE ID = $UserID";
            $Select = mysqli_query($con, $SelectQuery);
            $row = mysqli_fetch_assoc($Select); 
            
                
                $SelectQuery = "SELECT  applications.* , COUNT(UserID) AS CountedUserID  FROM `applications` WHERE UserID = $UserID ";
                $Select = mysqli_query($con, $SelectQuery);
                $ApplicationRow = mysqli_fetch_assoc($Select);

                $FormError = array();
                // Appointment and  Status show
                if($ApplicationRow['Approved'] == 1){
                    echo "You are Accepted";
                }elseif($ApplicationRow['Approved'] == 0){
                    echo "Rejected Work on Yourself and try to submit again after 6 months";
                }elseif($ApplicationRow['Approved'] == 2 && $ApplicationRow['Date'] ){
                    echo "Your Interview is determined on " . $ApplicationRow['Date'] ;
                }elseif($ApplicationRow['Date'] == NULL && $ApplicationRow['ID'] != NULL){
                    echo "Wait for your interview soon";
                }
                
                if(isset($_POST['Submit'])){
                    $UserID = $_POST['UserID'];
                    $CareerID = $_POST['Career'];
                
                    
                    if(empty($CareerID)){
                        $FormError[] = 'Must Select Value For Careers';
                    }
                    if(empty($FormError)){
                        if($ApplicationRow['CountedUserID'] < 1 ){
                            $InsertMessage = "INSERT INTO `applications` (UserID , CareerID) VALUES( $UserID ,$CareerID) ";
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
            ?>
        
            <h1 class="PageName"> Careers </h1>
            <div class="container">
                <form class="form-horizontal" action="" method="POST">
                    <input type="hidden" name="UserID" value="<?php echo $UserID ?>">
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
                        <div class="m-auto">
                            <select name="Career" class="custom-select">
                                <option value="0"> Select a career </option>
                                <?php
                                $SelectQuery = "SELECT * FROM careers WHERE ID NOT IN (2 , 4 , 5) ";
                                $Select = mysqli_query($con, $SelectQuery);
                                $fetchquery = mysqli_fetch_assoc($Select);
                                foreach ($Select as $Career) {
                                    echo "<option value='" . $Career['ID'] . "' >" . $Career['Careers'] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="InsertButton">
                            <input type="submit" name="Submit" value="Submit" class="btn btn-success btn-md w-10" />
                        </div>
                    </div>
                </form>
            </div>
        <?php 
        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger'>"  . "No Page With This Name" . '</div>';
            RedirectIndex($TheMsg);
            echo "</div>";   
        }

    include "./Includes/PageContent/Footer.php";

}else{
    if(!isset($_SESSION["UserID"])){
        header("Location: login.php");
        exit();
    }
}

ob_end_flush();

?>