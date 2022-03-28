<?php include_once("../../php/_login_check_admin.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <!-- Link BootStrap CSS Stylesheet from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Link Main CSS Stylesheet -->
  <link rel="stylesheet" href="../../css/style.css">
  <!-- Link Users CSS Stylesheet -->
  <link rel="stylesheet" href="../../css/users.css">
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

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="../home.php">Home</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="#">View Participants</a></li>
                <li><a class="dropdown-item active" href="users.php">Manage Users</a></li>
                <li><a class="dropdown-item" href="courses.php">Manage Courses</a></li>
              </ul>
            <li class="nav-item">
              <a class="nav-link" href="../../php/_logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal" data-bs-title="New User">New User</button>

    <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ModalLabel">User</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="userModal" method="POST">
              <div class="mb-3">
                <label for="fName" class="col-form-label">First Name:</label>
                <input type="text" name="fName" class="form-control fName" id="fName">
              </div>
              <div class="mb-3">
                <label for="lName" class="col-form-label">Last Name:</label>
                <input type="text" name ="lName" class="form-control lName" id="lName">
              </div>
              <div class="mb-3">
                <label for="email" class="col-form-label">Email:</label>
                <input type="text" name ="email" class="form-control email" id="email">
              </div>
              <div class="mb-3">
                <label for="password" class="col-form-label">Password:</label>
                <input type="password" name ="password" class="form-control" id="password">
              </div>
              <label for="access">Access Level:</label>
              <select name="access" id="access" class="form-select access" aria-label="Default select">
                <option value="" selected>Please select...</option>
                <option value="admin">Admin Account</option>
                <option value="user">User Account</option>
              </select>
              <input type="hidden" name="token" value="<?php echo uniqid()?>">
              <input type="hidden" class="targetid" name="targetid" value="">
              <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="formButton" id="btnSubmit" class="btn btn-primary" type="submit">Submit</button>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--<div id="newUserModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <form class="formBody" method="POST" action="../php/new_user.php" name="add_user">

          <label for="fname">First Name:</label>
          <input type="text" name="fname" id="fname" required>

          <label for="lname">Last Name:</label>
          <input type="text" name="lname" id="lname" required>

          <label for="email">Email:</label>
          <input type="email" name="email" id="email" required>

          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required>

          <label for="access">Access Level:</label>
          <select name="access" id="access" required>
          <option value="" selected>Please select...</option>
          <option value="admin">Admin Account</option>
          <option value="user">User Account</option>
          </select>

          <input type="hidden" name="token" value="<?php echo uniqid()?>">

          <button class="formButton" type="submit">Add User</button>
        </form>
    </div>
  </div>

  <div id="existingUserModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <form class="formBody" method="POST" action="../php/update_user.php" name="update_user">

          <label for="fname">First Name:</label>
          <input type="text" name="fname" id="fname" required>

          <label for="lname">Last Name:</label>
          <input type="text" name="lname" id="lname" required>

          <label for="email">Email:</label>
          <input type="email" name="email" id="email" required>

          <label for="password">Password:</label>
          <input type="password" name="password" id="password" required>

          <label for="access">Access Level:</label>
          <select name="access" id="access" required>
          <option value="" selected>Please select...</option>
          <option value="admin">Admin Account</option>
          <option value="user">User Account</option>
          </select>

          <input type="hidden" name="token" value="<?php echo uniqid()?>">

          <button class="formButton" type="submit">Add User</button>
        </form>
    </div>
  </div>-->

  <div class="tableWrap"> <?php include "../../php/retrieve_users.php"?> </div>
  
</body>
</html>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Including BootStrap JavaScript Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- SWAL (Sweet Alerts) CDN LINK -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="../../js/scripts.js"></script>
<script rel="preconnect" src="../../js/preloader.js"></script>
<script src="../../js/add_user_form.js"></script>

<script>

window.onbeforeunload = function () {
  window.scrollTo(0, 0);
}

</script>