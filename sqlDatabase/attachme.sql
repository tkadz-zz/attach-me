-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 06, 2022 at 01:55 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attachme`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `vacancyUID` varchar(225) NOT NULL,
  `readStatus` int(11) NOT NULL,
  `dateRead` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `userID`, `companyID`, `vacancyUID`, `readStatus`, `dateRead`, `dateAdded`, `lastUpdated`, `status`) VALUES
(9, 28, 38, 'bbe015b3c2e525030b5d185f4acc9f78', 1, '2022-11-05 17:11:11', '2022-11-05 16:11:05', '2022-11-05 16:34:11', 1),
(11, 28, 38, 'c89f9a9c7aa20c5975bc6d4a259d3e66', 1, '2022-11-05 17:11:30', '2022-11-05 16:11:14', '2022-11-05 16:55:30', 1),
(12, 28, 200, '265d2b4dfff70b886c327546d7e3174c', 0, '2022-11-06 01:34:25', '2022-11-05 16:11:20', '2022-11-06 00:34:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attachmentReports`
--

CREATE TABLE `attachmentReports` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `file` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `subID` int(11) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `dateStart` varchar(225) NOT NULL,
  `dateEnd` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `userID`, `companyID`, `subID`, `dateAdded`, `dateStart`, `dateEnd`, `lastUpdated`, `status`) VALUES
(10, 23, 38, 2, '2022-11-04 19:11:23', '2022-11-05', '2022-11-15', '2022-11-04 18:15:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `website` varchar(1000) NOT NULL,
  `avatar` varchar(225) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `bio` varchar(10000) NOT NULL,
  `LastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `user_id`, `name`, `phone`, `email`, `website`, `avatar`, `address`, `bio`, `LastUpdated`) VALUES
(1, 200, 'Company1', '000000000', 'companyemail@g.co', 'N/A', '../profileImages/63518225dd2b78.86541092.jpg', 'N/A', 'N/A', '2022-10-21 20:37:57'),
(2, 38, 'ECONET', '9887969', 'econet@gmail.com', 'N/A', '', 'runhare house', '', '2022-09-09 17:07:55');

-- --------------------------------------------------------

--
-- Table structure for table `company_sub_accounts`
--

CREATE TABLE `company_sub_accounts` (
  `id` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `sex` varchar(225) NOT NULL,
  `avatar` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `department` varchar(225) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL,
  `role` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_sub_accounts`
--

INSERT INTO `company_sub_accounts` (`id`, `companyID`, `name`, `surname`, `sex`, `avatar`, `email`, `phone`, `password`, `department`, `description`, `dateAdded`, `lastUpdate`, `status`, `role`) VALUES
(1, 38, 'Emanuel', 'Chindoza', 'MALE', '', '', '', '$2y$10$AnebUYscsEfTAOFllNkJreZPbiiVhs7yMLzKO9VsdgIV4PD3epEfm', 'Accounting', '', '2022-05-19 14:56:45', '2022-10-20 16:13:38', 0, 'supervisor'),
(2, 38, 'EVELYNN', 'MADZIBA', 'FEMALE', '../profileImages/63581ba6946d24.41378029.jpg', 'evelyn@gmail.com', '0783883392', '$2y$10$AnebUYscsEfTAOFllNkJreZPbiiVhs7yMLzKO9VsdgIV4PD3epEfm', 'Humanitarians', '', '2022-05-19 14:56:45', '2022-10-25 17:23:50', 1, 'admin'),
(3, 38, 'Cherity', 'Winji', 'MALE', '../profileImages/63518225dd2b78.86541092.jpg', '', '', '$2y$10$N.FDVP5VvHlQSBabcgQCcOVin6S2rGbxOazROcHdNjz74spu7UJ5C', 'Information Systems', '', '2022-05-19 14:56:45', '2022-10-20 17:15:17', 1, 'adminSupervisor'),
(4, 200, 'Ronald', 'Mukute', 'MALE', '../profileImages/63518d2e745537.61004449.jpg', '', '', '$2y$10$N.FDVP5VvHlQSBabcgQCcOVin6S2rGbxOazROcHdNjz74spu7UJ5C', 'Information Systems', '', '2022-05-19 14:56:45', '2022-10-22 10:27:53', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `cv`
--

CREATE TABLE `cv` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `file` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cv`
--

INSERT INTO `cv` (`id`, `userID`, `file`, `dateAdded`, `lastUpdated`) VALUES
(11, 23, '../cv/6366f272c2be79.63639583.docx', '2022-11-06 00:32:02', '2022-11-05 23:32:02'),
(12, 28, '../cv/6366f70ef0aa76.20355874.doc', '2022-11-06 00:51:42', '2022-11-05 23:51:42');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `website` varchar(225) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `avatar` varchar(225) NOT NULL,
  `dateJoined` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`id`, `userID`, `name`, `phone`, `email`, `website`, `address`, `avatar`, `dateJoined`, `lastUpdated`) VALUES
(1, 3, 'Great Zimbabwe University', '4228844', 'info@gzu.ac.zw', 'http://www.gzu.co.zw', 'Masvingo, Harera ', '', '2021-02-02', '2022-11-04 18:39:30'),
(2, 2, 'Midlands State University', '4228844', 'info@msu.ac.zw', 'http://www.msu.co.zw', 'Gweru ', '', '2021-02-02', '2022-11-04 18:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `logbooks`
--

CREATE TABLE `logbooks` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `file` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `senderID` int(11) NOT NULL,
  `receiverID` int(11) NOT NULL,
  `notyMsgID` int(11) NOT NULL,
  `notyType` int(11) NOT NULL,
  `notyStatus` int(11) NOT NULL,
  `notyDelStatus` int(11) NOT NULL,
  `dateReceived` varchar(225) NOT NULL,
  `dateRead` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `senderID`, `receiverID`, `notyMsgID`, `notyType`, `notyStatus`, `notyDelStatus`, `dateReceived`, `dateRead`, `lastUpdated`) VALUES
(1, 23, 23, 1, 1, 1, 1, '2022-04-30 19:33:11', '2022-04-30 19:33:11', '2022-04-30 17:39:29'),
(2, 23, 23, 1, 2, 1, 1, '2022-04-30 19:33:11', '2022-04-30 19:33:11', '2022-04-30 18:03:05'),
(3, 24, 24, 1, 1, 1, 0, '2022-04-30 19:33:11', '2022-04-30 19:33:11', '2022-04-30 17:33:11'),
(4, 23, 23, 1, 3, 1, 1, '2022-04-30 19:33:11', '2022-04-30 19:33:11', '2022-04-30 18:03:05'),
(5, 24, 23, 1, 4, 1, 1, '2022-04-30 19:33:14', '2022-04-30 19:33:11', '2022-04-30 18:31:16'),
(6, 24, 23, 1, 5, 1, 1, '2022-04-30 19:33:15', '2022-04-30 19:33:11', '2022-04-30 18:31:08'),
(7, 24, 23, 1, 6, 1, 1, '2022-04-30 19:33:17', '2022-04-30 19:33:11', '2022-04-30 18:31:08'),
(8, 24, 23, 1, 6, 1, 1, '2022-04-30 19:33:17', '2022-04-30 19:33:11', '2022-04-30 20:04:33');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_temp`
--

CREATE TABLE `password_reset_temp` (
  `id` int(11) NOT NULL,
  `email` varchar(225) NOT NULL,
  `token_key` varchar(225) NOT NULL,
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expDate` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `password_reset_temp`
--

INSERT INTO `password_reset_temp` (`id`, `email`, `token_key`, `updated`, `expDate`) VALUES
(1, 'tkadzzz@gmail.com', 'b7951432cf8f8cd39d63c79fb96b309f2c5f032cb3', '2022-03-30 17:39:09', '2022-03-31 19:39:09'),
(2, 'tkadzzz@gmail.com', 'b7951432cf8f8cd39d63c79fb96b309fbcf61c7aa8', '2022-03-30 17:39:20', '2022-03-31 19:39:20'),
(3, 'tkadzzz@gmail.com', 'b7951432cf8f8cd39d63c79fb96b309f15738d5925', '2022-03-30 17:39:32', '2022-03-31 19:39:32'),
(4, 'tkadzzz@gmail.com', 'b7951432cf8f8cd39d63c79fb96b309fc9a0474ee1', '2022-03-30 17:45:50', '2022-03-31 19:45:50'),
(5, 'tkadzzz@gmail.com', 'b7951432cf8f8cd39d63c79fb96b309f0b9f60174e', '2022-03-30 17:46:04', '2022-03-31 19:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

CREATE TABLE `program` (
  `id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `name`, `dateAdded`, `lastUpdated`, `status`) VALUES
(1, 'Information Systems', '2021-12-12', '2022-11-04 18:46:42', 1),
(2, 'Development Studies', '2021-12-12', '2022-11-04 18:47:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentEducation`
--

CREATE TABLE `studentEducation` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `schoolID` int(11) NOT NULL,
  `programID` varchar(225) NOT NULL,
  `programType` varchar(225) NOT NULL,
  `initial_year` varchar(225) NOT NULL,
  `final_year` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentEducation`
--

INSERT INTO `studentEducation` (`id`, `userID`, `schoolID`, `programID`, `programType`, `initial_year`, `final_year`, `lastUpdated`) VALUES
(1, 23, 3, '1', 'Bachelor', '2018-03-01', '2021-12-07', '2022-11-02 15:33:24'),
(2, 26, 0, '0', '0', '2018-01-01', '2021-02-02', '2021-11-01 19:14:55'),
(3, 27, 0, '0', '0', '2019-01-01', '2022-01-01', '2021-11-02 15:24:50'),
(5, 29, 3, '1', 'Bachelor', '2021-01-03', '2021-07-30', '2022-11-03 01:53:14'),
(6, 33, 3, '1', 'Masters', '2020-01-29', '2023-12-29', '2022-10-20 11:47:38'),
(7, 34, 0, '0', '0', '2022-03-31', '2022-03-31', '2022-03-29 19:25:24'),
(8, 35, 0, '0', '0', '2022-03-30', '2022-03-30', '2022-03-29 19:33:41'),
(9, 36, 2, '1', 'Bachelor', '2020-02-29', '2022-11-17', '2022-10-20 11:47:40'),
(10, 37, 2, '1', 'Bachelor', '2018-03-02', '2022-11-18', '2022-10-20 11:47:47'),
(11, 39, 2, '1', 'Bachelor', '2022-07-04', '2022-07-27', '2022-10-20 11:47:49'),
(12, 40, 2, '1', 'Bachelor', '2018-02-28', '2022-12-05', '2022-10-20 11:47:51'),
(13, 201, 2, '1', 'Bachelor', '2022-10-16', '2022-10-16', '2022-10-20 11:47:53'),
(15, 28, 3, '2', 'Bachelor', '2019-02-01', '2022-12-01', '2022-10-29 20:46:52'),
(16, 203, 2, '2', 'Masters', '2021-01-01', '2024-01-02', '2022-10-29 22:54:13');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `nationalID` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `dob` varchar(225) NOT NULL,
  `sex` varchar(225) NOT NULL,
  `marital` varchar(225) NOT NULL,
  `avatar` varchar(225) NOT NULL,
  `homeAddress` varchar(225) NOT NULL,
  `postalAddress` varchar(225) NOT NULL,
  `nationality` varchar(225) NOT NULL,
  `religion` varchar(225) NOT NULL,
  `aboutSelf` varchar(225) NOT NULL,
  `attachmentStatus` int(11) NOT NULL,
  `lastUpdatedStudent` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `user_id`, `name`, `surname`, `nationalID`, `email`, `phone`, `dob`, `sex`, `marital`, `avatar`, `homeAddress`, `postalAddress`, `nationality`, `religion`, `aboutSelf`, `attachmentStatus`, `lastUpdatedStudent`) VALUES
(18, '23', 'TANAKA', 'KADZUNGE', '59-180971R42', 'tkadzzz@gmail.com', '0782956402', '1996-05-09', 'MALE', 'SINGLE', '../profileImages/63517a7930e803.30930419.jpg', '31193 unit m', 'postal address #2', 'ZIMBABWE', 'CHRISTIANITY', 'ndanzwa nekurambwa', 1, '2022-11-05 17:17:05'),
(19, '24', 'PANASHE', 'MURWISI', '', 'panashemurwisi@gmail.com', '722233332', '1998-01-01', 'FEMALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'l love you all with all my heart', 0, '2021-10-31 06:16:41'),
(20, '26', 'TEST', 'USER', '', '', '0782226633', '2005-01-31', 'FEMALE', 'MARRIED', '', '', '', 'SOUTH AFRICA', 'HINDU', 'a strong hindu believer', 0, '2021-11-01 19:14:26'),
(21, '27', 'TERRY', 'KAYZ0', '', '', '782266333', '1997-02-03', 'N_A', 'PRIVATE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'nothing special to tell', 0, '2021-11-02 15:24:14'),
(22, '28', 'AALIYAH', 'MUSHONGA', '59-180971R43', 'aaliyahmuzuva@gmail.com', '0782267012', '1999-04-29', 'FEMALE', 'SINGLE', '../profileImages/635d99edd3e046.46589701.jpg', '', '', 'ZIMBABWE', 'CHRISTIANITY', '', 0, '2022-11-04 17:01:06'),
(23, '29', 'WLLIAM', 'ZAMBEZI', '59-180971R44', 'williamjuniorzambezi@gmail.com', '0713632330', '2002-05-21', 'MALE', 'MARRIED', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'boss baby', 0, '2022-11-03 01:44:25'),
(26, '32', 'NUMERIC', 'USER', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2022-03-29 19:11:33'),
(27, '33', 'NUMERIC', 'USERA', '', '', '782273383', '2001-02-28', 'FEMALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'N/A', 0, '2022-03-29 19:16:25'),
(28, '34', 'TEST', 'USERB', '', '', '700000000', '2005-06-22', 'MALE', 'SINGLE', '', '', '', 'BARBADOS', 'MD', '', 0, '2022-03-29 19:25:05'),
(29, '35', 'NUMERIC', 'USERC', '', '', '700000000', '2005-06-29', 'MALE', 'MARRIED', '', '', '', 'BAHRAIN', 'C', 'c', 0, '2022-03-29 19:33:28'),
(30, '36', 'TSITSI', 'QUEEN', '', '', '786665554', '2005-08-17', 'FEMALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'very very short', 0, '2022-05-17 09:30:43'),
(31, '37', 'MIRRIAD', 'GWIZA', '', 'mirriadgwiza@gmail.com', '771622539', '2005-08-17', 'FEMALE', 'MARRIED', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'Classy', 0, '2022-05-18 20:28:54'),
(32, '39', 'IAN', 'MSARA', '', '', '789999999', '2005-10-05', 'MALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIAN', 'blablabla', 0, '2022-07-19 19:14:01'),
(33, '40', 'NAKAI', 'SAKATI', '', '', '783334443', '1996-06-05', 'MALE', 'MARRIED', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'N/A', 0, '2022-07-28 18:32:40'),
(34, '201', 'MILES', 'SHANGURAI', '', '', '0779862645', '2006-01-10', 'MALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', '', 0, '2022-10-16 11:26:35'),
(35, '203', 'LAM', 'EIGHT9', '', '', '789050035', '2002-01-03', 'MALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', '', 0, '2022-10-29 22:53:29'),
(36, '205', 'NM', 'NX', '', '', '', '', '', '', '', '', '', '', '', '', 0, '2022-11-02 17:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `supervisorReports`
--

CREATE TABLE `supervisorReports` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `file` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supervisorReports`
--

INSERT INTO `supervisorReports` (`id`, `userID`, `file`, `dateAdded`, `lastUpdated`) VALUES
(5, 23, '../assessmentReports/6366fc6b135385.51983753.doc', '2022-11-06 01:14:35', '2022-11-06 00:14:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `loginID` varchar(225) NOT NULL,
  `password` varchar(225) NOT NULL,
  `role` varchar(225) NOT NULL,
  `joined` varchar(225) NOT NULL,
  `regStatus` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `loginID`, `password`, `role`, `joined`, `regStatus`, `status`, `lastUpdated`) VALUES
(26, 'R111111', '$2y$10$z6nVn2tA7Q4EUAjkL7U5PuwdoQFWbHy82zK/QfjGDMm09YIGqugdS', 'student', '2021-11-01 08:11:13', 4, 1, '2021-11-01 19:14:55'),
(24, 'R000000', '$2y$10$/7u3Onc/osZ6IFZWxckWneHC3PZ5NOCLanPHOpLfpa1uz5sP4QHVS', 'student', '2021-10-31 07:10:13', 3, 1, '2021-10-31 06:16:41'),
(25, 'gzu101', '$2y$10$ezd/YqAs4sTmMdzCm8jxNeo8fLK1fj7WbpRU6zZAjgnA0Ds9ZRGle', 'institute', '2021-10-12 04:10:14', 1, 1, '2021-10-31 09:56:17'),
(23, 'M186483', '$2y$10$pg0/uCdHax5p3..Y0rOMou5I46b0zcn0/x53Zmyq47Mriwil22USC', 'student', '2021-10-12 04:10:14', 5, 1, '2022-04-30 20:01:02'),
(27, 'T000000', '$2y$10$T6XVqSq6gjYx9rfuTR4J/OAJfhBEUIHzxM2LH2J6DPdXtuGzTYOs2', 'student', '2021-11-02 04:11:22', 4, 1, '2021-11-02 15:30:51'),
(28, 'M192850', '$2y$10$cNuIm3ZLjBEvBvaJ2EgWE.yWy1BpVmar2tz2WsEsZSrgus4QRCpre', 'student', '2021-11-05 05:11:46', 5, 1, '2022-10-29 20:47:04'),
(1, 'admin@tkadz', '$2y$10$ezd/YqAs4sTmMdzCm8jxNeo8fLK1fj7WbpRU6zZAjgnA0Ds9ZRGle', 'admin', '2021-11-11 20:34:24', 1, 1, '2021-11-11 18:35:42'),
(29, 'MIG961', '$2y$10$NsmMxqmVgp2HUDolc5fzaejA70.KikSBFV4I70mO0CSl1ZD/tTLzu', 'student', '2021-11-30 10:11:46', 5, 1, '2021-11-30 21:49:27'),
(32, 'M12345', '$2y$10$ewHPnWb60hj/ELi6rKi9auyGsbUImrlDT7SCfVFqJg0CKgifznaQG', 'student', '2022-03-29 09:03:11', 2, 1, '2022-03-29 19:11:33'),
(33, 'A12345', '$2y$10$gIqrh6KOqEx11pF4L2xBYe8p8rLSIraPsXlfgFT66.pSvyqylmcmO', 'student', '2022-03-29 09:03:14', 5, 1, '2022-03-29 19:18:53'),
(34, 'B123456', '$2y$10$Qnuq6soRfNI2h5uG80IcveYQffrnsHYNe0q9r1NVnXGW1aCLf..pK', 'student', '2022-03-29 09:03:24', 5, 1, '2022-03-29 19:25:33'),
(35, 'C12345', '$2y$10$ChY1ofnTgajSWxOyAJ52o.y3ubPgoRYXAF.n8.SjFeUyL6JRW6Zai', 'student', '2022-03-29 09:03:33', 5, 1, '2022-03-29 19:33:44'),
(36, 'M192233', '$2y$10$lmnk9zUDTKEBMpA.w.qJi.CxuojTOodO.qWofe5z1esTnteuzrQlC', 'student', '2022-05-17 11:05:29', 5, 1, '2022-05-17 09:32:42'),
(37, 'M186873', '$2y$10$AnebUYscsEfTAOFllNkJreZPbiiVhs7yMLzKO9VsdgIV4PD3epEfm', 'student', '2022-05-18 10:05:25', 5, 1, '2022-05-18 20:29:27'),
(38, 'ecologin', '$2y$10$AnebUYscsEfTAOFllNkJreZPbiiVhs7yMLzKO9VsdgIV4PD3epEfm', 'company', '2022-05-18 10:05:25', 5, 1, '2022-05-21 17:47:11'),
(39, 'M0000', '$2y$10$shz40xTbJW4Wo35.UdmLm.RhniTHiOTJwsDorD/wM5LEO6Ur3oAJ.', 'student', '2022-07-19 09:07:09', 5, 1, '2022-07-19 19:13:26'),
(40, 'M54321', '$2y$10$SsMN9IJTYAkNRQPVZDrd1uBb56RwMiwufBSQN9fppK3ThHZXc0cGS', 'student', '2022-07-28 08:07:18', 5, 1, '2022-07-28 18:23:18'),
(200, 'comp1', '$2y$10$AnebUYscsEfTAOFllNkJreZPbiiVhs7yMLzKO9VsdgIV4PD3epEfm', 'company', '2022-05-18 10:05:25', 5, 1, '2022-05-21 17:47:11'),
(201, 'M203673', '$2y$10$f9fElhhFjjZpckM6si9lc.9jHo7Y4MrWkV7kgffwBid31JgBVLXfa', 'student', '2022-10-16 01:10:22', 5, 1, '2022-10-16 11:27:22'),
(2, 'mymsu', '$2y$10$pg0/uCdHax5p3..Y0rOMou5I46b0zcn0/x53Zmyq47Mriwil22USC', 'institute', '2022-10-16 01:10:22', 5, 1, '2022-10-20 11:46:54'),
(3, 'gzu', '$2y$10$pg0/uCdHax5p3..Y0rOMou5I46b0zcn0/x53Zmyq47Mriwil22USC', 'institute', '2022-10-16 01:10:22', 5, 1, '2022-10-20 11:46:56'),
(203, 'M898989', '$2y$10$TrbPnvXtpIok03u73bSN0OZivkxY0lPK18v.BAbEngmssxI2KZMUW', 'student', '2022-10-30 12:10:52', 5, 1, '2022-10-29 22:54:23'),
(205, 'TESTING', '$2y$10$hx/cY/eDH8N3zMhEH5snhuXGpp2KZg3QLyS2./0Gqlu2NbY6AMchC', 'student', '2022-11-02 06:11:17', 2, 1, '2022-11-02 17:17:05');

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `subID` int(11) NOT NULL,
  `uniqueID` varchar(225) NOT NULL,
  `title` varchar(225) NOT NULL,
  `location` varchar(225) NOT NULL,
  `body` varchar(10000) NOT NULL,
  `cartegory` int(11) NOT NULL,
  `expiryDate` varchar(225) NOT NULL,
  `datePosted` varchar(225) NOT NULL,
  `dateOnline` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `companyID`, `subID`, `uniqueID`, `title`, `location`, `body`, `cartegory`, `expiryDate`, `datePosted`, `dateOnline`, `lastUpdated`, `status`) VALUES
(2, 38, 2, 'a771db40bf0ba5de94917f852483e4ae', 'wennnnc', 'nmnsd', 'nnndndnndndndnndnd', 2, '2022-09-13', '2022-09-12 11:09:35', '2022-09-12', '2022-09-12 09:35:45', 1),
(3, 200, 4, '54543afaef97cd6610cce8a506ed2348', 'wennnnc', 'nmnsd', 'nnndndnndndndnndnd', 2, '2022-09-13', '2022-09-12 11:09:36', '2022-09-12', '2022-10-21 20:34:34', 1),
(4, 38, 2, 'ee431d0da8ce9de44c12f574376b07cc', 'sakjhsa', 'mnxsa', 'bn,na,maN,MNA,MNs,mnA,MNS', 3, '2022-09-17', '2022-09-16 04:09:59', '2022-09-16', '2022-09-16 14:59:21', 1),
(5, 38, 2, 'cec1e189d23eee5ac7010517d2cbb6d7', 'yywyw', 'nnnsa', 'nnsdsddsdsddsds', 2, '2022-09-17', '2022-09-16 05:09:07', '2022-09-07', '2022-09-17 10:55:56', 1),
(6, 38, 2, '0e530284167711b3cf57c0785bbe426c', 'a new vacancy', 'harare', 'this is jjust a simple ody', 2, '2022-09-29', '2022-09-17 01:09:25', '2022-09-22', '2022-09-17 11:38:01', 1),
(7, 38, 2, '9d6d9f12020f2cfcb5ca24d474bff70f', '2nd vacancy', 'harare', 'this is just a body', 2, '2022-10-09', '2022-09-17 02:09:50', '2022-09-17', '2022-09-17 12:50:12', 0),
(8, 200, 4, 'dba5fce38a1f85d58a0104b39730c1ba', '3rd vacancy', 'harare', 'this is just a body', 2, '2022-10-09', '2022-09-17 02:09:51', '', '2022-10-21 20:34:31', 0),
(9, 38, 2, 'd0f63124b74811effc63a5db472cb16c', '4th vacancy', 'harare', 'this is just a body', 2, '2022-10-09', '2022-09-17 02:09:51', '', '2022-09-17 12:51:41', 0),
(10, 38, 2, 'e6c9d4a20a934e34371e509ab17a7b75', '5th vacancy', 'harare', 'this is just a body', 2, '2022-10-09', '2022-09-17 02:09:52', '2022-09-18', '2022-09-17 13:20:19', 1),
(11, 38, 2, '6544fb6765f010513461a8c8e0303d78', 'qqqq', 'qqq', 'qqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqqq', 1, '2022-10-03', '2022-09-17 04:09:08', '2022-09-24', '2022-09-17 14:09:38', 1),
(12, 38, 2, 'c89f9a9c7aa20c5975bc6d4a259d3e66', 'Work Related Learniing 2', 'nbnn', 'nmb,mb,mb,mbbbbnnnnmm', 3, '2022-11-24', '2022-09-30 01:09:40', '2022-10-05', '2022-10-25 17:44:08', 1),
(13, 200, 4, '265d2b4dfff70b886c327546d7e3174c', 'Love hurts', 'harare', 'nns sn snsna san san san nsa nmxsa', 3, '2022-11-05', '2022-09-30 03:09:01', '2022-10-01', '2022-10-21 20:34:28', 1),
(14, 38, 2, '730ef6fe8d13fc3ba4d08518b85959e1', 'Work Related Learniing', 'Harare', 'We need a compitent student willing to learn', 1, '2022-10-31', '2022-10-22 12:10:39', '2022-10-23', '2022-10-22 10:41:28', 1),
(15, 38, 2, 'bbe015b3c2e525030b5d185f4acc9f78', 'Testing 1', 'Mashava Masvingo', 'we all love IT, we are looking for an IT guy who really knows his things and way around a computer', 1, '2022-11-29', '2022-10-25 07:10:25', '2022-10-26', '2022-10-25 18:01:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `vacancyCategories`
--

CREATE TABLE `vacancyCategories` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `category` varchar(225) NOT NULL,
  `addedOn` varchar(225) NOT NULL,
  `comment` varchar(10000) NOT NULL,
  `status` int(11) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacancyCategories`
--

INSERT INTO `vacancyCategories` (`id`, `userID`, `category`, `addedOn`, `comment`, `status`, `lastUpdated`) VALUES
(1, 38, 'Computer and IT', '2022-05-22 10:34:39', 'Accounting\r\nBusiness law\r\nBusiness management\r\nConsumer education\r\nEntrepreneurial skills\r\nIntroduction to business\r\nMarketing    \r\nPersonal finance', 1, '2022-10-01 11:25:54'),
(2, 38, 'Business', '2022-05-22 10:34:39', 'Accounting\nBusiness law\nBusiness management\nConsumer education\nEntrepreneurial skills\nIntroduction to business\nMarketing    \nPersonal finance', 1, '2022-10-01 11:25:54'),
(3, 38, 'Performing Arts', '2022-05-22 10:34:39', 'Choir\nConcert band\nDance\nDrama\nGuitar\nJazz band\nMarching band\nMusic theory\nOrchestra\nPercussion\nPiano  \nTheater technology\nWorld music', 1, '2022-10-01 10:56:08'),
(4, 38, 'Sciences', '2022-05-22 10:34:39', 'Agriculture\r\nAstronomy\r\nBiology\r\nBotany\r\nChemistry\r\nEarth science\r\nElectronics\r\nEnvironmental science\r\nEnvironmental studies\r\nForensic science\r\nGeology\r\nMarine biology\r\nOceanography\r\nPhysical science\r\nPhysics\r\nZoology', 1, '2022-10-01 10:56:11'),
(5, 38, 'Social Studies', '2022-05-22 10:34:39', 'Cultural anthropology\r\nCurrent events\r\nEuropean history\r\nGeography\r\nGlobal studies\r\nHuman geography\r\nInternational relations\r\nLaw\r\nMacroeconomics\r\nMicroeconomics\r\nModern world studies\r\nPhysical anthropology\r\nPolitical studies\r\nPsychology\r\nReligious studies\r\nSociology\r\nUS government\r\nUS history\r\nWomen’s studies\r\nWorld history\r\nWorld politics\r\nWorld religions', 1, '2022-10-01 10:56:15'),
(6, 38, 'MM,,', '2022-10-01 02:10:24', '', 1, '2022-10-01 12:24:51'),
(7, 38, 'VVBBB', '2022-10-16 01:10:29', 'nbn', 1, '2022-10-16 11:29:52');

-- --------------------------------------------------------

--
-- Table structure for table `vacancyQualifications`
--

CREATE TABLE `vacancyQualifications` (
  `id` int(11) NOT NULL,
  `vacancyID` varchar(225) NOT NULL,
  `qualification` varchar(500) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacancyQualifications`
--

INSERT INTO `vacancyQualifications` (`id`, `vacancyID`, `qualification`, `dateAdded`, `lastUpdated`) VALUES
(9, 'cec1e189d23eee5ac7010517d2cbb6d7', '5 olevel passes including maths and science', '2022-09-16 07:09:25', '2022-09-16 17:25:15'),
(10, 'cec1e189d23eee5ac7010517d2cbb6d7', 'a driver\'s licence', '2022-09-16 07:09:30', '2022-09-16 17:30:38'),
(14, '0e530284167711b3cf57c0785bbe426c', 'at least 5 o\'levels including maths and english', '2022-09-17 02:09:34', '2022-09-17 12:34:21'),
(15, '0e530284167711b3cf57c0785bbe426c', 'drivers licence', '2022-09-17 02:09:34', '2022-09-17 12:34:28'),
(16, '0e530284167711b3cf57c0785bbe426c', '4 years experience in IT or related field', '2022-09-17 02:09:34', '2022-09-17 12:34:42'),
(17, 'e6c9d4a20a934e34371e509ab17a7b75', 'hh', '2022-09-17 03:09:20', '2022-09-17 13:20:17'),
(20, '6544fb6765f010513461a8c8e0303d78', '5 levels', '2022-09-17 04:09:10', '2022-09-17 14:10:54'),
(21, '6544fb6765f010513461a8c8e0303d78', 'paracet', '2022-09-17 04:09:53', '2022-09-17 14:53:17'),
(22, 'c89f9a9c7aa20c5975bc6d4a259d3e66', '5 o\'s', '2022-09-30 01:09:41', '2022-09-30 11:41:08'),
(23, 'a771db40bf0ba5de94917f852483e4ae', 'Degree in Mathmatics', '2022-09-30 02:09:36', '2022-09-30 12:36:36'),
(24, '265d2b4dfff70b886c327546d7e3174c', 'Science', '2022-09-30 03:09:02', '2022-09-30 13:02:49'),
(25, '265d2b4dfff70b886c327546d7e3174c', 'Maths', '2022-09-30 03:09:02', '2022-09-30 13:02:55'),
(26, '265d2b4dfff70b886c327546d7e3174c', 'english', '2022-09-30 03:09:02', '2022-09-30 13:02:59'),
(27, '730ef6fe8d13fc3ba4d08518b85959e1', '5 olevels including maths and english', '2022-10-22 12:10:40', '2022-10-22 10:40:25'),
(28, '730ef6fe8d13fc3ba4d08518b85959e1', 'good communication skills', '2022-10-22 12:10:40', '2022-10-22 10:40:38'),
(29, '730ef6fe8d13fc3ba4d08518b85959e1', 'studying towards IT or related degree program', '2022-10-22 12:10:40', '2022-10-22 10:40:58'),
(30, '730ef6fe8d13fc3ba4d08518b85959e1', 'willing to learn', '2022-10-22 12:10:41', '2022-10-22 10:41:09'),
(31, 'bbe015b3c2e525030b5d185f4acc9f78', 'IT related degree', '2022-10-25 07:10:27', '2022-10-25 17:27:11'),
(32, 'bbe015b3c2e525030b5d185f4acc9f78', 'Maths and science', '2022-10-25 07:10:27', '2022-10-25 17:27:24'),
(33, 'bbe015b3c2e525030b5d185f4acc9f78', 'PHP', '2022-10-25 07:10:27', '2022-10-25 17:27:30'),
(34, 'bbe015b3c2e525030b5d185f4acc9f78', 'HTML', '2022-10-25 07:10:27', '2022-10-25 17:27:33'),
(35, 'bbe015b3c2e525030b5d185f4acc9f78', 'CSS', '2022-10-25 07:10:27', '2022-10-25 17:27:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachmentReports`
--
ALTER TABLE `attachmentReports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_sub_accounts`
--
ALTER TABLE `company_sub_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cv`
--
ALTER TABLE `cv`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userID` (`userID`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logbooks`
--
ALTER TABLE `logbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentEducation`
--
ALTER TABLE `studentEducation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supervisorReports`
--
ALTER TABLE `supervisorReports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacancyCategories`
--
ALTER TABLE `vacancyCategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vacancyQualifications`
--
ALTER TABLE `vacancyQualifications`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `attachmentReports`
--
ALTER TABLE `attachmentReports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `company_sub_accounts`
--
ALTER TABLE `company_sub_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `studentEducation`
--
ALTER TABLE `studentEducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `supervisorReports`
--
ALTER TABLE `supervisorReports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `vacancyCategories`
--
ALTER TABLE `vacancyCategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `vacancyQualifications`
--
ALTER TABLE `vacancyQualifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
