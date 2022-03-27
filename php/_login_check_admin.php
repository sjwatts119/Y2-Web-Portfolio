<?php
session_start();

if(isset($_SESSION["auth"]))
{
    $access = $_SESSION["auth"];

    if($access != "admin"){
        //Admin access is good, page will load as normal
    }
    else if($access != "user"){
        header("Location: ../home.php?error=1");
    }
    else{
        header("Location: ../../index.php?error=1");
    }
}
else{
    header("Location: ../index.php?error=1");
}
?>
