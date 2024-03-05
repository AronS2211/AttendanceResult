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
              <h6 class='mb-0'>Schedule</h6>
              <h6 class='mb-0'></h6>
            </div>
          </div>
          <!-- ur content -->



          <form method="POST" action='Createexam.php' id="createexamform">
            <div class="TT-form-content">

              <div>
                <label for="test_name">Select a test:</label>
                <select name="test_name" id="test_name" onchange="setSelectedTest()" ;>
                  <option value="" selected>Select the Test</option>
                  <?php


                  // Fetch test names from the database
                  $sql = "SELECT DISTINCT test_name FROM erp_test WHERE test_ce_type = 'academic' OR test_ce_type = 'university';";
                  $result = $conn->query($sql);

                  // Create a drop-down list of test names
                  $options = "";
                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      $options .= "<option value='" . $row['test_name'] . "'>" . $row['test_name'] . "</option>";
                    }
                  }


                  echo $options;
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
                <select id="cls_deptname" name="cls_deptname">
                  <option value="" selected>Select the Department</option>
                </select>
              </div>
              <div>
                <label for="cls_sem">Semester:</label>
                <select id="cls_sem" name="cls_sem">
                  <option value="" selected>Select the Semester</option>
                </select>
              </div>
              <div>
                <label>Exam Type:</label>
                <input type="radio" name="ce_type" id="academic" style="display:inline-block;margin-left:1px;" value="academic" required>Academic
                <input type="radio" name="ce_type" id="university" style="display:inline-block;margin-left:1px;" value="university">University

              </div>
              <div>
                <label for="ce_sdate">Start Date:</label>
                <input type="date" id="ce_sdate" name="ce_sdate" value="<?php echo isset($_POST['ce_sdate']) ? $_POST['ce_sdate'] : ''; ?>" required>
              </div>
              <div>
                <label for="ce_edate">End Date:</label>
                <input type="date" id="ce_edate" name="ce_edate" value="<?php echo isset($_POST['ce_edate']) ? $_POST['ce_edate'] : ''; ?>" required>
              </div>
              <div>
                <input type="submit" value="Submit" name="submit">
              </div>

            </div>
          </form>





          <!-- Container for PHP code after form submission -->
          <div id="phpCodeSection"  class="d-flex justify-content-around">
            <?php


            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {


              echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
          var phpCodeSection = document.getElementById('phpCodeSection');
          if (phpCodeSection) {
            phpCodeSection.scrollIntoView({
              behavior: 'smooth',
              block: 'start'
            });
          }
        });
      </script>";

              // Get the form data
              $cls_deptname = $_POST['cls_deptname'];
              $cls_course = $_POST['cls_course'];
              $ce_sdate = $_POST['ce_sdate'];
              $ce_edate = $_POST['ce_edate'];
              $cls_sem = $_POST['cls_sem'];
              $ce_exam = $_POST['test_name'];
              $ce_type = $_POST['ce_type'];


              // Get the cls_id for the selected department
              $sql = "SELECT cls_id FROM erp_class WHERE cls_deptname = '$cls_deptname' AND cls_sem = '$cls_sem'";
              $result = mysqli_query($conn, $sql);
              if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $cls_id = $row['cls_id'];

                // Get the subject details for the selected department
                $sql = "SELECT sub_name, tt_subcode FROM erp_subject WHERE cls_id = '$cls_id'";
                $result = mysqli_query($conn, $sql);

                if ($result && mysqli_num_rows($result) > 0) {
                  echo "<form id='schedule' action='insert_exam.php' method='post' onsubmit='return validateDates()'>";
                  echo "<input type='hidden' name='ce_exam' value='" . $ce_exam . "'>";
                  echo "<input type='hidden' name='ce_type' value='" . $ce_type . "'>";
                  echo "<input type='hidden' name='cls_id' value='" . $cls_id . "'>";
                  echo "<input type='hidden' name='ce_sdate' value='" . $ce_sdate . "'>";
                  echo "<input type='hidden' name='ce_edate' value='" . $ce_edate . "'>";

                  echo "<table>";
                  echo "<tr><th>Subject Name</th><th>Subject Code</th><th>Date Of Examination</th></tr>";
                  echo "<tr><td></td><td></td><td><span>*check the box to exclude</span></td></tr>";
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>" . $row['sub_name'] . "</td><td>" . $row['tt_subcode'] . "</td>";
                    echo "<input type='hidden' name='tt_subcode[]' value='" . $row['tt_subcode'] . "'>";
                    echo "<td><input type='date' name='exam_date[]' min='" . $ce_sdate . "' max='" . $ce_edate . "'></td>";
                    echo "<td><input type='checkbox' name='exclude_exam[]'></td>";
                    echo "</tr>";
                  }

                  echo "</table>";
                  echo "<input type='submit' name='submit' value='Create Exam'>";
                  echo "</form>";
                }
              } else {
                echo "No subjects found for the selected department.";
              }
            }
            ?>

          </div>
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



  function validateDates() {
    var examDates = document.getElementsByName("exam_date[]");
    var excludeExams = document.getElementsByName("exclude_exam[]");

    for (var i = 0; i < examDates.length; i++) {
      // If the checkbox is checked, skip validation for this row
      if (excludeExams[i].checked) {
        examDates[i].value = "";
        continue;
      }

      if (examDates[i].value == "") {
        Swal.fire("Please enter all exam dates.");
        return false;
      }
    }
    return true;
  }
</script>
<!-- 
<script>
  // clear form history
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }
</script> -->

</html>