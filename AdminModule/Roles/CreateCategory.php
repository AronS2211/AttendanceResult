<?php
session_start();
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
        $role = "student";
    } elseif ($result_faculty) {
        $role = $result_faculty['f_role'];
    } else {
        echo "User not found in the database.";
    }

    // if ($role !== 'Admin') {
    //     echo "<script>alert('Unauthorized access.'); window.location.href = 'Main.php';</script>";
    //     exit();
    // }

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
    <title>Document</title>

    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins&family=Tilt+Neon&display=swap");

        /* Reusable CSS */
        html {
            scroll-behavior: smooth;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        ::selection {
            background-color: rgb(128, 0, 128);
            color: #fff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            cursor: default;
        }

        a {
            text-decoration: none;
            color: #000;
            cursor: pointer;
        }

        body {
            font-family: sans-serif;
            overflow-x: hidden;
        }

        textarea {
            resize: none;
            cursor: text;
        }

        input {
            cursor: text;
        }

        /* Sub Heading */
        .sub_heading {
            position: relative;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            font-family: "Poppins", sans-serif;
        }

        .sub_heading::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 100%;
            background: rgb(128, 0, 128);
            margin: 18px;
        }

        /* Forms Input */
        .form_input {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            width: 400px;
            margin: auto;
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

        .form_input label {
            flex: 1 0 100px;
            margin-right: 10px;
            text-align: right;
            font-family: "Poppins";
            font-size: 15px;
        }

        .btns {
            display: flex;
            justify-content: space-evenly;
            margin-top: 2rem;
        }

        .form_input .desc {
            flex: 2 1 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            height: 5rem;
        }

        .form_input input[type="text"],
        .form_input select {
            flex: 2 1 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .form_input button[type="submit"],
        .form_input button[type="reset"] {
            margin-left: 110px;
            padding: 10px;
            background-color: rgb(128, 0, 128);
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .form_input button[type="reset"] {
            background-color: rgb(128, 0, 128);
        }

        .form_input button[type="submit"]:hover,
        .form_input button[type="reset"]:hover {
            background-color: rgb(193, 91, 193);
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
    <center>
        <h4>MANAGE CATEGORY</h4>
    </center>

    <section class="sub_heading">
        <div><a href="./SearchCategory.php">Search Category</a></div>
        <div>Create Category</div>
    </section>

    <section>
        <form class="form_input" method="POST" action="">
            <label for="name">Category Name:</label>
            <input type="text" name="name" id="name" required>
            <br><br>

            <label for="modname">Module Name:</label>
            <input type="text" name="modname" id="modname" required>
            <br><br>

            <label for="pcat">Parent Category:</label>
            <input type="text" name="pcat" id="pcat">
            <br><br>

            <label for="desc">Category Description:</label>
            <textarea class="desc" name="desc" id="desc"></textarea>
            <br><br>

            <div class="btns">
                <button type="submit" name="submit">Create Category</button>
                <button type="reset">Clear</button>
            </div>
        </form>
    </section>


    <?php

    $conn = mysqli_connect("localhost", "root", "", "graceerp");

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $modname = $_POST['modname'];
        $pcat = $_POST['pcat'];

        $sql = "INSERT INTO erp_category (cat_name, cat_desc, cat_modname, cat_pcat) VALUES ('$name', '$desc', '$modname', '$pcat')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>alert('New Category Created Successfully');</script>";
        } else {
            echo "Error creating category: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
    ?>
</body>

</html>