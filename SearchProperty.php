<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "rentalhousesystem";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch search criteria from the form
$city = isset($_GET['city']) ? $_GET['city'] : '';
$propertyType = isset($_GET['propertyType']) ? $_GET['propertyType'] : 'any';
$minRent = isset($_GET['minRent']) ? $_GET['minRent'] : '';
$maxRent = isset($_GET['maxRent']) ? $_GET['maxRent'] : '';

// Construct SQL query to fetch properties with all images from property_photos
$query = "SELECT a.*, 
                 GROUP_CONCAT(p.photo_path ORDER BY p.id SEPARATOR ',') AS photo_paths 
          FROM addproperty a
          LEFT JOIN property_photos p ON p.property_id = a.property_id
          WHERE 1=1";

if (!empty($city)) $query .= " AND LOWER(city) LIKE LOWER('%$city%')";
if ($propertyType !== "any") $query .= " AND propertyType='$propertyType'";
if ($minRent !== '') $query .= " AND rent >= $minRent";
if ($maxRent !== '') $query .= " AND rent <= $maxRent";

$query .= " GROUP BY a.property_id";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Properties</title>
    <link rel="stylesheet" href="SearchProperty.css">
</head>
<body>

    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">StaySure</div>
        <form class="search-bar" method="GET" action="SearchProperty.php">
            <input type="text" name="city" placeholder="Search Home by city..." required>
            <button type="submit">Search</button>
        </form>
    </nav>

    <div class="container">
        <!-- Search Filters -->
        <div class="filters">
            <h3>Filter Property</h3>
            <form method="GET" action="SearchProperty.php" id="filterForm">
                <div class="filter-group">
                    <input type="text" name="city" placeholder="Enter city name">
                </div>

                <div class="filter-group">
                    <select name="propertyType">
                        <option value="any" disabled selected>Select No of bedrooms</option>
                        <option value="1RK">1RK</option>
                        <option value="1BHK">1BHK</option>
                        <option value="2BHK">2BHK</option>
                        <option value="3BHK">3BHK</option>
                        <option value="4BHK+">4BHK+</option>
                    </select>
                </div>

                <div class="filter-group">
                    <input type="number" name="minRent" placeholder="Min Rent (₹)" min="0">
                </div>

                <div class="filter-group">
                    <input type="number" name="maxRent" placeholder="Max Rent (₹)" min="0">
                </div>

                <div class="filter-buttons">
                    <button type="submit" class="filter-btn">Search</button>
                    <button type="button" class="clear-btn" onclick="clearFilters()">Clear</button>
                </div>
            </form>
        </div>

        <!-- Property Listings -->
        <div class="property-listings">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='property-card' id='property-{$row['property_id']}' data-property-id='{$row['property_id']}'>";
                    echo "<div class='property-image'>";

                    // Display multiple images in a slideshow
                    $photos = explode(",", $row['photo_paths']);
                    if (!empty($photos[0])) {
                        foreach ($photos as $index => $photo) {
                            $displayStyle = ($index === 0) ? "block" : "none";
                            echo "<img src='$photo' alt='Property Image' style='display: $displayStyle;'>";
                        }
                    } else {
                        echo "<img src='uploads/default.jpg' alt='No Image Available'>";
                    }

                    // Slideshow navigation buttons
                    echo "<button class='prev-btn' onclick='prevImage({$row['property_id']})'>&lt;</button>";
                    echo "<button class='next-btn' onclick='nextImage({$row['property_id']})'>&gt;</button>";

                    echo "</div>";
                   
                    echo "<div class='property-details'>";
                    echo "<h3>" . $row['propertyType'] . " in " . $row['city'] . "</h3>";
                    echo "<p><strong>City:</strong> " . $row['city'] . "</p>";
                    echo "<p><strong>Locality:</strong> " . $row['locality'] . "</p>";
                    echo "<p><strong>Address:</strong> " . $row['address'] . "</p>";
                    echo "<p><strong>Property Type:</strong> " . $row['propertyType'] . "</p>";
                    echo "<p><strong>Floor:</strong> " . $row['floor'] . "</p>";
                    echo "<p><strong>Bathrooms:</strong> " . $row['bathrooms'] . "</p>";
                    echo "<p><strong>Balconies:</strong> " . $row['balconies'] . "</p>";
                    echo "<p><strong>Furnishing:</strong> " . $row['furnishing'] . "</p>";
                    echo "<p><strong>Parking:</strong> " . $row['parking'] . "</p>";
                    echo "<p><strong>Wifi:</strong> " . $row['wifi'] . "</p>";
                    echo "<p><strong>Electricity:</strong> " . $row['electricity'] . "</p>";
                    echo "<p><strong>Water Supply:</strong> " . $row['water'] . "</p>";
                    if ($row['availability'] === 'Select Date') {
                        $availabilityText = !empty($row['availabilityDate']) ? date('d-m-Y', strtotime($row['availabilityDate'])) : 'Not Available';
                    } else {
                        $availabilityText = $row['availability'];
                    }
                    
                    echo "<p><strong>Availability:</strong> $availabilityText</p>";
                    echo "<p><strong>Age of Property:</strong> " . $row['age'] . "</p>";
                    echo "<p><strong>Rent:</strong> ₹" . $row['rent'] . " / month</p>";
                    echo "<p><strong>Security Deposit:</strong> ₹" . $row['security'] . "</p>";
                    echo "<p><strong>Maintenance Amount:</strong> ₹" . $row['maintenanceAmount'] . " / month</p>";
                    
                    echo "<div class='button-container'>";
                    echo "<button class='contact-btn' onclick='showOwnerInfo(this)'>Contact Owner</button>";
                    echo "<button class='book-btn' onclick='openBookingForm({$row['property_id']}, {$row['rent']}, {$row['security']})'>Book Now</button>";
                    echo "</div>";// Closing button-container div
                    echo "<div class='owner-info' style='display:none;'>"; 
                    echo "<p><strong>Owner:</strong> " . $row['name'] . "</p>";

                    echo "<div class='contact-icons'>"; 
                   
                   // WhatsApp icon
                   $countryCode = "91";
                   $whatsappNumber = preg_replace('/\D/', '', $row['mobile']);

                   if (strlen($whatsappNumber) == 10) { 
                   // If the number has only 10 digits, add the country code
                   $whatsappNumber = $countryCode . $whatsappNumber;
                   }

                    $whatsappMessage = urlencode("Hello " . $row['name'] . ", I am interested in your property. Can we discuss more details?");
                    $whatsappUrl = "https://wa.me/$whatsappNumber?text=$whatsappMessage";

                    echo "<a href='$whatsappUrl' target='_blank'>";
                    echo "<img src='icons/whatsapp.png' alt='WhatsApp' class='contact-icon'></a>";
                   // Email icon
                   echo "<a href='mailto:" . $row['email'] . "?subject=Inquiry about your rental property'>";
                   echo "<img src='icons/mail.png' alt='Email' class='contact-icon'></a>";
                   echo "</div>"; 
                   echo "</div>";

                    echo "</div>";
                    echo "</div>";
                    
                }
            } else {
                echo "<p>No properties found.</p>";
            }
            ?>
        </div>
    </div>
<!-- Booking -->
        <div id="booking-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeBookingForm()">&times;</span>
        <h2>Book Property</h2>
        <form id="booking-form" action="process_booking.php" method="POST">
            <input type="hidden" id="property_id" name="property_id">
            <input type="hidden" id="tenant_id" name="tenant_id" value="<?php echo $_SESSION['tenant_id']; ?>">

            <label>Check-in Date:</label>
            <input type="date" id="check_in" name="check_in" required>

            <label>Check-out Date:</label>
            <input type="date" id="check_out" name="check_out" required>

            <button type="submit" class="confirm-btn">Proceed to Payment</button>
        </form>
    </div>
</div>   
<!-- Booking End -->
<!-- payment -->
<div id="payment-modal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closePaymentForm()">&times;</span>
        <h2>Complete Payment</h2>
        <form id="payment-form" action="process_payment.php" method="POST">
            <input type="hidden" id="payment_tenant_id" name="tenant_id">
            <input type="hidden" id="booking_id" name="booking_id">
            
            <label>Total Amount:</label>
            <input type="text" id="total-amount" name="amount" readonly>

            <label>Payment Method:</label>
            <select name="payment_method" id="payment_method">
                <option value="Credit Card">Credit Card</option>
                <option value="UPI">UPI</option>
                <option value="Net Banking">Net Banking</option>
                <option value="Cash">Cash</option>
            </select>

            <button type="submit" class="confirm-btn">Confirm & Pay</button>
        </form>
    </div>
</div>
 <!-- payment -->
    <script>
        function nextImage(propertyId) {
            let images = document.querySelectorAll(`#property-${propertyId} .property-image img`);
            let currentIndex = [...images].findIndex(img => img.style.display === "block");
            images[currentIndex].style.display = "none";
            let nextIndex = (currentIndex + 1) % images.length;
            images[nextIndex].style.display = "block";
        }

        function prevImage(propertyId) {
            let images = document.querySelectorAll(`#property-${propertyId} .property-image img`);
            let currentIndex = [...images].findIndex(img => img.style.display === "block");
            images[currentIndex].style.display = "none";
            let prevIndex = (currentIndex - 1 + images.length) % images.length;
            images[prevIndex].style.display = "block";
        }
        function showOwnerInfo(button) {
    // Find the closest property card and locate the owner info inside it
    let propertyCard = button.closest('.property-card');
    let ownerInfo = propertyCard.querySelector('.owner-info');

    if (ownerInfo.style.display === "none" || ownerInfo.style.display === "") {
        ownerInfo.style.display = "block";   
    } else {
        ownerInfo.style.display = "none";  
        button.textContent = "Contact Owner";  
    }
}

    function clearFilters() {
    // Select all filter input fields and dropdowns
    document.querySelectorAll(".filters input, .filters select").forEach((field) => {
        if (field.type === "text" || field.type === "number") {
            field.value = ""; 
        } else if (field.tagName === "SELECT") {
            field.selectedIndex = 0; 
        }
    });

    applyFilters(); 
}
//  Booking
let currentBookingId = null; // Store booking ID for payment

    function openBookingForm(propertyId) {
        document.getElementById("property_id").value = propertyId;
        document.getElementById("booking-modal").style.display = "flex";
    }

    function closeBookingForm() {
        document.getElementById("booking-modal").style.display = "none";
    }

    function openPaymentForm(bookingId, totalAmount) {
        currentBookingId = bookingId;
        document.getElementById("booking_id").value = bookingId;
        document.getElementById("total-amount").value = "₹" + totalAmount;
        document.getElementById("payment-modal").style.display = "flex";
    }

    function closePaymentForm() {
        document.getElementById("payment-modal").style.display = "none";
    }

    document.getElementById("booking-form").addEventListener("submit", function(event) {
        event.preventDefault(); 
        let formData = new FormData(this);

        fetch("process_booking.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                closeBookingForm();
                openPaymentForm(data.booking_id, data.total_amount);
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error("Error:", error));
    });
    
    document.getElementById("payment-form").addEventListener("submit", function(event) {
    event.preventDefault(); // Prevent default form submission

    let totalAmountInput = document.getElementById("total-amount");
    let totalAmount = totalAmountInput.value.trim().replace(/[^\d.]/g, ""); // Remove ₹ and spaces

    if (totalAmount === "" || isNaN(totalAmount)) {
        alert("Invalid amount format! Please enter a valid amount.");
        return; // Stop execution if validation fails
    }

    totalAmountInput.value = totalAmount; // Send only the numeric value

    let formData = new FormData(this);

    fetch("process_payment.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        closePaymentForm();
        location.reload();
    })
    .catch(error => console.error("Error:", error));
});

    </script>
</body>
</html>
