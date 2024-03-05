<?php

include('../../includes/config.php');

// To initialize the files array for this page, to record only files for this page at once
$_FILES = array();



if (isset($_POST['sid'])) {
    $sid  = $_POST['sid'];
}
if (isset($_GET['sid'])) {
    $sid  = $_GET['sid'];
}

$sql = 'SELECT * from erp_student where stu_id="' . $sid . '"';
$result = $conn->query($sql);

$studentData = mysqli_fetch_assoc($result);



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

    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="icon" sizes="196x196" type="image/x-icon" href="../../assets/img/gcoe_logo.png">
    <style>
        #profile {
            background-color: var(--pri);
        }
    </style>


    <link rel="stylesheet" type="text/css" href="../../userProfile/assets/css/styles_TT.css">


    <style>
        .TT-form {
            display: none;
            border: 1px solid black;
            border-top: 0;
        }
    </style>
    <!-- <link rel="stylesheet" type="text/css" href="../../AdminModule/assets/css/styles_TT.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="../../AdminModule/assets/css/style_TT.css"> -->
    <link rel="stylesheet" type="text/css" href="../assets/css/styles.css">
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
                        <h3 class="m-0">Student Profile</h3>
                        <div>
                            <a href="../index.php">Back</a>
                            <!-- <a href="ManageFaculty.php">Manage Profile</a> -->
                        </div>

                    </div>
                    <div class="card-header border-top">
                        <div class="d-flex flex-row justify-content-between">
                            <h6 class='mb-0'>Update</h6>
                            <h6 class='mb-0'></h6>
                        </div>
                    </div>




                    <div class="Tablinks d-flex justify-content-between">
                        <button class="header-button tab active" onclick="showform('basicinfo')" id="basicinfo-tab">
                            <p>Basic Information</p>
                        </button>

                        <button class="header-button tab " onclick="showform('Personal')" id="Personal-tab">
                            <p>Personal Information</p>
                        </button>

                        <button class="header-button tab " onclick="showform('Health')" id="Health-tab">
                            <p>Health Information</p>
                        </button>

                        <button class="header-button tab " onclick="showform('Family')" id="Family-tab">
                            <p>Family Information</p>
                        </button>

                        <button class="header-button tab " onclick="showform('Address')" id="Address-tab">
                            <p>Address</p>
                        </button>
                        <button class="header-button tab " onclick="showform('Accommodation')" id="Accommodation-tab">
                            <p>Accommodation</p>
                        </button>
                        <button class="header-button tab " onclick="showform('Scholarship')" id="Scholarship-tab">
                            <p>Scholarship</p>
                        </button>
                        <button class="header-button tab " onclick="showform('GovernmentDocuments')" id="GovernmentDocuments-tab">
                            <p>Government Documents</p>
                        </button>
                    </div>




                    <form method="post" action="Studentdataupload.php" style="display: flex;" id="basicinfo" enctype="multipart/form-data" class="TT-form">

                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('basicinfo')">Enable Edit</button>
                            <div>
                                <label for="sId">Roll Number :</label>
                                <input type="text" name="sId" id="sId" required readonly value="<?php echo $sid ?>">
                            </div>
                            <div>
                                <label for="admno">Admission Number :</label>
                                <input type="text" name="admno" id="admno" value="<?php echo $studentData['stu_admno'] ?>">
                            </div>
                            <div>
                                <label for="studentProfilePic">Profile Picture :</label>
                                <input type="file" name="studentProfileImage[]" id="studentProfilePic" placeholder="Upload your picture" onchange="">
                            </div>
                            <div>
                                <label for="first_name">First Name :</label>
                                <input id="fname" type="text" name="first_name" value="<?php echo $studentData['stu_fname'] ?>" required>
                            </div>
                            <div>
                                <label for="last_name">Last Name : </label>
                                <input id="lname" type="text" name="last_name" value="<?php echo $studentData['stu_lname'] ?>">
                            </div>
                            <div>
                                <label for="date_of_birth">Date of Birth :</label>
                                <input id="dob" type="date" name="date_of_birth" value="<?php echo $studentData['stu_dob'] ?>" required>
                            </div>
                            <div>
                                <label for="gender">Gender:</label>
                                <span>
                                    <input type="radio" id="male" name="gender" value="Male" <?php echo ($studentData['stu_gender'] == 'Male') ? 'checked' : '' ?>>Male
                                    <input type="radio" id="female" name="gender" value="Female" <?php echo ($studentData['stu_gender'] == 'Female') ? 'checked' : '' ?>>Female
                                </span>
                            </div>
                            <div>
                                <label for="clsid">Class :</label>
                                <select name="clsid" required>
                                    <option>--Select class--</option>
                                    <?php
                                    $classsql = "SELECT distinct cls_id,cls_course,cls_dept,cls_startyr,cls_endyr from erp_class ";
                                    $classresult = $conn->query($classsql);
                                    while ($row = mysqli_fetch_assoc($classresult)) {
                                        $id = $row['cls_id'];
                                        $name = $row['cls_course'] . '-' . $row['cls_dept'] . '. Batch(' . $row['cls_startyr'] . '-' . $row['cls_endyr'] . ')';
                                        echo '<option value="' . $id . '"';
                                        echo (isset($studentData['cls_id']) && $studentData['cls_id'] == $id) ? 'selected' : '';
                                        echo '>' . $name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div>
                                <label for="doj">Date of Joining :</label>
                                <input id="doj" type="date" name="doj" value="<?php echo $studentData['stu_doj'] ?>" required>
                            </div>
                            <div>
                                <label for="mobile_number">Mobile Number :</label>
                                <input id="mobileNum" type="number" name="mobile_number" value="<?php echo $studentData['stu_mobile'] ?>" required />
                            </div>
                            <div>
                                <label for="email">Email ID : </label>
                                <input id="email" type="email" name="email" value="<?php echo $studentData['stu_email'] ?>" required>
                            </div>
                            <div>
                                <label for="coursetype">Course Type :</label>
                                <select name="coursetype">
                                    <option>Not selected</option>
                                    <option value="Regular" <?php echo ($studentData['stu_coursetype'] == 'Regular') ? 'selected' : '' ?>>Regular</option>
                                    <option value="Part Time" <?php echo ($studentData['stu_coursetype'] == 'Part Time') ? 'selected' : '' ?>>Part Time</option>
                                </select>
                            </div>
                            <div>
                                <label for="quota">Student quota :</label>
                                <select name="quota">
                                    <option>Not selected</option>
                                    <option value="Counselling" <?php echo ($studentData['stu_quota'] == 'Counselling') ? 'selected' : '' ?>>Counselling</option>
                                    <option value="Management" <?php echo ($studentData['stu_quota'] == 'Management') ? 'selected' : '' ?>>Management</option>
                                </select>
                            </div>
                            <div>
                                <label for="counsellingNumber">Counselling Number (Optional) : </label>
                                <input type="number" id="counsellingNumber" value="<?php echo $studentData['stu_counsellingno'] ?>" name="counsellingNumber">
                            </div>

                            <div>
                                <label for="stu_lateral">Lateral Entry:</label>
                                <span>
                                    <input type="radio" name="stu_lateral" value="Yes" <?php echo ($studentData['stu_lateral'] == 'Yes') ? 'checked' : ''; ?>> Yes
                                    <input type="radio" name="stu_lateral" value="No" <?php echo ($studentData['stu_lateral'] == 'No') ? 'checked' : ''; ?>> No
                                </span>
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" id="basicInfoSubmitBtn" class="TT-button">Update Profile</button>
                            </div>
                        </div>
                        <div id="Result"></div>
                    </form>

                    <form method="post" action="Studentdataupload.php" id="Personal" enctype="multipart/form-data" class="TT-form">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('Personal')">Enable Edit</button>
                            <div>
                                <label for="sid">Roll Number :</label>
                                <input type="text" name="sid" id="sid" required readonly value="<?php echo $sid ?>">
                            </div>
                            <div>
                                <label for="stu_height">Height :</label>
                                <input type="text" name="stu_height" value="<?php echo $studentData['stu_height'] ?>">
                            </div>

                            <div>
                                <label for="stu_weight">Weight :</label>
                                <input type="text" name="stu_weight" value="<?php echo $studentData['stu_weight'] ?>">
                            </div>

                            <div>
                                <label for="stu_mlang">Mother Tongue :</label>
                                <input type="text" name="stu_mlang" value="<?php echo $studentData['stu_mlang'] ?>">
                            </div>

                            <div>
                                <label for="stu_klang">Known Languages :</label>
                                <input type="text" name="stu_klang" value="<?php echo $studentData['stu_klang'] ?>">
                            </div>

                            <div>
                                <label for="stu_idmark">Identification Mark :</label>
                                <input type="text" name="stu_idmark" value="<?php echo $studentData['stu_idmark'] ?>">
                            </div>

                            <div>
                                <label for="stu_extcur">Extra curricular :</label>
                                <input type="text" name="stu_extcur" value="<?php echo $studentData['stu_extcur'] ?>">
                            </div>

                            <div>
                                <label for="stu_hobbies">Hobbies :</label>
                                <input type="text" name="stu_hobbies" value="<?php echo $studentData['stu_hobbies'] ?>">
                            </div>

                            <div>
                                <label for="stu_nationality">Nationality :</label>
                                <input type="text" name="stu_nationality" value="<?php echo $studentData['stu_nationality'] ?>">
                            </div>

                            <div>
                                <label for="stu_religion">Religion :</label>
                                <input type="text" name="stu_religion" value="<?php echo $studentData['stu_religion'] ?>">
                            </div>

                            <div>
                                <label for="stu_emergencyno">Emergency Contact :</label>
                                <input type="text" name="stu_emergencyno" value="<?php echo $studentData['stu_emergencyno'] ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>
                            </div>
                        </div>

                    </form>


                    <form method="post" action="Studentdataupload.php" id="Health" enctype="multipart/form-data" class="TT-form">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('Health')">Enable Edit</button>
                            <div>
                                <label for="sid">Roll Number :</label>
                                <input type="text" name="sid" id="sid" required readonly value="<?php echo $sid ?>">
                            </div>
                            <div>
                                <label for="stu_bloodgrp">Blood Group :</label>
                                <select name="stu_bloodgrp">
                                    <option value="">--Select Blood Group--</option>
                                    <option id="A+" value="A+" <?php echo (isset($studentData['stu_bloodgrp']) && $studentData['stu_bloodgrp'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                                    <option id="A-" value="A-" <?php echo (isset($studentData['stu_bloodgrp']) && $studentData['stu_bloodgrp'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                                    <option id="B+" value="B+" <?php echo (isset($studentData['stu_bloodgrp']) && $studentData['stu_bloodgrp'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                                    <option id="B-" value="B-" <?php echo (isset($studentData['stu_bloodgrp']) && $studentData['stu_bloodgrp'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                                    <option id="O+" value="O+" <?php echo (isset($studentData['stu_bloodgrp']) && $studentData['stu_bloodgrp'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                                    <option id="O-" value="O-" <?php echo (isset($studentData['stu_bloodgrp']) && $studentData['stu_bloodgrp'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                                    <option id="AB+" value="AB+" <?php echo (isset($studentData['stu_bloodgrp']) && $studentData['stu_bloodgrp'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                    <option id="AB-" value="AB-" <?php echo (isset($studentData['stu_bloodgrp']) && $studentData['stu_bloodgrp'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                </select>
                            </div>

                            <div>
                                <label for="stu_disability">Disability :</label>
                                <input type="text" name="stu_disability" value="<?php echo $studentData['stu_disability'] ?>">
                            </div>

                            <div>
                                <label for="stu_disid">Disability ID :</label>
                                <input type="text" name="stu_disid" value="<?php echo $studentData['stu_disid'] ?>">
                            </div>

                            <div>
                                <label for="stu_distype">Disability Type :</label>
                                <input type="text" name="stu_distype" value="<?php echo $studentData['stu_distype'] ?>">
                            </div>

                            <div>
                                <label for="stu_disper">Disability Percentage :</label>
                                <input type="text" name="stu_disper" value="<?php echo $studentData['stu_disper'] ?>">
                            </div>

                            <div>
                                <label for="stu_pdoctor">Personal Doctor :</label>
                                <input type="text" name="stu_pdoctor" value="<?php echo $studentData['stu_pdoctor'] ?>">
                            </div>

                            <div>
                                <label for="stu_pdoctorno">Doctor Contact Number :</label>
                                <input type="text" name="stu_pdoctorno" value="<?php echo $studentData['stu_pdoctorno'] ?>">
                            </div>

                            <div>
                                <label for="stu_bp">Blood Pressure :</label>
                                <input type="text" name="stu_bp" value="<?php echo $studentData['stu_bp'] ?>">
                            </div>

                            <div>
                                <label for="stu_visionL">Vision (Left) :</label>
                                <input type="text" name="stu_visionL" value="<?php echo $studentData['stu_visionL'] ?>">
                            </div>

                            <div>
                                <label for="stu_visionR">Vision (Right) :</label>
                                <input type="text" name="stu_visionR" value="<?php echo $studentData['stu_visionR'] ?>">
                            </div>

                            <div>
                                <label for="stu_eyecon">Eye Condition :</label>
                                <input type="text" name="stu_eyecon" value="<?php echo $studentData['stu_eyecon'] ?>">
                            </div>

                            <div>
                                <label for="stu_pulse">Pulse Rate :</label>
                                <input type="text" name="stu_pulse" value="<?php echo $studentData['stu_pulse'] ?>">
                            </div>

                            <div>
                                <label for="stu_squint">Squint :</label>
                                <input type="text" name="stu_squint" value="<?php echo $studentData['stu_squint'] ?>">
                            </div>

                            <div>
                                <label for="stu_dentalcon">Dental Condition :</label>
                                <input type="text" name="stu_dentalcon" value="<?php echo $studentData['stu_dentalcon'] ?>">
                            </div>

                            <div>
                                <label for="stu_healthcon">Overall Health Condition :</label>
                                <input type="text" name="stu_healthcon" value="<?php echo $studentData['stu_healthcon'] ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>
                            </div>
                        </div>
                    </form>

                    <form method="post" action="Studentdataupload.php" id="Family" enctype="multipart/form-data" class="TT-form">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('Family')">Enable Edit</button>
                            <div>
                                <label for="sid">Roll Number :</label>
                                <input type="text" name="sid" id="sid" required readonly value="<?php echo $sid ?>">
                            </div>
                            <h5 class='mb-0'>Father's Information</h5>
                            <div>

                                <label for="stu_father">Father's Name :</label>
                                <input type="text" name="stu_father" value="<?php echo $studentData['stu_father'] ?>">
                            </div>

                            <div>
                                <label for="stu_fqualification">Father's Qualification :</label>
                                <input type="text" name="stu_fqualification" value="<?php echo $studentData['stu_fqualification'] ?>">
                            </div>

                            <div>
                                <label for="stu_foccupation">Father's Occupation :</label>
                                <input type="text" name="stu_foccupation" value="<?php echo $studentData['stu_foccupation'] ?>">
                            </div>

                            <div>
                                <label for="stu_fmobile">Father's Mobile Number :</label>
                                <input type="text" name="stu_fmobile" value="<?php echo $studentData['stu_fmobile'] ?>">
                            </div>

                            <h5 class='mb-0'>Mother's Information</h5>
                            <div>

                                <label for="stu_mother">Mother's Name :</label>
                                <input type="text" name="stu_mother" value="<?php echo $studentData['stu_mother'] ?>">
                            </div>

                            <div>
                                <label for="stu_moccupation">Mother's Occupation :</label>
                                <input type="text" name="stu_moccupation" value="<?php echo $studentData['stu_moccupation'] ?>">
                            </div>

                            <div>
                                <label for="stu_mmobile">Mother's Mobile Number :</label>
                                <input type="text" name="stu_mmobile" value="<?php echo $studentData['stu_mmobile'] ?>">
                            </div>

                            <h5 class='mb-0'>Guardian's Information</h5>
                            <div>

                                <label for="stu_guardian">Guardian's Name :</label>
                                <input type="text" name="stu_guardian" value="<?php echo $studentData['stu_guardian'] ?>">
                            </div>

                            <div>
                                <label for="stu_gmobile">Guardian's Mobile Number :</label>
                                <input type="text" name="stu_gmobile" value="<?php echo $studentData['stu_gmobile'] ?>">
                            </div>

                            <h5 class='mb-0'>Sibling's Information</h5>
                            <div>

                                <label for="stu_sibdetail">Sibling Details :</label>
                                <input type="text" name="stu_sibdetail" value="<?php echo $studentData['stu_sibdetail'] ?>">
                            </div>

                            <div>
                                <label for="stu_sibinsame">Siblings in the Same School :</label>
                                <input type="text" name="stu_sibinsame" value="<?php echo $studentData['stu_sibinsame'] ?>">
                            </div>

                            <div>
                                <label for="stu_orphan">Is the Student An Orphan?</label>
                                <span>
                                    <input type="radio" name="stu_orphan" value="Yes" <?php echo (isset($studentData['stu_orphan']) && $studentData['stu_orphan'] == 'Yes') ? 'checked' : ''; ?>>Yes
                                    <input type="radio" name="stu_orphan" value="No" <?php echo (isset($studentData['stu_orphan']) && $studentData['stu_orphan'] == 'No') ? 'checked' : ''; ?>>No
                                </span>
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>
                            </div>
                        </div>
                    </form>

                    <form method="post" action="Studentdataupload.php" id="Address" enctype="multipart/form-data" class="TT-form">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('Address')">Enable Edit</button>
                            <div>
                                <label for="sid">Roll Number :</label>
                                <input type="text" name="sid" id="sid" required readonly value="<?php echo $sid ?>">
                            </div>
                            <div>
                                <label for="stu_padd">Permanent Address:</label>
                                <input type="text" name="stu_padd" value="<?php echo $studentData['stu_padd'] ?>">
                            </div>

                            <div>
                                <label for="stu_city">City:</label>
                                <input type="text" name="stu_city" value="<?php echo $studentData['stu_city'] ?>">
                            </div>

                            <div>
                                <label for="stu_state">State:</label>
                                <input type="text" name="stu_state" value="<?php echo $studentData['stu_state'] ?>">
                            </div>

                            <div>
                                <label for="stu_zip">Pin Code:</label>
                                <input type="text" name="stu_zip" value="<?php echo $studentData['stu_zip'] ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Address</button>
                            </div>
                        </div>
                    </form>

                    <form method="post" action="Studentdataupload.php" id="Accommodation" enctype="multipart/form-data" class="TT-form">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('Accommodation')">Enable Edit</button>
                            <div>
                                <label for="sid">Roll Number :</label>
                                <input type="text" name="sid" id="sid" required readonly value="<?php echo $sid ?>">
                            </div>
                            <div>
                                <label for="stu_hostel">Stay in Hostel:</label>
                                <span>
                                    <input type="radio" name="stu_hostel" value="Yes" <?php echo ($studentData['stu_hostel'] == 'Yes') ? 'checked' : ''; ?>> Yes
                                    <input type="radio" name="stu_hostel" value="No" <?php echo ($studentData['stu_hostel'] == 'No') ? 'checked' : ''; ?>> No
                                </span>
                            </div>

                            <div>
                                <label for="stu_transport">Use Transportation:</label>
                                <span>
                                    <input type="radio" name="stu_transport" value="Yes" <?php echo ($studentData['stu_transport'] == 'Yes') ? 'checked' : ''; ?>> Yes
                                    <input type="radio" name="stu_transport" value="No" <?php echo ($studentData['stu_transport'] == 'No') ? 'checked' : ''; ?>> No
                                </span>
                            </div>

                            <div>
                                <label for="stu_hosteltype">Hostel Type:</label>
                                <span>
                                    <input type="radio" name="stu_hosteltype" value="Free" <?php echo ($studentData['stu_hosteltype'] == 'Free') ? 'checked' : ''; ?>> Free
                                    <input type="radio" name="stu_hosteltype" value="Paid" <?php echo ($studentData['stu_hosteltype'] == 'Paid') ? 'checked' : ''; ?>> Paid
                                </span>
                            </div>

                            <div>
                                <label for="stu_roomno">Room Number:</label>
                                <input type="text" name="stu_roomno" value="<?php echo $studentData['stu_roomno'] ?>">
                            </div>

                            <div>
                                <label for="stu_food">Food Preference:</label>
                                <span>
                                    <input type="radio" name="stu_food" value="Veg" <?php echo ($studentData['stu_food'] == 'Veg') ? 'checked' : ''; ?>> Veg
                                    <input type="radio" name="stu_food" value="Non Veg" <?php echo ($studentData['stu_food'] == 'Non Veg') ? 'checked' : ''; ?>> Non Veg
                                </span>
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Accommodation</button>
                            </div>
                        </div>
                    </form>


                    <form method="post" action="Studentdataupload.php" id="Scholarship" enctype="multipart/form-data" class="TT-form">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('Scholarship')">Enable Edit</button>
                            <div>
                                <label for="sid">Roll Number :</label>
                                <input type="text" name="sid" id="sid" required readonly value="<?php echo $sid ?>">
                            </div>
                            <div>
                                <label for="stu_nameasbank">Name as per Bank Records:</label>
                                <input type="text" name="stu_nameasbank" value="<?php echo $studentData['stu_nameasbank'] ?>">
                            </div>

                            <div>
                                <label for="stu_accno">Bank Account Number:</label>
                                <input type="text" name="stu_accno" value="<?php echo $studentData['stu_accno'] ?>">
                            </div>

                            <div>
                                <label for="stu_ifsc">Bank IFSC Code:</label>
                                <input type="text" name="stu_ifsc" value="<?php echo $studentData['stu_ifsc'] ?>">
                            </div>

                            <div>
                                <label for="stu_bankname">Bank Name:</label>
                                <input type="text" name="stu_bankname" value="<?php echo $studentData['stu_bankname'] ?>">
                            </div>

                            <div>
                                <label for="stu_brancename">Branch Name:</label>
                                <input type="text" name="stu_brancename" value="<?php echo $studentData['stu_brancename'] ?>">
                            </div>

                            <div>
                                <label for="stu_scholarship">Scholarship Information:</label>
                                <input type="text" name="stu_scholarship" value="<?php echo $studentData['stu_scholarship'] ?>">
                            </div>

                            <div>
                                <label for="stu_scholarsts">Scholarship Status:</label>
                                <input type="text" name="stu_scholarsts" value="<?php echo $studentData['stu_scholarsts'] ?>">
                            </div>

                            <div>
                                <label for="stu_income">Annual Income:</label>
                                <input type="text" name="stu_income" value="<?php echo $studentData['stu_income'] ?>">
                            </div>

                            <div>
                                <label for="stu_inccerno">Income Certificate Number:</label>
                                <input type="text" name="stu_inccerno" value="<?php echo $studentData['stu_inccerno'] ?>">
                            </div>

                            <div>
                                <label for="stu_fg">First Graduate Student:</label>
                                <span>
                                    <input type="radio" name="stu_fg" value="Yes" <?php echo ($studentData['stu_fg'] == 'Yes') ? 'checked' : ''; ?>> Yes
                                    <input type="radio" name="stu_fg" value="No" <?php echo ($studentData['stu_fg'] == 'No') ? 'checked' : ''; ?>> No
                                </span>
                            </div>

                            <div>
                                <label for="stu_splcat">Special Category:</label>
                                <input type="text" name="stu_splcat" value="<?php echo $studentData['stu_splcat'] ?>">
                            </div>



                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Scholarship Info</button>
                            </div>
                        </div>
                    </form>

                    <form method="post" action="Studentdataupload.php" id="GovernmentDocuments" enctype="multipart/form-data" class="TT-form">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('GovernmentDocuments')">Enable Edit</button>
                            <div>
                                <label for="sid">Roll Number :</label>
                                <input type="text" name="sid" id="sid" required readonly value="<?php echo $sid ?>">
                            </div>
                            <div>
                                <label for="stu_aadhar">Aadhar Number:</label>
                                <input type="text" name="stu_aadhar" value="<?php echo $studentData['stu_aadhar'] ?>">
                            </div>

                            <div>
                                <label for="stu_ppno">Passport Number:</label>
                                <input type="text" name="stu_ppno" value="<?php echo $studentData['stu_ppno'] ?>">
                            </div>

                            <div>
                                <label for="stu_ppissueat">Passport Issued At:</label>
                                <input type="text" name="stu_ppissueat" value="<?php echo $studentData['stu_ppissueat'] ?>">
                            </div>

                            <div>
                                <label for="stu_issuedate">Issue Date:</label>
                                <input type="text" name="stu_issuedate" value="<?php echo $studentData['stu_issuedate'] ?>">
                            </div>

                            <div>
                                <label for="stu_ppexpdate">Passport Expiry Date:</label>
                                <input type="date" name="stu_ppexpdate" value="<?php echo $studentData['stu_ppexpdate'] ?>">
                            </div>

                            <div>
                                <label for="stu_visa">Visa Details:</label>
                                <textarea name="stu_visa"><?php echo $studentData['stu_visa'] ?></textarea>
                            </div>

                            <div>
                                <label for="stu_visano">Visa Number:</label>
                                <input type="text" name="stu_visano" value="<?php echo $studentData['stu_visano'] ?>">
                            </div>

                            <div>
                                <label for="stu_visaexpdate">Visa Expiry Date:</label>
                                <input type="date" name="stu_visaexpdate" value="<?php echo $studentData['stu_visaexpdate'] ?>">
                            </div>

                            <div>
                                <label for="stu_10thmark">10th Marks:</label>
                                <input type="text" name="stu_10thmark" value="<?php echo $studentData['stu_10thmark'] ?>">
                            </div>

                            <div>
                                <label for="stu_12thmark">12th Marks:</label>
                                <input type="text" name="stu_12thmark" value="<?php echo $studentData['stu_12thmark'] ?>">
                            </div>

                            <div>
                                <label for="stu_10theno">10th Exam Number:</label>
                                <input type="text" name="stu_10theno" value="<?php echo $studentData['stu_10theno'] ?>">
                            </div>

                            <div>
                                <label for="stu_12theno">12th Exam Number:</label>
                                <input type="text" name="stu_12theno" value="<?php echo $studentData['stu_12theno'] ?>">
                            </div>

                            <div>
                                <label for="stu_comcerno">Community Certificate Number:</label>
                                <input type="text" name="stu_comcerno" value="<?php echo $studentData['stu_comcerno'] ?>">
                            </div>

                            <div>
                                <label for="stu_community">Community:</label>
                                <input type="text" name="stu_community" value="<?php echo $studentData['stu_community'] ?>">
                            </div>

                            <div>
                                <label for="stu_caste">Caste:</label>
                                <input type="text" name="stu_caste" value="<?php echo $studentData['stu_caste'] ?>">
                            </div>

                            <div>
                                <label for="stu_tcno">Transfer Certificate Number:</label>
                                <input type="text" name="stu_tcno" value="<?php echo $studentData['stu_tcno'] ?>">
                            </div>

                            <div>
                                <label for="stu_tccomment">Transfer Certificate Comment:</label>
                                <input type="text" name="stu_tccomment" value="<?php echo $studentData['stu_tccomment'] ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Government Documents</button>
                            </div>
                        </div>
                    </form>





                </div>
            </div>

        </main>
    </div>

    <?php include('../../includes/footer.php'); ?>
</body>
<script src="../../assets/js/script.js"></script>
<script src="../assets/js/script.js"></script>

<!--  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
</script>
<!-- Script for upading (uploading) userprofile with a new profile picture -->
<script>
    $(document).ready(function() {
        $('#basicinfo').submit(function(e) {
            e.preventDefault();
            // Student details
            var fileSize = 0;
            var sId = $('#sId').val();
            var admno = $("#admno").val();
            var studentProfilePic = $("#studentProfilePic").val(); // Note: File input values are not directly accessible due to security reasons
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var dob = $("#dob").val();
            var gender = $("input[name='gender']:checked").val();
            var clsid = $("select[name='clsid']").val();
            var doj = $("#doj").val();
            var mobileNum = $("#mobileNum").val();
            var email = $("#email").val();
            var counsellingNumber = $("#counsellingNumber").val();
            var coursetype = $("select[name='coursetype']").val();
            var quota = $("select[name='quota']").val();
            var operation = 'update';


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
            // console.log("counsellingNumber:", counsellingNumber);
            // console.log("quota:",quota );
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
            formData.append('clsid', clsid);
            formData.append('doj', doj);
            formData.append('mobileNum', mobileNum);
            formData.append('email', email);
            formData.append('coursetype', coursetype);
            formData.append('counsellingNumber', counsellingNumber);
            formData.append('quota', quota);
            formData.append('operation', operation);

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
                                alert("Updated Successfully!");
                            } else {
                                $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> ${response}</div>`);
                            }
                            setTimeout(function() {
                                $("#Result").html('');
                                location.reload();
                            }, 2000);

                        }
                    });
                    console.log('Good to upload~!');
                } else {
                    $("#Result").html(`<div class="alert alert-danger fade show" role="alert"> File size has to be within 800kb</div>`);
                }
            }, 2000);
        });
    });
</script>

</html>