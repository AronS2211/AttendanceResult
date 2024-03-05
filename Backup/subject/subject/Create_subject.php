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
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">
  <style>
    #admin_module {
      background-color: var(--pri);
    }
  </style>

  <style>
    .current-day {
      background-color: blueviolet;
      color: white;
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
            <h3 class="m-0">Subject Creation</h3>
            <div>
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

          <form method="POST" action="Create_subject.php">
            <div class="TT-form-content">
              <div>
                <label for="cls_course">Course:</label>
                <select id="cls_course" name="cls_course" required>
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
                <label for="no_sub">No.of Subjects to Insert:</label>
                <input type="text" id="no_sub" name="no_sub" required></input>
              </div>
              <div>
                <input type="submit" value="Submit" name="submit">
              </div>
            </div>
          </form>
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



          <?php


          if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
            // Get the form data
            $cls_course = $_POST['cls_course'];
            $cls_deptname = $_POST['cls_deptname'];
            $cls_sem = $_POST['cls_sem'];
            $no_sub = $_POST['no_sub'];

            // Get the cls_id for the selected department
            $sql = "SELECT cls_id FROM erp_class WHERE cls_deptname = '$cls_deptname' AND cls_sem = '$cls_sem'";
            $result = mysqli_query($conn, $sql);
            if ($result && mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
              $cls_id = $row['cls_id'];

              echo "<form id='myForm' action='insert_sub.php' method='post'>";
              echo "<input type='hidden' name='cls_id' value='" . $cls_id . "'>";
              echo "<table>";
              echo "<tr><th>Subject Code</th><th>Subject Name</th><th>Subject Credits</th><th>Subject Type</th></tr>";

              for ($i = 1; $i <= $no_sub; $i++) {
                echo "<tr>";
                echo "<td><input type='text' name='tt_subcode[]' required></td>";
                echo "<td><input type='text' name='sub_name[]' required></td>";
                echo "<td><input type='text' name='sub_credit[]' required></td>";
                echo "<td><select name='sub_type[]' required>";
                echo "<option value=''>Select the Type</option>";
                echo "<option value='Core'>Core</option>";
                echo "<option value='Elective'>Elective</option>";
                echo "<option value='Laboratory'>Laboratory</option>";
                echo "<option value='Others'>Others</option>";
                echo "</select></td>";
                echo "</tr>";
              }

              echo "</table>";
              echo "<input type='submit' name='submit' value='Create Subjects' disabled>";
              echo "</form>";
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
  const form = document.getElementById('myForm');
  const submitBtn = form.querySelector('input[type="submit"]');

  // Listen for input changes on the form
  form.addEventListener('input', () => {
    // Check if all required fields have been filled in
    const requiredFields = form.querySelectorAll('[required]');
    const isFormValid = Array.from(requiredFields).every(field => field.value !== '');

    // Enable/disable the submit button accordingly
    submitBtn.disabled = !isFormValid;
  });

  window.onload = function() {
    var form = document.getElementById("myForm");
    form.addEventListener("submit", function(event) {
      var subTypes = document.getElementsByName("sub_type[]");
      for (var i = 0; i < subTypes.length; i++) {
        if (subTypes[i].value == "") {
          Swal.fire("Please select a subject type for all subjects.");
          event.preventDefault();
          return false;
        }
      }
      return true;
    });
  }
</script>

</html>