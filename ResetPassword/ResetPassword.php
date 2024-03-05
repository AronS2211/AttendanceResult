<?php

include('../includes/config.php');
$storedVerificationCode = $_SESSION['verificationCode'];

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
                    $_SESSION['msg'] = "Password changed successfully.";
                    $_SESSION['mailsts'] = 1;
                    header('Location:../index.php');
                    exit();
                } else {
                    $_SESSION['msg'] = "Password reset failed.";
                    $_SESSION['mailsts'] = 0;
                    header('Location:../index.php');
                    exit();
                }
            } else {
                $_SESSION['msg'] = "Password reset failed.";
                $_SESSION['mailsts'] = 0;
                header('Location:../index.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = "Incorrect verification code!";
            $_SESSION['mailsts'] = 0;
            header('Location:../index.php');
            exit();
        }
    } else {
        $_SESSION['msg'] = "Password and Confirm Password do not match";
        $_SESSION['mailsts'] = 0;
        header('Location:../index.php');
        exit();
    }
} else {
    $_SESSION['msg'] = "Please enter all fields";
    $_SESSION['mailsts'] = 0;
    header('Location:../index.php');
    exit();
}