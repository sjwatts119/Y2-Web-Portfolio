<?php

session_start();

//Checking if the user is logged in and if post values have been passed across.
if (!isset($_SESSION['userID'])){
    header("Location: ./login.php");
}
else if (!isset($_POST)){
    die("Missing POST Values");
}
else{
    require("_connect.php");

    //Defining variables from POST values.
    $title = mysqli_real_escape_string($db_connect,$_POST["courseTitle"]);
    $date = mysqli_real_escape_string($db_connect,$_POST["courseDate"]);

    $duration = mysqli_real_escape_string($db_connect,$_POST["courseDuration"]);
    $attendees= mysqli_real_escape_string($db_connect,$_POST["maxAttendees"]);

    $description = mysqli_real_escape_string($db_connect,$_POST["courseDescription"]);

    //The SQL statement
    $SQL = "INSERT INTO `courses` (`courseID`, `courseTitle`, `courseDate`, `courseDuration`, `maxAttendees`, `courseDescription`) VALUES (NULL, ?, ?, ?, ?, ?)";
    
    //Prepares the SQL statement for execution.
    $stmt = mysqli_prepare($connect, $SQL);
    
    mysqli_stmt_bind_param($stmt, 'ssdis', $title, $date, $duration, $attendees, $description);
    
    //Executes the prepared query.
    if (mysqli_stmt_execute($stmt))
    {
        echo "Course Created";
    }
    else
    {
        echo "Error: " . mysqli_error($connect);
    }
    
    //Closes the prepared statement.
    mysqli_stmt_close($stmt);
}

