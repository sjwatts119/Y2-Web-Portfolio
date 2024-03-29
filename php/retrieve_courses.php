<?php

$CIDValue = 1;

require_once("_connect.php");

//No need for prepared statement as no user data included
$sql = "SELECT courseID, courseTitle, courseDate, courseDuration, maxAttendees, courseDescription FROM courses";
$result = mysqli_query($db_connect, $sql);

echo "<br>";
echo "<table id='coursesTable' class='coursesTable'>";
echo "<td>" . "<div class='tableHeader'>Course ID</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Course Name</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Course Date</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Course Duration</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Max Attendees</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Course Description</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Participants</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Update Course</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Delete Course</div>" . "</td>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr id=row" . $row["courseID"] . ">";
    foreach ($row as $field => $value) {

        //finds value of UID for usage on the button ID
        reset($row);
        if ($field === key($row)){$CIDValue = $value;}

        //Inputs the current field into the table
        echo "<td><div class='field'>" . $value . "</div></td>"; 

        //finds last element in each row so a button can be added afterwards
        end($row);
        if ($field === key($row)){

            //adds button to end of table with ID the same as the current UID of the row for the user
            echo "<td>" . "<button type='button' class='viewUsersButton btn btn-outline-primary' data-bs-toggle='modal' data-bs-target='#participantsModal' data-bs-title='View Participants' id='" . "$CIDValue" . "'>Participants</button" . "</td>";
             //adds button to end of table with ID the same as the current UID of the row for the course
            echo "<td>" . "<button type ='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#Modal' data-bs-coursename='". $row["courseTitle"] . "' data-bs-coursedate='". $row["courseDate"] . "' data-bs-courseduration='". $row["courseDuration"] . "' data-bs-maxattendees='". $row["maxAttendees"] . "' data-bs-coursedescription='". $row["courseDescription"] . "'id='" . "$CIDValue" . "'>Update</button>" . "</td>";
            //adds button to end of table with ID the same as the current UID of the row for the course
            echo "<td>" . "<button class='deleteCourseButton btn btn-danger' id='" . "$CIDValue" . "'>Delete</button" . "</td>";
        }
    }
    echo "</tr>";
}
//Add a row to the bottom of the table with the button to add a new user.
echo "<tr>";
echo "<td><button type='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#Modal' data-bs-title='New Course'>+</button></td>";
for($iteration = 0; $iteration <8; $iteration++){
    echo "<td></td>"; 
}
echo "</tr>";
echo "</table>";

?>