<?php
    ob_start();

    $PageTitle = "Membership";

    include './init.php';

    session_start();
    session_regenerate_id();


    if(isset($_SESSION['UserID'])){
        $UserID = $_SESSION['UserID'];
        $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);

        if(isset($_POST['Confirm'])){
            
            $SelectUsers = "SELECT membershippayemnts .* , COUNT(UserID) AS CountedUsers FROM `membershippayemnts`  WHERE UserID = $UserID";
            $Query = mysqli_query($con , $SelectUsers);
            $CountedRow = mysqli_fetch_assoc($Query);

            $date = date('y-m-d');
            $EndDate = date('Y-m-d', strtotime($date. ' +1 month'));
            
            if($CountedRow['CountedUsers'] < 1){
                $UserID = $_POST['UserID'];
                $MembershipID = $_POST['MembershipID']; 
                $PaymentID = $_POST['Payment'];
                $Cost = $_POST['Cost'];
    
                
    
                $InsertDonate = "INSERT INTO `membershippayemnts`  VALUES( NULL , $UserID , $MembershipID , $Cost , $PaymentID , now() , '$EndDate' ) ";
                $InsertQuery = mysqli_query($con , $InsertDonate);
                if($InsertQuery){
                    echo "<div class='alert alert-success'>";
                        echo "You are joined ";
                    echo "</div>";
                }else{
                    echo "not yet";
                }
            }else{
                echo "Already Enrolled Your membership will ends in " . $EndDate;
            }

        }
    }


    $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;
    // include "Nav.php";
    if($do == 'Manage'){
                    $MembershipID = $_GET['MembershipID'];
                    ?>

            <h1 class="PageName"> Membership Join </h1>
            <div class="container">
                <form class="form-horizontal" action="" method="POST">
                    <input type="hidden" name="UserID" value="<?php echo $UserID  ?>">
                    <input type="hidden" name="MembershipID" value="<?php echo $MembershipID  ?>">
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type="text" name="FirstName" placeholder="First Name" class="form-control" value="<?php  echo $row['Name'];  ?>" disabled />
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type="text" name="LastName" placeholder="Last Name" class="form-control" value="<?php echo $row['LastName']; ?>"  disabled />
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type="number" name="Phone" placeholder="Phone" class="form-control" value="<?php echo $row['Phone']; ?>" disabled  />
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type="email" name="Email" placeholder="Email" class="form-control" value="<?php echo $row['Email']; ?>" disabled />
                        </div>
                    </div>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <select name="Payment" class="custom-select">
                                <option value="0"> Payment </option>
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
                    
                    <?php 
                        $Select = "SELECT ID , Price FROM membership WHERE ID = $MembershipID LIMIT 1";
                        $Query = mysqli_query($con , $Select);
                        $PriceRow = mysqli_fetch_assoc($Query);
                    ?>
                    <div class="form-group insertInput">
                        <div class="mb-20">
                            <input type='number' placeholder="Cost" class="form-control" value="<?php echo $PriceRow['Price']  ?>" disabled  />
                            <input type='hidden' name="Cost"  value="<?php echo $PriceRow['Price']  ?>"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="InsertButton">
                            <input type="submit" name="Confirm" value="Confirm" class="btn btn-success btn-md w-10" />
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