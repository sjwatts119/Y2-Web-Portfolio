<?php

session_start();

if($_SESSION['auth'] != "admin" && $_SESSION['auth'] != "user"){
    header("Location: ./index.php");
}
else if(empty($_POST)){
    die("Missing POST Values");
}
else{
    include_once("_connect.php");

    //Defining variables from POST values.
    $courseID = mysqli_real_escape_string($db_connect,$_POST["courseID"]);
    $userID = mysqli_real_escape_string($db_connect,$_SESSION["userID"]);

    //logic for preventing enrolment if the course is at maximum capacity.
    $sql = "SELECT enrolmentID FROM enrolments WHERE courseID=" . $courseID;
    $enrolmentTotal = mysqli_query($db_connect, $sql);
    $enrolmentTotalRows = mysqli_num_rows($enrolmentTotal);

    $sql = "SELECT courseID, courseTitle, courseDate, courseDuration, maxAttendees, courseDescription FROM courses WHERE courseID=" . $courseID;
    $courses = mysqli_query($db_connect, $sql);
    $courses = $courses->fetch_assoc();

    //if amount of users currently enrolled is higher or equal to the maximum attendees, prevent enrolling.
    if ($enrolmentTotalRows >= $courses["maxAttendees"]){
        die("Course at Capacity");
    }
    else{
        $stmt = $db_connect->prepare("INSERT INTO `enrolments` (`enrolmentID`, `userID`, `courseID`, `TIMESTAMP`) VALUES (NULL, ?, ?, 'current_timestamp()')");
                
        //Prepares the SQL statement for execution.
        $stmt->bind_param("ii", $userID, $courseID);
        
        if($stmt->execute()){
            //Closes the prepared statement.
            mysqli_stmt_close($stmt);
            echo "success";
        }
        else{
            die(mysqli_error($connect));
        }
    }
}