<?php
session_start();
// Include the database connection file
include('../../includes/config.php');
if (isset($_SESSION['user_id'])) {
    $log_id = $_SESSION['user_id'];
}

$Res = "Not OK";
if (isset($_POST['operation'])) {


    if ($_POST['operation'] == 'create') {
        $clsid = $_POST['clsid'];
        $semester = $_POST['semester'];
        $startdate = $_POST['startdate'];

        $sql = "SELECT * FROM erp_sem WHERE cls_id= '$clsid' and sem_no= '$semester'"; // selecting value of the record Query
        $result = $conn->query($sql);  //fetching

        if ($result->num_rows == 0) {
            $semsql = "INSERT into `erp_sem` (`cls_id`,`sem_no`,`sem_start`) values ('$clsid','$semester','$startdate')";
            $semresult = $conn->query($semsql);

            $inc = 0;

            switch ($semester) {
                case 3:
                    $inc = 1;
                    break;
                case 4:
                    $inc = 1;
                    break;
                case 5:
                    $inc = 2;
                    break;
                case 6:
                    $inc = 2;
                    break;
                case 7:
                    $inc = 3;
                    break;
                case 8:
                    $inc = 3;
                    break;
            }

            $clssql = "UPDATE erp_class
        SET cls_sem = '$semester',cls_acdstyr = cls_startyr+$inc,cls_acdedyr=cls_startyr+$inc+1
        WHERE cls_id = '$clsid';
        ";
            $clsresult = $conn->query($clssql);


            if ($semresult == TRUE) {
                $Res = "OK";
            } else {
                $Res = "Error: " . $semsql . "<br>" . mysqli_error($conn);
            }
        } else {
            $Res = "Semester Already Exist";
        }
    }

    // updating the end date



    if ($_POST['operation'] == 'update') {
        $semid = $_POST['semid'];
        $date = $_POST['date'];

        $sql = "UPDATE erp_sem
    SET sem_end = '$date'
    WHERE sem_id = '$semid';
    ";
        if (mysqli_query($conn, $sql)) {
            $Res = "OK";
        } else {
            $Res = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

echo $Res;
// close database connection
mysqli_close($conn);
