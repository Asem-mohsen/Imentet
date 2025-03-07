<?php
ob_start();

$PageTitle = "Sponsorships";

include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";

session_start();
session_regenerate_id();

if (isset($_SESSION["AdminID"])) { 

        $AdminID = $_SESSION['AdminID'];
        $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);
        include "./NavAdmin.php";

            if ($row['AdminRole'] == 1 || $row['AdminRole'] == 2 ) {
                
                $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;
            
                if($do == 'Manage'){ 
                    $sort = 'ASC';
                    $sortarray = array('ASC', 'DESC');
            
                    if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                        $sort = $_GET['sort'];
                    }
                    $SelectQuery = "SELECT sponsorship .* , eventsponsor.EventID AS EventID , entertainmnet.Name AS EventName , membership.Type AS Type FROM sponsorship
                                    LEFT JOIN eventsponsor ON sponsorship.ContractID = eventsponsor.ContractID
                                    LEFT JOIN entertainmnet ON eventsponsor.EventID = entertainmnet.ID
                                    JOIN membership ON sponsorship.MembershipID = membership.ID
                                    ORDER BY sponsorship.ContractID $sort
                                    ";
                        $Select = mysqli_query($con , $SelectQuery);
                        $fecthquery = mysqli_fetch_row($Select);
                        ?>
                            
                    <div class="page d-flex">
                        <div class=" w-280 sidepar p-20 p-relative">
                            <h3 class="p-relative txt-center mt-0">Control</h3>
                            <form method="post">
                                <ul>
                                    <?php if ($row['AdminRole'] == 1 ) { ?>
                                        <li> 
                                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Sponsorship.php?action=Add">
                                                <i class="fa-solid fa-plus fa-fw"></i><span> Add New Contract </span>
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
                                        <p class='mt-20 ml-20 cursor-d fw-bold'>Filter By Companies </p>
                                    </li>
                                        <?php
                                            $CompaniesSelect = "SELECT DISTINCT sponsorship.Name AS Name , sponsorship.ContractID AS ContractID FROM sponsorship 
                                            LEFT JOIN eventsponsor ON sponsorship.ContractID = eventsponsor.ContractID";
                                            $Run = mysqli_query($con , $CompaniesSelect);
                                            $fetch = mysqli_fetch_assoc($Run);

                                            foreach($Run as $Sponsor){ 
                                                $Checked = [];
                                                if(isset($_POST['ContractID'])){
                                                    $Checked = $_POST['ContractID'];
                                                }?>
                                    <li>
                                    <input type="checkbox" name="ContractID[]" value="<?php echo $Sponsor['ContractID'] ?>" <?php if(in_array( $Sponsor['ContractID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                            <?php echo $Sponsor['Name'] ; ?>
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
                                                        <a href="./Sponsorship.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Asc </a> |
                                                        <a href="./Sponsorship.php?action=Manage&sort=ASC" class="<?php if ($sort == 'DESC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Desc </a> ]
                                        </div>
                                    </li>
                                </ul>
                            </form>
                        </div>
                        <div class="container">
                            <h1 class="PageName">Sponsorships</h1>                         
                            <div class="table-responsive">
                                <table class="main-table table table-bordered table-hover table-light">
                                    <tr>
                                        <td>Contract ID</td>
                                        <td>Company</td>
                                        <td>Contracted for</td>
                                        <td>Signed With </td>
                                        <td>Membership </td>
                                        <td>Control</td>
                                    </tr>
                                    <?php
                                    if(isset($_POST['ContractID'])){
                                        $sql = "WHERE sponsorship.ContractID IN(".implode(',', $_POST['ContractID'] ).")" ; 
                                        $SelectQuery = "SELECT sponsorship .* , eventsponsor.EventID AS EventID , entertainmnet.Name AS EventName , membership.Type AS Type FROM sponsorship
                                        LEFT JOIN eventsponsor ON sponsorship.ContractID = eventsponsor.ContractID
                                        LEFT JOIN entertainmnet ON eventsponsor.EventID = entertainmnet.ID
                                        JOIN membership ON sponsorship.MembershipID = membership.ID
                                        $sql
                                        ORDER BY sponsorship.ContractID $sort
                                        ";
                                            $Select = mysqli_query($con , $SelectQuery);
                                            $fecthquery = mysqli_fetch_row($Select);
                                            $count = mysqli_num_rows($Select);
                                            
                                            if($count > 0 ){
                                                foreach ($Select as $Sponsorship) {
                                                    echo "<tr>";
                                                        echo "<td>" . $Sponsorship['ContractID']     . "</td>";
                                                        echo "<td>". $Sponsorship['Name'] . "</td>";
                                                        echo "<td>" ;
                                                                if( $Sponsorship['EventName'] == NULL){
                                                                    echo "<p class='c-gray fs-13'>Doesn't Contracted For Any Entertainment Yet </p>"; 
                                                                }else{
                                                                    echo "<a href='./Entertainments.php?action=MoreInfo&EventID=". $Sponsorship['EventID'] ."'> " . $Sponsorship['EventName']   . "</a>" ;
                                                                }
                                                        echo "</td>";
                                                        echo "<td>" .  $Sponsorship['ContractedWith'] . "</td>" ;
                                                        echo "<td>" .  $Sponsorship['Type'] . "</td>" ;
                                                        echo "<td>";
                                                                    if( $Sponsorship['EventName'] == NULL && $row['AdminRole'] == 1){
                                                                        echo "<a href='./Sponsorship.php?action=Delete&SponsorshipID=".$Sponsorship['ContractID']."' class='btn btn-danger' '> Terminate The Contract </a>"; 
                                                                    }else{
                                                                        echo "<div class='Terminate'>" ;
                                                                            echo "<button class='btn btn-danger' disabled > Terminate The Contract </button>"; 
                                                                            echo "<p class='fs-5 c-gray fs'>You Have to Change The Event's Sponsorship First In order to Terminate The Contract </p>" ;
                                                                        echo "</div" ;
                                                                    }
                                                        echo "</td>";
                                                    echo "</tr>";
                                                }
                                            }
                                    }else{
                                        $SelectQuery = "SELECT sponsorship .* , eventsponsor.EventID AS EventID , entertainmnet.Name AS EventName , membership.Type AS Type FROM sponsorship
                                        LEFT JOIN eventsponsor ON sponsorship.ContractID = eventsponsor.ContractID
                                        LEFT JOIN entertainmnet ON eventsponsor.EventID = entertainmnet.ID
                                        JOIN membership ON sponsorship.MembershipID = membership.ID
                                        ORDER BY sponsorship.ContractID $sort
                                        ";
                                            $Select = mysqli_query($con , $SelectQuery);
                                            $fecthquery = mysqli_fetch_row($Select);
                                            $count = mysqli_num_rows($Select);
                                            
                                            if($count > 0 ){
                                                foreach ($Select as $Sponsorship) {
                                                    echo "<tr>";
                                                        echo "<td>" . $Sponsorship['ContractID']     . "</td>";
                                                        echo "<td>". $Sponsorship['Name'] . "</td>";
                                                        echo "<td>" ;
                                                                if( $Sponsorship['EventName'] == NULL){
                                                                    echo "<p class='c-gray fs-13'>Doesn't Contracted For Any Entertainment Yet </p>"; 
                                                                }else{
                                                                    echo "<a href='./Entertainments.php?action=MoreInfo&EventID=". $Sponsorship['EventID'] ."'> " . $Sponsorship['EventName']   . "</a>" ;
                                                                }
                                                        echo "</td>";
                                                        echo "<td>" .  $Sponsorship['ContractedWith'] . "</td>" ;
                                                        echo "<td>" .  $Sponsorship['Type'] . "</td>" ;
                                                        echo "<td>";
                                                                    if( $Sponsorship['EventName'] == NULL && $row['AdminRole'] == 1){
                                                                        echo "<a href='./Sponsorship.php?action=Delete&SponsorshipID=".$Sponsorship['ContractID']."' class='btn btn-danger' '> Terminate The Contract </a>"; 
                                                                    }else{
                                                                        echo "<div class='Terminate'>" ;
                                                                            echo "<button class='btn btn-danger' disabled > Terminate The Contract </button>"; 
                                                                            echo "<p class='fs-5 c-gray fs'>You Have to Change The Event's Sponsorship First In order to Terminate The Contract </p>" ;
                                                                        echo "</div" ;
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
                }elseif($do == "Add"){
                    ?>
                        <h1 class="PageName"> Add New Sponsorship</h1>
                        <div class="container">
                            <form class="form-horizontal" action="?action=Insert" method="POST">
                                <div class="form-group insertInput">
                                    <div class="m-auto">
                                        <input type="text" name="Name" placeholder="Company Name" autocomplete="off" class="form-control" required="required" />
                                    </div>
                                </div>  
                                <div class="form-group insertInput">
                                    <div class="m-auto">
                                        <input type="text" name="Signed" placeholder="Signed By" autocomplete="off" class="form-control" required="required" />
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <div class="InsertButton">
                                        <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                        <a href="./Sponsorship.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
                }elseif($do == "Insert"){
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $Name = mysqli_real_escape_string($con , $_POST['Name']);
                        $Signed = mysqli_real_escape_string($con , $_POST['Signed']);

                    
                            $FormErrors = array();
                    
                            if (empty($Name)) {
                                $FormErrors[] = "The Company Name Cannot be empty";
                            }
                            
                            if (empty($Signed)) {
                                $FormErrors[] = "Deal IS Done By ? Cannot be empty";
                            }
                            if (!preg_match ("/^[a-zA-z]*$/", $Name) ) {  
                                $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                            }
                            if (!preg_match ("/^[a-zA-z]*$/", $Signed) ) {  
                                $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                            }
                            if(empty($FormErrors)){
                                $InsertQuery = "INSERT INTO `sponsorship` Values( Null , '$Name' , '$Signed' , 12 )";
                                $Insert = mysqli_query($con, $InsertQuery);

                                        echo "<div class='container'>";
                                        $TheMsg = "<div class='alert alert-success txt-center'> Sponsorship Added Successfuly </div>";
                                        RedirectIndex($TheMsg, "Back");
                                        echo "</div>";
                            }else{
                                foreach($FormErrors as $error){
                                    echo "<div class='alert alert-danger  txt-center'>" . $error . "</div>";
                                }
                            }
                        }
                }elseif($do == "Delete"){
                    $SponsorshipID = isset($_GET['SponsorshipID']) && is_numeric($_GET['SponsorshipID']) ? intval($_GET['SponsorshipID']) : 0;
                    
                    $Check = "SELECT * FROM sponsorship WHERE ContractID = $SponsorshipID";
                    $CheckSponsorship = mysqli_query($con, $Check);

                    if ($Check > 0) {

                        $DeleteQuery = "DELETE FROM sponsorship WHERE ContractID = $SponsorshipID";
                        $Delete = mysqli_query($con, $DeleteQuery);

                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-success  txt-center'>"  . "Deleted Successfully" . '</div>';
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                    } else {
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-danger  txt-center'>" . "Error" . "</div>";
                        RedirectIndex($TheMsg);
                        echo "</div>";
                    }
                }else{
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger txt-center'> No Page With This Name </div>";
                    RedirectIndex($TheMsg);
                    echo "</div>";
                }
            }else{
                
                echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-danger txt-center'> You are not authorized to access this page </div>";
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