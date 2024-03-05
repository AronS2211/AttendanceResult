<?php
// session_start();
// Include the database connection file
include('../../../includes/config.php');
if (isset($_SESSION['user_id'])) {
    $log_id = $_SESSION['user_id'];
}


if (isset($_POST['operation'])) {
    if (isset($_POST['operation']) && $_POST['operation'] == 'update') {
        // Retrieve values from the $_POST superglobal
        $fid = $_POST['fid'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $date_of_birth = $_POST['date_of_birth'];
        $gender = $_POST['gender'];
        $dept = $_POST['dept'];
        $designation = $_POST['designation'];
        $qualification = $_POST['qualification'];
        $experience = $_POST['experience'];
        $role = $_POST['role'];
        $cls_id = $_POST['cls_id'];
        $doj = $_POST['doj'];
        $mobile_number = $_POST['mobile_number'];
        $email = $_POST['email'];
        $Res = "Not OK";

        if (!(empty($_FILES['profileImage']['name'][0]) == '' ? 0 : 1)) {
            for ($i = 0; $i < count($_FILES['profileImage']['name']); $i++) {
                if ($_FILES["profileImage"]["error"][$i] > 0) {
                    echo "Error: " . $_FILES["profileImage"]["error"][$i];
                } else {
                    if ($_FILES['profileImage']['error'][$i] === UPLOAD_ERR_OK) {

                        $mime_type = mime_content_type($_FILES['profileImage']['tmp_name'][$i]);
                        if ($mime_type === 'image/png' || $mime_type === 'image/jpeg' || $mime_type === 'image/jpg') {
                            // perform processing on the uploaded file


                            // generate a unique file name based on the current timestamp and the original file name

                            $original_file_name = $_FILES["profileImage"]["name"][$i];

                            // Use pathinfo to get the file extension
                            $file_info = pathinfo($original_file_name);
                            $file_extension = $file_info['extension'];

                            $new_file_name = $fid . '.' . $file_extension;
                            // insert a row into the table



                            // Escape variables
                            $new_file_name_escaped = mysqli_real_escape_string($conn, $new_file_name);
                            // Construct the SQL query
                            // Your SQL update query
                            $sql = "UPDATE erp_faculty 
        SET f_fname = '$first_name',
            f_lname = '$last_name',
            f_dob = '$date_of_birth',
            f_gender = '$gender',
            f_dept = '$dept',
            f_designation = '$designation',
            f_qualification = '$qualification',
            f_exp = '$experience',
            f_role = '$role',
            f_doj = '$doj',
            f_mobile = '$mobile_number',
            f_email = '$email',
            cls_id = '$cls_id', f_img = '$new_file_name_escaped' 
        WHERE f_id = '$fid'";
                            // Execute the query
                            $result = mysqli_query($conn, $sql);

                            // Check for errors
                            if ($result === false) {
                                die('Error in executing query: ' . mysqli_error($conn));
                            }

                            // Close the database connection
                            //uploading file
                            move_uploaded_file($_FILES["profileImage"]["tmp_name"][$i], "../../../assets/img/profile/" . $new_file_name);
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

            $sql = "UPDATE erp_faculty 
        SET f_fname = '$first_name',
            f_lname = '$last_name',
            f_dob = '$date_of_birth',
            f_gender = '$gender',
            f_dept = '$dept',
            f_designation = '$designation',
            f_qualification = '$qualification',
            f_exp = '$experience',
            f_role = '$role',
            f_doj = '$doj',
            f_mobile = '$mobile_number',
            f_email = '$email',
            cls_id = '$cls_id'  
        WHERE f_id = '$fid'";
            // Execute the query
            $result = mysqli_query($conn, $sql);

            // Check for errors
            if ($result === false) {
                die('Error in executing query: ' . mysqli_error($conn));
            }

            // Close the database connection
            mysqli_close($conn);
            echo "OK";
        }
    } else { // If the operation isn't update then it's creation of userProfile where both insertion (fields) and upload of image happens 

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profileImage'])) {

            $f_id = $_POST['f_id'];
            $f_fname = $_POST['first_name'];
            $f_lname = $_POST['last_name'];
            $f_dob = $_POST['date_of_birth'];
            $f_gender = $_POST['gender'];
            $f_dept = $_POST['dept'];
            $f_designation = $_POST['designation'];
            $f_qualification = $_POST['qualification'];
            $f_exp = $_POST['experience'];
            $f_role = $_POST['role'];
            $f_doj = $_POST['doj'];
            $f_mobile = $_POST['mobile_number'];
            $f_email = $_POST['email'];
            $password = $_POST['password'];




            $Res = "Not OK";

            if (!(empty($_FILES['profileImage']['name'][0]) == '' ? 0 : 1)) {

                for ($i = 0; $i < count($_FILES['profileImage']['name']); $i++) {
                    if ($_FILES["profileImage"]["error"][$i] > 0) {
                        echo "Error: " . $_FILES["profileImage"]["error"][$i];
                    } else {
                        if ($_FILES['profileImage']['error'][$i] === UPLOAD_ERR_OK) {

                            $mime_type = mime_content_type($_FILES['profileImage']['tmp_name'][$i]);
                            if ($mime_type === 'image/png' || $mime_type === 'image/jpeg' || $mime_type === 'image/jpg') {
                                // perform processing on the uploaded file


                                // generate a unique file name based on the current timestamp and the original file name

                                $original_file_name = $_FILES["profileImage"]["name"][$i];

                                // Use pathinfo to get the file extension
                                $file_info = pathinfo($original_file_name);
                                $file_extension = $file_info['extension'];

                                $new_file_name = $f_id . '.' . $file_extension;


                                // Escape variables
                                $new_file_name_escaped = mysqli_real_escape_string($conn, $new_file_name);

                                $sql = "INSERT INTO `erp_faculty`(`f_id`, `f_role`, `f_fname`, `f_lname`,  `f_dept`,  `f_dob`, `f_gender`, `f_mobile`, `f_designation`, `f_qualification`,    `f_exp`, `f_email`, `f_doj`, `f_img`,`f_status`)
        VALUES ('$f_id','$f_role','$f_fname','$f_lname','$f_dept','$f_dob','$f_gender','$f_mobile','$f_designation','$f_qualification','$f_exp', '$f_email','$f_doj', '$new_file_name_escaped', 'Active')";
                                // Construct the SQL query
                                // $sql = "UPDATE `erp_faculty` SET `f_img` = '$new_file_name_escaped' WHERE `f_id` = '$f_id'";


                                // Execute the query
                                $result = mysqli_query($conn, $sql);

                                // Check for errors
                                if ($result === false) {
                                    die('Error in executing query: ' . mysqli_error($conn));
                                }

                                // Close the database connection

                                //uploading file
                                move_uploaded_file($_FILES["profileImage"]["tmp_name"][$i], "../../../assets/img/profile/" . $new_file_name);

                                //    create login

                                $sql = "INSERT INTO `erp_login`(`log_id`, `log_pwd`, `log_status`)
                            VALUES ('$f_id','$password','1')";

                                // Execute the query
                                $result = mysqli_query($conn, $sql);

                                // Check for errors
                                if ($result === false) {
                                    die('Error in executing query: ' . mysqli_error($conn));
                                }



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
                $sql = "INSERT INTO `erp_faculty`(`f_id`, `f_role`, `f_fname`, `f_lname`,  `f_dept`,  `f_dob`, `f_gender`, `f_mobile`, `f_designation`, `f_qualification`,    `f_exp`, `f_email`, `f_doj`, `f_status`)
        VALUES ('$f_id','$f_role','$f_fname','$f_lname','$f_dept','$f_dob','$f_gender','$f_mobile','$f_designation','$f_qualification','$f_exp', '$f_email','$f_doj', 'Active')";
                // Construct the SQL query
                // $sql = "UPDATE `erp_faculty` SET `f_img` = '$new_file_name_escaped' WHERE `f_id` = '$f_id'";


                // Execute the query
                $result = mysqli_query($conn, $sql);


                // Check for errors
                if ($result === false) {
                    die('Error in executing query: ' . mysqli_error($conn));
                }
                //    create login

                $sql = "INSERT INTO `erp_login`(`log_id`, `log_pwd`, `log_status`)
                   VALUES ('$f_id','$password','1')";

                // Execute the query
                $result = mysqli_query($conn, $sql);

                // Check for errors
                if ($result === false) {
                    die('Error in executing query: ' . mysqli_error($conn));
                }

                $Res = "OK";
                // Close the database connection
                mysqli_close($conn);
                echo $Res;
            }
        }
    }
}


if (isset($_POST["Function"])) {

    if ($_POST["Function"] == "studentStatusUpdate") {
        // // execute SQL statement
        $facultyId = $_POST["facultyId"];
        $studentStatusUpdate = $_POST["statusChangeValue"];

        $sql = "UPDATE erp_faculty
        SET f_status = '$studentStatusUpdate'
        WHERE f_id = '$facultyId';
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
