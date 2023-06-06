<?php
ob_start();

$PageTitle = "Gift Shop";

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
    
        if($AdminRole != 4){

            $do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;

            if($do == "Manage"){
                $ShopCategory = "SELECT * FROM giftcategory " ;
                $Query = mysqli_query($con , $ShopCategory);
                $row = mysqli_fetch_row($Query);
                ?>
                <div class="page d-flex">
                    <div class="sidepar p-20 p-relative">
                        <h3 class="p-relative txt-center mt-0">Control</h3>
                        <ul>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=AddItems">
                                    <i class="fa-solid fa-plus fa-fw"></i><span> Add More Items </span>
                                </a>
                            </li>
                            <?php if($AdminRole == 2 || $AdminRole == 1 ){ ?>
                                    <li>
                                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=AddCategory">
                                        <i class="fa-brands fa-plus fa-fw"></i><span> Add Category </span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=ItemsSold">
                                        <i class="fa-solid fa-circle-dollar-to-slot fa-fw"></i><span> Items Sold </span>
                                        </a>
                                    </li>
                            <?php } ?>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=CheckAll">
                                    <i class="fa-solid fa-search fa-fw"></i><span> Check All Items </span>
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
                        <h1 class="PageName">Categories</h1>
                            <div class="GiftPage">
                                <div class="Giftboxes">
                                    <?php foreach($Query as $Category){?>
                                        <div class="box">
                                        <!-- <img src="./Images/<?php //echo $Category['Image'] ?>" alt=""> -->
                                            <div class='CatDiv'>
                                                <a href="./GiftShop.php?action=CategoryItems&CatID=<?php echo $Category['ID'] ?>&CatName=<?php echo $Category['Category'] ?>"><?php echo $Category['Category'] ?></a>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <div class="Add box">
                                            <a href="./GiftShop.php?action=AddCategory"> Add New Category</a>
                                            <i class="fa fa-plus fa-fw"></i>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                <?php
            }elseif($do == "CategoryItems"){
                $CategoryID =  filter_var($_GET['CatID'], FILTER_SANITIZE_NUMBER_INT);
                $CategoryName = $_GET['CatName'];
                if(empty($CategoryID) || empty($CategoryName)){
                    echo "<div class='NoData'>";
                        echo "<p> Category with No ID ! What a perfect idea </p>";
                    echo "</div>";
                }else{

                $SelectItems = "SELECT giftshop .* , giftcategory.Category As CatName FROM giftshop LEFT JOIN giftcategory 
                                ON giftcategory.ID = giftshop.CategoryID WHERE giftshop.CategoryID = $CategoryID ";
                $Query = mysqli_query($con, $SelectItems);
                $row = mysqli_fetch_assoc($Query);
                $count = mysqli_num_rows($Query);
                
                ?>
                <div class="page d-flex">
                    <div class="sidepar p-20 p-relative">
                        <h3 class="p-relative txt-center mt-0">Control</h3>
                        <ul>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Dashboard.php">
                                    <i class="fa-solid fa-arrow-left fa-fw"></i><span> Dashboard </span>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=AddItems">
                                    <i class="fa-solid fa-plus fa-fw"></i><span> Add More Items </span>
                                </a>
                            </li>
                            <?php if($AdminRole == 2 || $AdminRole == 1 ){ ?>
                                    <li>
                                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=ItemsSold">
                                        <i class="fa-solid fa-circle-dollar-to-slot fa-fw"></i><span> Items Sold </span>
                                        </a>
                                    </li>
                            <?php } ?>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=CheckAll">
                                    <i class="fa-solid fa-search fa-fw"></i><span> Check All Items </span>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=Manage">
                                    <i class="fa-solid fa-arrow-left fa-fw"></i><span> Categories </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="GiftShop d-grid m-aut gap-20 mt-20">
                        <h1 class='PageName'><?php echo $CategoryName?></h1>
                        <?php if($count > 0){ ?>
                            <div class="Boxes">
                                <?php foreach($Query as $Item){ ?>
                                    <div class="items bg-white rad-6 p-relative">
                                        <?php if( $Item['Quantity'] == 0 ){
                                            echo "<div class='SoldOut'>";
                                                echo "<p> Sold Out </p> ";
                                            echo "</div>" ;
                                        } ?>
                                        <img class="cover" src="./Images/<?php echo $Item['Image'] ?>">
                                        <div class="itemName">
                                            <h4 class="m-0"><?php echo $Item['Item'] ?></h4>
                                        </div>
                                        <div class="Buttom">
                                            <?php if($AdminRole == 2 || $AdminRole == 1 ){ ?>
                                                <div class="Giftbuttons">
                                                    <a href="./GiftShop.php?action=Edit&ItemID=<?php echo $Item['ID'] ?>" class="title btn-shape bg-green c-white p-10">Edit</a>
                                                        <a href="./GiftShop.php?action=DeleteItem&ItemID=<?php echo $Item['ID'] ?>" class="title btn-shape bg-red c-white p-10">Delete</a>
                                                    </div>
                                                <?php } ?>
                                                <div class="Spans">
                                                    <span class="c-gray">
                                                        Quantity : 
                                                        <?php echo $Item['Quantity'] ?>
                                                    </span>
                                                    <span class="c-gray">
                                                        <i class="fa-solid fa-dollar-sign"></i>
                                                        <?php echo $Item['Price'] ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                            </div>

                        <?php 
                            }else{ ?>
                            <?php
                                echo "<div class='NoData'>";
                                    echo "<p>No data to show </p>";
                                    echo "<a href='./GiftShop.php?action=Manage' class='btn btn-primary'> Back </a>";
                                echo "</div>";
                            }

                echo "</div>";
                echo "</div>";
                }
            }elseif($do == "ItemsSold"){
                $SelectQuery = "SELECT useritems.* , giftshop.Item AS ItemName , giftshop.Price AS ItemPrice , user.Name AS UserName , user.LastName AS LastName,  user.ID AS UserID FROM useritems 
                JOIN giftshop ON useritems.GiftShopID = giftshop.ID 
                JOIN user ON useritems.UserID = user.ID ";
                $Select = mysqli_query($con , $SelectQuery);
                $fetchquery = mysqli_fetch_row($Select);
                ?>
                <div class="page d-flex">

                    <div class="sidepar p-20 p-relative">
                        <h3 class="p-relative txt-center mt-0">Control</h3>
                        <ul>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=AddItems">
                                    <i class="fa-solid fa-plus fa-fw"></i><span> Add More Items </span>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=Manage">
                                    <i class="fa-solid fa-arrow-left fa-fw"></i><span> Categories </span>
                                </a>
                            </li>
                            <?php if($AdminRole == 2 || $AdminRole == 1 ){ ?>
                                    <li>
                                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=AddCategory">
                                        <i class="fa-brands fa-plus fa-fw"></i><span> Add Category </span>
                                        </a>
                                    </li>
                            <?php } ?>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=CheckAll">
                                    <i class="fa-solid fa-search fa-fw"></i><span> Check All Items </span>
                                </a>
                            </li>
                            <li>
                                <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Dashboard.php">
                                    <i class="fa-solid fa-arrow-left fa-fw"></i><span> Dashboard </span>
                                </a>
                            </li>
                        </ul>
                    </div>  
                    <div class="container mb-20">
                        <h1 class="PageName">Items Sold</h1>
                        <div class="input-group md-form form-sm form-2 pl-0 mb-20">
                                <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." id="myInput" onkeyup="myFunction()" aria-label="Search">
                                <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                        </div>
                        <div class="table-responsive">
                            <table class="main-table table table-bordered table-hover" id="myTable">
                                <tr>
                                    <td>#</td>
                                    <td>Buyer</td>
                                    <td>Item</td>
                                    <td>Quantity</td>
                                    <td>Price Per Unit</td>
                                    <td>Total</td>
                                </tr>

                                <?php
                                    foreach ($Select as $Items) {
                                    
                                        $TotalItem = $Items['Quantity'] * $Items['ItemPrice'];
                                        $FullName =  $Items['UserName'] . " " . $Items['LastName'];
                                        echo "<tr  id='TableData'>";
                                            echo "<td>" . $Items['ID']     . "</td>";
                                            echo "<td><a href='./Users.php?action=MoreInfo&UserID=". $Items['UserID'] ."'> " . $FullName   . "</a></td>";
                                            echo "<td>" . $Items['ItemName']  . "</td>";
                                            echo "<td>" . $Items['Quantity']  . "</td>";
                                            echo "<td>" . $Items['ItemPrice'] . "</td>";
                                            echo "<td>" . $TotalItem . "</td>";
                                        echo "</tr>";
                                    }
                                ?>
                                
                            </table>
                        </div> 
                    </div>
                <?php
            }elseif($do == "CheckAll"){
                $SelectQuery = "SELECT giftshop.* , giftcategory.Category AS CategoryName FROM giftshop 
                JOIN giftcategory ON giftshop.CategoryID = giftcategory.ID 
                ";
                $Select = mysqli_query($con , $SelectQuery);
                $fetchquery = mysqli_fetch_row($Select);
                
                ?>  
                <h1 class="PageName"> All Items </h1>
                <div class="container mb-20">
                        <div class="input-group md-form form-sm form-2 pl-0 mb-20">
                            <input class="form-control my-0 py-1 pl-3 purple-border" type="text" placeholder="Search something here..." id="myInput" onkeyup="myFunction()" aria-label="Search">
                            <span class="input-group-addon waves-effect purple lighten-2" id="basic-addon1"><a><i class="fa fa-search white-text" aria-hidden="true"></i></a></span>
                        </div>
                    <div class="table-responsive">
                        <table class="main-table table table-bordered table-hover" id="myTable">
                            <tr>
                                <td>#</td>
                                <td>Image</td>
                                <td>Item</td>
                                <td>Quantity</td>
                                <td>Price Per Unit</td>
                                <td>Category</td>
                                <td>Actions</td>
                            </tr>
                            <?php 
                            foreach ($Select as $Items) {
                            
                                echo "<tr id='TableData'>";
                                    echo "<td>" . $Items['ID']     . "</td>";
                                    echo "<td><img src='./Images/" . $Items['Image'] . " ' class='TableImage'></td>";
                                    echo "<td>" . $Items['Item']  . "</td>";
                                    echo "<td>"; 
                                                if( $Items['Quantity'] <= 0){
                                                        echo "<div class='txt-center c-red fw-bold'>";
                                                            echo "<p> Sold Out </p> ";
                                                        echo "</div>" ;
                                                    }else{
                                                        echo $Items['Quantity'] ;
                                                    }
                                    
                                    echo "</td>";
                                    echo "<td>" . $Items['Price'] . "</td>";
                                    echo "<td>" . $Items['CategoryName'] . "</td>";
                                    echo "<td>";
                                        echo "<div class='tableButtons'>";
                                        if($AdminRole != 3){   
                                            echo "<a href='./GiftShop.php?action=Edit&ItemID="     . $Items['ID'] . "' class='btn btn-success'><i class='fa fa-edit'> </i> "       . 'Edit'  . "</a>";
                                            echo "<a href='./GiftShop.php?action=Delete&ItemID="   . $Items['ID'] . "' class='btn btn-danger confirm'><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                        }else{
                                            echo "<button class='btn btn-success' disabled><i class='fa fa-edit'> </i> "       . 'Edit'  . "</a>";
                                            echo "<button class='btn btn-danger confirm' disabled><i class='fa fa-close'> </i> "   . 'Delete' . "</a>";
                                        }
                                            echo "</div>";
                                    echo "</td>";
                                echo "</tr>";
                            }

                            ?>
                            
                        </table>
                    </div>
                </div>
                <?php
            }elseif($do == "Edit"){

                $ItemID =  filter_var($_GET['ItemID'], FILTER_SANITIZE_NUMBER_INT);
                if(empty($ItemID)){
                    echo "<div class='NoData'>";
                        echo "<p>Sorry, We don't sell Hidden Items </p>";
                    echo "</div>";
                }else{

                $SelectItems = "SELECT giftshop .* , giftcategory.Category As CatName , giftcategory.ID AS GiftCategoryID FROM giftshop 
                            LEFT JOIN giftcategory ON giftcategory.ID = giftshop.CategoryID 
                            WHERE giftshop.ID = $ItemID ";
                            
                $Query = mysqli_query($con, $SelectItems);
                $row = mysqli_fetch_assoc($Query);
                
                if(isset($row['ID'])){
                    $CategoryName = $row['CatName'];

                ?>
                    <h1 class="PageName"> Edit Item </h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=UpdateItem" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="ItemID" value="<?php echo $row['ID'] ?>">
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="text" name="Item" placeholder="Item" class="form-control" value="<?php echo $row['Item'] ?>"  required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="mb-20">
                                <input type="file" style="padding: 4px;" name="Image" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="number" name="Quantity" placeholder="Quantity" class="form-control" value="<?php echo $row['Quantity'] ?>"  required="required" />
                            </div>
                        </div>  
                        <div class="form-group insertInput">
                            <div class="mb-20">
                                <input type="number" name="Price" placeholder="Price" class="form-control" value="<?php echo $row['Price'] ?>" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                                    <div class="m-auto">
                                        <select name="Categories"  class="custom-select">
                                            <option value="<?php echo $row['CategoryID'] ?>"> <?php  echo $row['CatName']?> </option>
                                            <?php 
                                            $Select = "SELECT * FROM giftcategory";
                                            $Query = mysqli_query($con, $Select);
                                            $fetchquery = mysqli_fetch_assoc($Query);
                                                foreach($Query as $Category){?>
                                            <option value="<?php echo $Category['ID'] ?>"> <?php echo $Category['Category'] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                        </div>
                        <div class="form-group">
                            <div class="InsertButton">
                                <input type="submit" value="Update" class="btn btn-success btn-md w-10" />
                                <a href="./GiftShop.php?action=CategoryItems&CatID=<?php echo $row['GiftCategoryID'] ?>&CatName=<?php echo $CategoryName ?>" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                        
                    </form>
                </div>


                <?php
                            }else{
                                echo "<div class='NoData'>";
                                    echo "<p>Item Does Not Exist </p>";
                                echo "</div>";
                            }
                        }
            }elseif($do == "UpdateItem"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
                    $ItemID = $_POST['ItemID'];
                    $Quantity = $_POST['Quantity'];
                    $Price = $_POST['Price'];
                    $Categories = $_POST['Categories'];
                    $ItemName = mysqli_real_escape_string($con , $_POST['Item']);
                    $image = $_FILES['Image']['name'];
                    $folder = "Images\Uploads\\".$image;


                    if (isset($image)) {
                        $imageName = $_FILES['Image']['name'];
                        $imageType = $_FILES['Image']['type'];
                        $imageTmp = $_FILES['Image']['tmp_name'];
                        move_uploaded_file($imageTmp,$folder);              
                    }

                    $FormErrors = array();

                    if (empty($ItemName)) {
                        $FormErrors[] = "The Item Should Have a Name";
                    }
                    if (empty($Quantity) || $Price == 0) {
                        $FormErrors[] = "You Must Enter a Valid Quantity";
                    }
                    if (empty($Price) || $Price == 0) {
                        $FormErrors[] = "You Must Enter a Valid Price";
                    }
                    if (empty($image)){
                        $FormErrors[] = "You Must Select an Image For The Item";
                    }
                    if (!preg_match ("/^[a-zA-z]*$/", $ItemName) ) {  
                        $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                    }

                    if(empty($FormErrors)){
                    
                    $UpdateItem = "UPDATE giftshop SET Item = '$ItemName' , Image = '$image' , Quantity = $Quantity , Price = $Price , CategoryID = $Categories WHERE ID = $ItemID";
                    $Update = mysqli_query($con , $UpdateItem);
                    
                    echo "<div class='container'>";
                    $TheMsg = "<div class='alert alert-success txt-center'>"  . "Item Updated Successfully" . '</div>';
                    RedirectIndex($TheMsg, "Back");
                    echo "</div>";
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                        }
                    }
                    
                }
            }elseif($do == "AddItems"){
                ?>
                    <h1 class="PageName"> Add Item </h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=InsertItems" method="POST" enctype="multipart/form-data">
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="text" name="Item" placeholder="Item" class="form-control" required="required" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="mb-20">
                                <input type="file" style="padding: 4px;" name="Image" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="number" name="Quantity" placeholder="Quantity" class="form-control" required="required" />
                            </div>
                        </div>  
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="number" name="Price" placeholder="Price" class="form-control" required="required"  />
                            </div>
                        </div>
                        <div class="form-group insertInput">
                                    <div class="m-auto">
                                        <select name="Categories" class="custom-select">
                                            <option value="0"> Select a Category </option>
                                            <?php 
                                            $Select = "SELECT * FROM giftcategory";
                                            $Query = mysqli_query($con, $Select);
                                            $fetchquery = mysqli_fetch_assoc($Query);
                                                foreach($Query as $Category){?>
                                            <option value="<?php echo $Category['ID'] ?>"> <?php echo $Category['Category'] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                        </div>
                        <div class="form-group">
                            <div class="InsertButton">
                                <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />                           
                                <a href="./GiftShop.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                        
                    </form>
                </div>
                <?php
            }elseif($do == "InsertItems"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {        
                    $Quantity = $_POST['Quantity'];
                    $Price = $_POST['Price'];
                    $Categories = $_POST['Categories'];
                    $ItemName = mysqli_real_escape_string($con , $_POST['Item']);
                    $image = $_FILES['Image']['name'];
                    $folder = "Images\Uploads\\".$image;


                    if (isset($image)) {
                        $imageName = $_FILES['Image']['name'];
                        $imageType = $_FILES['Image']['type'];
                        $imageTmp = $_FILES['Image']['tmp_name'];
                        move_uploaded_file($imageTmp,$folder);              
                    }

                    $FormErrors = array();

                    if (empty($ItemName)) {
                        $FormErrors[] = "The Item Should Have a Name";
                    }
                    if (empty($Quantity) || $Price == 0) {
                        $FormErrors[] = "You Must Enter a Valid Quantity";
                    }
                    if (empty($Price) || $Price == 0) {
                        $FormErrors[] = "You Must Enter a Valid Price";
                    }
                    if (empty($image)){
                        $FormErrors[] = "You Must Select an Image For The Item";
                    }
                    if ($Categories == 0) {
                        $FormErrors[] = "You Must Enter a Valid Category";
                    }
                    if (!preg_match ("/^[a-zA-z]*$/", $ItemName) ) {  
                        $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                    }
                    if(empty($FormErrors)){
                        $InsertItems = "INSERT INTO `giftshop` VALUES( NULL , '$ItemName' , '$image' , $Quantity , $Price , $Categories )" ;
                        $Insert = mysqli_query($con , $InsertItems);
                        
                        echo "<div class='container'>";
                        $TheMsg = "<div class='alert alert-success txt-center'>"  . "Item Added Successfully" . '</div>';
                        RedirectIndex($TheMsg, "Back");
                        echo "</div>";
                    }else{
                        foreach ($FormErrors as $error) {
                            echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                        }
                    }
                }
            }elseif($do == "DeleteItem"){
                $ItemID = isset($_GET['ItemID']) && is_numeric($_GET['ItemID']) ? intval($_GET['ItemID']) : 0;

                                $Check = "SELECT * FROM giftshop WHERE ID = $ItemID";
                                $CheckItem = mysqli_query($con, $Check);

                                if ($Check > 0) {

                                    $DeleteQuery = "DELETE FROM giftshop WHERE ID = $ItemID ";
                                    $Delete = mysqli_query($con, $DeleteQuery);

                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-success txt-center'>"  . "Item Deleted Successfully" . '</div>';
                                    RedirectIndex($TheMsg, "Back");
                                    echo "</div>";
                                } else {
                                    echo "<div class='container'>";
                                    $TheMsg = "<div class='alert alert-danger txt-center'>" . "The Item Does Not Exist" . "</div>";
                                    RedirectIndex($TheMsg);
                                    echo "</div>";
                                }
            }elseif($do == "AddCategory"){
                ?>
                <h1 class="PageName"> Add Category </h1>
                <div class="container">
                    <form class="form-horizontal" action="?action=InsertCategory" method="POST">
                        <div class="form-group insertInput">
                            <div class="m-auto">
                                <input type="text" name="Category" placeholder="Category Name" class="form-control" autocomplete="off" required="required" />
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
                        <div class="form-group">
                            <div class="InsertButton">
                                <input type="submit" value="Add" class="btn btn-primary btn-md w-10" />
                                <a href="./GiftShop.php?action=Manage" class="btn btn-danger btn-md w-10"> Cancel </a>
                            </div>
                        </div>
                    </form>
                    <?php
            }elseif($do == "InsertCategory"){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $Category = mysqli_real_escape_string($con , $_POST['Category']);
                    $Place  = $_POST['Place'];
                
                        $FormErrors = array();
                
                        if (empty($Category)) {
                            $FormErrors[] = "Category Cannot be empty";
                        }
                        if ($Place == 0) {
                            $FormErrors[] = "You Must Select a Place";
                        }
                        if (!preg_match ("/^[a-zA-z]*$/", $Category) ) {  
                            $FormErrors[] = "Only alphabets and whitespace are allowed.";  
                        }
                
                        if(empty($FormErrors)){
                            $InsertQuery = "INSERT INTO `giftcategory` Values( Null , '$Category' , $Place)";
                            $Insert = mysqli_query($con, $InsertQuery);
                                    header("Location: ./GiftShop.php?action=Manage");            
                        }else{
                            foreach($FormErrors as $error){
                                echo "<div class='alert alert-danger txt-center'>" . $error . "</div>";
                            }
                        }
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