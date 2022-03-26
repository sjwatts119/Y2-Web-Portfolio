<?php
session_start();

if(isset($_SESSION["auth"]))
{
    $access = $_SESSION["auth"];

    if($access != "admin" or $access != "user"){
        //Access is good, webpage will load as normal.
    }
    else{
        header("Location: ../index.php?error=3");
    }
}
else{
    header("Location: ../index.php?error=3");
}
?>
