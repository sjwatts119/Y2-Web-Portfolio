<?php
    session_start();

    if($_SESSION['auth'] != "admin"){
        header("Location: /php/index.php");
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
        $password = mysqli_real_escape_string($db_connect,$_POST["password"]);
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        
        $access = mysqli_real_escape_string($db_connect,$_POST["access"]);
        $token = mysqli_real_escape_string($db_connect,$_POST["token"]);

        //Runs if the modal is for a new user 
        if($_POST['title'] == 'New User'){

                //The SQL statement
                $stmt = $db_connect->prepare("INSERT INTO `users` (`userID`, `email`, `firstName`, `lastName`, `password`, `access`, `TIMESTAMP`) VALUES (NULL, ?, ?, ?, ?, ?, current_timestamp())");
                
                //Prepares the SQL statement for execution.
                $stmt->bind_param("sssss", $email, $fname, $lname, $password, $access);
                
                //Executes the prepared query.
                $stmt->execute();
                
                //Closes the prepared statement.
                mysqli_stmt_close($stmt);
        }
        //Runs if the modal is for an existing 
        else{
                //The SQL statement
                $query = "UPDATE `users` SET `email`=?, `firstName`=?,`lastName`=?,`password`=?,`access`=?,`TIMESTAMP`=current_timestamp() WHERE `userID`=?";
                $stmt = $db_connect->prepare($query);
                //Prepares the SQL statement for execution.
                $stmt->bind_param('sssssi', $email, $fname, $lname, $password, $access, $targetID);
                
                //Executes the prepared query.
                if($stmt->execute()){
                    echo "User has been Updated";
                }
                else{
                    die(mysqli_error($connect));
                }
                
                //Closes the prepared statement.
                mysqli_stmt_close($stmt);
            }
        }
        

?>



