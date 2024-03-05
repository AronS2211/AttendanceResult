<?php
session_start();

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require '../AutoLoad.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$hostname = "localhost";
$username_db = "root";
$password_db = "";
$database = "graceerp";

$conn = new mysqli($hostname, $username_db, $password_db, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirmPassword'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    if ($password === $confirmPassword) {

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
                    $dbHost = 'localhost';
                    $dbName = 'graceerp';
                    $dbUser = 'root';
                    $dbPass = '';

                    $conn_email = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
                    $query_email = "SELECT stu_email FROM erp_student WHERE stu_id = ?";
                    $stmt_email = $conn_email->prepare($query_email);
                    $stmt_email->bindValue(1, $username);
                    $stmt_email->execute();
                    $emailAddresses = $stmt_email->fetchAll(PDO::FETCH_COLUMN);

                    $mail = new PHPMailer(true);

                    // Server settings
                    $mail->isSMTP();                                            // Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                      // Correct SMTP server host
                    $mail->SMTPAuth   = true;                                 // Enable SMTP authentication
                    $mail->Username   = 'sridhar22122002@gmail.com';         // Your Gmail address
                    $mail->Password   = 'vhrzgmqvvbdwurnp';                 // Your Gmail password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;    // Use STARTTLS
                    $mail->Port       = 587;                              // TCP port to connect to

                    function generateVerificationCode()
                    {
                        return bin2hex(random_bytes(3));
                    }

                    $_SESSION['verificationCode'] = generateVerificationCode();


                    // Recipients
                    $mail->setFrom('sridhar22122002@gmail.com', 'Grace Erp');
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

                    echo 'Verification code has been sent to your Email : ' . implode(', ', $emailAddresses);

                    echo $verificationCode;
                } catch (Exception $e) {
                    echo "Verification codes could not be sent. Contact your institution";
                }
            }
        } else {
            echo ("Please Enter a Valid Username");
        }
    } else {
        echo ("Password and Confirm Password do not match");
    }
} else {
    echo ("Please enter all fields");
}
