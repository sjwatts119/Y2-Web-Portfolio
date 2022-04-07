<?php
    if(isset($_POST["CID"]))
    {
        include_once("_connect.php");
        $CID = mysqli_real_escape_string($db_connect,$_POST["CID"]);

        $sql = "DELETE FROM courses WHERE courseID=?";

        $stmt = $db_connect->prepare($sql); 
        $stmt->bind_param("i", $CID);
        $stmt->execute();
    }
?>