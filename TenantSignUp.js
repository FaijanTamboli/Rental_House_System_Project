document.getElementById("signupForm").addEventListener("submit", function(event) {
    let name = document.querySelector("input[name='name']").value.trim();
    let email = document.querySelector("input[name='email']").value.trim();
    let password = document.querySelector("input[name='password']").value.trim();
    let confirmPassword = document.querySelector("input[name='confirmPassword']").value.trim();
    let mobile = document.querySelector("input[name='mobile']").value.trim();

    let messageDiv = document.getElementById("message");

    // Clear previous messages
    messageDiv.innerHTML = "";
    messageDiv.className = "";

    // Email Validation
    let emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        showMessage("❌ Please enter a valid email address.", "error");
        event.preventDefault();
        return;
    }

    // Password Validation (8-12 characters, 1 uppercase, 1 lowercase, 1 number, 1 special character)
    let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/;
    if (!passwordPattern.test(password)) {
        showMessage("❌ Password must be 8-12 characters and include at least 1 uppercase letter, 1 lowercase letter, 1 number, and 1 special character.", "error");
        event.preventDefault();
        return;
    }

    // Confirm Password Match
    if (password !== confirmPassword) {
        showMessage("❌ Passwords do not match.", "error");
        event.preventDefault();
        return;
    }

    // Mobile Number Validation (10 digits only)
    let mobilePattern = /^[6-9]\d{9}$/;
    if (!mobilePattern.test(mobile)) {
        showMessage("❌ Please enter a valid 10-digit mobile number.");
        event.preventDefault();
        return;
    }

    // If all validations pass, display success message
    showMessage("✅ Registration Successful!");
});

// Function to display messages on screen
function showMessage(message, type) {
    let messageDiv = document.getElementById("message");
    messageDiv.innerHTML = message;
    messageDiv.className = type === "error" ? "error-message" : "success-message";
}
