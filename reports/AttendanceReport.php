<?php

session_start();

if (isset($_SESSION['user_id'])) {

    include('../includes/config.php');


?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Attendance Report</title>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            body {
                font-family: Arial, sans-serif;
                position: relative;
                left: 100px;
                width: calc(100% - 100px);
            }

            label {
                font-weight: bold;
                margin-right: 10px;
            }

            select,
            input[type="date"],
            button {
                padding: 8px;
                margin: 5px;
                border: 1px solid #ccc;
                border-radius: 4px;
            }

            select {
                width: 200px;
            }

            button {
                background-color: #007bff;
                color: white;
                cursor: pointer;
            }

            .form {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }

            /* Style for the student table */
            #studentTable {
                margin-top: 20px;
                border-collapse: collapse;
                width: 100%;
            }

            #studentTable th,
            #studentTable td {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 1px;
                border-collapse: collapse;
            }

            #studentTable th {
                background-color: #f2f2f2;
            }

            button:hover {
                background-color: #0056b3;
            }

            #studentTable {
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <h1 style="text-align: center;">Attendance Report Generation</h1>
        <div class="form">
            <div><label>Course </label>
                <?php

                $year = date("Y");
                $s = mysqli_query($conn, "select distinct cls_course from erp_class where cls_startyr<'$year'<cls_startyr");
                ?>

                <!-- Dynamic data -->
                <select name='course' id="course">
                    <option value="" selected disabled hidden>--Select--</option>
                    <?php
                    $course1 = $_GET['course'];
                    while ($r = mysqli_fetch_array($s)) {
                    ?>
                        <option value="<?php echo $r['cls_course']; ?>">
                            <?php echo $r['cls_course']; ?>
                        </option>
                        <?php
                        if (isset($_POST['course'])) {
                        ?>
                            <option selected value="<?php echo $_POST['course']; ?>">
                                <?php echo $_POST['course']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </select>

                <label>Department:</label>
                <select name='department' id="department">
                    <option value="none" selected disabled hidden>--Select--</option>
                    <?php
                    if (isset($_POST['department'])) {
                    ?>
                        <option selected value="<?php echo $_POST['department']; ?>">
                            <?php echo $_POST['department']; ?>
                        </option>
                    <?php
                    }
                    ?>
                </select>



                <b><label> Semester: </label></b>
                <select name='semester' id='semester'>
                    <option value="none" selected disabled hidden>--Select--</option>
                </select>
            </div>
            <div>
                <b><label> Starting Date: </label></b>
                <input type="date" name="strdate" id="strdate">
                <b><label> Ending Date: </label></b>
                <input type="date" name="enddate" id="enddate">
                <button id="fetchStudents">Generate Report</button>
            </div>
        </div>
        <div id="studentTable"></div>

        </div>

        <script>
            //for selecting  dpt 
            $('#course').on('change', function() {
                var cls_id = this.value;
                // console.log(country_id);
                $.ajax({ 
                    url: 'ajax/getdept.php',
                    type: "POST",
                    data: {
                        c: cls_id
                    },
                    success: function(result) {
                        $('#department').html(result);
                    }
                })
            });
            //for selecting semester
            $('#department').on('change', function() {
                var selectedOption = $(this).find(":selected");
                var selectedCourse = selectedOption.attr("course");
                var selectedDepartment = selectedOption.attr("dept");
                $.ajax({
                    url: 'ajax/getsemester.php',
                    type: "POST",
                    data: {
                        c: selectedCourse,
                        d: selectedDepartment
                    },
                    success: function(result) {
                        console.log(result); // Check the output in the browser console
                        $('#semester').html(result);
                    }
                });
            });

            // Fetch students on button click
            $('#fetchStudents').click(function() {
                var selectedCourse = $('#course').val();
                var selectedDepartment = $('#department').val();
                var selectedSemester = $('#semester').val();
                var strdate = $('#strdate').val();
                var enddate = $('#enddate').val();

                if (selectedCourse && selectedDepartment && selectedSemester) {
                    // AJAX call to fetch student data based on selections
                    $.ajax({
                        type: "POST",
                        url: "fetch_students.php",
                        data: {
                            course: selectedCourse,
                            department: selectedDepartment,
                            semester: selectedSemester,
                            strdate: strdate,
                            enddate: enddate
                        },
                        success: function(response) {
                            $('#studentTable').html(response);
                        }
                    });
                }
            });
        </script>
    </body>

    </html>
<?php
} else {
    header("Location: ../index.php");
}
?>