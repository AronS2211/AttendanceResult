<?php
include("conn.php");
if (!isset($_SESSION['user_id'])) {
    exit();
}
if (isset($_POST["Function"])) {

    if ($_POST["Function"] == "Insert") {
        // // execute SQL statement
        $Stop_Name = $_POST["Stop_Name"];
        $Pickup_Time = $_POST["Pickup_Time"];
        $Route_Name = $_POST["Route_Name"];
        $Route_No = $_POST["Route_No"];
        $Drop_Time = $_POST["Drop_Time"];

        $sql = "INSERT INTO `erp_transport` (`tr_routeno`, `tr_routename`, `tr_stop`, `tr_pickup`, `tr_drop`) VALUES ('$Route_No', '$Route_Name', '$Stop_Name', '$Pickup_Time', '$Drop_Time')";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // close database connection
        mysqli_close($conn);
    }

    if ($_POST["Function"] == "Update") {
        // // execute SQL statement
        $tId = $_POST["tId"];
        $Stop_Name = $_POST["Stop_Name"];
        $Pickup_Time = $_POST["Pickup_Time"];
        $Route_Name = $_POST["Route_Name"];
        $Route_No = $_POST["Route_No"];
        $Drop_Time = $_POST["Drop_Time"];


        $sql = "UPDATE `erp_transport` SET `tr_routeno` = '" . $Route_No . "', `tr_routename` = '" . $Route_Name . "', `tr_stop` = '" . $Stop_Name . "', `tr_pickup` = '" . $Pickup_Time . "', `tr_drop` = '" . $Drop_Time . "' WHERE `erp_transport`.`tr_id` =" . $tId . "";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // close database connection
        mysqli_close($conn);
    }

    if ($_POST["Function"] == "Delete") {
        // // execute SQL statement
        $tId = $_POST["tId"];


        $sql = "DELETE FROM `erp_transport` WHERE `erp_transport`.`tr_id` =" . $tId . "";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // close database connection
        mysqli_close($conn);
    }
}
