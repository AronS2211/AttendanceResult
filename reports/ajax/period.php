<?php
    include('../../includes/config.php');
$c = $_POST['c'];
$d = $_POST['d'];
$s = $_POST['s'];

$cc = "SELECT DISTINCT erp_timetable.tt_period
FROM `erp_timetable`
LEFT JOIN `erp_schedule` ON erp_timetable.sc_id = erp_timetable.sc_id
LEFT JOIN erp_class ON erp_timetable.cls_id = erp_class.cls_id
LEFT JOIN erp_student ON erp_class.cls_id = erp_student.cls_id
WHERE cls_course='$c' AND cls_dept='$d' AND cls_sem='$s'";

$cq = mysqli_query($con, $cc);

$output = '<option value="">--Select--</option>';

while ($cr = mysqli_fetch_assoc($cq)) {
    $output .= '<option dept="' . $d . '" course="' . $c . '" sem="' . $s . '" pd="' . $cr['tt_period'] . '">' . $cr['tt_period'] . '</option>';
}
echo $output;
?>
