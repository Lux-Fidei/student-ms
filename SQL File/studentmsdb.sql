-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2024 at 04:38 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `studentmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `section` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `section`, `class_id`) VALUES
(2, 1, 16),
(3, 1, 17);

-- --------------------------------------------------------

--
-- Table structure for table `login_history`
--

CREATE TABLE `login_history` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT NULL,
  `logout_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_history`
--

INSERT INTO `login_history` (`id`, `user_id`, `login_time`, `logout_time`) VALUES
(59, 28, '2024-05-18 14:18:07', '2024-05-18 14:19:53'),
(60, 14, '2024-05-18 14:40:09', '2024-05-18 14:40:14'),
(61, 14, '2024-05-18 14:41:36', '2024-05-18 14:41:55'),
(62, 14, '2024-05-18 14:50:18', '2024-05-18 14:50:20'),
(63, 14, '2024-05-18 14:51:24', '2024-05-18 14:51:27'),
(64, 14, '2024-05-18 14:51:50', '2024-05-18 14:51:53'),
(65, 11, '2024-05-18 18:34:29', NULL),
(66, 11, '2024-05-18 20:54:19', '2024-05-18 22:04:22'),
(67, 28, '2024-05-21 21:04:41', '2024-05-21 21:05:21'),
(68, 28, '2024-05-21 21:05:45', '2024-05-21 22:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `request_docs`
--

CREATE TABLE `request_docs` (
  `ID` int(11) NOT NULL,
  `st_id` int(11) DEFAULT NULL,
  `re_id` int(11) DEFAULT NULL,
  `docName` varchar(255) DEFAULT NULL,
  `isApproved` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `request_docs`
--

INSERT INTO `request_docs` (`ID`, `st_id`, `re_id`, `docName`, `isApproved`) VALUES
(0, 26, NULL, 'Gradeslip', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `faculty_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `strand_id` int(11) DEFAULT NULL,
  `building` varchar(255) DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `timeslot` varchar(128) NOT NULL,
  `days` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `faculty_id`, `subject_id`, `strand_id`, `building`, `room`, `timeslot`, `days`) VALUES
(16, 30, 19, 1, 'Annex', 'Room 12', '07:00AM - 10:00AM', 'MW'),
(17, 31, 14, 1, 'Annex', 'Room 12', '07:00AM - 10:00AM', 'MW'),
(18, 33, 44, 1, 'Annex', 'Room 12', '01:00PM - 03:00PM', 'F');

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `FirstName` varchar(255) DEFAULT NULL,
  `MiddleName` varchar(255) DEFAULT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `Age` int(32) DEFAULT NULL,
  `Gender` varchar(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `UserAccountID` int(11) NOT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp(),
  `AdminImage` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `FirstName`, `MiddleName`, `LastName`, `Age`, `Gender`, `Address`, `UserAccountID`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`, `AdminImage`) VALUES
(1, 'Junaina', 'M.', 'Dimalna', 32, 'Female', 'Marawi City, Lanao Del Sur', 1, 'admin', 9318778510, 'junainah@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-10-11 04:36:52', 'Director.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `ClassID` int(11) NOT NULL,
  `ClassName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `ID` int(11) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `MiddleInitial` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Age` int(11) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Address` text NOT NULL,
  `Contact` varchar(20) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `JoiningDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `position` varchar(128) NOT NULL,
  `assignedStrand` varchar(32) DEFAULT NULL,
  `advisoryClasses` varchar(128) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`ID`, `UserAccountID`, `FirstName`, `MiddleInitial`, `LastName`, `Email`, `Age`, `Gender`, `Address`, `Contact`, `UserName`, `Password`, `Image`, `JoiningDate`, `position`, `assignedStrand`, `advisoryClasses`) VALUES
(25, 7, 'Test', '', 'Test', 'Test@test.com', 12, 'Male', 'MSU', '212', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715609219.png', '2024-05-13 14:06:59', 'Chairperson (Adviser & Subject)', 'STEM', 'DOTA2'),
(26, 8, 'Luffy', '', 'L', 'test@test.com', 12, 'Male', 'MSU', '123', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715609393.png', '2024-05-13 14:09:53', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA2'),
(27, 9, 'Nami', '', 'N', 'test@test.com', 12, 'Female', 'MSU', '234234', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715609908.png', '2024-05-13 14:18:28', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA2'),
(28, 10, 'Zoro', '', 'Ronoa', 'tet@zor.com', 12, 'Male', 'MM', '12121', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715610809.png', '2024-05-13 14:33:29', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA2'),
(29, 11, 'Haniah', '', 'Krys', 'krys@gmail.com', 26, 'Female', 'MSU', '12345678', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715615993.png', '2024-05-13 15:59:53', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA2'),
(30, 14, 'Ammar', 'M.', 'Ampuan', 'ammar@gmail.com', 19, 'Male', 'Tuca, Marawi City, Lanao Del Sur', '0931212134451', '', '', '43bfc6b38f0311f4f73e8d67166836fd1715787053.jpg', '2024-05-15 15:30:53', 'Chairperson (Subject)', 'TVL-ICT', ''),
(31, 15, 'Alibasher', '', 'Esmail', 'alibasher@gmail.com', 29, 'Male', '1ST STREET MSU MARAWI CITY, LANAO DEL SUR', '0921212312121', '', '', '43bfc6b38f0311f4f73e8d67166836fd1715923841.jpg', '2024-05-17 05:30:41', 'Chairperson (Subject)', 'Sports', ''),
(32, 20, 'Omaimah', '', 'Bagobago', 'omaimah@gmail.com', 32, 'Female', '1ST STREET, Brgy.Barrio Salam MSU, Marawi City, Lanao Del Sur', '0921212312121', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715962027.png', '2024-05-17 16:07:07', 'Chairperson (Subject)', 'STEAM', ''),
(33, 28, 'Jalipha', 'M.', 'Ampog', 'jalipha@gmail.com', 27, 'Female', '1st Street Bo. Salam, MSU Main Campus, Marawi City, LDS', '09260394453', '', '', '19cceb13e1c35cf0eec65270468a65661716013064.jpg', '2024-05-18 06:17:44', 'Chairperson (Subject)', 'TVL-ICT', ''),
(35, 29, 'Nuroldin', 'U', 'Pimping', 'pimping.nu72@s.msumain.edu.ph', 26, 'Male', 'Purok 03 House No.# 0225 Marawi Poblacion, Marawi City, Lanao del Sur, 9700', '09173569779', 'pixelphon', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'pixelphon.jpeg', '2024-05-18 16:15:03', 'Chairperson', 'TVL-ICT', 'qwerty');

-- --------------------------------------------------------

--
-- Table structure for table `tblgrades`
--

CREATE TABLE `tblgrades` (
  `ID` int(11) NOT NULL,
  `StuID` int(11) DEFAULT NULL,
  `Subject` int(11) DEFAULT NULL,
  `FirstGrading` int(11) DEFAULT NULL,
  `SecondGrading` int(11) DEFAULT NULL,
  `Semester` varchar(20) DEFAULT NULL,
  `Faculty` int(11) DEFAULT NULL,
  `Units` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblgrades`
--

INSERT INTO `tblgrades` (`ID`, `StuID`, `Subject`, `FirstGrading`, `SecondGrading`, `Semester`, `Faculty`, `Units`) VALUES
(35, 25, 19, 2, 2, '1st Semester', 30, 4),
(36, 26, 19, 3, 3, '1st Semester', 30, 4),
(37, 27, 19, 1, 1, '1st Semester', 30, 4),
(38, 28, 19, 4, 4, '1st Semester', 30, 4),
(39, 25, 19, 2, 2, '1st Semester', 30, 4),
(40, 26, 19, 3, 3, '1st Semester', 30, 4),
(41, 27, 19, 1, 1, '1st Semester', 30, 4),
(42, 28, 19, 4, 4, '1st Semester', 30, 4),
(43, 25, 19, 0, 0, '1st Semester', 30, 4),
(44, 26, 19, 0, 0, '1st Semester', 30, 4),
(45, 27, 19, 87, 89, '1st Semester', 30, 4),
(46, 28, 19, 0, 0, '1st Semester', 30, 4),
(47, 25, 19, 87, 89, '1st Semester', 30, 4),
(48, 26, 19, 89, 92, '1st Semester', 30, 4),
(49, 27, 19, 87, 82, '1st Semester', 30, 4),
(50, 28, 19, 87, 82, '1st Semester', 30, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotice`
--

CREATE TABLE `tblnotice` (
  `ID` int(5) NOT NULL,
  `NoticeTitle` mediumtext DEFAULT NULL,
  `NoticeTo` enum('student','record_examiners','faculty') NOT NULL DEFAULT 'student',
  `NoticeMsg` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About Us', '<p class=\"MsoNormal\" align=\"justify\" style=\"text-indent:21.0000pt;mso-char-indent-count:0.0000;text-align:justify;\r\ntext-justify:inter-ideograph;\"><font color=\"#ffffff\"><font size=\"5\" style=\"\" face=\"times new roman\">The</font><font size=\"5\" style=\"\"> <b style=\"\"><font face=\"arial\">MSU Marawi Senior High School</font></b><font face=\"georgia\"> </font></font><font size=\"5\" style=\"\" face=\"times new roman\">was established by virtue of resolution No. 6, S of 2015, as concurred upon in the meeting of the MSU Board of Regents held at the CHED Conference Room, HEDC Bldg., CP Garcia Avenue, UP Diliman Campus, Quezon City on March 18, 2015.</font></font></p><p class=\"MsoNormal\" align=\"justify\" style=\"text-indent:21.0000pt;mso-char-indent-count:0.0000;text-align:justify;\r\ntext-justify:inter-ideograph;\"><font size=\"5\" style=\"\" face=\"times new roman\" color=\"#ffffff\">At present, the school offers three Senior High School Academic Tracks, namely, ABM (Accountancy Business and Management), HUMSS (Humanities and Social Sciences), and STEM (Science, Technology, Engineering and Mathematics), as well as the Sports Track, and selected strands under TVL Track, namely, HE (Home Economics), ICT (Information Communication and Technology), and AFA (Agri-Fishery Arts).</font><span style=\"mso-spacerun:\'yes\';font-family:Calibri;mso-fareast-font-family:SimSun;\r\nmso-bidi-font-family:\'Times New Roman\';font-size:12.0000pt;\"><o:p></o:p></span></p>', NULL, NULL, NULL),
(2, 'contactus', '.', 'First Street, MSU Campus 9700 Marawi City, Philippines', ' seniorhs@msumain.edu.ph', 9467563566, NULL),
(3, 'mission-vision', '.', '<br>', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblpublicnotice`
--

CREATE TABLE `tblpublicnotice` (
  `ID` int(5) NOT NULL,
  `NoticeTitle` varchar(200) DEFAULT NULL,
  `NoticeMessage` mediumtext DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpublicnotice`
--

INSERT INTO `tblpublicnotice` (`ID`, `NoticeTitle`, `NoticeMessage`, `CreationDate`) VALUES
(5, 'Enrollment Period', 'The starting of class is august', '2024-04-19 06:51:28'),
(6, 'Test', 'Test test', '2024-04-23 05:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblschoolyear`
--

CREATE TABLE `tblschoolyear` (
  `id` int(11) NOT NULL,
  `schoolyear` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblschoolyear`
--

INSERT INTO `tblschoolyear` (`id`, `schoolyear`) VALUES
(1, '2023-2024');

-- --------------------------------------------------------

--
-- Table structure for table `tblsemesters`
--

CREATE TABLE `tblsemesters` (
  `SemesterID` int(11) NOT NULL,
  `SemesterName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsemesters`
--

INSERT INTO `tblsemesters` (`SemesterID`, `SemesterName`) VALUES
(1, '2023-2024'),
(2, '2023-2024');

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `ID` int(10) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `LastName` varchar(100) NOT NULL,
  `FirstName` varchar(100) NOT NULL,
  `MiddleInitial` varchar(10) DEFAULT NULL,
  `Gender` varchar(10) NOT NULL,
  `Age` int(11) NOT NULL,
  `DOB` date NOT NULL,
  `PlaceOfBirth` varchar(255) DEFAULT NULL,
  `CurrentAddress` varchar(255) NOT NULL,
  `PermanentAddress` varchar(255) NOT NULL,
  `ContactNo` varchar(15) NOT NULL,
  `EmailAddress` varchar(100) NOT NULL,
  `Strand` varchar(100) NOT NULL,
  `GradeLevel` varchar(100) NOT NULL,
  `LRN` varchar(20) DEFAULT NULL,
  `SchoolLastAttended` varchar(255) DEFAULT NULL,
  `FatherName` varchar(100) DEFAULT NULL,
  `FatherContactNumber` varchar(15) DEFAULT NULL,
  `MotherName` varchar(100) DEFAULT NULL,
  `MotherContactNumber` varchar(15) DEFAULT NULL,
  `EmergencyContactNumber` varchar(15) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Image` varchar(255) DEFAULT NULL,
  `YearAdmitted` datetime DEFAULT NULL,
  `section` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`ID`, `UserAccountID`, `LastName`, `FirstName`, `MiddleInitial`, `Gender`, `Age`, `DOB`, `PlaceOfBirth`, `CurrentAddress`, `PermanentAddress`, `ContactNo`, `EmailAddress`, `Strand`, `GradeLevel`, `LRN`, `SchoolLastAttended`, `FatherName`, `FatherContactNumber`, `MotherName`, `MotherContactNumber`, `EmergencyContactNumber`, `UserName`, `Password`, `Image`, `YearAdmitted`, `section`) VALUES
(25, 23, 'Amer', 'Abdulhakim', 'P.', 'Male', 21, '2002-12-14', 'Marawi City', 'Brgy. Dimaluna 2 MSU, Marawi City, Lanao Del Sur', 'Brgy. Dimaluna 2 MSU, Marawi City, Lanao Del Sur', '09684312010', 'amer@gmail.com', 'TVL-ICT', '11', '41255545977', 'MSU- Integrated Laboratory School', 'Amer Basher', '09298369057', 'Test Test', '09467697255', '09260393353', '', '', '43bfc6b38f0311f4f73e8d67166836fd1715967223.jpg', '2024-05-17 19:33:43', 1),
(26, 24, 'Lala', 'Sihawi', 'P.', 'Male', 18, '2005-05-25', 'Marawi City', 'Bario Salaam, MSU, Marawi City', 'Buto Ambolong, Marawi City, LDS', '09684312010', 'sihawilalajr@gmail.com', 'TVL-ICT', '12', '406089150413', 'MSU- Integrated Laboratory School', 'Sihawi A. Lala', '09298369057', 'Racmah P. Hadjiessah', '09467697255', '09467697255', '', '', '082fe7bf99b0fb09b6370248bf9b88111715973552.jpg', '2024-05-17 21:19:12', 1),
(27, 25, 'Abdul', 'Kent Solaiman', 'Solaiman', 'Male', 21, '2003-01-19', 'Cainta, Rizal', '0969, Brgy. Dimaluna 2, 8th Street, MSU, Marawi City, LDS', '0969, Brgy. Dimaluna 2, 8th Street, MSU, Marawi City, LDS', '09318179410', 'abdulkent143@gmail.com', 'TVL-ICT', '12', '4732001547', 'MSU- Integrated Laboratory School', 'Saanodin M. Abdul', '09505841925', 'Khadija Solaiman Abdul', '09260393353', '09260393353', '', '', 'd76b7387522f757efb9756f1ea9b29771716005920.jpg', '2024-05-18 06:18:40', 1),
(28, 0, 'Pimping', 'Nuroldin', 'U', 'Male', 26, '1998-01-08', 'Mercy Hospital, Iligan City', 'Purok 03 House No.# 0225 Marawi Poblacion, Marawi City, Lanao del Sur, 9700', 'Purok 03 House No.# 0225 Marawi Poblacion, Marawi City, Lanao del Sur, 9700', '09173569779', 'pixelphon@gmail.com', 'TVL-ICT', 'Old Cur', '201409972', 'MSU Main Campus Marawi City', 'Olomoding D. Pimping', '09123456789', 'Nur-haima B. Umpara', '099876554321', '09173569779', 'qwerty', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'qwerty.jpeg', '2014-08-04 20:22:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `SubjectID` int(11) NOT NULL,
  `SubjectName` varchar(255) NOT NULL,
  `units` int(2) NOT NULL,
  `subject_type` varchar(32) NOT NULL,
  `grade_level` int(3) NOT NULL,
  `semester` varchar(32) NOT NULL,
  `subject_description` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`SubjectID`, `SubjectName`, `units`, `subject_type`, `grade_level`, `semester`, `subject_description`) VALUES
(14, 'ENGLISH 001', 4, 'Core', 11, '1st Semester', 'Oral Communication'),
(15, 'FILIPINO 001', 4, 'Core', 11, '1st Semester', 'Komunikasyon at Pananaliksisk sa Wika at Kulturang Pilipino'),
(16, 'SCIENCE 001', 4, 'Core', 11, '1st Semester', 'Earth and Life Science (Lecture and Laboratory)'),
(17, 'HUMANITIES 001', 4, 'Core', 11, '1st Semester', '21st Century Literature From The Philippines And The World'),
(18, 'TVL-AS-015', 4, 'Core', 11, '1st Semester', 'Empowerment Technology (E-Tech): Ict For Professional Tracks'),
(19, 'MATHEMATICS 001', 4, 'Core', 11, '1st Semester', 'General Mathematics'),
(20, 'FILIPINO 002', 4, 'Core', 11, '1st Semester', 'Pagbasa at Pagsuri ng Iba’t-Ibang Teksto tungo sa Pananaliksik'),
(21, 'HOPE 1', 2, 'Core', 11, '1st Semester', 'Health Optimizing Physical Education 1'),
(22, 'TVL-AS-012', 4, 'Core', 11, '2nd Semester', 'Research In Daily Life 1'),
(23, 'ENGLISH 002', 4, 'Core', 11, '2nd Semester', 'Reading and Writing'),
(24, 'SCIENCE 002', 4, 'Core', 11, '2nd Semester', 'Physical Science (Lecture and Laboratory)'),
(25, 'MATHEMATICS 002', 4, 'Core', 11, '2nd Semester', 'Statistics and Probability'),
(26, 'SOCIAL SCIENCE 001', 4, 'Core', 11, '2nd Semester', 'Personality Development (Pansariling Kaunlaran)'),
(27, 'ICT-022', 4, 'Specialized', 11, '2nd Semester', 'Oracle 1  / Specialized Subject'),
(28, 'ICT-SS-022', 4, 'Specialized', 11, '2nd Semester', 'Java 1 / Computer Programming '),
(29, 'HOPE 2', 2, 'Core', 11, '2nd Semester', 'Health Optimizing Physical Education 2'),
(30, 'TVL-AS-011 / ENGLISH 3', 4, 'Core', 12, '1st Semester', 'English for Academic and Professional Purposes'),
(31, 'COMMUNICATION 001', 4, 'Core', 12, '1st Semester', 'Media and Information Literacy'),
(32, 'HUMANITIES 002', 4, 'Core', 12, '1st Semester', 'Contemporary Philippine Arts from the Regions'),
(33, 'FILIPINO 003', 4, 'Core', 12, '1st Semester', 'Pagsulat Sa Filipino sa Piling Larangan (Tech - Voc)'),
(34, 'TVL-AS-016', 4, 'Core', 12, '1st Semester', 'Entrepreneurship'),
(35, 'TVL-AS-013', 4, 'Core', 12, '1st Semester', 'Research In Daily Life 2'),
(36, 'ICT-SS-023', 4, 'Specialized', 12, '1st Semester', 'Java 2 / Specialized Subject'),
(37, 'ICT-SS-24', 4, 'Specialized', 12, '1st Semester', 'Oracle 2 / Specialized Subject'),
(38, 'HOPE 3', 2, 'Core', 12, '1st Semester', 'Health Optimizing Physical Education 3'),
(39, 'SOCIAL SCIENCE 002', 4, 'Core', 12, '2nd Semester', 'Understanding Culture, Society And Politics'),
(40, 'PHILO 1', 4, 'Core', 12, '2nd Semester', 'Introduction To Philosophy Of Human Person 1'),
(41, 'PR 3', 4, 'Specialized', 12, '2nd Semester', 'Capstone Project'),
(42, 'ICT-SS-026', 4, 'Specialized', 12, '2nd Semester', 'Java 3 / Specialized Subject'),
(43, 'ICT-SS-025', 4, 'Specialized', 12, '2nd Semester', 'Oracle 3 / Specialized Subject'),
(44, 'ICY-SS-027', 4, 'Specialized', 12, '2nd Semester', 'Work Immersion'),
(45, 'HOPE 4', 2, 'Core', 12, '2nd Semester', 'Health Optimizing Physical Education 4');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activity`
--

CREATE TABLE `tbl_activity` (
  `id` int(11) NOT NULL,
  `activity_name` varchar(255) NOT NULL,
  `date_allocated` date NOT NULL,
  `schoolyear_id` int(11) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_activity`
--

INSERT INTO `tbl_activity` (`id`, `activity_name`, `date_allocated`, `schoolyear_id`, `date_created`) VALUES
(1, 'Opening of School', '2024-12-31', 1, '2024-05-10 22:52:32');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `ClassID` int(11) NOT NULL,
  `GradeLevel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_class`
--

INSERT INTO `tbl_class` (`ClassID`, `GradeLevel`) VALUES
(1, '11'),
(2, '12');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_club`
--

CREATE TABLE `tbl_club` (
  `ClubID` int(11) NOT NULL,
  `ClubName` varchar(255) NOT NULL,
  `AdviserID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_club`
--

INSERT INTO `tbl_club` (`ClubID`, `ClubName`, `AdviserID`) VALUES
(6, 'Suwara ', 29);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_club_members`
--

CREATE TABLE `tbl_club_members` (
  `ClubMemberID` int(11) NOT NULL,
  `ClubID` int(11) DEFAULT NULL,
  `StudentID` int(11) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `course_description` varchar(255) NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`course_id`, `course_name`, `course_description`, `date_created`) VALUES
(1, 'TVL-ICT', 'Information and Communication Technology', '2024-04-21'),
(2, 'STEM', 'Science, Technology, Engineering, and Mathematics', '2024-04-22'),
(3, 'ABM', 'Accountancy, Business, and Management', '2024-04-22'),
(4, 'HUMMS', 'Humanities and Social Sciences', '2024-04-22'),
(5, 'TVL-AFA', 'Agri- Fishery Arts', '2024-04-22'),
(6, 'TVL-HE', 'Home Economics ', '2024-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation`
--

CREATE TABLE `tbl_evaluation` (
  `ID` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_evaluation`
--

INSERT INTO `tbl_evaluation` (`ID`, `teacher_id`, `question_id`, `answer`) VALUES
(22, 33, 4, 'Always'),
(23, 33, 5, 'Always'),
(24, 33, 6, 'Always'),
(25, 33, 7, 'Always'),
(26, 33, 8, 'Always'),
(27, 33, 9, 'Always'),
(28, 33, 10, 'Always'),
(29, 33, 11, 'Always'),
(30, 33, 12, 'Always'),
(31, 33, 13, 'Always');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_evaluation_comments`
--

CREATE TABLE `tbl_evaluation_comments` (
  `ID` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_evaluation_comments`
--

INSERT INTO `tbl_evaluation_comments` (`ID`, `teacher_id`, `comment`) VALUES
(2, 33, 'She\'s indeed a hardworking and passionate mentor.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_record_examineer`
--

CREATE TABLE `tbl_record_examineer` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `strand` varchar(255) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `contact` varchar(15) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_record_examineer`
--

INSERT INTO `tbl_record_examineer` (`id`, `fname`, `lname`, `email`, `age`, `strand`, `gender`, `address`, `contact`, `uname`, `password`, `image`) VALUES
(1, 'Moctar', 'Basher', 'basher@gmail.com', 18, 'TVL-ICT', 'Male', '1st Street Msu marawi city', '09318179410', 'moc', '0591e932d0692e75be2160cb6199bb35', '43bfc6b38f0311f4f73e8d67166836fd1713765158.jpg'),
(2, 'Sihawi', 'Lala', 'lala@gmail.com', 28, 'STEM', 'Female', '2nd Street', '09318179410', 'lala', '2e3817293fc275dbee74bd71ce6eb056', '2738b4d62e719f310e86d5ec92a15df81713851871.png'),
(3, 'Record', 'Examiner', 'examiner@gmail.com', 18, 'TVL-ICT', 'Male', 'examiner', '09090909090', 'examiner', '7dd7e73fae904292bd9ff25e1b6d35c0', 'e83dba2cbce536c56ed4cdfc7b536e121715828869.jpg'),
(25, 'kent', 'abdul', 'abdul@gmail.com', 26, 'TVL-ICT', 'Others', 'MSU MAIN', '09123456789', '', '', 'kent.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE `tbl_section` (
  `SectionID` int(11) NOT NULL,
  `Section` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_section`
--

INSERT INTO `tbl_section` (`SectionID`, `Section`) VALUES
(1, '1'),
(2, '2'),
(3, '3'),
(4, '4'),
(5, '5');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ter_questions`
--

CREATE TABLE `tbl_ter_questions` (
  `ID` int(11) NOT NULL,
  `Question` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ter_questions`
--

INSERT INTO `tbl_ter_questions` (`ID`, `Question`) VALUES
(4, 'The teacher explains and presents subject matter clearly and effectively.'),
(5, 'The teacher manages classroom behavior and maintains a positive learning environment.'),
(6, 'The teacher engages students in the learning process and encourages active participation.'),
(7, 'The teacher provides timely and constructive feedback on assignments and assessments.'),
(8, 'The teacher demonstrates expertise and knowledge of the subject matter.'),
(9, 'The teacher communicates effectively with students, parents, and colleagues.'),
(10, 'The teacher adheres to professional standards and ethics.'),
(11, 'The teacher adapts lessons to meet the diverse needs of students.'),
(12, 'The teacher incorporates technology into the classroom to enhance learning.'),
(13, 'The teacher collaborates with colleagues to improve instructional practices and contributes positively to the school community.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_accounts`
--

CREATE TABLE `tbl_user_accounts` (
  `ID` int(11) NOT NULL,
  `UserName` varchar(25) NOT NULL,
  `Password` varchar(125) NOT NULL,
  `Type` varchar(25) NOT NULL,
  `expiryDate` date DEFAULT NULL,
  `disabled` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_accounts`
--

INSERT INTO `tbl_user_accounts` (`ID`, `UserName`, `Password`, `Type`, `expiryDate`, `disabled`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', 'admin', NULL, NULL),
(10, 'zoro', 'eed83905a260b31bc5d254701999ee94', 'faculty', '2026-05-13', 1),
(11, 'haniah', '22f2cebafc26f75c5d5e3f09e12c1034', 'faculty', '2026-05-13', NULL),
(13, 'yassef', '2e91fc6d841b165b1630f98eb7e4b0ee', 'student', '2026-05-13', NULL),
(14, 'ammar', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Subject Teacher', '2026-05-15', NULL),
(15, 'alibasher', '8d15dcff7e137ead6f41b385a14d47e5', 'faculty', '2026-05-17', NULL),
(23, 'amer123', 'f5f45107403c20b3b3f33bc9631012b7', 'student', '2026-05-17', NULL),
(24, 'lala', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'student', '2026-05-17', NULL),
(25, 'kent', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Record Examineer', '2026-05-18', NULL),
(28, 'jalipha', 'f5d607bd7c74c4e66ba442c5e487cfb3', 'faculty', '2026-05-18', NULL),
(29, 'pixelphon', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Chairperson', '2026-05-19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `total_grades`
--

CREATE TABLE `total_grades` (
  `id` int(11) NOT NULL,
  `StuID` int(50) NOT NULL,
  `SubjectID` int(50) NOT NULL,
  `1st_grading` varchar(100) NOT NULL,
  `2nd_grading` varchar(100) NOT NULL,
  `units` varchar(100) NOT NULL,
  `final_grades` varchar(100) NOT NULL,
  `passed_failed` varchar(100) NOT NULL,
  `semID` int(11) NOT NULL,
  `syi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `request_docs`
--
ALTER TABLE `request_docs`
  ADD KEY `st_id` (`st_id`),
  ADD KEY `re_id` (`re_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblgrades`
--
ALTER TABLE `tblgrades`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `StuID` (`StuID`),
  ADD KEY `Subject` (`Subject`),
  ADD KEY `Faculty` (`Faculty`);

--
-- Indexes for table `tblnotice`
--
ALTER TABLE `tblnotice`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpublicnotice`
--
ALTER TABLE `tblpublicnotice`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblschoolyear`
--
ALTER TABLE `tblschoolyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblsemesters`
--
ALTER TABLE `tblsemesters`
  ADD PRIMARY KEY (`SemesterID`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  ADD PRIMARY KEY (`SubjectID`);

--
-- Indexes for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schoolyear_id` (`schoolyear_id`);

--
-- Indexes for table `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`ClassID`);

--
-- Indexes for table `tbl_club`
--
ALTER TABLE `tbl_club`
  ADD PRIMARY KEY (`ClubID`),
  ADD KEY `AdviserID` (`AdviserID`);

--
-- Indexes for table `tbl_club_members`
--
ALTER TABLE `tbl_club_members`
  ADD PRIMARY KEY (`ClubMemberID`),
  ADD KEY `ClubID` (`ClubID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `tbl_evaluation`
--
ALTER TABLE `tbl_evaluation`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indexes for table `tbl_evaluation_comments`
--
ALTER TABLE `tbl_evaluation_comments`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `tbl_record_examineer`
--
ALTER TABLE `tbl_record_examineer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_section`
--
ALTER TABLE `tbl_section`
  ADD PRIMARY KEY (`SectionID`);

--
-- Indexes for table `tbl_ter_questions`
--
ALTER TABLE `tbl_ter_questions`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbl_user_accounts`
--
ALTER TABLE `tbl_user_accounts`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `total_grades`
--
ALTER TABLE `total_grades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `tblgrades`
--
ALTER TABLE `tblgrades`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `tblnotice`
--
ALTER TABLE `tblnotice`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblpublicnotice`
--
ALTER TABLE `tblpublicnotice`
  MODIFY `ID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblschoolyear`
--
ALTER TABLE `tblschoolyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblsemesters`
--
ALTER TABLE `tblsemesters`
  MODIFY `SemesterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_club`
--
ALTER TABLE `tbl_club`
  MODIFY `ClubID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_club_members`
--
ALTER TABLE `tbl_club_members`
  MODIFY `ClubMemberID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_evaluation`
--
ALTER TABLE `tbl_evaluation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `tbl_evaluation_comments`
--
ALTER TABLE `tbl_evaluation_comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_record_examineer`
--
ALTER TABLE `tbl_record_examineer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_ter_questions`
--
ALTER TABLE `tbl_ter_questions`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_user_accounts`
--
ALTER TABLE `tbl_user_accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `total_grades`
--
ALTER TABLE `total_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `schedule` (`schedule_id`);

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user_accounts` (`ID`);

--
-- Constraints for table `request_docs`
--
ALTER TABLE `request_docs`
  ADD CONSTRAINT `request_docs_ibfk_1` FOREIGN KEY (`st_id`) REFERENCES `tblstudent` (`ID`),
  ADD CONSTRAINT `request_docs_ibfk_2` FOREIGN KEY (`re_id`) REFERENCES `tbl_record_examineer` (`id`);

--
-- Constraints for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD CONSTRAINT `tblclasses_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `tblfaculty` (`ID`);

--
-- Constraints for table `tblgrades`
--
ALTER TABLE `tblgrades`
  ADD CONSTRAINT `tblgrades_ibfk_1` FOREIGN KEY (`StuID`) REFERENCES `tblstudent` (`ID`),
  ADD CONSTRAINT `tblgrades_ibfk_2` FOREIGN KEY (`Subject`) REFERENCES `tblsubjects` (`SubjectID`),
  ADD CONSTRAINT `tblgrades_ibfk_3` FOREIGN KEY (`Faculty`) REFERENCES `tblfaculty` (`ID`);

--
-- Constraints for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD CONSTRAINT `tbl_activity_ibfk_1` FOREIGN KEY (`schoolyear_id`) REFERENCES `tblschoolyear` (`id`);

--
-- Constraints for table `tbl_club`
--
ALTER TABLE `tbl_club`
  ADD CONSTRAINT `tbl_club_ibfk_1` FOREIGN KEY (`AdviserID`) REFERENCES `tblfaculty` (`ID`);

--
-- Constraints for table `tbl_club_members`
--
ALTER TABLE `tbl_club_members`
  ADD CONSTRAINT `tbl_club_members_ibfk_1` FOREIGN KEY (`ClubID`) REFERENCES `tbl_club` (`ClubID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_club_members_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `tblstudent` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_evaluation`
--
ALTER TABLE `tbl_evaluation`
  ADD CONSTRAINT `tbl_evaluation_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `tblfaculty` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_evaluation_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `tbl_ter_questions` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_evaluation_comments`
--
ALTER TABLE `tbl_evaluation_comments`
  ADD CONSTRAINT `tbl_evaluation_comments_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `tblfaculty` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
