<?php
ob_start();

$PageTitle = "Donation";

include './init.php';

session_start();

if (isset($_SESSION["AdminID"])) { 
    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);

    $AdminRole = $row['AdminRole'];
    
    if($AdminRole == 1 || $AdminRole == 2){
            include "./Nav.php";
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
                    <h1 class="PageName"> Donations </h1>
                        <div class="container">
                        <button class="Control" data-toggle="collapse" data-target="#Control">Control</button>
                                <div class="buttons collapse" id="Control">
                                    <div class='FilterAndButtons'>
                                        <a href="./Dashboard.php" class="btn btn-info">Back</a>
                                        <form method="POST">
                                            <div class="MultiFilters">
                                                <div class="RoleFilter">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-filter"></i>  Filter By Place
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <?php
                                                        $PlaceSelect = "SELECT DISTINCT place.Name AS PlaceName , donations.PlaceID AS PlaceID FROM `donations` JOIN place ON place.ID = donations.PlaceID  ";
                                                        $Run = mysqli_query($con , $PlaceSelect);
                                                        $row = mysqli_fetch_assoc($Run);

                                                        foreach($Run as $Place){ 
                                                            $Checked = [];
                                                            if(isset($_POST['PlaceName'])){
                                                                $Checked = $_POST['PlaceName'];
                                                            }
                                                            ?>
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" name="PlaceID[]" value="<?php echo $Place['PlaceID'] ?>" <?php if(in_array( $Place['PlaceID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                    <?php echo $Place['PlaceName'] ; ?>
                                                            </label>
                                                        <?php } ?>
                                                            <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                    </div>
                                                </div>
                                                <div class="RoleFilter">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-filter"></i>  Filter By Payment
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <?php
                                                        $PaymentSelect = "SELECT DISTINCT paymentoptions.PaymentType AS PaymentType , donations.PaymentID AS PaymentID FROM `donations` JOIN paymentoptions ON paymentoptions.ID = donations.PaymentID  ";
                                                        $Run = mysqli_query($con , $PaymentSelect);
                                                        $row = mysqli_fetch_assoc($Run);

                                                        foreach($Run as $Payment){ 
                                                            $Checked = [];
                                                            if(isset($_POST['PaymentType'])){
                                                                $Checked = $_POST['PaymentType'];
                                                            }
                                                            ?>
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" name="PaymentID[]" value="<?php echo $Payment['PaymentID'] ?>" <?php if(in_array( $Payment['PaymentID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                    <?php echo $Payment['PaymentType'] ; ?>
                                                            </label>
                                                        <?php } ?>
                                                            <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    
                                    <div class='MultiSorting'>
                                        <div class="MultiSort collapse" id="Control" >
                                            <i class="fa-solid fa-sort"></i> Sorting : [
                                                <a href="./Donatiton.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                echo 'active';
                                                                            } ?>"> Asc </a> |
                                                <a href="./Donatiton.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                echo 'active';
                                                                            } ?>"> Desc </a> ]
                                        </div>
                                        <div class="MultiSort collapse" id="Control" >
                                            <i class="fa-solid fa-sort"></i> Amount : [
                                                <a href="./Donatiton.php?action=Manage&Amountsort=ASC" class="<?php if ($Amountsort == 'ASC') {
                                                                                echo 'active';
                                                                            } ?>"> Lowest </a> |
                                                <a href="./Donatiton.php?action=Manage&Amountsort=DESC" class="<?php if ($Amountsort == 'DESC') {
                                                                                echo 'active';
                                                                            } ?>"> Highest </a> ]
                                        </div>
                                    </div>
                                </div>
                            <div class="table-responsive">
                                <table class="main-table table table-bordered table-hover">
                                    <tr>
                                        <td>ID</td>
                                        <td>Name</td>
                                        <td>Email</td>
                                        <td>Place</td>
                                        <td>Payment</td>
                                        <td>Amount</td>
                                    </tr>
                                    <?php
                                    
                                    if(isset($_POST['PlaceID']) && isset($_POST['PaymentID'])){
                                        $sql = "WHERE donations.PlaceID IN(".implode(',', $_POST['PlaceID'] ).") AND donations.PaymentID IN (".implode(',', $_POST['PaymentID']).")" ; 

                                            $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName FROM donations
                                            left JOIN user ON donations.UserID = user.ID
                                            JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                                            JOIN place ON donations.PlaceID = place.ID
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
                                                        echo "<td>" . $Donation['Amount']   . "</td>";
                                                    echo "</tr>";
                                                } 
                                            }
                                    }elseif(isset($_POST['PlaceID']) && !isset($_POST['PaymentID'])){
                                        $sql = "WHERE donations.PlaceID IN(".implode(',', $_POST['PlaceID']).")";

                                            $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName FROM donations
                                                                left JOIN user ON donations.UserID = user.ID
                                                                JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                                                                JOIN place ON donations.PlaceID = place.ID
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
                                                    echo "<td>" . $Donation['Amount']   . "</td>";
                                                echo "</tr>";
                                            }  
                                        }
                                    }elseif(isset($_POST['PaymentID']) && !isset($_POST['PlaceID'])){
                                        $sql = "WHERE donations.PaymentID IN(". implode(',', $_POST['PaymentID']).")";
                                        $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName FROM donations
                                            left JOIN user ON donations.UserID = user.ID
                                            JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                                            JOIN place ON donations.PlaceID = place.ID
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
                                                    echo "<td>" . $Donation['Amount']   . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    }else{
                                            $DonationsQuery = "SELECT donations . * , user.Name AS UserName, user.Email AS UserEmail , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName FROM donations
                                            left JOIN user ON donations.UserID = user.ID
                                            JOIN paymentoptions ON donations.PaymentID = paymentoptions.ID
                                            JOIN place ON donations.PlaceID = place.ID
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
                                                    echo "<td>" . $Donation['Amount']   . "</td>";
                                                echo "</tr>";
                                            }
                                        
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                                
                <?php }else{
                echo "No Current Data";
                }
        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger'>" . "No Page With This Name"  . "</div>";
            RedirectIndex($TheMsg);
            echo "</div>";
        }
    
    }else{
        echo "<div class='container'>";
        $TheMsg = "<div class='alert alert-danger'>" . "You Are Not Authorized To Access This Platform"  . "</div>";
        RedirectIndex($TheMsg);
        echo "</div>";
    }
    include "./Includes/PageContent/Footer.php";
}else{
    if(!isset($_SESSION["AdminID"])){
        header("Location: SignIn.php");
        exit();
    }
}

ob_end_flush();
?>


