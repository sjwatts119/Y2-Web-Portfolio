<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$CIDValue = 1;

require_once("_connect.php");

//No need for prepared statement as no user data included
$sql = "SELECT userID, email, firstName, lastName, jobTitle, access FROM users";
$coursesForTotal = mysqli_query($db_connect, $sql);

//prepared statement for retrieving a users enrolment based on the user who is currently signed in.
$sql = "SELECT enrolmentID, userID, courseID FROM enrolments WHERE userID =?"; 
$stmt = $db_connect->prepare($sql); 
$stmt->bind_param("i", $_SESSION['userID']);
$stmt->execute();
$enrolments = $stmt->get_result(); 

//if no enrolments found for current user, return a card stating they can enrol on one of the available courses below.
if (mysqli_num_rows($enrolments) == 0){
    echo "<div id='card' class='card'>";
    echo "<div id='card-body' class='card-body'>";
    echo "<h5 class='card-title'>You're Currently not Enrolled on a Course.</h5>";
    echo "<p class='card-text'>You can find the range of available courses below, when you're ready, please press the Enrol button to join the course of your choosing.</p>";
    echo "</div>";
    echo "</div>";
}
else{
    while ($row = mysqli_fetch_assoc($enrolments)) {

        echo "<div id='card' class='card'>";
        echo "<div id='card-body' class='card-body'>";
    
        //No need for prepared statement as no user data included
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
                //No need for prepared statement as no user data included
                $sql = "SELECT enrolmentID FROM enrolments WHERE courseID=" . $courses["courseID"];
                $enrolmentTotal = mysqli_query($db_connect, $sql);
                $enrolmentTotal = mysqli_num_rows($enrolmentTotal);
    
                //Inputs the current field into the card
                echo "<p class='card-text'>Current Attendees: " . $enrolmentTotal . "/" . $courses["maxAttendees"] . "</p>";
            }
            else if($iteration == 5){
                //Inputs the current field into the card
                echo "<p class='card-text card-description'>Course Description: " . $courses["courseDescription"] . "</p>";
            }
        }
        //adds button to end of table with ID the same as the current UID of the row for the course
        echo "<a href='#' class='cancelEnrolmentButton btn btn-danger' id='" . $row['enrolmentID'] . "'>Cancel</a>";
        echo "</div>";
        echo "</div>";
    }
}
?>