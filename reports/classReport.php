<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="assets/css/classReport.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../assets/img/gcoe_logo.png">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!--for chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--for chart -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <style>
        #reports {
            background-color: var(--pri);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <?php include('../includes/config.php'); ?>
    <?php include('../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../includes/sidebar.php'); ?>
        <main>
            <!-- Main -->
            <?php
            $year = date("Y");
            $s = mysqli_query($con, "select distinct cls_deptname from erp_class");
            ?>
            <div class="d-flex justify-content-center pt-3">
                <div class="container d-flex flex-column p-3">
                    <div class="d-flex flex-row flex-wrap justify-content-between">
                        <h2 class="heading">Class Report</h2>
                        <a href="../reports" class="btn-back">Back</a>
                    </div>
                    <hr>
                    <div class="top-container">
                        <form action="" method="post">
                            <div class="form-container d-flex flex-row flex-wrap">
                                <div class="item">
                                    <label>Course </label>
                                    <?php
                                    $s = mysqli_query($con, "select distinct cls_course from erp_class where cls_startyr<'$year'<cls_startyr");
                                    ?>
                                    <!-- Dynamic data -->
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
                                    <!-- <div id=" txtHint"><b>Person info will be listed here.</b>
                                    </div> -->
                                </div>
                                <!--  -->
                                <div class="item">
                                    <b><label> Semester: </label></b>
                                    <!-- Dynamic data -->
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
                                <div class=" item">
                                    <label>Exam Name </label>
                                    <!-- Dynamic data -->
                                    <select name='ena' id="en">
                                        <option value="none" selected disabled hidden>--Select--</option>
                                        <?php
                                        if (isset($_POST['ena'])) {
                                            ?>
                                            <option selected value="<?php echo $_POST['ena']; ?>">
                                                <?php echo $_POST['ena']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--  -->
                                <div class=" item">
                                    <label> Subject Name: </label>
                                    <!-- Dynamic data -->
                                    <select name='subn' id="sb">
                                        <option value="none" selected disabled hidden>--Select--
                                        </option>
                                        <?php
                                        if (isset($_POST['subn'])) {
                                            ?>
                                            <option selected value="<?php echo $_POST['subn']; ?>">
                                                <?php echo $_POST['subn']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!--  -->
                                <div class=" item">
                                    <label>Result Type: </label>
                                    <input type="radio" id="" name="format" value="Tabular">
                                    <label>Tabular</label>
                                    <input type="radio" id="" name="format" value="Graph">
                                    <label>Graph</label>
                                    <input type="radio" id="" name="format" value="Both">
                                    <label>Both</label>
                                </div>
                            </div>
                            <div class="action_buttons">
                                <input class="search-btn" type="reset" value="Clear" name='reset'>
                                <input class="search-btn" type="submit" value="Search" name='submit'>
                            </div>
                        </form>
                        <hr>

                    </div>
                    <!--  -->
                    <div class="bottom-container">
                        <?php
                        if ($_POST['submit']) {
                            $year = date("Y");
                            $sid = $_POST["sid"];
                            $dc = $_POST["deptc"];
                            $ena = $_POST["ena"];
                            $ds = $_POST["depts"];
                            $dn = $_POST["deptn"];
                            $subn = $_POST["subn"];
                            $format = $_POST['format'];


                            if ($subn !== 'all') {
                                # code...
                                $qry = "SELECT * FROM erp_mark
                    LEFT JOIN erp_exam
                    ON erp_exam.exam_id = erp_mark.exam_id
                    LEFT JOIN erp_class
                    ON erp_mark.cls_id = erp_class.cls_id
                    LEFT JOIN erp_createexam
                    ON erp_mark.ce_id = erp_createexam.ce_id
                    LEFT JOIN erp_subject
                    ON erp_exam.tt_subcode = erp_subject.tt_subcode
                    LEFT JOIN erp_test
                    ON erp_test.test_id = erp_exam.test_id
                    LEFT JOIN erp_student
                    ON erp_student.stu_id = erp_mark.stu_id where cls_course='$dc' AND cls_dept='$dn' AND cls_sem='$ds'
                    AND ce_exam='$ena'  AND sub_name='$subn' AND cls_startyr<'$year'<cls_startyr";
                                $result = mysqli_query($con, $qry);


                                // declaration of variables
                                $roll = $present = $absent = $passed = $failed = $maxmark = $centum = $above90 = $bt81_90 = $bt71_80 = $$bt61_70 = $bt50_60 = $below50 = 0;
                                $totalmark = $subavg = 0;
                                $minmark = 100;

                                while ($row = mysqli_fetch_assoc($result)):
                                    $roll++;
                                    $mark_publish = $row['mark_publish'];
                                    $totalmark += $mark_publish;
                                    // to check if the student is absent or present
                        
                                    if ($mark_publish === 'AB') {
                                        # code...
                                        $absent++;
                                    } else {
                                        $present++;
                                        // finding number of students in each level
                                        if ($mark_publish === 100) {
                                            # code...
                                            $centum++;
                                        }
                                        if ($mark_publish >= 91) {
                                            $above90++;
                                            $passed++;
                                        } elseif ($mark_publish >= 81) {
                                            $bt81_90++;
                                            $passed++;
                                        } elseif ($mark_publish >= 71) {
                                            $bt71_80++;
                                            $passed++;
                                        } elseif ($mark_publish >= 61) {
                                            $bt61_70++;
                                            $passed++;
                                        } elseif ($mark_publish >= 50) {
                                            $bt50_60++;
                                            $passed++;
                                        } elseif ($mark_publish < 50) {
                                            $below50++;
                                            $failed++;
                                        }
                                        // finding maximun and minimun marks
                                        if ($mark_publish < $minmark) {
                                            # code...
                                            $minmark = $mark_publish;
                                        }
                                        if ($mark_publish > $maxmark) {
                                            # code...
                                            $maxmark = $mark_publish;
                                        }
                                    }
                                endwhile;
                                $percentageBelow50 = round((($below50) / $present) * 100, 2);
                                $percentage50_60 = round(($bt50_60 / $present) * 100, 2);
                                $percentage61_70 = round(($bt61_70 / $present) * 100, 2);
                                $percentage71_80 = round(($bt71_80 / $present) * 100, 2);
                                $percentage81_90 = round(($bt81_90 / $present) * 100, 2);
                                $percentageAbove90 = round(($above90 / $present) * 100, 2);
                                $passpercentage = round(($passed / $present) * 100, 2);
                                $failpercentage = round(($failed / $present) * 100, 2);
                            }
                            if ($subn === 'all') {
                                # code...
                                $noofsubjects = 0; //initialization
                        
                                $cc = "SELECT distinct sub_name FROM erp_mark
                    LEFT JOIN erp_exam
                    ON erp_exam.exam_id = erp_mark.exam_id
                    LEFT JOIN erp_class
                    ON erp_mark.cls_id = erp_class.cls_id
                    LEFT JOIN erp_createexam
                    ON erp_mark.ce_id = erp_createexam.ce_id
                    LEFT JOIN erp_subject
                    ON erp_exam.tt_subcode = erp_subject.tt_subcode 
                    where cls_course='$dc' AND cls_dept='$dn' AND cls_sem='$ds' AND ce_exam='$ena'";
                                $cq = mysqli_query($con, $cc);

                                $qry = "SELECT * FROM erp_mark
                    LEFT JOIN erp_exam
                    ON erp_exam.exam_id = erp_mark.exam_id
                    LEFT JOIN erp_class
                    ON erp_mark.cls_id = erp_class.cls_id
                    LEFT JOIN erp_createexam
                    ON erp_mark.ce_id = erp_createexam.ce_id
                    LEFT JOIN erp_subject
                    ON erp_exam.tt_subcode = erp_subject.tt_subcode
                    LEFT JOIN erp_test
                    ON erp_test.test_id = erp_exam.test_id
                    LEFT JOIN erp_student
                    ON erp_student.stu_id = erp_mark.stu_id where cls_course='$dc' AND cls_dept='$dn' AND cls_sem='$ds'
                    AND ce_exam='$ena' AND cls_startyr<'$year'<cls_startyr";
                                $result = mysqli_query($con, $qry);

                                $students = $present = $absent = array();
                                $passed = $failed = $maxmark = $centum = $above90 = $bt81_90 = $bt71_80 = $$bt61_70 = $bt50_60 = $below50 = array();
                                $percentagebelow50 = $percentage50_60 = $percentage61_70 = $percentage71_80 = $percentage81_90 = $percentageAbove90 = $passpercentage = $failpercentage = array();
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $stu_id = $row['stu_id'];
                                    $stu_fname = $row['stu_fname'];
                                    $stu_lname = $row['stu_lname'];
                                    $sub_name = $row['sub_name'];
                                    $mark_publish = $row['mark_publish'];

                                    if (!isset($students[$stu_id])) {
                                        // Create a new entry for the student
                                        $roll++;
                                        $students[$stu_id] = array(
                                            'stu_id' => $stu_id,
                                            'stu_fname' => $stu_fname,
                                            'stu_lname' => $stu_lname,
                                            'sub_marks' => array()
                                        );
                                    }

                                    // Add subject marks for the student
                                    $students[$stu_id]['sub_marks'][$sub_name] = $mark_publish;

                                    // calculating no of present and absents
                                    if (!isset($present[$sub_name])) {
                                        // Create a new entry for the subject
                                        $present[$sub_name] = $absent[$sub_name] = $passed[$sub_name] = $failed[$sub_name] = $maxmark[$sub_name] = $centum[$sub_name] = $above75[$sub_name] = $bt60_74[$sub_name] = $bt50_59[$sub_name] = $bt33_49[$sub_name] = $below33[$sub_name] = $totalmark[$sub_name] = 0;
                                        $minmark[$sub_name] = 100;
                                    }
                                    if ($mark_publish === 'AB') {
                                        # code...
                                        $absent[$sub_name]++;
                                    } else {
                                        # code...
                                        $totalmark[$sub_name] += $mark_publish; // total mark used to calculate subject average
                                        $present[$sub_name]++;
                                        // finding number of students in each level
                                        if ($mark_publish === 100) {
                                            # code...
                                            $centum[$sub_name]++;
                                        }
                                        if ($mark_publish >= 91) {
                                            $above90[$sub_name]++;
                                            $passed[$sub_name]++;
                                        } elseif ($mark_publish >= 81) {
                                            $bt81_90[$sub_name]++;
                                            $passed[$sub_name]++;
                                        } elseif ($mark_publish >= 71) {
                                            $bt71_80[$sub_name]++;
                                            $passed[$sub_name]++;
                                        } elseif ($mark_publish >= 61) {
                                            $bt61_70[$sub_name]++;
                                            $passed[$sub_name]++;
                                        } elseif ($mark_publish >= 50) {
                                            $bt50_60[$sub_name]++;
                                            $passed[$sub_name]++;
                                        } elseif ($mark_publish < 50) {
                                            $below50[$sub_name]++;
                                            $failed[$sub_name]++;
                                        }
                                        // finding maximun and minimun marks
                                        if ($mark_publish < $minmark[$sub_name]) {
                                            # code...
                                            $minmark[$sub_name] = $mark_publish;
                                        }
                                        if ($mark_publish > $maxmark[$sub_name]) {
                                            # code...
                                            $maxmark[$sub_name] = $mark_publish;
                                        }
                                    }
                                    // $percentageBelow33[$sub_name] = round(($below33[$sub_name] / $present[$sub_name]) * 100, 2);
                                    // $percentage33_49[$sub_name] = round(($bt33_49[$sub_name] / $present[$sub_name]) * 100, 2);
                                    // $percentage50_59[$sub_name] = round(($bt50_59[$sub_name] / $present[$sub_name]) * 100, 2);
                                    // $percentage60_74[$sub_name] = round(($bt60_74[$sub_name] / $present[$sub_name]) * 100, 2);
                                    // $percentageabove75[$sub_name] = round(($above75[$sub_name] / $present[$sub_name]) * 100, 2);
                                    $percentageBelow50[$sub_name] = round((($below50[$sub_name]) / $present[$sub_name]) * 100, 2);
                                    $percentage50_60[$sub_name] = round((($bt50_60[$sub_name]) / $present[$sub_name]) * 100, 2);
                                    $percentage61_70[$sub_name] = round(($bt61_70[$sub_name] / $present[$sub_name]) * 100, 2);
                                    $percentage71_80[$sub_name] = round(($bt71_80[$sub_name] / $present[$sub_name]) * 100, 2);
                                    $percentage81_90[$sub_name] = round(($bt81_90[$sub_name] / $present[$sub_name]) * 100, 2);
                                    $percentageAbove90[$sub_name] = round(($above90[$sub_name] / $present[$sub_name]) * 100, 2);
                                    $passpercentage[$sub_name] = round(($passed[$sub_name] / $present[$sub_name]) * 100, 2);
                                    $failpercentage[$sub_name] = round(($failed[$sub_name] / $present[$sub_name]) * 100, 2);
                                }
                            }

                            ?>
                            <div class="d-flex flex-row justify-content-center">
                                <div class='colm'>
                                    <p><b>Course :</b>
                                        <?php echo $dc; ?>
                                    </p>
                                    <p><b>Dept :</b>
                                        <?php echo $dn; ?>
                                    </p>
                                    <p><b>Sem :</b>
                                        <?php echo $ds; ?>
                                    </p>
                                    <p><b>Exam :</b>
                                        <?php echo $ena; ?>
                                    </p>
                                    <?php if ($subn !== 'all'): ?>
                                        <p><b>Subject:</b>
                                            <?php echo $subn; ?>
                                        </p>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex flex-row align-content-center align-items-center colm2" <?php
                                if ($format === 'Graph') {
                                    # code...
                                    echo 'style="display:none"';
                                }
                                ?>>
                                    <button id="csv" class="btn btn-info">Export To Excel</button>&nbsp;
                                    <button id="pdf" class="btn btn-danger">Export To PDF</button>
                                </div>
                            </div>

                            <div class="download_able table table-striped" id="report" <?php
                            if ($format === 'Graph') {
                                # code...
                                echo 'style="display:none"';
                            }
                            ?>>
                                <div class="row hideable d-block">
                                    <div class="d-flex justify-content-center">
                                        <img src="img/h.png" alt="" class="w-50">
                                    </div>
                                </div>
                                <div class="d-flex flex-row justify-content-center">
                                    <div class='colm'>
                                        <p><b>Course :</b>
                                            <?php echo $dc; ?>
                                        </p>
                                        <p><b>Dept :</b>
                                            <?php echo $dn; ?>
                                        </p>
                                        <p><b>Sem :</b>
                                            <?php echo $ds; ?>
                                        </p>
                                        <p><b>Exam :</b>
                                            <?php echo $ena; ?>
                                        </p>
                                        <?php if ($subn !== 'all'): ?>
                                            <p><b>Subject:</b>
                                                <?php echo $subn; ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <center class="d-flex justify-content-center">
                                    <table id="dataTable" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Reg.No</th>
                                                <th>Student Name</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <th>
                                                        <?php echo $subn;
                                                endif; ?>
                                                </th>
                                                <?php if ($subn === 'all'): ?>
                                                    <?php while ($row = mysqli_fetch_assoc($cq)):
                                                        $noofsubjects++;
                                                        ?>
                                                        <th>
                                                            <?php echo $row['sub_name']; ?>
                                                        </th>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php
                                            $serialNumber = 1;
                                            if ($subn !== 'all'):

                                                $result = mysqli_query($con, $qry);
                                                while ($row = mysqli_fetch_assoc($result)):

                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $serialNumber++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['stu_id']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['stu_fname'] . ' ' . $row['stu_lname']; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $row['mark_publish']; ?>
                                                        </td>
                                                    </tr>
                                                <?php endwhile;
                                            endif;
                                            if ($subn === 'all'):
                                                foreach ($students as $student) {
                                                    $stu_id = $student['stu_id'];
                                                    $stu_fname = $student['stu_fname'];
                                                    $stu_lname = $student['stu_lname'];
                                                    $sub_marks = $student['sub_marks'];
                                                    ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo $serialNumber++; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $stu_id; ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $stu_fname . ' ' . $stu_lname; ?>
                                                        </td>
                                                        <?php
                                                        $subresult = mysqli_query($con, $cc);
                                                        while ($row = mysqli_fetch_assoc($subresult)):
                                                            $subject = $row['sub_name'];
                                                            ?>
                                                            <td>
                                                                <?php
                                                                if (isset($sub_marks[$subject])) {
                                                                    echo $sub_marks[$subject];
                                                                } ?>
                                                            </td>
                                                        <?php endwhile; ?>
                                                    </tr>
                                                    <?php
                                                }

                                            endif; ?>
                                            <?php ?>
                                        </tbody>
                                        <?php
                                        ?>
                                    </table>
                                </center><br>
                                <!-- Corrected -->
                                <center class="d-flex justify-content-center justify-items-center">
                                    <table class="table table-bordered" id="analysisTable">

                                        <thead>
                                            <tr>
                                                <th>Exam Details</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <th>
                                                        <?php echo $subn;
                                                endif; ?>
                                                </th>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)): ?>
                                                        <th>
                                                            <?php echo $row['sub_name']; ?>
                                                        </th>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th>No. of students in 91%-100% (O Grade)</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $above90[$sub_name]; ?>
                                                    </td>
                                                <?php endif; ?>

                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $above90[$sub_name]; ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No. of students in 81%-90% (A+ Grade)</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $bt81_90[$sub_name]; ?>
                                                    </td>
                                                <?php endif; ?>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $bt81_90[$sub_name]; ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No. of students in 71%-80% (A Grade)</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $bt71_80[$sub_name]; ?>
                                                    </td>
                                                <?php endif; ?>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $bt71_80[$sub_name]; ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No. of students in 61%-70% (B+ Grade)</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $bt61_70[$sub_name]; ?>
                                                    </td>
                                                <?php endif; ?>

                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $bt61_70[$sub_name]; ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No. of students in 50%-60% (B Grade)</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $bt50_60[$sub_name]; ?>
                                                    </td>
                                                <?php endif; ?>

                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $bt50_60[$sub_name]; ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No. of students Below 50% (U Grade)</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $below50[$sub_name]; ?>
                                                    </td>
                                                <?php endif; ?>

                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $below50[$sub_name]; ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>

                                            <tr>
                                                <th>Class Strength</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $roll;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    for ($i = 0; $i < $noofsubjects; $i++) {
                                                        # code...
                                                        ?>
                                                        <td>
                                                            <?php echo $roll ?>
                                                        </td>

                                                    <?php }
                                                endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No.of students Appeared</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $present;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $present[$sub_name];
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No.of students Absent</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $absent;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $absent[$sub_name];
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No.of students Passed</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $passed;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $passed[$sub_name];
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No.of students Failed</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $failed;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $failed[$sub_name];
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>Percentage of Pass </th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php
                                                        echo $passpercentage;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php
                                                            $percentage = round(($passed[$sub_name] / $present[$sub_name]) * 100, 2);
                                                            echo $percentage;
                                                            ;
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>Percentage of Fail </th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php
                                                        echo $failpercentage;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php
                                                            $percentage = round(($failed[$sub_name] / $present[$sub_name]) * 100, 2);
                                                            echo $percentage;
                                                            ;
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>Subject Average </th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php
                                                        $subavg = round(($totalmark / $present), 2);
                                                        echo $subavg;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php
                                                            $subavg = round(($totalmark[$sub_name] / $present[$sub_name]), 2);
                                                            echo $subavg;
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>Maximum Mark</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $maxmark;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $maxmark[$sub_name];
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>Minimum Mark</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $minmark;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $minmark[$sub_name];
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                            <tr>
                                                <th>No.of students Centum</th>
                                                <?php if ($subn !== 'all'): ?>
                                                    <td>
                                                        <?php echo $centum;
                                                endif; ?>
                                                </td>
                                                <?php if ($subn === 'all'):
                                                    $subresult = mysqli_query($con, $cc);
                                                    while ($row = mysqli_fetch_assoc($subresult)):
                                                        $sub_name = $row['sub_name']; ?>
                                                        <td>
                                                            <?php echo $centum[$sub_name];
                                                            ?>
                                                        </td>
                                                    <?php endwhile; ?>
                                                <?php endif; ?>
                                            </tr>
                                        </tbody>
                                    </table>
                                </center>
                                <!--  -->
                            </div>
                            <div class="download_able table table-striped" <?php
                            if ($format === 'Tabular') {
                                # code...
                                echo 'style="display:none"';
                            }
                            ?>>
                                <?php
                                if ($subn !== 'all'):
                                    ?>
                                    <div class="d-flex justify-content-center">
                                        <canvas id="myChart" class="canvas" style='width:500px;'></canvas>
                                        <script>
                                            // var xValues = ["Above 90%", "60-74%", "50-59%", "33-49%", "Below 33%"];
                                            var xValues = ["91-100%", "81-90%", "71-80%", "61-70%", "50-60%", "Below 50%"];
                                            var yValues = [
                                                <?php echo $percentageAbove90; ?>,
                                                <?php echo $percentage81_90; ?>,
                                                <?php echo $percentage71_80; ?>,
                                                <?php echo $percentage61_70; ?>,
                                                <?php echo $percentage50_60; ?>,
                                                <?php echo $percentageBelow50; ?>
                                            ];

                                            var barColors = ["red", "green", "blue", "orange", "violet", "skyblue"];

                                            var myChart = new Chart("myChart", {
                                                type: "bar",
                                                data: {
                                                    labels: xValues,
                                                    datasets: [{
                                                        backgroundColor: barColors,
                                                        data: yValues
                                                    }]
                                                },
                                                options: {
                                                    responsive: true,
                                                    scales: {
                                                        y: {
                                                            min: 0,
                                                            max: 100,
                                                        }
                                                    },
                                                    plugins: {
                                                        legend: {
                                                            display: false
                                                        },
                                                        subtitle: {
                                                            display: true,
                                                            text: "Pass:<?php echo $passpercentage; ?>% ,Fail:<?php echo $failpercentage; ?>%",
                                                        },
                                                        title: {
                                                            display: true,
                                                            text: "Result Analysis of <?php echo $subn; ?>"
                                                        }
                                                    }
                                                }
                                            });
                                        </script>
                                    </div>
                                    <?php
                                endif;
                                ?>
                                <!-- chart for all subjects -->
                                <?php if ($subn === 'all'): ?>
                                    <div class="chart">
                                        <?php
                                        $subresult = mysqli_query($con, $cc);
                                        while ($row = mysqli_fetch_assoc($subresult)):
                                            $sub_name = $row['sub_name']; ?>
                                            <div>
                                                <canvas id="myChart<?php echo $sub_name; ?>" class="canvas"></canvas>
                                                <!-- script for chart -->
                                                <script>
                                                    var xValues = ["91-100%", "81-90%", "71-80%", "61-70%", "50-60%", "Below 50%"];
                                                    var yValues = [
                                                        <?php echo $percentageAbove90[$sub_name]; ?>,
                                                        <?php echo $percentage81_90[$sub_name]; ?>,
                                                        <?php echo $percentage71_80[$sub_name]; ?>,
                                                        <?php echo $percentage61_70[$sub_name]; ?>,
                                                        <?php echo $percentage50_60[$sub_name]; ?>,
                                                        <?php echo $percentageBelow50[$sub_name]; ?>
                                                    ];

                                                    var barColors = ["red", "green", "blue", "orange", "violet", "skyblue"];

                                                    var myChart = new Chart("myChart<?php echo $sub_name; ?>", {
                                                        type: "bar",
                                                        data: {
                                                            labels: xValues,
                                                            datasets: [{
                                                                backgroundColor: barColors,
                                                                data: yValues
                                                            }]
                                                        },
                                                        options: {
                                                            responsive: true,
                                                            scales: {
                                                                y: {
                                                                    min: 0,
                                                                    max: 100,
                                                                }
                                                            },
                                                            plugins: {
                                                                legend: {
                                                                    display: false
                                                                },
                                                                subtitle: {
                                                                    display: true,
                                                                    text: "Pass:<?php echo $passpercentage[$sub_name]; ?>% ,Fail:<?php echo $failpercentage[$sub_name]; ?>%",
                                                                },
                                                                title: {
                                                                    display: true,
                                                                    text: "Result Analysis of <?php echo $sub_name; ?>"
                                                                }
                                                            }
                                                        }
                                                    });
                                                </script>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php
                        }
                        if ($_POST['reset']) {
                            $_POST = array();
                        } ?>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
<script src="../assets/js/script.js"></script>
<!--  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
<!-- <script src="assets/js/classReport.js">
</script> -->
<script>
    $('#course').on('change', function () {
        var cls_id = this.value;
        // console.log(country_id);
        $.ajax({
            url: 'ajax/course.php',
            type: "POST",
            data: {
                c: cls_id
            },
            success: function (result) {
                $('#dept').html(result);
            }
        })
    });
    //
    $('#dept').on('change', function () {
        var c = this.options[this.selectedIndex].getAttribute("course");
        var d = this.options[this.selectedIndex].getAttribute("dept");
        $.ajax({
            url: 'ajax/dept.php',
            type: "POST",
            data: {
                c: c,
                d: d
            },
            success: function (result) {
                $('#sem').html(result);
                // console.log(data);
            }
        })
    });
    //
    $('#sem').on('change', function () {
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
            success: function (result) {
                $('#en').html(result);
                // console.log(data);
            }
        })
    });
    //
    $('#en').on('change', function () {
        var c = this.options[this.selectedIndex].getAttribute("course");
        var d = this.options[this.selectedIndex].getAttribute("dept");
        var s = this.options[this.selectedIndex].getAttribute("sem");
        var en = this.options[this.selectedIndex].getAttribute("en");
        console.log(c);
        console.log(d);
        console.log(s);
        console.log(en);
        $.ajax({
            url: 'ajax/ename.php',
            type: "POST",
            data: {
                c: c,
                d: d,
                s: s,
                en: en
            },
            success: function (result) {
                $('#sb').html(result);
                console.log(result);
            }
        })
    });
    //
    $('#sb').on('change', function () {
        var c = this.options[this.selectedIndex].getAttribute("course");
        var d = this.options[this.selectedIndex].getAttribute("dept");
        var s = this.options[this.selectedIndex].getAttribute("sem");
        var en = this.options[this.selectedIndex].getAttribute("en");
        var sb = this.options[this.selectedIndex].getAttribute("sb");
        console.log(c);
        console.log(d);
        console.log(s);
        console.log(en);
        console.log(sb);
        $.ajax({
            url: 'ajax/sub.php',
            type: "POST",
            data: {
                c: c,
                d: d,
                s: s,
                en: en,
                sb: sb
            },
            success: function (result) {
                $('#rn').html(result);
                console.log(result);
            }
        })
    });
    var btn = document.getElementById("pdf");
    var createpdf = document.getElementById("report");
    var opt = {
        margin: 0.25,
        filename: 'report.pdf',
        html2canvas: {
            scale: 2
        },
        jsPDF: {
            unit: 'in',
            format: 'A4',
            orientation: 'portrait'
        }
    };
    btn.addEventListener("click", function () {
        html2pdf().set(opt).from(createpdf).save();
    });

    function html_table_to_excel(type) {
        var data1 = document.getElementById('dataTable');
        var data2 = document.getElementById('analysisTable');

        var file = XLSX.utils.table_to_book(data1, {
            sheet: "sheet1"
        });

        var file2 = XLSX.utils.table_to_book(data2, {
            sheet: "sheet1"
        });

        XLSX.utils.book_append_sheet(file, file2.Sheets[file2.SheetNames[0]], "Sheet2");

        XLSX.write(file, {
            bookType: type,
            bookSST: true,
            type: 'base64'
        });

        XLSX.writeFile(file, 'report.' + type);
    }

    const export_button = document.getElementById('csv');

    export_button.addEventListener('click', () => {
        html_table_to_excel('xlsx');
    });
</script>
<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
</script>

</html>