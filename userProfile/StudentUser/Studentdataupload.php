<?php

session_start();

if (isset($_SESSION['user_id'])) {

    include('../../includes/config.php');


    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Collect form data
        if (isset($_POST['create'])) {
 
            $sid = $_POST['sid'];
            $admno = $_POST['admno'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $date_of_birth = $_POST['date_of_birth'];
            $gender = $_POST['gender'];
            $clsid = $_POST['clsid'];
            $doj = $_POST['doj'];
            $mobile_number = $_POST['mobile_number'];
            $email = $_POST['email'];
            $coursetype = $_POST['coursetype'];
            $quota = $_POST['quota'];

            $insertsql = "INSERT INTO erp_student (`stu_id`,`stu_admno`,`stu_fname`,`stu_lname`,`stu_dob`,`stu_gender`,`cls_id`,`stu_doj`,`stu_mobile`,`stu_email`,`stu_coursetype`,`stu_quota`)
            values(
                NULLIF('$sid', ''),
                NULLIF('$admno', ''),
                NULLIF('$first_name', ''),
                NULLIF('$last_name', ''),
                NULLIF('$date_of_birth', ''),
                NULLIF('$gender', ''),
                NULLIF('$clsid', ''),
                NULLIF('$doj', ''),
                NULLIF('$mobile_number', ''),
                NULLIF('$email', ''),
                NULLIF('$coursetype', ''),
                NULLIF('$quota', ''))
            ";

            if ($conn->query($insertsql) === TRUE) {
?>
                <form method="post" action="ViewStudent.php" enctype="multipart/form-data" id="updateform">
                    <input type="hidden" name="sid" value="<?php echo $sid ?>">
                </form>
                <script>
                    if (confirm("Profile successfully Created ! Do you want to add Additional Information?")) {
                        document.getElementById('updateform').submit()
                    } else {
                        window.location.href = '../index.php';
                    }
                </script>
            <?php
            } else {
                echo "Error: " . $insertsql . "<br>" . $conn->error;
            }
        }

        if (isset($_POST['update'])) {

            $sid = isset($_POST['sid']) ? $_POST['sid'] : '';
            $admno = isset($_POST['admno']) ? $_POST['admno'] : '';
            $first_name = isset($_POST['first_name']) ? $_POST['first_name'] : '';
            $last_name = isset($_POST['last_name']) ? $_POST['last_name'] : '';
            $date_of_birth = isset($_POST['date_of_birth']) ? $_POST['date_of_birth'] : '';
            $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
            $clsid = isset($_POST['clsid']) ? $_POST['clsid'] : '';
            $doj = isset($_POST['doj']) ? $_POST['doj'] : '';
            $mobile_number = isset($_POST['mobile_number']) ? $_POST['mobile_number'] : '';
            $email = isset($_POST['email']) ? $_POST['email'] : '';
            $coursetype = isset($_POST['coursetype']) ? $_POST['coursetype'] : '';
            $quota = isset($_POST['quota']) ? $_POST['quota'] : '';
            $stu_counsellingno = isset($_POST['counsellingNumber']) ? $_POST['counsellingNumber'] : '';

            // personal info
            $stu_height = isset($_POST['stu_height']) ? $_POST['stu_height'] : '';
            $stu_weight = isset($_POST['stu_weight']) ? $_POST['stu_weight'] : '';
            $stu_mlang = isset($_POST['stu_mlang']) ? $_POST['stu_mlang'] : '';
            $stu_klang = isset($_POST['stu_klang']) ? $_POST['stu_klang'] : '';
            $stu_idmark = isset($_POST['stu_idmark']) ? $_POST['stu_idmark'] : '';
            $stu_hobbies = isset($_POST['stu_hobbies']) ? $_POST['stu_hobbies'] : '';
            $stu_nationality = isset($_POST['stu_nationality']) ? $_POST['stu_nationality'] : '';
            $stu_extcur = isset($_POST['stu_extcur']) ? $_POST['stu_extcur'] : '';
            $stu_religion = isset($_POST['stu_religion']) ? $_POST['stu_religion'] : '';


            // health info
            $stu_bloodgrp = isset($_POST['stu_bloodgrp']) ? $_POST['stu_bloodgrp'] : '';
            $stu_disability = isset($_POST['stu_disability']) ? $_POST['stu_disability'] : '';
            $stu_disid = isset($_POST['stu_disid']) ? $_POST['stu_disid'] : '';
            $stu_distype = isset($_POST['stu_distype']) ? $_POST['stu_distype'] : '';
            $stu_disper = isset($_POST['stu_disper']) ? $_POST['stu_disper'] : '';
            $stu_pdoctor = isset($_POST['stu_pdoctor']) ? $_POST['stu_pdoctor'] : '';
            $stu_pdoctorno = isset($_POST['stu_pdoctorno']) ? $_POST['stu_pdoctorno'] : '';
            $stu_bp = isset($_POST['stu_bp']) ? $_POST['stu_bp'] : '';
            $stu_visionL = isset($_POST['stu_visionL']) ? $_POST['stu_visionL'] : '';
            $stu_visionR = isset($_POST['stu_visionR']) ? $_POST['stu_visionR'] : '';
            $stu_eyecon = isset($_POST['stu_eyecon']) ? $_POST['stu_eyecon'] : '';
            $stu_pulse = isset($_POST['stu_pulse']) ? $_POST['stu_pulse'] : '';
            $stu_squint = isset($_POST['stu_squint']) ? $_POST['stu_squint'] : '';
            $stu_dentalcon = isset($_POST['stu_dentalcon']) ? $_POST['stu_dentalcon'] : '';
            $stu_healthcon = isset($_POST['stu_healthcon']) ? $_POST['stu_healthcon'] : '';

            // family details
            $stu_father = isset($_POST['stu_father']) ? $_POST['stu_father'] : '';
            $stu_foccupation = isset($_POST['stu_foccupation']) ? $_POST['stu_foccupation'] : '';
            $stu_fqualification = isset($_POST['stu_fqualification']) ? $_POST['stu_fqualification'] : '';
            $stu_fmobile = isset($_POST['stu_fmobile']) ? $_POST['stu_fmobile'] : '';

            $stu_mother = isset($_POST['stu_mother']) ? $_POST['stu_mother'] : '';
            $stu_moccupation = isset($_POST['stu_moccupation']) ? $_POST['stu_moccupation'] : '';
            $stu_mmobile = isset($_POST['stu_mmobile']) ? $_POST['stu_mmobile'] : '';

            $stu_guardian = isset($_POST['stu_guardian']) ? $_POST['stu_guardian'] : '';
            $stu_gmobile = isset($_POST['stu_gmobile']) ? $_POST['stu_gmobile'] : '';

            $stu_sibdetail = isset($_POST['stu_sibdetail']) ? $_POST['stu_sibdetail'] : '';
            $stu_sibinsame = isset($_POST['stu_sibinsame']) ? $_POST['stu_sibinsame'] : '';
            $stu_orphan = isset($_POST['stu_orphan']) ? $_POST['stu_orphan'] : '';

            // Address

            $stu_padd = isset($_POST['stu_padd']) ? $_POST['stu_padd'] : '';
            $stu_city = isset($_POST['stu_city']) ? $_POST['stu_city'] : '';
            $stu_state = isset($_POST['stu_state']) ? $_POST['stu_state'] : '';
            $stu_zip = isset($_POST['stu_zip']) ? $_POST['stu_zip'] : '';

            // Accomodation
            $stu_hostel = isset($_POST['stu_hostel']) ? $_POST['stu_hostel'] : '';
            $stu_transport = isset($_POST['stu_transport']) ? $_POST['stu_transport'] : '';
            $stu_hosteltype = isset($_POST['stu_hosteltype']) ? $_POST['stu_hosteltype'] : '';
            $stu_roomno = isset($_POST['stu_roomno']) ? $_POST['stu_roomno'] : '';
            $stu_food = isset($_POST['stu_food']) ? $_POST['stu_food'] : '';

            // stu_scholarship
            $stu_nameasbank = isset($_POST['stu_nameasbank']) ? $_POST['stu_nameasbank'] : '';
            $stu_accno = isset($_POST['stu_accno']) ? $_POST['stu_accno'] : '';
            $stu_ifsc = isset($_POST['stu_ifsc']) ? $_POST['stu_ifsc'] : '';
            $stu_scholarship = isset($_POST['stu_scholarship']) ? $_POST['stu_scholarship'] : '';
            $stu_scholarsts = isset($_POST['stu_scholarsts']) ? $_POST['stu_scholarsts'] : '';
            $stu_income = isset($_POST['stu_income']) ? $_POST['stu_income'] : '';
            $stu_inccerno = isset($_POST['stu_inccerno']) ? $_POST['stu_inccerno'] : '';
            $stu_fg = isset($_POST['stu_fg']) ? $_POST['stu_fg'] : '';
            $stu_splcat = isset($_POST['stu_splcat']) ? $_POST['stu_splcat'] : '';
            $stu_lateral = isset($_POST['stu_lateral']) ? $_POST['stu_lateral'] : '';
            $stu_bankname = isset($_POST['stu_bankname']) ? $_POST['stu_bankname'] : '';
            $stu_brancename = isset($_POST['stu_brancename']) ? $_POST['stu_brancename'] : '';

            // Gov documents
            $stu_aadhar = isset($_POST['stu_aadhar']) ? $_POST['stu_aadhar'] : '';
            $stu_ppno = isset($_POST['stu_ppno']) ? $_POST['stu_ppno'] : '';
            $stu_ppissueat = isset($_POST['stu_ppissueat']) ? $_POST['stu_ppissueat'] : '';
            $stu_issuedate = isset($_POST['stu_issuedate']) ? $_POST['stu_issuedate'] : '';
            $stu_ppexpdate = isset($_POST['stu_ppexpdate']) ? $_POST['stu_ppexpdate'] : '';
            $stu_visa = isset($_POST['stu_visa']) ? $_POST['stu_visa'] : '';
            $stu_visano = isset($_POST['stu_visano']) ? $_POST['stu_visano'] : '';
            $stu_visaexpdate = isset($_POST['stu_visaexpdate']) ? $_POST['stu_visaexpdate'] : '';
            $stu_10thmark = isset($_POST['stu_10thmark']) ? $_POST['stu_10thmark'] : '';
            $stu_12thmark = isset($_POST['stu_12thmark']) ? $_POST['stu_12thmark'] : '';
            $stu_10theno = isset($_POST['stu_10theno']) ? $_POST['stu_10theno'] : '';
            $stu_12theno = isset($_POST['stu_12theno']) ? $_POST['stu_12theno'] : '';
            $stu_comcerno = isset($_POST['stu_comcerno']) ? $_POST['stu_comcerno'] : '';
            $stu_community = isset($_POST['stu_community']) ? $_POST['stu_community'] : '';
            $stu_caste = isset($_POST['stu_caste']) ? $_POST['stu_caste'] : '';
            $stu_tcno = isset($_POST['stu_tcno']) ? $_POST['stu_tcno'] : '';
            $stu_tccomment = isset($_POST['stu_tccomment']) ? $_POST['stu_tccomment'] : '';







            $updatesql = "UPDATE erp_student
            SET
                `stu_fname` = IF('$first_name' <> '', '$first_name', `stu_fname`),
                `stu_lname` = IF('$last_name' <> '', '$last_name', `stu_lname`),
                `stu_dob` = IF('$date_of_birth' <> '', '$date_of_birth', `stu_dob`),
                `stu_gender` = IF('$gender' <> '', '$gender', `stu_gender`),
                `cls_id` = IF('$clsid' <> '', '$clsid', `cls_id`),
                `stu_doj` = IF('$doj' <> '', '$doj', `stu_doj`),
                `stu_mobile` = IF('$mobile_number' <> '', '$mobile_number', `stu_mobile`),
                `stu_email` = IF('$email' <> '', '$email', `stu_email`),
                `stu_coursetype` = IF('$coursetype' <> '', '$coursetype', `stu_coursetype`),
                `stu_quota` = IF('$quota' <> '', '$quota', `stu_quota`),
                `stu_councellingno` = IF('$stu_counsellingno' <> '', '$stu_counsellingno', `stu_councellingno`),
                `stu_height` = IF('$stu_height' <> '', '$stu_height', `stu_height`),
                `stu_weight` = IF('$stu_weight' <> '', '$stu_weight', `stu_weight`),
                `stu_mlang` = IF('$stu_mlang' <> '', '$stu_mlang', `stu_mlang`),
                `stu_klang` = IF('$stu_klang' <> '', '$stu_klang', `stu_klang`),
                `stu_idmark` = IF('$stu_idmark' <> '', '$stu_idmark', `stu_idmark`),
                `stu_hobbies` = IF('$stu_hobbies' <> '', '$stu_hobbies', `stu_hobbies`),
                `stu_nationality` = IF('$stu_nationality' <> '', '$stu_nationality', `stu_nationality`),
                `stu_extcur` = IF('$stu_extcur' <> '', '$stu_extcur', `stu_extcur`),
                `stu_religion` = IF('$stu_religion' <> '', '$stu_religion', `stu_religion`),
                `stu_bloodgrp` = IF('$stu_bloodgrp' <> '', '$stu_bloodgrp', `stu_bloodgrp`),
                `stu_disability` = IF('$stu_disability' <> '', '$stu_disability', `stu_disability`),
                `stu_disid` = IF('$stu_disid' <> '', '$stu_disid', `stu_disid`),
                `stu_distype` = IF('$stu_distype' <> '', '$stu_distype', `stu_distype`),
                `stu_disper` = IF('$stu_disper' <> '', '$stu_disper', `stu_disper`),
                `stu_pdoctor` = IF('$stu_pdoctor' <> '', '$stu_pdoctor', `stu_pdoctor`),
                `stu_pdoctorno` = IF('$stu_pdoctorno' <> '', '$stu_pdoctorno', `stu_pdoctorno`),
                `stu_bp` = IF('$stu_bp' <> '', '$stu_bp', `stu_bp`),
                `stu_visionL` = IF('$stu_visionL' <> '', '$stu_visionL', `stu_visionL`),
                `stu_visionR` = IF('$stu_visionR' <> '', '$stu_visionR', `stu_visionR`),
                `stu_eyecon` = IF('$stu_eyecon' <> '', '$stu_eyecon', `stu_eyecon`),
                `stu_pulse` = IF('$stu_pulse' <> '', '$stu_pulse', `stu_pulse`),
                `stu_squint` = IF('$stu_squint' <> '', '$stu_squint', `stu_squint`),
                `stu_dentalcon` = IF('$stu_dentalcon' <> '', '$stu_dentalcon', `stu_dentalcon`),
                `stu_healthcon` = IF('$stu_healthcon' <> '', '$stu_healthcon', `stu_healthcon`),
                `stu_father` = IF('$stu_father' <> '', '$stu_father', `stu_father`),
                `stu_foccupation` = IF('$stu_foccupation' <> '', '$stu_foccupation', `stu_foccupation`),
                `stu_fqualification` = IF('$stu_fqualification' <> '', '$stu_fqualification', `stu_fqualification`),
                `stu_fmobile` = IF('$stu_fmobile' <> '', '$stu_fmobile', `stu_fmobile`),
                `stu_mother` = IF('$stu_mother' <> '', '$stu_mother', `stu_mother`),
                `stu_moccupation` = IF('$stu_moccupation' <> '', '$stu_moccupation', `stu_moccupation`),
                `stu_mmobile` = IF('$stu_mmobile' <> '', '$stu_mmobile', `stu_mmobile`),
                `stu_guardian` = IF('$stu_guardian' <> '', '$stu_guardian', `stu_guardian`),
                `stu_gmobile` = IF('$stu_gmobile' <> '', '$stu_gmobile', `stu_gmobile`),
                `stu_sibdetail` = IF('$stu_sibdetail' <> '', '$stu_sibdetail', `stu_sibdetail`),
                `stu_sibinsame` = IF('$stu_sibinsame' <> '', '$stu_sibinsame', `stu_sibinsame`),
                `stu_orphan` = IF('$stu_orphan' <> '', '$stu_orphan', `stu_orphan`),
                `stu_padd` = IF('$stu_padd' <> '', '$stu_padd', `stu_padd`),
                `stu_city` = IF('$stu_city' <> '', '$stu_city', `stu_city`),
                `stu_state` = IF('$stu_state' <> '', '$stu_state', `stu_state`),
                `stu_zip` = IF('$stu_zip' <> '', '$stu_zip', `stu_zip`),
                `stu_hostel` = IF('$stu_hostel' <> '', '$stu_hostel', `stu_hostel`),
    `stu_transport` = IF('$stu_transport' <> '', '$stu_transport', `stu_transport`),
    `stu_hosteltype` = IF('$stu_hosteltype' <> '', '$stu_hosteltype', `stu_hosteltype`),
    `stu_roomno` = IF('$stu_roomno' <> '', '$stu_roomno', `stu_roomno`),
    `stu_food` = IF('$stu_food' <> '', '$stu_food', `stu_food`),
    `stu_nameasbank` = IF('$stu_nameasbank' <> '', '$stu_nameasbank', `stu_nameasbank`),
    `stu_accno` = IF('$stu_accno' <> '', '$stu_accno', `stu_accno`),
    `stu_ifsc` = IF('$stu_ifsc' <> '', '$stu_ifsc', `stu_ifsc`),
    `stu_scholarship` = IF('$stu_scholarship' <> '', '$stu_scholarship', `stu_scholarship`),
    `stu_scholarsts` = IF('$stu_scholarsts' <> '', '$stu_scholarsts', `stu_scholarsts`),
    `stu_income` = IF('$stu_income' <> '', '$stu_income', `stu_income`),
    `stu_inccerno` = IF('$stu_inccerno' <> '', '$stu_inccerno', `stu_inccerno`),
    `stu_fg` = IF('$stu_fg' <> '', '$stu_fg', `stu_fg`),
    `stu_splcat` = IF('$stu_splcat' <> '', '$stu_splcat', `stu_splcat`),
    `stu_lateral` = IF('$stu_lateral' <> '', '$stu_lateral', `stu_lateral`),
    `stu_bankname` = IF('$stu_bankname' <> '', '$stu_bankname', `stu_bankname`),
    `stu_brancename` = IF('$stu_brancename' <> '', '$stu_brancename', `stu_brancename`),
    `stu_aadhar` = IF('$stu_aadhar' <> '', '$stu_aadhar', `stu_aadhar`),
    `stu_ppno` = IF('$stu_ppno' <> '', '$stu_ppno', `stu_ppno`),
    `stu_ppissueat` = IF('$stu_ppissueat' <> '', '$stu_ppissueat', `stu_ppissueat`),
    `stu_issuedate` = IF('$stu_issuedate' <> '', '$stu_issuedate', `stu_issuedate`),
    `stu_ppexpdate` = IF('$stu_ppexpdate' <> '', '$stu_ppexpdate', `stu_ppexpdate`),
    `stu_visa` = IF('$stu_visa' <> '', '$stu_visa', `stu_visa`),
    `stu_visano` = IF('$stu_visano' <> '', '$stu_visano', `stu_visano`),
    `stu_visaexpdate` = IF('$stu_visaexpdate' <> '', '$stu_visaexpdate', `stu_visaexpdate`),
    `stu_10thmark` = IF('$stu_10thmark' <> '', '$stu_10thmark', `stu_10thmark`),
    `stu_12thmark` = IF('$stu_12thmark' <> '', '$stu_12thmark', `stu_12thmark`),
    `stu_10theno` = IF('$stu_10theno' <> '', '$stu_10theno', `stu_10theno`),
    `stu_12theno` = IF('$stu_12theno' <> '', '$stu_12theno', `stu_12theno`),
    `stu_comcerno` = IF('$stu_comcerno' <> '', '$stu_comcerno', `stu_comcerno`),
    `stu_community` = IF('$stu_community' <> '', '$stu_community', `stu_community`),
    `stu_caste` = IF('$stu_caste' <> '', '$stu_caste', `stu_caste`),
    `stu_tcno` = IF('$stu_tcno' <> '', '$stu_tcno', `stu_tcno`),
    `stu_tccomment` = IF('$stu_tccomment' <> '', '$stu_tccomment', `stu_tccomment`)


            WHERE
                `stu_id` = '$sid';
            ";

            // Execute the query
            $updateresult = mysqli_query($conn, $updatesql);

            // Check for errors
            if (!$updateresult) {
                die("Error updating record: " . mysqli_error($conn));
            } else {

            ?>
                <form method="post" action="ViewStudent.php" enctype="multipart/form-data" id="viewform">
                    <input type="hidden" name="sid" value="<?php echo $sid ?>">
                </form>
                <script>
                    alert("Updated Successfully");
                    document.getElementById('viewform').submit();
                </script>



<?php
            }
        }
    }
} else {
    header("Location: ../../index.php");
}
