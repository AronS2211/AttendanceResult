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
  <link rel="stylesheet" type="text/css" href="../assets/css/style_TT.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">
  <link rel='stylesheet' type='text/css' href="../assets/css/view_exam.css">

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
            <h3 class="m-0">Exam Schedule</h3>
            <div>
              <a href="../index.php">Back</a>
              <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
            </div>
          </div>
          <div class="card-header border-top">
            <div class="d-flex flex-row justify-content-between">
              <h6 class='mb-0'>View</h6>
              <h6 class='mb-0'></h6>
            </div>
          </div>
          <!-- ur content -->
          <?php
          $ce_id = $_GET['ce_id'];
          $test_id = $_GET['test_id'];

          $sql = "SELECT tt_subcode, exam_date FROM erp_exam WHERE ce_id = '$ce_id'";
          $result = mysqli_query($conn, $sql);

          if ($result && mysqli_num_rows($result) > 0) {
            // Display the rows in a table
          ?>
            <div class='container  my-1'>
              <form method='post'>

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
                      <td><?= $row['exam_date'] ?></td>
                    </tr>
                  <?php
                  }
                  ?>
                </table>
              </form>

              <!-- Add Edit and Back buttons -->
              <form action='edit_exam.php' method='get'>
                <input type='hidden' name='ce_id' value='<?= $ce_id ?>'>
                <input type='hidden' name='test_id' value='<?= $test_id ?>'>
                <input type="submit" value="Edit">
              </form>

              <form action='Manage_exam.php' method='post'>
                <input type='submit' name='back' value='Back'>
              </form>
            </div>
          <?php
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

</html>