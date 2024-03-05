<?php



include('../../includes/config.php');

$profileresult = '';


if (isset($_POST['search'])) {


    // Initialize an empty WHERE clause for the SQL query
    $whereClause = "";

    // Check if Role is selected
    if (isset($_POST['f_role']) && $_POST['f_role'] !== 'Select Role:') {
        $role = $_POST['f_role'];
        // Add the condition to the WHERE clause
        $whereClause .= " AND f_role = '" . $role . "'";
    }

    // Check if Department is selected
    if (isset($_POST['department']) && $_POST['department'] !== 'Select Department') {
        $department = $_POST['department'];
        // Add the condition to the WHERE clause
        $whereClause .= " AND f_dept = '$department'";
    }

    // Check if other fields are provided
    if (!empty($_POST['f_id'])) {
        $facultyId = $_POST['f_id'];
        // Add the condition to the WHERE clause with a pattern match
        $whereClause .= " AND f_id LIKE '%$facultyId%'";
    }

    if (!empty($_POST['f_fname'])) {
        $firstName = $_POST['f_fname'];
        // Add the condition to the WHERE clause with a pattern match
        $whereClause .= " AND f_fname LIKE '%$firstName%'";
    }

    if (!empty($_POST['f_lname'])) {
        $lastName = $_POST['f_lname'];
        // Add the condition to the WHERE clause with a pattern match
        $whereClause .= " AND f_lname LIKE '%$lastName%'";
    }

    if (!empty($_POST['f_mobile'])) {
        $mobile = $_POST['f_mobile'];
        // Add the condition to the WHERE clause with a pattern match
        $whereClause .= " AND f_mobile LIKE '%$mobile%'";
    }



    // Construct the final SQL query
    $profilesql = "SELECT f_id, f_fname, f_lname, f_img, f_status,f_role,f_mobile FROM erp_faculty WHERE 1 $whereClause";



    // Execute the query and handle errors
    $profileresult = mysqli_query($conn, $profilesql);
    if (!$profileresult) {
        die("Query failed: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>

    <!-- Jquery-3 -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


    <link rel="stylesheet" type="text/css" href="../../AdminModule/assets/css/styles_TT.css">

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../../assets/img/gcoe_logo.png">
    <style>
        #profile {
            background-color: var(--pri);
        }
    </style>


    <link rel="stylesheet" type="text/css" href="../../userProfile/assets/css/styles_TT.css">

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
                        <h3 class="m-0">Manage Faculty</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>

                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Search</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>

                    <div class="card-body py-1 d-flex flex-column align-items-center justify-content-center">
                        <form id="TTform5" method="post" action="#">
                            <h2>Search</h2>
                            <div class="d-flex flex-row flex-wrap justify-content-center filter">
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <label class="TT-label" for="f_role">Role:</label>
                                        <select name="f_role">
                                            <option value="Select Role:">Select Role:</option>
                                            <?php
                                            $rolesql = "SELECT DISTINCT r_id,r_rolename from erp_role ";
                                            $roleresult = $conn->query($rolesql);
                                            while ($row = mysqli_fetch_assoc($roleresult)) {
                                                $id = $row['r_id'];
                                                $name = $row['r_rolename'];
                                                echo '<option value="' . $id . '">' . $name . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label class="TT-label" for="department">Department:</label>
                                        <select id="department" name="department" >
                                            <option value="Select Department">Select Department</option>
                                            <?php
                                            $deptsql = "select distinct cls_dept from erp_class ";
                                            $deptresult = $conn->query($deptsql);
                                            while ($row = mysqli_fetch_assoc($deptresult)) {
                                                $dept = $row['cls_dept'];
                                                echo '<option value="' . $dept . '" >' . $dept . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label class="TT-label" for="f_id">Faculty ID:</label>
                                        <input type="text" id="f_id" name="f_id"><br>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label class="TT-label" for="f_fname">First Name:</label>
                                        <input type="text" id="f_fname" name="f_fname"><br>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label class="TT-label" for="f_lname">Last Name:</label>
                                        <input type="text" id="f_lname" name="f_lname"><br>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label class="TT-label" for="f_mobile">Mobile:</label>
                                        <input type="text" id="f_mobile" name="f_mobile"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-row justify-content-around">
                                <button type="submit" name="search" class="TT-button">Search</button>
                                <button type="reset" class="TT-button">Clear</button>
                            </div>
                        </form>
                    </div>
                    <?php

                    if ($profileresult == true) {
                    ?>
                        <div class="d-flex justify-content-center">
                            <table class="TT-type-display-table">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Role</th>
                                        <th>Mobile</th>
                                        <th>Image</th>
                                        <th>Status</th>
                                        <th>Manage</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($profileresult)) {
                                        $i++;
                                    ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $row['f_id']; ?></td>
                                            <td><?php echo $row['f_fname'] . ' ' . $row['f_lname']; ?></td>
                                            <td>
                                                <?php
                                                $rolesql = "SELECT DISTINCT r_id,r_rolename from erp_role where r_id='" . $row['f_role'] . "'";
                                                $roleresult = $conn->query($rolesql);
                                                while ($role = mysqli_fetch_assoc($roleresult)) {
                                                    $id = $role['r_id'];
                                                    $name = $role['r_rolename'];
                                                    echo  $name;
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $row['f_mobile'] ?></td>
                                            <td>
                                                <img src="../../assets/img/profile/<?php echo $row['f_img']; ?>" alt="No Image" height="80px" width="80px">
                                            </td>
                                            <td>
                                                <form method="post" action="">
                                                    <input type="hidden" name="fid" value="<?php echo $row['f_id']; ?>">
                                                    <input type="hidden" name="f_status" value="<?php echo $row['f_status']; ?>">
                                                    <button type="button" fId="<?php echo $row['f_id'] ?>" class="btn btn-primary statusBtn" data-bs-toggle="modal" data-bs-target="#exampleModal" name="active" style="color: background:<?php echo $row['f_status'] == 'Active' ||  $row['f_status'] == 'active'  ? 'Green' : 'Red' ?>"><?php echo $row['f_status'] ?></button>
                                                </form>
                                            </td>
                                            <td>
                                                <form method="post" action="ViewFaculty.php">
                                                    <input type="hidden" name="fid" value="<?php echo $row['f_id']; ?>">
                                                    <button type="submit" name="view" class="TT-button">View Profile</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </div>
                    <?php
                    }
                    ?>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Change status to</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="container">
                                    <!-- Row 1 -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-outline-success statusChangeBtn">Active</button>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Row 2 -->
                                    <div class="row">
                                        <div class="col">
                                            <div class="d-grid gap-2">
                                                <button type="button" class="btn btn-outline-danger statusChangeBtn">Inactive</button>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="d-grid gap-2">
                                <div id='Result'></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="modalCloseBtn" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>

<script src="../../assets/js/script.js"></script>
<script src="../assets/js/anydata.js"></script>
<script src="../assets/js/script.js"></script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

        $('.statusBtn').click(function(e) {
            var facultyId = $(this).attr('fId');
            console.log(facultyId);

            $('.statusChangeBtn').unbind().click(function(e) {
                var statusChangeValue = $(this).html();
                console.log(statusChangeValue);
                // $('#modalCloseBtn').click();

                // AJAX call for updating the student status
                $.ajax({
                    url: 'ajax/upload.php',
                    type: 'POST',
                    data: {
                        statusChangeValue: statusChangeValue,
                        facultyId: facultyId,
                        Function: 'studentStatusUpdate'
                    },
                    success: function(response) {
                        console.log(response);
                        if (response == "OK") {
                            $("#Result").html(`<div class="alert alert-success fade show" role="alert"> Updated the status successfully! </div>`);
                        } else {
                            $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                        }
                        setTimeout(function() {
                            $("#Result").html('');
                            location.reload();
                        }, 1000);

                    }
                });

            });
        });
    });
</script>

</html>