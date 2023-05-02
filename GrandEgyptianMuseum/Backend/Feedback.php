<?php
ob_start();

$PageTitle = "Feedback";

include './init.php';

session_start();
session_regenerate_id();

if (isset($_SESSION["AdminID"])) { 

    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);

    $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;
    include "Nav.php";
    if($do == 'Manage'){ 
        $sort = 'ASC';
        $sortarray = array('ASC', 'DESC');
    
        if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
            $sort = $_GET['sort'];                
        }
        $Select = "SELECT feedback .* , user.Name AS UserName ,user.LastName AS LastName , user.ID AS UserID , entertainmnet.Name AS EntertainmentName , entertainmnet.ID AS EntertainmentID FROM feedback 
                    LEFT JOIN user ON feedback.UserID = user.ID
                    LEFT JOIN entertainmnet ON feedback.EntertainmnetID = entertainmnet.ID
                    ORDER BY feedback.ID $sort
                    ";
        $FeedbackQuery = mysqli_query($con , $Select);
        $fecthquery = mysqli_fetch_row($FeedbackQuery);
        ?>
                    

        <h1 class="PageName">User's Feedback</h1>
        <div class="container">
        <div class="input-group md-form form-sm form-2 pl-0 mb-20">
            <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." id="myInput" onkeyup="myFunction()" aria-label="Search">
            <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
        </div>
            <div class="table-responsive">
                <table class="main-table table table-bordered table-hover" id="myTable">
                    <tr>
                        <td> 
                            <div class="SortingInTd">
                                ID
                                <div class="SortingTd">
                                    <a href="./Feedback.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                        echo 'active';
                                                                                    } ?> "> <i class="fa-solid fa-sort-up"></i></a>
                                    <a href="./Feedback.php?action=Manage&sort=DESC" class="<?php if ($sort == 'ASC') {
                                                                                        echo 'active';
                                                                                    } ?> iconsort"><i class="fa-solid fa-sort-down"></i></a>
                                </div>
                            </div>
                        </td>
                        <td>User Name</td>
                        <td>Entertainment</td>
                        <td>Feedback</td>

                    </tr>
                    <?php
                    foreach ($FeedbackQuery as $Feedback) {
                        $FullName = $Feedback['UserName'] . " " . $Feedback['LastName'] ;
                        echo "<tr  id='TableData'>";
                            echo "<td>" . $Feedback['ID']     . "</td>";
                            echo "<td><a href='./Users.php?action=MoreInfo&UserID=". $Feedback['UserID'] ."'> " . $FullName   . "</a></td>";
                            echo "<td><a href='./Entertainments.php?action=MoreInfo&EventID=". $Feedback['EntertainmentID'] ."'> " . $Feedback['EntertainmentName']  . "</td>";
                            echo "<td>" . $Feedback['Description'] . "</td>";
                        echo "</tr>";
                    } ?>
                </table>
            </div>
        </div>

        <?php
    }else{
        echo "<div class='container'>";
        $TheMsg = "<div class='alert alert-danger'> You are not authorized to access this page </div";
        RedirectIndex($TheMsg);
        echo "</div>";
    }
    include "./Includes/PageContent/Footer.php";
}else{
    if(!isset($_SESSION["AdminID"])){
        header("Location: login.php");
        exit();
    }
}

ob_end_flush();
?>