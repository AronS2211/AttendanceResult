<?php
include('../../includes/config.php');
$c = $_POST['c'];
$d = $_POST['d'];
$s = $_POST['s'];
$cc = "SELECT distinct cls_id FROM erp_class where cls_course='$c' AND cls_dept='$d' AND cls_sem='$s' AND cls_startyr<=" . date('Y') . "<=cls_endyr";
$cq = mysqli_query($con, $cc);
while ($cr = mysqli_fetch_assoc($cq)) {
    $output = $cr['cls_id'];
}
// $cr = mysqli_fetch_assoc($cq);
// $output = $cr;
echo $output;