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

    error_reporting(0);
    // Get the JSON data from the POST request
    $json_data = $_POST['data'];

    // Decode the JSON data into an array
    $data = json_decode($json_data, true);
    if ($_POST['day']) {
        # code...
        $tt_day = $_POST['day'];
    } else {
        # code...
        $tt_day = "---Select a Day---";
    }


    // display the data in the new page
    ?>
    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3 pb-5">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Timetable</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Schedule</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>


                    <!-- display class details -->
                    <table class="TT-type-display-table table table-sm">
                        <tbody>
                            <tr>
                                <th>Department</th>
                                <td><?php echo $data['cls_deptname']; ?></td>
                            </tr>
                            <tr>
                                <th>Semester</th>
                                <td><?php echo  $data['cls_course'] . ' - ' . $data['cls_dept'] . ' - semester - ' . $data['cls_sem']  ?></td>
                            </tr>
                            <tr>
                                <th>Start and End date </th>
                                <td><?php echo date('d-m-Y', strtotime($data['sc_frdate'])) . ' to ' . date('d-m-Y', strtotime($data['sc_todate'])) ?></td>
                            </tr>
                            <tr>
                                <th>Time Table Type</th>
                                <td><?php echo $data['type_title']; ?></td>
                            </tr>
                        </tbody>
                    </table>


                    <form method="post" action="schedule.php">

                        <div class="TT-form-content">
                            <div>
                                <label for="day" style="display:inline">Day:</label>
                                <select name="day" id="day">
                                    <?php
                                    if ($tt_day === "") {
                                        echo '<option value="">---Select a day---</option>';
                                    } else {
                                        # code...
                                        echo '<option value="' . $tt_day . '"> ' . $tt_day . ' </option>';
                                    }
                                    ?>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                </select>
                                <input type="hidden" name="data" value="<?php echo htmlspecialchars(json_encode($data));  ?>">
                                <button type="submit" name="select">select</button>
                            </div>
                        </div>
                    </form>

                    <?php if (isset($_POST['select'])) {
                    ?>
                        <div class="TT-container">

                            <?php
                            // get data from input form
                            $tt_day = $_POST['day'];
                            // Get the JSON data from the POST request
                            $json_data = $_POST['data'];

                            // Decode the JSON data into an array
                            $data = json_decode($json_data, true);

                            // initializing data
                            $cls_id = $data['cls_id'];
                            $sc_id = $data['sc_id'];
                            $max_period = $data['type_hours'];

                            // Query the database for the timetable data
                            $sql = "SELECT * FROM erp_timetable WHERE cls_id = '$cls_id' AND sc_id = '$sc_id' AND tt_day = '$tt_day'";
                            $result = mysqli_query($conn, $sql);
                            // }

                            $period_sql = "SELECT erp_timetable.*,erp_subject.sub_name FROM erp_timetable LEFT JOIN erp_subject ON erp_timetable.tt_subcode=erp_subject.tt_subcode WHERE erp_timetable.cls_id = '$cls_id' AND erp_timetable.sc_id = '$sc_id' AND erp_timetable.tt_day = '$tt_day' ORDER BY erp_timetable.tt_period ";
                            $period_result = mysqli_query($conn, $period_sql);
                            if (mysqli_num_rows($period_result) > 0) {
                            ?>
                                <table class="TT-type-display-table">
                                    <thead>
                                        <tr>
                                            <th>Period</th>
                                            <th>Subject</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Display the subject
                                        $period_row = mysqli_fetch_all($period_result);
                                        // for ($i = 1; $i <= $data['type_hours']; $i++) {
                                        foreach ($period_row as $period_row_data) {
                                        ?>
                                            <tr>
                                                <td><?php echo $period_row_data[4]; // index 4 has the period number
                                                    ?></td>
                                                <td><?php echo $period_row_data[5] . ' - ' . $period_row_data['9']; //index 5 has subject code and  index 9 has subject name
                                                    ?></td>

                                                <!-- // Display the update button -->
                                                <td>
                                                    <form method='post' action='updateschedule.php'>
                                                        <input type='hidden' name='tt_id' value='<?php echo $period_row_data['0']; ?>'> <!-- index 0 is the tt_id -->
                                                        <input type='hidden' name='tt_day' value='<?php echo $tt_day; ?>'>
                                                        <input type='hidden' name='tt_period' value='<?php echo $period_row_data[4]; ?>'>
                                                        <input type='hidden' name='subject' value='<?php echo $period_row_data[5]; ?>'>
                                                        <input type="hidden" name="data" value="<?php echo htmlspecialchars(json_encode($data));  ?>">
                                                        <input type='submit' name='update' value='Update'>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            <?php
                                // }
                            } else {
                            ?>
                                <table class="TT-type-display-table">
                                    <thead>
                                        <tr>
                                            <th>Period</th>
                                            <th>Subject</th>
                                        </tr>
                                    </thead>
                                    <form method='post' action='newaddschedule.php'>
                                        <tbody>

                                            <input type='hidden' name='cls_id' value='<?php echo $cls_id; ?>'>
                                            <input type='hidden' name='sc_id' value='<?php echo $sc_id; ?>'>
                                            <input type='hidden' name='tt_day' value='<?php echo $tt_day; ?>'>
                                            <input type="hidden" name="data" value="<?php echo htmlspecialchars(json_encode($data));  ?>">
                                            <?php
                                            for ($i = 1; $i <= $data['type_hours']; $i++) {

                                            ?>

                                                <tr>
                                                    <td><?php echo $i; ?></td>

                                                    <td>
                                                        <select name='tt_subcode[]' required>
                                                            <option value="">Not Assigned</option>

                                                            <?php
                                                            $subjects_sql = "SELECT * FROM erp_subject where cls_id=$cls_id";
                                                            $subjects_result = mysqli_query($conn, $subjects_sql);
                                                            while ($subjects_row = mysqli_fetch_assoc($subjects_result)) {
                                                            ?>
                                                                <option value=<?php echo $subjects_row["tt_subcode"] ?>><?php echo $subjects_row['sub_name'] ?></option>
                                                            <?php
                                                                // echo "<option value='" . $subjects_row['tt_subcode'] . "'>" . $subjects_row['sub_name'] . "</option>";
                                                            }
                                                            ?>
                                                        </select>
                                                    </td>
                                                </tr>

                                            <?php }
                                            ?>

                                        </tbody>
                                </table>
                                <input type='submit' name='submit_add' value='Add' class="TT-button">
                                </form>
                            <?php
                            } ?>
                            <!-- </tr> -->


                        </div>
                    <?php
                    }
                    ?>
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