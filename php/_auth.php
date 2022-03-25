<?php
if(isset($_POST["email"]) or isset($_POST["password"]))
{
    //If the username and password are present, move on to checking creds against the database.
    include_once("_connect.php");
    $email = mysqli_real_escape_string($db_connect,$_POST["email"]);
    $password = mysqli_real_escape_string($db_connect,$_POST["password"]);

    //If passed email in invalid format, kill login attempt.
    if (filter_var($email, FILTER_VALIDATE_EMAIL)){
        die ("Invalid Email Address");
    }

    $query = 
    "SELECT
    *
    FROM
    `t_users`
    WHERE
    `email` = '$email'";

    $run = mysqli_query($db_connect,$query);

    if(mysqli_num_rows($run) == 1){
        //If user account matching email is found
        $result = mysqli_fetch_assoc($run);
        if (password_verify($password, $result["password"])){

            session_start();
            $_SESSION["auth"] = $result["access"];
            header("Location: ../secure/home.php");

        }
        else{
            header("Location: ../login.php?error=2");
        }
    }
    else{
        //if email not found
        header("Location: ../login.php?error=1");
    }
}


else
{
//If username and/or password NOT found, redirect user to login page.
header("Location: ../login.php?error=1");

}
?>