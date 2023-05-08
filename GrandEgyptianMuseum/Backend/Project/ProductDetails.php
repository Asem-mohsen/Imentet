<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();
if(isset($_SESSION['UserID'])){
    $UserID = $_SESSION['UserID'];
    $SelectUser = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
    $RunQuery = mysqli_query($con , $SelectUser);
    $User = mysqli_fetch_assoc($RunQuery);

    $FullName = $User['Name'] . " " . $User['LastName']; 
}
$ItemID =  filter_var($_GET['ItemID'], FILTER_SANITIZE_NUMBER_INT);
if(empty($ItemID)){
    header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/index.php");
}else{ 
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
    $ItemID = $_GET['ItemID'] ;

    $SelectProduct = "SELECT giftshop.* , giftcategory.Category AS CategoryName FROM giftshop 
                        JOIN giftcategory ON giftshop.CategoryID = giftcategory.ID 
                        WHERE giftshop.ID = $ItemID
    ";
    $RunProduct = mysqli_query($con , $SelectProduct);
    $Item = mysqli_fetch_assoc($RunProduct);
    $Count = mysqli_num_rows($RunProduct);


    $PageTitle = $Item['Item'] . " Details";

    if($ItemID != $Item['ID']){
        header("Location: http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/OnlineShop.php");
        exit();
        }

    ?>



    <?php include "../NavUser.php"; ?>

        <!-- Upper Part -->
        <div class="container">
            <ul class="list-unstyled thm-breadcrumb thm-breadcrumb__two">
                <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/home.php">Home</a></li>
                <li><a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/OnlineShop.php">Shop</a></li>
                <li><?php echo $Item['Item'] ?></li>
            </ul>
        </div>

        <!-- Item Details -->
        <section class="product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-details__image">
                            <img class="img-fluid" src="../Images/<?php echo $Item['Image'] ?>" width="500px" height="500px" alt="Awesome Image" />
                            <a href="../Images/<?php echo $Item['Image'] ?>" class="product-details__img-popup img-popup">
                                <i class="fa fa-search"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-details__content">
                            <form method="post" action="?ItemID=<?php echo $Item['ID'] ?>" enctype="multipart/form-data">
                                <input type='hidden' name='Image' value="<?php echo $Item['Image'] ?>" />
                                <input type='hidden' name='Price' value="<?php echo $Item['Price'] ?>" />
                                <input type='hidden' name='Item' value="<?php echo $Item['Item'] ?>" />
                                <input type='hidden' name='CatID' value="<?php echo $Item['CategoryID'] ?>" />

                                <h3 class="product-details__title"><?php echo $Item['Item'] ?></h3>
                                <p class="product-details__price"><?php echo $Item['Price'] . "$" ?></p>
                                <p class="product-details__text">
                                    Working from home meant we couldsnack & coffee breaks change our
                                    desks or view, good, drink on the job desires to obtain pain of because it
                                    is pain, but because occasionally circumstances.
                                </p>
                                <p class="product-details__categories">
                                    <span class="text-uppercase">Category : </span>
                                    <a href=""><?php echo $Item['CategoryName'] ?></a>
                                </p>
                                <div class="product-details__button-block">
                                    <input type='hidden' name='Quantity' value="<?php echo $Product['Quantity'] ?>" />
                                    <?php if(!isset($_POST['add_to_cart'])){ ?>
                                        <button name='add_to_cart' class="thm-btn product-details__cart-btn">Add to Cart <span>+</span></button>
                                    <?php }else{ ?>
                                        <button disabled class="thm-btn product-details__cart-btn">Added to Cart </button>
                                    <?php } ?>
                                </div>
                                <p class="product-details__availabelity">
                                    <span>Availability:</span>
                                    <?php echo $Item['Quantity'] . " In stock"?>
                                </p>
                                <p class="product-details__social">
                                    <span><i class="egypt-icon-share"></i></span>
                                    <a href="https://www.facebook.com/GrandEgyptianMuseum/" target="_blank"><i class="fa fa-facebook-f"></i></a>
                                    <a href="https://twitter.com/EgyptMuseumGem"  target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a href="https://www.instagram.com/grandegyptianmuseum/?hl=en" target="_blank"><i class="fa fa-instagram"></i></a>
                                </p>
                            </form>
                            <div class="accrodion-grp" data-grp-name="product-details__accrodion">
                                <div class="accrodion ">
                                    <div class="accrodion-title">
                                        <h4>Description</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <p>Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="accrodion active">
                                    <div class="accrodion-title">
                                        <h4>Comment</h4>
                                    </div>
                                    <div class="accrodion-content">
                                        <div class="inner">
                                            <div class="product-details__review-form">
                                                <h3 class="product-details__review-form__title">Add Your Comments</h3>
                                                <p class="product-details__review-form__text">Your Email address will not be published.</p>
                                                <form method="post" class="contact-one__form">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <p class="contact-one__field">
                                                                <label>Your Name</label>
                                                                <input type="text" name="Name">
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="contact-one__field">
                                                                <label>Email</label>
                                                                <input type="email" name="Email">
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <p class="contact-one__field">
                                                                <label>Your Comments</label>
                                                                <textarea name="Comment" required></textarea>
                                                                <button type="submit" name="AddComment" class="thm-btn contact-one__btn"> Comment </button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Products -->
        <section class="related-product">
            <div class="container">
                <h3 class="related-product__title">Related Products</h3>
                <div class="related-product__carousel owl-carousel owl-theme">
                        <?php
                        $SelectProducts = "SELECT giftshop.* , giftcategory.Category AS CategoryName FROM giftshop 
                                        JOIN giftcategory ON giftshop.CategoryID = giftcategory.ID 
                                        ORDER BY Price DESC
                                        LIMIT 12
                                        ";
                        $RunQuery = mysqli_query($con , $SelectProducts);
                        $fetchquery = mysqli_fetch_row($RunQuery);
                        foreach($RunQuery as $Product){?>
                            <div class="item">
                                <form method="post"action="?ItemID=<?php echo $Product['ID'] ?>" enctype="multipart/form-data">
                                    <div class="product-one__single">
                                        <div class="product-one__image">
                                            <img src="../Images/<?php echo $Product['Image'] ?>" height="270px" alt="Awesome Image" />
                                            <input type='hidden' name='Image' value="<?php echo $Product['Image'] ?>" />
                                        </div>
                                        <div class="product-one__content">
                                            <div class="product-one__content-left">
                                                <h3 class="product-one__title">
                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/Project/ProductDetails.php?ItemID=<?php echo $Product['ID'] ?>"><?php echo $Product['Item'] ?></a>
                                                </h3>
                                                <p class="product-one__text">$ <?php echo $Product['Price'] ?></p>
                                                <input type='hidden' name='Price' value="<?php echo $Product['Price'] ?>" />
                                                <p class="product-one__stars">
                                                    <?php echo "Available ".$Product['Quantity'] . " In Stock"?>
                                                    <input type='hidden' name='Quantity' value="<?php echo $Product['Quantity'] ?>" />
                                                    <input type='hidden' name='CatID' value="<?php echo $Product['CategoryID'] ?>" />
                                                    <input type='hidden' name='Item' value="<?php echo $Product['Item'] ?>" />
                                                </p>
                                            </div>
                                            <div class="product-one__content-right">
                                                <button name='add_to_cart' data-toggle="tooltip" data-placement="top" title="Add to Cart" class="product-one__cart-btn"><i class="egypt-icon-supermarket"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </section>

    <?php include "../UserFooter.php" ; 
} ?>