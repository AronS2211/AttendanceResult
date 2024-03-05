<?php

session_start();

if (isset($_SESSION['user_id'])) {

    include('../includes/config.php');


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Attendance Table</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.10.3/jspdf.umd.min.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

        <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

    </head>

    <body>

        <?php

        $course = $_POST['course'];
        $department = $_POST['department'];
        $semester = $_POST['semester'];
        $strdate = $_POST['strdate'];
        $enddate = $_POST['enddate'];


        // Your existing code for querying the database goes here...
        $classquery = "SELECT cls_id FROM erp_class WHERE cls_dept='$department' AND cls_course='$course' AND cls_sem='$semester'";
        $result2 = $conn->query($classquery);

        $row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
        foreach ($row2 as $data) {
            $clsid = $data['cls_id'];
        }

        $stdatesql = "select sem_start from erp_sem where cls_id='$clsid' and sem_no='$semester'";
        $stresult = $conn->query($stdatesql);

        $dtrow = mysqli_fetch_all($stresult, MYSQLI_ASSOC);
        foreach ($dtrow as $data) {
            $strdate = $data['sem_start'];
        }


        // Fetch student data based on selections and date range
        $sql = "SELECT
   *
FROM
    erp_class ec
LEFT JOIN
    erp_student es ON ec.cls_id = es.cls_id
LEFT JOIN
    erp_attendance a ON a.stu_id = es.stu_id
JOIN
    erp_timetable t ON a.cls_id = t.cls_id
WHERE
    a.cls_id = $clsid
    AND a.att_date BETWEEN '$strdate' AND '$enddate'"; // Use BETWEEN for date range


        $result = $conn->query($sql);
        $students = array();
        while ($row = mysqli_fetch_assoc($result)) {
            // print_r($row);
            $stu_id = $row['stu_id'];
            $stu_fname = $row['stu_fname'];
            $stu_lname = $row['stu_lname'];
            $att_date = $row['att_date'];
            $p = $row['att_hour'];
            $status = $row['att_status'];
            $sub_code = $row['att_sub'];



            if (!isset($students[$stu_id])) {
                // Create a new entry for the student
                $students[$stu_id] = array(
                    'stu_id' => $stu_id,
                    'stu_fname' => $stu_fname,
                    'stu_lname' => $stu_lname,

                    'date' => array()
                );
            }
            if (!isset($students[$stu_id]['date'][$att_date])) {
                $students[$stu_id]['date'][$att_date] = array();
            }
            if (!isset($students[$stu_id]['date'][$att_date][$p])) {
                $students[$stu_id]['date'][$att_date][$p] = array(
                    'status' => $status,
                    'sub_code' => $sub_code
                );
            }
        }
        // Display the fetched data in a Bootstrap table
        ?>

        <button id="csv" class="btn btn-info">Export To Excel</button>&nbsp;
        <button id="pdf" class="btn btn-info">Export To PDF</button>&nbsp;
        <div class="container mt-5" id="report">


            <table class="table table-bordered downloadable" id="datatable">
                <thead>

                    <tr>

                        <th colspan="500">
                            <h3 class="text-center"> Grace College Of Engineering <br></h3>
                        </th>


                    </tr>
                    <tr>
                        <th colspan="500">
                            <h4 class="text-center">Attendance Report Generation</h4>
                        </th>
                    </tr>

        </div>

        <tr>

            <th colspan="500" class="text-center"><?php echo $course . "-" . $department . " semester " . $semester ?></th>
        </tr>

        <tr>
            <th rowspan="3">S.No</th>
            <th rowspan="3">Name</th>


            <th rowspan="3">Admission No</th>


            <?php

            $date_query1 = "SELECT DISTINCT att_date FROM erp_attendance WHERE att_date BETWEEN '$strdate' AND '$enddate'";
            $date_result1 = $conn->query($date_query1);

            $periods1 = []; // Store periods for each date
            $alldcount = 0;
            while ($date_row = mysqli_fetch_assoc($date_result1)) {
                $att_date1 = $date_row['att_date'];
                $period_query = "SELECT DISTINCT att_hour FROM erp_attendance WHERE att_date = '$att_date1'";
                $period_result = $conn->query($period_query);
                $date_periods = mysqli_fetch_all($period_result, MYSQLI_ASSOC);
                $periods1[$att_date] = $date_periods;
                $period_count = count($date_periods);
                // echo "<th colspan=\"" . ($period_count) . "\" class=\"text-center\">$att_date</th>";
                $alldcount++;
            }


            $date_query = "SELECT DISTINCT att_date FROM erp_attendance WHERE att_date BETWEEN '$strdate' AND '$enddate'";
            $date_result = $conn->query($date_query);

            $periods = []; // Store periods for each date
            $dcount = 0;
            while ($date_row = mysqli_fetch_assoc($date_result)) {
                $att_date = $date_row['att_date'];
                $period_query = "SELECT DISTINCT att_hour FROM erp_attendance WHERE att_date = '$att_date'";
                $period_result = $conn->query($period_query);
                $date_periods = mysqli_fetch_all($period_result, MYSQLI_ASSOC);
                $periods[$att_date] = $date_periods;
                $period_count = count($date_periods);
                echo "<th class='hideable' colspan=\"" . ($period_count) . "\" class=\"text-center\">$att_date</th>";
                $dcount++;
            }


            ?>
            <th rowspan="3" colspan="">Total Hours</th>
            <th rowspan="3" colspan="">Attended Hours</th>
            <th rowspan="3" colspan="">Att%</th>
            <th rowspan="3" colspan="">Overall Hours</th>
            <th rowspan="3" colspan="">Overall attended Hours</th>
            <th rowspan="3" colspan="">Overall%</th>

        <tr>
            <?php
            foreach ($periods as $date => $date_periods) {
                foreach ($date_periods as $period_data) {
                    echo "<th class='hideable'>P" . $period_data['att_hour'] . " </th>";
                }
            }
            ?>

        </tr>
        <tr>
            <?php
            foreach ($students as $student) {
                // print_r($student);
                $count = 0;
                foreach ($periods as $date => $date_periods) {

                    foreach ($date_periods as $period_info) {
                        $period = $period_info['att_hour'];

                        $sub_code = $student['date'][$date][$period]['sub_code'];
                        echo "<th class='hideable'>" . $sub_code . "</th>";
                    }
                    $count1 = 0;
                    $count1++;
                }
                if ($count != $count1) {
                    break;
                }
                $count++;
            }
            ?>
        </tr>

        </thead>
        <tbody>
            <?php
            // Loop through students and display attendance data
            $serialNo = 1;
            foreach ($students as $student) {
                echo "<tr>";
                echo "<td>{$serialNo}</td>"; // Display the serial number
                $serialNo++;
                echo "<td>{$student['stu_fname']} {$student['stu_lname']}</td>";
                echo "<td>{$student['stu_id']}</td>";
                $attdhours = 0;
                $overallatdhours = 0;
                foreach ($periods as $date => $date_periods) {
                    foreach ($date_periods as $period_info) {
                        $period = $period_info['att_hour'];

                        if (isset($student['date'][$date][$period])) {
                            $status = $student['date'][$date][$period]['status'];
                            $sub_code = $student['date'][$date][$period]['sub_code'];
                            echo "<td class='hideable'>$status</td>";
                            if ($status === 'P') {
                                # code...
                                $attdhours++;
                            }
                        } else {
                            echo "<td></td><td></td>";
                        }
                    }
                }


                $date_result3 = $conn->query($date_query1);

                $periods3 = []; // Store periods for each date
                while ($date_row = mysqli_fetch_assoc($date_result3)) {
                    $att_date3 = $date_row['att_date'];
                    $period_query3 = "SELECT DISTINCT att_hour FROM erp_attendance WHERE att_date = '$att_date3'";
                    $period_result3 = $conn->query($period_query3);
                    $date_periods3 = mysqli_fetch_all($period_result3, MYSQLI_ASSOC);
                    $periods3[$att_date3] = $date_periods3;
                    $period_count3 = count($date_periods3);
                    // echo "<th colspan=\"" . ($period_count) . "\" class=\"text-center\">$att_date</th>";
                    // $alldcount++;
                }


                foreach ($periods3 as $date => $date_periods) {
                    foreach ($date_periods as $period_info) {
                        $period = $period_info['att_hour'];

                        if (isset($student['date'][$date][$period])) {
                            $status = $student['date'][$date][$period]['status'];
                            if ($status === 'P') {
                                # code...
                                $overallatdhours++;
                            }
                        } else {
                        }
                    }
                }

                $c1 = $dcount * $period_count;
                $attper = ($attdhours / $c1) * 100;
                echo "<td>$c1</td>";
                echo "<td>$attdhours</td>";
                echo "<td>" . round($attper) . "%</td>";


                $c2 = $alldcount * $period_count;
                $overall = ($overallatdhours / $c2) * 100;
                echo "<td>$c2</td>";
                echo "<td>$overallatdhours</td>";
                echo "<td>" . round($overall) . "%</td>";
                echo "</tr>";
            }


            ?>



        </tbody>

        </table>

        <footer>
            <div class="d-flex justify-content-between mt-5">
                <div class="p-2">CLASS ADVISER</div>
                <div class="p-2">HOD</div>
                <div class="p-2">PRINCIPAL</div>
            </div>
        </footer>


        <?php
        $conn->close();
        ?>



        <script>
            function html_table_to_excel(type) {
                var data1 = document.getElementById('datatable');


                var file = XLSX.utils.table_to_book(data1, {
                    sheet: "sheet1"
                });



                XLSX.write(file, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                });

                XLSX.writeFile(file, 'report.' + type);
            }

            const export_button = document.getElementById('csv');

            export_button.addEventListener('click', () => {
                html_table_to_excel('xlsx');
            });


            function generatePDF() {
                var createpdf = document.getElementById("report");
                var opt = {
                    margin: 0.10,
                    filename: 'report.pdf',
                    html2canvas: {
                        scale: 1
                    },
                    jsPDF: {
                        unit: 'in',
                        format: 'A4',
                        orientation: 'portrait'
                    }
                };

                html2pdf().set(opt).from(createpdf).save();
            }

            const export_pdf = document.getElementById('pdf');

            export_pdf.addEventListener('click', () => {
                // Hide elements with the class 'hideable'
                var hideableElements = document.querySelectorAll('.hideable');
                hideableElements.forEach(element => {
                    element.style.display = 'none';
                });

                generatePDF();
            });
        </script>



    </body>


    </html>
<?php
} else {
    header("Location: ../index.php");
}
?>