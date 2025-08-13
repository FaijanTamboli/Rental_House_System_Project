<?php
session_start();
$conn = new mysqli("localhost", "root", "", "rentalhousesystem");

if ($conn->connect_error) {
    die(json_encode(["status" => "error", "message" => "Database connection failed."]));
}

if (!isset($_SESSION['tenant_id'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in."]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tenant_id = $_SESSION['tenant_id'];
    $property_id = $_POST['property_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $booking_date = date("Y-m-d");
    $status = "Pending";

    // Validate check-in and check-out dates
    if (strtotime($check_out) <= strtotime($check_in)) {
        echo json_encode(["status" => "error", "message" => "Check-out date must be greater than Check-in date."]);
        exit();
    }

    // Fetch rent and deposit from the database
    $query = "SELECT rent, security FROM addproperty WHERE property_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $property_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["status" => "error", "message" => "Property not found."]);
        exit();
    }

    $property = $result->fetch_assoc();
    $total_amount = $property['rent'] + $property['security'];  // Calculate total amount

    // Insert booking details into the database
    $insert_query = "INSERT INTO bookings (tenant_id, property_id, check_in, check_out, booking_date, status) 
                     VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($insert_query);
    $stmt->bind_param("iissss", $tenant_id, $property_id, $check_in, $check_out, $booking_date, $status);
    
    if ($stmt->execute()) {
        $booking_id = $stmt->insert_id;
        echo json_encode(["status" => "success", "booking_id" => $booking_id, "total_amount" => $total_amount]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error processing booking."]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
