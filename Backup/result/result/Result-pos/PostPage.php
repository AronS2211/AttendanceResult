<?php include('../../includes/config.php'); ?>
<?php
// error_reporting(0);
$log_id = $_SESSION['user_id']; // Store user ID in session (temp ) and use in all files 
//for Fetching faculty details into session on login
$sql1 = "SELECT * FROM `erp_faculty` where f_id='$log_id';";
$result1 = mysqli_query($conn, $sql1);
if (!$result1) {
    die('Query failed: ' . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result1);
$ClassIdFromFaculty = $row['cls_id'];


$SubjectCode = $_POST['SubjectCode'];
$ExamCeId = $_POST['ExamCeId'];
// for reciving Exam id
$sql = "SELECT * FROM `erp_exam` where ce_id=$ExamCeId and tt_subcode='$SubjectCode';";
$result = mysqli_query($con, $sql);
$exam_id = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['exam_id'];


if (isset($_POST['save'])) {
    $resultRecords = array_filter($_POST['resultRecords'], function ($item) {
        return isset($item['convertedMark']) && $item['convertedMark'] !== '';
    });

    $i = 0;
    // print_r($TableRows);
    if ($resultRecords) {
        if (count($resultRecords) > 0) {
            foreach ($resultRecords as $Item) {
                $ConvertedMark = $Item['convertedMark'];
                if ($_POST['save'] == "SaveAsDraft")
                    $ConvertedMark = "";

                $sql = "INSERT INTO `erp_mark` (`mark_id`, `stu_id`, `cls_id`, `ce_id`, `exam_id`, `mark_draft`, `mark_publish`, `mark_rstatus`, `mark_date`) VALUES (NULL, '" . $Item['regno'] . "', '$ClassIdFromFaculty', '" . $_POST['ExamCeId'] . "', '$exam_id', '" . $Item['convertedMark'] . "', '" . $ConvertedMark . "', 'Assignment', NOW())";

                if (isset($Item['MarkId']) && $Item['MarkId'] != "")
                    $sql = "UPDATE `erp_mark` SET `mark_draft` = '" . $Item['convertedMark'] . "', `mark_publish` = '$ConvertedMark', `mark_rstatus` = 'Assignment ',`mark_date`= NOW() WHERE `erp_mark`.`mark_id` = " . $Item['MarkId'] . ";";

                // Run the query
                if ($con->query($sql) === TRUE)
                    $i++;
                // echo $sql;
            }
        }
    }

    //change the location to dashboard both if and else with success or error message
    if (count($resultRecords) == $i)
        header("Location: " . "FormPage.php?result=success&status=$i succeded a Out of " . count($resultRecords) . "&Count=" . $i);
    else
        header("Location: " . "FormPage.php?result=error&status=$i succeded Out of " . count($resultRecords) . "&Count=" . $i);
}
?>
                  