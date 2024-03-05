<?php
include "../../includes/config.php"; //contain Db connectivity and Session Start
// session_start();

$log_id=$_SESSION['user_id'];
$c =  $_POST['c'];
$d =  $_POST['d'];
$ClassId=$_SESSION['FacultyDetails']['cls_id'];
$cc = "SELECT cls_sem FROM `erp_class` where cls_id=$ClassId;";
// $cc = "SELECT DISTINCT cls_dept, cls_sem 
// FROM erp_class cls
// LEFT JOIN erp_subject sub ON cls.cls_id = sub.cls_id 
// LEFT JOIN erp_timetable tt ON tt.tt_subcode = sub.tt_subcode 
// LEFT JOIN erp_faculty fac ON sub.f_id = fac.f_id 
// WHERE fac.f_id = '$log_id' AND cls.cls_course = '$c' AND cls_dept='$d'";
$cq = mysqli_query($conn, $cc); // variable conn come form Dbconnect.php 
$output = '<option value="">--Select--</option>';
while ($cr = mysqli_fetch_assoc($cq)) {
    $output .= '<option dept="' . $d . '" course="' . $c . '" sem="' . $cr['cls_sem'] . '">' . $cr['cls_sem'] . '</option>';
}
echo $output;

