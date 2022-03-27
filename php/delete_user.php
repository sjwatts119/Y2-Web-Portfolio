<?php
    if(isset($_POST["userID"]))
    {
        include_once("_connect.php");
        $UID = $_POST["userID"];

        $query = "DELETE FROM users WHERE UID = $UID;";

        $run = mysqli_query($db_connect, $query);
    }
?>