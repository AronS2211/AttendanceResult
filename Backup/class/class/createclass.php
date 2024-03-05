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

</head>

<body>
    <?php include('../../includes/config.php'); ?>
    <?php include('../../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Class Creation</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Create</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>
                    <!-- ur content -->
                    <form action="#" method="post" id="TTform">

                        <div class="TT-form-content">
                            <div>
                                <label for="course">Course:</label>
                                <select name="course" id="" required>
                                    <option value="">---Select a Course---</option>
                                    <option value="B.E">B.E</option>
                                    <option value="B.Tech">B.Tech</option>
                                    <option value="M.E">M.E</option>
                                    <option value="M.B.A">M.B.A</option>
                                </select>
                            </div>
                            <div>
                                <label for="dept-name-abbr">Department: </label>
                                <select name="dept-name-abbr" id="" required>
                                    <option value="">---Select a Department---</option>
                                    <option value="CSE">CSE</option>
                                    <option value="ECE">ECE</option>
                                    <option value="EEE">EEE</option>
                                    <option value="MECH">MECH</option>
                                    <option value="CIVIL">CIVIL</option>
                                    <option value="AI DS">AI DS</option>
                                    <option value="MBA">MBA</option>
                                    <option value="AE">AE</option>
                                    <option value="PSE">PSE</option>
                                </select>
                            </div>
                            <div>
                                <label for="dept-name">Department Name:</label>
                                <select name="dept-name" id="" required>
                                    <option value="">---Select a Department---</option>
                                    <option value="Computer Science And Engineering">Computer Science And Engineering
                                    </option>
                                    <option value="Electronics And Communication Engineering">Electronics And Communication Engineering</option>
                                    <option value="Electrical And Electronics Engineering">Electrical And Electronics Engineering</option>
                                    <option value="Mechanical Engineering">Mechanical Engineering</option>
                                    <option value="Civil Engineering">Civil Engineering</option>
                                    <option value="Artificial Intelligence and Data Science">Artificial Intelligence And Data Science</option>
                                    <option value="Master of Business Administration">Master of Business Administration
                                    </option>
                                    <option value="Applied Electronics">Applied Electronics</option>
                                    <option value="Power Systems Engineering">Power Systems Engineering</option>
                                </select>
                            </div>
                            <div>
                                <label for="dept-code">Department Code:</label>
                                <input type="text" name="dept-code" value="" required>
                            </div>
                            <div>
                                <label for="bat-start-year">Batch start Year:</label>
                                <input type="text" name="bat-start-year" value="" required>
                            </div>
                            <div>
                                <label for="bat-end-year">Batch End Year:</label>
                                <input type="text" name="bat-end-year" value="" required>
                            </div>
                            <div class="TT-form-button">
                                <button type="submit" name="create" class="TT-button">Create</button>
                                <button type="reset" class="TT-button">Clear</button>
                            </div>
                        </div>

                    </form>
                    <!-- ur content -->


                    <!-- creating type php code-->
                    <?php



                    if (isset($_POST['create'])) {
                        //variable declaration
                        $course = mysqli_real_escape_string($conn, $_POST['course']);
                        $dept = mysqli_real_escape_string($conn, $_POST['dept-name-abbr']);
                        $deptname = mysqli_real_escape_string($conn, $_POST['dept-name']);
                        $deptcode = mysqli_real_escape_string($conn, $_POST['dept-code']);
                        $batstartyear = mysqli_real_escape_string($conn, $_POST['bat-start-year']);
                        $batendyear = mysqli_real_escape_string($conn, $_POST['bat-end-year']);
                        $startyear = $batstartyear;
                        $endyear = $batstartyear + 1;
                        $semester  = 0;

                        $fetchsql = "SELECT cls_id from erp_class where cls_startyr=$batstartyear and cls_endyr=$batendyear and cls_deptcode=$deptcode";
                        $fetchresult = $conn->query($fetchsql);
                        if ($fetchresult->num_rows > 0) {
                            # code...
                            echo '<script>swal.fire("Class Already Exist")</script>';
                        } else {
                            # code...

                            $classsql = "INSERT INTO `erp_class` (`cls_startyr`, `cls_endyr`, `cls_deptcode`, `cls_dept`, `cls_deptname`, `cls_sem`, `cls_course`, `cls_acdstyr`, `cls_acdedyr`) VALUES('$batstartyear','$batendyear','$deptcode','$dept','$deptname','$semester','$course','$startyear','$endyear')";
                            $classresult = $conn->query($classsql);
                            if ($classresult === TRUE) {
                                # code...

                    ?>
                                <script>
                                    document.getElementById("TTform").reset();
                                </script>
                    <?php

                                echo '<script>swal.fire("Class successfully Created")</script>';
                            } else {
                                echo "Error: " . $classsql . "<br>" . $conn->error;
                            }
                        }
                    }
                    $conn->close();
                    ?>

                    <!-- creation code ends -->

                </div>


            </div>
    </div>

    </main>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
<script src="../../assets/js/script.js"></script>
<script src="../assets/js/anydata.js"></script>
<script src="../assets/js/script.js"></script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

</html>