-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 16, 2021 at 04:20 PM
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
  `id` bigint(50) NOT NULL,
  `des` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `des`, `img`) VALUES
(1, '<p>bshdbhjbhsdj &quot;dcjd<strong>j&quot; bbb</strong>bbbbbbbb&nbsp; GGGV bbbb</p>\r\n', 'uploads/1620970637_images.png');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(50) NOT NULL,
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
(236, 22, 63),
(237, 24, 63),
(246, 20, 56);

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
(66, 56, 47, 20, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `assign_project`
--

CREATE TABLE `assign_project` (
  `id` bigint(50) NOT NULL,
  `name` text NOT NULL,
  `due_date` date NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assign_project`
--

INSERT INTO `assign_project` (`id`, `name`, `due_date`, `description`) VALUES
(56, 'frontend', '2021-05-11', 'jvjnvjdnnsd'),
(63, 'aqbb', '2021-05-12', 'mmmmmmmmmmmm');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` bigint(50) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `contact` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `email`, `contact`, `password`) VALUES
(20, 'bbmnkkkkkkbb', 'zf@345nnn', '8888', '0ff5247ca8a0dd247b3ed7428922b7ef'),
(22, 'ayush', 'ayush@13', '99', 'b2ca678b4c936f905fb82f2733f5297f'),
(24, 'xcvxc', 'xz @rgsr', 'vxc', 'ac2d3e188413c20795057839e2f69d40');

-- --------------------------------------------------------

--
-- Table structure for table `getintouch`
--

CREATE TABLE `getintouch` (
  `id` bigint(50) NOT NULL,
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
  `p_id` bigint(50) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 for pipeine 1 for active 2 for delayed 3 for completed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `milestones`
--

INSERT INTO `milestones` (`id`, `title`, `description`, `due_date`, `p_id`, `status`) VALUES
(47, 'bbbbbbb', 'mmmmmmmmmmmmmm', '2021-05-20', 56, 0);

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
(115, 0, 56, 47, 'GCP Networking Course Slides for Downloads Rev1.1621061794.pdf'),
(116, 0, 56, 47, 'map.1621061794.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `id` bigint(50) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `des` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `title`, `link`, `des`) VALUES
(16, 'trtrtr', 'htttp', '<p>xcfhccjgjcgj vbvbvbv bvg bvb</p>\r\n'),
(20, 'vvvvvvvvaaa', 'httttt', '<h1>cgcg<strong>cg bx</strong></h1>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_img`
--

CREATE TABLE `portfolio_img` (
  `id` bigint(50) NOT NULL,
  `p_id` bigint(50) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolio_img`
--

INSERT INTO `portfolio_img` (`id`, `p_id`, `img`) VALUES
(40, 16, 'Screenshot (10).1617506958.png'),
(55, 20, 'map.1620969705.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE `project_files` (
  `id` bigint(50) NOT NULL,
  `p_id` bigint(50) NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `p_id`, `img`) VALUES
(103, 56, 'domicille.1620014007.pdf'),
(109, 63, 'GCP Networking Course Slides for Downloads Rev1.1621004055.pdf'),
(112, 63, 'ada.1621017190.png');

-- --------------------------------------------------------

--
-- Table structure for table `recruitment`
--

CREATE TABLE `recruitment` (
  `id` bigint(50) NOT NULL,
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
  `id` bigint(50) NOT NULL,
  `name` text NOT NULL,
  `position` text NOT NULL,
  `image` text NOT NULL,
  `sort_order` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `name`, `position`, `image`, `sort_order`) VALUES
(37, 'bbbbaaaaa', 'acadn', 'uploads/1620967343_map.jpg', 97),
(39, 'vvvvvvvvvvvb', 'vicebbcc', 'uploads/1620967703_ada.png', 59),
(47, 'd \'ore', 'vice', 'uploads/1620967654_Screenshot2021-03-21143638.png', 3);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(50) NOT NULL,
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
(11, 'hxvc', 'chgc', 5, '<p>vvvvvvvvvvvvvv bbbbbbbbbb</p>\n', 'uploads/1620037100_20180613_230714.jpg'),
(13, 'djdg', '11', 3, '<p>bbbbbb</p>\n', 'uploads/1620967807_Screenshot2021-03-21143638.png'),
(17, 'VVGVVG', 'B', 4, '<p>CBVGH NHCGGB<em>GG</em></p>\r\n', 'uploads/1620969567_map.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `web_config`
--

CREATE TABLE `web_config` (
  `id` bigint(50) NOT NULL,
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
(1, 'fjvnfjbb', '333333335777', 'wegegvcmmmmmmmmmmmmmmmm', 'dfnblkd', 'srbr', 'bsrf', 'fb', 'uploads/1620970333_1.png');

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
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `assigned_employees`
--
ALTER TABLE `assigned_employees`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `assigned_milestones`
--
ALTER TABLE `assigned_milestones`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `assign_project`
--
ALTER TABLE `assign_project`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `getintouch`
--
ALTER TABLE `getintouch`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `milestones`
--
ALTER TABLE `milestones`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `milestone_files`
--
ALTER TABLE `milestone_files`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `portfolio_img`
--
ALTER TABLE `portfolio_img`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `project_files`
--
ALTER TABLE `project_files`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `recruitment`
--
ALTER TABLE `recruitment`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `web_config`
--
ALTER TABLE `web_config`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
