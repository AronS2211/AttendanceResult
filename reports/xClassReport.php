<?php

session_start();

if (isset($_SESSION['user_id'])) {

    include('../includes/config.php');


?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <!--for chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--for chart -->
    <title>Reports</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</head>

<style>
.main-container {
    margin: auto;
    padding: 0;
    position: relative;
    left: 100px;
    width: calc(100% - 100px);
}

.heading {
    font-size: 2rem;
    text-align: center;
    color: blueviolet;
    font-family: math;
}

.top-container {
    height: 50%;
}

.bottom-container {
    height: 70%;
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
    align-content: center;
}

textarea {
    resize: none;
}

.item {
    display: flex;
    gap: 10px;
    margin-top: 20px;
    margin-bottom: 20px
}

.form-container {
    width: 100%;
    display: flex;
}

.left {
    width: 50%;

    margin-left: 30px;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
}

.right {
    width: 50%;
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
}

.action_buttons {
    text-align: center;
    margin: auto;
}

.search-btn {
    font-size: 1.5rem;
    font-weight: 600;
    padding: 10px;
    border: 1px solid black;
    width: 100px;
    border-radius: 5px;
    color: white;
    background-color: darkviolet;
}

.search-btn:hover {
    background-color: violet;
}

.table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 70%;
}

td,
th,
thead {
    border: 1px solid black;
    padding: 8px;
}

th {
    text-align: center;
}

td {
    text-align: center;
}

tr:nth-child(even) {
    background-color: white;
}

.colm {
    display: flex;
    align-items: center;
    justify-content: center;
}

.colm2 {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 300px;
}

.rower {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-bottom: 10px;
}


.colm p {
    padding: 0px 10px;
    color: blueviolet;
    font-size: large;
    margin-bottom: 0px;
}

label {
    color: blueviolet;
    font-size: large;
}

.hide {
    display: hide;
}

table {
    border-collapse: collapse;
    width: 80%;
}


th {
    height: 80px;
}

.chart {
    display: grid;
    grid-template-columns: 50% 50%;
}

.canvas {
    width: 100%;
    max-width: 600px;
    max-height: 300px;
    padding-bottom: 40px;
}

.d-block {
    margin-bottom: 20px;
}
</style>


<body>
    <!-- Database Connections -->
    <?php
        error_reporting(0);
        $year = date("Y");

        $s = mysqli_query($con, "select distinct cls_deptname from erp_class");
        ?><br>


    <form action="./reports.php">
        <button>
            Go Back
        </button>
    </form>
    <div class="main-container">
        <h1 class="heading">Class Report</h1>
        <hr>
        <div class="top-container">
            <form action="" method="post">
                <div class="form-container">
                    <div class="left">
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
                                <option selected value="<?php echo $_POST['deptc']; ?>">
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
                        <!--  -->
                        <div class="item">
                            <label> Subject Name: </label>
                            <!-- Dynamic data -->
                            <select name='subn' id="sb">
                                <option value="none" selected disabled hidden>--Select--</option>
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
                    </div>
                    <div class="right">
                        <!-- -->
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
                            <!-- <div id="txtHint"><b>Person info will be listed here.</b></div> -->
                        </div>
                        <!--  -->
                        <div class="item">
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
                        <div class="item">
                            <label>Result Type: </label>
                            <input type="radio" id="" name="format" value="Tabular">
                            <label>Tabular</label>
                            <input type="radio" id="" name="format" value="Graph">
                            <label>Graph</label>
                            <input type="radio" id="" name="format" value="Both">
                            <label>Both</label>
                        </div>
                    </div>
                </div>
                <div class="action_buttons">
                    <input class="search-btn" type="submit" value="Clear" name='reset'>
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
                    $ena =  $_POST["ena"];
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
                        $roll = $present = $absent = $passed = $failed = $maxmark = $centum = $above75 = $bt60_74 = $bt50_59 = $bt33_49 = $below33 = 0;
                        $totalmark = $subavg = 0;
                        $minmark = 100;

                        while ($row = mysqli_fetch_assoc($result)) :
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
                                if ($mark_publish >= 75) {
                                    # code...
                                    $passed++;
                                    $above75++;
                                } elseif ($mark_publish >= 60) {
                                    # code...
                                    $bt60_74++;
                                    $passed++;
                                } elseif ($mark_publish >= 50) {
                                    # code...
                                    $bt50_59++;
                                    $passed++;
                                } elseif ($mark_publish >= 33) {
                                    # code...
                                    $bt33_49++;
                                    $failed++;
                                } elseif ($mark_publish < 33) {
                                    # code...
                                    $below33++;
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
                        $percentageBelow33 = round(($below33 / $present) * 100, 2);
                        $percentage33_49 = round(($bt33_49 / $present) * 100, 2);
                        $percentage50_59 = round(($bt50_59 / $present) * 100, 2);
                        $percentage60_74 = round(($bt60_74 / $present) * 100, 2);
                        $percentageabove75 = round(($above75 / $present) * 100, 2);
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
                        $passed = $failed = $maxmark = $centum = $above75 = $bt60_74 = $bt50_59 = $bt33_49 = $below33 = array();
                        $percentageBelow33 = $percentage33_49  = $percentage50_59  = $percentage60_74  = $percentageabove75 = $passpercentage   = $failpercentage   = array();
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
                                $present[$sub_name] = $absent[$sub_name] = $passed[$sub_name] = $failed[$sub_name] = $maxmark[$sub_name] = $centum[$sub_name] = $above75[$sub_name] = $bt60_74[$sub_name] = $bt50_59[$sub_name] = $bt33_49[$sub_name] = $below33[$sub_name] = $totalmark[$sub_name]  = 0;
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
                                if ($mark_publish >= 75) {
                                    # code...
                                    $passed[$sub_name]++;
                                    $above75[$sub_name]++;
                                } elseif ($mark_publish >= 60) {
                                    # code...
                                    $bt60_74[$sub_name]++;
                                    $passed[$sub_name]++;
                                } elseif ($mark_publish >= 50) {
                                    # code...
                                    $bt50_59[$sub_name]++;
                                    $passed[$sub_name]++;
                                } elseif ($mark_publish >= 33) {
                                    # code...
                                    $bt33_49[$sub_name]++;
                                    $failed[$sub_name]++;
                                } elseif ($mark_publish < 33) {
                                    # code...
                                    $below33[$sub_name]++;
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
                            $percentageBelow33[$sub_name] = round(($below33[$sub_name] / $present[$sub_name]) * 100, 2);
                            $percentage33_49[$sub_name] = round(($bt33_49[$sub_name] / $present[$sub_name]) * 100, 2);
                            $percentage50_59[$sub_name] = round(($bt50_59[$sub_name] / $present[$sub_name]) * 100, 2);
                            $percentage60_74[$sub_name] = round(($bt60_74[$sub_name] / $present[$sub_name]) * 100, 2);
                            $percentageabove75[$sub_name] = round(($above75[$sub_name] / $present[$sub_name]) * 100, 2);
                            $passpercentage[$sub_name] = round(($passed[$sub_name] / $present[$sub_name]) * 100, 2);
                            $failpercentage[$sub_name] = round(($failed[$sub_name] / $present[$sub_name]) * 100, 2);
                        }
                    }

                ?>
            <div class="rower">
                <div class='colm'>
                    <p><b>Course :</b> <?php echo $dc; ?></p>
                    <p><b>Dept :</b> <?php echo $dn; ?></p>
                    <p><b>Sem :</b> <?php echo $ds; ?></p>
                    <p><b>Exam :</b> <?php echo $ena; ?></p>
                    <?php if ($subn !== 'all') : ?>
                    <p><b>Subject:</b> <?php echo $subn; ?></p>
                    <?php endif; ?>
                </div>

                <div class="colm2" <?php
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
                    <div class="col-8 text-center">
                        <img src="/h.png" alt="">
                    </div>
                </div><br><br><br>

                <div class="colm">
                    <b>Course :</b> <?php echo $dc; ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Department :</b> <?php echo $dn; ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Semester :</b> <?php echo $ds; ?>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Exam Name :</b> <?php echo $ena; ?>
                </div>
                <center>
                    <table id="dataTable" class="d-block">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Reg.No</th>
                                <th>Student Name</th>
                                <?php if ($subn !== 'all') : ?>
                                <th><?php echo $subn;
                                            endif; ?></th>
                                <?php if ($subn === 'all') : ?>
                                <?php while ($row = mysqli_fetch_assoc($cq)) :
                                                    $noofsubjects++;
                                                ?>
                                <th><?php echo $row['sub_name']; ?></th>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                    $serialNumber = 1;
                                    if ($subn !== 'all') :

                                        $result = mysqli_query($con, $qry);
                                        while ($row = mysqli_fetch_assoc($result)) :

                                    ?>
                            <tr>
                                <td><?php echo $serialNumber++; ?></td>
                                <td><?php echo $row['stu_id']; ?></td>
                                <td><?php echo $row['stu_fname'] . ' ' . $row['stu_lname']; ?></td>
                                <td><?php echo $row['mark_publish']; ?></td>
                            </tr>
                            <?php endwhile;
                                    endif;
                                    if ($subn === 'all') :
                                        foreach ($students as $student) {
                                            $stu_id = $student['stu_id'];
                                            $stu_fname = $student['stu_fname'];
                                            $stu_lname = $student['stu_lname'];
                                            $sub_marks = $student['sub_marks'];
                                        ?>
                            <tr>
                                <td><?php echo $serialNumber++; ?></td>
                                <td> <?php echo $stu_id; ?></td>
                                <td> <?php echo  $stu_fname . ' ' . $stu_lname; ?></td>
                                <?php
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $subject = $row['sub_name'];
                                                ?>
                                <td><?php
                                                        if (isset($sub_marks[$subject])) {
                                                            echo $sub_marks[$subject];
                                                        } ?></td>
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
                </center><br><br><br><br><br><br><br><br><br><br>
                <center>
                    <table class="d-block" id="analysisTable">

                        <thead>
                            <tr>
                                <th>Exam Details</th>
                                <?php if ($subn !== 'all') : ?>
                                <th><?php echo $subn;
                                            endif; ?></th>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) : ?>
                                <th><?php echo $row['sub_name']; ?></th>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Number on Roll</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $roll;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                for ($i = 0; $i < $noofsubjects; $i++) {
                                                    # code...    
                                            ?>
                                <td><?php echo $roll ?></td>

                                <?php  }
                                            endif; ?>
                            </tr>
                            <tr>
                                <th>Number of Present</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $present;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $present[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Number of Absent</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $absent;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $absent[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Number of Passed</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $passed;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $passed[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Number of Failed</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $failed;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $failed[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Pass % </th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php
                                                echo $passpercentage;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php
                                                        $percentage = round(($passed[$sub_name] / $present[$sub_name]) * 100, 2);
                                                        echo $percentage;;
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Fail % </th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php
                                                echo $failpercentage;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php
                                                        $percentage = round(($failed[$sub_name] / $present[$sub_name]) * 100, 2);
                                                        echo $percentage;;
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Subject Average </th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php
                                                $subavg = round(($totalmark / $present), 2);
                                                echo $subavg;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php
                                                        $subavg = round(($totalmark[$sub_name] / $present[$sub_name]), 2);
                                                        echo $subavg;
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Maximum Mark</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $maxmark;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $maxmark[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Minimum Mark</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $minmark;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $minmark[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Number of Centum</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $centum;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $centum[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Above 75% </th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $above75;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $above75[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>60% to 74%</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $bt60_74;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $bt60_74[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>50% to 59%</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $bt50_59;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $bt50_59[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>33% to 49%</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $bt33_49;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $bt33_49[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                            <tr>
                                <th>Below 33%</th>
                                <?php if ($subn !== 'all') : ?>
                                <td><?php echo $below33;
                                            endif; ?></td>
                                <?php if ($subn === 'all') :
                                                $subresult = mysqli_query($con, $cc);
                                                while ($row = mysqli_fetch_assoc($subresult)) :
                                                    $sub_name = $row['sub_name']; ?>
                                <td><?php echo $below33[$sub_name];
                                                        ?></td>
                                <?php endwhile; ?>
                                <?php endif; ?>
                            </tr>
                        </tbody>
                    </table>
                </center>
            </div>
            <div class="download_able table table-striped" <?php
                                                                    if ($format === 'Tabular') {
                                                                        # code...
                                                                        echo 'style="display:none"';
                                                                    }
                                                                    ?>>
                <?php
                        if ($subn !== 'all') :
                        ?>
                <div>
                    <canvas id="myChart" class="canvas"></canvas>
                    <!-- script for chart -->
                    <script>
                    var xValues = ["Above 75 %", "60-74%", "50-59%", "33-49%", "Below 33%"];
                    var yValues = [
                        <?php echo $percentageabove75; ?>,
                        <?php echo $percentage60_74; ?>,
                        <?php echo $percentage50_59; ?>,
                        <?php echo $percentage33_49; ?>,
                        <?php echo $percentageBelow33; ?>
                    ];



                    var barColors = ["red", "green", "blue", "orange", "brown"];

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
                <?php if ($subn === 'all') : ?>
                <div class="chart">
                    <?php
                                $subresult = mysqli_query($con, $cc);
                                while ($row = mysqli_fetch_assoc($subresult)) :
                                    $sub_name = $row['sub_name']; ?>
                    <div>
                        <canvas id="myChart<?php echo $sub_name; ?>" class="canvas"></canvas>
                        <!-- script for chart -->
                        <script>
                        var xValues = ["Above 75 %", "60-74%", "50-59%", "33-49%", "Below 33%"];
                        var yValues = [
                            <?php echo $percentageabove75[$sub_name]; ?>,
                            <?php echo $percentage60_74[$sub_name]; ?>,
                            <?php echo $percentage50_59[$sub_name]; ?>,
                            <?php echo $percentage33_49[$sub_name]; ?>,
                            <?php echo $percentageBelow33[$sub_name]; ?>
                        ];

                        var barColors = ["red", "green", "blue", "orange", "brown"];

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
        <!--  -->

    </div>
</body>



<!-- script for excel conversion -->

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>

<script>
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

<!-- for pdf conversion -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js">
</script>
<center>
    <script>
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
    btn.addEventListener("click", function() {
        html2pdf().set(opt).from(createpdf).save();
    });
    </script>
</center>
<script>
$('#course').on('change', function() {
    var cls_id = this.value;
    // console.log(country_id);
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
//
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
            // console.log(data);
        }
    })
});
//
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
            $('#en').html(result);
            // console.log(data);
        }
    })
});
//
$('#en').on('change', function() {
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
        success: function(result) {
            $('#sb').html(result);
            console.log(result);
        }
    })
});
//
$('#sb').on('change', function() {
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
        success: function(result) {
            $('#rn').html(result);
            console.log(result);
        }
    })
});
</script>

<!-- <script>
    function generatePDF() {
        $('.hideable').show();

        // Choose the element that our invoice is rendered in.
        const element = $('.download_able').html();
        // Choose the element and save the PDF for our user.
        html2pdf()
            .set({
                html2canvas: {
                    scale: 4
                }
            })
            .from(element)
            .save('Class-Result-Report');

        $('.hideable').hide();

    }




    function exportCsv() {

        // const rows = [
        //     ["name1", "city1", "some other info"],
        //     ["name2", "city2", "more info"]
        // ];

        var theader = [
            's.no', 'stu_id', 'name', 'mark_publish', 'total', 'percentage'
        ]

        let csvContent = "data:text/csv;charset=utf-8,";
        theader = theader.join(",")
        csvContent += theader + "\r\n";

        tableData.forEach(function(rowArray) {
            let row = rowArray['s.no'] + ',' + rowArray['stu_id'] + ',' + rowArray['name'] + ',' + rowArray['mark_publish'] + ',' + rowArray['total'] + ',' + rowArray['percentage'];
            csvContent += row + "\r\n";
            // console.log(rowArray);
        });

        // console.log(JSON.parse(tableData));

        var encodedUri = encodeURI(csvContent);
        var link = document.getElementById('export_csv');
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "Class-Result-Report.csv");
        // window.open(encodedUri);
    }

    exportCsv();
    $('.hideable').hide();
</script> -->

</html>

<?php
} else {
    header("Location: ../index.php");
}
?>