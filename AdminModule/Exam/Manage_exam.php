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

  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
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
              <h6 class='mb-0'>Manage</h6>
              <h6 class='mb-0'></h6>
            </div>
          </div>
          <!-- ur content -->
          <div class="TT-form-content">
            <form class="for" name="myform" method="POST" action="Manage_exam.php">

              <div>
                <label for="ce_exam">Exam Name:</label>
                <select id="ce_exam" name="ce_exam">
                  <?php

                  // Query to get the list of exam names
                  $query = "SELECT DISTINCT ce_exam FROM erp_createexam";

                  // Execute the query
                  $result = mysqli_query($conn, $query);

                  // Loop through the results and create an option for each exam name
                  echo '<option value="" selected>Select the Exam</option>';
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<option value='" . $row['ce_exam'] . "'>" . $row['ce_exam'] . "</option>";
                  }

                  ?>
                </select>
              </div>

              <div>
                <label for="cls_course">Course:</label>
                <select id="cls_course" name="cls_course">
                  <?php

                  // Query the database to fetch the dropdown options
                  $sql = "SELECT DISTINCT cls_course FROM erp_class";
                  $result = mysqli_query($conn, $sql);

                  // Generate the options for the dropdown menu
                  echo '<option value="" selected>Select the Course</option>';
                  while ($row = mysqli_fetch_array($result)) {
                    echo '<option value="' . $row['cls_course'] . '">' . $row['cls_course'] . '</option>';
                  }

                  ?>
                </select>
              </div>

              <div>
                <label for="cls_deptname">Department:</label>
                <select id="cls_deptname" name="cls_deptname" required>
                  <option value="" selected>Select the Department</option>
                </select>
              </div>

              <div>
                <label for="cls_sem">Semester:</label>
                <select id="cls_sem" name="cls_sem" required>
                  <option value="" selected>Select the Semester</option>
                </select>
              </div>

              <div>
                <label>Exam Type:</label>
                <input type="radio" name="ce_type" id="academic" style="display:inline-block;margin-left:1px;" value="academic" required>Academic
                <input type="radio" name="ce_type" id="university" style="display:inline-block;margin-left:1px;" value="university">University
                <input type="radio" name="ce_type" id="others" style="display:inline-block;margin-left:1px;" value="others">Others
              </div>

              <div>
                <input type="submit" value="Search" name="submit">
              </div>

            </form>
          </div>



          <?php
          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            // Get the form data
            $cls_deptname = $_POST['cls_deptname'];
            $cls_course = $_POST['cls_course'];
            $cls_sem = $_POST['cls_sem'];
            $ce_exam = $_POST['ce_exam'];
            $ce_type = $_POST['ce_type'];

            // Get the cls_id for the selected department
            $sql = "SELECT cls_id FROM erp_class WHERE cls_deptname = '$cls_deptname' AND cls_sem = '$cls_sem'";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              $cls_id = $row['cls_id'];
            }

            $sql = "SELECT test_id FROM erp_test WHERE test_name = '$ce_exam'";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              $test_id = $row['test_id'];
            }

            // Modify the query to handle "Others" option
            if ($ce_type === "others") {
              $sql = "SELECT ce_id, ce_exam, ce_type, ce_sdate, ce_edate FROM erp_createexam WHERE cls_id = '$cls_id' AND ce_exam = '$ce_exam' AND ce_type NOT IN ('academic', 'university')";
            } else {
              $sql = "SELECT ce_id, ce_exam, ce_type, ce_sdate, ce_edate FROM erp_createexam WHERE cls_id = '$cls_id' AND ce_exam = '$ce_exam' AND ce_type = '$ce_type'";
            }

            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
              // Display the exam details in a table
              echo "<div class='d-flex justify-content-around'>";
              echo "<table>";
              echo "<tr><th>Exam Name</th><th>Exam Type</th><th>Start Date</th><th>End Date</th><th></th></tr>";
              while ($row = mysqli_fetch_assoc($result)) {
                $ce_id = $row['ce_id'];
                $ce_exam = $row['ce_exam'];
                $ce_type = $row['ce_type'];
                $ce_sdate = $row['ce_sdate'];
                $ce_edate = $row['ce_edate'];

                echo "<tr>";
                echo "<td>" . $ce_exam . "</td>";
                echo "<td>" . $ce_type . "</td>";
                echo "<td>" . $ce_sdate . "</td>";
                echo "<td>" . $ce_edate . "</td>";


          ?>
                <td>
                  <a href="view_exam.php?ce_id=<?php echo $ce_id; ?>&test_id=<?php echo $test_id; ?>">View </a>
                </td>
                </tr>
          <?php 
              }
              echo "</table>";
              echo "</div>";
            } else {
              echo "No exam found.";
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
  // Get the course, department, and semester dropdowns
  const courseDropdown = document.getElementById("cls_course");
  const deptDropdown = document.getElementById("cls_deptname");
  const semDropdown = document.getElementById("cls_sem");

  // Event listener for course dropdown
  courseDropdown.addEventListener("change", () => {
    // Clear previous options in department and semester dropdowns
    deptDropdown.innerHTML = '<option value="" selected>Select the Department</option>';
    semDropdown.innerHTML = '<option value="" selected>Select the Semester</option>';

    // Get the selected course
    const selectedCourse = courseDropdown.value;

    // Fetch the department options based on the selected course
    fetch(`get_depts.php?course=${selectedCourse}`)
      .then(response => response.json())
      .then(data => {
        // Generate the options for the department dropdown
        data.forEach(dept => {
          const option = document.createElement("option");
          option.value = dept;
          option.text = dept;
          deptDropdown.add(option);
        });
      })
      .catch(error => console.log(error));
  });

  // Event listener for department dropdown
  deptDropdown.addEventListener("change", () => {
    // Clear previous options in semester dropdown
    semDropdown.innerHTML = '<option value="" selected>Select the Semester</option>';

    // Get the selected course and department
    const selectedCourse = courseDropdown.value;
    const selectedDept = deptDropdown.value;

    // Fetch the semester options based on the selected course and department
    fetch(`get_sems.php?course=${selectedCourse}&dept=${selectedDept}`)
      .then(response => response.json())
      .then(data => {
        // Generate the options for the semester dropdown
        data.forEach(sem => {
          const option = document.createElement("option");
          option.value = sem;
          option.text = sem;
          semDropdown.add(option);
        });
      })
      .catch(error => console.log(error));
  });
</script>
<!-- <script>
      // clear form history
      if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
      }
    </script> -->

</html>