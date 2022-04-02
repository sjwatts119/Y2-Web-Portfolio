<?php

$iteration = 1;

$implodedArrayOfEnrolledCourses = implode( ',', $arrayOfEnrolledCourses);

$sql = "SELECT enrolmentID, userID, courseID FROM enrolments WHERE userID =" . $_SESSION['userID'];
$enrolments = mysqli_query($db_connect, $sql); 

$nonEnrolledCourses = "SELECT courseID, courseTitle, courseDate, maxAttendees FROM courses WHERE courseID NOT IN (" . $implodedArrayOfEnrolledCourses . ")";
$nonEnrolled = mysqli_query($db_connect, $nonEnrolledCourses); 

//If user not enrolled on any courses, display all courses in unenrolled section.
if (!$nonEnrolled){

    $sql = "SELECT courseID, courseTitle, courseDate, courseDuration, maxAttendees, courseDescription FROM courses";
    $result = mysqli_query($db_connect, $sql); 

    while ($row = mysqli_fetch_assoc($result)) {

        echo "<div id='card' class='card'>";
        echo "<div id='card-body' class='card-body'>";
    
        $sql = "SELECT courseID, courseTitle, courseDate, courseDuration, maxAttendees, courseDescription FROM courses WHERE courseID=" . $row["courseID"];
        $courses = mysqli_query($db_connect, $sql);
        $courses = $courses->fetch_assoc();
    
        for ($iteration = 1; $iteration < 4; $iteration++) {
    
            if($iteration == 1){
                //Inputs the current field into the card
                echo "<h5 class='card-title'>" . $courses["courseTitle"] . "</h5>"; 
                $iteration++;
            }
            else if($iteration == 2){
                //Inputs the current field into the card
                echo "<p class='card-text'>Course Date: " . $courses["courseDate"] . "</p>";
                $iteration++;
            }
            else if($iteration == 3){
                $sql = "SELECT enrolmentID FROM enrolments WHERE courseID=" . $courses["courseID"];
                $enrolmentTotal = mysqli_query($db_connect, $sql);
                $enrolmentTotal = mysqli_num_rows($enrolmentTotal);
    
                //Inputs the current field into the card
                echo "<p class='card-text'>Current Attendees: " . $enrolmentTotal . "/" . $courses["maxAttendees"] . "</p>";
                $iteration = 1;
            }
        }
        
        //adds button to end of table with ID the same as the current UID of the row for the course
        echo "<a href='#' class='enrolButton btn btn-primary' id='" . $row["courseID"] . "'>Enrol</a>";
        echo "<a href='#' class='moreInfoButton btn btn-secondary' id='" . $row["courseID"] . "'>View</a>";
        echo "</div>";
        echo "</div>";
    
    }

}

//If user is enrolled on courses, display only the courses they aren't enrolled on in unenrolled section.
else{
    while ($row = mysqli_fetch_assoc($nonEnrolled)) {

        echo "<div id='card' class='card'>";
        echo "<div id='card-body' class='card-body'>";
    
        $sql = "SELECT courseID, courseTitle, courseDate, courseDuration, maxAttendees, courseDescription FROM courses WHERE courseID=" . $row["courseID"];
        $courses = mysqli_query($db_connect, $sql);
        $courses = $courses->fetch_assoc();
    
        for ($iteration = 1; $iteration < 4; $iteration++) {
    
            if($iteration == 1){
                //Inputs the current field into the card
                echo "<h5 class='card-title'>" . $courses["courseTitle"] . "</h5>"; 
                $iteration++;
            }
            else if($iteration == 2){
                //Inputs the current field into the card
                echo "<p class='card-text'>Course Date: " . $courses["courseDate"] . "</p>";
                $iteration++;
            }
            else if($iteration == 3){
                $sql = "SELECT enrolmentID FROM enrolments WHERE courseID=" . $courses["courseID"];
                $enrolmentTotal = mysqli_query($db_connect, $sql);
                $enrolmentTotal = mysqli_num_rows($enrolmentTotal);
    
                //Inputs the current field into the card
                echo "<p class='card-text'>Current Attendees: " . $enrolmentTotal . "/" . $courses["maxAttendees"] . "</p>";
                $iteration = 1;
            }
        }
        
        //adds button to end of table with ID the same as the current UID of the row for the course
        echo "<a href='#' class='enrolButton btn btn-primary' id='" . $row["courseID"] . "'>Enrol</a>";
        echo "<a href='#' class='moreInfoButton btn btn-secondary' id='" . $row["courseID"] . "'>View</a>";
        echo "</div>";
        echo "</div>";
    
    }
}



?>