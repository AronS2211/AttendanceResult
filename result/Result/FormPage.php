<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../assets/img/gcoe_logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../../reports/assets/css/anydata.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../Includes/style.css">

    <style>
        #result {
            background-color: var(--pri);
        }

        /* html {
            overflow: scroll;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }

        .item label,
        select {
            width: 300px;
        } */
    </style>
</head>
<?php include('../../includes/config.php'); ?>
<?php include('../../includes/header.php'); ?>

<body>

    <?php // include('../Includes/Header.php') 
    ?> <!--local directory -->
    <?php

    //main includes config file
    // include "../../includes/header.php"; //main includes Header file 

    $log_id = $_SESSION['user_id']; // Store user ID in session (temp ) and use in all files 
    //for Fetching faculty details into session on login
    $sql1 = "SELECT * FROM `erp_faculty` where f_id='$log_id';";
    $result1 = mysqli_query($conn, $sql1);
    if (!$result1) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result1);
    $ClassIdFromFaculty = $row['cls_id'];

    // print_r($_SESSION['FacultyDetails']);

    $currentYear = date('Y'); // Get current year
    $nextYear = date('Y', strtotime('+1 year')); // Get next year

    $ExamRows = mysqli_query($conn, "SELECT * FROM `erp_createexam` WHERE cls_id=$ClassIdFromFaculty AND ce_sdate > '$currentYear-01-01' AND ce_sdate < '$nextYear-01-01';");
    $ExamRows = mysqli_fetch_all($ExamRows);
    ?>
    <?php include('../../includes/sidebar.php'); ?>
    <main>
        <div class="main-container">

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Result Posting </h3>
                        <div>
                            <a href="../../home/index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'></h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>
                    <!-- ur content -->
                    <div class="frm d-flex justify-content-around">
                        <form action="EntryPage.php" method="post">
                            <div class="TT-form-content">
                                <input type="hidden" name="SubjectCode" id="SubjectCode" value="" />
                                <input type="hidden" name="ExamCeId" id="ExamCeId" value="" />
                                <!-- <div class="drop">
                                            <label for="">Date :</label>
                                            <input type="date" name="date" id="" required>
                                        </div> -->
                                <?php
                                $Result = mysqli_query($conn, "SELECT * FROM erp_class WHERE cls_id=$ClassIdFromFaculty");
                                $ClassDetails = mysqli_fetch_assoc($Result);

                                $Course = $ClassDetails['cls_course'];
                                $Department = $ClassDetails['cls_dept'];
                                $Semester = $ClassDetails['cls_sem'];
                                ?>

                                <div>
                                    <label>Course:</label>
                                    <select name='Course' id="Course" required>
                                        <option value="" selected>--Select--</option>
                                        <option value="<?php echo $Course; ?>">
                                            <?php echo $Course; ?>
                                        </option>
                                    </select>
                                </div>

                                <div class="item">
                                    <label>Department:</label>
                                    <select name='Department' id="Department">
                                        <option value="none" selected>--Select--</option>
                                        <option value="<?php echo $Department; ?>">
                                            <?php echo $Department; ?>
                                        </option>
                                    </select>
                                </div>
                                <div class="item">
                                    <b><label> Semester: </label></b>
                                    <select name='Semester' id='Semester'>
                                        <option value="none" selected>--Select--</option>
                                        <option value="<?php echo $Semester; ?>">
                                            <?php echo $Semester; ?>
                                        </option>
                                    </select>
                                </div>
                                <div class="item">
                                    <label>Exam Name </label>
                                    <select name='Exam' id="Exam" required>
                                        <option value="none" selected disabled hidden>--Select--</option>
                                        <?php
                                        foreach ($ExamRows as $ExamRow) {
                                            echo "<option value=" . $ExamRow[0] . "  >" . $ExamRow[2] . "</option>";
                                            if ($ExamRow == 'University Exam') {
                                                echo "super";
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="item">
                                    <label> Subject Name: </label>
                                    <select name='Subject' id="Subject" required>
                                        <option value="none" selected disabled hidden>--Select--</option>
                                    </select>
                                </div>
                                <div class="action_buttons">
                                    <button type="submit" name="submit_btn" class="btn btn-primary">OK</button> &emsp;
                                    <button class="btn btn-danger" type="reset" value="Reset" onclick="location.reload();">Clear</button>
                                </div>
                            </div>



                        </form>
                    </div>



                </div>
            </div>

            <?php
            if (isset($_GET['result'])) {
                if ($_GET['result'] == "success") {
                    echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Result marked for " . $_GET['Count'] . ".'
                    });
                </script>
            ";
                }
                if ($_GET['result'] == "error") {
                    echo "
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Result for " . $_GET['Count'] . " has failed to mark.'
                    });
                </script>
            ";
                }
            }
            include('../../includes/footer.php'); ?>
            <!-- ur content -->


        </div>
    </main>


</body>
<script src="../../assets/js/script.js"></script>
<script src="../assets/js/anydata.js"></script>
<script src="../assets/js/script.js"></script>
<script>
    $('#Exam').on('change', function() {
        var ExamCeId = $("#Exam").val();
        console.log(ExamCeId);
        $.ajax({
            url: '../ajax/ename.php',
            type: "POST",
            data: {
                ExamCeId: ExamCeId
            },
            success: function(result) {
                $('#Subject').html(result);
                console.log(result);
            }
        })
    });

    $('#Subject').on('change', function() {
        var subcode = $(this).val();
        console.log(subcode);
        $("#Subject").val(subcode);
    });
</script>


</html>