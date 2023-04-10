<?php
ob_start();

$PageTitle = "Users Platform ";

include './init.php';

session_start();

if (isset($_SESSION["AdminID"])) { 
        $AdminID = $_SESSION['AdminID'];
        $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);

        $AdminRole = $row['AdminRole'];
        
        $do = isset($_GET['action']) ? $_GET['action'] : "Manage" ; 
        
        include './Nav.php';


        if($do == "Manage"){
                $sort = 'ASC';
                $sortarray = array('ASC', 'DESC');
        
                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];
                }
                $UserInfo = "SELECT user.* , userrole.RoleName AS UserRole, membership.Type AS MembershipType FROM user 
                            LEFT JOIN userrole ON userrole.ID = user.RoleID 
                            LEFT JOIN membership ON membership.ID = user.MembershipID
                            ORDER BY ID $sort";
                $Info = mysqli_query($con , $UserInfo);
                $fetchquery = mysqli_fetch_row($Info);
                $count =mysqli_num_rows($Info);
                if($count > 0 ){

                ?>
                            <h1 class="PageName"> Users </h1>
                                <div class="container mb-20">
                                        <?php if($AdminRole == 1 || $AdminRole == 2 ){ ?>
                                                <button class="Control" data-toggle="collapse" data-target="#Control">Control</button>
                                            <form action="" method="GET">
                                                <div class="buttons collapse buttonsUser" id="Control">
                                                    <div class="buttons">
                                                            <a href="./Users.php?action=AddUserRole" class="btn btn-primary">Add User Roles</a>
                                                            <span class="line"> </span>
                                                            <a href="./Users.php?action=AddMembership" class="btn btn-dark">Add Membership</a>
                                                            <span class="line"> </span>
                                                            <a href="./Users.php?action=CheckAllMembership" class="btn btn-info">Check All Membership</a>
                                                    </div>
                                                    <div class="Sort buttons collapse" id="Control" >
                                                        <i class="fa-solid fa-sort"></i> Sorting : [
                                                        <a href="?sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Asc </a> |
                                                        <a href="?sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Desc </a> ]
                                                    </div>
                                                    <div class="Filter">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-filter"></i>Filter
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php
                                                            $MembershipSelect = "SELECT * FROM membership";
                                                            $Run = mysqli_query($con , $MembershipSelect);
                                                            $row = mysqli_fetch_assoc($Run);

                                                            foreach($Run as $Membership){ 
                                                                $Checked = [];
                                                                if(isset($_GET['Type'])){
                                                                    $Checked = $_GET['Type'];
                                                                }
                                                                ?>
                                                                <label class="dropdown-item">
                                                                    <input type="checkbox" name="Type[]" value="<?php echo $Membership['ID'] ?>" <?php if(in_array( $Membership['ID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                        <?php echo $Membership['Type'] ?>
                                                                </label>
                                                            <?php } ?>
                                                            <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        <?php }else{ ?>
                                        
                                                    <button class="Control" data-toggle="collapse" data-target="#Control">Control</button>
                                                <form action="" method="GET">
                                                    
                                                    <div class="buttons collapse buttonsUser" id="Control">
                                                        <div class="Sort buttons collapse" id="Control" >
                                                            <i class="fa-solid fa-sort"></i> Sorting : [
                                                            <a href="?sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Asc </a> |
                                                            <a href="?sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                            echo 'active';
                                                                                        } ?>"> Desc </a> ]
                                                        </div>
                                                        <div class="Filter">
                                                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa-solid fa-filter"></i>Filter
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                                <?php
                                                                $MembershipSelect = "SELECT * FROM membership";
                                                                $Run = mysqli_query($con , $MembershipSelect);
                                                                $row = mysqli_fetch_assoc($Run);

                                                                foreach($Run as $Membership){ 
                                                                    $Checked = [];
                                                                    if(isset($_GET['Type'])){
                                                                        $Checked = $_GET['Type'];
                                                                    }
                                                                    ?>
                                                                    <label class="dropdown-item">
                                                                        <input type="checkbox" name="Type[]" value="<?php echo $Membership['ID'] ?>" <?php if(in_array( $Membership['ID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                            <?php echo $Membership['Type'] ?>
                                                                    </label>
                                                                <?php } ?>
                                                                <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                            
                                        <?php } ?>
                                    <div class="table-responsive">
                                        <table class="main-table table table-bordered table-hover">
                                            <tr>
                                                <td>ID</td>
                                                <td>Name</td>
                                                <td>Age</td>
                                                <td>Phone</td>
                                                <td>Nationality</td>
                                                <td>Role</td>
                                                <td>Membership</td>
                                                <td>Action</td>

                                            </tr>
                                            <?php
                                            if(isset($_GET['Type'])){
                                                $TypeChecked = [];
                                                $TypeChecked = $_GET['Type'];
                                                foreach($TypeChecked as $rowTypes){
                                                    $UserInfo = "SELECT user.* , userrole.RoleName AS UserRole, membership.Type AS MembershipType , membership.ID As MembershipID FROM user 
                                                    LEFT JOIN userrole ON userrole.ID = user.RoleID 
                                                    LEFT JOIN membership ON membership.ID = user.MembershipID
                                                    WHERE membership.ID IN($rowTypes) ";
                                                    $Info = mysqli_query($con , $UserInfo);
                                                    $fetchquery = mysqli_fetch_row($Info);
                                                    $count =mysqli_num_rows($Info);
                                                    if($count > 0 ){

                                                        foreach ($Info as $User) {
                                                            
                                                            if($User['MembershipType'] == NULL){

                                                                $User['MembershipType'] = "Does not have a membership";
                                                            }
                                                            echo "<tr>";
                                                            echo "<td>" . $User['ID']     . "</td>";
                                                            echo "<td>" . $User['Name']   . "</td>";
                                                            echo "<td>" . $User['Age']  . "</td>";
                                                            echo "<td>" . $User['Phone']  . "</td>";
                                                            echo "<td>" . $User['Nationality'] . "</td>";
                                                            echo "<td>" . $User['UserRole'] . "</td>";
                                                            echo "<td>" . $User['MembershipType'] . "</td>";
                                                                                                                    
                                                            echo "<td>";
                                                                echo "<a href='./Users.php?action=MoreInfo&UserID=" . $User['ID'] . "' class='btn btn-outline-primary activate'>"   . 'Check' . "</a>";
                                                            echo "</td>";

                                                            echo "</tr>";
                                                        } 
                                                    }
                                                }
                                            }else{
                                                foreach ($Info as $User) {
                                                            
                                                    if($User['MembershipType'] == NULL){

                                                        $User['MembershipType'] = "Does not have a membership";
                                                    }
                                                    echo "<tr>";
                                                    echo "<td>" . $User['ID']     . "</td>";
                                                    echo "<td>" . $User['Name']   . "</td>";
                                                    echo "<td>" . $User['Age']  . "</td>";
                                                    echo "<td>" . $User['Phone']  . "</td>";
                                                    echo "<td>" . $User['Nationality'] . "</td>";
                                                    echo "<td>" . $User['UserRole'] . "</td>";
                                                    echo "<td>" . $User['MembershipType'] . "</td>";
                                                                                                            
                                                    echo "<td>";
                                                        echo "<a href='./Users.php?action=MoreInfo&UserID=" . $User['ID'] . "' class='btn btn-outline-primary activate'>"   . 'Check' . "</a>";
                                                    echo "</td>";

                                                    echo "</tr>";
                                                } 

                                            }?>
                                        </table>
                                    </div>
                                </div>
                                
            <?php }else{
                echo "<div class='NoData'>";
                    echo "No Current Data";
                echo "</div>";

                }
        }elseif($do == "MoreInfo"){
                $UserID = filter_var($_GET['UserID'], FILTER_SANITIZE_NUMBER_INT); 
                if(empty($UserID)){
                    echo "<div class='NoData'>";
                        echo "<p>Sorry, We don't have Ghosts </p>";
                    echo "</div>";
                }else{

                $Users = "SELECT user.* , userrole.RoleName AS UserRole, membership.Type AS MembershipType 
                FROM user 
                LEFT JOIN userrole ON userrole.ID = user.RoleID 
                LEFT JOIN membership ON membership.ID = user.MembershipID WHERE user.ID = $UserID LIMIT 1";
                $Query = mysqli_query($con , $Users);
                $Userrow = mysqli_fetch_assoc($Query);
                if(isset($Userrow['ID'])){

                $UserName = $Userrow['Name'] ;

                foreach($Query as $User){
                        ?>
                    <div class="container rounded bg-white mb-5">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex flex-column align-items-center text-center p-3 ">
                                        <img class="rounded-circle mt-5" width="150px" src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                                        <span class="font-weight-bold"><?php echo $UserName ?></span>
                                        <span class="text-black-50"><?php echo $User['Email'] ?></span>
                                        <span> </span>
                                    </div>
                                </div>
                        </div>
                        <div class="info">
                            <div class="SomeInfo">
                                <button><?php echo $User['Nationality'] ?></button>
                                <button><?php echo "0" . $User['Phone'] ?></button>
                                <button><?php echo $User['UserRole'] ?></button>
                            </div>
                            <?php if($User['MembershipType'] != NULL){ ?>
                                        <div class="SomeInfo">
                                            <button><?php echo "Membership => " . $User['MembershipType'] ?></button>
                                        </div>
                            <?php } ?>
                        </div>
                    <?php } 
                        $Feedbacks = "SELECT feedback .* , entertainmnet.Name AS EventName FROM feedback
                                    LEFT JOIN entertainmnet ON feedback.EntertainmnetID = entertainmnet.ID  WHERE feedback.UserID = $UserID LIMIT 1";
                        $Query = mysqli_query($con , $Feedbacks);
                        $Feedback = mysqli_fetch_assoc($Query);
                        $count = mysqli_num_rows($Query);
                    ?>

                        <div class="UserInteractions">
                            <h3><?php echo $UserName ?> Interactions </h3>
                            <div class="ShowFeedback">
                                <h4 class="PanalHeading">Feedback</h4>
                                <div class="Feedback">
                                    <?php if($count > 0){
                                        foreach($Query as $Feedback){
                                        echo "<a href='./Entertainments.php?action=MoreInfo&EventID=".$Feedback['EntertainmnetID']."'>" . $Feedback['EventName'] . " Event</a>";
                                            echo"<span class='rec'> </span>";
                                        echo "<p>" . $Feedback['Description'] . "</p>";
                                    } }else{
                                        echo "<p class='NoData'>" .$UserName.  " Didn't Give a Feedback Yet </p>";
                                    } ?>
                                </div>
                            </div>
                                <?php  $TicketQuery = "SELECT visitticket . *  , place.Name AS PlaceName  FROM visitticket
                                                        JOIN place ON visitticket.PlaceID = place.ID
                                                        WHERE UserID = $UserID LIMIT 5
                                                        ";
                                        $Query = mysqli_query($con , $TicketQuery);
                                        $fetchquery = mysqli_fetch_row($Query);
                                        $count = mysqli_num_rows($Query);

                                ?>

                            <h4 class="PanalHeading">Tickets Booked</h4>

                            <div class="ShowTickets">
                                <div class="ShowVisit">
                                    <h4 class="SmallHeading">Visits</h4>
                                    <div class="Tickets">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">To</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($count > 0){ 
                                            foreach($Query as $VisitTicket){ ?>
                                            <tr>
                                            <td><?php echo $VisitTicket['Date']  ?></td>
                                            <td><?php echo $VisitTicket['PlaceName']  ?></td>
                                            <?php } }else{
                                                echo "<td class='NoData' colspan='3'> No Bookings for " .$UserName . "</td>";
                                            } ?>

                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                <?php  $TicketQuery = "SELECT entertainmnetticket . *  , entertainmnet.Name AS EventName , entertainmnet.Date As Date FROM entertainmnetticket
                                                        JOIN entertainmnet ON entertainmnetticket.EventID = entertainmnet.ID
                                                        WHERE UserID = $UserID LIMIT 5
                                                        ";
                                        $Query = mysqli_query($con , $TicketQuery);
                                        $fetchquery = mysqli_fetch_row($Query);
                                        $count = mysqli_num_rows($Query);

                                ?>
                                <div class="ShowEvents">
                                    <h4 class="SmallHeading">Entertainments</h4>
                                    <div class="Tickets">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Event</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php if($count > 0){ 
                                                foreach($Query as $Ticket){ ?>
                                            <tr>
                                            <td><?php echo $Ticket['Date']  ?></td>
                                            <td><?php echo $Ticket['EventName']  ?></td>
                                            </tr>
                                    <?php  } }else{
                                                echo "<td class='NoData' colspan='3'> No Bookings for " .$UserName . "</td>";
                                            } ?>
                                    </tbody>
                                    </table>
                                    </div>
                                </div>
                            </div>

                            <?php  $GiftsQuery = "SELECT useritems . *  , giftshop.Item AS ItemName , giftshop.Image As Image FROM useritems
                                                        JOIN giftshop ON useritems.GiftShopID = giftshop.ID
                                                        WHERE UserID = $UserID LIMIT 4
                                                        ";
                                        $Query = mysqli_query($con , $GiftsQuery);
                                        $fetchquery = mysqli_fetch_row($Query);
                                        $count = mysqli_num_rows($Query);

                                ?>
                            <h4 class="PanalHeading">Gift Shop</h4>
                            <div class="ShowGifts">
                            <div class="Items">
                                <?php if($count > 0 ){
                                        foreach($Query as $Item){ ?>
                                        <div class="ItemBox">
                                            <img src="./Images/<?php echo $Item['Image'] ?>" class="GiftImage" width="200px" height="200px" alt="">
                                            <a href="#"><?php echo $Item['ItemName'] ?></a>
                                            <div class="buttom">
                                                <button class="btn btn-success" disabled >Bought</button>
                                            </div>
                                        </div>
                                        <?php } }else{
                                                echo "<p class='NoData'>" .$UserName . " Didn't purchase any Items </p>";
                                            }  ?>
                                    </div>
                            </div>

                        </div>

                        <div class="Backbutton">
                            <a href="./Users.php?action=Manage"><i class="fa fa-arrow-left" aria-hidden="true"></i> </a>
                        </div> 
                    </div>
                    <?php
                }else{
                    echo "<div class='NoData'>";
                        echo "<p> The User Does not Exist </p>";
                    echo "</div>";
                }
            }
        }elseif($do == "CheckAllMembership"){ 
            $SelectMembership = "SELECT * FROM membership";
            $Query = mysqli_query($con , $SelectMembership);
            $row = mysqli_fetch_assoc($Query);
            ?>
            <div class="page d-flex">
                <div class="content-area w-full overflow-h">
                    <h1 class="PageName">Membership Plans</h1>
                    <div class="plans-page d-grid m-20 gap-20">
                    <?php foreach($Query as $Membership){ ?>
                        <a href="#">
                        <div class="plan bg-white rad-10 p-20 blue">
                            <div class="top mb-20 txt-center p-20">
                                <h2 class='m-0 c-white c-black'> <?php echo $Membership['Type'] ?> </h2>
                                <div class="price c-white">
                                    <span> $ </span> <?php echo $Membership['Price'] ?>
                                </div>
                            </div>
                        </div>
                        </a>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <?php
        }elseif($do == "AddUserRole"){ ?>
                <h1 class="PageHeader"> Add User Role </h1>
                        <div class="container">
                            <form class="form-horizontal" action="?action=InsertRole" method="POST">
                                <div class="form-group insertInput mb-0">
                                    <div class="m-auto">
                                        <input type="text" name="Name" class="form-control" placeholder="Role" autocomplete="off" required="required" />
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <div class="InsertButton">
                                        <input type="submit" value="Create" class="btn btn-primary btn-md w-10" />
                                        <a href="./Users.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                    </div>
                                </div>
                            </form>
                <?php
        }elseif($do == "InsertRole"){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $RoleName = $_POST['Name'];
            
                    $FormErrors = array();
            
                    if (empty($RoleName)) {
                        $FormErrors[] = "The Role Should Have a Name it Cannot be empty";
                    }
            
                    if(empty($FormErrors)){
                        $InsertQuery = "INSERT INTO `userrole` Values( Null , '$RoleName' )";
                        $Insert = mysqli_query($con, $InsertQuery);
                                header("Location: ./Users.php?action=Manage");
                                exit();
                                echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-success'> Role Added Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                                echo "</div>";
                    }else{
                        //LOOP into error array and print the error
                        foreach ($FormErrors as $error) {
                            $TheMsg = "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                        }
                        echo "<div class='container'>";
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                        }
                }
        }elseif($do == "AddMembership"){ ?>
            <h1 class="PageHeader"> Add Membership </h1>
                        <form class="form-horizontal" action="?action=InsertMembership" method="POST">
                            <div class="form-group insertInput mb-0">
                                <div class="m-auto">
                                    <input type="text" name="Name" class="form-control" placeholder="Membership Type" autocomplete="off" required="required" />
                                </div>
                            </div> 
                            <div class="form-group insertInput mb-0">
                                <div class="m-auto">
                                    <input type="number" name="Price" class="form-control" placeholder="Price" autocomplete="off" required="required" />
                                </div>
                            </div>   
                            <div class="form-group">
                                <div class="InsertButton">
                                    <input type="submit" value="Create" class="btn btn-primary btn-md w-10" />
                                    <a href="./Users.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                </div>
                            </div>
                        </form>
            <?php
        }elseif($do == "InsertMembership"){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $Membership = $_POST['Name'];
                $Price = $_POST['Price'];

                    $FormErrors = array();
            
                    if (empty($Membership)) {
                        $FormErrors[] = "The Role Should Have a Name it Cannot be empty";
                    }
                    if (empty($Price)) {
                        $FormErrors[] = "The Price Cannot be empty";
                    }


                    if(empty($FormErrors)){
                        $InsertQuery = "INSERT INTO `membership` Values( Null , '$Membership' , $Price )";
                        $Insert = mysqli_query($con, $InsertQuery);
                                header("Location: ./Users.php?action=Manage");
            
                                echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-success'> Membership Added Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                                echo "</div>";
                    }else{
                    //LOOP into error array and print the error
                    foreach ($FormErrors as $error) {
                        $TheMsg = "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                    }
                    echo "<div class='container'>";
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                    }
                }
        }else{
            echo "<div class='NoData'>";
                echo "The page does not exist";
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