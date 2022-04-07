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
        echo("course at capacity");
    }
    else{
        $stmt = $db_connect->prepare("INSERT INTO `enrolments` (`enrolmentID`, `userID`, `courseID`, `TIMESTAMP`) VALUES (NULL, ?, ?, 'current_timestamp()')");
                
        //Prepares the SQL statement for execution.
        $stmt->bind_param("ii", $userID, $courseID);
        
        if($stmt->execute()){
            //Closes the prepared statement.
            mysqli_stmt_close($stmt);

            $stmt = $db_connect->prepare("SELECT `email`, `firstName`, `courseDate` FROM `users` WHERE `userID` = ?");
            $stmt->bind_param("i", $userID);
            if($stmt->execute()){
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                $to = "<" . $user["email"] . ">";
                $subject = "You have been Enrolled on a Course.";

                $message = "Hello <h3>" . $user["email"] . "</h3>";
                $message .= ",</br></br>You have been successfully enrolled on course: </h3>" . $courses["courseTitle"] . "</h3>";
                $message .= ",</br></br>This course starts on: <h3>" . $courses["courseDate"] . "</h3>";
                $message .= ",</br></br>If you have any questions regarding this, please contact an admin.</h3>";
                $message .= ",</br></br>Thanks";

                $headers = 'From: <webmaster@WS296281-wad.remote.ac>' . "\r\n" .
                    'BCC: <mail@WS296281-wad.remote.ac>' . "\r\n" .
                    'Reply-To: <webmaster@WS296281-wad.remote.ac>' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $mail = mail($to, $subject, $message, $headers);
                if (!$mail){
                    echo "error with mail";
                }
                else{
                    echo "success";
                }
            }
        }
        else{
            die(mysqli_error($connect));
        }
    }
}