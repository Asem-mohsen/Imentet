<?php
ob_start();

$PageTitle = "Transportation";

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

        if($AdminRole != 4 && $AdminRole != 3 ){
            $do = isset($_GET['action']) ? $_GET['action'] : "Manage" ;

            if($do == "Manage"){ 
                    $sort = 'ASC';
                    $sortarray = array('ASC', 'DESC');
                
                    if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                        $sort = $_GET['sort'];                
                    }
                    $Select = "SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                JOIN stations AS F2 ON transportation.StationTo = F2.StationID 
                                ORDER BY transportation.ID $sort
                                ";
                    $Query = mysqli_query($con , $Select);
                    $row = mysqli_fetch_assoc($Query);
                    $count = mysqli_num_rows($Query);

                ?>
                <div class="page d-flex">
                    <div class=" w-280 sidepar p-20 p-relative">
                        <h3 class="p-relative txt-center mt-0">Control</h3>
                        <form method="post">
                            <ul>
                            <?php if ($AdminRole == 1 ) { ?> 
                                <li>                            
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Transportation.php?action=Add">
                                        <i class="fa-solid fa-plus fa-fw"></i><span> Add New Time </span>
                                    </a>
                                </li>
                            <?php } ?>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Dashboard.php">
                                        <i class="fa-solid fa-arrow-left fa-fw"></i><span> Dashboard </span>
                                    </a>
                                </li>
                                <li>
                                    <h6 class='txt-center mt-20 cursor-d'> <i class="fa-solid fa-filter fa-fw"></i> Filters </h6>
                                </li>
                                <li>
                                    <p class='mt-20 ml-20 cursor-d fw-bold'> From </p>
                                </li>
                                    <?php
                                        $StationsSelect = "SELECT DISTINCT transportation.StationID , stations.Station As StationName ,stations.StationID AS StationIDF1 FROM transportation 
                                                            JOIN stations ON transportation.StationID = stations.StationID 
                                                            ";
                                        $Run = mysqli_query($con , $StationsSelect);
                                        $row = mysqli_fetch_assoc($Run);

                                        foreach($Run as $Station){ 
                                            $Checked = [];
                                            if(isset($_POST['StationIDF1'])){
                                                $Checked = $_POST['StationIDF1'];
                                            }
                                        ?>
                                <li>
                                    <input type="checkbox" name="StationIDF1[]" value="<?php echo $Station['StationIDF1'] ?>" <?php if(in_array( $Station['StationIDF1'] , $Checked)){ echo "Checked" ;  } ?>/>
                                        <?php echo $Station['StationName'] ; ?>
                                </li>
                                        <?php } 
                                    ?>

                                <li>
                                    <p class='mt-20 ml-20 cursor-d fw-bold'> To </p>
                                </li>
                                <?php
                                        $StationsSelect = "SELECT DISTINCT transportation.StationTo , stations.Station As StationTo ,stations.StationID AS StationIDF2 FROM transportation 
                                                            JOIN stations ON transportation.StationTo = stations.StationID 
                                                            "; 
                                        $Run = mysqli_query($con , $StationsSelect);
                                        $row = mysqli_fetch_assoc($Run);

                                        foreach($Run as $Station){ 
                                            $Checked = [];
                                            if(isset($_POST['StationIDF2'])){
                                                $Checked = $_POST['StationIDF2'];
                                            }
                                        ?>
                                <li>
                                    <input type="checkbox" name="StationIDF2[]" value="<?php echo $Station['StationIDF2'] ?>" <?php if(in_array( $Station['StationIDF2'] , $Checked)){ echo "Checked" ;  } ?>/>
                                        <?php echo $Station['StationTo'] ; ?>
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
                                                    <a href="./Transportation.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                    echo 'active';
                                                                                } ?>"> Asc </a> |
                                                    <a href="./Transportation.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                    echo 'active';
                                                                                } ?>"> Desc </a> ]
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                
                    <div class="container">
                            <h1 class="PageName">Transportation</h1>

                            <?php 
                            if($count > 0) { ?>
                                <div class="container">
                                    <div class="table-responsive">
                                        <table class="main-table table table-bordered table-hover table-light">
                                            <tr>
                                                <td>Bus ID</td>
                                                <td>From</td>
                                                <td>Arrival Time</td>
                                                <td>To</td>
                                                <td>Departure Time</td>
                                                <td>Price</td>
                                                <td>Actions</td>
                                            </tr>
                                            <?php
                                                if(isset($_POST['StationIDF2']) && isset($_POST['StationIDF1']) ){
                                                    $Select = "SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                                    JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                                    JOIN stations AS F2 ON transportation.StationTo = F2.StationID 
                                                    ORDER BY transportation.ID $sort
                                                    ";
                                                    $Query = mysqli_query($con , $Select);

                                                    $sql = "WHERE F1.StationID IN(".implode(',', $_POST['StationIDF1'] ).") AND F2.StationID IN (".implode(',', $_POST['StationIDF2']).")" ; 
                                                    $SelectTrans = "SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                                    JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                                    JOIN stations AS F2 ON transportation.StationTo = F2.StationID 
                                                    $sql
                                                    ORDER BY transportation.ID $sort
                                                    ";

                                                    $Query = mysqli_query($con , $SelectTrans);
                                                    $row = mysqli_fetch_assoc($Query);
                                                    $count = mysqli_num_rows($Query);
                                                    
                                                    
                                                    if($count > 0 ){
                                                        foreach ($Query as $Transportation) {
                                                            $Time24FormatArrival = $Transportation['ArrivalTime']  ;
                                                            $Time12FormatArrival = date('h:i A' , strtotime($Time24FormatArrival));
            
                                                            $Time24FormatDeparture = $Transportation['DepartureTime']  ;
                                                            $Time12FormatDeparture = date('h:i A' , strtotime($Time24FormatDeparture));
                                                            echo "<tr>";
                                                                echo "<td>" . $Transportation['ID']     . "</td>";
                                                                echo "<td class='bg-eee '>" . $Transportation['StationName']  . "</td>";
                                                                echo "<td>" . $Time12FormatArrival  . "</td>";
                                                                echo "<td class='bg-eee'>" . $Transportation['StationTo']  . "</td>";
                                                                echo "<td>" . $Time12FormatDeparture  . "</td>";
                                                                echo "<td>" ;
                                                                        if( $Transportation['Price'] == 0){
                                                                            echo "<p class='c-gray fs-13'> Free </p>";
                                                                            
                                                                        }else{
                                                                            echo  $Transportation['Price'] ;
                                                                        }
                                                                echo "</td>"; 
                                                                echo "<td>" ;
                                                                            if($AdminRole == 2){
                                                                                echo "<div class='tableButtons'>";
                                                                                    echo "<a href='./Transportation.php?action=Edit&TransportationID=". $Transportation['ID']."' class='btn btn-success'>Edit</a>";
                                                                                    echo "<button class='btn btn-danger' disabled> Remove </button>";
                                                                                echo "</div>";
                                                                            }else{
                                                                                echo "<div class='tableButtons'>";
                                                                                    echo "<a href='./Transportation.php?action=Edit&TransportationID=". $Transportation['ID']."' class='btn btn-success'>Edit</a>";
                                                                                    echo "<a href='./Transportation.php?action=Remove&TransportationID=". $Transportation['ID']."' class='btn btn-danger'>Remove</a>";
                                                                                echo "</div>";
                                                                            }
                                                                echo "</td>";
                                                        
                                                            echo "</tr>";
                                                        }   
                                                    }
                                                }elseif(isset($_POST['StationIDF2']) && !isset($_POST['StationIDF1'])){
                                                    $Select = "SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                                    JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                                    JOIN stations AS F2 ON transportation.StationTo = F2.StationID 
                                                    ORDER BY transportation.ID $sort
                                                    ";
                                                    $Query = mysqli_query($con , $Select);

                                                    $sql = "WHERE transportation.StationTo IN(".implode(',', $_POST['StationIDF2'] ).")" ; 
                                                    $SelectTrans = "SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                                    JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                                    JOIN stations AS F2 ON transportation.StationTo = F2.StationID 
                                                    $sql
                                                    ORDER BY transportation.ID $sort
                                                    ";

                                                    $Query = mysqli_query($con , $SelectTrans);
                                                    $row = mysqli_fetch_assoc($Query);
                                                    $count = mysqli_num_rows($Query);
            
                                                    
                                                    if($count > 0 ){
                                                        foreach ($Query as $Transportation) {
                                                            $Time24FormatArrival = $Transportation['ArrivalTime']  ;
                                                            $Time12FormatArrival = date('h:i A' , strtotime($Time24FormatArrival));
            
                                                            $Time24FormatDeparture = $Transportation['DepartureTime']  ;
                                                            $Time12FormatDeparture = date('h:i A' , strtotime($Time24FormatDeparture));
                                                            echo "<tr>";
                                                                echo "<td>" . $Transportation['ID']     . "</td>";
                                                                echo "<td class='bg-eee '>" . $Transportation['StationName']  . "</td>";
                                                                echo "<td>" . $Time12FormatArrival  . "</td>";
                                                                echo "<td class='bg-eee'>" . $Transportation['StationTo']  . "</td>";
                                                                echo "<td>" . $Time12FormatDeparture  . "</td>";
                                                                echo "<td>" ;
                                                                        if( $Transportation['Price'] == 0){
                                                                            echo "<p class='c-gray fs-13'> Free </p>";
                                                                            
                                                                        }else{
                                                                            echo  $Transportation['Price'] ;
                                                                        }
                                                                echo "</td>"; 
                                                                echo "<td>" ;
                                                                            if($AdminRole == 2){
                                                                                echo "<div class='tableButtons'>";
                                                                                    echo "<a href='./Transportation.php?action=Edit&TransportationID=". $Transportation['ID']."' class='btn btn-success'>Edit</a>";
                                                                                    echo "<button class='btn btn-danger' disabled> Remove </button>";
                                                                                echo "</div>";
                                                                            }else{
                                                                                echo "<div class='tableButtons'>";
                                                                                    echo "<a href='./Transportation.php?action=Edit&TransportationID=". $Transportation['ID']."' class='btn btn-success'>Edit</a>";
                                                                                    echo "<a href='./Transportation.php?action=Remove&TransportationID=". $Transportation['ID']."' class='btn btn-danger'>Remove</a>";
                                                                                echo "</div>";
                                                                            }
                                                                echo "</td>";
                                                        
                                                            echo "</tr>";
                                                        }   
                                                    }
                                                }elseif(isset($_POST['StationIDF1']) && !isset($_POST['StationIDF2'])){
                                                    $Select = "SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                                    JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                                    JOIN stations AS F2 ON transportation.StationTo = F2.StationID 
                                                    ORDER BY transportation.ID $sort
                                                    ";
                                                    $Query = mysqli_query($con , $Select);

                                                    $sql = "WHERE F1.StationID IN(".implode(',', $_POST['StationIDF1'] ).")" ; 
                                                    $SelectTrans = "SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                                    JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                                    JOIN stations AS F2 ON transportation.StationTo = F2.StationID 
                                                    $sql
                                                    ORDER BY transportation.ID $sort
                                                    ";

                                                    $Query = mysqli_query($con , $SelectTrans);
                                                    $row = mysqli_fetch_assoc($Query);
                                                    $count = mysqli_num_rows($Query);
            
                                                    
                                                    if($count > 0 ){
                                                        foreach ($Query as $Transportation) {
                                                            $Time24FormatArrival = $Transportation['ArrivalTime']  ;
                                                            $Time12FormatArrival = date('h:i A' , strtotime($Time24FormatArrival));
            
                                                            $Time24FormatDeparture = $Transportation['DepartureTime']  ;
                                                            $Time12FormatDeparture = date('h:i A' , strtotime($Time24FormatDeparture));
                                                            echo "<tr>";
                                                                echo "<td>" . $Transportation['ID']     . "</td>";
                                                                echo "<td class='bg-eee '>" . $Transportation['StationName']  . "</td>";
                                                                echo "<td>" . $Time12FormatArrival  . "</td>";
                                                                echo "<td class='bg-eee'>" . $Transportation['StationTo']  . "</td>";
                                                                echo "<td>" . $Time12FormatDeparture  . "</td>";
                                                                echo "<td>" ;
                                                                        if( $Transportation['Price'] == 0){
                                                                            echo "<p class='c-gray fs-13'> Free </p>";
                                                                            
                                                                        }else{
                                                                            echo  $Transportation['Price'] ;
                                                                        }
                                                                echo "</td>"; 
                                                                echo "<td>" ;
                                                                            if($AdminRole == 2){
                                                                                echo "<div class='tableButtons'>";
                                                                                    echo "<a href='./Transportation.php?action=Edit&TransportationID=". $Transportation['ID']."' class='btn btn-success'>Edit</a>";
                                                                                    echo "<button class='btn btn-danger' disabled> Remove </button>";
                                                                                echo "</div>";
                                                                            }else{
                                                                                echo "<div class='tableButtons'>";
                                                                                    echo "<a href='./Transportation.php?action=Edit&TransportationID=". $Transportation['ID']."' class='btn btn-success'>Edit</a>";
                                                                                    echo "<a href='./Transportation.php?action=Remove&TransportationID=". $Transportation['ID']."' class='btn btn-danger'>Remove</a>";
                                                                                echo "</div>";
                                                                            }
                                                                echo "</td>";
                                                        
                                                            echo "</tr>";
                                                        } 
                                                    }
                                                }else{
                                                    $Select = "SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                                    JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                                    JOIN stations AS F2 ON transportation.StationTo = F2.StationID 
                                                    ORDER BY transportation.ID $sort
                                                    ";
                                                    $Query = mysqli_query($con , $Select);
                                                    $row = mysqli_fetch_assoc($Query);
                                                    $count = mysqli_num_rows($Query);
                                                    
                                                    foreach ($Query as $Transportation) {
                                                        $Time24FormatArrival = $Transportation['ArrivalTime']  ;
                                                        $Time12FormatArrival = date('h:i A' , strtotime($Time24FormatArrival));

                                                        $Time24FormatDeparture = $Transportation['DepartureTime']  ;
                                                        $Time12FormatDeparture = date('h:i A' , strtotime($Time24FormatDeparture));
                                                        echo "<tr>";
                                                            echo "<td>" . $Transportation['ID']     . "</td>";
                                                            echo "<td class='bg-eee '>" . $Transportation['StationName']  . "</td>";
                                                            echo "<td>" . $Time12FormatArrival  . "</td>";
                                                            echo "<td class='bg-eee'>" . $Transportation['StationTo']  . "</td>";
                                                            echo "<td>" . $Time12FormatDeparture  . "</td>";
                                                            echo "<td>" ;
                                                                    if( $Transportation['Price'] == 0){
                                                                        echo "<p class='c-gray fs-13'> Free </p>";
                                                                        
                                                                    }else{
                                                                        echo  $Transportation['Price'] ;
                                                                    }
                                                            echo "</td>"; 
                                                            echo "<td>" ;
                                                                        if($AdminRole == 2){
                                                                            echo "<div class='tableButtons'>";
                                                                                echo "<a href='./Transportation.php?action=Edit&TransportationID=". $Transportation['ID']."' class='btn btn-success'>Edit</a>";
                                                                                echo "<button class='btn btn-danger' disabled> Remove </button>";
                                                                            echo "</div>";
                                                                        }else{
                                                                            echo "<div class='tableButtons'>";
                                                                                echo "<a href='./Transportation.php?action=Edit&TransportationID=". $Transportation['ID']."' class='btn btn-success'>Edit</a>";
                                                                                echo "<a href='./Transportation.php?action=Remove&TransportationID=". $Transportation['ID']."' class='btn btn-danger'>Remove</a>";
                                                                            echo "</div>";
                                                                        }
                                                            echo "</td>";
                                                    
                                                        echo "</tr>";
                                                    } 
                                                    
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                        
                    <?php }else{
                            echo "<div class='NoData'>";
                                echo "<p>No data to show </p>";
                                echo "<a href='./Dashboard.php' class='btn btn-primary'> Back </a>";
                            echo "</div>";   
                            echo "</div>";
                            echo "</div>";  
                                }
            }elseif($do == "Edit"){
                
                $TransportationID =filter_var($_GET['TransportationID'] , FILTER_SANITIZE_NUMBER_INT);

                if(empty($TransportationID)){
                    echo "<div class='NoData'>";
                        echo "<p>Literally No Way</p>";
                    echo "</div>";
                }else{
                    // $Select = "SELECT * FROM transportation WHERE ID = $TransportationID  ";
                    $Select = " SELECT transportation .* , F1.Station AS StationName  , F2.Station As StationTo FROM transportation 
                                JOIN stations AS F1 ON transportation.StationID = F1.StationID 
                                JOIN stations AS F2 ON transportation.StationTo = F2.StationID  
                                ";
                    $Query = mysqli_query($con , $Select);
                    $row = mysqli_fetch_assoc($Query);
                    if(isset($row['ID'])){

                ?>
                <h1 class="PageName"> Edit Transportation </h1>
                        <div class="container">
                            <form class="form-horizontal" action="?action=Update" method="POST">
                                <input type="hidden" name="TransportationID" value="<?php echo $row['ID']?>">
                            <div class="form-group insertInput">
                                <label class="mt-20 control-label">Arrival Time</label>
                                <div class="m-auto">
                                    <input type="time" name="ArrivalTime" class="form-control" value="<?php echo $row['ArrivalTime'] ?>" autocomplete="off" required="required" />
                                </div>
                            </div>  
                            <div class="form-group insertInput">
                            <label class="control-label">Departure Time</label>
                                <div class="m-auto">
                                    <input type="time" name="DepartureTime" class="form-control" value="<?php echo $row['ArrivalTime'] ?>"autocomplete="off" required="required" />
                                </div>
                            </div> 
                            <div class="form-group insertInput">
                                <label class="control-label"> Select a Start Point </label>
                                    <div class="m-auto">
                                        <select name="Start" class="custom-select">
                                            <option value="<?php echo $row['StationID'] ?>"> <?php  echo $row['StationName'] ?> </option>
                                            <?php
                                            $SelectQuery = "SELECT * FROM stations ";
                                            $Select = mysqli_query($con, $SelectQuery);
                                            $fetchquery = mysqli_fetch_assoc($Select);
                                            foreach ($Select as $stations) {
                                                echo "<option value='" . $stations['StationID'] . "' >" . $stations['Station'] . " </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>  
                            <div class="form-group insertInput">
                                <label class="control-label mt-20"> End Point </label>
                                    <div class="m-auto">
                                        <select name="End" class="custom-select">
                                        <option value="<?php echo $row['StationTo'] ?>"> <?php  echo $row['StationTo'] ?> </option>
                                            <?php
                                            $SelectQuery = "SELECT * FROM stations ";
                                            $Select = mysqli_query($con, $SelectQuery);
                                            $fetchquery = mysqli_fetch_assoc($Select);
                                            foreach ($Select as $stations) {
                                                echo "<option value='" . $stations['StationID'] . "' >" . $stations['Station'] . " </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>  
                                <div class="form-group">
                                    <div class="InsertButton">
                                        <input type="submit" value="Update" class="btn btn-success btn-md w-10" />
                                        <a href="./Transportation.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                            }else{
                                echo "<div class='NoData'>";
                                    echo "<p>Transportation Does Not Exist </p>";
                                echo "</div>";
                        }
                    }
            }elseif($do == "Update"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                    $TransportationID = filter_var($_POST['TransportationID'], FILTER_SANITIZE_NUMBER_INT);
                    $ArrivalTime = $_POST['ArrivalTime'];
                    $DepartureTime = $_POST['DepartureTime'];
                    $Start = $_POST['Start'];
                    $End = $_POST['End'];

                        $FormErrors = array();
                
                        if (empty($ArrivalTime)) {
                            $FormErrors[] = "The Arrival Time Cannot be empty";
                        }
                        if (empty($DepartureTime)) {
                            $FormErrors[] = "The Arrival Time Cannot be empty";
                        }
                        if ($Start == 0 ) {
                            $FormErrors[] = "The Start Point Cannot be empty";
                        }
                        if ($End == 0 ) {
                            $FormErrors[] = "The Departure Point Cannot be empty";
                        }
                        if ($End == $Start ) {
                            $FormErrors[] = "We've arrived Without Even a Single step !!!";
                        }

                        if(empty($FormErrors)){
                            $UpdateQuery = "UPDATE transportation SET StationID = $Start , ArrivalTime = '$ArrivalTime' , StationTo = '$End' , DepartureTime = '$DepartureTime' WHERE ID = $TransportationID";
                            $Update = mysqli_query($con, $UpdateQuery);
                                        
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success txt-center'> Transportation Time Updated Successfully </div>";
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                        }else{
                            foreach($FormErrors as $error){
                                    echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                            }
                        }
                    }
            }elseif($do == "Add"){
                ?>
                <h1 class="PageName"> Add New Time </h1>
                        <div class="container">
                            <form class="form-horizontal" action="?action=Insert" method="POST">
                            <div class="form-group insertInput">
                                <label class="mt-20 control-label">Arrival Time</label>
                                <div class="m-auto">
                                    <input type="time" name="ArrivalTime" class="form-control" autocomplete="off" required="required" />
                                </div>
                            </div>  
                            <div class="form-group insertInput">
                            <label class="control-label">Departure Time</label>
                                <div class="m-auto">
                                    <input type="time" name="DepartureTime" class="form-control" autocomplete="off" required="required" />
                                </div>
                            </div> 
                            <div class="form-group insertInput">
                            <label class="control-label"> Select a Start Point </label>
                                    <div class="m-auto">
                                        <select name="Start" class="custom-select">
                                            <option value="0"> --- </option>
                                            <?php
                                            $SelectQuery = "SELECT * FROM stations ";
                                            $Select = mysqli_query($con, $SelectQuery);
                                            $fetchquery = mysqli_fetch_assoc($Select);
                                            foreach ($Select as $stations) {
                                                echo "<option value='" . $stations['StationID'] . "' >" . $stations['Station'] . " </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group insertInput">
                                <label class="control-label mt-20"> End Point </label>
                                    <div class="m-auto">
                                        <select name="End" class="custom-select">
                                            <option value="0"> --- </option>
                                            <?php
                                            $SelectQuery = "SELECT * FROM stations ";
                                            $Select = mysqli_query($con, $SelectQuery);
                                            $fetchquery = mysqli_fetch_assoc($Select);
                                            foreach ($Select as $stations) {
                                                echo "<option value='" . $stations['StationID'] . "' >" . $stations['Station'] . " </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                            </div>    
                                <div class="form-group">
                                    <div class="InsertButton">
                                        <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                        <a href="./Transportation.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
            }elseif($do == "Insert"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $ArrivalTime = $_POST['ArrivalTime'];
                    $DepartureTime = $_POST['DepartureTime'];
                    $Start = $_POST['Start'];
                    $End = $_POST['End'];


                        $FormErrors = array();
                
                        if (empty($ArrivalTime)) {
                            $FormErrors[] = "The Arrival Time Cannot be empty";
                        }
                        if (empty($DepartureTime)) {
                            $FormErrors[] = "The Arrival Time Cannot be empty";
                        }
                        if ($Start == 0 ) {
                            $FormErrors[] = "The Start Point Cannot be empty";
                        }
                        if ($End == 0 ) {
                            $FormErrors[] = "The Departure Point Cannot be empty";
                        }
                        if ($End == $Start ) {
                            $FormErrors[] = "Same Point ?? Will the User Jump!!!";
                        }

                        if(empty($FormErrors)){
                            $InsertQuery = "INSERT INTO `transportation` Values( Null , 'Bus' ,  $Start , '$ArrivalTime' , '$End' , '$DepartureTime' , 0 )";
                            $Insert = mysqli_query($con, $InsertQuery);
                                        
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success txt-center'> Transportation Time Added Successfully </div>";
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                        }else{
                            foreach($FormErrors as $error){
                                    echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                            }
                        }
                    }
            }elseif($do == "Remove"){
                $TransportationID = isset($_GET['TransportationID']) && is_numeric($_GET['TransportationID']) ? intval($_GET['TransportationID']) : 0;

                $Check = "SELECT * FROM transportation WHERE ID = $TransportationID";
                $CheckTransportation = mysqli_query($con, $Check);

                if ($Check > 0) {

                    $DeleteQuery = "DELETE FROM transportation WHERE ID = $TransportationID ";
                    $Delete = mysqli_query($con, $DeleteQuery);

                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-success txt-center'>"  . "Transportation Deleted Successfully" . '</div>';
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                } else {
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger txt-center'>" . "The Transportation Does Not Exist" . "</div>";
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