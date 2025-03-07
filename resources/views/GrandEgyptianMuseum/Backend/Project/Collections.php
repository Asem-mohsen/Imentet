<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();
$PageTitle = "Collections";
?>
    <?php include "../NavUser.php" ?>

        <section class="slider-one">
            <?php 
            $SelectCategories = "SELECT * FROM collectionscategories ";
            $RunQuery = mysqli_query($con , $SelectCategories);
            $Row = mysqli_fetch_assoc($RunQuery);
            foreach($RunQuery as $Category){ ?>
                    <section class="collection-three">
                        <div class="container">
                            <div class="block-title text-center"> 
                                <p ><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/Antiquities.php?CatID=<?php echo $Category['ID']?> " class="block-title__tag-line"><?php echo $Category['Category'] ?></a></p>
                                <h1 class="block-title__title" id="C1" ></h1>
                            </div>
                            <div class="row masonary-layout">
                                <?php
                                $CatID = $Category['ID'];
                                $SelectCollections = " SELECT collections .* , place.Name AS PlaceName FROM collections
                                                        JOIN place ON collections.PlaceID = place.ID
                                                        WHERE CatID = $CatID
                                                        LIMIT 8 ";
                                $RunCollections = mysqli_query($con , $SelectCollections);
                                $Row = mysqli_fetch_assoc($RunCollections);
                                $count = mysqli_num_rows($RunCollections);
                                if($count > 0){
                                    foreach($RunCollections as $Collection){ ?>
                                        <div class="col-lg-4 col-md-6 col-sm-12 masonary-item wow fadeInUp" data-wow-duration="1500ms"data-wow-delay="000ms">
                                            <div class="collection-three__single">
                                                <img src="../Images/<?php echo $Collection['Image'] ?>" alt="Awesome Image" />
                                                <div class="collection-three__content">
                                                    <h3 class="collection-three__title">
                                                        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>">
                                                            <?php echo $Collection['Collection'] ?>
                                                        </a>
                                                    </h3>
                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/CollectionDetails.php?CollectionID=<?php echo $Collection['ID'] ?>" class="collection-three__link"><span>+</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } 
                                } ?>
                            </div>
                        </div>
                    </section>
            <?php } ?>
            


            

        </section>

        <?php include "../UserFooter.php" ; ?>
