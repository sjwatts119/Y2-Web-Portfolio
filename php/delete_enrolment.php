<?php
    if(isset($_POST["enrolmentID"]))
    {
        include_once("_connect.php");
        $enrolmentID = mysqli_real_escape_string($db_connect,$_POST["enrolmentID"]);

        $sql = "DELETE FROM enrolments WHERE enrolmentID=?";

        $stmt = $db_connect->prepare($sql); 
        $stmt->bind_param("i", $enrolmentID);

        if($stmt->execute()){
            echo ("Enrolment removed Successfully");
        }
    }
    else if(isset($_POST["userID"]) && isset($_POST["courseID"]))
    {
        include_once("_connect.php");
        $userID =  mysqli_real_escape_string($db_connect,$_POST["userID"]);
        $courseID =  mysqli_real_escape_string($db_connect,$_POST["courseID"]);

        $query = "DELETE FROM enrolments WHERE userID = $userID AND courseID = $courseID";

        $sql = "DELETE FROM enrolments WHERE userID =? AND courseID =?";

        $stmt = $db_connect->prepare($sql); 
        $stmt->bind_param("ii", $userID, $courseID);

        if($stmt->execute()){
            echo ("Enrolment removed Successfully");
        }
    }
?>