<?php
ob_start();

$PageTitle = "Careers";

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
                    $DateSort ='';
                    $sortarray = array('ASC', 'DESC');
                
                    if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                        $sort = $_GET['sort'];                
                    }

                    if (isset($_GET['DateSort']) && in_array($_GET['DateSort'], $sortarray)) {
                        $DateSort = $_GET['DateSort'];
                    }

                    $ApplicationsQuery = "SELECT applications .* , user.Name AS UserName, user.ID AS UserID , careers.Careers As Career, sponsorship.Name As ContractName  FROM applications 
                                        LEFT JOIN user ON user.ID = applications.UserID 
                                        JOIN careers ON careers.ID = applications.CareerID
                                        LEFT JOIN sponsorship ON applications.ContractID = sponsorship.ContractID
                                        ORDER BY applications.Date $DateSort ,applications.ID $sort 
                                    ";
                
                    $Query = mysqli_query($con , $ApplicationsQuery);
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
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Careers.php?action=AddCareer">
                                                <i class="fa-solid fa-plus fa-fw"></i><span> Add Career </span>
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
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Careers </p>
                                        </li>
                                            <?php
                                                $CareersSelect = "SELECT DISTINCT careers.Careers As Career , careers.ID AS CareerID FROM `careers` 
                                                                    LEFT JOIN applications ON careers.ID = applications.CareerID
                                                                    ORDER BY careers.PlaceID DESC ";
                                                $Run = mysqli_query($con , $CareersSelect);
                                                $row = mysqli_fetch_assoc($Run);

                                                foreach($Run as $Career){ 
                                                    $Checked = [];
                                                    if(isset($_POST['CareerID'])){
                                                        $Checked = $_POST['CareerID'];
                                                    }
                                                    ?>
                                        <li>
                                            <input type="checkbox" name="CareerID[]" value="<?php echo $Career['CareerID'] ?>" <?php if(in_array( $Career['CareerID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                <?php echo $Career['Career'] ; ?>
                                        </li>
                                                <?php } 
                                            ?>
                                            
                                        <li>
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Status </p>
                                        </li>
                                                <?php
                                                $StatusSelect = "SELECT DISTINCT Approved FROM `applications` ";
                                                $Run = mysqli_query($con , $StatusSelect);
                                                $row = mysqli_fetch_assoc($Run);

                                                foreach($Run as $Status){ 
                                                    $Checked = [];
                                                    if(isset($_POST['Approved'])){
                                                        $Checked = $_POST['Approved'];
                                                    }
                                                    ?>
                                        <li>
                                            <input type="checkbox" name="Approved[]" value="<?php echo $Status['Approved'] ?>" <?php if(in_array( $Status['Approved'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                <?php if($Status['Approved'] == 1){ echo " Approved ";}elseif($Status['Approved'] == 2){ echo "Not Determined" ;}elseif($Status['Approved'] == 0){ echo "Rejected";} ?>
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
                                                            <a href="./Careers.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Asc </a> |
                                                            <a href="./Careers.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Desc </a> ]
                                            </div>
                                        </li>
                                        <li>
                                            <div class="p-10 fs-14">
                                                Date : [
                                                            <a href="./Careers.php?action=Manage&DateSort=ASC" class="<?php if ($DateSort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Nearest </a> |
                                                            <a href="./Careers.php?action=Manage&DateSort=DESC" class="<?php if ($DateSort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Furthest </a> ]
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                                
                                    <div class="container mb-50">
                                        <h1 class="PageName"> Applications </h1>
                                        <div class="input-group md-form form-sm form-2 pl-0 mb-20">
                                            <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." id="myInput" onkeyup="myFunction()" aria-label="Search">
                                            <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="main-table table table-bordered table-hover" id="myTable">
                                                <tr>
                                                    <td>ID</td>
                                                    <td>Applicant</td>
                                                    <td>Career</td>
                                                    <td>Appointment Date</td>
                                                    <td>Statues</td>
                                                    <td>Reason</td>
                                                    <td>Actions </td>
                                                </tr>
                                                <?php
                                                    if(isset($_POST['CareerID']) && isset($_POST['Approved'])){
                                                        $sql = "WHERE applications.CareerID IN(".implode(',', $_POST['CareerID'] ).") AND applications.Approved IN (".implode(',', $_POST['Approved']).")" ; 

                                                        $ApplicationsQuery = "SELECT applications .* , user.Name AS UserName, user.LastName AS LastName , user.ID AS UserID , careers.Careers As Career, sponsorship.Name As ContractName  FROM applications 
                                                                                LEFT JOIN user ON user.ID = applications.UserID 
                                                                                JOIN careers ON careers.ID = applications.CareerID
                                                                                LEFT JOIN sponsorship ON applications.ContractID = sponsorship.ContractID
                                                                                $sql
                                                                                ORDER BY applications.Date $DateSort ,applications.ID $sort 
                                                                                ";

                                                        $Query = mysqli_query($con , $ApplicationsQuery);
                                                        $fetchquery = mysqli_fetch_row($Query);
                                                        $count =mysqli_num_rows($Query);

                                                        
                                                        if($count > 0 ){
                                                            foreach ($Query as $ApplicationsQuery) {
                                                                    
                                                                $FullName =  $ApplicationsQuery['UserName'] . " " .  $ApplicationsQuery['LastName'] ;
                                                                echo "<tr id='TableData'>";
                                                                    echo "<td>" . $ApplicationsQuery['ID']     . "</td>";
                                                                    echo "<td>" ;
                                                                        if($ApplicationsQuery['CareerID'] == 2 && $ApplicationsQuery['Approved'] == 1  ){
                                                                            echo "<a href='./Careers.php?action=EquestriansProfile&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }elseif($ApplicationsQuery['CareerID'] == 3 && $ApplicationsQuery['Approved'] == 1 ){
                                                                            echo "<a href='./Careers.php?action=TourGuideProfile&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }elseif($ApplicationsQuery['UserID'] == NULL){
                                                                            echo $ApplicationsQuery['ContractName'] ;
                                                                        }else{
                                                                            echo "<a href='./Users.php?action=MoreInfo&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }
                                                                    echo "</td>";
                                                                    echo "<td>" . $ApplicationsQuery['Career']   . "</td>";
                                                                    echo "<td>" ; 
                                                                                    if($ApplicationsQuery['Date'] == NULL ){ 
                                                                                    
                                                                                        echo "<p class='fs-13'>Not Determined yet</p>" ;
                                                                                    }else{
                                                                                        echo $ApplicationsQuery['Date'];
                                                                                    } ; 
                                                                    echo "</td>";
                                                                    echo "<td>" ; 
                                                                                    if($ApplicationsQuery['Approved'] == 2 ){ 
                                                                                        echo "<p class='fs-13'> Not Determined Yet</p>" ;
                                                                                    }elseif($ApplicationsQuery['Approved'] == 1 ){
                                                                                        echo "Accepted";
                                                                                    }else{
                                                                                        echo "Rejected";
                                                                                    } ; 
                                                                    echo "</td>";
                                                                    echo "<td>" ;
                                                                                    if($ApplicationsQuery['Reason'] == NULL){
                                                                                        echo " ";
                                                                                    }else{
                                                                                        echo $ApplicationsQuery['Reason'];
                                                                                    }   
                                                                    echo "</td>";
                                                                    echo "<td>"; 
                                                                                    if($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 0){
                                                                                        echo "<button class='btn btn-danger' disabled> Rejected </button>";
                                                                                    }elseif($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 1){
                                                                                        echo "<button class='btn btn-success' disabled> Approved </button>";
                                                                                    }elseif($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 2){
                                                                                        echo "<a href='./Careers.php?action=Appointement&ApplicantID=".$ApplicationsQuery['ID']."' class='btn btn-primary'>Reviewing</a>";
                                                                                    }else{
                                                                                        echo "<a href='./Careers.php?action=Appointement&ApplicantID=".$ApplicationsQuery['ID']."' class='btn btn-dark'>Appointment</a>";
                                                                                    }
                                                                    echo "</td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }elseif(isset($_POST['CareerID']) && !isset($_POST['Approved'])){
                                                        $sql = "WHERE applications.CareerID IN(".implode(',', $_POST['CareerID']).")";

                                                        $ApplicationsQuery = "SELECT applications .* ,user.LastName AS LastName , user.Name AS UserName, user.ID AS UserID , careers.Careers As Career, sponsorship.Name As ContractName  FROM applications 
                                                                                LEFT JOIN user ON user.ID = applications.UserID 
                                                                                JOIN careers ON careers.ID = applications.CareerID
                                                                                LEFT JOIN sponsorship ON applications.ContractID = sponsorship.ContractID
                                                                                $sql
                                                                                ORDER BY applications.Date $DateSort ,applications.ID $sort 
                                                                                ";

                                                        $Query = mysqli_query($con , $ApplicationsQuery);
                                                        $fetchquery = mysqli_fetch_row($Query);
                                                        $count =mysqli_num_rows($Query);

                                                        
                                                        if($count > 0 ){
                                                            foreach ($Query as $ApplicationsQuery) {
                                                                    
                                                                $FullName =  $ApplicationsQuery['UserName'] . " " .  $ApplicationsQuery['LastName'] ;
                                                                echo "<tr id='TableData'>";
                                                                    echo "<td>" . $ApplicationsQuery['ID']     . "</td>";
                                                                    echo "<td>" ;
                                                                        if($ApplicationsQuery['CareerID'] == 2 && $ApplicationsQuery['Approved'] == 1  ){
                                                                            echo "<a href='./Careers.php?action=EquestriansProfile&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }elseif($ApplicationsQuery['CareerID'] == 3 && $ApplicationsQuery['Approved'] == 1 ){
                                                                            echo "<a href='./Careers.php?action=TourGuideProfile&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }elseif($ApplicationsQuery['UserID'] == NULL){
                                                                            echo $ApplicationsQuery['ContractName'] ;
                                                                        }else{
                                                                            echo "<a href='./Users.php?action=MoreInfo&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }
                                                                    echo "</td>";
                                                                    echo "<td>" . $ApplicationsQuery['Career']   . "</td>";
                                                                    echo "<td>" ; 
                                                                                    if($ApplicationsQuery['Date'] == NULL ){ 
                                                                                    
                                                                                        echo "<p class='fs-13'>Not Determined yet</p>" ;
                                                                                    }else{
                                                                                        echo $ApplicationsQuery['Date'];
                                                                                    } ; 
                                                                    echo "</td>";
                                                                    echo "<td>" ; 
                                                                                    if($ApplicationsQuery['Approved'] == 2 ){ 
                                                                                        echo "<p class='fs-13'> Not Determined Yet</p>" ;
                                                                                    }elseif($ApplicationsQuery['Approved'] == 1 ){
                                                                                        echo "Accepted";
                                                                                    }else{
                                                                                        echo "Rejected";
                                                                                    } ; 
                                                                    echo "</td>";
                                                                    echo "<td>" ;
                                                                                    if($ApplicationsQuery['Reason'] == NULL){
                                                                                        echo " ";
                                                                                    }else{
                                                                                        echo $ApplicationsQuery['Reason'];
                                                                                    }   
                                                                    echo "</td>";
                                                                    echo "<td>"; 
                                                                                    if($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 0){
                                                                                        echo "<button class='btn btn-danger' disabled> Rejected </button>";
                                                                                    }elseif($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 1){
                                                                                        echo "<button class='btn btn-success' disabled> Approved </button>";
                                                                                    }elseif($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 2){
                                                                                        echo "<a href='./Careers.php?action=Appointement&ApplicantID=".$ApplicationsQuery['ID']."' class='btn btn-primary'>Reviewing</a>";
                                                                                    }else{
                                                                                        echo "<a href='./Careers.php?action=Appointement&ApplicantID=".$ApplicationsQuery['ID']."' class='btn btn-dark'>Appointment</a>";
                                                                                    }
                                                                    echo "</td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }elseif(isset($_POST['Approved']) && !isset($_POST['CareerID'])){
                                                        $sql = "WHERE applications.Approved IN(". implode(',', $_POST['Approved']).")";
                                                        $ApplicationsQuery = "SELECT applications .* ,user.LastName AS LastName , user.Name AS UserName, user.ID AS UserID , careers.Careers As Career, sponsorship.Name As ContractName  FROM applications 
                                                                                LEFT JOIN user ON user.ID = applications.UserID 
                                                                                JOIN careers ON careers.ID = applications.CareerID
                                                                                LEFT JOIN sponsorship ON applications.ContractID = sponsorship.ContractID
                                                                                $sql
                                                                                ORDER BY applications.Date $DateSort ,applications.ID $sort 
                                                                                ";

                                                            $Query = mysqli_query($con , $ApplicationsQuery);
                                                            $fetchquery = mysqli_fetch_row($Query);
                                                            $count =mysqli_num_rows($Query);

                                                        
                                                        if($count > 0 ){
                                                            foreach ($Query as $ApplicationsQuery) {
                                                                    
                                                                $FullName =  $ApplicationsQuery['UserName'] . " " .  $ApplicationsQuery['LastName'] ;
                                                                echo "<tr id='TableData'>";
                                                                    echo "<td>" . $ApplicationsQuery['ID']     . "</td>";
                                                                    echo "<td>" ;
                                                                        if($ApplicationsQuery['CareerID'] == 2 && $ApplicationsQuery['Approved'] == 1  ){
                                                                            echo "<a href='./Careers.php?action=EquestriansProfile&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }elseif($ApplicationsQuery['CareerID'] == 3 && $ApplicationsQuery['Approved'] == 1 ){
                                                                            echo "<a href='./Careers.php?action=TourGuideProfile&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }elseif($ApplicationsQuery['UserID'] == NULL){
                                                                            echo $ApplicationsQuery['ContractName'] ;
                                                                        }else{
                                                                            echo "<a href='./Users.php?action=MoreInfo&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }
                                                                    echo "</td>";
                                                                    echo "<td>" . $ApplicationsQuery['Career']   . "</td>";
                                                                    echo "<td>" ; 
                                                                                    if($ApplicationsQuery['Date'] == NULL ){ 
                                                                                    
                                                                                        echo "<p class='fs-13'>Not Determined yet</p>" ;
                                                                                    }else{
                                                                                        echo $ApplicationsQuery['Date'];
                                                                                    } ; 
                                                                    echo "</td>";
                                                                    echo "<td>" ; 
                                                                                    if($ApplicationsQuery['Approved'] == 2 ){ 
                                                                                        echo "<p class='fs-13'> Not Determined Yet</p>" ;
                                                                                    }elseif($ApplicationsQuery['Approved'] == 1 ){
                                                                                        echo "Accepted";
                                                                                    }else{
                                                                                        echo "Rejected";
                                                                                    } ; 
                                                                    echo "</td>";
                                                                    echo "<td>" ;
                                                                                    if($ApplicationsQuery['Reason'] == NULL){
                                                                                        echo " ";
                                                                                    }else{
                                                                                        echo $ApplicationsQuery['Reason'];
                                                                                    }   
                                                                    echo "</td>";
                                                                    echo "<td>"; 
                                                                                    if($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 0){
                                                                                        echo "<button class='btn btn-danger' disabled> Rejected </button>";
                                                                                    }elseif($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 1){
                                                                                        echo "<button class='btn btn-success' disabled> Approved </button>";
                                                                                    }elseif($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 2){
                                                                                        echo "<a href='./Careers.php?action=Appointement&ApplicantID=".$ApplicationsQuery['ID']."' class='btn btn-primary'>Reviewing</a>";
                                                                                    }else{
                                                                                        echo "<a href='./Careers.php?action=Appointement&ApplicantID=".$ApplicationsQuery['ID']."' class='btn btn-dark'>Appointment</a>";
                                                                                    }
                                                                    echo "</td>";
                                                                echo "</tr>";
                                                            }
                                                        }
                                                    }else{
                                                            
                                                            $ApplicationsQuery = "SELECT applications .* , user.Name AS UserName,user.LastName AS LastName , user.ID AS UserID , careers.Careers As Career, sponsorship.Name As ContractName  FROM applications 
                                                                                LEFT JOIN user ON user.ID = applications.UserID 
                                                                                JOIN careers ON careers.ID = applications.CareerID
                                                                                LEFT JOIN sponsorship ON applications.ContractID = sponsorship.ContractID
                                                                                ORDER BY applications.Date $DateSort ,applications.ID $sort 
                                                                                ";
                                                            $Query = mysqli_query($con , $ApplicationsQuery);
                                                            $fetchquery = mysqli_fetch_row($Query);
                                                            $count =mysqli_num_rows($Query);
                                                                        
                                                            foreach ($Query as $ApplicationsQuery) {
                                                                    
                                                                $FullName =  $ApplicationsQuery['UserName'] . " " .  $ApplicationsQuery['LastName'] ;
                                                                echo "<tr id='TableData'>";
                                                                    echo "<td>" . $ApplicationsQuery['ID']     . "</td>";
                                                                    echo "<td>" ;
                                                                        if($ApplicationsQuery['CareerID'] == 2 && $ApplicationsQuery['Approved'] == 1  ){
                                                                            echo "<a href='./Careers.php?action=EquestriansProfile&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }elseif($ApplicationsQuery['CareerID'] == 3 && $ApplicationsQuery['Approved'] == 1 ){
                                                                            echo "<a href='./Careers.php?action=TourGuideProfile&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }elseif($ApplicationsQuery['UserID'] == NULL){
                                                                            echo $ApplicationsQuery['ContractName'] ;
                                                                        }else{
                                                                            echo "<a href='./Users.php?action=MoreInfo&UserID=". $ApplicationsQuery['UserID'] ."' >" . $FullName   . "</a>";
                                                                        }
                                                                    echo "</td>";
                                                                    echo "<td>" . $ApplicationsQuery['Career']   . "</td>";
                                                                    echo "<td>" ; 
                                                                                    if($ApplicationsQuery['Date'] == NULL ){ 
                                                                                    
                                                                                        echo "<p class='fs-13'>Not Determined yet</p>" ;
                                                                                    }else{
                                                                                        echo $ApplicationsQuery['Date'];
                                                                                    } ; 
                                                                    echo "</td>";
                                                                    echo "<td>" ; 
                                                                                    if($ApplicationsQuery['Approved'] == 2 ){ 
                                                                                        echo "<p class='fs-13'> Not Determined Yet</p>" ;
                                                                                    }elseif($ApplicationsQuery['Approved'] == 1 ){
                                                                                        echo "Accepted";
                                                                                    }else{
                                                                                        echo "Rejected";
                                                                                    } ; 
                                                                    echo "</td>";
                                                                    echo "<td>" ;
                                                                                    if($ApplicationsQuery['Reason'] == NULL){
                                                                                        echo " ";
                                                                                    }else{
                                                                                        echo $ApplicationsQuery['Reason'];
                                                                                    }   
                                                                    echo "</td>";
                                                                    echo "<td>"; 
                                                                                    if($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 0){
                                                                                        echo "<button class='btn btn-danger' disabled> Rejected </button>";
                                                                                    }elseif($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 1){
                                                                                        echo "<button class='btn btn-success' disabled> Approved </button>";
                                                                                    }elseif($ApplicationsQuery['Date'] != NULL && $ApplicationsQuery['Approved'] == 2){
                                                                                        echo "<a href='./Careers.php?action=Appointement&ApplicantID=".$ApplicationsQuery['ID']."' class='btn btn-primary'>Reviewing</a>";
                                                                                    }else{
                                                                                        echo "<a href='./Careers.php?action=Appointement&ApplicantID=".$ApplicationsQuery['ID']."' class='btn btn-dark'>Appointment</a>";
                                                                                    }
                                                                    echo "</td>";
                                                                echo "</tr>";
                                                            } 
                                                        
                                                    }
                                                ?>
                                            </table>
                                        </div>
                                    </div>
                        </div>
                                            
                    <?php }else{
                        echo "<div class='NoData'>";
                            echo "No Current Data";
                        echo "</div>";
                    }
            }elseif($do == "Appointement"){
                    $ApplicantID = $_GET['ApplicantID'];
                    if(empty($ApplicantID)){
                        echo "<div class='NoData'>";
                            echo "<p>We don't hire Ghosts yet </p>";
                        echo "</div>";
                    }else{
                    $ApplicationsQuery = "SELECT applications .* , user.Name AS UserName,  user.LastName AS LastName, user.ID AS UserID , careers.Careers As Career, sponsorship.Name As ContractName  FROM applications 
                                            LEFT JOIN user ON user.ID = applications.UserID 
                                            JOIN careers ON careers.ID = applications.CareerID
                                            LEFT JOIN sponsorship ON applications.ContractID = sponsorship.ContractID
                                            WHERE applications.ID = $ApplicantID "; 
                                            
                    $Query = mysqli_query($con , $ApplicationsQuery);
                    $row = mysqli_fetch_assoc($Query);
                    $count =mysqli_num_rows($Query);
                    if(isset($row['ID'])){
                        $FullName = $row['UserName'] . " " . $row['LastName'] ;
                                ?>
                <h1 class="PageName"> Interview </h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=InsertAppointement" method="POST">
                        
                    <input type="hidden" name="ApplicantID" value="<?php echo $ApplicantID ?>">
                        <div class="form-group insertInput mb-0">
                            <div class="m-auto">
                                <input type="text" name="Name" placeholder="Applicant Name" class="form-control" value="<?php if(isset($row['UserName'])){ echo $FullName ; }else{ echo $row['ContractName']; } ?>" disabled required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput mb-0">
                            <div class="m-auto">
                                <input type="text" name="Career" placeholder="Career" class="form-control" value="<?php echo $row['Career'] ?>" disabled required="required" />
                            </div>
                        </div>  
                        <div class="form-group insertInput mb-0">
                            <div class="mb-20">
                                <input type="date" name="Date" class="form-control" value="<?php if($row['Date'] != NULL ){ echo $row['Date'] ;} ?>" />
                            </div>
                        </div>

                        <div class="form-group insertInput mb-0">
                                    <div class="mb-20">
                                        <select name="Statues" class="custom-select">
                                            <option value=""> Interview Statues </option>
                                            <option value="2"> Under Consideration </option>
                                            <option value="0"> Rejected </option>
                                            <option value="1"> Approved </option>
                                        </select>
                                    </div>
                        </div>
                        <div class="form-group insertInput mb-0">
                            <div class="mb-20">
                                <textarea type="text" name="Reason" class="form-control" placeholder="Reason"></textarea> 
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="InsertButton">
                                <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                <a href="./Careers.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                        
                    </form>
                </div>
                    <?php
                        }else{
                            echo "<div class='NoData'>";
                                echo "<p>Application Does Not Exist </p>";
                            echo "</div>";
                    }
                }
            }elseif($do == "InsertAppointement"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $ApplicantID = $_POST['ApplicantID'];
                        $Statues  = $_POST['Statues'];
                        $Reason = mysqli_real_escape_string($con , $_POST['Reason']);

                        $rawdate      = htmlentities($_POST['Date']);
                        $Date         = date('Y-m-d', strtotime($rawdate));

                        $FormErrors = array();
                
                        if (empty($Date)) {
                            $FormErrors[] = "Date Cannot be empty";
                        }
                        if ($Statues == NULL) {
                            $FormErrors[] = "You Must Select a Statues";
                        }
                        if(($Statues == 0) && (empty($Reason))){
                            $FormErrors[] = "You Must Type a Reason for the Rejection";
                        }

                        if(empty($FormErrors)){
                            $InsertQuery = "UPDATE `applications` SET Date = '$Date' , Approved = $Statues , Reason = '$Reason' WHERE ID = $ApplicantID ";
                            $Insert = mysqli_query($con, $InsertQuery);
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success txt-center'> Application Updated Successfully </div>";
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                        }else{
                            foreach ($FormErrors as $error) {
                                echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                            }
                        }
                    }
            
            }elseif($do == "AddCareer"){ 
                ?>
                <h1 class="PageName"> Add Career </h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=InsertCareer" method="POST">
                        <div class="form-group insertInput mb-0">
                            <div class="m-auto">
                                <input type="text" name="Career" placeholder="Career" class="form-control" autocomplete="off" required="required" />
                            </div>
                        </div>  
                        <div class="form-group insertInput mb-0">
                                    <div class="m-auto">
                                        <select name="Place" class="custom-select">
                                            <option value="0"> Select a Place </option>
                                            <?php
                                            $SelectQuery = "SELECT * FROM place ";
                                            $Select = mysqli_query($con, $SelectQuery);
                                            $fetchquery = mysqli_fetch_assoc($Select);
                                            foreach ($Select as $Place) {
                                                echo "<option value='" . $Place['ID'] . "' >" . $Place['Name'] . " </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                        <div class="form-group">
                        <div class="InsertButton">
                                <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                <a href="./Careers.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                    </form>
                    <?php
            }elseif($do == "InsertCareer"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $Place  = $_POST['Place'];
                    $Career = mysqli_real_escape_string($con , $_POST['Career']);

                        $FormErrors = array();
                
                        if (empty($Career)) {
                            $FormErrors[] = "Career Cannot be empty";
                        }
                        if ($Place == 0) {
                            $FormErrors[] = "You Must Select a Place";
                        }
                        if (!preg_match ("/^[a-zA-z]*$/", $Career) ) {  
                            $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                        }
                        if(empty($FormErrors)){
                            $InsertQuery = "INSERT INTO `careers` Values( Null , '$Career' , $Place)";
                            $Insert = mysqli_query($con, $InsertQuery);
                                    header("Location: ./Careers.php?action=Manage");            
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success txt-center'> Career Added Successfully </div>";
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                        }
                    }
            }elseif($do == "EquestriansProfile"){
                $UserID = $_GET['UserID'];
                if(empty($UserID)){
                    echo "<div class='NoData'>";
                        echo "<p>Ghost Profile !</p>";
                    echo "</div>";
                }else{

                $SelectQuery = "SELECT user .* , applications.* FROM user JOIN applications ON user.ID = applications.UserID WHERE applications.UserID = $UserID LIMIT 1";
                $Select = mysqli_query($con , $SelectQuery);
                $Equestrian= mysqli_fetch_assoc($Select);
                if(isset($Equestrian['ID'])){
                    $FullName = $Equestrian['Name'] . " " . $Equestrian['LastName'] ;
                    ?>
                <div class="container rounded bg-white mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-3 border-right">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                        <span class="font-weight-bold"><?php echo $FullName?></span>
                                        <span class="text-black-50"><?php echo $Equestrian['Email']?></span>
                                        <span> </span>
                                    </div>
                                </div>
                                <div class="col-md-5 border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right"><?php echo $FullName?> Profile</h4>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">Name</label>
                                                <input type="text" class="form-control" placeholder="first name" disabled value="<?php echo $FullName?>">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Phone Number</label>
                                                <input type="number" class="form-control" placeholder="enter phone number" disabled value="<?php echo $Equestrian['Phone']?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Email</label>
                                                <input type="email" class="form-control" placeholder="enter email id" disabled value="<?php echo $Equestrian['Email']?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Date Of Interview</label>
                                                <input type="date" class="form-control" placeholder="enter email id" disabled value="<?php echo $Equestrian['Date']?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Reason of Acceptance</label>
                                                <input type="text" class="form-control" placeholder="enter email id" disabled value="<?php echo $Equestrian['Reason']?>">
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <a href="./Careers.php?action=Manage" class="btn btn-primary btn-md"> Back </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center experience">
                                            <span>Users Rating</span>
                                        </div>
                                            <br>
                                        <div class="col-md-12">
                                            <label class="labels">Rating</label>
                                            <input type="text" class="form-control" value="">
                                        </div> <br>
                                        <div class="col-md-12">
                                            <label class="labels">Feedback</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }else{
                            echo "<div class='NoData'>";
                                echo "<p>Profile Does Not Exist </p>";
                            echo "</div>";
                    }
                }
            }elseif($do == "TourGuideProfile"){
                $UserID = $_GET['UserID'];
                if(empty($UserID)){
                    echo "<div class='NoData'>";
                        echo "<p>Ghost Profile !</p>";
                    echo "</div>";
                }else{
                $SelectQuery = "SELECT user .* , applications.* FROM user JOIN applications ON user.ID = applications.UserID WHERE applications.UserID = $UserID LIMIT 1";
                $Select = mysqli_query($con , $SelectQuery);
                $TourGuide= mysqli_fetch_assoc($Select);
                if(isset($TourGuide['ID'])){
                    $FullName = $TourGuide['Name'] . " " . $TourGuide['LastName'] ;

                    ?>
                <div class="container rounded bg-white mt-5 mb-5">
                            <div class="row">
                                <div class="col-md-3 border-right">
                                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                                        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                        <span class="font-weight-bold"><?php echo $FullName ?></span>
                                        <span class="text-black-50"><?php echo $TourGuide['Email']?></span>
                                        <span> </span>
                                    </div>
                                </div>
                                <div class="col-md-5 border-right">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-right"><?php echo $FullName ?> Profile</h4>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-12">
                                                <label class="labels">Name</label>
                                                <input type="text" class="form-control" placeholder="first name" disabled value="<?php echo $FullName ?>">
                                            </div>
                                        </div>
                                        <div class="row mt-3">
                                            <div class="col-md-12">
                                                <label class="labels">Phone Number</label>
                                                <input type="number" class="form-control" placeholder="enter phone number" disabled value="<?php echo $TourGuide['Phone']?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Email</label>
                                                <input type="email" class="form-control" placeholder="enter email id" disabled value="<?php echo $TourGuide['Email']?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Date Of Interview</label>
                                                <input type="date" class="form-control" placeholder="enter email id" disabled value="<?php echo $TourGuide['Date']?>">
                                            </div>
                                            <div class="col-md-12">
                                                <label class="labels">Reason of Acceptance</label>
                                                <input type="text" class="form-control" placeholder="enter email id" disabled value="<?php echo $TourGuide['Reason']?>">
                                            </div>
                                        </div>
                                        <div class="mt-5 text-center">
                                            <a href="./Careers.php?action=Manage" class="btn btn-primary btn-md"> Back </a>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="p-3 py-5">
                                        <div class="d-flex justify-content-between align-items-center experience">
                                            <span>Users Rating</span>
                                        </div>
                                            <br>
                                        <div class="col-md-12">
                                            <label class="labels">Rating</label>
                                            <input type="text" class="form-control" value="">
                                        </div> <br>
                                        <div class="col-md-12">
                                            <label class="labels">Feedback</label>
                                            <input type="text" class="form-control" value="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                    }else{
                                        echo "<div class='NoData'>";
                                            echo "<p>Profile Does Not Exist </p>";
                                        echo "</div>";
                                }
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