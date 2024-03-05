<?php
include('Includes/db_connection.php');
if (isset($_POST["Function"])) {

    if ($_POST["Function"] == "CreateEvent") {
        // execute SQL statement
        $EventTitle = $_POST["EventTitle"];
        $EventDate = $_POST["EventDate"];
        $sql = "INSERT INTO `erp_gallery` (`g_title`, `g_timestamp`) VALUES ('$EventTitle', '$EventDate')";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // close database connection
        mysqli_close($conn);


    }

    if ($_POST["Function"] == "ReadEvent") {
        // execute SQL statement
        $EventId = $_POST["EventId"];
        $sql = "SELECT * FROM `erp_gallery` where g_id='$EventId';";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Get the row data
            $row = mysqli_fetch_assoc($result);
            $row["Response"]="OK";
            $json = json_encode($row);
            echo $json;
            // close database connection
            mysqli_close($conn);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }






    }

    if ($_POST["Function"] == "UpdateEvent") {
        // execute SQL statement
        $EventTitle = $_POST["EventTitle"];
        $EventDate = $_POST["EventDate"];
        $EventId = $_POST["EventId"];
        $sql = "UPDATE `erp_gallery` SET `g_title` = '$EventTitle', `g_timestamp` = '$EventDate' WHERE `erp_gallery`.`g_id` = $EventId;";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // close database connection
        mysqli_close($conn);


    }

    if ($_POST["Function"] == "DeleteEvent") {
        // execute SQL statement
        $EventId = $_POST["EventId"];
        $sql = "DELETE FROM erp_gallery WHERE `erp_gallery`.`g_id` = $EventId";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        // close database connection
        mysqli_close($conn);
    }



    if ($_POST["Function"] == "ReadImage") {
        // execute SQL statement
        $EventId = $_POST["EventId"];
        $sql = "SELECT * FROM `erp_img` where img_id='$EventId';";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            // Get the row data
            $row = mysqli_fetch_assoc($result);
            $row["Response"]="OK";
            $json = json_encode($row);
            echo $json;
            // close database connection
            mysqli_close($conn);
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }






    }

    if ($_POST["Function"] == "UpdateImage") {
        // execute SQL statement
        $Event = $_POST["Event"];
        $EditImgDesc = $_POST["EditImgDesc"];
        $EventId = $_POST["EventId"];
        $sql = "UPDATE `erp_img` SET `g_id` = '$Event', `img_desc` = '$EditImgDesc' WHERE `erp_img`.`img_id` = $EventId;";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // close database connection
        mysqli_close($conn);


    }

    if ($_POST["Function"] == "DeleteImage") {
        // execute SQL statement
        $EventId = $_POST["EventId"];
        $sql = "DELETE FROM erp_img WHERE `erp_img`.`img_id` = $EventId";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        // close database connection
        mysqli_close($conn);
    }







} else {
    echo "Function Parameter Not set";
}