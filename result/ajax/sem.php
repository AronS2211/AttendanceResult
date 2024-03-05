<?php
include "../../includes/config.php"; //contain DB connection and Session start
// session_start();

$log_id=$_SESSION['user_id'];
//$con = mysqli_connect("localhost", "root", "", "graceerp");
$c =  $_POST['c'];
$d =  $_POST['d'];
$s =  $_POST['s'];
print_r($s);
$cc = "SELECT DISTINCT ce_exam, ce.ce_id 
FROM erp_mark mark
LEFT JOIN erp_exam exam ON exam.exam_id = mark.exam_id
LEFT JOIN erp_class cls ON mark.cls_id = cls.cls_id
LEFT JOIN erp_createexam ce ON mark.ce_id = ce.ce_id
LEFT JOIN erp_subject sub ON exam.tt_subcode = sub.tt_subcode 
LEFT JOIN erp_timetable tt ON tt.tt_subcode = sub.tt_subcode 
LEFT JOIN erp_faculty fac ON sub.f_id = fac.f_id 
WHERE fac.f_id = '$log_id' AND cls.cls_course = '$c' AND cls.cls_dept = '$d' AND cls.cls_sem = '$s'";
$cq = mysqli_query($conn, $cc);
$output = '<option value="">--Select--</option>';
while ($cr = mysqli_fetch_assoc($cq)) {
    $output .= '<option dept="' . $d . '" course="' . $c . '" sem="' . $s . '" en="' . $cr['ce_exam'] . '" ceid="' . $cr['ce_id'] . '">' . $cr['ce_exam'] . '</option>';
}
echo $output;

