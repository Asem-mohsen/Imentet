<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Payment";

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
                  echo "<div class='alert alert-success'>";
                      echo "You are joined ";
                  echo "</div>";
                }else{
                    echo "not yet";
                }
            }else{
              foreach($FormErrors as $Error){
                echo "<div class='alert alert-danger'>";
                  echo $Error ; 
                echo "</div>";
              }
            }
            
          }

          if(isset($_POST['Cancel'])){
            header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/MembershipDetails.php?MembershipID=" . $MembershipID . "");
            exit();
          }

        }else{
          echo "Already Enrolled Your membership will ends in " . $EndDate;
        }
    }
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

              $InsertDonate = "INSERT INTO donations (UserID , PlaceID , Amount , PaymentID) VALUES($UserID , $PlaceID , $Amount , $PaymentID )";
              $InsertQuery = mysqli_query($con , $InsertDonate);        
            }else{
              $Email  = $_POST['Email'];
              $Name   = $_POST['Name'];
              $PlaceID   = $_POST['Place'];
              $Amount = $_POST['Amount'];
              $PaymentID = 1;

              $InsertDonate = "INSERT INTO donations (Name , Email , PlaceID , Amount , PaymentID) VALUES('$Name', '$Email' , $PlaceID , $Amount , $PaymentID )";
              $InsertQuery = mysqli_query($con , $InsertDonate);

            }
          }else{
            foreach($FormErrors as $Error){
              echo "<div class='alert alert-danger'>";
                echo $Error ; 
              echo "</div>";
            }
          }
        }
        if(isset($_POST['Cancel'])){

          header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/donation.php");
          exit();
        }
    }else{
      echo "Missing Information Get back anf fill the form";
    }
  }

  // 3rd is Visit tickets
  if(isset($_GET['VisitTickets'])){

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
              $PlaceID = 2 ;
        
              $InsertQuery = "INSERT INTO visitticket VALUES(NULL , $UserID , $PlaceID , '$Date' , $Payment , $TotalQuantity , $TotalFinalValue)";
              $RunQuery = mysqli_query($con , $InsertQuery);
        
              $EmptyCartQuery = "DELETE FROM visitticketNotPaid WHERE UserID = $UserID";
              $RunQuery = mysqli_query($con , $EmptyCartQuery);
        
              header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/VisitTickets.php#payment");

            }else{
            echo "<div class='alert alert-danger'>";
              echo "You Must Book Ticket First in order to pay";
            echo "</div>";
          }
        }else{
          echo "<div class='alert alert-danger'>";
            echo "You Must Sign In to Continue " ;
          echo "</div>";
        }
      }else{
        foreach($FormErrors as $Error){
          echo "<div class='alert alert-danger'>";
            echo $Error ; 
          echo "</div>";
        }
      }
    }
    if(isset($_POST['Cancel'])){
      $EmptyCartQuery = "DELETE FROM visitticketNotPaid WHERE UserID = $UserID";
      $RunQuery = mysqli_query($con , $EmptyCartQuery);
      header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/VisitTickets.php");
      exit();
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
          $FormErrors[] = "Card Number is Required";
        }
        if(empty($CardHolder)){
          $FormErrors[] = "Card Holder Name is Required";
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
                      header("Location: ./Cart.php");
                      unset($_SESSION['cart']);
              }
          }else{
              $FormError[] = 'No Items Selected';
          }
        }else{
          foreach($FormErrors as $Error){
            echo "<div class='alert alert-danger' >";
                echo $Error ;
            echo "</div>";
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
      echo "You are not a user";
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
          $SelectCart = "SELECT * FROM eventticketcart WHERE UserID = $UserID";
          $RunQuery = mysqli_query($con , $SelectCart);
          $EventCart = mysqli_fetch_assoc($RunQuery);
          $Count = mysqli_num_rows($RunQuery);
          if($Count > 0){
              $EventID = $EventCart['EventID'];
              $Quantity = $EventCart['Quantity'];
              $Total = $EventCart['TotalPrice'];
              $Payment = 1;

              $InsertEventTicket = "INSERT INTO entertainmnetticket VALUES(NULL , $EventID , $UserID , $Total , $Payment , $Quantity )";
              $InsertQuery = mysqli_query($con , $InsertEventTicket);

              $DeleteCart = "DELETE FROM eventticketcart WHERE UserID = $UserID";
              $DeleteQuery = mysqli_query($con , $DeleteCart);
                
              if(isset($InsertQuery) && isset($DeleteQuery)){
                      header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=" . $EventID . "");
                      exit();
              }
          }else{
              $FormError[] = 'No Tickets Booked';
          }
        }else{
          foreach($FormErrors as $Error){
            echo "<div class='alert alert-danger' >";
                echo $Error ;
            echo "</div>";
          }
        }

      }

      if(isset($_POST['Cancel'])){
        $DeleteCart = "DELETE FROM eventticketcart WHERE UserID = $UserID";
        $DeleteQuery = mysqli_query($con , $DeleteCart);

        header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/events.php?Page=1");
        exit();
      }
  }
}
?>

<?php include "../NavUser.php";

?>


      <div class="payment">
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
                  <option value="2021">2021</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
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
                <input type="text" name="CCV" maxlength="3" class="cvv-input" />
              </div>
            </div>
            <input type="submit" name="Pay" value="Pay" class="submit-btn" />
            <input type="submit" name="Cancel" value="Cancel" class="submit-btn" />
          </form>
        </div>
      </div>

      <!-- /.blog-two -->
    <?php include "../UserFooter.php" ?>

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