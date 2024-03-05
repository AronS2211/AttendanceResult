<?php

include('../../includes/config.php');  // <!-- connecting database -->

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Get the form data
  $tt_subcode = $_POST['tt_subcode'];
  $exam_date = $_POST['exam_date'];
  $test_name = $_POST['ce_exam'];
  $ce_type = $_POST['ce_type'];
  $cls_id = $_POST['cls_id'];
  $ce_sdate = $_POST['ce_sdate'];
  $ce_edate = $_POST['ce_edate'];


  // Insert the data into the database
  $success = true;
  $sql_fetch_test_id = "SELECT test_id FROM erp_test WHERE test_name = '$test_name'";
  $result = mysqli_query($conn, $sql_fetch_test_id);
  $row = mysqli_fetch_assoc($result);
  $test_id = $row['test_id'];


  // Insert the data into erp_createexam table
  $sql = "INSERT INTO erp_createexam (ce_exam,ce_type, cls_id,ce_sdate,ce_edate) VALUES ('$test_name','$ce_type','$cls_id','$ce_sdate','$ce_edate')";
  if (mysqli_query($conn, $sql)) {
    $ce_id = mysqli_insert_id($conn); // Get the auto-generated id
  }


  // Insert the data into erp_exam table
  for ($i = 0; $i < count($tt_subcode); $i++) {
    // Check if $exam_date[$i] is not empty and not equal to '00'
    if (!empty($exam_date[$i])) {
      // Prepare and execute the SQL query
      $sql = "INSERT INTO erp_exam (ce_id, test_id, tt_subcode, exam_date) VALUES ('$ce_id', '$test_id', '$tt_subcode[$i]', '$exam_date[$i]')";
      if (!mysqli_query($conn, $sql)) {
        $success = false; // Set $success to false if insertion fails
      }
    }
  }


  if ($success) {
    echo "<script>
          $(document).ready(function() {
              Swal.fire({
                  title: 'Exam created Successfully.',
                  icon: 'success',
                  confirmButtonText: 'OK'
              }).then((result) => {
                  if (result.isConfirmed) {
                      window.location.href = 'Createexam.php'; // Corrected line for redirection
                  }
              });
          });
      </script>";
  } else {
    echo "<script>
          Swal.fire({
              title: 'Error!',
              text: 'Error inserting data',
              icon: 'error',
              confirmButtonText: 'OK'
          });
      </script>";
  }
}
?>