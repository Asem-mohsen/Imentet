<?php
ob_start();

$PageTitle = "Entertainments Platform ";

include './init.php';

session_start();




if (isset($_SESSION["AdminID"])) { 
        $AdminID = $_SESSION['AdminID'];
        $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);
    if( $row['AdminRole'] != 4){
        
        $AdminRole = $row['AdminRole'];

        $do = isset($_GET['action']) ? $_GET['action'] : "Manage" ;
        include "./Nav.php";
            if($do == "Manage"){
                $CategoriesQuery = "SELECT * FROM entertainmnetcategory " ;
                $Categories = mysqli_query($con , $CategoriesQuery);
                $row = mysqli_fetch_row($Categories); 
                $now = $date = date("Y-m-d");
                ?>

                <div class="page d-flex overflow-h">
                    <div class="sidepar bg-white p-20 p-relative">
                        <h3 class="p-relative txt-center mt-0">Control</h3>
                        <ul>
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
                            <div class="Category swiper mySwiper">
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
                                                        <img src="./Images/<?php echo $Events['Image'] ; ?>" class="Image" alt="">
                                                            <div class="bottomBox">
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

            // SORTING 
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
            <h1 class="PageName">All Events </h1>
                            <div class="container mb-20">
                                    <button class="Control" data-toggle="collapse" data-target="#Control">Control</button>
                                        <div class="buttons collapse" id="Control">
                                            <div class='FilterAndButtons'>
                                                <a href="./Entertainments.php?action=Manage" class="btn btn-info">Back</a>
                                                <form method="POST">
                                                    <div class="MultiFilters"> 
                                                        <div class="RoleFilter">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-filter"></i>  Filter By Category
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <?php
                                                                $ResponseSelect = "SELECT DISTINCT entertainmnetcategory.Name AS CatName ,entertainmnet.CatID AS CatID FROM `entertainmnet` JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID ";
                                                                $Run = mysqli_query($con , $ResponseSelect);
                                                                $row = mysqli_fetch_assoc($Run);
                                                                foreach($Run as $Category){ 
                                                                    $Checked = [];
                                                                    if(isset($_POST['CatName'])){
                                                                        $Checked = $_POST['CatName'];
                                                                    }
                                                                    ?>
                                                                    <label class="dropdown-item">
                                                                        <input type="checkbox" name="CatID[]" value="<?php echo $Category['CatID'] ?>" <?php if(in_array( $Category['CatID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                            <?php echo $Category['CatName'] ; ?>
                                                                    </label>
                                                                <?php } ?>
                                                                    <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                            </div>
                                                        </div>

                                                        <div class="RoleFilter">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa-solid fa-filter"></i>  Filter By Place
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <?php
                                                                $PlaceSelect = "SELECT DISTINCT place.Name AS PlaceName , entertainmnet.PlaceID AS PlaceID FROM `entertainmnet` JOIN place ON place.ID = entertainmnet.PlaceID  ";
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
                                                    </div>
                                                </form>
                                            </div>
                                                <div class="TripleSort"> 
                                                    <div class="MultiSort collapse" id="Control" >
                                                        <i class="fa-solid fa-sort"></i> Sorting : [
                                                            <a href="./Entertainments.php?action=CheckAll&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Asc </a> |
                                                            <a href="./Entertainments.php?action=CheckAll&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Desc </a> ]
                                                    </div>
                                                    <div class="MultiSort collapse" id="Control" >
                                                        <i class="fa-solid fa-sort"></i> Regular Sort : [
                                                            <a href="./Entertainments.php?action=CheckAll&Pricesort=DESC" class="<?php if ($Pricesort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Highest </a> |
                                                            <a href="./Entertainments.php?action=CheckAll&Pricesort=ASC" class="<?php if ($Pricesort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Lowest </a> ]
                                                    </div>
                                                </div>
                                        </div>
                                <div class="table-responsive">
                                    <table class="main-table table table-bordered table-hover">
                                        <tr>
                                            <td>ID</td>
                                            <td>Title</td>
                                            <td>Date</td>
                                            <td>Place</td>
                                            <td>Price</td>
                                            <td>VIP Price</td>
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
                                                        echo "<tr>";
                                                        echo "<td>" . $Event['ID']     . "</td>";
                                                        echo "<td>" . $Event['Name']   . "</td>";
                                                        echo "<td>" . $Event['Date']  . "</td>";
                                                        echo "<td>" . $Event['PlaceName']  . "</td>";
                                                        echo "<td>" . $Event['RegularPrice'] . "</td>";
                                                        echo "<td>" . $Event['VipPrice'] . "</td>";
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
                                                    echo "<tr>";
                                                    echo "<td>" . $Event['ID']     . "</td>";
                                                    echo "<td>" . $Event['Name']   . "</td>";
                                                    echo "<td>" . $Event['Date']  . "</td>";
                                                    echo "<td>" . $Event['PlaceName']  . "</td>";
                                                    echo "<td>" . $Event['RegularPrice'] . "</td>";
                                                    echo "<td>" . $Event['VipPrice'] . "</td>";
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
                                                    echo "<tr>";
                                                    echo "<td>" . $Event['ID']     . "</td>";
                                                    echo "<td>" . $Event['Name']   . "</td>";
                                                    echo "<td>" . $Event['Date']  . "</td>";
                                                    echo "<td>" . $Event['PlaceName']  . "</td>";
                                                    echo "<td>" . $Event['RegularPrice'] . "</td>";
                                                    echo "<td>" . $Event['VipPrice'] . "</td>";
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
                                                    echo "<tr>";
                                                    echo "<td>" . $Event['ID']     . "</td>";
                                                    echo "<td>" . $Event['Name']   . "</td>";
                                                    echo "<td>" . $Event['Date']  . "</td>";
                                                    echo "<td>" . $Event['PlaceName']  . "</td>";
                                                    echo "<td>" . $Event['RegularPrice'] . "</td>";
                                                    echo "<td>" . $Event['VipPrice'] . "</td>";
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
                                <div class="Backbutton mt-0">
                                    <a href="./Entertainments.php?action=Manage"><i class="fa fa-arrow-left" aria-hidden="true"></i> </a>
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
                $CategoryName = $_POST['Name'];
            
                    $FormErrors = array();
            
                    if (empty($CategoryName)) {
                        $FormErrors[] = "The Category Should Have a Name it Cannot be empty";
                    }
            
                    if(empty($FormErrors)){
                        $InsertQuery = "INSERT INTO `entertainmnetcategory` Values( Null , '$CategoryName' )";
                        $Insert = mysqli_query($con, $InsertQuery);
            
                                echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-success'> Category Added Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                                echo "</div>";
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='alert alert-danger'>" . $error . "</div>";
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
                                <input type="file" name="Image" placeholder="Image" class="form-control" />
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
                                    <input type="number" name="RegularPrice" placeholder="Regular Price" class="form-control" required="required" />
                                </div>
                            </div>
                            <div class="form-group insertInput mb-0">
                                <div class="mb-20">
                                    <input type="number" name="VIP" class="form-control" placeholder="VIP Price" />
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
                        $Name         = $_POST['Name'];
                        $PlaceID      = $_POST['Place'];
                        $RegularPrice = $_POST['RegularPrice'];
                        $SponsoredBy  = $_POST['SponsoredBy'];

                        if(empty($_POST['VIP'])){
                            $VIP = Null;
                        }else{
                            $VIP          = $_POST['VIP'];
                        }
                        
                        if(empty($_POST['Everyday'])){
                            $Everyday =Null;
                        }else{
                            $Everyday = $_POST['Everyday'];
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
                        if($DateTo = '0000-00-00') {
                            $DateTo = NULL ;
                        }

                        if (empty($FormErrors)) {

                            $InsertQuery = "INSERT INTO `entertainmnet` Values( Null , '$Name' , '$image' , $PlaceID , '$Date', '$DateTo' , '$Everyday' , $RegularPrice , '$VIP' , $CategoryID ) ";
                            $InsertEvent = mysqli_query($con, $InsertQuery);


                            $InsertAll = "INSERT INTO `eventsponsor` Values (NULL , '". mysqli_insert_id($con) . "' , $SponsoredBy )";
                            $InsertSponsers = mysqli_query($con, $InsertAll);

                            echo "<div class='container'>";
                            $TheMsg = "<div class='alert alert-success'> Event Added Successfully </div>";
                            RedirectIndex($TheMsg, "Back");
                            echo "</div>";

                            
                        }else{
                            foreach ($FormErrors as $error) {
                                echo "<div class='alert alert-danger'>" . $error . "</div>";
                            }
                        }
                    } ?>

        <?php }elseif($do == "MoreInfo"){ 
            
            $EventID = filter_var($_GET['EventID'] , FILTER_SANITIZE_NUMBER_INT); 
            if(empty($EventID)){
                echo "<div class='NoData'>";
                    echo "<p>Event for Ghosts Only !  </p>";
                echo "</div>";
            }else{

            $SelectEvent = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName, sponsorship.Name AS SponsorshipName , feedback.Description AS Feedback, user.Name AS UserName ,user.ID AS UserID
                                ,eventstatus.Status AS EventStatus ,eventstatus.Reason AS EventReason 
                                FROM entertainmnet 
                            JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                            JOIN place ON place.ID = entertainmnet.PlaceID
                            JOIN eventsponsor ON eventsponsor.EventID = entertainmnet.ID 
                            LEFT JOIN feedback ON entertainmnet.ID = feedback.EntertainmnetID
                            LEFT JOIN user ON feedback.UserID = user.ID
                            LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                            JOIN sponsorship ON eventsponsor.ContractID = sponsorship.ContractID
                            WHERE entertainmnet.ID = $EventID LIMIT 1 ";
            $Events = mysqli_query($con , $SelectEvent);
            $fetchquery = mysqli_fetch_assoc($Events);
                
            $SelectCount = "SELECT COUNT(UserID) AS NumberOfPeople FROM entertainmnetticket WHERE EventID = $EventID";
            $SelectNumbers = mysqli_query($con , $SelectCount);
            $Numbers = mysqli_fetch_array($SelectNumbers);

            $now = date("Y-m-d");
                if(isset($fetchquery['ID'])){
            ?>

            <div class="EventPage">
                <?php
                foreach($Events as $Event){
                ?>
                    <div class="top">
                            <img src="./Images/<?php echo $Event['Image'] ?>" class="EventImage" alt="">
                    </div>
                    <h1> <?php echo $Event['Name'] ?> </h1>
                        <div class="info">
                            <h3><?php echo $Event['CatName'] ?></h3>
                            <div class="MoreInfo">
                                <p><i class="fa fa-map-marker" aria-hidden="true"></i><?php echo "  ". $Event['PlaceName'] ?></p>
                                <p><i class="fa-solid fa-hashtag" aria-hidden="true"></i><?php echo "  ". $Numbers['NumberOfPeople'] . " Attending"?></p>
                            </div>
                            <div class="Dates">
                                <?php
                                    if($Event['Everyday']){
                                            echo "<p><i class='fa fa-calendar' aria-hidden='true'></i>" . " Happens " . $Event['Everyday'] . "</p>";
                                        }else{
                                            echo "<p><i class='fa fa-calendar' aria-hidden='true'></i>" . ' On '. $Event['Date'] . "</p>";

                                        }
                                    if(($Event['DateTo'] == Null) || ($Event['DateTo'] == '0000-00-00')){
                                        }else{
                                            echo "<p><i class='fa fa-calendar' aria-hidden='true'></i>" . ' To '. $Event['DateTo'] . "</p>";
                                        } 
                                ?>
                            </div>
                            <div class="LastInfo">
                                <p>Regular Price : <?php echo $Event['RegularPrice'] ?> LE</p>
                                <p>Vip Price: <?php echo $Event['VipPrice'] ?> LE</p> 
                            </div>
                            
                            <?php if($Event['EventStatus']){ ?>
                                <div class='Status'>
                                    <p>This Event is <?php echo $Event['EventStatus'] ?> due to <?php echo $Event['EventReason'] ?></p>
                                </div>
                            <?php } ?>
                            <p class="sponsor"> This Event Is Sponsored By <?php echo $Event['SponsorshipName'] ?></p>
                        </div>
                        
                    <div class='FeedbacksEnter'>
                        <div class="Feedback">
                            <h2 class="mt-0 mb-10">Latest Feedback</h2>
                            <?php if($Event['Feedback'] == NULL ){
                                echo "<div class='NoFeedback'>";
                                    echo "<p> No Feedback Yet </p> " ;
                                echo "</div>";
                            }else{ ?>

                            
                                <div class="UserImg">
                                    <img class="avatar" src="images/avatar.png" alt="" />
                                    <a href="./Users.php?action=MoreInfo&UserID=<?php echo $Event['UserID'] ?>" class="c-gray" ><?php echo $Event['UserName'] ?></a>
                                </div>
                                <div class="details">
                                    <input type="text" disabled name="Feedback" value="<?php echo $Event['Feedback'] ?>">
                                </div>
                                <?php } ?>
                        </div>
                        <div class="EnterSpecialButtons">
                            <h2 class='ControlEnter'>Controls</h2>
                            <?php if($AdminRole == 1 || $AdminRole == 2){ 
                                        if($Event['Date'] < $now){ 
                                            echo "<button class='btn btn-success' disabled> Past </button>";
                                        }elseif($Event['EventStatus'] == "Cancelled"){
                                            echo "<button class='btn btn-danger' disabled> Cancelled </button>";
                                        }else{ ?>
                                <a href="./Entertainments.php?action=Edit&EventID=<?php echo $Event['ID'] ?>" class="btn btn-success"> Edit</a>
                            <?php }  }
                            if($AdminRole == 1){ ?>
                                <a href="./Entertainments.php?action=Delete&EventID=<?php echo $Event['ID'] ?>" class="btn btn-danger">Delete</a>
                            <?php } ?>
                            <a href="./Entertainments.php?action=Manage" class="btn btn-primary">Back</a>

                        </div>
                    </div>
                    
                
                <?php } ?>

            </div>
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

            
                $SelectQuery = "SELECT * FROM entertainmnet WHERE ID = $EventID ";
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
                                    <input type="file" name="Image" class="form-control" value="<?php echo $row['Image'] ?>"/>
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
                                            <input type="checkbox" aria-label="Checkbox for following text input" name="Everyday"  value="Daily">
                                        </div>
                                    </div>
                                    <input type="text" placeholder="Everday Event" class="form-control mt-20" aria-label="Text input with checkbox" disabled>
                                </div>
                                <div class="form-group insertInput mb-0">
                                    <div class="m-auto">
                                        <input type="number" name="RegularPrice" class="form-control" placeholder="Regular Price" required="required" value="<?php echo $row['RegularPrice'] ?>" />
                                    </div>
                                </div>
                                <div class="form-group insertInput mb-0">
                                    <div class="m-auto">
                                        <input type="number" name="VIP" class="form-control" placeholder="VIP Price" value="<?php echo $row['VipPrice'] ?>" />
                                    </div>
                                </div>
                                
                                <div class="form-group insertInput mb-0">
                                    <div class="mb-20">
                                        <select name="Place" class="custom-select">
                                            <option value="0"> Select a Place</option>
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
                                            <option value="0"> Change Category </option>
                                            <option value="No"> Doesn't want to Change The Category </option>
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
                                            <option value="0"> Sponsored By </option>
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
                            $Name         = $_POST['Name'];
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
                                $FormErrors[] = "Please Enter a Regular Price for the Event ";
                            }

                            if (empty($image)){
                                $FormErrors[] = "You Must Select an Image For The Event";
                            }
                            if ($PlaceID == 0) {
                                $FormErrors[] = "You Must Select a Correct Place For The Event";
                            }
                            if (empty($CategoryID) || $CategoryID == 0 || $CategoryID == 'No' ){
                                $CategoryID = $_GET['CatID'];
                            }
                            if ($SponsoredBy == 0) {
                                $FormErrors[] = "You Must Select a Sponsoreship For The Event";
                            }
                            if($Date < $now) {
                                $FormErrors[] = "The Event's Date Cannot be in the past";
                            }
                            if(empty($DateTo) || $DateTo == "1970-01-01") {
                                $DateTo = NULL ;
                            }

                            if (empty($FormErrors)) {

                                $UpdateQuery = "UPDATE `entertainmnet` SET Name = '$Name' , Image = '$image' , PlaceID = $PlaceID , Date = '$Date', DateTo = '$DateTo'  , Everyday = '$Everyday'  , RegularPrice = $RegularPrice , VipPrice = '$VIP' , CatID = $CategoryID WHERE ID = $EventID ";
                                $Update = mysqli_query($con, $UpdateQuery);

                                $UpdateAll = "UPDATE `eventsponsor` SET  EventID = $EventID , ContractID = $SponsoredBy WHERE EventID = $EventID ";
                                $InsertSponsers = mysqli_query($con, $UpdateAll);

                                if($Status != 0 && !empty($Reason)){
                                    $Insert = "INSERT INTO `eventstatus` VALUES( NULL, $EventID , '$Status' , '$Reason' )";
                                    $InsertStatus = mysqli_query($con, $Insert);
                                }
                                

                                echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-success'> Event Updated Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                                echo "</div>";
                                
                            }else{
                                foreach ($FormErrors as $error) {
                                    echo "<div class='alert alert-danger'>" . $error . "</div>";
                                }
                            }
                        } ?>
        <?php }elseif($do == 'Delete'){ 

                            $EventID = isset($_GET['EventID']) && is_numeric($_GET['EventID']) ? intval($_GET['EventID']) : 0;

                            $Check = "SELECT * FROM entertainmnet WHERE ID = $EventID";
                            $CheckEvent = mysqli_query($con, $Check);

                            if ($Check > 0) {
                                
                                $DeleteQuery = "DELETE FROM eventsponsor WHERE EventID = $EventID ";
                                $Delete = mysqli_query($con, $DeleteQuery);

                                $DeleteQuery = "DELETE FROM entertainmnet WHERE ID = $EventID ";
                                $Delete = mysqli_query($con, $DeleteQuery);

                                header("Location: ./Entertainments.php?action=Manage");

                            } else {
                                echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-danger'>" . "The Event Does Not Exist" . "</div>";
                                RedirectIndex($TheMsg);
                                echo "</div>";
                            }
                            ?>


        <?php }else{
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger'>"  . "No Page With This Name" . '</div>';
                    RedirectIndex($TheMsg);
                    echo "</div>";              
        } 
    
            include "./Includes/PageContent/Footer.php";

    }else{
        echo "<div class='container'>";
        $TheMsg = "<div class='alert alert-danger'>"  . "You Are Not Authorized To Access This Platform" . '</div>';
        RedirectIndex($TheMsg);
        echo "</div>";      
    } 
}else{
    if(!isset($_SESSION["AdminID"])){
        header("Location: SignIn.php");
        exit();
    }
}
ob_end_flush();

?>