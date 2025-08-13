document.addEventListener("DOMContentLoaded", function() {
  const form = document.getElementById("propertyForm");
  const mobileInput = document.querySelector("input[name='mobile']");
  const availabilityOptions = document.querySelectorAll("input[name='availability']");
  const availabilityDate = document.getElementById("availabilityDate");

  // Show date picker only when "Select Date" is chosen
  availabilityOptions.forEach(option => {
    option.addEventListener("change", function() {
      if (this.value === "Select Date") {
        availabilityDate.style.display = "block";
        availabilityDate.required = true;
      } else {
        availabilityDate.style.display = "none";
        availabilityDate.required = false;
        availabilityDate.value = "";
      }
    });
  });

  // Set custom message for mobile input on invalid event
  mobileInput.addEventListener("invalid", function(e) {
    if (mobileInput.validity.patternMismatch) {
      mobileInput.setCustomValidity("Please enter a 10 digit mobile number.");
    } else {
      mobileInput.setCustomValidity("");
    }
  });

  // Clear custom validity on input to allow revalidation
  mobileInput.addEventListener("input", function(e) {
    mobileInput.setCustomValidity("");
  });

  // Additional form validation on submit
  form.addEventListener("submit", function(event) {
    const email = form.email.value;
    const mobile = form.mobile.value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (!emailPattern.test(email)) {
      alert("Please enter a valid email address.");
      event.preventDefault();
    }
    
    if (!/^\d{10}$/.test(mobile)) {
      alert("Please enter a 10 digit mobile number.");
      event.preventDefault();
    }
  });
});
