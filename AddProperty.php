<?php
session_start(); // Start session

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentalhousesystem";

// Connect to MySQL Database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ✅ CHECK IF USER IS LOGGED IN
if (!isset($_SESSION['owner_id'])) {
    // Redirect user to login page if not logged in
    echo "<script>alert('❌ You must be logged in to post a property!'); window.location.href='PropertyOwnerLogin.html';</script>";
    exit();
}

// Display success message if redirected after adding a property
if (isset($_GET['success']) && $_GET['success'] == 1) {
    echo "<p style='color: green; font-weight: bold;'>✅ Property added successfully!</p>";
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = htmlspecialchars($_POST["name"]);
    $mobile = htmlspecialchars($_POST["mobile"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
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
    $owner_id = $_SESSION['owner_id']; // Get the logged-in owner's ID

    // ✅ Corrected SQL query and bind_param() to match columns
    $sql = "INSERT INTO addproperty 
            (owner_id, name, mobile, email, city, locality, address, propertyType, floor, bathrooms, balconies, furnishing, parking, wifi, electricity, water, availability, availabilityDate, age, rent, security, maintenanceAmount, maintenanceType) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssssiiissssssssiiis", 
        $owner_id, $name, $mobile, $email, $city, $locality, $address, 
        $propertyType, $floor, $bathrooms, $balconies, $furnishing, $parking, 
        $wifi, $electricity, $water, $availability, $availabilityDate, $age, 
        $rent, $security, $maintenanceAmount, $maintenanceType
    );

    if ($stmt->execute()) {
        $property_id = $stmt->insert_id; // Get the inserted property ID

        // ✅ File Upload Handling
        if (!empty($_FILES['photos']['name'][0])) {
            $uploadDir = "uploads/";
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true); // Create uploads directory if it doesn't exist
            }

            foreach ($_FILES['photos']['name'] as $key => $photoName) {
                $fileTmp = $_FILES['photos']['tmp_name'][$key];
                $fileType = strtolower(pathinfo($photoName, PATHINFO_EXTENSION));
                $allowedTypes = array("jpg", "jpeg", "png", "gif");

                if (in_array($fileType, $allowedTypes)) {
                    $filePath = $uploadDir . time() . "_" . basename($photoName);

                    if (move_uploaded_file($fileTmp, $filePath)) {
                        // Insert photo path into property_photos table
                        $photo_sql = "INSERT INTO property_photos (property_id, photo_path) VALUES (?, ?)";
                        $photo_stmt = $conn->prepare($photo_sql);
                        $photo_stmt->bind_param("is", $property_id, $filePath);
                        $photo_stmt->execute();
                        $photo_stmt->close();
                    }
                }
            }
        }

        // Redirect to the same page with success message
        header("Location: AddProperty.html");
        exit();
    } else {
        echo "<p style='color: red;'>❌ Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

$conn->close();
?>
