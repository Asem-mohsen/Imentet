<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Events";

?>


<?php include "../NavUser.php"; ?>
      <section class="event-page-header">
        <section class="event-sorting event-page-three">
          <div class="container">
            <div class="tab-content">
              <div id="searchByMonth-tab" class="event-sorting__tab-content tab-pane show active animated fadeInUp" >
                <input type="text" name="searchByMonth-datepicker" class="searchByMonth-datepicker" value="November - 2019" readonly />
              </div>
              <div id="searchByDate-tab" class="event-sorting__tab-content tab-pane animated fadeInUp" >
                <input type="text" name="searchByDate-datepicker" class="searchByDate-datepicker" value="14 - Dec - 2019" readonly />
              </div>
            </div>
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a
                  href="#searchByMonth-tab"
                  data-toggle="tab"
                  class="nav-link active"
                  >Search By Month</a
                >
              </li>
              <li class="nav-item">
                <a href="#searchByDate-tab" data-toggle="tab" class="nav-link"
                  >Search By Date <i class="fa fa-calendar-o"></i
                ></a>
              </li>
            </ul>
            <!-- /.nav nav-tabs -->
          </div>
          <!-- /.container -->
        </section>

        <div class="collection-search event-page">
          <div class="container">
            <div class="inner-container">
              <div class="collection-search__outer">
                <div class="collection-search__field">
                  <select class="selectpicker" name="Categories">
                    <option value="0">Categories</option>
                    <?php
                      $Select = "SELECT * FROM entertainmnetcategory" ;
                      $RunQuery = mysqli_query($con , $Select);
                      $row = mysqli_fetch_assoc($RunQuery);
                      foreach($RunQuery as $Category){ ?>
                        <option value="<?php echo $Category['ID'] ?>"><?php echo $Category['Name'] ?></option>
                      <?php } ?>                    
                  </select>
                </div>

                <div class="collection-search__field">
                  <select class="selectpicker">
                  <option value="0">Location</option>
                    <?php
                      $Select = "SELECT * FROM place" ;
                      $RunQuery = mysqli_query($con , $Select);
                      $row = mysqli_fetch_assoc($RunQuery);
                      foreach($RunQuery as $Place){ ?>
                        <option value="<?php echo $Place['ID'] ?>"><?php echo $Place['Name'] ?></option>
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
      </section>

      <section class="event-three">
        <div class="container">
          <div class="row">
            <?php             
            $SelectEvent = "SELECT entertainmnet.* , place.Name AS PlaceName , entertainmnetcategory.Name AS CatName , eventstatus.Status AS EventStatus
                            FROM entertainmnet 
                            JOIN entertainmnetcategory ON entertainmnetcategory.ID = entertainmnet.CatID 
                            JOIN place ON place.ID = entertainmnet.PlaceID
                            LEFT JOIN eventstatus ON entertainmnet.ID = eventstatus.EventID
                            LIMIT 6 ";
            $RunEvents = mysqli_query($con , $SelectEvent);
            $fetchquery = mysqli_fetch_assoc($RunEvents);
            foreach($RunEvents as $Event){ 
              $Date = date('d M Y', strtotime($Event['Date'])); 

              ?>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="event-three__single">
                  <div class="event-three__image">
                    <img src="../Images/<?php echo $Event['Image'] ?>" alt="Awesome Image" height="200px"/>
                    <h3 class="event-three__title">
                      <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Event['ID'] ?>"><?php echo $Event['Name'] ?></a>
                    </h3>
                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="event-three__cat"><?php echo $Event['CatName'] ?></a>
                  </div>
                  <div class="event-three__content">
                    <p class="event-three__text">
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
                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/EventDetails.php?EventID=<?php echo $Event['ID'] ?>" class="thm-btn event-three__btn">
                      <span class="main-text">$ <?php echo $Event['RegularPrice'] ?> / Person</span>
                      <span class="hover-text">More Details</span>
                    </a>
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>

          <div class="post-pagination post-pagination__two">
            <a href="#">Prev</a>
            <a href="#" class="active">1</a>
            <a href="events2.html">2</a>
            <a href="#">Next</a>
          </div>
        </div>
      </section>

<?php include "../UserFooter.php" ; ?>
