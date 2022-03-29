<?php include_once "php/auto_redirect.php" ?>
<?php include_once "php/login_error.php" ?>

<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <!-- Link BootStrap CSS Stylesheet from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Link Main CSS Stylesheet -->
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/style.css">
  <!-- Anime.JS Animations Library -->
  <script src="https://cdn.jsdelivr.net/npm/animejs@3.0.1/lib/anime.min.js"></script>
  <!-- Google Fonts --> 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body id="stop-scrolling">
  <div class="preloader"></div>

        <div class="canvas-edit">
            <canvas></canvas>
        </div>

            <div class="form-login">
              <form class="loginForm" method="POST" name="login_form">
                <h2>Log In</h2>
              
                <label for="formEmail">Email</label>
                <input type="email" id="formEmail" name="email" placeholder="Your Email" required>

                <label for="formPassword">Password</label>
                <input type="password" id="formPassword" name="password" placeholder="Your Password" required>

                <div class="loginError" id="errorEmail" style="display:none;">Email Address not Found</div>
                <div class="loginError" id="errorPassword" style="display:none;">Your password is Incorrect</div>
                <div class="loginError" id="errorCaptcha" style="display:none;">reCaptcha score is Too Low.</div>
                <div class="loginError" id="errorAttempts" style="display:none;">Too Many Attempts, Please try again Later.</div>
                <div class="loginError"><?php echo $errorMessageAuth; ?></div>
        
                <button class="formButton" id="submitForm" type="submit">Login</button>
              </div>
            </form>
          </div>
</body>

</html>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Including BootStrap JavaScript Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- reCaptcha API -->
<script src="https://www.google.com/recaptcha/api.js?render=6LdSkBQfAAAAAEBkLlcljJTxLXzJmhmDB0QqyGij"></script>

<script src="js/scripts.js"></script>
<script src="js/login-error.js"></script>
<script rel="preconnect" src="js/preloader.js"></script>

<script>

function Login()
        {
            grecaptcha.ready(function() {
                grecaptcha.execute('6LdSkBQfAAAAAEBkLlcljJTxLXzJmhmDB0QqyGij', { action: 'submit' } ).then(function (token) {
                    $.ajax({
                        //Populates the AJAX request.
                        url: './php/_auth.php',
                        type: 'POST',
                        data: $('.loginForm').serialize() + "&token=" + token,
                        success: function (response)
                        {
                            //This function will run if the request was successful.

                            //If the server replies with 'true', redirect them to another page.
                            if (response == "true")
                            {
                                window.location.href = "secure/home.php";
                            }
                            else
                            {
                              loginError(response);
                            }
                        },
                        error: function()
                        {
                            //This function will run if the request failed.
                            alert("Error");
                        }
                    });
                });
            });
        }

        //This event will execute when a subsequent
        //form with the correct ID is submitted.

        $(".loginForm").submit(function (event) {

            //This prevents the default synchronous action.
            event.preventDefault();
            
            Login();

        });

</script>