<?php
session_start();

//Iterate the attempts session variable and if it is 3 or above, prevent login.
if (isset($_SESSION['attempts']))
{
    $attempts = $_SESSION['attempts'];
}
else
{
    $attempts = 0;
}

if ($attempts > 3)
{
    echo "error4";
}
else{

    if(isset($_POST["email"]) or isset($_POST["password"]))
    {
        $captcha = $_POST['token'];
        $secretKey = '6LdSkBQfAAAAANbjGoWfyGFE_O5LnC_l8ke7sIdH';
        $reCAPTCHA = json_decode(file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha)));

        $attempts++;

        $_SESSION['attempts'] = $attempts;


        if ($reCAPTCHA->success == true && $reCAPTCHA->score >= 0.5)
        {
                //If the username and password are present, and if recaptcha score is high enough, move on to checking creds against the database.
                include_once("_connect.php");
                $email = mysqli_real_escape_string($db_connect,$_POST["email"]);
                $password = mysqli_real_escape_string($db_connect,$_POST["password"]);
        
                //If passed email in invalid format, kill login attempt.
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                    die ("Invalid Email Address");
                }
        
                    //Prepared statement for checking user credentials
                    $sql = "SELECT * FROM users WHERE email = ?"; 
                    $stmt = $db_connect->prepare($sql); 
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result(); 
        
                if(mysqli_num_rows($result) == 1){
                    //If user account matching email is found
                    $result = mysqli_fetch_assoc($result);
                    if (password_verify($password, $result["password"])){

                        $_SESSION["auth"] = $result["access"];
                        $_SESSION["userID"] = $result["userID"];
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
}
?>