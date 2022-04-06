<?php

$CIDValue = 1;
$arrayOfEnrolledCourses = [];

require_once("_connect.php");

$sql = "SELECT userID, email, firstName, lastName, jobTitle, access FROM users";
$coursesForTotal = mysqli_query($db_connect, $sql); 

$sql = "SELECT enrolmentID, userID, courseID FROM enrolments WHERE userID =" . $_SESSION['userID'];
$enrolments = mysqli_query($db_connect, $sql); 

while ($row = mysqli_fetch_assoc($enrolments)) {

    echo "<div id='card' class='card'>";
    echo "<div id='card-body' class='card-body'>";

    $sql = "SELECT courseID, courseTitle, courseDate, courseDuration, maxAttendees, courseDescription FROM courses WHERE courseID=" . $row["courseID"];
    $courses = mysqli_query($db_connect, $sql);
    $courses = $courses->fetch_assoc();

    //Iterating through each column on the table and outputting it into a card
    for ($iteration = 1; $iteration < 6; $iteration++) {

        if($iteration == 1){
            //Inputs the current field into the card
            echo "<h5 class='card-title'>" . $courses["courseTitle"] . "</h5>"; 
        }
        else if($iteration == 2){
            //Inputs the current field into the card
            echo "<p class='card-text'>Course Date: " . $courses["courseDate"] . "</p>";
        }
        else if($iteration == 3){
            //Inputs the current field into the card
            echo "<p class='card-text'>Course Duration (Weeks): " . $courses["courseDuration"] . "</p>";
        }
        else if($iteration == 4){
            //find number of enrolments for current course to figure out if the course is at capacity or not.
            $sql = "SELECT enrolmentID FROM enrolments WHERE courseID=" . $courses["courseID"];
            $enrolmentTotal = mysqli_query($db_connect, $sql);
            $enrolmentTotal = mysqli_num_rows($enrolmentTotal);

            //Inputs the current field into the card
            echo "<p class='card-text'>Current Attendees: " . $enrolmentTotal . "/" . $courses["maxAttendees"] . "</p>";
        }
        else if($iteration == 5){
            //Inputs the current field into the card
            echo "<p class='card-text'>Coruse Description: " . $courses["courseDescription"] . "</p>";
        }
    }
    //adds button to end of table with ID the same as the current UID of the row for the course
    echo "<a href='#' class='cancelEnrolmentButton btn btn-danger' id='" . $row['enrolmentID'] . "'>Cancel</a>";
    echo "</div>";
    echo "</div>";
    array_push($arrayOfEnrolledCourses, $row["courseID"]);
}
$arrayOfEnrolledCourses = array_unique($arrayOfEnrolledCourses);

?>