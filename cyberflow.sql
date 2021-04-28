-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2021 at 10:51 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cyberflow`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` bigint(20) NOT NULL,
  `des` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `des`, `img`) VALUES
(1, '<p>we are a firm from dehradun . we have ethics. around 8 pm bjbkhvjjbj cgcghcghc</p>\r\n', 'uploads/1617432867_map.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) NOT NULL,
  `e_id` bigint(50) NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `status` bigint(50) NOT NULL COMMENT '0 for admin and 1 for employee'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `e_id`, `email`, `password`, `status`) VALUES
(6, 20, 'zf@345', 'f7c0e071db137f5ae65382041c7cef4b', 1),
(8, 22, 'ayush@13', 'b2ca678b4c936f905fb82f2733f5297f', 1),
(9, 0, 'admin@gmail.com', '12345', 0),
(10, 23, 'p@gmail', '388ec3e3fa4983032b4f3e7d8fcb65ad', 1),
(11, 24, 'xz @rgsr', '8fa14cdd754f91cc6554c9e71929cce7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `assigned_employees`
--

CREATE TABLE `assigned_employees` (
  `id` bigint(50) NOT NULL,
  `e_id` bigint(50) NOT NULL,
  `project_id` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_employees`
--

INSERT INTO `assigned_employees` (`id`, `e_id`, `project_id`) VALUES
(34, 22, 36),
(35, 24, 36),
(47, 20, 35),
(48, 22, 35),
(49, 24, 35);

-- --------------------------------------------------------

--
-- Table structure for table `assigned_milestones`
--

CREATE TABLE `assigned_milestones` (
  `id` bigint(50) NOT NULL,
  `p_id` bigint(50) NOT NULL,
  `m_id` bigint(50) NOT NULL,
  `e_id` bigint(50) NOT NULL,
  `excuse` text NOT NULL,
  `comments` text NOT NULL,
  `status` bigint(20) NOT NULL COMMENT '0 for pipeline 1 for active  2 for delayed 3 for completed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assigned_milestones`
--

INSERT INTO `assigned_milestones` (`id`, `p_id`, `m_id`, `e_id`, `excuse`, `comments`, `status`) VALUES
(13, 35, 12, 22, 'i was not well bhhh', 'content was not clear hhhhhhhhh', 0),
(14, 35, 12, 23, 'busy in other projects', 'suitable files not provided', 0),
(33, 36, 23, 22, 'php shi se ni pdi h mne', 'backend teacher was not good\r\n', 0),
(34, 36, 23, 24, '', '', 0),
(35, 36, 24, 22, '', '', 0),
(36, 35, 25, 22, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `assign_project`
--

CREATE TABLE `assign_project` (
  `id` bigint(11) NOT NULL,
  `name` text NOT NULL,
  `due_date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_project`
--

INSERT INTO `assign_project` (`id`, `name`, `due_date`, `description`) VALUES
(35, 'frontend anf', '2021-04-07', 'cascas vcv'),
(36, 'backend', '2021-04-06', 'njj ,');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `contact`, `password`) VALUES
(20, 'bbmnkkkkkkbb', 'zf@345nnn', '8888', '77904eff2f05cbf1aafc2108d021fa26'),
(22, 'ayush', 'ayush@13', '99', 'b2ca678b4c936f905fb82f2733f5297f'),
(23, 'pnchu', 'p@gmail', '8888', '8a21cc4b32061760e384861289579573'),
(24, 'xcvxc', 'xz @rgsr', 'vxc', 'ac2d3e188413c20795057839e2f69d40');

-- --------------------------------------------------------

--
-- Table structure for table `getintouch`
--

CREATE TABLE `getintouch` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phn` text NOT NULL,
  `message` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 for unread 1 for read',
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `getintouch`
--

INSERT INTO `getintouch` (`id`, `name`, `email`, `phn`, `message`, `status`, `time_stamp`) VALUES
(1, 'piyush', 'piu@bsacbbjk', '88888888', 'know about your viiosnn', 0, '2021-04-06 06:49:06'),
(2, 'chbdchdb', 'wwew@24', '11111', 'gvgvgvgvgv', 0, '2021-04-06 06:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `milestones`
--

CREATE TABLE `milestones` (
  `id` bigint(50) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `due_date` date NOT NULL,
  `p_id` bigint(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `title`, `description`, `due_date`, `p_id`) VALUES
(12, 'html', ' jh', '2021-04-13', 35),
(23, 'php page', 'chbkc', '2021-04-09', 36),
(24, 'sql page', 'zx zxj ', '2021-04-24', 36),
(25, 'css page', 'jzcvzjdjkb', '2021-04-27', 35);

-- --------------------------------------------------------

--
-- Table structure for table `milestone_files`
--

CREATE TABLE `milestone_files` (
  `id` bigint(50) NOT NULL,
  `e_id` bigint(50) NOT NULL,
  `p_id` bigint(50) NOT NULL,
  `m_id` bigint(50) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milestone_files`
--

INSERT INTO `milestone_files` (`id`, `e_id`, `p_id`, `m_id`, `img`) VALUES
(29, 0, 0, 12, 'map.1619061784.jpg'),
(30, 0, 0, 12, 'map.1619061784.jpg'),
(31, 0, 0, 12, 'ada.1619061785.png'),
(32, 0, 0, 12, 'ada.1619061785.png'),
(69, 0, 0, 23, 'map.1619087768.jpg'),
(70, 0, 0, 23, 'map.1619087768.jpg'),
(71, 0, 0, 23, 'ada.1619087768.png'),
(72, 0, 0, 23, 'ada.1619087768.png'),
(73, 0, 0, 24, 'Screenshot 2021-03-21 143638.1619087806.png'),
(74, 0, 0, 24, 'Screenshot 2021-03-21 143638.1619087806.png'),
(75, 0, 0, 24, 'Screenshot 2021-03-21 144248.1619087807.png'),
(76, 0, 0, 24, 'Screenshot 2021-03-21 144248.1619087807.png'),
(77, 0, 0, 25, 'Screenshot 2021-03-21 144919.1619088381.png'),
(78, 0, 0, 25, 'Screenshot 2021-03-21 144919.1619088381.png'),
(79, 0, 0, 25, 'Screenshot 2021-03-21 151044.1619088382.png'),
(80, 0, 0, 25, 'Screenshot 2021-03-21 151044.1619088382.png');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `title`, `link`, `des`) VALUES
(16, 'trtrtr', 'htttp', '<p>xcfhccjgjcgj</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_img`
--

CREATE TABLE `portfolio_img` (
  `id` bigint(20) NOT NULL,
  `p_id` bigint(20) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio_img`
--

INSERT INTO `portfolio_img` (`id`, `p_id`, `img`) VALUES
(40, 16, 'Screenshot (10).1617506958.png'),
(46, 16, '1.1617545197.png');

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` bigint(20) NOT NULL,
  `p_id` bigint(20) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `p_id`, `img`) VALUES
(60, 35, 'map.1619037447.jpg'),
(62, 35, 'ada.1619037447.png'),
(64, 36, 'ada.1619087713.png'),
(65, 36, 'ada.1619087713.png'),
(66, 36, 'map.1619087714.jpg'),
(67, 36, 'map.1619087714.jpg'),
(68, 35, 'Screenshot (6).1619237714.png'),
(69, 35, 'Screenshot (6).1619237714.png');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment`
--

CREATE TABLE `recruitment` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `qualification` text NOT NULL,
  `resume` text NOT NULL,
  `specialisation` text NOT NULL,
  `phn` text NOT NULL,
  `intro` text NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 for unread 1 for read',
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recruitment`
--

INSERT INTO `recruitment` (`id`, `name`, `email`, `qualification`, `resume`, `specialisation`, `phn`, `intro`, `status`, `time_stamp`) VALUES
(1, 'ankur', 'an@fdd', 'btech', 'Application-SSA198340192633.pdf', 'web dev', '777777777', 'i have done my b tech from ge.\r\ninternships from', 0, '2021-04-05 13:53:39'),
(2, 'akesh', 'j jkb@44', 'bca', 'enrollment form.pdf', 'graphic designer', '8888888', 'from ge and certificates from udemy', 0, '2021-04-05 13:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `position` text NOT NULL,
  `image` text NOT NULL,
  `sort_order` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `position`, `image`, `sort_order`) VALUES
(32, 'seesesexxxxxxxxxxxx', 'sssssxxxxxxxxxxxxxx', 'uploads/1617434526_ada.png', 1),
(36, 'hgghghxxx', 'cvicexxxx', 'uploads/1619581365_fast.png', 6);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) NOT NULL,
  `name` text NOT NULL,
  `position` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `des` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `position`, `sort_order`, `des`, `img`) VALUES
(9, 'bnnnnnnn', 'mmmxxxxxx', 9, '', 'uploads/1617434878_Screenshot2021-03-21144248.png'),
(11, 'hxvch', 'chgc', 5, '<p>ggsdzb</p>\r\n', 'uploads/1617547362_Screenshot(3).png');

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

CREATE TABLE `web_config` (
  `id` bigint(20) NOT NULL,
  `title` text NOT NULL,
  `phn` text NOT NULL,
  `address` text NOT NULL,
  `facebook` text NOT NULL,
  `twitter` text NOT NULL,
  `instagram` text NOT NULL,
  `linkedin` text NOT NULL,
  `logo` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_config`
--

INSERT INTO `web_config` (`id`, `title`, `phn`, `address`, `facebook`, `twitter`, `instagram`, `linkedin`, `logo`) VALUES
(1, 'fjvnfj', '33333333', 'wegeg', 'dfnblkd', 'srbr', 'bsrf', 'fb', 'uploads/1617617529_1.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_employees`
--
ALTER TABLE `assigned_employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_milestones`
--
ALTER TABLE `assigned_milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_project`
--
ALTER TABLE `assign_project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `getintouch`
--
ALTER TABLE `getintouch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestones`
--
ALTER TABLE `milestones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `milestone_files`
--
ALTER TABLE `milestone_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `portfolio_img`
--
ALTER TABLE `portfolio_img`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_files`
--
ALTER TABLE `project_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recruitment`
--
ALTER TABLE `recruitment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `web_config`
--
ALTER TABLE `web_config`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `assigned_employees`
--
ALTER TABLE `assigned_employees`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `assigned_milestones`
--
ALTER TABLE `assigned_milestones`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `assign_project`
--
ALTER TABLE `assign_project`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `getintouch`
--
ALTER TABLE `getintouch`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `milestone_files`
--
ALTER TABLE `milestone_files`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `portfolio_img`
--
ALTER TABLE `portfolio_img`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `recruitment`
--
ALTER TABLE `recruitment`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `web_config`
--
ALTER TABLE `web_config`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
