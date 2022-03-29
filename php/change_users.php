<?php
    session_start();

    if($_SESSION['auth'] != "admin"){
        header("Location: ./index.php");
    }
    if(empty($_POST)){
        die("Missing POST Values");
    }
    else{
        include_once("_connect.php");
        //Defining variables from POST values.

        $title = mysqli_real_escape_string($db_connect,$_POST["title"]);
        $targetID = mysqli_real_escape_string($db_connect,$_POST["targetid"]);

        $fname = mysqli_real_escape_string($db_connect,$_POST["fName"]);
        $lname = mysqli_real_escape_string($db_connect,$_POST["lName"]);
        
        $email = mysqli_real_escape_string($db_connect,$_POST["email"]);
        $jobTitle = mysqli_real_escape_string($db_connect,$_POST["jobTitle"]);

        $password = mysqli_real_escape_string($db_connect,$_POST["password"]);
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $access = mysqli_real_escape_string($db_connect,$_POST["access"]);
        $token = mysqli_real_escape_string($db_connect,$_POST["token"]);

        //Runs if the modal is for a new user 
        if($_POST['title'] == 'New User'){

                //The SQL statement
                $stmt = $db_connect->prepare("INSERT INTO `users` (`userID`, `email`, `firstName`, `lastName`, `password`, `jobTitle`, `access`, `TIMESTAMP`) VALUES (NULL, ?, ?, ?, ?, ?, ?, current_timestamp())");
                
                //Prepares the SQL statement for execution.
                $stmt->bind_param("ssssss", $email, $fname, $lname, $password, $jobTitle, $access);

                if($stmt->execute()){
                    $arr = array();
                    $arr[0] = $targetID;
                    $arr[1] = $email;
                    $arr[2] = $fname;
                    $arr[3] = $lname;
                    $arr[4] = $access;
                    $arr[6] = $jobTitle;
                    //returning true shows that this is creating a new user
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
                $query = "UPDATE `users` SET `email`=?, `firstName`=?,`lastName`=?,`password`=?,`jobTitle`=?,`access`=?,`TIMESTAMP`=current_timestamp() WHERE `userID`=?";
                $stmt = $db_connect->prepare($query);
                //Prepares the SQL statement for execution.
                $stmt->bind_param('ssssssi', $email, $fname, $lname, $password, $jobTitle, $access, $targetID);
                
                //Executes the prepared query.
                if($stmt->execute()){
                    $arr = array();
                    $arr[0] = $targetID;
                    $arr[1] = $email;
                    $arr[2] = $fname;
                    $arr[3] = $lname;
                    $arr[4] = $access;
                    $arr[6] = $jobTitle;
                    //returning false shows that this is updating an existing user, not creating a new one.
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



