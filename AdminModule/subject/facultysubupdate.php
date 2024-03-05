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



    <?php

    if (isset($_POST['update'])) {
        // If the submit update button was clicked, insert the new timetable entry into the database
        $sub_id = $_POST['sub_id'];
        $subcode = $_POST['subcode'];
        $subname = $_POST['subname'];
        $faculty = $_POST['faculty'];
        $cour = $_POST['course'];
        $dept = $_POST['department'];
        $sem = $_POST['semester'];
    }
    ?>



    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Subject Allocation</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Update</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>
                    <!-- ur content -->


                    <div class="d-flex justify-content-around">
                        <form action="suballocscript.php" method="post">

                            <div class="TT-form-content">
                                <?php
                                $faculty_query = "SELECT f_id,f_fname,f_lname,f_designation FROM erp_faculty  ORDER BY f_fname ASC";
                                $faculty_result = mysqli_query($conn, $faculty_query);
                                ?>
                                <input type="text" value="<?php echo $subcode . '-' . $subname ?>" disabled>
                                <input type="text" value="<?php echo $faculty ?>" disabled>
                                <input type="hidden" name="course" value='<?php echo $cour; ?>'>
                                <input type="hidden" name="department" value='<?php echo $dept; ?>'>
                                <input type="hidden" name="semester" value='<?php echo $sem; ?>'>
                                <input type='hidden' name='sub_id' id="recordId" value='<?php echo $sub_id; ?>'>
                                <select name='f_id' required>
                                    <option value="">Select faculty</option>
                                    <?php
                                    while ($faculty_row = mysqli_fetch_assoc($faculty_result)) {
                                    ?>
                                        <option value=<?php echo $faculty_row["f_id"] ?>><?php echo $faculty_row['f_fname'] . '  ' . $faculty_row['f_lname'] . ',' . $faculty_row['f_designation'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit" value="Update" name="add">
                            </div>
                        </form>
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