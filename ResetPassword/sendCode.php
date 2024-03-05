<?php
// session_start();
include('../includes/config.php');

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require '../Tools/AutoLoad.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    // To check if it's faculty or student
    $query_faculty = "SELECT * FROM erp_faculty WHERE f_id = ?";
    $stmt_faculty = $conn->prepare($query_faculty);
    $stmt_faculty->bind_param("s", $username);
    $stmt_faculty->execute();
    $result_faculty = $stmt_faculty->get_result();

    $query_student = "SELECT * FROM erp_student WHERE stu_id = ?";
    $stmt_student = $conn->prepare($query_student);
    $stmt_student->bind_param("s", $username);
    $stmt_student->execute();
    $result_student = $stmt_student->get_result();

    // Interact with the database
    if ($result_faculty->num_rows > 0 || $result_student->num_rows > 0) {
        $query_check_duplicate = "SELECT * FROM erp_login WHERE log_id = ?";
        $stmt_check_duplicate = $conn->prepare($query_check_duplicate);
        $stmt_check_duplicate->bind_param("s", $username);
        $result = $stmt_check_duplicate->execute();
        $result_check_duplicate = $result;

        if ($result_check_duplicate) {

            try {

                $conn_email = $pdo;
                $query_email = "SELECT f_email FROM erp_faculty WHERE f_id = ?";
                $stmt_email = $conn_email->prepare($query_email);
                $stmt_email->bindValue(1, $username);
                $stmt_email->execute();
                $emailAddresses = $stmt_email->fetchAll(PDO::FETCH_COLUMN);

                $mail = new PHPMailer(true);

                // Server settings
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host = 'smtp.gmail.com';                      // Correct SMTP server host
                $mail->SMTPAuth = true;                                 // Enable SMTP authentication
                $mail->Username = '/////';         // Your Gmail address
                $mail->Password = '/////';                 // Your Gmail password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Use STARTTLS
                $mail->Port = 587;                              // TCP port to connect to

                function generateVerificationCode()
                {
                    return bin2hex(random_bytes(3));
                }

                $_SESSION['verificationCode'] = generateVerificationCode();


                // Recipients
                $mail->setFrom('///////', 'Grace Erp');
                foreach ($emailAddresses as $email) {
                    $verificationCode = $_SESSION['verificationCode']; // Generate the verification code

                    $mail->addAddress($email, 'Guide');

                    // Email body
                    $mail->isHTML(true);
                    $mail->Subject = 'Verification Code';
                    $mail->Body = "Your verification code is: <b style='font-size: 2rem; font-family: arial;'>$verificationCode</b>";
                    $mail->AltBody = 'Your verification code is: ' . $verificationCode;

                    $mail->send();

                    $mail->clearAddresses();
                }

                $_SESSION['msg'] = 'Verification code has been sent to your Email : ' . implode(', ', $emailAddresses);
                $_SESSION['mailsts'] = 1;
                header('Location:../forgot-password.php');
                exit();
            } catch (Exception $e) {
                $_SESSION['msg'] = "Verification codes could not be sent. Contact your institution";
                $_SESSION['mailsts'] = 0;
                header('Location:../index.php');
                exit();
            }
        } else {
            $_SESSION['msg'] = ("Please Enter a Valid User ID");
            $_SESSION['mailsts'] = 0;
            header('Location:../index.php');
            exit();
        }
    } else {
        $_SESSION['msg'] = ("Please Enter a Valid User ID");
        $_SESSION['mailsts'] = 0;
        header('Location:../index.php');
        exit();
    }
} else {
    $_SESSION['msg'] = ("Please enter all fields");
    $_SESSION['mailsts'] = 0;
    header('Location:../index.php');
    exit();
}