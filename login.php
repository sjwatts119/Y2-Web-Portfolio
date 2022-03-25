<?php include_once "php/loginError.php" ?>

<!doctype html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Login</title>
  <!-- Link Main CSS Stylesheet -->
  <link rel="stylesheet" href="css/login.css">
  <!-- Link BootStrap CSS Stylesheet from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>


<body id="stop-scrolling">
  <div class="preloader"></div>
    <div class="loginFormContainer">
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

      </form>
  </div>
</body>

</html>

<!-- Including BootStrap JavaScript Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>