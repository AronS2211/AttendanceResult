<?php include('../../includes/config.php'); ?>
<?php
$log_id = $_SESSION['user_id']; // Store user ID in session (temp ) and use in all files
//for Fetching faculty details into session on login
$sql1 = "SELECT * FROM `erp_faculty` where f_id='$log_id'";
$result1 = mysqli_query($conn, $sql1);
if (!$result1) {
    die('Query failed: ' . mysqli_error($conn));
}
$row = mysqli_fetch_assoc($result1);
$ClassId = $row['cls_id'];
$i = 0;
if ($_POST['attendanceRecords']) {
    if (count($_POST['attendanceRecords']) > 0) {
        foreach ($_POST['attendanceRecords'] as $Item) {
            $sql = "INSERT INTO `erp_attendance` (`att_id`, `stu_id`, `att_date`, `att_hour`, `att_sub`, `att_status`, `att_sreason`, `cls_id`) VALUES (NULL,'" . $Item['regno'] . "', '" . $_POST['Date'] . "', '" . $_POST['Period'] . "', '" . $_POST['Subject'] . "', '" . $Item['status'] . "', '" . $Item['dropdown'] . "', '" . $ClassId . "')";
            // Run the query
            //echo $sql;
            if ($conn->query($sql) === TRUE)
                $i++;
        }
    }
}
if (count($_POST['attendanceRecords']) == $i)
    header("Location: " . "FormPage.php?result=success&status=$i succeded Out of " . count($_POST['attendanceRecords']));
else
    header("Location: " . "FormPage.php?result=error&status=$i succeded Out of " . count($_POST['attendanceRecords']));
?>