<?php

$CIDValue = 1;
$iteration = 1;

require_once("_connect.php");

$sql = "SELECT userID, email, firstName, lastName, jobTitle, access FROM users";
$coursesForTotal = mysqli_query($db_connect, $sql); 

$sql = "SELECT enrolmentID, userID, courseID FROM enrolments WHERE userID =" . $_SESSION['userID'];
$enrolments = mysqli_query($db_connect, $sql); 

echo "<br>";
echo "<table id='coursesTable' class='coursesTable'>";
echo "<td>" . "<div class='tableHeader'>Course Name</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Course Date</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Current Attendees</div>" . "</td>";
echo "<td>" . "<div class='tableHeader'>Leave Course</div>" . "</td>";

while ($row = mysqli_fetch_assoc($enrolments)) {

    $sql = "SELECT courseID, courseTitle, courseDate, courseDuration, maxAttendees, courseDescription FROM courses WHERE courseID=" . $_SESSION["userID"];
    $courses = mysqli_query($db_connect, $sql);
    $courses = $courses->fetch_assoc();

    echo "<tr id=row" . $courses["courseTitle"] . ">";

    foreach ($row as $field => $value) {

        if($iteration == 1){
            //Inputs the current field into the table
            echo "<td>" . $courses["courseTitle"] . "</td>"; 
            $iteration++;
        }
        else if($iteration == 2){
            echo "<td>" . $courses["courseDate"] . "</td>";
            $iteration++;
        }
        else if($iteration == 3){
            $sql = "SELECT enrolmentID FROM enrolments WHERE courseID=" . $courses["courseID"];
            $enrolmentTotal = mysqli_query($db_connect, $sql);
            $enrolmentTotal = mysqli_num_rows($enrolmentTotal);

            echo "<td>" . $enrolmentTotal . "</td>";
            $iteration = 1;
        }


    end($row);
        if ($field === key($row)){

            //adds button to end of table with ID the same as the current UID of the row for the course
            echo "<td>" . "<button class='deleteCourseButton btn btn-danger' id='" . "$CIDValue" . "'>Delete</button" . "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";

/*while ($row = mysqli_fetch_assoc($courses)) {
    echo "<tr id=row" . $row["courseID"] . ">";
    foreach ($row as $field => $value) {

        //finds value of UID for usage on the button ID
        reset($row);
        if ($field === key($row)){$CIDValue = $value;}

        //Inputs the current field into the table
        echo "<td>" . $value . "</td>"; 

        //finds last element in each row so a button can be added afterwards
        end($row);
        if ($field === key($row)){

            //adds button to end of table with ID the same as the current UID of the row for the course
            echo "<td>" . "<button class='deleteCourseButton btn btn-danger' id='" . "$CIDValue" . "'>Delete</button" . "</td>";
            //adds button to end of table with ID the same as the current UID of the row for the course
            echo "<td>" . "<button type ='button' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#Modal' data-bs-coursename='". $row["courseTitle"] . "' data-bs-coursedate='". $row["courseDate"] . "' data-bs-courseduration='". $row["courseDuration"] . "' data-bs-maxattendees='". $row["maxAttendees"] . "' data-bs-coursedescription='". $row["courseDescription"] . "'id='" . "$CIDValue" . "'>Update</button>" . "</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";*/

?>