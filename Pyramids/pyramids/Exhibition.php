<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Exhibitions";

$NumOfRecords = 9 ;
if(isset($_GET['MoreData'])){
  $NumOfRecords = $NumOfRecords + $_GET['MoreData'] ;
}
?>
  <?php include "./NavUserPyramids.php" ; ?>

      <section class="inner-banner" style="background-image: url(./images/Background/inner-banner-bg-2-2.png);">
        <div class="container">
          <h2 class="inner-banner__title">Exhibition</h2>
          <ul class="list-unstyled thm-breadcrumb">
            <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a></li>
            <li><a>What's On</a></li>
            <li>Exhibition</li>
          </ul>

          <ul class="nav nav-tabs exhibhition-one__menu">
            <li class="nav-item">
              <a class="nav-link active" data-toggle="tab" href="#current">Ongoing</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="tab" href="#upcoming">Upcoming</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link" data-toggle="tab" href="#arc-1">Past</a>
            </li>
          </ul>

        </div>
      </section>

      <section class="exhibhition-one exhibhition-one__page">
        <div class="container">
          <div class="tab-content">

            <!-- Current -->
            <div class="tab-pane show active animated fadeInUp" id="current">
              <div class="row">
                <?php 
                  $SelectExhibitions = "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                        JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                        WHERE CatID = 9 AND Date BETWEEN '2023-04-14' AND '2023-12-01'
                                        LIMIT $NumOfRecords";
                  $Query = mysqli_query($con , $SelectExhibitions);
                  $ExhibitionsRow = mysqli_fetch_assoc($Query);
                  $Count = mysqli_num_rows($Query);
                  foreach($Query as $Exhibitions){ 
                    $StartDate = $Exhibitions['Date'] ;
                    $EndDate = $Exhibitions['DateTo'] ;
                    $StartDateInMonth = date('M d, Y' , strtotime($StartDate));
                    $EndDateInMonth = date('M d, Y' , strtotime($EndDate));
                    ?>
                    <div class="col-lg-4">
                      <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
                        <div class="exhibhition-one__image">
                          <div class="exhibhition-one__image-inner"  style='max-height:210px'>
                            <span class="exhibhition-one__image-border-1"></span>
                            <span class="exhibhition-one__image-border-2"></span>
                            <span class="exhibhition-one__image-border-3"></span>
                            <span class="exhibhition-one__image-border-4"></span>
                            <img src="images/<?php echo $Exhibitions['Image'] ?>" alt="Awesome Image" />
                            <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="exhibhition-one__image-link">
                              <i class="egypt-icon-arrow-1"></i>
                            </a>
                          </div>
                        </div>
                        <div class="exhibhition-one__content">
                          <a href="http://localhost/imentet-1/Pyramids/pyramids/Exhibition.php" class="exhibhition-one__category"><?php echo $Exhibitions['CatName'] ?></a>
                          <h3 class="exhibhition-one__title">
                            <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>">
                              <?php echo $Exhibitions['Name'] ?>
                            </a>
                          </h3>
                          <div class="exhibhition-one__bottom">
                            <div class="exhibhition-one__bottom-left">
                              <span><?php echo $StartDateInMonth ?> </span>
                              <span>
                              <?php echo $EndDateInMonth ?>  <i class="fa fa-angle-double-left"></i>
                              </span>
                            </div>
                            <div class="exhibhition-one__bottom-right">
                              <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="thm-btn exhibhition-one__btn">Read More</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
              </div>
            </div>

            <!-- Upcoming -->
            <div class="tab-pane animated fadeInUp" id="upcoming">
              <div class="row">
                <?php 
                  $SelectExhibitions = "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                        JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                        WHERE CatID = 9 AND Date BETWEEN '2023-12-02' AND '2025-12-30'
                                        LIMIT $NumOfRecords";
                  $Query = mysqli_query($con , $SelectExhibitions);
                  $ExhibitionsRow = mysqli_fetch_assoc($Query);
                  $Count = mysqli_num_rows($Query);
                  foreach($Query as $Exhibitions){ 
                    $StartDate = $Exhibitions['Date'] ;
                    $EndDate = $Exhibitions['DateTo'] ;
                    $StartDateInMonth = date('M d, Y' , strtotime($StartDate));
                    $EndDateInMonth = date('M d, Y' , strtotime($EndDate));
                    ?>
                    <div class="col-lg-4">
                      <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
                        <div class="exhibhition-one__image">
                          <div class="exhibhition-one__image-inner"  style='max-height:210px'>
                            <span class="exhibhition-one__image-border-1"></span>
                            <span class="exhibhition-one__image-border-2"></span>
                            <span class="exhibhition-one__image-border-3"></span>
                            <span class="exhibhition-one__image-border-4"></span>
                            <img src="images/<?php echo $Exhibitions['Image'] ?>" alt="Awesome Image" />
                            <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="exhibhition-one__image-link">
                              <i class="egypt-icon-arrow-1"></i>
                            </a>
                          </div>
                        </div>
                        <div class="exhibhition-one__content">
                          <a href="http://localhost/imentet-1/Pyramids/pyramids/Exhibition.php" class="exhibhition-one__category"><?php echo $Exhibitions['CatName'] ?></a>
                          <h3 class="exhibhition-one__title">
                            <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>">
                              <?php echo $Exhibitions['Name'] ?>
                            </a>
                          </h3>
                          <div class="exhibhition-one__bottom">
                            <div class="exhibhition-one__bottom-left">
                              <span><?php echo $StartDateInMonth ?> </span>
                              <span>
                              <?php echo $EndDateInMonth ?>  <i class="fa fa-angle-double-left"></i>
                              </span>
                            </div>
                            <div class="exhibhition-one__bottom-right">
                              <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="thm-btn exhibhition-one__btn">Read More</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
              </div>
            </div>
            <!-- Archive -->
            <div class="tab-pane animated fadeInUp" id="arc-1">
              <div class="row">
              <?php 
                  $SelectExhibitions = "SELECT entertainmnet.* , entertainmnetcategory.Name AS CatName FROM entertainmnet 
                                        JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                        WHERE CatID = 9 AND Date BETWEEN '2020-12-02' AND '2023-04-30'
                                        LIMIT $NumOfRecords";
                  $Query = mysqli_query($con , $SelectExhibitions);
                  $ExhibitionsRow = mysqli_fetch_assoc($Query);
                  $Count = mysqli_num_rows($Query);
                  foreach($Query as $Exhibitions){ 
                    $StartDate = $Exhibitions['Date'] ;
                    $EndDate = $Exhibitions['DateTo'] ;
                    $StartDateInMonth = date('M d, Y' , strtotime($StartDate));
                    $EndDateInMonth = date('M d, Y' , strtotime($EndDate));
                    ?>
                    <div class="col-lg-4">
                      <div class="exhibhition-one__single wow fadeInUp" data-wow-duration="1500ms">
                        <div class="exhibhition-one__image">
                          <div class="exhibhition-one__image-inner"  style='max-height:210px'>
                            <span class="exhibhition-one__image-border-1"></span>
                            <span class="exhibhition-one__image-border-2"></span>
                            <span class="exhibhition-one__image-border-3"></span>
                            <span class="exhibhition-one__image-border-4"></span>
                            <img src="images/<?php echo $Exhibitions['Image'] ?>" alt="Awesome Image" />
                            <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="exhibhition-one__image-link">
                              <i class="egypt-icon-arrow-1"></i>
                            </a>
                          </div>
                        </div>
                        <div class="exhibhition-one__content">
                          <a href="http://localhost/imentet-1/Pyramids/pyramids/Exhibition.php" class="exhibhition-one__category"><?php echo $Exhibitions['CatName'] ?></a>
                          <h3 class="exhibhition-one__title">
                            <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>">
                              <?php echo $Exhibitions['Name'] ?>
                            </a>
                          </h3>
                          <div class="exhibhition-one__bottom">
                            <div class="exhibhition-one__bottom-left">
                              <span><?php echo $StartDateInMonth ?> </span>
                              <span>
                              <?php echo $EndDateInMonth ?>  <i class="fa fa-angle-double-left"></i>
                              </span>
                            </div>
                            <div class="exhibhition-one__bottom-right">
                              <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Exhibitions['ID'] ?>" class="thm-btn exhibhition-one__btn">Read More</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
              </div>
            </div>

            <!-- Load More -->
            <?php if($Count >= $NumOfRecords){ ?>
              <div class="text-center">
                <a href="?MoreData=8" class="exhibhition-one__more-link">
                  <i class="exhibhition-one__more-link__icon">+</i>
                  <span class="text-uppercase">Load More</span>
                </a>
              </div>
            <?php } ?>

          </div>
        </div>
      </section>

  <?php include "./UserFooterPyramids.php" ; ?>

