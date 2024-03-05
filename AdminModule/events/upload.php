<?php
include("conn.php");
if (!isset($_SESSION['user_id'])) {
    exit();
}
if (isset($_SESSION['user_id'])) {
    $log_id = $_SESSION['user_id'];
}
if (!(empty($_FILES['profileImage']['name'][0]) == '' ? 0 : 1)) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['calenderImages'])) {
        $file = $_FILES['calenderImages'];
        // print_r($file);
        if (isset($_POST['event_name'])) {
            $event_name = $_POST['event_name'];
        }
        if (isset($_POST['event_start_date'])) {
            $event_start_date = $_POST['event_start_date'];
        }
        if (isset($_POST['event_time'])) {
            $event_time = date("h:i A", strtotime($_POST['event_time']));
        }
        if (isset($_POST['event_duration'])) {
            $event_duration = $_POST['event_duration'];
        }
        if (isset($_POST['event_end_date'])) {
            $event_end_date = $_POST['event_end_date'];
            if ($event_end_date == $event_start_date) {
                $news_desc = "The event '" . $event_name . "' is scheduled at " . $event_time . " on " . $event_start_date;
            } else {
                $news_desc = "The event '" . $event_name . "' is scheduled at " . $event_time . " starting from" . $event_start_date . " to " . $event_end_date . " for " . $event_duration . " days";
            }
        }
        $Res = "Failed!";
        //  echo $event_name.$event_date;

        // perform some validation and processing on the uploaded file

        // move the uploaded file to a permanent location
        for ($i = 0; $i < count($_FILES['calenderImages']['name']); $i++) {
            if ($_FILES["calenderImages"]["error"][$i] > 0) {
                echo "Error: " . $_FILES["calenderImages"]["error"][$i];
            } else {
                if ($_FILES['calenderImages']['error'][$i] === UPLOAD_ERR_OK) {

                    $mime_type = mime_content_type($_FILES['calenderImages']['tmp_name'][$i]);
                    if ($mime_type === 'image/png' || $mime_type === 'image/jpeg' || $mime_type === 'image/jpg') {
                        // perform processing on the uploaded file

                        // Include the database connection file
                        include('conn.php');
                        // generate a unique file name based on the current timestamp and the original file name
                        $new_file_name = time() . '_' . $_FILES["calenderImages"]["name"][$i];
                        // insert a row into the table
                        // $sql = "INSERT INTO erp_news (g_id, img_img, img_desc) VALUES ('" . $event_name . "', '" . "img/" . $new_file_name . "', '" . $event_date . "')";


                        // $news_desc = mysqli_real_escape_string($conn, $news_desc);

                        // Insert form data into erp_n_event table

                        // $sql = "INSERT INTO erp_news (news_title, news_type, news_desc, news_img) VALUES ('$event_name', 'calender' , '$news_desc', '" . "/img" . $new_file_name . "')";



                        // Escape variables
                        $event_name_escaped = mysqli_real_escape_string($conn, $event_name);
                        $news_desc_escaped = mysqli_real_escape_string($conn, $news_desc);
                        $new_file_name_escaped = mysqli_real_escape_string($conn, $new_file_name);

                        // Construct the SQL query
                        $sql = "INSERT INTO erp_news (news_title, news_type, news_desc, news_img) VALUES ('$event_name_escaped', 'events', '$news_desc_escaped', '/AdminModule/events/img/$new_file_name_escaped')";

                        $sql2 = "INSERT INTO erp_calender (cal_event,cal_pic, cal_postby, cal_sdate, cal_edate) VALUES('$event_name','/AdminModule/events/img/$new_file_name_escaped', '$log_id', '$event_start_date', '$event_end_date')";

                        // Execute the query
                        $result = mysqli_query($conn, $sql);
                        $result2 = mysqli_query($conn, $sql2);

                        // Check for errors
                        if ($result === false) {
                            die('Error in executing query: ' . mysqli_error($conn));
                        }
                        if ($result2 == false) {
                            die('Error in executing query haha: ' . mysqli_error($conn));
                        }

                        // Close the database connection
                        mysqli_close($conn);
                        //uploading file
                        move_uploaded_file($_FILES["calenderImages"]["tmp_name"][$i], "img/" . $new_file_name);
                        $Res = "OK";
                    } else {
                        // file has an invalid type
                        echo "Error: Invalid File Type.";
                    }
                } else {
                    // there was an error uploading the file
                    echo "Error: There was a error uploading the file.";
                }
            }
        }
        echo $Res;
    }
} else {
    if (isset($_POST['event_name'])) {
        $event_name = $_POST['event_name'];
    }
    if (isset($_POST['event_start_date'])) {
        $event_start_date = $_POST['event_start_date'];
    }
    if (isset($_POST['event_time'])) {
        $event_time = date("h:i A", strtotime($_POST['event_time']));
    }
    if (isset($_POST['event_duration'])) {
        $event_duration = $_POST['event_duration'];
    }
    if (isset($_POST['event_end_date'])) {
        $event_end_date = $_POST['event_end_date'];
        if ($event_end_date == $event_start_date) {
            $news_desc = "The event '" . $event_name . "' is scheduled at " . $event_time . " on " . $event_start_date;
        } else {
            $news_desc = "The event '" . $event_name . "' is scheduled at " . $event_time . " starting from" . $event_start_date . " to " . $event_end_date . " for " . $event_duration . " days";
        }
    }
    $Res = "Failed!";
    //  echo $event_name.$event_date;

    // perform some validation and processing on the uploaded file

    // move the uploaded file to a permanent location
    // Construct the SQL query
    $sql = "INSERT INTO erp_news (news_title, news_type, news_desc, news_img) VALUES ('$event_name_escaped', 'events', '$news_desc_escaped', '')";

    $sql2 = "INSERT INTO erp_calender (cal_event,cal_pic, cal_postby, cal_sdate, cal_edate) VALUES('$event_name','', '$log_id', '$event_start_date', '$event_end_date')";

    // Execute the query
    $result = mysqli_query($conn, $sql);
    $result2 = mysqli_query($conn, $sql2);

    // Check for errors
    if ($result === false) {
        die('Error in executing query: ' . mysqli_error($conn));
    }
    if ($result2 == false) {
        die('Error in executing query haha: ' . mysqli_error($conn));
    }

    // Close the database connection
    mysqli_close($conn);
    $Res = "OK";
    echo $Res;
}
