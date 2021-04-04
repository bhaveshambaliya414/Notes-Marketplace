-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2021 at 06:34 AM
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
(2, 'USA', '1', NULL, NULL, NULL, NULL, b'1');

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
(2, 24, 15, 16, b'1', NULL, b'1', '0000-00-00 00:00:00', b'1', '0', 'python', '1', NULL, NULL, NULL, NULL),
(5, 24, 15, 16, b'0', NULL, b'1', '2021-04-14 00:04:23', b'1', '0', 'python', '1', NULL, NULL, NULL, NULL),
(69, 1, 15, 16, b'1', '', b'0', NULL, b'1', '100', 'php', '1', NULL, NULL, NULL, NULL);

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
(2, 'IT', 'this book is very interesting.', NULL, NULL, NULL, NULL, b'1');

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
(2, 'Story Books', 'it is a story book.', NULL, NULL, NULL, NULL, b'1');

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
(1, '2', 'draft', 'Notestatus', NULL, NULL, NULL, NULL, b'0'),
(2, '2', 'published', 'Notestatus', NULL, NULL, NULL, NULL, b'0'),
(3, '3', 'inreview', 'Notestatus', NULL, NULL, NULL, NULL, b'0');

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
(1, 15, 1, 15, NULL, NULL, 'php', 1, 'C:\\xampp\\htdocs\\notesmarketplace\\front\\images\\note-details', 1, 100, 'nice book', NULL, 1, 'php', '03', 'stive harvard', b'0', '100', NULL, NULL, NULL, NULL, NULL, b'0'),
(14, 15, 1, 15, NULL, NULL, 'home', 1, 'note-img.jpeg', 1, 2, 'vbc', 'IIM', 1, 'xyz', '03', 'xyz', b'0', '200', 'sample.pdf', NULL, NULL, NULL, NULL, b'0'),
(22, 15, 3, 15, NULL, '2021-03-03 00:00:00', 'xy', 1, 'note-img.jpeg', 1, 0, 'asd', '', 1, '', '', '', b'1', '0', 'SUCCESS.png', NULL, NULL, NULL, NULL, b'0'),
(24, 15, 2, 15, NULL, '2021-03-08 00:16:29', 'python', 1, 'banner.jpg', 1, 2, 'hjk', 'IIM', 1, 'xyz', '03', 'xyz', b'0', '12', 'logo.png', NULL, NULL, NULL, NULL, b'0'),
(35, 16, 2, 16, NULL, NULL, 'science', 1, 'avatar.png', 1, 100, 'bn', 'IIT', 1, 'science', '02', 'peter', b'1', '0', 'banner.jpg', NULL, NULL, NULL, NULL, b'0'),
(37, 16, 2, 16, NULL, NULL, 'system', 1, 'download.png', 1, 100, 'mn', 'IIT', 1, 'xyz', '02', 'xyz', b'0', '200', 'logo.png', '2021-03-03 00:00:00', NULL, '2021-03-03 00:00:00', NULL, b'0'),
(38, 16, 1, 16, NULL, NULL, 'system', 1, 'download.png', 1, 100, 'mn', 'IIT', 1, 'xyz', '02', 'xyz', b'0', '200', 'logo.png', NULL, NULL, NULL, NULL, b'0'),
(39, 16, 1, 16, NULL, NULL, 'software design', 1, 'avatar.png', 1, 100, 'mnb', 'IIM', 1, 'python', '03', 'peter', b'0', '200', 'banner.jpg', NULL, NULL, NULL, NULL, b'0');

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
(2, 39, 'software design', 'banner.jpg', NULL, NULL, NULL, NULL, b'0');

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
(3, 16, '2021-03-27 00:00:00', 1, 'edwin@gmail.com', '01', '9985252522', 'user-img.png', 'vv side2', 'vvn', 'ny', 'ny', '23', 'USA', 'iim', 'gec', NULL, NULL, NULL, NULL);

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
(1, 'rahul', 'jdhhjhakldjka', '2021-02-09 17:06:37', 1, '2021-02-10 17:06:37', 1, b'0');

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
(2, 1, 'raj', 'mehra', 'raj@gmail.com', 'raj', '', b'1', NULL, NULL, NULL, NULL, b'0'),
(5, 1, 'rahul', 'shah', 'rahul@gmail.com', 'rahul', '', b'0', '0000-00-00 00:00:00', 0, NULL, NULL, b'0'),
(11, 1, 'anil', 'patel', 'anil@gmail.com', '$2y$10$H1yiwjUm0DjfcwH0C', '', b'0', NULL, NULL, NULL, NULL, b'1'),
(12, 1, 'payal', 'kaur', 'payal@gmail.com', '$2y$10$CWb0Mw4nuUnDXfIdH', '', b'0', NULL, NULL, NULL, NULL, b'1'),
(13, 1, 'ajay', 'asd', 'ajay@gmail.com', '$2y$10$C/Y143O7GUMFpJb1A', '9dd52269dd79f9f970439422646057', b'0', NULL, NULL, NULL, NULL, b'1'),
(15, 1, 'bhavesh', 'ahir', 'bhaveshahir414@gmail.com', '$2y$10$lLZRXj6eyhk4K.n3Pq0jsOpGxKnD6joId8kOOIWMYp2R4gkLlUtfa', 'dcb3c71451db96e00c971fc5a31256', b'0', NULL, NULL, NULL, NULL, b'1'),
(16, 1, 'edwin', 'diaz', 'edwin@gmail.com', 'asd', '03069080a4ae8b2681b9530de1eb53', b'0', NULL, NULL, NULL, NULL, b'1');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `downloads`
--
ALTER TABLE `downloads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `notecategories`
--
ALTER TABLE `notecategories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notetypes`
--
ALTER TABLE `notetypes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `referencedata`
--
ALTER TABLE `referencedata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sellernotes`
--
ALTER TABLE `sellernotes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `sellernotesattachments`
--
ALTER TABLE `sellernotesattachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sellernotesreportedissues`
--
ALTER TABLE `sellernotesreportedissues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sellernotesreviews`
--
ALTER TABLE `sellernotesreviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `systemconfigurations`
--
ALTER TABLE `systemconfigurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userprofile`
--
ALTER TABLE `userprofile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userroles`
--
ALTER TABLE `userroles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
