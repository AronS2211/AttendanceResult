-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2023 at 06:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `erp_attact`
--

CREATE TABLE `erp_attact` (
  `att_actid` bigint(20) NOT NULL COMMENT 'attendance activity id',
  `att_id` bigint(20) NOT NULL COMMENT 'attendance id',
  `stu_id` bigint(20) NOT NULL COMMENT 'student id(Register no)',
  `att_date` date NOT NULL COMMENT 'attendance date',
  `att_hour` varchar(10) NOT NULL COMMENT 'attendance hour(1,2,3,4,5,6,7,8)',
  `att_sub` varchar(50) NOT NULL COMMENT 'subcode of attendance taken',
  `att_status` varchar(10) NOT NULL COMMENT 'attendance status(P/A)',
  `cls_id` bigint(20) NOT NULL COMMENT 'class id',
  `att_act` varchar(30) NOT NULL COMMENT 'Activity (delete/update)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `erp_attendance`
--

CREATE TABLE `erp_attendance` (
  `att_id` bigint(20) NOT NULL COMMENT 'attendance id',
  `stu_id` bigint(20) NOT NULL COMMENT 'student id(Register no)',
  `att_date` date NOT NULL COMMENT 'attendance date',
  `att_hour` varchar(10) NOT NULL COMMENT 'attendance hour(1,2,3,4,5,6,7,8)',
  `att_sub` varchar(50) NOT NULL COMMENT 'subcode of attendance taken',
  `att_status` varchar(10) NOT NULL COMMENT 'attendance status(P/A)',
  `cls_id` bigint(20) NOT NULL COMMENT 'class id'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_attendance`
--

INSERT INTO `erp_attendance` (`att_id`, `stu_id`, `att_date`, `att_hour`, `att_sub`, `att_status`, `cls_id`) VALUES
(1, 950320104005, '2023-03-03', '2', 'MINI PROJECT', 'P', 1),
(2, 950320104006, '2023-03-03', '2', 'MINI PROJECT', 'P', 1),
(3, 950320104012, '2023-03-03', '2', 'MINI PROJECT', 'A', 1),
(4, 950320104013, '2023-03-03', '2', 'MINI PROJECT', 'A', 1),
(5, 950320104018, '2023-03-03', '2', 'MINI PROJECT', 'P', 1);

-- --------------------------------------------------------

--
-- Table structure for table `erp_calender`
--

CREATE TABLE `erp_calender` (
  `cal_id` bigint(20) NOT NULL COMMENT 'Calender id',
  `cal_event` varchar(30) NOT NULL COMMENT 'Event name',
  `cal_timestamp` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'timestamp of Event creation',
  `cal_postby` varchar(30) NOT NULL COMMENT 'Posted by Whom',
  `cal_sdate` date NOT NULL COMMENT 'Event Starting date',
  `cal_edate` date NOT NULL COMMENT 'Event Ending date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_calender`
--

INSERT INTO `erp_calender` (`cal_id`, `cal_event`, `cal_timestamp`, `cal_postby`, `cal_sdate`, `cal_edate`) VALUES
(1, 'Sports Day', '2023-03-14 14:32:31', 'f001', '2023-03-14', '2023-03-14'),
(2, 'College Day', '2023-03-14 14:33:16', 'f001', '2023-03-14', '2023-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `erp_class`
--

CREATE TABLE `erp_class` (
  `cls_id` bigint(20) NOT NULL COMMENT 'Class id',
  `cls_startyr` year(4) NOT NULL COMMENT 'Starting year',
  `cls_endyr` year(4) NOT NULL COMMENT 'Ending year',
  `cls_deptcode` varchar(20) NOT NULL COMMENT 'Department code',
  `cls_dept` varchar(50) NOT NULL COMMENT 'Department name(Abbreviation)',
  `cls_deptname` varchar(50) NOT NULL COMMENT 'dept name(full form)',
  `cls_sem` int(10) NOT NULL COMMENT 'Semester',
  `cls_course` varchar(20) NOT NULL COMMENT 'Course name'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_class`
--

INSERT INTO `erp_class` (`cls_id`, `cls_startyr`, `cls_endyr`, `cls_deptcode`, `cls_dept`, `cls_deptname`, `cls_sem`, `cls_course`) VALUES
(1, 2020, 2024, '104', 'CSE', 'Computer Science And Engineering', 6, 'B.E'),
(2, 2020, 2024, '106', 'ECE', 'Electronics And Communication Engineering', 6, 'B.E'),
(3, 2021, 2023, '401', 'AE', 'Applied Electronics', 4, 'M.E'),
(4, 2021, 2023, '405', 'CSE', 'Computer Science And Engineering', 4, 'M.E'),
(5, 2021, 2023, '411', 'PSE', 'Power System Engineering', 4, 'M.E'),
(6, 2022, 2024, '631', 'MBA', 'Master Of Business Administration', 2, 'M.E'),
(7, 2020, 2024, '114', 'MECH', 'Mechanical Engineering', 6, 'B.E'),
(8, 2021, 2025, '103', 'CIVIL', 'Civil Engineering', 4, 'B.E'),
(9, 2021, 2025, '105', 'EEE', 'Electrical And Elecronics Engineering', 4, 'B.E'),
(10, 2021, 2025, '106', 'ECE', 'Electronics And Communication Engineering', 4, 'B.E');

-- --------------------------------------------------------

--
-- Table structure for table `erp_createexam`
--

CREATE TABLE `erp_createexam` (
  `ce_id` bigint(20) NOT NULL COMMENT 'Create Exam id',
  `cls_id` bigint(20) NOT NULL COMMENT 'Class id',
  `ce_exam` varchar(30) NOT NULL COMMENT 'Exam name(Slip test/Unit test/IAT/University)',
  `ce_no` int(10) NOT NULL COMMENT 'no of exam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_createexam`
--

INSERT INTO `erp_createexam` (`ce_id`, `cls_id`, `ce_exam`, `ce_no`) VALUES
(1, 1, 'Slip Test 1', 0),
(2, 2, 'Slip Test 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `erp_exam`
--

CREATE TABLE `erp_exam` (
  `exam_id` bigint(20) NOT NULL COMMENT 'Exam id',
  `ce_id` bigint(20) NOT NULL COMMENT 'Create exam id',
  `tt_subcode` varchar(50) NOT NULL COMMENT 'subject code of Exam',
  `exam_resulttype` varchar(20) NOT NULL COMMENT 'Exam-Result type(Mark/grade)',
  `exam_date` date NOT NULL COMMENT 'Exam date',
  `exam_passmark` int(200) NOT NULL COMMENT 'Exam Passmark',
  `exam_maxmark` int(20) NOT NULL COMMENT 'Exam Maximum mark'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_exam`
--

INSERT INTO `erp_exam` (`exam_id`, `ce_id`, `tt_subcode`, `exam_resulttype`, `exam_date`, `exam_passmark`, `exam_maxmark`) VALUES
(1, 1, 'CS8602', 'Mark', '2023-03-03', 10, 20),
(2, 1, 'CS8601', 'Mark', '2023-03-02', 10, 20),
(3, 2, 'CS8589', 'Marks', '2023-03-17', 50, 100);

-- --------------------------------------------------------

--
-- Table structure for table `erp_examact`
--

CREATE TABLE `erp_examact` (
  `exam_actid` bigint(20) NOT NULL COMMENT 'exam activity id',
  `exam_act` varchar(30) NOT NULL COMMENT 'exam activity',
  `exam_id` bigint(20) NOT NULL COMMENT 'Exam id',
  `ce_id` bigint(20) NOT NULL COMMENT 'Create exam id',
  `tt_subcode` varchar(50) NOT NULL COMMENT 'subject code of Exam',
  `exam_resulttype` varchar(20) NOT NULL COMMENT 'Exam-Result type(Mark/grade)',
  `exam_date` date NOT NULL COMMENT 'Exam date',
  `exam_passmark` int(200) NOT NULL COMMENT 'Exam Passmark',
  `exam_maxmark` int(20) NOT NULL COMMENT 'Exam Maximum mark'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `erp_faculty`
--

CREATE TABLE `erp_faculty` (
  `f_id` varchar(20) NOT NULL COMMENT 'Faculty id',
  `f_role` varchar(50) NOT NULL COMMENT 'Faculty Role',
  `f_fname` varchar(20) NOT NULL COMMENT 'Faculty first name',
  `f_lname` varchar(20) NOT NULL COMMENT 'Faculty last name',
  `f_img` varchar(500) NOT NULL COMMENT 'faculty image',
  `f_dept` varchar(20) NOT NULL COMMENT 'faculty department',
  `cls_id` bigint(20) NOT NULL COMMENT 'class id (incharge of class)',
  `f_dob` date NOT NULL COMMENT 'faculty date of birth',
  `f_gender` varchar(20) NOT NULL COMMENT 'faculty gender',
  `f_mstatus` varchar(20) NOT NULL COMMENT 'faculty marrital status',
  `f_mobile` varchar(20) NOT NULL COMMENT 'faculty mobile number',
  `f_designation` varchar(20) NOT NULL COMMENT 'faculty designation',
  `f_qualification` varchar(20) NOT NULL COMMENT 'faculty Qualification',
  `f_exp` varchar(20) NOT NULL COMMENT 'faculty Experience',
  `f_add` varchar(50) NOT NULL COMMENT 'faculty address',
  `f_city` varchar(20) NOT NULL COMMENT 'faculty city',
  `f_state` varchar(20) NOT NULL COMMENT 'faculty state',
  `f_zip` varchar(20) NOT NULL COMMENT 'faculty Zipcode',
  `f_padd` varchar(20) NOT NULL COMMENT 'faculty permanent address',
  `f_emgno` varchar(20) NOT NULL COMMENT 'faculty emergency number',
  `f_idmark` varchar(100) NOT NULL COMMENT 'faculty identification mark',
  `f_mlang` varchar(20) NOT NULL COMMENT 'faculty mother language',
  `f_klang` varchar(20) NOT NULL COMMENT 'faculty known language',
  `f_bloodgrp` varchar(20) NOT NULL COMMENT 'faculty blood group',
  `f_email` varchar(20) NOT NULL COMMENT 'faculty Email id',
  `f_hobbies` varchar(20) NOT NULL COMMENT 'faculty hobbies',
  `f_nationality` varchar(20) NOT NULL COMMENT 'faculty nationality',
  `f_religion` varchar(20) NOT NULL COMMENT 'faculty religion',
  `f_caste` varchar(20) NOT NULL COMMENT 'faculty caste',
  `f_community` varchar(20) NOT NULL COMMENT 'faculty community',
  `f_transport` varchar(10) NOT NULL COMMENT 'faculty transport(Yes/No)',
  `f_hostal` varchar(10) NOT NULL COMMENT 'faculty Hostel(Yes/No)',
  `f_disability` varchar(100) NOT NULL COMMENT 'faculty Disability',
  `f_pdoctor` varchar(100) NOT NULL COMMENT 'faculty personal Doctor name ',
  `f_pdoctorno` varchar(20) NOT NULL COMMENT 'faculty personal doctor number',
  `f_doj` date DEFAULT NULL COMMENT 'date of join',
  `f_admno` varchar(20) NOT NULL COMMENT 'admission number',
  `f_bioid` varchar(20) NOT NULL COMMENT 'bio id',
  `f_club` varchar(500) NOT NULL COMMENT 'club&socity',
  `f_aadhaarno` varchar(30) NOT NULL COMMENT 'aadhaar number',
  `f_voterid` varchar(30) NOT NULL COMMENT 'voter id',
  `f_projguide` int(10) NOT NULL COMMENT 'number of projects guiding',
  `f_pastemp` varchar(200) NOT NULL COMMENT 'past employers',
  `f_univspec` varchar(200) NOT NULL COMMENT 'university specialization',
  `f_pob` varchar(50) NOT NULL COMMENT 'place of birth',
  `f_ppno` varchar(20) NOT NULL COMMENT 'passport number',
  `f_panno` varchar(20) NOT NULL COMMENT 'pancard number',
  `f_indexp` int(10) NOT NULL COMMENT 'industry experience',
  `f_yoc` year(4) NOT NULL COMMENT 'year of completion',
  `f_teachexp` varchar(20) NOT NULL COMMENT 'teaching experience',
  `f_child` varchar(50) NOT NULL COMMENT 'staff child',
  `f_food` varchar(20) NOT NULL COMMENT 'food offering',
  `f_childinsame` varchar(20) NOT NULL COMMENT 'child in same college',
  `f_childinother` varchar(20) NOT NULL COMMENT 'child studying in other college',
  `f_allowlog` varchar(20) NOT NULL COMMENT 'allow login',
  `f_status` varchar(20) NOT NULL COMMENT 'status',
  `f_uname` varchar(20) NOT NULL COMMENT 'user name',
  `f_pwd` varchar(20) NOT NULL COMMENT 'password',
  `f_cpwd` varchar(20) NOT NULL COMMENT 'confirm password',
  `f_sques` varchar(50) NOT NULL COMMENT 'security quest',
  `f_ans` varchar(20) NOT NULL COMMENT 'answer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_faculty`
--

INSERT INTO `erp_faculty` (`f_id`, `f_role`, `f_fname`, `f_lname`, `f_img`, `f_dept`, `cls_id`, `f_dob`, `f_gender`, `f_mstatus`, `f_mobile`, `f_designation`, `f_qualification`, `f_exp`, `f_add`, `f_city`, `f_state`, `f_zip`, `f_padd`, `f_emgno`, `f_idmark`, `f_mlang`, `f_klang`, `f_bloodgrp`, `f_email`, `f_hobbies`, `f_nationality`, `f_religion`, `f_caste`, `f_community`, `f_transport`, `f_hostal`, `f_disability`, `f_pdoctor`, `f_pdoctorno`, `f_doj`, `f_admno`, `f_bioid`, `f_club`, `f_aadhaarno`, `f_voterid`, `f_projguide`, `f_pastemp`, `f_univspec`, `f_pob`, `f_ppno`, `f_panno`, `f_indexp`, `f_yoc`, `f_teachexp`, `f_child`, `f_food`, `f_childinsame`, `f_childinother`, `f_allowlog`, `f_status`, `f_uname`, `f_pwd`, `f_cpwd`, `f_sques`, `f_ans`) VALUES
('f001', 'Advisor', 'Muthu', 'Kumar', '', 'ECE', 0, '1990-02-12', 'Male', 'yes', '475', 'AP/ECE', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0055', 'Tty', '2323', '', 'tamil', 'English', 'O+', 'kuamr@gracecoe.org', 'teaching', 'india', 'Hindhu', 'BC', '--', 'yes', 'No', 'No', 'Well', '4364635', '2023-03-09', '4215643', '654654', 'science club', '77056394373', '341551', 5, '', 'PG', 'tuty', '4632516', '584684', 4, 2007, '5', 'babu', 'non veg', 'babu', 'babulingam', 'yes', 'active', 'getha', '78554', '78554', 'what your fevourite colour?', 'blue'),
('f002', 'Advisor', 'Dhana', 'babu', '', 'CSE', 0, '1993-02-12', 'Male', 'no', '475', 'AP/CSE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0045', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'babu@gracecoe.org', 'teaching', 'india', 'Hindhu', 'BC', '--', 'yes', 'No', 'NO', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f003', 'Advisor', 'Jerald', 'abi', '', 'CSE', 0, '1991-02-12', 'Male', 'no', '475', 'AP/CSE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0085', 'Tty', '2323', '', 'tamil', 'English', 'B+', 'jero@gracecoe.org', 'teaching', 'india', 'Hindhu', 'MBC', '--', 'yes', 'No', 'No', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f004', 'Advisor', 'Vijaya', 'lakshmi', '', 'ECE', 0, '1992-02-14', 'Female', 'yes', '475', 'AP/ECE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'vijaya@gracecoe.org', 'teaching', 'india', 'Hindhu', 'BC', '--', 'yes', 'No', 'No', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f005', 'Advisor', 'Dharma', 'lingam', '', 'EEE', 0, '1990-02-12', 'Male', 'yes', '475', 'AP/EEE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A+', 'Dharma@gracecoe.org', 'teaching', 'india', 'Hindhu', 'SC', '--', 'yes', 'No', 'no', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f006', 'Advisor', 'Raja', 'lakshmi', '', 'EEE', 0, '1990-03-12', 'Female', 'yes', '475', 'AP/EEE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A+', 'raja@gracecoe.org', 'teaching', 'india', 'Hindhu', 'SC', '--', 'yes', 'No', 'no', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f007', 'Advisor', 'John', 'Newton', '', 'CIVIL', 0, '1991-02-12', 'Male', 'yes', '475', 'AP/CIVIL ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A+', 'john@gracecoe.org', 'teaching', 'india', 'Hindhu', 'BC', '--', 'yes', 'No', 'No', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f008', 'Advisor', 'Thomas', 'john', '', 'CIVIL', 0, '1990-04-28', 'Male', 'yes', '475', 'AP/CIVIL ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'babu@gracecoe.org', 'teaching', 'india', 'Hindhu', 'MBC', '--', 'yes', 'No', 'Deaf', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f009', 'Advisor', 'Muthu', 'lakshmi', '', 'MECH', 0, '1992-04-12', 'female', 'yes', '475', 'AP/MECH ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'lakshmi@gracecoe.org', 'teaching', 'india', 'Hindhu', 'MBC', '--', 'yes', 'No', 'no', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f010', 'Advisor', 'Ram', 'kumar', '', 'MECH', 0, '1990-02-12', 'Male', 'yes', '475', 'AP/MECH ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'ram@gracecoe.org', 'teaching', 'india', 'Hindhu', 'MBC', '--', 'yes', 'No', 'no', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f011', 'Advisor', 'ram', 'lingam', '', 'MBA', 0, '1990-02-12', 'Male', 'yes', '475', 'AP/CSE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'babu@gracecoe.org', 'teaching', 'india', 'Hindhu', 'MBC', '--', 'yes', 'No', 'no', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f012', 'Advisor', 'ravi', 'devi', '', 'MBA', 0, '1990-02-12', 'female', 'yes', '475', 'AP/CSE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'babu@gracecoe.org', 'teaching', 'india', 'Hindhu', 'MBC', '--', 'yes', 'No', 'no', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f013', 'Advisor', 'Aron', 'S', '', 'ME-CSE', 0, '1990-02-12', 'Male', 'yes', '475', 'AP/CSE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'babu@gracecoe.org', 'teaching', 'india', 'Hindhu', 'MBC', '--', 'yes', 'No', 'no', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', ''),
('f014', 'Advisor', 'Gowtham', 'lingam', '', 'ME-CSE', 0, '1990-02-12', 'Male', 'yes', '475', 'AP/CSE ', 'M.E', '5', 'Tuty', 'Tuty', 'TN', '0005', 'Tty', '2323', '', 'tamil', 'English', 'A1+', 'babu@gracecoe.org', 'teaching', 'india', 'Hindhu', 'MBC', '--', 'yes', 'No', 'no', 'Well', '', NULL, '', '', '', '', '', 0, '', '', '', '', '', 0, 0000, '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `erp_fees`
--

CREATE TABLE `erp_fees` (
  `fe_id` bigint(20) NOT NULL COMMENT 'Fees id',
  `fe_est` varchar(30) NOT NULL COMMENT 'Estimation fees',
  `stu_quota` varchar(30) NOT NULL COMMENT 'student quota(management/general/pmms/first Graduate)',
  `fe_exam` varchar(30) NOT NULL COMMENT 'Exam fees',
  `fe_rra` varchar(30) NOT NULL COMMENT 'rra fees',
  `fe_sports` varchar(30) NOT NULL COMMENT 'sports fees',
  `fe_tuition` varchar(30) NOT NULL COMMENT 'tuition fees',
  `fe_mess` varchar(30) NOT NULL COMMENT 'mess fees',
  `fe_hostel` varchar(30) NOT NULL COMMENT 'hostel fees',
  `fe_bus` varchar(30) NOT NULL COMMENT 'bus fees',
  `fe_otr` varchar(20) NOT NULL COMMENT 'other fees',
  `cls_sem` int(10) NOT NULL COMMENT 'semester'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_fees`
--

INSERT INTO `erp_fees` (`fe_id`, `fe_est`, `stu_quota`, `fe_exam`, `fe_rra`, `fe_sports`, `fe_tuition`, `fe_mess`, `fe_hostel`, `fe_bus`, `fe_otr`, `cls_sem`) VALUES
(1, '500', 'management ', '7500', '1000', '500', '9000', '5000', '10000', '7000', '-', 1),
(2, '600', 'general ', '8500', '2000', '700', '9000', '5000', '10000', '7000', '-', 2);

-- --------------------------------------------------------

--
-- Table structure for table `erp_gallery`
--

CREATE TABLE `erp_gallery` (
  `g_id` bigint(20) NOT NULL COMMENT 'Gallery id',
  `g_title` varchar(30) NOT NULL COMMENT 'gallery title',
  `g_timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'gallery timestamp(Event date&time)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_gallery`
--

INSERT INTO `erp_gallery` (`g_id`, `g_title`, `g_timestamp`) VALUES
(1, 'sports day', '2023-03-06 04:43:48'),
(2, 'college day', '2023-03-06 04:44:40'),
(3, 'Test Event', '2023-04-05 01:04:09'),
(4, 'try1', '2023-04-04 18:03:00'),
(6, 'try1ab', '2023-03-23 18:29:00');

-- --------------------------------------------------------

--
-- Table structure for table `erp_hostel`
--

CREATE TABLE `erp_hostel` (
  `h_id` bigint(20) NOT NULL COMMENT 'Hostel id',
  `h_gender` varchar(10) NOT NULL COMMENT 'Gender Hostel ',
  `h_wdn` varchar(30) NOT NULL COMMENT 'Hostel warden name',
  `h_wdnno` varchar(20) NOT NULL COMMENT 'hostel wardan mobile no',
  `h_depty_wdn` varchar(30) NOT NULL COMMENT 'hostel depty warden name',
  `h_depty_wdnno` varchar(20) NOT NULL COMMENT 'hostel depty warden mobile no',
  `h_rt_wdn` varchar(20) NOT NULL COMMENT 'hostel residential tutor warden name',
  `h_rt_wdnno` varchar(20) NOT NULL COMMENT 'hostel residential tutor warden mobile no'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_hostel`
--

INSERT INTO `erp_hostel` (`h_id`, `h_gender`, `h_wdn`, `h_wdnno`, `h_depty_wdn`, `h_depty_wdnno`, `h_rt_wdn`, `h_rt_wdnno`) VALUES
(1, '1', 'babu', '123456789', 'babu2', '987654321', 'babu3', '098712345'),
(2, '2', 'prem', '123456789', 'prem2', '987654321', 'prem3', '098712345');

-- --------------------------------------------------------

--
-- Table structure for table `erp_img`
--

CREATE TABLE `erp_img` (
  `img_id` bigint(20) NOT NULL COMMENT 'Image id',
  `g_id` bigint(20) NOT NULL COMMENT 'gallery id',
  `img_img` varchar(100) NOT NULL COMMENT 'image',
  `img_desc` varchar(50) NOT NULL COMMENT 'image Description'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_img`
--

INSERT INTO `erp_img` (`img_id`, `g_id`, `img_img`, `img_desc`) VALUES
(1, 1, 'img/sportsday.jpg', 'principal addressing'),
(2, 1, 'img/sportsday2.jpg', 'chairman addressing'),
(3, 2, 'img/collegeday.jpg', 'principal addressing'),
(6, 2, 'img/collegeImg.jpg', 'test'),
(7, 3, 'img/collegeImg.jpg', 'test'),
(8, 2, 'img/collegeImg.jpg', 'test'),
(9, 2, 'img/collegeImg.jpg', 'test'),
(10, 2, 'img/collegeImg.jpg', 'test'),
(11, 6, 'img/collegeImg.jpg', 'test56'),
(12, 2, 'img/collegeImg.jpg', 'test'),
(13, 2, 'img/collegeImg.jpg', 'test'),
(14, 2, 'img/collegeImg.jpg', 'test'),
(24, 4, 'img/1680667089_collegedve.jpg', 'testing multiple files '),
(25, 4, 'img/1680667089_Collegea2e.jpg', 'testing multiple files '),
(26, 4, 'img/1680667089_Collegea1.jpg', 'testing multiple files1'),
(27, 6, 'img/1680667418_collegedve.jpg', 'test single file');

-- --------------------------------------------------------

--
-- Table structure for table `erp_leave`
--

CREATE TABLE `erp_leave` (
  `lv_id` bigint(20) NOT NULL COMMENT 'Leave id',
  `f_id` varchar(20) NOT NULL COMMENT 'faculty id(leave taken by)',
  `lv_type` varchar(20) NOT NULL COMMENT 'leave type (ML,CL,Permission)',
  `lv_reason` varchar(200) NOT NULL COMMENT 'leave reason',
  `lv_applyon` date NOT NULL COMMENT 'apply date',
  `lv_sdate` date NOT NULL COMMENT 'leave start date',
  `lv_edate` date NOT NULL COMMENT 'leave end date',
  `lv_stime` time NOT NULL COMMENT 'leave start time',
  `lv_etime` time NOT NULL COMMENT 'leave end time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `erp_login`
--

CREATE TABLE `erp_login` (
  `log_id` varchar(20) NOT NULL COMMENT 'Login id(Registerno/faculty id)',
  `log_pwd` varchar(20) NOT NULL COMMENT 'login password',
  `log_session` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'login session(timestamp)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_login`
--

INSERT INTO `erp_login` (`log_id`, `log_pwd`, `log_session`) VALUES
('950320104005', '1234', '2023-03-06 04:50:02'),
('f005', '5678', '2023-03-06 05:03:18');

-- --------------------------------------------------------

--
-- Table structure for table `erp_mark`
--

CREATE TABLE `erp_mark` (
  `mark_id` bigint(20) NOT NULL COMMENT 'mark id',
  `stu_id` bigint(20) NOT NULL COMMENT 'student id(register no)',
  `cls_id` bigint(20) NOT NULL COMMENT 'class id',
  `ce_id` bigint(20) NOT NULL COMMENT 'create exam id',
  `exam_id` bigint(20) NOT NULL COMMENT 'exm id (sub , pass mark , max mark)',
  `mark_mark` int(200) NOT NULL COMMENT 'mark',
  `mark_retest` int(20) NOT NULL COMMENT 'retest mark',
  `mark_date` date NOT NULL COMMENT 'mark entry date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_mark`
--

INSERT INTO `erp_mark` (`mark_id`, `stu_id`, `cls_id`, `ce_id`, `exam_id`, `mark_mark`, `mark_retest`, `mark_date`) VALUES
(1, 950320104005, 1, 1, 1, 10, 0, '2023-03-06'),
(2, 950320104005, 1, 1, 2, 10, 0, '2023-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `erp_news`
--

CREATE TABLE `erp_news` (
  `news_id` bigint(20) NOT NULL COMMENT 'news id',
  `news_title` varchar(20) NOT NULL COMMENT 'news title',
  `news_desc` varchar(200) NOT NULL COMMENT 'news description',
  `news_link` varchar(200) NOT NULL COMMENT 'news link',
  `news_type` varchar(200) NOT NULL COMMENT 'news type',
  `news_img` varchar(200) NOT NULL COMMENT 'news image'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_news`
--

INSERT INTO `erp_news` (`news_id`, `news_title`, `news_desc`, `news_link`, `news_type`, `news_img`) VALUES
(1, 'result published', 'UG and PG result published ', 'https://stucor.in/study-materials-annauniv/', 'news', 'img/stucor.jpeg'),
(2, 'sports day', 'sports day on 06-03-2023', 'null', 'events', 'img/sportsbroucher.jpeg'),
(3, 'leave announcement', 'leave on 06-03-2023', 'null', 'circular', 'img/circular.jpeg'),
(4, 'thought of the day', 'thought of the day - 01', 'https://www.youtube.com/watch?v=tujqRqHT1Qs&list=PLJx23jPZ2MP7NWSeGXb3mT3EkoeDtvuFN&index=4', 'thought', 'img/thumpnail01.jpeg'),
(5, 'Winner In Olympic', 'Olympic winner in 2023', 'https://www.youtube.com/watch?v=tujqRqHT1Qs&list=PLJx23jPZ2MP7NWSeGXb3mT3EkoeDtvuFN&index=4', 'performer', 'img/winner.jpeg'),
(6, 'Annual Day', 'Annual day Celebration', '-----', 'Flash news', 'annual.peg'),
(7, 'sports', '-----sports', 'yydtsyuf', 'gsudyf', 'chksgf');

-- --------------------------------------------------------

--
-- Stand-in structure for view `erp_n_circular`
-- (See below for the actual view)
--
CREATE TABLE `erp_n_circular` (
`news_id` bigint(20)
,`news_title` varchar(20)
,`news_desc` varchar(200)
,`news_link` varchar(200)
,`news_type` varchar(200)
,`news_img` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `erp_n_event`
-- (See below for the actual view)
--
CREATE TABLE `erp_n_event` (
`news_id` bigint(20)
,`news_title` varchar(20)
,`news_desc` varchar(200)
,`news_link` varchar(200)
,`news_type` varchar(200)
,`news_img` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `erp_n_news`
-- (See below for the actual view)
--
CREATE TABLE `erp_n_news` (
`news_id` bigint(20)
,`news_title` varchar(20)
,`news_desc` varchar(200)
,`news_link` varchar(200)
,`news_type` varchar(200)
,`news_img` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `erp_n_performer`
-- (See below for the actual view)
--
CREATE TABLE `erp_n_performer` (
`news_id` bigint(20)
,`news_title` varchar(20)
,`news_desc` varchar(200)
,`news_link` varchar(200)
,`news_type` varchar(200)
,`news_img` varchar(200)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `erp_n_thought`
-- (See below for the actual view)
--
CREATE TABLE `erp_n_thought` (
`news_id` bigint(20)
,`news_title` varchar(20)
,`news_desc` varchar(200)
,`news_link` varchar(200)
,`news_type` varchar(200)
,`news_img` varchar(200)
);

-- --------------------------------------------------------

--
-- Table structure for table `erp_role`
--

CREATE TABLE `erp_role` (
  `r_id` bigint(20) NOT NULL COMMENT 'role id',
  `r_rolename` varchar(30) NOT NULL COMMENT 'role name',
  `r_access` varchar(30) NOT NULL COMMENT 'role access'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_role`
--

INSERT INTO `erp_role` (`r_id`, `r_rolename`, `r_access`) VALUES
(1, 'HOD', 'Homepage'),
(2, 'Advisor', 'result,Attendence'),
(3, 'student', 'Marks view');

-- --------------------------------------------------------

--
-- Table structure for table `erp_student`
--

CREATE TABLE `erp_student` (
  `stu_id` varchar(24) NOT NULL COMMENT 'student id',
  `cls_id` bigint(20) NOT NULL COMMENT 'class id',
  `stu_dob` date NOT NULL COMMENT 'student date of birth',
  `stu_fname` varchar(20) NOT NULL COMMENT 'student first name',
  `stu_lname` varchar(20) NOT NULL COMMENT 'student last name ',
  `stu_img` varchar(500) NOT NULL COMMENT 'student image',
  `stu_gender` varchar(10) NOT NULL COMMENT 'student gender',
  `stu_height` varchar(20) NOT NULL COMMENT 'height (in cm)',
  `stu_weight` varchar(20) NOT NULL COMMENT 'weight (in kg)',
  `stu_mobile` varchar(20) NOT NULL COMMENT 'student mobile number',
  `stu_fmobile` varchar(20) NOT NULL COMMENT 'student father mobile number',
  `stu_mmobile` varchar(20) NOT NULL COMMENT 'student mother mobile number',
  `stu_gmobile` varchar(20) NOT NULL COMMENT 'student guardian mobile number',
  `stu_admno` varchar(20) NOT NULL COMMENT 'student admission number',
  `stu_aadhar` varchar(20) NOT NULL COMMENT 'student aadhar number',
  `stu_padd` varchar(50) NOT NULL COMMENT 'student personal address',
  `stu_city` varchar(20) NOT NULL COMMENT 'student city',
  `stu_state` varchar(20) NOT NULL COMMENT 'student state',
  `stu_zip` varchar(20) NOT NULL COMMENT 'student zip code',
  `stu_idmark` varchar(100) NOT NULL COMMENT 'student identification mark',
  `stu_mlang` varchar(20) NOT NULL COMMENT 'student mother language',
  `stu_klang` varchar(20) NOT NULL COMMENT 'student known language',
  `stu_bloodgrp` varchar(20) NOT NULL COMMENT 'student blood group',
  `stu_email` varchar(30) NOT NULL COMMENT 'student email',
  `stu_hobbies` varchar(100) NOT NULL COMMENT 'student hobbies',
  `stu_nationality` varchar(30) NOT NULL COMMENT 'student nationality',
  `stu_religion` varchar(20) NOT NULL COMMENT 'student religion',
  `stu_caste` varchar(20) NOT NULL COMMENT 'student caste',
  `stu_community` varchar(20) NOT NULL COMMENT 'student community',
  `stu_quota` varchar(20) NOT NULL COMMENT 'student quota',
  `stu_father` varchar(50) NOT NULL COMMENT 'student father name',
  `stu_mother` varchar(50) NOT NULL COMMENT 'student mother name',
  `stu_guardian` varchar(30) NOT NULL COMMENT 'student guardian name',
  `stu_motherimg` varchar(500) NOT NULL COMMENT 'student mother image',
  `stu_fatherimg` varchar(500) NOT NULL COMMENT 'student father image',
  `stu_guardianimg` varchar(500) NOT NULL COMMENT 'student guardian image',
  `stu_foccupation` varchar(30) NOT NULL COMMENT 'student father occupation',
  `stu_moccupation` varchar(30) NOT NULL COMMENT 'student mother occupation',
  `stu_fqualification` varchar(30) NOT NULL COMMENT 'student father qualification',
  `stu_doj` date NOT NULL COMMENT 'student date of join',
  `stu_transport` varchar(30) NOT NULL COMMENT 'student transport(yes/no)',
  `stu_hostel` varchar(10) NOT NULL COMMENT 'student hostel(yes/no)',
  `h_id` int(20) NOT NULL COMMENT 'hostel id',
  `stu_roomno` varchar(20) NOT NULL COMMENT 'hostel room number',
  `stu_disability` varchar(20) NOT NULL COMMENT 'student disability',
  `stu_pdoctor` varchar(50) NOT NULL COMMENT 'student personal doctor name',
  `stu_pdoctorno` varchar(20) NOT NULL COMMENT 'personal doctor no',
  `stu_bp` varchar(20) NOT NULL COMMENT 'blood pressure',
  `stu_visionL` varchar(20) NOT NULL COMMENT 'vision Left',
  `stu_visionR` varchar(20) NOT NULL COMMENT 'vision right',
  `stu_pulse` varchar(20) NOT NULL COMMENT 'pulse',
  `stu_squint` varchar(20) NOT NULL COMMENT 'squint detail',
  `stu_pallor` varchar(20) NOT NULL COMMENT 'pallor ',
  `stu_eyecon` varchar(20) NOT NULL COMMENT 'detail of eye contion',
  `stu_dentalcon` varchar(50) NOT NULL COMMENT 'detail of dental condition',
  `stu_healthcon` varchar(50) NOT NULL COMMENT 'details of health condition',
  `stu_comments` varchar(100) NOT NULL COMMENT 'comments',
  `stu_ppno` varchar(30) NOT NULL COMMENT 'passport no',
  `stu_ppissueat` varchar(50) NOT NULL COMMENT 'passport issue at',
  `stu_ppexpdate` date DEFAULT NULL COMMENT 'passport expiry date',
  `stu_visa` varchar(500) NOT NULL COMMENT 'passport visa details',
  `stu_issuedate` varchar(30) NOT NULL COMMENT 'passport issue date',
  `stu_visano` varchar(30) NOT NULL COMMENT 'passport visa number',
  `stu_visaexpdate` date DEFAULT NULL COMMENT 'visa expiry date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_student`
--

INSERT INTO `erp_student` (`stu_id`, `cls_id`, `stu_dob`, `stu_fname`, `stu_lname`, `stu_img`, `stu_gender`, `stu_height`, `stu_weight`, `stu_mobile`, `stu_fmobile`, `stu_mmobile`, `stu_gmobile`, `stu_admno`, `stu_aadhar`, `stu_padd`, `stu_city`, `stu_state`, `stu_zip`, `stu_idmark`, `stu_mlang`, `stu_klang`, `stu_bloodgrp`, `stu_email`, `stu_hobbies`, `stu_nationality`, `stu_religion`, `stu_caste`, `stu_community`, `stu_quota`, `stu_father`, `stu_mother`, `stu_guardian`, `stu_motherimg`, `stu_fatherimg`, `stu_guardianimg`, `stu_foccupation`, `stu_moccupation`, `stu_fqualification`, `stu_doj`, `stu_transport`, `stu_hostel`, `h_id`, `stu_roomno`, `stu_disability`, `stu_pdoctor`, `stu_pdoctorno`, `stu_bp`, `stu_visionL`, `stu_visionR`, `stu_pulse`, `stu_squint`, `stu_pallor`, `stu_eyecon`, `stu_dentalcon`, `stu_healthcon`, `stu_comments`, `stu_ppno`, `stu_ppissueat`, `stu_ppexpdate`, `stu_visa`, `stu_issuedate`, `stu_visano`, `stu_visaexpdate`) VALUES
('2021AE01', 3, '2003-09-07', 'kumara', 'Vel', 'img/Vel.jpg', 'Male', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'Ramanathapuram', 'tamilnadu', '628753', 'scare in hand', 'tamil', 'english', 'A', 'kumar@gmail.com', 'speech', 'india', 'hindu', '-', 'MBC', 'Management', 'Raja', 'Rani', 'Raja guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('2021AE02', 3, '2003-09-07', 'Rani', 'Devi', 'img/rani.jpg', 'Female', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'thirunelveli', 'tamilnadu', '628603', 'scare in hand', 'tamil', 'english', 'A', 'rani@gmail.com', 'speech,Dance', 'india', 'hindu', '-', 'sC', 'Management', 'Raja', 'Durga', 'lakshmi guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('2021CS01', 4, '2003-04-04', 'Mari', 'Muthu', 'img/muthu.jpg', 'Male', '', '', '121212345', '2222245645', '44444444565', '66666666464', '12543465098', '545345345787', '1h/882 housing board', 'kerala', 'kerala', '628009', 'scare in hand', 'tamil', 'english', 'o+', 'Vignesh@gmail.com', 'Reading,dance', 'india', 'hindu', '-', 'MBC', 'Management', 'Durai', 'Lakshmi', 'Vignesh guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-12', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('2021CS02', 4, '2003-05-07', 'Sangeetha', 'S', 'img/sangeetha.jpg', 'Female', '', '', '121454344', '2222224567', '44444442345', '66666634346', '12546783456', '454554548787', '1h/882 housing board', 'Madurai', 'tamilnadu', '628043', 'scare in hand', 'tamil', 'english', 'O', 'sangeetha@gmail.com', 'speech', 'india', 'hindu', '-', 'SC', 'Management', 'Raju', 'Bama', 'Bharathi guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('2021PS01', 5, '2003-10-07', 'Muthu', 'Raj', 'img/vivek.jpg', 'Male', '', '', '121215678', '2222562222', '44444445644', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'tuty', 'tamilnadu', '628008', 'scare in hand', 'tamil', 'english', 'A', 'muthu@gmail.com', 'speech,Drawing', 'india', 'hindu', '-', 'MBC', 'Management', 'Raj', 'Kumari', 'Vivek guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('2021PS02', 5, '2003-02-07', 'Gandhi', 'Raj', 'img/gandhi.jpg', 'Male', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/885 housing board', 'thirunelveli', 'tamilnadu', '628033', 'scare in hand', 'tamil', 'english', 'A', 'gandhi@gmail.com', 'speech', 'india', 'hindu', '-', 'BC', 'Management', 'bala', 'Lakshmi', 'soundar guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('2022MBA01', 6, '2002-03-01', 'Ram', 'babu', 'img/babu.jpg', 'Male', '', '', '121212121', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'tuty', 'tamilnadu', '628008', 'scare in hand', 'tamil', 'english', 'b+', 'babu@gmail.com', 'singing', 'india', 'hindu', '-', 'BC', 'Management', 'Jayaram', 'Vijaya', 'babu guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('2022MBA02', 6, '2003-09-07', 'Radhika', 'S', 'img/radiga.jpg', 'Male', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'thirunelveli', 'tamilnadu', '628003', 'scare in hand', 'tamil', 'english', 'A', 'jero@gmail.com', 'speech', 'india', 'hindu', '-', 'BC', 'Management', 'Raju', 'Devi', 'jero guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950320104005', 1, '2002-03-01', 'Dhana', 'babu', 'img/babu.jpg', 'Male', '', '', '121212121', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'tuty', 'tamilnadu', '628008', 'scare in hand', 'tamil', 'english', 'b+', 'babu@gmail.com', 'singing', 'india', 'hindu', '-', 'BC', 'Management', 'Jayaram', 'Vijaya', 'babu guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950320104006', 1, '2002-09-07', 'Jerald', 'Abishek', 'img/jero.jpg', 'Male', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'thirunelveli', 'tamilnadu', '628003', 'scare in hand', 'tamil', 'english', 'A', 'jero@gmail.com', 'speech', 'india', 'hindu', '-', 'BC', 'Management', 'Raju', 'Devi', 'jero guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950320114002', 7, '2002-09-07', 'Muthu', 'lingam', 'img/muthu.jpg', 'Male', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'thiruchendur', 'tamilnadu', '628083', 'scare in hand', 'tamil', 'english', 'A', 'jero@gmail.com', 'speech,Drawing', 'india', 'hindu', '-', 'MBC', 'Management', 'Raju', 'Rani', 'muthu guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950320114003', 7, '2002-08-07', 'Rama', 'Devi', 'img/rama.jpg', 'Female', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'tuty', 'tamilnadu', '628083', 'scare in hand', 'tamil', 'english', 'A', 'Rama@gmail.com', 'speech,Dance', 'india', 'hindu', '-', 'BC', 'Management', 'Ravi', 'ranu', 'Rama guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950321103004', 8, '2003-05-07', 'Bharathi', 'S', 'img/Bharathi.jpg', 'Female', '', '', '121454344', '2222224567', '44444442345', '66666634346', '12546783456', '454554548787', '1h/882 housing board', 'Madurai', 'tamilnadu', '628043', 'scare in hand', 'tamil', 'english', 'O', 'Bharathi@gmail.com', 'speech', 'india', 'hindu', '-', 'SC', 'Management', 'Raju', 'Bama', 'Bharathi guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950321103301', 8, '2003-04-04', 'Vignesh', 'Muthu', 'img/muthu.jpg', 'Male', '', '', '121212345', '2222245645', '44444444565', '66666666464', '12543465098', '545345345787', '1h/882 housing board', 'kerala', 'kerala', '628009', 'scare in hand', 'tamil', 'english', 'o+', 'Vignesh@gmail.com', 'Reading,dance', 'india', 'hindu', '-', 'MBC', 'Management', 'Durai', 'Lakshmi', 'Vignesh guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-12', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950321105003', 9, '2003-09-07', 'Raja', 'Vel', 'img/Vel.jpg', 'Male', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'Ramanathapuram', 'tamilnadu', '628753', 'scare in hand', 'tamil', 'english', 'A', 'raja@gmail.com', 'speech', 'india', 'hindu', '-', 'MBC', 'Management', 'Raja', 'Rani', 'Raja guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950321105006', 9, '2003-09-07', 'Lakshmi', 'Devi', 'img/laksmi.jpg', 'Female', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'thirunelveli', 'tamilnadu', '628603', 'scare in hand', 'tamil', 'english', 'A', 'lakshmi@gmail.com', 'speech,Dance', 'india', 'hindu', '-', 'sC', 'Management', 'Raja', 'Durga', 'lakshmi guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950321106003', 10, '2003-10-07', 'Vivek', 'Raj', 'img/vivek.jpg', 'Male', '', '', '121215678', '2222562222', '44444445644', '66666666666', '12546788098', '545454548787', '1h/882 housing board', 'tuty', 'tamilnadu', '628008', 'scare in hand', 'tamil', 'english', 'A', 'Vivek@gmail.com', 'speech,Drawing', 'india', 'hindu', '-', 'MBC', 'Management', 'Raj', 'Kumari', 'Vivek guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL),
('950321106007', 10, '2003-02-07', 'Soundar', 'Raj', 'img/soundar.jpg', 'Male', '', '', '121212221', '2222222222', '44444444444', '66666666666', '12546788098', '545454548787', '1h/885 housing board', 'thirunelveli', 'tamilnadu', '628033', 'scare in hand', 'tamil', 'english', 'A', 'soundar@gmail.com', 'speech', 'india', 'hindu', '-', 'BC', 'Management', 'bala', 'Lakshmi', 'soundar guardian', 'img/bmom.jpg', 'img/fdad.jpg', 'img/bgaurd.jpg', 'coolie', 'coolie', '10th', '2020-11-11', 'No', 'No', 0, '', 'nil', 'nil', '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, '', '', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `erp_subject`
--

CREATE TABLE `erp_subject` (
  `tt_subcode` varchar(10) NOT NULL COMMENT 'Timetable subjectcode',
  `cls_id` bigint(20) NOT NULL COMMENT 'class id',
  `sub_name` varchar(50) NOT NULL COMMENT 'subject name',
  `sub_credit` int(20) NOT NULL COMMENT 'subject credits'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_subject`
--

INSERT INTO `erp_subject` (`tt_subcode`, `cls_id`, `sub_name`, `sub_credit`) VALUES
('CS8601', 1, 'Mobile Computing', 3),
('CS8602', 1, 'Compiler Design', 4),
('CS8661', 1, 'Internet Programming', 3);

-- --------------------------------------------------------

--
-- Table structure for table `erp_timetable`
--

CREATE TABLE `erp_timetable` (
  `tt_id` int(200) NOT NULL COMMENT 'timetable_id (autu_increment)',
  `cls_id` bigint(20) NOT NULL COMMENT 'class_id',
  `tt_day` varchar(30) NOT NULL COMMENT 'timetable_day',
  `tt_period` varchar(20) NOT NULL COMMENT 'timetable_periodno',
  `tt_subcode` varchar(30) NOT NULL COMMENT 'timetable_subjectcode',
  `f_id` varchar(100) NOT NULL COMMENT 'faculty_id(subject incharge)',
  `type_id` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_timetable`
--

INSERT INTO `erp_timetable` (`tt_id`, `cls_id`, `tt_day`, `tt_period`, `tt_subcode`, `f_id`, `type_id`) VALUES
(3, 1, 'FRI', '1', 'CS8602', 'f001', 1),
(4, 1, 'MON', '1', 'CS8601', 'f005', 1);

-- --------------------------------------------------------

--
-- Table structure for table `erp_tt_type`
--

CREATE TABLE `erp_tt_type` (
  `type_id` bigint(20) NOT NULL,
  `type_title` varchar(30) NOT NULL,
  `type_hours` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `erp_tt_type`
--

INSERT INTO `erp_tt_type` (`type_id`, `type_title`, `type_hours`) VALUES
(1, 'General', 8),
(2, 'MBA', 4);

-- --------------------------------------------------------

--
-- Structure for view `erp_n_circular`
--
DROP TABLE IF EXISTS `erp_n_circular`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `erp_n_circular`  AS SELECT `erp_news`.`news_id` AS `news_id`, `erp_news`.`news_title` AS `news_title`, `erp_news`.`news_desc` AS `news_desc`, `erp_news`.`news_link` AS `news_link`, `erp_news`.`news_type` AS `news_type`, `erp_news`.`news_img` AS `news_img` FROM `erp_news` WHERE `erp_news`.`news_type` = 'circular\'circular''circular\'circular'  ;

-- --------------------------------------------------------

--
-- Structure for view `erp_n_event`
--
DROP TABLE IF EXISTS `erp_n_event`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `erp_n_event`  AS SELECT `erp_news`.`news_id` AS `news_id`, `erp_news`.`news_title` AS `news_title`, `erp_news`.`news_desc` AS `news_desc`, `erp_news`.`news_link` AS `news_link`, `erp_news`.`news_type` AS `news_type`, `erp_news`.`news_img` AS `news_img` FROM `erp_news` WHERE `erp_news`.`news_type` = 'events\'events''events\'events'  ;

-- --------------------------------------------------------

--
-- Structure for view `erp_n_news`
--
DROP TABLE IF EXISTS `erp_n_news`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `erp_n_news`  AS SELECT `erp_news`.`news_id` AS `news_id`, `erp_news`.`news_title` AS `news_title`, `erp_news`.`news_desc` AS `news_desc`, `erp_news`.`news_link` AS `news_link`, `erp_news`.`news_type` AS `news_type`, `erp_news`.`news_img` AS `news_img` FROM `erp_news` WHERE `erp_news`.`news_type` = 'news\'news''news\'news'  ;

-- --------------------------------------------------------

--
-- Structure for view `erp_n_performer`
--
DROP TABLE IF EXISTS `erp_n_performer`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `erp_n_performer`  AS SELECT `erp_news`.`news_id` AS `news_id`, `erp_news`.`news_title` AS `news_title`, `erp_news`.`news_desc` AS `news_desc`, `erp_news`.`news_link` AS `news_link`, `erp_news`.`news_type` AS `news_type`, `erp_news`.`news_img` AS `news_img` FROM `erp_news` WHERE `erp_news`.`news_type` = 'performer\'performer''performer\'performer'  ;

-- --------------------------------------------------------

--
-- Structure for view `erp_n_thought`
--
DROP TABLE IF EXISTS `erp_n_thought`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `erp_n_thought`  AS SELECT `erp_news`.`news_id` AS `news_id`, `erp_news`.`news_title` AS `news_title`, `erp_news`.`news_desc` AS `news_desc`, `erp_news`.`news_link` AS `news_link`, `erp_news`.`news_type` AS `news_type`, `erp_news`.`news_img` AS `news_img` FROM `erp_news` WHERE `erp_news`.`news_type` = 'thought\'thought''thought\'thought'  ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `erp_attendance`
--
ALTER TABLE `erp_attendance`
  ADD PRIMARY KEY (`att_id`);

--
-- Indexes for table `erp_calender`
--
ALTER TABLE `erp_calender`
  ADD PRIMARY KEY (`cal_id`);

--
-- Indexes for table `erp_class`
--
ALTER TABLE `erp_class`
  ADD PRIMARY KEY (`cls_id`);

--
-- Indexes for table `erp_createexam`
--
ALTER TABLE `erp_createexam`
  ADD PRIMARY KEY (`ce_id`);

--
-- Indexes for table `erp_exam`
--
ALTER TABLE `erp_exam`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `erp_faculty`
--
ALTER TABLE `erp_faculty`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `erp_fees`
--
ALTER TABLE `erp_fees`
  ADD PRIMARY KEY (`fe_id`);

--
-- Indexes for table `erp_gallery`
--
ALTER TABLE `erp_gallery`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `erp_hostel`
--
ALTER TABLE `erp_hostel`
  ADD PRIMARY KEY (`h_id`);

--
-- Indexes for table `erp_img`
--
ALTER TABLE `erp_img`
  ADD PRIMARY KEY (`img_id`);

--
-- Indexes for table `erp_leave`
--
ALTER TABLE `erp_leave`
  ADD PRIMARY KEY (`lv_id`);

--
-- Indexes for table `erp_login`
--
ALTER TABLE `erp_login`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `erp_mark`
--
ALTER TABLE `erp_mark`
  ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `erp_news`
--
ALTER TABLE `erp_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `erp_role`
--
ALTER TABLE `erp_role`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `erp_student`
--
ALTER TABLE `erp_student`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `erp_subject`
--
ALTER TABLE `erp_subject`
  ADD PRIMARY KEY (`tt_subcode`);

--
-- Indexes for table `erp_timetable`
--
ALTER TABLE `erp_timetable`
  ADD PRIMARY KEY (`tt_id`);

--
-- Indexes for table `erp_tt_type`
--
ALTER TABLE `erp_tt_type`
  ADD PRIMARY KEY (`type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `erp_attendance`
--
ALTER TABLE `erp_attendance`
  MODIFY `att_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'attendance id', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `erp_calender`
--
ALTER TABLE `erp_calender`
  MODIFY `cal_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Calender id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `erp_class`
--
ALTER TABLE `erp_class`
  MODIFY `cls_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Class id', AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `erp_createexam`
--
ALTER TABLE `erp_createexam`
  MODIFY `ce_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Create Exam id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `erp_exam`
--
ALTER TABLE `erp_exam`
  MODIFY `exam_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Exam id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `erp_fees`
--
ALTER TABLE `erp_fees`
  MODIFY `fe_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Fees id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `erp_gallery`
--
ALTER TABLE `erp_gallery`
  MODIFY `g_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Gallery id', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `erp_hostel`
--
ALTER TABLE `erp_hostel`
  MODIFY `h_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Hostel id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `erp_img`
--
ALTER TABLE `erp_img`
  MODIFY `img_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Image id', AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `erp_leave`
--
ALTER TABLE `erp_leave`
  MODIFY `lv_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'Leave id';

--
-- AUTO_INCREMENT for table `erp_mark`
--
ALTER TABLE `erp_mark`
  MODIFY `mark_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'mark id', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `erp_news`
--
ALTER TABLE `erp_news`
  MODIFY `news_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'news id', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `erp_role`
--
ALTER TABLE `erp_role`
  MODIFY `r_id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'role id', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `erp_timetable`
--
ALTER TABLE `erp_timetable`
  MODIFY `tt_id` int(200) NOT NULL AUTO_INCREMENT COMMENT 'timetable_id (autu_increment)', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `erp_tt_type`
--
ALTER TABLE `erp_tt_type`
  MODIFY `type_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
