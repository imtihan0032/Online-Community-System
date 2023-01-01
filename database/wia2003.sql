-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2022 at 05:37 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wia2003`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `Username`, `Password`) VALUES
(1, 'lea', '0000'),
(2, 'kin', '2222');

-- --------------------------------------------------------

--
-- Table structure for table `covidstatus`
--

CREATE TABLE `covidstatus` (
  `ReportID` int(11) NOT NULL,
  `stat` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `covidstatus`
--

INSERT INTO `covidstatus` (`ReportID`, `stat`) VALUES
(62, 'Symptomatic'),
(70, 'Recovered'),
(71, 'Symptomatic'),
(72, 'Symptomatic'),
(73, 'Recovered'),
(74, 'Symptomatic'),
(76, 'Symptomatic');

-- --------------------------------------------------------

--
-- Table structure for table `facilities`
--

CREATE TABLE `facilities` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `openhours` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facilities`
--

INSERT INTO `facilities` (`id`, `name`, `location`, `openhours`, `category`, `image`) VALUES
(1, 'McDonalds', 'KL Gateway', '10.00am-10.00pm', 'f&b', 'mcdonalds.png'),
(2, 'Watsons', 'Midvalley', '10.00am-10.00pm', 'store', 'watsons.png'),
(3, 'Pizza Hut', 'Midvalley', '10.30am-9.30pm', 'f&b', 'pizzahut.png'),
(4, 'Daiso Japan', 'Midvalley', '10.30am-9.30pm', 'store', 'daiso.png'),
(5, 'Midvalley', ' Kuala Lumpur', '10.00am-10.00pm', 'mall', 'midvalley.png'),
(6, 'Post Malaysia', 'Petaling Jaya', '8.30am-5.30pm', 'faci', 'posmalaysia.png'),
(7, 'KL Gateway Mall', 'Kuala Lumpur', '10.00am-10.00pm', 'mall', 'klgateway.png'),
(8, 'Rapid Bus Stop', 'BRT Sunway Depot', '5.30am-12.00am', 'faci', 'bus.png'),
(9, 'Caltex Sunway', 'Petaling Jaya', '24 hours', 'faci', 'caltex.png'),
(10, 'Petron ', 'Petaling Jaya', '6.00am-12.00am', 'faci', 'petron.png'),
(11, 'Shell', 'Petaling Jaya', '24 hours', 'faci', 'shell.png'),
(12, 'dobiQueen', 'Bandar Putra Permai', '8.30am-6.00pm', 'faci', 'laundry.png'),
(13, 'Baskin Robbins', 'Midvalley', '10.30am-9.30am', 'f&b', 'baskinrobbins.png'),
(14, 'A&W', 'Midvalley', '10.00am-10.00pm', 'f&b', 'a&w.png'),
(15, 'Zus Coffee', 'Midvalley', '10.00am-10.00pm', 'f&b', 'zus.png'),
(16, 'Krispy Kreme', 'Midvalley', '10.00am-10.00pm', 'f&b', 'krispy.png'),
(17, 'Asian Express', 'KL Gateway', '10.00am-10.00pm', 'f&b', 'asian.png'),
(18, 'Hello Sushi', 'KL Gateway', '10.00am-10.00pm', 'f&b', 'sushi.png'),
(19, 'Burger King', 'KL Gateway', '10.00am-10.00pm', 'f&b', 'burgerking.png'),
(20, 'Hokkaido Tarts', 'KL Gateway', '10.00am-10.00pm', 'f&b', 'hokkaido.png'),
(21, '4Fingers', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', '4fingers.png'),
(22, 'Auntie Anne\'s', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'auntieann.png'),
(23, 'Sunway Pyramid', 'Petaling Jaya', '10.00am-10.00pm', 'mall', 'pyramid.png'),
(24, 'Bread History', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'bread.png'),
(25, 'Boost Juice', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'boost.png'),
(26, 'City Milk', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'citymilk.png'),
(27, 'Dragon-i', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'dragoni.png'),
(28, 'Famous Amos', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'famousamos.png'),
(29, 'Garrett Popcorn', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'garrett.png'),
(30, 'Gong Cha', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'gongcha.png'),
(31, 'Haidilao HotPot', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'haidilao.png'),
(32, 'Jollibee', 'Sunway Pyramid', '10.00am-10.00pm', 'f&b', 'jollibee.png'),
(33, 'MR. DIY', 'Sunway Pyramid', '10.00am-10.00pm', 'store', 'mrdiy.png'),
(34, 'Mr. Dollar', 'Sunway Pyramid', '10.00am-10.00pm', 'store', 'mrdollar.png'),
(35, 'MUJI', 'Sunway Pyramid', '10.00am-10.00pm', 'store', 'muji.png'),
(36, 'Caring', 'Sunway Pyramid', '10.00am-10.00pm', 'store', 'caring.png'),
(37, 'Guardian', 'Sunway Pyramid', '10.00am-10.00pm', 'store', 'guardian.png'),
(38, 'Village Grocer', 'KL Gateway', '10.00am-10.00pm', 'store', 'villagegrocer.png'),
(39, '7 Eleven', 'Sunway Pyramid', '24 hours', 'store', '7eleven.png'),
(40, 'FamilyMart ', 'Sunway Pyramid', '10.00am-10.00pm', 'store', 'familymart.png'),
(41, 'MiX Store', 'Midvalley', '10.00am-10.00pm', 'store', 'mix.png'),
(42, 'AEON', 'Midvalley', '10.00am-10.00pm', 'store', 'aeon.png');

-- --------------------------------------------------------

--
-- Table structure for table `quarantinedate`
--

CREATE TABLE `quarantinedate` (
  `ReportID` int(11) NOT NULL,
  `StartDate` date NOT NULL,
  `EndDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `quarantinedate`
--

INSERT INTO `quarantinedate` (`ReportID`, `StartDate`, `EndDate`) VALUES
(62, '2022-06-15', '2022-06-28'),
(70, '0000-00-00', '0000-00-00'),
(71, '2022-06-21', '2022-06-30'),
(72, '2022-06-23', '2022-06-28'),
(73, '0000-00-00', '0000-00-00'),
(74, '2022-06-20', '2022-06-30'),
(76, '2022-07-06', '2022-07-07');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `ReportID` int(11) NOT NULL,
  `ResidentID` int(11) NOT NULL,
  `SubmittedDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`ReportID`, `ResidentID`, `SubmittedDate`) VALUES
(62, 1, '2022-06-18'),
(70, 1, '2022-06-19'),
(71, 1, '2022-06-19'),
(72, 2, '2022-06-20'),
(73, 2, '2022-06-20'),
(74, 1, '2022-06-20'),
(76, 1, '2022-06-20');

-- --------------------------------------------------------

--
-- Table structure for table `resident`
--

CREATE TABLE `resident` (
  `ResidentID` int(11) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Block` varchar(255) NOT NULL,
  `Unit` varchar(255) NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Age` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Occupation` varchar(255) NOT NULL,
  `Description` text NOT NULL,
  `Image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `resident`
--

INSERT INTO `resident` (`ResidentID`, `Name`, `Block`, `Unit`, `PhoneNumber`, `Email`, `Username`, `Password`, `Age`, `Nationality`, `Occupation`, `Description`, `Image`) VALUES
(1, 'Nima Razavi', 'A', '11', '01160566796', 'razavinima37@gmail.com', 'neo', '1111', '21', 'Iranian', 'Test', 'All good', 'pic.jpeg'),
(2, 'Samiul Hoque Sami', 'A', '13', '0122103330', 'sami@isaguy444.com', 'sam', 'WIA2003', '21', 'Bangladeshi', 'Student', 'Oh yessss I\'m here!', 'pic2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `TaskID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `Task` varchar(250) NOT NULL,
  `Deadline` date NOT NULL,
  `Description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`TaskID`, `AdminID`, `Task`, `Deadline`, `Description`) VALUES
(2, 1, 'Check Block A Status', '2022-06-18', 'Visit block A sometime in the afternoon'),
(3, 1, 'Check User Status', '2022-07-20', 'Analyse the reports tonight'),
(4, 1, 'Send Service Email', '2022-06-20', 'Send service email to Paul'),
(5, 1, 'Check Email', '2022-10-27', 'Check important email');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `covidstatus`
--
ALTER TABLE `covidstatus`
  ADD KEY `ReportID` (`ReportID`);

--
-- Indexes for table `facilities`
--
ALTER TABLE `facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quarantinedate`
--
ALTER TABLE `quarantinedate`
  ADD KEY `quarantinedate_ibfk_1` (`ReportID`);

--
-- Indexes for table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`ReportID`),
  ADD KEY `ResidentID` (`ResidentID`);

--
-- Indexes for table `resident`
--
ALTER TABLE `resident`
  ADD PRIMARY KEY (`ResidentID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`TaskID`),
  ADD KEY `AdminID` (`AdminID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `facilities`
--
ALTER TABLE `facilities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `report`
--
ALTER TABLE `report`
  MODIFY `ReportID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `resident`
--
ALTER TABLE `resident`
  MODIFY `ResidentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `TaskID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `covidstatus`
--
ALTER TABLE `covidstatus`
  ADD CONSTRAINT `covidstatus_ibfk_1` FOREIGN KEY (`ReportID`) REFERENCES `report` (`ReportID`) ON DELETE CASCADE;

--
-- Constraints for table `quarantinedate`
--
ALTER TABLE `quarantinedate`
  ADD CONSTRAINT `quarantinedate_ibfk_1` FOREIGN KEY (`ReportID`) REFERENCES `report` (`ReportID`) ON DELETE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `report_ibfk_1` FOREIGN KEY (`ResidentID`) REFERENCES `resident` (`ResidentID`) ON DELETE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`AdminID`) REFERENCES `admin` (`AdminID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
