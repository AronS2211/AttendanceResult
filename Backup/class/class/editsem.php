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

    <?php $clsid = $_REQUEST['clsid']; ?>

    <?php
    $status = "";
    $semid = $_REQUEST['sem_id'];  //getting id from request
    if (isset($_POST['new']) && $_POST['new'] == 1) {

        $Semester =       $_REQUEST['Semester'];
        $StartDate =         $_REQUEST['StartDate'];
        $EndDate =     $_REQUEST['EndDate'];

        $update = "UPDATE erp_sem SET sem_no='$Semester', sem_start='$StartDate', sem_end='$EndDate' WHERE sem_id='$semid'";
        mysqli_query($conn, $update);
        $status = "Record Updated Successfully.";
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

    $classsql = "SELECT * FROM erp_class WHERE cls_id= '$clsid' ";   // selecting value of the record Query
    $classresult = $conn->query($classsql);  //fetching
    $classrow = mysqli_fetch_assoc($classresult);


    $semsql = "SELECT * FROM erp_sem WHERE sem_id= '$semid' ";   // selecting value of the record Query
    $semresult = $conn->query($semsql);  //fetching
    $semrow = mysqli_fetch_all($semresult, MYSQLI_ASSOC);
    ?>

    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Semester Management</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between report-head">
                            <h6 class='mb-0'>Edit</h6>
                            <?php
                            echo "<h6>" . $classrow['cls_startyr'] . "-" . $classrow['cls_endyr'] . " " . $classrow['cls_course'] . "-" . $classrow['cls_dept'] . " semester " . $classrow['cls_sem'] . "</h6>";

                            ?>
                            <a href="manageSem.php?id=<?php echo $clsid; ?>">Manage Semester</a>
                        </div>
                    </div>
                    <!-- ur content -->

                    <?php
                    echo '<p id="status" class="text-center" style="color:#FF0000;">' . $status . '</p>';

                    if (is_array($semrow)) {
                        foreach ($semrow as $data) {
                    ?>


                            <form id="TTform" method="post" action="">
                                <div class="TT-form-content">
                                    <div><input type="hidden" name="new" value="1" /></div>
                                    <div><input name="id" type="hidden" value="<?php echo $data['sem_id']; ?>" /></div>
                                    <div>
                                        <label for="Semester">Semester</label>
                                        <input type="text" name="Semester" placeholder="Enter Semester" required value="<?php echo $data['sem_no']; ?>" />
                                    </div>
                                    <div>
                                        <label for="StartDate">Start Date</label>
                                        <input type="date" name="StartDate" placeholder="Enter StartDate" required value="<?php echo $data['sem_start']; ?>" />
                                    </div>
                                    <div>
                                        <label for="EndDate">End Date</label>
                                        <input type="date" name="EndDate" placeholder="Enter EndDate" required value="<?php echo $data['sem_end']; ?>" />
                                    </div>

                                    <div class="TT-form-button">
                                        <input class="TT-button" name="submit" type="submit" value="Update" />
                                    </div>
                                </div>

                            </form>
                    <?php
                        }
                    } ?>

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