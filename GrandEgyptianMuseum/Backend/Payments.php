<?php
ob_start();

$PageTitle = "Payments";

include './init.php';

session_start();
session_regenerate_id();

if (isset($_SESSION["AdminID"])) { 
        
    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);

    if ($row['AdminRole'] == 1 || $row['AdminRole'] == 2 ) {
        
        include "Nav.php";
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

            <h1 class="PageName">Methods of Payments</h1>
            <div class="container">
            <?php if ($row['AdminRole'] == 1 ) { ?> 
                <button class="Control ml-15" data-toggle="collapse" data-target="#Control">Control</button>
                <div class="PaymentsButtons collapse m-rl-15" id="Control">
                    <a href="./Payments.php?action=Add" class="btn btn-primary">Add New Method</a>
                        <div class="Sort buttons collapse" id="Control" >
                            <i class="fa-solid fa-sort"></i> Sorting : [
                            <a href="./Payments.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                            echo 'active';
                                                        } ?>"> Asc </a> |
                            <a href="./Payments.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                            echo 'active';
                                                        } ?>"> Desc </a> ]
                        </div>
                </div>
                <?php } 
                if($count > 0) { ?>
                        <div class="container">
                            <div class="table-responsive">
                                <table class="main-table table table-bordered table-hover">
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
                                $TheMsg = "<div class='alert alert-success'> Payment Method Added Successfully </div>";
                                RedirectIndex($TheMsg, "Back");
                                echo "</div>";
                    }else{
                        foreach($FormErrors as $errors){
                            
                        }
                    }
                }
        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger'> This Page Does Not Exist </div";
            RedirectIndex($TheMsg);
            echo "</div>"; 
        }
    include "./Includes/PageContent/Footer.php";

    }else{
        echo "<div class='container'>";
        $TheMsg = "<div class='alert alert-danger'> You are not authorized to access this page </div";
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