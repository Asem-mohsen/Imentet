<?php
ob_start();

$PageTitle = "Admins Platform";

include './init.php';

session_start();

if (isset($_SESSION["AdminID"])) {

    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
    if ($row['AdminRole'] == 1) {
        include "./Nav.php";

        $do = isset($_GET['action']) ?  $_GET['action'] : "Manage";

        if ($do == "Manage") { ?>

            <style>
                body{
                        background-image: url("./Images/333691937_546800627550330_2976087108571575641_n.jpg") , url("./Images/pexels-photo-3199399.jpeg");
                        background-position: 652px, -435px;
                        background-size: cover , cover;
                        height: 634px;
                        background-repeat: no-repeat, no-repeat;
                    }
            </style>
                
            <div class="Ticketspage">
                <div class="tickets Admins">
                    <a href="./Admins.php?action=Add">
                        Add Admin
                    </a>
                </div>
                <div class="tickets Admins">
                    <a href="./Admins.php?action=CheckAdmins" >
                        Check All Admins
                    </a>
                </div>
            </div>
            <div class="AdminHeading">
                <h1 class="page-name Admins"> Admins </h1>
            </div>

            <?php
        } elseif ($do == "Add") {  ?>
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
                            <input type="number" name="Phone" placeholder="Phone" class="form-control" autocomplete="off" required="required" />
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
                            <a href="./Admins.php?action=CheckAdmins" class="btn btn-danger btn-md w-10"> Cancel </a>
                        </div>
                    </div>
                </form>
            </div>
            <?php 
        } elseif ($do == 'Insert') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                $Name      = $_POST['Name'];
                $Phone     = $_POST['Phone'];
                $Address   = $_POST['Address'];
                $Email     = $_POST['Email'];
                $Password  = $_POST['Password'];
                $Role      = $_POST['Role'];
                $hashedPassword = password_hash($Password , PASSWORD_DEFAULT);

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

                if (empty($FormErrors)) {

                    $InsertQuery = "INSERT INTO `admin` Values( Null , '$Name' , $Phone , '$Address' , '$Email' , '$hashedPassword' , 1 , $Role )";
                    $Insert = mysqli_query($con, $InsertQuery);
                    echo "<div class='container'>";
                    $TheMsg =  "<div class='alert alert-success'> Admin Added Successfully </div>";
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                }else{
                    foreach ($FormErrors as $error) {
                        echo "<div class='alert alert-danger'>" . $error . "</div>";
                    }
                }
            } 
        } elseif ($do == "CheckAdmins") {

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
                        <h1 class="PageName">All Admins </h1>
                        <div class="container">
                            <button class="Control" data-toggle="collapse" data-target="#Control">Control</button>
                                <div class="buttons collapse" id="Control">
                                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="GET">
                                        <div class="Adminbuttons">
                                            <a href="./Admins.php?action=Resigned" class="btn btn-success">Check Resignations</a>
                                            <span class="AdminLine"> </span>
                                            <a href="./Admins.php?action=Add" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Admin</a>
                                            <span class="AdminLine"> </span>
                                            <a href="./Admins.php?action=Manage" class="btn btn-info">Back</a>
                                            <div class="AdminSort collapse" id="Control" >
                                                <i class="fa-solid fa-sort"></i> Sorting : [
                                                <a href="./Admins.php?action=CheckAdmins&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                echo 'active';
                                                                            } ?>"> Asc </a> |
                                                <a href="./Admins.php?action=CheckAdmins&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                echo 'active';
                                                                            } ?>"> Desc </a> ]
                                            </div>
                                        </div>
                                    </form>
                                    <form method="POST">
                                        <div class="MultiFilter">
                                            <div class="RoleFilter">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-filter"></i>  Filter By Role
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="Role[]" id="Role" class="FilterCheck" value="<?php echo $Role['ID'] ?>" <?php if(in_array( $Role['ID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                <?php echo $Role['Role'] ?>
                                                        </label>
                                                    <?php } ?>
                                                        <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                </div>
                                            </div>
                                            <div class="ActiveFilter">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-filter"></i>  Filter By Status
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" name="Active[]" id="Active" class="FilterCheck" value="<?php echo $Active['Active'] ?>" <?php if(in_array( $Active['Active'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                    <?php if($Active['Active'] == 1){ echo "Active" ; }elseif($Active['Active'] == 2){ echo "Resigned" ;}else{ echo "Deactivated";} ?>
                                                            </label>
                                                        <?php } ?>
                                                            <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                </div>
                                            </div>


                                        </div>
                                    </form>
                                </div>
                            <div class="table-responsive">
                                <table class="main-table table table-bordered table-hover">
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
                                                            echo "<td>" . $Admin['Phone']  . "</td>";
                                                            echo "<td>" . $Admin['Address'] . "</td>";
                                                            echo "<td>" . $Admin['Role']   . "</td>";
                                                            echo "<td>";
                                                                    if ($Admin['Active'] == 0) {
                                                                        echo "<button class='btn btn-dark' disabled> Not Activated </button>";
                                                                    }elseif($Admin['Active'] == 1) {
                                                                        echo "<button class='btn btn-primary' disabled> Activated </button>";
                                                                    }else{
                                                                        echo "<button class='btn btn-danger' disabled> Resigned </button>";
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
                                                        echo "<td>" . $Admin['Phone']  . "</td>";
                                                        echo "<td>" . $Admin['Address'] . "</td>";
                                                        echo "<td>" . $Admin['Role']   . "</td>";
                                                        echo "<td>";
                                                                if ($Admin['Active'] == 0) {
                                                                    echo "<button class='btn btn-dark' disabled> Not Activated </button>";
                                                                }elseif($Admin['Active'] == 1) {
                                                                    echo "<button class='btn btn-primary' disabled> Activated </button>";
                                                                }else{
                                                                    echo "<button class='btn btn-danger' disabled> Resigned </button>";
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
                                                        echo "<td>" . $Admin['Phone']  . "</td>";
                                                        echo "<td>" . $Admin['Address'] . "</td>";
                                                        echo "<td>" . $Admin['Role']   . "</td>";
                                                        echo "<td>";
                                                                if ($Admin['Active'] == 0) {
                                                                    echo "<button class='btn btn-dark' disabled> Not Activated </button>";
                                                                }elseif($Admin['Active'] == 1) {
                                                                    echo "<button class='btn btn-primary' disabled> Activated </button>";
                                                                }else{
                                                                    echo "<button class='btn btn-danger' disabled> Resigned </button>";
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
                                                        echo "<td>" . $Admin['Phone']  . "</td>";
                                                        echo "<td>" . $Admin['Address'] . "</td>";
                                                        echo "<td>" . $Admin['Role']   . "</td>";
                                                        echo "<td>";
                                                                if ($Admin['Active'] == 0) {
                                                                    echo "<button class='btn btn-dark' disabled> Not Activated </button>";
                                                                }elseif($Admin['Active'] == 1) {
                                                                    echo "<button class='btn btn-primary' disabled> Activated </button>";
                                                                }else{
                                                                    echo "<button class='btn btn-danger' disabled> Resigned </button>";
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

                        <?php 
                        
        } elseif ($do == "Resigned") {
                    
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
                <h1 class="PageName">Resignstions</h1>
                <div class="container">
                            <button class="Control" data-toggle="collapse" data-target="#Control">Control</button>
                                <div class="buttons collapse" id="Control">
                                    <div class="Adminbuttons">
                                        <a href="./Admins.php?action=Add" class="btn btn-primary"> <i class="fa fa-plus"></i> Add Admin</a>
                                        <span class="AdminLine"> </span>
                                        <a href="./Admins.php?action=CheckAdmins" class="btn btn-info">Back</a>
                                        <div class="AdminSort collapse" id="Control" >
                                            <i class="fa-solid fa-sort"></i> Sorting : [
                                            <a href="./Admins.php?action=Resigned&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                            echo 'active';
                                                                        } ?>"> Asc </a> |
                                            <a href="./Admins.php?action=Resigned&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                            echo 'active';
                                                                        } ?>"> Desc </a> ]
                                        </div>
                                    </div>
                                    <form method="POST">
                                        <div class="MultiFilter">
                                            <div class="RoleFilter">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-filter"></i>  Filter By Role
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
                                                        <label class="dropdown-item">
                                                            <input type="checkbox" name="Role[]" id="Role" class="FilterCheck" value="<?php echo $Role['ID'] ?>" <?php if(in_array( $Role['ID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                <?php echo $Role['Role'] ?>
                                                        </label>
                                                    <?php } ?>
                                                        <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                </div>
                                            </div>
                                            <div class="ActiveFilter">
                                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fa-solid fa-filter"></i>  Filter By Status
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
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
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" name="Active[]" id="Active" class="FilterCheck" value="<?php echo $Active['Active'] ?>" <?php if(in_array( $Active['Active'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                    <?php if($Active['Active'] == 1){ echo "Active" ; }elseif($Active['Active'] == 2){ echo "Resigned" ;}else{ echo "Deactivated";} ?>
                                                            </label>
                                                        <?php } ?>
                                                            <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                <div class="table-responsive">
                    <table class="main-table table table-bordered table-hover">
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
                                                                        if ($Admin['Active'] == 2) {
                                                                            echo "<button class='btn btn-danger' disabled> Resigned </button>";
                                                                        }elseif($Admin['Active'] == 1){
                                                                            echo "<a href='Admins.php?action=Deactive&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Activated ... Tab here To Deactivate It Temporarily' . "</a>";
                                                                        }elseif($Admin['Active'] == 0){
                                                                            echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Deactivated ... Tab here To Activate' . "</a>";
                                                                        }
                                                            echo "</td>";
                                                            echo "<td>" ;
                                                                        if ($Admin['Active'] == 2) {
                                                                            echo "<div class='tableButtons'>";
                                                                                echo "<a href='Admins.php?action=Delete&ID=" . $Admin['ID'] . "' class='btn btn-danger'><i class='fa fa-close'> </i> " . 'Accept'  . "</a>";
                                                                                echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='btn btn-primary'><i class='fa fa-edit'> </i> " . 'Refuse'  . "</a>";
                                                                            echo "</div>";
                                                                        }elseif($Admin['ID'] == $AdminID){
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
                                                                    if ($Admin['Active'] == 2) {
                                                                        echo "<button class='btn btn-danger' disabled> Resigned </button>";
                                                                    }elseif($Admin['Active'] == 1){
                                                                        echo "<a href='Admins.php?action=Deactive&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Activated ... Tab here To Deactivate It Temporarily' . "</a>";
                                                                    }elseif($Admin['Active'] == 0){
                                                                        echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Deactivated ... Tab here To Activate' . "</a>";
                                                                    }
                                                        echo "</td>";
                                                        echo "<td>" ;
                                                                    if ($Admin['Active'] == 2) {
                                                                        echo "<div class='tableButtons'>";
                                                                            echo "<a href='Admins.php?action=Delete&ID=" . $Admin['ID'] . "' class='btn btn-danger'><i class='fa fa-close'> </i> " . 'Accept'  . "</a>";
                                                                            echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='btn btn-primary'><i class='fa fa-edit'> </i> " . 'Refuse'  . "</a>";
                                                                        echo "</div>";
                                                                    }elseif($Admin['ID'] == $AdminID){
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
                                                                    if ($Admin['Active'] == 2) {
                                                                        echo "<button class='btn btn-danger' disabled> Resigned </button>";
                                                                    }elseif($Admin['Active'] == 1){
                                                                        echo "<a href='Admins.php?action=Deactive&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Activated ... Tab here To Deactivate It Temporarily' . "</a>";
                                                                    }elseif($Admin['Active'] == 0){
                                                                        echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Deactivated ... Tab here To Activate' . "</a>";
                                                                    }
                                                        echo "</td>";
                                                        echo "<td>" ;
                                                                    if ($Admin['Active'] == 2) {
                                                                        echo "<div class='tableButtons'>";
                                                                            echo "<a href='Admins.php?action=Delete&ID=" . $Admin['ID'] . "' class='btn btn-danger'><i class='fa fa-close'> </i> " . 'Accept'  . "</a>";
                                                                            echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='btn btn-primary'><i class='fa fa-edit'> </i> " . 'Refuse'  . "</a>";
                                                                        echo "</div>";
                                                                    }elseif($Admin['ID'] == $AdminID){
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
                                                                    if ($Admin['Active'] == 2) {
                                                                        echo "<button class='btn btn-danger' disabled> Resigned </button>";
                                                                    }elseif($Admin['Active'] == 1){
                                                                        echo "<a href='Admins.php?action=Deactive&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Activated ... Tab here To Deactivate It Temporarily' . "</a>";
                                                                    }elseif($Admin['Active'] == 0){
                                                                        echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='activate'>"   . 'Deactivated ... Tab here To Activate' . "</a>";
                                                                    }
                                                        echo "</td>";
                                                        echo "<td>" ;
                                                                    if ($Admin['Active'] == 2) {
                                                                        echo "<div class='tableButtons'>";
                                                                            echo "<a href='Admins.php?action=Delete&ID=" . $Admin['ID'] . "' class='btn btn-danger'><i class='fa fa-close'> </i> " . 'Accept'  . "</a>";
                                                                            echo "<a href='Admins.php?action=Active&ID=" . $Admin['ID'] . "' class='btn btn-primary'><i class='fa fa-edit'> </i> " . 'Refuse'  . "</a>";
                                                                        echo "</div>";
                                                                    }elseif($Admin['ID'] == $AdminID){
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
            <?php
        } elseif ($do == "Edit") {

            $AdminID = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;

            $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID ";
            $Select = mysqli_query($con, $SelectQuery);
            $row = mysqli_fetch_assoc($Select);
            $count = mysqli_num_rows($Select);

            if ($count > 0) {

            ?>

                <h1 class="PageName">Edit Admin</h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=Update" method="POST">
                        <input type="hidden" name="AdminID" value="<?php echo $AdminID; ?>">
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="text" name="Name" placeholder="Admin Name" class="form-control" autocomplete="off" value="<?php echo $row['Name']; ?>" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="number" name="Phone" placeholder="Phone" class="form-control" value="<?php echo $row['Phone']; ?>" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="text" name="Address" placeholder="Address" class="form-control" value="<?php echo $row['Address']; ?>" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="email" name="Email" placeholder="Email" class="form-control" value="<?php echo $row['Email']; ?>" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="password" name="Password" placeholder="Password" class="form-control" value="<?php echo $row['Password']; ?>" required="required" disabled />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <select name="Role" class="custom-select">
                                    <option value="0"> Admin Role </option>
                                    <?php
                                    $SelectRole = "SELECT * FROM adminrole";
                                    $Roles = mysqli_query($con, $SelectRole);
                                    $fetchquery = mysqli_fetch_assoc($Roles);

                                    foreach ($Roles as $Role) {
                                        echo "<option value='" . $Role['ID'] . "' >" . $Role['Role'] . " </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="InsertButton">
                                <input type="submit" value="Update" class="btn btn-success w-10" />
                                <a href="./Admins.php?action=CheckAdmins" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                    </form>

                </div>


            <?php } else {
                echo "<div class='container'>";
                $TheMsg = "<div class='alert alert-danger'>" . "Admin is not Exist" . "</div>";
                RedirectIndex($TheMsg);
                echo "</div>";
            }
        } elseif ($do == "Update") {

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $AdminID    = $_POST['AdminID'];
                $Name       = $_POST['Name'];
                $Phone      = $_POST['Phone'];
                $Address    = $_POST['Address'];
                $Email      = $_POST['Email'];
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
                if (empty($Email)) {
                    $FormErrors[] = "Email Cannot be Empty";
                }
                if ($Role == 0) {
                    $FormErrors[] = "Role Cannot be Empty";
                }

                if (empty($FormErrors)) {
                    $UpdateQuery = "UPDATE admin SET Name = '$Name' , Phone = $Phone , Address = '$Address' , Email = '$Email' , AdminRole = '$Role'  WHERE ID = $AdminID ";
                    $Update = mysqli_query($con, $UpdateQuery);

                    echo "<div class='container'>";
                    $TheMsg  = "<div class='alert alert-success'>" .  "Update Successfully " . '</div>';
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                }else{
                    foreach ($FormErrors as $error) {
                        echo "<div class='container'>";
                        echo "<div class='alert alert-danger'>" . $error . "</div>";
                        RedirectIndex($TheMsg, "back", 5);
                        echo "</div>";
                    }
                }

            } else {
                echo "<div class='container'>";
                $TheMsg = "<div class='alert alert-danger'>" . "Unuthorized access"  . "</div>";
                RedirectIndex($TheMsg, "Back", 5);
                echo "</div>";
            } 

        } elseif ($do == "Delete") { 

                $AdminID = isset($_GET['ID']) && is_numeric($_GET['ID']) ? intval($_GET['ID']) : 0;

                $Check = "SELECT * FROM admin WHERE ID = $AdminID";
                $CheckAdmin = mysqli_query($con, $Check);

                if ($Check > 0) {

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
                    $TheMsg = "<div class='alert alert-success'>" . "The Account is Activated Successfully" . '</div>';
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                } else {
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger'>" . "This Admin does not Exist"  . "</div>";
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
                    $TheMsg = "<div class='alert alert-success'>" . "The Account is Deactivated Successfully" . '</div>';
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                } else {
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger'>" . "This Admin does not Exist"  . "</div>";
                    RedirectIndex($TheMsg);
                    echo "</div>";
                }
        } else { 
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger'>" . "This Page Does Not Exist"  . "</div>";
                    RedirectIndex($TheMsg);
                    echo "</div>";
        }
            include "./Includes/PageContent/Footer.php";
    } else {
        echo "<div class='container'>";
        $TheMsg = "<div class='alert alert-danger'>" . "You Are Not Authorized To Access This Page"  . "</div>";
        RedirectIndex($TheMsg);
        echo "</div>";
    }
} else {
    if (!isset($_SESSION["AdminID"])) {
        header("Location: SignIn.php");
        exit();
    }
}
    ob_end_flush();

        ?>