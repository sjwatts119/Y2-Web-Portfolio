<?php
    if(isset($_POST["CID"]))
    {
        include_once("_connect.php");
        $CID = $_POST["CID"];

        $query = "DELETE FROM courses WHERE courseID = $CID;";

        $run = mysqli_query($db_connect, $query);
    }
?>