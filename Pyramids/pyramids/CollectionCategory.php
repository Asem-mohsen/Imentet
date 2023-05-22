<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();


if(isset($_GET['CatID'])){
  $CategoryID = $_GET['CatID'];
}
$CategoryID =  filter_var($_GET['CatID'], FILTER_SANITIZE_NUMBER_INT);

if(empty($CategoryID)){
  header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php");
}

$SelectCollections = "SELECT collections .* , collectionscategories.Category AS Category FROM collections
                      JOIN collectionscategories ON collections.CatID = collectionscategories.ID
                      WHERE CatID = $CategoryID ";
  $CollectionRun = mysqli_query($con , $SelectCollections);
  $CollectionRow = mysqli_fetch_assoc($CollectionRun);

$PageTitle = $CollectionRow['Category'];
$NumOfRecords = 8 ;
if(isset($_GET['MoreData'])){
  $NumOfRecords = $NumOfRecords + $_GET['MoreData'] ;
}
if($CategoryID != $CollectionRow['CatID']){
  header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php");
}
?>
  <?php include "./NavUserPyramids.php" ?>

      <section class="inner-banner inner-banner__collection-page">
        <div class="container">
          <h2 class="inner-banner__title"><?php echo $CollectionRow['Category'] . " Collection" ?></h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/pyramids.php">Home</a></li>
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/Collections.php">Collections</a></li>
            <li><?php echo $CollectionRow['Category'] ?></li>
          </ul>
        </div>
      </section>

      <!-- Search bar -->
      <form method="post">
        <div class="collection-search collection-page">
          <div class="container">
            <div class="inner-container">
              <div class="collection-search__outer">
                <div class="collection-search__field">
                  <select class="selectpicker" name="PlaceID">
                    <option>Location</option>
                      <?php
                            $Select = "SELECT * FROM place" ;
                            $RunQuery = mysqli_query($con , $Select);
                            $row = mysqli_fetch_assoc($RunQuery);
                            foreach($RunQuery as $Place){ 
                              $Checked = array();
                              if(isset($_POST['PlaceID'])){
                                $Checked = $_POST['PlaceID'];
                              }
                              ?>
                              <option value="<?php echo $Place['ID'] ?>" <?php if($Place['ID'] == $Checked){ echo "selected" ;  } ?>><?php echo $Place['Name'] ?></option>
                        <?php } ?> 
                  </select>
                </div>
              </div>

              <button type="submit" name='Find' class="thm-btn collection-search__btn">
                Collections 
              </button>
            </div>
          </div>
        </div>
      </form>

      <!-- Collection Items -->
        <?php if(isset($_GET['CatID'])){
                  if(!empty($_GET['CatID'])){
                        $CategoryID = $_GET['CatID'] ;
                                ?>
                    <section class="collection-two collection-two__collection-page">
                          <div class="container">
                              <div class="row masonary-layout">
                                <?php 
                                  if(isset($_POST['Find'])){
                                    if($_POST['PlaceID']){
                                      $PlaceID =$_POST['PlaceID'] ;
                                        $sql = "WHERE collections.PlaceID = $PlaceID AND CatID = $CategoryID";
                                        $SelectCollections = "SELECT collections .* , place.Name AS PlaceName FROM collections
                                                              JOIN place ON collections.PlaceID = place.ID
                                                              $sql
                                                              LIMIT $NumOfRecords";
                                        $RunQuery = mysqli_query($con , $SelectCollections);
                                        $CollectionRow = mysqli_fetch_assoc($RunQuery);
                                        $Count = mysqli_num_rows($RunQuery);
                                        foreach($RunQuery as $Collection){ ?>
                                            <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="0ms">
                                              <div class="collection-two__single">
                                                  <div class="collection-two__image">
                                                      <img src="images/<?php echo $Collection['Image'] ?>" width="300px" height="300px" alt="">
                                                      <div class="collection-two__hover">
                                                          <a class="img-popup" href="images/<?php echo $Collection['Image'] ?>"><i class="egypt-icon-focus"></i>
                                                          </a>
                                                      </div>
                                                  </div>
                                                  <div class="collection-two__content">
                                                      <p class="collection-two__category"><a href="http://localhost/imentet-1/Pyramids/pyramids/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>"><?php echo $Collection['PlaceName'] ?></a></p>
                                                      
                                                      <h3 class="collection-two__title"><a href="http://localhost/imentet-1/Pyramids/pyramids/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>"><?php echo $Collection['Collection'] ?></a></h3>
                                                  </div>
                                              </div>
                                            </div>
                                          <?php 
                                        } 
                                    }elseif($_POST['PlaceID'] == 0 ){
                                      $SelectCollections = "SELECT collections .* , place.Name AS PlaceName FROM collections
                                                        JOIN place ON collections.PlaceID = place.ID
                                                        WHERE CatID = $CategoryID
                                                        LIMIT $NumOfRecords";
                                      $RunQuery = mysqli_query($con , $SelectCollections);
                                      $CollectionRow = mysqli_fetch_assoc($RunQuery);
                                      $Count = mysqli_num_rows($RunQuery);
                                      foreach($RunQuery as $Collection){ ?>
                                        <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="0ms">
                                          <div class="collection-two__single">
                                              <div class="collection-two__image">
                                                  <img src="images/<?php echo $Collection['Image'] ?>" width="300px" height="300px" alt="">
                                                  <div class="collection-two__hover">
                                                      <a class="img-popup" href="images/<?php echo $Collection['Image'] ?>"><i class="egypt-icon-focus"></i>
                                                      </a>
                                                  </div>
                                              </div>
                                              <div class="collection-two__content">
                                                  <p class="collection-two__category"><a href="http://localhost/imentet-1/Pyramids/pyramids/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>"><?php echo $Collection['PlaceName'] ?></a></p>
                                                  
                                                  <h3 class="collection-two__title"><a href="http://localhost/imentet-1/Pyramids/pyramids/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>"><?php echo $Collection['Collection'] ?></a></h3>
                                              </div>
                                          </div>
                                        </div>
                                      <?php 
                                      } 
                                    }
                                  }else{
                                    $SelectCollections = "SELECT collections .* , place.Name AS PlaceName FROM collections
                                                          JOIN place ON collections.PlaceID = place.ID
                                                          WHERE CatID = $CategoryID
                                                          LIMIT $NumOfRecords";
                                              $RunQuery = mysqli_query($con , $SelectCollections);
                                              $CollectionRow = mysqli_fetch_assoc($RunQuery);
                                              $Count = mysqli_num_rows($RunQuery);
                                              foreach($RunQuery as $Collection){ ?>
                                                <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="0ms">
                                                    <div class="collection-two__single">
                                                        <div class="collection-two__image">
                                                            <img src="images/<?php echo $Collection['Image'] ?>" width="300px" height="300px" alt="">
                                                            <div class="collection-two__hover">
                                                                <a class="img-popup" href="images/<?php echo $Collection['Image'] ?>"><i class="egypt-icon-focus"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="collection-two__content">
                                                            <p class="collection-two__category"><a href="http://localhost/imentet-1/Pyramids/pyramids/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>"><?php echo $Collection['PlaceName'] ?></a></p>
                                                            
                                                            <h3 class="collection-two__title"><a href="http://localhost/imentet-1/Pyramids/pyramids/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>"><?php echo $Collection['Collection'] ?></a></h3>
                                                        </div>
                                                    </div>
                                                </div>
                                              <?php 
                                              } 
                                  } ?>
                              </div>

                              <?php if($Count >= $NumOfRecords){ ?>
                                <div class="text-center">
                                  <a href="?MoreData=8" class="exhibhition-one__more-link">
                                    <i class="exhibhition-one__more-link__icon">+</i>
                                    <span class="text-uppercase">Load More</span>
                                  </a>
                                </div>
                              <?php } ?>
                          </div>
                    </section>
                  <?php }else{
                    header("Location: ./Collections.php");
                  } ?>
        <?php }else{ 
          header("Location: ./Collections.php");
        } ?>
 
  <?php include "./UserFooterPyramids.php" ; ?>