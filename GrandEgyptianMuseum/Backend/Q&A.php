<?php
ob_start();

$PageTitle = "Question And Answers";

include './init.php';

session_start();

if (isset($_SESSION["AdminID"])) { 

    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);

    $AdminRole = $row['AdminRole'];
    
    if( $AdminRole == 4 || $AdminRole == 1 ){

        $do = isset($_GET['action']) ? $_GET['action'] : "Manage" ;
        include './Nav.php';

        if($do == "Manage"){
            
                $sort = 'ASC';
                $sortarray = array('ASC', 'DESC');
        
                if (isset($_GET['sort']) && in_array($_GET['sort'], $sortarray)) {
                    $sort = $_GET['sort'];
                }
                $QuestionsQuery = "SELECT * FROM `q&a` ORDER BY ID $sort ";
                $QA = mysqli_query($con , $QuestionsQuery);
                $fetchquery = mysqli_fetch_row($QA);
                $count =mysqli_num_rows($QA);
                if($count > 0 ){
                    ?>
                            <h1 class="PageName">Questions And Answers </h1>
                                <div class="container">
                                    <button class="Control" data-toggle="collapse" data-target="#Control">Control</button>
                                    <div class="buttons collapse" id="Control">
                                            <div class="Adminbuttons">
                                                <a href="./Dashboard.php" class="btn btn-info">Back</a>
                                                <span class="AdminLine"> </span>
                                                <form method="POST">
                                                    <div class="RoleFilter">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa-solid fa-filter"></i>  Filter By Response
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <?php
                                                            $ResponseSelect = "SELECT DISTINCT ResponseFilter FROM `q&a` ";
                                                            $Run = mysqli_query($con , $ResponseSelect);
                                                            $row = mysqli_fetch_assoc($Run);

                                                            foreach($Run as $Response){ 
                                                                $Checked = [];
                                                                if(isset($_POST['ResponseFilter'])){
                                                                    $Checked = $_POST['ResponseFilter'];
                                                                }
                                                                ?>
                                                                <label class="dropdown-item">
                                                                    <input type="checkbox" name="ResponseFilter[]" value="<?php echo $Response['ResponseFilter'] ?>" <?php if(in_array( $Response['ResponseFilter'] , $Checked)){ echo "Checked" ;  } ?>/>
                                                                        <?php if($Response['ResponseFilter'] == 1){ echo 'Answered' ; }elseif($Response['ResponseFilter'] == 0){ echo 'No Response' ; } ?>
                                                                </label>
                                                            <?php } ?>
                                                                <button type="submit" class="btn btn-primary filterbutton">Search</button>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="AdminSort collapse" id="Control" >
                                                    <i class="fa-solid fa-sort"></i> Sorting : [
                                                        <a href="./Q&A.php?action=Manage&sort=ASC" class="<?php if ($sort == 'ASC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Asc </a> |
                                                        <a href="./Q&A.php?action=Manage&sort=DESC" class="<?php if ($sort == 'DESC') {
                                                                                        echo 'active';
                                                                                    } ?>"> Desc </a> ]
                                                </div>
                                            </div>
                                        
                                    </div>
                                    <div class="table-responsive">
                                        <table class="main-table table table-bordered table-hover">
                                            <tr>
                                                <td>ID</td>
                                                <td>Question</td>
                                                <td>Answer</td>
                                                <td>Action</td>
                                            </tr>
                                            <?php

                                            if(isset($_POST['ResponseFilter'])){
                                                $sql = "WHERE `q&a`.`ResponseFilter` IN(".implode(',', $_POST['ResponseFilter'] ).")" ; 
                                                $QuestionsQuery = "SELECT * FROM `q&a` $sql ORDER BY ID $sort";
                                                $QA = mysqli_query($con , $QuestionsQuery);
                                                $fetchquery = mysqli_fetch_row($QA);
                                                $count =mysqli_num_rows($QA); 
                                                    
                                                    if($count > 0 ){
                                                        foreach ($QA as $Info) {

                                                            echo "<tr>";
                                                                echo "<td>" .      $Info['ID']         . "</td>";
                                                                echo "<td>" . $Info['UsersQuestion']   . "</td>";
            
                                                                if($Info['CsAnswer'] == NULL){
                                                                        echo "<td colspan=2>" ;
                                                                            echo "<a href='./Q&A.php?action=Replay&QuestionID=". $Info['ID'] ."&AdminID=". $AdminID ."' class='btn btn-primary ReplyButton'> Reply </a>";
                                                                        echo "</td>";
                                                                }else{
                                                                        echo "<td>" ;
                                                                            echo $Info['CsAnswer'] ;
                                                                        echo "</td>"; 
                                                                            }
                                                                
                                                                if($Info['CsAnswer'] != NULL){
                                                                    echo "<td><a href='./Q&A.php?action=EditReplay&QuestionID=".$Info['ID']."&AdminID=". $AdminID ."' class='btn btn-success'> Edit Reply </a></td>";
                                                                }
                                                            echo "</tr>";
                                                        } 
                                                    }
                                            }else{
                                                $QuestionsQuery = "SELECT * FROM `q&a` ORDER BY ID $sort";
                                                $QA = mysqli_query($con , $QuestionsQuery);
                                                $fetchquery = mysqli_fetch_row($QA);
                                                $count =mysqli_num_rows($QA); 
                                                
                                                if($count > 0 ){
                                                    foreach ($QA as $Info) {

                                                        echo "<tr>";
                                                            echo "<td>" .      $Info['ID']         . "</td>";
                                                            echo "<td>" . $Info['UsersQuestion']   . "</td>";
        
                                                            if($Info['CsAnswer'] == NULL){
                                                                    echo "<td colspan=2>" ;
                                                                        echo "<a href='./Q&A.php?action=Replay&QuestionID=". $Info['ID'] ."&AdminID=". $AdminID ."' class='btn btn-primary ReplyButton'> Reply </a>";
                                                                    echo "</td>";
                                                            }else{
                                                                    echo "<td>" ;
                                                                        echo $Info['CsAnswer'] ;
                                                                    echo "</td>"; 
                                                                        }
                                                            
                                                            if($Info['CsAnswer'] != NULL){
                                                                echo "<td><a href='./Q&A.php?action=EditReplay&QuestionID=".$Info['ID']."&AdminID=". $AdminID ."' class='btn btn-success'> Edit Reply </a></td>";
                                                            }
                                                        echo "</tr>";
                                                    } 
                                                }
                                            }
                                            ?>
                                        </table>
                                    </div>
                                </div>
                                        
                <?php }else{
                    echo "No Current Data";
                }
        }elseif($do == "Replay"){ 

            $QestionID = filter_var($_GET['QuestionID'], FILTER_SANITIZE_NUMBER_INT);
            if(empty($QestionID)){
                echo "<div class='NoData'>";
                    echo "<p>Dude Where is the Question !! </p>";
                echo "</div>";
            }else{

            $AdminID = $_GET['AdminID'];
            $Select = "SELECT * FROM `q&a` WHERE ID = $QestionID ";
            $QuestionsQuery = mysqli_query($con , $Select);
            $row = mysqli_fetch_assoc($QuestionsQuery);
            if(isset($row['ID'])){

            ?>
            <h1 class="PageName"> Reply </h1>
            <div class="container">
                <form class="form-horizontal" action="?action=InsertReplay" method="POST">
                <div class="form-group insertInput">
                    <input type="hidden" name="AdminID" value="<?php echo $AdminID ?>">
                    <input type="hidden" name="QestionID" value="<?php echo $QestionID ?>">
                        <label class="mt-20 control-label">The Question</label>
                        <div class="m-auto">
                            <textarea type="text" name="Question" rows="5" class="form-control" disabled > <?php echo $row['UsersQuestion'] ?></textarea>
                        </div>
                    </div> 
                    <div class="form-group insertInput">
                        <label class="col-sm-2 control-label">Answer</label>
                        <div class="m-auto">
                            <textarea type="text" name="Answer" rows="3" class="form-control" required="required" ></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="InsertButton">
                            <input type="submit" value="Reply" class="btn btn-primary btn-md  w-10" />
                            <a href="./Q&A.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                        </div>
                    </div>
                    <div class="tips">
                        <h4 class="Notes">Notes</h4>
                        <ul>
                            <li>Your Response will be reviewed by another Admins </li>
                            <li>Keep in mind that you represent the entity as a whole </li>
                            <li>Whatever the Questin, The Answer is MUST</li>
                        </ul>
                    </div>
                </form>
            <?php 
            }else{
                        echo "<div class='NoData'>";
                            echo "<p>Question Does Not Exist </p>";
                        echo "</div>";
                    }
                }
        }elseif($do == "InsertReplay"){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $QestionID = $_POST['QestionID'];
                $AdminID = $_POST['AdminID'];
                $Answer = $_POST['Answer'];
                    $FormErrors = array();
            
                    if (empty($Answer)) {
                        $FormErrors[] = "The Answer Cannot be empty";
                    }
            
                    if(empty($FormErrors)){
                        $UpdateQuery = "UPDATE `q&a` SET CsAnswer = '$Answer' , AdminID = $AdminID , ResponseFilter = 1 WHERE ID = $QestionID";
                        $Insert = mysqli_query($con, $UpdateQuery);
                                header("Location: ./Q&A.php?action=Manage");
                    }
            }
                
        }elseif($do == "EditReplay"){
            
            $QestionID = filter_var($_GET['QuestionID'], FILTER_SANITIZE_NUMBER_INT);
            $AdminID = filter_var($_GET['AdminID'], FILTER_SANITIZE_NUMBER_INT);

            if(empty($QestionID) || empty($AdminID)){
                echo "<div class='NoData'>";
                    echo "<p>Replay for a hidden Question ? Really !</p>";
                echo "</div>";
            }else{
                $Select = "SELECT * FROM `q&a` WHERE ID = $QestionID ";
                $QuestionsQuery = mysqli_query($con , $Select);
                $row = mysqli_fetch_assoc($QuestionsQuery);
                if(isset($row['ID'])){

            ?>
            <h1 class="PageName"> Edit Replay </h1>
            <div class="container">
                <form class="form-horizontal" action="?action=UpdateReplay" method="POST">
                <div class="form-group insertInput ">
                    <input type="hidden" name="AdminID" value="<?php echo $AdminID ?>">
                    <input type="hidden" name="QestionID" value="<?php echo $QestionID ?>">
                        <label class="control-label mt-20">The Question</label>
                        <div class="m-auto">
                            <textarea type="text" name="Question" rows="5" class="form-control" disabled > <?php echo $row['UsersQuestion'] ?></textarea>
                        </div>
                    </div> 
                    <div class="form-group insertInput">
                        <label class="control-label  mt-20">Answer</label>
                        <div class="m-auto">
                            <textarea type="text" name="Answer" rows="3" class="form-control" required="required" ><?php echo $row['CsAnswer']; ?></textarea>
                        </div>
                    </div>  
                    <div class="form-group">
                        <div class="InsertButton">
                            <input type="submit" value="Update" class="btn btn-success btn-md w-10" />
                            <a href="./Q&A.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                        </div>
                    </div>
                    <div class="tips">
                        <h4 class="Notes">Notes</h4>
                        <ul>
                            <li>Your Response will be reviewed by another Admins </li>
                            <li>Keep in mind that you represent the entity as a whole </li>
                            <li>Whatever the Questin, The Answer is MUST</li>
                        </ul>
                    </div>
                </form>
            <?php 
                }else{
                    echo "<div class='NoData'>";
                        echo "<p>Question Does Not Exist </p>";
                    echo "</div>";
                }
            }
        }elseif($do == "UpdateReplay"){
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $QestionID = $_POST['QestionID'];
                $AdminID = $_POST['AdminID'];
                $Answer = $_POST['Answer'];
                    $FormErrors = array();
            
                    if (empty($Answer)) {
                        $FormErrors[] = "The Answer Cannot be empty";
                    }
            
                    if(empty($FormErrors)){
                        $UpdateQuery = "UPDATE `q&a` SET CsAnswer = '$Answer' , AdminID = $AdminID , ResponseFilter = 1 WHERE ID = $QestionID";
                        $Insert = mysqli_query($con, $UpdateQuery);
                                header("Location: ./Q&A.php?action=Manage");
                    }
            }
        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger'>"  . "No Page With This Name" . '</div>';
            RedirectIndex($TheMsg);
            echo "</div>";   
        }
    }else{
        echo "<div class='container'>";
        $TheMsg = "<div class='alert alert-danger'>"  . "You Are Not Authorized To Access This Platform" . '</div>';
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