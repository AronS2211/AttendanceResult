<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GracER</title>

  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="icon" sizes="196x196" type="image/x-icon" href="../assets/img/gcoe_logo.png">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
  <!-- sweet alert JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="../assets/css/anydata.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/style_TT.css">

  <style>
    #admin_module {
      background-color: var(--pri);
    }
  </style>

</head>

<body>
  <?php include('../../includes/config.php'); ?>
  <?php include('../../includes/header.php'); ?>

  <div class="main-container">
    <?php include('../../includes/sidebar.php'); ?>
    <main>

      <div class="main-card">
        <div class="card text-bg-light mx-3 my-3">
          <div class="report-head p-2 d-flex justify-content-between align-items-center">
            <h3 class="m-0">Create Exams</h3>
            <div class="d-flex">
              <a href="../index.php">Back</a>
              <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
            </div>
          </div>
          <div class="card-header border-top">
            <div class="d-flex flex-row justify-content-between">
              <h6 class='mb-0'>Create</h6>
              <h6 class='mb-0'></h6>
            </div>
          </div>
          <!-- ur content -->

          <form method="POST" action="Create.php">
            <div class="TT-form-content">
              <div>
                <label for="test_name">Exam Name:</label>
                <input type="text" id="test_name" name="test_name" required>
              </div>
              <div>
                <label for="test_type">Test Type:</label>
                <select id="test_type" name="test_type" onchange="toggleMarks()" required>
                  <option value="">Select Test Type</option>
                  <option value="m">Mark</option>
                  <option value="g">Grade</option>
                </select>
              </div>
              <div>
                <label>Exam Type:</label>
                <input type="radio" name="ce_type" id="academic" style="display:inline-block;margin-left:1px;" value="academic" required>Academic
                <input type="radio" name="ce_type" id="university" style="display:inline-block;margin-left:1px;" value="university">University
                <input type="radio" name="ce_type" id="others" style="display:inline-block;margin-left:1px;" value="others">Others
              </div>

              <div>
                <label for="test_maxmark">Max Mark/Grade:</label>
                <input type="number" id="test_maxmark" name="test_maxmark" required>
              </div>

              <div>
                <label for="test_passmark">Min Mark/Grade:</label>
                <input type="number" id="test_passmark" name="test_passmark" required>
              </div>
              <div>
                <input type="submit" name="submit" value="Submit">
              </div>
            </div>
          </form>




          <?php

          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            // Get the form data
            $test_name = $_POST['test_name'];
            $test_maxmark = $_POST['test_maxmark'];
            $test_passmark = $_POST['test_passmark'];
            $test_type = $_POST['test_type'];
            $test_ce_type = $_POST['ce_type'];

            // Check if the test already exists in the database
            $sql_check = "SELECT * FROM erp_test WHERE test_name = '$test_name' AND test_type = '$test_type'";
            $result = $conn->query($sql_check);
            if ($result->num_rows > 0) {
              // Display a pop-up message asking whether to create or cancel creation
              $sql = "INSERT INTO erp_test (test_name, test_maxmark, test_passmark, test_type, test_ce_type) VALUES ('$test_name', '$test_maxmark', '$test_passmark', '$test_type' ,'$test_ce_type')";

              echo "<script>
        Swal.fire({
            title: 'The test already exists. Do you want to create it anyway?',
            showCancelButton: true,
            confirmButtonText: 'Create',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                // User clicked OK, insert the data into the database
                " . ($conn->query($sql) === TRUE ? "
                    Swal.fire('Test has been created.');
                " : "
                    Swal.fire('Error: Cannot create test.');
                ") . "
            } else {
                // User clicked cancel, do nothing
            }
        });
    </script>";
            } else {
              // Insert the data into the database
              $sql_insert = "INSERT INTO erp_test (test_name, test_maxmark, test_passmark, test_type, test_ce_type) VALUES ('$test_name', '$test_maxmark', '$test_passmark', '$test_type' ,'$test_ce_type')";
              if ($conn->query($sql_insert) === TRUE) {
                // Display a pop-up message if the test is successfully inserted
                echo "<script>
          Swal.fire({
              title: 'Test has been created.',
              icon: 'success',
              confirmButtonText: 'OK'
          });
      </script>";
              } else {
                echo "Error: Cannot create test.";
              }
            }
          }

          ?>

          <!-- ur content -->
        </div>
      </div>

    </main>
  </div>

  <?php include('../../includes/footer.php'); ?>
</body>
<script src="../../assets/js/script.js"></script>
<script src="../assets/js/anydata.js"></script>
<script src="../assets/js/script.js"></script>

<script>
  function toggleMarks() {
    const typeSelect = document.getElementById("test_type");
    const maxMarkInput = document.getElementById("test_maxmark");
    const passMarkInput = document.getElementById("test_passmark");

    if (typeSelect.value === "g") { // Change "G" to "g" to match the option value
      maxMarkInput.type = "text";
      passMarkInput.type = "text";
    } else {
      maxMarkInput.type = "number";
      passMarkInput.type = "number";
    }
  }
</script>

<script>
  // clear form history
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</html>