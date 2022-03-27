<?php
session_start();

if(isset($_SESSION['auth']))
{
    if ($_SESSION['auth'] == "admin"){
        //Admin access is good, page will load as normal
    }
    else if ($_SESSION['auth'] == "user"){
        header("Location: ../home.php?error=1");
    }
    else{
        header("Location: ../../index.php?error=1");
    }
}
else{
    header("Location: ../../index.php?error=1");
}
?>
