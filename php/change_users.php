<?php

    if(empty($_POST)){
        die("Missing POST Values");
    }
    else{
        $title = mysqli_real_escape_string($db_connect,$_POST["title"]);

        require("_connect.php");

        //if($_POST['title'] == 'New User'){
            if(1){
            session_start();

                //Defining variables from POST values.
                $fname = mysqli_real_escape_string($db_connect,$_POST["fName"]);
                $lname = mysqli_real_escape_string($db_connect,$_POST["lName"]);

                $email = mysqli_real_escape_string($db_connect,$_POST["email"]);
                $password = mysqli_real_escape_string($db_connect,$_POST["password"]);

                $password = password_hash($password, PASSWORD_DEFAULT);

                $access = mysqli_real_escape_string($db_connect,$_POST["access"]);
                $token = mysqli_real_escape_string($db_connect,$_POST["token"]);

                //The SQL statement
                $stmt = $db_connect->prepare("INSERT INTO `users` (`userID`, `email`, `firstName`, `lastName`, `password`, `access`, `TIMESTAMP`) VALUES (NULL, ?, ?, ?, ?, ?, current_timestamp())");
                
                //Prepares the SQL statement for execution.
                $stmt->bind_param("sssss", $email, $fname, $lname, $password, $access);
                
                mysqli_stmt_bind_param($stmt, 'sssss', $email, $fname, $lname, $password, $access);
                
                //Executes the prepared query.
                $stmt->execute();
                
                //Closes the prepared statement.
                mysqli_stmt_close($stmt);
            }

        else{
            session_start();

            //Checking if the user is logged in and if post values have been passed across.
            if (!isset($_SESSION['UID'])){
                header("Location: ./login.php");
            }
            else if (!isset($_POST)){
                die("Missing POST Values");
            }
            else{
                require("_connect.php");

                //Defining variables from POST values.
                $fname = mysqli_real_escape_string($db_connect,$_POST["firstName"]);
                $lname = mysqli_real_escape_string($db_connect,$_POST["lastName"]);

                $email = mysqli_real_escape_string($db_connect,$_POST["email"]);
                $password = mysqli_real_escape_string($db_connect,$_POST["password"]);

                $password = password_hash($password, PASSWORD_DEFAULT);

                $access = mysqli_real_escape_string($db_connect,$_POST["access"]);
                $token = mysqli_real_escape_string($db_connect,$_POST["token"]);

                //The SQL statement
                $SQL = "UPDATE `users` SET (`userID`, `email`, `firstName`, `lastName`, `password`, `access`, `TIMESTAMP`) WHERE userID=? VALUES (NULL, ?, ?, ?, ?, ?, current_timestamp())";
                
                //Prepares the SQL statement for execution.
                $stmt = mysqli_prepare($connect, $SQL);
                
                mysqli_stmt_bind_param($stmt, 'sssssi', $email, $fname, $lname, $password, $access, $UID);
                
                //Executes the prepared query.
                if (mysqli_stmt_execute($stmt))
                {
                    echo "User Updated";
                }
                else
                {
                    echo "Error: " . mysqli_error($connect);
                }
                
                //Closes the prepared statement.
                mysqli_stmt_close($stmt);
        }
    }

}
