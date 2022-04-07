<?php
    session_start();

    if($_SESSION['auth'] != "admin"){
        header("Location: ./index");
    }
    if(empty($_POST)){
        die("Missing POST Values");
    }
    else{
        include_once("_connect.php");
        //Defining variables from POST values.

        $title = mysqli_real_escape_string($db_connect,$_POST["title"]);
        $targetID = mysqli_real_escape_string($db_connect,$_POST["targetid"]);

        $courseName = mysqli_real_escape_string($db_connect,$_POST["courseName"]);
        
        $courseDate = mysqli_real_escape_string($db_connect,$_POST["courseDate"]);
        $courseDuration = mysqli_real_escape_string($db_connect,$_POST["courseDuration"]);

        $maxAttendees = mysqli_real_escape_string($db_connect,$_POST["maxAttendees"]);
        $courseDescription = mysqli_real_escape_string($db_connect,$_POST["courseDescription"]);
        
        $token = mysqli_real_escape_string($db_connect,$_POST["token"]);

        //Runs if the modal is for a new Course 
        if($_POST['title'] == 'New Course'){

                //The SQL statement
                $stmt = $db_connect->prepare("INSERT INTO `courses` (`courseID`, `courseTitle`, `courseDate`, `courseDuration`, `maxAttendees`, `courseDescription`) VALUES (NULL, ?, ?, ?, ?, ?)");
                
                //Prepares the SQL statement for execution.
                $stmt->bind_param("sssss", $courseName, $courseDate, $courseDuration, $maxAttendees, $courseDescription);

                if($stmt->execute()){
                    $arr = array();
                    $arr[0] = $targetID;
                    $arr[1] = $courseName;
                    $arr[2] = $courseDate;
                    $arr[3] = $courseDuration;
                    $arr[4] = $maxAttendees;
                    $arr[6] = $courseDescription;
                    //returning true shows that this is creating a new Course
                    $arr[5] = true;

                    echo json_encode($arr);

                    //Closes the prepared statement.
                    mysqli_stmt_close($stmt);
                }
                else{
                    die(mysqli_error($connect));
                }
        }
        //Runs if the modal is for an existing user
        else{
                //The SQL statement
                $query = "UPDATE `courses` SET `courseTitle`=?, `courseDate`=?,`courseDuration`=?,`maxAttendees`=?,`courseDescription`=? WHERE `courseID`=?";
                $stmt = $db_connect->prepare($query);
                //Prepares the SQL statement for execution.
                $stmt->bind_param('sssssi', $courseName, $courseDate, $courseDuration, $maxAttendees, $courseDescription, $targetID);
                
                //Executes the prepared query.
                if($stmt->execute()){
                    $arr = array();
                    $arr[0] = $targetID;
                    $arr[1] = $courseName;
                    $arr[2] = $courseDate;
                    $arr[3] = $courseDuration;
                    $arr[4] = $maxAttendees;
                    $arr[6] = $courseDescription;
                    //returning false shows that this is updating an existing course, not creating a new one.
                    $arr[5] = false;

                    echo json_encode($arr);
                }
                else{
                    die(mysqli_error($connect));
                }
                
                //Closes the prepared statement.
                mysqli_stmt_close($stmt);
            }
        }
        

?>



