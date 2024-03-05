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

        $tt_id = $_POST['tt_id'];
        $tt_day = $_POST['tt_day'];
        $tt_period = $_POST['tt_period'];
        $subject = $_POST['subject'];

        // Get the JSON data from the POST request
        $json_data = $_POST['data'];
        // Decode the JSON data into an array
        $data = json_decode($json_data, true);
        // initializing data
        $max_period = $data['type_hours'];

        $cls_id = $data['cls_id'];
    }

    ?>

    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Timetable Schedule</h3>
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
                    <!-- // Display a dropdown menu to select the subject -->
                    <form method='post' action='updateschedulephp.php'>

                        <div class='TT-form-content'>
                            <input type='hidden' name='tt_id' value='<?php echo $tt_id ?>'>
                            <input type='text' readonly name='tt_day' value='<?php echo $tt_day; ?>'>
                            <input type='text' readonly name='tt_period' value='<?php echo 'Period ' . $tt_period; ?>'>
                            <input type='hidden' name='data' value='<?php echo htmlspecialchars(json_encode($data));  ?>'>
                            <select name='tt_subcode'>
                                <option value="">---select subject---</option>

                                <?php

                                $subjects_sql = "SELECT * FROM erp_subject where cls_id=$cls_id";
                                $subjects_result = mysqli_query($conn, $subjects_sql);
                                while ($subjects_row = mysqli_fetch_assoc($subjects_result)) {
                                    if ($subjects_row) {
                                ?>
                                        <option value="<?php echo $subjects_row['tt_subcode'] ?>" <?php echo (isset($subjects_row['tt_subcode']) && $subjects_row['tt_subcode'] == $subject) ? 'selected' : ''; ?>> <?php echo $subjects_row['tt_subcode']  . $subjects_row['sub_name'] ?></option>

                                <?php

                                    }
                                }
                                ?>
                            </select>
                            <input type="submit" value="Update">
                        </div>
                    </form>
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


<!-- <script>
    // clear form history
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script> -->

</html>