<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GracER</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../../assets/img/gcoe_logo.png">
    <style>
        #profile {
            background-color: var(--pri);
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/anydata.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>




    <!-- Jquery-3 -->
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <!-- sweet alert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        <h3 class="m-0">Create Student</h3>
                        <div>
                            <a href="../index.php">Back</a>

                        </div>

                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Create</h6>
                        </div>
                    </div>

                    <div class="card-body py-1 d-flex flex-column align-items-center justify-content-center">
                        <form method="post" id="createStudentForm" action="Studentdataupload.php" enctype="multipart/form-data" class="mb-4">
                            <div class="d-flex flex-row flex-wrap justify-content-center filter">

                                <div class="d-flex flex-column">
                                    <div class="d-flex">
                                        <p>Personal Details</p>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="sid">Roll Number :</label>
                                        <input type="text" id="sId" name="sid" value="" onchange="populateid()">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="admno">Register Number :</label>
                                        <input type="text" name="admno" id="admno">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="studentProfilePic">Profile Picture :</label>
                                        <input type="file" name="studentProfileImage[]" id="studentProfilePic" placeholder="Upload your picture" onchange="">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="fname">First Name :</label>
                                        <input type="text" id="fname" name="first_name">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="lname">Last Name : </label>
                                        <input type="text" id="lname" name="last_name">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="Initials">Initials: </label>
                                        <input type="text" name="Initials" value="" id="Initials" placeholder="Enter your Initials ">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="dob">Date of Birth :</label>
                                        <input type="date" id="dob" name="date_of_birth">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="gender">Gender:</label>
                                        <span>
                                            <input type="radio" id="male" name="gender" value="Male" checked>Male
                                            <input type="radio" id="female" name="gender" value="Female">Female
                                        </span>
                                    </div>
                                </div>
                                <div class="d-flex flex-column">
                                    <div class="d-flex flex-row">
                                        <label for="clsid">Class :</label>
                                        <select name="clsid">
                                            <option>--Select class--</option>
                                            <?php
                                            $classsql = "SELECT distinct cls_id,cls_course,cls_dept,cls_startyr,cls_endyr from erp_class ";
                                            $classresult = $conn->query($classsql);
                                            while ($row = mysqli_fetch_assoc($classresult)) {
                                                echo '<option value="' . $row['cls_id'] . '">' . $row['cls_course'] . '-' . $row['cls_dept'] . '. Batch(' . $row['cls_startyr'] . '-' . $row['cls_endyr'] . ')</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="doj">Date of Joining :</label>
                                        <input type="date" id="doj" name="doj">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="mobileNum">Mobile Number :</label>
                                        <input type="number" id="mobileNum" name="mobile_number" />
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="email">Email ID : </label>
                                        <input type="email" id="email" name="email">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="coursetype">Course Type :</label>
                                        <select name="coursetype">
                                            <option>--Select Course Type--</option>
                                            <option value="Regular">Regular</option>
                                            <option value="Part Time">Part Time</option>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="quota">Student quota :</label>
                                        <select name="quota">
                                            <option>--Select quota Type--</option>
                                            <option value="Counselling">Counselling</option>
                                            <option value="Management">Management</option>
                                        </select>
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="counsellingNumber">Counselling Number (Optional) : </label>
                                        <input type="text" id="counsellingNumber" name="counsellingNumber">
                                    </div>
                                    <div class="d-flex flex-row">
                                        <label for="stu_lateral">Lateral Entry:</label>
                                        <span>
                                            <input type="radio" name="stu_lateral" value="Yes"> Yes
                                            <input type="radio" name="stu_lateral" value="No" checked> No
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex mr-23px justify-content-around">
                                <button type="submit" name="create">Create Profile</button>
                                <button type="reset">Clear</button>
                            </div>
                        </form>
                    </div>

                    <div id="Result"></div>
                    <form id="redirectFidValueForm" method="post" enctype="multipart/form-data" action="ViewStudent.php">
                        <div>
                            <label hidden for="usr_name">Id:</label>
                            <input type="text" value="" name="sid" id="username2" hidden>
                        </div>
                    </form>
                </div>
            </div>

        </main>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
<script src="../../assets/js/script.js"></script>
<script src="../assets/js/anydata.js"></script>
<script src="../assets/js/script.js"></script>



<script>
    // Populate sid for redirection form
    function populateid() {
        var sid = document.getElementById('sId').value;
        document.getElementById('username2').value = sid;
    }



    $(document).ready(function() {
        $('#createStudentForm').submit(function(e) {
            e.preventDefault();

            //  Acquiring values from the input fields from create faculty form


            // Student details
            var fileSize = 0;
            var sId = $('#sId').val();
            var admno = $("#admno").val();
            var studentProfilePic = $("#studentProfilePic")
                .val(); // Note: File input values are not directly accessible due to security reasons

            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var Initials = $('#Initials').val();
            // var Salutations = $('#Salutations').val();

            var dob = $("#dob").val();
            var gender = $("input[name='gender']:checked").val();
            var lateral = $("input[name='stu_lateral']:checked").val();
            var clsid = $("select[name='clsid']").val();
            var doj = $("#doj").val();
            var mobileNum = $("#mobileNum").val();
            var email = $("#email").val();
            var counsellingNumber = $("#counsellingNumber").val();
            var coursetype = $("select[name='coursetype']").val();
            var quota = $("select[name='quota']").val();
            var operation = 'insert';

            last_name = last_name + " " + Initials;

            // first_name = Salutations + "." + first_name;

            // // Log the values to the console
            // console.log("sId:", sId);
            // console.log("admno:", admno);
            // console.log("studentProfilePic:", studentProfilePic);
            // console.log("fname:", fname);
            // console.log("lname:", lname);
            // console.log("dob:", dob);
            // console.log("gender:", gender);
            // console.log("clsid:", clsid);
            // console.log("doj:", doj);
            // console.log("mobileNum:", mobileNum);
            // console.log("email:", email);
            // console.log("coursetype:", coursetype);
            // console.log("quota:", quota);
            // console.log("operation:", operation);

            // Creating artificial form data structure
            var formData = new FormData(this);

            // Append each variable to the FormData object
            formData.append('sId', sId);
            formData.append('admno', admno);
            formData.append('studentProfilePic', studentProfilePic);
            formData.append('fname', fname);
            formData.append('lname', lname);
            formData.append('dob', dob);
            formData.append('gender', gender);
            formData.append('lateral', lateral);
            formData.append('clsid', clsid);
            formData.append('doj', doj);
            formData.append('mobileNum', mobileNum);
            formData.append('email', email);
            formData.append('counsellingNumber', counsellingNumber);
            formData.append('coursetype', coursetype);
            formData.append('quota', quota);
            formData.append('operation', operation);

            // Logic for checking the size of the image file being uploaded
            if ($("#studentProfilePic").val() !== '') {
                // Logic for checking the size of the image file being uploaded
                var fileSize = ($("#studentProfilePic")[0].files[0].size / 1024);
                fileSize = (Math.round(fileSize * 100) / 100);
            }
            setTimeout(function() {
                if (fileSize <= 800) {
                    $.ajax({
                        url: 'ajax/upload.php',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            console.log(response);
                            if (response == "OK") {
                                $("#Result").html(
                                    `<div class="alert alert-success fade show" role="alert"> Created successfully! </div>`
                                );
                                Swal.fire({
                                    title: "Profile created successfully! Would you like to update more profile info?",
                                    showCancelButton: true,
                                    confirmButtonText: "Update",
                                    cancelButtonText: "No, thanks",
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        // Redirect to a page for updating more profile info
                                        $("#redirectFidValueForm").submit();
                                    } else {
                                        // Refresh the current page
                                        window.location.reload();
                                    }
                                });
                                // if (window.confirm("Profile created successfully! Would you like to update more profile info?")) {
                                //     // Redirect to a page for updating more profile info
                                //     $("#redirectFidValueForm").submit();
                                // } else {
                                //     // Refresh the current page
                                //     window.location.reload();
                                // }
                            } else {
                                $("#Result").html(
                                    `<div class="alert alert-danger fade show" role="alert"> ${response}</div>`
                                );
                            }
                            setTimeout(function() {
                                $("#Result").html('');
                            }, 5000);

                        }
                    });
                    console.log('Good to upload~!');
                } else {
                    $("#Result").html(
                        `<div class="alert alert-danger fade show" role="alert"> File size has to be within 800kb</div>`
                    );
                }
            }, 2000);
        });
    });
</script>

</html>