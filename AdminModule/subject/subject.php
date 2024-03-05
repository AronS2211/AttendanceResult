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

    <?php

    error_reporting(0);
    $courses = array(); //array to store courses
    $departments = array(); //array to store departments
    $semesters = array(); // array to store semesters
    $cour_dept_query = 'SELECT DISTINCT cls_course, cls_deptname FROM erp_class ORDER BY cls_course';
    $result = $conn->query($cour_dept_query);
    while ($row = mysqli_fetch_assoc($result)) {
        $course = $row['cls_course'];
        $department = $row['cls_deptname'];
        if (!in_array($course, $courses)) {
            $courses[] = $course;
        }
        if (!isset($departments[$course])) {
            $departments[$course] = array();
        }
        $departments[$course][] = $department;
    }


    $query1 = 'SELECT DISTINCT cls_course, cls_sem FROM erp_class ORDER BY cls_course';
    $result1 = $conn->query($query1);
    while ($row = mysqli_fetch_assoc($result1)) {
        $course = $row['cls_course'];
        $semester = $row['cls_sem'];
        if (!in_array($course, $courses)) {
            $courses[] = $course;
        }
        if (!isset($semesters[$course])) {
            $semesters[$course] = array();
        }
        $semesters[$course][] = $semester;
    }

    ?>

    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 mt-3 mb-5">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Subject Management</h3>
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

                    <!-- form for selecting class -->
                    <form id="TTform5" method="post" action="#">

                        <div class="TT-form-content">
                            <div>
                                <label class="TT-label" for="course">Course:</label>
                                <select id="course" name="course" style="width: 300px;" required>
                                    <option value="">---Select a course---</option>
                                    <?php foreach ($courses as $course) : ?>
                                        <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label class="TT-label" for="department">Department:</label>
                                <select id="department" name="department" style="width: 300px;" required>
                                    <option value="">---Select a course first---</option>
                                </select>
                            </div>
                            <div>
                                <label class="TT-label" for="semester">Semester:</label>
                                <select id="semester" name="semester" style="width: 300px;" required>
                                    <option value="">---Select a course first---</option>
                                </select>
                            </div>
                            <div class="TT-form-button">
                                <button type="submit" name="search" class="TT-button">Search</button>
                                <button type="reset" class="TT-button">Clear</button>
                            </div>
                        </div>
                    </form>



                    <?php

                    if (isset($_POST['search'])) {
                        $cour = $_POST['course'];
                        $dept = $_POST['department'];
                        $sem = $_POST['semester'];
                    ?>

                        <div class="card-header border-top">
                            <div class="d-flex flex-row justify-content-between">
                                <h6 class='mb-0'><?php echo $cour . ' ' . $dept . ' semester ' . $sem ?></h6>
                            </div>
                        </div>



                        <div class="TT-type-display">
                            <?php

                            $query2 = "select cls_id from erp_class where cls_deptname='$dept' and cls_course = '$cour' and cls_sem = '$sem'";
                            $result2 = $conn->query($query2);
                            $row2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);
                            foreach ($row2 as $data) {
                                $clsid = $data['cls_id'];
                            }
                            $sub_query = "SELECT * FROM erp_subject WHERE cls_id= $clsid ";
                            $sub_result = $conn->query($sub_query);
                            if (mysqli_num_rows($sub_result) > 0) {
                            ?>

                                <table class="TT-type-display-table">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Subject</th>
                                            <th>Faculty</th>
                                            <th>Manage</th>
                                        </tr>
                                    </thead>

                                    <?php

                                    // Display the subject
                                    $i = 1;
                                    while ($sub_row = mysqli_fetch_assoc($sub_result)) {

                                        if ($sub_row['f_id'] == "") {
                                    ?>

                                            <tbody>
                                                <tr>
                                                    <form method='post' action='suballocscript.php' id='updateform'>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $sub_row['tt_subcode'] . '-' . $sub_row['sub_name']; ?></td>
                                                        <?php
                                                        $faculty_query = "SELECT f_id,f_fname,f_lname,f_designation FROM erp_faculty  ORDER BY f_fname ASC";
                                                        $faculty_result = mysqli_query($conn, $faculty_query);
                                                        ?>
                                                        <td>
                                                            <select name='f_id' required>
                                                                <option value="">Not Assigned</option>
                                                                <?php
                                                                while ($faculty_row = mysqli_fetch_assoc($faculty_result)) {
                                                                ?>
                                                                    <option value=<?php echo $faculty_row["f_id"]; ?>><?php echo $faculty_row['f_fname'] . '  ' . $faculty_row['f_lname'] . ',' . $faculty_row['f_designation'] ?></option>
                                                                <?php
                                                                }
                                                                ?>
                                                            </select>
                                                        </td>
                                                        <td>

                                                            <input type="hidden" name="course" value='<?php echo $cour; ?>'>
                                                            <input type="hidden" name="department" value='<?php echo $dept; ?>'>
                                                            <input type="hidden" name="semester" value='<?php echo $sem; ?>'>
                                                            <input type='hidden' name='sub_id' id="recordId" value='<?php echo $sub_row['sub_id']; ?>'>
                                                            <input type='submit' name='add' value='Assign'>

                                                        </td>
                                                    </form>
                                                </tr>
                                            </tbody>
                                        <?php
                                        } else {
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $sub_row['tt_subcode'] . '-' . $sub_row['sub_name']; ?></td>
                                                    <?php
                                                    $faculty_query = "SELECT f_fname,f_lname,f_designation FROM erp_faculty Where f_id= '" . $sub_row['f_id'] . "'";
                                                    $faculty_result = mysqli_query($conn, $faculty_query);
                                                    $faculty_row = mysqli_fetch_assoc($faculty_result);
                                                    ?>
                                                    <td><?php echo $faculty_row['f_fname'] . '  ' . $faculty_row['f_lname'] . ',' . $faculty_row['f_designation'] ?></td>
                                                    <!-- // Display the update button -->
                                                    <td>
                                                        <form method='post' action='facultysubupdate.php' id='updateform'>
                                                            <input type="hidden" name="course" value='<?php echo $cour; ?>'>
                                                            <input type="hidden" name="department" value='<?php echo $dept; ?>'>
                                                            <input type="hidden" name="semester" value='<?php echo $sem; ?>'>
                                                            <input type="hidden" name="subcode" value='<?php echo $sub_row['tt_subcode']; ?>'>
                                                            <input type="hidden" name="subname" value='<?php echo $sub_row['sub_name']; ?>'>
                                                            <input type="hidden" name="faculty" value='<?php echo $faculty_row['f_fname'] . '  ' . $faculty_row['f_lname'] . ',' . $faculty_row['f_designation'] ?>'>
                                                            <input type='hidden' name='sub_id' id="recordId" value='<?php echo $sub_row['sub_id']; ?>'>
                                                            <input type='submit' name='update' value='Update'>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                    <?php
                                        }
                                        $i++;
                                    }
                                    ?>
                                </table>
                        <?php

                            } else {
                                echo 'Please Create Subjects First';
                            }
                        }

                        ?>
                        </div>

                        <!-- end of display -->

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


<script type="text/javascript">
    var departments = <?php echo json_encode($departments); ?>;
    var semesters = <?php echo json_encode($semesters); ?>;
    document.getElementById('course').addEventListener('change', function() {
        var course = this.value;
        var departmentSelect = document.getElementById('department');
        var semesterSelect = document.getElementById('semester');
        // Remove existing options
        while (departmentSelect.firstChild) {
            departmentSelect.removeChild(departmentSelect.firstChild);
        }
        while (semesterSelect.firstChild) {
            semesterSelect.removeChild(semesterSelect.firstChild);
        }
        // Add default option
        var defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.innerHTML = 'Select a department';
        departmentSelect.appendChild(defaultOption);

        var defaultOption = document.createElement('option');
        defaultOption.value = '';
        defaultOption.innerHTML = 'Select a semester';
        semesterSelect.appendChild(defaultOption);

        // Add options based on the selected course
        if (departments.hasOwnProperty(course)) {
            departments[course].forEach(function(department) {
                var option = document.createElement('option');
                option.value = department;
                option.innerHTML = department;
                departmentSelect.appendChild(option);
            });
        }

        if (semesters.hasOwnProperty(course)) {
            semesters[course].forEach(function(semester) {
                var option = document.createElement('option');
                option.value = semester;
                option.innerHTML = semester;
                semesterSelect.appendChild(option);
            });
        }

    });
</script>

</html>