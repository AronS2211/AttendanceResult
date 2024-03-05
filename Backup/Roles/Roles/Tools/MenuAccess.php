<?php
if (isset($_GET['role'])) {
    $selectedRole = $_GET['role'];

    $conn = mysqli_connect("localhost", "root", "", "graceerp");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = "SELECT r_access FROM erp_role WHERE r_rolename = '" . mysqli_real_escape_string($conn, $selectedRole) . "'";

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $menuAccess = $row['r_access'];

    mysqli_close($conn);
}

if (isset($_POST['add'])) {
    $selectedRole = $_GET['role'];

    $conn = mysqli_connect("localhost", "root", "", "graceerp");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $newMenuItem = $_POST['new_menu_item'];

    $existingMenus = explode(',', $menuAccess);
    if (in_array($newMenuItem, $existingMenus)) {
        echo "<script>alert('Selected menu item already exists.!');</script>";
        mysqli_close($conn);
        exit();
    }

    $updatedMenuAccess = $menuAccess . ',' . $newMenuItem;

    $updateQuery = "UPDATE erp_role SET r_access = '" . mysqli_real_escape_string($conn, $updatedMenuAccess) . "' WHERE r_rolename = '" . mysqli_real_escape_string($conn, $selectedRole) . "'";
    mysqli_query($conn, $updateQuery);

    mysqli_close($conn);

    header("Location: MenuAccess.php?role=" . urlencode($selectedRole));
    exit();
}

if (isset($_POST['delete'])) {
    $selectedRole = $_GET['role'];
    $menuItemToDelete = $_POST['delete'];

    $conn = mysqli_connect("localhost", "root", "", "graceerp");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $existingMenus = explode(',', $menuAccess);
    $updatedMenus = array_diff($existingMenus, [$menuItemToDelete]);
    $updatedMenuAccess = implode(',', $updatedMenus);

    $updateQuery = "UPDATE erp_role SET r_access = '" . mysqli_real_escape_string($conn, $updatedMenuAccess) . "' WHERE r_rolename = '" . mysqli_real_escape_string($conn, $selectedRole) . "'";
    mysqli_query($conn, $updateQuery);

    mysqli_close($conn);

    header("Location: MenuAccess.php?role=" . urlencode($selectedRole));
    exit();
}
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

        ::-webkit-scrollbar{
            display: none;
        }

        ::selection{
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

        select {
            cursor: pointer;
            width: 11rem;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        select option {
            padding: 8px;
        }

        body {
            font-family: sans-serif;
            overflow-x: hidden;
        }

        /* Sub Heading */
        .sub_heading {
            position: relative;
            padding: 1px;
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
        }

        /* Menu Management */
        h1,
        h2 {
            color: #333;
            font-size: 1rem;
        }

        table {
            width: 24rem;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ccc;
            font-family: "Poppins";
            font-size: 14px;
        }

        th {
            background-color: rgb(128, 0, 128);
            color: #fff;
            width: 100%;
        }

        .delete-btn {
            background-color: rgb(128, 0, 128);
            color: #fff;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .delete-btn:hover {
            background-color: rgb(193, 91, 193);
        }

        .add-menu-form {
            margin-top: 20px;
        }

        .add-menu-form select {
            padding: 8px;
            font-size: 14px;
        }

        .add-menu-form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .add-menu-form button:hover {
            background-color: #0069d9;
        }

        .no-menu-access {
            color: #999;
            margin-top: 10px;
        }
    </style>
    </style>
</head>

<body>
    <div class="container">
        <?php if (isset($selectedRole)) { ?>
            <center>
                <h4>MANAGE MENU ITEM</h4>
            </center>

            <section class="sub_heading">
                <div>Manage Menu Items</div>
                <div></div>
            </section>

            <br>

            <!-- Menu Management -->
            <h1>Menu Access for Role: <?php echo $selectedRole; ?></h1>
            <?php if (!empty($menuAccess)) {
                $menuItems = explode(',', $menuAccess);
                $menuItems = array_filter($menuItems);

                if (count($menuItems) > 0) { ?>
                    <br>
                    <table>
                        <tr>
                            <th>Menu Item</th>
                            <th>Action</th>
                        </tr>
                        <?php foreach ($menuItems as $menuItem) { ?>
                            <tr>
                                <td><?php echo $menuItem; ?></td>
                                <td>
                                    <form method="post" action="">
                                        <input type="hidden" name="delete" value="<?php echo $menuItem; ?>">
                                        <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this menu item?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                <?php } else { ?>
                    <p>No menu access for this role.</p>
                <?php }
            } else { ?>
                <p>No menu access for this role.</p>
            <?php } ?>

            <!-- Add New Menu -->
            <h2>Add New Menu</h2>
            <form method="post" action="">
                <select name="new_menu_item" required>
                    <?php
                    $availableMenuItems = [
                        'home',
                        'dashboard',
                        'admin_module',
                        'attendance_posting',
                        'result_posting',
                        'reports',
                        'gallery',
                        'profile',
                        'view_calendar',
                        'change_password',
                    ];

                    $assignedMenuItems = explode(',', $menuAccess);
                    $availableMenuItems = array_diff($availableMenuItems, $assignedMenuItems);

                    foreach ($availableMenuItems as $menuItem) {
                        echo "<option value=\"$menuItem\">$menuItem</option>";
                    }
                    ?>
                </select>
                <br>
                <br>
                <button class="delete-btn" type="submit" name="add">Add</button>
            </form>

        <?php } ?>
    </div>
    <br><br>
</body>

</html>