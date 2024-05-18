-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2024 at 09:52 AM
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
(5, 11, '2024-05-15 07:55:23', '2024-05-15 07:55:27'),
(6, 10, '2024-05-15 08:15:53', NULL),
(7, 10, '2024-05-15 08:16:56', '2024-05-15 08:17:00'),
(8, 11, '2024-05-15 08:24:15', '2024-05-15 08:24:47'),
(9, 11, '2024-05-15 14:47:08', '2024-05-15 08:47:25'),
(10, 10, '2024-05-15 14:48:41', NULL),
(11, 11, '2024-05-15 14:51:39', '2024-05-15 14:51:42'),
(12, 11, '2024-05-15 19:30:37', '2024-05-15 19:30:41'),
(13, 11, '2024-05-15 20:42:32', '2024-05-15 20:49:41'),
(14, 11, '2024-05-15 20:57:32', '2024-05-15 20:57:36'),
(15, 11, '2024-05-15 21:25:17', '2024-05-15 21:25:21'),
(16, 11, '2024-05-15 21:25:55', '2024-05-15 21:25:59'),
(17, 11, '2024-05-15 21:38:16', '2024-05-15 21:40:59'),
(18, 14, '2024-05-15 23:31:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `UserAccountID` int(11) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `UserAccountID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 1, 'Admin', 'admin', 8979555558, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-10-11 04:36:52');

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

INSERT INTO `tblfaculty` (`ID`, `UserAccountID`, `FirstName`, `LastName`, `Email`, `Age`, `Gender`, `Address`, `Contact`, `UserName`, `Password`, `Image`, `JoiningDate`, `position`, `assignedStrand`, `advisoryClasses`) VALUES
(4, 0, 'Saanodin M. Abdul', 'abdul', 'saanodin@gmail.cpm', 23, 'Male', '8th Street MSU marawi City', '09318179410', 'user123', '6ad14ba9986e3615423dfca256d04e3f', '57683b65b34eda82fd02852a4415e9c91709526048.jpg', '2024-03-04 04:20:48', '', NULL, NULL),
(5, 0, 'Ammar ', 'Macabalang', 'ammar@gmail.com', 25, 'Male', '8TH Street MSU', '09505841925', 'user143', 'b4e4a40dd336fdc442a4979964afcada', 'c2f59594d3593d4ad0b271c60cf11f391709530114.jpg', '2024-03-04 05:28:34', '', NULL, NULL),
(6, 0, 'Suhaib ', 'Mastura', 'suhaib@gmail.com', 29, 'Male', '1st Street', '09505841925', 'eban', 'aa9dff8fd2379f35097dc7ecf0a4f16b', 'b5dc9b4eae4cc27396d2b332d5cd24f61713519967.png', '2024-04-19 09:46:07', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA 2'),
(9, 0, 'Kent', 'Solaiman', 'kent143@gmail.com', 21, 'Male', '8th Street MSU', '09318179410', 'kent123', '7b0172b419534186a9af2f95b040e7b8', 'e0d6469036a5af65d3f7b1e5b05872da1713542621.png', '2024-04-19 16:03:41', '', NULL, NULL),
(10, 0, 'salman', 'salmon', 'salman@gmail.com', 26, 'Male', '5th street msu marawi city lds', '09318179321', 'salmon', '180fd182f9a0742f483619781ccc36c4', '4975500f7dac022b439b8f2252b456931713795291.png', '2024-04-22 14:14:51', '', NULL, NULL),
(11, 0, 'Jalipha', 'Ampog', 'jalipha@gmail.com', 27, 'Female', '1st Street', '09090909222', 'jalipha', '5a9f0d96473e9b3d20a3848dddb46cd4', '43bfc6b38f0311f4f73e8d67166836fd1713851535.jpg', '2024-04-23 05:52:15', '', NULL, NULL),
(12, 0, 'qwerty', 'asdfgh', 'qwerty@gmail.com', 26, 'Male', 'qwerty asdfgh', '0912345678', 'qwerty', 'd59c0e414426c0b261ba0cc19372ca1a', '5e3b19796bd2e718c4dbcac02800ad081714758255.jpg', '2024-05-03 17:44:15', 'chairperson', NULL, NULL),
(14, 0, 'zxcvb', 'asdfgh', 'qwerty@gmail.com', 26, 'Male', 'purok qwerty asdfgh city', '0912345678', 'asdfgh', 'a152e841783914146e4bcd4f39100686', '5e3b19796bd2e718c4dbcac02800ad081714759839.jpg', '2024-05-03 18:10:54', 'Chairperson (Adviser & Subject)', NULL, NULL),
(18, 0, 'tapay', 'tapay', 'tapay', 27, 'Male', 'qwerty', '9123456789', 'uname', 'qwerty', 'qwerty.jpeg', '2024-05-03 18:32:36', 'Visiting Teacher', 'qwerty', 'asdfgh'),
(20, 0, 'qwer', 'qwer', 'qwer@g', 27, 'Male', 'qwer', '01234', 'nuroldinre', '962012d09b8170d912f0669f6d7d9d07', '5e3b19796bd2e718c4dbcac02800ad081714761655.jpg', '2024-05-03 18:41:31', 'Chairperson (Adviser & Subject)', 'qwertyiuo', 'asdflkjqwer'),
(22, 0, 'Test', 'Test', 'Test@test.com', 12, 'Male', 'MSU', '212', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715608530.png', '2024-05-13 13:55:30', 'Chairperson (Adviser & Subject)', 'STEM', 'DOTA2'),
(25, 7, 'Test', 'Test', 'Test@test.com', 12, 'Male', 'MSU', '212', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715609219.png', '2024-05-13 14:06:59', 'Chairperson (Adviser & Subject)', 'STEM', 'DOTA2'),
(26, 8, 'Luffy', 'L', 'test@test.com', 12, 'Male', 'MSU', '123', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715609393.png', '2024-05-13 14:09:53', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA2'),
(27, 9, 'Nami', 'N', 'test@test.com', 12, 'Female', 'MSU', '234234', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715609908.png', '2024-05-13 14:18:28', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA2'),
(28, 10, 'Zoro', 'Ronoa', 'tet@zor.com', 12, 'Male', 'MM', '12121', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715610809.png', '2024-05-13 14:33:29', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA2'),
(29, 11, 'Haniah', 'Krys', 'krys@gmail.com', 26, 'Female', 'MSU', '12345678', '', '', 'e538570366ca9cf5f838d069b9ffb23a1715615993.png', '2024-05-13 15:59:53', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA2'),
(30, 14, 'Ammar', 'Macaba', 'ammar@gmail.com', 19, 'Male', 'Tuca, Marawi City, Lanao Del Sur', '0931212134451', '', '', '43bfc6b38f0311f4f73e8d67166836fd1715787053.jpg', '2024-05-15 15:30:53', 'Chairperson (Subject)', 'STEAM', '');

-- --------------------------------------------------------

--
-- Table structure for table `tblgrades`
--

CREATE TABLE `tblgrades` (
  `ID` int(11) NOT NULL,
  `StuID` varchar(255) NOT NULL,
  `Subject` varchar(255) NOT NULL,
  `FirstGrading` varchar(10) NOT NULL,
  `SecondGrading` varchar(10) NOT NULL,
  `Semester` varchar(50) NOT NULL,
  `Faculty` int(11) NOT NULL,
  `Units` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblgrades`
--

INSERT INTO `tblgrades` (`ID`, `StuID`, `Subject`, `FirstGrading`, `SecondGrading`, `Semester`, `Faculty`, `Units`) VALUES
(5, '1234444', 'oracle 1', '88', '92', '2023-2024', 11, 4),
(6, '1234444', 'Java 2', '87', '86', '2023-2024', 29, 6),
(7, '1234444', 'Math', '84', '83', '2023-2024', 28, 2);

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
  `UserAccountId` int(11) NOT NULL,
  `StudentName` varchar(200) DEFAULT NULL,
  `StudentEmail` varchar(200) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `StuID` varchar(200) DEFAULT NULL,
  `FatherName` mediumtext DEFAULT NULL,
  `MotherName` mediumtext DEFAULT NULL,
  `ContactNumber` varchar(13) DEFAULT NULL,
  `AltenateNumber` bigint(13) DEFAULT NULL,
  `Address` mediumtext DEFAULT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Image` varchar(200) DEFAULT NULL,
  `DateofAdmission` timestamp NULL DEFAULT current_timestamp(),
  `grade_level` varchar(50) DEFAULT NULL,
  `strand` varchar(50) DEFAULT NULL,
  `section` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`ID`, `UserAccountId`, `StudentName`, `StudentEmail`, `Gender`, `DOB`, `StuID`, `FatherName`, `MotherName`, `ContactNumber`, `AltenateNumber`, `Address`, `UserName`, `Password`, `Image`, `DateofAdmission`, `grade_level`, `strand`, `section`) VALUES
(17, 0, 'kent ', 'kent@gmail.com', 'Female', '2004-01-24', '231321321', NULL, NULL, NULL, NULL, NULL, 'kent', '7b0172b419534186a9af2f95b040e7b8', 'e7da5f78d53fd2f62c2b991f3df7b0e21713838289.png', '2024-04-23 02:11:29', '11', 'STEAM', 1),
(18, 0, 'Ammar', 'ammar@gmail.com', 'Male', '2005-01-12', '32132132', 'ammar', 'amara', '321321', 4213213, 'Marawi City', 'ammar', 'fed5de04cbba88aae4fa4b1d370dde5c', '9237ec3735144b721fb2453571cdcd101713842230.png', '2024-04-23 03:17:10', '11', 'STEAM', 2),
(19, 0, 'Amer Abdulhakim', 'amer@gmail.com', 'Male', '2001-01-02', '1234444', 'amer', 'pangcoga', '0931817941', 931817941, '8th street msu marawi city', 'amer', 'f5f45107403c20b3b3f33bc9631012b7', '4975500f7dac022b439b8f2252b456931713852130.png', '2024-04-23 06:02:10', '12', 'STEAM', 3),
(20, 2, 'Juhainah Farouk', 'ju@gmail.com', 'Female', '2005-09-01', '406091152298', 'Farouk Macamano', 'Norjannah Mephalangca', '0938132718', 999999999, 'Bario Rapasun MSU Marawi City', 'juhainah', '308fe66906d9b7d5191ef7ca10dee75f', '43bfc6b38f0311f4f73e8d67166836fd1714036381.jpg', '2024-04-25 09:13:01', '12', 'STEM', 4),
(21, 0, 'NuroldinUmpara Pimping', 'qwerty@gmail.com', 'Male', '1998-01-08', '201409972', 'QWERTY', 'QWERTY', 'QWERTY', 9173569779, 'QWERTY', 'nuroldinStudent', 'd59c0e414426c0b261ba0cc19372ca1a', NULL, '2024-05-04 17:22:11', 'graduated', 'old curriculum', 0),
(22, 0, 'Kent', 'kent@gmail.com', 'Male', '2002-01-02', '478032150098', 'Saanodin Maday', 'Khadija Solaiman', '0926039331', 926039331, '8th Street MSU MARAWI CITY', 'kent123', '7b0172b419534186a9af2f95b040e7b8', '43bfc6b38f0311f4f73e8d67166836fd1715242188.jpg', '2024-05-09 08:09:48', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `SubjectID` int(11) NOT NULL,
  `SubjectName` varchar(255) NOT NULL,
  `units` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`SubjectID`, `SubjectName`, `units`) VALUES
(1, 'Oracle 1', 3),
(2, 'Oracle 2', 3),
(3, 'English 1', 3),
(4, 'Math 1', 1),
(5, 'Physics 1', 3),
(6, 'Soc Science 1', 1),
(7, 'Capstone 1', 2);

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
(3, 'Record', 'Examiner', 'examiner@gmail.com', 18, 'TVL-ICT', 'Male', 'examiner', '09090909090', 'examiner', '7dd7e73fae904292bd9ff25e1b6d35c0', 'e83dba2cbce536c56ed4cdfc7b536e121715828869.jpg');

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
(14, 'ammar', 'a0da27baba88e573c351502a63844844', 'faculty', '2026-05-15', NULL);

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
-- Indexes for table `login_history`
--
ALTER TABLE `login_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`course_id`);

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
-- AUTO_INCREMENT for table `login_history`
--
ALTER TABLE `login_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `ClassID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblfaculty`
--
ALTER TABLE `tblfaculty`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tblgrades`
--
ALTER TABLE `tblgrades`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_record_examineer`
--
ALTER TABLE `tbl_record_examineer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user_accounts`
--
ALTER TABLE `tbl_user_accounts`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `total_grades`
--
ALTER TABLE `total_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `login_history`
--
ALTER TABLE `login_history`
  ADD CONSTRAINT `login_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user_accounts` (`ID`);

--
-- Constraints for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD CONSTRAINT `tblclasses_ibfk_1` FOREIGN KEY (`ClassID`) REFERENCES `tblfaculty` (`ID`);

--
-- Constraints for table `tblgrades`
--
ALTER TABLE `tblgrades`
  ADD CONSTRAINT `tblgrades_ibfk_1` FOREIGN KEY (`Faculty`) REFERENCES `tblfaculty` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `tblgrades_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `tblsubjects` (`SubjectID`);

--
-- Constraints for table `tbl_activity`
--
ALTER TABLE `tbl_activity`
  ADD CONSTRAINT `tbl_activity_ibfk_1` FOREIGN KEY (`schoolyear_id`) REFERENCES `tblschoolyear` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
