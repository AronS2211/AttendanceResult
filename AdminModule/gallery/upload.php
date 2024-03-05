<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['fileToUpload'])) {
    $file = $_FILES['fileToUpload'];
    // print_r($file);
    if (isset($_POST['Evnet'])) {
        $Evnet = $_POST['Evnet'];
    }
    if (isset($_POST['ImageDesc'])) {
        $ImageDesc = $_POST['ImageDesc'];
    }
    $Res="Not OK";
    //  echo $Evnet.$ImageDesc;

    // perform some validation and processing on the uploaded file

    // move the uploaded file to a permanent location
    for ($i = 0; $i < count($_FILES['fileToUpload']['name']); $i++) {
        if ($_FILES["fileToUpload"]["error"][$i] > 0) {
            echo "Error: " . $_FILES["fileToUpload"]["error"][$i];
        } else {
            if ($_FILES['fileToUpload']['error'][$i] === UPLOAD_ERR_OK) {

                $mime_type = mime_content_type($_FILES['fileToUpload']['tmp_name'][$i]);
                if ($mime_type === 'image/png' || $mime_type === 'image/jpeg' || $mime_type === 'image/jpg') {
                    // perform processing on the uploaded file

                    // Include the database connection file
                    include('Includes/db_connection.php');
                    // generate a unique file name based on the current timestamp and the original file name
                    $new_file_name = time() . '_' . $_FILES["fileToUpload"]["name"][$i];
                    // insert a row into the table
                    $sql = "INSERT INTO erp_img (g_id, img_img, img_desc) VALUES ('" . $Evnet . "', '" . "img/" . $new_file_name . "', '" . $ImageDesc . "')";

                    if (!mysqli_query($conn, $sql)) {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }

                    // Close the database connection
                    mysqli_close($conn);
                    //uploading file
                    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], "img/" . $new_file_name);
                    $Res= "OK";
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