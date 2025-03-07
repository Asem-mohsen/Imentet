<?php
ob_start();

$PageTitle = "Entertainments";

include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";
session_start();
session_regenerate_id();


if (isset($_SESSION["AdminID"])) { 
        $AdminID = $_SESSION['AdminID'];
        $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);
    include './NavAdmin.php';

        if( $row['AdminRole'] != 4){
            
            $AdminRole = $row['AdminRole'];

            $do = isset($_GET['action']) ? $_GET['action'] : "Manage" ;
            if($do == "Manage"){
                    $CategoriesQuery = "SELECT * FROM entertainmnetcategory " ;
                    $Categories = mysqli_query($con , $CategoriesQuery);
                    $row = mysqli_fetch_row($Categories); 
                    $now = $date = date("Y-m-d");
                    ?>

                    <div class="page d-flex overflow-h">
                        <div class="sidepar p-20 p-relative">
                            <h3 class="p-relative txt-center mt-0">Control</h3>
                            <ul>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Feedback.php?action=Manage">
                                        <i class="fa-solid fa-comment fa-fw"></i><span> Feedback </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Entertainments.php?action=CheckAll">
                                        <i class="fa-solid fa-search fa-fw"></i><span> Check All Events </span>
                                    </a>
                                </li>
                                <?php if($AdminRole == 2 || $AdminRole == 1 ){ ?>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Entertainments.php?action=AddCategory">
                                            <i class="fa-brands fa-plus fa-fw"></i><span> Add Category </span>
                                            </a>
                                        </li>
                                <?php } ?>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Dashboard.php">
                                        <i class="fa-solid fa-arrow-left fa-fw"></i><span> Dashboard </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="EventsPage w-full ml-50">
                            <h1 class='PageName p-relative mt-0'>Entertainments</h1>
                            <?php foreach($Categories as $Category){ 
                                        $CategoryID =$Category['ID'] ;
                                        $SelectQuery = "SELECT entertainmnet .* , eventstatus.Status AS Status FROM entertainmnet 
                                                        LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID 
                                                        WHERE entertainmnet.CatID = $CategoryID " ;
                                        $Select = mysqli_query($con , $SelectQuery);
                                        $rows = mysqli_fetch_row($Select);
                                        $count = mysqli_num_rows($Select);
                                    ?>
                                <div class="Category swiper swiper-container mySwiper">
                                            <h3 class="mt-50"><?php echo $Category['Name']; ?></h3>
                                            
                                    <div class="Boxes swiper-wrapper">
                                            <?php  if($count > 0 ){ ?>
                                                    <?php foreach($Select as $Events){ ?>
                                                        <div class="Box swiper-slide">
                                                            <?php if($Events['Date'] < $now && $Events['Everyday'] != "Daily"){
                                                                echo "<div class='PastEvent Past'>";
                                                                    echo "<p> Past </p> ";
                                                                echo "</div>" ;
                                                            }elseif($Events['Everyday'] == "Daily"){
                                                                echo "<div class='PastEvent Daily'>";
                                                                    echo "<p>" .$Events['Everyday'] .  "</p> ";
                                                                echo "</div>" ;
                                                            }else{
                                                                echo "<div class='PastEvent CancelledAndPostponed'>";
                                                                    echo "<p>" .$Events['Status'] .  "</p> ";
                                                                echo "</div>" ;
                                                            } ?>
                                                                <div class="bottomBox">
                                                                    <img src="./Images/<?php echo $Events['Image'] ; ?>" class="Image" alt="">
                                                                    <a href="./Entertainments.php?action=MoreInfo&EventID=<?php echo $Events['ID'] ; ?>"><?php  echo $Events['Name'] ; ?></a>
                                                                </div>
                                                        </div>
                                                    <?php } ?>
                                            <?php } ?>
                                        <div class="PlusBoxEntertainment swiper-slide">
                                            <a href="./Entertainments.php?action=AddEvent&CategoryID=<?php echo $CategoryID ?>">Add</a>
                                        </div>
                                        
                                    </div>

                                    <div class="swiper-pagination"></div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
            <?php }elseif($do == "CheckAll"){ 

                $sort = 'ASC';
                $Pricesort ='ASC';
                $sortarray = array('ASC', 'DESC');
            
                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];                
                }
                if (isset($_GET['Pricesort']) && in_array($_GET['Pricesort'], $sortarray)) {
                    $Pricesort = $_GET['Pricesort'];
                }


                $SelectQuery = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                JOIN place ON place.ID = entertainmnet.PlaceID 
                                ORDER BY entertainmnet.VIpPrice $Pricesort, entertainmnet.ID $sort
                                ";
                $Select = mysqli_query($con , $SelectQuery);
                $fetchquery = mysqli_fetch_row($Select);
                
                ?>  
                        <div class="page d-flex">
                            <div class=" w-280 sidepar p-20 p-relative">
                                <h3 class="p-relative txt-center mt-0">Control</h3>
                                <form method="post">
                                    <ul>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Entertainments.php?action=Manage">
                                                <i class="fa-solid fa-arrow-left fa-fw"></i><span> Back </span>
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
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Category </p>
                                        </li>
                                            <?php
                                                $ResponseSelect = "SELECT DISTINCT entertainmnetcategory.Name AS CatName ,entertainmnet.CatID AS CatID FROM `entertainmnet` JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID ";
                                                $Run = mysqli_query($con , $ResponseSelect);
                                                $row = mysqli_fetch_assoc($Run);
                                                foreach($Run as $Category){ 
                                                    $Checked = [];
                                                    if(isset($_POST['CatID'])){
                                                        $Checked = $_POST['CatID'];
                                                    }
                                            ?>
                                        <li>
                                                <input type="checkbox" name="CatID[]" value="<?php echo $Category['CatID'] ?>" <?php if(in_array( $Category['CatID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                <?php echo $Category['CatName'] ; ?>
                                        </li>
                                                <?php } 
                                            ?>
                                            
                                        <li>
                                            <p class='mt-20 ml-20 cursor-d fw-bold'>By Place </p>
                                        </li>
    
                                            <?php
                                                $PlaceSelect = "SELECT DISTINCT place.Name AS PlaceName , entertainmnet.PlaceID AS PlaceID FROM `entertainmnet` JOIN place ON place.ID = entertainmnet.PlaceID  ";
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
                                                <button type="submit" class="filterCareersbutton">Filter</button>
                                        <li>
                                            <h6 class='txt-center mt-20'><i class="fa-solid fa-sort fa-fw"></i> Sorting </h6>
                                        </li>
                                        <li>
                                            <div class="p-10 fs-14">
                                                Sorting : [
                                                            <a href="./Entertainments.php?action=CheckAll&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Asc </a> |
                                                            <a href="./Entertainments.php?action=CheckAll&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Desc </a> ]
                                            </div>
                                        </li>
                                        <li>
                                            <div class="p-10 fs-14">
                                                Price : [
                                                            <a href="./Entertainments.php?action=CheckAll&Pricesort=ASC" class="<?php if ($Pricesort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Lowest </a> |
                                                            <a href="./Entertainments.php?action=CheckAll&Pricesort=DESC" class="<?php if ($Pricesort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Highest </a> ]
                                            </div>
                                        </li>
                                    </ul>
                                </form>
                            </div>
                                <div class="container mb-20">
                                    <h1 class="PageName">All Events </h1>
                                    <div class="input-group md-form form-sm form-2 pl-0 mb-20">
                                        <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." id="myInput" onkeyup="myFunction()" aria-label="Search">
                                        <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="main-table table table-bordered table-hover table-light EventsTable" id="myTable">
                                            <tr>
                                                <td>ID</td>
                                                <td>Title</td>
                                                <td>Date</td>
                                                <td>Place</td>
                                                <td>Egyptian Price</td>
                                                <td>Foregin Price</td>
                                                <td>Category</td>
                                                <td>Action</td>
                                            </tr>
                                            <?php
                                                if(isset($_POST['PlaceID']) && isset($_POST['CatID'])){
                                                    $sql = "WHERE entertainmnet.PlaceID IN(".implode(',', $_POST['PlaceID'] ).") AND entertainmnet.CatID IN (".implode(',', $_POST['CatID']).")" ; 
                                                    $SelectQuery = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                                        JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                                        JOIN place ON place.ID = entertainmnet.PlaceID
                                                        $sql
                                                        ORDER BY entertainmnet.VIpPrice $Pricesort, entertainmnet.ID $sort
                                                        ";
                                                        $Select = mysqli_query($con , $SelectQuery);
                                                        $fetchquery = mysqli_fetch_row($Select);
                                                        $count = mysqli_num_rows($Select);

                                                        
                                                        if($count > 0 ){
                                                            foreach ($Select as $Event) {
                                                                echo "<tr id='TableData'>";
                                                                echo "<td>" . $Event['ID']     . "</td>";
                                                                echo "<td>" . $Event['Name']   . "</td>";
                                                                echo "<td>" . $Event['Date']  . "</td>";
                                                                echo "<td>" . $Event['PlaceName']  . "</td>";
                                                                echo "<td>" . $Event['EgyptianPrice'] . "</td>";
                                                                echo "<td>" . $Event['ForeginPrice'] . "</td>";
                                                                echo "<td>" . $Event['CatName']   . "</td>";
                                                                echo "<td>";
                                                                    echo "<a href='./Entertainments.php?action=MoreInfo&EventID=" . $Event['ID'] . "' class='btn btn-outline-primary activate'>"   . 'Check' . "</a>";
                                                                echo "</td>";
                                                                echo "</tr>";
                                                            }  
                                                        }
                                                }elseif(isset($_POST['PlaceID']) && !isset($_POST['CatID'])){
                                                    $sql = "WHERE entertainmnet.PlaceID IN(".implode(',', $_POST['PlaceID']).")";
                                                    $SelectQuery = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                                        JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                                        JOIN place ON place.ID = entertainmnet.PlaceID
                                                        $sql
                                                        ORDER BY entertainmnet.VIpPrice $Pricesort, entertainmnet.ID $sort
                                                        ";
                                                        $Select = mysqli_query($con , $SelectQuery);
                                                        $fetchquery = mysqli_fetch_row($Select);
                                                        $count = mysqli_num_rows($Select);

                                                    
                                                    if($count > 0 ){
                                                        foreach ($Select as $Event) {
                                                            echo "<tr id='TableData'>";
                                                            echo "<td>" . $Event['ID']     . "</td>";
                                                            echo "<td>" . $Event['Name']   . "</td>";
                                                            echo "<td>" . $Event['Date']  . "</td>";
                                                            echo "<td>" . $Event['PlaceName']  . "</td>";
                                                            echo "<td>" . $Event['EgyptianPrice'] . "</td>";
                                                            echo "<td>" . $Event['ForeginPrice'] . "</td>";
                                                            echo "<td>" . $Event['CatName']   . "</td>";
                                                            echo "<td>";
                                                                echo "<a href='./Entertainments.php?action=MoreInfo&EventID=" . $Event['ID'] . "' class='btn btn-outline-primary activate'>"   . 'Check' . "</a>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        } 
                                                    }
                                                }elseif(isset($_POST['CatID']) && !isset($_POST['PlaceID'])){
                                                    $sql = "WHERE entertainmnet.CatID IN(". implode(',', $_POST['CatID']).")";
                                                    $SelectQuery = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                                        JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                                        JOIN place ON place.ID = entertainmnet.PlaceID
                                                        $sql
                                                        ORDER BY entertainmnet.VIpPrice $Pricesort, entertainmnet.ID $sort
                                                        ";
                                                        $Select = mysqli_query($con , $SelectQuery);
                                                        $fetchquery = mysqli_fetch_row($Select);
                                                        $count = mysqli_num_rows($Select);

                                                    
                                                    if($count > 0 ){
                                                        foreach ($Select as $Event) {
                                                            echo "<tr id='TableData'>";
                                                            echo "<td>" . $Event['ID']     . "</td>";
                                                            echo "<td>" . $Event['Name']   . "</td>";
                                                            echo "<td>" . $Event['Date']  . "</td>";
                                                            echo "<td>" . $Event['PlaceName']  . "</td>";
                                                            echo "<td>" . $Event['EgyptianPrice'] . "</td>";
                                                            echo "<td>" . $Event['ForeginPrice'] . "</td>";
                                                            echo "<td>" . $Event['CatName']   . "</td>";
                                                            echo "<td>";
                                                                echo "<a href='./Entertainments.php?action=MoreInfo&EventID=" . $Event['ID'] . "' class='btn btn-outline-primary activate'>"   . 'Check' . "</a>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        } 
                                                    }
                                                }else{
                                                        $SelectQuery = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                                        JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                                        JOIN place ON place.ID = entertainmnet.PlaceID 
                                                        ORDER BY entertainmnet.VIpPrice $Pricesort, entertainmnet.ID $sort
                                                        ";
                                                        $Select = mysqli_query($con , $SelectQuery);
                                                        $fetchquery = mysqli_fetch_row($Select);

                                                    
                                                        foreach ($Select as $Event) {
                                                            echo "<tr id='TableData'>";
                                                            echo "<td>" . $Event['ID']     . "</td>";
                                                            echo "<td>" . $Event['Name']   . "</td>";
                                                            echo "<td>" . $Event['Date']  . "</td>";
                                                            echo "<td>" . $Event['PlaceName']  . "</td>";
                                                            echo "<td>" . $Event['EgyptianPrice'] . "</td>";
                                                            echo "<td>" . $Event['ForeginPrice'] . "</td>";
                                                            echo "<td>" . $Event['CatName']   . "</td>";
                                                            echo "<td>";
                                                                echo "<a href='./Entertainments.php?action=MoreInfo&EventID=" . $Event['ID'] . "' class='btn btn-outline-primary activate'>"   . 'Check' . "</a>";
                                                            echo "</td>";
                                                            echo "</tr>";
                                                        }  
                                                    
                                                }
                                            ?>
                                        </table>
                                    </div>
                                </div>
            <?php }elseif($do == "AddCategory"){
                ?>
                <h1 class="PageName"> Add Category </h1>
                        <div class="container">
                            <form class="form-horizontal" action="?action=InsertCategory" method="POST">
                                <div class="form-group insertInput mb-0">
                                    <div class="m-auto">
                                        <input type="text" name="Name" placeholder="Category Name" class="form-control" autocomplete="off" required="required" />
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <div class="InsertButton">
                                        <input type="submit" value="Create" class="btn btn-primary btn-md w-10" />
                                        <a href="./Entertainments.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                    </div>
                                </div>
                            </form>
            <?php }elseif($do == "InsertCategory"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $CategoryName = mysqli_real_escape_string($con , $_POST['Name']);

                        $FormErrors = array();
                
                        if (empty($CategoryName)) {
                            $FormErrors[] = "The Category Should Have a Name it Cannot be empty";
                        }
                        if (!preg_match ("/^[a-zA-z]*$/", $CategoryName) ) {  
                            $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                        }
                
                        if(empty($FormErrors)){
                            $InsertQuery = "INSERT INTO `entertainmnetcategory` Values( Null , '$CategoryName' )";
                            $Insert = mysqli_query($con, $InsertQuery);
                
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success text-center'> Category Added Successfully </div>";
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                        }else{
                            foreach ($FormErrors as $error) {
                                echo "<div class='alert alert-danger text-center'>" . $error . "</div>";
                            }
                        }
                    }
                ?>
            <?php }elseif($do == "AddEvent"){ 
                $CategoryID = $_GET['CategoryID'];
                if(empty($CategoryID)){
                    echo "<div class='NoData'>";
                        echo "<p> Category is Empty !</p>";
                    echo "</div>";
                }else{

                ?>
                <h1 class="PageName"> Add Event </h1>
                        <div class="container">
                            <form class="form-horizontal" action="?action=Insert" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="CategoryID" value="<?php echo $_GET['CategoryID']; ?>">
                                <div class="form-group insertInput mb-0">
                                    <div class="m-auto">
                                        <input type="text" name="Name" class="form-control" placeholder="Event Name" autocomplete="off" required="required" />
                                    </div>
                                </div>
                                <div class="form-group insertInput mb-0">
                                    <div class="mb-20">
                                    <input type="file" style="padding: 4px;" name="Image" placeholder="Image" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group insertInput mb-0">
                                <label class=" control-label">From</label>
                                    <div class="m-auto">
                                        <input type="date" name="Date" class="form-control" required="required" />
                                    </div>
                                </div>
                                <div class="form-group insertInput mb-0">
                                <label class=" control-label">To</label>
                                    <div class="m-auto">
                                        <input type="date" name="DateTo" class="form-control" />
                                    </div>
                                </div>
                                <div class="input-group insertInput mb-3">
                                    <div class="input-group-prepend mt-20">
                                        <div class="input-group-text">
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="Everyday"  value="Daily">
                                        </div>
                                    </div>
                                    <input type="text" placeholder="Everday Event" class="form-control mt-20" aria-label="Text input with checkbox" disabled>
                                </div>
                                <div class="form-group insertInput mb-0 ">
                                    <div class="m-auto">
                                        <input type="number" name="RegularPrice" placeholder="Egyptian Price" class="form-control" required="required" />
                                    </div>
                                </div>
                                <div class="form-group insertInput mb-0">
                                    <div class="mb-20">
                                        <input type="number" name="VIP" class="form-control" placeholder="Foreigners Price" />
                                    </div>
                                </div>
                                <div class="form-group insertInput">
                                    <div class="mb-20">
                                        <textarea type="text" name="Description" rows="5" class="form-control" placeholder="Event Description" ></textarea>
                                    </div>
                                </div> 
                                <div class="form-group insertInput mb-0">
                                    <div class="mb-20">
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
                                <div class="form-group insertInput mb-0">
                                    <div class="m-auto">
                                        <select name="SponsoredBy" class="custom-select" >
                                            <option value="0"> Sponsored By .. </option>
                                            <?php
                                            $SelectQuery = "SELECT * FROM sponsorship ";
                                            $Select = mysqli_query($con, $SelectQuery);
                                            $fetchquery = mysqli_fetch_assoc($Select);
                                            foreach ($Select as $Sponsorship) {
                                                echo "<option value='" . $Sponsorship['ContractID'] . "' >" . $Sponsorship['Name'] . " </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="InsertButton">
                                        <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                        <a href="./Entertainments.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php } ?>
            <?php }elseif($do == "Insert"){ 
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                            $CategoryID   = $_POST['CategoryID'];
                            $Name = mysqli_real_escape_string($con , $_POST['Name']);
                            $Description = mysqli_real_escape_string($con , $_POST['Description']);

                            $PlaceID      = $_POST['Place'];
                            $RegularPrice = $_POST['RegularPrice'];
                            $SponsoredBy  = $_POST['SponsoredBy'];

                            if(empty($_POST['VIP'])){
                                $VIP = Null;
                            }else{
                                $VIP      = $_POST['VIP'];
                            }
                            
                            if(empty($_POST['Everyday'])){
                                $Everyday =Null;
                            }else{
                                $Everyday = $_POST['Everyday'];
                            }

                            if(empty($Description)){
                                $Description = "Lorem ipsum dolor sit amet consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip";
                            }else{
                                $Description = mysqli_real_escape_string($con , $_POST['Description']);
                            }
                            
                            $rawdate      = htmlentities($_POST['Date']);
                            $Date         = date('Y-m-d', strtotime($rawdate));
                            $rawdateTo    = htmlentities($_POST['DateTo']);
                            $DateTo       = date('Y-m-d', strtotime($rawdateTo));
                            $now          = date("Y-m-d");

                            $image        = $_FILES['Image']['name'];
                            $folder       = "Images\Uploads\\".$image;


                            if (isset($image)) {
                                $imageName = $_FILES['Image']['name'];
                                $imageType = $_FILES['Image']['type'];
                                $imageTmp = $_FILES['Image']['tmp_name'];
                                move_uploaded_file($imageTmp,$folder);              
                            }


                            $FormErrors = array();
                            if (empty($Name)) {
                                $FormErrors[] = "The Event Should Have a Name";
                            }
                            if (empty($Date)) {
                                $FormErrors[] = "You Must Enter a Valid Date";
                            }
                            if (empty($RegularPrice)) {
                                $FormErrors[] = "Please Enter a Regular Price for the Event ";
                            }
                            if ($PlaceID == 0) {
                                $FormErrors[] = "You Must Select a Correct Place For The Event";
                            }
                            if ($SponsoredBy == 0) {
                                $FormErrors[] = "You Must Select a Sponsoreship For The Event";
                            }
                            if($Date < $now) {
                                $FormErrors[] = "The Event's Date Cannot be in the past";
                            }
                            if($DateTo == '0000-00-00') {
                                $DateTo = NULL ;
                            }
                            if (!preg_match ("/^[a-zA-z]*$/", $Name) ) {  
                                $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                            }

                            if (empty($FormErrors)) {

                                $InsertQuery = "INSERT INTO `entertainmnet` Values( Null , '$Name' , '$image' , '$Description' , $PlaceID , '$Date', '$DateTo' , '$Everyday' , $RegularPrice , '$VIP' , $CategoryID ) ";
                                $InsertEvent = mysqli_query($con, $InsertQuery);


                                $InsertAll = "INSERT INTO `eventsponsor` Values (NULL , '". mysqli_insert_id($con) . "' , $SponsoredBy )";
                                $InsertSponsers = mysqli_query($con, $InsertAll);

                                echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-success text-center'> Event Added Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                                echo "</div>";

                                
                            }else{
                                foreach ($FormErrors as $error) {
                                    echo "<div class='alert alert-danger text-center'>" . $error . "</div>";
                                }
                            }
                        } ?>

            <?php }elseif($do == "AddGallery"){ 
                $EventID = $_GET['EventID'];
                if(empty($EventID)){
                    echo "<div class='NoData'>";
                        echo "<p> Event is Empty !</p>";
                    echo "</div>";
                }else{

                ?>
                <h1 class="PageName"> Add Gallery </h1>
                    <div class="container">
                        <form class="form-horizontal" action="?action=InsertGallery" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="EventID" value="<?php echo $_GET['EventID']; ?>">
                            <div class="form-group insertInput mb-0">
                                <div class="mb-20">
                                    <input type="file" style="padding: 4px;" name="Image[]" multiple class="form-control" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="InsertButton">
                                    <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                    <a href="./Entertainments.php?action=MoreInfo&EventID=<?php echo $EventID ?>" class="btn btn-danger btn-md w-10"> Cancel </a>
                                </div>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            <?php }elseif($do == "InsertGallery"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                    $EventID = $_POST['EventID'];
                    $image = array_filter($_FILES['Image']['name']);
                    $targetDir = "Images\Uploads\\" ; 
                    $allowTypes = array('jpg','png','jpeg','gif'); 

                    if(!empty($image)){ 
                        foreach($_FILES['Image']['name'] as $key=>$val){ 
                            // File upload path 
                            $fileName = basename($_FILES['Image']['name'][$key]); 
                            $targetFilePath = $targetDir . $fileName; 
                            
                            // Check whether file type is valid 
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                            if(in_array($fileType, $allowTypes)){ 
                                // Upload file to server 
                                if(move_uploaded_file($_FILES["Image"]["tmp_name"][$key], $targetFilePath)){ 
                                    // Image db insert sql 
                                    $InsertQuery = "INSERT INTO `eventgallery` Values( Null , $EventID , '$fileName' ) ";
                                    $InsertEvent = mysqli_query($con, $InsertQuery);
                                    
                                }else{ 
                                    $errorUpload .= $_FILES['Image']['name'][$key].' | '; 

                                } 
                            }else{ 
                                $errorUploadType .= $_FILES['Image']['name'][$key].' | '; 
                            } 
                        } 
                        if($InsertEvent){
                            echo "<div class='container'>";
                            $TheMsg = "<div class='alert alert-success text-center'> Image Added Successfully </div>";
                            RedirectIndex($TheMsg, "Back");
                            echo "</div>";  
                        }
                    }else{
                        echo "<div class='alert alert-danger text-center'> Image Cannot Be Empty </div>" ;
                    }
                } ?>
            <?php }elseif($do == "MoreInfo"){ 
                
                $EventID = filter_var($_GET['EventID'] , FILTER_SANITIZE_NUMBER_INT); 
                if(empty($EventID)){
                    echo "<div class='NoData'>";
                        echo "<p>Event for Ghosts Only !  </p>";
                    echo "</div>";
                }else{

                $SelectEvent = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName, sponsorship.Name AS SponsorshipName , user.Name AS UserName ,user.ID AS UserID
                                    ,eventstatus.Status AS EventStatus ,eventstatus.Reason AS EventReason 
                                    FROM entertainmnet 
                                LEFT JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                LEFT JOIN place ON place.ID = entertainmnet.PlaceID
                                LEFT JOIN eventsponsor ON eventsponsor.EventID = entertainmnet.ID 
                                LEFT JOIN feedback ON entertainmnet.ID = feedback.EntertainmnetID
                                LEFT JOIN user ON feedback.UserID = user.ID
                                LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                                LEFT JOIN sponsorship ON eventsponsor.ContractID = sponsorship.ContractID
                                WHERE entertainmnet.ID = $EventID LIMIT 1 ";
                $Events = mysqli_query($con , $SelectEvent);
                $Event = mysqli_fetch_assoc($Events);


                $SelectFeedback = "SELECT feedback.* , userimages.Image AS UserImage , user.Name AS UserName
                                        FROM feedback
                                        LEFT JOIN user ON feedback.UserID = user.ID
                                        lEFT JOIN userimages ON user.ID = userimages.UserID
                                        WHERE EntertainmnetID = $EventID LIMIT 4 ";
                $FeedbackRun = mysqli_query($con , $SelectFeedback);
                $Feedbacks = mysqli_fetch_assoc($FeedbackRun);
                $CountFeedback = mysqli_num_rows($FeedbackRun);

                
                
                $TodaysDate = date("Y-m-d");

                $SelectCount = "SELECT COUNT(UserID) AS NumberOfPeople FROM entertainmnetticket WHERE EventID = $EventID";
                $SelectNumbers = mysqli_query($con , $SelectCount);
                $Numbers = mysqli_fetch_array($SelectNumbers);

                $now = date("Y-m-d");
                    if(isset($Event['ID'])){
                        $StartDate = date('d M Y', strtotime($Event['Date'])); 

                ?>
                <h1 class="c-black txt-center mt-70"> <?php echo $Event['Name'] ?> </h1>
                <section class="pt-40 event-details">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="event-details__content">
                                    <div class="event-details__single" id="about-event">
                                        <div class="event-details__event-info m-0">
                                            <div class="row">
                                                <div class="col-lg-6 d-flex">
                                                    <div class="my-auto">
                                                        <ul class="list-unstyled event-details__event-info__list">
                                                            <li>
                                                            <span class="mt-20">Date & Time</span>
                                                            <p>
                                                                <i class="fa fa-clock-o"></i>
                                                                <?php echo $StartDate ; 
                                                                        if($Event['DateTo'] != Null && $Event['DateTo'] != '0000-00-00' && $Event['DateTo'] != '1970-01-01'  && $Event['Everyday'] != "Daily" && !empty($Event['DateTo']) ){
                                                                            $EndDate = date('d M Y', strtotime($Event['DateTo']));
                                                                            echo " - " . $EndDate; 
                                                                            ; 
                                                                        }elseif($Event['Everyday'] == "Daily"){
                                                                            echo " - This Event Happens " . $Event['Everyday'] ;
                                                                        } ?> 
                                                            </p>
                                                            </li>
                                                            <li>
                                                            <span>Location</span>
                                                            <p>
                                                                <i class="fa fa-location-arrow"></i>
                                                                <?php echo $Event['PlaceName'] ?>
                                                            </p>
                                                            </li>
                                                            <li>
                                                            <span>Organizer</span>
                                                            <p>
                                                                <i class="fa fa-user"></i>
                                                                <?php echo $Event['SponsorshipName'] ?>
                                                            </p>
                                                            </li>
                                                            <li>
                                                                <span>Ticket Cost</span>
                                                                <p>
                                                                    <i class="fa fa-money"></i>
                                                                    Egyptian - <?php echo $Event['EgyptianPrice'] ." EGP" ;?> <br>
                                                                    
                                                                    <i class="fa fa-money"></i>
                                                                    <?php if(isset($Event['ForeignPrice']) && $Event['ForeignPrice'] != 0){ echo "Foreginers - " . $Event['ForeignPrice'] . " EGP" ; }  ?>
                                                                </p>
                                                            </li>
                                                            <li>
                                                                <span>Category</span>
                                                                <p class="mt-20">
                                                                    <i class="fa fa-card"></i>
                                                                    <?php echo $Event['CatName'] ?>
                                                                </p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 clearfix">
                                                    <img src="./images/<?php echo $Event['Image'] ?>" width="420px" height='420px'  class="float-right" alt="Awesome Image" />
                                                </div>
                                            </div>
                                        </div>
                                            <?php if($Event['EventStatus']){ ?>
                                                <div class='Status'>
                                                    <p>This Event was <?php echo $Event['EventStatus'] ?> due to <?php echo $Event['EventReason'] ?></p>
                                                </div>
                                            <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="event-details__form">
                                    <h3 class="event-details__form-title">Control</h3>
                                    <div class="row">
                                        <div class="col-sm-12 d-grid gap-20">
                                            <?php if($AdminRole == 1 || $AdminRole == 2){ 
                                                if($Event['Date'] < $now && !($Event['Everyday'] == 'Daily')){ 
                                                    echo "<button class='btn btn-success' disabled> Past </button>";
                                                }elseif($Event['EventStatus'] == "Cancelled"){
                                                    echo "<button class='thm-btn event-details__form-btn btn-danger' disabled> This Event is Cancelled </button>";
                                                }else{ ?>
                                                    <a href="./Entertainments.php?action=Edit&EventID=<?php echo $Event['ID'] ?>" class='thm-btn event-details__form-btn'> Edit</a>
                                                <?php }  
                                            }
                                            if($AdminRole == 1){ ?>
                                                <a href="./Entertainments.php?action=Delete&EventID=<?php echo $Event['ID'] ?>" class='thm-btn event-details__form-btn  btn-danger'>Delete</a>
                                            <?php } ?>
                                            <a href="./Entertainments.php?action=Manage" class='thm-btn event-details__form-btn' >Back</a>
                                            <a href="./Entertainments.php?action=AddGallery&EventID=<?php echo $Event['ID'] ?>" class='thm-btn event-details__form-btn'>Add Gallery</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='FeedbacksEnter'>
                        <div class="Feedback">
                            <h2 class="mt-0 mb-10">Latest Feedback</h2>
                            <?php if($CountFeedback > 0 ){
                                foreach ($FeedbackRun as $Feedback){ ?>
                                    <div class="UserImg">
                                        <img class="avatar" src="images/<?php echo $Feedback['UserImage'] ?>" alt="" />
                                        <a href="./Users.php?action=MoreInfo&UserID=<?php echo $Feedback['UserID'] ?>" class="c-gray" ><?php echo $Feedback['UserName'] ?></a>
                                    </div>
                                    <div class="details">
                                        <input type="text" disabled name="Feedback" value="<?php echo $Feedback['Description'] ?>">
                                    </div>
                                <?php } 
                            }else{ 
                                echo "<div class='NoFeedback'>";
                                    echo "<p> No Feedback Yet </p> " ;
                                echo "</div>";
                            } ?>
                        </div>
                    </div>
                </section>
                <?php 
                    }else{
                        echo "<div class='NoData'>";
                            echo "<p>Event Does Not Exist </p>";
                        echo "</div>";
                    }
                }
                ?>

            <?php }elseif($do == "Edit"){ 
                $EventID = isset($_GET['EventID']) && is_numeric($_GET['EventID']) ? intval($_GET['EventID']) : 0;

                if(empty($EventID)){
                    echo "<div class='NoData'>";
                        echo "<p>Where is The Event to Edit !</p>";
                    echo "</div>";
                }else{
                
                    $SelectQuery = "SELECT entertainmnet.* , place.Name AS PlaceName, place.ID AS PlaceID , sponsorship.ContractID AS SponsorshipID ,  sponsorship.Name AS SponsorshipName, entertainmnetcategory.Name AS CatName ,entertainmnetcategory.ID AS CatID
                                    FROM entertainmnet
                                    JOIN place ON place.ID = entertainmnet.PlaceID
                                    JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                    JOIN eventsponsor ON eventsponsor.EventID = entertainmnet.ID
                                    JOIN sponsorship ON eventsponsor.ContractID = sponsorship.ContractID 
                                    WHERE entertainmnet.ID = $EventID ";
                    $Select = mysqli_query($con, $SelectQuery);
                    $row = mysqli_fetch_assoc($Select);
                    $count = mysqli_num_rows($Select);
                    if(isset($row['ID'])){

                    ?>
                    <h1 class="PageName"> Edit Event </h1>
                            <div class="container">
                                <form class="form-horizontal" action="?action=Update&CatID=<?php echo $row['CatID'] ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="EventID" value="<?php echo $EventID; ?>">
                                    <div class="form-group insertInput mb-0">
                                        <div class="m-auto">
                                            <input type="text" name="Name" class="form-control" placeholder="Event Name" autocomplete="off" required="required" value="<?php echo $row['Name'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group insertInput mb-0">
                                        <div class="mb-20">
                                        <input type="file" style="padding: 4px;" name="Image" class="form-control" value="<?php echo $row['Image'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group insertInput mb-0">
                                        <div class="m-auto">
                                            <input type="date" name="Date" class="form-control"  required="required" value="<?php echo $row['Date'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group insertInput mb-0">
                                    <label class=" control-label">To</label>
                                        <div class="m-auto">
                                            <input type="date" name="DateTo" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="input-group insertInput mb-3">
                                        <div class="input-group-prepend mt-20">
                                            <div class="input-group-text">
                                                <input type="checkbox" aria-label="Checkbox for following text input" name="Everyday"  value="Daily" <?php if($row['Everyday'] == "Daily"){echo "Checked" ;} ?>>
                                            </div>
                                        </div>
                                        <input type="text" placeholder="Everday Event" class="form-control mt-20" aria-label="Text input with checkbox" disabled>
                                    </div>
                                    <div class="form-group insertInput mb-0">
                                        <div class="m-auto">
                                            <input type="number" name="RegularPrice" class="form-control" placeholder="Egyptian Price" required="required" value="<?php echo $row['EgyptianPrice'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group insertInput mb-0">
                                        <div class="m-auto">
                                            <input type="number" name="VIP" class="form-control" placeholder="Foreigners Price" value="<?php echo $row['ForeignPrice'] ?>" />
                                        </div>
                                    </div>
                                    <div class="form-group insertInput">
                                        <div class="mt-20">
                                            <textarea type="text" name="Description" rows="5" class="form-control" placeholder="Event Description" ><?php echo $row['Description'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group insertInput mb-0">
                                        <div class="mb-20 mt-20">
                                            <select name="Place" class="custom-select">
                                                <option value="<?php echo $row['PlaceID']?>"> <?php echo $row['PlaceName']?></option>
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

                                    <div class="form-group insertInput mb-0">
                                        <div class="mb-20">
                                            <select name="CatID" class="custom-select">
                                            <option value="<?php echo $row['CatID']?>"> <?php echo $row['CatName']?></option>
                                                <?php
                                                $SelectQuery = "SELECT * FROM entertainmnetcategory ";
                                                $Select = mysqli_query($con, $SelectQuery);
                                                $fetchquery = mysqli_fetch_assoc($Select);
                                                foreach ($Select as $Category) {
                                                    echo "<option value='" . $Category['ID'] . "' >" . $Category['Name'] . " </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group insertInput mb-0">
                                        <div class="m-auto">
                                            <select name="SponsoredBy" class="custom-select" >
                                            <option value="<?php echo $row['SponsorshipID']?>"> <?php echo $row['SponsorshipName']?></option>
                                                <?php
                                                $SelectQuery = "SELECT * FROM sponsorship ";
                                                $Select = mysqli_query($con, $SelectQuery);
                                                $fetchquery = mysqli_fetch_assoc($Select);
                                                foreach ($Select as $Sponsorship) {
                                                    echo "<option value='" . $Sponsorship['ContractID'] . "' >" . $Sponsorship['Name'] . " </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php if($AdminRole == 1){ ?>
                                        <div class="StatusDiv">
                                                <a class="btn btn-primary StatusButton" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">Event Status</a>
                                            <div class="col">
                                                <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                    <div>
                                                        <div class="form-group insertInput mb-0">
                                                            <div class="mb-20">
                                                                <select name="Status" class="custom-select">
                                                                    <option value="0"> Event Status </option>
                                                                    <option value="Postponed"> Postponed</option>
                                                                    <option value="Cancelled"> Cancelled</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group insertInput mb-0">
                                                            <div class="m-auto">
                                                                <textarea name="Reason" placeholder="Reason" class='form-control' rows="3"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="form-group">
                                        <div class="InsertButton">
                                            <input type="submit" value="Update" class="btn btn-success btn-md w-10" />
                                            <a href="./Entertainments.php?action=MoreInfo&EventID=<?php echo $EventID ?>" class="btn btn-danger btn-md w-10"> Cancel </a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                    <?php }else{
                            echo "<div class='NoData'>";
                                echo "<p>Event Does Not Exist </p>";
                            echo "</div>";
                        }
                    } ?>
            <?php }elseif($do == 'Update'){ 

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                                $EventID      = $_POST['EventID'];
                                $CategoryID   = $_POST['CatID'];
                                $Name         = mysqli_real_escape_string($con , $_POST['Name']);
                                $Description  = mysqli_real_escape_string($con , $_POST['Description']);
                                $PlaceID      = $_POST['Place'];
                                $RegularPrice = $_POST['RegularPrice'];
                                $SponsoredBy  = $_POST['SponsoredBy'];

                                if(empty($_POST['VIP'])){
                                    $VIP = Null;
                                }else{
                                    $VIP      = $_POST['VIP'];
                                }

                                if(empty($_POST['Everyday'])){
                                    $Everyday =Null;
                                }else{
                                    $Everyday = $_POST['Everyday'];
                                }

                                $Status       = $_POST['Status'];
                                $Reason       = $_POST['Reason'];

                                $rawdate      = htmlentities($_POST['Date']);
                                $Date         = date('Y-m-d', strtotime($rawdate));
                                
                                $rawdateTo      = htmlentities($_POST['DateTo']);
                                $DateTo         = date('Y-m-d', strtotime($rawdateTo));
                                
                                $now          = date("Y-m-d");

                                $image        = $_FILES['Image']['name'];
                                $folder       = "Images\Uploads\\".$image;


                                if (isset($image)) {
                                    $imageName = $_FILES['Image']['name'];
                                    $imageType = $_FILES['Image']['type'];
                                    $imageTmp = $_FILES['Image']['tmp_name'];
                                    move_uploaded_file($imageTmp,$folder);              
                                }

                                $FormErrors = array();

                                if (empty($Name)) {
                                    $FormErrors[] = "The Event Should Have a Name";
                                }
                                if (empty($Date)) {
                                    $FormErrors[] = "You Must Enter a Valid Date";
                                }
                                if (empty($RegularPrice)) {
                                    $FormErrors[] = "Please Enter a Egyptian Price for the Event ";
                                }

                                if (empty($image)){
                                    $FormErrors[] = "You Must Select an Image For The Event";
                                }

                                if($Date < $now) {
                                    $FormErrors[] = "The Event's Date Cannot be in the past";
                                }
                                if(empty($DateTo) || $DateTo == "1970-01-01") {
                                    $DateTo = NULL ;
                                }
                                if (!preg_match ("/^[a-zA-z]*$/", $Name) ) {  
                                    $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                                }

                                if (empty($FormErrors)) {

                                    $UpdateQuery = "UPDATE `entertainmnet` SET Name = '$Name' , Image = '$image', Description = '$Description' , PlaceID = $PlaceID , Date = '$Date', DateTo = '$DateTo'  , Everyday = '$Everyday'  , EgyptianPrice = $RegularPrice , ForeignPrice = '$VIP' , CatID = $CategoryID WHERE ID = $EventID ";
                                    $Update = mysqli_query($con, $UpdateQuery);

                                    $UpdateAll = "UPDATE `eventsponsor` SET  EventID = $EventID , ContractID = $SponsoredBy WHERE EventID = $EventID ";
                                    $InsertSponsers = mysqli_query($con, $UpdateAll);

                                    if($Status != 0 && !empty($Reason)){
                                        $Insert = "INSERT INTO `eventstatus` VALUES( NULL, $EventID , '$Status' , '$Reason' )";
                                        $InsertStatus = mysqli_query($con, $Insert);
                                    }
                                    

                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success txt-center'> Event Updated Successfully </div>";
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                                    
                                }else{
                                    foreach ($FormErrors as $error) {
                                        echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                                    }
                                }
                            } ?>
            <?php }elseif($do == 'Delete'){ 

                                $EventID = isset($_GET['EventID']) && is_numeric($_GET['EventID']) ? intval($_GET['EventID']) : 0;

                                $Check = "SELECT * FROM entertainmnet WHERE ID = $EventID";
                                $CheckEvent = mysqli_query($con, $Check);

                                if ($Check > 0) {
                                    
                                    $DeleteGalleryQuery = "DELETE FROM eventgallery WHERE EventID = $EventID ";
                                    $Delete = mysqli_query($con, $DeleteGalleryQuery);

                                    $DeleteSponsorQuery = "DELETE FROM eventsponsor WHERE EventID = $EventID ";
                                    $Delete = mysqli_query($con, $DeleteSponsorQuery);

                                    $DeleteEventQuery = "DELETE FROM entertainmnet WHERE ID = $EventID ";
                                    $Delete = mysqli_query($con, $DeleteEventQuery);

                                    header("Location: ./Entertainments.php?action=Manage");

                                } else {
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-danger txt-center'>" . "The Event Does Not Exist" . "</div>";
                                    RedirectIndex($TheMsg);
                                    echo "</div>";
                                }
                                ?>


            <?php }else{
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-danger txt-center'>"  . "No Page With This Name" . '</div>';
                        RedirectIndex($TheMsg);
                        echo "</div>";              
            } 
            
        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger txt-center'>"  . "You Are Not Authorized To Access This Platform" . '</div>';
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