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

        input {
            cursor: text;
        }

        input[type="checkbox"] {
            cursor: pointer;
        }

        select {
            cursor: pointer;
        }

        body {
            font-family: sans-serif;
            overflow-x: hidden;
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
        .form_input {
            font-family: "Poppins";
            font-size: 15px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: space-between;
            width: 348px;
            margin: auto;
        }

        .desc {
            height: 3rem;
            width: 11rem;
        }

        select {
            width: 11rem;
            font-family: "Poppins";
        }

        .btns {
            display: flex;
            justify-content: space-between;
            width: 20rem;
            padding: 0px 90px;
            margin-top: 2rem;
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

        /* Search Results */
        .search_results {
            position: relative;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            font-family: "Poppins", sans-serif;
        }

        .search_results::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            height: 3px;
            width: 100%;
            background: rgb(128, 0, 128);
            margin: 18px;
        }

        .form_result {
            margin-top: 20px;
            padding: 0 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: center;
            padding: 8px;
            border-bottom: 1px solid #ddd;
            border-right: 1px solid #ddd;
        }

        th:first-child,
        td:first-child {
            border-left: 1px solid #ddd;
        }

        th {
            background-color: rgb(128, 0, 128);
            color: #fff;
            text-align: center;
        }

        tr:hover {
            background-color: linear-gradient(to right, rgb(79, 4, 79), rgb(193, 91, 193));
        }

        .role-link {
            font-family: "Poppins";
        }

        .role-link:hover {
            color: rgb(193, 91, 193);
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
        <div>Search Roles</div>
        <div><a href="./CreateRoles.php">Create Roles</a></div>
    </section>

    <!-- Form Inputs -->
    <section>
        <form class="form_input" method="post" action="">
            <label for="search_role">Role Name:</label>
            <select id="search_role" name="search_role">
                <option value="">Search All</option>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "graceerp");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                $query = "SELECT DISTINCT r_rolename FROM erp_role";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $roleName = $row['r_rolename'];
                    $selected = ($_POST['search_role'] == $roleName) ? 'selected' : '';
                    echo "<option value='$roleName' $selected>$roleName</option>";
                }

                mysqli_close($conn);
                ?>
            </select>


            <br>
            <br>

            <label for="search_desc">Description:</label>
            <input class="desc" type="text" id="search_desc" name="search_desc">
            <br>


            <div class="btns">
                <button type="submit" name="submit">Search</button> &nbsp;
                <button type="reset">Clear</button>

            </div>
        </form>
    </section>

    <section>
        <div class="search_results">Search Results</div>


        <?php
        if (isset($_POST['submit'])) {
            $search_role = $_POST['search_role'];
            $search_desc = $_POST['search_desc'];

            $conn = mysqli_connect("localhost", "root", "", "graceerp");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $query = "SELECT DISTINCT r_rolename, r_desc FROM erp_role WHERE 1=1";

            if (!empty($search_role)) {
                $query .= " AND r_rolename = '" . $search_role . "'";
            }
            if (!empty($search_desc)) {
                $query .= " AND r_desc LIKE '%" . $search_desc . "%'";
            }

            $result = mysqli_query($conn, $query);
            $count = mysqli_num_rows($result);

            if ($count > 0) {
                echo "<p style='padding: 0 20px;'>YOUR SEARCH RESULTED " . $count . " RECORDS</p>";

                echo "<form class='form_result' method='post' action=''>";
                echo "<table><tr><th>Role Name</th><th>Role Description</th><th>Delete</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td><a href='Tools/MenuAccess.php?role=" . urlencode($row["r_rolename"]) . "' class='role-link'>" . $row["r_rolename"] . "</a></td><td>" . $row["r_desc"] . "</td><td><input type='checkbox' name='delete[]' value='" . $row["r_rolename"] . "'></td></tr>";
                }
                echo "</table> <br>";
                echo "<button type='submit' name='delete_submit' onclick='showAlert()'>Delete Selected</button>";
                echo "</form>";
            } else {
                echo "<p class='success'>No results found.</p>";
            }

            mysqli_close($conn);
        }



        if (isset($_POST['delete_submit'])) {
            $delete_ids = $_POST['delete'];

            $conn = mysqli_connect("localhost", "root", "", "roles");

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            foreach ($delete_ids as $delete_id) {
                $query = "DELETE FROM erp_role WHERE r_rolename = '" . $delete_id . "'";

                if (mysqli_query($conn, $query)) {
                    echo "<script>alert('Selected role deleted successfully!');</script>";
                } else {
                    echo "<p class='success'>Error deleting record with ID " . $delete_id . ": " . mysqli_error($conn) . "</p><br>";
                }
            }

            mysqli_close($conn);
        }
        ?>


    </section>

    <script>
        function showAlert() {
            var result = confirm("Are you sure you want to delete the selected Roles?");
            if (result) {

                console.log("Deleting roles...");
                document.querySelector('.form_result').submit();
            } else {

                console.log("Canceled delete action.");
                event.preventDefault();
            }
        }
    </script>



</body>

</html>