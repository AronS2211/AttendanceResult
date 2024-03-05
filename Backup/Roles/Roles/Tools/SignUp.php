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

            $insert_query = "INSERT INTO erp_login (log_id, log_pwd) VALUES (?, ?)";
            $stmt_insert = $conn->prepare($insert_query);
            $stmt_insert->bind_param("ss", $username, $password);

            // Check if the username already exists
            $check_username_query = "SELECT log_id FROM erp_login WHERE log_id = ?";
            $stmt_check_username = $conn->prepare($check_username_query);
            $stmt_check_username->bind_param("s", $username);
            $stmt_check_username->execute();
            $result_check_username = $stmt_check_username->get_result();

            if ($result_check_username->num_rows > 0) {
                echo "Username already exists.";
            } else {
                $stmt_insert->execute();
                echo "User registered successfully.Go to Login page";
            }

            $stmt_insert->close();
            $stmt_check_username->close();
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
?>