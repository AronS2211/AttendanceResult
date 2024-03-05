<?php include('../../includes/config.php'); ?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../assets/img/gcoe_logo.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../assets/css/anydata.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- <link rel="stylesheet" href="../Includes/Styles.css"> -->

    <style>
        #attendance {
            background-color: var(--pri);
        }

        body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        padding: 0px;
    }

    .table-container {
        max-height: 340px;
        overflow-y: auto;
        width: 55%;
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0 auto;
        /* Added to center the container horizontally */
    }

    .centered {
        text-align: center;
    }

    .table-body {
        padding: 2px;
        background-color: #b0529f;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .dbresult tr:nth-child(odd) {
        background-color: #ffe2e2;
    }

    .dbresult tr:nth-child(even) {
        background-color: #ffe2e2;
    }

    .table-responsive:hover {
        transform: scale(1.05);
    }

    .container {
        width: 55%;
        margin: 0 auto;
        text-align: center;
        padding-top: 5px;
        background-color: #470A52;
    }

    .centered div {
        display: inline-block;
        display: flex;
        width: 167px;
    }

    select,
    input {
        display: block;
        font-size: 16px;
        width: -webkit-fill-available;
        margin-bottom: 0;
        /* margin-right: -20px; */
        margin-left: 7px;
        padding: 0px;
        border-radius: 5px;
        border-width: 1px !important;
        border-style: solid !important;
        border-color: rgb(204, 204, 204) !important;
        border-image: initial !important;
    }

    input[type="checkbox"],
    input[type="radio"] {
        line-height: normal;
        margin: 0 3px 5px;
    }

    .dbresult,
    .dbresult td,
    .dbresult th {
        border: 1px solid #470A52;
        border-collapse: collapse;
        padding: 6px;
    }

    .table-container::-webkit-scrollbar {
        display: none;
    }

    .button {
        width: 60px;
    }

    .dbresult {
        border-collapse: collapse;
        width: 100%;
        table-layout: fixed;
    }

    .dbresult th,
    .dbresult td {
        border: 1px solid #470A52;
        padding: 3px;
        text-align: center;
    }

    .dbresult thead th {
        position: sticky;
        top: 0;
        text-align: center;
        background-color: 470A52;
    }

    .post-head {
        width: 55%;
        margin: 0 auto;
        border-collapse: collapse;
        margin-top: 10px;
        margin-bottom: 17px;
    }

    .post-head td {
        border: 1px solid #639cd9;
        padding: 8px;
        text-align: left;
    }

    center {
        text-align: center;
    }

    /* input[type=checkbox],
    input[type=radio] {
        margin: 0px 0 0;
        margin-top: 1px\9;
        line-height: normal;
    } */

    html {
        overflow: scroll;
        overflow-x: hidden;
    }

    ::-webkit-scrollbar {
        width: 0;
        background: transparent;
    }

    .table-responsive {
        padding: 2px;
        background-color: #639cd9;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    @keyframes bounce-in {
        0% {
            transform: scale(0);
            opacity: 0;
        }

        50% {
            transform: scale(1.2);
        }

        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    </style>
</head>

<body>
    <?php include('../../includes/header.php'); ?>
    <?php // include('../Includes/Header.php') ?>
    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Attendance Posting</h3>
                        <div>
                            <a href="../../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <?php $log_id = $_SESSION['user_id']; // Store user ID in session (temp ) and use in all files 
                    //for Fetching faculty details into session on login
                    $sql1 = "SELECT * FROM `erp_faculty` where f_id='$log_id';";
                    $result1 = mysqli_query($conn, $sql1);
                    if (!$result1) {
                        die('Query failed: ' . mysqli_error($conn));
                    }
                    $row = mysqli_fetch_assoc($result1);
                    $ClassIdFromFaculty = $row['cls_id']; ?>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'></h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>
                    <!-- ur content -->
                    
                        <table class="post-head">
                            <tr>
                                <td>
                                    <?php
                                    function dateHeader()
                                    {
                                        if (isset($_POST['date'])) {
                                            $date = $_POST['date'];
                                            echo "Date: " . $date;
                                        }
                                        return $date;
                                        $date = date("d-M-Y ");
                                        echo "Date: " . $date;
                                        return $date;
                                    }
                                    $date = dateHeader();

                                    ?>
                                </td>
                                <td>
                                    <?php echo "Course: " . $_POST['Course']; ?>
                                </td>
                                <td>
                                    <?php echo "Semester: " . $_POST['Semester']; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo "Department: " . $_POST['Department']; ?>
                                </td>
                                <td>
                                    <?php echo "Period: " . $_POST['Period']; ?>
                                </td>
                                <td>
                                    <?php echo "Subject: " . $_POST['Subject']; ?>
                                </td>
                            </tr>
                        </table>
                    </center>
                    <form action="PostPage.php" method="post">
                        <input type="hidden" name="Date" value="<?php echo $date; ?>">
                        <input type="hidden" name="Course" value="<?php echo $_POST['Course']; ?>">
                        <input type="hidden" name="Department" value="<?php echo $_POST['Department']; ?>">
                        <input type="hidden" name="Semester" value="<?php echo $_POST['Semester']; ?>">
                        <input type="hidden" name="Period" value="<?php echo $_POST['Period']; ?>">
                        <input type="hidden" name="Subject" value="<?php echo $_POST['Subject']; ?>">

                        <?php
                        // $ClassId = $_SESSION['FacultyDetails']['cls_id'];
                        $query = "SELECT * FROM erp_student WHERE cls_id='$ClassIdFromFaculty'";
                        $result = mysqli_query($conn, $query);
                        $numrow = mysqli_num_rows($result);
                        if ($numrow > 0) {
                            echo '<div class="table-container">';
                            echo '<table class="dbresult" id="attendanceTable">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th style="width: 50px;">Sl.No</th>';
                            echo '<th>Name</th>';
                            echo '<th>Reg No.</th>';
                            echo '<th>Status</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            $i = 1; // Start index from 1

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '<tr>';
                                echo '<td>', $i, '</td>';
                                echo '<td>', $row['stu_fname'] . ' ' . $row['stu_lname'], '<input type="hidden" name="attendanceRecords[' . $i . '][name]" value="' . $row['stu_fname'] . ' ' . $row['stu_lname'] . '"></td>';
                                echo '<td>', $row['stu_id'], '<input type="hidden" name="attendanceRecords[' . $i . '][regno]" value="' . $row['stu_id'] . '"></td>';
                                echo '<td class="centered">
                   <div> <input type="radio" class="presentstd" id="pre' . $i . '" name="attendanceRecords[' . $i . '][status]" value="P" checked>Present
                    <input type="radio" class="absentstd" id="abs' . $i . '" name="attendanceRecords[' . $i . '][status]" value="A">Absent
               <select id="sel' . $i . '" name="attendanceRecords[' . $i . '][dropdown]" style="display:none">
                  <option value="">Choose</option>
                  <option value="od">On-Duty</option>
                  <option value="absent">Absent</option> 
                  <option value="absent">Late</option> 
                </select></div> 
            </td>';

                                echo '</tr>';
                                $i++;
                            }

                            echo '</tbody>';
                            echo '</table>';
                            echo '</div>';
                        } else {
                            echo 'Record Not found';
                        }
                        echo '
     <div id="absentStudentsBox">
         <h5><b>Absent Students</b></h5>
         <ul id="absentStudentsList"></ul>
     </div>';
                        ?>
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                let radios = document.querySelectorAll('[name^="attendanceRecords["][name$="[status]"]');
                                radios.forEach(function(radio) {
                                    radio.addEventListener('change', function() {
                                        updateAbsentList();
                                    });
                                });

                                function updateAbsentList() {
                                    let list = document.getElementById('absentStudentsList');
                                    list.innerHTML = ''; // Clear the list

                                    radios.forEach(function(radio) {
                                        if (radio.value == 'A' && radio.checked) {
                                            let name = radio.closest('tr').querySelector(
                                                '[name^="attendanceRecords["][name$="[name]"]').value;
                                            let li = document.createElement('li');
                                            li.textContent = name;
                                            list.appendChild(li);
                                        }
                                    });
                                }
                            });
                        </script>
                        <?php
                        $j = 0; //Hide & show checkbox in attendance absent
                        while ($j < $i) {

                        ?>
                            <script>
                                $(document).ready(function() {
                                    $("#abs<?php echo $j; ?>").click(function() {
                                        console.log("1");
                                        $("#sel<?php echo $j; ?>").show(); //dropdown
                                    });
                                    $("#pre<?php echo $j; ?>").click(function() {
                                        $("#sel<?php echo $j; ?>").hide(); //dropdown
                                    });
                                });
                            </script>
                        <?php
                            $j++;
                        } ?>
                        <div>
                            <center>
                                <input type="submit" name="save" value="Save" class="button button4">&emsp;
                                <!-- <button class="button button4">Save as Draft</button>&emsp; -->
                                <button class="button button4" type="reset" value="Reset" onclick="location.reload();">Clear</button>
                            </center>
                        </div>
                    </form>
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

</html>