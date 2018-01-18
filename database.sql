-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 18, 2018 at 08:12 AM
-- Server version: 5.6.36-log
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `glugpace`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `username` varchar(20) NOT NULL,
  `password` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`username`, `password`) VALUES
('Admin', 'suz@glugpace@3129'),
('Ameen', 'ameen@glugpace'),
('Indhu', 'indhu@glugpace'),
('Reemaz', 'reemaz@glugpace'),
('Sushin', 'sushin');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `content_small` varchar(300) DEFAULT NULL,
  `content_large` varchar(10000) DEFAULT NULL,
  `img1` varchar(20) DEFAULT NULL,
  `img2` varchar(20) DEFAULT NULL,
  `img3` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `content_small`, `content_large`, `img1`, `img2`, `img3`) VALUES
(1, 'What''s going on this world!', 'While computing Simple Average Aggregate percentages for X, XII, Graduation and Post-Graduation, include all Languages, Additional Subjects, practicals, and Optional Subjects.', 'Your original college ID card should be mandatorily available with you during the Selection process, along with a recent color passportsize photograph.2. Donâ€™t forget to mention your Roll number, Name and DOB on back side of the photograph. Our test administrators will collectitfrom you, during the interview process.3. Education details - Simple average includes marks obtained in all subjects / semesters / years including electives, optional subjects, additional subjects, practicals and languages. Steps detailed below:4. Simple average calculations : a.b.c.d.While computing Simple Average Aggregate percentages for X, XII, Graduation and Post-Graduation, include all Languages, Additional Subjects, practicals, and Optional Subjects. Please refer to the illustration below for better understanding.If your college follows a CGPA system, please ensure that the CGPA is calculated taking into account each and every course that youhave undertaken in the curriculum, including optional or additional subjects (if any).If you have done your Diploma after X and have joined directly as a lateral entrant into 2nd year of B.E / B.Tech, please calculate theaggregate for all the 3 years of Diploma (including all languages /optional subjects/ additional subjects undertaken during the 3 years)and capture the same. Compute the aggregate for Engineering from the 2nd year (3rdsemester) onwards to the final semester, asapplicable.If your school follows a grade system, please enter the simple average of marks equivalent to it.', 'whatsnew1.png', 'whatsnew2.png', 'whatsnew3.png');

-- --------------------------------------------------------

--
-- Table structure for table `header_background`
--

CREATE TABLE IF NOT EXISTS `header_background` (
  `name` varchar(100) DEFAULT NULL,
  `content` varchar(500) DEFAULT NULL,
  `img` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `header_background`
--

INSERT INTO `header_background` (`name`, `content`, `img`) VALUES
('Home', 'Sample Page', 'cover1.jpg'),
('Events', 'Sample Page', 'cover2.jpg'),
('Articles', 'Sample Page', 'cover3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `nontechnical`
--

CREATE TABLE IF NOT EXISTS `nontechnical` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `content_small` varchar(300) DEFAULT NULL,
  `content_large` varchar(10000) DEFAULT NULL,
  `img` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `nontechnical`
--

INSERT INTO `nontechnical` (`id`, `name`, `content_small`, `content_large`, `img`) VALUES
(1, 'Hello World', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png'),
(2, 'Free as in Freedom', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png'),
(3, 'Free as in Freedom', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png'),
(4, 'Hello World', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png');

-- --------------------------------------------------------

--
-- Table structure for table `technical`
--

CREATE TABLE IF NOT EXISTS `technical` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `content_small` varchar(300) DEFAULT NULL,
  `content_large` varchar(10000) DEFAULT NULL,
  `img` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `technical`
--

INSERT INTO `technical` (`id`, `name`, `content_small`, `content_large`, `img`) VALUES
(1, 'Free as in Freedom', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png'),
(2, 'Hello World', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png'),
(3, 'Free as in Freedom', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png'),
(4, 'Free as in Freedom', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png');

-- --------------------------------------------------------

--
-- Table structure for table `visit_log`
--

CREATE TABLE IF NOT EXISTS `visit_log` (
  `type` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `id` int(11) DEFAULT NULL,
  `visit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visit_log`
--

INSERT INTO `visit_log` (`type`, `name`, `id`, `visit`) VALUES
('Page', 'index.php', 0, 88),
('Page', 'articles.php', 0, 53),
('Page', 'events.php', 0, 21),
('Page', 'about.php', 0, 0),
('events', 'What''s going on this world!', 1, 3),
('technical', 'Free as in Freedom', 1, 0),
('whatsnew', 'Free as in Freedom', 1, 1),
('whatsnew', 'Hello Wolrd', 2, 1),
('whatsnew', 'Free as in Freedom', 3, 5),
('technical', 'Hello Wolrd', 2, 1),
('technical', 'Free as in Freedom', 3, 4),
('technical', 'Free as in Freedom', 4, 5),
('whatsnew', 'Hello Wolrd', 4, 12),
('nontechnical', 'Hello Wolrd', 1, 0),
('nontechnical', 'Free as in Freedom', 2, 0),
('nontechnical', 'Free as in Freedom', 3, 1),
('nontechnical', 'Hello Wolrd', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `whatsnew`
--

CREATE TABLE IF NOT EXISTS `whatsnew` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `content_small` varchar(300) DEFAULT NULL,
  `content_large` varchar(10000) DEFAULT NULL,
  `img` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `whatsnew`
--

INSERT INTO `whatsnew` (`id`, `name`, `content_small`, `content_large`, `img`) VALUES
(1, 'Free as in Freedom', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power', 'whatsnew1.png'),
(2, 'Hello World', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png'),
(3, 'Free as in Freedom', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png'),
(4, 'Hello World', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''fre', '''Free software'' means software that respects users'' freedom and community. Roughly, it means that the users have the freedom to run, copy, distribute, study, change and improve the software. Thus, ''free software'' is a matter of liberty, not price. To understand the concept, you should think of ''free'' as in ''free speech,'' not as in ''free beer''. We campaign for these freedoms because everyone deserves them. With these freedoms, the users (both individually and collectively) control the program and what it does for them. When users don''t control the program, we call it a ''nonfree'' or ''proprietary'' program. The nonfree program controls the users, and the developer controls the program; this makes the program an instrument of unjust power.', 'whatsnew1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nontechnical`
--
ALTER TABLE `nontechnical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `technical`
--
ALTER TABLE `technical`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `whatsnew`
--
ALTER TABLE `whatsnew`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
