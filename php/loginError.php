<?php

$errors = array (
    1 => "Email is not a Registered Account.",
    2 => "Your Password is Incorrect.",
    3 => "Please log in."
);

$errorMessageEmail = "";
$errorMessagePassword = "";
$errorMessageAuth = "";

$error_id = isset($_GET['error']) ? (int)$_GET['error'] : 0;
if ($error_id != 0 && array_key_exists($error_id, $errors)) {
    
  if($error_id == 1){
    $errorMessageEmail = $errors[$error_id];
  }
  else if($error_id == 2){
    $errorMessagePassword = $errors[$error_id];
  }
  else if($error_id == 3){
    $errorMessageAuth = $errors[$error_id];
  }
}

?>