<?php
include('../../includes/config.php');
$c =  $_POST['c'];
$d =  $_POST['d'];
$s =  $_POST['s'];
// $en =  $_POST['en'];
// $sb =  $_POST['sb'];
// print_r($sb);
// $cc = "SELECT distinct stu_id FROM erp_mark
// LEFT JOIN erp_exam
// ON erp_exam.exam_id = erp_mark.exam_id
// LEFT JOIN erp_class
// ON erp_mark.cls_id = erp_class.cls_id
// LEFT JOIN erp_createexam
// ON erp_mark.ce_id = erp_createexam.ce_id
// LEFT JOIN erp_subject
// ON erp_exam.tt_subcode = erp_subject.tt_subcode where cls_course='$c' AND cls_dept='$d' AND cls_sem='$s' AND ce_exam='$en' AND sub_name='$sb'";
// $cq = mysqli_query($con, $cc);
$sql = "SELECT cls_id FROM `erp_class` where cls_dept='$d' and cls_sem ='$s'and cls_course='$c';";
$result = mysqli_query($con, $sql);
$cls_id = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['cls_id'];

$sql = "SELECT * FROM `erp_subject` where cls_id=$cls_id;";
$result = mysqli_query($con, $sql);
$SubjectRows = mysqli_fetch_all($result, MYSQLI_ASSOC);

$output = '<option value="">--Select--</option>';
// while ($cr = mysqli_fetch_assoc($cq)) {
//     $output .= '<option dept="' . $d . '" course="' . $c . '" sem="' . $s . '" en="' . $en . '" sb="' . $sb . '" rn="' . $cr['stu_id'] . '">' . $cr['stu_id'] . '</option>';
// }
foreach ($SubjectRows as $Item) {
    $output .= "<option value='" . $Item['tt_subcode'] . "'>" . $Item['sub_name'] . "</option>";
}
echo $output;
