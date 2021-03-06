-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 13, 2016 at 09:43 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmsc_128_org(y)`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(100) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date_admin` date DEFAULT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `Announcement_id` int(100) NOT NULL,
  `Content` varchar(1000) NOT NULL,
  `Topic` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_Id` int(100) DEFAULT NULL,
  `Content` varchar(1000) NOT NULL,
  `Date_Comment` date NOT NULL,
  `Disc_Id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contained`
--

CREATE TABLE `contained` (
  `contain_id` int(100) DEFAULT NULL,
  `Member_Id` int(11) NOT NULL,
  `Org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `created`
--

CREATE TABLE `created` (
  `create_id` int(100) DEFAULT NULL,
  `admin_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discussion`
--

CREATE TABLE `discussion` (
  `Disc_Id` int(100) NOT NULL,
  `Content` varchar(1000) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `joined`
--

CREATE TABLE `joined` (
  `joined_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `list_id` int(100) NOT NULL,
  `disc_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `date_posted` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `Member_Id` int(100) NOT NULL,
  `Date_Joined` date NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `org`
--

CREATE TABLE `org` (
  `Org_Id` int(100) NOT NULL,
  `Org_Name` varchar(100) NOT NULL,
  `Description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posted`
--

CREATE TABLE `posted` (
  `post_id` int(100) NOT NULL,
  `date_posted` date NOT NULL,
  `org_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `User_Id` int(100) NOT NULL,
  `2014-62892` varchar(100) NOT NULL,
  `First_Name` varchar(60) NOT NULL,
  `Last_Name` varchar(60) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Course` varchar(60) NOT NULL,
  `Date_Joined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `written`
--

CREATE TABLE `written` (
  `w_id` int(100) NOT NULL,
  `Member_id` int(11) NOT NULL,
  `Disc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`Announcement_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD KEY `Disc_Id` (`Disc_Id`);

--
-- Indexes for table `contained`
--
ALTER TABLE `contained`
  ADD KEY `Member_Id` (`Member_Id`),
  ADD KEY `Org_id` (`Org_id`);

--
-- Indexes for table `created`
--
ALTER TABLE `created`
  ADD KEY `announcement_id` (`announcement_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `discussion`
--
ALTER TABLE `discussion`
  ADD PRIMARY KEY (`Disc_Id`);

--
-- Indexes for table `joined`
--
ALTER TABLE `joined`
  ADD PRIMARY KEY (`joined_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `member_id` (`member_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `Disc_id` (`disc_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`Member_Id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `org`
--
ALTER TABLE `org`
  ADD PRIMARY KEY (`Org_Id`);

--
-- Indexes for table `posted`
--
ALTER TABLE `posted`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `announcement_id` (`announcement_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`User_Id`);

--
-- Indexes for table `written`
--
ALTER TABLE `written`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `Member_id` (`Member_id`),
  ADD KEY `Disc_id` (`Disc_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `Announcement_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `discussion`
--
ALTER TABLE `discussion`
  MODIFY `Disc_Id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `joined`
--
ALTER TABLE `joined`
  MODIFY `joined_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `list_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `Member_Id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `org`
--
ALTER TABLE `org`
  MODIFY `Org_Id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posted`
--
ALTER TABLE `posted`
  MODIFY `post_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `User_Id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `written`
--
ALTER TABLE `written`
  MODIFY `w_id` int(100) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `member` (`Member_Id`),
  ADD CONSTRAINT `admin_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `org` (`Org_Id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`Disc_Id`) REFERENCES `discussion` (`Disc_Id`);

--
-- Constraints for table `contained`
--
ALTER TABLE `contained`
  ADD CONSTRAINT `contained_ibfk_1` FOREIGN KEY (`Member_Id`) REFERENCES `member` (`Member_Id`),
  ADD CONSTRAINT `contained_ibfk_2` FOREIGN KEY (`Org_id`) REFERENCES `org` (`Org_Id`);

--
-- Constraints for table `created`
--
ALTER TABLE `created`
  ADD CONSTRAINT `created_ibfk_1` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`Announcement_id`),
  ADD CONSTRAINT `created_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Constraints for table `joined`
--
ALTER TABLE `joined`
  ADD CONSTRAINT `joined_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`User_Id`),
  ADD CONSTRAINT `joined_ibfk_2` FOREIGN KEY (`member_id`) REFERENCES `member` (`Member_Id`);

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `lists_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `org` (`Org_Id`),
  ADD CONSTRAINT `lists_ibfk_2` FOREIGN KEY (`Disc_id`) REFERENCES `discussion` (`Disc_Id`);

--
-- Constraints for table `member`
--
ALTER TABLE `member`
  ADD CONSTRAINT `member_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `org` (`Org_Id`);

--
-- Constraints for table `posted`
--
ALTER TABLE `posted`
  ADD CONSTRAINT `posted_ibfk_1` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`Announcement_id`),
  ADD CONSTRAINT `posted_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `org` (`Org_Id`);

--
-- Constraints for table `written`
--
ALTER TABLE `written`
  ADD CONSTRAINT `written_ibfk_1` FOREIGN KEY (`Member_id`) REFERENCES `member` (`Member_Id`),
  ADD CONSTRAINT `written_ibfk_2` FOREIGN KEY (`Disc_id`) REFERENCES `discussion` (`Disc_Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
