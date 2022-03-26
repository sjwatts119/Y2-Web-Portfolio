<?php

    //Connect to the database.
    require("_connect.php");

    //Ensure that the user has provided all required fields.
    if (!isset($_POST['txtEmail'], $_POST['txtPassword'], $_POST['token']))
    {
        die("Missing values!");
    }

    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword'];

    $captcha = $_POST['token'];
    $secretKey = '6LdSkBQfAAAAANbjGoWfyGFE_O5LnC_l8ke7sIdH';
    $reCAPTCHA = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha)));

    if ($reCAPTCHA->score <= 0.5)
    {
        die("You are a bot!");
    }

    session_start();

    if (isset($_SESSION['attempts']))
    {
        $attempts = $_SESSION['attempts'];
    }
    else
    {
        $attempts = 0;
    }

    if ($attempts >= 3)
    {
        die("Too many attempts!");
    }

    $attempts++;

    $_SESSION['attempts'] = $attempts;

    // die($reCAPTCHA->score);

    //Validating the email address.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        die("Invalid Email Address");
    }

    //Gets the user from the database.
    $SQL = "SELECT * FROM `users` WHERE `email` = '$email'";

    //Makes the query.
    $query = mysqli_query($connect, $SQL);

    //Checks if the query was successful.
    if (mysqli_num_rows($query) === 0)
    {
        die("Invalid Email or Password");
    }

    //Fetch the user's data.
    $USER = mysqli_fetch_assoc($query);

    //Check if the password is correct.
    if (password_verify($password, $USER['password']))
    {
        $_SESSION['attempts'] = 0;

        $_SESSION['userID'] = $USER['userID'];
        $_SESSION['firstName'] = $USER['firstName'];
        $_SESSION['lastName'] = $USER['lastName'];
        $_SESSION['role'] = $USER['role'];

        echo "true";
    }
    else
    {
        //if password is incorrect
        header("Location: ../index.php?error=2");
    }

?>