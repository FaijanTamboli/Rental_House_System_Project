<?php
session_start();
$conn = new mysqli("localhost", "root", "", "rentalhousesystem");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $booking_id = $_POST['booking_id'];
    $amount = isset($_POST['amount']) ? trim($_POST['amount']) : "0";
    $amount = floatval(preg_replace('/[^\d.]/', '', $amount));
    $payment_method = $_POST['payment_method'];
    $payment_date = date("Y-m-d");

    // Fetch tenant_id from bookings table to ensure it exists
    $query = "SELECT tenant_id FROM bookings WHERE booking_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo "Invalid booking ID.";
        exit();
    }

    $row = $result->fetch_assoc();
    $tenant_id = $row['tenant_id']; // Fetch tenant_id from booking record

    $stmt->close();

    // Insert payment data into payments table
    $query = "INSERT INTO payments (tenant_id, booking_id, amount, payment_date, payment_method) 
              VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iidss", $tenant_id, $booking_id, $amount, $payment_date, $payment_method);

    if ($stmt->execute()) {
        // Update booking status to 'Confirmed' after successful payment
        $update_query = "UPDATE bookings SET status = 'Confirmed' WHERE booking_id = ?";
        $update_stmt = $conn->prepare($update_query);
        $update_stmt->bind_param("i", $booking_id);
        $update_stmt->execute();
        $update_stmt->close();

        echo "Payment Successful! Booking Confirmed.";
    } else {
        echo "Error processing payment.";
    }

    $stmt->close();
    $conn->close();
}
?>
