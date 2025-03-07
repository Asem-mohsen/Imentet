<?php

function GetTitle()
{
    global $PageTitle;
    if (isset($PageTitle)) {
        echo $PageTitle;
    } else {
        echo 'Defult';
    }
}

/*
Redirect Function [This function accept parameters]
   1/TheMsg "Which echo the error message" it might be [ERROR / Success / Warning]
   2/Seconds = seconds before the redirecting happen -by default it's 3s-
   3/URL = the link which to redirect 
*/

function RedirectIndex($TheMsg, $URL = Null, $Seconds = 3)
{

    if ($URL === Null) {
        $URL = 'Dashboard.php';
        $Link = "Home Page";  
    } else {
        if (isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER'] !== '') {
            $URL =$_SERVER['HTTP_REFERER'];
            $Link = "Previous Page";
        } else {
            $URL = 'Dashboard.php';
            $Link = "Home Page";
        }
    }
    echo  $TheMsg;
    echo "<div class='alert alert-info text-center'>
                You Will be Redirected to  " . $Link . "  After " . $Seconds  . " seconds 
        </div>";

    header("refresh:$Seconds;url=$URL");
    exit();
}

/*
   Count Number Of items function
to count number of items rows IN DB and accept TWO parameters
1-iteam that we will count
2-table that contain that item
*/
function CountItems($item , $table ){
    global $con;

    $Select = "SELECT COUNT($item) FROM $table" ;
    $Select = mysqli_query($con , $Select);

    return  mysqli_fetch_column($Select);
}


// Function that converts large into K and m 

function thousandsCurrencyFormat($num) {

    if( $num >= 1000 ) {

        $x = round($num);
        $x_number_format = number_format($x);
        $x_array = explode(',', $x_number_format);
        $x_parts = array('K', 'M', 'B', 'T');
        $x_count_parts = count($x_array) - 1;
        $x_display = $x;
        $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
        $x_display .= $x_parts[$x_count_parts - 1];
        
        return $x_display;
    }

    return $num;
}


// Divide the Name into First And Last Name
function split_name($name) {
    $name = trim($name);
    $last_name = (strpos($name, ' ') === false) ? '' : preg_replace('#.*\s([\w-]*)$#', '$1', $name);
    $first_name = trim( preg_replace('#'.preg_quote($last_name,'#').'#', '', $name ) );
    return array($first_name, $last_name);
}
?>