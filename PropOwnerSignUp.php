<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";  
$password = ""; 
$dbname = "rentalhousesystem";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$full_name = trim($_POST['name']);
$email = trim($_POST['email']);
$password = trim($_POST['password']); 
$mobile = trim($_POST['mobile']);

// Check if email already exists
$sql_check = "SELECT * FROM property_owner WHERE email='$email'";
$result_check = mysqli_query($conn, $sql_check);

if (mysqli_num_rows($result_check) > 0) {
    echo "<script>alert('Email already registered! Try logging in.'); window.location.href='propertyOwnerLogin.html';</script>";
    exit();
}

// Insert user into the database 
$sql = "INSERT INTO property_owner (full_name, email, password, mobile) VALUES ('$full_name', '$email', '$password', '$mobile')";

if (mysqli_query($conn, $sql)) {
    echo "<script>alert('Registration Successful!'); window.location.href='propertyOwnerLogin.html';</script>";
} else {
    echo "<script>alert('Registration Failed. Please try again.'); window.history.back();</script>";
}

// Close connection
mysqli_close($conn);
?>
