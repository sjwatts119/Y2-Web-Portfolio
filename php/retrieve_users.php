<?php

$UIDValue = 1;

require_once("_connect.php");

$sql = "SELECT userID, email, firstName, lastName, access FROM users";
$result = mysqli_query($db_connect, $sql); 
echo "<br>";
echo "<table id='usersTable' class='usersTable'>";
echo "<td>" . "<div class='tableHeader'>User ID</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Email</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>First Name</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Last Name</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Access Level</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Delete User</div>" . "</td>";

while ($row = mysqli_fetch_assoc($result)) {
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
            echo "<td>" . "<button class='deleteUserButton' id='" . "$UIDValue" . "'>Delete</button" . "</td>";
            //adds button to end of table with ID the same as the current UID of the row for the user
            echo "<td>" . "<button type ='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#Modal' data-bs-firstname='". $row["firstName"] . "' data-bs-lastname='". $row["lastName"] . "' data-bs-email='". $row["email"] . "'id='" . "$UIDValue" . "'>Update</button>" . "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";

?>