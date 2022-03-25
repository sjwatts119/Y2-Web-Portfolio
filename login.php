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
        
            <div class="animated-elements animated-reversed" id="squarefly-1"></div>
            <div class="animated-elements animated-forward" id="squarefly-2"></div>
            <div class="animated-elements animated-reversed" id="squarefly-3"></div>
            <div class="animated-elements animated-forward" id="squarefly-4"></div>
            <div class="animated-elements animated-reversed" id="squarefly-5"></div>

            <div class="form-login">
              <form class="loginForm" method="POST" action="php/_auth.php" name="login_form">
                <h2>Log In</h2>
              
                <label for="formEmail">Email</label>
                <input type="email" id="formEmail" name="email" placeholder="Your Email" required>

                <label for="formPassword">Password</label>
                <input type="password" id="formPassword" name="password" placeholder="Your Password" required>

                <div class="loginError"><?php echo $errorMessageEmail; ?></div>
                <div class="loginError"><?php echo $errorMessagePassword; ?></div>
                <div class="loginError"><?php echo $errorMessageAuth; ?></div>
        
                <button class="formButton" id="submitForm" type="submit">Login</button>
              </div>
            </form>
          </div>
</body>

</html>

<!-- Including BootStrap JavaScript Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>