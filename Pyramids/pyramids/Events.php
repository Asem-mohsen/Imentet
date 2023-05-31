<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();


$Date = date('d - M - Y');
$DateMonth = date('M - Y');
$PageTitle = "Events";

// Pagination 
$RecoedPerPage = 6 ;
$Page = '';
if(isset($_GET['Page'])){
  $Page = $_GET['Page'];
}else{
  $Page = 1 ;
}
$StartFrom = ($Page-1) * $RecoedPerPage ;

?>

<?php include "./NavUserPyramids.php" ; ?>

      <!-- Search By Date Section -->
      <section class="event-page-header">
        <section class="event-sorting event-page-three">
          <div class="container">
            <div class="tab-content">
              <div id="searchByMonth-tab" class="event-sorting__tab-content tab-pane show active animated fadeInUp" >
                <input type="text" name="searchByMonth-datepicker" class="searchByMonth-datepicker" value="<?php echo $DateMonth ?>" readonly />
              </div>
              <div id="searchByDate-tab" class="event-sorting__tab-content tab-pane animated fadeInUp" >
                <input type="text" name="searchByDate-datepicker" class="searchByDate-datepicker" value="<?php echo $Date ; ?>" readonly />
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a href="#searchByMonth-tab" data-toggle="tab" class="nav-link active">Search By Month</a>
              </li>
              <li class="nav-item">
                <a href="#searchByDate-tab" data-toggle="tab" class="nav-link">Search By Date 
                  <i class="fa fa-calendar-o"></i>
                </a>
              </li>
            </ul>
          </div>
        </section>
        
        <!-- Search Options -->
        <form method="post">
          <div class="collection-search event-page">
            <div class="container">
              <div class="inner-container">
                <div class="collection-search__outer">
                  <div class="collection-search__field">
                    <select class="selectpicker" name="CatID">
                      <option value="0">Categories</option>
                      <?php
                        $Select = "SELECT * FROM entertainmnetcategory WHERE ID != 9" ;
                        $RunQuery = mysqli_query($con , $Select);
                        $row = mysqli_fetch_assoc($RunQuery);
                        foreach($RunQuery as $Category){
                          $Checked = array();
                          if(isset($_POST['CatID'])){
                            $Checked = $_POST['CatID'];
                        }
                        ?>
                          <option value="<?php echo $Category['ID'] ?>" <?php if($Category['ID'] == $Checked){ echo "selected" ;  } ?>> <?php echo $Category['Name'] ?></option>
                        <?php } ?>                    
                    </select>
                  </div>
                  <div class="collection-search__field">
                    <select class="selectpicker" name="PlaceID">
                    <option value="0">Location</option>
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

                <button type="submit" name="FindEvent" class="thm-btn collection-search__btn">
                  Find Event
                </button>
              </div>
            </div>
          </div>
        </form>
      </section>

      <!-- Search Data -->
      <section class="event-three">
        <div class="container">
          <div class="row">
            <?php
              if(isset($_POST['FindEvent'])){
                  if($_POST['PlaceID'] && $_POST['CatID']){
                      $PlaceID =$_POST['PlaceID'] ;
                      $CatID =$_POST['CatID'] ;
                      $sql = "WHERE entertainmnet.PlaceID = $PlaceID AND entertainmnet.CatID != 9 AND entertainmnet.CatID = $CatID" ; 
                      $SelectEvent = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName , eventstatus.Status AS EventStatus
                                FROM entertainmnet 
                                JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                JOIN place ON place.ID = entertainmnet.PlaceID
                                LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                                $sql 
                                LIMIT $StartFrom , $RecoedPerPage
                                ";
                        $RunEvents = mysqli_query($con , $SelectEvent);
                        $fetchquery = mysqli_fetch_assoc($RunEvents);
                        $count = mysqli_num_rows($RunEvents);

                        if($count > 0 ){
                          foreach($RunEvents as $Event){ 
                            $Date = date('d M Y', strtotime($Event['Date'])); 
              
                            ?>
                            <div class="col-lg-4 col-md-6 col-sm-12">
                              <div class="event-three__single">
                                <div class="event-three__image">
                                  <img src="images/<?php echo $Event['Image'] ?>" alt="Awesome Image" height="200px"/>
                                  <h3 class="event-three__title">
                                    <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>"><?php echo $Event['Name'] ?></a>
                                  </h3>
                                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="event-three__cat"><?php echo $Event['CatName'] ?></a>
                                </div>
                                <div class="event-three__content">
                                  <p class="event-three__text"  style="overflow: hidden; max-height: 182px; min-height: 182px;">
                                    <?php echo $Event['Description'] ?>
                                  </p>
                                  <ul class="event-three__list list-unstyled">
                                    <li>
                                      <span>Date & Time</span>
                                      <p>
                                        <i class="fa fa-clock-o"></i> 
                                        <?php echo $Date ; ?>
                                      </p>
                                    </li>
                                    <li>
                                      <span>Location</span>
                                      <p>
                                        <i class="fa fa-location-arrow"></i> 
                                        <?php echo $Event['PlaceName'] ?>
                                      </p>
                                    </li>
                                  </ul>
                                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="thm-btn event-three__btn">
                                    <span class="main-text">EGP <?php echo $Event['EgyptianPrice'] ?> / Person</span>
                                    <span class="hover-text">More Details</span>
                                  </a>
                                </div>
                              </div>
                            </div>
                          <?php }
                        }
                  }elseif($_POST['PlaceID'] && $_POST['CatID'] == 0){
                      $PlaceID =$_POST['PlaceID'] ;
                      $sql = "WHERE entertainmnet.CatID != 9 AND entertainmnet.PlaceID = $PlaceID ";
                      $SelectEvent = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName , eventstatus.Status AS EventStatus
                      FROM entertainmnet 
                      JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                      JOIN place ON place.ID = entertainmnet.PlaceID
                      LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                      $sql 
                      LIMIT $StartFrom , $RecoedPerPage
                      ";
                      $RunEvents = mysqli_query($con , $SelectEvent);
                      $fetchquery = mysqli_fetch_assoc($RunEvents);
                      $count = mysqli_num_rows($RunEvents);

                      if($count > 0 ){
                        foreach($RunEvents as $Event){ 
                          $Date = date('d M Y', strtotime($Event['Date'])); 

                          ?>
                          <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="event-three__single">
                              <div class="event-three__image">
                                <img src="images/<?php echo $Event['Image'] ?>" alt="Awesome Image" height="200px"/>
                                <h3 class="event-three__title">
                                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>"><?php echo $Event['Name'] ?></a>
                                </h3>
                                <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="event-three__cat"><?php echo $Event['CatName'] ?></a>
                              </div>
                              <div class="event-three__content">
                                <p class="event-three__text"  style="overflow: hidden; max-height: 182px; min-height: 182px;">
                                  <?php echo $Event['Description'] ?>
                                </p>
                                <ul class="event-three__list list-unstyled">
                                  <li>
                                    <span>Date & Time</span>
                                    <p>
                                      <i class="fa fa-clock-o"></i> 
                                      <?php echo $Date ; ?>
                                    </p>
                                  </li>
                                  <li>
                                    <span>Location</span>
                                    <p>
                                      <i class="fa fa-location-arrow"></i> 
                                      <?php echo $Event['PlaceName'] ?>
                                    </p>
                                  </li>
                                </ul>
                                <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="thm-btn event-three__btn">
                                  <span class="main-text">EGP <?php echo $Event['EgyptianPrice'] ?> / Person</span>
                                  <span class="hover-text">More Details</span>
                                </a>
                              </div>
                            </div>
                          </div>
                        <?php }
                      }
                  }elseif($_POST['CatID'] && $_POST['PlaceID'] == 0){
                      $CatID =$_POST['CatID'] ;
                      $sql = "WHERE entertainmnet.CatID != 9 AND entertainmnet.CatID = $CatID ";
                      $SelectEvent = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName , eventstatus.Status AS EventStatus
                      FROM entertainmnet 
                      JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                      JOIN place ON place.ID = entertainmnet.PlaceID
                      LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                      $sql 
                      LIMIT $StartFrom , $RecoedPerPage
                      ";
                      $RunEvents = mysqli_query($con , $SelectEvent);
                      $fetchquery = mysqli_fetch_assoc($RunEvents);
                      $count = mysqli_num_rows($RunEvents);

                      if($count > 0 ){
                        foreach($RunEvents as $Event){ 
                          $Date = date('d M Y', strtotime($Event['Date'])); 

                          ?>
                          <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="event-three__single">
                              <div class="event-three__image">
                                <img src="images/<?php echo $Event['Image'] ?>" alt="Awesome Image" height="200px"/>
                                <h3 class="event-three__title">
                                  <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>"><?php echo $Event['Name'] ?></a>
                                </h3>
                                <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="event-three__cat"><?php echo $Event['CatName'] ?></a>
                              </div>
                              <div class="event-three__content">
                              <p class="event-three__text"  style="overflow: hidden; max-height: 182px; min-height: 182px;">
                                <?php echo $Event['Description'] ?>
                              </p>
                                <ul class="event-three__list list-unstyled">
                                  <li>
                                    <span>Date & Time</span>
                                    <p>
                                      <i class="fa fa-clock-o"></i> 
                                      <?php echo $Date ; ?>
                                    </p>
                                  </li>
                                  <li>
                                    <span>Location</span>
                                    <p>
                                      <i class="fa fa-location-arrow"></i> 
                                      <?php echo $Event['PlaceName'] ?>
                                    </p>
                                  </li>
                                </ul>
                                <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="thm-btn event-three__btn">
                                  <span class="main-text">EGP <?php echo $Event['EgyptianPrice'] ?> / Person</span>
                                  <span class="hover-text">More Details</span>
                                </a>
                              </div>
                            </div>
                          </div>
                        <?php }
                      }
                  }elseif($_POST['CatID'] == 0  && $_POST['PlaceID'] == 0){
                    $SelectEvent =" SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName , eventstatus.Status AS EventStatus
                                    FROM entertainmnet 
                                    JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                                    JOIN place ON place.ID = entertainmnet.PlaceID
                                    LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                                    LIMIT $StartFrom , $RecoedPerPage
                                    ";
                    $RunEvents = mysqli_query($con , $SelectEvent);
                    $fetchquery = mysqli_fetch_assoc($RunEvents);
                    $count = mysqli_num_rows($RunEvents);

                    if($count > 0 ){
                      foreach($RunEvents as $Event){ 
                        $Date = date('d M Y', strtotime($Event['Date'])); 

                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                          <div class="event-three__single">
                            <div class="event-three__image">
                              <img src="images/<?php echo $Event['Image'] ?>" alt="Awesome Image" height="200px"/>
                              <h3 class="event-three__title">
                                <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>"><?php echo $Event['Name'] ?></a>
                              </h3>
                              <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="event-three__cat"><?php echo $Event['CatName'] ?></a>
                            </div>
                            <div class="event-three__content">
                            <p class="event-three__text"  style="overflow: hidden; max-height: 182px; min-height: 182px;">
                                <?php echo $Event['Description'] ?>
                              </p>
                              <ul class="event-three__list list-unstyled">
                                <li>
                                  <span>Date & Time</span>
                                  <p>
                                    <i class="fa fa-clock-o"></i> 
                                    <?php echo $Date ; ?>
                                  </p>
                                </li>
                                <li>
                                  <span>Location</span>
                                  <p>
                                    <i class="fa fa-location-arrow"></i> 
                                    <?php echo $Event['PlaceName'] ?>
                                  </p>
                                </li>
                              </ul>
                              <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="thm-btn event-three__btn">
                                <span class="main-text">EGP <?php echo $Event['EgyptianPrice'] ?> / Person</span>
                                <span class="hover-text">More Details</span>
                              </a>
                            </div>
                          </div>
                        </div>
                      <?php }
                    }
                  }
              }else{
              
                    $SelectEvent = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName , eventstatus.Status AS EventStatus
                    FROM entertainmnet 
                    JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                    JOIN place ON place.ID = entertainmnet.PlaceID
                    LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                    LIMIT $StartFrom , $RecoedPerPage
                    ";
                    $RunEvents = mysqli_query($con , $SelectEvent);
                    $fetchquery = mysqli_fetch_assoc($RunEvents);
                    $count = mysqli_num_rows($RunEvents);

                    if($count > 0 ){
                      foreach($RunEvents as $Event){ 
                        $Date = date('d M Y', strtotime($Event['Date'])); 

                        ?>
                        <div class="col-lg-4 col-md-6 col-sm-12">
                          <div class="event-three__single">
                            <div class="event-three__image">
                              <img src="images/<?php echo $Event['Image'] ?>" alt="Awesome Image" height="200px"/>
                              <h3 class="event-three__title">
                                <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>"><?php echo $Event['Name'] ?></a>
                              </h3>
                              <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="event-three__cat"><?php echo $Event['CatName'] ?></a>
                            </div>
                            <div class="event-three__content">
                              <p class="event-three__text"  style="overflow: hidden; max-height: 182px; min-height: 182px;">
                                <?php echo $Event['Description'] ?>
                              </p>
                              <ul class="event-three__list list-unstyled">
                                <li>
                                  <span>Date & Time</span>
                                  <p>
                                    <i class="fa fa-clock-o"></i> 
                                    <?php echo $Date ; ?>
                                  </p>
                                </li>
                                <li>
                                  <span>Location</span>
                                  <p>
                                    <i class="fa fa-location-arrow"></i> 
                                    <?php echo $Event['PlaceName'] ?>
                                  </p>
                                </li>
                              </ul>
                              <a href="http://localhost/imentet-1/Pyramids/pyramids/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="thm-btn event-three__btn">
                                <span class="main-text">EGP <?php echo $Event['EgyptianPrice'] ?> / Person</span>
                                <span class="hover-text">More Details</span>
                              </a>
                            </div>
                          </div>
                        </div>
                      <?php }
                    } 
              }
            ?>
          </div>

          <!-- Pagination  -->
          <div class="post-pagination post-pagination__two">
            <?php 
                        $Select = "SELECT * FROM entertainmnet WHERE CatID != 9 " ;
                        $RunCount = mysqli_query($con , $Select);
                        $TotalRecoerds = mysqli_num_rows($RunCount);
                        $TotalPages = ceil($TotalRecoerds / $RecoedPerPage );
            for($i = 1 ; $i <= $TotalPages ; $i++){ ?>
              <a href="./Events.php?Page=<?php echo $i ?>" <?php if(!isset($_GET['Page'])){ }elseif($_GET['Page'] == $i){ echo "class='active'" ;} ?> ><?php echo $i ?></a>
            <?php } ?>
          </div>
        </div>
      </section>


<?php include "./UserFooterPyramids.php" ; ?>

