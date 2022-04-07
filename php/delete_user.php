<?php
    if(isset($_POST["UID"]))
    {
        include_once("_connect.php");

        $UID = mysqli_real_escape_string($db_connect,$_POST["UID"]);

        $sql = "DELETE FROM users WHERE userID=?";

        $stmt = $db_connect->prepare($sql); 
        $stmt->bind_param("i", $UID);
        if($stmt->execute()){
            echo ("User deleted Successfully");
        }
    }
?>