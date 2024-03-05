<?php
session_start();
ob_start();

$storedVerificationCode = $_SESSION['verificationCode'];
$hostname = "localhost";
$username_db = "root";
$password_db = "";
$database = "graceerp";

$conn = new mysqli($hostname, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sign Up Process

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword']) && isset($_POST['verification'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];
    $verification = $_POST['verification'];

    if ($password === $confirmPassword) {

        if (isset($storedVerificationCode) && $verification === $storedVerificationCode) {
            unset($storedVerificationCode);

            $update_query = "UPDATE erp_login SET log_pwd = ? WHERE log_id = ?";
            $stmt_update = $conn->prepare($update_query);

            if ($stmt_update) {
                $stmt_update->bind_param("ss", $password, $username);
                $stmt_update->execute();

                if ($stmt_update) {
                    echo "Password changed successfully. Go to the Login page";
                } else {
                    echo "Password reset failed or no matching record found";
                }

                $stmt_update->close();
            } else {
                echo "Password reset failed";
            }
        } else {
            echo "Incorrect verification code!";
        }
    } else {
        echo "Password and Confirm Password do not match";
    }
} else {
    echo "Please enter all fields";
}

$conn->close();
