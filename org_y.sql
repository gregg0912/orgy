-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 12, 2016 at 09:19 PM
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
(4, '2016-12-11 04:45:12', 'Bieber', 'Gonna choose die here haha', 2, 41),
(5, '2016-12-11 03:54:00', 'Hello', 'How Are You? Can you tell me your name?', 2, 41),
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
(46, '2016-12-06 02:32:30', 'Kicked', 'Admin marbasaur kicked Hayley Williamssss from the org.', 2, 41),
(47, '2016-12-06 02:33:16', 'Request', 'Hayley Williamswishes to join this group.', 11, 41),
(48, '2016-12-06 02:34:27', 'Accepted', 'Admin marbasaur accepted the request of Hayley Williamssss to join the org.', 2, 41),
(49, '2016-12-06 02:34:41', 'Rejected', 'Admin marbasaur rejected the request of Gregg Marionn Icay to join the org.', 2, 41),
(50, '2016-12-12 04:08:22', 'Hayley!', 'You should be reading this. Start&#039;s\r\n\r\n\r\nlol', 2, 41),
(51, '2016-12-08 01:23:21', 'Request', 'Hayley Williamswishes to join this group.', 11, 2),
(52, '2016-12-08 02:10:17', 'Request', 'Hayley Williamswishes to join this group.', 11, 3),
(53, '2016-12-08 02:38:13', 'Request', 'marbasaurwishes to join this group.', 2, 11),
(54, '2016-12-08 02:38:52', 'Request', 'gregg0912 wishes to join this group.', 5, 41),
(55, '2016-12-11 03:52:13', 'helloooo', 'hellloool test lang wag omona', 2, 41),
(56, '2016-12-11 03:51:32', 'helloooo', 'kakahiya talaga maygad', 2, 41),
(58, '2016-12-09 04:50:32', 'Request', 'nujVallaquoiwishes to join this group.', 15, 1),
(59, '2016-12-09 04:52:14', 'Request', 'nujVallaquoiwishes to join this group.', 15, 49),
(60, '2016-12-09 04:54:02', 'Accepted', 'Admin marbasaur accepted the request of Emmanue Valauqio to join the org.', 2, 1),
(61, '2016-12-11 11:03:19', 'Rejected', 'Admin marbasaur rejected the request of Hayley Williamssss to join the org because she can and she is such a rebel :).', 2, 1),
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
(83, '2016-12-09 09:00:42', 'Request', 'marbasaur cancelled their request to join UP Tubong Mindanao.', 2, 8),
(84, '2016-12-10 05:54:08', 'Request', 'gregg09 wishes to join UPV Sakdag.', 5, 41),
(85, '2016-12-10 05:54:13', 'Request', 'gregg09 cancelled their request to join UPV Sakdag.', 5, 41),
(86, '2016-12-10 05:57:53', 'Request', 'gregg0912 wishes to join UPV Sakdag.', 5, 41),
(87, '2016-12-10 05:57:56', 'Request', 'gregg0912 cancelled their request to join UPV Sakdag.', 5, 41),
(88, '2016-12-12 04:10:10', 'Stop it', 'tuwang-tuwa ako\r\npero tama na to', 2, 1),
(90, '2016-12-11 01:11:43', 'Request', 'kladmin does not need permission to join UPV KaLuzon. kladmin does what he wants.', 17, 39),
(91, '2016-12-11 04:06:30', 'Hello', 'Marbasaur i can see you', 17, 39),
(92, '2016-12-11 04:38:02', 'huwat&#039;', 'lalala\r\n\r\nlalala', 2, 1),
(93, '2016-12-12 04:04:21', 'Upvote', 'marbasaur upvoted your post on December 05, 2016 01:31:03 am entitled hello', 5, 1),
(94, '2016-12-12 04:09:59', 'allow', 'allow\r\nallow\r\nallow', 2, 1),
(95, '2016-12-12 10:10:55', 'Kicked', 'Admin kladmin kicked Hannah Chloie Marba from the org.', 17, 39),
(96, '2016-12-12 06:18:24', 'Request', 'kladmin wishes to join Elektrons.', 17, 1),
(97, '2016-12-12 06:18:35', 'Request', 'kladmin wishes to join UPV Sakdag.', 17, 41),
(98, '2016-12-12 06:20:13', 'testing', 'testing', 2, 41),
(99, '2016-12-12 06:24:48', 'Accepted', 'Admin marbasaur accepted the request of Ka Luzon to join the org.', 2, 1),
(100, '2016-12-12 06:24:58', 'Rejected', 'Admin marbasaur rejected the request of Ka Luzon to join the org.', 2, 41),
(101, '2016-12-12 06:26:50', 'Kicked', 'Admin marbasaur kicked Ka Luzon from the org.', 2, 1),
(102, '2016-12-12 06:27:50', 'Request', 'kladmin wishes to join Elektrons.', 17, 1),
(103, '2016-12-12 06:28:26', 'Accepted', 'Admin marbasaur accepted the request of Ka Luzon to join the org.', 2, 1),
(104, '2016-12-12 06:33:25', 'announcement!', 'gusto ko lang mag-announce haha tapusa niyo na thesis niyo.', 2, 1),
(105, '2016-12-12 18:36:54', 'the only exception', 'oh and i&#039;m on my way to believing', 2, 1),
(106, '2016-12-12 18:38:30', 'Request', 'kladmin wishes to join UPV Sakdag.', 17, 41),
(107, '2016-12-12 18:44:50', 'ain&#039;t it fun', '&#039;cause you&#039;re on your own in the real world', 2, 1),
(108, '2016-12-12 18:48:39', 'PM/AM', 'PM na plssss', 2, 1),
(109, '2016-12-12 22:18:33', 'Request', 'adminacc wishes to join Elektrons.', 19, 1),
(110, '2016-12-12 22:18:47', 'Request', 'adminacc wishes to join UPV Sakdag.', 19, 41),
(111, '2016-12-12 22:19:04', 'Request', 'adminacc wishes to join UPV KaLuzon.', 19, 39),
(112, '2016-12-12 22:19:35', 'Accepted', 'Admin marbasaur accepted the request of Adminer Accounter to join the org.', 2, 1),
(113, '2016-12-12 22:19:35', 'Accepted', 'Admin marbasaur accepted the request of Adminer Accounter to join the org.', 2, 1),
(114, '2016-12-12 22:19:46', 'Rejected', 'Admin marbasaur rejected the request of Ka Luzon to join the org.', 2, 41),
(115, '2016-12-12 22:19:48', 'Accepted', 'Admin marbasaur accepted the request of Adminer Accounter to join the org.', 2, 41),
(116, '2016-12-12 22:21:20', 'Accepted', 'Admin kladmin accepted the request of Adminer Accounter to join the org.', 17, 39),
(117, '2016-12-12 22:24:24', 'Kicked', 'Admin marbasaur kicked Adminer Accounter from the org.', 2, 41),
(118, '2016-12-12 22:24:39', 'Kicked', 'Admin marbasaur kicked Adminer Accounter from the org.', 2, 1),
(119, '2016-12-12 22:25:07', 'Request', 'adminacc wishes to join Elektrons.', 19, 1),
(120, '2016-12-12 22:25:13', 'Request', 'adminacc wishes to join Redbolts.', 19, 2),
(121, '2016-12-12 22:25:21', 'Request', 'adminacc wishes to join UPV Sakdag.', 19, 41),
(122, '2016-12-12 22:29:38', 'Commented', 'adminacc commented on your post on 2016-12-04 03:39:05 entitled hello', 2, 39),
(123, '2016-12-12 22:30:22', 'Accepted', 'Admin marbasaur accepted the request of Adminer Accounter to join the org.', 2, 1),
(124, '2016-12-12 22:30:30', 'Accepted', 'Admin marbasaur accepted the request of Adminer Accounter to join the org.', 2, 41),
(125, '2016-12-12 22:32:42', 'Commented', 'adminacc commented on your post on 2016-12-12 03:52:03 entitled topic', 2, 1),
(126, '2016-12-12 23:35:38', 'Request', 'marbasaur wishes to join UPV KaLuzon.', 2, 39),
(127, '2016-12-12 23:35:51', 'Accepted', 'Admin kladmin accepted the request of Hannah Chloie Marba to join the org.', 17, 39),
(128, '2016-12-12 23:36:51', 'Commented', 'kladmin commented on your post on 2016-12-12 23:36:17 entitled topic', 2, 39),
(129, '2016-12-12 23:37:03', 'Commented', 'kladmin commented on your post on 2016-12-12 23:36:17 entitled topic', 2, 39),
(130, '2016-12-12 23:39:35', 'Request', 'marbasaur wishes to join UPV KaLuzon.', 2, 39),
(131, '2016-12-12 23:39:46', 'Accepted', 'Admin kladmin accepted the request of Hannah Chloie Marba to join the org.', 17, 39),
(132, '2016-12-12 23:41:09', 'Request', 'marbasaur wishes to join UPV KaLuzon.', 2, 39),
(133, '2016-12-12 23:41:29', 'Accepted', 'Admin kladmin accepted the request of Hannah Chloie Marba to join the org.', 17, 39),
(134, '2016-12-12 23:43:12', 'Request', 'marbasaur wishes to join UPV KaLuzon.', 2, 39),
(135, '2016-12-12 23:43:27', 'Accepted', 'Admin kladmin accepted the request of Hannah Chloie Marba to join the org.', 17, 39),
(136, '2016-12-12 23:46:42', 'Kicked', 'Admin kladmin kicked   from the org.', 17, 39),
(137, '2016-12-12 23:47:31', 'Request', 'marbasaur wishes to join UPV KaLuzon.', 2, 39),
(138, '2016-12-12 23:47:47', 'Accepted', 'Admin kladmin accepted the request of Hannah Chloie Marba to join the org.', 17, 39),
(139, '2016-12-12 23:48:03', 'Kicked', 'Admin kladmin kicked Hannah Chloie Marba from the org.', 17, 39),
(140, '2016-12-12 23:52:34', 'Request', 'marbasaur wishes to join UPV KaLuzon.', 2, 39),
(141, '2016-12-12 23:52:57', 'Accepted', 'Admin kladmin accepted the request of Hannah Chloie Marba to join the org.', 17, 39),
(142, '2016-12-12 23:55:56', 'Kicked', 'Admin kladmin kicked Hannah Chloie Marba from the org.', 17, 39),
(143, '2016-12-13 01:31:10', 'psoting', 'psooooting', 2, 1),
(144, '2016-12-13 02:05:09', 'Upvote', 'root upvoted your post on December 13, 2016 02:04:11 am entitled sample topic', 2, 1),
(146, '2016-12-13 02:05:27', 'Upvote', 'gregg0912 upvoted your post entitled sample topic', 2, 1),
(147, '2016-12-13 02:05:47', 'Commented', 'gregg0912 commented on your post entitled sample topic', 2, 1),
(148, '2016-12-13 02:06:00', 'Commented', 'gregg0912 commented on your post entitled sample topic', 2, 1),
(149, '2016-12-13 02:06:09', 'Commented', 'gregg0912 commented on your post entitled sample topic', 2, 1),
(150, '2016-12-13 02:07:50', 'Commented', 'gregg0912 commented on your post entitled sample topic', 2, 1),
(152, '2016-12-13 02:17:24', 'Upvote', 'marbasaur upvoted your post entitled hello', 5, 1),
(153, '2016-12-13 02:17:53', 'Upvote', 'root upvoted your post entitled why', 5, 1),
(154, '2016-12-13 02:21:37', 'Upvote', 'root upvoted your post entitled topic', 2, 1),
(157, '2016-12-13 02:31:02', 'Upvote', 'gregg0912 upvoted your post entitled topic', 2, 1),
(158, '2016-12-13 02:45:35', 'Upvote', 'gregg0912 upvoted your post entitled topic', 2, 1),
(160, '2016-12-13 02:46:03', 'Upvote', 'root upvoted your post entitled hello', 2, 1),
(162, '2016-12-13 03:10:37', 'Upvote', 'gregg0912 upvoted your post entitled topic', 2, 1),
(163, '2016-12-13 03:11:47', 'Commented', 'marbasaur commented on your post entitled marbasaur', 5, 1),
(164, '2016-12-13 03:11:55', 'Upvote', 'root upvoted your post entitled marbasaur', 5, 1),
(165, '2016-12-13 03:12:00', 'Upvote', 'root upvoted your post entitled marbasaur', 5, 1),
(166, '2016-12-13 03:29:31', 'Upvote', 'root upvoted your post entitled hello', 5, 1),
(167, '2016-12-13 03:31:03', 'Upvote', 'root upvoted your post entitled pampadamo', 5, 1),
(169, '2016-12-13 03:31:13', 'Upvote', 'root upvoted your post entitled more', 5, 1),
(172, '2016-12-13 03:31:26', 'Upvote', 'marbasaur upvoted your post entitled more', 5, 1),
(173, '2016-12-13 03:43:12', 'Upvote', 'marbasaur upvoted your post entitled topic nanaman', 5, 1),
(174, '2016-12-13 03:43:16', 'Upvote', 'marbasaur upvoted your post entitled topic', 5, 1),
(177, '2016-12-13 03:48:07', 'Downvote', 'marbasaur downvoted your post entitled topic nanaman', 5, 1),
(178, '2016-12-13 03:48:20', 'Upvote', 'marbasaur upvoted your post entitled topic', 5, 1),
(179, '2016-12-13 03:48:26', 'Upvote', 'marbasaur upvoted your post entitled more', 5, 1);

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
(12, 'pwede pa-try? :)', '2016-12-04 12:08:34', 4, 5),
(13, 'comments', '2016-12-05 01:40:06', 1, 5),
(14, 'nami ni siya na discussion page i like it', '2016-12-08 21:51:11', 37, 2),
(15, 'dddqw', '2016-12-09 11:59:40', 34, 15),
(16, 'comment\r\ncomment\r\ncomment', '2016-12-12 03:52:18', 39, 2),
(17, 'comment lololol', '2016-12-12 18:17:57', 39, 2),
(19, 'comment rin ako. labyu sempai', '2016-12-12 22:32:42', 39, 19),
(23, 'hi sa&#039;yo dyan', '2016-12-13 02:07:38', 45, 5),
(24, 'hihihihihi should i start bashing?&#039;;', '2016-12-13 02:07:50', 45, 5),
(25, 'noticed wag ambisyosa hahahahahah', '2016-12-13 03:11:47', 49, 2);

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
(4, 'hello', 'gusto ko magdiscuss oops wrong', '2016-11-24 00:00:00', 2, 1, 1),
(5, 'discuss', 'discusss', '2016-11-24 00:00:00', 8, 1, 1),
(6, 'hhh', 'kkkk', '2016-11-24 00:00:00', 5, 6, -1),
(7, 'Choy topic happy', 'Choy topic commentssss yes happy\r\n', '2016-12-11 19:33:17', 2, 1, 1),
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
(19, 'title and content222', 'title and content222', '2016-11-28 00:00:00', 4, 41, 1),
(20, 'title and content222112', 'title and content222121', '2016-11-28 00:00:00', 3, 41, 0),
(21, 'title and content25523', 'title and content2124', '2016-11-28 00:00:00', 7, 41, 0),
(22, 'title and content209', 'title and content290', '2016-11-28 00:00:00', 6, 41, 0),
(23, 'title and content2', '12432', '2016-11-28 00:00:00', 7, 41, 0),
(24, 'title and content21256', 'title and content289032', '2016-11-28 00:00:00', 5, 41, 1),
(25, 'censored', 'censored', '2016-11-28 02:11:50', 2, 41, -2),
(26, 'hello', 'world', '2016-11-29 14:14:33', 5, 6, -1),
(27, 'hello', 'cyra from isran', '2016-11-30 19:23:05', 5, 6, -1),
(31, 'hello', 'diyan', '2016-12-04 05:01:38', 2, 21, 0),
(32, 'hello', 'kulas bebe loves', '2016-12-04 05:06:48', 5, 1, 0),
(33, 'why', 'are you late?', '2016-12-04 05:07:34', 5, 1, 0),
(34, 'That&#039;s what you get', 'Paramore', '2016-12-04 05:12:47', 5, 1, 0),
(35, 'si gregg0912', 'wag siya papapasukin sa group na&#039;to please', '2016-12-04 12:16:37', 11, 41, 1),
(36, 'hello', 'nanamanaasdfagg', '2016-12-05 01:31:03', 5, 1, 2),
(37, 'FOB', 'yehey yooo', '2016-12-11 16:48:57', 2, 22, 0),
(38, 'post', 'postttt', '2016-12-11 19:33:26', 2, 1, -1),
(39, 'topic', 'comment\r\ncomment\r\ncomment', '2016-12-12 03:52:03', 2, 1, 2),
(40, 'discussion', 'discussion', '2016-12-12 18:23:13', 2, 41, 0),
(41, 'pagination', 'lumabas ka', '2016-12-12 19:00:25', 2, 41, 0),
(42, 'pagination', 'pagination where?\r\n\r\nwhere', '2016-12-12 19:00:45', 2, 41, 0),
(45, 'sample topic', 'sample comment\r\nsample comment\r\nsample comment', '2016-12-13 02:04:11', 2, 1, 1),
(46, 'topic', 'topic\r\npero\r\ncomment\r\nlol', '2016-12-13 02:27:00', 2, 1, 2),
(47, 'topic', 'topic pero comment', '2016-12-13 02:27:13', 2, 1, 0),
(48, 'marbasaur', 'marbasaur simpai please notice this pleb', '2016-12-13 03:09:48', 5, 1, 1),
(49, 'marbasaur', 'marbasaur simpai please notice this pleb', '2016-12-13 03:09:50', 5, 1, 1),
(50, 'pampadamo', 'sang comments', '2016-12-13 03:16:44', 5, 1, 1),
(51, 'pamadamo', 'sang comments', '2016-12-13 03:17:01', 5, 1, -1),
(52, 'more', 'comments', '2016-12-13 03:17:16', 5, 1, -1),
(53, 'more', 'comments', '2016-12-13 03:17:30', 5, 1, 1),
(54, 'topic', 'content', '2016-12-13 03:42:25', 5, 1, 1),
(55, 'topic', 'AND CONTENT', '2016-12-13 03:42:36', 5, 1, 1),
(56, 'topic nanaman', 'at syempre may content', '2016-12-13 03:42:54', 5, 1, -1);

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
(18, 19, 2, 'upvote'),
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
(31, 36, 2, 'upvote'),
(32, 33, 15, 'downvote'),
(33, 39, 2, 'upvote'),
(34, 7, 2, 'upvote'),
(35, 45, 5, 'upvote'),
(36, 33, 2, 'upvote'),
(37, 39, 5, 'upvote'),
(38, 38, 5, 'downvote'),
(39, 47, 2, 'upvote'),
(40, 46, 2, 'upvote'),
(41, 47, 5, 'downvote'),
(42, 46, 5, 'upvote'),
(43, 4, 5, 'upvote'),
(44, 49, 2, 'upvote'),
(45, 48, 2, 'upvote'),
(46, 36, 5, 'upvote'),
(47, 50, 2, 'upvote'),
(48, 51, 2, 'downvote'),
(49, 52, 2, 'downvote'),
(50, 53, 2, 'upvote'),
(51, 56, 2, 'downvote'),
(52, 55, 2, 'upvote'),
(53, 54, 2, 'upvote');

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
(65, 15, 49, 'pending', '2016-12-09'),
(84, 17, 39, 'admin', '2016-12-11'),
(87, 17, 1, 'member', '2016-12-12'),
(91, 19, 39, 'member', '2016-12-12'),
(92, 19, 1, 'member', '2016-12-12'),
(93, 19, 2, 'pending', '2016-12-12'),
(94, 19, 41, 'member', '2016-12-12');

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
(32, 'seen', 11, 46),
(33, 'seen', 2, 47),
(34, 'seen', 11, 48),
(35, 'seen', 5, 49),
(36, 'seen', 11, 50),
(37, 'seen', 2, 54),
(38, 'seen', 11, 55),
(39, 'seen', 11, 56),
(41, 'seen', 15, 60),
(42, 'seen', 11, 61),
(43, 'seen', 2, 73),
(44, 'seen', 2, 74),
(45, 'seen', 2, 76),
(46, 'seen', 2, 78),
(47, 'seen', 2, 79),
(48, 'seen', 2, 80),
(49, 'seen', 2, 81),
(50, 'seen', 2, 84),
(51, 'seen', 2, 85),
(52, 'seen', 2, 86),
(53, 'seen', 2, 87),
(54, 'seen', 1, 88),
(55, 'seen', 3, 88),
(56, 'seen', 5, 88),
(57, 'seen', 8, 88),
(58, 'seen', 15, 88),
(64, 'seen', 2, 91),
(65, 'seen', 1, 88),
(66, 'seen', 3, 88),
(67, 'seen', 5, 88),
(68, 'seen', 8, 88),
(69, 'seen', 15, 88),
(70, 'seen', 5, 93),
(71, 'seen', 1, 94),
(72, 'seen', 3, 94),
(73, 'seen', 5, 94),
(74, 'seen', 8, 94),
(75, 'seen', 15, 94),
(76, 'seen', 2, 95),
(77, 'seen', 2, 96),
(78, 'seen', 2, 97),
(79, 'seen', 11, 98),
(80, 'seen', 17, 99),
(81, 'seen', 17, 100),
(82, 'seen', 17, 101),
(83, 'seen', 2, 102),
(84, 'seen', 17, 103),
(85, 'seen', 1, 104),
(86, 'seen', 3, 104),
(87, 'seen', 5, 104),
(88, 'seen', 8, 104),
(89, 'seen', 15, 104),
(90, 'seen', 17, 104),
(91, 'seen', 1, 105),
(92, 'seen', 3, 105),
(93, 'seen', 5, 105),
(94, 'seen', 8, 105),
(95, 'seen', 15, 105),
(96, 'seen', 17, 105),
(97, 'seen', 2, 106),
(98, 'seen', 1, 107),
(99, 'seen', 3, 107),
(100, 'seen', 5, 107),
(101, 'seen', 8, 107),
(102, 'seen', 15, 107),
(103, 'seen', 17, 107),
(104, 'seen', 1, 108),
(105, 'seen', 3, 108),
(106, 'seen', 5, 108),
(107, 'seen', 8, 108),
(108, 'seen', 15, 108),
(109, 'seen', 17, 108),
(110, 'seen', 2, 109),
(111, 'seen', 2, 110),
(112, 'seen', 17, 111),
(113, 'seen', 19, 112),
(114, 'seen', 19, 113),
(115, 'seen', 17, 114),
(116, 'seen', 19, 115),
(117, 'seen', 19, 116),
(118, 'seen', 19, 117),
(119, 'seen', 19, 118),
(120, 'seen', 2, 119),
(121, 'seen', 2, 121),
(122, 'seen', 2, 122),
(123, 'seen', 19, 123),
(124, 'seen', 19, 124),
(125, 'seen', 2, 125),
(126, 'seen', 17, 126),
(127, 'seen', 2, 127),
(128, 'seen', 2, 128),
(129, 'seen', 2, 129),
(130, 'seen', 17, 130),
(131, 'seen', 2, 131),
(132, 'seen', 17, 132),
(133, 'seen', 2, 133),
(134, 'seen', 17, 134),
(135, 'seen', 2, 135),
(137, 'seen', 17, 137),
(138, 'seen', 2, 138),
(139, 'seen', 2, 139),
(140, 'seen', 17, 140),
(141, 'seen', 2, 141),
(142, 'seen', 2, 142),
(143, 'not_seen', 1, 143),
(144, 'not_seen', 3, 143),
(145, 'seen', 5, 143),
(146, 'not_seen', 8, 143),
(147, 'not_seen', 15, 143),
(148, 'not_seen', 17, 143),
(149, 'not_seen', 19, 143),
(150, 'seen', 2, 144),
(151, 'seen', 2, 146),
(152, 'seen', 2, 147),
(153, 'seen', 2, 148),
(154, 'seen', 2, 149),
(155, 'seen', 2, 150),
(156, 'seen', 5, 152),
(157, 'seen', 5, 153),
(158, 'seen', 2, 154),
(159, 'seen', 2, 157),
(160, 'seen', 2, 158),
(161, 'seen', 2, 160),
(162, 'seen', 2, 162),
(163, 'seen', 5, 163),
(164, 'seen', 5, 164),
(165, 'seen', 5, 165),
(166, 'seen', 5, 167),
(167, 'seen', 5, 169),
(168, 'seen', 5, 172),
(169, 'seen', 5, 173),
(170, 'seen', 5, 174),
(171, 'seen', 5, 177),
(172, 'seen', 5, 178),
(173, 'seen', 5, 179);

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
(2, '2014-15823', 'Hannah Chloie', 'Marba', 'marbasaur', 'f29bfcf86e073e184d50a9eb9b285c60', 'BS Computer Science', '2016-11-17', 4, '../images/image.jpg', '1970-01-01', 'hannahmarba@gmail.com'),
(3, '2014-35613', 'Lincy', 'Legada', 'lllegada', '00c798afd4bed3dac3d01ed75fce899d', 'Bachelor of Science in Computer Science', '2016-11-17', 3, '../images/mikoto.jpg', '1970-01-01', ''),
(4, '2014-6969', 'Mocha', 'Uson', 'MarcosPaRin#', 'ce022f27c1f7517d002d6618117efd01', 'BS Walang Pinag-aralan', '2016-11-01', 1, '../images/janina.PNG', '0000-00-00', ''),
(5, '2014-37755', 'Gregg Marionn', 'Icay', 'gregg0912', '1e47eac4cea67ca5a85cbd812a8c1a36', 'Bachelor of Science in Computer Science', '2016-11-23', 4, '../images/12346352_1149311071748300_3070081871993010060_n.png', '1970-01-01', 'gmicay123@gmail.com'),
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
(16, '2014-64890', 'Emmanue', 'Valauqio', 'nujVallaquoi', 'ab1952d1ec26669f80d9c01518918388', '---', '2016-12-09', 1, '../images/', '2016-12-12', 'nuj101nuj@gmail.com'),
(17, '2014-37557', 'Ka', 'Luzon', 'kladmin', 'f5494623430e0a68e11e87950aaed329', '---', '2016-12-11', 1, '../images/', '1997-09-12', 'kladmin@gmail.com'),
(18, '2014-37557', 'Ka', 'Luzon', 'kladmin', 'f5494623430e0a68e11e87950aaed329', '---', '2016-12-11', 1, '../images/', '1997-09-12', 'kladmin@gmail.com'),
(19, '2014-37759', 'Adminer', 'Accounter', 'adminacc', '0192023a7bbd73250516f069df18b500', 'Bachelor of Science in Fisheries', '2016-12-12', 1, '../images/tumblr_o462ojaOSF1uya0j9o1_400.png', '0000-00-00', 'gmicay123@gmail.com');

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
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=180;
--
-- AUTO_INCREMENT for table `classification`
--
ALTER TABLE `classification`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `discuss`
--
ALTER TABLE `discuss`
  MODIFY `disc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
--
-- AUTO_INCREMENT for table `disc_upvote`
--
ALTER TABLE `disc_upvote`
  MODIFY `dvID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `joined`
--
ALTER TABLE `joined`
  MODIFY `join_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
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
  MODIFY `seen_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
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
