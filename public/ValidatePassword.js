function validatePassword() {
    let password = document.getElementById("password").value;
    let confirmPassword = document.getElementById("password_confirmation").value;
    let warnings = [];
    let warningsList = document.getElementById("warningsList");

    // Clear previous warnings
    warningsList.innerHTML = '';

    // Check if passwords match
    if (password !== confirmPassword) {
        warnings.push("Passwords must match.");
    }

    // Validate password length
    if (password.length < 8) {
        warnings.push("Password must be at least 8 characters.");
    }

    // Validate password contains at least one letter
    if (!/[a-z]/i.test(password)) {
        warnings.push("Password must contain at least one letter.");
    }

    // Validate password contains at least one number
    if (!/[0-9]/.test(password)) {
        warnings.push("Password must contain at least one number.");
    }

    // If there are warnings, show them and prevent form submission
    if (warnings.length > 0) {
        // Show warnings in the form
        document.getElementById("passwordWarnings").classList.remove("hidden");

        // Add warnings to the list
        warnings.forEach(function(warning) {
            let li = document.createElement("li");
            li.textContent = warning;
            warningsList.appendChild(li);
        });

        return false; // Prevent form submission
    }

    return true; // Allow form submission if all checks pass
}