<?php
// session_start();
// Include the database connection file
include('../../../includes/config.php');
if (isset($_SESSION['user_id'])) {
    $log_id = $_SESSION['user_id'];
}

if (isset($_POST["operation"])) {

    if (($_SERVER["REQUEST_METHOD"] == "POST") && $_POST["operation"] == 'insert') {
        if (isset($_POST['sId'])) {
            $sId = $_POST['sId'];
            $admno = $_POST['admno'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $dob = $_POST['dob'];
            $gender = $_POST['gender'];
            $clsid = $_POST['clsid'];
            $doj = $_POST['doj'];
            $mobileNum = $_POST['mobileNum'];
            $email = $_POST['email'];
            $counsellingNumber = $_POST['counsellingNumber'];
            $coursetype = $_POST['coursetype'];
            $quota = $_POST['quota'];
            $stu_lateral = $_POST['lateral'];
            $operation = $_POST['operation'];
        }
        $Res = "Not OK";

        if (!(empty($_FILES['studentProfileImage']['name'][0]) == '' ? 0 : 1)) {
            // Code for retrieving the uploaded file and move it to physical location
            for ($i = 0; $i < count($_FILES['studentProfileImage']['name']); $i++) {
                if ($_FILES["studentProfileImage"]["error"][$i] > 0) {
                    echo "Error: " . $_FILES["studentProfileImage"]["error"][$i];
                } else {
                    if ($_FILES['studentProfileImage']['error'][$i] === UPLOAD_ERR_OK) {

                        $mime_type = mime_content_type($_FILES['studentProfileImage']['tmp_name'][$i]);
                        if ($mime_type === 'image/png' || $mime_type === 'image/jpeg' || $mime_type === 'image/jpg') {
                            // perform processing on the uploaded file


                            // generate a unique file name based on the current timestamp and the original file name

                            $original_file_name = $_FILES["studentProfileImage"]["name"][$i];

                            // Use pathinfo to get the file extension
                            $file_info = pathinfo($original_file_name);
                            $file_extension = $file_info['extension'];

                            $new_file_name = $sId . '.' . $file_extension;
                            // insert a row into the table
                            // $sql = "INSERT INTO erp_news (g_id, img_img, img_desc) VALUES ('" . $event_name . "', '" . "img/" . $new_file_name . "', '" . $event_date . "')";


                            // $news_desc = mysqli_real_escape_string($conn, $news_desc);

                            // Insert form data into erp_n_event table

                            // $sql = "INSERT INTO erp_news (news_title, news_type, news_desc, news_img) VALUES ('$event_name', 'calender' , '$news_desc', '" . "/img" . $new_file_name . "')";



                            // Escape variables
                            $new_file_name_escaped = mysqli_real_escape_string($conn, $new_file_name);
                            // // Construct the SQL query
                            // $sql = "UPDATE `erp_student` SET `f_img` = '$new_file_name_escaped' WHERE `sId` = '$sId'";
                            // Execute the query
                            $sql = "INSERT INTO `erp_student` (
                        `stu_id`, `stu_admno`, `cls_id`, `stu_dob`, `stu_fname`, `stu_lname`, `stu_img`, `stu_gender`, 
                        `stu_mobile`, `stu_email`, `stu_doj`, `stu_quota`, `stu_coursetype`, `stu_counsellingno`,`stu_lateral`, `stu_status`
                    ) VALUES (
                        '$sId', '$admno', '$clsid', '$dob', '$fname', '$lname', '$new_file_name', '$gender', 
                        '$mobileNum', '$email', '$doj', '$quota', '$coursetype', '$counsellingNumber','$stu_lateral', 'Active'
                    )";

                            $result = mysqli_query($conn, $sql);



                            // Check for errors
                            if ($result === false) {
                                die('Error in executing query: ' . mysqli_error($conn));
                            }

                            // Close the database connection
                            //uploading file
                            move_uploaded_file($_FILES["studentProfileImage"]["tmp_name"][$i], "../../../assets/img/profile/" . $new_file_name);
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
            mysqli_close($conn);
            echo $Res;
        } else {
            $sql = "INSERT INTO `erp_student` (
                `stu_id`, `stu_admno`, `cls_id`, `stu_dob`, `stu_fname`, `stu_lname`,`stu_gender`, 
                `stu_mobile`, `stu_email`, `stu_doj`, `stu_quota`, `stu_coursetype`, `stu_counsellingno`, `stu_status`
            ) VALUES (
                '$sId', '$admno', '$clsid', '$dob', '$fname', '$lname', '$gender', 
                '$mobileNum', '$email', '$doj', '$quota', '$coursetype', '$counsellingNumber', 'Active'
            )";

            $result = mysqli_query($conn, $sql);



            // Check for errors
            if ($result === false) {
                die('Error in executing query: ' . mysqli_error($conn));
            }
            $Res = "OK";
            mysqli_close($conn);
            echo $Res;
        }
    }
}

if (isset($_POST['operation'])) {

    if (($_SERVER["REQUEST_METHOD"] == "POST") && $_POST["operation"] == 'update') {

        $sId = $_POST['sId'];
        $admno = $_POST['admno'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $clsid = $_POST['clsid'];
        $doj = $_POST['doj'];
        $mobileNum = $_POST['mobileNum'];
        $email = $_POST['email'];
        $counsellingNumber = $_POST['counsellingNumber'];
        $coursetype = $_POST['coursetype'];
        $quota = $_POST['quota'];
        $operation = $_POST['operation'];
        $Res = "Not OK";

        // If student profile pic is not being updated but only fields
        if (!(empty($_FILES['studentProfileImage']['name'][0]) == '' ? 0 : 1)) {

            // Code for retrieving the uploaded file and move it to physical location
            for ($i = 0; $i < count($_FILES['studentProfileImage']['name']); $i++) {
                if ($_FILES["studentProfileImage"]["error"][$i] > 0) {
                    echo "Error: " . $_FILES["studentProfileImage"]["error"][$i];
                } else {
                    if ($_FILES['studentProfileImage']['error'][$i] === UPLOAD_ERR_OK) {

                        $mime_type = mime_content_type($_FILES['studentProfileImage']['tmp_name'][$i]);
                        if ($mime_type === 'image/png' || $mime_type === 'image/jpeg' || $mime_type === 'image/jpg') {
                            // perform processing on the uploaded file


                            // generate a unique file name based on the current timestamp and the original file name

                            $original_file_name = $_FILES["studentProfileImage"]["name"][$i];

                            // Use pathinfo to get the file extension
                            $file_info = pathinfo($original_file_name);
                            $file_extension = $file_info['extension'];

                            $new_file_name = $sId . '.' . $file_extension;
                            // insert a row into the table
                            // $sql = "INSERT INTO erp_news (g_id, img_img, img_desc) VALUES ('" . $event_name . "', '" . "img/" . $new_file_name . "', '" . $event_date . "')";


                            // $news_desc = mysqli_real_escape_string($conn, $news_desc);

                            // Insert form data into erp_n_event table

                            // $sql = "INSERT INTO erp_news (news_title, news_type, news_desc, news_img) VALUES ('$event_name', 'calender' , '$news_desc', '" . "/img" . $new_file_name . "')";



                            // Escape variables
                            $new_file_name_escaped = mysqli_real_escape_string($conn, $new_file_name);
                            // // Construct the SQL query
                            $sql = "UPDATE erp_student
                    SET stu_admno = '$admno',
                        stu_fname = '$fname',
                        stu_lname = '$lname',
                        stu_dob = '$dob',
                        stu_gender = '$gender',
                        cls_id = '$clsid',
                        stu_doj = '$doj',
                        stu_mobile = '$mobileNum',
                        stu_email = '$email',
                        stu_counsellingno = '$counsellingNumber',
                        stu_coursetype = '$coursetype',
                        stu_quota = '$quota',
                        stu_img = '$new_file_name_escaped' 
                    WHERE stu_id = '$sId'";
                            // Execute the query
                            // $sql = "INSERT INTO `erp_student` (
                            //     `stu_id`, `stu_admno`, `cls_id`, `stu_dob`, `stu_fname`, `stu_lname`, `stu_img`, `stu_gender`, 
                            //     `stu_mobile`, `stu_email`, `stu_doj`, `stu_quota`, `stu_coursetype`
                            // ) VALUES (
                            //     '$sId', '$admno', '$clsid', '$dob', '$fname', '$lname', '$new_file_name', '$gender', 
                            //     '$mobileNum', '$email', '$doj', '$quota', '$coursetype'
                            // )";

                            $result = mysqli_query($conn, $sql);



                            // Check for errors
                            if ($result === false) {
                                die('Error in executing query: ' . mysqli_error($conn));
                            }

                            // Close the database connection
                            //uploading file
                            move_uploaded_file($_FILES["studentProfileImage"]["tmp_name"][$i], "../../../assets/img/profile/" . $new_file_name);
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
            mysqli_close($conn);
            echo $Res;
        } else {

            // // Construct the SQL query
            $sql = "UPDATE erp_student
    SET stu_admno = '$admno',
        stu_fname = '$fname',
        stu_lname = '$lname',
        stu_dob = '$dob',
        stu_gender = '$gender',
        cls_id = '$clsid',
        stu_doj = '$doj',
        stu_mobile = '$mobileNum',
        stu_email = '$email',
        stu_counsellingno = '$counsellingNumber',
        stu_coursetype = '$coursetype',
        stu_quota = '$quota' 
    WHERE stu_id = '$sId'";
            // Execute the query
            // $sql = "INSERT INTO `erp_student` (
            //     `stu_id`, `stu_admno`, `cls_id`, `stu_dob`, `stu_fname`, `stu_lname`, `stu_img`, `stu_gender`, 
            //     `stu_mobile`, `stu_email`, `stu_doj`, `stu_quota`, `stu_coursetype`
            // ) VALUES (
            //     '$sId', '$admno', '$clsid', '$dob', '$fname', '$lname', '$new_file_name', '$gender', 
            //     '$mobileNum', '$email', '$doj', '$quota', '$coursetype'
            // )";

            $result = mysqli_query($conn, $sql);



            // Check for errors
            if ($result === false) {
                die('Error in executing query: ' . mysqli_error($conn));
            }

            // Close the database connection
            mysqli_close($conn);
            echo "OK";
        }
    }
}


if (isset($_POST["Function"])) {

    if ($_POST["Function"] == "studentStatusUpdate") {
        // // execute SQL statement
        $studentId = $_POST["studentId"];
        $studentStatusUpdate = $_POST["statusChangeValue"];

        $sql = "UPDATE erp_student
        SET stu_status = '$studentStatusUpdate'
        WHERE stu_id = '$studentId';
        ";
        if (mysqli_query($conn, $sql)) {
            echo "OK";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // close database connection
        mysqli_close($conn);
    }
}
