<?php
ob_start();

$PageTitle = "Tickets";

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

        if( $AdminRole != 4 ){
            
            $do = isset($_GET['action']) ?  $_GET['action'] : "Visit" ;

            if($do == "Entertainment"){
                $sort = 'ASC';
                $PriceSort ='ASC';
                $sortarray = array('ASC', 'DESC');
            
                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];                
                }

                if (isset($_GET['PriceSort']) && in_array($_GET['PriceSort'], $sortarray)) {
                    $PriceSort = $_GET['PriceSort'];
                }
                $ETicketQuery = "SELECT entertainmnetticket . * , user.Name AS UserName , paymentoptions.PaymentType AS Payment , entertainmnet.Name AS EventName FROM entertainmnetticket
                                        JOIN user ON entertainmnetticket.UserID = user.ID
                                        JOIN paymentoptions ON entertainmnetticket.PaymentID = paymentoptions.ID
                                        JOIN entertainmnet ON entertainmnetticket.EventID = entertainmnet.ID
                                        ORDER BY Price $PriceSort , entertainmnetticket.ID $sort
                                    ";
                    $Query = mysqli_query($con , $ETicketQuery);
                    $fetchquery = mysqli_fetch_row($Query);
                    $count =mysqli_num_rows($Query);
                    if($count > 0 ){
                        ?>
                        <div class="page d-flex">

                            <div class=" w-280 sidepar p-20 p-relative">
                                <h3 class="p-relative txt-center mt-0">Control</h3>
                                <form method="post">
                                    <ul>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Tickets.php?action=Visit">
                                                <i class="fa-solid fa-ticket fa-fw"></i><span> Visits Tickets </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Dashboard.php">
                                                <i class="fa-solid fa-arrow-left fa-fw"></i><span> Dashboard </span>
                                            </a>
                                        </li>
                                        <li>
                                            <h6 class='txt-center mt-20 cursor-d'> <i class="fa-solid fa-filter fa-fw"></i> Filters </h6>
                                        </li>
                                        <li>
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Payment </p>
                                        </li>
                                            <?php

                                                $PaymentSelect = "SELECT DISTINCT paymentoptions.PaymentType AS PaymentType , entertainmnetticket.PaymentID AS PaymentID FROM `entertainmnetticket` 
                                                                JOIN paymentoptions ON paymentoptions.ID = entertainmnetticket.PaymentID  ";
                                                $Run = mysqli_query($con , $PaymentSelect);
                                                $row = mysqli_fetch_assoc($Run);

                                                foreach($Run as $Payment){ 
                                                    $Checked = [];
                                                    if(isset($_POST['PaymentID'])){
                                                        $Checked = $_POST['PaymentID'];
                                                    }
                                            ?>
                                        <li>
                                                <input type="checkbox" name="PaymentID[]" value="<?php echo $Payment['PaymentID'] ?>" <?php if(in_array($Payment['PaymentID'] , $Checked)){ echo "Checked" ;  } ?>/>
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
                                                            <a href="./Tickets.php?action=Entertainment&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> ASC </a> |
                                                            <a href="./Tickets.php?action=Entertainment&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> DESC </a> ]
                                            </div>
                                        </li>
                                        <li>
                                            <div class="p-10 fs-14">
                                                Price : [
                                                            <a href="./Tickets.php?action=Entertainment&PriceSort=ASC" class="<?php if ($PriceSort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> ASC </a> |
                                                            <a href="./Tickets.php?action=Entertainment&PriceSort=DESC" class="<?php if ($PriceSort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> DESC</a> ]
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                                    <div class="container">
                                        <h1 class="PageName"> Entertainment Tickets </h1>
                                        <div class="input-group md-form form-sm form-2 pl-0 mb-20">
                                            <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." id="myInput" onkeyup="myFunction()" aria-label="Search">
                                            <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="main-table table table-bordered table-hover table-light" id="myTable">
                                                <tr>
                                                    <td>ID</td>
                                                    <td>User Name</td>
                                                    <td>Entertainment</td>
                                                    <td>Quantity</td>
                                                    <td>Total</td>
                                                    <td>Payment</td>
                                                </tr>
                                                <?php
                                            if(isset($_POST['PaymentID'])){
                                                $sql = "WHERE entertainmnetticket.PaymentID IN(".implode(',', $_POST['PaymentID'] ).")" ; 
        
                                                $ETicketQuery = "SELECT entertainmnetticket . * , user.Name AS UserName ,  user.LastName AS LastName, paymentoptions.PaymentType AS Payment , entertainmnet.Name AS EventName FROM entertainmnetticket
                                                                    JOIN user ON entertainmnetticket.UserID = user.ID
                                                                    JOIN paymentoptions ON entertainmnetticket.PaymentID = paymentoptions.ID
                                                                    JOIN entertainmnet ON entertainmnetticket.EventID = entertainmnet.ID
                                                                    $sql
                                                                    ORDER BY Price $PriceSort , entertainmnetticket.ID $sort
                                                                    ";
                                                $Query = mysqli_query($con , $ETicketQuery);
                                                $fetchquery = mysqli_fetch_row($Query);
                                                $count =mysqli_num_rows($Query);
                                                
                                                
                                                if($count > 0 ){
                                                    foreach ($Query as $ETicket) {
                                                        $FullName =  $ETicket['UserName'] . ' ' .  $ETicket['LastName'] ;

                                                        echo "<tr id='TableData'>";
                                                            echo "<td>" . $ETicket['ID']     . "</td>";
                                                            echo "<td><a href='./Users.php?action=MoreInfo&UserID=". $ETicket['UserID'] ."'>" . $FullName  . "</a></td>";
                                                            echo "<td><a href='./Entertainments.php?action=MoreInfo&EventID=". $ETicket['EventID'] ."'>" . $ETicket['EventName']   . "</a></td>";
                                                            echo "<td>" . $ETicket['Quantity']   . "</td>";
                                                            echo "<td>" . $ETicket['Price']   . "</td>";
                                                            echo "<td>" . $ETicket['Payment']   . "</td>";
                                                        echo "</tr>";
                                                    } 
                                                }
                                            }else{
                                                $ETicketQuery = "SELECT entertainmnetticket . * , user.Name AS UserName, user.LastName AS LastName , paymentoptions.PaymentType AS Payment , entertainmnet.Name AS EventName FROM entertainmnetticket
                                                JOIN user ON entertainmnetticket.UserID = user.ID
                                                JOIN paymentoptions ON entertainmnetticket.PaymentID = paymentoptions.ID
                                                JOIN entertainmnet ON entertainmnetticket.EventID = entertainmnet.ID
                                                ORDER BY Price $PriceSort , entertainmnetticket.ID $sort
                                                ";
                                                $Query = mysqli_query($con , $ETicketQuery);
                                                $fetchquery = mysqli_fetch_row($Query);
                                                $count =mysqli_num_rows($Query);
                                                
                                                foreach ($Query as $ETicket) {
                                                    $FullName =  $ETicket['UserName'] . ' ' .  $ETicket['LastName'] ;

                                                    echo "<tr id='TableData'>";
                                                        echo "<td>" . $ETicket['ID']     . "</td>";
                                                        echo "<td><a href='./Users.php?action=MoreInfo&UserID=". $ETicket['UserID'] ."'>" . $FullName   . "</a></td>";
                                                        echo "<td><a href='./Entertainments.php?action=MoreInfo&EventID=". $ETicket['EventID'] ."'>" . $ETicket['EventName']   . "</a></td>";
                                                        echo "<td>" . $ETicket['Quantity']   . "</td>";
                                                        echo "<td>" . $ETicket['Price']   . "</td>";
                                                        echo "<td>" . $ETicket['Payment']   . "</td>";
                                                    echo "</tr>";
                                                } 
                                                
                                            }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                    </div>            
                    <?php }else{
                        echo "<div class='No-Data'> No Current Data  </div>";
                    }

            }elseif($do == "Visit"){
                $sort = 'ASC';
                $DateSort = 'ASC';
                $sortarray = array('ASC', 'DESC');
            
                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];                
                }
                if (isset($_GET['DateSort']) && in_array($_GET['DateSort'], $sortarray)) {
                    $DateSort = $_GET['DateSort'];                
                }

                $ETicketQuery = "SELECT visitticket . * , user.Name AS UserName , user.RoleID  AS RoleID , userrole.RoleName AS RoleName , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName , place.ID AS PlaceID FROM visitticket
                                LEFT JOIN user ON visitticket.UserID = user.ID 
                                    LEFT  JOIN userrole ON userrole.ID = user.RoleID
                                LEFT JOIN paymentoptions ON visitticket.PaymentID = paymentoptions.ID
                                LEFT JOIN place ON visitticket.PlaceID = place.ID
                                ORDER BY visitticket.ID $sort , Date $DateSort
                                ";
                $Query = mysqli_query($con , $ETicketQuery);
                $fetchquery = mysqli_fetch_row($Query);
                $count = mysqli_num_rows($Query);
                if($count > 0 ){
                            ?>
                    <div class="page d-flex">

                        <div class=" w-280 sidepar p-20 p-relative">
                            <h3 class="p-relative txt-center mt-0">Control</h3>
                            <form method="post">
                                <ul>
                                    <li>
                                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Tickets.php?action=Entertainment">
                                            <i class="fa-solid fa-ticket fa-fw"></i><span> Entertainments Tickets </span>
                                        </a>
                                    </li>
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
                                            $PlaceSelect = "SELECT DISTINCT place.Name AS PlaceName , visitticket.PlaceID AS PlaceID FROM 
                                                            `visitticket` JOIN place ON place.ID = visitticket.PlaceID  ";
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
                                        <p class='mt-20 ml-20 cursor-d fw-bold'>By Role </p>
                                    </li>
                                            <?php
                                            $SRoleSelect = "SELECT DISTINCT userrole.ID AS RoleID, RoleName FROM `userrole` ORDER BY RoleName ASC ";
                                            $Run = mysqli_query($con , $SRoleSelect);
                                            $row = mysqli_fetch_assoc($Run);

                                            foreach($Run as $Role){ 
                                                $Checked = [];
                                                if(isset($_POST['RoleID'])){
                                                    $Checked = $_POST['RoleID'];
                                                }
                                                ?>
                                    <li>
                                        <input type="checkbox" name="RoleID[]" value="<?php echo $Role['RoleID'] ?>" <?php if(in_array( $Role['RoleID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                            <?php echo $Role['RoleName'] ?>
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
                                                        <a href="./Tickets.php?action=Visit&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Asc </a> |
                                                        <a href="./Tickets.php?action=Visit&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Desc </a> ]
                                        </div>
                                    </li>
                                    <li>
                                        <div class="p-10 fs-14">
                                            Date : [
                                                        <a href="./Tickets.php?action=Visit&DateSort=ASC" class="<?php if ($DateSort == 'ASC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Nearest </a> |
                                                        <a href="./Tickets.php?action=Visit&DateSort=DESC" class="<?php if ($DateSort == 'DESC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Furthest</a> ]
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                                <div class="container">
                                <h1 class="PageName"> Visit Tickets </h1>
                                    <div class="input-group md-form form-sm form-2 pl-0 mb-20">
                                        <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." id="myInput" onkeyup="myFunction()" aria-label="Search">
                                        <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="main-table table table-bordered table-hover table-light" id="myTable">
                                            <tr>
                                                <td>ID</td>
                                                <td>User Name</td>
                                                <td>Role</td>
                                                <td>Place</td>
                                                <td>Date</td>
                                                <td>Quantity</td>
                                                <td>Total</td>
                                                <td>Payment</td>
                                            </tr>
                                            <?php
                                                if(isset($_POST['RoleID']) && isset($_POST['PlaceID'])){
                                                            $sql = "WHERE visitticket.PlaceID IN(".implode(',', $_POST['PlaceID'] ).") AND RoleID IN (".implode(',', $_POST['RoleID']).")" ; 
                    
                                                            $ETicketQuery = "SELECT visitticket . * , user.Name AS UserName , user.RoleID  AS RoleID , userrole.RoleName AS RoleName ,  user.LastName AS LastName , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName , place.ID AS PlaceID FROM visitticket
                                                            LEFT JOIN user ON visitticket.UserID = user.ID 
                                                                LEFT JOIN userrole ON userrole.ID = user.RoleID
                                                            LEFT JOIN paymentoptions ON visitticket.PaymentID = paymentoptions.ID
                                                            LEFT JOIN place ON visitticket.PlaceID = place.ID
                                                            $sql
                                                            ORDER BY Date $DateSort ,visitticket.ID $sort 
                                                            ";
                                                            $Query = mysqli_query($con , $ETicketQuery);
                                                            $fetchquery = mysqli_fetch_row($Query);
                                                            $count =mysqli_num_rows($Query);
                                                            
                                                            
                        
                                                            
                                                            if($count > 0 ){
                                                                foreach ($Query as $VTicket) {
                                                                    $FullName =  $VTicket['UserName'] . ' ' .  $VTicket['LastName'] ;
                                                                    echo "<tr id='TableData'>";
                                                                        echo "<td>" . $VTicket['ID']     . "</td>";
                                                                        echo "<td><a href='./Users.php?action=MoreInfo&UserID=". $VTicket['UserID'] ."' class='t-none'>" . $FullName   . "</td>";
                                                                        echo "<td>";
                                                                            if(isset($VTicket['RoleName'])){ 
                                                                                echo $VTicket['RoleName'] ;
                                                                            }else{
                                                                                echo "<p class='fs-13 c-gray'>Not Determined yet</p>" ;
                                                                            } 
                                                                        echo "</td>";                                                                        echo "<td>" . $VTicket['PlaceName']   . "</td>";
                                                                        echo "<td>" . $VTicket['Date']   . "</td>";
                                                                        echo "<td>" . $VTicket['Quantity']   . "</td>";
                                                                        echo "<td>" . $VTicket['Total']   . "</td>";
                                                                        echo "<td>" . $VTicket['Payment']   . "</td>";
                                                                    echo "</tr>";
                                                                } 
                                                            }
                                                }elseif(isset($_POST['PlaceID']) && !isset($_POST['RoleID'])){
                                                    $sql = "WHERE visitticket.PlaceID IN(".implode(',', $_POST['PlaceID']).")";

                                                    $ETicketQuery = "SELECT visitticket . * , user.Name AS UserName,  user.LastName AS LastName  , user.RoleID  AS RoleID , userrole.RoleName AS RoleName , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName , place.ID AS PlaceID FROM visitticket
                                                    LEFT JOIN user ON visitticket.UserID = user.ID 
                                                        LEFT JOIN userrole ON userrole.ID = user.RoleID
                                                    LEFT JOIN paymentoptions ON visitticket.PaymentID = paymentoptions.ID
                                                    LEFT JOIN place ON visitticket.PlaceID = place.ID
                                                    $sql
                                                    ORDER BY Date $DateSort ,visitticket.ID $sort 
                                                    ";
                                                    $Query = mysqli_query($con , $ETicketQuery);
                                                    $fetchquery = mysqli_fetch_row($Query);
                                                    $count =mysqli_num_rows($Query);
                                                    
                                                    

                                                    
                                                    if($count > 0 ){
                                                        foreach ($Query as $VTicket) {
                                                            $FullName =  $VTicket['UserName'] . ' ' .  $VTicket['LastName'] ;
                                                            echo "<tr id='TableData'>";
                                                                echo "<td>" . $VTicket['ID']     . "</td>";
                                                                echo "<td><a href='./Users.php?action=MoreInfo&UserID=". $VTicket['UserID'] ."' class='t-none'>" . $FullName   . "</td>";
                                                                echo "<td>";
                                                                        if(isset($VTicket['RoleName'])){ 
                                                                            echo $VTicket['RoleName'] ;
                                                                        }else{
                                                                            echo "<p class='fs-13 c-gray'>Not Determined yet</p>" ;
                                                                        } 
                                                                echo "</td>";                                                                echo "<td>" . $VTicket['PlaceName']   . "</td>";
                                                                echo "<td>" . $VTicket['Date']   . "</td>";
                                                                echo "<td>" . $VTicket['Quantity']   . "</td>";
                                                                echo "<td>" . $VTicket['Total']   . "</td>";
                                                                echo "<td>" . $VTicket['Payment']   . "</td>";
                                                            echo "</tr>";
                                                        } 
                                                    }
                                                }elseif(isset($_POST['RoleID']) && !isset($_POST['PlaceID'])){
                                                    $sql = "WHERE RoleID IN(". implode(',', $_POST['RoleID']).")";
                                                    
                                                    $EVTicketQuery = "SELECT visitticket . * , user.Name AS UserName , user.LastName AS LastName , user.RoleID  AS RoleID , userrole.RoleName AS RoleName , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName , place.ID AS PlaceID FROM visitticket
                                                    LEFT JOIN user ON visitticket.UserID = user.ID 
                                                        LEFT JOIN userrole ON userrole.ID = user.RoleID
                                                    LEFT JOIN paymentoptions ON visitticket.PaymentID = paymentoptions.ID
                                                    LEFT JOIN place ON visitticket.PlaceID = place.ID
                                                    $sql
                                                    ORDER BY Date $DateSort ,visitticket.ID $sort 
                                                    ";

                                                    $Query = mysqli_query($con , $EVTicketQuery);
                                                    $fetchquery = mysqli_fetch_row($Query);
                                                    $count =mysqli_num_rows($Query);
                                                    
                                                    if($count > 0 ){
                                                        foreach ($Query as $VTicket) {
                                                            $FullName =  $VTicket['UserName'] . ' ' .  $VTicket['LastName'] ;
                                                            echo "<tr id='TableData'>";
                                                                echo "<td>" . $VTicket['ID']     . "</td>";
                                                                echo "<td><a href='./Users.php?action=MoreInfo&UserID=". $VTicket['UserID'] ."' class='t-none'>" . $FullName   . "</td>";
                                                                echo "<td>";
                                                                        if(isset($VTicket['RoleName'])){ 
                                                                            echo $VTicket['RoleName'] ;
                                                                        }else{
                                                                            echo "<p class='fs-13 c-gray'>Not Determined yet</p>" ;
                                                                        } 
                                                                echo "</td>";                                                                echo "<td>" . $VTicket['PlaceName']   . "</td>";
                                                                echo "<td>" . $VTicket['Date']   . "</td>";
                                                                echo "<td>" . $VTicket['Quantity']   . "</td>";
                                                                echo "<td>" . $VTicket['Total']   . "</td>";
                                                                echo "<td>" . $VTicket['Payment']   . "</td>";
                                                            echo "</tr>";
                                                        } 
                                                    }
                                                }else{
                                                    $ETicketQuery = "SELECT visitticket . * , user.Name AS UserName , user.LastName AS LastName , user.RoleID  AS RoleID , userrole.RoleName AS RoleName , paymentoptions.PaymentType AS Payment , place.Name AS PlaceName , place.ID AS PlaceID FROM visitticket
                                                    LEFT JOIN user ON visitticket.UserID = user.ID 
                                                        LEFT JOIN userrole ON userrole.ID = user.RoleID
                                                    LEFT JOIN paymentoptions ON visitticket.PaymentID = paymentoptions.ID
                                                    LEFT JOIN place ON visitticket.PlaceID = place.ID
                                                    ORDER BY Date $DateSort ,visitticket.ID $sort 
                                                    ";
                                                    $Query = mysqli_query($con , $ETicketQuery);
                                                    $fetchquery = mysqli_fetch_row($Query);
                                                    $count =mysqli_num_rows($Query);
                                                    
                                                    foreach ($Query as $VTicket) {
                                                        $FullName =  $VTicket['UserName'] . ' ' .  $VTicket['LastName'] ;
                                                        echo "<tr id='TableData'>";
                                                            echo "<td>" . $VTicket['ID']     . "</td>";
                                                            echo "<td><a href='./Users.php?action=MoreInfo&UserID=". $VTicket['UserID'] ."' class='t-none'>" . $FullName   . "</td>";
                                                            echo "<td>";
                                                                if(isset($VTicket['RoleName'])){ 
                                                                    echo $VTicket['RoleName'] ;
                                                                }else{
                                                                    echo "<p class='fs-13 c-gray'>Not Determined yet</p>" ;
                                                                } 
                                                            echo "</td>";
                                                            echo "<td>" . $VTicket['PlaceName']   . "</td>";
                                                            echo "<td>" . $VTicket['Date']   . "</td>";
                                                            echo "<td>" . $VTicket['Quantity']   . "</td>";
                                                            echo "<td>" . $VTicket['Total']   . "</td>";
                                                            echo "<td>" . $VTicket['Payment']   . "</td>";
                                                        echo "</tr>";
                                                    } 
                                                    
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                    </div>
                                    
                <?php }else{
                        echo "<div class='No-Data'> No Current Data  </div>";
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
