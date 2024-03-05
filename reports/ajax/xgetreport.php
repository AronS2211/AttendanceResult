<?php
include('../../includes/config.php');
$sql = "SELECT *,TIMESTAMPDIFF(YEAR, stu_dob, CURDATE()) AS age,TIMESTAMPDIFF(YEAR, stu_doj, CURDATE()) AS exp FROM erp_student left join erp_login on erp_student.stu_id =erp_login.log_id
left join erp_transport on erp_student.tr_id=erp_transport.tr_id 
left join erp_class on erp_student.cls_id=erp_class.cls_id 
left join erp_hostel on erp_student.h_id=erp_hostel.h_id where 1 ";
$sql2 = "SELECT *,TIMESTAMPDIFF(YEAR, f_dob, CURDATE()) AS age,TIMESTAMPDIFF(YEAR, f_doj, CURDATE()) AS exp FROM erp_faculty left join erp_login on erp_faculty.f_id =erp_login.log_id
left join erp_transport on erp_faculty.tr_id=erp_transport.tr_id 
left join erp_class on erp_faculty.cls_id=erp_class.cls_id 
left join erp_hostel on erp_faculty.h_id=erp_hostel.h_id 
left join erp_role on erp_faculty.f_role=erp_role.r_id where 1 ";
if ($_POST["fname"] != null) {
    $key = $_POST["fname"];
    $sql .= "and stu_fname like '%$key%'";
    $sql2 .= "and f_fname like '%$key%'";
}
if ($_POST["lname"] != null) {
    $key = $_POST["lname"];
    $sql .= "and stu_lname like '%$key%'";
    $sql2 .= "and stu_lname like '%$key%'";
}
if ($_POST["dept"] != null) {
    $dept = $_POST["dept"];
    $cls = explode(',', $dept);
    $sql .= "and cls_startyr='$cls[0]' and cls_endyr='$cls[1]' and cls_course='$cls[2]' and cls_dept='$cls[3]'";
    $sql2 .= "and f_dept='$cls[3]'";
}
if ($_POST["sem"] != null) {
    $key = $_POST["sem"];
    $sql .= "and cls_sem='$key'";
    $sql2 .= "and cls_sem='$key'";
}
if ($_POST["route"] != null) {
    $key = $_POST["route"];
    $sql .= "and tr_routename='$key'";
    $sql2 .= "and tr_routename='$key'";
}
if ($_POST["stop"] != null) {
    $key = $_POST["stop"];
    $sql .= "and tr_stop='$key'";
    $sql2 .= "and tr_stop='$key'";
}
// if (isset($_POST["role"])) {
//     $key = $_POST["role"];
//     $sql .= "and r_rolename='$key'";
// }
if ($_POST["quote"] != null) {
    $key = $_POST["quote"];
    $sql .= "and stu_quota='$key'";
    $sql2 .= "N/A";
}
if ($_POST["transport"] != null) {
    $key = $_POST["transport"];
    $sql .= "and stu_transport='$key'";
    $sql .= "and f_transport='$key'";
}
if ($_POST["blood"] != null) {
    $key = $_POST["blood"];
    $sql .= "and stu_bloodgrp='$key'";
    $sql2 .= "and f_bloodgrp='$key'";
}
if ($_POST["comm"] != null) {
    $key = $_POST["comm"];
    $sql .= "and stu_community='$key'";
    $sql2 .= "and f_community='$key'";
}
if ($_POST["caste"] != null) {
    $key = $_POST["caste"];
    $sql .= "and stu_caste='$key'";
    $sql2 .= "and f_caste='$key'";
}
if ($_POST["rel"] != null) {
    $key = $_POST["rel"];
    $sql .= "and stu_religion='$key'";
    $sql2 .= "and f_religion='$key'";
}
if ($_POST["gen"] != null) {
    $key = $_POST["gen"];
    $sql .= "and stu_gender='$key'";
    $sql2 .= "and f_gender='$key'";
}
if ($_POST["hos"] != null) {
    $key = $_POST["hos"];
    $sql .= "and stu_hostel='$key'";
    $sql2 .= "and f_hostel='$key'";
}
if ($_POST["admno"] != null) {
    $key = $_POST["admno"];
    $sql .= "and stu_admno='$key'";
}
if ($_POST["agefr"] != null || $_POST["ageto"] != null) {
    $age1 = $_POST["agefr"] != null ? $_POST["agefr"] : 0;
    $age2 = $_POST["ageto"] != null ? $_POST["ageto"] : 100;
    $sql .= "and TIMESTAMPDIFF(YEAR, stu_dob, CURDATE()) between " . $age1 . " and " . $age2 . "";
    $sql2 .= "and TIMESTAMPDIFF(YEAR, f_dob, CURDATE()) between " . $age1 . " and " . $age2 . "";
}
$exp1 = 0;
$exp2 = 100;
if ($_POST["expfr"] != null || $_POST["expto"] != null) {
    $exp1 = $_POST["expfr"] != null ? $_POST["expfr"] : 0;
    $exp2 = $_POST["expto"] != null ? $_POST["expto"] : 100;
    $sql .= "and TIMESTAMPDIFF(YEAR, stu_doj, CURDATE()) between " . $exp1 . " and " . $exp2 . "";
    $sql2 .= "and TIMESTAMPDIFF(YEAR, f_doj, CURDATE()) between " . $exp1 . " and " . $exp2 . "";
}
$sqlq = mysqli_query($con, $sql);
$sqlq2 = mysqli_query($con, $sql2);
// Checkbox
if (isset($_POST['checkbox'])) {
    foreach ($_POST['checkbox'] as $value) {
        $cbox[] = $value;
    }

    foreach ($_POST as $key => $value) {
    }

    // table
    echo "<table>
<thead>
    <tr>";
    foreach ($cbox as $c):
        echo "<td>$c</td>";
    endforeach;
    echo "</tr>
</thead>
<tbody>";
    // while ($row = mysqli_fetch_assoc($sqlq)) {
    //     if (in_array('First Name', $cbox)) {
    //         $field[] = $row['stu_fname'];
    //     }
    //     if (in_array('Designation', $cbox)) {
    //         $field[] = 'N/A';
    //     }
    //     if (in_array('Last Name', $cbox)) {
    //         $field[] = $row['stu_lname'];
    //     }
    //     if (in_array('Department', $cbox)) {
    //         $field[] = $row['cls_startyr'] . ' - ' . $row['cls_endyr'] . ' ' . $row['cls_course'] . ' ' . $row['cls_dept'] . ' Semester ' . $row['cls_sem'];
    //         $field2[] = $row['cls_dept'];
    //     }
    //     if (in_array('Mobile Phone', $cbox)) {
    //         $field[] = $row['stu_mobile'];
    //         $field2[] = $row['f_mobile'];
    //     }
    //     if (in_array('Photo', $cbox)) {
    //         $field[] = $row['stu_img'];
    //         $field2[] = $row['f_img'];
    //     }
    //     // Process Blood Group
    //     if (in_array('Blood Group', $cbox)) {
    //         $field[] = $row['stu_bloodgrp'];
    //         $field2[] = $row['f_bloodgrp'];
    //     }

    //     // Process Student Quota
    //     if (in_array('Student Quota', $cbox)) {
    //         $field[] = $row['stu_quota'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Community
    //     if (in_array('Community', $cbox)) {
    //         $field[] = $row['stu_community'];
    //         $field2[] = $row['f_community'];
    //     }

    //     // Process Caste
    //     if (in_array('Caste', $cbox)) {
    //         $field[] = $row['stu_caste'];
    //         $field2[] = $row['f_caste'];
    //     }

    //     // Process Aadhaar No
    //     if (in_array('Aadhaar No', $cbox)) {
    //         $field[] = $row['stu_aadhar'];
    //         $field2[] = $row['f_aadhaarno'];
    //     }

    //     // Process Admission Date
    //     if (in_array('Admission Date', $cbox)) {
    //         $field[] = $row['stu_doj'];
    //         $field2[] = $row['stu_doj'];
    //     }

    //     // Process Admission Number
    //     if (in_array('Admission Number', $cbox)) {
    //         $field[] = $row['stu_admno'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Email
    //     if (in_array('Email', $cbox)) {
    //         $field[] = $row['stu_email'];
    //         $field2[] = $row['f_email'];
    //     }

    //     // Process City
    //     if (in_array('City', $cbox)) {
    //         $field[] = $row['stu_city'];
    //         $field2[] = $row['f_city'];
    //     }

    //     // Process Class Advisor
    //     if (in_array('Class Advisor', $cbox)) {
    //         $field[] = 'N/A';
    //         $field2[] = $row['cls_startyr'] . ' - ' . $row['cls_endyr'] . ' ' . $row['cls_course'] . ' ' . $row['cls_dept'] . ' Semester ' . $row['cls_sem'];
    //     }

    //     // Process Date of Birth
    //     if (in_array('Date of Birth', $cbox)) {
    //         $field[] = $row['stu_dob'];
    //         $field2[] = $row['f_dob'];
    //     }

    //     // Process Date Of Joining
    //     if (in_array('Date Of Joining', $cbox)) {
    //         $field[] = $row['stu_doj'];
    //         $field2[] = $row['f_doj'];
    //     }

    //     // Process Dietary Needs Details
    //     // if (in_array('Dietary Needs Details', $cbox)) {
    //     //     $field[] = "N/A";
    //     // }

    //     // Process Disability
    //     if (in_array('Disability', $cbox)) {
    //         $field[] = $row['stu_disability'];
    //         $field2[] = $row['f_disability'];
    //     }

    //     // Process DisabilityDetails
    //     if (in_array('DisabilityDetails', $cbox)) {
    //         $field[] = 'Disability ID : ' . $row['stu_disid'] . '<br> Disability Type : ' . $row['stu_distype'] . '<br> Disability Percentage :' . $row['stu_disper'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Drop Time
    //     if (in_array('Drop Time', $cbox)) {
    //         $field[] = $row['tr_drop'];
    //         $field2[] = $row['tr_drop'];
    //     }

    //     // Process Education Details
    //     if (in_array('Education Details', $cbox)) {
    //         $field[] = "10th Exam No : " . $row['stu_10theno'] . "<br> 10th mark : " . $row['stu_10thmark'] . "<br> 12th Exam No : " . $row['stu_12theno'] . "<br> 12th mark: " . $row['stu_12thmark'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Emergency Contact number
    //     if (in_array('Emergency Contact number', $cbox)) {
    //         $field[] = $row['stu_emergencyno'];
    //         $field2[] = $row['f_emgno'];
    //     }

    //     // Process Faculty ID
    //     if (in_array('Faculty ID', $cbox)) {
    //         $field[] = 'N/A';
    //         $field2[] = $row['f_id'];
    //     }

    //     // Process Experience
    //     if (in_array('Experience', $cbox)) {
    //         $field[] = 'N/A';
    //         $field2[] = $row['f_exp'];
    //     }

    //     // Process Experience Details
    //     if (in_array('Experience Details', $cbox)) {
    //         $field[] = 'N/A';
    //         $field2[] = $row['f_exp'];
    //     }

    //     // Process Extra Curricular Activities
    //     if (in_array('Extra Curricular Activities', $cbox)) {
    //         $field[] = $row['stu_extcur'];
    //         $field2[] = 'N/A';
    //     }

    //     // Process Father Education
    //     if (in_array('Father Education', $cbox)) {
    //         $field[] = $row['stu_fqualification'];
    //         $field2[] = 'N/A';
    //     }

    //     // Process Father Name
    //     if (in_array('Father Name', $cbox)) {
    //         $field[] = $row['stu_father'];
    //         $field2[] = 'N/A';
    //     }

    //     // Process Father Mobile
    //     if (in_array('Father Mobile', $cbox)) {
    //         $field[] = $row['stu_fmobile'];
    //         $field2[] = 'N/A';
    //     }

    //     // Process Father Occupation
    //     if (in_array('Father Occupation', $cbox)) {
    //         $field[] = $row['stu_foccupation'];
    //         $field2[] = 'N/A';
    //     }

    //     // Process Food Offering
    //     if (in_array('Food Offering', $cbox)) {
    //         $field[] = $row['stu_food'];
    //         $field2[] = $row['f_food'];
    //     }

    //     // Process Full Name
    //     if (in_array('Full Name', $cbox)) {
    //         $field[] = $row['stu_fname'] . ' ' . $row['stu_lname'];
    //         $field2[] = $row['f_fname'] . ' ' . $row['f_lname'];
    //     }

    //     // Process Gender
    //     if (in_array('Gender', $cbox)) {
    //         $field[] = $row['stu_gender'];
    //         $field2[] = $row['f_gender'];
    //     }

    //     // Process Hostel
    //     if (in_array('Hostel', $cbox)) {
    //         $field[] = $row['stu_hostel'];
    //         $field2[] = $row['stu_hostel'];
    //     }

    //     // Process Identification Marks
    //     if (in_array('Identification Marks', $cbox)) {
    //         $field[] = $row['stu_idmark'];
    //         $field2[] = $row['f_idmark'];
    //     }

    //     // Process Mother Name
    //     if (in_array('Mother Name', $cbox)) {
    //         $field[] = $row['stu_mother'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Mother Mobile
    //     if (in_array('Mother Mobile', $cbox)) {
    //         $field[] = $row['stu_mmobile'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Mother Occupation
    //     if (in_array('Mother Occupation', $cbox)) {
    //         $field[] = $row['stu_moccupation'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Mother Tongue
    //     if (in_array('Mother Tongue', $cbox)) {
    //         $field[] = $row['stu_mlang'];
    //         $field2[] = $row['f_mlang'];
    //     }

    //     // Process Nationality
    //     if (in_array('Nationality', $cbox)) {
    //         $field[] = $row['stu_nationality'];
    //         $field2[] = $row['f_nationality'];
    //     }

    //     // Process Guardian Name
    //     if (in_array('Guardian Name', $cbox)) {
    //         $field[] = $row['stu_guardian'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Guardian Mobile Phone
    //     if (in_array('Guardian Mobile Phone', $cbox)) {
    //         $field[] = $row['stu_gmobile'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Permanent Address
    //     if (in_array('Permanent Address', $cbox)) {
    //         $field[] = $row['stu_padd'];
    //         $field2[] = $row['f_padd'];
    //     }

    //     // Process Personal doctor details
    //     if (in_array('Personal doctor details', $cbox)) {
    //         $field[] = 'Personal doctor Name : ' . $row['stu_pdoctor'] . '<br> Personal doctor Number : ' . $row['stu_pdoctorno'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Pick Time
    //     if (in_array('Pick Time', $cbox)) {
    //         $field[] = $row['tr_pickup'];
    //         $field2[] = $row['tr_pickup'];
    //     }

    //     // Process Pin Code
    //     if (in_array('Pin Code', $cbox)) {
    //         $field[] = $row['stu_zip'];
    //         $field2[] = $row['f_zip'];
    //     }

    //     // Process Qualification
    //     if (in_array('Qualification', $cbox)) {
    //         $field[] = 'N/A';
    //         $field2[] = $row['f_qualification'];
    //     }

    //     // Process Reg. No.
    //     if (in_array('Reg. No.', $cbox)) {
    //         $field[] = $row['stu_regno'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Religion Name
    //     if (in_array('Religion Name', $cbox)) {
    //         $field[] = $row['stu_religion'];
    //         $field2[] = $row['f_religion'];
    //     }

    //     // Process Role Name
    //     if (in_array('Role Name', $cbox)) {
    //         $field[] = 'Student';
    //         $field2[] = $row['r_rolename'];
    //     }

    //     // Process Roll Number
    //     if (in_array('Roll Number', $cbox)) {
    //         $field[] = $row['stu_id'];
    //         $field2[] = $row['f_id'];
    //     }

    //     // Process Room
    //     if (in_array('Room', $cbox)) {
    //         $field[] = $row['stu_roomno'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Route
    //     if (in_array('Route', $cbox)) {
    //         $field[] = $row['tr_routename'];
    //         $field2[] = $row['tr_routename'];
    //     }

    //     // Process Scholarship
    //     if (in_array('Scholarship', $cbox)) {
    //         $field[] = $row['stu_scholarship'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Semester
    //     if (in_array('Semester', $cbox)) {
    //         $field[] = $row['cls_sem'];
    //         $field2[] = $row['cls_sem'];
    //     }

    //     // Process Sibling Details
    //     if (in_array('Sibling Details', $cbox)) {
    //         $field[] = $row['stu_sibdetail'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Siblings in Same Institute
    //     if (in_array('Siblings in Same Institute', $cbox)) {
    //         $field[] = $row['stu_sibinsame'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Staff Child
    //     if (in_array('Staff Child', $cbox)) {
    //         $field[] = "N/A";
    //         $field2[] = $row['f_child'];
    //     }

    //     // Process State Name
    //     if (in_array('State Name', $cbox)) {
    //         $field[] = $row['stu_state'];
    //         $field2[] = $row['f_state'];
    //     }

    //     // Process Stop Name
    //     if (in_array('Stop Name', $cbox)) {
    //         $field[] = $row['tr_stop'];
    //         $field2[] = $row['tr_stop'];
    //     }

    //     // Process TC Comments
    //     if (in_array('TC Comments', $cbox)) {
    //         $field[] = $row['stu_tccomment'];
    //         $field2[] = "N/A";
    //     }

    //     // Process TC Number
    //     if (in_array('TC Number', $cbox)) {
    //         $field[] = $row['stu_tcno'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Transfer Details
    //     if (in_array('Transfer Details', $cbox)) {
    //         $field[] = $row['stu_transfer'];
    //         $field2[] = "N/A";
    //     }

    //     // Process Transport
    //     if (in_array('Transport', $cbox)) {
    //         $field[] = $row['stu_transport'];
    //         $field2[] = $row['f_transport'];
    //     }

    //     // Process Type of Disability
    //     if (in_array('Type of Disability', $cbox)) {
    //         $field[] = $row['stu_distype'];
    //         $field2[] = "N/A";
    //     }

    //     //Designation

    //     echo "<tr>";
    //     foreach ($field as $f):
    //         echo "<td>$f</td>";
    //     endforeach;
    //     echo "</tr>";
    //     $field = array();
    // }
    ////////////////////////////////////////////////////////////////////
    $row = array();
    while ($row = mysqli_fetch_assoc($sqlq2)) {
        if (in_array('First Name', $cbox)) {
            $field[] = $row['stu_fname'];
            $field2[] = $row['f_fname'];
        }
        if (in_array('Designation', $cbox)) {
            $field[] = 'N/A';
            $field2[] = $row['f_designation'];
        }
        if (in_array('Last Name', $cbox)) {
            $field[] = $row['stu_lname'];
            $field2[] = $row['f_lname'];
        }
        if (in_array('Department', $cbox)) {
            $field[] = $row['cls_startyr'] . ' - ' . $row['cls_endyr'] . ' ' . $row['cls_course'] . ' ' . $row['cls_dept'] . ' Semester ' . $row['cls_sem'];
            $field2[] = $row['cls_dept'];
        }
        if (in_array('Mobile Phone', $cbox)) {
            $field[] = $row['stu_mobile'];
            $field2[] = $row['f_mobile'];
        }
        if (in_array('Photo', $cbox)) {
            $field[] = $row['stu_img'];
            $field2[] = $row['f_img'];
        }
        // Process Blood Group
        if (in_array('Blood Group', $cbox)) {
            $field[] = $row['stu_bloodgrp'];
            $field2[] = $row['f_bloodgrp'];
        }

        // Process Student Quota
        if (in_array('Student Quota', $cbox)) {
            $field[] = $row['stu_quota'];
            $field2[] = "N/A";
        }

        // Process Community
        if (in_array('Community', $cbox)) {
            $field[] = $row['stu_community'];
            $field2[] = $row['f_community'];
        }

        // Process Caste
        if (in_array('Caste', $cbox)) {
            $field[] = $row['stu_caste'];
            $field2[] = $row['f_caste'];
        }

        // Process Aadhaar No
        if (in_array('Aadhaar No', $cbox)) {
            $field[] = $row['stu_aadhar'];
            $field2[] = $row['f_aadhaarno'];
        }

        // Process Admission Date
        if (in_array('Admission Date', $cbox)) {
            $field[] = $row['stu_doj'];
            $field2[] = $row['stu_doj'];
        }

        // Process Admission Number
        if (in_array('Admission Number', $cbox)) {
            $field[] = $row['stu_admno'];
            $field2[] = "N/A";
        }

        // Process Email
        if (in_array('Email', $cbox)) {
            $field[] = $row['stu_email'];
            $field2[] = $row['f_email'];
        }

        // Process City
        if (in_array('City', $cbox)) {
            $field[] = $row['stu_city'];
            $field2[] = $row['f_city'];
        }

        // Process Class Advisor
        if (in_array('Class Advisor', $cbox)) {
            $field[] = 'N/A';
            $field2[] = $row['cls_startyr'] . ' - ' . $row['cls_endyr'] . ' ' . $row['cls_course'] . ' ' . $row['cls_dept'] . ' Semester ' . $row['cls_sem'];
        }

        // Process Date of Birth
        if (in_array('Date of Birth', $cbox)) {
            $field[] = $row['stu_dob'];
            $field2[] = $row['f_dob'];
        }

        // Process Date Of Joining
        if (in_array('Date Of Joining', $cbox)) {
            $field[] = $row['stu_doj'];
            $field2[] = $row['f_doj'];
        }

        // Process Dietary Needs Details
        // if (in_array('Dietary Needs Details', $cbox)) {
        //     $field[] = "N/A";
        // }

        // Process Disability
        if (in_array('Disability', $cbox)) {
            $field[] = $row['stu_disability'];
            $field2[] = $row['f_disability'];
        }

        // Process DisabilityDetails
        if (in_array('DisabilityDetails', $cbox)) {
            $field[] = 'Disability ID : ' . $row['stu_disid'] . '<br> Disability Type : ' . $row['stu_distype'] . '<br> Disability Percentage :' . $row['stu_disper'];
            $field2[] = "N/A";
        }

        // Process Drop Time
        if (in_array('Drop Time', $cbox)) {
            $field[] = $row['tr_drop'];
            $field2[] = $row['tr_drop'];
        }

        // Process Education Details
        if (in_array('Education Details', $cbox)) {
            $field[] = "10th Exam No : " . $row['stu_10theno'] . "<br> 10th mark : " . $row['stu_10thmark'] . "<br> 12th Exam No : " . $row['stu_12theno'] . "<br> 12th mark: " . $row['stu_12thmark'];
            $field2[] = "N/A";
        }

        // Process Emergency Contact number
        if (in_array('Emergency Contact number', $cbox)) {
            $field[] = $row['stu_emergencyno'];
            $field2[] = $row['f_emgno'];
        }

        // Process Faculty ID
        if (in_array('Faculty ID', $cbox)) {
            $field[] = 'N/A';
            $field2[] = $row['f_id'];
        }

        // Process Experience
        if (in_array('Experience', $cbox)) {
            $field[] = 'N/A';
            $field2[] = $row['f_exp'];
        }

        // Process Experience Details
        if (in_array('Experience Details', $cbox)) {
            $field[] = 'N/A';
            $field2[] = $row['f_exp'];
        }

        // Process Extra Curricular Activities
        if (in_array('Extra Curricular Activities', $cbox)) {
            $field[] = $row['stu_extcur'];
            $field2[] = 'N/A';
        }

        // Process Father Education
        if (in_array('Father Education', $cbox)) {
            $field[] = $row['stu_fqualification'];
            $field2[] = 'N/A';
        }

        // Process Father Name
        if (in_array('Father Name', $cbox)) {
            $field[] = $row['stu_father'];
            $field2[] = 'N/A';
        }

        // Process Father Mobile
        if (in_array('Father Mobile', $cbox)) {
            $field[] = $row['stu_fmobile'];
            $field2[] = 'N/A';
        }

        // Process Father Occupation
        if (in_array('Father Occupation', $cbox)) {
            $field[] = $row['stu_foccupation'];
            $field2[] = 'N/A';
        }

        // Process Food Offering
        if (in_array('Food Offering', $cbox)) {
            $field[] = $row['stu_food'];
            $field2[] = $row['f_food'];
        }

        // Process Full Name
        if (in_array('Full Name', $cbox)) {
            $field[] = $row['stu_fname'] . ' ' . $row['stu_lname'];
            $field2[] = $row['f_fname'] . ' ' . $row['f_lname'];
        }

        // Process Gender
        if (in_array('Gender', $cbox)) {
            $field[] = $row['stu_gender'];
            $field2[] = $row['f_gender'];
        }

        // Process Hostel
        if (in_array('Hostel', $cbox)) {
            $field[] = $row['stu_hostel'];
            $field2[] = $row['stu_hostel'];
        }

        // Process Identification Marks
        if (in_array('Identification Marks', $cbox)) {
            $field[] = $row['stu_idmark'];
            $field2[] = $row['f_idmark'];
        }

        // Process Mother Name
        if (in_array('Mother Name', $cbox)) {
            $field[] = $row['stu_mother'];
            $field2[] = "N/A";
        }

        // Process Mother Mobile
        if (in_array('Mother Mobile', $cbox)) {
            $field[] = $row['stu_mmobile'];
            $field2[] = "N/A";
        }

        // Process Mother Occupation
        if (in_array('Mother Occupation', $cbox)) {
            $field[] = $row['stu_moccupation'];
            $field2[] = "N/A";
        }

        // Process Mother Tongue
        if (in_array('Mother Tongue', $cbox)) {
            $field[] = $row['stu_mlang'];
            $field2[] = $row['f_mlang'];
        }

        // Process Nationality
        if (in_array('Nationality', $cbox)) {
            $field[] = $row['stu_nationality'];
            $field2[] = $row['f_nationality'];
        }

        // Process Guardian Name
        if (in_array('Guardian Name', $cbox)) {
            $field[] = $row['stu_guardian'];
            $field2[] = "N/A";
        }

        // Process Guardian Mobile Phone
        if (in_array('Guardian Mobile Phone', $cbox)) {
            $field[] = $row['stu_gmobile'];
            $field2[] = "N/A";
        }

        // Process Permanent Address
        if (in_array('Permanent Address', $cbox)) {
            $field[] = $row['stu_padd'];
            $field2[] = $row['f_padd'];
        }

        // Process Personal doctor details
        if (in_array('Personal doctor details', $cbox)) {
            $field[] = 'Personal doctor Name : ' . $row['stu_pdoctor'] . '<br> Personal doctor Number : ' . $row['stu_pdoctorno'];
            $field2[] = "N/A";
        }

        // Process Pick Time
        if (in_array('Pick Time', $cbox)) {
            $field[] = $row['tr_pickup'];
            $field2[] = $row['tr_pickup'];
        }

        // Process Pin Code
        if (in_array('Pin Code', $cbox)) {
            $field[] = $row['stu_zip'];
            $field2[] = $row['f_zip'];
        }

        // Process Qualification
        if (in_array('Qualification', $cbox)) {
            $field[] = 'N/A';
            $field2[] = $row['f_qualification'];
        }

        // Process Reg. No.
        if (in_array('Reg. No.', $cbox)) {
            $field[] = $row['stu_regno'];
            $field2[] = "N/A";
        }

        // Process Religion Name
        if (in_array('Religion Name', $cbox)) {
            $field[] = $row['stu_religion'];
            $field2[] = $row['f_religion'];
        }

        // Process Role Name
        if (in_array('Role Name', $cbox)) {
            $field[] = 'Student';
            $field2[] = $row['r_rolename'];
        }

        // Process Roll Number
        if (in_array('Roll Number', $cbox)) {
            $field[] = $row['stu_id'];
            $field2[] = $row['f_id'];
        }

        // Process Room
        if (in_array('Room', $cbox)) {
            $field[] = $row['stu_roomno'];
            $field2[] = "N/A";
        }

        // Process Route
        if (in_array('Route', $cbox)) {
            $field[] = $row['tr_routename'];
            $field2[] = $row['tr_routename'];
        }

        // Process Scholarship
        if (in_array('Scholarship', $cbox)) {
            $field[] = $row['stu_scholarship'];
            $field2[] = "N/A";
        }

        // Process Semester
        if (in_array('Semester', $cbox)) {
            $field[] = $row['cls_sem'];
            $field2[] = $row['cls_sem'];
        }

        // Process Sibling Details
        if (in_array('Sibling Details', $cbox)) {
            $field[] = $row['stu_sibdetail'];
            $field2[] = "N/A";
        }

        // Process Siblings in Same Institute
        if (in_array('Siblings in Same Institute', $cbox)) {
            $field[] = $row['stu_sibinsame'];
            $field2[] = "N/A";
        }

        // Process Staff Child
        if (in_array('Staff Child', $cbox)) {
            $field[] = "N/A";
            $field2[] = $row['f_child'];
        }

        // Process State Name
        if (in_array('State Name', $cbox)) {
            $field[] = $row['stu_state'];
            $field2[] = $row['f_state'];
        }

        // Process Stop Name
        if (in_array('Stop Name', $cbox)) {
            $field[] = $row['tr_stop'];
            $field2[] = $row['tr_stop'];
        }

        // Process TC Comments
        if (in_array('TC Comments', $cbox)) {
            $field[] = $row['stu_tccomment'];
            $field2[] = "N/A";
        }

        // Process TC Number
        if (in_array('TC Number', $cbox)) {
            $field[] = $row['stu_tcno'];
            $field2[] = "N/A";
        }

        // Process Transfer Details
        if (in_array('Transfer Details', $cbox)) {
            $field[] = $row['stu_transfer'];
            $field2[] = "N/A";
        }

        // Process Transport
        if (in_array('Transport', $cbox)) {
            $field[] = $row['stu_transport'];
            $field2[] = $row['f_transport'];
        }

        // Process Type of Disability
        if (in_array('Type of Disability', $cbox)) {
            $field[] = $row['stu_distype'];
            $field2[] = "N/A";
        }

        //Designation

        echo "<tr>";
        foreach ($field2 as $f2):
            echo "<td>$f2</td>";
        endforeach;
        echo "</tr>";
        $field2 = array();
    }
    // 
    echo "
</tbody>
</table>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div class="d-flex justify-content-between">
        <a href="../export_excel.php" class="btn-pri">Export to Excel</a>
        <div class="fs-5">ANYDATA REPORT</div>
        <a href="../export_pdf.php" class="btn-pri">Export to PDF</a>
    </div>
</body>

</html>