<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../assets/img/gcoe_logo.png">
    <style>
    #profile {
        background-color: var(--pri);
    }

    form {
        padding: 25px;
        border-radius: 5px;
        display: flex;
        flex-direction: column;
        width: max-content;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
    }

    label {
        margin-bottom: 8px;
        font-family: EL;
        width: 200px;
    }

    select,
    option {
        font-family: EL !important;
        width: 200px;
    }

    input {
        padding: 8px;
        margin-bottom: 16px !important;
        border: 2px solid var(--dark);
        border-radius: 5px;
        ;
    }

    .alert h5 {
        margin: 0px;
        font-family: EL;
    }

    form button {
        padding: 10px;
        background-color: var(--dark);
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: fit-content;
        border-radius: 5px !important;
        box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
        align-self: end;
    }

    form button:hover {
        background-color: var(--pri);
    }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

</head>

<body>
    <?php include('../includes/config.php'); ?>
    <?php include('../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../includes/sidebar.php'); ?>
        <main>
            <div class="container pt-4 d-flex flex-column justify-content-center">
                <div class="d-flex justify-content-end">
                    <?php
                    if ($_SESSION['upload_sts'] == 1) {
                        ?>
                    <div class="alert alert-success alert-dismissible fade show w-50" role="alert">
                        <h6>
                            <?php echo $_SESSION['message']; ?>
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    } elseif ($_SESSION['upload_sts'] == 0) {
                        ?>
                    <div class="alert alert-danger alert-dismissible fade show w-50" role="alert">
                        <h6>
                            <?php echo $_SESSION['message']; ?>
                        </h6>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    }
                    $_SESSION['message'] = '';
                    $_SESSION['upload_sts'] = '';
                    ?>
                </div>
                <div class="d-flex flex-column align-items-center align-content-center">
                    <form action="studentUpload.php" method="post" enctype="multipart/form-data">
                        <h2>Student Bulk Upload</h2>
                        <div class="item">
                            <label>Course </label>
                            <?php
                            $s = mysqli_query($con, "select distinct cls_course from erp_class where cls_startyr<=" . date('Y') . "<=cls_endyr");
                            ?>
                            <select name='deptc' id="course">
                                <option value="" selected disabled hidden>--Select--</option>
                                <?php
                                $course1 = $_GET['deptc'];
                                while ($r = mysqli_fetch_array($s)) {
                                    ?>
                                <option value="<?php echo $r['cls_course']; ?>">
                                    <?php echo $r['cls_course']; ?>
                                </option>
                                <?php
                                    if (isset($_POST['deptc'])) {
                                        ?>
                                <option selected value=" <?php echo $_POST['deptc']; ?>">
                                    <?php echo $_POST['deptc']; ?>
                                </option>
                                <?php
                                    }
                                    ?>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="item">
                            <label>Department:</label>
                            <select name='deptn' id="dept">
                                <option value="none" selected disabled hidden>--Select--</option>
                                <?php
                                if (isset($_POST['deptn'])) {
                                    ?>
                                <option selected value="<?php echo $_POST['deptn']; ?>">
                                    <?php echo $_POST['deptn']; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="item">
                            <label> Semester: </label>
                            <select name='depts' id='sem'>
                                <option value="none" selected disabled hidden>--Select--</option>
                                <?php
                                if (isset($_POST['depts'])) {
                                    ?>
                                <option selected value="<?php echo $_POST['depts']; ?>">
                                    <?php echo $_POST['depts']; ?>
                                </option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <input type="hidden" name="clsid" id='clsid' value="" required>

                        <label>Excel File (.csv/.xls/.xlsx) :</label>
                        <input type="file" name="import_file" required>

                        <button name="save_excel_data" type="submit">Import</button>
                    </form>
                </div>
            </div>
        </main>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
<script src="../assets/js/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<script>
$('#course').on('change', function() {
    var cls_id = this.value;
    $.ajax({
        url: 'ajax/course.php',
        type: "POST",
        data: {
            c: cls_id
        },
        success: function(result) {
            $('#dept').html(result);
        }
    })
});
$('#dept').on('change', function() {
    var c = this.options[this.selectedIndex].getAttribute("course");
    var d = this.options[this.selectedIndex].getAttribute("dept");
    $.ajax({
        url: 'ajax/dept.php',
        type: "POST",
        data: {
            c: c,
            d: d
        },
        success: function(result) {
            $('#sem').html(result);
        }
    })
});
$('#sem').on('change', function() {
    var c = this.options[this.selectedIndex].getAttribute("course");
    var d = this.options[this.selectedIndex].getAttribute("dept");
    var s = this.options[this.selectedIndex].getAttribute("sem");
    $.ajax({
        url: 'ajax/sem.php',
        type: "POST",
        data: {
            c: c,
            d: d,
            s: s
        },
        success: function(result) {
            $('#clsid').val(result);
        }
    })
});
</script>

</html>