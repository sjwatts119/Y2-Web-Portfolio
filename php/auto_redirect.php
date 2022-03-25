<?php

session_start();

if(isset($_SESSION["auth"]))
{
    $access = $_SESSION["auth"];

    if($access != "admin" or $access != "user"){
        header("Location: secure/home.php");
    }
}

?>
