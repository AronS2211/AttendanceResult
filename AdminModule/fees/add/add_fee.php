<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="../../style1.css"> -->
    <title>Add fee</title>
</head>

<body>
    <button class="add_btn" onclick="location.href='../FeesSelectCategory.php';">Back</button>

    <style>
        .left-container {
            width: 50%;

        }

        .right-container {
            width: 50%;
            display: flex;
            flex-direction: column;
            gap: 15px;
            text-align: left;
        }

        .add_btn {
            margin-top: 30px;
            background-color: rgb(128, 0, 128);
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            cursor: pointer;
        }

        .add_btn:hover {
            background-color: rgb(128, 0, 128);
        }

        .main-container {
            display: flex;
            /* flex-direction: column; */
            gap: 10px;
            width: 100%;
            align-items: center;
            /* background-color: #f8f8f8;
            border: 1px solid #ccc;
            border-radius: 5px; */
        }

        form {
            font-family: Arial, sans-serif;
            font-size: 16px;
            width: 40%;
            padding: 80px;
            align-items: center;
            background-color: #f8f8f8;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            margin-bottom: 5px;
        }

        select {
            width: 50vh;
        }

        input[type="text"],
        input[type="number"] {
            padding: 5px;
            border-radius: 3px;
            border: 1px solid #ccc;
            width: 58vh;
            margin: auto;
            align-items: center;
            justify-content: center;
            align-items: right;
            margin-bottom: 10px;
        }

        input[type="button"],
        input[type="submit"] {
            background-color: rgb(128, 0, 128);
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="button"]:hover,
        input[type="submit"]:hover {
            background-color: rgb(128, 0, 128);
        }

        /* Style specific elements */
        h1 {
            font-size: 24px;
            margin: 20px;
        }

        #fees_id {
            width: 50px;
        }

        /* Adjust spacing for buttons */
        input[type="button"] {
            margin-right: 10px;
        }

        /* Make form responsive */
        @media only screen and (max-width: 600px) {
            form {
                margin: 10px;
                padding: 10px;
            }

            input[type="text"],
            input[type="number"] {
                max-width: 100%;
            }
        }

        /* Add your desired styles here for fee_course*/
        #fee_course {
            width: 330px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Add your desired styles here for fee_maincat*/
        #fee_maincat {
            width: 330px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        /* Add your desired styles here for fee_subcat*/
        #fee_subcat {
            width: 330px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            margin-bottom: 10px;
        }

        .form-container {
            width: 80%;
            margin: auto;
            align-content: center;
            align-items: center;
            justify-content: center;
        }

        .item {
            display: flex;
            gap: 50px
        }

        .item-input {
            display: inline-block;
            align-items: center;
            margin: auto;
        }
    </style>
    <SCRIPT language=JavaScript>
        // 
        function reload(form) {
            var fee_course = form.fee_course.options[form.fee_course.options.selectedIndex].value;
            var fee_cat = form.fee_cat.options[form.fee_cat.options.selectedIndex].value;
            self.location = 'add_fee.php?course=' + fee_course + '&cat=' + fee_cat;
        }
    </script>
    <?php
    $conn = new mysqli(
        "localhost",
        "root",
        "",
        "graceerp"
    );

    if ($conn->connect_error) {
        die("Connection failed: "
            . $conn->connect_error);
    }
    if (isset($_POST['submit'])) {
        // $fees_id = $_POST['fee_id'];
        $fees_course = $_POST['fee_course'];
        $fees_maincat = $_POST['fee_cat'];
        $fees_subcat = $_POST['fee_subcat'];
        $tuition_fees = $_POST['fee_tuition'];
        $au_fees = $_POST['fee_au'];
        $cdeposit_fees = $_POST['fee_cdeposit'];
        $accomodation_fees = $_POST['fee_accomodation'];
        $mess_fees = $_POST['fee_mess'];
        $bus_fees = $_POST['fee_bus'];
        $exam_fees = $_POST['fee_exam'];
        $erp_fees = $_POST['fee_erp'];
        $dept_fees = $_POST['fee_dept'];
        $insert_query = "INSERT INTO erp_fees (fee_course,fee_maincat,fee_subcat,fee_tuition,fee_au,fee_cdeposit,fee_accommodation,fee_mess,fee_bus,fee_exam,fee_erp,fee_dept)
  VALUES ('$fees_course','$fees_maincat','$fees_subcat',$tuition_fees,'$au_fees','$cdeposit_fees','$accomodation_fees','$mess_fees','$bus_fees','$exam_fees','$erp_fees','$dept_fees')";
        if (mysqli_query($conn, $insert_query)) {
            // echo "New Record has been added";
        } else {
            echo "Error: " . $insert_query . ":-" . mysqli_error($conn);
        }
        $header = "../FeesSelectCategory.php";
        echo '<script>alert("Successfully Added!")</script>';
        // header('Location: ' . $header);
    }
    @$course = $_GET['course'];
    @$cat = $_GET['cat'];
    $fee_maincat = "SELECT DISTINCT fee_maincat FROM erp_fees";

    $result = ($conn->query($fee_maincat));
    $row = [];
    if ($result->num_rows > 0) {
        // fetch all data from db into array 

        $row = $result->fetch_all(MYSQLI_ASSOC);
    }
    $fee_course = " SELECT DISTINCT fee_course FROM erp_fees";
    $result1 = ($conn->query($fee_course));
    $row1 = [];
    if ($result1->num_rows > 0) {
        // fetch all data from db into array 

        $row1 = $result1->fetch_all(MYSQLI_ASSOC);
    }
    if (isset($course) and strlen($course) > 0) {
        $fee_subcat = " SELECT DISTINCT fee_subcat FROM erp_fees where fee_course='$course' and fee_maincat='$cat'";
    } else $fee_subcat = " SELECT DISTINCT fee_subcat FROM erp_fees";
    $result2 = ($conn->query($fee_subcat));
    $row2 = [];
    if ($result2->num_rows > 0) {
        // fetch all data from db into array 

        $row2 = $result2->fetch_all(MYSQLI_ASSOC);
    }
    ?>
    <center>
        <h1>ADD FEE DETAILS</h1>
        <form method="post" name="sel_cat">

            <div class="main-container">
                <div class="right-container">
                    <label for="fee_maincat">Fees Main category:</label>
                    <label for="fee_course">Fees course:</label>
                    <label for="fee_subcat">Fees Sub category:</label>
                    <label for="fee_tuition">Tuition Fees:</label>
                    <label for="fee_au">AU Fees:</label>
                    <label for="fee_cdeposit">Caution deposit Fees:</label>
                    <label for="fee_accomodation">Accomodation Fees:</label>
                    <label for="fee_mess">Mess Fees:</label>
                    <label for="fee_bus">Bus Fees:</label>
                    <label for="fee_exam">Exam Fees:</label>
                    <label for="fee_erp">ERP Fees:</label>
                    <label for="fee_dept">Fee for department:</label>
                </div>
                <div class="left-container">
                    <?php
                    echo "<select name='fee_cat' id='fee_maincat'>";
                    echo "<option value=''>Select Main Category</option>";
                    $null = "Null";
                    if (!empty($row1))
                        foreach ($row as $rows) {
                            if ($rows['fee_maincat'] == @$cat) {
                                echo "<option selected value='$rows[fee_maincat]'>$rows[fee_maincat]</option>" . "<BR>";
                            } else {
                                echo  "<option value='$rows[fee_maincat]'>$rows[fee_maincat]</option>";
                            }
                        }
                    echo "</select>";
                    ?>
                    <?php
                    echo "<select id='fee_course' name='fee_course' onchange=\"reload(this.form)\">";
                    echo "<option value=''>Select Fee Course</option>";
                    $null = "Null";
                    if (!empty($row1))
                        foreach ($row1 as $rows) {
                            if ($rows['fee_course'] == @$course) {
                                echo "<option selected value='$rows[fee_course]'>$rows[fee_course]</option>" . "<BR>";
                            } else {
                                echo  "<option value='$rows[fee_course]'>$rows[fee_course]</option>";
                            }
                        }
                    echo "</select>";
                    ?>

                    <select name="fee_subcat" id="fee_subcat">
                        <option value="" default>Select Fee Sub Category</option>
                        <?php
                        $null = "Null";
                        if (!empty($row2))
                            foreach ($row2 as $rows) {
                        ?>
                            <option selected value="<?php echo $rows['fee_subcat']; ?>"><?php echo $rows['fee_subcat']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="number" id="fee_tuition" name="fee_tuition" required><br>
                    <input type="number" id="fee_au" name="fee_au" required><br>
                    <input type="number" id="fee_cdeposit" name="fee_cdeposit" required><br>
                    <input type="number" id="fee_accomodation" name="fee_accomodation" required><br>
                    <input type="number" id="fee_mess" name="fee_mess" required><br>
                    <input type="number" id="fee_bus" name="fee_bus" required><br>
                    <input type="number" id="fee_exam" name="fee_exam" required><br>
                    <input type="number" id="fee_erp" name="fee_erp" required><br>
                    <input type="text" id="fee_dept" name="fee_dept" required><br>
                </div>
            </div>
            <input type="submit" name="submit" value="Add">
        </form>
    </center>
</body>

</html>