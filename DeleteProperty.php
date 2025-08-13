<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Database connection
    $conn = new mysqli("localhost", "root", "", "rentalhousesystem");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Step 1: Get property ID(s) for this email
    $propertySql = "SELECT property_id FROM addproperty WHERE email = ?";
    $propertyStmt = $conn->prepare($propertySql);
    $propertyStmt->bind_param("s", $email);
    $propertyStmt->execute();
    $propertyResult = $propertyStmt->get_result();

    if ($propertyResult->num_rows > 0) {
        while ($propertyRow = $propertyResult->fetch_assoc()) {
            $property_id = $propertyRow['property_id'];

            // Step 2: Get all booking IDs for this property
            $bookingSql = "SELECT booking_id FROM bookings WHERE property_id = ?";
            $bookingStmt = $conn->prepare($bookingSql);
            $bookingStmt->bind_param("i", $property_id);
            $bookingStmt->execute();
            $bookingResult = $bookingStmt->get_result();

            // Step 3: Delete all payments related to these bookings
            while ($bookingRow = $bookingResult->fetch_assoc()) {
                $booking_id = $bookingRow['booking_id'];

                $deletePayments = "DELETE FROM payments WHERE booking_id = ?";
                $payStmt = $conn->prepare($deletePayments);
                $payStmt->bind_param("i", $booking_id);
                $payStmt->execute();
                $payStmt->close();
            }
            $bookingStmt->close();

            // Step 4: Delete bookings for the property
            $deleteBookings = "DELETE FROM bookings WHERE property_id = ?";
            $stmtBookings = $conn->prepare($deleteBookings);
            $stmtBookings->bind_param("i", $property_id);
            $stmtBookings->execute();
            $stmtBookings->close();

            // Step 5: Delete property photos
            $deletePhotos = "DELETE FROM property_photos WHERE property_id = ?";
            $photoStmt = $conn->prepare($deletePhotos);
            $photoStmt->bind_param("i", $property_id);
            $photoStmt->execute();
            $photoStmt->close();

            // Step 6: Finally, delete the property itself
            $deleteProperty = "DELETE FROM addproperty WHERE property_id = ?";
            $stmtProperty = $conn->prepare($deleteProperty);
            $stmtProperty->bind_param("i", $property_id);
            $stmtProperty->execute();
            $stmtProperty->close();
        }

        echo "<script>alert('✅ Property deleted successfully!'); window.location.href='AddProperty.html';</script>";
    } else {
        echo "<script>alert('❌ No property found with this email.'); window.location.href='AddProperty.html';</script>";
    }

    $propertyStmt->close();
    $conn->close();
}
?>
