<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Collection Details";

$CollectionID =  filter_var($_GET['CollectionID'], FILTER_SANITIZE_NUMBER_INT);
if(empty($CollectionID)){
    header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php");
}else{

  $SelectCollection = "SELECT collections .* , place.Name AS PlaceName , collectionscategories.Category AS CollectionCategory FROM collections
                        JOIN place ON collections.PlaceID = place.ID
                        JOIN collectionscategories ON collections.CatID = collectionscategories.ID
                        WHERE collections.ID = $CollectionID
                        LIMIT 1
                        ";
  $Collections = mysqli_query($con , $SelectCollection);
  $Collection = mysqli_fetch_assoc($Collections);


  if($CollectionID != $Collection['ID']){
    header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Collections.php");
    exit();
  }
  ?>

  <?php include "../NavUser.php"; ?>

    <section class="inner-banner">
        <div class="container">
            <h2 class="inner-banner__title">Collection Details</h2>
            <ul class="list-unstyled thm-breadcrumb">
                <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Home</a></li>
                <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Collections.php">Collections</a></li>
                <li>Collection Details</li>
            </ul>
        </div>
    </section>

    <!-- Colletion Details -->
    <div class="collection-details">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-6">
                    <div class="collection-details__content">
                        <h3 class="collection-details__title"><?php echo $Collection['Collection'] ?></h3>
                        <br>
                        <img src="../Images/<?php echo $Collection['Image'] ?>" alt="Awesome Image" class="img-fluid" />
                        <?php $ImageSize = getimagesize("../Images/" . $Collection['Image'] . "") ; ?>
                        <br>
                        <br>
                        <a href="#" class="collection-details__link"><i class="fa fa-download"></i> Download Image</a>
                        <br>
                        <p class="collection-details__text"><?php echo $Collection['Description'] ?></p>
                        <br>
                        <p class="collection-details__text"></p>
                        <br>
                        <h3 class="collection-details__subtitle">Highlights</h3>
                        <br>
                        <ul class="collection-details__list list-unstyled">
                            <li>
                                <i class="egypt-icon-check"></i>
                                This Piece of Art is considerd one of the main artifacts displayed in <?php echo $Collection['PlaceName'] ?> 
                            </li>
                            <li>
                                <i class="egypt-icon-check"></i>
                                The Colors are still the same 
                            </li>
                            <li>
                                <i class="egypt-icon-check"></i>
                                One of the main pieces in the <?php echo $Collection['CollectionCategory'] ?> Catgeory
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-5 collection-details__sidebar-wrap">
                    <div class="collection-details__sidebar">
                        <div class="collection-details__sidebar-single">
                            <h3 class="collection-details__sidebar-title"><span>Details of Collection</span></h3>
                            <ul class="collection-details__sidebar-list list-unstyled">
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Artist
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">Ancient Egyptians</span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Year
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value">2500BC - 2700BC</span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Style
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value"><?php echo $Collection['CollectionCategory'] ?></span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Location
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value"><?php echo $Collection['PlaceName'] ?></span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Dimension
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value"><?php echo  $ImageSize[3] ?></span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Type
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value"><?php echo $Collection['CollectionCategory'] ?></span>
                                </li>
                                <li>
                                    <span class="collection-details__sidebar-list__name">
                                        Object Num
                                        <span class="collection-details__sidebar-list__sep">:</span>
                                    </span>
                                    <span class="collection-details__sidebar-list__value"><?php echo rand(100 , 100000) ?></span>
                                </li>
                            </ul>
                        </div>
                        <div class="collection-details__sidebar-single">
                            <h3 class="collection-details__sidebar-subtitle">Share With Friends</h3>
                            <div class="collection-details__sidebar-social">
                                <a href="https://www.facebook.com/GrandEgyptianMuseum/" target="_blank" class="fa fa-facebook-f"></a>
                                <a href="https://twitter.com/EgyptMuseumGem" target="_blank" class="fa fa-twitter"></a>
                                <a href="#" class="fa fa-rss"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="collection-details__paginations">
        <div class="container">
            <div class="row">
            <!-- Prev -->
            <?php
                $SelectCollections = "SELECT * FROM collections WHERE ID < $CollectionID ORDER BY ID DESC LIMIT 1 ";
                $CollectionsRun = mysqli_query($con , $SelectCollections);
                $Prev = mysqli_fetch_assoc($CollectionsRun);
                $CountADD =mysqli_num_rows($CollectionsRun);
                
            ?>
            <?php if($CountADD >= 1 ){ ?>
                <div class="col-sm-3 text-center">
                    <a href="./CollectionDetails.php?CollectionID=<?php echo $Prev['ID'] ?>"> Prev <span>-</span></a>
                </div>
            <?php }else{ ?>
                <div class="col-sm-3 text-center">
                    <a href="./Collections.php"> Collections Page <span>-</span></a>
                </div>
            <?php } ?> 
            
            <div class="col-sm-6 text-center">
                <a href="./Collections.php"><i class="egypt-icon-menu"></i></a>
            </div>
            <!-- NEXT  -->
            <?php
                $SelectCollections = "SELECT * FROM collections WHERE ID > $CollectionID ORDER BY ID ASC LIMIT 1 ";
                $CollectionNextRun = mysqli_query($con , $SelectCollections);
                $Next = mysqli_fetch_assoc($CollectionNextRun);
                $CountNum =mysqli_num_rows($CollectionNextRun);
                if($CountNum >= 1 ){?>
                    
                <div class="col-sm-3 text-center">
                    <a href="./CollectionDetails.php?CollectionID=<?php echo $Next['ID'] ?>">Next <span>+</span></a>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Similar Collectons -->
    <section class="similar-collection collection-two__collection-page">
        <div class="container">
            <h3 class="text-center similar-collection__title">
                Similar Collections
            </h3>
            <div class="row masonary-layout">
            <?php 
                $SelectCollection = "SELECT collections .* , collectionscategories.Category AS CollectionCategory FROM collections
                                        JOIN collectionscategories ON collections.CatID = collectionscategories.ID
                                        ORDER BY ID DESC
                                        LIMIT 3 
                                    ";
                $Collections = mysqli_query($con , $SelectCollection);
                $CollectionRow = mysqli_fetch_assoc($Collections);
                foreach($Collections as $SimilarColl){?>
                    <div class="col-lg-4 col-md-6 col-sm-12 wow fadeInUp masonary-item" data-wow-duration="1500ms" data-wow-delay="0ms">
                        <div class="collection-two__single">
                            <div class="collection-two__image">
                                <img src="../Images/<?php echo $SimilarColl['Image'] ?>" height="200px" alt="">
                                <div class="collection-two__hover">
                                    <a class="img-popup" href="../Images/<?php echo $SimilarColl['Image'] ?>"><i class="egypt-icon-focus"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="collection-two__content">
                                <p class="collection-two__category"><a href="#"><?php echo $SimilarColl['CollectionCategory'] ?></a></p>
                                
                                <h3 class="collection-two__title"><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/CollectionDetails.php?CollectionID=<?php echo $SimilarColl['ID'] ?>"><?php echo $SimilarColl['Collection'] ?></a></h3>
                            </div>
                        </div>
                    </div>
                <?php } ?>

                
            </div>
        </div>
    </section>

  <?php include "../UserFooter.php"; 
}?>