<?php
include "../../includes/config.php"; // contain DB connectivity and Session start
// session_start();

$log_id = $_SESSION['user_id'];
function useDate()
{
    if (!isset($_POST['date'])) {
        $currentDayName = date('D');
        return $currentDayName;
    }
    $date = $_POST['date'];
    $currentDayName = date('D', strtotime($date));
    return $currentDayName;
}
$currentDayName = useDate();

$sql = "SELECT DISTINCT B.tt_period
FROM erp_subject AS A
LEFT JOIN erp_timetable AS B ON A.tt_subcode = B.tt_subcode
WHERE A.f_id = '$log_id' AND B.tt_day = '$currentDayName'";
$Result = mysqli_query($conn, $sql);

$output = '<option value="">--Select--</option>';
while ($cr = mysqli_fetch_assoc($Result)) {
    $output .= '<option >' . $cr['tt_period'] . '</option>';
}
echo $output;
