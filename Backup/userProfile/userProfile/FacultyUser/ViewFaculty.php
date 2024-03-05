<?php


include('../../includes/config.php');




$fid = $_POST['fid'];

$sql = 'SELECT * from erp_faculty where f_id="' . $fid . '"';
$result = $conn->query($sql);

$facultyData = mysqli_fetch_assoc($result);



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
                        <h3 class="m-0">Faculty Profile</h3>
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
                        <button class="header-button tab active" onclick="showform('Basic_info')" id="Basic_info-tab">
                            <p>Basic Details</p>
                        </button>
                        <button class="header-button tab" onclick="showform('personalinfo')" id="personalinfo-tab">
                            <p>Personal Details</p>
                        </button>
                        <button class="header-button tab" onclick="showform('healthinfo')" id="healthinfo-tab">
                            <p>Health Details</p>
                        </button>
                        <button class="header-button tab" onclick="showform('familyinfo')" id="familyinfo-tab">
                            <p>Family Details</p>
                        </button>
                        <button class="header-button tab" onclick="showform('addressinfo')" id="addressinfo-tab">
                            <p>Address</p>
                        </button>

                        <button class="header-button tab" onclick="showform('collegeinfo')" id="collegeinfo-tab">
                            <p>College Details</p>
                        </button>
                        <button class="header-button tab" onclick="showform('experiences')" id="experiences-tab">
                            <p>Experience</p>
                        </button>
                        <button class="header-button tab" onclick="showform('passportinfo')" id="passportinfo-tab">
                            <p>Government Documents</p>
                        </button>
                    </div>


                    <form method="post" action="faculty_data.php" style="display: flex;" enctype="multipart/form-data" class="TT-form" id="Basic_info">

                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('Basic_info')">Enable Edit</button>
                            <div>
                                <label for="f_id">Faculty ID* :</label>
                                <input type="text" name="f_id" id="fid" readonly required value="<?php echo isset($facultyData['f_id']) ? $facultyData['f_id'] : ''; ?>">
                            </div>
                            <div>
                                <label for="profile_pic">Profile Picture :</label>
                                <input type="file" name="profileImage[]" id="profile_pic" placeholder="Upload your picture" onchange="">
                            </div>
                            <div>   
                                <label for="first_name">First Name* :</label>
                                <input type="text" name="first_name" id="first_name" placeholder="Enter your First Name" required value="<?php echo isset($facultyData['f_fname']) ? $facultyData['f_fname'] : ''; ?>">
                            </div>
                            <div>
                                <label for="last_name">Last Name : </label>
                                <input type="text" name="last_name" id="last_name" placeholder="Enter your First Name" value="<?php echo isset($facultyData['f_lname']) ? $facultyData['f_lname'] : ''; ?>">
                            </div>
                            <div>
                                <label for="date_of_birth">Date of Birth* :</label>
                                <input type="date" name="date_of_birth" id="date_of_birth" placeholder="Enter your Date Of Birth" required value="<?php echo isset($facultyData['f_dob']) ? $facultyData['f_dob'] : ''; ?>">
                            </div>
                            <div>
                                <label for="gender">Gender*:</label>
                                <span>
                                    <input type="radio" id="male" name="gender" value="Male" <?php echo (isset($facultyData['f_gender']) && $facultyData['f_gender'] == 'Male') ? 'checked' : ''; ?>>Male
                                    <input type="radio" id="female" name="gender" value="Female" <?php echo (isset($facultyData['f_gender']) && $facultyData['f_gender'] == 'Female') ? 'checked' : ''; ?>>Female
                                </span>
                            </div>
                            <div>
                                <label for="dept">Department :</label>
                                <select name="dept" required>
                                    <option>Select your Department</option>
                                    <?php
                                    $deptsql = "select distinct cls_dept from erp_class ";
                                    $deptresult = $conn->query($deptsql);
                                    while ($row = mysqli_fetch_assoc($deptresult)) {
                                        $dept = $row['cls_dept'];
                                        echo '<option value="' . $dept . '"';
                                        echo (isset($facultyData['f_dept']) && $facultyData['f_dept'] == $dept) ? 'selected' : '';
                                        echo '>' . $dept . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="designation">Designation :</label>
                                <select name="designation" required>
                                    <option>Select your designation</option>
                                    <option value="Assistant Professor" <?php echo (isset($facultyData['f_designation']) && $facultyData['f_designation'] == 'Assistant Professor') ? 'selected' : ''; ?>>Assistant Professor</option>
                                    <option value="Associate Professor" <?php echo (isset($facultyData['f_designation']) && $facultyData['f_designation'] == 'Associate Professor') ? 'selected' : ''; ?>>Associate Professor</option>
                                    <option value="HOD" <?php echo (isset($facultyData['f_designation']) && $facultyData['f_designation'] == 'HOD') ? 'selected' : ''; ?>>HOD</option>
                                    <option value="Principal" <?php echo (isset($facultyData['f_designation']) && $facultyData['f_designation'] == 'Principal') ? 'selected' : ''; ?>>Principal</option>
                                </select>
                            </div>
                            <div>
                                <label for="qualification">Qualification:</label>
                                <input type="text" id="qualification" name="qualification" placeholder="Qualification" required value="<?php echo isset($facultyData['f_qualification']) ? $facultyData['f_qualification'] : ''; ?>">
                            </div>
                            <div>
                                <label for="experience">Experience :</label>
                                <input type="number" name="experience" id="experience" placeholder="Enter your experience" required value="<?php echo isset($facultyData['f_exp']) ? $facultyData['f_exp'] : ''; ?>" />
                            </div>
                            <div>
                                <label for="role">Role :</label>
                                <select name="role" required>
                                    <option>Select Role:</option>
                                    <?php
                                    $rolesql = "SELECT DISTINCT r_id,r_rolename from erp_role ";
                                    $roleresult = $conn->query($rolesql);
                                    while ($row = mysqli_fetch_assoc($roleresult)) {
                                        $id = $row['r_id'];
                                        $name = $row['r_rolename'];
                                        echo '<option value="' . $id . '"';
                                        echo (isset($facultyData['f_role']) && $facultyData['f_role'] == $id) ? 'selected' : '';
                                        echo '>' . $name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="cls_id"> Class( For Class Advisor ):</label>
                                <select name="cls_id">
                                    <option value="">--Select the class--</option>
                                    <?php
                                    $classsql = "SELECT DISTINCT * from erp_class ";
                                    $classresult = $conn->query($classsql);
                                    while ($row = mysqli_fetch_assoc($classresult)) {
                                        $id = $row['cls_id'];
                                        $name = $row['cls_course'] . " " . $row['cls_dept'] . " Batch " . $row['cls_startyr'] . "-" . $row['cls_endyr'];
                                        echo '<option value="' . $id . '"';
                                        echo (isset($facultyData['cls_id']) && $facultyData['cls_id'] == $id) ? 'selected' : '';
                                        echo '>' . $name . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div>
                                <label for="doj">Date of Joining* :</label>
                                <input type="date" name="doj" id="doj" placeholder="Enter Date Of Joining" required value="<?php echo isset($facultyData['f_doj']) ? $facultyData['f_doj'] : ''; ?>">
                            </div>
                            <div>
                                <label for="mobile_number">Mobile Number :</label>
                                <input type="number" name="mobile_number" id="mobile_number" placeholder="Enter your contact number" required value="<?php echo isset($facultyData['f_mobile']) ? $facultyData['f_mobile'] : ''; ?>" />
                            </div>
                            <div>
                                <label for="email">Email ID : </label>
                                <input type="email" name="email" id="email" placeholder="Enter your Email Address" required value="<?php echo isset($facultyData['f_email']) ? $facultyData['f_email'] : ''; ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>
                            </div>
                        </div>
                        <div id="Result"></div>
                    </form>

                    <form method="post" action="faculty_data.php" enctype="multipart/form-data" class="TT-form" id='personalinfo'>
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('personalinfo')">Enable Edit</button>

                            <input type="hidden" name="f_id" value="<?php echo $fid ?>">

                            <div>
                                <label for="mother_lang">Mother Tongue : </label>
                                <input type="text" name="mother_lang" placeholder="Mother tongue" value="<?php echo isset($facultyData['f_mlang']) ? $facultyData['f_mlang'] : ''; ?>">
                            </div>
                            <div>
                                <label for="mar-status">Marital status: </label>
                                <span>
                                    <input type="radio" id="yes" name="mar-status" value="married" <?php echo (isset($facultyData['f_mstatus']) && $facultyData['f_mstatus'] == 'married') ? 'checked' : ''; ?>>Married
                                    <input type="radio" id="no" name="mar-status" value="unmarried" <?php echo (isset($facultyData['f_mstatus']) && $facultyData['f_mstatus'] == 'unmarried') ? 'checked' : ''; ?>>Unmarried
                                </span>
                            </div>
                            <div>
                                <label for="id_mark">Identification mark:</label>
                                <input type="text" name="id_mark" placeholder="Enter your Identification mark" value="<?php echo isset($facultyData['f_idmark']) ? $facultyData['f_idmark'] : ''; ?>" />
                            </div>
                            <div>
                                <label for="k_lang">known language :</label>
                                <input type="text" name="k_lang" placeholder="Enter known languages" value="<?php echo isset($facultyData['f_klang']) ? $facultyData['f_klang'] : ''; ?>" />
                            </div>
                            <div>
                                <label for="place_of_birth">Place of Birth : </label>
                                <input type="text" name="place_of_birth" placeholder="Enter your place of birth" value="<?php echo isset($facultyData['f_pob']) ? $facultyData['f_pob'] : ''; ?>">
                            </div>

                            <div>
                                <label for="hobbies">Hobbies : </label>
                                <textarea id="hobbies" name="hobbies" placeholder="Enter your hobbies here." rows="4" cols="40" value="<?php echo isset($facultyData['f_hobbies']) ? $facultyData['f_hobbies'] : ''; ?>"></textarea>
                            </div>
                            <div>
                                <label for="nationality">Nationality :</label>
                                <input type="text" name="nationality" placeholder="Enter your nationality" value="<?php echo isset($facultyData['f_nationality']) ? $facultyData['f_nationality'] : ''; ?>" />
                            </div>
                            <div>
                                <label for="religion">Religion : </label>
                                <select name="religion" id="religion" onchange="showreligion()">
                                    <option value="">--Select Religion--</option>
                                    <option value="Christian" <?php echo (isset($facultyData['f_religion']) && $facultyData['f_religion'] == 'Christian') ? 'selected' : ''; ?>>Christian</option>
                                    <option value=Hindu" <?php echo (isset($facultyData['f_religion']) && $facultyData['f_religion'] == 'Hindu') ? 'selected' : ''; ?>>Hindu</option>
                                    <option value="Muslim" <?php echo (isset($facultyData['f_religion']) && $facultyData['f_religion'] == 'Muslim') ? 'selected' : ''; ?>>Muslim</option>
                                    <option value="others" <?php echo (isset($facultyData['f_religion']) && $facultyData['f_religion'] != 'Christian' && $facultyData['f_religion'] != 'Hindu' && $facultyData['f_religion'] != 'Muslim' && $facultyData['f_religion'] != '')  ? 'selected' : ''; ?>>Others</option>
                                </select>

                            </div>
                            <div id="otherReligion" style="display: none;">
                                <label for="otherReligion">Type Your Religion:</label>
                                <input type="text" name="otherReligion" value="<?php echo (isset($facultyData['f_religion']) && $facultyData['f_religion'] != 'Christian' && $facultyData['f_religion'] != 'Hindu' && $facultyData['f_religion'] != 'Muslim' && $facultyData['f_religion'] != '')  ? $facultyData['f_religion'] : ''; ?>">
                            </div>
                            <div>
                                <label for="community">Community : </label>
                                <input type="text" name="community" placeholder="Enter your Community" value="<?php echo isset($facultyData['f_community']) ? $facultyData['f_community'] : ''; ?>">
                            </div>
                            <div>
                                <label for="caste">Caste: </label>
                                <input type="text" name="caste" placeholder="Enter your caste" value="<?php echo isset($facultyData['f_caste']) ? $facultyData['f_caste'] : ''; ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>

                            </div>
                        </div>
                    </form>

                    <form method="post" action="faculty_data.php" enctype="multipart/form-data" class="TT-form" id="healthinfo">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('healthinfo')">Enable Edit</button>

                            <input type="hidden" name="f_id" value="<?php echo $fid ?>">

                            <div>
                                <label for="blood_group">Blood Group :</label>
                                <select name="blood_group">
                                    <option value="">--Select Blood Group--</option>
                                    <option id="A+" value="A+" <?php echo (isset($facultyData['f_bloodgrp']) && $facultyData['f_bloodgrp'] == 'A+') ? 'selected' : ''; ?>>A+</option>
                                    <option id="A-" value="A-" <?php echo (isset($facultyData['f_bloodgrp']) && $facultyData['f_bloodgrp'] == 'A-') ? 'selected' : ''; ?>>A-</option>
                                    <option id="B+" value="B+" <?php echo (isset($facultyData['f_bloodgrp']) && $facultyData['f_bloodgrp'] == 'B+') ? 'selected' : ''; ?>>B+</option>
                                    <option id="B-" value="B-" <?php echo (isset($facultyData['f_bloodgrp']) && $facultyData['f_bloodgrp'] == 'B-') ? 'selected' : ''; ?>>B-</option>
                                    <option id="O+" value="O+" <?php echo (isset($facultyData['f_bloodgrp']) && $facultyData['f_bloodgrp'] == 'O+') ? 'selected' : ''; ?>>O+</option>
                                    <option id="O-" value="O-" <?php echo (isset($facultyData['f_bloodgrp']) && $facultyData['f_bloodgrp'] == 'O-') ? 'selected' : ''; ?>>O-</option>
                                    <option id="AB+" value="AB+" <?php echo (isset($facultyData['f_bloodgrp']) && $facultyData['f_bloodgrp'] == 'AB+') ? 'selected' : ''; ?>>AB+</option>
                                    <option id="AB-" value="AB-" <?php echo (isset($facultyData['f_bloodgrp']) && $facultyData['f_bloodgrp'] == 'AB-') ? 'selected' : ''; ?>>AB-</option>
                                </select>
                            </div>
                            <div>
                                <label for="personal_doc_name">Personal Doctor Name:</label>
                                <input type="text" name="personal_doc_name" placeholder="Enter your personal doctor Name" value="<?php echo isset($facultyData['f_pdoctor']) ? $facultyData['f_pdoctor'] : ''; ?>" />
                            </div>
                            <div>
                                <label for="personal_doc_no">Personal Doctor Number:</label>
                                <input type="number" name="personal_doc_no" placeholder="Enter your personal doctor number" value="<?php echo isset($facultyData['f_pdoctorno']) ? $facultyData['f_pdoctorno'] : ''; ?>" />
                            </div>
                            <div>
                                <label for="emergency_no">Emergency Number :</label>
                                <input type="number" name="emergency_no" placeholder="Enter the emergeny contact" value="<?php echo isset($facultyData['f_emgno']) ? $facultyData['f_emgno'] : ''; ?>">
                            </div>
                            <div>
                                <label for="disability">Do you have any Disability:</label>
                                <span>
                                    <input type="radio" id="dis_yes" name="disability" value="Yes" onclick="" <?php echo (isset($facultyData['f_disability']) && $facultyData['f_disability'] == 'Yes') ? 'checked' : ''; ?>>Yes
                                    <input type="radio" id="dis_no" name="disability" value="No" onclick="" <?php echo (isset($facultyData['f_disability']) && $facultyData['f_disability'] == 'No') ? 'checked' : ''; ?>>No
                                </span>
                            </div>
                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>
                            </div>
                        </div>
                    </form>

                    <form method="post" action="faculty_data.php" enctype="multipart/form-data" class="TT-form" id="familyinfo">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('familyinfo')">Enable Edit</button>

                            <input type="hidden" name="f_id" value="<?php echo $fid ?>">

                            <div>
                                <label for="no_of_childs">Childrens : </label>
                                <input type="number" name="no_of_childs" placeholder="Enter the number of childrens" value="<?php echo isset($facultyData['f_child']) ? $facultyData['f_child'] : ''; ?>">
                            </div>
                            <div>
                                <label for="childs_in_same_clg">Childrens in same college : </label>
                                <input type="text" id="same_college" name="childs_in_same_clg" placeholder="Enter Name of Child in same college" value="<?php echo isset($facultyData['f_childinsame']) ? $facultyData['f_childinsame'] : ''; ?>">
                            </div>
                            <div>
                                <label for="childs_in_other_clg">Childrens in Other college:</label>
                                <input type="text" id="other_college" name="childs_in_other_clg" placeholder="Enter Name of Child in other college" value="<?php echo isset($facultyData['f_childinother']) ? $facultyData['f_childinother'] : ''; ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>

                            </div>
                        </div>
                    </form>



                    <form method="post" action="faculty_data.php" enctype="multipart/form-data" class="TT-form" id="addressinfo">

                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('addressinfo')">Enable Edit</button>

                            <input type="hidden" name="f_id" value="<?php echo $fid ?>">

                            <div>
                                <label for="address">Address :</label>
                                <input type="text" name="address" placeholder="Enter your address" value="<?php echo isset($facultyData['f_add']) ? $facultyData['f_add'] : ''; ?>">
                            </div>
                            <div>
                                <label for="city_name">City: </label>
                                <input type="text" name="city_name" placeholder="Enter your City" value="<?php echo isset($facultyData['f_city']) ? $facultyData['f_city'] : ''; ?>">
                            </div>
                            <div>
                                <label for="state_name">State : </label>
                                <input type="text" name="state_name" placeholder="Enter your State" value="<?php echo isset($facultyData['f_state']) ? $facultyData['f_state'] : ''; ?>">
                            </div>
                            <div>
                                <label for="pincode">PinCode :</label>
                                <input type="number" name="pincode" placeholder="Enter your pincode" value="<?php echo isset($facultyData['f_zip']) ? $facultyData['f_zip'] : ''; ?>">
                            </div>
                            <div>
                                <label for="per_add">Permanent address:</label>
                                <input type="text" name="per_add" placeholder="Enter your Permanent address" value="<?php echo isset($facultyData['f_padd']) ? $facultyData['f_padd'] : ''; ?>" />
                            </div>
                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>

                            </div>
                        </div>
                    </form>


                    <form method="post" action="faculty_data.php" enctype="multipart/form-data" class="TT-form" id="experiences">

                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('experience')">Enable Edit</button>

                            <input type="hidden" name="f_id" value="<?php echo $fid ?>">

                            <div>
                                <label for="university_speacilization">University speacialization :</label>
                                <input type="text" name="university_speacilization" placeholder="Enter your university speacialization" value="<?php echo isset($facultyData['f_univspec']) ? $facultyData['f_univspec'] : ''; ?>">
                            </div>
                            <div>
                                <label for="year_completion">Year of Completion : </label>
                                <input type="number" name="year_completion" placeholder="Enter your Year of Completion" value="<?php echo isset($facultyData['f_yoc']) ? $facultyData['f_yoc'] : ''; ?>">
                            </div>
                            <div>
                                <label for="f_teachexp">Teaching Experience : </label>
                                <input type="number" name="f_teachexp" placeholder="Enter your teaching experience" value="<?php echo isset($facultyData['f_teachexp']) ? $facultyData['f_teachexp'] : ''; ?>">
                            </div>
                            <div>
                                <label for="project_guided">Project Guided: </label>
                                <input type="number" name="project_guided" placeholder="Enter the number of project guided" value="<?php echo isset($facultyData['f_projguide']) ? $facultyData['f_projguide'] : ''; ?>">
                            </div>
                            <div>
                                <label for="ind_exp">Industry Experience : </label>
                                <input type="number" name="ind_exp" placeholder="Enter your industry experience" value="<?php echo isset($facultyData['f_indexp']) ? $facultyData['f_indexp'] : ''; ?>">
                            </div>
                            <div>
                                <label for="pre_emp">Previous Employer : </label>
                                <input type="text" name="pre_emp" value="<?php echo isset($facultyData['f_pastemp']) ? $facultyData['f_pastemp'] : ''; ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>

                            </div>
                        </div>
                    </form>


                    <form method="post" action="faculty_data.php" enctype="multipart/form-data" class="TT-form" id="collegeinfo">

                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('collegeinfo')">Enable Edit</button>

                            <input type="hidden" name="f_id" value="<?php echo $fid ?>">

                            <div>
                                <label for="transport">College Transport : </label>
                                <span>
                                    <input type="radio" id="college_transport" name="transport" value="Yes" <?php echo (isset($facultyData['f_transport']) && $facultyData['f_transport'] == 'Yes') ? 'checked' : ''; ?>>Yes
                                    <input type="radio" id="own" name="transport" value="No" <?php echo (isset($facultyData['f_transport']) && $facultyData['f_transport'] == 'No') ? 'checked' : ''; ?>>No
                                </span>
                            </div>
                            <div>
                                <label for="fac_hostel">Faculty Hostel : </label>
                                <span>
                                    <input type="radio" id="hostel" name="fac_hostel" value="Yes" <?php echo (isset($facultyData['f_hostel']) && $facultyData['f_hostel'] == 'Yes') ? 'checked' : ''; ?>>Yes
                                    <input type="radio" id="none_hostel" name="fac_hostel" value="No" <?php echo (isset($facultyData['f_hostel']) && $facultyData['f_hostel'] == 'No') ? 'checked' : ''; ?>>No
                                </span>
                            </div>
                            <div>
                                <label for="food_offering">Food offering : </label>
                                <span>
                                    <input type="radio" id="veg" name="food_offering" value="Veg" <?php echo (isset($facultyData['f_food']) && $facultyData['f_food'] == 'Veg') ? 'checked' : ''; ?>>Veg
                                    <input type="radio" id="nonVeg" name="food_offering" value="Non Veg" <?php echo (isset($facultyData['f_food']) && $facultyData['f_food'] == 'Non Veg') ? 'checked' : ''; ?>>Non Veg
                                </span>
                            </div>
                        </div>

                        <div class="TT-form-content">
                            <h2></h2>
                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>
                            </div>
                        </div>
                    </form>

                    <form method="post" action="faculty_data.php" enctype="multipart/form-data" class="TT-form" id="passportinfo">
                        <div class="TT-form-content">
                            <button type="button" onclick="enableInputs('passportinfo')">Enable Edit</button>

                            <input type="hidden" name="f_id" value="<?php echo $fid ?>">
                            <div>
                                <label for="aadhaar_no">Aadhaar Number*: </label>
                                <input type="number" name="aadhaar_no" placeholder="Enter your Aadhar number" value="<?php echo isset($facultyData['f_aadhaarno']) ? $facultyData['f_aadhaarno'] : ''; ?>">
                            </div>
                            <div>
                                <label for="pass_no">Passport Number:</label>
                                <input type="text" name="pass_no" placeholder="Enter your passport number" value="<?php echo isset($facultyData['f_ppno']) ? $facultyData['f_ppno'] : ''; ?>">
                            </div>
                            <div>
                                <label for="voter_id">Voter ID Number:</label>
                                <input type="text" name="voter_id" placeholder="Enter your voter id number" value="<?php echo isset($facultyData['f_voterid']) ? $facultyData['f_voterid'] : ''; ?>">
                            </div>
                            <div>
                                <label for="pan_card_no">Pan Card Number:</label>
                                <input type="text" name="pan_card_no" placeholder="Enter your Pan number" value="<?php echo isset($facultyData['f_panno']) ? $facultyData['f_panno'] : ''; ?>">
                            </div>

                            <div class="TT-form-button">
                                <button type="submit" name="update" class="TT-button">Update Profile</button>

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
        $('#Basic_info').submit(function(e) {
            e.preventDefault();
            var fileSize = 0;
            //  Acquiring values from the input fields from create faculty form
            var fid = $('#fid').val();
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var date_of_birth = $('#date_of_birth').val();
            var gender = $('input[name="gender"]:checked').val(); // Radio buttons need special handling
            var dept = $('select[name="dept"]').val();
            var designation = $('select[name="designation"]').val();
            var qualification = $('#qualification').val();
            var experience = $('#experience').val();
            var role = $('select[name="role"]').val();
            var cls_id = $('select[name="cls_id"]').val();
            var doj = $('#doj').val();
            var mobile_number = $('#mobile_number').val();
            var email = $('#email').val();
            var operation = 'update';

            // Creating artificial form data structure
            var formData = new FormData(this);
            // Log the values to the console
            // console.log('fid:', fid);
            // console.log('first_name:', first_name);
            // console.log('last_name:', last_name);
            // console.log('date_of_birth:', date_of_birth);
            // console.log('gender:', gender);
            // console.log('dept:', dept);
            // console.log('designation:', designation);
            // console.log('qualification:', qualification);
            // console.log('experience:', experience);
            // console.log('role:', role);
            // console.log('cls_id:', cls_id);
            // console.log('doj:', doj);
            // console.log('mobile_number:', mobile_number);
            // console.log('email:', email);
            // Append the form values to the FormData object
            formData.append('fid', $('#fid').val());
            formData.append('first_name', $('#first_name').val());
            formData.append('last_name', $('#last_name').val());
            formData.append('date_of_birth', $('#date_of_birth').val());
            formData.append('gender', $('input[name="gender"]:checked').val());
            formData.append('dept', $('select[name="dept"]').val());
            formData.append('designation', $('select[name="designation"]').val());
            formData.append('qualification', $('#qualification').val());
            formData.append('experience', $('#experience').val());
            formData.append('role', $('select[name="role"]').val());
            formData.append('cls_id', $('select[name="cls_id"]').val());
            formData.append('doj', $('#doj').val());
            formData.append('mobile_number', $('#mobile_number').val());
            formData.append('email', $('#email').val());
            formData.append('operation', operation);


            if ($("#profile_pic").val() !== '') {
                // Logic for checking the size of the image file being uploaded
                var fileSize = ($("#profile_pic")[0].files[0].size / 1024);
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