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

    // Get the JSON data from the POST request
    $fid = $_SESSION['user_id'];

    //fetch timetable
    $fsql = "SELECT f_fname,f_lname FROM erp_faculty WHERE f_id= '" . $fid . "'";
    $fresult = mysqli_query($conn, $fsql);
    while ($row = mysqli_fetch_assoc($fresult)) {
        $fname = $row['f_fname'] . " " . $row['f_lname'];
    }

    $subsql = "SELECT distinct tt_subcode,sub_name FROM erp_subject where f_id= '" . $fid . "'";
    $subresult = mysqli_query($conn, $subsql);
    $subject = array();
    $i = 0;
    while ($row = mysqli_fetch_assoc($subresult)) {
        $subject[$i] = $row['tt_subcode'];
        $i++;
    }


    // Get the current day
    $currentDay = date('l');


    $view_sql = "SELECT
                tt_day,tt_period,tt_subcode
             FROM
                erp_timetable
             WHERE
                erp_timetable.tt_subcode IN ('" . implode("','", $subject) . "')
             ORDER BY
                FIELD(tt_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";


    $result = mysqli_query($conn, $view_sql);
    // Prepare an array to store the results
    $tableData = array();
    $hours = 0;

    while ($row = $result->fetch_assoc()) {
        $tt_day = $row['tt_day'];
        $tt_period = $row['tt_period'];
        $tt_subcode = $row['tt_subcode'];
        if (!isset($tableData[$tt_day])) {
            $tableData[$tt_day] = array();
        }
        if (!isset($tableData[$tt_day][$tt_period])) {
            $tableData[$tt_day][$tt_period] = $tt_subcode;
        }

        if ($hours < $tt_period) {
            $hours = $tt_period;
        }
    }


    // getting all subjects of the faculty
    $subject_sql = "SELECT erp_subject.*,erp_faculty.f_fname,erp_faculty.f_lname FROM erp_subject LEFT JOIN erp_faculty ON erp_subject.f_id=erp_faculty.f_id WHERE erp_subject.f_id='" . $fid . "'";
    $subject_result = mysqli_query($conn, $subject_sql);


    ?>
    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">View Timetable</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>View</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <th>Day</th>
                            <?php
                            for ($i = 1; $i <= $hours; $i++) {
                                echo "<th>Period $i </th>";
                            }
                            ?>
                        </thead>
                        <tbody>
                            <?php

                            // Output the subject data
                            foreach ($tableData as $day => $data) {

                                // Check if the current day matches the row's day
                                $isCurrentDay = ($day === $currentDay);

                                // Apply different styles to the row based on whether it's the current day or not
                                $rowClass = $isCurrentDay ? 'current-day' : '';
                                echo "<tr class='$rowClass'><td>" . $day . "</td>";

                                for ($i = 1; $i <= $hours; $i++) {
                                    if (isset($data[$i])) {
                                        echo "<td>$data[$i]</td>";
                                    } else {
                                        echo "<td></td>";
                                    }
                                }
                                echo "</tr>";
                            }

                            ?>
                        </tbody>
                    </table>

                    <table class="TT-type-display-table">
                        <thead>
                            <tr>
                                <th>Sub code</th>
                                <th>Subject Name</th>
                                <th>Faculty</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // foreach ($subject_data as $row) {
                            while ($row = mysqli_fetch_assoc($subject_result)) {
                            ?>
                                <tr>
                                    <td><?php echo $row['tt_subcode'] ?></td>
                                    <td><?php echo $row['sub_name'] ?></td>
                                    <td><?php echo $row['f_fname'] . "  " . $row['f_lname'] ?></td>
                                </tr>
                            <?php

                            }
                            ?>
                        </tbody>
                    </table>
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