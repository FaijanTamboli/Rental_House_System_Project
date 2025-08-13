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
$sql = "SELECT owner_id, password FROM property_owner WHERE email='$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    // Verify password 
    if ($password === $row['password']) {
        $_SESSION['owner_id'] = $row['owner_id']; // Store owner_id in session
        echo "<script>alert('Login Successful!'); window.location.href='AddProperty.html';</script>";
    } else {
        echo "<script>alert('Incorrect Password! Please try again.'); window.history.back();</script>";
    }
} else {
    echo "<script>alert('Email not found! Please register first.'); window.location.href='PropertyOwnerSignUp.html';</script>";
}

// Close connection
mysqli_close($conn);
?>
