<!DOCTYPE html>
<html>

<head>
  <title>Fee Form</title>
  <link rel="stylesheet" href="../../style1.css">
</head>

<body>
  <button class="add_btn" onclick="location.href='../FeesSelectCategory.php';">Back</button>
  <?php
  // Establishing connection to the database
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "graceerp";

  $conn = new mysqli($servername, $username, $password, $dbname);

  // Checking if the connection is successful
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  // echo "connceted Sucessfully";
  $fees_id = $_GET['id'];
  $getData = "select * from erp_fees where fee_id in ('$fees_id');";
  $result = ($conn->query($getData));
  $row = [];
  if ($result->num_rows > 0) {

    $row = $result->fetch_all(MYSQLI_ASSOC);
  }
  if (isset($_POST['submit'])) {
    $fee_id = $_POST['fee_id'];
    $tuition_fees = $_POST['tuition_fee'];
    $au_fees = $_POST['au_fees'];
    $cdeposit_fees = $_POST['cdeposit_fees'];
    $accomodation_fees = $_POST['accomodation_fees'];
    $mess_fees = $_POST['mess_fees'];
    $bus_fees = $_POST['bus_fees'];
    $exam_fees = $_POST['exam_fees'];
    $erp_fees = $_POST['erp_fees'];
    $dept_fees = $_POST['dept_fees'];
    $insert_query = "UPDATE erp_fees SET fee_id='$fee_id',fee_tuition='$tuition_fees',fee_au='$au_fees',fee_cdeposit='$cdeposit_fees',fee_accommodation='$accomodation_fees',fee_mess='$mess_fees',fee_bus='$bus_fees',fee_exam='$exam_fees',fee_erp='$erp_fees',fee_dept='$dept_fees'
  WHERE fee_id = '$fee_id'";
    if (mysqli_query($conn, $insert_query)) {
      echo '<script>alert("Successfully Updated!")</script>';
    } else {
      echo "Error: " . $insert_query . ":-" . mysqli_error($conn);
    }
    
    // header("Location:../FeesSelectCategory.php");
  }
  if (isset($_POST['delete'])) {
    $fee_id = $_POST['fee_id'];
    $delete_query = "DELETE FROM erp_fees WHERE fee_id='$fee_id'";
    if (mysqli_query($conn, $delete_query)) {
      echo '<script>alert("Successfully Deleted!")</script>';
    } else {
      echo "Error: " . $delete_query . ":-" . mysqli_error($conn);
    }
  }

  ?>
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


  <center>
    <h1>MANAGE FEE DETAILS</h1>
    <?php
    $null = "Null";
    if (!empty($row))
      foreach ($row as $rows) {
    ?>
      <form method="post">
        <div class="main-container">
          <div class="right-container">
            <label for="fee_id">Fee ID:</label>
            <label for="fee_tuition">Tuition Fees:</label>
            <label for="fee_au">AU Fees:</label>
            <label for="fee_cdeposit">Caution deposit Fees:</label>
            <label for="fee_accomodation">Accomodation Fees:</label>
            <label for="fee_mess">Mess Fees:</label>
            <label for="fee_bus">Bus Fees:</label>
            <label for="fee_exam">Exam Fees:</label>
            <label for="fee_erp">ERP Fees:</label>
            <label for="fee_dept">Fees for Department:</label>
          </div>
          <div class="left-container">
            <input type="text" id="fee_id" name="fee_id" value="<?php echo $_GET['id']; ?>" required><br>
            <input type="number" id="fee_tuition" name="tuition_fee" value=<?php echo $rows['fee_tuition'] ?>required><br>
            <input type="number" id="fee_au" name="au_fees" value=<?php echo $rows['fee_au'] ?> required><br>
            <input type="number" id="fee_cdeposit" name="cdeposit_fees" value=<?php echo $rows['fee_cdeposit'] ?> required><br>
            <input type="number" id="fee_accomodation" name="accomodation_fees" value=<?php echo $rows['fee_accommodation'] ?> required><br>
            <input type="number" id="fee_mess" name="mess_fees" value=<?php echo $rows['fee_mess'] ?> required><br>
            <input type="number" id="fee_bus" name="bus_fees" value=<?php echo $rows['fee_bus'] ?> required><br>
            <input type="number" id="fee_exam" name="exam_fees" value=<?php echo $rows['fee_exam'] ?> required><br>
            <input type="number" id="fee_erp" name="erp_fees" value=<?php echo $rows['fee_erp'] ?> required><br>
            <input type="text" id="fee_dept" name="dept_fees" placeholder=<?php echo $rows['fee_dept'] ?> required><br>
          </div>
        </div>
        <input type="submit" name="delete" value="Delete">
        <input type="submit" name="submit" value="Save">
      </form>
      </div>
    <?php } ?>
  </center>
</body>

</html>