// File: assets/js/booking.js
// Form Validation and AJAX Submission

document.addEventListener("DOMContentLoaded", function () {
  const bookingForm = document.getElementById("bookingForm");
  const submitBtn = document.getElementById("submitBtn");
  const formMessage = document.getElementById("formMessage");

  // Real-time validation
  const inputs = {
    name: document.getElementById("name"),
    email: document.getElementById("email"),
    phone: document.getElementById("phone"),
    destination: document.getElementById("destination"),
    travel_date: document.getElementById("travel_date"),
    num_persons: document.getElementById("num_persons"),
    terms: document.getElementById("terms"),
  };

  // Validation rules
  const validators = {
    name: {
      validate: (value) => {
        if (!value.trim()) return "Name is required";
        if (value.trim().length < 3)
          return "Name must be at least 3 characters";
        if (!/^[a-zA-Z\s]+$/.test(value))
          return "Name can only contain letters and spaces";
        return "";
      },
    },
    email: {
      validate: (value) => {
        if (!value.trim()) return "Email is required";
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(value))
          return "Please enter a valid email address";
        return "";
      },
    },
    phone: {
      validate: (value) => {
        if (!value.trim()) return "Phone number is required";
        const phoneRegex = /^[0-9+\-\s()]{10,15}$/;
        if (!phoneRegex.test(value))
          return "Please enter a valid phone number (10-15 digits)";
        return "";
      },
    },
    destination: {
      validate: (value) => {
        if (!value) return "Please select a destination";
        return "";
      },
    },
    travel_date: {
      validate: (value) => {
        if (!value) return "Travel date is required";
        const selectedDate = new Date(value);
        const today = new Date();
        today.setHours(0, 0, 0, 0);
        if (selectedDate < today) return "Travel date must be in the future";
        return "";
      },
    },
    num_persons: {
      validate: (value) => {
        const num = parseInt(value);
        if (isNaN(num) || num < 1)
          return "Number of persons must be at least 1";
        if (num > 50) return "Number of persons cannot exceed 50";
        return "";
      },
    },
    terms: {
      validate: (checked) => {
        if (!checked) return "You must agree to the terms and conditions";
        return "";
      },
    },
  };

  // Show error message
  function showError(input, message) {
    const formGroup =
      input.closest(".form-group") || input.closest(".checkbox-group");
    const errorElement = formGroup.querySelector(".error-message");

    formGroup.classList.add("error");
    formGroup.classList.remove("success");

    if (errorElement) {
      errorElement.textContent = message;
      errorElement.style.display = "block";
    }
  }

  // Show success state
  function showSuccess(input) {
    const formGroup =
      input.closest(".form-group") || input.closest(".checkbox-group");
    const errorElement = formGroup.querySelector(".error-message");

    formGroup.classList.remove("error");
    formGroup.classList.add("success");

    if (errorElement) {
      errorElement.textContent = "";
      errorElement.style.display = "none";
    }
  }

  // Validate single field
  function validateField(fieldName) {
    const input = inputs[fieldName];
    if (!input) return true;

    const value = input.type === "checkbox" ? input.checked : input.value;
    const error = validators[fieldName].validate(value);

    if (error) {
      showError(input, error);
      return false;
    } else {
      showSuccess(input);
      return true;
    }
  }

  // Add real-time validation
  Object.keys(inputs).forEach((fieldName) => {
    const input = inputs[fieldName];
    if (!input) return;

    // Validate on blur
    input.addEventListener("blur", () => {
      validateField(fieldName);
    });

    // Clear error on input
    input.addEventListener("input", () => {
      const formGroup =
        input.closest(".form-group") || input.closest(".checkbox-group");
      if (formGroup.classList.contains("error")) {
        validateField(fieldName);
      }
    });

    // For checkbox
    if (input.type === "checkbox") {
      input.addEventListener("change", () => {
        validateField(fieldName);
      });
    }
  });

  // Validate all fields
  function validateForm() {
    let isValid = true;

    Object.keys(validators).forEach((fieldName) => {
      if (!validateField(fieldName)) {
        isValid = false;
      }
    });

    return isValid;
  }

  // Display form message
  function displayMessage(message, type) {
    formMessage.innerHTML = `
            <div class="alert alert-${type}">
                <i class="fas fa-${
                  type === "success" ? "check-circle" : "exclamation-circle"
                }"></i>
                ${message}
            </div>
        `;
    formMessage.style.display = "block";

    // Scroll to message
    formMessage.scrollIntoView({ behavior: "smooth", block: "center" });

    // Auto hide after 5 seconds for success messages
    if (type === "success") {
      setTimeout(() => {
        formMessage.style.display = "none";
      }, 5000);
    }
  }

  // Handle form submission
  bookingForm.addEventListener("submit", async function (e) {
    e.preventDefault();

    // Clear previous messages
    formMessage.style.display = "none";

    // Validate form
    if (!validateForm()) {
      displayMessage("Please correct the errors in the form", "error");
      return;
    }

    // Disable submit button
    submitBtn.disabled = true;
    submitBtn.innerHTML =
      '<i class="fas fa-spinner fa-spin"></i> Processing...';

    // Prepare form data
    const formData = new FormData(bookingForm);

    try {
      // Send AJAX request
      const response = await fetch("process-booking.php", {
        method: "POST",
        body: formData,
      });

      const data = await response.json();

      if (data.success) {
        // Success
        displayMessage(data.message, "success");

        // Reset form
        bookingForm.reset();

        // Remove all success/error states
        document
          .querySelectorAll(".form-group, .checkbox-group")
          .forEach((group) => {
            group.classList.remove("error", "success");
          });

        // Optional: Redirect to thank you page after 3 seconds
        setTimeout(() => {
          // window.location.href = 'thank-you.php?booking_id=' + data.booking_id;
        }, 3000);
      } else {
        // Error
        if (data.errors && Object.keys(data.errors).length > 0) {
          // Display field-specific errors
          Object.keys(data.errors).forEach((fieldName) => {
            const input = inputs[fieldName];
            if (input) {
              showError(input, data.errors[fieldName]);
            }
          });
        }

        displayMessage(
          data.message || "An error occurred. Please try again.",
          "error"
        );
      }
    } catch (error) {
      console.error("Error:", error);
      displayMessage(
        "Network error. Please check your connection and try again.",
        "error"
      );
    } finally {
      // Re-enable submit button
      submitBtn.disabled = false;
      submitBtn.innerHTML =
        '<i class="fas fa-paper-plane"></i> Submit Booking Request';
    }
  });

  // Phone number formatting
  inputs.phone.addEventListener("input", function (e) {
    let value = e.target.value.replace(/[^\d+\-\s()]/g, "");
    e.target.value = value;
  });

  // Number of persons validation on input
  inputs.num_persons.addEventListener("input", function (e) {
    let value = parseInt(e.target.value);
    if (value < 1) e.target.value = 1;
    if (value > 50) e.target.value = 50;
  });
});
