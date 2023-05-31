<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Cart";

if(isset($_GET['Do']) == 'Remove'){
  foreach($_SESSION['cart'] as $key => $value){
      if($value['ID'] == $_GET['ItemID']){
          unset($_SESSION['cart'][$key]);
      }
  }
}

if(isset($_POST['Back'])){
  header('Location: http://localhost/imentet-1/Pyramids/pyramids/OnlineShop.php?Page=1');
}

if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];

  if(isset($_POST['Buy'])){
      
      if(isset($_POST['ItemID'])){
          
          for($i = 0 ; $i < count($_POST['ItemID']) ; $i++){
              $UserID = $_POST['UserID'];
              $ProductID = $_POST['ItemID'][$i];
              $Quantity = $_POST['Quantity'][$i];
              $Price = $_POST['Price'][$i];

              $TotalValue[$i] = 0 ;
              $TotalValue[$i] += $Price * $Quantity ; 
              $Total  = $TotalValue[$i];

              $FormError = array();

              if($Quantity <= 0 ){
                  $FormError[] = "Quantity Cannot be Less than or Equal Zero";
              }
              if($Quantity > 10 ){
                  $FormError[] = "Quantity Cannot be More than 10";
              }

              if(empty($FormError)){

                  $InsertGifts = "INSERT INTO itemscart VALUES(NULL , $UserID , $ProductID , $Quantity , $Total)";
                  $InsertQuery = mysqli_query($con , $InsertGifts);

              }
              
          }
          if(isset($InsertQuery)){
            header('Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Payment.php?OnlineShop');
            exit();
          }
      }else{
          $FormError[] = 'No Items Selected';
      }

  }

}

?>


<?php include "./NavUserPyramids.php"; ?>

    <div class="container">
        <ul class="list-unstyled thm-breadcrumb thm-breadcrumb__two">
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a></li>
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/OnlineShop.php?Page=1">Shop</a></li>
            <li>Shopping Cart</li>
        </ul>
    </div>

    <!-- Error Display -->
    <?php
        if(isset($FormError)){
          foreach($FormError as $Error){
            echo "<div class='alert alert-danger text-center' >";
                echo $Error ;
            echo "</div>";
          }
        }

    ?>

    <!-- Cart Details -->
    <section class="cart-page">
        <div class="container">
          <form action="" method="post">
            <div class="cart-total">
                <h3 class="cart-total__text text-uppercase">Your Cart: 
                  <span class="text-capitalize" id="TotalItems"> </span>
                </h3>
                <h3 class="cart-total__text text-uppercase">Total Price: 
                  <span class="text-capitalize cart-total__highlight" id='TotalPriceOne'></span>
                </h3>
            </div>
              <div class="cart-main">
                  <div class="table-outer table-responsive">
                      <table class="cart-table" id="myTable">
                          <thead class="cart-header">
                              <tr>
                                  <th class="prod-column">Product</th>
                                  <th class="price">Price</th>
                                  <th>Quantity</th>
                                  <th>Total</th>
                                  <th>Remove</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php 
                                if(isset($_GET['PaymentSucceeded'])){
                                  echo "<div class='alert alert-success text-center'> Purchase Completed Successfully </div>";
                                }
                              ?>
                              <?php 
                                if(!empty($_SESSION['cart'])){
                                    foreach($_SESSION['cart'] as $value){ 
                                          $ProductID = $value['ID'];
                                          $Select = "SELECT * FROM giftshop WHERE ID = $ProductID ";
                                          $Query = mysqli_query($con , $Select);
                                          $row = mysqli_fetch_assoc($Query);
                                      ?>
                                      <tr>

                                          <td class="prod-column">
                                              <input type="hidden" name="UserID" value="<?php if(isset($UserID)){echo $UserID ;} ; ?>">
                                              <input type="hidden" name="ItemID[]" class="ItemID" value="<?php echo $ProductID ; ?>">
                                              <div class="column-box">
                                                  <figure class="prod-thumb">
                                                    <a href="http://localhost/imentet-1/Pyramids/pyramids/ProductDetails.php?ItemID=<?php echo $value['ID'] ?>">
                                                      <img src="images/<?php echo $row['Image'] ?>" width="100px" height="100px" style="padding-right:20px;" alt="">
                                                    </a>
                                                  </figure>
                                                  <h3 class="prod-title padd-top-20"><?php echo $value['Item'] ?></h3>
                                              </div>
                                          </td>
                                          <td class="price">
                                            <?php echo $row['Price'] ; ?>
                                            <input type="hidden" name="Price[]" class="VisitPrice" value="<?php echo $value['Price'] ; ?>">
                                          </td>
                                          <td class="qty">
                                            <input class="quantity-spinner Quantity" onchange="subTotal()" type="number" min="1" max="<?php echo $row['Quantity'] ?>"  value="1" name="Quantity[]">
                                          </td>
                                          <td class="sub-total SubTotal"></td>
                                          <td class="remove">
                                            <a href="http://localhost/imentet-1/Pyramids/pyramids/Cart.php?Do=Remove&ItemID=<?php echo $value['ID'] ?>" class="remove-btn">
                                              <span class="egypt-icon-remove"></span> 
                                            </a>
                                          </td>
                                      </tr>
                                  <?php } 
                                } ?>
                          </tbody>
                      </table>
                  </div>
              </div>
            <div class="cart-update">
                <div class="row justify-content-between">
                    <div class="col-lg-6">
                        
                    </div>
                    <div class="col-lg-5">
                      <form action="" method="post">
                        <div class="cart-update__button-box">
                            <button type="submit" name='Back' class="thm-btn cart-update__btn cart-update__btn-two">Update Cart </button>
                          <?php if(isset($_SESSION['UserID'])){ ?>
                              <button type="submit" name='Buy' class="thm-btn cart-update__btn cart-update__btn-three">Checkout <span>+</span></button>
                          <?php }elseif(isset($_SESSION['AdminID'])){ ?>
                              <button disabled class="thm-btn cart-update__btn cart-update__btn-three">Not Authorized</button>
                          <?php }else{ ?>
                              <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php" class="thm-btn cart-update__btn cart-update__btn-three">Sign In to Continue</a>
                          <?php  } ?>
                        </div>
                      </form>
                    </div>
                </div>
            </div>
          </form>
        </div>
    </section>

    <!-- Success Msg -->
    <?php if(isset($_GET['PaymentSucceeded'])){ ?>
      <div id="success" class="modal fade" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <button
                type="button"
                class="close"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
              <div class="success-content-message">
                <i class="fa fa-check"></i>
                <h2>success</h2>

                <p>Your payment has been completed successfully.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php  } ?>

    <script>
      var TotalPrice = 0;
      var Price = document.getElementsByClassName('VisitPrice');
      var Quantity = document.getElementsByClassName('Quantity');
      var SubTotal = document.getElementsByClassName('SubTotal');
      var FullTotalOne = document.getElementById('TotalPriceOne');
      function subTotal(){
        TotalPrice = 0;   
          for(i=0 ; i <Price.length ; i++){

              SubTotal[i].innerText = (Price[i].value)*(Quantity[i].value) + " LE";
              TotalPrice = TotalPrice + (Price[i].value)*(Quantity[i].value);
          }
          FullTotalOne.innerText = TotalPrice;
      }
      subTotal(); 


      // Count Items In Tables  And inserting it to page

        var TotalItems = document.getElementById('TotalItems');
        var table = document.getElementById("myTable");
        var totalRowCount = table.rows.length;
        var tbodyRowCount = table.tBodies[0].rows.length;

        TotalItems.innerText = tbodyRowCount + ' Items';
        
    </script>

<?php include "./UserFooterPyramids.php" ; ?>

    <script>
      jQuery(window).load(function () {
        jQuery("#success").modal("show");
      });
    </script>