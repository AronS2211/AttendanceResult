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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
  <!-- sweet alert JS -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <link rel="stylesheet" href="../assets/css/anydata.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/style_TT.css">
  <link rel='stylesheet' type='text/css' href='../assets/css/edit_exam.css'>

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
        <div class="card text-bg-light mx-3 mt-3 mb-5">
          <div class="report-head p-2 d-flex justify-content-between align-items-center">
            <h3 class="m-0">Exam Schedule</h3>
            <div>
              <a href="../index.php">Back</a>
              <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
            </div>
          </div>
          <div class="card-header border-top">
            <div class="d-flex flex-row justify-content-between">
              <h6 class='mb-0'>Edit</h6>
              <h6 class='mb-0'></h6>
            </div>
          </div>
          <!-- ur content -->



          <?php


          $ce_id = $_GET['ce_id'];
          $test_id = $_GET['test_id'];

          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
            // Get the updated exam end date and update the database
            $ce_edate = $_POST['ce_edate'];
            $sql = "UPDATE erp_createexam SET ce_edate = '$ce_edate' WHERE ce_id = '$ce_id'";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
              echo "Error updating exam end date: " . mysqli_error($conn);
              exit();
            }

            // Get the updated exam dates and update the database
            foreach ($_POST['exam_date'] as $tt_subcode => $exam_date) {
              if (isset($tt_subcode) && isset($exam_date)) {
                $sql = "UPDATE erp_exam SET exam_date = '$exam_date' WHERE ce_id = '$ce_id' AND tt_subcode = '$tt_subcode'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                  echo "Error updating exam dates: " . mysqli_error($conn);
                  exit();
                }
              }
            }

          ?>
            <script>
              Swal.fire({
                title: 'Exam dates updated successfully.',
                icon: 'success',
                confirmButtonText: 'OK'
              });
            </script>
            <?php
          }

          // Get ce_sdate and ce_edate from the database
          $sql = "SELECT ce_sdate, ce_edate FROM erp_createexam WHERE ce_id = '$ce_id'";
          $result = mysqli_query($conn, $sql);
          if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $ce_sdate = $row['ce_sdate'];
            $ce_edate = $row['ce_edate'];

            // Get exam dates and subject codes from the database
            $sql = "SELECT tt_subcode, exam_date FROM erp_exam WHERE ce_id = '$ce_id' AND test_id = '$test_id'";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
            ?>
              <div class='container'>
                <form method='post'>


                  <label for='ce_edate'>Exam End Date:</label>
                  <input type='date' id='ce_edate' name='ce_edate' value='<?= $ce_edate ?>' min='<?= $ce_sdate ?>' onchange='updateExamDates(this.value)'><br><br>

                  <table>
                    <tr>
                      <th>Subject Code</th>
                      <th>Exam Date</th>
                    </tr>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                      <tr>
                        <td><?= $row['tt_subcode'] ?></td>
                        <td><input type='date' name='exam_date[<?= $row['tt_subcode'] ?>]' value='<?= $row['exam_date'] ?>' min='<?= $ce_sdate ?>'></td>
                      </tr>
                    <?php
                    }
                    ?>
                  </table>
                  <input type="submit" name="update" value="Update">
                </form>
              </div>


          <?php
              // Add JavaScript function to update exam date inputs based on the selected end date
              echo '<script>
      function updateExamDates(endDate) {
        const examDateInputs = document.querySelectorAll(\'input[type="date"][name^="exam_date"]\');
        examDateInputs.forEach(input => {
          input.max = endDate;
        });
      }
    </script>';
            } else {
              echo "No exam data found.";
            }

            // Add Back button
            echo "<form action='Manage_exam.php' method='post'>";
            echo "<input type='submit' name='back' value='Back'>";
            echo "</form>";
          } else {
            echo "No data found.";
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
  // clear form history
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script>

</html>