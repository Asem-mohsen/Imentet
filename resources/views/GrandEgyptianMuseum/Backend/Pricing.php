<?php
ob_start();

$PageTitle = "Pricing System";

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

        if( $AdminRole == 1 || $AdminRole == 2 ){
            
            $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;

            if($do == "Manage"){
                    $sort = 'ASC';
                    $sortarray = array('ASC', 'DESC');
                
                    if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                        $sort = $_GET['sort'];                
                    }

                    $PriceQuery = "SELECT DISTINCT visitpricing. *, userrole.RoleName AS UserRole , place.Name AS PlaceName FROM visitpricing 
                                    JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                    JOIN place ON visitpricing.PlaceID = place.ID
                                    ORDER BY visitpricing.ID $sort 
                                    ";
                
                    $AboveQuery = mysqli_query($con , $PriceQuery);
                    $fetchquery = mysqli_fetch_row($AboveQuery);
                    $count =mysqli_num_rows($AboveQuery);
                    if($count > 0 ){
                        ?>
                        <div class="page d-flex">
                            <div class=" w-280 sidepar p-20 p-relative">
                                <h3 class="p-relative txt-center mt-0">Control</h3>
                                <form method="post">
                                    <ul>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Pricing.php?action=AddPricing">
                                                <i class="fa-solid fa-plus fa-fw"></i><span> Add New Pricing </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Payments.php?action=Manage">
                                                <i class="fa-solid fa-circle-dollar-to-slot fa-fw"></i><span> Payments </span>
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
                                                $PlaceSelect = "SELECT DISTINCT place.Name AS PlaceName , visitpricing.PlaceID AS PlaceID FROM 
                                                                `visitpricing` JOIN place ON place.ID = visitpricing.PlaceID";
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
                                                            <a href="./Pricing.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Asc </a> |
                                                            <a href="./Pricing.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Desc </a> ]
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                                
                            <section class="pricing-section">
                                <div class="container">
                                    <div class="row justify-content-md-center">
                                        <div class="col-xl-5 col-lg-6 col-md-8">
                                            <div class="section-title text-center title-ex1">
                                                <h1 class="PageName" style="margin-top:27px;">Pricing</h1>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex f-wrap">
                                            <?php 
                                                if(isset($_POST['RoleID']) && isset($_POST['PlaceID'])){
                                                    $sql = "WHERE visitpricing.PlaceID IN(".implode(',', $_POST['PlaceID'] ).") AND visitpricing.UserRole IN (".implode(',', $_POST['RoleID']).")" ; 
            
                                                    $PriceQuery = "SELECT DISTINCT visitpricing. *, userrole.RoleName AS UserRole , visitpricing.UserRole AS RoleID ,place.Name AS PlaceName FROM visitpricing 
                                                                    JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                                                    JOIN place ON visitpricing.PlaceID = place.ID
                                                                    $sql
                                                                    ORDER BY visitpricing.ID $sort 
                                                                    ";
                                
                                                    $Query = mysqli_query($con , $PriceQuery);
                                                    $fetchquery = mysqli_fetch_row($Query);
                                                    $count =mysqli_num_rows($Query);
            
                                                    
                                                    if($count > 0 ){
                                                        foreach($Query as $Pricing){ ?>
                                                            <div class="PriceDiv" style="margin: auto;">
                                                                <div class="price-card">
                                                                    <h2><?php echo $Pricing['UserRole'] ?></h2>
                                                                    <ul class="pricing-offers">
                                                                        <li class="fw-bold"><?php echo $Pricing['PlaceName'] ?></li>
                                                                        <li><?php 
                                                                                if($Pricing['MuseumFee']){
                                                                                    echo "<div class=''>";
                                                                                        echo "<p>Entrance : <span>". $Pricing['EntranceFee'] ."</span></p>";
                                                                                        echo "<p>Museum : <span>". $Pricing['MuseumFee'] ."</span></p>";
                                                                                    echo "</div>";
                                                                                }else{
                                                                                    echo "<div class=''>";
                                                                                        echo "<p>Entrance : <span>".  $Pricing['EntranceFee'] ."</span></p>";
                                                                                    echo "</div>";
                                                                                }?>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="d-flex space-between">
                                                                        <a href="./Pricing.php?action=Edit&PricingID=<?php echo $Pricing['ID'] ?>&RoleID=<?php echo $Pricing['RoleID']?>" class="btn btn-success btn-mid">Edit</a>
                                                                        <?php if($AdminRole == 1){  ?>
                                                                            <a href="./Pricing.php?action=Delete&PricingID=<?php echo $Pricing['ID'] ?>&RoleID=<?php echo $Pricing['RoleID']?>" class="btn btn-danger btn-mid">Remove</a>
                                                                        <?php }else{ ?>
                                                                            <button class="btn btn-danger btn-mid" disabled>Remove</button>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php }  
                                                        }
                                                }elseif(isset($_POST['PlaceID']) && !isset($_POST['RoleID'])){
                                                    $sql = "WHERE visitpricing.PlaceID IN(".implode(',', $_POST['PlaceID']).")";
            
                                                    $PriceQuery = "SELECT DISTINCT visitpricing. *, userrole.RoleName AS UserRole ,visitpricing.UserRole AS RoleID, place.Name AS PlaceName FROM visitpricing 
                                                                    JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                                                    JOIN place ON visitpricing.PlaceID = place.ID
                                                                    $sql
                                                                    ORDER BY visitpricing.ID $sort 
                                                                    ";
                                
                                                    $Query = mysqli_query($con , $PriceQuery);
                                                    $fetchquery = mysqli_fetch_row($Query);
                                                    $count =mysqli_num_rows($Query);
            
                                                    
                                                    if($count > 0 ){
                                                        foreach($Query as $Pricing){ ?>
                                                            <div class="PriceDiv" style="margin: auto;">
                                                                <div class="price-card">
                                                                    <h2><?php echo $Pricing['UserRole'] ?></h2>
                                                                    <ul class="pricing-offers">
                                                                        <li class="fw-bold"><?php echo $Pricing['PlaceName'] ?></li>
                                                                        <li><?php 
                                                                                if($Pricing['MuseumFee']){
                                                                                    echo "<div class=''>";
                                                                                        echo "<p>Entrance : <span>". $Pricing['EntranceFee'] ."</span></p>";
                                                                                        echo "<p>Museum : <span>". $Pricing['MuseumFee'] ."</span></p>";
                                                                                    echo "</div>";
                                                                                }else{
                                                                                    echo "<div class=''>";
                                                                                        echo "<p>Entrance : <span>".  $Pricing['EntranceFee'] ."</span></p>";
                                                                                    echo "</div>";
                                                                                }?>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="d-flex space-between">
                                                                        <a href="./Pricing.php?action=Edit&PricingID=<?php echo $Pricing['ID'] ?>&RoleID=<?php echo $Pricing['RoleID']?>" class="btn btn-success btn-mid">Edit</a>
                                                                        <?php if($AdminRole == 1){  ?>
                                                                            <a href="./Pricing.php?action=Delete&PricingID=<?php echo $Pricing['ID'] ?>&RoleID=<?php echo $Pricing['RoleID']?>" class="btn btn-danger btn-mid">Remove</a>
                                                                        <?php }else{ ?>
                                                                            <button class="btn btn-danger btn-mid" disabled>Remove</button>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php }  
                                                    }
                                                }elseif(isset($_POST['RoleID']) && !isset($_POST['PlaceID'])){
                                                    $sql = "WHERE visitpricing.UserRole IN(". implode(',', $_POST['RoleID']).")";
                                                    $PriceQuery = "SELECT DISTINCT visitpricing. *, userrole.RoleName AS UserRole , visitpricing.UserRole AS RoleID , place.Name AS PlaceName FROM visitpricing 
                                                                    JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                                                    JOIN place ON visitpricing.PlaceID = place.ID
                                                                    $sql
                                                                    ORDER BY visitpricing.ID $sort 
                                                                    ";
                                
                                                    $Query = mysqli_query($con , $PriceQuery);
                                                    $fetchquery = mysqli_fetch_row($Query);
                                                    $count =mysqli_num_rows($Query);
            
                                                    
                                                    if($count > 0 ){
                                                        foreach($Query as $Pricing){ ?>
                                                            <div class="PriceDiv" style="margin: auto;">
                                                                <div class="price-card">
                                                                    <h2><?php echo $Pricing['UserRole'] ?></h2>
                                                                    <ul class="pricing-offers">
                                                                        <li class="fw-bold"><?php echo $Pricing['PlaceName'] ?></li>
                                                                        <li><?php 
                                                                                if($Pricing['MuseumFee']){
                                                                                    echo "<div class=''>";
                                                                                        echo "<p>Entrance : <span>". $Pricing['EntranceFee'] ."</span></p>";
                                                                                        echo "<p>Museum : <span>". $Pricing['MuseumFee'] ."</span></p>";
                                                                                    echo "</div>";
                                                                                }else{
                                                                                    echo "<div class=''>";
                                                                                        echo "<p>Entrance : <span>".  $Pricing['EntranceFee'] ."</span></p>";
                                                                                    echo "</div>";
                                                                                }?>
                                                                        </li>
                                                                    </ul>
                                                                    <div class="d-flex space-between">
                                                                    <a href="./Pricing.php?action=Edit&PricingID=<?php echo $Pricing['ID'] ?>&RoleID=<?php echo $Pricing['RoleID']?>" class="btn btn-success btn-mid">Edit</a>
                                                                    <?php if($AdminRole == 1){  ?>
                                                                        <a href="./Pricing.php?action=Delete&PricingID=<?php echo $Pricing['ID'] ?>&RoleID=<?php echo $Pricing['RoleID']?>" class="btn btn-danger btn-mid">Remove</a>
                                                                    <?php }else{ ?>
                                                                        <button class="btn btn-danger btn-mid" disabled>Remove</button>
                                                                    <?php } ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    <?php } 
                                                    }
                                                }else{
                                                    $PriceQuery = "SELECT DISTINCT visitpricing. *, userrole.RoleName AS UserRole ,visitpricing.UserRole AS RoleID  , place.Name AS PlaceName FROM visitpricing 
                                                                    JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                                                    JOIN place ON visitpricing.PlaceID = place.ID
                                                                    ORDER BY visitpricing.ID $sort 
                                                    ";
                                
                                                    $Query = mysqli_query($con , $PriceQuery);
                                                    $fetchquery = mysqli_fetch_row($Query);
                                                    $count =mysqli_num_rows($Query);
                                                    
                                                    foreach($Query as $Pricing){ ?>
                                                        <div class="PriceDiv" style="margin: auto;">
                                                            <div class="price-card">
                                                                <h2><?php echo $Pricing['UserRole'] ?></h2>
                                                                <ul class="pricing-offers">
                                                                    <li class="fw-bold"><?php echo $Pricing['PlaceName'] ?></li>
                                                                    <li><?php 
                                                                            if($Pricing['MuseumFee']){
                                                                                echo "<div class=''>";
                                                                                    echo "<p>Entrance : <span>". $Pricing['EntranceFee'] ."</span></p>";
                                                                                    echo "<p>Museum : <span>". $Pricing['MuseumFee'] ."</span></p>";
                                                                                echo "</div>";
                                                                            }else{
                                                                                echo "<div class=''>";
                                                                                    echo "<p>Entrance : <span>".  $Pricing['EntranceFee'] ."</span></p>";
                                                                                echo "</div>";
                                                                            }?>
                                                                    </li>
                                                                </ul>
                                                                <div class="d-flex space-between">
                                                                    <a href="./Pricing.php?action=Edit&PricingID=<?php echo $Pricing['ID'] ?>&RoleID=<?php echo $Pricing['RoleID']?>" class="btn btn-success btn-mid">Edit</a>
                                                                    <?php if($AdminRole == 1){  ?>
                                                                        <a href="./Pricing.php?action=Delete&PricingID=<?php echo $Pricing['ID'] ?>&RoleID=<?php echo $Pricing['RoleID']?>" class="btn btn-danger btn-mid">Remove</a>
                                                                    <?php }else{ ?>
                                                                        <button class="btn btn-danger btn-mid" disabled>Remove</button>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php 
                                                    } 
                                                    
                                                }
                                            ?>
                                            
                                    </div>
                                </div>
                            </section>
                        </div>
                                            
                    <?php }else{
                        echo "<div class='NoData'>";
                            echo "No Current Data";
                        echo "</div>";
                    }
            }elseif($do == "AddPricing"){
                $PriceQuery = "SELECT DISTINCT visitpricing. *, userrole.RoleName AS Rolename , place.Name AS PlaceName FROM visitpricing 
                Right JOIN userrole ON visitpricing.UserRole = userrole.ID 
                JOIN place ON visitpricing.PlaceID = place.ID
                GROUP BY UserRole
                HAVING COUNT(UserRole) > 2
                ";

                $AboveQuery = mysqli_query($con , $PriceQuery);
                $row = mysqli_fetch_assoc($AboveQuery);
                ?>
                    <h1 class="PageName"> Add New Price </h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=Insert" method="POST">
                        
                        <div class="form-group insertInput mb-20">
                            <div class="mb-20">
                                <select name="UserRole" class="custom-select">
                                    <option value="0"> User Role </option>
                                    <?php
                                    $SelectQuery = "SELECT `userrole`.* , userrole.ID AS UserRoleID , visitpricing.* , COUNT(visitpricing.UserRole) AS COUNTUserRole FROM `userrole` 
                                                    LEFT JOIN visitpricing ON userrole.ID = visitpricing.UserRole 
                                                    GROUP BY UserRole 
                                                    HAVING COUNTUserRole <= 1
                                                    ";
                                    $Select = mysqli_query($con, $SelectQuery);
                                    $fetchquery = mysqli_fetch_assoc($Select);
                                    foreach ($Select as $Roles) {
                                        echo "<option value='" . $Roles['UserRoleID'] . "' >" . $Roles['RoleName'] . " </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class=" mt-20">
                                <select name="Place" class="custom-select">
                                    <option value="0">Place </option>
                                    <?php
                                    $SelectQuery = "SELECT * From `place` ";
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
                            <div class="mt-20">
                                <input type="number" name="EntranceFee" placeholder="Entrance Fees" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="number" name="MuseumFee" placeholder="Museum Fees" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="InsertButton">
                                <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                <a href="./Pricing.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                    </form>
                </div>
                <?php 
                
            }elseif($do == "Edit"){
                
                $PricingID = isset($_GET['PricingID']) && is_numeric($_GET['PricingID']) ? intval($_GET['PricingID']) : 0;
                $RoleID = isset($_GET['RoleID']) && is_numeric($_GET['RoleID']) ? intval($_GET['RoleID']) : 0;
            
                if(empty($PricingID) || empty($RoleID)){
                    echo "<div class='NoData'>";
                        echo "<p>Where is The Price And The Role Details to Edit !</p>";
                    echo "</div>";
                }else{
                    $SelectQuery = "SELECT DISTINCT visitpricing. *, userrole.RoleName AS UserRole, visitpricing.UserRole AS RoleID  ,place.ID AS PlaceID , place.Name AS PlaceName FROM visitpricing 
                                    LEFT JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                    JOIN place ON visitpricing.PlaceID = place.ID
                                    WHERE visitpricing.ID = $PricingID AND UserRole = $RoleID ";
                    $Select = mysqli_query($con, $SelectQuery);
                    $row = mysqli_fetch_assoc($Select);
                    $count = mysqli_num_rows($Select);
                    if(isset($row['ID'])){
                ?>
                    <h1 class="PageName"> Edit Price </h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=Update" method="POST">

                    <input type="hidden" name="PriceID" value="<?php echo $PricingID ?>">

                        <div class="form-group insertInput mb-20">
                            <div class="mb-20">
                                <select name="UserRole" class="custom-select" disabled>
                                    <option value="<?php echo $RoleID?>"> <?php echo $row['UserRole'] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class=" mt-20">
                                <select name="Place" class="custom-select" disabled>
                                    <option value="<?php echo $row['PlaceID'] ?>"><?php echo $row['PlaceName'] ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="mt-20">
                                <input type="number" name="EntranceFee" placeholder="Entrance Fees" value="<?php echo $row['EntranceFee'] ?>" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="number" name="MuseumFee" placeholder="Museum Fees" value="<?php echo $row['MuseumFee'] ?>" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="InsertButton">
                                <input type="submit" value="Update" class="btn btn-success btn-md w-10" />
                                <a href="./Pricing.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                    </form>
                </div>
                <?php 
                    }
                }
            }elseif($do == "Insert"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {      
                    $UserRole = $_POST['UserRole'];
                    $Place = $_POST['Place'];
                    $EntranceFee = $_POST['EntranceFee'];
                    $MuseumFee = $_POST['MuseumFee'];

                    $FormErrors = array();

                    if ($Place == 0) {
                        $FormErrors[] = "You Must Select a Place";
                    }
                    if (empty($EntranceFee) || $EntranceFee < 10) {
                        $FormErrors[] = "You Must Enter a Valid And More than 10 Egyptian Pounds Price";
                    }
                    if ($UserRole == 0) {
                        $FormErrors[] = "You Must Select a Valid Role";
                    }
                    if(empty($MuseumFee)){
                        $MuseumFee == NULL ;
                    }

                    if(empty($FormErrors)){
                        $InsertPrice = "INSERT INTO `visitpricing` VALUES( NULL , $UserRole , $Place , $EntranceFee , '$MuseumFee'  )" ;
                        $Insert = mysqli_query($con , $InsertPrice);
                        
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-success txt-center'>"  . "Price Added Successfully" . '</div>';
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                        }
                    }
                }
            }elseif($do == "Update"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                    $PriceID = $_POST['PriceID'];
                    $EntranceFee = $_POST['EntranceFee'];
                    $MuseumFee = $_POST['MuseumFee'];

                    $FormErrors = array();

                    if (empty($EntranceFee) || $EntranceFee < 10) {
                        $FormErrors[] = "You Must Enter a Valid And More than 10 Egyptian Pounds Price";
                    }
                    if(empty($MuseumFee)){
                        $MuseumFee == NULL ;
                    }

                    if (empty($FormErrors)) {

                        $UpdateQuery = "UPDATE `visitpricing` SET EntranceFee = $EntranceFee , MuseumFee = '$MuseumFee' WHERE ID = $PriceID ";
                        $Update = mysqli_query($con, $UpdateQuery);
                        

                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-success txt-center'> Price Updated Successfully </div>";
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                        
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                        }
                    }
                }
            }elseif($do == "Delete"){
                        $PricingID = isset($_GET['PricingID']) && is_numeric($_GET['PricingID']) ? intval($_GET['PricingID']) : 0;
                        $RoleID = isset($_GET['RoleID']) && is_numeric($_GET['RoleID']) ? intval($_GET['RoleID']) : 0;
            
                                $Check = "SELECT * FROM visitpricing WHERE ID = $PricingID AND UserRole = $RoleID";
                                $CheckPricing = mysqli_query($con, $Check);

                                if ($Check > 0) {
                                    
                                    $DeleteQuery = "DELETE FROM visitpricing WHERE ID = $PricingID AND UserRole = $RoleID  ";
                                    $Delete = mysqli_query($con, $DeleteQuery);

                                    header("Location: ./Pricing.php?action=Manage");

                                } else {
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-danger txt-center'>" . "The Pricing Category Does Not Exist" . "</div>";
                                    RedirectIndex($TheMsg);
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