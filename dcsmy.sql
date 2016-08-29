-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2016 at 04:57 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dcsmy`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `USERNAME` varchar(30) NOT NULL,
  `PASSWORD` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`USERNAME`, `PASSWORD`) VALUES
('admin', '$1$getREKT!$rQz1CoJsgyS9/c8MYudmY.'),
('cavin', '$1$getREKT!$dIxLR68y4V5oJpF4pSiBI.'),
('elden', '$1$getREKT!$bU9gG0vwSNBxQT1p/jpoH0');

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `STUDENT ID` varchar(20) NOT NULL,
  `STUDENT NAME` varchar(99) NOT NULL,
  `PROGRAM` varchar(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`STUDENT ID`, `STUDENT NAME`, `PROGRAM`) VALUES
('C1400418', 'JONATHAN GAN', 'DCSMY'),
('C1400421', 'WONG TUCK MUN', 'DCSMY'),
('C1500285', 'KONG JIN FEI', 'DCSMY'),
('C1678910', 'AUGUST INTAKE', 'DCSMY');

-- --------------------------------------------------------

--
-- Table structure for table `student_subjects`
--

CREATE TABLE `student_subjects` (
  `STUDENT ID` varchar(20) NOT NULL,
  `COURSE CODE` varchar(20) NOT NULL,
  `COMPLETED` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_subjects`
--

INSERT INTO `student_subjects` (`STUDENT ID`, `COURSE CODE`, `COMPLETED`) VALUES
('C1400421', 'CSC 1015', b'0'),
('C1400421', 'CSC 1016', b'0'),
('C1400421', 'CSC 1017', b'0'),
('C1400421', 'CSC 1018', b'0'),
('C1400421', 'CSC 1019', b'0'),
('C1400421', 'CSC 2015', b'0'),
('C1400421', 'CSC 2016', b'0'),
('C1400421', 'CSC 2017', b'0'),
('C1400421', 'CSC 2018', b'0'),
('C1400421', 'CSC 2019', b'0'),
('C1400421', 'CSC 2020', b'0'),
('C1400421', 'CSC 2021', b'0'),
('C1400421', 'CSC 2022', b'0'),
('C1400421', 'CSC 2023', b'0'),
('C1400421', 'CSC 2026', b'0'),
('C1400421', 'CSC 3015', b'0'),
('C1400421', 'CSC 3016', b'0'),
('C1400421', 'CSC 3017', b'0'),
('C1400421', 'ENL 1005', b'0'),
('C1400421', 'ENL 1006', b'0'),
('C1400421', 'MPU 2163', b'0'),
('C1400421', 'MPU 2382', b'0'),
('C1400421', 'MTH 1008', b'0'),
('C1400421', 'MTH 1009', b'0'),
('c1400418', 'CSC 1015', b'1'),
('c1400418', 'CSC 1016', b'1'),
('c1400418', 'CSC 1017', b'1'),
('c1400418', 'CSC 1018', b'1'),
('c1400418', 'CSC 1019', b'1'),
('c1400418', 'CSC 2015', b'0'),
('c1400418', 'CSC 2016', b'1'),
('c1400418', 'CSC 2017', b'1'),
('c1400418', 'CSC 2018', b'1'),
('c1400418', 'CSC 2019', b'0'),
('c1400418', 'CSC 2020', b'0'),
('c1400418', 'CSC 2021', b'0'),
('c1400418', 'CSC 2022', b'0'),
('c1400418', 'CSC 2023', b'0'),
('c1400418', 'CSC 2026', b'0'),
('c1400418', 'CSC 3015', b'0'),
('c1400418', 'CSC 3016', b'0'),
('c1400418', 'CSC 3017', b'0'),
('c1400418', 'ENL 1005', b'1'),
('c1400418', 'ENL 1006', b'0'),
('c1400418', 'MPU 2163', b'1'),
('c1400418', 'MPU 2283', b'1'),
('c1400418', 'MPU 2382', b'0'),
('c1400418', 'MTH 1008', b'1'),
('c1400418', 'MTH 1009', b'1'),
('c1400418', 'MPU 2383', b'0'),
('C1400421', 'MPU 2283', b'0'),
('C1400421', 'MPU 2383', b'0'),
('C1678910', 'CSC 1015', b'0'),
('C1678910', 'CSC 1016', b'0'),
('C1678910', 'CSC 1017', b'0'),
('C1678910', 'CSC 1018', b'0'),
('C1678910', 'CSC 1019', b'0'),
('C1678910', 'CSC 2015', b'0'),
('C1678910', 'CSC 2016', b'0'),
('C1678910', 'CSC 2017', b'0'),
('C1678910', 'CSC 2018', b'0'),
('C1678910', 'CSC 2019', b'0'),
('C1678910', 'CSC 2020', b'0'),
('C1678910', 'CSC 2021', b'0'),
('C1678910', 'CSC 2022', b'0'),
('C1678910', 'CSC 2023', b'0'),
('C1678910', 'CSC 2026', b'0'),
('C1678910', 'CSC 3015', b'0'),
('C1678910', 'CSC 3016', b'0'),
('C1678910', 'CSC 3017', b'0'),
('C1678910', 'ENL 1005', b'0'),
('C1678910', 'ENL 1006', b'0'),
('C1678910', 'MPU 2163', b'0'),
('C1678910', 'MPU 2283', b'0'),
('C1678910', 'MPU 2382', b'0'),
('C1678910', 'MPU 2383', b'0'),
('C1678910', 'MTH 1008', b'0'),
('C1678910', 'MTH 1009', b'0'),
('C1500285', 'CSC 1015', b'1'),
('C1500285', 'CSC 1016', b'1'),
('C1500285', 'CSC 1018', b'1'),
('C1500285', 'CSC 1019', b'1'),
('C1500285', 'CSC 2015', b'1'),
('C1500285', 'CSC 2016', b'1'),
('C1500285', 'CSC 2017', b'1'),
('C1500285', 'CSC 2020', b'1'),
('C1500285', 'CSC 2026', b'1'),
('C1500285', 'ENL 1005', b'1'),
('C1500285', 'ENL 1006', b'1'),
('C1500285', 'MPU 2283', b'1'),
('C1500285', 'MPU 2382', b'1'),
('C1500285', 'MPU 2383', b'1'),
('C1500285', 'MTH 1008', b'1'),
('C1500285', 'MTH 1009', b'1'),
('C1500285', 'CSC 1017', b'0'),
('C1500285', 'CSC 2018', b'0'),
('C1500285', 'CSC 2019', b'0'),
('C1500285', 'CSC 2021', b'0'),
('C1500285', 'CSC 2022', b'0'),
('C1500285', 'CSC 2023', b'0'),
('C1500285', 'CSC 3015', b'0'),
('C1500285', 'CSC 3016', b'0'),
('C1500285', 'CSC 3017', b'0'),
('C1500285', 'MPU 2163', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `subjects_all`
--

CREATE TABLE `subjects_all` (
  `COURSE CODE` varchar(15) NOT NULL,
  `COURSE NAME` varchar(99) NOT NULL,
  `CREDIT HOURS` int(1) NOT NULL,
  `PREREQUISITE(S)` varchar(199) NOT NULL,
  `PROGRAM` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects_all`
--

INSERT INTO `subjects_all` (`COURSE CODE`, `COURSE NAME`, `CREDIT HOURS`, `PREREQUISITE(S)`, `PROGRAM`) VALUES
('CSC 1015', 'Introduction to Computer and Application', 3, 'None', 'DCSMY'),
('CSC 1016', 'Problem Solving and Programming', 4, 'None', 'DCSMY'),
('CSC 1017', 'System Analysis and Design', 3, '	\r\nCSC 1015 Introduction to Computer and Application', 'DCSMY'),
('CSC 1018', 'Programming in C++', 4, '	\r\nCSC 1016 Introduction to Problem Solving and Programming', 'DCSMY'),
('CSC 1019', 'Computer System', 3, 'CSC 1015 Introduction to Computer and Application', 'DCSMY'),
('CSC 2015', 'Introduction to Database', 3, 'MTH 1009 Discrete Mathematics', 'DCSMY'),
('CSC 2016', 'Programming with Java 1', 4, 'CSC 1016 Introduction to Problem Solving and Programming', 'DCSMY'),
('CSC 2017', 'Data Structures', 3, 'CSC 1018 Programming in C++', 'DCSMY'),
('CSC 2018', 'Operating Systems', 4, 'CSC 1019 Computer System', 'DCSMY'),
('CSC 2019', 'Multimedia Technology', 3, 'None', 'DCSMY'),
('CSC 2020', 'Internet Technology', 3, 'CSC 1015 Introduction to Computer and Application', 'DCSMY'),
('CSC 2021', 'Object-Oriented Analysis and Design', 3, 'CSC 1017 System Analysis and Design,CSC 2016 Programming with Java 1', 'DCSMY'),
('CSC 2022', 'Programming with Java 2', 4, 'CSC 2016 Programming with Java 1', 'DCSMY'),
('CSC 2023', 'Web Programming in Java', 4, 'CSC 2022 Programming with Java 2', 'DCSMY'),
('CSC 2026', 'Data Communication and Networking', 3, 'CSC 1019 Computer System', 'DCSMY'),
('CSC 3015', 'Network Programming Essentials', 4, 'CSC 1019 Computer System, CSC 2022 Programming with Java 2', 'DCSMY'),
('CSC 3016', 'Essence of Linux', 4, 'CSC 1019 Computer System', 'DCSMY'),
('CSC 3017', 'Software Project', 4, 'CSC2015 Introduction to Database, CSC2021 Object Oriented Analysis and Design, CSC2022 Programming with Java II', 'DCSMY'),
('ENL 1005', 'English', 3, 'None', 'DCSMY'),
('ENL 1006', 'Communication Skills', 3, 'None', 'DCSMY'),
('MPU 2163', 'Pengajian Malaysia', 3, 'None', 'DCSMY'),
('MPU 2283', 'Introduction to Entrepreneurial Behavior', 3, 'None', 'DCSMY'),
('MPU 2382', 'Comparative Religion', 3, 'None', 'DCSMY'),
('MPU 2383', 'Community Services', 2, 'None', 'DCSMY'),
('MTH 1008', 'Computing Mathematics', 3, 'None', 'DCSMY'),
('MTH 1009', 'Discrete Mathematics', 3, 'MTH 1008 Computing  Mathematics', 'DCSMY');

-- --------------------------------------------------------

--
-- Table structure for table `subjects_name`
--

CREATE TABLE `subjects_name` (
  `COURSE CODE` varchar(15) NOT NULL,
  `COURSE NAME` varchar(99) NOT NULL,
  `PROGRAM` varchar(99) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects_name`
--

INSERT INTO `subjects_name` (`COURSE CODE`, `COURSE NAME`, `PROGRAM`) VALUES
('CSC 1015', 'Introduction to Computer and Application', 'DCSMY'),
('CSC 1016', 'Problem Solving and Programming', 'DCSMY'),
('CSC 1017', 'System Analysis and Design', 'DCSMY'),
('CSC 1018', 'Programming in C++', 'DCSMY'),
('CSC 1019', 'Computer System', 'DCSMY'),
('CSC 2015', 'Introduction to Database', 'DCSMY'),
('CSC 2016', 'Programming with Java 1', 'DCSMY'),
('CSC 2017', 'Data Structures', 'DCSMY'),
('CSC 2018', 'Operating Systems', 'DCSMY'),
('CSC 2019', 'Multimedia Technology', 'DCSMY'),
('CSC 2020', 'Internet Technology', 'DCSMY'),
('CSC 2021', 'Object-Oriented Analysis and Design', 'DCSMY'),
('CSC 2022', 'Programming with Java 2', 'DCSMY'),
('CSC 2023', 'Web Programming in Java', 'DCSMY'),
('CSC 2026', 'Data Communication and Networking', 'DCSMY'),
('CSC 3015', 'Network Programming Essentials', 'DCSMY'),
('CSC 3016', 'Essence of Linux', 'DCSMY'),
('CSC 3017', 'Software Project', 'DCSMY'),
('ENL 1005', 'English', 'DCSMY'),
('ENL 1006', 'Communication Skills', 'DCSMY'),
('MPU 2163', 'Pengajian Malaysia', 'DCSMY'),
('MPU 2283', 'Introduction to Entrepreneurial Behavior', 'DCSMY'),
('MPU 2382', 'Comparative Religion', 'DCSMY'),
('MPU 2383', 'Community Services', 'DCSMY'),
('MTH 1008', 'Computing Mathematics', 'DCSMY'),
('MTH 1009', 'Discrete Mathematics', 'DCSMY');

-- --------------------------------------------------------

--
-- Table structure for table `subjects_prereq`
--

CREATE TABLE `subjects_prereq` (
  `COURSE CODE` varchar(20) NOT NULL,
  `PREREQUISITE1` varchar(20) NOT NULL,
  `PREREQUISITE2` varchar(20) NOT NULL,
  `PREREQUISITE3` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects_prereq`
--

INSERT INTO `subjects_prereq` (`COURSE CODE`, `PREREQUISITE1`, `PREREQUISITE2`, `PREREQUISITE3`) VALUES
('CSC 1015', 'None', 'None', 'None'),
('CSC 1016', 'None', 'None', 'None'),
('CSC 1017', 'CSC 1015', 'None', 'None'),
('CSC 1018', 'CSC 1016', 'None', 'None'),
('CSC 1019', 'CSC 1015', 'None', 'None'),
('CSC 2015', 'MTH 1009', 'None', 'None'),
('CSC 2016', 'CSC 1016', 'None', 'None'),
('CSC 2017', 'CSC 1018', 'None', 'None'),
('CSC 2018', 'CSC 1019', 'None', 'None'),
('CSC 2019', 'None', 'None', 'None'),
('CSC 2020', 'CSC 1015', 'None', 'None'),
('CSC 2021', 'CSC 1017', 'CSC 2016', 'None'),
('CSC 2022', 'CSC 2016', 'None', 'None'),
('CSC 2023', 'CSC 2022', 'None', 'None'),
('CSC 2026', 'CSC 1019', 'None', 'None'),
('CSC 3015', 'CSC 1019', 'CSC 2022', 'None'),
('CSC 3016', 'CSC 1019', 'None', 'None'),
('CSC 3017', 'CSC 2015', 'CSC 2021', 'CSC 2022'),
('ENL 1005', 'None', 'None', 'None'),
('ENL 1006', 'None', 'None', 'None'),
('MPU 2163', 'None', 'None', 'None'),
('MPU 2283', 'None', 'None', 'None'),
('MPU 2382', 'None', 'None', 'None'),
('MPU 2383', 'None', 'None', 'None'),
('MTH 1008', 'None', 'None', 'None'),
('MTH 1009', 'MTH 1008', 'None', 'None');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student_info`
--
ALTER TABLE `student_info`
  ADD PRIMARY KEY (`STUDENT ID`);

--
-- Indexes for table `subjects_name`
--
ALTER TABLE `subjects_name`
  ADD PRIMARY KEY (`COURSE CODE`);

--
-- Indexes for table `subjects_prereq`
--
ALTER TABLE `subjects_prereq`
  ADD UNIQUE KEY `COURSE CODE` (`COURSE CODE`) USING BTREE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
