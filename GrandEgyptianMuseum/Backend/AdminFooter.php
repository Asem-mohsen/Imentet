  <?php 
  
  $SelectQuery = "SELECT admin .* , adminrole.Role AS RoleName , adminimage.Image AS Image FROM admin
  LEFT JOIN adminrole ON admin.AdminRole = adminrole.ID 
  LEFT JOIN adminimage ON admin.ID = adminimage.AdminID
  WHERE admin.ID = $AdminID";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
    $AdminRole =$row['AdminRole'] ;
  ?>
  <!-- Footer -->
    <!-- <footer class="site-footer">
        <div class="container">
          <a class="site-footer__logo" href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php"
            ><img src="images/resources/footer-logo-imentet-gem.png" alt=""
          /></a>
          <form action="#" class="site-footer__form">
            <div class="site-footer__form-icon">
              <i class="egypt-icon-email"></i>
            </div>
            <input type="text" placeholder="Enter Email Address..." />
            <button type="submit">
              <i class="egypt-icon-right-arrow1"></i>
            </button>
          </form>
          <div class="site-footer__social">
            <a href="https://www.facebook.com/GrandEgyptianMuseum/" target="_blank"><i class="egypt-icon-logo"></i></a>
            <a href="https://twitter.com/EgyptMuseumGem"  target="_blank"><i class="egypt-icon-twitter"></i></a>
            <a href="https://www.instagram.com/grandegyptianmuseum/?hl=en"  target="_blank"><i class="egypt-icon-instagram"></i></a>
          </div>
          <p class="site-footer__copy">
            Copyrights &copy; 2023 <a href="#">Egypt</a>, All Rights Reserved.
          </p>
        </div>
    </footer> -->

    </div>

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
                    <a class="active d-flex align-center fs-14 c-b p-10 rad-6" href="">
                    <i class="fa-solid fa-chart-bar fa-fw"></i><span> Dashboard </span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Project/index.php" target='_blank'>
                        <i class="fa-solid fa-sitemap fa-fw"></i><span> Website </span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=Manage">
                        <i class="fa-solid fa-users fa-fw"></i><span> Users </span>
                    </a>
                </li>
                <li>
                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Users.php?action=CheckAllMembership">
                        <i class="fa-solid fa-key fa-fw"></i><span> Membership </span>
                    </a>
                </li>
                <?php if ($row['AdminRole'] == 1) { ?>
                    <li>
                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Admins.php?action=Manage">
                            <i class="fa-solid fa-gear fa-fw"></i><span> Admins </span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($row['AdminRole'] == 4 || $row['AdminRole'] == 1) { ?>
                    <li>
                        <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Q&A.php?action=Manage">
                        <i class="fa-regular fa-circle-question fa-fw"></i><span> Messages </span>
                        </a>
                    </li>
                <?php } ?>
                <?php if ($row['AdminRole'] != 4) { ?>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./GiftShop.php?action=Manage">
                                <i class="fa-solid fa-shop fa-fw"></i><span> Gift Shop </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Entertainments.php?action=Manage">
                            <i class="fa-solid fa-calendar-days fa-fw"></i><span> Entertainments </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Tickets.php?action=Visit">
                                <i class="fa-solid fa-ticket fa-fw"></i><span> Tickets </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Collections.php?action=Manage">
                            <i class="fa-solid fa-layer-group fa-fw"></i><span> Arts </span>
                            </a>
                        </li>
                <?php } ?>
                <?php if($row['AdminRole'] == 1 || $row['AdminRole'] == 2){ ?>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Pricing.php?action=Manage">
                            <i class="fa-solid fa-money-bill-1-wave fa-fw"></i><span> Pricing</span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Careers.php?action=Manage">
                            <i class="fa-brands fa-wpforms fa-fw"></i><span> Careers </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Donatiton.php?action=Manage">
                            <i class="fa-solid fa-hand-holding-dollar fa-fw"></i><span> Donations </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Sponsorship.php?action=Manage">
                            <i class="fa-solid fa-rectangle-ad fa-fw"></i><span> Sponsorship </span>
                            </a>
                        </li>
                        <li>
                            <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Transportation.php?action=Manage">
                            <i class="fa-solid fa-truck-plane fa-fw"></i><span> Transportaton </span>
                            </a>
                        </li>
                <?php } ?>
                <?php if($row['AdminRole'] == 4){ ?>
                <li>
                    <a class="d-flex align-center fs-14 c-b p-10 rad-6" href="./Feedback.php?action=Manage">
                        <i class="fa-solid fa-comment fa-fw"></i><span> Feedback </span>
                    </a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div> 

    <!-- Search  -->
    <div class="search-popup">
      <div class="search-popup__overlay custom-cursor__overlay">
        <div class="cursor"></div>
        <div class="cursor-follower"></div>
      </div>
      <div class="search-popup__inner">
        <form action="#" class="search-popup__form">
          <input type="text" name="search" placeholder="Type here to Search...." />
          <button type="submit">
            <i class="egypt-icon-search"></i>
          </button>
        </form>
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
    <script src="js/theme.js"></script>
  </body>
</html>       
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
