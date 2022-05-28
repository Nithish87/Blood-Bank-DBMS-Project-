-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2022 at 05:30 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `redvault`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Email` varchar(50) NOT NULL,
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `Phone` bigint(11) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Email`, `FirstName`, `LastName`, `Phone`, `Gender`, `Password`) VALUES
('adam@gmail.com', 'Adam', 'Fernandez', 4785126470, 'Male', 'adam12345'),
('prathijna@gmail.com', 'Prathijna', 'Shetty', 5478964125, 'Female', 'Shetty1234');

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--

CREATE TABLE `blood` (
  `Name` varchar(5) NOT NULL,
  `Quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood`
--

INSERT INTO `blood` (`Name`, `Quantity`) VALUES
('A+', 7.2),
('A-', 2),
('AB+', 3.25),
('AB-', 2),
('B+', 4.5),
('B-', 3.3),
('O+', 2.225),
('O-', 1);

-- --------------------------------------------------------

--
-- Table structure for table `camp`
--

CREATE TABLE `camp` (
  `CampID` int(11) NOT NULL,
  `CampDate` date NOT NULL,
  `Location` varchar(50) NOT NULL,
  `EmpID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `camp`
--

INSERT INTO `camp` (`CampID`, `CampDate`, `Location`, `EmpID`) VALUES
(1, '2021-12-04', 'Mangalore', 'adam@gmail.com'),
(2, '2022-01-31', 'Udupi', 'prathijna@gmail.com'),
(3, '2022-02-11', 'Karkala', 'adam@gmail.com'),
(4, '2022-02-19', 'Karkala', 'adam@gmail.com'),
(5, '2022-01-29', 'Mulki', 'prathijna@gmail.com'),
(6, '2022-01-28', 'Bengaluru', 'prathijna@gmail.com'),
(10, '2022-01-30', 'Mumbai', 'adam@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `donated`
--

CREATE TABLE `donated` (
  `DonationID` int(11) NOT NULL,
  `CampID` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Quantity` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `donated`
--

INSERT INTO `donated` (`DonationID`, `CampID`, `UserID`, `Quantity`) VALUES
(1, 1, 'stark@gmail.com', 300),
(3, 6, 'stark@gmail.com', 200),
(4, 5, 'nithishprabhu@gmail.com', 250),
(6, 5, 'wanebruce@wane.com', 200),
(7, 10, 'spider@gmail.com', 250),
(8, 10, 'wanda@yahoo.in', 300),
(9, 10, 'katarina@gmail.com', 200),
(10, 10, 'strange@kamartaj.us', 225);

-- --------------------------------------------------------

--
-- Table structure for table `register`
--

CREATE TABLE `register` (
  `RegistrationID` int(11) NOT NULL,
  `CampID` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `register`
--

INSERT INTO `register` (`RegistrationID`, `CampID`, `UserID`) VALUES
(34, 4, 'stark@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `FirstName` varchar(20) NOT NULL,
  `LastName` varchar(20) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(10) NOT NULL,
  `Phone` bigint(11) NOT NULL,
  `Address` varchar(50) NOT NULL,
  `BloodType` varchar(5) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`FirstName`, `LastName`, `DateOfBirth`, `Gender`, `Phone`, `Address`, `BloodType`, `Email`, `Password`) VALUES
('Katarina', 'Holmes', '1994-06-17', 'Female', 4578941258, 'Delhi', 'A+', 'katarina@gmail.com', 'katarina'),
('Nithish', 'Prabhu', '2001-09-08', 'Male', 9448512916, 'Udupi', 'A+', 'nithishprabhu@gmail.com', 'nithish87'),
('Peter', 'Parker', '2001-06-14', 'Male', 1247854126, 'Queens', 'AB+', 'spider@gmail.com', 'spiderman'),
('Tony', 'Stark', '2022-01-05', 'Male', 1234567891, 'Bengaluru', 'A+', 'stark@gmail.com', 'tonystark'),
('Stephen', 'Strange', '1983-10-13', 'Male', 1478523697, 'NewYork', 'O+', 'strange@kamartaj.us', 'timestone'),
('Scarlet', 'Witch', '1984-02-10', 'Female', 4561257894, 'London', 'B-', 'wanda@yahoo.in', 'darkhold'),
('Bruce', 'Wane', '1982-06-08', 'Male', 1245789541, 'Gotham', 'O+', 'wanebruce@wane.com', 'brucewane');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Email`);

--
-- Indexes for table `blood`
--
ALTER TABLE `blood`
  ADD PRIMARY KEY (`Name`);

--
-- Indexes for table `camp`
--
ALTER TABLE `camp`
  ADD PRIMARY KEY (`CampID`),
  ADD KEY `EmpID` (`EmpID`);

--
-- Indexes for table `donated`
--
ALTER TABLE `donated`
  ADD PRIMARY KEY (`DonationID`,`CampID`,`UserID`),
  ADD KEY `CampID` (`CampID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `register`
--
ALTER TABLE `register`
  ADD PRIMARY KEY (`RegistrationID`,`CampID`,`UserID`),
  ADD KEY `CampID` (`CampID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`Email`),
  ADD KEY `BloodType` (`BloodType`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `camp`
--
ALTER TABLE `camp`
  MODIFY `CampID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `donated`
--
ALTER TABLE `donated`
  MODIFY `DonationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `register`
--
ALTER TABLE `register`
  MODIFY `RegistrationID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `camp`
--
ALTER TABLE `camp`
  ADD CONSTRAINT `camp_ibfk_1` FOREIGN KEY (`EmpID`) REFERENCES `admin` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `donated`
--
ALTER TABLE `donated`
  ADD CONSTRAINT `donated_ibfk_1` FOREIGN KEY (`CampID`) REFERENCES `camp` (`CampID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `donated_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `register`
--
ALTER TABLE `register`
  ADD CONSTRAINT `register_ibfk_1` FOREIGN KEY (`CampID`) REFERENCES `camp` (`CampID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `register_ibfk_2` FOREIGN KEY (`UserID`) REFERENCES `user` (`Email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`BloodType`) REFERENCES `blood` (`Name`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
