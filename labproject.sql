-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2015 at 12:43 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `labproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `country`
--
-- Creation: Apr 14, 2015 at 04:40 AM
--

CREATE TABLE IF NOT EXISTS `country` (
  `Country_Name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`Country_Name`) VALUES
('Afghanistan'),
('Albania'),
('Algeria'),
('Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--
-- Creation: May 05, 2015 at 11:08 AM
--

CREATE TABLE IF NOT EXISTS `friend` (
  `Profile_Id` int(5) NOT NULL,
  `Friend_Profile_Id` int(5) NOT NULL,
  `Friend_From` date NOT NULL,
  `IsAdded` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `friend`:
--   `Friend_Profile_Id`
--       `profile` -> `Profile_Id`
--   `Profile_Id`
--       `profile` -> `Profile_Id`
--

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`Profile_Id`, `Friend_Profile_Id`, `Friend_From`, `IsAdded`) VALUES
(27, 20, '2015-05-17', 1),
(20, 28, '2015-05-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--
-- Creation: Apr 16, 2015 at 02:49 AM
--

CREATE TABLE IF NOT EXISTS `location` (
`Location_Id` int(3) NOT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `State` varchar(20) DEFAULT NULL,
  `City` varchar(20) NOT NULL,
  `Country_Name` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `location`:
--   `Country_Name`
--       `country` -> `Country_Name`
--

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`Location_Id`, `Address`, `State`, `City`, `Country_Name`) VALUES
(20, '137/6/1 Middle Paicpara', 'Mirpur-1', 'Dhaka', 'Bangladesh'),
(22, '', '', '', 'Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `messege`
--
-- Creation: May 07, 2015 at 07:01 AM
--

CREATE TABLE IF NOT EXISTS `messege` (
`MessegeId` int(11) NOT NULL,
  `MessegeBody` varchar(500) NOT NULL,
  `FromId` int(11) NOT NULL,
  `ToId` int(11) NOT NULL,
  `DateTime` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `messege`:
--   `FromId`
--       `profile` -> `Profile_Id`
--   `ToId`
--       `profile` -> `Profile_Id`
--

--
-- Dumping data for table `messege`
--

INSERT INTO `messege` (`MessegeId`, `MessegeBody`, `FromId`, `ToId`, `DateTime`) VALUES
(31, 'Hello Mahfuz...', 20, 27, '2015-05-17 09:14:29'),
(32, 'Hello Rahim, How are you bro?', 27, 20, '2015-05-17 09:14:52'),
(33, 'Hello', 28, 20, '2015-05-17 12:20:45'),
(34, 'Hello again', 20, 28, '2015-05-17 12:21:03');

-- --------------------------------------------------------

--
-- Table structure for table `profile`
--
-- Creation: Apr 14, 2015 at 05:02 AM
--

CREATE TABLE IF NOT EXISTS `profile` (
`Profile_Id` int(3) NOT NULL,
  `First_Name` varchar(15) DEFAULT NULL,
  `Last_Name` varchar(15) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Religion` varchar(20) DEFAULT NULL,
  `Country` varchar(20) DEFAULT NULL,
  `Sex` varchar(10) DEFAULT NULL,
  `Location_Id` int(3) DEFAULT NULL,
  `Email` varchar(40) NOT NULL,
  `About` varchar(250) DEFAULT NULL,
  `School` varchar(50) DEFAULT NULL,
  `College` varchar(50) DEFAULT NULL,
  `Profile_photo` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `profile`:
--   `Location_Id`
--       `location` -> `Location_Id`
--

--
-- Dumping data for table `profile`
--

INSERT INTO `profile` (`Profile_Id`, `First_Name`, `Last_Name`, `DOB`, `Religion`, `Country`, `Sex`, `Location_Id`, `Email`, `About`, `School`, `College`, `Profile_photo`) VALUES
(20, 'Abdur', 'Rahim', '1993-11-04', 'Islam', 'Bangladesh', 'Male', 20, 'rahim.prsf@gmail.com', 'I love Allah.', 'Dhanmondi Govt Boys High School', 'Dhaka College', 'img/photo/2020150517041910male.png'),
(27, 'Mahfuz', 'Ur Rahman', '1992-10-29', 'Islam', 'Bangladesh', 'Male', 22, 'demoemail@example.com', 'Something about me', 'School Name', 'College Name', 'img/photo/male.png'),
(28, 'NAme', 'Last Name', '2012-05-08', 'Isalm', 'Bangladesh', 'Male', 22, 'random@example.com', 'About', 'Schol name', 'college name', 'img/photo/2820150517082410amazxing-cool-desktop-hd-images-widescreen.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--
-- Creation: May 07, 2015 at 09:00 AM
--

CREATE TABLE IF NOT EXISTS `status` (
`Status_Id` int(5) NOT NULL,
  `Status_Body` varchar(1500) NOT NULL,
  `Profile_Id` int(5) NOT NULL,
  `Date` datetime NOT NULL,
  `IsPhoto` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `status`:
--   `Profile_Id`
--       `profile` -> `Profile_Id`
--

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`Status_Id`, `Status_Body`, `Profile_Id`, `Date`, `IsPhoto`) VALUES
(38, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 20, '2015-05-17 09:02:59', 0),
(39, 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia.', 20, '2015-05-17 09:05:05', 0),
(40, 'img/photo/202015051705063713-inch-MacBook-Pro-Retina-Review-Late-2013-004.jpg', 20, '2015-05-17 09:06:37', 1),
(41, 'img/photo/2820150517081924amazing_sunset_in_vally-wallpaper-1366x768.jpg', 28, '2015-05-17 12:19:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--
-- Creation: Apr 14, 2015 at 05:30 AM
--

CREATE TABLE IF NOT EXISTS `user` (
`User_Id` int(3) NOT NULL,
  `User_name` varchar(15) NOT NULL,
  `Pass` varchar(50) NOT NULL,
  `Email` varchar(40) NOT NULL,
  `Profile_id` int(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- RELATIONS FOR TABLE `user`:
--   `Profile_id`
--       `profile` -> `Profile_Id`
--

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`User_Id`, `User_name`, `Pass`, `Email`, `Profile_id`) VALUES
(13, 'rahim373', '9733b92d7d60ecac9ad32ff7a5c87a3c', 'rahim.prsf@gmail.com', 20),
(20, 'mahfuz', '827ccb0eea8a706c4c34a16891f84e7b', 'demoemail@example.com', 27),
(21, 'Abc', '202cb962ac59075b964b07152d234b70', 'random@example.com', 28);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `country`
--
ALTER TABLE `country`
 ADD PRIMARY KEY (`Country_Name`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
 ADD KEY `Profile_Id` (`Profile_Id`), ADD KEY `Friend_Profile_Id` (`Friend_Profile_Id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
 ADD PRIMARY KEY (`Location_Id`), ADD KEY `Country_Name` (`Country_Name`);

--
-- Indexes for table `messege`
--
ALTER TABLE `messege`
 ADD PRIMARY KEY (`MessegeId`), ADD KEY `FromId` (`FromId`), ADD KEY `ToId` (`ToId`);

--
-- Indexes for table `profile`
--
ALTER TABLE `profile`
 ADD PRIMARY KEY (`Profile_Id`), ADD UNIQUE KEY `Email` (`Email`), ADD KEY `Location_Id` (`Location_Id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
 ADD PRIMARY KEY (`Status_Id`), ADD KEY `Profile_Id` (`Profile_Id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`User_Id`), ADD UNIQUE KEY `Email` (`Email`,`Profile_id`), ADD KEY `Profile_id` (`Profile_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
MODIFY `Location_Id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `messege`
--
ALTER TABLE `messege`
MODIFY `MessegeId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `profile`
--
ALTER TABLE `profile`
MODIFY `Profile_Id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
MODIFY `Status_Id` int(5) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `User_Id` int(3) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `friend`
--
ALTER TABLE `friend`
ADD CONSTRAINT `Friend_Fiend_Profile_Id_FK` FOREIGN KEY (`Friend_Profile_Id`) REFERENCES `profile` (`Profile_Id`) ON DELETE CASCADE,
ADD CONSTRAINT `Friend_Prifole_Id_FK` FOREIGN KEY (`Profile_Id`) REFERENCES `profile` (`Profile_Id`) ON DELETE CASCADE;

--
-- Constraints for table `location`
--
ALTER TABLE `location`
ADD CONSTRAINT `location_CountryName_Fk` FOREIGN KEY (`Country_Name`) REFERENCES `country` (`Country_Name`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `messege`
--
ALTER TABLE `messege`
ADD CONSTRAINT `messege_ibfk_1` FOREIGN KEY (`FromId`) REFERENCES `profile` (`Profile_Id`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `messege_ibfk_2` FOREIGN KEY (`ToId`) REFERENCES `profile` (`Profile_Id`) ON DELETE CASCADE;

--
-- Constraints for table `profile`
--
ALTER TABLE `profile`
ADD CONSTRAINT `Profile_location_fk` FOREIGN KEY (`Location_Id`) REFERENCES `location` (`Location_Id`) ON DELETE SET NULL ON UPDATE NO ACTION;

--
-- Constraints for table `status`
--
ALTER TABLE `status`
ADD CONSTRAINT `Status_Profile_Id_FK` FOREIGN KEY (`Profile_Id`) REFERENCES `profile` (`Profile_Id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
ADD CONSTRAINT `User_Profile_FK` FOREIGN KEY (`Profile_id`) REFERENCES `profile` (`Profile_Id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
