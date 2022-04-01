<?php
    if(isset($_POST["enrolmentID"]))
    {
        include_once("_connect.php");
        $enrolmentID = $_POST["enrolmentID"];

        $query = "DELETE FROM enrolments WHERE enrolmentID = $enrolmentID;";

        $run = mysqli_query($db_connect, $query);
    }
?>