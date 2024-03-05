<?php
include('../../includes/config.php');
$c = $_POST['c'];
$d = $_POST['d'];
$cc = "select distinct cls_sem from erp_class where cls_course='$c' AND cls_dept='$d' AND cls_startyr<=" . date('Y') . "<=cls_endyr";
$cq = mysqli_query($con, $cc);
$output = '<option value="">--Select--</option>';
while ($cr = mysqli_fetch_assoc($cq)) {
    $output .= '<option dept="' . $d . '" course="' . $c . '" sem="' . $cr['cls_sem'] . '">' . $cr['cls_sem'] . '</option>';
}
echo $output;