<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export to PDF</title>
    <!-- Include the html2pdf library -->
    <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
</head>

<body>
    <!-- Your content with a specific ID -->
    <div id="contentToExport">
        <!-- Add your content here -->
        <h1>Hello, this is the content to export!</h1>
        <p>Some text in the content...</p>
    </div>

    <!-- Button to trigger the export -->
    <button onclick="exportToPDF()">Export to PDF</button>

    <script>
        function exportToPDF() {
            // Get the content element by its ID
            const content = document.getElementById('contentToExport');

            // Use html2pdf library to export the content to PDF
            html2pdf(content);
        }
    </script>
</body>

</html>
<?php

session_start();

if (isset($_SESSION['user_id'])) {

    include('../includes/config.php');


    ?>
    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Anydata Report</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <style>
            .lbox {
                width: 15px;
                height: 15px;
            }

            .col_blue {
                background-color: blue;
            }

            .col_red {
                background-color: red;
            }

            .col_green {
                background-color: green;
            }

            .col_violet {
                background-color: darkviolet;
            }

            label {
                margin: 0px 5px;
            }

            tr>td {
                padding: 0px 15px;
                font-size: 13px;
            }

            td {
                margin-bottom: 10px !important;
            }

            input,
            select {
                font-size: 11px;
                margin-bottom: 3px;
            }

            /*  */

            .check-tbl #fieldSelectionForm .label-box {
                margin-bottom: 5px;
                display: flex;
                justify-content: space-between;
                flex-wrap: wrap;
            }


            .check-tbl #fieldSelectionForm label {
                width: 190px;
                font-size: 13px;
                margin-bottom: 3px;
            }

            .checkall label {
                width: 190px;
                font-size: 13px;
                margin-bottom: 3px;
                display: flex;
            }

            .checkall label input {
                margin: 0px;
            }

            .check-tbl #fieldSelectionForm label input {
                margin-right: 10px;
            }

            .check-tbl #fieldSelectionForm button {
                padding: 3px 5px;
                background-color: var(--pri);
                color: white;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-size: 13px;
            }

            .btn-pri {
                padding: 3px 5px;
                background-color: var(--pri);
                color: white;
                border: none;
                border-radius: 3px;
                cursor: pointer;
                font-size: 13px;
                text-decoration: none;
            }

            .btn-pri:hover,
            .btn-pri:focus {
                background-color: var(--dark);
                color: white;
            }

            .check-tbl table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .check-tbl th,
            .check-tbl td {
                border: 1px solid #ddd;
                padding: 10px;
                text-align: left;
            }

            .check-tbl th {
                background-color: var(--pri);
                color: white;
            }

            .check-tbl tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            #reporttable table {
                width: 100%;
                border-collapse: collapse;
                margin-top: 20px;
            }

            #reporttable th,
            #reporttable td {
                border: 1px solid #ddd;
                text-align: left;
            }

            .table-responsive {
                overflow: scroll;
                max-width: 80rem;
                max-height: 30rem;
            }

            /*  */
        </style>
        <link rel="stylesheet" href="../assets/css/style.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="assets/js/script.js"></script>
        <script src="assets/js/html2pdf.js/dist/html2pdf.bundle.js"></script>
    </head>

    <body>
        <div class="card text-bg-light mx-3 my-1">
            <div class="card-header">
                <div class="d-flex flex-row justify-content-between">
                    <h6>SEARCH</h6>
                    <h6>* INDICATES MANDATORY FIELDS</h6>
                </div>
            </div>
            <div class="card-body py-1 d-flex flex-column align-items-center justify-content-center">
                <form method="POST" id="reportform">
                    <table class="d-flex justify-content-center">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="fname" class="w-100">First name:</label><br>
                                        <input type="text" id="fname" name="fname">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="lname" class="w-100">Last name:</label><br>
                                        <input type="text" id="lname" name="lname">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="dept" class="w-100">Department:</label><br>
                                        <select id="dept" name="dept" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct cls_dept FROM `erp_class`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['cls_dept']; ?>'>
                                                        <?php echo $row['cls_dept']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="route" class="w-100">Route:</label><br>
                                        <select id="route" name="route" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct tr_routeno FROM `erp_transport`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['tr_routeno'] ?>'>
                                                        <?php echo $row['tr_routeno']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="stop" class="w-100">Stop:</label><br>
                                        <select id="stop" name="stop" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct tr_stop FROM `erp_transport`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['tr_stop'] ?>'>
                                                        <?php echo $row['tr_stop']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="sem" class="w-100">Class:</label><br>
                                        <select id="sem" name="sem" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct cls_startyr,cls_endyr,cls_course,cls_dept,cls_sem FROM `erp_class`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option
                                                        value='<?php echo $row['cls_startyr'] . ',' . $row['cls_endyr'] . ',' . $row['cls_course'] . ',' . $row['cls_dept'] . ',' . $row['cls_sem']; ?>'>
                                                        <?php echo $row['cls_startyr'] . ' - ' . $row['cls_endyr'] . ' ' . $row['cls_course'] . ' ' . $row['cls_dept'] . ' ' . $row['cls_sem'] . ' Semester'; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="role" class="w-100">Role:</label><br>
                                        <select id="role" name="role" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct r_rolename FROM `erp_role`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['r_rolename'] ?>'>
                                                        <?php echo $row['r_rolename']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="quote" class="w-100">Student Quota:</label><br>
                                        <select id="quote" name="quote" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct stu_quota FROM `erp_student`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['stu_quota'] ?>'>
                                                        <?php echo $row['stu_quota']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="transport" class="w-100">Transport:</label><br>
                                        <select id="transport" name="transport" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct stu_transport FROM `erp_student`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['stu_transport'] ?>'>
                                                        <?php echo $row['stu_transport']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="blood" class="w-100">Blood Group:</label><br>
                                        <select id="blood" name="blood" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct stu_bloodgrp FROM `erp_student`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['stu_bloodgrp'] ?>'>
                                                        <?php echo $row['stu_bloodgrp']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="comm" class="w-100">Community:</label><br>
                                        <select id="comm" name="comm" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct stu_community FROM `erp_student`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['stu_community'] ?>'>
                                                        <?php echo $row['stu_community']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="caste" class="w-100">Caste:</label><br>
                                        <select id="caste" name="caste" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct stu_caste FROM `erp_student`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['stu_caste'] ?>'>
                                                        <?php echo $row['stu_caste']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="rel" class="w-100">Religion:</label><br>
                                        <select id="rel" name="rel" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct stu_religion FROM `erp_student`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['stu_religion'] ?>'>
                                                        <?php echo $row['stu_religion']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="gen" class="w-100">Gender:</label><br>
                                        <select id="gen" name="gen" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct stu_gender FROM `erp_student`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['stu_gender'] ?>'>
                                                        <?php echo $row['stu_gender']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="hos" class="w-100">Hostel:</label><br>
                                        <select id="hos" name="hos" class="w-100">
                                            <option value="">--select--</option>
                                            <?php
                                            $sql = "SELECT distinct stu_hostel FROM `erp_student`";
                                            $result = mysqli_query($conn, $sql);

                                            if (mysqli_num_rows($result) > 0) {
                                                // output data of each row
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    ?>
                                                    <option value='<?php echo $row['stu_hostel'] ?>'>
                                                        <?php echo $row['stu_hostel']; ?>
                                                    </option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="admno" class="w-100">Admission No:</label><br>
                                        <input id="admno" name="admno" class="w-100">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="age" class="w-100">Age:</label><br>
                                        <label for="agefr" class="w-100">From:</label><br>
                                        <input type="text" id="agefr" name="agefr">
                                        <label for="ageto" class="w-100">To:</label><br>
                                        <input type="text" id="ageto" name="ageto">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="exp" class="w-100">Experience:</label><br>
                                        <label for="expfr" class="w-100">From:</label><br>
                                        <input type="text" id="expfr" name="expfr">
                                        <label for="expto" class="w-100">To:</label><br>
                                        <input type="text" id="expto" name="expto">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="qlf" class="w-100">Qualification:</label><br>
                                        <input type="text" id="qlf" name="qlf">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row justify-content-center">
                                        <label for="admno" class="w-100">Legends:</label><br>
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="lbox col_blue"></div>&nbsp;
                                            <label class="">
                                                Student
                                            </label>
                                        </div>&ensp;
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="lbox col_green"></div>&nbsp;
                                            <label class="">
                                                Staff
                                            </label>
                                        </div>&ensp;
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="lbox col_violet"></div>&nbsp;
                                            <label class="">
                                                Parent
                                            </label>
                                        </div>&ensp;
                                        <div class="d-flex flex-row justify-content-between align-items-center">
                                            <div class="lbox col_red"></div>&nbsp;
                                            <label class="">
                                                Common
                                            </label>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-start align-content-center checkall">
                        <label for="checkAll">Check All&nbsp;
                            <input type="checkbox" id="checkAll" onchange="checkAllCheckboxes()">
                        </label>
                    </div>
                    <div class="d-flex flex-column check-tbl">
                        <div class="form" id="fieldSelectionForm">
                            <div class="label-box">
                                <?php
                                $fieldMappings = [
                                    'stu_id' => 'Student ID',
                                    'cls_id' => 'Class ID',
                                    'fee_id' => 'Fee ID',
                                    'stu_dob' => 'Date of Birth',
                                    'stu_fname' => 'First Name',
                                    'stu_lname' => 'Last Name',
                                    'stu_img' => 'Student Image',
                                    'stu_gender' => 'Gender',
                                    'stu_height' => 'Height (in cm)',
                                    'stu_weight' => 'Weight (in kg)',
                                    'stu_mobile' => 'Mobile Number',
                                    'stu_fmobile' => 'Father Mobile Number',
                                    'stu_mmobile' => 'Mother Mobile Number',
                                    'stu_gmobile' => 'Guardian Mobile Number',
                                    'stu_admno' => 'Admission Number',
                                    'stu_aadhar' => 'Aadhar Number',
                                    'stu_padd' => 'Personal Address',
                                    'stu_city' => 'City',
                                    'stu_state' => 'State',
                                    'stu_zip' => 'Zip Code',
                                    'stu_idmark' => 'Identification Mark',
                                    'stu_mlang' => 'Mother Language',
                                    'stu_klang' => 'Known Language',
                                    'stu_bloodgrp' => 'Blood Group',
                                    'stu_email' => 'Email',
                                    'stu_hobbies' => 'Hobbies',
                                    'stu_nationality' => 'Nationality',
                                    'stu_religion' => 'Religion',
                                    'stu_caste' => 'Caste',
                                    'stu_community' => 'Community',
                                    'stu_quota' => 'Quota',
                                    'stu_father' => 'Father Name',
                                    'stu_mother' => 'Mother Name',
                                    'stu_guardian' => 'Guardian Name',
                                    'stu_motherimg' => 'Mother Image',
                                    'stu_fatherimg' => 'Father Image',
                                    'stu_guardianimg' => 'Guardian Image',
                                    'stu_foccupation' => 'Father Occupation',
                                    'stu_moccupation' => 'Mother Occupation',
                                    'stu_fqualification' => 'Father Qualification',
                                    'stu_doj' => 'Date of Join',
                                    'stu_transport' => 'Transport',
                                    'stu_hostel' => 'Hostel',
                                    'h_id' => 'Hostel ID',
                                    'stu_roomno' => 'Room Number',
                                    'stu_disability' => 'Disability',
                                    'stu_disid' => 'Disability ID Card No',
                                    'stu_distype' => 'Disability Type',
                                    'stu_disper' => 'Disability Percentage',
                                    'stu_pdoctor' => 'Personal Doctor Name',
                                    'stu_pdoctorno' => 'Personal Doctor No',
                                    'stu_bp' => 'Blood Pressure',
                                    'stu_visionL' => 'Vision Left',
                                    'stu_visionR' => 'Vision Right',
                                    'stu_pulse' => 'Pulse',
                                    'stu_squint' => 'Squint Detail',
                                    'stu_pallor' => 'Pallor',
                                    'stu_eyecon' => 'Eye Condition Detail',
                                    'stu_dentalcon' => 'Dental Condition Detail',
                                    'stu_healthcon' => 'Health Condition Detail',
                                    'stu_comments' => 'Comments',
                                    'stu_ppno' => 'Passport No',
                                    'stu_ppissueat' => 'Passport Issue At',
                                    'stu_ppexpdate' => 'Passport Expiry Date',
                                    'stu_visa' => 'Visa Details',
                                    'stu_issuedate' => 'Passport Issue Date',
                                    'stu_visano' => 'Visa Number',
                                    'stu_visaexpdate' => 'Visa Expiry Date',
                                    'stu_10thmark' => '10th Mark',
                                    'stu_12thmark' => '12th Mark',
                                    'stu_comcerno' => 'Community Certificate No',
                                    'stu_10theno' => '10th Exam Number',
                                    'stu_12theno' => '12th Exam Number',
                                    'stu_income' => 'Annual Income',
                                    'stu_inccerno' => 'Income Certificate Number',
                                    'stu_orphan' => 'Orphan',
                                    'stu_fg' => 'First Graduate',
                                    'stu_splcat' => 'Special Category',
                                    'stu_nameasbank' => 'Name as in Bank Account',
                                    'stu_bankname' => 'Bank Name',
                                    'stu_brancename' => 'Branch Name',
                                    'stu_lateral' => 'Lateral',
                                    'stu_coursetype' => 'Course Type',
                                    'stu_councellingno' => 'Counseling Number',
                                    'stu_hosteltype' => 'Hostler Type',
                                    'stu_accno' => 'Account Number',
                                    'stu_ifsc' => 'IFSC Number',
                                    'stu_status' => 'Status',
                                    'mobile_token' => 'Mobile Token',
                                    'stu_spin' => 'Student Security Pin',
                                    'last_otp' => 'Last OTP'
                                ];
                                $fieldMappings = [
                                    'First Name',
                                    'Designation',
                                    'Last Name',
                                    'Department',
                                    'Class',
                                    'Mobile Phone',
                                    'Photo',
                                    'Blood Group',
                                    'Student Quota',
                                    'Community',
                                    'Caste',
                                    'Aadhaar No',
                                    'Admission Date',
                                    'Admission Number',
                                    'Email',
                                    'City',
                                    'Class Advisor',
                                    'Date of Birth',
                                    'Date Of Joining',
                                    // 'Dietary Needs Details',
                                    'Disability',
                                    'DisabilityDetails',
                                    'Drop Time',
                                    'Education Details',
                                    'Emergency Contact number',
                                    'Faculty ID',
                                    'Experience',
                                    'Experience Details',
                                    'Extra Curricular Activities',
                                    'Father Education',
                                    'Father Name',
                                    'Father Mobile',
                                    'Father Occupation',
                                    'Food Offering',
                                    'Full Name',
                                    'Gender',
                                    'Hostel',
                                    'Identification Marks',
                                    'Mother Name',
                                    'Mother Mobile',
                                    'Mother Occupation',
                                    'Mother Tongue',
                                    'Nationality',
                                    'Guardian Name',
                                    'Guardian Mobile Phone',
                                    'Permanent Address',
                                    'Personal doctor details',
                                    'Pick Time',
                                    'Pin Code',
                                    'Qualification',
                                    'Reg. No.',
                                    'Religion Name',
                                    'Role Name',
                                    'Roll Number',
                                    'Room',
                                    'Route',
                                    'Scholarship',
                                    'Sibling Details',
                                    'Siblings in Same Institute',
                                    'Staff Child',
                                    'State Name',
                                    'Stop Name',
                                    'TC Comments',
                                    'TC Number',
                                    'Transfer Details',
                                    'Transport',
                                    'Type of Disability',
                                ];

                                $checkbox = array();
                                foreach ($fieldMappings as $fullName) {
                                    echo "<label><input type='checkbox' name='checkbox[]' value='$fullName'>$fullName</label>";
                                }
                                ?>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="button" id="searchbtn">Search</button>
                            </div>
                            <!-- <input type="submit" value="submit"> -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <div id="reporttable">
                            <!-- The selected fields will be displayed here -->
                        </div>
                    </div>


                </form>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
            </script>
        <script>
            //////////////////
            $(() => {
                $("#searchbtn").click(function (ev) {
                    ev.preventDefault();
                    var form = $("#reportform");
                    var url = './ajax/getreport.php';
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: form.serialize(),
                        success: function (data) {
                            $("#reporttable").html(data);
                        },
                        error: function (data) {
                            alert("some Error");
                        }
                    });
                });
            });

            function exportpdf() {
                var form = document.getElementById('reportform');
                form.action = './ajax/export_pdf.php';
                form.method = 'post';
                form.submit();
            }

            function exportexcel() {
                var form = document.getElementById('reportform');
                form.action = './ajax/export_excel.php';
                form.method = 'post';
                form.submit();
            }
        </script>
    </body>

    </html>
    <?php
} else {
    header("Location: ../index.php");
}
?>