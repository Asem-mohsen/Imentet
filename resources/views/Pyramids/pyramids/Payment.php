<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Payment";
include "./NavUserPyramids.php";
  // We have 5 Trasnactions that needs payment options 

  // 1st is Membership 
  if(isset($_SESSION['UserID'])){
    $UserID = $_SESSION['UserID'] ;

    if(isset($_GET['MembershipPayment'])){

        $MembershipID = $_GET['MembershipPayment'] ;
        
        // A qeury to select the user and check if he/she already enrolled in a previous membership or not 
        $SelectUsers = "SELECT membershippayemnts .* , COUNT(UserID) AS CountedUsers FROM `membershippayemnts`  WHERE UserID = $UserID";
        $Query = mysqli_query($con , $SelectUsers);
        $CountedRow = mysqli_fetch_assoc($Query);

        $SelectCost = "SELECT * FROM membership WHERE ID = $MembershipID ";
        $Query = mysqli_query($con , $SelectCost);
        $CostRow = mysqli_fetch_assoc($Query);
        

        if($CountedRow['CountedUsers'] < 1){
          $MembershipID = $_GET['MembershipPayment'] ;
          $PaymentID = 1;
          $Cost = $CostRow['Price'];
          $Date = date('y-m-d');
          $EndDate = date('Y-m-d', strtotime($Date. ' +1 month'));
          

          if(isset($_POST['Pay'])){
            
            $CardNumber = $_POST['CardNumber'];
            $CardHolder = $_POST['CardHolder'];
            $CCV = $_POST['CCV'];

            $FormErrors= array() ;
            if(empty($CardNumber) || strlen($CardNumber) != 16 ){
              $FormErrors[] = "Card Number is Required";
            }
            if(empty($CardHolder)){
              $FormErrors[] = "Card Holder Name is Required";
            }
            if (!preg_match ("/^[a-zA-z]*$/", $CardHolder) ) {  
              $FormErrors[] = "Only alphabets and whitespace are allowed.";  
            }
            if(isset($_POST['ExpMonth']) == 0 ){
              $FormErrors[] = "Expire Month is Required";
            }
            if(isset($_POST['ExpYear']) == 0 ){
              $FormErrors[] = "Expire Year is Required";
            }
            if(strlen($CCV) > 3 || empty($CCV)){
              $FormErrors[] = "CCV is Required";
            }
            if(empty($FormErrors)){
                $InsertMembership = "INSERT INTO `membershippayemnts`  VALUES( NULL , $UserID , $MembershipID , $Cost , $PaymentID , now() , '$EndDate' ) ";
                $InsertQuery = mysqli_query($con , $InsertMembership);
                if($InsertQuery){
                  header("Location: http://localhost/imentet-1/Pyramids/pyramids/MembershipDetails.php?MembershipID=" . $MembershipID . "");
                }
            }
            
          }

          if(isset($_POST['Cancel'])){
            header("Location: http://localhost/imentet-1/Pyramids/pyramids/MembershipDetails.php?MembershipID=" . $MembershipID . "");
            exit();
          }

        }
    }
  }else{
    // header('Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php');
  }

  // 2nd is Donation
  if(isset($_GET['Donations'])) { 
    
    if(isset($_POST['UserID']) && isset($_POST['Place']) && isset($_POST['Amount']) && isset($_POST['Email']) && isset($_POST['Name'])){
      
        $UserID = $_POST['UserID'];
        $PlaceID = $_POST['Place'];
        $Amount = $_POST['Amount'];
        $Email  = $_POST['Email'];
        $Name   = $_POST['Name'];

        if(isset($_POST['Pay'])){

          $CardNumber = $_POST['CardNumber'];
          $CardHolder = $_POST['CardHolder'];
          $CCV = $_POST['CCV'];

          $FormErrors= array() ;
          if(empty($CardNumber) || strlen($CardNumber) != 16 ){
            $FormErrors[] = "Card Number is Required";
          }
          if(empty($CardHolder)){
            $FormErrors[] = "Card Holder Name is Required";
          }
          if (!preg_match ("/^[a-zA-z]*$/", $CardHolder) ) {  
            $FormErrors[] = "Only alphabets and whitespace are allowed.";  
          }
          if(isset($_POST['ExpMonth']) == 0 ){
            $FormErrors[] = "Expire Month is Required";
          }
          if(isset($_POST['ExpYear']) == 0 ){
            $FormErrors[] = "Expire Year is Required";
          }
          if(strlen($CCV) > 3 || empty($CCV)){
            $FormErrors[] = "CCV is Required";
          }
          if($_POST['Place'] == 0 ){
            $FormErrors[] = "Place is Required";
          }
          if($_POST['Amount'] == 0 ){
            $FormErrors[] = "Amount is Empty ";
          }
          if(empty($_POST['Name'])){
            $FormErrors[] = "Your Name is Required";
          }
          if(empty($_POST['Email'])){
            $FormErrors[] = "Email is Required";
          }

          if(empty($FormErrors)){
            if(isset($_SESSION['UserID'])){
              $UserID = $_POST['UserID'];
              $PlaceID = $_POST['Place'];
              $Amount = $_POST['Amount'];
              $PaymentID = 1;
              
              if($Amount >= 1000000){
                $SelectMembership = "SELECT * FROM membershippayemnts WHERE UserID = $UserID";
                $SelectMembershipQuery = mysqli_query($con , $SelectMembership);
                $MembershipRow = mysqli_fetch_assoc($SelectMembershipQuery);
                $CountUsers = mysqli_num_rows($SelectMembershipQuery);
                if(!isset($MembershipRow['UserID'])){
                  $MembershipID = 12 ; 
                  $Date = date('Y-m-d');
                  $EndDate = date('Y-m-d', strtotime($Date. ' + 365 day'));
  
                  $InsertMembershipSupport = "INSERT INTO membershippayemnts (UserID , MembershipID , Cost , PaymentID , Date , EndsIn) VALUES($UserID , $MembershipID , $Amount , $PaymentID , '$Date' , '$EndDate')";
                  $InsertMembershipSupportQuery = mysqli_query($con , $InsertMembershipSupport);   
  
                  $InsertDonate = "INSERT INTO donations (UserID , PlaceID , Amount , PaymentID) VALUES($UserID , $PlaceID , $Amount , $PaymentID )";
                  $InsertQuery = mysqli_query($con , $InsertDonate);    
  
                  header("Location: http://localhost/imentet-1/Pyramids/pyramids/Donation.php?DonateWithMembership");  
                
                }else{

                  $DeleteMembership = "DELETE FROM membershippayemnts WHERE UserID = $UserID ";
                  $DeleteQuery = mysqli_query($con , $DeleteMembership);

                  $MembershipID = 12 ; 
                  $Date = date('Y-m-d');
                  $EndDate = date('Y-m-d', strtotime($Date. ' + 365 day'));
  
                  $InsertMembershipSupport = "INSERT INTO membershippayemnts (UserID , MembershipID , Cost , PaymentID , Date , EndsIn) VALUES($UserID , $MembershipID , $Amount , $PaymentID , '$Date' , '$EndDate')";
                  $InsertMembershipSupportQuery = mysqli_query($con , $InsertMembershipSupport);   
  
                  $InsertDonate = "INSERT INTO donations (UserID , PlaceID , Amount , PaymentID) VALUES($UserID , $PlaceID , $Amount , $PaymentID )";
                  $InsertQuery = mysqli_query($con , $InsertDonate);  

                  header("Location: http://localhost/imentet-1/Pyramids/pyramids/Donation.php?DonatedDone");  

                }

              }else{
                $InsertDonate = "INSERT INTO donations (UserID , PlaceID , Amount , PaymentID) VALUES($UserID , $PlaceID , $Amount , $PaymentID )";
                $InsertQuery = mysqli_query($con , $InsertDonate);    
                header("Location: http://localhost/imentet-1/Pyramids/pyramids/Donation.php?DonatedDone");
              }
            }else{
              $Email  = $_POST['Email'];
              $Name   = $_POST['Name'];
              $PlaceID   = $_POST['Place'];
              $Amount = $_POST['Amount'];
              $PaymentID = 1;

              $InsertDonate = "INSERT INTO donations (Name , Email , PlaceID , Amount , PaymentID) VALUES('$Name', '$Email' , $PlaceID , $Amount , $PaymentID )";
              $InsertQuery = mysqli_query($con , $InsertDonate);
              header("Location: http://localhost/imentet-1/Pyramids/pyramids/Donation.php?DonatedDone");


            }
          }
        }
        if(isset($_POST['Cancel'])){

          header("Location: http://localhost/imentet-1/Pyramids/pyramids/Donation.php");
          exit();
        }
    }else{
      $MissingInfoDonations =  "<div class='alert alert-danger text-center'> Missing Information Get back anf fill the form </div>";
    }
  }

  // 3rd is Visit tickets
  if(isset($_GET['VisitTickets'])){

    if(isset($_SESSION['UserID'])){
      if(isset($_POST['Pay'])){

        $CardNumber = $_POST['CardNumber'];
        $CardHolder = $_POST['CardHolder'];
        $CCV = $_POST['CCV'];
  
        $FormErrors= array() ;
        if(empty($CardNumber) || strlen($CardNumber) != 16 ){
          $FormErrors[] = "Card Number is Required";
        }
        if(empty($CardHolder)){
          $FormErrors[] = "Card Holder Name is Required";
        }
        if (!preg_match ("/^[a-zA-z]*$/", $CardHolder) ) {  
          $FormErrors[] = "Only alphabets and whitespace are allowed.";  
        }
        if(isset($_POST['ExpMonth']) == 0 ){
          $FormErrors[] = "Expire Month is Required";
        }
        if(isset($_POST['ExpYear']) == 0 ){
          $FormErrors[] = "Expire Year is Required";
        }
        if(strlen($CCV) > 3 || empty($CCV)){
          $FormErrors[] = "CCV is Required";
        }
  
        if(empty($FormErrors)){
          if(isset($UserID)){
            $SelectCart = "SELECT visitticketNotPaid.* , SUM(Quantity) AS TotalQuantity ,  SUM(Total) AS TotalSum FROM visitticketNotPaid WHERE UserID = $UserID";
            $RunQuery = mysqli_query($con , $SelectCart);
            $VisitCart = mysqli_fetch_assoc($RunQuery);
            $Count = mysqli_num_rows($RunQuery);
            if($Count > 0){
  
                $UserID = $_POST['UserID'];
                $TotalQuantity = $VisitCart['TotalQuantity'];
                $TotalFinalValue = $VisitCart['TotalSum'];
                $rawdate      = htmlentities($VisitCart['Date']);
                $Date         = date('Y-m-d', strtotime($rawdate));
                $Payment = 1;
                $PlaceID = 1 ;
          
                $InsertQuery = "INSERT INTO visitticket VALUES(NULL , $UserID , $PlaceID , '$Date' , $Payment , $TotalQuantity , $TotalFinalValue)";
                $RunQuery = mysqli_query($con , $InsertQuery);
          
                $EmptyCartQuery = "DELETE FROM visitticketNotPaid WHERE UserID = $UserID";
                $RunQuery = mysqli_query($con , $EmptyCartQuery);
          
                header("Location: http://localhost/imentet-1/Pyramids/pyramids/VisitTickets.php?PaymentSucceeded");
              }else{
                $BookTicketFirst = "<div class='alert alert-danger text-center'> You Must Book Ticket First in order to pay </div>";
            }
          }else{
            $SignInFirst = "<div class='alert alert-danger text-center'> You Must Sign In to Continue</div>";
          }
        }
      }
      if(isset($_POST['Cancel'])){
        $EmptyCartQuery = "DELETE FROM visitticketNotPaid WHERE UserID = $UserID";
        $RunQuery = mysqli_query($con , $EmptyCartQuery);
        header("Location: http://localhost/imentet-1/Pyramids/pyramids/VisitTickets.php");
        exit();
      }
    }else{
      header('Location: http://localhost/imentet-1/Pyramids/pyramids/index.php');
    }

  }

  // 4th is Online Shopping
  if(isset($_GET['OnlineShop'])){
    if(isset($_SESSION['UserID'])){
      $UserID = $_SESSION['UserID'];

      if(isset($_POST['Pay'])){

        $CardNumber = $_POST['CardNumber'];
        $CardHolder = $_POST['CardHolder'];
        $CCV = $_POST['CCV'];

        $FormErrors= array() ;

        if(empty($CardNumber) || strlen($CardNumber) != 16 ){
          $FormErrors[] = "Card Number is Required and must be equal 16 numbers";
        }
        if(empty($CardHolder)){
          $FormErrors[] = "Card Holder Name is Required";
        }
        if (!preg_match ("/^[a-zA-z]*$/", $CardHolder) ) {  
          $FormErrors[] = "Only alphabets and whitespace are allowed.";  
        }
        if(isset($_POST['ExpMonth']) == 0 ){
          $FormErrors[] = "Expire Month is Required";
        }
        if(isset($_POST['ExpYear']) == 0 ){
          $FormErrors[] = "Expire Year is Required";
        }
        if(strlen($CCV) != 3 || empty($CCV)){
          $FormErrors[] = "CCV is Required ";
        }
        if(empty($FormErrors)){
          $SelectCart = "SELECT * FROM itemscart WHERE UserID = $UserID";
          $RunQuery = mysqli_query($con , $SelectCart);
          $ShopCart = mysqli_fetch_assoc($RunQuery);
          $Count = mysqli_num_rows($RunQuery);
          if($Count > 0){
            foreach($RunQuery as $Cart){
              $ProductID = $Cart['GiftShopID'];
              $Quantity = $Cart['Quantity'];
              $Total = $Cart['Total'];
              $Payment = 1;

                $InsertGifts = "INSERT INTO useritems VALUES(NULL , $UserID , $ProductID , $Quantity , $Payment , $Total)";
                $InsertQuery = mysqli_query($con , $InsertGifts);
                
                $UpdateGifts = "UPDATE giftshop SET Quantity = Quantity-$Quantity WHERE ID = $ProductID";
                $UpdateQuery = mysqli_query($con , $UpdateGifts);

                $DeleteCart = "DELETE FROM itemscart WHERE UserID = $UserID";
                $DeleteQuery = mysqli_query($con , $DeleteCart);
                    
            }
          
              if(isset($InsertQuery) && isset($UpdateQuery) && isset($DeleteQuery)){
                      header("Location: ./Cart.php?PaymentSucceeded");
                      unset($_SESSION['cart']);
              }
          }else{
              $FormError[] = 'No Items Selected';
          }
        }

      }

      if(isset($_POST['Cancel'])){
        $DeleteCart = "DELETE FROM itemscart WHERE UserID = $UserID";
        $DeleteQuery = mysqli_query($con , $DeleteCart);
        unset($_SESSION['cart']);
        header("Location: ./Cart.php");
        exit();
      }
    }else{
      header('Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php');
    }
  }

  // 5th is Events Tickets
  if(isset($_GET['EventTicket'])){
    if(isset($_SESSION['UserID'])){
      $UserID = $_SESSION['UserID'];

      if(isset($_POST['Pay'])){

          $CardNumber = $_POST['CardNumber'];
          $CardHolder = $_POST['CardHolder'];
          $CCV = $_POST['CCV'];

          $FormErrors= array() ;

          if(empty($CardNumber) || strlen($CardNumber) != 16 ){
            $FormErrors[] = "Card Number is Required";
          }
          if(empty($CardHolder)){
            $FormErrors[] = "Card Holder Name is Required";
          }
          if (!preg_match ("/^[a-zA-z]*$/", $CardHolder) ) {  
            $FormErrors[] = "Only alphabets and whitespace are allowed.";  
          }
          if(isset($_POST['ExpMonth']) == 0 ){
            $FormErrors[] = "Expire Month is Required";
          }
          if(isset($_POST['ExpYear']) == 0 ){
            $FormErrors[] = "Expire Year is Required";
          }
          if(strlen($CCV) != 3 || empty($CCV)){
            $FormErrors[] = "CCV is Required";
          }
        if(empty($FormErrors)){
          $SelectCart = "SELECT eventticketcart.* , SUM(TotalPrice) AS Total , SUM(Quantity) AS TotalQuantity FROM `eventticketcart` WHERE UserID = $UserID";
          $RunQuery = mysqli_query($con , $SelectCart);
          $EventCart = mysqli_fetch_assoc($RunQuery);
          $Count = mysqli_num_rows($RunQuery);
          if($Count > 0){
              $EventID = $EventCart['EventID'];
              $Quantity = $EventCart['TotalQuantity'];
              $Total = $EventCart['Total'];
              $Payment = 1;

              $InsertEventTicket = "INSERT INTO entertainmnetticket VALUES(NULL , $EventID , $UserID , $Total , $Payment , $Quantity )";
              $InsertQuery = mysqli_query($con , $InsertEventTicket);

              $DeleteCart = "DELETE FROM eventticketcart WHERE UserID = $UserID";
              $DeleteQuery = mysqli_query($con , $DeleteCart);
                
              if(isset($InsertQuery) && isset($DeleteQuery)){
                      header("Location: http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=" . $EventID . "&PaymentDone");
                      exit();
              }
          }else{
              $FormError[] = 'No Tickets Booked';
          }
        }

      }

      if(isset($_POST['Cancel'])){
        $DeleteCart = "DELETE FROM eventticketcart WHERE UserID = $UserID";
        $DeleteQuery = mysqli_query($con , $DeleteCart);
        header("Location: http://localhost/imentet-1/Pyramids/pyramids/Events.php?Page=1");
        exit();
      }
    }else{
      header('Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php');
    }
  }
?>



      <div class="payment">
          <!-- Display Errors -->
          <?php
              if(isset($FormErrors)){
                foreach($FormErrors as $Error){
                  echo "<div class='alert alert-danger text-center' >";
                      echo $Error ;
                  echo "</div>";
                }
              }
              if(isset($BookTicketFirst)){ echo $BookTicketFirst ;}
              if(isset($SignInFirst)){ echo $SignInFirst ;}
              if(isset($MissingInfoDonations)){ echo $MissingInfoDonations ;}
          ?>

        <div class="container">
          <!-- Card -->
          <div class="card-container">
            <div class="front">
              <div class="image">
                <img src="images/chip.png" alt="" />
                <img src="images/visa.png" alt="" />
              </div>
              <div class="card-number-box">################</div>
              <div class="flexbox">
                <div class="box">
                  <span>card holder</span>
                  <div class="card-holder-name">full name</div>
                </div>
                <div class="box">
                  <span>expires</span>
                  <div class="expiration">
                    <span class="exp-month">mm</span>
                    <span class="exp-year">yy</span>
                  </div>
                </div>
              </div>
            </div>

            <div class="back">
              <div class="stripe"></div>
              <div class="box">
                <span>cvv</span>
                <div class="cvv-box"></div>
                <img src="images/visa.png" alt="" />
              </div>
            </div>
          </div>

          <form method="post">
            <div class="inputBox">
              <span>card number</span>
              <input type="hidden" name="UserID" value="<?php if(isset($_GET['Donations']) || isset($_GET['VisitTickets'])  && isset($_SESSION['UserID'])){ echo $UserID ; } ?>" />
              <input type="hidden" name="Place" value="<?php if(isset($_GET['Donations']) && isset($_POST['Place'])){ echo $PlaceID ; } ?>" />
              <input type="hidden" name="Amount" value="<?php if(isset($_GET['Donations'])&& isset($_POST['Amount'])){ echo $Amount ; } ?>" />
              <input type="hidden" name="Email" value="<?php if(isset($_GET['Donations']) && isset($_POST['Email'])){ echo $Email ; } ?>" />
              <input type="hidden" name="Name" value="<?php if(isset($_GET['Donations']) && isset($_POST['Name'])){ echo $Name ; } ?>" />
              
              <input type="number" name="CardNumber" maxlength="16" class="card-number-input" />
            </div>
            <div class="inputBox">
              <span>card holder</span>
              <input type="text" name="CardHolder" class="card-holder-input" />
            </div>
            <div class="flexbox">
              <div class="inputBox">
                <span>expiration mm</span>
                <select name="ExpMonth" id="" class="month-input">
                  <option value="0" selected disabled>month</option>
                  <option value="01">01</option>
                  <option value="02">02</option>
                  <option value="03">03</option>
                  <option value="04">04</option>
                  <option value="05">05</option>
                  <option value="06">06</option>
                  <option value="07">07</option>
                  <option value="08">08</option>
                  <option value="09">09</option>
                  <option value="10">10</option>
                  <option value="11">11</option>
                  <option value="12">12</option>
                </select>
              </div>
              <div class="inputBox">
                <span>expiration yy</span>
                <select name="ExpYear" id="" class="year-input">
                  <option value="0" selected disabled>year</option>
                  <option value="2024">2024</option>
                  <option value="2025">2025</option>
                  <option value="2026">2026</option>
                  <option value="2027">2027</option>
                  <option value="2028">2028</option>
                  <option value="2029">2029</option>
                  <option value="2031">2031</option>
                  <option value="2032">2032</option>
                  <option value="2033">2033</option>
                  <option value="2034">2034</option>
                </select>
              </div>
              <div class="inputBox">
                <span>cvv</span>
                <input type="number" name="CCV" maxlength="3" class="cvv-input" />
              </div>
            </div>
            <input type="submit" name="Pay" value="Pay" class="submit-btn" />
            <input type="submit" name="Cancel" value="Cancel" class="submit-btn" />
          </form>
        </div>
      </div>

    <?php include "./UserFooterPyramids.php" ?>

    <script>
      document.querySelector(".card-number-input").oninput = () => {
        document.querySelector(".card-number-box").innerText =
          document.querySelector(".card-number-input").value;
      };

      document.querySelector(".card-holder-input").oninput = () => {
        document.querySelector(".card-holder-name").innerText =
          document.querySelector(".card-holder-input").value;
      };

      document.querySelector(".month-input").oninput = () => {
        document.querySelector(".exp-month").innerText =
          document.querySelector(".month-input").value;
      };

      document.querySelector(".year-input").oninput = () => {
        document.querySelector(".exp-year").innerText =
          document.querySelector(".year-input").value;
      };

      document.querySelector(".cvv-input").onmouseenter = () => {
        document.querySelector(".front").style.transform =
          "perspective(1000px) rotateY(-180deg)";
        document.querySelector(".back").style.transform =
          "perspective(1000px) rotateY(0deg)";
      };

      document.querySelector(".cvv-input").onmouseleave = () => {
        document.querySelector(".front").style.transform =
          "perspective(1000px) rotateY(0deg)";
        document.querySelector(".back").style.transform =
          "perspective(1000px) rotateY(180deg)";
      };

      document.querySelector(".cvv-input").oninput = () => {
        document.querySelector(".cvv-box").innerText =
          document.querySelector(".cvv-input").value;
      };
    </script>

    
  </body>
</html>
