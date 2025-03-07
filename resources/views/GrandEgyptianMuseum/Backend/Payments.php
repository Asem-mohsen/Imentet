<?php
ob_start();

$PageTitle = "Payments";

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

        if ($row['AdminRole'] == 1 || $row['AdminRole'] == 2 ) {
            
            $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;

            if($do == 'Manage'){ 
                $sort = 'ASC';
                $sortarray = array('ASC', 'DESC');

                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];
                }

                $Select = "SELECT * FROM paymentoptions ORDER BY ID $sort" ;
                $PaymentsQuery = mysqli_query($con , $Select);
                $fecthquery = mysqli_fetch_row($PaymentsQuery);
                $count = mysqli_num_rows($PaymentsQuery);
            
                ?>
                <div class="page d-flex">
                    <div class=" w-280 sidepar p-20 p-relative">
                        <h3 class="p-relative txt-center mt-0">Control</h3>
                        <form method="post">
                            <ul>
                                <?php if ($row['AdminRole'] == 1 ) { ?> 
                                    <li>
                                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Payments.php?action=Add">
                                            <i class="fa-solid fa-plus fa-fw"></i><span> Add New Payment Method </span>
                                        </a>
                                    </li>
                                <?php } ?>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Pricing.php?action=Manage">
                                        <i class="fa-solid fa-circle-dollar-to-slot fa-fw"></i><span> Pricing </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Dashboard.php">
                                        <i class="fa-solid fa-arrow-left fa-fw"></i><span> Dashboard </span>
                                    </a>
                                </li>
                                <li>
                                    <h6 class='txt-center mt-20'><i class="fa-solid fa-sort fa-fw"></i> Sorting </h6>
                                </li>
                                <li>
                                    <div class="p-10 fs-14">
                                        Sorting : [
                                                    <a href="./Payments.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                    echo 'active';
                                                                                } ?>"> Asc </a> |
                                                    <a href="./Payments.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                    echo 'active';
                                                                                } ?>"> Desc </a> ]
                                    </div>
                                </li>
                            </ul>
                        </form>
                    </div>
                    <div class="container">
                        <h1 class="PageName">Methods of Payments</h1>
                    <?php if($count > 0) { ?>
                                <div class="container">
                                    <div class="table-responsive">
                                        <table class="main-table table table-bordered table-hover table-light">
                                            <tr>
                                                <td>#</td>
                                                <td>Method</td>
                                            </tr>
                                            <?php
                                            foreach ($PaymentsQuery as $Payments) {
                                                echo "<tr>";
                                                    echo "<td>" . $Payments['ID']     . "</td>";
                                                    echo "<td>" . $Payments['PaymentType']  . "</td>";
                                                echo "</tr>";
                                            } ?>
                                        </table>
                                    </div>
                                </div>
                    <?php }else{
                            echo "<div class='NoData'>";
                                echo "<p>No data to show </p>";
                                echo "<a href='./Dashboard.php' class='btn btn-primary'> Back </a>";
                            echo "</div>";          
                    }
                    echo "</div>";
                echo "</div>";

            }elseif($do == 'Add'){ 
                ?>
                <h1 class="PageName"> Add New Payment Method </h1>
                        <div class="container">
                            <form class="form-horizontal" action="?action=InsertNewMethod" method="POST">
                                <div class="form-group insertInput">
                                    <div class="m-auto">
                                        <input type="text" name="Payment" placeholder="Payment Method" class="form-control" required="required" />
                                    </div>
                                </div>  
                                <div class="form-group">
                                    <div class="InsertButton">
                                        <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                        <a href="./Payments.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <?php
            }elseif($do == 'InsertNewMethod'){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $Payment = $_POST['Payment'];
                
                        $FormErrors = array();
                
                        if (empty($Payment)) {
                            $FormErrors[] = "The Payment Cannot be empty";
                        }
                
                        if(empty($FormErrors)){
                            $InsertQuery = "INSERT INTO `paymentoptions` Values( Null , '$Payment' )";
                            $Insert = mysqli_query($con, $InsertQuery);
                                        
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success txt-center'> Payment Method Added Successfully </div>";
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                        }else{
                            foreach($FormErrors as $errors){
                                
                            }
                        }
                    }
            }else{
                echo "<div class='container'>";
                $TheMsg = "<div class='alert alert-danger txt-center'> This Page Does Not Exist </div";
                RedirectIndex($TheMsg);
                echo "</div>"; 
            }

        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger txt-center'> You are not authorized to access this page </div";
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