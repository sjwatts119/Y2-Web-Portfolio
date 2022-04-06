<?php
//$to ,$subject and $subject are defined before including this file.
    $headers = 'From: webmaster@WS296281-wad.remote.ac'       . "\r\n" .
                 'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);
?>