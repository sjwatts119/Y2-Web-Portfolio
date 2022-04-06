<?php
    echo ($_POST["userID"]);
    echo ($_POST["courseID"]);

    if(isset($_POST["enrolmentID"]))
    {
        include_once("_connect.php");
        $enrolmentID = $_POST["enrolmentID"];

        $query = "DELETE FROM enrolments WHERE enrolmentID = $enrolmentID;";

        $run = mysqli_query($db_connect, $query);

        echo ("Enrolment removed Successfully");
    }
    else if(isset($_POST["userID"]) && isset($_POST["courseID"]))
    {
        include_once("_connect.php");
        $userID = $_POST["userID"];
        $courseID = $_POST["courseID"];

        $query = "DELETE FROM enrolments WHERE userID = $userID AND courseID = $courseID;";

        $run = mysqli_query($db_connect, $query);
        echo ("Enrolment removed Successfully");
    }
?>