-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 02:56 PM
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
-- Table structure for table `tbl_club_members`
--

CREATE TABLE `tbl_club_members` (
  `ID` int(11) NOT NULL,
  `ClubID` int(11) NOT NULL,
  `StudentID` int(11) NOT NULL,
  `Position` enum('officer','member') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_club_members`
--

INSERT INTO `tbl_club_members` (`ID`, `ClubID`, `StudentID`, `Position`) VALUES
(3, 8, 19, 'member'),
(4, 8, 19, 'member'),
(5, 7, 20, 'officer'),
(6, 7, 20, 'officer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_club_members`
--
ALTER TABLE `tbl_club_members`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ClubID` (`ClubID`),
  ADD KEY `StudentID` (`StudentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_club_members`
--
ALTER TABLE `tbl_club_members`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_club_members`
--
ALTER TABLE `tbl_club_members`
  ADD CONSTRAINT `tbl_club_members_ibfk_1` FOREIGN KEY (`ClubID`) REFERENCES `tbl_club` (`ClubID`),
  ADD CONSTRAINT `tbl_club_members_ibfk_2` FOREIGN KEY (`StudentID`) REFERENCES `tblstudent` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
