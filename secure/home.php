<?php include_once("../php/_login_check.php");?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Home</title>
  <!-- Link BootStrap CSS Stylesheet from CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <!-- Link Main CSS Stylesheet -->
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/home.css">
  <!-- Google Fonts --> 
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.css" integrity="sha512-TZTUnuHs1njGko8PJqZlHzqZTZd880A+BvhR1jy1v4mWB4VFKVLG/eK9LYdDjxqNLmttSC1ygmqg6rkYjnEgaQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  <meta name="viewport" content="width=device-width,initial-scale=1">
</head>

<body id="stop-scrolling">
    <div class="preloader"></div>

    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php">Enrol™</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="home.php">Home</a>
            </li>
            <li class="nav-item dropdown <?php if($_SESSION['auth'] != "admin"){echo "d-none";} ?>" id="adminDropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">Admin</a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                <li><a class="dropdown-item" href="admin/users.php">Manage Users</a></li>
                <li><a class="dropdown-item" href="admin/courses.php">Manage Courses</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../php/_logout.php">Log Out</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="titleWrapper"><h3>Your Courses</h3></div>
    <div class="tableWrap enrolled-carousel" id="enrolled"> <?php include "../php/retrieve_enrolments.php"?></div>

    <div class="titleWrapper"><h3>Available Courses</h3></div>
    <div class="tableWrap unenrolled-carousel" id="non-enrolled"> <?php include "../php/retrieve_non_enrolled.php"?></div>
    
</body>
<footer class="footer mt-auto py-5"></footer>
</html>

<!-- jQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<!-- Including BootStrap JavaScript Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- SWAL (Sweet Alerts) CDN LINK -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<!-- flickity CDN Link -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flickity/3.0.0/flickity.pkgd.min.js" integrity="sha512-achKCfKcYJg0u0J7UDJZbtrffUwtTLQMFSn28bDJ1Xl9DWkl/6VDT3LMfVTo09V51hmnjrrOTbtg4rEgg0QArA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="../js/scripts.js"></script>
<script rel="preconnect" src="../js/preloader.js"></script>
<script src="../js/add_enrolment_form.js"></script>

