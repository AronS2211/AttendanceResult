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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.5/dist/sweetalert2.all.min.js"></script>

    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../assets/css/anydata.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="/attendance/Includes/style.css">

    <style>
        #result {
            background-color: var(--pri);
        }

        .table-container {
            max-height: 265px;
            overflow-y: auto;
            overflow-x: hidden;
            /* width: 58%; */
            margin: 0 auto;
        }

        .table-container::-webkit-scrollbar {
            display: none;
        }

        .dbresult {
            border-collapse: collapse;
            /* width: 105%; */
            table-layout: fixed;
        }

        .dbresult th,
        .dbresult td {
            border: 1px solid #dddddd;
            text-align: center;
        }

        .dbresult thead th {
            position: sticky;
            top: 0;
            background-color: 33A5FF;
        }

        .post-head {
            width: 58%;
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
    </style>
    <style>
        html {
            overflow: scroll;
            overflow-x: hidden;
        }

        ::-webkit-scrollbar {
            width: 0;
            background: transparent;
        }
    </style>
</head>

<?php include('../../includes/header.php'); ?>

<body>
    <?php //include('../Includes/Header.php'); 
    ?>
    <?php
    $log_id = $_SESSION['user_id']; // Store user ID in session (temp ) and use in all files 
    // for Fetching faculty details into session on login
    $sql1 = "SELECT * FROM `erp_faculty` where f_id='$log_id';";
    $result1 = mysqli_query($conn, $sql1);
    if (!$result1) {
        die('Query failed: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result1);
    $ClassIdFromFaculty = $row['cls_id'];

    $year = date("Y");
    $ExamCEId = $_POST["Exam"];
    $Semester = $_POST["Semester"];
    $Department = $_POST["Department"];
    $SubjectCode = $_POST["Subject"];
    $Course = $_POST["Course"];
    //for getting Exam Name
    $sql = "SELECT ce_exam,ce_type FROM erp_createexam where ce_id=$ExamCEId;";
    $result = mysqli_query($conn, $sql);
    $resultValues = mysqli_fetch_assoc($result);
    $ExamName = $resultValues["ce_exam"];
    $ExamType = $resultValues["ce_type"];
    // echo $ExamType;

    //For getting Subject Name
    $sql = "SELECT sub_name FROM erp_subject where tt_subcode='$SubjectCode';";
    $result = mysqli_query($conn, $sql);
    $SubjectName = mysqli_fetch_assoc($result)["sub_name"];
    // for reciving Exam id
    $sql = "SELECT * FROM erp_exam where ce_id=$ExamCEId and tt_subcode='$SubjectCode';";
    $result = mysqli_query($conn, $sql);
    $ExamId = mysqli_fetch_all($result, MYSQLI_ASSOC)[0]['exam_id'];

    //For getting last entered student marks
    $sql = "SELECT e.stu_id, e.mark_draft, e.mark_publish,e.mark_id FROM erp_mark e JOIN ( SELECT stu_id, MAX(mark_id) as mark_id FROM erp_mark WHERE cls_id = $ClassIdFromFaculty AND ce_id = $ExamCEId AND exam_id = $ExamId AND (mark_draft != '' OR mark_publish != '') GROUP BY stu_id ) t ON e.stu_id = t.stu_id AND e.mark_id = t.mark_id;
";
    $sql = "SELECT e.stu_id, e.mark_draft, e.mark_publish,e.mark_id FROM erp_mark e JOIN ( SELECT stu_id, MAX(mark_id) as mark_id FROM erp_mark WHERE cls_id = $ClassIdFromFaculty AND ce_id = $ExamCEId AND exam_id = $ExamId AND (mark_draft != '' OR mark_publish != '') GROUP BY stu_id ) t ON e.stu_id = t.stu_id AND e.mark_id = t.mark_id;
";
    $result = mysqli_query($conn, $sql);
    $StudentMarkList = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // print_r($StudentMarkList);
    if (isset($StudentMarkList) && count($StudentMarkList) != 0) {
        echo '<script>
      $(document).ready(function() {
          Swal.fire({
              icon: "info",
              title: "Info!",
              text: "Result already marked for ' . count($StudentMarkList) . ' Students.",
          });
      });
  </script>';
    } ?>

    <div class="main-container">
        <?php include('../../includes/sidebar.php'); ?>
        <main>

            <div class="main-card">
                <div class="card text-bg-light mx-3 my-3">
                    <div class="report-head p-2 d-flex justify-content-between align-items-center">
                        <h3 class="m-0">Result</h3>
                        <div>
                            <a href="../../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>
                    </div>
                    <!-- <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Create</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div> -->
                    <!-- ur content -->
                        <div class="container">
                            <div class="table-responsive">
                                <h3 align="center">Result Posting</h3>
                            </div>
                        </div>

                        <center>
                            <table class="post-head">
                                <tr>
                                    <td><?php echo "Date: " . date("Y-m-d"); ?></td>
                                    <td><?php echo "Department: " . $Department; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo "Branch: " . $Course; ?></td>
                                    <td><?php echo "Semester: " . $Semester; ?></td>
                                </tr>
                                <tr>
                                    <td><?php echo "Exam: " . $ExamName; ?></td>
                                    <td><?php echo "Subject: " . $SubjectName; ?></td>
                                </tr>
                            </table>
                            <p><span style="color:red;"> * </span> Mark <b>-</b> if it is absent(Ab) </p>
                        </center>
                        <form action="PostPage.php" method="post">
                            <input type="hidden" name="Department" value="<?php echo $Department; ?>">
                            <input type="hidden" name="Exam" value="<?php echo $ExamName; ?>">
                            <input type="hidden" name="Semester" value="<?php echo $Semester; ?>">
                            <input type="hidden" name="Course" value="<?php echo $Course; ?>">
                            <input type="hidden" name="Subject" value="<?php echo $SubjectName; ?>">
                            <input type="hidden" name="SubjectCode" value="<?php echo $SubjectCode; ?>">
                            <input type="hidden" name="ExamCeId" value="<?php echo $ExamCEId; ?>">

                            <?php
                            $year = date("Y");

                            $Sql = "SELECT B.test_maxmark,B.test_name FROM erp_exam A join erp_test B on A.test_id=B.test_id where A.ce_id=$ExamCEId and A.tt_subcode='$SubjectCode';";
                            // echo $q;
                            $qry = mysqli_query($conn, $Sql);
                            $nu = mysqli_num_rows($qry);
                            if ($nu > 0) {
                                while ($ro = mysqli_fetch_assoc($qry)) {
                                    $max = $ro["test_maxmark"];
                                    $test = $ro["test_name"];
                                }
                            }
                            $query = "SELECT * FROM erp_student where cls_id='$ClassIdFromFaculty'";
                            $result = mysqli_query($conn, $query);
                            $numrow = mysqli_num_rows($result);

                            if ($numrow > 0) {
                                echo '<div class="table-container TT-form-content" style="margin-left: 267px;">';
                                echo '<table class="dbresult" widht="5px">';
                                echo '<thead>';
                                echo '<tr>';
                                echo '<th>Sl.No</th>';
                                echo '<th>Name</th>';
                                echo '<th>Reg No.</th>';
                                if ($ExamType == "academic") {
                                    echo '<th>Mark</th>';
                                    echo '<th>Converted Mark</th>';
                                } elseif ($ExamType == "university") {
                                    echo '<th>Converted Mark</th>';
                                }
                                echo '</tr>';
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $Student = array_filter($StudentMarkList, function ($item) use ($row) {
                                        return isset($item['stu_id']) && $item['stu_id'] == $row['stu_id'];
                                    });
                                    $StudentConvertedMark = array_values($Student)[0]['mark_draft'] ?? "";
                                    $mark_id = array_values($Student)[0]['mark_id'] ?? "";
                                    if ($ExamType == "academic") {
                                        $StudentMark = $StudentConvertedMark != "" ? ($max / 100) * $StudentConvertedMark : "";
                                    }
                                    // print_r($Student);
                                    // print_r($row);
                                    //   if ($StudentMark === '##') {
                                    //     $StudentConvertedMark = 'AB';
                                    // }

                                    echo '<tr>';
                                    echo '<td>', $i + 1;
                                    echo '<td>', $row['stu_fname'] . ' ' . $row['stu_lname'], '
      <input type="hidden" name="resultRecords[' . $i . '][name]" value="' . $row['stu_fname'] . ' ' . $row['stu_lname'] . '">
      <input type="hidden" name="resultRecords[' . $i . '][MarkId]" value="' . $mark_id . '">
      </td>';
                                    echo '<td>', $row['stu_id'], '
      <input type="hidden" name="resultRecords[' . $i . '][regno]" value="' . $row['stu_id'] . '" ></td>';
                                    if ($ExamType == "academic") {
                                        echo '<td>
      <input type="text" name="resultRecords[' . $i . '][mark]" id="mark' . $i . '"     value ="' . $StudentMark . '" placeholder="" min="0" max="' . $max . '" oninput="lengthConverter' . $i . '(this.value)" onchange="" [. $i .]  > /' . $max . '</td>';
                                        echo '<td>
      <input type="text" name="resultRecords[' . $i . '][convertedMark]" id="convertedMark' . $i . '" id="convertedMark' . $i . '" readonly value=' . $StudentConvertedMark . '></td>';
                                    } elseif ($ExamType == "university") {
                                        echo '<td>
          <select id="sel3" name="resultRecords[' . $i . '][convertedMark]" >
          <option value="">Choose</option>
          <option value="O" ' . ($StudentConvertedMark == "O" ? "selected" : "") . ' >O</option>
          <option value="A+"  ' . ($StudentConvertedMark == "A+" ? "selected" : "") . ' >A+</option>
          <option value="A" ' . ($StudentConvertedMark == "A" ? "selected" : "") . ' >A</option>
          <option value="B+" ' . ($StudentConvertedMark == "B+" ? "selected" : "") . ' >B+</option>
          <option value="B" ' . ($StudentConvertedMark == "B" ? "selected" : "") . ' >B</option>
          <option value="RA" ' . ($StudentConvertedMark == "RA" ? "selected" : "") . ' >RA</option>
          <option value="absent" ' . ($StudentConvertedMark == "absent" ? "selected" : "") . ' >Absent</option> 
        </select>
          </td>';
                                    }
                                    echo '</tr>';

                            ?>
                                    <script>
                                        function lengthConverter<?php echo $i; ?>(valNum) {
                                            // console.log("value : " + valNum);
                                            if (valNum == "-") {
                                                console.log(document.getElementById("convertedMark<?php echo $i; ?>"));
                                                document.getElementById("convertedMark<?php echo $i; ?>").value = "AB";
                                            } else {
                                                var convertedMark = parseFloat((valNum / <?php echo $max; ?>) * 100);

                                                if (valNum > <?php echo $max; ?>) {
                                                    alert("Mark Exceeded");
                                                    // document.getElementById("outputMeters<?php echo $i; ?>").value = "invalid";
                                                    document.getElementById("convertedMark<?php echo $i; ?>").value = 0;
                                                } else {
                                                    // console.log(document.getElementById("convertedMark<?php echo $i; ?>"));
                                                    // document.getElementById("outputMeters<?php echo $i; ?>").value = convertedMark;
                                                    document.getElementById("convertedMark<?php echo $i; ?>").value = convertedMark;
                                                }
                                            }
                                        }
                                    </script>
                            <?php
                                    $i++;
                                }
                                echo '</tbody>';
                                echo "</table>";
                                echo '</div>';
                                echo "<div class='container1'>
    <center>
    <button class='button button4'name='save' value='save'>Save</button>&emsp;
    <button class='button button4'name='save' value='SaveAsDraft'>Save as Draft</button>&emsp;
    <button class='btn' type='reset' value='Reset' onclick='location.reload();'>Clear</button>
    </center>
</div>";
                            } else {
                                echo 'Record Not found';
                            }

                            ?>
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