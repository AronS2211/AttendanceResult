
<?php
include('../../includes/config.php');

// Get the selected course from the query string
$selectedCourse = $_GET['course'];

// Query the database to fetch the department options
$sql = "SELECT DISTINCT cls_deptname FROM erp_class WHERE cls_course='$selectedCourse'";
$result = mysqli_query($conn, $sql);

// Generate an array of department options
$deptOptions = array();
while ($row = mysqli_fetch_array($result)) {
      array_push($deptOptions, $row['cls_deptname']);
}

// Return the array as JSON
echo json_encode($deptOptions);

// Close the database connection