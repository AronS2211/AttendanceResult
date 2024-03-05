<?php
include('../../includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db_name", $user, $password);

    $user_id = $_SESSION['user_id'];

    $sql_student = "SELECT * FROM erp_student WHERE stu_id = :user_id";
    $sql_faculty = "SELECT f_role FROM erp_faculty WHERE f_id = :user_id";

    $stmt_student = $pdo->prepare($sql_student);
    $stmt_student->bindParam(':user_id', $user_id);
    $stmt_student->execute();

    $stmt_faculty = $pdo->prepare($sql_faculty);
    $stmt_faculty->bindParam(':user_id', $user_id);
    $stmt_faculty->execute();

    $result_student = $stmt_student->fetch();
    $result_faculty = $stmt_faculty->fetch();

    if ($result_student) {
        $role = 'student';
    } elseif ($result_faculty) {
        $role = $result_faculty['f_role'];
    } else {
        echo "User not found in the database.";
    }

    if ($role !== 'Admin') {
        echo "<script>alert('Unauthorized access.'); window.location.href = './grace home/home1.php';</script>";
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

$pdo = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grace ERP | Admin Menu</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins&family=Tilt+Neon&display=swap");

        /* ScrollBar */
        ::-webkit-scrollbar {
            display: none;
        }

        ::selection {
            background-color: rgb(128, 0, 128);
            color: #fff;
        }


        /* Reusable CSS */
        html {
            scroll-behavior: smooth;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        a {
            text-decoration: none;
            color: #000;
        }

        body {
            font-family: sans-serif;
            overflow-x: hidden;
            padding: 20px;
        }

        button {

            padding: 10px;
            background-color: rgb(128, 0, 128);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: rgb(193, 91, 193);
        }

        ul {
            list-style-type: none;
        }

        ul {
            display: flex;
            flex-direction: column;
            gap: 5px;
            text-transform: uppercase;
        }

        li {
            font-family: "Poppins", sans-serif;
        }

        .heading {
            position: relative;
            font-family: "Poppins", sans-serif;
        }

        .heading::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 12rem;
            background: rgb(128, 0, 128);
            margin-bottom: -5px;
        }
    </style>
</head>

<body>
    <button onclick="goBack()">Go Back</button>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <nav>
        <h4 class="heading">USER ROLES AND MENU</h4>
        <br>
        <ul>
            <li><a href="CreateRoles.php">Create Roles</a></li>
            <li><a href="SearchRoles.php">Search Roles</a></li>
            <li><a href="CreateCategory.php">Create Category</a></li>
            <li><a href="SearchCategory.php">Search Category</a></li>
        </ul>
    </nav>
</body>

</html>