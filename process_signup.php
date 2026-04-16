<?php
// Enable errors to see why the database is rejecting your data
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    
    // Hash password for login security
    $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // IMPORTANT: Column names must match your DB exactly (Name, Email, Password, Phone_Number, Role)
    $sql = "INSERT INTO Users (Name, Email, Password, Phone_Number, Role) 
            VALUES ('$name', '$email', '$hashed_password', '$phone', '$role')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login.php");
        exit();
    } else {
        // If this prints, your database structure is different from the code
        echo "Database Error: " . $conn->error;
    }
}
?>