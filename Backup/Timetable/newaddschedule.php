<?php

session_start();

if (isset($_SESSION['user_id'])) {

    include('../../includes/config.php');
    //conecting database

    if (isset($_POST['submit_add'])) {
        //initialize
        $success = "";
        // getting data

        $cls_id = $_POST['cls_id'];
        $sc_id = $_POST['sc_id'];
        $tt_day = $_POST['tt_day'];
        $tt_subcode = $_POST['tt_subcode'];

        // Get the JSON data from the POST request
        $json_data = $_POST['data'];

        // Decode the JSON data into an array
        $data = json_decode($json_data, true);

        // Loop through the form data to insert each timetable period
        for ($i = 0; $i < count($tt_subcode); $i++) {
            $tt_period = $i + 1;
            $subcode = mysqli_real_escape_string($conn, $tt_subcode[$i]);
            // Insert the timetable period into the table

            $add_sql = "INSERT INTO erp_timetable (cls_id,sc_id,tt_day,tt_period,tt_subcode) VALUES ('$cls_id','$sc_id','$tt_day','$tt_period','$subcode')";
            $add_result = $conn->query($add_sql);

            if ($add_result) {
                $success = "true";
            } else {
                $success = "false";
            }
        }
        //$add_sql = "INSERT INTO erp_timetable (cls_id,sc_id,tt_day,tt_period,tt_subcode) VALUES ('$cls_id','$sc_id','$tt_day','$tt_period','$tt_subcode')";
        //$add_result = $conn->query($add_sql);
        if ($success) {
            //echo "<script>alert('Timetable entry added successfully.')</script>";
            echo "
        <body>
       
        <form id='myform' method='post' action='schedule.php'>
        
        <input type='hidden' name='day' value='$tt_day'>
        <input type='hidden' name='data' value='$json_data'>
        <input type='hidden' name='select' value='done'>
      
        </form>
        </body> 
        <script>
                        document.getElementById('myform').submit();
                    </script>";
        } else {
            echo "<!-- sweet alert JS -->
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>Swal.fire('Error adding timetable entry: " . mysqli_error($conn) . "')</script>";
        }
    }


    // Close database connection
    $conn->close();

?>
<?php
} else {
    header("Location: ../../index.php");
}
?>