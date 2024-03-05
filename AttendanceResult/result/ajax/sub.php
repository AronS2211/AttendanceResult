<?php
include "../../includes/config.php";
// session_start();

$log_id=$_SESSION['user_id'];
// $conn = mysqli_connect("localhost", "root", "", "graceerp");
$c =  $_POST['c'];
$d =  $_POST['d'];
$s =  $_POST['s'];
$pd = $_POST['pd'];
//$pd = $_POST['pd'];
// $sql = "SELECT sub.tt_subcode, sub.sub_name 
// FROM erp_subject sub 
// LEFT JOIN erp_class cls ON sub.cls_id = cls.cls_id 
// LEFT JOIN erp_timetable tt ON tt.tt_subcode = sub.tt_subcode 
// LEFT JOIN erp_faculty fac ON sub.f_id = fac.f_id 
// WHERE fac.f_id = '$log_id' AND cls.cls_dept='$d' AND cls.cls_sem ='$s' AND cls.cls_course='$c' AND tt.tt_period='$sub'";
// $result = mysqli_query($conn, $sql);
// $cls_id = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['cls_id'] ;
$cls_id = $_SESSION['FacultyDetails']['cls_id'];
$F_id = $_SESSION['FacultyDetails']['f_id'];
$currentDayName = date('l');
$currentDayName="Monday";
// $sql = "SELECT * FROM `erp_subject` where cls_id=$cls_id and $F_id;";
// $sql = "SELECT * FROM `erp_timetable` where tt_period=$pd and tt_day='$currentDayName' and cls_id=$cls_id;";
$sql = "SELECT  DISTINCT A.tt_subcode,B.sub_name FROM `erp_timetable` A LEFT JOIN erp_subject B on A.tt_subcode=B.tt_subcode where A.tt_period=$pd and A.tt_day='$currentDayName' and A.cls_id=$cls_id;";
$result = mysqli_query($conn, $sql);
$SubjectRows = mysqli_fetch_all($result, MYSQLI_ASSOC) ;

$output = '<option value="">--Select--</option>';
// while ($cr = mysqli_fetch_assoc($cq)) {
//     $output .= '<option dept="' . $d . '" course="' . $c . '" sem="' . $s . '" en="' . $en . '" sb="' . $sb . '" rn="' . $cr['stu_id'] . '">' . $cr['stu_id'] . '</option>';
// }
foreach($SubjectRows as $Item){
    $output .= "<option value='".$Item['tt_subcode']."'>".$Item['sub_name']."</option>";
}
echo $output;

