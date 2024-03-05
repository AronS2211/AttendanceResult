<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
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

    form {
        font-family: Arial, sans-serif;
        font-size: 16px;
        margin: 20px;
        padding: 20px;
        background-color: #f8f8f8;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    label {
        /* display: inline-block; */
        margin-bottom: 5px;
        margin-left: -150px;
        position: fixed;
        align-content: right;
        justify-content: right;
        align-items: right;
        text-align: left;
    }

    input[type="text"],
    input[type="number"] {

        padding: 5px;
        border-radius: 3px;
        border: 1px solid #ccc;
        width: 40%;
        align-content: right;
        justify-content: right;
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
        background-color: #3e8e41;
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

    .delete_btn {
        background-color: rgb(255, 0, 0);
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

    .delete_btn:hover {
        background-color: #db0000;
    }

    .form-container {
        width: 80%;
        margin: auto;
        align-content: center;
        align-items: center;
        justify-content: center;
    }
</style>


<body>
    <button class="add_btn" onclick="location.href='../FeesSelectCategory.php';">Back</button>

    <?php
    $conn = new mysqli(
        "localhost",
        "root",
        "",
        "graceerp"
    );
    if (isset($_POST['submit'])) {
        // $fees_id = $_POST['fee_id'];
        $fees_course = $_POST['add_course'];
        $fees_maincat = $_POST['add_mainCat'];
        $fees_subcat = $_POST['add_subCat'];
        $tuition_fees = "0";
        $au_fees = "0";
        $cdeposit_fees = "0";
        $accomodation_fees = "0";
        $mess_fees = "0";
        $bus_fees = "0";
        $exam_fees = "0";
        $erp_fees = "0";
        $dept_fees = "0";
        $insert_query = "INSERT INTO erp_fees (fee_course,fee_maincat,fee_subcat,fee_tuition,fee_au,fee_cdeposit,fee_accommodation,fee_mess,fee_bus,fee_exam,fee_erp,fee_dept)
  VALUES ('$fees_course','$fees_maincat','$fees_subcat',$tuition_fees,'$au_fees','$cdeposit_fees','$accomodation_fees','$mess_fees','$bus_fees','$exam_fees','$erp_fees','$dept_fees')";
        if (mysqli_query($conn, $insert_query)) {
            // echo "New Record has been added";
        } else {
            echo "Error: " . $insert_query . ":-" . mysqli_error($conn);
        }
        echo '<script>alert("Successfully Added!")</script>';
    }

    if (isset($_POST['delete'])) {
        $fees_maincat = $_POST['add_mainCat'];
        $delete_query = "DELETE FROM erp_fees WHERE fee_maincat = '$fees_maincat'";

        if (mysqli_query($conn, $delete_query)) {
            echo "Record has been deleted";
        } else {
            echo "Error: " . $delete_query . ":-" . mysqli_error($conn);
        }
    }

    ?>
    <center>
        <div class="form-container">
            <h1>ADD/DELETE FEE CATEGORIES</h1>
            <form method="post">

                <label for="add_mainCat">Fees Main category:</label>
                <input type="text" id="add_mainCat" name="add_mainCat" required><br>

                <label for="add_course">Fees course:</label>
                <input type="text" id="add_course" name="add_course" required><br>

                <label for="add_subCat">Fees Sub category:</label>
                <input type="text" id="add_subCat" name="add_subCat" required><br>

                <input type="submit" name="submit" value="Add" class="add_btn">
                <input type="submit" name="delete" value="Delete" class="delete_btn">
            </form>
        </div>
    </center>
</body>

</html>