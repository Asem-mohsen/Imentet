<?php
ob_start();

$PageTitle = "Donation";

include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";

session_start();
session_regenerate_id();

if (isset($_SESSION["AdminID"])) { 
    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
    $AdminRole = $row['AdminRole'];

    include './NavAdmin.php';

        if($AdminRole == 1 || $AdminRole == 2){
            $do = isset($_GET['action']) ? $_GET['action'] : "Manage" ;
                
            if($do == "Manage"){
                $sort = 'ASC';
                $Amountsort ='ASC';
                $sortarray = array('ASC', 'DESC');
            
                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];                
                }

                if (isset($_GET['Amountsort']) && in_array($_GET['Amountsort'], $sortarray)) {
                    $Amountsort = $_GET['Amountsort'];
                }
                $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName FROM donations
                left JOIN user ON donations.UserID = user.ID
                JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                JOIN place ON donations.PlaceID = place.ID
                ORDER BY donations.Amount $Amountsort, donations.ID $sort
                ";
                $Query = mysqli_query($con , $DonationsQuery);
                $fetchquery = mysqli_fetch_row($Query);
                $count =mysqli_num_rows($Query);
                if($count > 0 ){
                    ?>
                        <div class="page d-flex">
                            <div class="w-280 sidepar p-20 p-relative">
                                <h3 class="p-relative txt-center mt-0">Control</h3>
                                <form method="post">
                                    <ul>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Dashboard.php">
                                                <i class="fa-solid fa-arrow-left fa-fw"></i><span> Dashboard </span>
                                            </a>
                                        </li>
                                        <li>
                                            <h6 class='txt-center mt-20 cursor-d'> <i class="fa-solid fa-filter fa-fw"></i> Filters </h6>
                                        </li>
                                        <li>
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Place </p>
                                        </li>
                                            <?php
                                                $PlaceSelect = "SELECT DISTINCT place.Name AS PlaceName , donations.PlaceID AS PlaceID FROM `donations` JOIN place ON place.ID = donations.PlaceID  ";
                                                $Run = mysqli_query($con , $PlaceSelect);
                                                $row = mysqli_fetch_assoc($Run);

                                                foreach($Run as $Place){ 
                                                    $Checked = [];
                                                    if(isset($_POST['PlaceID'])){
                                                        $Checked = $_POST['PlaceID'];
                                                    }
                                            ?>
                                        <li>
                                                <input type="checkbox" name="PlaceID[]" value="<?php echo $Place['PlaceID'] ?>" <?php if(in_array( $Place['PlaceID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                <?php echo $Place['PlaceName'] ; ?>
                                        </li>
                                                <?php } 
                                            ?>
                                            
                                        <li>
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Payment </p>
                                        </li>
                                                <?php
                                                    $PaymentSelect = "SELECT DISTINCT paymentoptions.PaymentType AS PaymentType , donations.PaymentID AS PaymentID FROM `donations` JOIN paymentoptions ON paymentoptions.ID = donations.PaymentID  ";
                                                    $Run = mysqli_query($con , $PaymentSelect);
                                                    $row = mysqli_fetch_assoc($Run);

                                                    foreach($Run as $Payment){ 
                                                        $Checked = [];
                                                        if(isset($_POST['PaymentID'])){
                                                            $Checked = $_POST['PaymentID'];
                                                        }
                                                ?>
                                        <li>
                                                <input type="checkbox" name="PaymentID[]" value="<?php echo $Payment['PaymentID'] ?>" <?php if(in_array( $Payment['PaymentID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                <?php echo $Payment['PaymentType'] ; ?>
                                        </li>
                                                <?php } 
                                            ?>
                                                <button type="submit" class="filterCareersbutton">Filter</button>
                                        <li>
                                            <h6 class='txt-center mt-20'><i class="fa-solid fa-sort fa-fw"></i> Sorting </h6>
                                        </li>
                                        <li>
                                            <div class="p-10 fs-14">
                                                Sorting : [
                                                            <a href="./Donatiton.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Asc </a> |
                                                            <a href="./Donatiton.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Desc </a> ]
                                            </div>
                                        </li>
                                        <li>
                                            <div class="p-10 fs-14">
                                                Amount : [
                                                            <a href="./Donatiton.php?action=Manage&Amountsort=ASC" class="<?php if ($Amountsort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Lowest </a> |
                                                            <a href="./Donatiton.php?action=Manage&Amountsort=DESC" class="<?php if ($Amountsort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Highest</a>]
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <div class="container">
                            <h1 class="PageName"> Donations </h1>
                                <div class="table-responsive">
                                    <table class="main-table table table-bordered table-hover table-light">
                                        <tr>
                                            <td>ID</td>
                                            <td>Name</td>
                                            <td>Email</td>
                                            <td>Place</td>
                                            <td>Payment</td>
                                            <td>Membership</td>
                                            <td>Amount</td>
                                        </tr>
                                        <?php
                                        
                                        if(isset($_POST['PlaceID']) && isset($_POST['PaymentID'])){
                                            $sql = "WHERE donations.PlaceID IN(".implode(',', $_POST['PlaceID'] ).") AND donations.PaymentID IN (".implode(',', $_POST['PaymentID']).")" ; 

                                                $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment ,
                                                                    place.Name AS PlaceName , membership.Type AS MembershipType
                                                                    FROM donations
                                                                    left JOIN user ON donations.UserID = user.ID
                                                                    JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                                                                    JOIN place ON donations.PlaceID = place.ID
                                                                    LEFT JOIN membershippayemnts ON membershippayemnts.UserID = user.ID 
                                                                    LEFT JOIN membership ON membershippayemnts.MembershipID = membership.ID
                                                                    $sql
                                                                    ORDER BY donations.Amount $Amountsort, donations.ID $sort
                                                                    ";                            
                                                $Query = mysqli_query($con , $DonationsQuery);
                                                $fetchquery = mysqli_fetch_row($Query);
                                                $count =mysqli_num_rows($Query);

                                                
                                                if($count > 0 ){
                                                    foreach ($Query as $Donation) {

                                                        echo "<tr>";
                                                            echo "<td>" . $Donation['ID']     . "</td>";
                                                            echo "<td>";
                                                                    if($Donation['UserID'] != NULL){
                                                                        echo "<a href='./Users.php?action=MoreInfo&UserID=". $Donation['UserID'] ."'>" . $Donation['UserName']   . "</a>";
                                                                    }else{
                                                                        echo $Donation['Name'];
                                                                    }
                                                            echo "</td>";
                                                            echo "<td>";
                                                                    if($Donation['UserID'] != NULL){
                                                                        echo $Donation['UserEmail'] ;
                                                                    }else{
                                                                        echo $Donation['Email'];
                                                                    }
                                                            echo "</td>";
                                                            echo "<td>" . $Donation['PlaceName']   . "</td>";
                                                            echo "<td>" . $Donation['Payment']   . "</td>";
                                                            echo "<td>";
                                                                        if($Donation['MembershipType'] != NULL){
                                                                            echo $Donation['MembershipType'] ;
                                                                        }else{
                                                                            echo "<p class='fs-13 c-gray'> Doesn't have Membership </p>";
                                                                        } 
                                                            echo "</td>";
                                                            echo "<td>" . thousandsCurrencyFormat($Donation['Amount'])   . "</td>";
                                                        echo "</tr>";
                                                    }
                                                }
                                        }elseif(isset($_POST['PlaceID']) && !isset($_POST['PaymentID'])){
                                            $sql = "WHERE donations.PlaceID IN(".implode(',', $_POST['PlaceID']).")";

                                                $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment ,
                                                                    place.Name AS PlaceName , membership.Type AS MembershipType
                                                                    FROM donations
                                                                    left JOIN user ON donations.UserID = user.ID
                                                                    JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                                                                    JOIN place ON donations.PlaceID = place.ID
                                                                    LEFT JOIN membershippayemnts ON membershippayemnts.UserID = user.ID 
                                                                    LEFT JOIN membership ON membershippayemnts.MembershipID = membership.ID
                                                                    $sql
                                                                    ORDER BY donations.Amount $Amountsort, donations.ID $sort

                                                                    ";                            
                                                
                                                $Query = mysqli_query($con , $DonationsQuery);
                                                $fetchquery = mysqli_fetch_row($Query);
                                                $count =mysqli_num_rows($Query);

                                            
                                            if($count > 0 ){
                                                foreach ($Query as $Donation) {

                                                    echo "<tr>";
                                                        echo "<td>" . $Donation['ID']     . "</td>";
                                                        echo "<td>";
                                                                if($Donation['UserID'] != NULL){
                                                                    echo "<a href='./Users.php?action=MoreInfo&UserID=". $Donation['UserID'] ."'>" . $Donation['UserName']   . "</a>";
                                                                }else{
                                                                    echo $Donation['Name'];
                                                                }
                                                        echo "</td>";
                                                        echo "<td>";
                                                                if($Donation['UserID'] != NULL){
                                                                    echo $Donation['UserEmail'] ;
                                                                }else{
                                                                    echo $Donation['Email'];
                                                                }
                                                        echo "</td>";
                                                        echo "<td>" . $Donation['PlaceName']   . "</td>";
                                                        echo "<td>" . $Donation['Payment']   . "</td>";
                                                        echo "<td>";
                                                                    if($Donation['MembershipType'] != NULL){
                                                                        echo $Donation['MembershipType'] ;
                                                                    }else{
                                                                        echo "<p class='fs-13 c-gray'> Doesn't have Membership </p>";
                                                                    } 
                                                        echo "</td>";
                                                        echo "<td>" . thousandsCurrencyFormat($Donation['Amount'])  . "</td>";
                                                    echo "</tr>";
                                                }  
                                            }
                                        }elseif(isset($_POST['PaymentID']) && !isset($_POST['PlaceID'])){
                                            $sql = "WHERE donations.PaymentID IN(". implode(',', $_POST['PaymentID']).")";
                                            $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment ,
                                                                place.Name AS PlaceName , membership.Type AS MembershipType
                                                                FROM donations
                                                                left JOIN user ON donations.UserID = user.ID
                                                                JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                                                                JOIN place ON donations.PlaceID = place.ID
                                                                LEFT JOIN membershippayemnts ON membershippayemnts.UserID = user.ID 
                                                                LEFT JOIN membership ON membershippayemnts.MembershipID = membership.ID
                                                                $sql
                                                                ORDER BY donations.Amount $Amountsort, donations.ID $sort
                                                                ";
                                            
                                                $Query = mysqli_query($con , $DonationsQuery);
                                                $fetchquery = mysqli_fetch_row($Query);
                                                $count =mysqli_num_rows($Query);

                                            
                                            if($count > 0 ){
                                                foreach ($Query as $Donation) {

                                                    echo "<tr>";
                                                        echo "<td>" . $Donation['ID']     . "</td>";
                                                        echo "<td>";
                                                                if($Donation['UserID'] != NULL){
                                                                    echo "<a href='./Users.php?action=MoreInfo&UserID=". $Donation['UserID'] ."'>" . $Donation['UserName']   . "</a>";
                                                                }else{
                                                                    echo $Donation['Name'];
                                                                }
                                                        echo "</td>";
                                                        echo "<td>";
                                                                if($Donation['UserID'] != NULL){
                                                                    echo $Donation['UserEmail'] ;
                                                                }else{
                                                                    echo $Donation['Email'];
                                                                }
                                                        echo "</td>";
                                                        echo "<td>" . $Donation['PlaceName']   . "</td>";
                                                        echo "<td>" . $Donation['Payment']   . "</td>";
                                                        echo "<td>";
                                                                    if($Donation['MembershipType'] != NULL){
                                                                        echo $Donation['MembershipType'] ;
                                                                    }else{
                                                                        echo "<p class='fs-13 c-gray'> Doesn't have Membership </p>";
                                                                    } 
                                                        echo "</td>";
                                                        echo "<td>" . thousandsCurrencyFormat($Donation['Amount'])   . "</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                        }else{
                                                $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment ,
                                                                    place.Name AS PlaceName , membership.Type AS MembershipType
                                                                    FROM donations
                                                                    left JOIN user ON donations.UserID = user.ID
                                                                    JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                                                                    JOIN place ON donations.PlaceID = place.ID
                                                                    LEFT JOIN membershippayemnts ON membershippayemnts.UserID = user.ID 
                                                                    LEFT JOIN membership ON membershippayemnts.MembershipID = membership.ID 
                                                                    ORDER BY donations.Amount $Amountsort, donations.ID $sort
                                                                    ";
                                                $Query = mysqli_query($con , $DonationsQuery);
                                                $fetchquery = mysqli_fetch_assoc($Query);
                                                $count =mysqli_num_rows($Query);
                                            
                                                foreach ($Query as $Donation) {

                                                    echo "<tr>";
                                                        echo "<td>" . $Donation['ID']     . "</td>";
                                                        echo "<td>";
                                                                if($Donation['UserID'] != NULL){
                                                                    echo "<a href='./Users.php?action=MoreInfo&UserID=". $Donation['UserID'] ."'>" . $Donation['UserName']   . "</a>";
                                                                }else{
                                                                    echo $Donation['Name'];
                                                                }
                                                        echo "</td>";
                                                        echo "<td>";
                                                                if($Donation['UserID'] != NULL){
                                                                    echo $Donation['UserEmail'] ;
                                                                }else{
                                                                    echo $Donation['Email'];
                                                                }
                                                        echo "</td>";
                                                        echo "<td>" . $Donation['PlaceName']   . "</td>";
                                                        echo "<td>" . $Donation['Payment']   . "</td>";
                                                        echo "<td>";
                                                                    if($Donation['MembershipType'] != NULL){
                                                                        echo $Donation['MembershipType'] ;
                                                                    }else{
                                                                        echo "<p class='fs-13 c-gray'> Doesn't have Membership </p>";
                                                                    } 
                                                        echo "</td>";
                                                        echo "<td>" . thousandsCurrencyFormat($Donation['Amount'])   . "</td>";
                                                    echo "</tr>";
                                                }
                                            
                                        }
                                        ?>
                                    </table>
                                </div>
                            </div>
                                    
                    <?php }else{
                        echo "<div class='NoData'>";
                            echo "No Current Data";
                        echo "</div>";
                    }
            }else{
                echo "<div class='container'>";
                $TheMsg = "<div class='alert alert-danger txt-center'>" . "No Page With This Name"  . "</div>";
                RedirectIndex($TheMsg);
                echo "</div>";
            }
        
        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger txt-center'>" . "You Are Not Authorized To Access This Platform"  . "</div>";
            RedirectIndex($TheMsg);
            echo "</div>";
        }
    include "./AdminFooter.php";

}else{
    if(!isset($_SESSION["AdminID"])){
        header("Location: login.php");
        exit();
    }
}

ob_end_flush();
?>


