<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalhousesystem";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("❌ Connection failed: " . $conn->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['owner_id'])) {
    echo "<script>alert('❌ Please log in to edit a property.'); window.location.href='PropertyOwnerLogin.html';</script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $mobile = htmlspecialchars($_POST["mobile"]);
    $city = htmlspecialchars($_POST["city"]);
    $locality = htmlspecialchars($_POST["locality"]);
    $address = htmlspecialchars($_POST["address"]);
    $propertyType = htmlspecialchars($_POST["propertyType"]);
    $floor = is_numeric($_POST["floor"]) ? $_POST["floor"] : 0;
    $bathrooms = is_numeric($_POST["bathrooms"]) ? $_POST["bathrooms"] : 0;
    $balconies = is_numeric($_POST["balconies"]) ? $_POST["balconies"] : 0;
    $furnishing = htmlspecialchars($_POST["furnishing"]);
    $parking = htmlspecialchars($_POST["parking"]);
    $wifi = htmlspecialchars($_POST["wifi"]);
    $electricity = htmlspecialchars($_POST["electricity"]);
    $water = htmlspecialchars($_POST["water"]);
    $availability = htmlspecialchars($_POST["availability"]);
    $availabilityDate = !empty($_POST["availabilityDate"]) ? $_POST["availabilityDate"] : NULL;
    $age = htmlspecialchars($_POST["age"]);
    $rent = is_numeric($_POST["rent"]) ? $_POST["rent"] : 0;
    $security = is_numeric($_POST["security"]) ? $_POST["security"] : 0;
    $maintenanceAmount = is_numeric($_POST["maintenanceAmount"]) ? $_POST["maintenanceAmount"] : 0;
    $maintenanceType = htmlspecialchars($_POST["maintenanceType"]);

    $owner_id = $_SESSION['owner_id'];

    // Find the property by email and owner_id
    $find_sql = "SELECT property_id FROM addproperty WHERE email = ? AND owner_id = ?";
    $find_stmt = $conn->prepare($find_sql);
    $find_stmt->bind_param("si", $email, $owner_id);
    $find_stmt->execute();
    $find_stmt->store_result();

    if ($find_stmt->num_rows > 0) {
        $find_stmt->bind_result($property_id);
        $find_stmt->fetch();

        // Update the property
        $update_sql = "UPDATE addproperty SET 
            mobile=?, city=?, locality=?, address=?, propertyType=?, floor=?, bathrooms=?, balconies=?, furnishing=?, 
            parking=?, wifi=?, electricity=?, water=?, availability=?, availabilityDate=?, age=?, rent=?, security=?, 
            maintenanceAmount=?, maintenanceType=?
            WHERE property_id=? AND owner_id=?";

        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param(
            "sssssiiissssssssiiisii",
            $mobile, $city, $locality, $address, $propertyType, $floor, $bathrooms, $balconies, $furnishing,
            $parking, $wifi, $electricity, $water, $availability, $availabilityDate, $age,
            $rent, $security, $maintenanceAmount, $maintenanceType,
            $property_id, $owner_id
        );

        if ($stmt->execute()) {
            // ✅ Photo Upload (optional)
            if (!empty($_FILES['photos']['name'][0])) {
                $uploadDir = "uploads/";
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Delete existing photos first (optional but recommended)
                $delete_photos = $conn->prepare("DELETE FROM property_photos WHERE property_id = ?");
                $delete_photos->bind_param("i", $property_id);
                $delete_photos->execute();
                $delete_photos->close();

                foreach ($_FILES['photos']['name'] as $key => $photoName) {
                    $fileTmp = $_FILES['photos']['tmp_name'][$key];
                    $fileType = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
                    $allowedTypes = array("jpg", "jpeg", "png", "gif");

                    if (in_array($fileType, $allowedTypes)) {
                        $filePath = $uploadDir . time() . "_" . basename($photoName);

                        if (move_uploaded_file($fileTmp, $filePath)) {
                            $photo_sql = "INSERT INTO property_photos (property_id, photo_path) VALUES (?, ?)";
                            $photo_stmt = $conn->prepare($photo_sql);
                            $photo_stmt->bind_param("is", $property_id, $filePath);
                            $photo_stmt->execute();
                            $photo_stmt->close();
                        }
                    }
                }
            }

            echo "<script>alert('✅ Property updated successfully!'); window.location.href='EditProperty.html';</script>";
        } else {
            echo "<p style='color:red;'>❌ Update failed: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<script>alert('❌ No property found for this email!'); window.location.href='EditProperty.html';</script>";
    }

    $find_stmt->close();
}

$conn->close();
?>
