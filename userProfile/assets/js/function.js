
function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
    } else {
        passwordInput.type = "password";
    }
}


function validatePassword() {
    const passwordInput = document.getElementById("password");
    const passwordError = document.getElementById("passwordError");
    const regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
    if (!regex.test(passwordInput.value)) {
        passwordError.innerHTML = "Password must be at least 8 characters long, and include at least one uppercase letter, one lowercase letter, and one number.";
    } else {
        passwordError.innerHTML = "";
    }
}

function validateConfirmPassword() {
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const confirmPasswordError = document.getElementById("confirmPasswordError");
    const passwordInput = document.getElementById("password");
    if (confirmPasswordInput.value !== passwordInput.value) {
        confirmPasswordError.innerHTML = "Passwords do not match.";
    } else {
        confirmPasswordError.innerHTML = "";
    }
}

function populateid() {
    var fid = document.getElementById('fid').value;
    document.getElementById('username').value = fid;
}