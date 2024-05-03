-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 09:10 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.3.33

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
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 8979555558, 'admin@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2019-10-11 04:36:52');

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `ClassID` int(11) NOT NULL,
  `ClassName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tblfaculty`
--

CREATE TABLE `tblfaculty` (
  `ID` int(11) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblfaculty`
--

INSERT INTO `tblfaculty` (`ID`, `FirstName`, `LastName`, `Email`, `Age`, `Gender`, `Address`, `Contact`, `UserName`, `Password`, `Image`, `JoiningDate`, `position`, `assignedStrand`, `advisoryClasses`) VALUES
(4, 'Saanodin M. Abdul', 'abdul', 'saanodin@gmail.cpm', 23, 'Male', '8th Street MSU marawi City', '09318179410', 'user123', '6ad14ba9986e3615423dfca256d04e3f', '57683b65b34eda82fd02852a4415e9c91709526048.jpg', '2024-03-04 04:20:48', '', NULL, NULL),
(5, 'Ammar ', 'Macabalang', 'ammar@gmail.com', 25, 'Male', '8TH Street MSU', '09505841925', 'user143', 'b4e4a40dd336fdc442a4979964afcada', 'c2f59594d3593d4ad0b271c60cf11f391709530114.jpg', '2024-03-04 05:28:34', '', NULL, NULL),
(6, 'Suhaib ', 'Mastura', 'suhaib@gmail.com', 29, 'Male', '1st Street', '09505841925', 'eban', 'aa9dff8fd2379f35097dc7ecf0a4f16b', 'b5dc9b4eae4cc27396d2b332d5cd24f61713519967.png', '2024-04-19 09:46:07', '', NULL, NULL),
(9, 'Kent', 'Solaiman', 'kent143@gmail.com', 21, 'Male', '8th Street MSU', '09318179410', 'kent123', '7b0172b419534186a9af2f95b040e7b8', 'e0d6469036a5af65d3f7b1e5b05872da1713542621.png', '2024-04-19 16:03:41', '', NULL, NULL),
(10, 'salman', 'salmon', 'salman@gmail.com', 26, 'Male', '5th street msu marawi city lds', '09318179321', 'salmon', '180fd182f9a0742f483619781ccc36c4', '4975500f7dac022b439b8f2252b456931713795291.png', '2024-04-22 14:14:51', '', NULL, NULL),
(11, 'Jalipha', 'Ampog', 'jalipha@gmail.com', 27, 'Female', '1st Street', '09090909222', 'jalipha', '5a9f0d96473e9b3d20a3848dddb46cd4', '43bfc6b38f0311f4f73e8d67166836fd1713851535.jpg', '2024-04-23 05:52:15', '', NULL, NULL),
(12, 'qwerty', 'asdfgh', 'qwerty@gmail.com', 26, 'Male', 'qwerty asdfgh', '0912345678', 'qwerty', 'd59c0e414426c0b261ba0cc19372ca1a', '5e3b19796bd2e718c4dbcac02800ad081714758255.jpg', '2024-05-03 17:44:15', 'chairperson', NULL, NULL),
(14, 'zxcvb', 'asdfgh', 'qwerty@gmail.com', 26, 'Male', 'purok qwerty asdfgh city', '0912345678', 'asdfgh', 'a152e841783914146e4bcd4f39100686', '5e3b19796bd2e718c4dbcac02800ad081714759839.jpg', '2024-05-03 18:10:54', 'Chairperson (Adviser & Subject)', NULL, NULL),
(18, 'tapay', 'tapay', 'tapay', 27, 'Male', 'qwerty', '9123456789', 'uname', 'qwerty', 'qwerty.jpeg', '2024-05-03 18:32:36', 'Visiting Teacher', 'qwerty', 'asdfgh'),
(20, 'qwer', 'qwer', 'qwer@g', 27, 'Male', 'qwer', '01234', 'nuroldinre', '962012d09b8170d912f0669f6d7d9d07', '5e3b19796bd2e718c4dbcac02800ad081714761655.jpg', '2024-05-03 18:41:31', 'Chairperson (Adviser & Subject)', 'qwertyiuo', 'asdflkjqwer'),
(21, 'Nuroldin', 'Pimping', 'revengecat@gmail.com', 27, 'Male', 'Purok 03 House No.# 0225 Marawi Poblacion Marawi City Lanao del Sur 9700', '09173569779', 'pixelphon', '25f9e794323b453885f5181f1b624d0b', '5e3b19796bd2e718c4dbcac02800ad081714761822.jpg', '2024-05-03 18:43:42', 'Chairperson (Adviser & Subject)', 'STEAM', 'DOTA 2');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblgrades`
--

INSERT INTO `tblgrades` (`ID`, `StuID`, `Subject`, `FirstGrading`, `SecondGrading`, `Semester`, `Faculty`, `Units`) VALUES
(5, '1234444', 'oracle 1', '84', '85', '2023-2024', 11, 4);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpublicnotice`
--

INSERT INTO `tblpublicnotice` (`ID`, `NoticeTitle`, `NoticeMessage`, `CreationDate`) VALUES
(5, 'Enrollment Period', 'The starting of class is august', '2024-04-19 06:51:28'),
(6, 'Test', 'Test test', '2024-04-23 05:46:42');

-- --------------------------------------------------------

--
-- Table structure for table `tblsemesters`
--

CREATE TABLE `tblsemesters` (
  `SemesterID` int(11) NOT NULL,
  `SemesterName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `strand` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`ID`, `StudentName`, `StudentEmail`, `Gender`, `DOB`, `StuID`, `FatherName`, `MotherName`, `ContactNumber`, `AltenateNumber`, `Address`, `UserName`, `Password`, `Image`, `DateofAdmission`, `grade_level`, `strand`) VALUES
(17, 'kent ', 'kent@gmail.com', 'Female', '2004-01-24', '231321321', NULL, NULL, NULL, NULL, NULL, 'kent', '7b0172b419534186a9af2f95b040e7b8', 'e7da5f78d53fd2f62c2b991f3df7b0e21713838289.png', '2024-04-23 02:11:29', NULL, NULL),
(18, 'Ammar', 'ammar@gmail.com', 'Male', '2005-01-12', '32132132', 'ammar', 'amara', '321321', 4213213, 'Marawi City', 'ammar', 'fed5de04cbba88aae4fa4b1d370dde5c', '9237ec3735144b721fb2453571cdcd101713842230.png', '2024-04-23 03:17:10', NULL, NULL),
(19, 'Amer Abdulhakim', 'amer@gmail.com', 'Male', '2001-01-02', '1234444', 'amer', 'pangcoga', '0931817941', 931817941, '8th street msu marawi city', 'amer', 'f5f45107403c20b3b3f33bc9631012b7', '4975500f7dac022b439b8f2252b456931713852130.png', '2024-04-23 06:02:10', NULL, NULL),
(20, 'Juhainah Farouk', 'ju@gmail.com', 'Female', '2005-09-01', '406091152298', 'Farouk Macamano', 'Norjannah Mephalangca', '0938132718', 999999999, 'Bario Rapasun MSU Marawi City', 'juhainah', '308fe66906d9b7d5191ef7ca10dee75f', '43bfc6b38f0311f4f73e8d67166836fd1714036381.jpg', '2024-04-25 09:13:01', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsubjects`
--

CREATE TABLE `tblsubjects` (
  `SubjectID` int(11) NOT NULL,
  `SubjectName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsubjects`
--

INSERT INTO `tblsubjects` (`SubjectID`, `SubjectName`) VALUES
(1, 'Oracle 1'),
(2, 'Oracle 2'),
(3, 'English 1'),
(4, 'Math 1'),
(5, 'Physics 1'),
(6, 'Soc Science 1'),
(7, 'Capstone 1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_class`
--

CREATE TABLE `tbl_class` (
  `ClassID` int(11) NOT NULL,
  `GradeLevel` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_record_examineer`
--

INSERT INTO `tbl_record_examineer` (`id`, `fname`, `lname`, `email`, `age`, `strand`, `gender`, `address`, `contact`, `uname`, `password`, `image`) VALUES
(1, 'Moctar', 'Basher', 'basher@gmail.com', 18, 'TVL-ICT', 'Male', '1st Street Msu marawi city', '09318179410', 'moc', '0591e932d0692e75be2160cb6199bb35', '43bfc6b38f0311f4f73e8d67166836fd1713765158.jpg'),
(2, 'Sihawi', 'Lala', 'lala@gmail.com', 28, 'STEM', 'Female', '2nd Street', '09318179410', 'lala', '2e3817293fc275dbee74bd71ce6eb056', '2738b4d62e719f310e86d5ec92a15df81713851871.png');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_section`
--

CREATE TABLE `tbl_section` (
  `SectionID` int(11) NOT NULL,
  `Section` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

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
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UserName` (`UserName`);

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
-- Indexes for table `total_grades`
--
ALTER TABLE `total_grades`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblgrades`
--
ALTER TABLE `tblgrades`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
-- AUTO_INCREMENT for table `tblsemesters`
--
ALTER TABLE `tblsemesters`
  MODIFY `SemesterID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblsubjects`
--
ALTER TABLE `tblsubjects`
  MODIFY `SubjectID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_section`
--
ALTER TABLE `tbl_section`
  MODIFY `SectionID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `total_grades`
--
ALTER TABLE `total_grades`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
