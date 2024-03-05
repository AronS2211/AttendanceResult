<?php
include "../../includes/config.php"; // contain DB connectivity and Session start
// session_start();

$log_id=$_SESSION['user_id'];
$Period = $_POST['Period'];
$currentDayName = date('D');
$sql = "SELECT  DISTINCT A.tt_subcode,B.sub_name FROM `erp_timetable` A LEFT JOIN erp_subject B on A.tt_subcode=B.tt_subcode where A.tt_period=$Period and A.tt_day='$currentDayName' and B.f_id='$log_id'";
if($_SESSION['user_id']["f_role"]==1) $sql="";
$result = mysqli_query($conn, $sql);
$SubjectRows = mysqli_fetch_all($result, MYSQLI_ASSOC) ;

$output = '<option value="">--Select--</option>';
foreach($SubjectRows as $Item){
    $output .= "<option value='".$Item['tt_subcode']."'>".$Item['sub_name']."</option>";
}
echo $output;

