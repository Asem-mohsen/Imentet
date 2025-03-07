<?php
  include "./DatabaseConnection/Connection.php";
  if (isset($_SESSION["AdminID"])) {
    $AdminID = $_SESSION['AdminID'];

    $SelectQuery = "SELECT admin .* , adminrole.Role AS RoleName , adminimage.Image AS Image FROM admin
    LEFT JOIN adminrole ON admin.AdminRole = adminrole.ID 
    LEFT JOIN adminimage ON admin.ID = adminimage.AdminID
    WHERE admin.ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
    $AdminRole =$row['AdminRole'] ;
    
  ?>


    <!-- Side Menu -->
    <div class="side-menu__block">
      <div class="side-menu__block-overlay custom-cursor__overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
      </div>
      <div class="side-menu__block-inner">
        <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php">
          <img src="images/resources/dark-logo-imentet.png" alt="Awesome Image" />
        </a>
        <div class="side-menu__block-about">
          <h3 class="side-menu__block__title txt-center">Admin Panel</h3>
            <ul class=" gap-30 bo-n navigation-box @@extra_class">
                <li>
                    <a class="active d-flex align-center fs-14 c-b p-10 " href="">
                    <i class="fa-solid fa-chart-bar fa-fw"></i><span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-b p-10" href="./Project/index.php" target='_blank'>
                        <i class="fa-solid fa-sitemap fa-fw"></i><span> Website </span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-b p-10 " href="./Users.php?action=Manage">
                        <i class="fa-solid fa-users fa-fw"></i><span> Users </span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-b p-10" href="./Users.php?action=CheckAllMembership">
                        <i class="fa-solid fa-key fa-fw"></i><span> Membership </span>
                    </a>
                </li>
                <?php if ($row['AdminRole'] == 1) { ?>
                    <li>
                        <a class="d-flex align-center fs-14 c-b p-10" href="./Admins.php?action=Manage">
                            <i class="fa-solid fa-gear fa-fw"></i><span> Admins </span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($row['AdminRole'] == 4 || $row['AdminRole'] == 1) { ?>
                    <li>
                        <a class="d-flex align-center fs-14 c-b p-10" href="./Q&A.php?action=Manage">
                        <i class="fa-regular fa-circle-question fa-fw"></i><span> Messages </span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($row['AdminRole'] != 4) { ?>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10" href="./GiftShop.php?action=Manage">
                                <i class="fa-solid fa-shop fa-fw"></i><span> Gift Shop </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10" href="./Entertainments.php?action=Manage">
                            <i class="fa-solid fa-calendar-days fa-fw"></i><span> Entertainments </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10" href="./Tickets.php?action=Visit">
                                <i class="fa-solid fa-ticket fa-fw"></i><span> Tickets </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10" href="./Collections.php?action=Manage">
                            <i class="fa-solid fa-layer-group fa-fw"></i><span> Arts </span>
                            </a>
                        </li>
                <?php } ?>
                <?php if($row['AdminRole'] == 1 || $row['AdminRole'] == 2){ ?>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10" href="./Pricing.php?action=Manage">
                            <i class="fa-solid fa-money-bill-1-wave fa-fw"></i><span> Pricing</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10" href="./Careers.php?action=Manage">
                            <i class="fa-brands fa-wpforms fa-fw"></i><span> Careers </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10" href="./Donatiton.php?action=Manage">
                            <i class="fa-solid fa-hand-holding-dollar fa-fw"></i><span> Donations </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 " href="./Sponsorship.php?action=Manage">
                            <i class="fa-solid fa-rectangle-ad fa-fw"></i><span> Sponsorship </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 " href="./Transportation.php?action=Manage">
                            <i class="fa-solid fa-truck-plane fa-fw"></i><span> Transportaton </span>
                            </a>
                        </li>
                <?php } ?>
                <?php if($row['AdminRole'] == 4){ ?>
                <li>
                    <a class="d-flex align-center fs-14 c-b p-10" href="./Feedback.php?action=Manage">
                        <i class="fa-solid fa-comment fa-fw"></i><span> Feedback </span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div> 

    <!-- Scroll to Top -->
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top">
      <i class="egypt-icon-arrow-2"></i>
    </a>

    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/bootstrap-select.min.js"></script>
    <script src="js/isotope.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/jquery.validate.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/TweenMax.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/nouislider.js"></script>
    <script src="js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="JS/theme.js"></script>

    <script src="./JS/jquery-3.6.1.js"></script>
    <script src="./JS/jquery-ui.min.js"></script>
    <script src="./JS/jquery.selectBoxIt.min.js"></script>
    <script src="./JS/bootstrap.min.js"></script>
    <script src="JS//backend.js"></script>
    <!-- Swipper New -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <!-- End Swipper -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="https://kit.fontawesome.com/39c3d46f9d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
  </body>
</html>   
<?php  } ?>    