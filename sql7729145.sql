-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: sql7.freesqldatabase.com
-- Generation Time: Sep 03, 2024 at 07:27 PM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 7.0.33-0ubuntu0.16.04.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sql7729145`
--

-- --------------------------------------------------------

--
-- Table structure for table `Cart`
--

CREATE TABLE `Cart` (
  `ID` int(100) NOT NULL,
  `User_ID` int(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` int(100) NOT NULL,
  `Quantity` int(100) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Cart`
--

INSERT INTO `Cart` (`ID`, `User_ID`, `Name`, `Price`, `Quantity`, `Image`, `Author`) VALUES
(1, 2, 'Babel', 310, 2, 'babel.jpg', ''),
(2, 2, 'The Colour Out Of Space', 84, 1, 'the-colour-out-of-space9780241443934-864139_1800x1800.jpg', 'H.P. Lovecraft');

-- --------------------------------------------------------

--
-- Table structure for table `Message`
--

CREATE TABLE `Message` (
  `ID` int(100) NOT NULL,
  `User_ID` int(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Number` varchar(16) NOT NULL,
  `Message` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `ID` int(100) NOT NULL,
  `User_ID` int(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Number` varchar(16) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Method` varchar(50) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Total_Products` varchar(500) NOT NULL,
  `Total_Price` int(100) NOT NULL,
  `Placed_On` varchar(50) NOT NULL,
  `Payment_Status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Products`
--

CREATE TABLE `Products` (
  `ID` int(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Price` int(100) NOT NULL,
  `Image` varchar(255) NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Sale` varchar(50) NOT NULL DEFAULT 'no',
  `New_Arrival` varchar(50) NOT NULL DEFAULT 'no',
  `Author` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Products`
--

INSERT INTO `Products` (`ID`, `Name`, `Price`, `Image`, `Category`, `Sale`, `New_Arrival`, `Author`) VALUES
(1, 'Babel', 310, 'babel.jpg', 'Fantasy & Sci-Fi', 'no', 'yes', 'R.F. Kuang'),
(2, 'American Gods', 290, 'americangods.jpg', 'Fantasy & Sci-Fi', 'yes', 'no', 'Neil Gaiman'),
(3, 'Ready Player One', 280, 'playerone.jpg', 'Fantasy & Sci-Fi', 'no', 'no', 'Ernest Cline'),
(4, 'Lord of the Rings', 465, 'lordrings.jpg', 'Fantasy & Sci-Fi', 'no', 'yes', 'J. R. R. Tolkien'),
(5, 'A Darker Shade of Magic', 305, 'darkershademagic.jpg', 'Fantasy & Sci-Fi', 'no', 'no', 'V.E. Schwab'),
(6, 'First Lie Wins', 405, 'firstliewins.jpg', 'Crime & Thriller', 'no', 'yes', 'Ashley Elston'),
(7, 'Family Remains', 280, 'familyremains.jpg', 'Crime & Thriller', 'yes', 'yes', 'Lisa Jewell'),
(8, 'Never Lie', 302, 'neverlie.jpg', 'Crime & Thriller', 'no', 'no', 'Freida McFadden'),
(9, 'Atonement', 280, 'atonement.jpg', 'pick', 'yes', 'no', 'Ian McEwan'),
(10, 'Changeling', 270, 'changeling.jpg', 'Crime & Thriller', 'no', 'yes', 'Victor LaValle'),
(11, 'Why Nations Fail', 365, 'nationsfail.jpg', 'Historical', 'no', 'no', 'Daron Acemoglu'),
(12, 'Rich State, Poor State', 370, 'richstate.jpg', 'Historical', 'no', 'yes', 'Greg Mills'),
(13, 'SPQR', 395, 'spqr.jpg', 'Historical', 'no', 'no', 'Mary Beard'),
(14, 'American Prometheus', 395, 'promethius.jpg', 'Historical', 'no', 'no', 'Kai Bird'),
(15, 'Jerusalem', 430, 'jeru.jpg', 'Historical', 'no', 'no', 'Simon Sebag Montefiore'),
(16, 'The Eyes of Darkness', 99, 'eyesdarkness.jpg', 'Horror', 'yes', 'no', 'Dean Koontz'),
(17, 'Frankenstein', 49, 'frankenstein.jpg', 'Horror', 'yes', 'no', 'Mary Shelley'),
(18, 'Devils Day', 195, 'devils-day9781473619883-968956_1800x1800.jpg', 'Horror', 'yes', 'no', 'Andrew Michael Hurley'),
(19, 'City Of Ghosts', 156, 'city-of-ghosts9781787394940-420802_1800x1800.jpg', 'Horror', 'yes', 'yes', 'Ben Creed'),
(20, 'The Colour Out Of Space', 84, 'the-colour-out-of-space9780241443934-864139_1800x1800.jpg', 'Horror', 'yes', 'no', 'H.P. Lovecraft');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `ID` int(100) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `UserType` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`ID`, `Name`, `Email`, `Password`, `UserType`) VALUES
(1, 'aministrator', 'administrator@admin.com', '@dMinistrator88', 'admin'),
(2, 'user', 'user@gmail.com', 'the@User1', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Cart`
--
ALTER TABLE `Cart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Products`
--
ALTER TABLE `Products`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Cart`
--
ALTER TABLE `Cart`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Message`
--
ALTER TABLE `Message`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Products`
--
ALTER TABLE `Products`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `ID` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
