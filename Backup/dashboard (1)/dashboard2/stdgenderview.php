<?php
include('../includes/config.php');
$cls_id = (int)$_GET['cls_id'];
$gender = $_GET['gender'];
// echo $cls_id;
$sql = "SELECT * FROM erp_student WHERE stu_gender = '$gender' AND cls_id=$cls_id";
$result = mysqli_query($conn, $sql);
$students = array();
while ($row = $result->fetch_assoc()) {
    $students[] = $row;
}
// print_r($students);


?>
<!DOCTYPE html>
<html lang="en">

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

<body>
<div class="container mt-5">
    <h2>Students</h2>

    <table class="table">
        <thead style="background-color:#470A52; color:white">
            <?php
            // Getting class students
            $class_students = array();
            foreach ($students as $student) {
                if ($cls_id == $student['cls_id']) {
                    $class_students[] = $student;
                }
            }
            ?>
            <tr>
                <th>SI.No</th>
                <th>Student Name</th>
                <th>Register No.</th>
                <th>Gender</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($class_students as $student) {
            ?>
                <tr>
                    <td><?php echo $i ?></td>
                    <td><a href="../userProfile/StudentUser/ViewStudent.php?sid=<?php echo $student['stu_id'] ?>" target="_blank"><?php echo $student['stu_fname'] . ' ' . $student['stu_lname'] ?></td>
                    <td><?php echo $student['stu_id'] ?></td>
                    <td><?php echo $student['stu_gender'] ?></td>
                </tr>
            <?php
                $i++;
            } ?>
        </tbody>
    </table>
</div>
</body>
<script>
    $(document).ready(function(e) {
        $('a').click(function(a) {
            a.preventDefault();
            var href = $(this).attr('href');
            console.log(href);
                window.open(href,'_blank', 'resizable,height=600,width=760,left=500,top=100');
        });
    });
</script>

</html>
