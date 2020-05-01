-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2020 at 11:36 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peer_assessment`
--

-- --------------------------------------------------------

--
-- Table structure for table `coursewrk`
--

CREATE TABLE `coursewrk` (
  `id` int(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `code` varchar(20) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(10) NOT NULL,
  `groupsid` int(10) NOT NULL,
  `submittedby` int(10) NOT NULL,
  `comment` varchar(3000) NOT NULL,
  `file` varchar(100) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) NOT NULL,
  `coursewrkid` int(10) NOT NULL,
  `title` varchar(150) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `submittedby` int(10) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT 'GA',
  `datesubmitted` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `groups_assigned`
--

CREATE TABLE `groups_assigned` (
  `id` int(10) NOT NULL,
  `groupsid` int(10) NOT NULL,
  `usersid` int(10) NOT NULL,
  `status` varchar(2) NOT NULL,
  `dateassigned` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL,
  `aboutme` varchar(200) NOT NULL,
  `role` varchar(20) NOT NULL,
  `datecreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `email`, `photo`, `aboutme`, `role`, `datecreated`) VALUES
(1, 'peter.gibson@gmail.com', 'peter123gibs', 'Peter', 'Gibson', 'peter.gibson@gmail.com', '20200428_14_01_09109.jpg', '', 'admin', '2020-04-07 14:10:00'),
(2, 'heather.morris@gmail.com', 'hea123mors', 'Heather', 'Morris', 'heather.morris@gmail.com', '20200426_15_22_38437.jpg', '', 'student', '2020-04-07 15:28:00'),
(3, 'jackson.morris@gmail.com', 'jack123hack', 'Jackson', 'Morris', 'jackson.morris@gmail.com', 'avatar2.jpg', '', 'student', '2020-04-07 16:45:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coursewrk`
--
ALTER TABLE `coursewrk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups_assigned`
--
ALTER TABLE `groups_assigned`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
