<div class="container pt-3">
    <div class="d-flex justify-content-center align-items-center">
        <h2>
            <?php echo date('F - Y') ?>
        </h2>
    </div>
    <?php

    if (isset($_SESSION['user_id'])) {
        // // Get the JSON data from the POST request
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
    }
    //
// 
    ?>
    <?php
    $month = date('m');
    $year = date('Y');
    $query = "SELECT * FROM erp_calender WHERE YEAR(cal_sdate) = $year
  AND MONTH(cal_sdate) = $month AND YEAR(cal_edate) = $year
  AND MONTH(cal_edate) = $month;";
    $result = mysqli_query($conn, $query);
    $numrow = mysqli_num_rows($result);
    if ($numrow > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $eid = $row["cal_id"];
            $event = $row['cal_event'];
            $evt_pic = $row['cal_pic'];
            ?>
    <!-- Modal -->
    <div class="modal fade" id="model<?php echo $eid; ?>" tabindex=" -1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <?php echo $event; ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body cal-event">
                    <img src="<?php echo ".." . $evt_pic; ?>">
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>
    <!-- Modal -->
    <?php
    $firstDayOfMonth = strtotime("$year-$month-01");
    $daysInMonth = date('t', $firstDayOfMonth);
    $firstDayOfWeek = date('N', $firstDayOfMonth);
    for ($calday = 1; $calday <= $daysInMonth; $calday++) {
        $originalDate = "$year-$month-$calday";
        $newDate = date("l", strtotime($originalDate));
        ?>
    <div class=" modal fade" id="model<?php echo $calday . $month . $year ?>" tabindex=" -1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                        <?php echo $calday . '-' . $month . '-' . $year . ' ( ' . $newDate . ' )'; ?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <section>
                        <h2>Time table</h2>
                        <!-- This form is just for style -->
                        <div>
                            <?php
                                // Get the current day
                                $currentDay = substr($newDate, 0, 2);
                                // $result = substr($myStr, 0, 5);
                                // Prepare and execute the SQL query to retrieve the timetable data
                                // $view_sql = "SELECT tt_day, GROUP_CONCAT(tt_subcode ORDER BY tt_period) AS subjects FROM erp_timetable where erp_timetable.tt_subcode in ({implode(',',$subject}) GROUP BY tt_day ORDER BY FIELD(tt_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
                                // "SELECT tt_day, GROUP_CONCAT(tt_subcode ORDER BY tt_period) AS subjects FROM erp_timetable WHERE cls_id = 'your_cls_id' AND sc_id = 'your_sc_id' GROUP BY tt_day ORDER BY FIELD(tt_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
                                //                 $view_sql = "SELECT tt_day,tt_period,tt_subcode FROM erp_timetable WHERE erp_timetable.tt_subcode IN ('" . implode("','", $subject) . "') ORDER BY
                                // FIELD(tt_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday')";
                                $view_sql = "SELECT tt_day,tt_period,tt_subcode FROM erp_timetable WHERE erp_timetable.tt_subcode IN ('" . implode("','", $subject) . "') ORDER BY
                // FIELD(tt_day, 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun')";
                                $result = mysqli_query($conn, $view_sql);
                                // Prepare an array to store the results
                                echo $view_sql;
                                $tableData = array();
                                $hours = 0;
                                while ($row = $result->fetch_assoc()) {
                                    $tt_day = $row['tt_day'];
                                    $tt_period = $row['tt_period'];
                                    $tt_subcode = $row['tt_subcode'];
                                    // echo $tt_day, $tt_period, $tt_subcode;
                                    if (!isset($tableData[$tt_day])) {
                                        $tableData[$tt_day] = array();
                                    }
                                    if (!isset($tableData[$tt_day][$tt_period])) {
                                        $tableData[$tt_day][$tt_period] = $tt_subcode;
                                    }

                                    if ($hours < $tt_period) {
                                        $hours = $tt_period;
                                        // echo $hours;
                                    }
                                }
                                ?>
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

                                            if ($currentDay == $day) {

                                                // Apply different styles to the row based on whether it's the current day or not
                                                $rowClass = $isCurrentDay ? 'current-day' : '';
                                                echo "<tr class='$rowClass'><td>" . $day . "</td>";

                                                for ($i = 1; $i <= $hours; $i++) {
                                                    // 
                                                    echo $data[0];
                                                    // 
                                                    if (isset($data[$i])) {
                                                        echo "<td>$data[$i]</td>";
                                                    } else {
                                                        echo "<td></td>";
                                                    }
                                                }
                                                echo "</tr>";
                                            }
                                        }

                                        ?>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <?php
                                $subject_sql = "SELECT erp_subject.*,erp_faculty.f_fname,erp_faculty.f_lname FROM erp_subject LEFT JOIN erp_faculty ON erp_subject.f_id=erp_faculty.f_id WHERE erp_subject.f_id='" . $fid . "'";
                                $subject_result = mysqli_query($conn, $subject_sql);
                                // $subject_data = mysqli_fetch_all($subject_result);
                                ?>
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
                                        <td>
                                            <?php echo $row['tt_subcode'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sub_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $row['f_fname'] . "  " . $row['f_lname'] ?>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                        ?>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
    ?>
    <?php
    function build_calendar($month, $year, $conn, $subject, $fid)
    {
        $firstDayOfMonth = strtotime("$year-$month-01");
        $daysInMonth = date('t', $firstDayOfMonth);
        $firstDayOfWeek = date('N', $firstDayOfMonth);
        // // Create an array with day names
        $dayNames = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        // // Start the table
        echo "<table class='calendar-table'>";
        echo "<tr>";
        foreach ($dayNames as $day) {
            echo "<th>$day</th>";
        }
        echo "</tr>";

        // // Start the first row
        echo "<tr>";

        // // Add empty cells for the days before the first day of the month
        for ($i = 1; $i < $firstDayOfWeek; $i++) {
            echo "<td></td>";
        }

        // // Fill in the days of the month
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $originalDate = "$year-$month-$day";
            $newDate = date("l", strtotime($originalDate));
            ?>
    <?php
            $event = '&ensp;';
            $evt_pic = '&ensp;';
            $query = "SELECT * FROM `erp_calender` where '$year-$month-$day' between cal_sdate and cal_edate;";
            $result = mysqli_query($conn, $query);
            $numrow = mysqli_num_rows($result);
            if ($numrow > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $event = $row['cal_event'];
                    $evt_pic = $row['cal_pic'];
                    $eid = $row["cal_id"];
                }
            }
            $today = date('d');
            $cls = '';
            if ($today == $day) {
                $cls = 'today';
            }

            echo "<td class='$cls'>
        <div class='d-flex flex-column'>
            <div class='d-flex flex-row'>
                <p></p>";

            $filteredString = preg_replace("/[^a-zA-Z]/", "", $event);
            $lowercaseString = strtolower($filteredString);
            $hday = '';
            if ($lowercaseString == "holiday") {
                $hday = 'leave';
            }
            if (strpos($lowercaseString, "holiday")) {
                $hday = 'leave';
            }
            $lowercaseString = strtolower($newDate);
            if ($lowercaseString == 'sunday') {
                $hday = 'leave';
            }
            $evt = '';
            if ($event != "&ensp;") {
                $evt = 'events';
            }
            //$event = '&ensp;';
            if ($lowercaseString == 'sunday') {
                echo "<p class='$evt fs-day $hday'><button>" . $day . "</button></p>";
            } else {
                if ($today == $day) {
                    echo "<p class='today fs-day'><button data-bs-toggle='modal' data-bs-target='#model" . $day . $month . $year . "'>
            " . $day . "</button></p>";
                } else {
                    echo "<p class='$evt fs-day $hday'><button data-bs-toggle='modal' data-bs-target='#model" . $day . $month . $year . "'>
            " . $day . "</button></p>";
                }
            }

            echo "</div>
            <div class='d-flex flex-row'>";
            if ($evt_pic != '&ensp;') {
                echo '<button class="model-link" data-bs-toggle="modal" data-bs-target="#model' . $eid . '">
            ' . $event . '
          </button>';
            }
            echo "</div>
        </div>
        </td>";
            // Start a new row after each Saturday
            if (date('N', strtotime("$year-$month-$day")) == 7) {
                echo "</tr><tr>";
            }
        }

        // End the table
        echo "</tr></table>";
    }

    $month = date('m');
    $year = date('Y');

    build_calendar($month, $year, $conn, $subject, $fid);
    ?>
</div>
<style>
</style>