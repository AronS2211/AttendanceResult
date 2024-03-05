<?php

include('../../includes/config.php');  // <!-- connecting database -->

?>
<html>

<head>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>


<?php
$success = true; // Initialize the success variable

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Get the form data
    $test_name = $_POST['test_name'];
    $exam_date = $_POST['ce_sdate'];
    $ce_type = 'others';
    $tt_subcode = $_POST['test_name'];
    $ce_sdate = $_POST['ce_sdate'];
    $ce_edate = $_POST['ce_edate'];
    $cls_deptname = $_POST['cls_deptname'];
    $cls_sem = $_POST['cls_sem'];
    $cls_course = $_POST['cls_course'];


    // Retrieve cls_id from erp_class
    $sql_cls = "SELECT cls_id FROM erp_class WHERE cls_deptname = '$cls_deptname' AND cls_course = '$cls_course' AND cls_sem = '$cls_sem'";
    $result_cls = mysqli_query($conn, $sql_cls);

    if ($result_cls && mysqli_num_rows($result_cls) > 0) {
        $row_cls = mysqli_fetch_assoc($result_cls);
        $cls_id = $row_cls['cls_id'];
    } else {
        echo "No matching class found.";
        $success = false; // Set success to false
    }

    // Retrieve test_id from erp_test
    $sql_fetch_test_id = "SELECT test_id FROM erp_test WHERE test_name = '$test_name'";
    $result = mysqli_query($conn, $sql_fetch_test_id);
    $row = mysqli_fetch_assoc($result);
    $test_id = $row['test_id'];

    // Insert the data into erp_createexam table
    $sql = "INSERT INTO erp_createexam (ce_exam, ce_type, cls_id, ce_sdate, ce_edate) VALUES ('$test_name', '$ce_type', '$cls_id', '$ce_sdate', '$ce_edate')";
    if (mysqli_query($conn, $sql)) {
        $ce_id = mysqli_insert_id($conn); // Get the auto-generated id

        // Insert the data into erp_exam table
        $sql = "INSERT INTO erp_exam (ce_id, test_id, tt_subcode, exam_date) VALUES ('$ce_id', '$test_id', '$test_name', '$exam_date')";
        // Execute the query
        if (!mysqli_query($conn, $sql)) {
            $success = false; // Set success to false
        }
    } else {
        $success = false; // Set success to false
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
                            window.location.href = 'Create_other_exam.php'; // Corrected line for redirection
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

</html>