<?php
include "./DatabaseConnection/Connection.php";

ob_start();
session_start();
session_regenerate_id();

$PageTitle = "Contact Us";

if(isset($_SESSION['UserID'])){
    $UserID = $_SESSION['UserID'];
    $SelectQuery = "SELECT * FROM user WHERE ID = $UserID LIMIT 1";
    $Select = mysqli_query($con, $SelectQuery);
    $row = mysqli_fetch_assoc($Select);
}

if(isset($_POST['Send']) && !isset($_SESSION['AdminID'])){
    $UsersQuestion = stripslashes($_POST['UsersQuestion']);
    $FirstName = stripslashes($_POST['FirstName']);
    $Email = stripslashes($_POST['Email']);

    $UsersQuestion = mysqli_real_escape_string($con , $UsersQuestion);
    $FirstName = mysqli_real_escape_string($con , $FirstName);

    $FormErrors = array();

    if(empty($_POST['Email']) || !isset($_POST['Email'])){
        $FormErrors[] = "Email Is Required";
    }

    if(empty($UsersQuestion)){
        $FormErrors[] = "Message is Required ";
    }
    if(empty($_POST['FirstName'])){
        $FormErrors[] = "Name is Required ";
    }elseif(isset($_SESSION['UserID'])){
        $Name = $row['Name'];
    }
    if(empty($_POST['Phone']) || $_POST['Phone'] == 0 || !isset($_POST['Phone']) ){
        $FormErrors[] = "Phone is Required ";
    }

    if(empty($FormErrors)){
        $InsertMessage = "INSERT INTO `q&a` (Email , UsersQuestion) VALUES( '$Email' ,'$UsersQuestion') ";
        $InsertQuery = mysqli_query($con , $InsertMessage);

        if($InsertQuery){
            $MsgSuccess =  "<div class='alert alert-success text-center'> We'll Response as soon as possible </div> ";
        }
    }

}elseif(isset($_POST['Send']) && isset($_SESSION['AdminID'])){
    $ErrorMsgOfAdmin =  "<div class='alert alert-danger text-center'> You are an Admin Why do you Need That !! </div>" ;
}

?>
    <?php include "./NavUserPyramids.php" ; ?>

        <section class="inner-banner">
            <div class="container">
                <h2 class="inner-banner__title">Contact Us</h2>
                <p class="inner-banner__text">We're always here to help you with anything you might need.</p><!-- /.inner-banner__text -->
                <ul class="list-unstyled thm-breadcrumb">
                    <li><a href="http://localhost/imentet-1/Pyramids/pyramids/index.php">Home</a></li>
                    <li><a href="http://localhost/imentet-1/Pyramids/pyramids/AboutUs.php">Pyramids</a></li>
                    <li>Contact Us</li>
                </ul>
            </div>
        </section>

        <!-- Showing Errors -->
        <?php 

            if(isset($ErrorMsgOfAdmin)){ echo $ErrorMsgOfAdmin ; }
            if(isset($MsgSuccess)){ echo $MsgSuccess ; }

            if(isset($FormErrors)){
                foreach($FormErrors as $Error){
                    echo "<div class='alert alert-danger text-center'>";
                        echo $Error;
                    echo "</div>";
                }
            }

        ?>

        <section class="contact-one">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="contact-one__main">
                            <div class="contact-one__image">
                                <img src="images/resources/membership-1.png" class="img-fluid" alt="" />
                            </div>
                            <div class="contact-one__content">
                                <div class="row no-gutters">
                                    <div class="col-lg-6">
                                        <h3 class="contact-one__title">Egypt</h3>
                                        <p class="contact-one__text">Alexandria Desert Rd, Haram, Giza Governorate X4VF+V3F</p>
                                        <p class="contact-one__text"><a href="tel:321-888-789-0123">TEL: +20-23-531-7344</a></p>
                                        <p class="contact-one__text"><a href="mailto:egyptmuseum@example.com">E-mail: Pyramids@example.com</a></p>
                                    </div>
                                    <div class="col-lg-6">
                                        <ul class="contact-one__list list-unstyled">
                                            <li><span class="contact-one__list-name">Sa & Su <span class="contact-one__list-colon">:</span></span>10am to 7.30pm</li>
                                            <li><span class="contact-one__list-name">Mo & Tu <span class="contact-one__list-colon">:</span></span>10am to 7.30pm</li>
                                            <li><span class="contact-one__list-name">We & Th <span class="contact-one__list-colon">:</span></span>10am to 7.30pm</li>
                                            <li><span class="contact-one__list-name">FR <span class="contact-one__list-colon">:</span></span>Closed</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <form method="POST" class="contact-one__form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p class="contact-one__field">
                                        <input type="hidden" name="UserID" value="<?php if(isset($_SESSION['UserID'])){ echo $User['ID'] ; } ?>">
                                        <input type="hidden" name="FirstName" value="<?php if(isset($_SESSION['UserID'])){ echo $row['Name'] ; } ?>">
                                        <input type="hidden" name="Email" value="<?php if(isset($_SESSION['UserID'])){ echo $row['Email'] ; } ?>">
                                        <input type="hidden" name="Phone" value="<?php if(isset($_SESSION['UserID']) && isset($row['Phone']) && $row['Phone'] != 0 ){ echo $row['Phone'] ; } ?>">

                                        <label>First Name:</label>
                                        <input type="text" name="FirstName"  value="<?php if(isset($row['Name'])){ echo $row['Name']; } ?>" <?php if(isset($row['Name'])){ echo "disabled" ;} ?>  >
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="contact-one__field">
                                        <label>Last Name:</label>
                                        <input type="text" name="LastName"  value="<?php if(isset($row['LastName'])){ echo $row['LastName']; } ?>" <?php if(isset($row['LastName'])){ echo "disabled" ;} ?> >
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="contact-one__field">
                                        <label>Email:</label>
                                        <input type="email" name="Email" value="<?php if(isset($row['Email'])){ echo $row['Email']; } ?>" <?php if(isset($row['Email'])){ echo "disabled" ;} ?> required>
                                    </p>
                                </div>
                                <div class="col-lg-6">
                                    <p class="contact-one__field">
                                        <label>Phone:</label>
                                        <input type="number" name="Phone" pattern="[0-9]*" value="<?php if(isset($row['Phone']) && $row['Phone'] != 0 ){ echo "0" . $row['Phone']; } ?>" <?php if(isset($row['Phone']) && $row['Phone'] != 0 ){ echo "disabled" ;} ?> >
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <p class="contact-one__field">
                                        <label>Subject:</label>
                                        <input type="text" name="subject" required>
                                    </p>
                                </div>
                                <div class="col-lg-12">
                                    <p class="contact-one__field">
                                        <label>Message:</label>
                                        <textarea name="UsersQuestion" required></textarea>
                                        <button type="submit" name='Send' class="thm-btn contact-one__btn">Send Message</button>
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        <!-- Map -->
        <div class="contact-map-one" id="map">
            <div class="container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13821.875835399496!2d31.122688!3d29.994688!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14584534984a8ad1%3A0x45764c5bc4ec261a!2sGrand%20Egyptian%20Museum!5e0!3m2!1sen!2seg!4v1681483362521!5m2!1sen!2seg" class="google-map__home" allowfullscreen></iframe>
            </div>
        </div>
        
        <br>
        <br>
        

    <?php include "./UserFooterPyramids.php" ; ?>