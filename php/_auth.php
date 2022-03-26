<?php
if(isset($_POST["email"]) or isset($_POST["password"]))
{
    $captcha = $_POST['token'];
    $secretKey = '6LdSkBQfAAAAANbjGoWfyGFE_O5LnC_l8ke7sIdH';
    $reCAPTCHA = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha)));

    if ($reCAPTCHA->success == true && $reCAPTCHA->score >= 0.5)
    {
            //If the username and password are present, move on to checking creds against the database.
            include_once("_connect.php");
            $email = mysqli_real_escape_string($db_connect,$_POST["email"]);
            $password = mysqli_real_escape_string($db_connect,$_POST["password"]);
    
            //If passed email in invalid format, kill login attempt.
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                die ("Invalid Email Address");
            }
    
            $query = 
            "SELECT
            *
            FROM
            `users`
            WHERE
            `email` = '$email'";
    
            $run = mysqli_query($db_connect,$query);
    
            if(mysqli_num_rows($run) == 1){
                //If user account matching email is found
                $result = mysqli_fetch_assoc($run);
                if (password_verify($password, $result["password"])){
    
                    session_start();
                    $_SESSION["auth"] = $result["access"];
                    echo "true";
                }
                else{
                    //if password is incorrect
                    echo "error1";
                }
            }
            else{
                //if email not found
                echo "error2";
            }
    }
    else{
        //if recaptcha score is too low
        echo "error3";
    }

    
}
else
{
//If username and/or password NOT found, redirect user to login page.
echo "error2";
}
?>