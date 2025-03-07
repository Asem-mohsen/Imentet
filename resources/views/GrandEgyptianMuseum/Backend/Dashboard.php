<?php
ob_start();
session_start();
session_regenerate_id();
$PageTitle = "Dashboard";

include "./DatabaseConnection/Connection.php";
include "./Functions/Functions.php";

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

<?php include './NavAdmin.php'; ?> 
    <div class="page d-flex">
        <div class="content-area w-full overflow-h">
            <h1 class="p-relative inDashboard">Dashboard</h1>
            
                    <?php 
                        $CountUsers = "SELECT * FROM user" ;
                        $Users = mysqli_query($con ,$CountUsers);
                        $NumUsers = mysqli_num_rows($Users);

                        $CountEmployees = "SELECT * FROM applications WHERE Approved = 1 " ;
                        $Employees = mysqli_query($con ,$CountEmployees);
                        $NumEmployees = mysqli_num_rows($Employees);

                        $Countsponsorships = "SELECT * FROM sponsorship" ;
                        $Sponsorship = mysqli_query($con ,$Countsponsorships);
                        $NumSponsorship = mysqli_num_rows($Sponsorship);

                        $CountGiftshop = "SELECT * FROM giftshop" ;
                        $Giftshop = mysqli_query($con ,$CountGiftshop);
                        $NumGiftshop = mysqli_num_rows($Giftshop);
                        
                    ?>
                <div class="Total bg-white rad-10 txt-c-mobile dis-block-mobile">
                    <div class="TotalBox TotalUsers">
                        <div class="d-flex p-20 space-between ">
                            <div class="TotalInfo">
                                <span class="TotalUsers"><?php echo thousandsCurrencyFormat($NumUsers) ?></span>
                                <i class="fa fa-user fa-fw fa-2x TotalUsers"></i>
                                <a href="./Users.php?action=Manage" class="TotalLink">Users</a>
                            </div>
                        </div>                        
                    </div>
                    <div class="TotalBox TotalCareers">
                        <div class="p-20  d-flex space-between ">
                            <div class="TotalInfo">
                                <span class="TotalCareers"><?php echo thousandsCurrencyFormat($NumEmployees) ?></span>
                                <i class="fa-solid fa-user-tie TotalCareers"></i>
                                <a href="./Careers.php?action=Manage" class="TotalLink">Employees</a>
                            </div>
                        </div>
                    </div>
                    <div class="TotalBox TotalSpon">
                        <div class="p-20 d-flex space-between ">
                            <div class="TotalInfo">
                                <span class="TotalSpon"><?php echo thousandsCurrencyFormat($NumSponsorship) ?></span>
                                <i class="fa-solid fa-play TotalSpon"></i>
                                <a href="./Sponsorship.php?action=Manage" class="TotalLink">Sponsorships</a>
                            </div>
                        </div>
                    </div>
                    <div class="TotalBox TotalProducts">
                        <div class="p-20 d-flex space-between ">
                            <div class="TotalInfo">
                                <span class="TotalProducts"><?php echo thousandsCurrencyFormat($NumGiftshop) ?></span>
                                <i class="fa-solid fa-tag TotalProducts"></i>
                                <a href="./GiftShop.php?action=CheckAll" class="TotalLink">Products</a>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="wrapper d-grid gap-20">
                    <div class="welcome bg-white rad-10 txt-c-mobile dis-block-mobile">
                        <div class="intro p-20 d-flex space-between bg-eee">
                            <div>
                                <h2 class="m-0 c-black">Welcome</h2>
                                <p class="c-gray"><?php echo $row['Name'] ?></p>
                            </div>
                            <img class="hide-mobile" src="images/welcome.png" alt="" />
                        </div>
                        <img class="avatar" src="images/AdminImages/<?php echo $row['Image'] ?>" alt="" />
                        <div class="body txt-center d-flex p-20 mt-20 mb-20 dis-block-mobile">
                            <div>
                                <?php echo $row['Name'] ?><span class="d-block fs-14 c-gray mt-20">
                                    <?php echo $row['RoleName'] ?>
                                </span>
                            </div>
                        </div>
                        <a href="./Profile.php?action=Manage&AdminID=<?php echo $AdminID ?>" class="visit d-block fs-14 bg-blue c-white w-fit btn btn-primary">Profile</a>
                    </div>
                        
                        <?php 
                            $CountEventsTickets = "SELECT * FROM entertainmnetticket" ;
                            $EventsTickets = mysqli_query($con ,$CountEventsTickets);
                            $NumEventsTickets = mysqli_num_rows($EventsTickets);

                            $CountVisitTickets = "SELECT * FROM visitticket" ;
                            $VisitTickets = mysqli_query($con ,$CountVisitTickets);
                            $NumVisitTickets = mysqli_num_rows($VisitTickets);

                            $Total = $NumEventsTickets + $NumVisitTickets ;
                        ?>
                    <div class="tickets p-20 bg-white rad-10">
                        <h2 class="mt-0 mb-10 c-black">Tickets Statistics</h2>
                        <p class="c-gray fs-14 mb-20 mt-0">Everything About Tickets</p>
                        <div class="d-flex gap-20 txt-center f-wrap">
                            <div class="box p-20 rad-10 fs-13 c-gray  bo">
                                <i class="fa-regular fa-rectangle-list fa-2x mb-10 c-orange"></i>
                                <span class="d-block c-b fw-bold fs-25 mb-5"><?php echo $Total?></span>
                                Total Tickets
                            </div>

                            <div class="box p-20 rad-10 fs-13 c-gray bo">
                            <i class="fa-solid fa-plane fa-2x mb-10 c-blue"></i>
                                <span class="d-block c-b fw-bold fs-25 mb-5"><?php echo $NumVisitTickets?></span>
                                <a href="./Tickets.php?action=Visit" class="txt-d-none">Visits</a> 
                            </div>

                            <div class="box p-20 rad-10 fs-13 c-gray bo">
                                <i class="fa-solid fa-globe fa-2x mb-10 c-green"></i>
                                <span class="d-block c-b fw-bold fs-25 mb-5"><?php echo $NumEventsTickets?></span>
                                <a href="./Tickets.php?action=Entertainment" class="txt-d-none">Entertainments</a> 
                            </div>
                        </div>
                    </div>

                    <?php 
                            $SelectQuery = "SELECT * FROM entertainmnet ORDER BY Date DESC LIMIT 4 " ;
                            $Select = mysqli_query($con , $SelectQuery);
                            $rows = mysqli_fetch_row($Select);
                    ?>
                    <div class="latest p-20 bg-white rad-10 txt-c-mobile">
                        <h2 class="mt-0 mb-20 c-black">Latest Events</h2>
                            <?php foreach($Select as $Event){ ?>
                        <div class="new-row d-flex align-center bo-bottom">
                            <img class="bo rad-6 mr-15" src="./Images/<?php echo $Event['Image'] ?>" alt="">
                            <div class="info">
                                <h3 class="fs-15 mb-5 c-black"><?php echo $Event['Name'] ?></h3>
                                <p class="c-gray m-0 fs-14 "><?php echo $Event['Date'] ?></p>
                            </div>
                            <div class="fs-13">
                                <a href="./Entertainments.php?action=MoreInfo&EventID=<?php echo $Event['ID'] ; ?>" class="btn btn-outline-primary txt-d-none"> Check </a> </div>
                        </div>
                            <?php } ?>
                    </div>

                    <?php 
                        $Select = "SELECT feedback .* , user.Name AS UserName , user.ID AS UserID , entertainmnet.Name AS EntertainmentName , entertainmnet.ID AS EntertainmentID FROM feedback 
                                    LEFT JOIN user ON feedback.UserID = user.ID
                                    LEFT JOIN entertainmnet ON feedback.EntertainmnetID = entertainmnet.ID
                                    ORDER BY feedback.ID DESC LIMIT 4
                        ";
                        $FeedbackQuery = mysqli_query($con , $Select);
                        $fecthquery = mysqli_fetch_assoc($FeedbackQuery);
                    ?>
                    <div class="Feedbacks p-20 bg-white rad-10">
                        <h2 class="mt-0 mb-10 c-black">Latest Feedback</h2>
                        <?php foreach($FeedbackQuery as $Feedback){ ?>
                        <div class="Feedback">
                            <div class="UserImg">
                                <img class="avatar" src="images/avatar.png" alt="" />
                                <a href="./Users.php?action=MoreInfo&UserID=<?php echo $Feedback['UserID'] ?>" class="c-gray" ><?php echo $Feedback['UserName'] ?></a>
                            </div>
                            <div class="details">
                                <input type="text" disabled name="Feedback" value="<?php echo $Feedback['Description'] ?>">
                                <a href="./Entertainments.php?action=MoreInfo&EventID=<?php echo $Feedback['EntertainmentID'] ; ?>"> <?php echo "On " . $Feedback['EntertainmentName'] . " Event" ?> </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
            </div>
            <?php if($AdminRole != 4 ){ ?>
                <h1 class="inDashboard">Financial Analysis</h1>
                    <?php 
                        $SumDonations = "SELECT SUM(Amount) AS TotalAmount FROM donations" ;
                        $Donations = mysqli_query($con ,$SumDonations);
                        $row = mysqli_fetch_array($Donations);

                        $SumEvents = "SELECT SUM(Price) AS TotalMoney FROM entertainmnetticket " ;
                        $TotalSumEvents = mysqli_query($con ,$SumEvents);
                        $SumMoneyEvents = mysqli_fetch_array($TotalSumEvents);

                        $SumGiftShop = "SELECT SUM(useritems.Total) AS TotalMoney FROM useritems " ;
                        $Giftshop = mysqli_query($con ,$SumGiftShop);
                        $GiftshopMoney = mysqli_fetch_array($Giftshop);

                        $VisitTickets = "SELECT  SUM(visitticket.Total) AS TotalSum FROM visitticket ";
                        $VisitsQuery = mysqli_query($con ,$VisitTickets);
                        $SumMoneyVisits = mysqli_fetch_array($VisitsQuery);
                        
                        // Chart
                        $dataPoints1 = array();
                        $dataPoints2 = array();

                        $sql="SELECT Name , EgyptianPrice , ForeignPrice FROM entertainmnet ORDER BY ID DESC LIMIT 7";

                        if ($result=mysqli_query($con,$sql)){	  
                            foreach($result as $ChartRow){
                                array_push($dataPoints1, array("label"=> $ChartRow["Name"], "y"=> $ChartRow["EgyptianPrice"]));
                                array_push($dataPoints2, array("label"=> $ChartRow["Name"], "y"=> $ChartRow["ForeignPrice"]));
                            }
                        }

                        // Sales Chart
                        $dataPoints = array();

                        $sql1="SELECT giftshop.Item As Name,  giftshop.Price AS ItemPrice FROM useritems 
                        JOIN giftshop ON useritems.GiftShopID = giftshop.ID ";

                        if ($result1=mysqli_query($con,$sql1)){	  
                            foreach($result1 as $SaleRow){
                                array_push($dataPoints, array("label"=> $SaleRow["Name"], "y"=> $SaleRow["ItemPrice"]));
                            }
                        } 

                        // Donations Chart


                        $DonationArray = array();

                        $sql2="SELECT donations.UserID AS UserID , donations.Amount AS Amount , donations.Name As Name , user.Name AS UserName FROM donations
                            left JOIN user ON donations.UserID = user.ID ORDER BY Amount DESC LIMIT 6 ";
                        

                        if ($result2=mysqli_query($con,$sql2)){	  
                            foreach($result2 as $DonationRow){
                                $IfCondition = ($DonationRow['UserID'] != NULL) ? $DonationRow['UserName'] : $DonationRow['Name'] ;
                                array_push($DonationArray, array("label"=> $IfCondition, "y"=> $DonationRow["Amount"]));
                            }
                        } 

                    ?>
                    <script>





                            //Events Tickets Chart
                        window.onload = function () {
                        
                        var chart = new CanvasJS.Chart("chartContainer", {
                            animationEnabled: true,
                            exportEnabled: false,
                            theme: "light2", // "light1", "light2", "dark1", "dark2"
                            title:{
                                text: "Regular & VIP Events Price"
                            },
                            data: [{
                                type: "column", //change type to bar, line, area, pie, etc  
                                dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                            }, {
                                type: "column", //change type to bar, line, area, pie, etc  
                                dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        chart.render();

                        var SalesChart = new CanvasJS.Chart("chartContainer2", {
                            animationEnabled: true,
                            exportEnabled: false,
                            theme: "light2", // "light1", "light2", "dark1", "dark2"
                            title:{
                                text: "Sales Revenue"
                            },
                            data: [{
                                type: "line", //change type to bar, line, area, pie, etc  
                                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        SalesChart.render();
                        

                        var DonationsChart = new CanvasJS.Chart("chartContainer3", {
                            animationEnabled: true,
                            exportEnabled: false,
                            theme: "light2", // "light1", "light2", "dark1", "dark2"
                            title:{
                                text: "Donations"
                            },
                            data: [{
                                type: "area", //change type to bar, line, area, pie, etc  
                                dataPoints: <?php echo json_encode($DonationArray, JSON_NUMERIC_CHECK); ?>
                            }]
                        });
                        DonationsChart.render();
                        }

                    </script>

                <div class="TotalFinance bg-white rad-10 txt-c-mobile dis-block-mobile">
                    <div class="TotalBoxFinance Donations">
                        <div class="p-20 FinanceInfo">
                        <i class="fa-solid fa-dollar-sign "></i>
                                <div class="TotalInfo">
                                <span class="Donations"><?php echo thousandsCurrencyFormat($row['TotalAmount']) ?></span>
                                <p>Donations</p>
                            </div>
                        </div>
                    </div>
                    <div class="TotalBoxFinance Events">
                        <div class="p-20 FinanceInfo">
                        <i class="fa-solid fa-dollar-sign "></i>
                            <div class="TotalInfo">
                                <span class="Events"><?php echo thousandsCurrencyFormat($SumMoneyEvents['TotalMoney'])?></span>
                                <p>Events Tickets</p>
                            </div>
                        </div>
                    </div>
                    <div class="TotalBoxFinance ">
                        <div class="p-20 FinanceInfo">
                        <i class="fa-solid fa-dollar-sign "></i>
                            <div class="TotalInfo">
                                <span class=" mt-0"><?php echo thousandsCurrencyFormat($GiftshopMoney['TotalMoney']) ?></span>
                                <p>GiftShop</p>
                            </div>
                        </div>
                    </div>
                    <div class="TotalBoxFinance Visits">
                        <div class="p-20 FinanceInfo">
                        <i class="fa-solid fa-dollar-sign Visits"></i>
                            <div class="TotalInfo">
                                <span class="Visits"><?php echo thousandsCurrencyFormat($SumMoneyVisits['TotalSum'])?></span>
                                <p>Visit Tickets</p>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="wrapper d-grid gap-20">

                <div class="Chart1 bg-white rad-10 txt-c-mobile dis-block-mobile">
                    <div id="chart_div" class="Chart1" style="width:100%; max-width:600px; height:500px;"></div>
                </div>

                <div class="Chart2 bg-white rad-10 txt-c-mobile dis-block-mobile">
                    <div id="chartContainer" class="chart2" style="height: 370px; width: 100%;"></div>
                </div>

                <div class="Chart3 bg-white rad-10 txt-c-mobile dis-block-mobile">
                    <div id="chartContainer2" class="chart3" style="height: 370px; width: 100%;"></div>
                </div>

                <div class="Chart3 bg-white rad-10 txt-c-mobile dis-block-mobile">
                    <div id="chartContainer3" class="chart3" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
            <?php } ?>
            

    </div>

    <?php
        include './AdminFooter.php';
} else {
    header("Location: login.php");
    exit();
}
?>