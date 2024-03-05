<?php
$host = "localhost";
$user = "root";
$password = '';
$db_name = "graceerp";

$con = mysqli_connect($host, $user, $password, $db_name);
if (mysqli_connect_errno()) {
    die("Failed to connect with MySQL: " . mysqli_connect_error());
}
$conn = new mysqli($host, $user, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$pdo = new PDO('mysql:host=' . $host . ';dbname=' . $db_name . '', '' . $user . '', '' . $password . '');
session_start();
// error_reporting(0);