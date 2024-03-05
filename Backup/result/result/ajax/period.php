<?php
include "../../includes/config.php";//contain DB connection and Session start
// session_start();

$log_id=$_SESSION['user_id'];
$con = mysqli_connect("localhost", "root", "", "graceerp");

$c = $_POST['c'];
$d = $_POST['d'];
$s = $_POST['s'];
$p = $_POST['p'];
$currentDayName = date('l');
// $cc = "SELECT DISTINCT tt.tt_period 
// FROM erp_timetable tt 
// LEFT JOIN erp_subject sub ON tt.tt_subcode = sub.tt_subcode 
// LEFT JOIN erp_class cls ON sub.cls_id = cls.cls_id 
// LEFT JOIN erp_faculty fac ON sub.f_id = fac.f_id 
// WHERE fac.f_id = '$log_id' AND cls.cls_course = '$c' AND cls.cls_dept='$d' AND cls.cls_sem='$s'";
$currentDayName="Monday";
$cc = "SELECT DISTINCT B.tt_period FROM `erp_subject` A left JOIN erp_timetable B on A.tt_subcode=B.tt_subcode WHERE A.f_id='$log_id' AND B.tt_day='$currentDayName';";


$cq = mysqli_query($conn, $cc);

$output = '<option value="">--Select--</option>';

while ($cr = mysqli_fetch_assoc($cq)) {
    $output .= '<option dept="' . $d . '" course="' . $c . '" sem="' . $s . '" pd="' . $cr['tt_period'] . '">' . $cr['tt_period'] . '</option>';
}
echo $output;
?>

