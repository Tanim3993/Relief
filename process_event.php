<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type = $_POST['type'];
    $loc = $_POST['location'];
    $sev = $_POST['severity'];
    $date = $_POST['start_date'];

    $sql = "INSERT INTO Disaster_Event (Type, Location, Severity, Start_Date) VALUES ('$type', '$loc', '$sev', '$date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
    } else {
        echo "Error: " . $conn->error;
    }
}
?>