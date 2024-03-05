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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../assets/css/anydata.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/style_TT.css">

    <style>
        #admin_module {
            background-color: var(--pri);
        }
    </style>

    <style>
        .current-day {
            background-color: blueviolet;
            color: white;
        }
    </style>
</head>

<body>
    <?php include('../../includes/config.php'); ?>
    <?php include('../../includes/header.php'); ?>



    <?php


    // <!-- php code to fetch from database -->
    $classresult = "";
    $classmsg = "";
    if (isset($_POST['search'])) {
        if ((!empty($_POST['course'])) && (!empty($_POST['department'])) && (!empty($_POST['batstartyear'])) && (!empty($_POST['endyear']))) { //check if all fields are set

            $course = mysqli_real_escape_string($conn, $_POST['course']);
            $dept = mysqli_real_escape_string($conn, $_POST['department']);
            $startyear = mysqli_real_escape_string($conn, $_POST['batstartyear']);
            $endyear = mysqli_real_escape_string($conn, $_POST['endyear']);



            $classsql = "SELECT * FROM erp_class WHERE cls_course= '$course' and cls_dept='$dept' and cls_startyr='$startyear'and cls_endyr='$endyear' ";
            $classresult = $conn->query($classsql);

            // working

        } elseif ((!empty($_POST['course'])) && (!empty($_POST['department'])) && (!empty($_POST['batstartyear']))) {
            # code...
            $course = mysqli_real_escape_string($conn, $_POST['course']);
            $dept = mysqli_real_escape_string($conn, $_POST['department']);
            $startyear = mysqli_real_escape_string($conn, $_POST['batstartyear']);

            $classsql = "SELECT * FROM erp_class WHERE cls_course= '$course' and cls_dept='$dept' and cls_startyr='$startyear' ";
            $classresult = $conn->query($classsql);

            // working


        } elseif ((!empty($_POST['course'])) && (!empty($_POST['department'])) && (!empty($_POST['endyear']))) { //check if all fields are set

            $course = mysqli_real_escape_string($conn, $_POST['course']);
            $dept = mysqli_real_escape_string($conn, $_POST['department']);
            $endyear = mysqli_real_escape_string($conn, $_POST['endyear']);

            $classsql = "SELECT * FROM erp_class WHERE cls_course= '$course' and cls_dept='$dept' and cls_endyr='$endyear' ";
            $classresult = $conn->query($classsql);

            // working


        } elseif ((!empty($_POST['course'])) && (!empty($_POST['batstartyear'])) && (!empty($_POST['endyear']))) { //check if all fields are set

            $course = mysqli_real_escape_string($conn, $_POST['course']);
            $startyear = mysqli_real_escape_string($conn, $_POST['batstartyear']);
            $endyear = mysqli_real_escape_string($conn, $_POST['endyear']);

            $classsql = "SELECT * FROM erp_class WHERE cls_course= '$course'  and cls_startyr='$startyear'and cls_endyr='$endyear' ";
            $classresult = $conn->query($classsql);

            // working


        } elseif ((!empty($_POST['department'])) && (!empty($_POST['batstartyear'])) && (!empty($_POST['endyear']))) { //check if all fields are set

            $dept = mysqli_real_escape_string($conn, $_POST['department']);
            $startyear = mysqli_real_escape_string($conn, $_POST['batstartyear']);
            $endyear = mysqli_real_escape_string($conn, $_POST['endyear']);

            $classsql = "SELECT * FROM erp_class WHERE  cls_dept='$dept' and cls_startyr='$startyear'and cls_endyr='$endyear' ";
            $classresult = $conn->query($classsql);

            // working

        } elseif ((!empty($_POST['course'])) && (!empty($_POST['department']))) { //check if all fields are set

            $course = mysqli_real_escape_string($conn, $_POST['course']);
            $dept = mysqli_real_escape_string($conn, $_POST['department']);

            $classsql = "SELECT * FROM erp_class WHERE cls_course= '$course' and cls_dept='$dept' ";
            $classresult = $conn->query($classsql);

            // working


        } elseif ((!empty($_POST['course'])) && (!empty($_POST['batstartyear']))) { //check if all fields are set

            $course = mysqli_real_escape_string($conn, $_POST['course']);
            $startyear = mysqli_real_escape_string($conn, $_POST['batstartyear']);

            $classsql = "SELECT * FROM erp_class WHERE cls_course= '$course' and cls_startyr='$startyear' ";
            $classresult = $conn->query($classsql);

            // working


        } elseif ((!empty($_POST['course'])) &&  (!empty($_POST['endyear']))) { //check if all fields are set

            $course = mysqli_real_escape_string($conn, $_POST['course']);
            $endyear = mysqli_real_escape_string($conn, $_POST['endyear']);

            $classsql = "SELECT * FROM erp_class WHERE cls_course= '$course' and cls_endyr='$endyear' ";
            $classresult = $conn->query($classsql);

            // working


        } elseif ((!empty($_POST['department'])) && (!empty($_POST['batstartyear']))) { //check if all fields are set

            $dept = mysqli_real_escape_string($conn, $_POST['department']);
            $startyear = mysqli_real_escape_string($conn, $_POST['batstartyear']);

            $classsql = "SELECT * FROM erp_class WHERE  cls_dept='$dept' and cls_startyr='$startyear' ";
            $classresult = $conn->query($classsql);

            // working


        } elseif ((!empty($_POST['department'])) && (!empty($_POST['endyear']))) { //check if all fields are set

            $dept = mysqli_real_escape_string($conn, $_POST['department']);
            $endyear = mysqli_real_escape_string($conn, $_POST['endyear']);

            $classsql = "SELECT * FROM erp_class WHERE  cls_dept='$dept' and cls_endyr='$endyear' ";
            $classresult = $conn->query($classsql);


            // working


        } elseif ((!empty($_POST['batstartyear'])) && (!empty($_POST['endyear']))) { //check if all fields are set

            $startyear = mysqli_real_escape_string($conn, $_POST['batstartyear']);
            $endyear = mysqli_real_escape_string($conn, $_POST['endyear']);

            $classsql = "SELECT * FROM erp_class WHERE  cls_startyr='$startyear'and cls_endyr='$endyear' ";
            $classresult = $conn->query($classsql);

            // working


        } elseif ((!empty($_POST['course']))) { //check if all fields are set

            $course = mysqli_real_escape_string($conn, $_POST['course']);

            $classsql = "SELECT * FROM erp_class WHERE cls_course= '$course'  ";
            $classresult = $conn->query($classsql);

            // working

        } elseif ((!empty($_POST['department']))) { //check if all fields are set

            $department = mysqli_real_escape_string($conn, $_POST['department']);

            $classsql = "SELECT * FROM erp_class WHERE cls_dept= '$department'  ";
            $classresult = $conn->query($classsql);

            // working

        } elseif ((!empty($_POST['batstartyear']))) { //check if all fields are set

            $startyear = mysqli_real_escape_string($conn, $_POST['batstartyear']);

            $classsql = "SELECT * FROM erp_class WHERE cls_startyr='$startyear' ";
            $classresult = $conn->query($classsql);

            // working

        } elseif ((!empty($_POST['endyear']))) { //check if all fields are set

            $endyear = mysqli_real_escape_string($conn, $_POST['endyear']);
            $classsql = "SELECT * FROM erp_class WHERE  cls_endyr='$endyear' ";
            $classresult = $conn->query($classsql);

            // working

        } else { //check if all fields are set
            $classsql = "SELECT * FROM erp_class ";
            $classresult = $conn->query($classsql);

            // working
        }
    }


    // <!-- data fetched from database  -->
    ?>

    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Class Management</h3>
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
                    <form id="TTform" method="post" action="#">

                        <div class="TT-form-content">
                            <div>
                                <label for="course">Course:</label>
                                <!-- php code  for fetching course for html form -->
                                <?php
                                $coursesql = "select DISTINCT  cls_course from erp_class";
                                $courseresult = $conn->query($coursesql);
                                if ($courseresult == true) {
                                    if ($courseresult->num_rows > 0) {
                                        $courserow = mysqli_fetch_all($courseresult, MYSQLI_ASSOC);
                                        $coursemsg = $courserow;
                                    } else {
                                        $coursemsg = "No Data Found";
                                    }
                                ?>
                                    <select name="course" id="course">
                                        <option value="">--Course--</option>
                                        <?php
                                        if (is_array($coursemsg)) {
                                            foreach ($coursemsg as $data) {
                                        ?>
                                                <option value="<?php echo $data['cls_course']; ?>"><?php echo $data['cls_course'] ?? ''; ?>
                                                </option>
                                    <?php
                                            }
                                        } else {
                                            echo $coursemsg;
                                        }
                                    }
                                    ?>
                                    </select>


                                    <!-- course fetched -->
                            </div>
                            <div>
                                <label for="department">Department:</label>
                                <!-- php code  for fetching department for html form -->
                                <?php
                                $deptsql = "select DISTINCT  cls_dept from erp_class";
                                $deptresult = $conn->query($deptsql);
                                if ($deptresult == true) {
                                    if ($deptresult->num_rows > 0) {
                                        $deptrow = mysqli_fetch_all($deptresult, MYSQLI_ASSOC);
                                        $deptmsg = $deptrow;
                                    } else {
                                        $deptmsg = "No Data Found";
                                    }
                                ?>
                                    <select name="department" id="dept">
                                        <option value="">--Department--</option>
                                        <?php
                                        if (is_array($deptmsg)) {
                                            foreach ($deptmsg as $data) {
                                        ?>
                                                <option value="<?php echo $data['cls_dept'] ?>"><?php echo $data['cls_dept'] ?? ''; ?>
                                                </option>
                                    <?php
                                            }
                                        } else {
                                            echo $deptmsg;
                                        }
                                    }
                                    ?>
                                    </select>

                                    <!-- department fetched -->
                            </div>
                            <div>
                                <label for="batstartyear">Batch Start Year:</label>
                                <!-- php code  for fetching batch start year for html form -->
                                <?php
                                $batchsql = "select DISTINCT  cls_startyr from erp_class";
                                $batchresult = $conn->query($batchsql);
                                if ($batchresult == true) {
                                    if ($batchresult->num_rows > 0) {
                                        $batchrow = mysqli_fetch_all($batchresult, MYSQLI_ASSOC);
                                        $batchmsg = $batchrow;
                                    } else {
                                        $batchmsg = "No Data Found";
                                    }
                                ?>
                                    <select name="batstartyear" id="batatartyear">
                                        <option value="">--Batch--</option>
                                        <?php
                                        if (is_array($batchmsg)) {
                                            foreach ($batchmsg as $data) {
                                        ?>
                                                <option value=" <?php echo $data['cls_startyr']; ?> "><?php echo $data['cls_startyr'] ?? ''; ?>
                                                </option>
                                    <?php
                                            }
                                        } else {
                                            echo $batchmsg;
                                        }
                                    }
                                    ?>
                                    </select>

                                    <!-- batch start year  fetched -->
                            </div>
                            <div>
                                <label for="endyear">Passing Out Year:</label>
                                <!-- php code  for fetching batch pass out year for html form -->
                                <?php
                                $endsql = "select DISTINCT  cls_endyr from erp_class";
                                $endresult = $conn->query($endsql);
                                if ($endresult == true) {
                                    if ($endresult->num_rows > 0) {
                                        $endrow = mysqli_fetch_all($endresult, MYSQLI_ASSOC);
                                        $endmsg = $endrow;
                                    } else {
                                        $endmsg = "No Data Found";
                                    }
                                ?>
                                    <select name="endyear" id="endyear">
                                        <option value="">--Pass out year--</option>
                                        <?php
                                        if (is_array($endmsg)) {
                                            foreach ($endmsg as $data) {
                                        ?>
                                                <option value=" <?php echo $data['cls_endyr']; ?> "><?php echo $data['cls_endyr'] ?? ''; ?>
                                                </option>
                                    <?php
                                            }
                                        } else {
                                            echo $endmsg;
                                        }
                                    }
                                    ?>
                                    </select>

                                    <!-- batch pass out year  fetched -->
                            </div>
                            <div class="TT-form-button">
                                <button type="submit" name="search" class="TT-button">Search</button>
                                <button type="reset" class="TT-button">Clear</button>
                            </div>
                        </div>

                    </form>


                    <div class="TT-type-display" id="TTdisplay1">

                        <?php

                        if ($classresult == true) {

                            if ($classresult->num_rows > 0) {

                        ?>
                                <table class="TT-type-display-table text-center table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Department Code</th>
                                            <th>Batch</th>
                                            <th>Course</th>
                                            <th>Department</th>
                                            <th>Department Name</th>
                                            <th>Semester</th>
                                            <th>Academic Year</th>
                                            <th colspan="3">Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody class="">
                                        <?php
                                        $classrow = mysqli_fetch_all($classresult, MYSQLI_ASSOC);
                                        $classmsg = $classrow;
                                    } else {
                                        $classmsg = "No Data Found";
                                    }

                                    if (is_array($classmsg)) {
                                        foreach ($classmsg as $data) {
                                        ?>
                                            <tr>
                                                <td><?php echo $data['cls_deptcode'] ?? ''; ?></td>
                                                <td><?php echo $data['cls_startyr'] . '-' . $data['cls_endyr'] ?? ''; ?></td>
                                                <td><?php echo $data['cls_course'] ?? ''; ?></td>
                                                <td><?php echo $data['cls_dept'] ?? ''; ?></td>
                                                <td><?php echo $data['cls_deptname'] ?? ''; ?></td>
                                                <td><?php echo $data['cls_sem'] ?? ''; ?></td>
                                                <td><?php echo $data['cls_acdstyr'] . '-' . $data['cls_acdedyr'] ?? ''; ?></td>
                                                <td><button class="TT-button btn btn-secondary" onclick="window.location.href= 'manageSem.php?id=<?php echo $data['cls_id']; ?>'">Manage Sem</button></td>
                                                <td><button class="TT-button btn btn-dark" onclick="window.location.href= 'editclass.php?id=<?php echo $data['cls_id']; ?>'">Edit</button></td>
                                                <td>
                                                    <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete this Class?')) { window.location.href = 'delClass.php?id=<?php echo $data['cls_id']; ?>'; }">Delete</button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    } else {   ?>
                                        <tr>
                                            <td rowspan="3"><?php echo $classmsg; ?></td>
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