<?php

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
    $SQL = "UPDATE `users` SET (`userID`, `email`, `firstName`, `lastName`, `password`, `access`, `TIMESTAMP`) VALUES (NULL, ?, ?, ?, ?, ?, current_timestamp())";
    
    //Prepares the SQL statement for execution.
    $stmt = mysqli_prepare($connect, $SQL);
    
    mysqli_stmt_bind_param($stmt, 'sssss', $email, $fname, $lname, $password, $access);
    
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

