<?php
    if(isset($_POST["UID"]))
    {
        include_once("_connect.php");
        $UID = $_POST["UID"];

        $query = "DELETE FROM users WHERE userID = $UID;";

        $run = mysqli_query($db_connect, $query);
    }
?>