<?php include('../../includes/config.php'); ?>
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

    <style>
        #attendance {
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
        select,
        input {
            width: 300px;
        } */
    </style>
</head>

<body>
    <?php include('../../includes/header.php'); ?>
    <?php include('../../includes/sidebar.php'); ?>
    <?php //include('../Includes/Header.php'); 
    ?>
    <?php $log_id = $_SESSION['user_id']; // Store user ID in session (temp ) and use in all files 
    //for Fetching faculty details into session on login
    $sql1 = "SELECT * FROM `erp_faculty` where f_id='$log_id';";
    $result1 = mysqli_query($conn, $sql1);
    if (!$result1) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result1);
    $_SESSION["UserDetails"]=$row;
    $ClassIdFromFaculty = $row['cls_id'];
    ?>

    <main>
        <div class="main-container">
            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Attendance Entry</h3>
                        <div>
                            <a href="../../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <!-- <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Entry</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div> -->
                    <!-- ur content -->
                    <div class="frm d-flex justify-content-around">
                        <form action="EntryPage.php" method="post">
                            <div class="TT-form-content">
                                <div class="">
                                    <div class="">
                                        <label for="">Date :</label>
                                        <input type="date" style="align-items:center;" name="date" id="date" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                    <?php
                                    $Result = mysqli_query($con, "SELECT * FROM erp_class WHERE cls_id=$ClassIdFromFaculty");
                                    $ClassDetails = mysqli_fetch_assoc($Result);
                                    $Course = $ClassDetails['cls_course'];
                                    $Department = $ClassDetails['cls_dept'];
                                    $Semester = $ClassDetails['cls_sem'];
                                    ?>
                                    <div class="item">
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
                                        <label>Period: </label>
                                        <select name="Period" id="Period">
                                            <option value="none" selected>--Select--</option>
                                        </select>
                                    </div>
                                    <div class="item">
                                        <label> Subject : </label>
                                        <select name='Subject' id="Subject">
                                            <option value="none" selected>--Select--</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="action_buttons">
                                <button type="submit" name="submit_btn" class="btn btn-primary">OK</button> &emsp;
                                <button class="btn" type="reset" value="Reset" onclick="location.reload();">Clear</button>
                            </div>
                        </form>
                    </div>
                    <?php
                    $currentDayName = date('D');
                    ?>
                </div>
                <hr>
            </div>
            <script>
                $('#Semester').on('change', function() {
                    var date = $('#date').val();
                    $.ajax({
                        url: '../ajax/GetPeriodsList.php',
                        type: "POST",
                        data: {
                            date: date
                        },
                        success: function(result) {
                            $('#Period').html(result);
                        }
                    });
                });

                $('#Period').on('change', function() {
                    var Period = $('#Period').val();
                    $.ajax({
                        url: '../ajax/GetSubjectList.php',
                        type: "POST",
                        data: {
                            Period: Period
                        },
                        success: function(result) {
                            console.log(result);
                            $('#Subject').html(result);
                        }
                    });
                });
            </script>
            <?php
            if (isset($_GET['result'])) {
                if ($_GET['result'] == "success") {
                    echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Attendance marked for " . $_GET['status'] . ".'
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
                        text: 'Result for " . $_GET['status'] . " has failed to mark.'
                    });
                </script>
            ";
                }
            }
            ?>
            <!-- ur content -->
        </div>


    </main>

    <?php include('../../includes/footer.php'); ?>
</body>
<script src="../../assets/js/script.js"></script>
<script src="../assets/js/anydata.js"></script>
<script src="../assets/js/script.js"></script>

</html>