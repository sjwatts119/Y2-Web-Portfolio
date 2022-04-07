<?php
session_start();

if(isset($_SESSION['auth']))
{
    if ($_SESSION['auth'] == "admin" or $_SESSION['auth'] == "user")
    {

    }
    else{
        header("Location: ../?error=1");
    }
}
else{
    header("Location: ../?error=1");
}
?>
