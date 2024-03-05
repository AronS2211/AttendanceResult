<?php
    include('../../includes/config.php');
$id =  $_POST['c'];
$cc = "select distinct cls_dept from erp_class where cls_course='$id'";
$cq = mysqli_query($con, $cc);
$output = '<option value="">--Select--</option>';
while ($cr = mysqli_fetch_assoc($cq)) {
    $output .= '<option dept="' . $cr['cls_dept'] . '" course="' . $id . '">' . $cr['cls_dept'] . '</option>';
}
echo $output;
