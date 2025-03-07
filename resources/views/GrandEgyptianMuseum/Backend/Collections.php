<?php
ob_start();

$PageTitle = "Arts";

include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";

session_start();
session_regenerate_id();

if (isset($_SESSION["AdminID"])) { 

    $AdminID = $_SESSION['AdminID'];
    $SelectQuery = "SELECT * FROM admin WHERE ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
    $AdminRole = $row['AdminRole'];

    include './NavAdmin.php';

        if($AdminRole != 4 ){
            $do = isset($_GET['action']) ? $_GET['action'] : "Manage" ;
                
            if($do == "Manage"){ 
                $CollectionSelect = "SELECT collections .* , place.Name AS PlaceName FROM collections 
                                    JOIN place ON collections.PlaceID = place.ID ";
                $SelectQuery = mysqli_query($con , $CollectionSelect);
                $row = mysqli_fetch_assoc($SelectQuery)
                ?>
                <div class="page d-flex">
                    <div class="sidepar p-20 p-relative">
                        <h3 class="p-relative txt-center mt-0">Control</h3>
                        <ul>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6"  href="./Collections.php?action=Add">
                                    <i class="fa-solid fa-plus fa-fw"></i><span> Add Art </span>
                                </a>
                            </li>
                                <li>
                                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Collections.php?action=CheckAll">
                                        <i class="fa-solid fa-search fa-fw"></i><span> Check All Arts </span>
                                    </a>
                                </li>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Dashboard.php">
                                    <i class="fa-solid fa-arrow-left fa-fw"></i><span> Dashboard </span>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="content-area w-full">
                        <h1 class="PageName">Arts</h1>
                        <div class="Collections">
                            <?php foreach($SelectQuery as $Collection){ ?>
                            <div class="Collection">
                                <div class="Img">
                                    <img style="background-image: url('./Images/<?php echo $Collection['Image'] ; ?>');" alt="">
                                </div>
                                <?php if($AdminRole == 3){ ?>
                                        <h2 class="ArtNameNoAdmin"><?php echo $Collection['Collection'] ; ?></h2>
                                <?php }else{ ?>
                                        <a href="./Collections.php?action=Edit&CollectionID=<?php echo $Collection['ID'] ?>" class="ArtName"><?php echo $Collection['Collection'] ; ?></a>
                                <?php } ?>
                                <div class="MoreInfo">
                                    <div class="Description">
                                        <h3> Description </h3>
                                        <p><?php echo $Collection['Description'] ;?></p>
                                    </div>
                                    <div class="Place">
                                        <h4> Located In </h4>
                                        <p><?php echo $Collection['PlaceName'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <hr class="vr">
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php 
            }elseif($do == "Add"){
                ?>
                <h1 class="PageName"> Add Collections </h1>
                        <div class="container">
                            <form class="form-horizontal" action="?action=Insert" method="POST" enctype="multipart/form-data">
                                <div class="form-group insertInput">
                                    <div class="m-auto">
                                        <input type="text" name="Collection" placeholder="Collection Name" class="form-control" required="required" />
                                    </div>
                                </div>
                                <div class="form-group insertInput">
                                    <div class="mb-20">
                                        <input type="file" style="padding: 4px;" name="Image" class="form-control" />
                                    </div>
                                </div>
                                <div class="form-group insertInput">
                                    <div class="mb-20">
                                        <textarea name="Description" placeholder="Description" class="form-control" rows="3"></textarea>
                                    </div>
                                </div>  
                                <div class="form-group insertInput mb-0">
                                    <div class="mb-20">
                                        <select name="Category" class="custom-select" >
                                            <option value="0"> Category .. </option>
                                            <?php
                                            $SelectQuery = "SELECT * FROM collectionscategories ";
                                            $Select = mysqli_query($con, $SelectQuery);
                                            $fetchquery = mysqli_fetch_assoc($Select);
                                            foreach ($Select as $Category) {
                                                echo "<option value='" . $Category['ID'] . "' >" . $Category['Category'] . " </option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  
                                <div class="form-group insertInput">
                                    <div class="m-auto">
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
                                <div class="form-group CheckBoxesPanel">
                                    <div class='CheckBoxDiv'>
                                        <div>
                                            <span> Show On Pyrmaids Home </span>
                                        </div>
                                        <label>
                                            <input type="checkbox" name="ShowOnPyramids" class="toggle-checkbox" value="1" />
                                            <div class="toggle-switch"></div>
                                        </label>
                                    </div>
                                    <div class='CheckBoxDiv'>
                                        <div>
                                            <span> Show On Museum Home </span>
                                        </div>
                                        <label>
                                            <input type="checkbox" name="ShowOnMuseum" class="toggle-checkbox" value="1" />
                                            <div class="toggle-switch"></div>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="InsertButton">
                                        <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                        <a href="./Collections.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                                    </div>
                                </div>
                            
                            </form>
                        </div>
                    <?php
            }elseif($do == "Insert"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                    $Collection =  mysqli_real_escape_string($con , $_POST['Collection']);
                    $Description =  mysqli_real_escape_string($con , $_POST['Description']);
                    $PlaceID      = $_POST['Place'];
                    $CategoryID      = $_POST['Category'];

                    $image        = $_FILES['Image']['name'];
                    $folder       = "Images\Uploads\\".$image;

                    if(!isset($_POST['ShowOnPyramids'])){
                        $ShowOnPyramids = NULL ;
                    }else{
                        $ShowOnPyramids = $_POST['ShowOnPyramids'];
                    }
                    if(!isset($_POST['ShowOnMuseum'])){
                        $ShowOnMuseum = NULL ;
                    }else{
                        $ShowOnMuseum = $_POST['ShowOnMuseum'];
                    }


                    if (isset($image)) {
                        $imageName = $_FILES['Image']['name'];
                        $imageType = $_FILES['Image']['type'];
                        $imageTmp = $_FILES['Image']['tmp_name'];
                        move_uploaded_file($imageTmp,$folder);              
                    }


                    $FormErrors = array();

                    if (empty($Collection)) {
                        $FormErrors[] = "The Collection Should Have a Name";
                    }
                    if (empty($Description)) {
                        $FormErrors[] = "You Must Type a Description";
                    }
                    if (empty($image)) {
                        $FormErrors[] = "You Must Insert an Image ";
                    }
                    if ($PlaceID == 0) {
                        $FormErrors[] = "You Must Select a Correct Place to show the Collection";
                    }
                    if ($CategoryID == 0) {
                        $FormErrors[] = "You Must Select a Correct Category to the Collection";
                    }
                    if (!preg_match ("/^[a-zA-z]*$/", $Collection) ) {  
                        $FormErrors[] = "Only alphabets and whitespace are allowed For The Collection Name";  
                    }

                    if (empty($FormErrors)) {

                        $InsertQuery = "INSERT INTO `collections` Values( Null , '$Collection' , '$image' , '$Description' , $PlaceID , $CategoryID , '$ShowOnPyramids' , '$ShowOnMuseum')";
                        $Insert = mysqli_query($con, $InsertQuery);
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-success txt-center'> Collection Added Successfully </div>";
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                        
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                        }
                    }
                } 
            }elseif($do == "Edit"){

                $CollectionID = isset($_GET['CollectionID']) && is_numeric($_GET['CollectionID']) ? intval($_GET['CollectionID']) : 0;
                if(empty($CollectionID)){
                    echo "<div class='NoData'>";
                        echo "<p> ID is Empty !</p>";
                    echo "</div>";
                }else{
                    $SelectQuery = "SELECT collections.* ,  place.Name AS PlaceName , place.ID AS PlaceID , collectionscategories.Category AS CatName FROM collections 
                                    JOIN place ON collections.PlaceID = place.ID
                                    JOIN collectionscategories ON collections.CatID = collectionscategories.ID 
                                    WHERE collections.ID = $CollectionID ";
                    $Select = mysqli_query($con, $SelectQuery);
                    $row = mysqli_fetch_assoc($Select);
                    $count = mysqli_num_rows($Select);
                    if(isset($row['ID'])){

                    ?>
                    <h1 class="PageName"> Edit Collection</h1>
                            <div class="container">
                                <form class="form-horizontal" action="?action=Update" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="CollectionID" value="<?php echo $CollectionID; ?>">
                                    <div class="form-group insertInput">
                                        <label class="mt-20 control-label">Collection</label>
                                        <div class="m-auto">
                                            <input type="text" name="Collection" class="form-control" required="required" value="<?php echo $row['Collection'] ?>"/>
                                        </div>
                                    </div>
                                    <div class="form-group insertInput">
                                        <label class=" control-label">Image</label>
                                        <div class="m-auto">
                                        <input type="file" style="padding: 4px;" name="Image" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="form-group insertInput">
                                        <label class="mt-20 control-label">Description</label>
                                        <div class="m-auto">
                                            <textarea name="Description" class="form-control" required="required"><?php echo $row['Description'] ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group insertInput mb-0">
                                        <label class="mt-20 control-label">Category</label>
                                        <div class="mb-20">
                                            <select name="Category" class="custom-select" >
                                                <option value="<?php echo $row['CatID'] ?>"> <?php echo $row['CatName'] ?> </option>
                                                <?php
                                                $SelectQuery = "SELECT * FROM collectionscategories ";
                                                $Select = mysqli_query($con, $SelectQuery);
                                                $fetchquery = mysqli_fetch_assoc($Select);
                                                foreach ($Select as $Category) {
                                                    echo "<option value='" . $Category['ID'] . "' >" . $Category['Category'] . " </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="form-group insertInput">
                                        <label class="mt-20 control-label">Place</label>
                                        <div class="m-auto">
                                            <select name="Place" class="custom-select">
                                                <option value="<?php echo $row['PlaceID'] ?>"> <?php echo $row['PlaceName'] ?> </option>
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
                                    <div class="form-group CheckBoxesPanel">
                                        <div class='CheckBoxDiv'>
                                            <div>
                                                <span> Show On Pyrmaids Home </span>
                                            </div>
                                            <label>
                                                <input type="checkbox" name="ShowOnPyramids" class="toggle-checkbox" value="1" <?php if(isset($row['ShowOnPyramidsHome']) && $row['ShowOnPyramidsHome'] != 0 ){echo "Checked";} ?> />
                                                <div class="toggle-switch"></div>
                                            </label>
                                        </div>
                                        <div class='CheckBoxDiv'>
                                            <div>
                                                <span> Show On Museum Home </span>
                                            </div>
                                            <label>
                                                <input type="checkbox" name="ShowOnMuseum" class="toggle-checkbox" value="1" <?php if(isset($row['ShowOnMuseumHome']) && $row['ShowOnMuseumHome'] != 0 ){echo "Checked";} ?>/>
                                                <div class="toggle-switch"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="InsertButton">
                                            <input type="submit" value="Update" class="btn btn-success btn-md" />
                                            <a href="./Collections.php?action=Delete&CollectionID=<?php echo $CollectionID ?>" class="btn btn-danger">Remove</a>
                                        </div>
                                        <div class="InsertButton">
                                        <a href="./Collections.php?action=Manage" class="btn btn-primary btn-md w-10 alig txt-center"> Cancel </a>
                                    </div>
                                        </div>
                                </form>
                            </div>
                            <?php
                    }else{
                        echo "<div class='NoData'>";
                            echo "<p>Collection Does Not Exist </p>";
                        echo "</div>";
                    }
                }
            }elseif($do == "Update"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

                        $Collection   =  mysqli_real_escape_string($con , $_POST['Collection']);
                        $Description  =  mysqli_real_escape_string($con , $_POST['Description']);
                        $CollectionID = $_POST['CollectionID'];
                        $PlaceID      = $_POST['Place'];
                        $CategoryID   = $_POST['Category'];

                        $image        = $_FILES['Image']['name'];
                        $folder       = "Images\Uploads\\".$image;
                        if(!isset($_POST['ShowOnPyramids'])){
                            $ShowOnPyramids = NULL ;
                        }else{
                            $ShowOnPyramids = $_POST['ShowOnPyramids'];
                        }
                        if(!isset($_POST['ShowOnMuseum'])){
                            $ShowOnMuseum = NULL ;
                        }else{
                            $ShowOnMuseum = $_POST['ShowOnMuseum'];
                        }

                        if (isset($image)) {
                            $imageName = $_FILES['Image']['name'];
                            $imageType = $_FILES['Image']['type'];
                            $imageTmp = $_FILES['Image']['tmp_name'];
                            move_uploaded_file($imageTmp,$folder);              
                        }

                        $FormErrors = array();

                        if (empty($Collection)) {
                            $FormErrors[] = "The Collection Should Have a Name";
                        }
                        if (empty($Description)) {
                            $FormErrors[] = "The Description Should not be empty";
                        }
                        if ($PlaceID == 0) {
                            $FormErrors[] = "You Must Select a Correct Place For The Collection";
                        }
                        if (empty($image)){
                            $FormErrors[] = "You Must Enter a image For The Collection";
                        }
                        if (!preg_match ("/^[a-zA-z]*$/", $Collection) ) {  
                            $FormErrors[] = "Only alphabets and whitespace are allowed For The Collection Name";  
                        }
                        
                        if (empty($FormErrors)) {

                            $UpdateQuery = "UPDATE `collections` SET Collection = '$Collection' , Image = '$image' , Description = '$Description' , PlaceID = $PlaceID , CatID = $CategoryID , ShowOnPyramidsHome = '$ShowOnPyramids' , ShowOnMuseumHome = '$ShowOnMuseum' WHERE ID = $CollectionID ";
                            $Update = mysqli_query($con, $UpdateQuery);
                            echo "<div class='container'>";
                            $TheMsg = "<div class='alert alert-success txt-center'> Collection Updated Successfully </div>";
                            RedirectIndex($TheMsg, "Back");
                            echo "</div>";
                            
                        }else{
                            foreach ($FormErrors as $error) {
                                echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                            }
                        }

                    

                } 
            }elseif($do == "Delete"){
                $CollectionID = isset($_GET['CollectionID']) && is_numeric($_GET['CollectionID']) ? intval($_GET['CollectionID']) : 0;

                $Check = "SELECT * FROM collections WHERE ID = $CollectionID";
                $CheckCollection = mysqli_query($con, $Check);

                if ($Check > 0) {

                    $DeleteQuery = "DELETE FROM collections WHERE ID = $CollectionID ";
                    $Delete = mysqli_query($con, $DeleteQuery);
                    header("Location:./Collections.php?action=Manage");
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-success txt-center'>"  . "Deleted Successfully" . '</div>';
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                } else {
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-danger txt-center'>" . "Error" . "</div>";
                    RedirectIndex($TheMsg);
                    echo "</div>";
                }
            }elseif($do == "CheckAll"){
                $CollectionSelect = "SELECT collections .* , place.Name AS PlaceName FROM collections JOIN place ON collections.PlaceID = place.ID ";
                $SelectQuery = mysqli_query($con , $CollectionSelect);
                $row = mysqli_fetch_assoc($SelectQuery);
                $count = mysqli_num_rows($SelectQuery);
                if($count > 0 ){
                    ?>
                            <h1 class="PageName">Arts</h1>
                                <div class="container">
                                <div class="input-group md-form form-sm form-2 pl-0 mb-20">
                                    <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." id="myInput" onkeyup="myFunction()" aria-label="Search">
                                    <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                                </div>
                                    <div class="table-responsive">
                                        <table class="main-table table table-bordered table-hover" id="myTable">
                                            <tr>
                                                <td>ID</td>
                                                <td>Collection</td>
                                                <td>Image</td>
                                                <td>Description</td>
                                                <td>Located In</td>
                                                <td>Actions</td>
                                            </tr>
                                            <?php
                                            foreach ($SelectQuery as $Collection) {

                                                echo "<tr id='TableData'>";
                                                    echo "<td>" . $Collection['ID']     . "</td>";
                                                    echo "<td>" . $Collection['Collection']   . "</td>";
                                                    echo "<td> <img src='./Images/".$Collection['Image']."' width='100px'/></td>";
                                                    echo "<td>" . $Collection['Description']   . "</td>";
                                                    echo "<td>" . $Collection['PlaceName']   . "</td>";
                                                    echo "<td>" ;
                                                                if($AdminRole == 3){
                                                                    echo "<button class='btn btn-success' disabled>Edit</button>";
                                                                    echo "<button class='btn btn-danger' disabled>Remove</button>";
                                                                }else{
                                                                    echo "<div class='tableButtons'>";
                                                                        echo "<a href='./Collections.php?action=Edit&CollectionID=". $Collection['ID']."' class='btn btn-success'>Edit</a>";
                                                                        echo "<a href='./Collections.php?action=Delete&CollectionID=". $Collection['ID']."' class='btn btn-danger'>Remove</a>";
                                                                    echo "</div>";
                                                                }
                                                    echo "</td>";
                                                echo "</tr>";
                                            } ?>
                                        </table>
                                    </div>
                                </div>
                                        
                <?php }else{
                    echo "No Current Data";
                }
            }else{
                echo "<div class='container'>";
                $TheMsg = "<div class='alert alert-danger txt-center'>" . "No Page With This Name"  . "</div>";
                RedirectIndex($TheMsg);
                echo "</div>";       
            }

        }else{
            echo "<div class='container'>";
            $TheMsg = "<div class='alert alert-danger txt-center'>" . "You Are Not Authorized To Access This Platform"  . "</div>";
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