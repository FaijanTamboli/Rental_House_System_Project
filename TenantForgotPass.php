<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";  
$password = ""; 
$dbname = "rentalhousesystem";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$email = trim($_POST['email']);
$new_password = trim($_POST['new_password']);

// Check if email exists in the database
$sql_check = "SELECT * FROM tenant WHERE email=?";
$stmt = mysqli_prepare($conn, $sql_check);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result_check = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result_check) > 0) {
    // Update password
    $sql_update = "UPDATE tenant SET password=? WHERE email=?";
    $stmt_update = mysqli_prepare($conn, $sql_update);
    mysqli_stmt_bind_param($stmt_update, "ss", $new_password, $email);

    if (mysqli_stmt_execute($stmt_update)) {
        echo "<script>alert('Password updated successfully!'); window.location.href='TenantLogin.html';</script>";
    } else {
        echo "<script>alert('Error updating password. Please try again.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Email not found! Please enter a valid registered email.'); window.history.back();</script>";
}

// Close connection
mysqli_close($conn);
?>
