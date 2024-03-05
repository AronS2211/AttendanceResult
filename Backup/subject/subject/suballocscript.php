<?php
include('../../includes/config.php');
// connecting to the database
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subject</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php
    if (isset($_POST['add'])) {
        //initialize
        $success = "";
        // getting data
        $f_id = $_POST['f_id'];
        $sub_id = $_POST['sub_id'];
        $cour = $_POST['course'];
        $dept = $_POST['department'];
        $sem = $_POST['semester'];

        $add_sql =  "UPDATE erp_subject SET f_id = '$f_id' WHERE sub_id = '$sub_id'";
        $add_result = $conn->query($add_sql);

        if ($add_result) {
            $success = true;
        } else {
            $success = false;
        }

        if ($success) {
            echo "<script>
                // Display SweetAlert2 alert
                Swal.fire({
                    text: 'Faculty Allocation successful',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Redirect to Create_subjects.php
                        document.getElementById('myform').submit();
                    }
                });
            </script>";
    ?>

            <div class="TT-container" style="display: none;">
                <form action="subject.php" method="post" id="myform">
                    <div class="TT-form-content">
                        <input type="hidden" name="course" value='<?php echo $cour; ?>'>
                        <input type="hidden" name="department" value='<?php echo $dept; ?>'>
                        <input type="hidden" name="semester" value='<?php echo $sem; ?>'>
                        <input type="hidden" value="OK" id="search" name="search">
                    </div>
                </form>
            </div>

    <?php
        } else {
            echo "<script>Swal.fire('Error adding timetable entry: " . mysqli_error($conn) . "')</script>";
        }
    }
    // Close database connection
    $conn->close();
    ?>

</body>

</html>