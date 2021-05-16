-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 07:47 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `notesmarketplace`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `countrycode` varchar(100) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `countrycode`, `createddate`, `createdby`, `modifieddate`, `modifedby`, `isactive`) VALUES
(1, 'India', '91', NULL, NULL, NULL, NULL, b'1'),
(2, 'USA', '1', NULL, NULL, NULL, NULL, b'1'),
(3, 'UK', '44', '2021-04-02 15:35:27', NULL, NULL, NULL, b'1'),
(4, 'Japan', '81', '2021-04-16 15:57:58', NULL, '2021-04-16 15:57:58', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

CREATE TABLE `downloads` (
  `id` int(11) NOT NULL,
  `noteid` int(11) NOT NULL,
  `seller` int(11) NOT NULL,
  `downloader` int(11) NOT NULL,
  `issellerhasalloweddownload` bit(1) NOT NULL,
  `attachmentpath` varchar(1000) DEFAULT NULL,
  `isattachmentdownloaded` bit(1) NOT NULL,
  `attachmentdownloadeddate` datetime DEFAULT NULL,
  `ispaid` bit(1) NOT NULL,
  `purchasedprice` decimal(10,0) DEFAULT NULL,
  `notetitle` varchar(100) NOT NULL,
  `notecategory` varchar(100) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `downloads`
--

INSERT INTO `downloads` (`id`, `noteid`, `seller`, `downloader`, `issellerhasalloweddownload`, `attachmentpath`, `isattachmentdownloaded`, `attachmentdownloadeddate`, `ispaid`, `purchasedprice`, `notetitle`, `notecategory`, `createddate`, `createdby`, `modifieddate`, `modifiedby`) VALUES
(2, 24, 17, 16, b'1', 'banner.png', b'1', '2021-03-11 16:21:48', b'1', '0', 'python', '1', NULL, NULL, NULL, NULL),
(5, 24, 17, 16, b'0', 'banner.png', b'1', '2021-04-02 00:04:23', b'1', '0', 'python', '1', NULL, NULL, NULL, NULL),
(69, 1, 17, 16, b'1', 'banner.png', b'0', '2021-03-18 10:57:38', b'1', '80', 'php', '1', NULL, NULL, NULL, NULL),
(70, 1, 15, 16, b'1', '', b'0', NULL, b'1', '100', 'php', '1', NULL, NULL, NULL, NULL),
(77, 1, 15, 16, b'0', '', b'0', NULL, b'1', '100', 'php', '1', '2021-04-14 23:26:46', 16, '2021-04-14 23:26:46', 16),
(78, 1, 15, 16, b'0', 'banner.png', b'0', '2021-03-09 18:22:07', b'1', '100', 'php', '1', '2021-04-15 18:02:47', 16, '2021-04-15 18:02:47', 16),
(80, 24, 16, 17, b'1', 'banner.png', b'0', '2021-04-01 16:21:40', b'1', '12', 'python', '1', '2021-04-15 23:36:22', 16, '2021-04-15 23:36:22', 16),
(81, 44, 16, 17, b'1', '../Members/16/44/Attachements/Attachement_0_120521093454.pdf', b'1', '2021-05-12 18:48:39', b'0', NULL, 'summer', 'History', '2021-05-12 18:48:39', 16, '2021-05-12 18:48:39', 16),
(82, 44, 16, 20, b'1', '../Members/16/44/Attachements/Attachement_0_120521093454.pdf', b'1', '2021-05-16 17:38:04', b'0', NULL, 'summer', 'History', '2021-05-16 17:38:04', 20, '2021-05-16 17:38:04', 20);

-- --------------------------------------------------------

--
-- Table structure for table `notecategories`
--

CREATE TABLE `notecategories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notecategories`
--

INSERT INTO `notecategories` (`id`, `name`, `description`, `createddate`, `createdby`, `modifieddate`, `modifedby`, `isactive`) VALUES
(1, 'computer science', 'this book is very interesting.', NULL, NULL, NULL, NULL, b'1'),
(2, 'IT', 'this book is very interesting.', NULL, NULL, NULL, NULL, b'1'),
(3, 'History', 'knowledge of past', '2021-04-16 16:18:33', NULL, '2021-04-16 16:18:33', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `notetypes`
--

CREATE TABLE `notetypes` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notetypes`
--

INSERT INTO `notetypes` (`id`, `name`, `description`, `createddate`, `createdby`, `modifieddate`, `modifedby`, `isactive`) VALUES
(1, 'Handwritten Notes', 'it is a handwritten notes.', NULL, NULL, NULL, NULL, b'1'),
(2, 'Story Books', 'it is a story book.', NULL, NULL, NULL, NULL, b'1'),
(3, 'Novel', 'novel book is very interesting.', '2021-04-16 16:56:12', NULL, '2021-04-16 16:56:12', NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `referencedata`
--

CREATE TABLE `referencedata` (
  `id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `datavalue` varchar(100) NOT NULL,
  `refcategory` varchar(100) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `referencedata`
--

INSERT INTO `referencedata` (`id`, `value`, `datavalue`, `refcategory`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 'Draft', 'draft', 'Notestatus', NULL, NULL, NULL, NULL, b'1'),
(2, 'Published', 'published', 'Notestatus', NULL, NULL, NULL, NULL, b'1'),
(3, 'Inreview', 'inreview', 'Notestatus', NULL, NULL, NULL, NULL, b'1'),
(4, 'Rejected', 'rejected', 'Notestatus', NULL, NULL, NULL, NULL, b'1'),
(5, 'submit for review', 'submit for review', 'Notestatus', NULL, NULL, NULL, NULL, b'1'),
(6, 'Removed', 'removed', 'Notestatus', NULL, NULL, NULL, NULL, b'1'),
(7, 'Male', 'M', 'Gender', NULL, NULL, NULL, NULL, b'1'),
(8, 'Female', 'F', 'Gender', NULL, NULL, NULL, NULL, b'1'),
(9, 'Unknown', 'U', 'Gender', NULL, NULL, NULL, NULL, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotes`
--

CREATE TABLE `sellernotes` (
  `id` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `actionedby` int(11) DEFAULT NULL,
  `adminremarks` varchar(1000) DEFAULT NULL,
  `publisheddate` datetime DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `category` int(11) NOT NULL,
  `displaypicture` varchar(500) DEFAULT NULL,
  `notetype` int(11) DEFAULT NULL,
  `numberofpages` int(11) DEFAULT NULL,
  `description` varchar(1000) NOT NULL,
  `universityname` varchar(200) DEFAULT NULL,
  `country` int(11) DEFAULT NULL,
  `course` varchar(100) DEFAULT NULL,
  `coursecode` varchar(100) DEFAULT NULL,
  `professor` varchar(100) DEFAULT NULL,
  `ispaid` bit(1) NOT NULL,
  `sellingprice` decimal(10,0) DEFAULT NULL,
  `notespreview` varchar(1000) DEFAULT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotes`
--

INSERT INTO `sellernotes` (`id`, `sellerid`, `status`, `actionedby`, `adminremarks`, `publisheddate`, `title`, `category`, `displaypicture`, `notetype`, `numberofpages`, `description`, `universityname`, `country`, `course`, `coursecode`, `professor`, `ispaid`, `sellingprice`, `notespreview`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 15, 1, 15, NULL, '2021-04-02 18:23:59', 'php', 1, 'C:\\xampp\\htdocs\\notesmarketplace\\front\\images\\note-details', 1, 100, 'nice book', 'IIT', 1, 'php', '03', 'stive harvard', b'1', '100', NULL, NULL, NULL, NULL, NULL, b'0'),
(22, 15, 6, 15, NULL, '2021-03-03 00:00:00', 'xy', 1, 'note-img.jpeg', 1, 0, 'asd', '', 1, '', '', '', b'0', '0', 'SUCCESS.png', NULL, NULL, NULL, NULL, b'0'),
(24, 15, 6, 15, NULL, '2021-03-08 00:16:29', 'python', 1, 'banner.jpg', 1, 2, 'hjk', 'IIM', 1, 'xyz', '03', 'xyz', b'1', '12', 'logo.png', NULL, NULL, NULL, NULL, b'0'),
(35, 16, 1, 16, NULL, '2021-03-16 18:23:00', 'science', 1, 'avatar.png', 1, 100, 'bn', 'IIT', 1, 'science', '02', 'peter', b'0', '0', 'banner.jpg', NULL, NULL, NULL, NULL, b'0'),
(37, 16, 1, 16, NULL, '2021-02-16 16:44:08', 'system', 1, 'download.png', 1, 100, 'mn', 'IIT', 1, 'xyz', '02', 'xyz', b'1', '200', 'logo.png', '2021-03-03 00:00:00', NULL, '2021-03-03 00:00:00', NULL, b'0'),
(38, 16, 1, 16, 'lorem ghtsfgd ghdha', '2021-02-18 00:00:00', 'system', 1, 'download.png', 1, 100, 'mn', 'IIT', 1, 'xyz', '02', 'xyz', b'1', '200', 'logo.png', NULL, NULL, '2021-04-16 17:23:48', NULL, b'0'),
(39, 16, 1, 16, NULL, '2021-03-10 18:23:08', 'software design', 1, 'avatar.png', 1, 100, 'mnb', 'IIM', 1, 'python', '03', 'peter', b'1', '200', 'banner.jpg', NULL, NULL, NULL, NULL, b'0'),
(40, 16, 1, 16, NULL, NULL, 'example', 1, 'banner.jpg', 1, 100, 'kjfjgkj', 'IIM', 1, 'xyz', '03', 'xyz', b'1', '200', 'logo.png', '2021-04-17 14:36:01', 16, '2021-04-17 14:36:01', NULL, b'1'),
(44, 16, 2, 17, NULL, '2021-05-12 13:04:54', 'summer', 3, 'DP_120521010454.jpg', 1, 70, 'nice book', 'IIM', 1, 'xyz', '01', 'xyz', b'0', '0', 'Preview_120521010454.pdf', '2021-05-12 13:04:54', 16, '2021-05-12 13:04:54', 16, b'1'),
(45, 18, 6, 18, NULL, '2021-05-15 11:55:53', 'solo', 3, 'DP_150521115553.jpeg', 2, 50, 'timepass ', 'IIT', 1, 'story', '00', 'ramesh', b'1', '40', 'Preview_150521115553.pdf', '2021-05-15 11:55:53', 18, '2021-05-15 11:55:53', 18, b'1'),
(46, 16, 1, 16, NULL, '2021-05-15 21:58:32', 'computer', 1, 'DP_150521095832.jpeg', 1, 100, 'just try', 'xyz', 1, 'science', '02', 'peter', b'1', '50', 'Preview_150521095832.pdf', '2021-05-15 21:58:32', 16, '2021-05-15 21:58:32', 16, b'1'),
(47, 16, 2, 16, NULL, '2021-05-16 18:01:05', 'maths', 1, 'DP_160521060105.jpg', 1, 100, 'fundamental of maths', 'xyz', 1, 'xyz', '01', 'peter', b'1', '40', 'Preview_160521060105.pdf', '2021-05-16 18:01:05', 16, '2021-05-16 18:01:05', 16, b'1'),
(48, 19, 2, 19, NULL, '2021-05-16 18:08:07', 'practice', 2, 'DP_160521060808.jpg', 1, 70, 'nice book', 'xyz', 3, 'science', '02', 'xyz', b'0', '0', 'Preview_160521060808.pdf', '2021-05-16 18:08:07', 19, '2021-05-16 18:08:07', 19, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesattachments`
--

CREATE TABLE `sellernotesattachments` (
  `id` int(11) NOT NULL,
  `noteid` int(11) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filepath` varchar(1000) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotesattachments`
--

INSERT INTO `sellernotesattachments` (`id`, `noteid`, `filename`, `filepath`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 38, 'system', 'logo.png', NULL, NULL, NULL, NULL, b'0'),
(2, 39, 'software design', 'banner.jpg', NULL, NULL, NULL, NULL, b'0'),
(3, 40, 'example', 'banner-with-overlay.jpg', '2021-04-17 14:36:01', 16, '2021-04-17 14:36:01', NULL, b'1'),
(4, 43, 'Attachement_0_110521090125.pdf', '../Members/16/43/Attachements/Attachement_0_110521090125.pdf', '2021-05-12 00:31:25', 1, '2021-05-12 00:31:25', 1, b'1'),
(5, 44, 'Attachement_0_120521093454.pdf', '../Members/16/44/Attachements/Attachement_0_120521093454.pdf', '2021-05-12 13:04:54', 1, '2021-05-12 13:04:54', 1, b'1'),
(6, 45, 'Attachement_0_150521082553.pdf', '../Members/18/45/Attachements/Attachement_0_150521082553.pdf', '2021-05-15 11:55:53', 1, '2021-05-15 11:55:53', 1, b'1'),
(7, 46, 'Attachement_0_150521062832.pdf', '../Members/16/46/Attachements/Attachement_0_150521062832.pdf', '2021-05-15 21:58:32', 1, '2021-05-15 21:58:32', 1, b'1'),
(8, 47, 'Attachement_0_160521023105.pdf', '../Members/16/47/Attachements/Attachement_0_160521023105.pdf', '2021-05-16 18:01:05', 1, '2021-05-16 18:01:05', 1, b'1'),
(9, 48, 'Attachement_0_160521023808.pdf', '../Members/19/48/Attachements/Attachement_0_160521023808.pdf', '2021-05-16 18:08:08', 1, '2021-05-16 18:08:08', 1, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreportedissues`
--

CREATE TABLE `sellernotesreportedissues` (
  `id` int(11) NOT NULL,
  `noteid` int(11) NOT NULL,
  `reportedbyid` int(11) NOT NULL,
  `againstdownloadid` int(11) NOT NULL,
  `remarks` varchar(1000) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sellernotesreviews`
--

CREATE TABLE `sellernotesreviews` (
  `id` int(11) NOT NULL,
  `noteid` int(11) NOT NULL,
  `reviewedbyid` int(11) NOT NULL,
  `againstdownloadsid` int(11) NOT NULL,
  `ratings` decimal(10,0) NOT NULL,
  `comments` varchar(1000) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellernotesreviews`
--

INSERT INTO `sellernotesreviews` (`id`, `noteid`, `reviewedbyid`, `againstdownloadsid`, `ratings`, `comments`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 44, 20, 82, '5', 'i am extreamlly surprised for ....', '2021-05-16 17:39:21', 20, '2021-05-16 17:39:21', 20, b'1');

-- --------------------------------------------------------

--
-- Table structure for table `systemconfigurations`
--

CREATE TABLE `systemconfigurations` (
  `id` int(11) NOT NULL,
  `Key*` varchar(100) NOT NULL,
  `value` varchar(1000) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userprofile`
--

CREATE TABLE `userprofile` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `dob` datetime DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `secondaryemailaddress` varchar(100) NOT NULL,
  `phoneno_countrycode` varchar(5) NOT NULL,
  `phonenumber` varchar(20) NOT NULL,
  `profilepicture` varchar(500) DEFAULT NULL,
  `addressline1` varchar(100) NOT NULL,
  `addressline2` varchar(100) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `university` varchar(100) DEFAULT NULL,
  `college` varchar(100) DEFAULT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userprofile`
--

INSERT INTO `userprofile` (`id`, `userid`, `dob`, `gender`, `secondaryemailaddress`, `phoneno_countrycode`, `phonenumber`, `profilepicture`, `addressline1`, `addressline2`, `city`, `state`, `zipcode`, `country`, `university`, `college`, `createddate`, `createdby`, `modifieddate`, `modifiedby`) VALUES
(1, 15, '2021-03-22 00:00:00', 1, 'bhaveshahir414@gmail.com', 'hide', '9985252522', 'reviewer-1.png', 'vv side2', 'vvn', 'ny', 'ny', '23', 'A', 'iim', 'gec', NULL, NULL, NULL, NULL),
(3, 16, '2021-03-27 00:00:00', 1, 'edwin@gmail.com', '01', '9985252522', 'user-img.png', 'vv side2', 'vvn', 'ny', 'ny', '23', 'USA', 'iim', 'gec', NULL, NULL, NULL, NULL),
(5, 19, '0000-00-00 00:00:00', 7, 'rahulkher@gmail.com', '+91', '08899889988', 'DP_160521110006.png', 'syn road', 'jk hotel', 'jaipur', 'raj', '365', 'India', 'layer', 'jk', '2021-05-16 11:00:06', NULL, '2021-05-16 11:00:06', NULL),
(6, 20, '2001-12-23 00:00:00', 7, 'pravin@gmail.com', '+91', '9506345053', 'DP_160521053651.png', 'ashish store ', 'shreenagar', 'sk', 'jm', '63563', 'India', 'xyz', 'xyz', '2021-05-16 17:36:51', NULL, '2021-05-16 17:36:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `userroles`
--

CREATE TABLE `userroles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userroles`
--

INSERT INTO `userroles` (`id`, `name`, `description`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(1, 'member', 'jdhhjhakldjka', '2021-02-09 17:06:37', 1, '2021-02-10 17:06:37', 1, b'0'),
(2, 'admin', 'admin role', NULL, NULL, NULL, NULL, b'0'),
(3, 'super admin', 'super admin role', NULL, NULL, NULL, NULL, b'0');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `roleid` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `token` varchar(50) NOT NULL,
  `isemailverified` bit(1) NOT NULL,
  `createddate` datetime DEFAULT NULL,
  `createdby` int(11) DEFAULT NULL,
  `modifieddate` datetime DEFAULT NULL,
  `modifiedby` int(11) DEFAULT NULL,
  `isactive` bit(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `roleid`, `firstname`, `lastname`, `email`, `password`, `token`, `isemailverified`, `createddate`, `createdby`, `modifieddate`, `modifiedby`, `isactive`) VALUES
(15, 2, 'bhavesh', 'ahir', 'bhaveshahir414@gmail.com', 'Bhavesh@123', 'dcb3c71451db96e00c971fc5a31256', b'0', NULL, NULL, NULL, NULL, b'1'),
(16, 1, 'edwin', 'diaz', 'edwin@gmail.com', 'Edwin@123', '03069080a4ae8b2681b9530de1eb53', b'0', NULL, NULL, NULL, NULL, b'1'),
(17, 1, 'ramesh', 'shah', 'ramesh@gmail.com', 'Ramesh@123', 'd7036316ddf469f915d729cc505d28', b'0', '2021-04-27 16:07:43', NULL, '2021-04-27 16:07:43', NULL, b'1'),
(18, 1, 'haresh', 'bati', 'haresh@gmail.com', 'Haresh@123', '48fcf2c7eef15ee5c5a3cefa9bb7bf', b'0', '2021-05-14 21:59:12', NULL, '2021-05-14 21:59:12', NULL, b'1'),
(19, 1, 'rahul', 'kher', 'rahulkher@gmail.com', 'Rahul@123', 'dc0505baeb04a9cd3b72267e0fbf0a', b'0', '2021-05-16 09:51:54', NULL, '2021-05-16 09:51:54', NULL, b'1'),
(20, 1, 'pravin', 'kumar', 'pravin@gmail.com', 'Pravin@123', 'af270afc830ee22f9825bac594f718', b'0', '2021-05-16 17:34:20', NULL, '2021-05-16 17:34:20', NULL, b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `downloads`
--
ALTER TABLE `downloads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NoteID` (`noteid`),
  ADD KEY `Seller` (`seller`),
  ADD KEY `Downloader` (`downloader`);

--
-- Indexes for table `notecategories`
--
ALTER TABLE `notecategories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notetypes`
--
ALTER TABLE `notetypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referencedata`
--
ALTER TABLE `referencedata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NoteType` (`notetype`),
  ADD KEY `Country` (`country`),
  ADD KEY `category` (`category`),
  ADD KEY `sellerid` (`sellerid`),
  ADD KEY `status` (`status`),
  ADD KEY `actionedby` (`actionedby`);

--
-- Indexes for table `sellernotesattachments`
--
ALTER TABLE `sellernotesattachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NoteID` (`noteid`);

--
-- Indexes for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NoteID` (`noteid`),
  ADD KEY `ReportedByID` (`reportedbyid`),
  ADD KEY `AgainstDownloadID` (`againstdownloadid`);

--
-- Indexes for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `NoteID` (`noteid`),
  ADD KEY `ReviewedByID` (`reviewedbyid`),
  ADD KEY `AgainstDownloadsID` (`againstdownloadsid`);

--
-- Indexes for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD PRIMARY KEY (`id`),
  ADD KEY `UserID` (`userid`),
  ADD KEY `Gender` (`gender`);

--
-- Indexes for table `userroles`
--
ALTER TABLE `userroles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `RoleID` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sellernotes`
--
ALTER TABLE `sellernotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `sellernotesattachments`
--
ALTER TABLE `sellernotesattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `downloads`
--
ALTER TABLE `downloads`
  ADD CONSTRAINT `downloads_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_2` FOREIGN KEY (`Seller`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `downloads_ibfk_3` FOREIGN KEY (`Downloader`) REFERENCES `users` (`ID`);

--
-- Constraints for table `sellernotes`
--
ALTER TABLE `sellernotes`
  ADD CONSTRAINT `sellernotes_ibfk_1` FOREIGN KEY (`sellerid`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sellernotes_ibfk_2` FOREIGN KEY (`status`) REFERENCES `referencedata` (`ID`),
  ADD CONSTRAINT `sellernotes_ibfk_3` FOREIGN KEY (`actionedby`) REFERENCES `users` (`id`);

--
-- Constraints for table `sellernotesattachments`
--
ALTER TABLE `sellernotesattachments`
  ADD CONSTRAINT `sellernotesattachments_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`);

--
-- Constraints for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_2` FOREIGN KEY (`ReportedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotesreportedissues_ibfk_3` FOREIGN KEY (`AgainstDownloadID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  ADD CONSTRAINT `sellernotesreviews_ibfk_1` FOREIGN KEY (`NoteID`) REFERENCES `sellernotes` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_2` FOREIGN KEY (`ReviewedByID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sellernotesreviews_ibfk_3` FOREIGN KEY (`AgainstDownloadsID`) REFERENCES `downloads` (`ID`);

--
-- Constraints for table `userprofile`
--
ALTER TABLE `userprofile`
  ADD CONSTRAINT `userprofile_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `userprofile_ibfk_2` FOREIGN KEY (`Gender`) REFERENCES `referencedata` (`ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleid`) REFERENCES `userroles` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
