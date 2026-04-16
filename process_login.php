<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include 'db.php'; // Ensure db.php has the correct $dbname

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Use 'users' (plural) to match your database sidebar
    $sql = "SELECT * FROM Users WHERE Email = '$email'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        // This is the critical line that matches the SQL hash above
        if (password_verify($password, $user['Password'])) {
            $_SESSION['user_id'] = $user['User_ID'];
            $_SESSION['user_name'] = $user['Name'];
            header("Location: index.php");
            exit();
        } else {
            // Redirect back with password error
            header("Location: login.php?error=password");
            exit();
        }
    } else {
        // Redirect back with user not found error
        header("Location: login.php?error=user_not_found");
        exit();
    }
}
?>