<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <!-- <script src="tableExport/tableExport.js"></script>
    <script type="text/javascript" src="tableExport/jquery.base64.js"></script>
    <script src="js/export.js"></script> -->
    <title>Reports</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
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

    table {
        width: 80%;
    }

    .hide {
        display: hide;
    }

    th {
        height: 80px;
    }
</style>


<body>
    <!-- Database Connections -->
    <?php
    error_reporting(0);
    $year = date("Y");
    $con = mysqli_connect("localhost", "root", "", "graceerp");
    $s = mysqli_query($con, "select distinct cls_deptname from erp_class");
    ?><br>
    <form action="./reports.php">
        <button>
            Go Back
        </button>
    </form>
    <div class="main-container">
        <h1 class="heading"> Result Posted Report</h1>
        <hr>
        <div class="top-container">
            <div class="form-container">
                <div class="left">
                    <form action="" method="post">

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
                // $fs =$_POST["fs"];
                $sqlq = "SELECT erp_mark.mark_date as mdate,erp_subject.f_id as id,erp_faculty.f_fname as fname,erp_faculty.f_lname as lname FROM erp_mark
                JOIN erp_exam
                ON erp_exam.exam_id = erp_mark.exam_id
                JOIN erp_class
                ON erp_mark.cls_id = erp_class.cls_id
                JOIN erp_createexam
                ON erp_mark.ce_id = erp_createexam.ce_id
                JOIN erp_subject
                ON erp_exam.tt_subcode = erp_subject.tt_subcode
                JOIN erp_test
                ON erp_test.test_id = erp_exam.test_id
                JOIN erp_faculty
                ON erp_faculty.f_id = erp_subject.f_id where cls_course='$dc' AND cls_dept='$dn' AND cls_sem='$ds'
                AND ce_exam='$ena' AND sub_name='$subn' AND cls_startyr<'$year'<cls_startyr  
ORDER BY `erp_mark`.`exam_id` ASC;";
                $qry = mysqli_query($con, $sqlq);
            ?>
                <div class="rower">
                    <div class='colm'>
                        <p><b>Course :</b> <?php echo $dc; ?></p>
                        <p><b>Dept :</b> <?php echo $dn; ?></p>
                        <p><b>Sem :</b> <?php echo $ds; ?></p>
                        <p><b>Subject :</b> <?php echo $subn; ?></p>
                        <p><b>Exam :</b> <?php echo $ena; ?></p>
                    </div>
                    <div class='colm2'>
                        <button class="btn">
                            <a href="javascript:void(0);" id="export_csv">Export to Excel</a>
                        </button>&emsp;&emsp;
                        <button class="btn">
                            <a href="javascript:void(0);" onclick="generatePDF()">Export to PDF</a>
                        </button>
                    </div>
                </div>
                <script>
                    var tableData = [];
                </script>
                <div class="download_able table table-striped">
                    <div class="row hideable">
                        <!-- <div class="col-8">< enter your clg nme ></div> -->
                        <div class="col-8 text-center">
                            <img src="./h.png" style="height:150px;margin:50px" alt="logo">
                        </div>
                    </div>
                    <center>
                        <table id="dataTable" class="d-block">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Exam</th>
                                    <th> Semester</th>
                                    <th>Posted Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($r = mysqli_fetch_array($qry)) {
                                    if ($i == 1) {

                                ?>
                                        <tr>
                                            <td><?php echo $i;
                                                $i++; ?></td>
                                            <td><?php echo $ena; ?></td>
                                            <td><?php echo $ds ?></td>
                                            <td><?php echo "Posted On " . $r['mdate'] . " By " . $r['fname'] . " " . $r['lname'] ?></td>
                                        </tr>
                                        <script>
                                            tableData.push({
                                                's.no': `<?php echo ($i - 1); ?>`,
                                                'stu_id': `<?php echo $r['stu_id']; ?>`,
                                                'name': `<?php echo $r['stu_fname']; ?> <?php echo $r['stu_lname']; ?>`,
                                                'mark_publish': `<?php echo $r['mark_publish']; ?>`,
                                                'total': `<?php echo $tot; ?>`,
                                                'percentage': `<?php echo $per; ?>`,
                                            });
                                        </script>
                                <?php
                                    }
                                    $i = 0;
                                }

                                ?>
                            </tbody>
                            < </table>
                    </center>

                    <script>
                        var graph_data = [];
                    </script>

                    <div class="graph text-center">
                        <?php
                        if (isset($_POST['format']) && $_POST['format'] != 'Tabular') {

                            $year = date("Y");
                            $sid = $_POST["sid"];
                            $dc = $_POST["deptc"];
                            $ena =  $_POST["ena"];
                            $ds = $_POST["depts"];
                            $dn = $_POST["deptn"];
                            $subn = $_POST["subn"];
                            $mysqli = new mysqli("localhost", "root", "", "graceerp");

                            $sql = "SELECT erp_mark.mark_draft,erp_exam.tt_subcode FROM erp_mark 
                                LEFT join erp_exam on erp_exam.exam_id = erp_mark.exam_id
                                WHERE stu_id = '$sid' ";


                            $result = mysqli_query($con, $sql);

                            // $result -> free_result();

                            // $mysqli -> close();
                        ?>
                            <script>
                                var graph_data = JSON.parse('<?php echo json_encode(mysqli_fetch_all($result, MYSQLI_NUM)); ?>');
                            </script>


                            <img src="" id="graphImage" class="hideable" alt="" style="width:100%;align:center;margin:20px;">

                            <canvas id="myChart" style="width:50vh;height:20vh;align:center;"></canvas>

                        <?php
                        }
                        ?>
                    </div>

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
<script src="./html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


<!-- chart -->
<script>
    var xValues = [];

    var yValues = [];
    var barColors = [];
    var availableColors = ["red", "green", "blue", "orange", "brown"];
    graph_data.forEach(function(arr) {

        yValues.push(arr[0]);
        xValues.push(arr[1]);

        barColors.push(availableColors[Math.floor((Math.random() * 5) + 1)])
    })


    new Chart("myChart", {
        type: "bar",
        data: {
            labels: xValues,
            datasets: [{
                backgroundColor: barColors,
                data: yValues
            }]
        },
        options: {
            legend: {
                display: false
            },
            title: {
                display: true,
                text: ""
            }
        }
    });
</script>
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

    // function getRollnumber() {
    //     var c = this.options[this.selectedIndex].getAttribute("course");
    //     var d = this.options[this.selectedIndex].getAttribute("dept");
    //     var s = this.options[this.selectedIndex].getAttribute("sem");
    //     var en = this.options[this.selectedIndex].getAttribute("en");
    //     var sb = this.options[this.selectedIndex].getAttribute("sb");
    //     console.log(c);
    //     console.log(d);
    //     console.log(s);
    //     console.log(en);
    //     console.log(sb);
    //     $.ajax({
    //         url: 'ajax/sub.php',
    //         type: "POST",
    //         data: {
    //             c: c,
    //             d: d,
    //             s: s,
    //             en: en,
    //             sb: sb
    //         },
    //         success: function(result) {
    //             $('#rn').html(result);
    //             console.log(result);
    //         }
    //     });
    // }
    // getRollnumber();
</script>

<script>
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
            .save('Result Posted Status-Report');

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
        link.setAttribute("download", "Individual-Result-Report.csv");
        // window.open(encodedUri);
    }

    exportCsv();
    $('.hideable').hide();
</script>

</html>