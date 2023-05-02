<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();
$PageTitle = "Visit Us";

$Date = date('d - M - Y');

if(isset($_SESSION['UserID'])){
  $UserID = $_SESSION['UserID'];
  $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
  $Select = mysqli_query($con, $SelectQuery);
  $row = mysqli_fetch_assoc($Select);
}

if(isset($_SESSION['AdminID'])){
  $AdminID = $_SESSION['AdminID'];

}
if(isset($_POST['Confirm']) && isset($UserID)){
  
  $UserID = $_POST['UserID'];

  for($i = 0 ; $i < count($_POST['Quantity']) ; $i++){
    $UserID = $_POST['UserID'];
    $Quantity = $_POST['Quantity'][$i];
    $Payment = 1;
    $PlaceID = 2 ;
    $Price = $_POST['Price'][$i];

    $rawdate      = htmlentities($_POST['Date']);
    $Date         = date('Y-m-d', strtotime($rawdate));

    $TotalValue[$i] = 0 ;
    $TotalValue[$i] += $Price * $Quantity ; 

    $TotalFinalValue = array_sum($TotalValue);

  }

  $TotalQuantity = array_sum($_POST['Quantity']);
  $InsertQuery = "INSERT INTO visitticket VALUES(NULL , $UserID , $PlaceID , '$Date' , $Payment , $TotalQuantity , $TotalFinalValue)";
  $RunQuery = mysqli_query($con , $InsertQuery);

}
?>

    <?php include "../NavUser.php" ;?>

      <section class="product-details">
        <form action="" method="post">
          <div class="container">
            <div class="row">
              <div class="col-lg-12">
                <div class="plan-visit__single" id="interior">
                  <div class="plan-visit__block-title">
                    <h3 class="plan-visit__block-title__title">Tickets</h3>
                    <div class="select-date">
                      <div>
                        <i class="fa fa-calendar-o"></i> Select Date
                      </div>
                      <div id="searchByDate-tab" class="event-sorting__tab-content tab-pane animated fadeInUp">
                        <input type="text" name="Date" class="searchByDate-datepicker" value="<?php echo $Date ?>" readonly />                        
                      </div>
                    </div>
                  </div>
                  <ul class="nav nav-tabs plan-visit__map-tab-links" role="tablist">
                    <li class="nav-item">
                      <a role="tab" data-toggle="tab" href="#egyptian" class="nav-link active">Egyptian</a>
                    </li>
                    <li class="nav-item">
                      <a role="tab" data-toggle="tab" href="#other" class="nav-link">Other Nationalities</a>
                    </li>
                  </ul>
                  <div class="tab-content">
                    <div class="tab-pane animated fadeInUp show active" id="egyptian">
                      <div class="plan-visit__map-content">
                        <div class="table-outer table-responsive">
                          <table class="cart-table">
                            <thead class="cart-header">
                              <tr>
                                <th class="prod-column">Type</th>
                                <th class="price">Price</th>
                                <th>Quantity</th>
                                <th>Amenities</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $SelectVisitPrice = "SELECT visitpricing. *, userrole.RoleName AS UserRole , visitpricing.UserRole AS RoleID ,place.Name AS PlaceName FROM visitpricing 
                                            JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                            JOIN place ON visitpricing.PlaceID = place.ID 
                                            WHERE PlaceID = 2 AND UserRole != 2 AND UserRole != 3 
                                            ORDER BY visitpricing.ID DESC";
                                $RunQuery = mysqli_query($con , $SelectVisitPrice);
                                $VisitRow = mysqli_fetch_assoc($RunQuery);
                                foreach($RunQuery as $Visit){ ?>
                                  <tr>
                                    <td class="prod-column" style="white-space: nowrap">
                                      <div class="column-box">
                                        <h3 class="prod-title padd-top-20">
                                          <?php echo $Visit['UserRole'] ?>
                                        </h3>
                                      </div>
                                    </td>
                                    <td class="price" style="white-space: nowrap">
                                    <?php echo $Visit['MuseumFee'] . " LE" ?>
                                    <input type="hidden" class="VisitPrice" name="Price[]" value="<?php echo $Visit['MuseumFee'] ?>">
                                    </td>
                                    <td class="qty ">
                                      <input class="quantity-spinner Quantity" max='10' min="0" type="number" value="0" name="Quantity[]" onchange="subTotal()" />
                                    </td>
                                    <td>
                                      <div class="amenities-list">
                                        <p class="login-form__checkbox">
                                          <input type="checkbox" id="test1" name="radio-group" />
                                          <label for="test1">Wheelchair</label>
                                        </p>

                                        <p class="login-form__checkbox">
                                          <input type="checkbox" id="test2" name="radio-group" />
                                          <label for="test2">Sunscreen</label>
                                        </p>
                                      </div>
                                    </td>
                                    <td class="SubTotal"></td>
                                  </tr>
                                <?php } ?>
                            </tbody>
                          </table>

                          <div class="cart-total custom-cart-total">
                            <h3 class="cart-total__text text-uppercase">
                              Total Price:
                              <span class="text-capitalize cart-total__highlight" id="TotalPriceOne">
                                
                              </span>
                            </h3>
                            <button type="submit" name="Confirm" class="thm-btn cart-update__btn cart-update__btn-three">
                              Checkout <span>+</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane animated fadeInUp" id="other">
                      <div class="plan-visit__map-content">
                        <div class="table-outer table-responsive">
                          <table class="cart-table">
                            <thead class="cart-header">
                              <tr>
                                <th class="prod-column">Type</th>
                                <th class="price">Price</th>
                                <th>Quantity</th>
                                <th>Amenities</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                                $SelectVisitPrice = "SELECT visitpricing. *, userrole.RoleName AS UserRole , visitpricing.UserRole AS RoleID ,place.Name AS PlaceName FROM visitpricing 
                                            JOIN userrole ON visitpricing.UserRole = userrole.ID 
                                            JOIN place ON visitpricing.PlaceID = place.ID 
                                            WHERE PlaceID = 2 AND UserRole != 1 AND UserRole != 5 ";
                                $RunQuery = mysqli_query($con , $SelectVisitPrice);
                                $VisitRow = mysqli_fetch_assoc($RunQuery);
                                foreach($RunQuery as $VisitForegin){ ?>
                                  <tr>
                                    <td class="prod-column" style="white-space: nowrap">
                                      <div class="column-box">
                                      <input type="hidden" name="UserID" value="<?php if(isset($UserID)){ echo $UserID ;} ?>">
                                        <h3 class="prod-title padd-top-20">
                                          <?php echo $VisitForegin['UserRole'] ?>
                                        </h3>
                                      </div>
                                    </td>
                                    <td class="price" style="white-space: nowrap">
                                    <?php echo $VisitForegin['MuseumFee'] . " LE" ?>
                                    <input type="hidden" class="VisitPrice" name="Price[]" value="<?php echo $Visit['MuseumFee'] ?>">
                                    </td>
                                    <td class="qty">
                                      <input class="quantity-spinner Quantity" max='10' min="0" type="number" value="0" name="Quantity[]" onchange="subTotal()" />
                                    </td>
                                    <td>
                                      <div class="amenities-list">
                                        <p class="login-form__checkbox">
                                          <input type="checkbox" id="test1" name="radio-group" />
                                          <label for="test1">Wheelchair</label>
                                        </p>

                                        <p class="login-form__checkbox">
                                          <input type="checkbox" id="test2" name="radio-group" />
                                          <label for="test2">Sunscreen</label>
                                        </p>
                                      </div>
                                    </td>
                                    <td class="sub-total SubTotal"> </td>
                                  </tr>
                                <?php } ?>
                            </tbody>
                          </table>

                          <div class="cart-total custom-cart-total">
                            <h3 class="cart-total__text text-uppercase">
                              Total Price:
                              <span class="text-capitalize cart-total__highlight" id="TotalPriceTwo">

                              </span>
                            </h3>
                            <button type="submit" name="Confirm" class="thm-btn cart-update__btn cart-update__btn-three" >
                              Checkout <span>+</span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane animated fadeInUp" id="third-floor">
                      <div class="plan-visit__map-content">
                        <img
                          class="img-fluid"
                          src="images/resources/int-map.jpg"
                          alt="Awesome Image"
                        />
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </section>



    <script>
      var TotalPrice = 0;
      var Price = document.getElementsByClassName('VisitPrice');
      var Quantity = document.getElementsByClassName('Quantity');
      var SubTotal = document.getElementsByClassName('SubTotal');
      var FullTotalOne = document.getElementById('TotalPriceOne');
      var FullTotalTwo = document.getElementById('TotalPriceTwo');
      function subTotal(){
        TotalPrice = 0;   
          for(i=0 ; i <Price.length ; i++){

              SubTotal[i].innerText = (Price[i].value)*(Quantity[i].value) + " LE";
              TotalPrice = TotalPrice + (Price[i].value)*(Quantity[i].value);
          }
          FullTotalOne.innerText = TotalPrice;
          FullTotalTwo.innerText = TotalPrice;
      }
      subTotal(); 
    </script>
<?php include "../UserFooter.php"; ?>
