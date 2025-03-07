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
    if(isset($_POST['AddComment'])){
        $Comment = mysqli_real_escape_string($con , $_POST['Comment']);
        $UserID = $_POST['UserID'];
        $ItemID = $_POST['ItemID'];

        if(!empty($Comment)){
            $InsertComment = "INSERT INTO shopcomments VALUES (NULL , $ItemID , $UserID , '$Comment')";
            $RunComment = mysqli_query($con , $InsertComment);
        }else{
            $EmptyComment = "Comment Cannot be Empty";
        }

    }
    if(isset($_POST['DeleteComment'])){
        $CommentID = $_POST['CommentID'];
        $UserID = $_POST['UserID'];
        $ProductID = $_POST['ProductID'];
        $DeleteComment = "DELETE FROM shopcomments
                            WHERE ID = $CommentID AND UserID = $UserID AND ProductID = $ProductID ";
        $DeleteRun = mysqli_query($con , $DeleteComment);

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
        header("Location: http://localhost/imentet-1/Pyramids/pyramids/OnlineShop.php?Page=1");
        exit();
        }

    ?>



    <?php include "./NavUserPyramids.php"; ?>

        <!-- Upper Part -->
        <div class="container">
            <ul class="list-unstyled thm-breadcrumb thm-breadcrumb__two">
                <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a></li>
                <li><a href="http://localhost/imentet-1/Pyramids/pyramids/OnlineShop.php?Page=1">Shop</a></li>
                <li><?php echo $Item['Item'] ?></li>
            </ul>
        </div>

        <!-- Item Details -->
        <section class="product-details">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-details__image">
                            <img class="img-fluid" src="images/<?php echo $Item['Image'] ?>" width="500px" height="500px" alt="Awesome Image" />
                            <a href="images/<?php echo $Item['Image'] ?>" class="product-details__img-popup img-popup">
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
                                <p class="product-details__price"><?php echo $Item['Price'] . " EGP" ?></p>
                                <p class="product-details__text">
                                    All of our products are of excellent quality, the materials used to
                                    make this <?php echo $Item['Item'] ?> are environmentally friendly and highly
                                    sustainable and recyclable.
                                </p>
                                <p class="product-details__categories">
                                    <span class="text-uppercase">Category : </span>
                                    <a href=""><?php echo $Item['CategoryName'] ?></a>
                                </p>
                                <div class="product-details__button-block">
                                    <input type='hidden' name='Quantity' value="<?php echo $Product['Quantity'] ?>" />
                                    <?php if(!isset($_POST['add_to_cart']) && $Item['Quantity'] > 0){ ?>
                                        <button name='add_to_cart' class="thm-btn product-details__cart-btn">Add to Cart <span>+</span></button>
                                    <?php }elseif(isset($_POST['add_to_cart'])){ ?>
                                        <button disabled class="thm-btn product-details__cart-btn">Added to Cart </button>
                                    <?php }elseif($Item['Quantity'] <= 0){
                                        echo "Out Of Stock" ;
                                    } ?>
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
                                            <p>All of our products are of excellent quality, the materials used to make this Othman Empire Painting are environmentally friendly and highly sustainable and recyclable.</p>
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
                                                <!-- Reviews -->
                                                <div class="product-details__review" style="margin-bottom: 40px;">
                                                    <?php 
                                                        $SelectComments = "SELECT shopcomments.* , user.Name AS UserName, user.LastName AS LastName , userimages.Image AS Image FROM shopcomments 
                                                                            JOIN user ON shopcomments.UserID = user.ID 
                                                                            LEFT JOIN userimages ON user.ID = userimages.UserID
                                                                            WHERE ProductID = $ItemID
                                                                            ORDER BY shopcomments.ID DESC
                                                                            LIMIT 3 ";
                                                        $RunSelectComments = mysqli_query($con , $SelectComments);
                                                        $CommentRow = mysqli_fetch_assoc($RunSelectComments);
                                                        foreach($RunSelectComments as $UserComment){ 
                                                            $FullNameInComments =  $UserComment['UserName'] . ' ' .  $UserComment['LastName'] ;
                                                            $Date = date('M d, Y' ,strtotime($UserComment['Date'])) ?>
                                                            <form action="" method="post" style='margin-bottom: 27px;'>
                                                                <div class="product-details__review-single">
                                                                    <input type="hidden" name="CommentID" value="<?php echo $UserComment['ID'] ?>">
                                                                    <input type="hidden" name="ProductID" value="<?php echo $UserComment['ProductID'] ?>">
                                                                    <input type="hidden" name="UserID" value="<?php echo $UserComment['UserID'] ?>">
                                                                    <div class="product-details__review-left">
                                                                        <img src="images/<?php echo $UserComment['Image'] ?>" width="70px" height="70px" alt="Awesome Image" />
                                                                    </div>
                                                                    <div class="product-details__review-right">
                                                                        <div class="product-details__review-top">
                                                                            <div class="product-details__review-top-left">
                                                                                <h3 class="product-details__review-title"><?php if(isset($FullNameInComments)){ echo $FullNameInComments ; }else{  echo $UserComment['UserName'] ; } ?></h3>
                                                                                <span class="product-details__review-sep">–</span>
                                                                                <span class="product-details__review-date"><?php echo $Date ?></span>
                                                                            </div>
                                                                            <?php if(isset($_SESSION['UserID'])){
                                                                                    if($UserComment['UserID'] == $UserID ){ ?>
                                                                                        <div class="product-details__review-top-right" style="position:absolute; right:37px">
                                                                                            <button name='DeleteComment'style="background-color: #d99578; border:none ; color:white ; border-radius: 7px; padding: 5px 14px;"> 
                                                                                                Remove
                                                                                            </button>
                                                                                        </div>
                                                                                    <?php }
                                                                            } ?>
                                                                        </div>
                                                                        <p class="product-details__review-text"><?php echo $UserComment['Comment'] ?></p>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        <?php }
                                                    ?>
                                                </div>
                                                <h3 class="product-details__review-form__title">Add Your Comment</h3>
                                                <p class="product-details__review-form__text" style="margin-bottom: 20px;">Your Email address will not be published.</p>
                                                <form method="post" class="contact-one__form">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <p class="contact-one__field">
                                                                <label>Your Name</label>
                                                                <input type="text" name="Name" placeholder="Your Full Name" value="<?php if(isset($FullName)){ echo $FullName ;} ?>" <?php if(isset($FullName)){ echo "disabled" ;} ?> />
                                                                <input type="hidden" name="UserID" value="<?php echo $UserID ?>"/>
                                                                <input type="hidden" name="ItemID" value="<?php echo $ItemID ?>"/>
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <p class="contact-one__field">
                                                                <label>Email</label>
                                                                <input type="email" name="Email" placeholder="Email Address" value="<?php if(isset($User['Email'])){ echo $User['Email'] ;} ?>" <?php if(isset($User['Email'])){ echo "disabled" ;} ?>  />
                                                            </p>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <p class="contact-one__field">
                                                                <label>Your Comment</label>
                                                                <textarea name="Comment" required></textarea>
                                                                <?php if(isset($_SESSION['UserID'])){ ?>
                                                                    <button type="submit" name="AddComment" class="thm-btn contact-one__btn"> Comment </button>
                                                                <?php }elseif(isset($_SESSION['UserID'])){ ?>
                                                                    <button type="submit" disabled class="thm-btn contact-one__btn"> Not Authorized </button>
                                                                <?php }else{ ?>
                                                                    <a href="http://localhost/imentet-1/GrandEgyptianMuseum/Backend/login.php" class="thm-btn contact-one__btn"> Sign In to Countine </a>
                                                                <?php } ?>
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
                                            <img src="images/<?php echo $Product['Image'] ?>" height="270px" alt="Awesome Image" />
                                            <input type='hidden' name='Image' value="<?php echo $Product['Image'] ?>" />
                                        </div>
                                        <div class="product-one__content">
                                            <div class="product-one__content-left">
                                                <h3 class="product-one__title">
                                                    <a href="http://localhost/imentet-1/Pyramids/pyramids/ProductDetails.php?ItemID=<?php echo $Product['ID'] ?>"><?php echo $Product['Item'] ?></a>
                                                </h3>
                                                <p class="product-one__text">EGP <?php echo $Product['Price'] ?></p>
                                                <input type='hidden' name='Price' value="<?php echo $Product['Price'] ?>" />
                                                <p class="product-one__stars">
                                                    <?php echo "Available ".$Product['Quantity'] . " In Stock"?>
                                                    <input type='hidden' name='Quantity' value="<?php echo $Product['Quantity'] ?>" />
                                                    <input type='hidden' name='CatID' value="<?php echo $Product['CategoryID'] ?>" />
                                                    <input type='hidden' name='Item' value="<?php echo $Product['Item'] ?>" />
                                                </p>
                                            </div>
                                            <div class="product-one__content-right">
                                                <?php if($Product['Quantity'] <= 0){?>
                                                    Out of Stock
                                                <?php }else{ ?>
                                                    <button name='add_to_cart' data-toggle="tooltip" data-placement="top" title="Add to Cart" class="product-one__cart-btn"><i class="egypt-icon-supermarket"></i></button>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        <?php } ?>
                </div>
            </div>
        </section>


        <!-- Error Msg -->
        <?php if(isset($EmptyComment)){ ?>
            <div class="alert alert-danger" role="alert" style="text-align: center;">
                <i class="fa fa-times fa-lg"></i>
                <?php echo $EmptyComment ?>
            </div>
        <?php  } ?>

    <?php include "./UserFooterPyramids.php" ; 

} ?>
