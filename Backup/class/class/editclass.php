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
                <div class="card text-bg-light mx-3 mt-3 mb-5">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Class Management</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between  report-head">
                            <h6 class='mb-0'>Edit</h6>
                            <h6 class='mb-0'></h6>
                            <!-- <div> -->
                                <a href="manageClass.php">Manage Class</a>
                            <!-- </div> -->
                        </div>
                    </div>
                    <!-- ur content -->
                    <div class="TT-type-display" id="TTdisplay">
                        <?php
                        $status = "";
                        if (isset($_POST['new']) && $_POST['new'] == 1) {
                            $id = $_REQUEST['id'];
                            $course =       $_REQUEST['course'];
                            $dept =         $_REQUEST['department'];
                            $deptname =     $_REQUEST['deptname'];
                            $deptcode =     $_REQUEST['deptcode'];
                            $batstartyear = $_REQUEST['startyear'];
                            $batendyear =   $_REQUEST['endyear'];
                            $startyear =    $_REQUEST['acdstyr'];
                            $endyear =      $_REQUEST['acdedyr'];
                            $semester =     $_REQUEST['semester'];
                            // $update = "UPDATE erp_class SET cls_course='$course', cls_dept='$dept', cls_deptname='$deptname', cls_deptcode='$deptcode', cls_startyr='$batstartyear', cls_endyr='$batendyear'     WHERE cls_id='$id'";
                            $update = "UPDATE erp_class SET cls_course='$course', cls_dept='$dept', cls_deptname='$deptname', cls_deptcode='$deptcode', cls_startyr='$batstartyear', cls_endyr='$batendyear', cls_acdstyr='$startyear', cls_acdedyr='$endyear', cls_sem='$semester' WHERE cls_id='$id'";
                            mysqli_query($conn, $update);
                            $status = "Record Updated Successfully.";
                            echo '<p id="status" style="color:#FF0000;">' . $status . '</p>';
                            echo '<script>
                                setTimeout(function() {
                                    document.getElementById("status").style.display = "none";
                                }, 5000); // 5000 milliseconds = 5 seconds
                            </script>';
                            echo "<script>
                    if (window.history.replaceState) {
                        window.history.replaceState(null, null, window.location.href);
                    }
                </script>";
                        }
                        $id = $_REQUEST['id'];  //getting id from request
                        $classsql = "SELECT * FROM erp_class WHERE cls_id= '$id' ";   // selecting value of the record Query
                        $classresult = $conn->query($classsql);  //fetching
                        $classrow = mysqli_fetch_all($classresult, MYSQLI_ASSOC);
                        if (is_array($classrow)) {
                            foreach ($classrow as $data) {
                        ?>
                    </div>
                    <form id="TTform" method="post" action="">
                        <div class="TT-form-content">
                            <div><input type="hidden" name="new" value="1" /></div>
                            <div><input name="id" type="hidden" value="<?php echo $data['cls_id']; ?>" /></div>
                            <div>
                                <label for="course">Course</label>
                                <input type="text" name="course" placeholder="Enter Course" required value="<?php echo $data['cls_course']; ?>" />
                            </div>
                            <div>
                                <label for="department">Department</label>
                                <input type="text" name="department" placeholder="Enter Department Abbr" required value="<?php echo $data['cls_dept']; ?>" />
                            </div>
                            <div>
                                <label for="deptname">Department Name</label>
                                <input type="text" name="deptname" placeholder="Enter Department Name" required value="<?php echo $data['cls_deptname']; ?>" />
                            </div>
                            <div>
                                <label for="deptcode">Department Code</label>
                                <input type="text" name="deptcode" placeholder="Enter Department Code" required value="<?php echo $data['cls_deptcode']; ?>" />
                            </div>
                            <div>
                                <label for="startyear">Start Year</label>
                                <input type="text" name="startyear" placeholder="Enter Start Year" required value="<?php echo $data['cls_startyr']; ?>" />
                            </div>
                            <div>
                                <label for="endyear">End Year</label>
                                <input type="text" name="endyear" placeholder="Enter End Year" required value="<?php echo $data['cls_endyr']; ?>" />
                            </div>
                            <div>
                                <label for="acdstyr">Academic Start Year</label>
                                <input type="text" name="acdstyr" placeholder="Enter Academic Start Year" required value="<?php echo $data['cls_acdstyr']; ?>" />
                            </div>
                            <div>
                                <label for="acdedyr">Academic End Year</label>
                                <input type="text" name="acdedyr" placeholder="Enter Academic End Year" required value="<?php echo $data['cls_acdedyr']; ?>" />
                            </div>
                            <div>
                                <label for="semester">Semester</label>
                                <input type="text" name="semester" placeholder="Enter Semester" required value="<?php echo $data['cls_sem']; ?>" />
                            </div>
                            <div class="TT-form-button">
                                <input class="TT-button" name="submit" type="submit" value="Update" />
                            </div>
                        </div>

                    </form>
            <?php
                            }
                        } ?>
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