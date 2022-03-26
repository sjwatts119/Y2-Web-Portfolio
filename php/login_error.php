<?php

$errors = array (
    1 => "Please log in.",
);

$errorMessageAuth = "";

$error_id = isset($_GET['error']) ? (int)$_GET['error'] : 0;
if ($error_id != 0 && array_key_exists($error_id, $errors)) {
    
  if($error_id == 1){
    $errorMessageAuth = $errors[$error_id];
  }
}

?>