<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Online Shop";

// Pagination 
$RecoedPerPage = 12 ;
$Page = '';
if(isset($_GET['Page'])){
  $Page = $_GET['Page'];
}else{
  $Page = 1 ;
}
$StartFrom = ($Page-1) * $RecoedPerPage ;

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
              'CatID' => $_POST['CatID'],
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
          'CatID' => $_POST['CatID'],
      );
      $_SESSION['cart'][] = $session_array ;
  }
}

  // Sorting 

if(isset($_POST['Search'])){

  if($_POST['Sort'] == 'ASC'){
      $SortValue = 'ASC';
      $QuantityValue = 'ASC';
  }elseif($_POST['Sort'] == 'DESC'){
      $SortValue = 'DESC';
      $QuantityValue = 'ASC';
  }elseif($_POST['Sort'] == 1 ){
      $QuantityValue = 'DESC';
      $SortValue = "ASC" ;
      $QuantityDone = 1 ;
  }else{
    $DefultSearch = 1 ;
    $SortValue = 'ASC';
    $QuantityValue = 'ASC';

  }

}else{
  $DefultSearch = 1 ;
  $QuantityValue = 'ASC';
  $SortValue = 'ASC';

}

  $SelectProducts = "SELECT giftshop.* , giftcategory.Category AS CategoryName FROM giftshop 
                    JOIN giftcategory ON giftshop.CategoryID = giftcategory.ID 
                    ORDER BY Price $SortValue , giftshop.Quantity $QuantityValue
                    LIMIT $StartFrom , $RecoedPerPage 
                    ";
  $RunQuery = mysqli_query($con , $SelectProducts);
  $fetchquery = mysqli_fetch_row($RunQuery);
  $Count = mysqli_num_rows($RunQuery);

  $SelectoCount = "SELECT * FROM giftshop " ;
  $ToCount = mysqli_query($con , $SelectoCount);
  $fetchquery = mysqli_fetch_row($RunQuery);
  $TotalItemsCount = mysqli_num_rows($ToCount);

?>


    <?php include "./NavUserPyramids.php" ?>

      <section class="inner-banner" style="background-image: url(./images/Background/inner-banner-bg-2-2.png)">
        <div class="container">
          <h2 class="inner-banner__title">Official Shop</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a></li>
            <li>Store</li>
          </ul>
        </div>
      </section>

      <!-- Sorting -->
      <div class="product-sorting">
        <div class="container">
        <form method="post">
          <div class="inner-container">
            <div>
            <select class="selectpicker" id='SelectSort' name="Sort">
              <option <?php if(isset($DefultSearch) == 1 ){echo "selected" ;} ?> >Default Sorting</option>
              <option value="1"    <?php if(isset($QuantityDone) == '1'){ echo "selected" ;} ?>>Top Selling</option>
              <option value="DESC" <?php if(isset($_POST['Search']) && $SortValue == 'DESC'){ echo "selected" ;} ?>>Highst Price</option>
              <option value="ASC"  <?php if(isset($_POST['Search']) && $SortValue == 'ASC' && isset($QuantityDone) != 1 && isset($DefultSearch) != 1){ echo "selected" ;} ?>>Lowest Price</option>
            </select>
            <button class="thm-btn topbar-one__btn" style="background-color: #d99578; color:white; height: 50px;" name="Search" > Search</button>
            </div>
            <p class="product-sorting__text">Showing <?php echo $Count ; ?>-<?php echo $RecoedPerPage ; ?> of <?php echo $TotalItemsCount ; ?> results</p>
          </div>
        </form>
        </div>
      </div>

      <!-- Products -->
      <section class="product-one">
        <div class="container">
            <div class="row">
              <?php 
                  
                  foreach ($RunQuery as $Product) { ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-duration="1500ms">
                      <form method="post" action="?ItemID=<?php echo $Product['ID'] ?>" enctype="multipart/form-data">
                        <div class="product-one__single">
                          <div class="product-one__image">
                            <img src="images/<?php echo $Product['Image'] ?>" height="270px" alt="Awesome Image" />
                                <input type='hidden' name='Image' value="<?php echo $Product['Image'] ?>" />
                          </div>
                          <div class="product-one__content">
                            <div class="product-one__content-left">
                              <h3 class="product-one__title">
                                <a href="http://localhost/imentet-1/Pyramids/pyramids/ProductDetails.php?ItemID=<?php echo $Product['ID'] ?>"><?php echo $Product['Item'] ?></a>
                                <input type='hidden' name='Item' value="<?php echo $Product['Item'] ?>" />
                              </h3>
                              <p class="product-one__text"><?php echo  "EGP " . $Product['Price'] ?></p>
                              <input type='hidden' name='Price' value="<?php echo $Product['Price'] ?>" />
                              <p class="product-one__stars">
                                Available <?php echo $Product['Quantity'] . " Items" ?>
                              </p>
                            </div>
                              <input type='hidden' name='Quantity' value="<?php echo $Product['Quantity'] ?>" />
                                <input type='hidden' name='CatID' value="<?php echo $Product['CategoryID'] ?>" />
                            <div class="product-one__content-right">
                              <?php if($Product['Quantity'] <= 0){?>
                                Out of Stock
                              <?php }else{ ?>
                                <button data-toggle="tooltip" data-placement="top" name='add_to_cart' value="Add to Cart" class="product-one__cart-btn">
                                  <i class="egypt-icon-supermarket"></i>
                                </button>
                              <?php } ?>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  <?php }?>
            </div>


          <!-- Pagination  -->
          <div class="post-pagination post-pagination__two">
            <?php 
                        $Select = "SELECT * FROM giftshop " ;
                        $RunCount = mysqli_query($con , $Select);
                        $TotalRecoerds = mysqli_num_rows($RunCount);
                        $TotalPages = ceil($TotalRecoerds / $RecoedPerPage );
            for($i = 1 ; $i <= $TotalPages ; $i++){ ?>
              <a href="./OnlineShop.php?Page=<?php echo $i ?>" <?php  if(!isset($_GET['Page'])){ }elseif($_GET['Page'] == $i){ echo "class='active'" ;} ?> ><?php echo $i ?></a>
            <?php } ?>
          </div>
        </div>
      </section>

    <?php include "./UserFooterPyramids.php" ; ?>