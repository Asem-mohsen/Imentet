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
  $User = mysqli_fetch_assoc($Select);
  $FullName = $User['Name'] . " " . $User['LastName']; 

}

if(isset($_SESSION['AdminID'])){
  $AdminID = $_SESSION['AdminID'];
}
if(isset($_POST['Pay'])){
  if(isset($UserID)){
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
      $TotalValue[$i] += $Price *  $Quantity; 

      $TotalFinalValue = array_sum($TotalValue);

    }

    $TotalQuantity = array_sum($_POST['Quantity']);
    $InsertQuery = "INSERT INTO visitticket VALUES(NULL , $UserID , $PlaceID , '$Date' , $Payment , $TotalQuantity , $TotalFinalValue)";
    $RunQuery = mysqli_query($con , $InsertQuery);

    $EmptyCartQuery = "DELETE FROM visitticketNotPaid WHERE UserID = $UserID";
    $RunQuery = mysqli_query($con , $EmptyCartQuery);

    header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/VisitTickets.php");
  }else{
    echo "You Must Sign In to Continue " ;
  }
}

if(isset($_POST['Confirm'])){
  if(isset($UserID)){

    $UserID = $_POST['UserID'];

    for($i = 0 ; $i < count($_POST['RoleID']) ; $i++){
      $UserID = $_POST['UserID'];
      $RoleID = $_POST['RoleID'][$i];
      $UserRole = $_POST['UserRole'];
      $Quantity = $_POST['Quantity'][$i];
      $PlaceID = 2 ;
      $Price = $_POST['Price'][$i];

      $rawdate      = htmlentities($_POST['Date']);
      $Date         = date('Y-m-d', strtotime($rawdate));

      $TotalValue[$i] = 0 ;
      $TotalValue[$i] += $Price * $Quantity ; 
      $Total  = $TotalValue[$i];

      $InsertQuery = "INSERT INTO visitticketNotPaid VALUES(NULL , $UserID , $RoleID , $Quantity , $PlaceID , '$Date' , $Total)";
      $RunQuery = mysqli_query($con , $InsertQuery);

    }

  }else{
    echo "You Must Sign In to Continue " ;
  }

}


?>
    <?php include "../NavUser.php" ;?>

      <section class="donation-form spacing">
        <div class="container">
          <div class="inner-container">
            <h3 class="donation-form__title text-center">Book your Ticket</h3>
            <ul class="nav nav-tabs donation-form__tab">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tickets">Tickets</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#contact" >Contact Details</a>
              </li>
              <?php if(isset($_SESSION['UserID'])){ ?>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#payment">Payment</a>
                </li>
              <?php } ?>
            </ul>
            <div class="tab-content">
              <!-- Tickets -->
              <div class="tab-pane show active animated fadeInUp" id="tickets">
                <form method='POST'>
                  <div class="top-tabs">
                    <ul class="nav nav-tabs plan-visit__map-tab-links" role="tablist">
                      <li class="nav-item">
                        <a role="tab" data-toggle="tab" href="#egyptian" class="nav-link active">Egyptian</a>
                      </li>
                      <li class="nav-item">
                        <a role="tab" data-toggle="tab" href="#other" class="nav-link">Other Nationalities</a>
                      </li>
                    </ul>
                    <div class="select-date">
                        <div>
                          <i class="fa fa-calendar-o"></i> Select Date
                        </div>
                        <div id="searchByDate-tab" class="event-sorting__tab-content tab-pane animated fadeInUp">
                          <input type="text" name="Date" class="searchByDate-datepicker" value="<?php echo $Date ?>" readonly />                        
                        </div>
                    </div>
                  </div>
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
                                          <input type="hidden" name="UserRole[]" value="<?php if(isset($_SESSION['UserID'])){ echo $Visit['UserRole'] ;} ?>">
                                          <input type="hidden" name="RoleID[]" value="<?php if(isset($_SESSION['UserID'])){ echo $Visit['RoleID'] ;} ?>">
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
                                Next
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
                                        <input type="hidden" name="UserID" value="<?php if(isset($_SESSION['UserID'])){ echo $UserID ;} ?>">
                                          <h3 class="prod-title padd-top-20">
                                            <?php echo $VisitForegin['UserRole'] ?>
                                          </h3>
                                          <input type="hidden" name="UserRole[]" value="<?php if(isset($_SESSION['UserID'])){ echo $VisitForegin['UserRole'] ;} ?>">
                                          <input type="hidden" name="RoleID[]" value="<?php if(isset($_SESSION['UserID'])){ echo $VisitForegin['RoleID'] ;} ?>">
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
                              <button type="submit" name="Confirm" class="thm-btn cart-update__btn cart-update__btn-three">
                                Next
                              </button>
                            </div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane animated fadeInUp" id="third-floor">
                      <div class="plan-visit__map-content">
                        <img class="img-fluid" src="images/resources/int-map.jpg" alt="Awesome Image"/>
                      </div>
                    </div>
                  </div>
                </form>
              </div>

              <!-- Contact -->
              <div class="tab-pane animated fadeInUp" id="contact">
                <form method='POST' action="" class="donation-form__form">
                    <div class="row">
                      <div class="col-md-6">
                        <div class="donation-form__form-field">
                          <input type="text" name="FirstName" placeholder="First Name" value="<?php if(isset($_SESSION['UserID'])){ echo $User['Name'] ;}?>" />
                          <input type="hidden" name="UserID" value="<?php if(isset($_SESSION['UserID'])){ echo $UserID ; } ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="donation-form__form-field">
                          <input type="text" name="LastName" placeholder="Last Name" value="<?php if(isset($User['LastName'])){ echo $User['LastName'] ;}?>"/>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="donation-form__form-field">
                          <input type="email" name="Email" placeholder="Your Email Address" value="<?php if(isset($User['Email'])){ echo $User['Email'] ;}?>" />
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="donation-form__form-field">
                          <input type="number" name="Phone" placeholder="Your Phone Number" value="<?php if(isset($User['Phone'])){ echo "0". $User['Phone'] ;}?>" />
                        </div>
                      </div>
                      <?php if(isset($_SESSION['UserID'])){ ?>
                        <div class="col-lg-12">
                          <div class="text-center">
                            <button type="submit" class="thm-btn donation-form__form-btn" >
                              Next
                            </button>
                          </div>
                        </div>
                      <?php }else{ ?>
                        <div class="col-lg-12">
                        <div class="text-center">
                          <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php" class="thm-btn donation-form__form-btn" >
                            Sign In To Continue
                          </a>
                        </div>
                      </div>
                    <?php } ?>
                    </div>
                </form>
              </div>
              
              <!-- Payment -->
            <?php if(isset($_SESSION['UserID'])){ ?>
              <div class="tab-pane animated fadeInUp" id="payment">
                <form method="POST" class="donation-form__form">
                  <div class="row">
                    <div class="col-md-12">
                      <h3>Payment Summary</h3>
                      <div class="table-outer table-responsive">
                        <table class="cart-table custom">
                          <thead class="cart-header">
                            <tr>
                              <th>Name</th>
                              <th>Phone Number</th>
                              <th>Email</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td><?php if(isset($_SESSION['UserID'])){ echo $FullName ;}?></td>
                              <input type="hidden" name="UserID" value="<?php if(isset($_SESSION['UserID'])){ echo $UserID ;}?>">
                              <td><?php if(isset($_SESSION['UserID'])){ echo "0". $User['Phone'] ;}?></td>
                              <td><?php if(isset($_SESSION['UserID'])){ echo $User['Email'] ;}?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <br />
                    <!-- Cart -->
                    <?php 
                        $SelectData = "SELECT visitticketnotpaid .* , userrole.RoleName, visitpricing.MuseumFee AS Price FROM `visitticketnotpaid` 
                                      JOIN userrole ON userrole.ID = visitticketnotpaid.UserRoleID 
                                      JOIN visitpricing ON userrole.ID = visitpricing.UserRole
                                      WHERE UserID = $UserID AND Quantity > 0 AND MuseumFee > 0";
                        $RunQuery = mysqli_query($con , $SelectData);
                        $FetchRow = mysqli_fetch_assoc($RunQuery);
                        $Count = mysqli_num_rows($RunQuery);
                    
                    ?>
                    <div class="col-md-12 mt-8">
                      <h3>Your Cart</h3>
                      <p>Selected ticket date : <?php if(isset($FetchRow['Date'])){echo $FetchRow['Date'] ;} ?></p>
                        <input type="hidden" name="Date" value="<?php if(isset($FetchRow['Date'])){echo $FetchRow['Date'] ;}?>">
                      <div class="table-outer table-responsive">
                        <table class="cart-table custom">
                          <thead class="cart-header">
                            <tr>
                              <th class="prod-column">Type</th>
                              <th class="price">Price</th>
                              <th>Quantity</th>
                              <th>Subtotal</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            <?php 
                            if($Count > 0){
                              foreach($RunQuery as $Data){ ?>
                                <tr>
                                  <td><?php if(isset($Data['RoleName'])){ echo $Data['RoleName'] ;} ?></td>
                                  <td><?php if(isset($Data['Price'])){ echo $Data['Price'] ;} ?></td>
                                  <input type="hidden" name="Price[]" value="<?php if(isset($Data['Price'])){ echo $Data['Price'] ;}?>">
                                  <td class="qty"><?php if(isset($Data['Quantity'])){ echo $Data['Quantity'] ;} ?></td>
                                  <input type="hidden" name="Quantity[]" value="<?php if(isset($Data['Quantity'])){ echo $Data['Quantity'] ;} ?>">
                                  <td class="sub-total"> <?php if(isset($Data['Total'])){ echo $Data['Total'] ;}  ?> </td>
                                </tr>
                              <?php }
                            } ?>
                          </tbody>
                        </table>
                        <div class="cart-total custom-cart-total">
                          <button type="submit" name="Pay" class="thm-btn cart-update__btn cart-update__btn-three">
                            Pay Now
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
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

      <?php  include "../UserFooter.php" ;?>
