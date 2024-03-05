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
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

</head>

<body>
    <?php include('../includes/config.php'); ?>
    <?php include('../includes/header.php'); ?>

    <div class="main-container">
        <?php include('../includes/sidebar.php'); ?>
        <main>
            <!-- Navigation for  user profile -->

            <div class="d-flex justify-content-center pt-3">
                <div class="report-box">
                    <div class="d-flex">
                        <h2>User Profile</h2>
                    </div>
                    <div class="d-flex">
                        <div class="d-flex flex-column m-3 mx-5">
                            <h6>Faculty User</h6>
                            <a href="./FacultyUser/Create_faculty.php">Create Faculty</a>
                            <a href="./FacultyUser/ManageFaculty.php">Manage Faculty</a>
                            <a href="facultyBulkUpload.php">Faculty Bulk Upload</a>
                        </div>

                        <div class="d-flex flex-column m-3 mx-5">
                            <h6>Student User</h6>
                            <a href="./StudentUser/CreateStudent.php">Create Student</a>
                            <a href="./StudentUser/ManageStudent.php">Manage Student</a>
                            <a href="studentBulkUpload.php">Student Bulk Upload</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Navigation for  user profile -->
        </main>
    </div>

    <?php include('../includes/footer.php'); ?>
</body>
<script src="../assets/js/script.js"></script>
<!--  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<!--  -->

</html>