-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 16, 2022 at 06:07 PM
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
-- Table structure for table `admin_sub_acc`
--

CREATE TABLE `admin_sub_acc` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `supervisorID` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `dateStart` varchar(225) NOT NULL,
  `dateEnd` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `attachmentsHistory`
--

CREATE TABLE `attachmentsHistory` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `supervisorID` varchar(225) NOT NULL,
  `started` varchar(225) NOT NULL,
  `toEnd` varchar(225) NOT NULL,
  `ended` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `logbook` varchar(225) NOT NULL,
  `attachmentReport` varchar(225) NOT NULL,
  `supervisorReport` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `companyDepartment`
--

CREATE TABLE `companyDepartment` (
  `id` int(11) NOT NULL,
  `companyID` int(11) NOT NULL,
  `department` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `instDepartment`
--

CREATE TABLE `instDepartment` (
  `id` int(11) NOT NULL,
  `instID` int(11) NOT NULL,
  `department` varchar(225) NOT NULL,
  `dateAdded` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Table structure for table `institute_sub_accounts`
--

CREATE TABLE `institute_sub_accounts` (
  `id` int(11) NOT NULL,
  `instID` int(11) NOT NULL,
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
  `supervisorID` varchar(11) NOT NULL,
  `initial_year` varchar(225) NOT NULL,
  `final_year` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_sub_acc`
--
ALTER TABLE `admin_sub_acc`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `attachmentsHistory`
--
ALTER TABLE `attachmentsHistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companyDepartment`
--
ALTER TABLE `companyDepartment`
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
-- Indexes for table `instDepartment`
--
ALTER TABLE `instDepartment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute_sub_accounts`
--
ALTER TABLE `institute_sub_accounts`
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
-- AUTO_INCREMENT for table `admin_sub_acc`
--
ALTER TABLE `admin_sub_acc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachmentReports`
--
ALTER TABLE `attachmentReports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachments`
--
ALTER TABLE `attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attachmentsHistory`
--
ALTER TABLE `attachmentsHistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companyDepartment`
--
ALTER TABLE `companyDepartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_sub_accounts`
--
ALTER TABLE `company_sub_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cv`
--
ALTER TABLE `cv`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instDepartment`
--
ALTER TABLE `instDepartment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `institute_sub_accounts`
--
ALTER TABLE `institute_sub_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logbooks`
--
ALTER TABLE `logbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentEducation`
--
ALTER TABLE `studentEducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `supervisorReports`
--
ALTER TABLE `supervisorReports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vacancyCategories`
--
ALTER TABLE `vacancyCategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vacancyQualifications`
--
ALTER TABLE `vacancyQualifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
