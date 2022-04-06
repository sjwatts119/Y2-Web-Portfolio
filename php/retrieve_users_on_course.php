<?php

require_once("_connect.php");

$enrolledUserIDs = array();

$sql = "SELECT userID FROM enrolments WHERE courseID =" . $_POST["courseID"];
$enrolments = mysqli_query($db_connect, $sql);

while($row = mysqli_fetch_array($enrolments)){
    array_push($enrolledUserIDs, $row["userID"]);
}

$enrolledUserIDs = implode( ',', $enrolledUserIDs);

$sql = "SELECT userID, email, firstName, lastName, jobTitle FROM users WHERE userID IN (" . $enrolledUserIDs . ")";
$enrolledUsers = mysqli_query($db_connect, $sql); 

//if result is a false bool value, there are no users being returned that are enrolled on the course.
if(!$enrolledUsers){
    echo("No Users are Currently Enrolled on this Course.");
}

else{
    echo "<table id='usersTable' class='usersTable'>";
    echo "<td>" . "<div class='tableHeader'>User ID</div>" . "</td>";
    echo "<td>" . "<div class='tableHeader'>Email</div>" . "</td>";
    echo "<td>" . "<div class='tableHeader'>First Name</div>" . "</td>";
    echo "<td>" . "<div class='tableHeader'>Last Name</div>" . "</td>";
    echo "<td>" . "<div class='tableHeader'>Job Title</div>" . "</td>";
    echo "<td>" . "<div class='tableHeader'>Remove User</div>" . "</td>";
    while ($row = mysqli_fetch_assoc($enrolledUsers)) {
        echo "<tr id=row" . $row["userID"] . ">";
        foreach ($row as $field => $value) {
    
            //finds value of UID for usage on the button ID
            reset($row);
            if ($field === key($row)){$UIDValue = $value;}
    
            //Inputs the current field into the table
            echo "<td>" . $value . "</td>"; 
    
            //finds last element in each row so a button can be added afterwards
            end($row);
            if ($field === key($row)){
    
                //adds button to end of table with ID the same as the current UID of the row for the user
                echo "<td>" . "<button class='removeUserButton btn btn-danger' id='" . "$UIDValue" . "'>Remove</button" . "</td>";
            }
        }
        echo "</tr>";
    }
    echo "</table>";
}



?>