
<?php

include('../../includes/config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  // Get the form data
  $cls_id = $_POST['cls_id'];
  $tt_subcode = $_POST['tt_subcode'];
  $sub_name = $_POST['sub_name'];
  $sub_credit = $_POST['sub_credit'];
  $sub_type = $_POST['sub_type'];

  // Loop through the subject data and insert into the database
  $success = true;
  for ($i = 0; $i < count($tt_subcode); $i++) {
    // Check if the data already exists
    $check_sql = "SELECT * FROM erp_subject WHERE cls_id = '$cls_id' AND tt_subcode = '$tt_subcode[$i]'";
    $check_result = mysqli_query($conn, $check_sql);

    // If a record already exists, you can choose to skip or update it
    if (mysqli_num_rows($check_result) > 0) {

      continue;
    }


    // Insert the data if it doesn't exist
    $sql = "INSERT INTO erp_subject (cls_id, tt_subcode, sub_name, sub_credit, sub_type) VALUES ('$cls_id', '$tt_subcode[$i]', '$sub_name[$i]', '$sub_credit[$i]', '$sub_type[$i]')";
    if (!mysqli_query($conn, $sql)) {
      $success = false;
      break;
    }
  }

  $subjects = [['LIB', 'Library'], ['SPORT', 'Sports'], ['ASC', 'Association'], ['PLACE', 'Placement'], ['AWM', 'Advisor ward meet']];
  foreach ($subjects as $subject) {
    // Check if the data already exists
    $check_sql = "SELECT * FROM erp_subject WHERE cls_id = '$cls_id' AND tt_subcode = '$subject[0]'";
    $check_result = mysqli_query($conn, $check_sql);

    // If a record already exists, you can choose to skip or update it
    if (mysqli_num_rows($check_result) > 0) {
      //skip insert
      continue;
    }

    // Insert the data if it doesn't exist
    $sql = "INSERT INTO erp_subject (cls_id, tt_subcode, sub_name,sub_type) VALUES ('$cls_id', '$subject[0]', '$subject[1]',  'Others')";
    if (!mysqli_query($conn, $sql)) {
      $success = false;
      break;
    }
  }


  if ($success) {
    echo "
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
          // Display SweetAlert2 alert
            Swal.fire({
                text: 'Update successful',
                icon: 'success',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to Create_subjects.php
                    window.location.href = 'Create_subject.php';
                }
            });
          });
        </script>
    ";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
