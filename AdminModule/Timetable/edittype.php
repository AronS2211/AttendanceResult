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


    <!-- <link rel="stylesheet" type="text/css" href="../assets/css/styles_TT.css"> -->
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
                        <h3 class="m-0">Time Table Type</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Edit</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>





                    <div class="TT-type-display" id="TTdisplay2">
                        <?php
                        $status = "";
                        if (isset($_POST['new']) && $_POST['new'] == 1) {
                            $id = $_REQUEST['id'];
                            $type = $_REQUEST['title'];
                            $hours = $_REQUEST['hours'];
                            $update = "update erp_tt_type set type_title='" . $type . "', type_hours='" . $hours . "' where type_id='" . $id . "'";
                            mysqli_query($conn, $update);
                            $status = "Record Updated Successfully.";
                            echo '<p id="status" style="color:#FF0000;">' . $status . '</p>';
                            echo '<script>
                                setTimeout(function() {
                                    document.getElementById("status").style.display = "none";
                                }, 5000); // 5000 milliseconds = 5 seconds
                            </script>';
                        }
                        $id = $_REQUEST['id'];  //getting id from request
                        $sql = "SELECT * FROM erp_tt_type WHERE type_id= $id ";   // selecting value of the record Query
                        $result = $conn->query($sql);  //fetching
                        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        if (is_array($row)) {
                            foreach ($row as $data) {
                        ?>
                    </div>
                    <form method="post" action="#">
                        <div class="TT-form-content">
                            <div><input type="hidden" name="new" value="1" /></div>
                            <div><input name="id" type="hidden" value="<?php echo $data['type_id']; ?>" /></div>
                            <div>
                                <label for="type">Time Table type Name:</label>
                                <input type="text" name="title" placeholder="Enter TimeTable Type" required value="<?php echo $data['type_title']; ?>" />
                            </div>
                            <div>
                                <label for="hours">Total Number of Hours:</label>
                                <input type="text" name="hours" placeholder="Enter Hours" required value="<?php echo $data['type_hours']; ?>" />
                            </div>
                            <div>
                                <input class="TT-button" name="submit" type="submit" value="Update" />
                            </div>

                        </div>
                    </form>
            <?php
                            }
                        } ?>

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