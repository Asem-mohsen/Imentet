<?php
ob_start();

$PageTitle = "Users Platform ";

include './init.php';

session_start();
session_regenerate_id();

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
                $UserInfo = "SELECT user.* , userrole.RoleName AS UserRole, membership.Type AS MembershipType , membershippayemnts.MembershipID FROM user 
                            LEFT JOIN userrole ON userrole.ID = user.RoleID 
                            LEFT JOIN membershippayemnts ON user.ID = membershippayemnts.UserID
                            LEFT JOIN membership ON membership.ID = membershippayemnts.MembershipID
                            ORDER BY ID $sort";
                $Info = mysqli_query($con , $UserInfo);
                $fetchquery = mysqli_fetch_row($Info);
                $count =mysqli_num_rows($Info);
                if($count > 0 ){

                ?>
                <div class="page d-flex">
                        <div class=" w-280 sidepar bg-white p-20 p-relative">
                            <h3 class="p-relative txt-center mt-0">Control</h3>
                            <form method="post">
                                <ul>
                                    <?php if($AdminRole == 1 || $AdminRole == 2 ){ ?>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=AddUserRole">
                                                <i class="fa-solid fa-plus fa-fw"></i><span>Add User Roles</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=Subscribers">
                                                <i class="fa-regular fa-circle-check fa-fw"></i><span> Membership Subscribers </span>
                                            </a>
                                        </li>
                                    <?php } ?>
                                    <li>
                                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=CheckAllMembership">
                                            <i class="fa-solid fa-search fa-fw"></i><span> Membership </span>
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
                                        <p class='mt-20 ml-20 cursor-d fw-bold'>By Membership </p>
                                    </li>
                                        <?php
                                            
                                            $MembershipSelect = "SELECT * FROM membership";
                                            $Run = mysqli_query($con , $MembershipSelect);
                                            $row = mysqli_fetch_assoc($Run);

                                            foreach($Run as $Membership){ 
                                                $Checked = [];
                                                if(isset($_POST['Type'])){
                                                    $Checked = $_POST['Type'];
                                                }
                                                ?>
                                    <li>
                                        <input type="checkbox" name="Type[]" value="<?php echo $Membership['ID'] ?>" <?php if(in_array( $Membership['ID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                            <?php echo $Membership['Type'] ?>
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
                                                        <a href="./Users.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Asc </a> |
                                                        <a href="./Users.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Desc </a> ]
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                                <div class="container mb-20">
                                    <h1 class="PageName"> Users </h1>
                                    
                                    <div class="table-responsive">
                                        <table class="main-table table table-bordered table-hover table-light">
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
                                                if(isset($_POST['Type'])){
                                                    $TypeChecked = [];
                                                    $TypeChecked = $_POST['Type'];
                                                    foreach($TypeChecked as $rowTypes){
                                                        $UserInfo = "SELECT user.* , userrole.RoleName AS UserRole, membership.Type AS MembershipType , membershippayemnts.MembershipID FROM user 
                                                        LEFT JOIN userrole ON userrole.ID = user.RoleID 
                                                        LEFT JOIN membershippayemnts ON user.ID = membershippayemnts.UserID
                                                        LEFT JOIN membership ON membership.ID = membershippayemnts.MembershipID
                                                        WHERE membership.ID IN($rowTypes) ";
                                                        $Info = mysqli_query($con , $UserInfo);
                                                        $fetchquery = mysqli_fetch_row($Info);
                                                        $count =mysqli_num_rows($Info);
                                                        if($count > 0 ){

                                                            foreach ($Info as $User) {
                                                                
                                                                if($User['MembershipType'] == NULL){

                                                                    $User['MembershipType'] = "<p class='fs-13 c-gray'> Does not have a membership </p>";
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

                                                            $User['MembershipType'] = "<p class='fs-13 c-gray'> Does not have a membership </p>";
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
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                
            <?php }else{
                echo "<div class='NoData'>";
                    echo "No Current Data";
                echo "</div>";
            echo "</div>";
                }
        }elseif($do == "MoreInfo"){
                $UserID = filter_var($_GET['UserID'], FILTER_SANITIZE_NUMBER_INT); 
                if(empty($UserID)){
                    echo "<div class='NoData'>";
                        echo "<p>Sorry, We don't have Ghosts </p>";
                    echo "</div>";
                }else{
                $Users = "SELECT user.* , userrole.RoleName AS UserRole, membership.Type AS MembershipType , membershippayemnts.MembershipID 
                            FROM user 
                            LEFT JOIN membershippayemnts ON user.ID = membershippayemnts.UserID
                            LEFT JOIN userrole ON userrole.ID = user.RoleID 
                            LEFT JOIN membership ON membership.ID = membershippayemnts.MembershipID 
                            WHERE user.ID = $UserID LIMIT 1
                            ";
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

                $sort = 'ASC';
                $sortarray = array('ASC', 'DESC');
            
                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];                
                }
            $SelectMembership = "SELECT membership.* , membershipperiod.ID AS PeriodID ,  membershipperiod.Period AS PeriodTime  FROM membership
                                JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
                                ORDER BY membership.ID $sort
                                ";
            $Query = mysqli_query($con , $SelectMembership);
            $row = mysqli_fetch_assoc($Query);
            ?>
            <div class="page d-flex">
                <div class=" w-280 sidepar bg-white p-20 p-relative">
                    <h3 class="p-relative txt-center mt-0">Control</h3>
                    <form method="post">
                        <ul>
                            <?php if($AdminRole == 1 || $AdminRole == 2 ){ ?>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=AddMembership">
                                        <i class="fa-solid fa-plus fa-fw"></i><span> Add New Membership </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=Subscribers">
                                        <i class="fa-regular fa-circle-check fa-fw"></i><span> Membership Subscribers </span>
                                    </a>
                                </li>
                            <?php } ?>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=Manage">
                                    <i class="fa-solid fa-users fa-fw"></i><span> Users </span>
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
                                <p class='mt-20 ml-20 cursor-d fw-bold'>By Type </p>
                            </li>
                                <?php
                                    $MembershipSelect = "SELECT DISTINCT membership.* , membership.ID AS MembershipID FROM membership ";
                                    $Run = mysqli_query($con , $MembershipSelect);
                                    $row = mysqli_fetch_assoc($Run);

                                    foreach($Run as $MembershipType){ 
                                        $Checked = [];
                                        if(isset($_POST['MembershipID'])){
                                            $Checked = $_POST['MembershipID'];
                                        }
                                ?>
                            <li>
                                <input type="checkbox" name="MembershipID[]" value="<?php echo $MembershipType['MembershipID'] ?>" <?php if(in_array( $MembershipType['MembershipID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                    <?php echo $MembershipType['Type'] ; ?>
                            </li>
                                    <?php } 
                                ?>
                                
                            <li>
                                <p class='mt-20 ml-20 cursor-d fw-bold'>By Period </p>
                            </li>
                                    <?php
                                    $PeriodSelect = "SELECT DISTINCT membershipperiod.ID AS PeriodID, membershipperiod.Period AS Period FROM `membershipperiod` ";
                                    $Run = mysqli_query($con , $PeriodSelect);
                                    $row = mysqli_fetch_assoc($Run);

                                    foreach($Run as $Period){ 
                                        $Checked = [];
                                        if(isset($_POST['PeriodID'])){
                                            $Checked = $_POST['PeriodID'];
                                        }
                                        ?>
                            <li>
                                <input type="checkbox" name="PeriodID[]" value="<?php echo $Period['PeriodID'] ?>" <?php if(in_array( $Period['PeriodID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                    <?php echo $Period['Period'] ?>
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
                                                <a href="./Users.php?action=CheckAllMembership&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                echo 'active';
                                                                            } ?>"> Asc </a> |
                                                <a href="./Users.php?action=CheckAllMembership&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                echo 'active';
                                                                            } ?>"> Desc </a> ]
                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
            
                <div class="content-area w-full overflow-h">
                    <h1 class="PageName">Membership Plans</h1>
                    <div class="plans-page d-grid m-20 gap-20">
                        <?php 
                            if(isset($_POST['MembershipID']) && isset($_POST['PeriodID'])){
                                $sql = "WHERE membership.ID IN(".implode(',', $_POST['MembershipID'] ).") AND membership.PeriodID IN (".implode(',', $_POST['PeriodID']).")" ; 

                                $SelectMembership = "SELECT membership.* , membershipperiod.ID AS PeriodID ,  membershipperiod.Period AS PeriodTime  FROM membership
                                                    JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
                                                    $sql
                                                    ORDER BY membership.ID $sort
                                                    ";
                                $Query = mysqli_query($con , $SelectMembership);
                                $row = mysqli_fetch_assoc($Query);
                                $count =mysqli_num_rows($Query);

                                
                                if($count > 0 ){
                                    
                                    foreach($Query as $Membership){ ?>
                        
                                        <div class="plan bg-white rad-10 p-20 blue">
                                            <a href="#">
                                                <div class="top mb-20 txt-center p-20">
                                                    <h2 class='m-0 c-white c-black'> <?php echo $Membership['Type'] ?> </h2>
                                                    <div class="price c-white">
                                                        <?php if(isset($Membership['Price']) && $Membership['Price'] != 0 ){ echo $Membership['Price'] . " <span> $ </span>". "/" . $Membership['PeriodTime']  ;   } ?>
                                                    </div>
                                                </div>
                                            </a>
                                            <ul class="m-0">
                                                <li>
                                                    <i class="fa-solid fa-check fa-fw yes"></i>
                                                    <span>
                                                        <?php if($Membership['Entry'] == 0 ){ 
                                                                    echo " Unlimited Entry" ;
                                                            }else{
                                                                    echo "Free entry for ".$Membership['Entry'] . " times per Month" ;
                                                            } 
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                    <?php if($Membership['DiscountOnTours'] == 1 ){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Discounts on tours conducted by team hospitality" ;   
                                                            }elseif($Membership['DiscountOnTours'] == NULL || $Membership['DiscountOnTours'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Discounts on tours conducted by team hospitality" ;
                                                            }else{
                                                                echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                echo $Membership['DiscountOnTours'] . " Discounts on tours conducted by team hospitality" ;                                                       
                                                            } 
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                        <?php
                                                            if($Membership['AccessKidsArea'] == 1 ){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Free Access to Kids Area" ;   
                                                            }elseif($Membership['AccessKidsArea'] == NULL || $Membership['AccessKidsArea'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Free Access to Kids Area" ;
                                                            }
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['ChildernMuseum'] == 1 ){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Access To Childern Museum" ;   
                                                                }elseif($Membership['ChildernMuseum'] == NULL || $Membership['ChildernMuseum'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access To Childern Museum" ;
                                                                }else{
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo $Membership['ChildernMuseum'] . " Free Entries to Childern Museum " ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['VouchersMuseum'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Voucher For Museum Restaurant" ;   
                                                                }elseif($Membership['VouchersMuseum'] == NULL || $Membership['VouchersMuseum'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Free Voucher For Museum Restaurant" ;
                                                                }else{
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo $Membership['VouchersMuseum'] . " Free Vouchers For Museum Restaurans" ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['DiscountOnKidsClasses'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Discounts on Kid's Historical Classes & Activities" ;   
                                                                }elseif($Membership['DiscountOnKidsClasses'] == NULL || $Membership['DiscountOnKidsClasses'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Discounts on Kid's Historical Classes & Activities" ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['SubsMuseumLib'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                                                }elseif($Membership['SubsMuseumLib'] == NULL || $Membership['SubsMuseumLib'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessMuseumLib'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Access to The Grand Egyptian Museum Library" ; 
                                                                }elseif($Membership['AccessMuseumLib'] == NULL || $Membership['AccessMuseumLib'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access to The Grand Egyptian Museum Library" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['SpecialRecognition'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Special Recognition" ; 
                                                                }elseif($Membership['SpecialRecognition'] == NULL || $Membership['SpecialRecognition'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Special Recognition" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessToEvents'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Access to Exclusive Events" ; 
                                                                }elseif($Membership['AccessToEvents'] == NULL || $Membership['AccessToEvents'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access to Exclusive Events" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['FreeMuseumRest'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Access to All Offilcial Museum Restaurants" ; 
                                                                }elseif($Membership['FreeMuseumRest'] == NULL || $Membership['FreeMuseumRest'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Free Access to All Offilcial Museum Restaurants" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessTutankhamun'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to Tutankhamun Museum" ; 
                                                                }elseif($Membership['AccessTutankhamun'] == NULL || $Membership['AccessTutankhamun'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to Tutankhamun Museum" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessHologram'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to King Tut's Hologram" ;
                                                                }elseif($Membership['AccessHologram'] == NULL || $Membership['AccessHologram'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to King Tut's Hologram" ;
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessToMonuments'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to Exclusive Monuments in The Museum" ;
                                                                }elseif($Membership['AccessToMonuments'] == NULL || $Membership['AccessToMonuments'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to Exclusive Monuments in The Museum" ;
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                            </ul>
                                            <?php if($AdminRole == 1 || $AdminRole == 2){ ?>
                                                <a href="./Users.php?action=EditMembership&MembershipID=<?php echo $Membership['ID'] ?>" class="btn btn-success mt-20 w-100"> Edit </a>
                                            <?php }else{ ?>
                                                <button class="btn btn-success mt-20 w-100" disabled> Edit </button>
                                            <?php } ?>
                                        </div>
                                    <?php } 
                                }
                            }elseif(isset($_POST['MembershipID']) && !isset($_POST['PeriodID'])){
                                $sql = "WHERE membership.ID IN(".implode(',', $_POST['MembershipID']).")";

                                $SelectMembership = "SELECT membership.* , membershipperiod.ID AS PeriodID ,  membershipperiod.Period AS PeriodTime  FROM membership
                                                    JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
                                                    $sql
                                                    ORDER BY membership.ID $sort
                                                    ";
                                $Query = mysqli_query($con , $SelectMembership);
                                $row = mysqli_fetch_assoc($Query);
                                $count =mysqli_num_rows($Query);

                                
                                if($count > 0 ){
                                    
                                    foreach($Query as $Membership){ ?>
                        
                                        <div class="plan bg-white rad-10 p-20 blue">
                                            <a href="#">
                                                <div class="top mb-20 txt-center p-20">
                                                    <h2 class='m-0 c-white c-black'> <?php echo $Membership['Type'] ?> </h2>
                                                    <div class="price c-white">
                                                        <?php if(isset($Membership['Price']) && $Membership['Price'] != 0 ){ echo $Membership['Price'] . " <span> $ </span>". "/" . $Membership['PeriodTime']  ;   } ?>
                                                    </div>
                                                </div>
                                            </a>
                                            <ul class="m-0">
                                                <li>
                                                    <i class="fa-solid fa-check fa-fw yes"></i>
                                                    <span>
                                                        <?php if($Membership['Entry'] == 0 ){ 
                                                                    echo " Unlimited Entry" ;
                                                            }else{
                                                                    echo "Free entry for ".$Membership['Entry'] . " times per Month" ;
                                                            } 
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                    <?php if($Membership['DiscountOnTours'] == 1 ){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Discounts on tours conducted by team hospitality" ;   
                                                            }elseif($Membership['DiscountOnTours'] == NULL || $Membership['DiscountOnTours'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Discounts on tours conducted by team hospitality" ;
                                                            }else{
                                                                echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                echo $Membership['DiscountOnTours'] . " Discounts on tours conducted by team hospitality" ;                                                       
                                                            } 
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                        <?php
                                                            if($Membership['AccessKidsArea'] == 1 ){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Free Access to Kids Area" ;   
                                                            }elseif($Membership['AccessKidsArea'] == NULL || $Membership['AccessKidsArea'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Free Access to Kids Area" ;
                                                            }
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['ChildernMuseum'] == 1 ){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Access To Childern Museum" ;   
                                                                }elseif($Membership['ChildernMuseum'] == NULL || $Membership['ChildernMuseum'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access To Childern Museum" ;
                                                                }else{
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo $Membership['ChildernMuseum'] . " Free Entries to Childern Museum " ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['VouchersMuseum'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Voucher For Museum Restaurant" ;   
                                                                }elseif($Membership['VouchersMuseum'] == NULL || $Membership['VouchersMuseum'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Free Voucher For Museum Restaurant" ;
                                                                }else{
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo $Membership['VouchersMuseum'] . " Free Vouchers For Museum Restaurans" ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['DiscountOnKidsClasses'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Discounts on Kid's Historical Classes & Activities" ;   
                                                                }elseif($Membership['DiscountOnKidsClasses'] == NULL || $Membership['DiscountOnKidsClasses'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Discounts on Kid's Historical Classes & Activities" ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['SubsMuseumLib'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                                                }elseif($Membership['SubsMuseumLib'] == NULL || $Membership['SubsMuseumLib'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessMuseumLib'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Access to The Grand Egyptian Museum Library" ; 
                                                                }elseif($Membership['AccessMuseumLib'] == NULL || $Membership['AccessMuseumLib'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access to The Grand Egyptian Museum Library" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['SpecialRecognition'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Special Recognition" ; 
                                                                }elseif($Membership['SpecialRecognition'] == NULL || $Membership['SpecialRecognition'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Special Recognition" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessToEvents'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Access to Exclusive Events" ; 
                                                                }elseif($Membership['AccessToEvents'] == NULL || $Membership['AccessToEvents'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access to Exclusive Events" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['FreeMuseumRest'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Access to All Offilcial Museum Restaurants" ; 
                                                                }elseif($Membership['FreeMuseumRest'] == NULL || $Membership['FreeMuseumRest'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Free Access to All Offilcial Museum Restaurants" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessTutankhamun'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to Tutankhamun Museum" ; 
                                                                }elseif($Membership['AccessTutankhamun'] == NULL || $Membership['AccessTutankhamun'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to Tutankhamun Museum" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessHologram'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to King Tut's Hologram" ;
                                                                }elseif($Membership['AccessHologram'] == NULL || $Membership['AccessHologram'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to King Tut's Hologram" ;
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessToMonuments'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to Exclusive Monuments in The Museum" ;
                                                                }elseif($Membership['AccessToMonuments'] == NULL || $Membership['AccessToMonuments'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to Exclusive Monuments in The Museum" ;
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                            </ul>
                                            <?php if($AdminRole == 1 || $AdminRole == 2){ ?>
                                                <a href="./Users.php?action=EditMembership&MembershipID=<?php echo $Membership['ID'] ?>" class="btn btn-success mt-20 w-100"> Edit </a>
                                            <?php }else{ ?>
                                                <button class="btn btn-success mt-20 w-100" disabled> Edit </button>
                                            <?php } ?>
                                        </div>
                                    <?php } 
                                }
                            }elseif(isset($_POST['PeriodID']) && !isset($_POST['MembershipID'])){
                                $sql = "WHERE membership.PeriodID IN(". implode(',', $_POST['PeriodID']).")";
                                $SelectMembership = "SELECT membership.* , membershipperiod.ID AS PeriodID ,  membershipperiod.Period AS PeriodTime  FROM membership
                                                    JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
                                                    $sql
                                                    ORDER BY membership.ID $sort
                                                    ";
                                $Query = mysqli_query($con , $SelectMembership);
                                $row = mysqli_fetch_assoc($Query);
                                $count =mysqli_num_rows($Query);
                                
                                if($count > 0 ){
                                    
                                    foreach($Query as $Membership){ ?>
                        
                                        <div class="plan bg-white rad-10 p-20 blue">
                                            <a href="#">
                                                <div class="top mb-20 txt-center p-20">
                                                    <h2 class='m-0 c-white c-black'> <?php echo $Membership['Type'] ?> </h2>
                                                    <div class="price c-white">
                                                        <?php if(isset($Membership['Price']) && $Membership['Price'] != 0 ){ echo $Membership['Price'] . " <span> $ </span>". "/" . $Membership['PeriodTime']  ;   } ?>
                                                    </div>
                                                </div>
                                            </a>
                                            <ul class="m-0">
                                                <li>
                                                    <i class="fa-solid fa-check fa-fw yes"></i>
                                                    <span>
                                                        <?php if($Membership['Entry'] == 0 ){ 
                                                                    echo " Unlimited Entry" ;
                                                            }else{
                                                                    echo "Free entry for ".$Membership['Entry'] . " times per Month" ;
                                                            } 
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                    <?php if($Membership['DiscountOnTours'] == 1 ){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Discounts on tours conducted by team hospitality" ;   
                                                            }elseif($Membership['DiscountOnTours'] == NULL || $Membership['DiscountOnTours'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Discounts on tours conducted by team hospitality" ;
                                                            }else{
                                                                echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                echo $Membership['DiscountOnTours'] . " Discounts on tours conducted by team hospitality" ;                                                       
                                                            } 
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                        <?php
                                                            if($Membership['AccessKidsArea'] == 1 ){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Free Access to Kids Area" ;   
                                                            }elseif($Membership['AccessKidsArea'] == NULL || $Membership['AccessKidsArea'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Free Access to Kids Area" ;
                                                            }
                                                        ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['ChildernMuseum'] == 1 ){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Access To Childern Museum" ;   
                                                                }elseif($Membership['ChildernMuseum'] == NULL || $Membership['ChildernMuseum'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access To Childern Museum" ;
                                                                }else{
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo $Membership['ChildernMuseum'] . " Free Entries to Childern Museum " ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['VouchersMuseum'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Voucher For Museum Restaurant" ;   
                                                                }elseif($Membership['VouchersMuseum'] == NULL || $Membership['VouchersMuseum'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Free Voucher For Museum Restaurant" ;
                                                                }else{
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo $Membership['VouchersMuseum'] . " Free Vouchers For Museum Restaurans" ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['DiscountOnKidsClasses'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Discounts on Kid's Historical Classes & Activities" ;   
                                                                }elseif($Membership['DiscountOnKidsClasses'] == NULL || $Membership['DiscountOnKidsClasses'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Discounts on Kid's Historical Classes & Activities" ;
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['SubsMuseumLib'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                                                }elseif($Membership['SubsMuseumLib'] == NULL || $Membership['SubsMuseumLib'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessMuseumLib'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Access to The Grand Egyptian Museum Library" ; 
                                                                }elseif($Membership['AccessMuseumLib'] == NULL || $Membership['AccessMuseumLib'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access to The Grand Egyptian Museum Library" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['SpecialRecognition'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Special Recognition" ; 
                                                                }elseif($Membership['SpecialRecognition'] == NULL || $Membership['SpecialRecognition'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Special Recognition" ; 
                                                                }
                                                            ?>
                                                    </span>
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessToEvents'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Access to Exclusive Events" ; 
                                                                }elseif($Membership['AccessToEvents'] == NULL || $Membership['AccessToEvents'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Access to Exclusive Events" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['FreeMuseumRest'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "Free Access to All Offilcial Museum Restaurants" ; 
                                                                }elseif($Membership['FreeMuseumRest'] == NULL || $Membership['FreeMuseumRest'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "Free Access to All Offilcial Museum Restaurants" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessTutankhamun'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to Tutankhamun Museum" ; 
                                                                }elseif($Membership['AccessTutankhamun'] == NULL || $Membership['AccessTutankhamun'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to Tutankhamun Museum" ; 
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessHologram'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to King Tut's Hologram" ;
                                                                }elseif($Membership['AccessHologram'] == NULL || $Membership['AccessHologram'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to King Tut's Hologram" ;
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                                <li>
                                                    <span>
                                                            <?php
                                                                if($Membership['AccessToMonuments'] == 1){ 
                                                                        echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                        echo "FREE Access to Exclusive Monuments in The Museum" ;
                                                                }elseif($Membership['AccessToMonuments'] == NULL || $Membership['AccessToMonuments'] == 0){
                                                                        echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                        echo "FREE Access to Exclusive Monuments in The Museum" ;
                                                                }
                                                            ?>
                                                    </span>                                       
                                                    <i class="fa-solid fa-circle-info help"></i>
                                                </li>
                                            </ul>
                                            <?php if($AdminRole == 1 || $AdminRole == 2){ ?>
                                                <a href="./Users.php?action=EditMembership&MembershipID=<?php echo $Membership['ID'] ?>" class="btn btn-success mt-20 w-100"> Edit </a>
                                            <?php }else{ ?>
                                                <button class="btn btn-success mt-20 w-100" disabled> Edit </button>
                                            <?php } ?>
                                        </div>
                                    <?php }  
                                }
                            }else{
                                $SelectMembership = "SELECT membership.* , membershipperiod.ID AS PeriodID ,  membershipperiod.Period AS PeriodTime  FROM membership
                                                    JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
                                                    ORDER BY membership.ID $sort
                                                    ";
                                $Query = mysqli_query($con , $SelectMembership);
                                $row = mysqli_fetch_assoc($Query);
                                
                                foreach($Query as $Membership){ ?>
                        
                                    <div class="plan bg-white rad-10 p-20 blue">
                                        <a href="#">
                                            <div class="top mb-20 txt-center p-20">
                                                <h2 class='m-0 c-white c-black'> <?php echo $Membership['Type'] ?> </h2>
                                                <div class="price c-white">
                                                    <?php if(isset($Membership['Price']) && $Membership['Price'] != 0 ){ echo $Membership['Price'] . " <span> $ </span>". "/" . $Membership['PeriodTime']  ;   } ?>
                                                </div>
                                            </div>
                                        </a>
                                        <ul class="m-0">
                                            <li>
                                                <i class="fa-solid fa-check fa-fw yes"></i>
                                                <span>
                                                    <?php if($Membership['Entry'] == 0 ){ 
                                                                echo " Unlimited Entry" ;
                                                        }else{
                                                                echo "Free entry for ".$Membership['Entry'] . " times per Month" ;
                                                        } 
                                                    ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                <?php if($Membership['DiscountOnTours'] == 1 ){ 
                                                                echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                echo "Discounts on tours conducted by team hospitality" ;   
                                                        }elseif($Membership['DiscountOnTours'] == NULL || $Membership['DiscountOnTours'] == 0){
                                                                echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                echo "Discounts on tours conducted by team hospitality" ;
                                                        }else{
                                                            echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                            echo $Membership['DiscountOnTours'] . " Discounts on tours conducted by team hospitality" ;                                                       
                                                        } 
                                                    ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                    <?php
                                                        if($Membership['AccessKidsArea'] == 1 ){ 
                                                                echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                echo "Free Access to Kids Area" ;   
                                                        }elseif($Membership['AccessKidsArea'] == NULL || $Membership['AccessKidsArea'] == 0){
                                                                echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                echo "Free Access to Kids Area" ;
                                                        }
                                                    ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['ChildernMuseum'] == 1 ){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Free Access To Childern Museum" ;   
                                                            }elseif($Membership['ChildernMuseum'] == NULL || $Membership['ChildernMuseum'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Access To Childern Museum" ;
                                                            }else{
                                                                echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                echo $Membership['ChildernMuseum'] . " Free Entries to Childern Museum " ;
                                                            }
                                                        ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['VouchersMuseum'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Free Voucher For Museum Restaurant" ;   
                                                            }elseif($Membership['VouchersMuseum'] == NULL || $Membership['VouchersMuseum'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Free Voucher For Museum Restaurant" ;
                                                            }else{
                                                                echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                echo $Membership['VouchersMuseum'] . " Free Vouchers For Museum Restaurans" ;
                                                            }
                                                        ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['DiscountOnKidsClasses'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Discounts on Kid's Historical Classes & Activities" ;   
                                                            }elseif($Membership['DiscountOnKidsClasses'] == NULL || $Membership['DiscountOnKidsClasses'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Discounts on Kid's Historical Classes & Activities" ;
                                                            }
                                                        ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['SubsMuseumLib'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                                            }elseif($Membership['SubsMuseumLib'] == NULL || $Membership['SubsMuseumLib'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "A Year of Subscription to the Grand Egyptian Museum Library" ; 
                                                            }
                                                        ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['AccessMuseumLib'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Access to The Grand Egyptian Museum Library" ; 
                                                            }elseif($Membership['AccessMuseumLib'] == NULL || $Membership['AccessMuseumLib'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Access to The Grand Egyptian Museum Library" ; 
                                                            }
                                                        ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['SpecialRecognition'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Special Recognition" ; 
                                                            }elseif($Membership['SpecialRecognition'] == NULL || $Membership['SpecialRecognition'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Special Recognition" ; 
                                                            }
                                                        ?>
                                                </span>
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['AccessToEvents'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Access to Exclusive Events" ; 
                                                            }elseif($Membership['AccessToEvents'] == NULL || $Membership['AccessToEvents'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Access to Exclusive Events" ; 
                                                            }
                                                        ?>
                                                </span>                                       
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['FreeMuseumRest'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "Free Access to All Offilcial Museum Restaurants" ; 
                                                            }elseif($Membership['FreeMuseumRest'] == NULL || $Membership['FreeMuseumRest'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "Free Access to All Offilcial Museum Restaurants" ; 
                                                            }
                                                        ?>
                                                </span>                                       
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['AccessTutankhamun'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "FREE Access to Tutankhamun Museum" ; 
                                                            }elseif($Membership['AccessTutankhamun'] == NULL || $Membership['AccessTutankhamun'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "FREE Access to Tutankhamun Museum" ; 
                                                            }
                                                        ?>
                                                </span>                                       
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['AccessHologram'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "FREE Access to King Tut's Hologram" ;
                                                            }elseif($Membership['AccessHologram'] == NULL || $Membership['AccessHologram'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "FREE Access to King Tut's Hologram" ;
                                                            }
                                                        ?>
                                                </span>                                       
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                            <li>
                                                <span>
                                                        <?php
                                                            if($Membership['AccessToMonuments'] == 1){ 
                                                                    echo "<i class='fa-solid fa-check fa-fw yes'></i>";
                                                                    echo "FREE Access to Exclusive Monuments in The Museum" ;
                                                            }elseif($Membership['AccessToMonuments'] == NULL || $Membership['AccessToMonuments'] == 0){
                                                                    echo "<i class='fa-solid fa-xmark fa-fw no'></i>";
                                                                    echo "FREE Access to Exclusive Monuments in The Museum" ;
                                                            }
                                                        ?>
                                                </span>                                       
                                                <i class="fa-solid fa-circle-info help"></i>
                                            </li>
                                        </ul>
                                        <?php if($AdminRole == 1 || $AdminRole == 2){ ?>
                                            <a href="./Users.php?action=EditMembership&MembershipID=<?php echo $Membership['ID'] ?>" class="btn btn-success mt-20 w-100"> Edit </a>
                                        <?php }else{ ?>
                                            <button class="btn btn-success mt-20 w-100" disabled> Edit </button>
                                        <?php } ?>
                                    </div>
                                <?php } 
                                
                            } ?>
                    
                    </div>
                </div>
            </div>
            <?php
        }elseif($do == "Subscribers"){
            $sort = 'ASC';
            $sortarray = array('ASC', 'DESC');
    
            if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                $sort = $_GET['sort'];
            }
            $MembershipInfo = "SELECT membershippayemnts.* , user.Name AS UserName , membership.Type AS MembershipType , paymentoptions.PaymentType AS PaymentType , membershipperiod.Period FROM membershippayemnts 
                        LEFT JOIN user ON membershippayemnts.UserID = user.ID
                        LEFT JOIN membership ON membership.ID = membershippayemnts.MembershipID
                        LEFT JOIN paymentoptions ON membershippayemnts.PaymentID = paymentoptions.ID
                        LEFT JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID
                        ORDER BY ID $sort";
            $Info = mysqli_query($con , $MembershipInfo);
            $fetchquery = mysqli_fetch_row($Info);
            $count =mysqli_num_rows($Info);
            if($count > 0 ){
                if($AdminRole != 1 && $AdminRole != 2){
                    echo "<div class='NoData'>";
                        echo "<p>Again ! You are Not allowed to see this Page </p>";
                    echo "</div>";
                }else{ 
            ?>
            <div class="page d-flex">
                    <div class=" w-280 sidepar bg-white p-20 p-relative">
                        <h3 class="p-relative txt-center mt-0">Control</h3>
                        <form method="post">
                            <ul>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=CheckAllMembership">
                                        <i class="fa-solid fa-search fa-fw"></i><span> Membership </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=Manage">
                                        <i class="fa-solid fa-users fa-fw"></i><span> Users </span>
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
                                    <p class='mt-20 ml-20 cursor-d fw-bold'>By Membership </p>
                                </li>
                                    <?php
                                        
                                        $MembershipSelect = "SELECT * FROM membership";
                                        $Run = mysqli_query($con , $MembershipSelect);
                                        $row = mysqli_fetch_assoc($Run);

                                        foreach($Run as $Membership){ 
                                            $Checked = [];
                                            if(isset($_POST['Type'])){
                                                $Checked = $_POST['Type'];
                                            }
                                            ?>
                                <li>
                                    <input type="checkbox" name="Type[]" value="<?php echo $Membership['ID'] ?>" <?php if(in_array( $Membership['ID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                        <?php echo $Membership['Type'] ?>
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
                                                    <a href="./Users.php?action=Subscribers&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                    echo 'active';
                                                                                } ?>"> Asc </a> |
                                                    <a href="./Users.php?action=Subscribers&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                    echo 'active';
                                                                                } ?>"> Desc </a> ]
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                            <div class="container mb-20">
                                <h1 class="PageName"> Users </h1>
                                
                                <div class="table-responsive">
                                    <table class="main-table table table-bordered table-hover table-light">
                                        <tr>
                                            <td>ID</td>
                                            <td>Name</td>
                                            <td>Membership</td>
                                            <td>Cost</td>
                                            <td>Payment</td>
                                            <td>Start Date</td>
                                            <td>Period</td>
                                            <td>End Date</td>

                                        </tr>
                                        <?php
                                            if(isset($_POST['Type'])){
                                                    $sql = " WHERE membershippayemnts.MembershipID IN(".implode(',', $_POST['Type'] ).")"; 
                                                    $MembershipInfo = "SELECT membershippayemnts.* , user.Name AS UserName , user.ID AS UserID, membership.Price AS Price  , membership.Type AS MembershipType , paymentoptions.PaymentType AS PaymentType , membershipperiod.Period FROM membershippayemnts 
                                                                        LEFT JOIN user ON membershippayemnts.UserID = user.ID
                                                                        LEFT JOIN membership ON membership.ID = membershippayemnts.MembershipID
                                                                        LEFT JOIN paymentoptions ON membershippayemnts.PaymentID = paymentoptions.ID
                                                                        LEFT JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID
                                                                        $sql
                                                                        ORDER BY membershippayemnts.ID $sort
                                                                        ";
                                                    $Info = mysqli_query($con , $MembershipInfo);
                                                    $fetchquery = mysqli_fetch_row($Info);
                                                    $count =mysqli_num_rows($Info);
                                                    if($count > 0 ){

                                                        foreach ($Info as $MembershipUsers) {
                                                            
                                                            if($MembershipUsers['MembershipType'] == NULL){

                                                                $MembershipUsers['MembershipType'] = "<p class='fs-13 c-gray'> Does not have a membership </p>";
                                                            }
                                                            echo "<tr>";
                                                            echo "<td>" . $MembershipUsers['ID']     . "</td>";
                                                            echo "<td> <a href='./Users.php?action=MoreInfo&UserID=" . $MembershipUsers['UserID'] . "'>" . $MembershipUsers['UserName']   . "</a></td>";
                                                            echo "<td>" . $MembershipUsers['MembershipType'] . "</td>";
                                                                                                                    
                                                            echo "<td>" . $MembershipUsers['Price']     . "</td>";
                                                            echo "<td>" . $MembershipUsers['PaymentType']     . "</td>";
                                                            echo "<td>" . $MembershipUsers['Date']     . "</td>";
                                                            echo "<td>" . $MembershipUsers['Period']     . "</td>";
                                                            echo "<td>" . $MembershipUsers['EndsIn']     . "</td>";

                                                            echo "</tr>";
                                                        } 
                                                    }
                                            }else{
                                                    $MembershipInfo = "SELECT membershippayemnts.* , user.Name AS UserName,  user.ID AS UserID , membership.Type AS MembershipType, membership.Price AS Price , paymentoptions.PaymentType AS PaymentType , membershipperiod.Period FROM membershippayemnts 
                                                                        LEFT JOIN user ON membershippayemnts.UserID = user.ID
                                                                        LEFT JOIN membership ON membership.ID = membershippayemnts.MembershipID
                                                                        LEFT JOIN paymentoptions ON membershippayemnts.PaymentID = paymentoptions.ID
                                                                        LEFT JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID
                                                                        ORDER BY membershippayemnts.ID $sort
                                                                        ";
                                                    $Info = mysqli_query($con , $MembershipInfo);
                                                    $fetchquery = mysqli_fetch_row($Info);
                                                    $count =mysqli_num_rows($Info);
                                                    if($count > 0 ){

                                                        foreach ($Info as $MembershipUsers) {
                                                            
                                                            if($MembershipUsers['MembershipType'] == NULL){

                                                                $MembershipUsers['MembershipType'] = "<p class='fs-13 c-gray'> Does not have a membership </p>";
                                                            }
                                                            echo "<tr>";
                                                                echo "<td>" . $MembershipUsers['ID']     . "</td>";
                                                                echo "<td> <a href='./Users.php?action=MoreInfo&UserID=" . $MembershipUsers['UserID'] . "'>" . $MembershipUsers['UserName']   . "</a></td>";
                                                                echo "<td>" . $MembershipUsers['MembershipType'] . "</td>";
                                                                                                                        
                                                                echo "<td>" . $MembershipUsers['Price']     . "</td>";
                                                                echo "<td>" . $MembershipUsers['PaymentType']     . "</td>";
                                                                echo "<td>" . $MembershipUsers['Date']     . "</td>";
                                                                echo "<td>" . $MembershipUsers['Period']     . "</td>";
                                                                echo "<td>" . $MembershipUsers['EndsIn']     . "</td>";
                                                            echo "</tr>";
                                                        } 
                                                    }
                                            }
                                        ?>
                                    </table>
                                </div>
                            </div>
                    
            <?php }
            }else{
                echo "<div class='NoData'>";
                    echo "No Current Data";
                echo "</div>";
            echo "</div>";
                }
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
        }elseif($do == "AddMembership"){ 
            if($AdminRole != 1 && $AdminRole != 2){
                echo "<div class='NoData'>";
                    echo "<p>Again ! You are not allowd to Add Membership </p>";
                echo "</div>";
            }else{ ?>
                    <h1 class="PageHeader"> Add Membership </h1>
                        <form class="form-horizontal" action="?action=InsertMembership" method="POST">
                            <div class="form-group insertInput mb-0">
                                <div class="m-auto">
                                    <input type="text" name="Name" class="form-control" placeholder="Membership Type" autocomplete="off" required="required" />
                                </div>
                            </div> 
                            <div class="form-group insertInput mb-0">
                                <div class="mb-20">
                                    <select name="Period" class="custom-select">
                                        <option value="0"> Select Period </option>
                                        <?php
                                        $SelectQuery = "SELECT * FROM membershipperiod ";
                                        $Select = mysqli_query($con, $SelectQuery);
                                        $fetchquery = mysqli_fetch_assoc($Select);
                                        foreach ($Select as $Period) {
                                            echo "<option value='" . $Period['ID'] . "' >" . $Period['Period'] . " </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group insertInput mb-0">
                                <div class="m-auto">
                                    <input type="number" name="FreeEntry" class="form-control" placeholder="Free Entry" autocomplete="off" required="required" />
                                </div>
                            </div> 
                            <div class="form-group insertInput mb-0">
                                <div class="mb-0">
                                    <input type="number" name="Price" class="form-control" placeholder="Price" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group insertInput mb-0">
                                <div class="mt-20">
                                    <input type="number" name="ChildernMuseum" class="form-control" placeholder="Access to Childern Museum" autocomplete="off" />
                                </div>
                            </div> 
                            <div class="form-group insertInput mb-0">
                                <div class="mt-20">
                                    <input type="number" name="VouchersMuseum" class="form-control" placeholder="Vouchers For Museum Restaurants" autocomplete="off"  />
                                </div>
                            </div> 
                            <div class="form-group CheckBoxesPanel">

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Discount On Tours</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="DiscountOnTours" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access to Kids Area</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessKidsArea" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>
                                    
                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span>Discount On Kids Classes</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="DiscountOnKidsClasses" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Subscription to Museum Library</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="SubsMuseumLib" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access Museum Library</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name='AccessMuseumLib' class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Special Recognition</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="SpecialRecognition" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access To All Events	</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessToEvents" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Free Access To Museum Restaurants</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="FreeMuseumRest" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access To Tutankhamun Museum</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessTutankhamun" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span>Access Tutankhamun Hologram</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessHologram" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access To Exclusive Monuments</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessToMonuments" class="toggle-checkbox" value="1" />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="InsertButton">
                                    <input type="submit" value="Create" class="btn btn-primary btn-md w-10" />
                                    <a href="./Users.php?action=CheckAllMembership" class="btn btn-danger btn-md w-10"> Cancel </a>
                                </div>
                            </div>
                        </form>
                    <?php
            }
        }elseif($do == "InsertMembership"){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $Membership = $_POST['Name'];
                $Price = $_POST['Price'];
                $Period = $_POST['Period'];
                $FreeEntry = $_POST['FreeEntry'];
                $ChildernMuseum = $_POST['ChildernMuseum'];
                
                    $FormErrors = array();
            
                    if (empty($Membership)) {
                        $FormErrors[] = "The Role Should Have a Name it Cannot be empty";
                    }
                    if (empty($Price) || $Price == 0 ) {
                        $Price = NULL ;
                    }
                    if ($Period == 0 ) {
                        $FormErrors[] = "You Must Select a Period For The Membership";
                    }
                    if($FreeEntry > 8){
                        $FormErrors[] = "Too Much Entries For The Museum it Must be less than 8";
                    }
                    if($ChildernMuseum > 8){
                        $FormErrors[] = "Too Much Entries For The Childern Museum it Must be less than 8";
                    }

                    if(!isset($_POST['FreeEntry'])){
                        $FreeEntry = NULL ;
                    }else{
                        $FreeEntry = $_POST['FreeEntry'];
                    }
                    if(!isset($_POST['DiscountOnTours'])){
                        $DiscountOnTours = NULL ;
                    }else{
                        $DiscountOnTours = $_POST['DiscountOnTours'];
                    }
                    if(!isset($_POST['ChildernMuseum'])){
                        $ChildernMuseum = NULL ;
                    }else{
                        $ChildernMuseum = $_POST['ChildernMuseum'];
                    }
                    if(!isset($_POST['VouchersMuseum'])){
                        $VouchersMuseum = NULL ;
                    }else{
                        $VouchersMuseum = $_POST['VouchersMuseum'];
                        if($VouchersMuseum > 10){
                            $FormErrors[] = "Too Much Vouchers For The Restaurants it Must be less than 10";
                        }
                    }
                    if(!isset($_POST['AccessKidsArea'])){
                        $AccessKidsArea = NULL ;
                    }else{
                        $AccessKidsArea = $_POST['AccessKidsArea'];
                    }
                    if(!isset($_POST['DiscountOnKidsClasses'])){
                        $DiscountOnKidsClasses = NULL ;
                    }else{
                        $DiscountOnKidsClasses = $_POST['DiscountOnKidsClasses'];
                    }
                    if(!isset($_POST['SubsMuseumLib'])){
                        $SubsMuseumLib = NULL ;
                    }else{
                        $SubsMuseumLib = $_POST['SubsMuseumLib'];
                    }
                    if(!isset($_POST['AccessMuseumLib'])){
                        $AccessMuseumLib = NULL ;
                    }else{
                        $AccessMuseumLib = $_POST['AccessMuseumLib'];
                    }
                    if(!isset($_POST['SpecialRecognition'])){
                        $SpecialRecognition = NULL ;
                    }else{
                        $SpecialRecognition = $_POST['SpecialRecognition'];
                    }
                    if(!isset($_POST['AccessToEvents'])){
                        $AccessToEvents = NULL ;
                    }else{
                        $AccessToEvents = $_POST['AccessToEvents'];
                    }
                    if(!isset($_POST['FreeMuseumRest'])){
                        $FreeMuseumRest = NULL ;
                    }else{
                        $FreeMuseumRest = $_POST['FreeMuseumRest'];
                    }
                    if(!isset($_POST['AccessTutankhamun'])){
                        $AccessTutankhamun = NULL ;
                    }else{
                        $AccessTutankhamun = $_POST['AccessTutankhamun'];
                    }
                    if(!isset($_POST['AccessHologram'])){
                        $AccessHologram = NULL ;
                    }else{
                        $AccessHologram = $_POST['AccessHologram'];
                    }
                    if(!isset($_POST['AccessToMonuments'])){
                        $AccessToMonuments = NULL ;
                    }else{
                        $AccessToMonuments = $_POST['AccessToMonuments'];
                    }

                    if(empty($FormErrors)){
                        $InsertQuery = "INSERT INTO `membership` Values(Null , '$Membership' , '$Price' , $Period , '$FreeEntry' , '$DiscountOnTours' , '$AccessKidsArea', '$ChildernMuseum' , '$VouchersMuseum' , '$DiscountOnKidsClasses' ,'$SubsMuseumLib'  , '$AccessMuseumLib' , '$SpecialRecognition', '$AccessToEvents', '$FreeMuseumRest', '$AccessTutankhamun', '$AccessHologram', '$AccessToMonuments'  )";
                        $Insert = mysqli_query($con, $InsertQuery);
                                header("Location: ./Users.php?action=CheckAllMembership");
            
                                echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-success txt-center'> Membership Added Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                                echo "</div>";
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                                RedirectIndex($TheMsg, "Back");
                            echo "</div>";
                        }
                    }
                }
        }elseif($do == "EditMembership"){ 
            $MembershipID = isset($_GET['MembershipID']) && is_numeric($_GET['MembershipID']) ? intval($_GET['MembershipID']) : 0;

            if(empty($MembershipID)){
                echo "<div class='NoData'>";
                    echo "<p>Where is The Membership to Edit !</p>";
                echo "</div>";
            }elseif($AdminRole != 1 && $AdminRole != 2){
                echo "<div class='NoData'>";
                    echo "<p>Again ! You are not allowd to Edit Anything </p>";
                echo "</div>";
            }else{
                $SelectMembership = "SELECT membership.* , membershipperiod.ID AS PeriodID ,  membershipperiod.Period AS PeriodTime  FROM membership
                                    JOIN membershipperiod ON membership.PeriodID = membershipperiod.ID 
                                    WHERE membership.ID = $MembershipID ";
                $Query = mysqli_query($con , $SelectMembership);
                $row = mysqli_fetch_assoc($Query);
                $count = mysqli_num_rows($Query);
                if(isset($row['ID'])){
                
                    ?>
                    <h1 class="PageHeader"> Edit Membership </h1>
                        <form class="form-horizontal" action="?action=UpdateMembership" method="POST">
                            <input type="hidden" name="MembershipID" value="<?php echo $MembershipID ?>">
                            <div class="form-group insertInput mb-0">
                            <label class="mt-20 control-label">Name</label>
                                <div class="m-auto">
                                    <input type="text" name="Name" class="form-control" value="<?php echo $row['Type'] ?>" autocomplete="off" required="required" />
                                </div>
                            </div> 
                            <div class="form-group insertInput mb-0">
                                <label class="control-label">Period</label>
                                <div class="m-auto">
                                    <select name="Period" class="custom-select">
                                        <option value="<?php echo $row['PeriodID'] ?>"> <?php echo $row['PeriodTime'] ?> </option>
                                        <?php
                                        $SelectQuery = "SELECT * FROM membershipperiod ";
                                        $Select = mysqli_query($con, $SelectQuery);
                                        $fetchquery = mysqli_fetch_assoc($Select);
                                        foreach ($Select as $Period) {
                                            echo "<option value='" . $Period['ID'] . "' >" . $Period['Period'] . " </option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group insertInput mb-0">
                            <label class="mt-20 control-label">Free Entry</label>
                                <div class="m-auto">
                                    <input type="number" name="FreeEntry" class="form-control"  value="<?php echo $row['Entry'] ?>"  required="required" />
                                </div>
                            </div> 
                            <div class="form-group insertInput mb-0">
                            <label class="control-label">Price</label>
                                <div class="m-auto">
                                    <input type="number" name="Price" class="form-control" value="<?php echo $row['Price'] ?>" placeholder="Price" autocomplete="off" />
                                </div>
                            </div>
                            <div class="form-group insertInput mb-0">
                            <label class="mt-20 control-label">Free Entry to Childern Museum</label>
                                <div class="m-auto">
                                    <input type="number" name="ChildernMuseum" class="form-control" value="<?php echo $row['ChildernMuseum'] ?>" placeholder="Access to Childern Museum" autocomplete="off" />
                                </div>
                            </div> 
                            <div class="form-group insertInput mb-0">
                            <label class="mt-20 control-label">Free Vouchers To Museum's Restaurants</label>
                                <div class="m-auto">
                                    <input type="number" name="VouchersMuseum" class="form-control"  value="<?php echo $row['VouchersMuseum'] ?>" placeholder="Vouchers For Museum Restaurants" autocomplete="off"  />
                                </div>
                            </div> 
                            <div class="form-group CheckBoxesPanel">

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Discount On Tours</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="DiscountOnTours" class="toggle-checkbox" value="1" <?php if(isset($row['DiscountOnTours'])&& $row['DiscountOnTours'] != 0 ){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access to Kids Area</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessKidsArea" class="toggle-checkbox" value="1" <?php if(isset($row['AccessKidsArea']) && $row['AccessKidsArea'] != 0){echo "Checked";} ?>  />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>
                                    
                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span>Discount On Kids Classes</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="DiscountOnKidsClasses" class="toggle-checkbox" value="1" <?php if(isset($row['DiscountOnKidsClasses'])&& $row['DiscountOnKidsClasses'] != 0){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Subscription to Museum Library</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="SubsMuseumLib" class="toggle-checkbox" value="1" <?php if(isset($row['SubsMuseumLib'])&& $row['SubsMuseumLib'] != 0){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access Museum Library</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name='AccessMuseumLib' class="toggle-checkbox" value="1" <?php if(isset($row['AccessMuseumLib'])&& $row['AccessMuseumLib'] != 0){echo "Checked";} ?>  />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Special Recognition</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="SpecialRecognition" class="toggle-checkbox" value="1" <?php if(isset($row['SpecialRecognition'])&& $row['SpecialRecognition'] != 0){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access To All Events	</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessToEvents" class="toggle-checkbox" value="1" <?php if(isset($row['AccessToEvents'])&& $row['AccessToEvents'] != 0){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Free Access To Museum Restaurants</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="FreeMuseumRest" class="toggle-checkbox" value="1"  <?php if(isset($row['FreeMuseumRest'])&& $row['FreeMuseumRest'] != 0){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access To Tutankhamun Museum</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessTutankhamun" class="toggle-checkbox" value="1"  <?php if(isset($row['AccessTutankhamun'])&& $row['AccessTutankhamun'] != 0){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span>Access Tutankhamun Hologram</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessHologram" class="toggle-checkbox" value="1" <?php if(isset($row['AccessHologram'])&& $row['AccessHologram'] != 0){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>

                                <div class='CheckBoxDiv'>
                                    <div>
                                        <span> Access To Exclusive Monuments</span>
                                    </div>
                                    <label>
                                        <input type="checkbox" name="AccessToMonuments" class="toggle-checkbox" value="1" <?php if(isset($row['AccessToMonuments'])&& $row['AccessToMonuments'] != 0){echo "Checked";} ?> />
                                        <div class="toggle-switch"></div>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="InsertButton">
                                    <input type="submit" value="Update" class="btn btn-success btn-md w-10" />
                                    <a href="./Users.php?action=CheckAllMembership" class="btn btn-danger btn-md w-10"> Cancel </a>
                                </div>
                            </div>
                        </form>
                        <?php
                }else{
                    echo "<div class='NoData'>";
                        echo "This ID does not exist";
                    echo "</div>";
                }
            }
        }elseif($do == "UpdateMembership"){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $MembershipID = $_POST['MembershipID'];
                $Membership = $_POST['Name'];
                $Price = $_POST['Price'];
                $Period = $_POST['Period'];
                $FreeEntry = $_POST['FreeEntry'];
                $ChildernMuseum = $_POST['ChildernMuseum'];
                
                    $FormErrors = array();
            
                    if (empty($Membership)) {
                        $FormErrors[] = "The Role Should Have a Name it Cannot be empty";
                    }
                    if (empty($Price) || $Price == 0 ) {
                        $Price = NULL ;
                    }
                    if ($Period == 0 ) {
                        $FormErrors[] = "You Must Select a Period For The Membership";
                    }
                    if($FreeEntry > 8){
                        $FormErrors[] = "Too Much Entries For The Museum it Must be less than 8";
                    }
                    if($ChildernMuseum > 8){
                        $FormErrors[] = "Too Much Entries For The Childern Museum it Must be less than 8";
                    }

                    if(!isset($_POST['FreeEntry'])){
                        $FreeEntry = NULL ;
                    }else{
                        $FreeEntry = $_POST['FreeEntry'];
                    }
                    if(!isset($_POST['DiscountOnTours'])){
                        $DiscountOnTours = NULL ;
                    }else{
                        $DiscountOnTours = $_POST['DiscountOnTours'];
                    }
                    if(!isset($_POST['ChildernMuseum'])){
                        $ChildernMuseum = NULL ;
                    }else{
                        $ChildernMuseum = $_POST['ChildernMuseum'];
                    }
                    if(!isset($_POST['VouchersMuseum'])){
                        $VouchersMuseum = NULL ;
                    }else{
                        $VouchersMuseum = $_POST['VouchersMuseum'];
                        if($VouchersMuseum > 10){
                            $FormErrors[] = "Too Much Vouchers For The Restaurants it Must be less than 10";
                        }
                    }
                    if(!isset($_POST['AccessKidsArea'])){
                        $AccessKidsArea = NULL ;
                    }else{
                        $AccessKidsArea = $_POST['AccessKidsArea'];
                    }
                    if(!isset($_POST['DiscountOnKidsClasses'])){
                        $DiscountOnKidsClasses = NULL ;
                    }else{
                        $DiscountOnKidsClasses = $_POST['DiscountOnKidsClasses'];
                    }
                    if(!isset($_POST['SubsMuseumLib'])){
                        $SubsMuseumLib = NULL ;
                    }else{
                        $SubsMuseumLib = $_POST['SubsMuseumLib'];
                    }
                    if(!isset($_POST['AccessMuseumLib'])){
                        $AccessMuseumLib = NULL ;
                    }else{
                        $AccessMuseumLib = $_POST['AccessMuseumLib'];
                    }
                    if(!isset($_POST['SpecialRecognition'])){
                        $SpecialRecognition = NULL ;
                    }else{
                        $SpecialRecognition = $_POST['SpecialRecognition'];
                    }
                    if(!isset($_POST['AccessToEvents'])){
                        $AccessToEvents = NULL ;
                    }else{
                        $AccessToEvents = $_POST['AccessToEvents'];
                    }
                    if(!isset($_POST['FreeMuseumRest'])){
                        $FreeMuseumRest = NULL ;
                    }else{
                        $FreeMuseumRest = $_POST['FreeMuseumRest'];
                    }
                    if(!isset($_POST['AccessTutankhamun'])){
                        $AccessTutankhamun = NULL ;
                    }else{
                        $AccessTutankhamun = $_POST['AccessTutankhamun'];
                    }
                    if(!isset($_POST['AccessHologram'])){
                        $AccessHologram = NULL ;
                    }else{
                        $AccessHologram = $_POST['AccessHologram'];
                    }
                    if(!isset($_POST['AccessToMonuments'])){
                        $AccessToMonuments = NULL ;
                    }else{
                        $AccessToMonuments = $_POST['AccessToMonuments'];
                    }

                    if(empty($FormErrors)){
                        $UpdateQuery = "UPDATE membership  SET  Type = '$Membership' , Price = '$Price' , PeriodID = $Period ,  Entry = '$FreeEntry' ,
                                                                DiscountOnTours = '$DiscountOnTours' , AccessKidsArea = '$AccessKidsArea', ChildernMuseum = '$ChildernMuseum' , 
                                                                VouchersMuseum = '$VouchersMuseum' , DiscountOnKidsClasses = '$DiscountOnKidsClasses' , SubsMuseumLib ='$SubsMuseumLib'  , 
                                                                AccessMuseumLib = '$AccessMuseumLib' , SpecialRecognition = '$SpecialRecognition', AccessToEvents = '$AccessToEvents',
                                                                FreeMuseumRest = '$FreeMuseumRest', AccessTutankhamun = '$AccessTutankhamun', AccessHologram = '$AccessHologram', AccessToMonuments = '$AccessToMonuments'  
                                        WHERE ID = $MembershipID ";
                        $Update = mysqli_query($con, $UpdateQuery);
            
                                echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-success txt-center'> Membership Updated Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                                echo "</div>";

                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='container'>";
                                $TheMsg = "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                                RedirectIndex($TheMsg, "Back");
                            echo "</div>";
                        }
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