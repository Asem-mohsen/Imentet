<?php
    ob_start();

    $PageTitle = "OnlineShopping";

    include './init.php';

    session_start();
    session_regenerate_id();

$do = isset($_GET['action']) ?  $_GET['action'] : "Manage" ;
    // include "Nav.php";
    if($do == 'Manage'){  

        if(isset($_POST['add_to_cart'])){
            if(isset($_SESSION['cart'])){
                
                $session_array_id = array_column($_SESSION['cart'] , 'ItemID');
                
                if(!in_array($_GET['ItemID'] , $session_array_id)){
                    $session_array = array(
                        'ID' => $_GET['ItemID'],
                        'Item' => $_POST['Item'],
                        'Image' => $_POST['Image'],
                        'Price' => $_POST['Price'],
                        'Quantity' => $_POST['Quantity'],
                        'CategoryName' => $_POST['CategoryName'],
                    );
                    $_SESSION['cart'][] = $session_array ;
                }
            }else{
                $session_array = array(
                    'ID' => $_GET['ItemID'],
                    'Item' => $_POST['Item'],
                    'Image' => $_POST['Image'],
                    'Price' => $_POST['Price'],
                    'Quantity' => $_POST['Quantity'],
                    'CategoryName' => $_POST['CategoryName'],
                );
                $_SESSION['cart'][] = $session_array ;
            }
        }

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
                    foreach ($Select as $Items) { ?>
                    <form action="?ItemID=<?php echo $Items['ID'] ?>" method="post" enctype="multipart/form-data">
                        <?php
                        echo "<tr id='TableData'>";
                            echo "<td>" . $Items['ID']     . "</td>";
                            echo "<td><img src='./Images/" . $Items['Image'] . " ' class='TableImage'></td>";
                                echo "<input type='hidden' name='Image' value=" . $Items['Image'] . " />";
                            echo "<td>" . $Items['Item']  . "</td>";
                                echo "<input type='hidden' name='Item' value=" . $Items['Item'] . " />";
                            echo "<td>"; 
                                        if( $Items['Quantity'] <= 0){
                                                echo "<div class='txt-center c-red fw-bold'>";
                                                    echo "<p> Sold Out </p> ";
                                                echo "</div>" ;
                                            }else{
                                                echo $Items['Quantity'] ;
                                            }
                            echo "</td>";
                                echo "<input type='hidden' name='Quantity' value=" . $Items['Quantity'] . " />";
                            echo "<td>" . $Items['Price'] . "</td>";
                                echo "<input type='hidden' name='Price' value=" . $Items['Price'] . " />";
                            echo "<td>" . $Items['CategoryName'] . "</td>";
                                echo "<input type='hidden' name='CategoryName' value=" . $Items['CategoryName'] . " />";
                            echo "<td>";
                                            if($Items['Quantity'] <= 0 ){
                                                echo "<button class='btn btn-success' name='add_to_cart' disabled> Add to Cart </button>";
                                            }else{
                                                echo "<button class='btn btn-success' name='add_to_cart'> Add to Cart </button>";
                                            }
                            echo "</td>";
                        echo "</tr>";
                        ?>
                    </form>
                        <?php
                    }

                    ?>
                    
                </table>
            </div>
            <?php 
            // var_dump($_SESSION['cart']);
            ?>

        </div>
        <?php
    }elseif($do == 'Cart'){
        if(isset($_SESSION['UserID'])){
            $UserID = $_SESSION['UserID'];

            if(isset($_POST['BUY'])){
                    
                if(isset($_POST['ItemID'])){
                    
                    for($i = 0 ; $i < count($_POST['ItemID']) ; $i++){
                        $UserID = $_POST['UserID'];
                        $ProductID = $_POST['ItemID'][$i];
                        $Quantity = $_POST['Quantity'][$i];
                        $Payment = $_POST['Payment'];
                        $Total = $_POST['Total'];
                        $Price = $_POST['Price'][$i];

                        $TotalValue[$i] = 0 ;
                        $TotalValue[$i] += $Price * $Quantity ; 

                        $TotalFinalValue = array_sum($TotalValue);
                        
                        $FormError = array();

                        if($Quantity <= 0 ){
                            $FormError[] = "Quantity Cannot be Less than or Equal Zero";
                        }
                        if($Quantity > 10 ){
                            $FormError[] = "Quantity Cannot be More than 10";
                        }
                        if($Payment == 0 ){
                            $FormError[] = "Payment Cannot be Empty";
                        }

                        if(empty($FormError)){

                            $InsertGifts = "INSERT INTO useritems VALUES(NULL , $UserID , $ProductID , $Quantity , $Payment , '$TotalFinalValue')";
                            $InsertQuery = mysqli_query($con , $InsertGifts);
                            
                            $UpdateGifts = "UPDATE giftshop SET Quantity = Quantity-$Quantity WHERE ID = $ProductID";
                            $UpdateQuery = mysqli_query($con , $UpdateGifts);
                            

                        }
                        
                    }
                    if(isset($InsertQuery) && isset($UpdateQuery)){

                            echo "<div class='alert alert-success'>";
                                echo "Done";
                            echo "</div>";
                        
                    }
                }else{
                    $FormError[] = 'No Items Selected';
                }
                
                foreach($FormError as $Error){
                    echo "<div class='alert alert-danger' >";
                        echo $Error ;
                    echo "</div>";
                }
            }
        }
        ?>
        <section class="h-100 h-custom" style="background-color: #d2c9ff;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <form action="" method="post">
                                <div class="row g-0">
                                    <div class="col-lg-8">
                                        <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                            <h6 class="mb-0 text-muted" id="TotalItemsTwo"></h6>
                                        </div>
                                        <hr class="my-4">
                                        <div class="table-responsive">
                                            <table class="main-table table table-bordered table-hover" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <td>Image</td>
                                                        <td>Item</td>
                                                        <td>Quantity</td>
                                                        <td>Price</td>
                                                        <td>Total</td>
                                                        <td>Action</td>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    <?php 
                                                    
                                                    if(!empty($_SESSION['cart'])){
                                                        foreach($_SESSION['cart'] as $value){ 
                                                            $ProductID = $value['ID'];
                                                            $Select = "SELECT * FROM giftshop WHERE ID = $ProductID ";
                                                            $Query = mysqli_query($con , $Select);
                                                            $row = mysqli_fetch_assoc($Query);
                                                            ?>
                                                            <tr class="product-data">
                                                                <td>
                                                                    <input type="hidden" name="UserID" value="<?php if(isset($UserID)){echo $UserID ;} ; ?>">
                                                                    <input type="hidden" name="ItemID[]" class="ItemID" value="<?php echo $ProductID ; ?>">
                                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                                        <img src="./Images/<?php echo $row['Image'] ?>" class="rounded-3" style="width: 100px; height:100px ;" alt="">
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <h6 class="text-muted"><?php echo $value['CategoryName'] ?></h6>
                                                                    <h6 class="text-black mb-0"><?php echo $value['Item'] ?></h6>
                                                                </td>
                                                                <td>
                                                                        <div class="input-group mb-3" style="width: 80px;">
                                                                            <!-- <div class="input-group-prepend">
                                                                                <button class="input-group-text ChangeQuantity increament-btn cursor-pointer" onchange="subTotal()">+</button>
                                                                            </div> -->
                                                                                <input type="number" min="1" max="<?php echo $row['Quantity'] ?>" onchange="subTotal()" class="form-control bg-white input-quantity IQuantity" name="Quantity[]" value="1" />
                                                                            <!-- <div class="input-group-append">
                                                                                <button class="input-group-text ChangeQuantity decreament-btn cursor-pointer" onchange="subTotal()">-</button>
                                                                            </div> -->
                                                                        </div>
                                                                </td>
                                                                <td>
                                                                    <p> <?php echo $row['Price'] ; ?> </p>
                                                                    <input type="hidden" name="Price[]" class="Iprice" value="<?php echo $value['Price'] ; ?>">
                                                                </td>
                                                                <td>                                    
                                                                    <div class="subtotal Itotal">
                                                                        <h6 class="mb-0"> </h6>
                                                                    </div>
                                                                </td>
                                                                <td>                               
                                                                    <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                                        <a href="./OnlineShopping.php?action=Cart&Do=Remove&ItemID=<?php echo $value['ID'] ?>" class="text-muted"><i class="fas fa-times"></i></a>
                                                                    </div>
                                                                </td>
                                                            </tr>

                                                            <?php
                                                        } 

                                                    }else{
                                                        echo "<div class='NoData'>";
                                                            echo "<p> No Data </p>";
                                                        echo "</div>";
                                                    }
                                                        ?>
                                                <tbody>
                                            </table>
                                        </div>
                                        <form action="" method="get">
                                            <a href="./OnlineShopping.php?action=Cart&Do=RemoveAll "class="btn btn-warning">
                                                Clear All
                                            </a>
                                        </form>

                                        <hr class="my-4">
                                        <div class="pt-5">
                                            <h6 class="mb-0"><a href="./OnlineShopping.php?action=Manage" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 bg-grey">
                                        <div class="p-5">
                                            <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-4">
                                                <h5 class="text-uppercase" id='TotalItems'></h5>
                                            </div>


                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between mb-5">
                                                <h5 class="text-uppercase">Total price</h5>
                                                    <h5 id='GrandTotal'>
                                                        
                                                    </h5>
                                                    <input type="hidden" id='GrandTotal' value='' name="Total" />
                                            </div>
                                            <div class="d-flex justify-content-between mb-5">
                                                <div class="form-group insertInput">
                                                    <div class="mb-20">
                                                        <select name="Payment" class="custom-select">
                                                            <option value="0"> Payment </option>
                                                            <?php
                                                            $SelectQuery = "SELECT * FROM paymentoptions";
                                                            $Select = mysqli_query($con, $SelectQuery);
                                                            $fetchquery = mysqli_fetch_assoc($Select);
                                                            foreach ($Select as $Payment) {
                                                                echo "<option value='" . $Payment['ID'] . "' >" . $Payment['PaymentType'] . " </option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="InsertButton">
                                                    <?php if(isset($UserID)){ ?>
                                                        <input type="submit" name="BUY" value="BUY" class="btn btn-success btn-md " />
                                                    <?php }else{
                                                        echo "<a href='./SignIn.php' class='btn btn-primary'>Register</a>";
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>

        <script>

            var  GT = 0;
            var IPrice = document.getElementsByClassName('Iprice');
            var IQuantity = document.getElementsByClassName('IQuantity');
            var ITotal = document.getElementsByClassName('Itotal');
            var FinalTotal = document.getElementById('FinalTotal');
            var GrandTotal = document.getElementById('GrandTotal');
            function subTotal(){
                GT = 0;    
                for(i=0 ; i <IPrice.length ; i++){

                    ITotal[i].innerText = (IPrice[i].value)*(IQuantity[i].value);
                    GT = GT + (IPrice[i].value)*(IQuantity[i].value);
                }

                GrandTotal.innerText = GT;   

            }

            subTotal(); 

            // Count Items In Tables  And inserting it to page
            var TotalItemsTwo = document.getElementById('TotalItemsTwo');
            var TotalItems = document.getElementById('TotalItems');
            var table = document.getElementById("myTable");
            var totalRowCount = table.rows.length;
            var tbodyRowCount = table.tBodies[0].rows.length;

            TotalItems.innerText = tbodyRowCount + ' Items';
            TotalItemsTwo.innerText = tbodyRowCount + ' Items';

        </script>
        <?php

        if(isset($_GET['Do'])){
            
            if($_GET['Do'] == 'RemoveAll'){
                unset($_SESSION['cart']);
            }

            if($_GET['Do'] == 'Remove'){
                foreach($_SESSION['cart'] as $key => $value){
                    if($value['ID'] == $_GET['ItemID']){
                        unset($_SESSION['cart'][$key]);
                    }
                }
            }
        }

        ?>
        <?php 
    }
        ?>





<?php
    include "./Includes/PageContent/Footer.php";


    ob_end_flush();
?>