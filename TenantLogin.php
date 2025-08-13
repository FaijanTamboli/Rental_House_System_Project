<?php
session_start(); // Start session
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
$password = trim($_POST['password']);

// Check if email exists
$sql = "SELECT * FROM tenant WHERE email = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $email);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Verify password 
    if ($password === $row['password']) {
        // ✅ Store tenant ID in session
        $_SESSION['tenant_id'] = $row['tenant_id'];

        echo "<script>alert('Login Successful!'); window.location.href='SearchProperty.php';</script>";
    } else {
        echo "<script>alert('Incorrect Password! Please try again.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Email not found! Please register first.'); window.location.href='TenantSignUp.html';</script>";
}

// Close connection
mysqli_close($conn);
?>
