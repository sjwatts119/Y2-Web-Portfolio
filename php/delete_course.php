<?php
    if(isset($_POST["courseID"]))
    {
        include_once("_connect.php");
        $CID = $_POST["courseID"];

        $query = "DELETE FROM courses WHERE courseID = $CID;";

        $run = mysqli_query($db_connect, $query);
    }
?>