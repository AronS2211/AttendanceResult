<?php


include('../../includes/config.php');

// Get the selected course and department
$course = $_GET['course'];
$dept = $_GET['dept'];

// Query the database to fetch the semester options
$sql = "SELECT DISTINCT cls_sem FROM erp_class WHERE cls_course='$course' AND cls_deptname='$dept' ORDER BY cls_sem ASC";
$result = mysqli_query($conn, $sql);

// Generate the options for the semester dropdown
$sems = array();
while ($row = mysqli_fetch_array($result)) {
  $sems[] = $row['cls_sem'];
}
echo json_encode($sems);

