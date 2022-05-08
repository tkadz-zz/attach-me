-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 29, 2022 at 09:32 AM
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
(1, 200, 'Company1', '000000000', 'companyemail@g.co', 'N/A', '', 'N/A', 'N/A', '2022-03-30 15:54:07');

-- --------------------------------------------------------

--
-- Table structure for table `institute`
--

CREATE TABLE `institute` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(225) NOT NULL,
  `phone` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `website` varchar(225) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `dateJoined` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institute`
--

INSERT INTO `institute` (`id`, `user_id`, `name`, `phone`, `email`, `website`, `address`, `dateJoined`, `lastUpdated`) VALUES
(1, 25, 'Great Zimbabwe University', '4228844', 'info@gzu.ac.zw', 'http://www.gzu.co.zw', 'Masvingo, Harera ', '2021-02-02', '2021-10-31 09:50:36');

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
(1, 'Information Systems', '2021-12-12', '2021-10-31 10:25:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `studentEducation`
--

CREATE TABLE `studentEducation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `program` varchar(225) NOT NULL,
  `programType` varchar(225) NOT NULL,
  `initial_year` varchar(225) NOT NULL,
  `final_year` varchar(225) NOT NULL,
  `lastUpdated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `studentEducation`
--

INSERT INTO `studentEducation` (`id`, `user_id`, `school_id`, `program`, `programType`, `initial_year`, `final_year`, `lastUpdated`) VALUES
(1, 23, 25, '1', 'Bachelor', '2021-12-01', '2021-12-07', '2021-11-01 18:50:00'),
(2, 26, 0, '0', '0', '2018-01-01', '2021-02-02', '2021-11-01 19:14:55'),
(3, 27, 0, '0', '0', '2019-01-01', '2022-01-01', '2021-11-02 15:24:50'),
(4, 28, 25, '1', 'Bachelor', '2021-11-05', '2021-11-26', '2021-11-05 16:51:40'),
(5, 29, 0, '1', 'Bachelor', '2021-01-03', '2021-07-30', '2021-11-30 21:49:05'),
(6, 33, 25, '1', 'Masters', '2020-01-29', '2023-12-29', '2022-03-29 19:17:13'),
(7, 34, 0, '0', '0', '2022-03-31', '2022-03-31', '2022-03-29 19:25:24'),
(8, 35, 0, '0', '0', '2022-03-30', '2022-03-30', '2022-03-29 19:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `user_id` varchar(225) NOT NULL,
  `name` varchar(225) NOT NULL,
  `surname` varchar(225) NOT NULL,
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

INSERT INTO `students` (`id`, `user_id`, `name`, `surname`, `email`, `phone`, `dob`, `sex`, `marital`, `avatar`, `homeAddress`, `postalAddress`, `nationality`, `religion`, `aboutSelf`, `attachmentStatus`, `lastUpdatedStudent`) VALUES
(18, '23', 'TANAKA', 'KADZUNGE', 'tkadzzz@gmail.com', '0782956402', '1996-05-09', 'MALE', 'SINGLE', '', '31193 unit m', 'postal address 2', 'ZIMBABWE', 'CHRISTIANITY', 'ndanzwa nekurambwa', 0, '2022-04-19 12:13:25'),
(19, '24', 'PANASHE', 'MURWISI', 'panashemurwisi@gmail.com', '722233332', '1998-01-01', 'FEMALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'l love you all with all my heart', 0, '2021-10-31 06:16:41'),
(20, '26', 'TEST', 'USER', '', '0782226633', '2005-01-31', 'FEMALE', 'MARRIED', '', '', '', 'SOUTH AFRICA', 'HINDU', 'a strong hindu believer', 0, '2021-11-01 19:14:26'),
(21, '27', 'TERRY', 'KAYZ0', '', '782266333', '1997-02-03', 'N_A', 'PRIVATE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'nothing special to tell', 0, '2021-11-02 15:24:14'),
(22, '28', 'AALIYAH', 'MUSHONGA', 'aaliyahmuzuva@gmail.com', '0782267012', '1999-04-29', 'FEMALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', '', 0, '2021-11-05 16:50:47'),
(23, '29', 'WLLIAM', 'ZAMBEZI', 'williamjuniorzambezi@gmail.com', '0713632330', '2002-05-21', 'MALE', 'MARRIED', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'boss baby', 0, '2021-11-30 21:48:07'),
(26, '32', 'NUMERIC', 'USER', '', '', '', '', '', '', '', '', '', '', '', 0, '2022-03-29 19:11:33'),
(27, '33', 'NUMERIC', 'USERA', '', '782273383', '2001-02-28', 'FEMALE', 'SINGLE', '', '', '', 'ZIMBABWE', 'CHRISTIANITY', 'N/A', 0, '2022-03-29 19:16:25'),
(28, '34', 'TEST', 'USERB', '', '700000000', '2005-06-22', 'MALE', 'SINGLE', '', '', '', 'BARBADOS', 'MD', '', 0, '2022-03-29 19:25:05'),
(29, '35', 'NUMERIC', 'USERC', '', '700000000', '2005-06-29', 'MALE', 'MARRIED', '', '', '', 'BAHRAIN', 'C', 'c', 0, '2022-03-29 19:33:28');

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
(23, 'M186483', '$2y$10$96n.DqeVRdg/wjZ.onlfp.zwOAa0SySDcWcEQ62/KtoT03C4xHBf.', 'student', '2021-10-12 04:10:14', 5, 1, '2022-03-29 22:01:21'),
(27, 'T000000', '$2y$10$T6XVqSq6gjYx9rfuTR4J/OAJfhBEUIHzxM2LH2J6DPdXtuGzTYOs2', 'student', '2021-11-02 04:11:22', 4, 1, '2021-11-02 15:30:51'),
(28, 'M192850', '$2y$10$cNuIm3ZLjBEvBvaJ2EgWE.yWy1BpVmar2tz2WsEsZSrgus4QRCpre', 'student', '2021-11-05 05:11:46', 3, 1, '2021-11-05 16:52:29'),
(1, 'admin@tkadz', '$2y$10$ezd/YqAs4sTmMdzCm8jxNeo8fLK1fj7WbpRU6zZAjgnA0Ds9ZRGle', 'admin', '2021-11-11 20:34:24', 1, 1, '2021-11-11 18:35:42'),
(29, 'MIG961', '$2y$10$NsmMxqmVgp2HUDolc5fzaejA70.KikSBFV4I70mO0CSl1ZD/tTLzu', 'student', '2021-11-30 10:11:46', 5, 1, '2021-11-30 21:49:27'),
(32, 'M12345', '$2y$10$ewHPnWb60hj/ELi6rKi9auyGsbUImrlDT7SCfVFqJg0CKgifznaQG', 'student', '2022-03-29 09:03:11', 2, 1, '2022-03-29 19:11:33'),
(33, 'A12345', '$2y$10$gIqrh6KOqEx11pF4L2xBYe8p8rLSIraPsXlfgFT66.pSvyqylmcmO', 'student', '2022-03-29 09:03:14', 5, 1, '2022-03-29 19:18:53'),
(34, 'B123456', '$2y$10$Qnuq6soRfNI2h5uG80IcveYQffrnsHYNe0q9r1NVnXGW1aCLf..pK', 'student', '2022-03-29 09:03:24', 5, 1, '2022-03-29 19:25:33'),
(35, 'C12345', '$2y$10$ChY1ofnTgajSWxOyAJ52o.y3ubPgoRYXAF.n8.SjFeUyL6JRW6Zai', 'student', '2022-03-29 09:03:33', 5, 1, '2022-03-29 19:33:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institute`
--
ALTER TABLE `institute`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `program`
--
ALTER TABLE `program`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `studentEducation`
--
ALTER TABLE `studentEducation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loginID` (`loginID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `institute`
--
ALTER TABLE `institute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `password_reset_temp`
--
ALTER TABLE `password_reset_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `program`
--
ALTER TABLE `program`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `studentEducation`
--
ALTER TABLE `studentEducation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
