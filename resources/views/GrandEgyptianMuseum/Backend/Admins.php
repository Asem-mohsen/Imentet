<?php
ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Admins";

include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";

if (isset($_SESSION["AdminID"])) {

    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
    include "./NavAdmin.php";

        if ($row['AdminRole'] == 1) {
            $do = isset($_GET['action']) ?  $_GET['action'] : "Manage";

            if ($do == "Add") {  ?>
                <h1 class="PageName"> Add Admin </h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=Insert" method="POST">
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="text" name="Name" placeholder="Admin Name" class="form-control" autocomplete="off" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="number" name="Phone" pattern="[0-9]" placeholder="Phone" class="form-control" autocomplete="off" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="text" name="Address" placeholder="Address" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="email" name="Email" placeholder="Email" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="password" name="Password" placeholder="Password" class="form-control" required="required" />
                            </div>
                        </div>

                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <select name="Role" class="custom-select">
                                    <option value="0"> Admin Role </option>
                                    <?php
                                    $SelectQuery = "SELECT * From `adminrole` ";
                                    $Select = mysqli_query($con, $SelectQuery);
                                    $fetchquery = mysqli_fetch_assoc($Select);
                                    foreach ($Select as $Roles) {
                                        echo "<option value='" . $Roles['ID'] . "' >" . $Roles['Role'] . " </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="InsertButton">
                                <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                <a href="./Admins.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                    </form>
                </div>
                <?php 
            } elseif ($do == 'Insert') {
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                    $Name      = mysqli_real_escape_string($con , $_POST['Name']);
                    $Address   = mysqli_real_escape_string($con , $_POST['Address']);
                    $Phone     = $_POST['Phone'];
                    $Email     = $_POST['Email'];
                    $Password  = $_POST['Password'];
                    $Role      = $_POST['Role'];
                    $hashedPassword = password_hash($Password , PASSWORD_DEFAULT);
                    
                    $Image = "avatar.png";
                    $FormErrors = array();

                    if (empty($Name)) {
                        $FormErrors[] = "The Person Should Have a Name";
                    }
                    if (empty($Phone)) {
                        $FormErrors[] =  "You Must Enter a Phone Number";
                    }
                    if (empty($Address)) {
                        $FormErrors[] = "You Must Enter an Address";
                    }
                    if (empty($Email)) {
                        $FormErrors[] = "Please Enter an Email ";
                    }
                    if (empty($Password)) {
                        $FormErrors[] = "The Password Cannot be Empty";
                    }
                    if ($Role == 0) {
                        $FormErrors[] = "You Must Select a Correct Role For The Admin";
                    }
                    if (!preg_match ("/^[a-zA-z]*$/", $Name) ) {  
                        $FormErrors[] = "Name Only alphabets and whitespace are allowed.";  
                    }

                    if (empty($FormErrors)) {
                        $Select = " SELECT * FROM admin WHERE Email = '$Email' ";
                        $Result = mysqli_query($con, $Select);
                        if(mysqli_num_rows($Result) > 0){
                            echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-success txt-center'> Admin Email Already Exist ! </div>";
                                RedirectIndex($TheMsg, "Back");
                            echo "</div>";

                        }else{
                            $InsertQuery = "INSERT INTO `admin` Values( Null , '$Name' , $Phone , '$Address' , '$Email' , '$hashedPassword' , 1 , $Role , 1)";
                            $Insert = mysqli_query($con, $InsertQuery);

                            $InsertImgQuery = "INSERT INTO `adminimage` Values( Null , '". mysqli_insert_id($con) . "' , '$Image' )";
                            $Insert = mysqli_query($con, $InsertImgQuery);

                            echo "<div class='container'>";
                                $TheMsg =  "<div class='alert alert-success txt-center'> Admin Added Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                            echo "</div>";
                            
                        }
                        
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='alert alert-danger'>" . $error . "</div>";
                        }
                    }
                } 
            } elseif ($do == "Manage") {

                        $sort = 'ASC';
                        $sortarray = array('ASC', 'DESC');
                
                        if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                            $sort = $_GET['sort'];
                        }
                        $SelectAdmins = "SELECT admin . * , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                        INNER JOIN adminrole ON adminrole.ID = admin.AdminRole
                                        ORDER BY ID $sort
                                        ";
                        $Admins = mysqli_query($con, $SelectAdmins);
                        $fetchquery = mysqli_fetch_assoc($Admins);
                        ?>
                        <div class="page d-flex">
                            <div class=" w-280 sidepar p-20 p-relative">
                                <h3 class="p-relative txt-center mt-0">Control</h3>
                                <form method="post">
                                    <ul>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Admins.php?action=Add">
                                                <i class="fa-solid fa-plus fa-fw"></i><span> Add Admin</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Admins.php?action=Status">
                                                <i class="fa-solid fa-search fa-fw"></i><span>Check Status</span>
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
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Role </p>
                                        </li>
                                            <?php
                                                $RoleSelect = "SELECT * FROM adminrole";
                                                $Run = mysqli_query($con , $RoleSelect);
                                                $row = mysqli_fetch_assoc($Run);

                                                foreach($Run as $Role){ 
                                                    $Checked = [];
                                                    if(isset($_POST['Role'])){
                                                        $Checked = $_POST['Role'];
                                                    }
                                                    ?>
                                        <li>
                                            <input type="checkbox" name="Role[]" id="Role" class="FilterCheck" value="<?php echo $Role['ID'] ?>" <?php if(in_array( $Role['ID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                            <?php echo $Role['Role'] ?>
                                        </li>
                                                <?php } 
                                            ?>
                                            
                                        <li>
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Status </p>
                                        </li>
                                                <?php
                                                $ActiveSelect = "SELECT DISTINCT Active FROM admin";
                                                $Run = mysqli_query($con , $ActiveSelect);
                                                $row = mysqli_fetch_assoc($Run);

                                                foreach($Run as $Active){ 
                                                    $Checked = [];
                                                    if(isset($_POST['Active'])){
                                                        $Checked = $_POST['Active'];
                                                    }
                                                    ?>
                                        <li>
                                                <input type="checkbox" name="Active[]" id="Active" class="FilterCheck" value="<?php echo $Active['Active'] ?>" <?php if(in_array( $Active['Active'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                <?php if($Active['Active'] == 1){ echo "Active" ; }else{ echo "Deactivated";} ?>
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
                                                            <a href="./Admins.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Asc </a> |
                                                            <a href="./Admins.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Desc </a> ]
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <div class="container">
                                <h1 class="PageName">All Admins </h1>
                                <div class="table-responsive">
                                    <table class="main-table table table-bordered table-hover table-light">
                                        <tr>
                                            <td>ID</td>
                                            <td>Name</td>
                                            <td>Phone</td>
                                            <td>Address</td>
                                            <td>Role</td>
                                            <td>Statues</td>
                                            <td>Control</td>
                                        </tr>
                                        <?php
                                        
                                            if(isset($_POST['Active']) && isset($_POST['Role'])){
                                                $sql = "WHERE admin.AdminRole IN(".implode(',', $_POST['Role'] ).") AND admin.Active IN (".implode(',', $_POST['Active']).")" ; 
                                                $SelectAdmins = "SELECT admin .* , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                                $sql ORDER BY ID $sort
                                                ";
                                                    $Admins = mysqli_query($con, $SelectAdmins);
                                                    $fetchquery = mysqli_fetch_assoc($Admins);
                                                    $count =mysqli_num_rows($Admins);

                                                    
                                                    if($count > 0 ){
                                                            foreach ($Admins as $Admin) {
                                                                echo "<tr>";
                                                                echo "<td>" .$Admin['ID'] . "</td>";
                                                                echo "<td>"; 
                                                                        if($Admin['ID'] == $AdminID){
                                                                            echo "<p class='txt-center'> You </p>";
                                                                        }else{
                                                                            echo $Admin['Name'];
                                                                        } 
                                                                echo "</td>";
                                                                echo "<td>" ."0" . $Admin['Phone']  . "</td>";
                                                                echo "<td>" . $Admin['Address'] . "</td>";
                                                                echo "<td>" . $Admin['Role']   . "</td>";
                                                                echo "<td>";
                                                                        if ($Admin['Active'] == 0) {
                                                                            echo "<button class='btn btn-dark' disabled> Not Activated </button>";
                                                                        }elseif($Admin['Active'] == 1) {
                                                                            echo "<button class='btn btn-primary' disabled> Activated </button>";
                                                                        }
                                                                echo "</td>";
                                                                echo "<td> ";
                                                                        if($Admin['ID'] == $AdminID){
                                                                            echo "<a href='Profile.php?action=Manage&AdminID="     . $Admin['ID'] . "' class='btn btn-primary'>"  . 'Your Profile'  . "</a> ";
                                                                        }else{
                                                                            echo "  <a href='Admins.php?action=Edit&ID="     . $Admin['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "           . 'Edit'  . "</a> 
                                                                                    <a href='Admins.php?action=Delete&ID="   . $Admin['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                                                        } 
                                                                echo "</td>";
                                                                
                                                                echo "</tr>";
                                                            }
                                                    }
                                            }elseif(isset($_POST['Active']) && !isset($_POST['Role'])){
                                                $sql = "WHERE admin.Active IN(".implode(',', $_POST['Active']).")";
                                                $SelectAdmins = "SELECT admin .* , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                                $sql ORDER BY ID $sort
                                                ";
                                                $Admins = mysqli_query($con, $SelectAdmins);
                                                $fetchquery = mysqli_fetch_assoc($Admins);
                                                $count =mysqli_num_rows($Admins);

                                                
                                                if($count > 0 ){
                                                        foreach ($Admins as $Admin) {
                                                            echo "<tr>";
                                                            echo "<td>" .$Admin['ID'] . "</td>";
                                                            echo "<td>"; 
                                                                    if($Admin['ID'] == $AdminID){
                                                                        echo "<p class='txt-center'> You </p>";
                                                                    }else{
                                                                        echo $Admin['Name'];
                                                                    } 
                                                            echo "</td>";
                                                            echo "<td>" ."0" . $Admin['Phone']  . "</td>";
                                                            echo "<td>" . $Admin['Address'] . "</td>";
                                                            echo "<td>" . $Admin['Role']   . "</td>";
                                                            echo "<td>";
                                                                    if ($Admin['Active'] == 0) {
                                                                        echo "<button class='btn btn-dark' disabled> Not Activated </button>";
                                                                    }elseif($Admin['Active'] == 1) {
                                                                        echo "<button class='btn btn-primary' disabled> Activated </button>";
                                                                    }
                                                            echo "</td>";
                                                            echo "<td> ";
                                                                    if($Admin['ID'] == $AdminID){
                                                                        echo "<a href='Profile.php?action=Manage&AdminID="     . $Admin['ID'] . "' class='btn btn-primary'>"  . 'Your Profile'  . "</a> ";
                                                                    }else{
                                                                        echo "  <a href='Admins.php?action=Edit&ID="     . $Admin['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "           . 'Edit'  . "</a> 
                                                                                <a href='Admins.php?action=Delete&ID="   . $Admin['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                                                    } 
                                                            echo "</td>";
                                                            
                                                            echo "</tr>";
                                                        }
                                                }
                                            }elseif(isset($_POST['Role']) && !isset($_POST['Active'])){
                                                $sql = "WHERE admin.AdminRole IN(".implode(',', $_POST['Role']).")";
                                                $SelectAdmins = "SELECT admin .* , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                                                $sql ORDER BY ID $sort
                                                                ";
                                                $Admins = mysqli_query($con, $SelectAdmins);
                                                $fetchquery = mysqli_fetch_assoc($Admins);
                                                $count =mysqli_num_rows($Admins);

                                                
                                                if($count > 0 ){
                                                        foreach ($Admins as $Admin) {
                                                            echo "<tr>";
                                                            echo "<td>" .$Admin['ID'] . "</td>";
                                                            echo "<td>"; 
                                                                    if($Admin['ID'] == $AdminID){
                                                                        echo "<p class='txt-center'> You </p>";
                                                                    }else{
                                                                        echo $Admin['Name'];
                                                                    } 
                                                            echo "</td>";
                                                            echo "<td>" ."0" . $Admin['Phone']  . "</td>";
                                                            echo "<td>" . $Admin['Address'] . "</td>";
                                                            echo "<td>" . $Admin['Role']   . "</td>";
                                                            echo "<td>";
                                                                    if ($Admin['Active'] == 0) {
                                                                        echo "<button class='btn btn-dark' disabled> Not Activated </button>";
                                                                    }elseif($Admin['Active'] == 1) {
                                                                        echo "<button class='btn btn-primary' disabled> Activated </button>";
                                                                    }
                                                            echo "</td>";
                                                            echo "<td> ";
                                                                    if($Admin['ID'] == $AdminID){
                                                                        echo "<a href='Profile.php?action=Manage&AdminID="     . $Admin['ID'] . "' class='btn btn-primary'>"  . 'Your Profile'  . "</a> ";
                                                                    }else{
                                                                        echo "  <a href='Admins.php?action=Edit&ID="     . $Admin['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "           . 'Edit'  . "</a> 
                                                                                <a href='Admins.php?action=Delete&ID="   . $Admin['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                                                    } 
                                                            echo "</td>";
                                                            
                                                            echo "</tr>";
                                                        }
                                                }
                                            }else{
                                                $SelectAdmins = "SELECT admin .* , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                                                ORDER BY ID $sort ";
                                                $Admins = mysqli_query($con, $SelectAdmins);
                                                $fetchquery = mysqli_fetch_assoc($Admins);
                                                $count =mysqli_num_rows($Admins);

                                                
                                                if($count > 0 ){
                                                        foreach ($Admins as $Admin) {
                                                            echo "<tr>";
                                                            echo "<td>" .$Admin['ID'] . "</td>";
                                                            echo "<td>"; 
                                                                    if($Admin['ID'] == $AdminID){
                                                                        echo "<p class='txt-center'> You </p>";
                                                                    }else{
                                                                        echo $Admin['Name'];
                                                                    } 
                                                            echo "</td>";
                                                            echo "<td>" ."0" . $Admin['Phone']  . "</td>";
                                                            echo "<td>" . $Admin['Address'] . "</td>";
                                                            echo "<td>" . $Admin['Role']   . "</td>";
                                                            echo "<td>";
                                                                    if ($Admin['Active'] == 0) {
                                                                        echo "<button class='btn btn-dark' disabled> Not Activated </button>";
                                                                    }elseif($Admin['Active'] == 1) {
                                                                        echo "<button class='btn btn-primary' disabled> Activated </button>";
                                                                    }
                                                            echo "</td>";
                                                            echo "<td> ";
                                                                    if($Admin['ID'] == $AdminID){
                                                                        echo "<a href='Profile.php?action=Manage&AdminID="     . $Admin['ID'] . "' class='btn btn-primary'>"  . 'Your Profile'  . "</a> ";
                                                                    }else{
                                                                        echo "  <a href='Admins.php?action=Edit&ID="     . $Admin['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "           . 'Edit'  . "</a> 
                                                                                <a href='Admins.php?action=Delete&ID="   . $Admin['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                                                    } 
                                                            echo "</td>";
                                                            
                                                            echo "</tr>";
                                                        }
                                                }
                                            }
                                            

                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                            <?php 
                            
            } elseif ($do == "Status") {
                        
                        $sort = 'ASC';
                        $sortarray = array('ASC', 'DESC');
                
                        if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                            $sort = $_GET['sort'];
                        }
                    $SelectAdmins = "SELECT admin . * , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                        INNER JOIN adminrole ON adminrole.ID = admin.AdminRole
                                        ORDER BY ID $sort
                                        ";
                    $Admins = mysqli_query($con, $SelectAdmins);
                    $fetchquery = mysqli_fetch_assoc($Admins);
                    ?>
                        <div class="page d-flex">
                            <div class=" w-280 sidepar p-20 p-relative">
                                <h3 class="p-relative txt-center mt-0">Control</h3>
                                <form method="post">
                                    <ul>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Admins.php?action=Add">
                                                <i class="fa-solid fa-plus fa-fw"></i><span> Add Admin</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Admins.php?action=Manage">
                                                <i class="fa-solid fa-arrow-left fa-fw"></i><span>Back</span>
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
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Role </p>
                                        </li>
                                            <?php
                                                $RoleSelect = "SELECT * FROM adminrole";
                                                $Run = mysqli_query($con , $RoleSelect);
                                                $row = mysqli_fetch_assoc($Run);

                                                foreach($Run as $Role){ 
                                                    $Checked = [];
                                                    if(isset($_POST['Role'])){
                                                        $Checked = $_POST['Role'];
                                                    }
                                                    ?>
                                        <li>
                                            <input type="checkbox" name="Role[]" id="Role" class="FilterCheck" value="<?php echo $Role['ID'] ?>" <?php if(in_array( $Role['ID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                            <?php echo $Role['Role'] ?>
                                        </li>
                                                <?php } 
                                            ?>
                                            
                                        <li>
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Status </p>
                                        </li>
                                                <?php
                                                $ActiveSelect = "SELECT DISTINCT Active FROM admin";
                                                $Run = mysqli_query($con , $ActiveSelect);
                                                $row = mysqli_fetch_assoc($Run);

                                                foreach($Run as $Active){ 
                                                    $Checked = [];
                                                    if(isset($_POST['Active'])){
                                                        $Checked = $_POST['Active'];
                                                    }
                                                    ?>
                                        <li>
                                                <input type="checkbox" name="Active[]" id="Active" class="FilterCheck" value="<?php echo $Active['Active'] ?>" <?php if(in_array( $Active['Active'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                <?php if($Active['Active'] == 1){ echo "Active" ; }else{ echo "Deactivated";} ?>
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
                                                            <a href="./Admins.php?action=Status&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Asc </a> |
                                                            <a href="./Admins.php?action=Status&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Desc </a> ]
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                            <div class="container">
                                <h1 class="PageName">Status</h1>
                                <div class="table-responsive">
                                    <table class="main-table table table-bordered table-hover table-light">
                                        <tr>
                                            <td>ID</td>
                                            <td>Name</td>
                                            <td>Role</td>
                                            <td>Statues</td>
                                            <td>Control</td>
                                        </tr>
                                        <?php
                                            if(isset($_POST['Active']) && isset($_POST['Role'])){
                                                $sql = "WHERE admin.AdminRole IN(".implode(',', $_POST['Role'] ).") AND admin.Active IN (".implode(',', $_POST['Active']).")" ; 
                                                $SelectAdmins = "SELECT admin .* , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                                $sql ORDER BY ID $sort
                                                ";
                                                    $Admins = mysqli_query($con, $SelectAdmins);
                                                    $fetchquery = mysqli_fetch_assoc($Admins);
                                                    $count =mysqli_num_rows($Admins);

                                                    
                                                    if($count > 0 ){
                                                        foreach ($Admins as $Admin) {
                                                            echo "<tr>";
                                                                echo "<td>" . $Admin['ID']     . "</td>";
                                                                echo "<td>"; 
                                                                            if($Admin['ID'] == $AdminID){
                                                                                echo "<p class='txt-center'> You </p>";
                                                                            }else{
                                                                                echo $Admin['Name'];
                                                                            } 
                                                                echo "</td>";
                                                                echo "<td>" . $Admin['Role']   . "</td>";
                                                                echo "<td>";
                                                                            if($Admin['Active'] == 1 && $Admin['Role'] != 'Master Level' ){
                                                                                echo "<a href='Admins.php?action=Deactive&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Activated ... Tab here To Deactivate It Temporarily' . "</a>";
                                                                            }elseif($Admin['Active'] == 0){
                                                                                echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Deactivated ... Tab here To Activate' . "</a>";
                                                                            }elseif($Admin['Role'] == 'Master Level'){
                                                                                echo "<p class='activate fs-13 c-gray'>Cannot Deactivate Your Account </p>";
                                                                            }
                                                                echo "</td>";
                                                                echo "<td>" ;
                                                                            if($Admin['ID'] == $AdminID){
                                                                                echo "<a href='Profile.php?action=Manage&AdminID="     . $Admin['ID'] . "' class='btn btn-primary'>"  . 'Your Profile'  . "</a> ";
                                                                            }else{
                                                                                echo "<div class='tableButtons'>";
                                                                                    echo "<a href='Admins.php?action=Edit&ID="     . $Admin['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "           . 'Edit'  . "</a>";
                                                                                    echo "<a href='Admins.php?action=Delete&ID="   . $Admin['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                                                                echo "</div>";
                                                                            }
                                                                echo "</td>";
                                                            echo "</tr>";
                                                        } 
                                                    }
                                            }elseif(isset($_POST['Active']) && !isset($_POST['Role'])){
                                                $sql = "WHERE admin.Active IN(".implode(',', $_POST['Active']).")";
                                                $SelectAdmins = "SELECT admin .* , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                                $sql ORDER BY ID $sort
                                                ";
                                                $Admins = mysqli_query($con, $SelectAdmins);
                                                $fetchquery = mysqli_fetch_assoc($Admins);
                                                $count =mysqli_num_rows($Admins);

                                                
                                                if($count > 0 ){
                                                    foreach ($Admins as $Admin) {
                                                        echo "<tr>";
                                                            echo "<td>" . $Admin['ID']     . "</td>";
                                                            echo "<td>"; 
                                                                        if($Admin['ID'] == $AdminID){
                                                                            echo "<p class='txt-center'> You </p>";
                                                                        }else{
                                                                            echo $Admin['Name'];
                                                                        } 
                                                            echo "</td>";
                                                            echo "<td>" . $Admin['Role']   . "</td>";
                                                            echo "<td>";
                                                                        if($Admin['Active'] == 1 && $Admin['Role'] != 'Master Level' ){
                                                                            echo "<a href='Admins.php?action=Deactive&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Activated ... Tab here To Deactivate It Temporarily' . "</a>";
                                                                        }elseif($Admin['Active'] == 0){
                                                                            echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Deactivated ... Tab here To Activate' . "</a>";
                                                                        }elseif($Admin['Role'] == 'Master Level'){
                                                                            echo "<p class='activate fs-13 c-gray'>Cannot Deactivate Your Account </p>";
                                                                        }
                                                            echo "</td>";
                                                            echo "<td>" ;
                                                                        if($Admin['ID'] == $AdminID){
                                                                            echo "<a href='Profile.php?action=Manage&AdminID="     . $Admin['ID'] . "' class='btn btn-primary'>"  . 'Your Profile'  . "</a> ";
                                                                        }else{
                                                                            echo "<div class='tableButtons'>";
                                                                                echo "<a href='Admins.php?action=Edit&ID="     . $Admin['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "           . 'Edit'  . "</a>";
                                                                                echo "<a href='Admins.php?action=Delete&ID="   . $Admin['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                                                            echo "</div>";
                                                                        }
                                                            echo "</td>";
                                                        echo "</tr>";
                                                    }  
                                                }
                                            }elseif(isset($_POST['Role']) && !isset($_POST['Active'])){
                                                $sql = "WHERE admin.AdminRole IN(".implode(',', $_POST['Role']).")";
                                                $SelectAdmins = "SELECT admin .* , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                                                $sql ORDER BY ID $sort
                                                                ";
                                                $Admins = mysqli_query($con, $SelectAdmins);
                                                $fetchquery = mysqli_fetch_assoc($Admins);
                                                $count =mysqli_num_rows($Admins);

                                                
                                                if($count > 0 ){
                                                    foreach ($Admins as $Admin) {
                                                        echo "<tr>";
                                                            echo "<td>" . $Admin['ID']     . "</td>";
                                                            echo "<td>"; 
                                                                        if($Admin['ID'] == $AdminID){
                                                                            echo "<p class='txt-center'> You </p>";
                                                                        }else{
                                                                            echo $Admin['Name'];
                                                                        } 
                                                            echo "</td>";
                                                            echo "<td>" . $Admin['Role']   . "</td>";
                                                            echo "<td>";
                                                                        if($Admin['Active'] == 1 && $Admin['Role'] != 'Master Level' ){
                                                                            echo "<a href='Admins.php?action=Deactive&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Activated ... Tab here To Deactivate It Temporarily' . "</a>";
                                                                        }elseif($Admin['Active'] == 0){
                                                                            echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Deactivated ... Tab here To Activate' . "</a>";
                                                                        }elseif($Admin['Role'] == 'Master Level'){
                                                                            echo "<p class='activate fs-13 c-gray'>Cannot Deactivate Your Account </p>";
                                                                        }
                                                            echo "</td>";
                                                            echo "<td>" ;
                                                                        if($Admin['ID'] == $AdminID){
                                                                            echo "<a href='Profile.php?action=Manage&AdminID="     . $Admin['ID'] . "' class='btn btn-primary'>"  . 'Your Profile'  . "</a> ";
                                                                        }else{
                                                                            echo "<div class='tableButtons'>";
                                                                                echo "<a href='Admins.php?action=Edit&ID="     . $Admin['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "           . 'Edit'  . "</a>";
                                                                                echo "<a href='Admins.php?action=Delete&ID="   . $Admin['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                                                            echo "</div>";
                                                                        }
                                                            echo "</td>";
                                                        echo "</tr>";
                                                    }  
                                                }
                                            }else{
                                                $SelectAdmins = "SELECT admin .* , adminrole.ID AS RoleID , adminrole.Role AS Role FROM admin 
                                                                INNER JOIN adminrole ON adminrole.ID = admin.AdminRole 
                                                                ORDER BY ID $sort";
                                                $Admins = mysqli_query($con, $SelectAdmins);
                                                $fetchquery = mysqli_fetch_assoc($Admins);
                                                $count =mysqli_num_rows($Admins);

                                                
                                                if($count > 0 ){
                                                    foreach ($Admins as $Admin) {
                                                        echo "<tr>";
                                                            echo "<td>" . $Admin['ID']     . "</td>";
                                                            echo "<td>"; 
                                                                        if($Admin['ID'] == $AdminID){
                                                                            echo "<p class='txt-center'> You </p>";
                                                                        }else{
                                                                            echo $Admin['Name'];
                                                                        } 
                                                            echo "</td>";
                                                            echo "<td>" . $Admin['Role']   . "</td>";
                                                            echo "<td>";
                                                                        if($Admin['Active'] == 1 && $Admin['Role'] != 'Master Level' ){
                                                                            echo "<a href='Admins.php?action=Deactive&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Activated ... Tab here To Deactivate It Temporarily' . "</a>";
                                                                        }elseif($Admin['Active'] == 0){
                                                                            echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Deactivated ... Tab here To Activate' . "</a>";
                                                                        }elseif($Admin['Role'] == 'Master Level'){
                                                                            echo "<p class='activate fs-13 c-gray'>Cannot Deactivate Your Account </p>";
                                                                        }
                                                            echo "</td>";
                                                            echo "<td>" ;
                                                                        if($Admin['ID'] == $AdminID){
                                                                            echo "<a href='Profile.php?action=Manage&AdminID="     . $Admin['ID'] . "' class='btn btn-primary'>"  . 'Your Profile'  . "</a> ";
                                                                        }else{
                                                                            echo "<div class='tableButtons'>";
                                                                                echo "<a href='Admins.php?action=Edit&ID="     . $Admin['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "           . 'Edit'  . "</a>";
                                                                                echo "<a href='Admins.php?action=Delete&ID="   . $Admin['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                                                            echo "</div>";
                                                                        }
                                                            echo "</td>";
                                                        echo "</tr>";
                                                    } 
                                                }
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                <?php
            } elseif ($do == "Edit") {

                $AdminID = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;

                $SelectQuery = "SELECT admin.* , adminrole.ID AS RoleID , adminrole.Role AS RoleName FROM admin 
                                JOIN adminrole ON admin.AdminRole = adminrole.ID
                                WHERE admin.ID = $AdminID ";
                $Select = mysqli_query($con, $SelectQuery);
                $row = mysqli_fetch_assoc($Select);
                $count = mysqli_num_rows($Select);

                if ($count > 0) {

                ?>

                    <h1 class="PageName">Edit Admin</h1>
                    <section class="profile" style="padding-top: 0px;">
                        <div class="container">
                            <div class="row">
                                <form class="login-form__form" action="?action=Update" method="POST">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                            <input type="hidden" name="AdminID" value="<?php echo $AdminID; ?>">
                                            <input type="text" name="Name" placeholder="Admin Name"  autocomplete="off" value="<?php echo $row['Name']; ?>" />
                                            <i class="fa fa-user"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                            <input type="number"name="Phone" pattern="[0-9]*" placeholder="Phone" value="<?php echo "0". $row['Phone']; ?>" />
                                            <i class="fa fa-phone"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                            <input type="email" name="Email" value="<?php echo $row['Email'] ?>" placeholder="Email" disabled  />
                                            <i class="fa fa-envelope-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                            <input  type="text" name="Address" placeholder="Address"  value="<?php echo $row['Address']; ?>"/>
                                            <i class="fa fa-id-card-o"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                            <input type="password" name="Password" placeholder="Password"  value="<?php echo $row['Password']; ?>"  disabled />
                                            <i class="fa fa-lock"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="login-form__field">
                                                <select name="Role" class="custom-select" style='height:62px; '>
                                                    <option value="<?php echo $row['RoleID'] ?>"><?php echo $row['RoleName'] ?> </option>
                                                    <?php
                                                        $SelectRole = "SELECT * FROM adminrole";
                                                        $Roles = mysqli_query($con, $SelectRole);
                                                        $fetchquery = mysqli_fetch_assoc($Roles);
                                                    foreach ($Roles as $Role) { ?>
                                                        <option value="<?php echo $Role['ID'] ?>"> <?php echo $Role['Role'] ?> </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="login-form__bottom">
                                        <div class="gap-4">
                                            <a href="./Admins.php?action=Manage"  class="thm-btn login-form__btn">
                                            Cancel
                                            </a>
                                            <button type="submit" value="Update" class="thm-btn login-form__btn login-form__btn-two" >
                                            Update
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </section>
                <?php } else {
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger'>" . "Admin is not Exist" . "</div>";
                    RedirectIndex($TheMsg);
                    echo "</div>";
                }
            } elseif ($do == "Update") {

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $AdminID    = $_POST['AdminID'];
                    $Name      = mysqli_real_escape_string($con , $_POST['Name']);
                    $Address   = mysqli_real_escape_string($con , $_POST['Address']);
                    $Phone      = $_POST['Phone'];
                    $Role       = $_POST['Role'];

                    $FormErrors = array();

                    if (empty($Name)) {

                        $FormErrors[] = "Name Cannot be Empty";
                    }
                    if (empty($Phone)) {
                        $FormErrors[] =  "Phone Cannot be Empty";
                    }
                    if (empty($Address)) {
                        $FormErrors[] = "Address Cannot be Empty";
                    }
                    if ($Role == 0) {
                        $FormErrors[] = "Role Cannot be Empty";
                    }
                    if (!preg_match ("/^[a-zA-z]*$/", $Name) ) {  
                        $FormErrors[] = "Name Only alphabets and whitespace are allowed.";  
                    }

                    if (empty($FormErrors)) {
                        $UpdateQuery = "UPDATE admin SET Name = '$Name' , Phone = $Phone , Address = '$Address' , AdminRole = '$Role'  WHERE ID = $AdminID ";
                        $Update = mysqli_query($con, $UpdateQuery);

                        echo "<div class='container'>";
                        $TheMsg  = "<div class='alert alert-success txt-center'>" .  "Update Successfully " . '</div>';
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='container'>";
                            echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                            RedirectIndex($TheMsg, "back", 5);
                            echo "</div>";
                        }
                    }

                } else {
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger txt-center'>" . "Unuthorized access"  . "</div>";
                    RedirectIndex($TheMsg, "Back", 5);
                    echo "</div>";
                } 

            } elseif ($do == "Delete") { 

                    $AdminID = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;

                    $Check = "SELECT * FROM admin WHERE ID = $AdminID";
                    $CheckAdmin = mysqli_query($con, $Check);

                    if ($Check > 0) {
                        
                        $DeleteImgQuery = "DELETE FROM adminimage WHERE AdminID = $AdminID ";
                        $Delete = mysqli_query($con, $DeleteImgQuery);

                        $DeleteQuery = "DELETE FROM admin WHERE ID = $AdminID ";
                        $Delete = mysqli_query($con, $DeleteQuery);

                        

                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-success'>"  . "Deleted Successfully" . '</div>';
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                    } else {
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-danger'>" . "Error" . "</div>";
                        RedirectIndex($TheMsg);
                        echo "</div>";
                    }
                    
            } elseif ($do == "Active") { 

                    $AdminID = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;

                    $Check = "SELECT * FROM admin WHERE ID = $AdminID ";
                    $CheckAdmin = mysqli_query($con, $Check);

                    if ($Check > 0) {

                        $UpdateQuery = "UPDATE admin SET Active = 1 WHERE ID = $AdminID";
                        $Update = mysqli_query($con, $UpdateQuery);

                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-success txt-center'>" . "The Account is Activated Successfully" . '</div>';
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                    } else {
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-danger txt-center'>" . "This Admin does not Exist"  . "</div>";
                        RedirectIndex($TheMsg);
                        echo "</div>";
                    }
            } elseif ($do == "Deactive") { 

                    $AdminID = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;

                    $Check = "SELECT * FROM admin WHERE ID = $AdminID ";
                    $CheckAdmin = mysqli_query($con, $Check);

                    if ($Check > 0) {

                        $UpdateQuery = "UPDATE admin SET Active = 0 WHERE ID = $AdminID";
                        $Update = mysqli_query($con, $UpdateQuery);

                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-success txt-center'>" . "The Account is Deactivated Successfully" . '</div>';
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                    } else {
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-danger txt-center'>" . "This Admin does not Exist"  . "</div>";
                        RedirectIndex($TheMsg);
                        echo "</div>";
                    }
            } else { 
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-danger'>" . "This Page Does Not Exist"  . "</div>";
                        RedirectIndex($TheMsg);
                        echo "</div>";
            }

        } else {
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger txt-center'>" . "You Are Not Authorized To Access This Page"  . "</div>";
            RedirectIndex($TheMsg);
            echo "</div>";
        }
    include "./AdminFooter.php";
} else {
    if (!isset($_SESSION["AdminID"])) {
        header("Location: login.php");
        exit();
    }
}

    ob_end_flush();

        ?>

        