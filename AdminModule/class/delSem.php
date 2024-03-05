<?php

session_start();

if (isset($_SESSION['user_id'])) {


    include('../../includes/config.php');
?>
    <?php

    // Assuming the database connection is already established and stored in $conn variable

    // Check if 'id' parameter is set in the request
    if (isset($_REQUEST['id'])) {
        // Sanitize the input to prevent SQL injection
        $del_id = mysqli_real_escape_string($conn, $_REQUEST['id']);

        // Construct the DELETE query
        $query = "DELETE FROM erp_sem WHERE sem_id = '$del_id'";

        // Execute the DELETE query
        $result = mysqli_query($conn, $query);

        // Check if deletion was successful
        if ($result) {
            // Redirect to the previous page
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit;
        } else {
            // Handle deletion failure
            echo "Deletion failed: " . mysqli_error($conn);
        }
    } else {
        // Handle case where 'id' parameter is not set
        echo "ID parameter is not set.";
    }
    ?>

    <?php
    // Close database connection
    $conn->close();
    ?>
<?php
} else {
    header("Location: ../../index.php");
}
?>