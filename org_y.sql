-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2016 at 04:35 AM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `org_y`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `announcement_id` int(11) NOT NULL,
  `date_posted` datetime NOT NULL,
  `topic` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`announcement_id`, `date_posted`, `topic`, `content`, `user_id`, `org_id`) VALUES
(1, '2016-11-14 00:00:00', 'General Assembly', 'Meron tayong general assembly kahapon! Bakit wala umattend? @!)#(*!@)#', 1, 1),
(2, '2016-11-24 00:00:00', 'hoy!', 'hi :)', 2, 41),
(3, '2016-11-24 00:00:00', 'Hello', 'hello', 2, 41),
(4, '2016-11-27 00:00:00', 'Bieber', 'Bieber or DIE.', 2, 41),
(5, '2016-11-27 07:51:03', 'Hello', 'How Are You?', 2, 41),
(6, '2016-11-27 08:05:03', 'we don&#039;t talk anymore', 'like we used to....', 2, 41),
(7, '2016-11-27 08:05:28', 'hello', 'worllllld', 2, 41),
(8, '2016-11-29 07:27:27', 'hello', 'biatches', 2, 41),
(9, '2016-11-29 07:34:35', 'please', 'work', 2, 41),
(10, '2016-12-03 11:43:38', 'Accepted', 'Admin marbasaur accepted the request of Hayley Williams to join the org.', 2, 41),
(11, '2016-12-03 11:43:40', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(12, '2016-12-03 01:00:44', 'Request', 'gregg0912 wihses to join this group.', 5, 41),
(13, '2016-12-03 01:02:00', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(14, '2016-12-03 01:02:02', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(15, '2016-12-03 01:02:23', 'Request', 'gregg0912 wihses to join this group.', 5, 41),
(16, '2016-12-03 01:05:21', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(17, '2016-12-03 01:05:39', 'Request', 'gregg0912 wihses to join this group.', 5, 41),
(18, '2016-12-03 01:07:15', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(19, '2016-12-03 01:07:31', 'Request', 'gregg0912 wihses to join this group.', 5, 41),
(20, '2016-12-03 01:08:02', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(22, '2016-12-03 01:10:03', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(24, '2016-12-03 01:13:36', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(26, '2016-12-03 01:15:03', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(29, '2016-12-03 01:19:25', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(30, '2016-12-03 01:19:42', 'Request', 'gregg0912 wihses to join this group.', 5, 41),
(31, '2016-12-03 01:24:23', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(32, '2016-12-03 01:24:51', 'Request', 'gregg0912 wishes to join this group.', 5, 41),
(33, '2016-12-03 01:47:22', 'Request', 'gregg0912 wishes to join this group.', 5, 7),
(34, '2016-12-03 01:48:01', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(35, '2016-12-03 01:48:20', 'Request', 'gregg0912 wishes to join this group.', 5, 41),
(36, '2016-12-03 01:48:44', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icayloo to join the org.', 2, 41),
(37, '2016-12-03 01:49:03', 'Request', 'gregg0912 wishes to join this group.', 5, 41),
(38, '2016-12-04 05:49:05', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icay to join the org.', 2, 41),
(39, '2016-12-04 05:49:28', 'Request', 'gregg0912 wishes to join this group.', 5, 41),
(40, '2016-12-04 07:40:33', 'sample', 'announcement', 2, 41),
(41, '2016-12-04 07:57:14', 'announcement', 'announcement', 2, 41),
(42, '2016-12-04 08:51:23', 'hello', 'hello', 2, 41),
(43, '2016-12-04 09:04:03', 'this is a', 'testis', 2, 41),
(44, '2016-12-04 09:04:10', 'this', 'is another testies', 2, 41),
(45, '2016-12-04 09:04:17', 'te-te-testicle', 'testicle', 2, 41),
(46, '2016-12-06 02:32:30', 'Kicked', 'Admin marbasaur kicked Hayley Williamssss from the org.', 2, 41),
(47, '2016-12-06 02:33:16', 'Request', 'Hayley Williamswishes to join this group.', 11, 41),
(48, '2016-12-06 02:34:27', 'Accepted', 'Admin marbasaur accepted the request of Hayley Williamssss to join the org.', 2, 41),
(49, '2016-12-06 02:34:41', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icay to join the org.', 2, 41),
(50, '2016-12-08 01:03:27', 'Hayley!', 'You should be reading this.', 2, 41),
(51, '2016-12-08 01:23:21', 'Request', 'Hayley Williamswishes to join this group.', 11, 2),
(52, '2016-12-08 02:10:17', 'Request', 'Hayley Williamswishes to join this group.', 11, 3),
(53, '2016-12-08 02:38:13', 'Request', 'marbasaurwishes to join this group.', 2, 11),
(54, '2016-12-08 02:38:52', 'Request', 'gregg0912 wishes to join this group.', 5, 41),
(55, '2016-12-09 04:24:22', 'helloooo', 'hellloool test lang wag magalit', 2, 41),
(56, '2016-12-09 04:24:22', 'helloooo', 'hellloool test lang wag magalit', 2, 41),
(57, '2016-12-09 04:26:35', 'announcement', 'annnnnn', 2, 41),
(58, '2016-12-09 04:50:32', 'Request', 'nujVallaquoiwishes to join this group.', 15, 1),
(59, '2016-12-09 04:52:14', 'Request', 'nujVallaquoiwishes to join this group.', 15, 49),
(60, '2016-12-09 04:54:02', 'Accepted', 'Admin marbasaur accepted the request of Emmanue Valauqio to join the org.', 2, 1),
(61, '2016-12-09 04:54:08', 'Rejected', 'Admin marbasaur rejected the request of Hayley Williamssss to join the org.', 2, 1),
(62, '2016-12-09 05:27:41', 'Request', 'gregg09wishes to join this group.', 5, 11),
(63, '2016-12-09 05:57:49', 'Request', 'gregg09wishes to join this group.', 5, 3),
(64, '2016-12-09 06:14:35', 'Request', 'gregg09wishes to join this group.', 5, 2),
(65, '2016-12-09 06:26:19', 'Request', 'gregg09wishes to join this group.', 5, 2),
(66, '2016-12-09 06:30:19', 'Request', 'gregg09wishes to join this group.', 5, 2),
(67, '2016-12-09 06:32:11', 'Request', 'gregg09wishes to join this group.', 5, 3),
(68, '2016-12-09 06:33:24', 'Request', 'gregg09wishes to join this group.', 5, 2),
(69, '2016-12-09 06:34:05', 'Request', 'gregg09wishes to join this group.', 5, 3),
(70, '2016-12-09 06:34:50', 'Request', 'gregg09wishes to join this group.', 5, 3),
(71, '2016-12-09 06:45:31', 'Request', 'gregg09 wishes to join this group.', 5, 2),
(72, '2016-12-09 06:46:55', 'Request', 'gregg09 wishes to join this group.', 5, 7),
(73, '2016-12-09 07:57:42', 'Request', 'gregg09 wishes to join this group.', 5, 41),
(74, '2016-12-09 08:06:25', 'Request', 'gregg09 wishes to join this group.', 5, 41),
(75, '2016-12-09 08:06:55', 'Request', 'gregg09 cancelled their request to join UPV Sakdag', 5, 41),
(76, '2016-12-09 08:08:48', 'Request', 'gregg09 wishes to join this group.', 5, 41),
(77, '2016-12-09 08:08:52', 'Request', 'gregg09 cancelled their request to join this group.', 5, 41),
(78, '2016-12-09 08:11:19', 'Request', 'gregg09 wishes to join this group.', 5, 41),
(79, '2016-12-09 08:11:22', 'Request', 'gregg09 cancelled their request to join UPV Sakdag', 5, 41),
(80, '2016-12-09 08:14:04', 'Request', 'gregg09 wishes to join UPV Sakdag.', 5, 41),
(81, '2016-12-09 08:14:07', 'Request', 'gregg09 cancelled their request to join UPV Sakdag.', 5, 41),
(82, '2016-12-09 08:59:40', 'Request', 'marbasaur cancelled their request to join Daebak.', 2, 9),
(83, '2016-12-09 09:00:42', 'Request', 'marbasaur cancelled their request to join UP Tubong Mindanao.', 2, 8);

-- --------------------------------------------------------

--
-- Table structure for table `classification`
--

CREATE TABLE `classification` (
  `class_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `classification`
--

INSERT INTO `classification` (`class_id`, `org_id`, `type_id`) VALUES
(1, 1, 5),
(2, 2, 5),
(3, 3, 5),
(4, 4, 5),
(5, 6, 5),
(6, 7, 1),
(7, 9, 6),
(13, 9, 6),
(14, 10, 9),
(15, 11, 1),
(16, 11, 6),
(17, 12, 9),
(18, 13, 2),
(19, 13, 6),
(20, 14, 3),
(21, 14, 11),
(22, 15, 3),
(23, 15, 11),
(24, 16, 11),
(25, 17, 13),
(26, 18, 5),
(27, 19, 13),
(28, 20, 5),
(29, 21, 13),
(30, 22, 13),
(31, 23, 13),
(32, 24, 13),
(33, 25, 13),
(34, 26, 12),
(35, 27, 13),
(36, 28, 3),
(37, 39, 12),
(38, 40, 12),
(39, 41, 13),
(40, 42, 12),
(41, 43, 3),
(42, 44, 9),
(43, 45, 13),
(44, 46, 7),
(45, 47, 3),
(46, 47, 11),
(47, 48, 9),
(48, 49, 8),
(49, 50, 7),
(50, 51, 7),
(51, 52, 7),
(52, 53, 7),
(53, 54, 7),
(54, 55, 7),
(55, 56, 9),
(56, 57, 13),
(61, 29, 12),
(62, 30, 9),
(63, 31, 10),
(64, 32, 10),
(65, 33, 10),
(66, 34, 9),
(67, 35, 6),
(68, 35, 9),
(69, 36, 11),
(70, 37, 11),
(71, 39, 12),
(74, 58, 3),
(75, 58, 11),
(76, 59, 9),
(77, 60, 11),
(78, 61, 12),
(79, 62, 9),
(80, 63, 8),
(81, 64, 8),
(82, 65, 12),
(83, 66, 8),
(84, 67, 8),
(85, 68, 8),
(86, 69, 9),
(87, 70, 12),
(88, 71, 13),
(89, 72, 11),
(90, 72, 3),
(91, 73, 12),
(92, 74, 8),
(93, 74, 1),
(94, 74, 6),
(95, 76, 8),
(96, 77, 8),
(97, 78, 8);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `body` varchar(100) NOT NULL,
  `date_c` datetime NOT NULL,
  `disc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `body`, `date_c`, `disc_id`, `user_id`) VALUES
(8, 'hello', '2016-11-24 00:00:00', 3, 4),
(9, 'hello', '2016-11-24 00:00:00', 3, 6),
(10, 'hallu besh nu problem?', '2016-12-04 10:45:03', 28, 2),
(11, 'gani! ano problem? talks to self', '2016-12-04 10:45:16', 28, 2),
(12, 'pwede pa-try? :)', '2016-12-04 12:08:34', 4, 5),
(13, 'comments', '2016-12-05 01:40:06', 1, 5),
(14, 'nami ni siya na discussion page i like it', '2016-12-08 21:51:11', 37, 2),
(15, 'dddqw', '2016-12-09 11:59:40', 34, 15);

-- --------------------------------------------------------

--
-- Table structure for table `discuss`
--

CREATE TABLE `discuss` (
  `disc_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `date_posted` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  `org_id` int(11) NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `discuss`
--

INSERT INTO `discuss` (`disc_id`, `title`, `content`, `date_posted`, `user_id`, `org_id`, `votes`) VALUES
(1, 'yung amoy ng utot ni kulas', 'Dear kulas, di ko na talaga matiis yung utot mo. Konting air-freshener naman please.', '2016-11-14 00:00:00', 1, 1, 1),
(2, 'hellosqwsqws', 'world123', '2016-11-24 00:00:00', 2, 1, 0),
(3, 'Hello Winter', 'hahahah', '2016-11-24 00:00:00', 2, 1, 0),
(4, 'hello', 'gusto ko magdiscuss oops wrong', '2016-11-24 00:00:00', 2, 1, 0),
(5, 'discuss', 'discusss', '2016-11-24 00:00:00', 8, 1, 1),
(6, 'hhh', 'kkkk', '2016-11-24 00:00:00', 5, 6, -1),
(7, 'Choy topic', 'Choy topic commentssss\r\n', '2016-11-24 00:00:00', 2, 1, 0),
(8, 'GGEZ', 'haluuuhhh', '2016-11-24 00:00:00', 5, 6, 1),
(9, 'title2', 'content2', '2016-11-28 01:24:30', 2, 41, -1),
(10, 'title and content', 'title and content', '2016-11-28 00:00:00', 1, 41, 0),
(11, 'title and content', 'title and content', '2016-11-28 00:00:00', 1, 41, 0),
(12, 'title and content', 'title and content', '2016-11-28 00:00:00', 1, 41, 1),
(13, 'title and content', 'title and content', '2016-11-28 00:00:00', 4, 41, 0),
(14, 'title and content', 'title and content', '2016-11-28 00:00:00', 4, 41, 0),
(15, 'title and content222', 'title and content22233', '2016-11-28 00:00:00', 4, 41, 0),
(16, 'title and content22212', 'title and content22212', '2016-11-28 00:00:00', 4, 41, 0),
(17, 'title and content22211', 'title and content22212', '2016-11-28 00:00:00', 4, 41, 0),
(18, 'title and content222121', 'title and content222111', '2016-11-28 00:00:00', 1, 41, 0),
(19, 'title and content222', 'title and content222', '2016-11-28 00:00:00', 4, 41, -1),
(20, 'title and content222112', 'title and content222121', '2016-11-28 00:00:00', 3, 41, 0),
(21, 'title and content25523', 'title and content2124', '2016-11-28 00:00:00', 7, 41, 0),
(22, 'title and content209', 'title and content290', '2016-11-28 00:00:00', 6, 41, 0),
(23, 'title and content2', '12432', '2016-11-28 00:00:00', 7, 41, 0),
(24, 'title and content21256', 'title and content289032', '2016-11-28 00:00:00', 5, 41, 1),
(25, 'censored', 'censored', '2016-11-28 02:11:50', 2, 41, -2),
(26, 'hello', 'world', '2016-11-29 14:14:33', 5, 6, -1),
(27, 'hello', 'cyra from isran', '2016-11-30 19:23:05', 5, 6, -1),
(28, 'something', 'something\r\n\r\nsomething', '2016-12-04 02:24:59', 2, 39, 0),
(30, 'hello', 'cold world', '2016-12-04 03:39:05', 2, 39, 0),
(31, 'hello', 'diyan', '2016-12-04 05:01:38', 2, 21, 0),
(32, 'hello', 'kulas bebe loves', '2016-12-04 05:06:48', 5, 1, 0),
(33, 'why', 'are you late?', '2016-12-04 05:07:34', 5, 1, -1),
(34, 'That&#039;s what you get', 'Paramore', '2016-12-04 05:12:47', 5, 1, 0),
(35, 'si gregg0912', 'wag siya papapasukin sa group na&#039;to please', '2016-12-04 12:16:37', 11, 41, 1),
(36, 'hello', 'nanamanaasdfagg', '2016-12-05 01:31:03', 5, 1, -1),
(37, 'FOB', 'yehey', '2016-12-08 21:50:33', 2, 22, 0);

-- --------------------------------------------------------

--
-- Table structure for table `disc_upvote`
--

CREATE TABLE `disc_upvote` (
  `dvID` int(11) NOT NULL,
  `disc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `approval` enum('upvote','downvote') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `disc_upvote`
--

INSERT INTO `disc_upvote` (`dvID`, `disc_id`, `user_id`, `approval`) VALUES
(1, 5, 1, 'upvote'),
(2, 5, 2, 'upvote'),
(3, 5, 3, 'downvote'),
(4, 5, 5, 'downvote'),
(5, 5, 4, 'upvote'),
(17, 25, 2, 'downvote'),
(18, 19, 2, 'downvote'),
(19, 20, 2, 'upvote'),
(20, 9, 2, 'downvote'),
(21, 1, 5, 'upvote'),
(22, 24, 2, 'upvote'),
(23, 6, 5, 'downvote'),
(24, 8, 5, 'upvote'),
(25, 26, 5, 'downvote'),
(26, 27, 5, 'downvote'),
(27, 35, 11, 'upvote'),
(28, 20, 11, 'downvote'),
(29, 25, 11, 'downvote'),
(30, 12, 2, 'upvote'),
(31, 36, 2, 'downvote'),
(32, 33, 15, 'downvote');

-- --------------------------------------------------------

--
-- Table structure for table `joined`
--

CREATE TABLE `joined` (
  `join_id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `org_id` int(100) NOT NULL,
  `membership_type` enum('admin','member','pending') NOT NULL,
  `date_joined` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `joined`
--

INSERT INTO `joined` (`join_id`, `user_id`, `org_id`, `membership_type`, `date_joined`) VALUES
(1, 1, 1, 'member', '2016-11-14'),
(2, 2, 1, 'admin', '2016-10-10'),
(3, 2, 22, 'member', '2016-06-13'),
(4, 2, 41, 'admin', '2016-11-01'),
(5, 2, 39, 'member', '2016-10-27'),
(6, 2, 21, 'member', '2016-11-03'),
(7, 3, 5, 'member', '2016-04-11'),
(8, 3, 1, 'member', '2016-08-18'),
(9, 3, 31, 'member', '2016-04-12'),
(10, 3, 43, 'admin', '2016-08-19'),
(11, 3, 25, 'member', '2016-08-22'),
(12, 1, 4, 'member', '2016-11-23'),
(13, 1, 2, 'member', '2016-11-23'),
(14, 1, 7, 'member', '2016-11-23'),
(15, 5, 6, 'member', '2016-11-23'),
(16, 5, 1, 'member', '2016-11-24'),
(17, 8, 1, 'member', '2016-11-24'),
(18, 8, 2, 'member', '2016-11-24'),
(21, 2, 2, 'pending', '2016-11-27'),
(22, 2, 3, 'pending', '2016-11-27'),
(23, 2, 4, 'pending', '2016-11-27'),
(24, 2, 5, 'pending', '2016-11-27'),
(25, 2, 6, 'pending', '2016-11-27'),
(26, 2, 7, 'pending', '2016-11-27'),
(29, 2, 10, 'pending', '2016-11-27'),
(30, 2, 12, 'pending', '2016-11-27'),
(31, 2, 43, 'pending', '2016-11-27'),
(32, 9, 4, 'pending', '2016-11-28'),
(33, 9, 15, 'pending', '2016-11-28'),
(34, 9, 22, 'pending', '2016-11-28'),
(35, 9, 31, 'pending', '2016-11-28'),
(36, 9, 76, 'pending', '2016-11-28'),
(37, 9, 34, 'pending', '2016-11-28'),
(38, 9, 60, 'pending', '2016-11-28'),
(59, 11, 41, 'member', '2016-12-06'),
(60, 11, 2, 'pending', '2016-12-08'),
(61, 11, 3, 'pending', '2016-12-08'),
(62, 2, 11, 'pending', '2016-12-08'),
(64, 15, 1, 'member', '2016-12-09'),
(65, 15, 49, 'pending', '2016-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `orgs`
--

CREATE TABLE `orgs` (
  `org_id` int(100) NOT NULL,
  `org_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orgs`
--

INSERT INTO `orgs` (`org_id`, `org_name`, `description`, `photo`) VALUES
(1, 'Elektrons', 'The best org in the world! Mga Semilya ni Oble\r\nOrg Consists of following courses: BS Computer Scien', '../images/image.jpg'),
(2, 'Redbolts', 'Pula nga Linte!', '../images/janina.PNG'),
(3, 'Komsai.Org', 'Organization for future Programmers, professionals, Technician and any computer Lovers.', '../images/komsai.jpg'),
(4, 'Skimmers', 'Organization for Media Studies and Literature major', '../images/skimmers.jpg'),
(5, 'SoTech', 'School of Technology! building under the mango tree. consists of Chemical Engineering and Food Techn', '../images/sotech.jpg'),
(6, 'PH Pub', 'Exclusively for Public Health Students.', '../images/phPub.jpg'),
(7, 'UP Sonata', 'Enhance music skills. Especially in instrument playing', '../images/sonata.jpg'),
(8, 'UP Tubong Mindanao', 'For people from Mindanao.', '../images/tubao.jpg'),
(9, 'Daebak', 'For Kpop Lovers. oppa <3', '../images/daebak.jpg'),
(10, 'Genguken', 'Society for Modern Research and Graphic Culture.', '../images/gengu.jpg'),
(11, 'UPV Choristers', 'For Music Lovers. UPV''s famous singing org', '../images/kore.jpg'),
(12, 'UPV Mountaineers', 'For people who loves nature and hiking at the same time!', '../images/mountaineers.jpg'),
(13, 'UPV Hublag', 'We like to move it, move it! Dancers of the Year! UPV''s famous dance company', '../images/hublag.jpg'),
(14, 'SAMASA', 'Serve the People! Tuloy parin ang LABAN! iskolar ng bayan!', '../images/samasa.jpg'),
(15, 'PMB', 'Bleeding Blue', '../images/pmb.jpg'),
(16, 'Catalyst', 'Creating Leaders. Shaping communities. Quality over Quantity', '../images/catalyst.jpg'),
(17, 'UPV Math Circle', 'Math Lovers. Mathematics major.\r\nIf it is easy, you''re not doing it right', '../images/mathCircle.jpg'),
(18, 'Clovers', 'Science People. Home of the CAS dean.', '../images/clovers.jpg'),
(19, 'StatSoc', 'The Probability that you know us', '../images/statSoc.jpg'),
(20, 'Fisheries', 'UPV''s Flagship course. College of Fisheries and Ocean Sciences', '../images/fisheries.jpg'),
(21, 'Icthophilic Society', 'Fisheries'' Organization', '../images/janina.PNG'),
(22, 'UPV Media.com', 'We are one. One CMS. UPV''s First award giving body', '../images/janina.PNG'),
(23, 'ChemSoc', 'Elements, atom, molecule LOVERS.', '../images/janina.PNG'),
(24, 'UPV Literati', 'We write to express what we feel', '../images/janina.PNG'),
(25, 'Samahang Sikolohiya', 'Samahang Sikolohiya', '../images/janina.PNG'),
(26, 'UPV Negrense', 'Negrense. Iba ang tikalon sa may itikal', '../images/janina.PNG'),
(27, 'Fisheries Guild', 'FG FG go go go.', '../images/janina.PNG'),
(28, 'KARATULA', 'We express ang feelings through our drawings', '../images/janina.PNG'),
(29, 'Kadugong Boholanon', 'Taga Bohol. ', '../images/janina.PNG'),
(30, 'Debate Society', 'Argue With us! just Try!', '../images/janina.PNG'),
(31, 'SSC Org', 'INHS - SSC', '../images/janina.PNG'),
(32, 'Yupihay', 'UP Highschool alumni', '../images/janina.PNG'),
(33, 'Pisay', 'Philippine Science High School. Scholar Since High School', '../images/janina.PNG'),
(34, 'UPV Sipat', 'Picture Time! 1 2 3..Say Cheese!', '../images/janina.PNG'),
(35, 'UPV Modus', 'UPV''s modeling Organization. We walk like Rihanna', '../images/janina.PNG'),
(36, 'UPV DUCES', 'We help the people.', '../images/janina.PNG'),
(37, 'VOLCORPS', 'For those who are willing to lend a hand. We the Volunteers!', '../images/janina.PNG'),
(39, 'UPV KaLuzon', 'taga Luzon.', '../images/kaluzon.jpg'),
(40, 'UPV Antiqueno', 'Karay-a tamun. And we are proud of it! we Love Antique', '../images/antique.jpg'),
(41, 'UPV Sakdag', 'Community Development.', '../images/letterS.jpg'),
(42, 'UP San Joaquinhons', 'San Joaquin People', '../images/sanjo.jpg'),
(43, 'UP Lipad', 'we''re soarin'', flyin'' Let''s spread our Wings! Love is love. love knows no gender! UPV Lipad', '../images/lipad.jpg'),
(44, 'Greenthumbs', 'Nature Lovers! We care to our Mother Earth', '../images/greenthumbs.jpg'),
(45, 'UPV KAMARAGTAS', 'idk', '../images/kamaragtas.jpg'),
(46, 'Alpha Phi Omega', 'Alpha Phi Omega.', '../images/apo.jpg'),
(47, 'Anakbayan - UPV', 'Mga anak ng bayan. Tuloy-tuloy ang laban para sa bayan!', '../images/anakbayan.jpg'),
(48, 'Armslength Productions - Miagao', 'Abot-kaya mo.', '../images/armslength.jpg'),
(49, 'Belle of the Batallion', 'Army reserve!', '../images/bellebatallion.jpg'),
(50, 'Campus Bible Fellowship', 'We sing praises to the Lord our GOD. amen!', '../images/cbf.jpg'),
(51, 'CFC Youth For Christ', 'Youth For Christ. speaks for it''s name', '../images/cfc yfc.jpg'),
(52, 'Chi Alpha', 'hallelujah', '../images/chialpha.png'),
(53, 'Christian Brotherhood International', 'International Christian Brotherhood Organization', '../images/cbi.jpg'),
(54, 'Christian Student Campus Evangelism Fellowship', 'We Love GOD. we sing praises for him!', '../images/cscef.jpg'),
(55, 'Every Nation Campus', 'LIFE - Leadership, Integrity, Faith and Excellence', '../images/enc.jpg'),
(56, 'Indie Org', 'Independent movie production', '../images/indie.jpg'),
(57, 'Junior People Management Association of the Philippines', 'Association for Junior Management People', '../images/jmap.jpg'),
(58, 'League of Filipino Students', 'Filipino People', '../images/lfs.jpg'),
(59, 'Mind Cooler Club', 'UPV counselors. Angry -> Mind Cooling -> Cool', '../images/mindcooler.jpg'),
(60, 'National Alliance of Youth Leaders', 'We Strive to become better youths', '../images/nayl.png'),
(61, 'UPV Capizeños', 'Artista kung aga, Aswang kung Gab.e!', '../images/capizenyo.jpg'),
(62, 'UP Fight Club', 'Let''s get ready for rumble! 1 2 3 FIGHT!', '../images/fightclub.jpg'),
(63, 'UP Hamilia Sisterhood', 'Female Hamhams', '../images/hamham.jpg'),
(64, 'UP Hamili Brotherhood', 'Male Hamhams', '../images/hamham.jpg'),
(65, 'UP Pandananon', 'From Pandan', '../images/pandanons.jpg'),
(66, 'UP Scintilla Jvris Fraternity', 'Male SJ', '../images/sj.jpg'),
(67, 'UP Validus Amicitia Brotherhood', 'Organizer of HASA.', '../images/va.jpg'),
(68, 'UP Vanguard Fraternity', 'We are strong!', '../images/janina.PNG'),
(69, 'UP Grandstand United Football Club', 'We meet at grandstand, we play at grandstand! we love football!', '../images/Football.jpg'),
(70, 'UPV Guimarasnon', 'From Guimaras! home for the world class mangoes', '../images/guimaras.png'),
(71, 'Oikos', 'Supply and Demand. Economy interests us', '../images/oikos.jpg'),
(72, 'Samaka-ka', 'We fight for people', '../images/samaka.png'),
(73, 'San Joaquinhons', 'SJ na hindi fratsor.', '../images/sanjo.jpg'),
(74, 'Songwriters Philippines - Iloilo', 'Philippine pop music. PPop', '../images/swi.jpg'),
(76, 'UP Stella Juris Sorority', 'Female SJ', '../images/sj.jpg'),
(77, 'UP Beta Sigma Fraternity UPV \r\nChapter', 'Brotherhood!', '../images/betasig.jpg'),
(78, 'UP Sigma Beta Sorority UPV \r\nChapter', 'Sisterhood!', '../images/betasig.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `org_type`
--

CREATE TABLE `org_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `org_type`
--

INSERT INTO `org_type` (`type_id`, `type_name`) VALUES
(1, 'Music'),
(2, 'Dance'),
(3, 'Political'),
(4, 'Writing'),
(5, 'Academic'),
(6, 'Performing'),
(7, 'Religious'),
(8, 'Fraternity / Sorority'),
(9, 'Hobby'),
(10, 'High School'),
(11, 'Service'),
(12, 'Regional / Provincial'),
(13, 'Course'),
(14, 'All');

-- --------------------------------------------------------

--
-- Table structure for table `seen_announcement`
--

CREATE TABLE `seen_announcement` (
  `seen_id` int(100) NOT NULL,
  `seen` enum('seen','not_seen','','') NOT NULL,
  `user_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seen_announcement`
--

INSERT INTO `seen_announcement` (`seen_id`, `seen`, `user_id`, `announcement_id`) VALUES
(1, 'seen', 1, 1),
(2, 'seen', 5, 8),
(3, 'seen', 11, 10),
(4, 'seen', 5, 11),
(5, 'seen', 5, 11),
(6, 'seen', 5, 11),
(8, 'seen', 5, 11),
(10, 'seen', 5, 11),
(12, 'seen', 5, 11),
(13, 'seen', 5, 11),
(14, 'seen', 5, 11),
(15, 'seen', 5, 11),
(16, 'seen', 5, 11),
(17, 'seen', 2, 30),
(18, 'seen', 5, 11),
(19, 'seen', 2, 32),
(20, 'seen', 5, 11),
(21, 'seen', 2, 35),
(22, 'seen', 5, 11),
(23, 'seen', 2, 37),
(24, 'seen', 5, 38),
(25, 'seen', 2, 39),
(26, 'seen', 11, 40),
(27, 'seen', 11, 41),
(28, 'seen', 11, 42),
(29, 'seen', 11, 43),
(30, 'seen', 11, 44),
(31, 'seen', 11, 45),
(32, 'seen', 11, 46),
(33, 'seen', 2, 47),
(34, 'seen', 11, 48),
(35, 'seen', 5, 49),
(36, 'seen', 11, 50),
(37, 'seen', 2, 54),
(38, 'seen', 11, 55),
(39, 'seen', 11, 56),
(40, 'seen', 11, 57),
(41, 'seen', 15, 60),
(42, 'seen', 11, 61),
(43, 'seen', 2, 73),
(44, 'seen', 2, 74),
(45, 'seen', 2, 76),
(46, 'seen', 2, 78),
(47, 'seen', 2, 79),
(48, 'seen', 2, 80),
(49, 'seen', 2, 81);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(50) NOT NULL,
  `student_no` varchar(100) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `password` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `date_joined` date NOT NULL,
  `year_level` int(100) NOT NULL,
  `prof_pic` varchar(150) NOT NULL,
  `birthday` date NOT NULL,
  `email` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `student_no`, `first_name`, `last_name`, `username`, `password`, `course`, `date_joined`, `year_level`, `prof_pic`, `birthday`, `email`) VALUES
(1, '2014-64892', 'Buddy Lane', 'Shimuta', 'BuLShit', 'fc5e038d38a57032085441e7fe7010b0', '---', '1970-01-01', 1, '../images/98tGf8w.png', '1970-01-01', ''),
(2, '2014-15823', 'Hannah Chloie', 'Marba', 'marbasaur', 'eb09d5e396183f4b71c3c798158f7c07', 'BS Computer Science', '2016-11-17', 3, '../images/image.jpg', '1970-01-06', 'hannahmarba@gmail.com'),
(3, '2014-35613', 'Lincy', 'Legada', 'lllegada', '00c798afd4bed3dac3d01ed75fce899d', 'Bachelor of Science in Computer Science', '2016-11-17', 3, '../images/mikoto.jpg', '1970-01-01', ''),
(4, '2014-6969', 'Mocha', 'Uson', 'MarcosPaRin#', 'ce022f27c1f7517d002d6618117efd01', 'BS Walang Pinag-aralan', '2016-11-01', 1, '../images/janina.PNG', '0000-00-00', ''),
(5, '2014-37755', 'Gregg Marionn', 'Icay', 'gregg09', '38337b658d36179f4db94738c28ec614', 'Bachelor of Science in Computer Science', '2016-11-23', 3, '../images/c0b39b383ad4d0d9e7562e716344c272.png', '1997-09-12', 'gmicay123@gmail.com'),
(6, '2014-67832', 'Emmanuel', 'Valaquio', 'NujValaquio101 ', 'ab1952d1ec26669f80d9c01518918388', 'Bachelor of Science in Chemistry', '2016-11-23', 1, 'zeke.jpg', '2016-11-07', 'nuj101nuj@gmail.com'),
(7, '2014-37756', 'Hello', 'World', 'gregg ', 'ea468a1024705bdb3a4dc1999af08212', 'Bachelor of Science in Computer Science', '2016-11-24', 3, '../images/12346352_1149311071748300_3070081871993010060_n.png', '1997-09-12', 'gmicay123@gmail.com'),
(8, '2014-37757', 'Gregg Marionn', 'Icay', 'pokemon ', 'ea468a1024705bdb3a4dc1999af08212', 'Bachelor of Science in Computer Science', '2016-11-24', 3, '../images/TransVC.png', '1997-09-12', 'gmicay123@gmail.com'),
(9, '2014-35611', 'Shyle', 'Juaneza', 'shyleiscool', 'ec03e1e1569581df53838deb199c51b5', 'Bachelor of Arts in Communication and Media Studies', '2016-11-28', 3, '../images/', '1997-05-10', 'shylejuaneza@gmail.com'),
(10, '2014-35611', 'Shyle', 'Juaneza', 'shyleiscool', 'ec03e1e1569581df53838deb199c51b5', 'Bachelor of Arts in Communication and Media Studies', '2016-11-28', 3, '../images/', '1997-05-10', 'shylejuaneza@gmail.com'),
(11, '2014-37556', 'Hayley', 'Williamssss', 'Hayley Williams', '4e25e510bb73f379d9059e5c69d958be', 'Bachelor of Arts in Communication and Media Studies', '2016-12-03', 5, '../images/Paramore-Logo-3-600x250.png', '1988-12-27', 'hayley@gmail.com'),
(12, '2014-37556', 'Hayley', 'Williams', 'Hayley Williams', '4e25e510bb73f379d9059e5c69d958be', 'Bachelor of Arts in Communication and Media Studies', '2016-12-03', 5, '../images/5.jpg', '1988-12-27', 'hayley@gmail.com'),
(13, '2014-37566', 'Hayley', 'Williams', 'hallelujah', '4e25e510bb73f379d9059e5c69d958be', '---', '2016-12-07', 1, '../images/5.jpg', '1989-01-27', 'yelyahwilliams@gmail.com'),
(14, '2014-37566', 'Hayley', 'Williams', 'hallelujah', '4e25e510bb73f379d9059e5c69d958be', '---', '2016-12-07', 1, '../images/5.jpg', '1989-01-27', 'yelyahwilliams@gmail.com'),
(15, '2014-64890', 'Emmanue', 'Valauqio', 'nujVallaquoi', 'ab1952d1ec26669f80d9c01518918388', 'Bachelor of Science in Fisheries', '2016-12-09', 4, '../images/', '2016-12-12', 'nuj101nuj@gmail.com'),
(16, '2014-64890', 'Emmanue', 'Valauqio', 'nujVallaquoi', 'ab1952d1ec26669f80d9c01518918388', '---', '2016-12-09', 1, '../images/', '2016-12-12', 'nuj101nuj@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`announcement_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `classification`
--
ALTER TABLE `classification`
  ADD PRIMARY KEY (`class_id`),
  ADD KEY `org_id` (`org_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `disc_id` (`disc_id`);

--
-- Indexes for table `discuss`
--
ALTER TABLE `discuss`
  ADD PRIMARY KEY (`disc_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `disc_upvote`
--
ALTER TABLE `disc_upvote`
  ADD PRIMARY KEY (`dvID`),
  ADD KEY `disc_id` (`disc_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `joined`
--
ALTER TABLE `joined`
  ADD PRIMARY KEY (`join_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `org_id` (`org_id`);

--
-- Indexes for table `orgs`
--
ALTER TABLE `orgs`
  ADD PRIMARY KEY (`org_id`);

--
-- Indexes for table `org_type`
--
ALTER TABLE `org_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `seen_announcement`
--
ALTER TABLE `seen_announcement`
  ADD PRIMARY KEY (`seen_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `announcement_id` (`announcement_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;
--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `discuss`
--
ALTER TABLE `discuss`
  MODIFY `disc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `disc_upvote`
--
ALTER TABLE `disc_upvote`
  MODIFY `dvID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `joined`
--
ALTER TABLE `joined`
  MODIFY `join_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `orgs`
--
ALTER TABLE `orgs`
  MODIFY `org_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;
--
-- AUTO_INCREMENT for table `org_type`
--
ALTER TABLE `org_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `seen_announcement`
--
ALTER TABLE `seen_announcement`
  MODIFY `seen_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement`
--
ALTER TABLE `announcement`
  ADD CONSTRAINT `announcement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `announcement_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `orgs` (`org_id`);

--
-- Constraints for table `classification`
--
ALTER TABLE `classification`
  ADD CONSTRAINT `classification_ibfk_1` FOREIGN KEY (`org_id`) REFERENCES `orgs` (`org_id`),
  ADD CONSTRAINT `classification_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `org_type` (`type_id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`disc_id`) REFERENCES `discuss` (`disc_id`);

--
-- Constraints for table `discuss`
--
ALTER TABLE `discuss`
  ADD CONSTRAINT `discuss_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `discuss_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `orgs` (`org_id`);

--
-- Constraints for table `disc_upvote`
--
ALTER TABLE `disc_upvote`
  ADD CONSTRAINT `disc_upvote_ibfk_1` FOREIGN KEY (`disc_id`) REFERENCES `discuss` (`disc_id`),
  ADD CONSTRAINT `disc_upvote_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Constraints for table `joined`
--
ALTER TABLE `joined`
  ADD CONSTRAINT `joined_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `joined_ibfk_2` FOREIGN KEY (`org_id`) REFERENCES `orgs` (`org_id`);

--
-- Constraints for table `seen_announcement`
--
ALTER TABLE `seen_announcement`
  ADD CONSTRAINT `seen_announcement_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `seen_announcement_ibfk_2` FOREIGN KEY (`announcement_id`) REFERENCES `announcement` (`announcement_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
