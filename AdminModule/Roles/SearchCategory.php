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

        ::selection {
            background-color: rgb(128, 0, 128);
            color: #fff;
        }

        ::-webkit-scrollbar {
            display: none;
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

        select {
            cursor: pointer;
        }

        body {
            font-family: sans-serif;
            overflow-x: hidden;
        }

        input,
        textarea {
            cursor: text;
        }

        input[type="checkbox"] {
            cursor: pointer;
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
            width: 400px;
            margin: auto;
        }

        .form_input label {
            flex: 1 0 100px;
            margin-right: 10px;
            text-align: right;
        }

        .btns {
            display: flex;
            justify-content: space-evenly;
            margin-top: 2rem;
        }

        .form_input input[type="text"],
        .form_input select {
            flex: 2 1 200px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            font-family: "Poppins";
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

        .success {
            background-color: var(--menu-border);
            color: white;
            padding: 12px 20px;
            margin: 10px 0;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            text-align: center;
            font-family: "Poppins";
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
            text-align: left;
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
            background-color: #f5f5f5;
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
        <div>Search Category</div>
        <div><a href="./CreateCategory.php">Create Category</a></div>
    </section>

    <section>
        <form class="form_input" action="#" method="POST">
            <label for="category">Category Name:</label>
            <input type="text" id="category" name="category">
            <br><br>

            <label for="description">Description:</label>
            <input class="desc" type="text" id="description" name="description">
            <br><br>

            <label for="module">Module Name:</label>
            <select id="module" name="module">
                <option value="">Search All</option>

                <?php
                $conn = mysqli_connect("localhost", "root", "", "graceerp");

                $query = "SELECT DISTINCT cat_modname FROM erp_category";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $category = $row["cat_modname"];
                    $selected = ($_POST['module'] == $category) ? 'selected' : '';
                    echo '<option value="' . $category . '" ' . $selected . '>' . $category . '</option>';
                }

                mysqli_close($conn);
                ?>

            </select>

            <br><br>

            <label for="parent">Parent Category:</label>
            <input type="text" id="parent" name="parent">
            <br><br>

            <div class="btns">
                <button type="submit" name="submit">Search</button>
                <button type="reset">Clear</button>
            </div>
        </form>


        <section>
            <div class="search_results">Search Results</div>

            <?php
            if (isset($_POST['submit'])) {
                $category = $_POST['category'];
                $description = $_POST['description'];
                $module = $_POST['module'];
                $parent = $_POST['parent'];

                $query = "SELECT * FROM erp_category WHERE 1=1";
                if (!empty($category)) {
                    $query .= " AND cat_name LIKE '%$category%'";
                }
                if (!empty($description)) {
                    $query .= " AND cat_desc LIKE '%$description%'";
                }
                if (!empty($module)) {
                    $query .= " AND cat_modname = '$module'";
                }
                if (!empty($parent)) {
                    $query .= " AND cat_pcat LIKE '%$parent%'";
                }

                $conn = mysqli_connect("localhost", "root", "", "graceerp");
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    echo '<form method="post" action="">';
                    echo '<table>';
                    echo '<thead><tr><th>Category Name</th><th>Parent Category</th><th>Description</th><th>Module Name</th><th>Delete</th></tr></thead>';
                    echo '<tbody>';
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['cat_name'] . '</td>';
                        echo '<td>' . $row['cat_pcat'] . '</td>';
                        echo '<td>' . $row['cat_desc'] . '</td>';
                        echo '<td>' . $row['cat_modname'] . '</td>';
                        echo '<td><input type="checkbox" name="delete[]" value="' . $row['cat_id'] . '"></td>';
                        echo '</tr>';
                    }
                    echo '</tbody></table>';
                    echo '<br><button type="submit" name="delete_submit" onclick="showAlert()">Delete Selected</button> <br><br>';
                    echo '</form>';
                } else {
                    echo '<p class="success">No results found</p>';
                }
            }

            if (isset($_POST['delete_submit'])) {
                $delete_ids = $_POST['delete'];

                $conn = mysqli_connect("localhost", "root", "", "graceerp");

                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                foreach ($delete_ids as $delete_id) {
                    $query = "DELETE FROM erp_category WHERE cat_id = '" . $delete_id . "'";

                    if (mysqli_query($conn, $query)) {
                        echo "<script>alert('Selected Category Deleted Successfully');</script>";
                    } else {
                        echo "<p class='success'>Error deleting record with ID " . $delete_id . ": " . mysqli_error($conn) . "</p><br>";
                    }
                }

                mysqli_close($conn);
            }
            ?>


        </section>

    </section>

    <script>
        function showAlert() {
            var result = confirm("Are you sure you want to delete the selected Category?");
            if (result) {

                console.log("Deleting Category...");
                document.querySelector('.form_result').submit();
            } else {

                console.log("Canceled delete action.");
                event.preventDefault();
            }
        }
    </script>
</body>

</html>