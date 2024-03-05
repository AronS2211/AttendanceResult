<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Reader\IReadFilter;

include('../includes/config.php');

if (isset($_POST['save_excel_data'])) {
    $fileName = $_FILES['import_file']['name'];
    $file_ext = pathinfo($fileName, PATHINFO_EXTENSION);

    $allowed_ext = ['xls', 'csv', 'xlsx'];

    if (in_array($file_ext, $allowed_ext)) {
        $inputFileNamePath = $_FILES['import_file']['tmp_name'];
        $spreadsheet = IOFactory::load($inputFileNamePath);
        // $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $data = $spreadsheet->getActiveSheet()->toArray();

        $count = "0";
        $dataCount = 0;
        // $cls_id = $_POST['clsid'];
        $cls_id = 10001;
        echo $cls_id;
        foreach ($data as $row) {
            if ($count > 0) {

                $stu_id = $row['0'];
                $stu_regno = $row['1'];
                $stu_fname = $row['2'];
                $stu_lname = $row['3'];
                $stu_dob = $row['4'];
                $stu_gender = $row['5'];
                $stu_doj = $row['6'];
                $stu_mobile = $row['7'];
                $stu_email = $row['8'];
                $stu_coursetype = $row['9'];
                $stu_quota = $row['10'];
                $stu_lateral = $row['11'];

                $studentQuery = "INSERT INTO erp_student (stu_id,stu_regno,stu_fname,stu_lname,stu_dob,stu_gender,cls_id,stu_doj,stu_mobile,stu_email,stu_coursetype,stu_quota,stu_lateral) 
                VALUES ('$stu_id','$stu_regno','$stu_fname','$stu_lname','$stu_dob','$stu_gender','$cls_id','$stu_doj','$stu_mobile','$stu_email','$stu_coursetype','$stu_quota','$stu_lateral')";
                $result = mysqli_query($con, $studentQuery);
                $msg = true;
                $dataCount += 1;
            } else {
                $count = "1";
            }
        }

        if (isset($msg)) {
            $_SESSION['message'] = "Successfully Imported ($dataCount rows inserted successfully)";
            $_SESSION['upload_sts'] = 1;
            header('Location: studentBulkUpload.php');
            exit(0);
        } else {
            $_SESSION['message'] = "Not Imported";
            $_SESSION['upload_sts'] = 0;
            header('Location: studentBulkUpload.php');
            exit(0);
        }
    } else {
        $_SESSION['message'] = "Invalid File";
        $_SESSION['upload_sts'] = 0;
        header('Location: studentBulkUpload.php');
        exit(0);
    }
}
?>