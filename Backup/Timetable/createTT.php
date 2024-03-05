<?php


include('../../includes/config.php');  // <!-- connecting database -->


$courses = array(); //array to store courses
$departments = array(); //array to store departments
$semesters = array(); // array to store semesters
$query = 'SELECT DISTINCT cls_course, cls_deptname FROM erp_class ORDER BY cls_course';
$result = $conn->query($query);
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









<!DOCTYPE html>
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

    <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">

    <link rel="stylesheet" href="../assets/css/anydata.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
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
                        <h3 class="m-0">Create Timetable </h3>
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



                    <!-- form for selecting class -->
                    <form id="TTform3" method="post" action="#">

                        <div class="TT-form-content">
                            <div>
                                <label for="course">Course:</label>
                                <select id="course" name="course" style="width: 300px;" required>
                                    <option value="">---Select a course---</option>
                                    <?php foreach ($courses as $course) : ?>
                                        <option value="<?php echo $course; ?>"><?php echo $course; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <label for="department">Department:</label>
                                <select id="department" name="department" style="width: 300px;" required>
                                    <option value="">---Select a course first---</option>
                                </select>
                            </div>
                            <div>
                                <label for="semester">Semester:</label>
                                <select id="semester" name="semester" style="width: 300px;" required>
                                    <option value="">---Select a course first---</option>
                                </select>
                            </div>
                            <div>
                                <!-- php code  for fetching timetable type for html form -->
                                <?php
                                $sql3 = "select*from erp_tt_type";
                                $result3 = $conn->query($sql3);
                                if ($result3 == true) {
                                    if ($result3->num_rows > 0) {
                                        $row3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);
                                        $msg3 = $row3;
                                    } else {
                                        $msg3 = "No Data Found";
                                    }
                                ?>
                                    <label for="type">Time Table type:</label>
                                    <select name="type" id="type" style="width: 300px;" required>
                                        <option value="">--Time table type--</option>
                                        <?php
                                        if (is_array($msg3)) {
                                            foreach ($msg3 as $data) {
                                        ?>
                                                <option value=" <?php echo $data['type_id']; ?> "><?php echo $data['type_title'] ?? ''; ?> </option>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>
                                    </select>
                                    <!-- timetable type fetched -->
                            </div>
                            <div>
                                <label for="frdate">From Date:</label>
                                <input type="date" name="frdate" id="sc_frdate" required>
                            </div>
                            <div>
                                <label for="todate">To Date:</label>
                                <input type="date" name="todate" id="sc_todate" required>
                            </div>
                            <div class="TT-form-button">
                                <button type="submit" name="create" class="TT-button">Save</button>
                                <button type="reset" class="TT-button">Clear</button>
                            </div>
                        </div>
                    </form>

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


<script>
    // clear form history
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<!-- creating type php code-->
<?php


if (isset($_POST['create'])) {
    //variable declaration and getting value
    $cour = $_POST['course'];
    $dept = $_POST['department'];
    $sem = $_POST['semester'];
    $type = $_POST['type'];
    $frdate = $_POST['frdate'];
    $todate = $_POST['todate'];
    //fetching cls id    
    $sql1 = "select cls_id from erp_class where cls_deptname='$dept' and cls_course = '$cour' and cls_sem = '$sem'";
    $result1 = $conn->query($sql1);
    $row1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);
    foreach ($row1 as $data) {
        $clsid = $data['cls_id'];
    }

    // echo $clsid;
    //insert to schedule table
    $sql2 = "insert into erp_schedule (class_id,type_id,sc_frdate,sc_todate) values ('$clsid','$type','$frdate','$todate')";
    $result2 = $conn->query($sql2);
?>

<?php
    if ($result2 === TRUE) {
        echo '<script>Swal.fire("Time Table successfully Created");</script>';
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }
}
$conn->close();
?>

<!-- creation code ends -->


</html>