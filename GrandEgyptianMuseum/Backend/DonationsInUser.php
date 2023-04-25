<?php
    ob_start();

    $PageTitle = "Donate";

    include './init.php';

    session_start();
    session_regenerate_id();


    if(isset($_SESSION['UserID'])){
        $UserID = $_SESSION['UserID'];
        $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);
        if(isset($_POST['Send'])){
            $UserID = $_POST['UserID'];
            $Amount = $_POST['Amount']; 
            $PlaceID = $_POST['Place'];
            $PaymentID = $_POST['Payment'];



            $InsertDonate = "INSERT INTO `donations` (UserID , PlaceID , Amount , PaymentID) VALUES( $UserID , $PlaceID , $Amount , $PaymentID) ";
            $InsertQuery = mysqli_query($con , $InsertDonate);
            if($InsertQuery){
                echo "<div class='alert alert-success'>";
                    echo "Thanks for your donations";
                echo "</div>";
            }else{
                echo "not yet";
            }

            $SelectMembership = "SELECT membershippayemnts .* , COUNT(UserID) AS CountedUserID FROM `membershippayemnts` WHERE UserID = $UserID ";
            $SelectQuery = mysqli_query($con , $SelectMembership);
            $DonationRow = mysqli_fetch_assoc($SelectQuery);

            if($Amount >= 1000000 && $DonationRow['CountedUserID'] < 1){
                $date = date("Y-m-d");
                $EndDate = date('Y-m-d', strtotime($date. ' + 2 years'));

                $InsertMembership = "INSERT INTO `membershippayemnts` (UserID , MembershipID  , Cost , PaymentID , Date , EndsIn) VALUES( $UserID , 12 , $Amount , $PaymentID , now() , '$EndDate' ) ";
                $InsertQuery = mysqli_query($con , $InsertMembership);
                if($InsertQuery){
                    echo "<div class='alert alert-success'>";
                        echo "You are now a member of supporting membership";
                    echo "</div>";
                }else{
                    echo "not yet";
                }
            }elseif($Amount >= 1000000 && $DonationRow['CountedUserID'] == 1 && $DonationRow['MembershipID'] != 12 ){
                $date = date("Y-m-d");
                $EndDate = date('Y-m-d', strtotime($date. ' + 2 years'));

                $UpdateMembership = "UPDATE `membershippayemnts` SET MembershipID = 12 , Cost = $Amount , PaymentID = $PaymentID , Date = now() , EndsIn = '$EndDate' WHERE UserID = $UserID  ";
                $UpdatedQuery = mysqli_query($con , $UpdateMembership);
                if($UpdatedQuery){
                    echo "<div class='alert alert-success'>";
                        echo "You are membership is updated";
                    echo "</div>";
                }else{
                    echo "not yet";
                }
            }
        }
    }else{
        if(isset($_POST['Send'])){
            $Amount = $_POST['Amount']; 
            $PlaceID = $_POST['Place'];
            $FullName =  $_POST['FirstName'] . ' ' .  $_POST['LastName'] ;
            $Email = $_POST['Email'];
            $PaymentID = $_POST['Payment'];

            $InsertDonate = "INSERT INTO `donations` (Name , Email , PlaceID , Amount , PaymentID) VALUES( '$FullName', '$Email' , $PlaceID , $Amount , $PaymentID) ";
            $InsertQuery = mysqli_query($con , $InsertDonate);
    
            if($InsertQuery){
                echo "<div class='alert alert-success'>";
                    echo "Thanks for your donations";
                echo "</div>";
            }else{
                echo "not yet";
            }
        }
    }


    $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;
    // include "Nav.php";
    if($do == 'Manage'){
                    
                    ?>

            <h1 class="PageName"> Donations </h1>
            <div class="container">
                <form class="form-horizontal" action="" method="POST">
                    <input type="hidden" name="UserID" value="<?php if(isset($UserID)){echo $UserID ;} ?>">
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
                            <select name="Place" class="custom-select">
                                <option value="0"> Select a Place </option>
                                <?php
                                $SelectQuery = "SELECT * FROM place";
                                $Select = mysqli_query($con, $SelectQuery);
                                $fetchquery = mysqli_fetch_assoc($Select);
                                foreach ($Select as $Place) {
                                    echo "<option value='" . $Place['ID'] . "' >" . $Place['Name'] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <select name="Payment" class="custom-select">
                                <option value="0"> Select a Payment </option>
                                <?php
                                $SelectQuery = "SELECT * FROM paymentoptions";
                                $Select = mysqli_query($con, $SelectQuery);
                                $fetchquery = mysqli_fetch_assoc($Select);
                                foreach ($Select as $Payment) {
                                    echo "<option value='" . $Payment['ID'] . "' >" . $Payment['PaymentType'] . " </option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input name="Amount" placeholder="Donation" class="form-control" required />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="InsertButton">
                            <input type="submit" name="Send" value="Donate" class="btn btn-success btn-md w-10" />
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