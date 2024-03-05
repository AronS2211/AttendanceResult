<?php
include "../../includes/config.php"; // contain DB connectivity and Session start
// session_start();

$log_id=$_SESSION['user_id'];//variable from DB connect file
$id =  $_POST['c'];
$cc = "SELECT DISTINCT cls_dept  FROM erp_class cls
LEFT JOIN erp_subject sub ON cls.cls_id = sub.cls_id 
LEFT JOIN erp_timetable tt ON tt.tt_subcode = sub.tt_subcode 
LEFT JOIN erp_faculty fac ON sub.f_id = fac.f_id 
WHERE fac.f_id = '$log_id' AND cls.cls_course = '$id'";
$cq = mysqli_query($conn, $cc); //variable conn came from Dbconnect.php file
$output = '<option value="">--Select--</option>';
while ($cr = mysqli_fetch_assoc($cq)) {
    $output .= '<option dept="' . $cr['cls_dept'] . '" course="' . $id . '">' . $cr['cls_dept'] . '</option>';
}
echo $output;
