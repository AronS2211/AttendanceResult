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

    <style>
        #admin_module {
            background-color: var(--pri);
        }
    </style>

</head>

<body>
    <?php include('../../includes/config.php'); ?>
    <?php include('../../includes/header.php'); ?>

    <?php
    $id = $_REQUEST['id'];  //getting id from request
    $semsql = "SELECT * FROM erp_sem WHERE cls_id= '$id' "; // selecting value of the record Query
    $semresult = $conn->query($semsql);  //fetching
    ?>


    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Class Management</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between report-head">
                            <h6 class='mb-0'>Manage Semester</h6>
                            <a href="manageClass.php">Manage Class</a>

                        </div>
                    </div>
                    <!-- ur content -->

                    <div class="TT-type-display">
                        <table class="TT-type-display-table">
                            <thead>
                                <tr>
                                    <th>Department Code</th>
                                    <th>Batch</th>
                                    <th>Course</th>
                                    <th>Department</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $classsql = "SELECT * from erp_class where cls_id= '$id' ";
                                $classresult = $conn->query($classsql);
                                $classrow = mysqli_fetch_assoc($classresult);
                                ?>
                                <tr>
                                    <td><?php echo $classrow['cls_deptcode']; ?></td>
                                    <td><?php echo $classrow['cls_startyr'] . '-' . $classrow['cls_endyr']; ?></td>
                                    <td><?php echo $classrow['cls_course']; ?></td>
                                    <td><?php echo $classrow['cls_dept']; ?></td>
                                </tr>
                            </tbody>
                        </table>
                        <?php

                        if ($semresult == true) {

                            if ($semresult->num_rows > 0) {

                        ?>

                                <table class="TT-type-display-table" id="semdisplay">
                                    <thead>
                                        <th>Semester</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th colspan="3">Manage</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $semrow = mysqli_fetch_all($semresult, MYSQLI_ASSOC);
                                        $semmsg = $semrow;
                                    } else {
                                        $semmsg = "No semester Found";
                                    }

                                    if (is_array($semmsg)) {
                                        foreach ($semmsg as $data) {
                                        ?>
                                            <tr>
                                                <td><?php echo $data['sem_no'] ?? ''; ?></td>
                                                <td><?php echo $data['sem_start'] ?? ''; ?></td>
                                                <td><?php echo $data['sem_end'] ?? ''; ?></td>
                                                <td>
                                                    <button class="btn btn-secondary" onclick="showdate(<?php echo $data['sem_id'] ?? ''; ?>)">Edit End Date</button>
                                                    <form id="edit_date_form<?php echo $data['sem_id'] ?? ''; ?>" method="post" enctype="multipart/form-data" style="display: none;">
                                                        <input type="date" name="date" id="date">
                                                        <input type="text" value="<?php echo $data['sem_id'] ?? ''; ?>" name="semid" id="semid" hidden>
                                                        <button class="btn btn-success" type="submit" name="edit" class="TT-button">submit</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <button class="btn btn-dark" onclick="window.location.href= 'editsem.php?clsid=<?php echo $data['cls_id']; ?>&sem_id=<?php echo $data['sem_id']; ?>'">Edit</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete this item?')) { window.location.href = 'delSem.php?id=<?php echo $data['sem_id']; ?>'; }">Delete</button>
                                                </td>
                                            </tr>
                                <?php
                                        }
                                    }
                                }
                                ?>
                                    </tbody>
                                </table>

                                <div id="Result"></div>
                    </div>
                    <div class="TT-type-display">
                        <button class="btn btn-primary" onclick="show()">Create New Semester</button>
                        <hr>
                        <form id="create_sem" method="post" style="display: none;">

                            <div class="TT-form-content">
                                <input type="hidden" id="clsid" value="<?php echo $id; ?>">
                                <div>
                                    <label for="semester">Semester Number</label>
                                    <input type="number" name="semester" id="semester" value="" min="1" required>
                                </div>
                                <div>
                                    <label for="startdate">Semester Start Date:</label>
                                    <input type="date" id="startdate" value="" required>
                                </div>
                                <div class="TT-form-button">
                                    <button type="submit" name="create" class="TT-button">Create</button>
                                    <button type="reset" class="TT-button">Clear</button>
                                </div>
                            </div>

                        </form>
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
    function showdate(id) {
        var formid = "edit_date_form" + id;
        var type = document.getElementById(formid).style.display;
        if (type == 'none') {
            document.getElementById(formid).style.display = 'flex';
        } else {
            document.getElementById(formid).style.display = 'none';
        }
    }

    function show() {
        var type = document.getElementById('create_sem').style.display;
        if (type == 'none') {
            document.getElementById('create_sem').style.display = 'flex';
        } else {
            document.getElementById('create_sem').style.display = 'none';
        }
    }
</script>

<script>
    $(document).ready(function() {
        $('#create_sem').submit(function(e) {
            e.preventDefault();

            var clsid = $('#clsid').val();
            var semester = $('#semester').val();
            var startdate = $('#startdate').val();
            var operation = 'create';

            // Preparing input values as form data for Ajax call
            var formData = new FormData(this);
            formData.append('clsid', clsid);
            formData.append('semester', semester);
            formData.append('startdate', startdate);
            formData.append('operation', operation);

            setTimeout(function() {
                $.ajax({
                    url: 'upload.php',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log(response);
                        if (response == "OK") {
                            $("#Result").html(`<div class="alert alert-success fade show" role="alert">Created successfully! </div>`);
                        } else {
                            $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                        }
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                });
            }, 2000);
        });


        $(document).on('submit', '[id^=edit_date_form]', function(e) {
            e.preventDefault();

            var operation = 'update';
            var formData = new FormData(this);
            formData.append('operation', operation);

            $.ajax({
                url: 'upload.php',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    console.log(response);
                    if (response == "OK") {
                        $("#Result").html(`<div class="alert alert-success fade show" role="alert"> Updated successfully! </div>`);
                    } else {
                        $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                    }
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            });
        });


    });
</script>

</html>