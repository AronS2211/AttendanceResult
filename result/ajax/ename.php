<?php
include "../../includes/config.php";// contain DBconnection and session start
// session_start();

$log_id=$_SESSION['user_id'];// $con = mysqli_connect("localhost", "root", "", "graceerp");
// $c =  $_POST['c'];
// $d =  $_POST['d'];
// $s =  $_POST['s'];
$ExamCeId =  $_POST['ExamCeId'];
$FacultyId=$_SESSION['user_id'];
// echo $ExamCeId.$FacultyId;
// print_r($en);
//query need to be altered
// $cc = "SELECT distinct sub_name,erp_subject.tt_subcode FROM erp_mark 
// LEFT JOIN erp_exam
// ON erp_exam.exam_id = erp_mark.exam_id
// LEFT JOIN erp_class
// ON erp_mark.cls_id = erp_class.cls_id
// LEFT JOIN erp_createexam
// ON erp_mark.ce_id = erp_createexam.ce_id
// LEFT JOIN erp_subject
// ON erp_exam.tt_subcode = erp_subject.tt_subcode where cls_course='$c' AND cls_dept='$d' AND cls_sem='$s' AND ce_exam='$en'";
$cc = "SELECT * FROM `erp_exam` A join erp_subject B on A.tt_subcode=B.tt_subcode where A.ce_id=$ExamCeId and B.f_id='$FacultyId';";
$cq = mysqli_query($conn, $cc);
$output = '<option value="">--Select--</option>';
while ($cr = mysqli_fetch_assoc($cq)) {
    $output .= '<option value="' . $cr['tt_subcode'] . '" >' . $cr['sub_name'] . '</option>';
    // $output .= '<option dept="' . $d . '" course="' . $c . '" sem="' . $s . '" en="' . $en . '" sb="' . $cr['sub_name'] . '" code="'. $cr['tt_subcode'] .'" >' . $cr['sub_name'] . '</option>';
}
echo $output;
