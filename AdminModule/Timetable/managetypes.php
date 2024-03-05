<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../assets/img/gcoe_logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../assets/css/anydata.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">

    <style>
        #admin_module {
            background-color: var(--pri);
        }
    </style>
</head>

<body>
    <?php include('../../includes/config.php'); ?>
    <?php include('../../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>


            <?php


            // <!-- php code to fetch from database -->
            $result = "";
            $msg = "";
            if (isset($_POST['search'])) {
                if ((!empty($_POST['type'])) && (!empty($_POST['hours']))) { //check if both fields are set
                    $typeid = $_POST['type'];
                    $hours = $_POST['hours'];
                    $sql = "SELECT * FROM erp_tt_type WHERE type_title like '%$typeid%' and type_hours='$hours' ";
                    $result = $conn->query($sql);
                } elseif (!empty($_POST['type'])) { //check if type field only is set
                    $typeid = $_POST['type'];
                    $sql = "SELECT * FROM erp_tt_type WHERE type_title like '%$typeid%' ";
                    $result = $conn->query($sql);
                } elseif (!empty($_POST['hours'])) {    // check if no of hours field only is set
                    $hours = $_POST['hours'];
                    $sql = "SELECT * FROM erp_tt_type WHERE type_hours='$hours' ";
                    $result = $conn->query($sql);
                } else {            // executed when no field is set
                    $sql = "SELECT * FROM erp_tt_type";
                    $result = $conn->query($sql);
                }
            }


            // <!-- data fetched from database  -->



            ?>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Timetable Types</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Manage</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>
                    <!-- ur content -->
                    <form id="TTform1" method="post" action="#">

                        <div class="TT-form-content">
                            <div>
                                <label for="type">Time Table type Name:</label>
                                <!-- php code  for fetching timetable type for html form -->
                                <?php
                                $sql3 = "select*from erp_tt_type";
                                $result3 = $conn->query($sql3);
                                if ($result3 == true) {
                                    if ($result3->num_rows > 0) {
                                        $row3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                                        $msg3 = $row3;
                                    } else {
                                        $msg3 = "No Data Found";
                                    }
                                ?>
                                    <select name="type" id="type">
                                        <option value="">--Time table type--</option>
                                        <?php
                                        if (is_array($msg3)) {
                                            foreach ($msg3 as $data) {
                                        ?>
                                                <option value="<?php echo $data['type_title']; ?>"><?php echo $data['type_title'] ?? ''; ?>
                                                </option>
                                    <?php
                                            }
                                        } else {
                                        }
                                    }
                                    ?>
                                    </select>



                                    <!-- timetable type fetched -->
                            </div>
                            <div>
                                <label for="hours">Total Number of Hours:</label>
                                <input type="text" name="hours">
                            </div>
                            <div>
                                <button type="submit" name="search" class="TT-button">Search</button>
                                <button type="reset" class="TT-button">Clear</button>
                            </div>
                        </div>
                    </form>
                    <?php

                    if ($result == true) {
                        if ($result->num_rows > 0) {
                    ?>
                            <div class="d-flex justify-content-around">
                                <table class="TT-type-display-table">
                                    <thead>
                                        <tr>
                                            <th>Type Name</th>
                                            <th>Number of Hours</th>
                                            <th colspan="2">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                                        $msg = $row;
                                    } else {
                                        $msg = "No Data Found";
                                    }

                                    if (is_array($msg)) {
                                        foreach ($msg as $data) {
                                        ?>
                                            <tr>
                                                <td><?php echo $data['type_title'] ?? ''; ?></td>
                                                <td><?php echo $data['type_hours'] ?? ''; ?></td>
                                                <td><button class="TT-button" onclick="window.location.href= 'edittype.php?id=<?php echo $data['type_id']; ?>'">Edit</button></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {   ?>
                                        <tr>
                                            <td rowspan="3"><?php echo $msg; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- ur content -->
                </div>
            </div>

        </main>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
<script src="../../assets/js/script.js"></script>
<script src="../assets/js/anydata.js"></script>
<script src="../assets/js/script.js"></script>

</html>