<?php
session_start();
include("conn.php");
include("includes/Header.php");

if (!isset($_SESSION['user_id'])) {
  exit();
}
// Check if the connection was successful
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the form values using $_POST superglobal
  $staff_name = $_POST["staff_name"];
  $leave_type = $_POST["leave_type"];
  $reason = $_POST["reason"];
  $date = $_POST["date"];
  $substitute_teacher = $_POST["substitute_teacher"];

  // Prepare the SQL query to insert the form data into the table
  $sql = "INSERT INTO leave_requests (staff_name, leave_type, reason, date, substitute_teacher) VALUES ('$staff_name', '$leave_type', '$reason', '$date', '$substitute_teacher')";

  // Execute the query and check if it was successful
  if ($conn->query($sql) === TRUE) {
    echo "Leave request submitted successfully!";
    header("Location: leave_approval.php?id=" . mysqli_insert_id($conn));
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}
// Close the database connection
