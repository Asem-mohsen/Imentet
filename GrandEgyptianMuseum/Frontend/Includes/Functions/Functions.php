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



?>