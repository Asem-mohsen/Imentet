<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Antiquities";
$NumOfRecords = 8 ;
if(isset($_GET['MoreData'])){
  $NumOfRecords = $NumOfRecords + $_GET['MoreData'] ;
}
?>

  <?php include "../NavUser.php"; ?>


      <section class="inner-banner inner-banner__collection-page">
        <div class="container">
          <h2 class="inner-banner__title">Antiquities Collection</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Home</a></li>
            <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Antiquities.php">Collections</a></li>
            <li>Antiquities</li>
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
                    <section class="collection-four">
                        <div class="container-fluid">
                          <div class="row high-gutters">
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
                                      <div class="col-lg-3 col-md-6 col-sm-6">
                                        <div class="collection-four__single" style="margin-top: 20px ;">
                                          <img src="../Images/<?php echo $Collection['Image'] ?>" style="width: -webkit-fill-available ; " height="300px" alt="Awesome Image" />
                                          <div class="collection-four__content">
                                            <a href="collection-details.html" class="collection-four__link" >+</a>
                                            <p class="collection-four__cat"><?php echo $Collection['PlaceName'] ?></p>
                                            <h3 class="collection-four__title">
                                              <a href="collection-details.html"><?php echo $Collection['Collection'] ?></a>
                                            </h3>
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
                                    <div class="col-lg-3 col-md-6 col-sm-6">
                                      <div class="collection-four__single" style="margin-top: 20px ;">
                                        <img src="../Images/<?php echo $Collection['Image'] ?>" style="width: -webkit-fill-available ; " height="300px" alt="Awesome Image" />
                                        <div class="collection-four__content">
                                          <a href="collection-details.html" class="collection-four__link" >+</a>
                                          <p class="collection-four__cat"><?php echo $Collection['PlaceName'] ?></p>
                                          <h3 class="collection-four__title">
                                            <a href="collection-details.html"><?php echo $Collection['Collection'] ?></a>
                                          </h3>
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
                                            <div class="col-lg-3 col-md-6 col-sm-6">
                                              <div class="collection-four__single">
                                              <img src="../Images/<?php echo $Collection['Image'] ?>" width="200px" height="200px" alt="Awesome Image" />
                                                <div class="collection-four__content">
                                                  <a href="collection-details.html" class="collection-four__link" >+</a>
                                                  <p class="collection-four__cat"><?php echo $Collection['PlaceName'] ?></p>
                                                  <h3 class="collection-four__title">
                                                    <a href=""><?php echo $Collection['Collection'] ?></a>
                                                  </h3>
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


  <?php include "../UserFooter.php" ; ?>

