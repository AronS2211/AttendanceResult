<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Fees Category</title>
    <style>
        hr {
            border-top: 1px solid #111111;
            border-bottom: 1px solid #292929;
        }

        .main-container {
            display: flex;
            flex-direction: column;
            height: 100vh;
            padding: 20px;
        }

        .form-container {
            margin: auto;
            display: flex;
            flex-direction: column;
            width: 30%;
            height: fit-content;
            gap: 10px
        }

        .form-container h1 {
            text-align: center;
            font-size: 2rem;
            font-weight: 600;
        }

        .form-container select {
            padding: 10px;
            border-radius: 20px;

        }

        input {
            margin: auto;
            padding: 6px;
            border-radius: 10px;
            width: 50%;
            color: white;
            font-weight: 600;
            cursor: pointer;
            border: rgb(128, 0, 128);
            background-color: rgb(128, 0, 128);
            ;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            text-align: left;
        }

        th,
        td {
            padding: 8px;
            border: 1px solid black;
        }

        th {
            background-color: lightgray;
        }

        h1 {
            text-align: center;
            font-size: 36px;
            margin-top: 30px;
            margin-bottom: 20px;
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
            background-color: #026dbe;
        }

        .edit_btn {
            margin-top: 8px;
            background-color: rgb(128, 0, 128);
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-right: 10px;
            text-decoration: none;
            cursor: pointer;
        }

        .edit_btn:hover {
            background-color: #026dbe;
        }

        a {

            text-decoration: none;
            color: white;
        }

        .buttons {
            display: flex;
            gap: 5px;
        }

        .add_cat {
            width: 50%;
            padding: 6px;
            cursor: pointer;
            border-radius: 10px;
            border: rgb(128, 0, 128);
            background-color: rgb(128, 0, 128);
            ;
        }

        .add_cat a {
            text-decoration: none;
            color: white;
            font-weight: 600;
        }
    </style>
    <SCRIPT language=JavaScript>
        // 
        function reload(form) {
            var fee_course = form.fee_course.options[form.fee_course.options.selectedIndex].value;
            var fee_cat = form.fee_cat.options[form.fee_cat.options.selectedIndex].value;
            self.location = 'FeesSelectCategory.php?course=' + fee_course + '&cat=' + fee_cat;
        }
    </script>
</head>

<body>

    <?php
    @$course = $_GET['course'];
    @$cat = $_GET['cat'];
    $conn = new mysqli(
        "localhost",
        "root",
        "",
        "graceerp"
    );

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
    } else
        $fee_subcat = "SELECT DISTINCT fee_subcat FROM erp_fees where fee_course='$course' and fee_maincat='$cat'";
    $result2 = ($conn->query($fee_subcat));
    $row2 = [];
    if ($result2->num_rows > 0) {
        // fetch all data from db into array 
    
        $row2 = $result2->fetch_all(MYSQLI_ASSOC);
    }

    ?>
    <div class="main-container">
        <form method=post name="sel_cat" class="form-container" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h1>Select Fees Category</h1>
            <?php
            echo "<select name='fee_cat'>";
            echo "<option default value=''>Select Main Category</option>";
            $null = "Null";
            if (!empty($row1))
                foreach ($row as $rows) {
                    if ($rows['fee_maincat'] == @$cat) {
                        echo "<option selected value='$rows[fee_maincat]'>$rows[fee_maincat]</option>" . "<BR>";
                    } else {
                        echo "<option value='$rows[fee_maincat]'>$rows[fee_maincat]</option>";
                    }
                }
            echo "</select>";
            ?>
            <?php
            echo "<select name='fee_course' onchange=\"reload(this.form)\">";
            echo "<option value=''>Select Fee Course</option>";
            $null = "Null";
            if (!empty($row1))
                foreach ($row1 as $rows) {
                    if ($rows['fee_course'] == @$course) {
                        echo "<option selected value='$rows[fee_course]'>$rows[fee_course]</option>" . "<BR>";
                    } else {
                        echo "<option value='$rows[fee_course]'>$rows[fee_course]</option>";
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
            <div class="buttons">
                <input type="submit" name="search" value="Search">
                <button class="add_cat"><a href="./AddCat/add.php">Add / delete Category</a></button>
            </div>

        </form>
        
        <div class="iframe">
            <?php

            if (isset($_POST['search'])) {
                $fee_maincat1 = $_POST['fee_cat'];
                $fee_course1 = $_POST['fee_course'];
                $fee_subcat1 = $_POST['fee_subcat'];

                $getData = "select * from erp_fees where fee_course='$fee_course1' and fee_maincat='$fee_maincat1' and fee_subcat='$fee_subcat1'";
                $result4 = ($conn->query($getData));
                $row4 = [];
                if ($result4->num_rows > 0) {
                    // fetch all data from db into array 
            
                    $row4 = $result4->fetch_all(MYSQLI_ASSOC);
                }
                echo "<h1>$fee_maincat1 <br />Fee Structure ($fee_subcat1 )</h1>";
            }
            ?>

            <table>

                <tr>
                    <th>S.No</th>
                    <?php if ($fee_maincat == "management") { ?>
                    <th>Admission Fees</th>
                    <?php } ?>
                    <th>Tuition Fees</th>
                    <th>Au Fees</th>
                    <th>Caution Deposit Fees</th>
                    <th>Accommodation Fees</th>
                    <th>Mess Fees</th>
                    <th>Bus Fees</th>
                    <th>Exam Fees</th>
                    <th>ERP Fees</th>
                    <th>Fees for department</th>
                    <th>Actions</th>
                </tr>
                <?php
                $null = "Null";
                $sno = 1;
                if (!empty($row4))
                    foreach ($row4 as $rows) {
                        ?>
                <tr>

                    <td>
                        <?php echo $sno++; ?>
                    </td>
                    <?php $id = $rows['fee_id'] ?>
                    <?php if ($fee_maincat == "management") { ?>
                    <td>
                        <?php echo $rows['fee_admission'] ? $rows['fee_admission'] : 'Null' ?>
                    </td>
                    <?php } ?>
                    <td>
                        <?php echo $rows['fee_tuition'] ? $rows['fee_tuition'] : 'Null'; ?>
                    </td>
                    <td>
                        <?php echo $rows['fee_au']; ?>
                    </td>
                    <td>
                        <?php echo $rows['fee_cdeposit']; ?>
                    </td>
                    <td>
                        <?php echo $rows['fee_accommodation']; ?>
                    </td>
                    <td>
                        <?php echo $rows['fee_mess']; ?>
                    </td>
                    <td>
                        <?php echo $rows['fee_bus']; ?>
                    </td>
                    <td>
                        <?php echo $rows['fee_exam']; ?>
                    </td>
                    <td>
                        <?php echo $rows['fee_erp']; ?>
                    </td>
                    <td>
                        <?php echo $rows['fee_dept']; ?>
                    </td>
                    <td><button class="edit_btn"><a href="./edit/fee_edit.php?id=<?php echo $id ?>">Edit</a></button>
                    </td>

                </tr>
                <?php } ?>
            </table>
            <button class="edit_btn"><a href="./add/add_fee.php">Add</a></button>

        </div>
    </div>


</body>

</html>