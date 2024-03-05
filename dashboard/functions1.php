<?php
// session_start();
// if (isset($_SESSION['user_id'])) {
include('../includes/config.php');


if (isset($_POST['Operation'])) {
    if ($_POST['Operation'] == 'getSemestersUsingDepartment') {
        $selectedDepartment = $_POST['selectedDepartment'];
        $sql = "SELECT DISTINCT cls_sem, cls_id FROM erp_class WHERE cls_dept='$selectedDepartment'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $existingSemesters = array(); // Take from existing classes in class table
            while ($row = $result->fetch_assoc()) {
                $existingSemesters[] = $row;
            }
            // print_r($existingSemesters);
            echo "<option value='' selected>Select the Semester</option>";
            foreach ($existingSemesters as $existingSemester) {
                ?>
<option value="<?php echo $existingSemester['cls_sem'] . ',' . $existingSemester['cls_id'] ?>">
    <?php echo $existingSemester['cls_sem'] ?>
</option>
<?php
            }
        }
    }
}

if (isset($_POST['Operation'])) {
    if ($_POST['Operation'] == 'getCreatedExams') {
        $sql = "SELECT * FROM `erp_createexam`";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $existingCreatedExams = array(); // Take from existing classes in class table
            while ($row = $result->fetch_assoc()) {
                $existingCreatedExams[] = $row;
            }
            // print_r($existingCreatedExams);
            echo "<option value='' selected>Select the Exam</option>";
            foreach ($existingCreatedExams as $existingCreatedExam) {
                ?>
<option value="<?php echo $existingCreatedExam['ce_id'] ?>">
    <?php echo $existingCreatedExam['ce_exam'] ?>
</option>
<?php
            }
        }
    }
}
if (isset($_POST['Operation'])) {
    if ($_POST['Operation'] == 'topPerformanceFinder') {
        $selectedDepartment = $_POST['selectedDepartment'];
        $selectedSemester = $_POST['selectedSemester'];
        $selectedClassId = $_POST['selectedClassId'];
        $createdExamId = $_POST['createdExamId'];

        // Selected all students from a class for the selected exam
        $sql = "SELECT * FROM `erp_student` Where cls_id=$selectedClassId";
        $result = mysqli_query($conn, $sql);
        $studentsForSelectedExam = array(); // Take from existing classes in class table
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $studentsForSelectedExam[] = $row;
            }
            // echo count($studentsForSelectedExam);
        }

        // Selected all student mark entries for selected exam with mark published
        $sql = "SELECT * FROM `erp_mark` WHERE ce_id=$createdExamId";
        $result = mysqli_query($conn, $sql);
        $studentsMarkEntries = array(); // Take from existing classes in class table
        $studentMarkArray = array();
        $totalMarksAssocArray = array();
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $studentsMarkEntries[] = $row;
            }
            // echo count($studentsMarkEntries);

            // Getting student marks

            foreach ($studentsForSelectedExam as $studentForSelectedExam) {
                foreach ($studentsMarkEntries as $studentMarkEntry) {
                    if ($studentForSelectedExam['stu_id'] == $studentMarkEntry['stu_id']) {
                        $studentMarkArray[] = $studentMarkEntry['mark_publish'];
                    }
                }
                $average = round(array_sum($studentMarkArray) / count($studentMarkArray), 2);
                $totalMarksAssocArray[$studentForSelectedExam['stu_id']] = $average;
            }
        }
        // $totalMarksAssocArray = json_encode($totalMarksAssocArray);
        // print_r($totalMarksAssocArray);
        // echo $average;

        // Top performer metric parameters declaration
        $aboveNinety = 0;
        $eightyToNinety = 0;
        $seventyToEighty = 0;
        $sixtyToSeventy = 0;
        $fiftyToSixty = 0;
        $fortyToFifty = 0;
        $thirtyToForty = 0;
        $belowThirty = 0;

        $aboveNinetyArray = array();
        $eightyToNinetyArray = array();
        $seventyToEightyArray = array();
        $sixtyToSeventyArray = array();
        $fiftyToSixtyArray = array();
        $fortyToFiftyArray = array();
        $thirtyToFortyArray = array();
        $belowThirtyArray = array();
        foreach ($totalMarksAssocArray as $studentId => $mark) {
            if ($mark > 90) {
                $aboveNinety++;
                $aboveNinetyArray[] = $studentId;
            } elseif ($mark > 80 && $mark <= 90) {
                $eightyToNinety++;
                $eightyToNinetyArray[] = $studentId;
            } elseif ($mark > 70 && $mark <= 80) {
                $seventyToEighty++;
                $seventyToEightyArray[] = $studentId;
            } elseif ($mark > 60 && $mark <= 70) {
                $sixtyToSeventy++;
                $sixtyToSeventyArray[] = $studentId;
            } elseif ($mark > 50 && $mark <= 60) {
                $fiftyToSixty++;
                $fiftyToSixtyArray[] = $studentId;
            } elseif ($mark > 40 && $mark <= 50) {
                $fortyToFifty++;
                $fortyToFiftyArray[] = $studentId;
            } elseif ($mark > 30 && $mark <= 40) {
                $thirtyToForty++;
                $thirtyToFortyArray[] = $studentId;
            } else {
                $belowThirty++;
                $belowThirtyArray[] = $studentId;
            }
        }
        // To get all student Ids alone for sending them via achor tag
        $studentIdArray = array();
        foreach ($studentsForSelectedExam as $student) {
            $studentIdArray[] = $student['stu_id'];
        }
        // echo $aboveNinety. ',' . $eightyToNinety. ',' . $seventyToEighty. ',' . $sixtyToSeventy. ',' . $fiftyToSixty. ',' . $fortyToFifty. ',' . $thirtyToForty. ',' . $belowThirty;


        ?>
<td>1</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $studentIdArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $selectedDepartment ?>
    </a>
</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $aboveNinetyArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $aboveNinety ?>
    </a>
</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $eightyToNinetyArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $eightyToNinety ?>
    </a>
</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $seventyToEightyArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $seventyToEighty ?>
    </a>
</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $sixtyToSeventyArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $sixtyToSeventy ?>
    </a>
</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $fiftyToSixtyArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $fiftyToSixty ?>
    </a>
</td>|
<td>1</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $studentIdArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
    </a>
    <?php echo $selectedDepartment ?>
</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $fortyToFiftyArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $fortyToFifty ?>
    </a>
</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $thirtyToFortyArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $thirtyToForty ?>
    </a>
</td>
<td>
    <a class='topPerformerClassAnchorTag'
        href="topPerformerClassView.php?studentIds=<?php echo implode(',', $belowThirtyArray) . '&semester=' . $selectedSemester . '&department=' . $selectedDepartment ?>">
        <?php echo $belowThirty ?>
    </a>
</td>

<script>
$(document).ready(function(e) {
    $('.topPerformerClassAnchorTag').click(function(a) {
        a.preventDefault();
        var href = $(this).attr('href');
        console.log(href);
        window.open(href, 'All students', 'resizable,height=600,width=860');
    });
});
</script>

<?php

    }
}
if (isset($_POST['Operation'])) {
    if ($_POST['Operation'] == 'getDepartments') {
        $sql = "SELECT DISTINCT cls_dept from erp_class";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $existingDepartments = array(); // Take from existing classes in class table
            while ($row = $result->fetch_assoc()) {
                $existingDepartments[] = $row['cls_dept'];
            }
            echo "<option value='' selected>Select the Department</option>";
            foreach ($existingDepartments as $department) {
                ?>
<option value="<?php echo $department ?>">
    <?php echo $department ?>
</option>
<?php
            }
        }
    }
}


if (isset($_POST['Operation'])) {
    if ($_POST['Operation'] == 'filterNotResultPosted') {
        $selectedDepartment = $_POST['selectedDepartment'];
        $selectedExam = $_POST['selectedExam'];
        $sql = "SELECT * FROM `res_post_status_vw` WHERE cls_dept= '$selectedDepartment' AND ce_exam='$selectedExam'";
        $result = mysqli_query($conn, $sql);
        $filteredNotResultPostedArray = array(); // Take from existing classes in class table
        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                $filteredNotResultPostedArray[] = $row;
            }
            foreach ($filteredNotResultPostedArray as $filteredNotPostedRows) {
                ?>
<tr>
    <td>
        <?php echo $filteredNotPostedRows['cls_course'] . ' ' . $filteredNotPostedRows['cls_dept'] . ' ' . $filteredNotPostedRows['cls_sem'] . ' (' . $filteredNotPostedRows['cls_startyr'] . ' - ' . $filteredNotPostedRows['cls_endyr'] . ')' ?>
    </td>
    <td>
        <?php echo $filteredNotPostedRows['sub_name'] ?>
    </td>
    <td>
        <?php echo $filteredNotPostedRows['ce_exam'] ?>
    </td>
    <td>
        <?php echo $filteredNotPostedRows['f_fname'] . ' ' . $filteredNotPostedRows['f_lname'] ?>
    </td>
</tr>
<?php
            }
        } else {
            echo "<tr><td align='center' colspan='4'>0 records found!</td></tr>";
        }
    }
}


// Filtering attendance report with 3 select field values
if (isset($_POST['Operation'])) {
    if ($_POST['Operation'] == 'filteringAttendanceStatus') {
        $Query = '';
        $day = date('D');
        $selectValuesArray = $_POST['selectValuesArray'];
        if (array_key_exists('staff', $selectValuesArray) == 1) {
            $staffId = ($selectValuesArray['staff']);
            $Query .= "AND erp_subject.f_id='" . $staffId . "' ";
            // echo $staffId;
        }

        if (array_key_exists('department', $selectValuesArray) == 1) {
            $department = ($selectValuesArray['department']);
            $Query .= "AND cls_dept='" . $department . "' ";
            // echo $department;
        }

        if (array_key_exists('period', $selectValuesArray) == 1) {
            $period = ($selectValuesArray['period']);
            if ($period != 'default') {
                $Query .= "AND tt_period=" . $period . ' ';
            }
            // echo $period;
        }




        // QUERY for selecting all periods (of all departments) and along with it necessary information
        $sql = "SELECT erp_subject.f_id, erp_subject.tt_subcode, erp_subject.sub_name, erp_faculty.f_fname, erp_faculty.f_lname, erp_timetable.tt_day, erp_timetable.tt_period , erp_timetable.sc_id, erp_schedule.sc_frdate, erp_schedule.sc_todate, erp_timetable.cls_id, erp_class.cls_dept, erp_class.cls_sem, CURRENT_DATE AS att_date FROM erp_subject JOIN erp_faculty ON erp_faculty.f_id = erp_subject.f_id JOIN erp_timetable ON erp_timetable.tt_subcode = erp_subject.tt_subcode JOIN erp_class ON erp_class.cls_id = erp_timetable.cls_id JOIN erp_schedule ON erp_timetable.sc_id = erp_schedule.sc_id WHERE CURRENT_DATE BETWEEN sc_frdate AND sc_todate AND tt_day='$day' $Query;";
        // echo $sql;
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {

            $filteredAttendanceStatusArray = array(); // Take from existing classes in class table
            while ($row = $result->fetch_assoc()) {
                $filteredAttendanceStatusArray[] = $row;
            }
            $i = 1;
            foreach ($filteredAttendanceStatusArray as $filteredAttendanceStatusRecord) {
                $postedStatus = 0;
                $noOfStudentsPresent = 0;
                $noOfStudentsAbsent = 0;
                $classId = $filteredAttendanceStatusRecord['cls_id'];
                $sql = "SELECT COUNT(stu_id) as studentCount FROM erp_student WHERE cls_id = $classId";
                $result = mysqli_query($conn, $sql);
                $studentCount = $result->fetch_assoc()['studentCount'];
                // echo $studentCount;


                $sql = "SELECT * FROM erp_attendance WHERE att_sub='$filteredAttendanceStatusRecord[tt_subcode]' AND att_hour=$filteredAttendanceStatusRecord[tt_period] AND cls_id=$filteredAttendanceStatusRecord[cls_id] And att_date='2024-02-16';";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    $postedStatus = 1;
                    $attendanceTableArray = array();
                    while ($row = $result->fetch_assoc()) {
                        $attendanceTableArray[] = $row;
                    }
                    // Finding number of present for a faculty in attendance table
                    foreach ($attendanceTableArray as $attendanceRecord) {
                        if ($attendanceRecord['att_status'] == 'P') {
                            $noOfStudentsPresent++;
                        }
                    }
                    $noOfStudentsAbsent = $studentCount - $noOfStudentsPresent;
                }

                ?>
<tr>
    <td>
        <?php echo $i ?>
    </td>
    <td>
        <?php echo $filteredAttendanceStatusRecord['cls_dept'] ?>
    </td>
    <td>
        <?php echo $filteredAttendanceStatusRecord['cls_sem'] ?>
    </td>
    <td>
        <?php echo $filteredAttendanceStatusRecord['tt_period'] ?>
    </td>
    <td>
        <?php echo $filteredAttendanceStatusRecord['sub_name'] ?>
    </td>
    <td>
        <?php echo $filteredAttendanceStatusRecord['f_fname'] . ' ' . $filteredAttendanceStatusRecord['f_lname'] ?>
    </td>
    <td>
        <?php echo $postedStatus == 1 ? 'Posted' : 'Not Posted' ?>
    </td>
    <td>
        <?php echo $studentCount ?>
    </td>
    <td>
        <?php echo $noOfStudentsPresent ?>
    </td>
    <td>
        <?php echo $noOfStudentsAbsent ?>
    </td>
</tr>
<?php
                $i++;
            }
        }
    }
}
// }