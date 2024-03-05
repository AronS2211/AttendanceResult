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
        $role = 'student';
        echo "1";
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

        span {
            color: red;
        }

        input {
            cursor: text;
        }

        input[type="checkbox"] {
            cursor: pointer;
        }

        textarea {
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

        /* Form Inputs */
        form {
            padding: 0 18rem;
        }

        textarea {
            resize: none;
            width: 11rem;
        }

        .btns {
            display: flex;
            justify-content: center;
            gap: 2rem;
            background-color: #fff;
        }

        .role_input {
            width: 11rem;
        }

        input[type="submit"],
        button[type="reset"] {
            background-color: rgb(128, 0, 128);
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover,
        button[type="reset"]:hover {
            background-color: rgb(193, 91, 193);
        }

        /* Authorized Menu Items */
        fieldset {
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        legend {
            font-weight: bold;
            font-size: 18px;
        }

        fieldset label {
            display: block;
            margin-bottom: 5px;
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

        input[type="checkbox"] {
            margin-right: 5px;
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
        <h4>MANAGE ROLES</h4>
    </center>

    <section class="sub_heading">
        <div><a href="./SearchRoles.php">Search Roles</a></div>
        <div>Create Roles</div>
    </section>

    <!-- Form Inputs -->
    <section>

        <form action="#" method="post">
            <label for="rolename"><span>*</span> Role Name:</label>
            <input class="role_input" type="text" id="rolename" name="rolename" required><br><br>

            <label class="desc" for="description"><span style="color:#fff;">*</span> Description:</label>
            <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>


            <br>
            <br>
            <fieldset>
                <legend>Authorized Menu Items:</legend>
                <label><input type="checkbox" name="menu_item[]" value="home">Home</label><br>
                <label><input type="checkbox" name="menu_item[]" value="dashboard">Dashboard</label><br>
                <label><input type="checkbox" name="menu_item[]" value="admin_module">Admin Module</label><br>
                <label><input type="checkbox" name="menu_item[]" value="attendance_posting">Attendance Posting</label><br>
                <label><input type="checkbox" name="menu_item[]" value="result_posting">Result Posting</label><br>
                <label><input type="checkbox" name="menu_item[]" value="reports">Reports</label><br>
                <label><input type="checkbox" name="menu_item[]" value="gallery">Gallery</label><br>
                <label><input type="checkbox" name="menu_item[]" value="profile">Profile</label><br>
                <label><input type="checkbox" name="menu_item[]" value="view_calendar">View Calendar</label><br>
                <label><input type="checkbox" name="menu_item[]" value="change_password">Change Password</label><br>
            </fieldset>
            <div class="btns">
                <input type="submit" value="Submit">
                <button type="reset">Clear</button>
            </div>
        </form>

    </section>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $rolename = $_POST["rolename"];
        $description = $_POST["description"];

        $menu_items = isset($_POST["menu_item"]) ? $_POST["menu_item"] : [];

        $conn = new mysqli("localhost", "root", "", "graceerp");

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $check_stmt = $conn->prepare("SELECT r_id FROM erp_role WHERE r_rolename = ?");
        $check_stmt->bind_param("s", $rolename);
        $check_stmt->execute();
        $check_result = $check_stmt->get_result();

        if ($check_result->num_rows > 0) {
            echo "<script>alert('This RoleName Already Exists');</script>";
        } else {
            $menu_items_string = implode(',', $menu_items);

            $stmt = $conn->prepare("INSERT INTO erp_role (r_rolename, r_desc, r_access) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $rolename, $description, $menu_items_string);

            $stmt->execute();

            if ($stmt->insert_id > 0) {
                echo "<script>alert('New role created successfully!');</script>";
            } else {
                echo "<script>alert('You have to choose at least one Menu Item');</script>";
            }

            $stmt->close();
        }

        $check_stmt->close();
        $conn->close();
    }
    ?>


</body>

</html>