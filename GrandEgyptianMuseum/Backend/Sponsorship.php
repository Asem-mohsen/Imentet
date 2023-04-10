<?php
ob_start();

$PageTitle = "Sponsorships";

include './init.php';

session_start();

if (isset($_SESSION["AdminID"])) { 

        $AdminID = $_SESSION['AdminID'];
        $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
        $Select = mysqli_query($con, $SelectQuery);
        $row = mysqli_fetch_assoc($Select);

        if ($row['AdminRole'] == 1 || $row['AdminRole'] == 2 ) {
            
            include "./Nav.php";
            $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;
        
            if($do == 'Manage'){ 
                $sort = 'ASC';
                $sortarray = array('ASC', 'DESC');
        
                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];
                }
                $SelectQuery = "SELECT sponsorship .* , eventsponsor.EventID AS EventID , entertainmnet.Name AS EventName FROM sponsorship
                LEFT JOIN eventsponsor ON sponsorship.ContractID = eventsponsor.ContractID
                LEFT JOIN entertainmnet ON eventsponsor.EventID = entertainmnet.ID
                ORDER BY sponsorship.ContractID $sort
                ";
                    $Select = mysqli_query($con , $SelectQuery);
                    $fecthquery = mysqli_fetch_row($Select);
                    ?>
                        

                    <h1 class="PageName">Sponsorships</h1>
                    <div class="container">
                        <?php 
                        if ($row['AdminRole'] == 1 ) { ?>
                        <button class="Control" data-toggle="collapse" data-target="#Control">Control</button>
                                <div class="buttons collapse" id="Control">
                                    <div class='FilterAndButtons'>
                                        <div class="buttons">
                                            <a href="./Sponsorship.php?action=Add" class="btn btn-primary">Add New Contract</a>
                                            <span class="line"> </span>
                                            <a href="./Dashboard.php" class="btn btn-info">Back</a>
                                        </div>
                                        <div class="Filter">
                                            <form method="POST">
                                                <div class="RoleFilter">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="fa-solid fa-filter"></i>  Filter By Companies
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <?php
                                                        $PlaceSelect = "SELECT DISTINCT sponsorship.Name AS Name , sponsorship.ContractID AS ContractID FROM sponsorship 
                                                                        LEFT JOIN eventsponsor ON sponsorship.ContractID = eventsponsor.ContractID";
                                                        $Run = mysqli_query($con , $PlaceSelect);
                                                        $fetch = mysqli_fetch_assoc($Run);

                                                        foreach($Run as $Sponsor){ 
                                                            $Checked = [];
                                                            if(isset($_POST['ContractID'])){
                                                                $Checked = $_POST['ContractID'];
                                                            }
                                                            ?>
                                                            <label class="dropdown-item">
                                                                <input type="checkbox" name="ContractID[]" value="<?php echo $Sponsor['ContractID'] ?>" <?php if(in_array( $Sponsor['ContractID'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                    <?php echo $Sponsor['Name'] ; ?>
                                                            </label>
                                                        <?php } ?>
                                                            <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                            
                                    </div>
                                    <div class="AdminSort collapse" id="Control" >
                                        <i class="fa-solid fa-sort"></i> Sorting : [
                                            <a href="./Sponsorship.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                            echo 'active';
                                                                        } ?>"> Asc </a> |
                                            <a href="./Sponsorship.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                            echo 'active';
                                                                        } ?>"> Desc </a> ]
                                    </div>
                                                
                                </div>
                        <?php } ?>
                                                                    
                    <div class="table-responsive">
                    <table class="main-table table table-bordered table-hover">
                        <tr>
                            <td>Contract ID</td>
                            <td>Company</td>
                            <td>Contracted for</td>
                            <td>Signed With </td>
                            <td>Control</td>
                        </tr>
                        <?php
                        if(isset($_POST['ContractID'])){
                            $sql = "WHERE sponsorship.ContractID IN(".implode(',', $_POST['ContractID'] ).")" ; 
                            $SelectQuery = "SELECT sponsorship .* , eventsponsor.EventID AS EventID , entertainmnet.Name AS EventName FROM sponsorship
                            LEFT JOIN eventsponsor ON sponsorship.ContractID = eventsponsor.ContractID
                            LEFT JOIN entertainmnet ON eventsponsor.EventID = entertainmnet.ID
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
                            $SelectQuery = "SELECT sponsorship .* , eventsponsor.EventID AS EventID , entertainmnet.Name AS EventName FROM sponsorship
                            LEFT JOIN eventsponsor ON sponsorship.ContractID = eventsponsor.ContractID
                            LEFT JOIN entertainmnet ON eventsponsor.EventID = entertainmnet.ID
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
                    $Name = $_POST['Name'];
                    $Signed = $_POST['Signed'];

                
                        $FormErrors = array();
                
                        if (empty($Name)) {
                            $FormErrors[] = "The Company Name Cannot be empty";
                        }
                        
                        if (empty($Signed)) {
                            $FormErrors[] = "Deal IS Done By ? Cannot be empty";
                        }
                
                        if(empty($FormErrors)){
                            $InsertQuery = "INSERT INTO `sponsorship` Values( Null , '$Name' , '$Signed' )";
                            $Insert = mysqli_query($con, $InsertQuery);

                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success'> Sponsorship Added Successfuly </div>";
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                        }else{
                            foreach($FormErrors as $error){
                                echo "<div class='alert alert-danger'>" . $error . "</div>";
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
                    $TheMsg = "<div class='alert alert-success'>"  . "Deleted Successfully" . '</div>';
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                } else {
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger'>" . "Error" . "</div>";
                    RedirectIndex($TheMsg);
                    echo "</div>";
                }
            }else{
                echo "<div class='container'>";
                $TheMsg = "<div class='alert alert-danger'> No Page With This Name </div";
                RedirectIndex($TheMsg);
                echo "</div>";
            }
        }else{
            echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger'> You are not authorized to access this page </div";
            RedirectIndex($TheMsg);
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