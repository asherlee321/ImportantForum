-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 15, 2018 at 12:19 PM
-- Server version: 5.7.24-0ubuntu0.18.04.1
-- PHP Version: 7.2.12-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ForumDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `TextData`
--

CREATE TABLE `TextData` (
  `id` int(11) NOT NULL,
  `userData` text,
  `userID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `TextData`
--

INSERT INTO `TextData` (`id`, `userData`, `userID`) VALUES
(1, 'Hi guys this is the first post!', 2),
(2, 'you suck', 2),
(3, '<b>test</b>', 2),
(4, 'another test', 2),
(5, 'what is my life\r\n', 21),
(6, 'what is it?', 2),
(7, 'I dunno', 2);

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(25) DEFAULT NULL,
  `UserPassword` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `UserName`, `UserPassword`) VALUES
(1, 'Bernie', 'Pickell'),
(2, 'asher', '2302'),
(3, 'BEr', 'Pickell123'),
(4, 'test', 'test'),
(5, 'JIMMY', 'JIMMY'),
(6, '', ''),
(7, 'john', 'smith'),
(8, 'asher is gay', 'big'),
(9, 'James', '1234'),
(10, 'urgAY', 'GA'),
(11, 'sexy meister69420', 'sex'),
(12, 'newUser', '1234'),
(13, 'testUser1', '12345'),
(14, 'JimmyBob', 'fuckyou'),
(15, 'thisistest', '2302'),
(16, '1', '2'),
(17, 'gamer', 'gaming'),
(18, 'benPickell', 'test123'),
(19, 'testtesttest', '4321'),
(20, 'what', 'what'),
(21, 'nounocards', 'thisisgay'),
(22, 'ashman', '4321');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `TextData`
--
ALTER TABLE `TextData`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `TextData`
--
ALTER TABLE `TextData`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
