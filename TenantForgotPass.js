document.getElementById("forgotPasswordForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let email = document.querySelector("input[name='email']").value.trim();
    let newPassword = document.querySelector("input[name='new_password']").value.trim();
    let confirmPassword = document.querySelector("input[name='confirm_password']").value.trim();

    // Email Validation
    let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        alert("Please enter a valid Email ID.");
        return;
    }

    // Password Validation (8-12 characters, 1 uppercase, 1 lowercase, 1 number, 1 special character)
    let passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,12}$/;
    if (!passwordPattern.test(newPassword)) {
        alert("❌ Password must be 8-12 characters with at least 1 uppercase, 1 lowercase, 1 number, and 1 special character.");
        return;
    }

    if (newPassword !== confirmPassword) {
        alert("Passwords do not match!");
        return;
    }

    // Submit the form after successful validation
    this.submit();
});
