<?php



include('../../includes/config.php');

// If the submit update button was clicked, insert the new timetable entry into the database


$tt_day = $_POST['tt_day'];
$data = $_POST['data'];

$tt_id = $_POST['tt_id'];
$tt_subcode = $_POST['tt_subcode'];

// Prepare and execute the update statement
$update_sql = "UPDATE erp_timetable SET tt_subcode = ? WHERE tt_id = ?";
$stmt = $conn->prepare($update_sql);
$stmt->bind_param("si", $tt_subcode, $tt_id);

if ($stmt->execute()) {

    echo "
        <!DOCTYPE html>
<html>

<head>
    <title>Schedule</title>
    <link rel='stylesheet' type='text/css' href='../assets/css/styles_TT.css'>
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
</head>
        <body>

        <form class='TT-form' method='post' style='display:none'  action='schedule.php'>
        <h2>Update period successful</h2>
        <div class='TT-form-content'>
        <input type='hidden' name='day' value='$tt_day'>
        <input type='hidden' name='data' value='$data'>
        <input type='submit' id='updateform' name='select' value='done'>
        </div>
        </form>
        <script>
        // Display SweetAlert2 alert
        Swal.fire({
            text: 'Update successful',
            icon: 'success',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // Trigger form submission
                document.getElementById('updateform').click();
            }
        });
    </script>
        </body></html>";
} else {
    echo "<!-- sweet alert JS -->
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>Swal.fire('Error adding timetable entry: " . $stmt->error . "')</script>";
}

$stmt->close();
