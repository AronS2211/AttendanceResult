<?php

// session_start();


include('../../includes/config.php');


if (isset($_POST['create'])) {

    // Retrieve data from the HTML form 
    $f_id = $_POST['f_id'];
    $f_fname = $_POST['first_name'];
    $f_lname = $_POST['last_name'];
    $f_dob = $_POST['date_of_birth'];
    $f_gender = $_POST['gender'];
    $f_dept = $_POST['dept'];
    $f_designation = $_POST['designation'];
    $f_qualification = $_POST['qualification'];
    $f_exp = $_POST['experience'];
    $f_role = $_POST['role'];
    $f_doj = $_POST['doj'];
    $f_mobile = $_POST['mobile_number'];
    $f_email = $_POST['email'];

    $sql = "INSERT INTO `erp_faculty`(`f_id`, `f_role`, `f_fname`, `f_lname`,  `f_dept`,  `f_dob`, `f_gender`, `f_mobile`, `f_designation`, `f_qualification`,    `f_exp`, `f_email`, `f_doj` ,`cls_id`)
        VALUES ('$f_id','$f_role','$f_fname','$f_lname','$f_dept','$f_dob','$f_gender','$f_mobile','$f_designation','$f_qualification','$f_exp', '$f_email','$f_doj','$f_clsid')";

    $result = $conn->query($sql);

    $f_username = $_POST['f_id'];
    $f_psw = $_POST['password'];
    $f_cpsw = $_POST['confirmPassword'];
    if ($f_psw === $f_cpsw) {
        $loginsql = "INSERT INTO `erp_login` (`log_id`,`log_pwd`)
                VALUES('$f_username','$f_psw')";
        $loginresult = $conn->query($loginsql);
        if ($loginresult === TRUE and $result == TRUE) {
?>
            <form method="post" action="ViewFaculty.php" enctype="multipart/form-data" id="updateform">
                <input type="hidden" name="fid" value="<?php echo $f_id ?>">
            </form>
            <script>
                if (confirm("Profile successfully Created ! Do you want to add Additional Information?")) {
                    document.getElementById('updateform').submit()
                } else {
                    window.location.href = './Create_faculty.php';
                }
            </script>
        <?php
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

if (isset($_POST['update'])) {

    // Get data from form

    // Retrieve data from the HTML form 

    $f_id = isset($_POST['f_id']) ? $_POST['f_id'] : '';
    $f_fname = isset($_POST['first_name']) ? $_POST['first_name'] : '';
    $f_lname = isset($_POST['last_name']) ? $_POST['last_name'] : '';
    $f_dob = isset($_POST['date_of_birth']) ?  $_POST['date_of_birth'] : '';
    $f_gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $f_dept = isset($_POST['dept']) ? $_POST['dept'] : '';
    $f_designation = isset($_POST['designation']) ? $_POST['designation'] : '';
    $f_qualification = isset($_POST['qualification']) ?  $_POST['qualification'] : '';
    $f_exp = isset($_POST['experience']) ? $_POST['experience'] : '';
    $f_role = isset($_POST['role']) ? $_POST['role'] : '';
    $f_doj = isset($_POST['doj']) ? $_POST['doj'] : '';
    $f_mobile = isset($_POST['mobile_number']) ? $_POST['mobile_number'] : '';
    $f_email = isset($_POST['email']) ? $_POST['email'] : '';
    $f_clsid = isset($_POST['cls_id']) ? $_POST['cls_id'] : '';


    $f_mlang = isset($_POST['mother_lang']) ? $_POST['mother_lang'] : '';
    $f_mar_status = isset($_POST['mar-status']) ?  $_POST['mar-status'] : '';
    $f_idmark = isset($_POST['id_mark']) ? $_POST['id_mark'] : '';
    $f_klang = isset($_POST['k_lang']) ? $_POST['k_lang'] : '';
    $f_pob = isset($_POST['place_of_birth']) ? $_POST['place_of_birth'] : '';
    $f_hobbies = isset($_POST['hobbies']) ? $_POST['hobbies'] : '';
    $f_nationality = isset($_POST['nationality']) ?  $_POST['nationality'] : '';
    $f_religion = isset($_POST['religion']) ?  $_POST['religion'] : '';
    $f_community = isset($_POST['community']) ? $_POST['community'] : '';
    $f_caste = isset($_POST['caste']) ? $_POST['caste'] : '';

    if ($f_religion == 'others') {
        $f_religion = $_POST['otherReligion'];
    }

    $f_bloodgrp = isset($_POST['blood_group']) ?  $_POST['blood_group'] : '';
    $f_pdoctor = isset($_POST['personal_doc_name']) ? $_POST['personal_doc_name'] : '';
    $f_pdoctorno = isset($_POST['personal_doc_no']) ? $_POST['personal_doc_no'] : '';
    $f_emgno = isset($_POST['emergency_no']) ? $_POST['emergency_no'] : '';
    $f_disability = isset($_POST['disability']) ? $_POST['disability'] : '';



    $f_child = isset($_POST['no_of_childs']) ? $_POST['no_of_childs'] : '';
    $f_childinsame = isset($_POST['childs_in_same_clg']) ? $_POST['childs_in_same_clg'] : '';
    $f_childinother = isset($_POST['childs_in_other_clg']) ? $_POST['childs_in_other_clg'] : '';


    // getting address
    $f_add = isset($_POST['address']) ? $_POST['address'] : '';
    $f_city = isset($_POST['city_name']) ? $_POST['city_name'] : '';
    $f_state = isset($_POST['state_name']) ? $_POST['state_name'] : '';
    $f_zip = isset($_POST['pincode']) ?  $_POST['pincode'] : '';
    $f_padd = isset($_POST['per_add']) ? $_POST['per_add'] : '';


    $f_univspec = isset($_POST['university_speacilization']) ? $_POST['university_speacilization'] : '';
    $f_yoc = isset($_POST['year_completion']) ? $_POST['year_completion'] : '';
    $f_teachexp = isset($_POST['f_teachexp']) ? $_POST['f_teachexp'] : '';
    $f_projectguide = isset($_POST['project_guided']) ? $_POST['project_guided'] : '';
    $f_indexp = isset($_POST['ind_exp']) ? $_POST['ind_exp'] : '';
    $pre_emp = isset($_POST['pre_emp']) ? $_POST['pre_emp'] : '';



    $f_transport = isset($_POST['transport']) ? $_POST['transport'] : '';
    $f_hostel = isset($_POST['fac_hostel']) ? $_POST['fac_hostel'] : '';
    $f_food = isset($_POST['food_offering']) ? $_POST['food_offering'] : '';


    $f_panno = isset($_POST['pan_card_no']) ? $_POST['pan_card_no'] : '';
    $f_aadhar = isset($_POST['aadhaar_no']) ? $_POST['aadhaar_no'] : '';
    $f_ppno = isset($_POST['pass_no']) ? $_POST['pass_no'] : '';
    $f_voterid = isset($_POST['voter_id']) ? $_POST['voter_id'] : '';


    $updatesql = "UPDATE erp_faculty
SET
    `f_fname` = IF('$f_fname' <> '', '$f_fname', `f_fname`),
    `f_lname` = IF('$f_lname' <> '', '$f_lname', `f_lname`),
    `f_dob` = IF('$f_dob' <> '', '$f_dob', `f_dob`),
    `f_gender` = IF('$f_gender' <> '', '$f_gender', `f_gender`),
    `f_dept` = IF('$f_dept' <> '', '$f_dept', `f_dept`),
    `f_designation` = IF('$f_designation' <> '', '$f_designation', `f_designation`),
    `f_qualification` = IF('$f_qualification' <> '', '$f_qualification', `f_qualification`),
    `f_exp` = IF('$f_exp' <> '', '$f_exp', `f_exp`),
    `f_role` = IF('$f_role' <> '', '$f_role', `f_role`),
    `f_doj` = IF('$f_doj' <> '', '$f_doj', `f_doj`),
    `f_mobile` = IF('$f_mobile' <> '', '$f_mobile', `f_mobile`),
    `f_email` = IF('$f_email' <> '', '$f_email', `f_email`),
    `cls_id` = IF('$f_clsid' <> '', '$f_clsid', `cls_id`),
    `f_mlang` = IF('$f_mlang' <> '', '$f_mlang', `f_mlang`),
    `f_mstatus` = IF('$f_mar_status' <> '', '$f_mar_status', `f_mstatus`),
    `f_idmark` = IF('$f_idmark' <> '', '$f_idmark', `f_idmark`),
    `f_klang` = IF('$f_klang' <> '', '$f_klang', `f_klang`),
    `f_pob` = IF('$f_pob' <> '', '$f_pob', `f_pob`),
    `f_hobbies` = IF('$f_hobbies' <> '', '$f_hobbies', `f_hobbies`),
    `f_nationality` = IF('$f_nationality' <> '', '$f_nationality', `f_nationality`),
    `f_religion` = IF('$f_religion' <> '', '$f_religion', `f_religion`),
    `f_community` = IF('$f_community' <> '', '$f_community', `f_community`),
    `f_caste` = IF('$f_caste' <> '', '$f_caste', `f_caste`),
    `f_bloodgrp` = IF('$f_bloodgrp' <> '', '$f_bloodgrp', `f_bloodgrp`),
    `f_pdoctor` = IF('$f_pdoctor' <> '', '$f_pdoctor', `f_pdoctor`),
    `f_pdoctorno` = IF('$f_pdoctorno' <> '', '$f_pdoctorno', `f_pdoctorno`),
    `f_emgno` = IF('$f_emgno' <> '', '$f_emgno', `f_emgno`),
    `f_disability` = IF('$f_disability' <> '', '$f_disability', `f_disability`),
    `f_child` = IF('$f_child' <> '', '$f_child', `f_child`),
    `f_childinsame` = IF('$f_childinsame' <> '', '$f_childinsame', `f_childinsame`),
    `f_childinother` = IF('$f_childinother' <> '', '$f_childinother', `f_childinother`),
    `f_add` = IF('$f_add' <> '', '$f_add', `f_add`),
    `f_city` = IF('$f_city' <> '', '$f_city', `f_city`),
    `f_state` = IF('$f_state' <> '', '$f_state', `f_state`),
    `f_zip` = IF('$f_zip' <> '', '$f_zip', `f_zip`),
    `f_padd` = IF('$f_padd' <> '', '$f_padd', `f_padd`),
    `f_univspec` = IF('$f_univspec' <> '', '$f_univspec', `f_univspec`),
    `f_yoc` = IF('$f_yoc' <> '', '$f_yoc', `f_yoc`),
    `f_teachexp` = IF('$f_teachexp' <> '', '$f_teachexp', `f_teachexp`),
    `f_projguide` = IF('$f_projectguide' <> '', '$f_projectguide', `f_projguide`),
    `f_indexp` = IF('$f_indexp' <> '', '$f_indexp', `f_indexp`),
    `f_pastemp` = IF('$pre_emp' <> '', '$pre_emp', `f_pastemp`),
    `f_transport` = IF('$f_transport' <> '', '$f_transport', `f_transport`),
    `f_hostel` = IF('$f_hostel' <> '', '$f_hostel', `f_hostel`),
    `f_food` = IF('$f_food' <> '', '$f_food', `f_food`),
    `f_panno` = IF('$f_panno' <> '', '$f_panno', `f_panno`),
    `f_aadhaarno` = IF('$f_aadhar' <> '', '$f_aadhar', `f_aadhaarno`),
    `f_ppno` = IF('$f_ppno' <> '', '$f_ppno', `f_ppno`),
    `f_voterid` = IF('$f_voterid' <> '', '$f_voterid', `f_voterid`)
WHERE
    `f_id` = '$f_id';
";

    // Execute the query
    $updateresult = mysqli_query($conn, $updatesql);

    // Check for errors
    if (!$updateresult) {
        die("Error updating record: " . mysqli_error($conn));
    } else {


        ?>
        <form method="post" action="ViewFaculty.php" enctype="multipart/form-data" id="viewform">
            <input type="hidden" name="fid" value="<?php echo $f_id ?>">
        </form>
        <script>
            alert("Updated Successfully");
            document.getElementById('viewform').submit();
        </script>



<?php
    }
}

?>