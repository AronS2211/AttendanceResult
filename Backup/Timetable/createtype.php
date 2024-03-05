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
    <style>
        #admin_module {
            background-color: var(--pri);
        }
    </style>


    <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css">
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function show() {
            var type = document.getElementById('type').value;
            if (type == 'others') {
                document.getElementById('typename').style.display = 'flex';
            } else {
                document.getElementById('typename').style.display = 'none';
            }
        }
    </script>
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
                        <h3 class="m-0">Create Time Table Type</h3>
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
                    <!-- html form -->


                    <form id="TTform2" method="post" action="#">

                        <div class="TT-form-content">
                            <div><label for="type">Timetable Type Name:</label>
                                <select name="type" id="type" onchange="show()">
                                    <option value="">--select Type</option>
                                    <option value="General Timetable">General Timetable</option>
                                    <option value="MBA Timetable">MBA Timetable</option>
                                    <option value="Special Timetable">Special Timetable</option>
                                    <option value="others">Others</option>
                                </select>
                            </div>
                            <div id="typename" style="display: none;">
                                <label for="typename">Other Type Name:</label>
                                <input type="text" name="typename">
                            </div>
                            <div><label for="hours">Number of Hours per day:</label>
                                <input type="text" name="hours" value="" required>
                            </div>

                            <div>
                                <button type="submit" name="create" class="TT-button">Create</button>
                                <button type="reset" class="TT-button">Clear</button>
                            </div>
                        </div>
                    </form>
                    <!-- html form end -->
                </div>
            </div>

        </main>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
<!-- creating type php code-->
<?php


if (isset($_POST['create'])) {
    //variable declaration
    $type = $_POST['type'];
    $hours = $_POST['hours'];

    if ($type === "others") {
        $type = $_POST['typename'];
    }

    $selectsql = "select * from erp_tt_type where type_title = '$type'";

    $selectresult = mysqli_query($conn, $selectsql);

    if ($selectresult->num_rows  > 0) {
        echo '<script>Swal.fire("Time Table type Already Exist !");</script>';
    } else {

        $sql = "insert into erp_tt_type (type_title,type_hours) values('$type','$hours')";
        $result = $conn->query($sql);
?>
        <script>
            document.getElementById("TTform2").reset();
        </script>
<?php
        if ($result === TRUE) {
            echo '<script>Swal.fire("Time Table type successfully Created");</script>';
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>

<!-- creation code ends -->



<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>


<script src="../../assets/js/script.js"></script>
<script src="../assets/js/anydata.js"></script>
<script src="../assets/js/script.js"></script>

</html>