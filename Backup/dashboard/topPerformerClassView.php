<?php
if (isset($_SESSION['user_id'])) {
    if (isset($_GET['studentIds'])) {
        $studentIds = $_GET['studentIds'];
        $department = $_GET['department'];
        $semester = $_GET['semester'];
        $studentIds = explode(',', $studentIds);
    }
    $studentInfoArray = array();
    foreach ($studentIds as $studentId) {
        $sql = "SELECT * FROM erp_student Where stu_id = '$studentId'";
        $result = mysqli_query($conn, $sql);
        while ($row = $result->fetch_assoc()) {
            $studentInfoArray[] = $row;
        }
    }

    ?>
    <html lang="en">

    <head>

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Students</title>

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

            <!-- jQuery -->
            <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>

            <!-- Popper.js -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

            <!-- Bootstrap JS -->
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        </head>
    </head>

    <body>

        <div class="container mt-5">
            <h2>Students</h2>

            <table class="table">
                <thead style="background-color:#470A52; color:white">
                    <tr>
                        <th>SI.No</th>
                        <th>Student Name</th>
                        <th>Department</th>
                        <th>Register No.</th>
                        <th>Mobile Number</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1;
                    foreach ($studentInfoArray as $studentInfo) { ?>
                        <tr>
                            <td>
                                <?php echo $i ?>
                            </td>
                            <td><a href="../userProfile/StudentUser/ViewStudent.php?sid=<?php echo $studentInfo['stu_id'] ?>"
                                    target='WikipediaWindow'>
                                    <?php echo $studentInfo['stu_fname'] . ' ' . $studentInfo['stu_lname'] ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $department . ' Sem - ' . $semester ?>
                            </td>
                            <td>
                                <?php echo $studentInfo['stu_id'] ?>
                            </td>
                            <td>
                                <?php echo $studentInfo['stu_mobile'] ?>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    } ?>
                </tbody>
            </table>
        </div>
    </body>
    <script>
        $(document).ready(function (e) {
            $('a').click(function (a) {
                a.preventDefault();
                var href = $(this).attr('href');
                console.log(href);
                window.open(href, '_blank', 'resizable,height=600,width=760,left=500,top=100');
            });
        });
    </script>

    </html>
<?php } ?>