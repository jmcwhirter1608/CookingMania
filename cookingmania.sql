-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 06:51 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cookingmania`
--

-- --------------------------------------------------------

--
-- Stand-in structure for view `admins`
-- (See below for the actual view)
--
CREATE TABLE `admins` (
`User_ID` int(11)
,`User_type` int(11)
,`User_fname` varchar(255)
,`User_lname` varchar(255)
,`User_email` varchar(255)
,`User_phonenumber` varchar(255)
,`User_password` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `Class_ID` int(11) NOT NULL,
  `Recipe_ID` int(11) NOT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Class_Date` date NOT NULL,
  `Class_StartTime` time NOT NULL,
  `Class_RoomNum` int(11) NOT NULL,
  `Class_EndTime` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Class_ID`, `Recipe_ID`, `User_ID`, `Class_Date`, `Class_StartTime`, `Class_RoomNum`, `Class_EndTime`) VALUES
(1, 1, 19, '2023-05-01', '12:14:30', 201, 0),
(2, 2, 19, '2023-05-02', '12:14:30', 201, 0);

-- --------------------------------------------------------

--
-- Table structure for table `class_enrollment`
--

CREATE TABLE `class_enrollment` (
  `Class_ID` int(11) NOT NULL,
  `User_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_enrollment`
--

INSERT INTO `class_enrollment` (`Class_ID`, `User_ID`) VALUES
(1, 16),
(1, 18),
(2, 15),
(2, 16);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `Comment_ID` int(11) NOT NULL,
  `Recipe_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `CommentText` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `Recipe_ID` int(11) NOT NULL,
  `Recipe_name` varchar(255) DEFAULT NULL,
  `Recipe_time` varchar(255) DEFAULT NULL,
  `Recipe_level` int(11) DEFAULT NULL,
  `Recipe_instructions` mediumtext DEFAULT NULL,
  `Recipe_Ingredients` text NOT NULL,
  `last_update_date` date DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`Recipe_ID`, `Recipe_name`, `Recipe_time`, `Recipe_level`, `Recipe_instructions`, `Recipe_Ingredients`, `last_update_date`, `User_ID`) VALUES
(1, 'Pizza', '30', 1, 'Roll Dough, Add Sauce, Add Cheese, Cook for 25', '', '2023-05-01', 19),
(2, 'Chicken Parmesan', '45', 2, 'Cook Chicken Till Burnt\r\nPlace marinara in air fryer\r\nStir up the sauce\r\nRun it with the crew', '', '2023-05-01', 19);

-- --------------------------------------------------------

--
-- Stand-in structure for view `students`
-- (See below for the actual view)
--
CREATE TABLE `students` (
`User_ID` int(11)
,`User_type` int(11)
,`User_fname` varchar(255)
,`User_lname` varchar(255)
,`User_email` varchar(255)
,`User_phonenumber` varchar(255)
,`User_password` varchar(255)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `teachers`
-- (See below for the actual view)
--
CREATE TABLE `teachers` (
`User_ID` int(11)
,`User_type` int(11)
,`User_fname` varchar(255)
,`User_lname` varchar(255)
,`User_email` varchar(255)
,`User_phonenumber` varchar(255)
,`User_password` varchar(255)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `User_ID` int(11) NOT NULL,
  `User_type` int(11) DEFAULT NULL,
  `User_fname` varchar(255) DEFAULT NULL,
  `User_lname` varchar(255) DEFAULT NULL,
  `User_email` varchar(255) DEFAULT NULL,
  `User_phonenumber` varchar(255) DEFAULT NULL,
  `User_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`User_ID`, `User_type`, `User_fname`, `User_lname`, `User_email`, `User_phonenumber`, `User_password`) VALUES
(6, 1, 'John', 'McWhirter', 'jbm@gmail.com', '1234567890', 'brea'),
(7, 2, 'Gary', 'Brocket', 'gbm@gmail.com', '1234567890', 'asdf'),
(8, 3, 'Jim', 'Boler', 'jbol@gmail.com', '1234567890', 'asdf'),
(14, 2, 'Ariana', 'Pouya', 'apy@gmail.com', '1234567896', 'asdf'),
(15, 3, 'Ron', 'Weasley', 'RWgriffin@gmail.com', '1234567890', 'rat'),
(16, 3, 'Harry', 'Potter', 'thechosenone@gmail.com', '1234567890', 'slytherin'),
(18, 3, 'Hermione', 'Granger', 'smartgirl@gmail.com', '1234567890', 'asdf'),
(19, 2, 'Severus', 'Snape', 'HalfBlodP@gmail.com', '1234567890', 'asdf');

-- --------------------------------------------------------

--
-- Structure for view `admins`
--
DROP TABLE IF EXISTS `admins`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admins`  AS SELECT `users`.`User_ID` AS `User_ID`, `users`.`User_type` AS `User_type`, `users`.`User_fname` AS `User_fname`, `users`.`User_lname` AS `User_lname`, `users`.`User_email` AS `User_email`, `users`.`User_phonenumber` AS `User_phonenumber`, `users`.`User_password` AS `User_password` FROM `users` WHERE `users`.`User_type` = 1 ;

-- --------------------------------------------------------

--
-- Structure for view `students`
--
DROP TABLE IF EXISTS `students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `students`  AS SELECT `users`.`User_ID` AS `User_ID`, `users`.`User_type` AS `User_type`, `users`.`User_fname` AS `User_fname`, `users`.`User_lname` AS `User_lname`, `users`.`User_email` AS `User_email`, `users`.`User_phonenumber` AS `User_phonenumber`, `users`.`User_password` AS `User_password` FROM `users` WHERE `users`.`User_type` = 3 ;

-- --------------------------------------------------------

--
-- Structure for view `teachers`
--
DROP TABLE IF EXISTS `teachers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `teachers`  AS SELECT `users`.`User_ID` AS `User_ID`, `users`.`User_type` AS `User_type`, `users`.`User_fname` AS `User_fname`, `users`.`User_lname` AS `User_lname`, `users`.`User_email` AS `User_email`, `users`.`User_phonenumber` AS `User_phonenumber`, `users`.`User_password` AS `User_password` FROM `users` WHERE `users`.`User_type` = 2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Class_ID`),
  ADD UNIQUE KEY `Class_ID` (`Class_ID`),
  ADD KEY `Class_User` (`User_ID`),
  ADD KEY `Class_recipe` (`Recipe_ID`);

--
-- Indexes for table `class_enrollment`
--
ALTER TABLE `class_enrollment`
  ADD PRIMARY KEY (`Class_ID`,`User_ID`),
  ADD KEY `Enrolled_User` (`User_ID`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD UNIQUE KEY `Comment_ID` (`Comment_ID`),
  ADD KEY `Comment_Recipe` (`Recipe_ID`),
  ADD KEY `Comment_user` (`User_ID`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`Recipe_ID`),
  ADD UNIQUE KEY `Recipe_ID` (`Recipe_ID`),
  ADD KEY `Recipe_User` (`User_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`),
  ADD KEY `User_type` (`User_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `Class_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `Recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `Class_User` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Class_recipe` FOREIGN KEY (`Recipe_ID`) REFERENCES `recipes` (`Recipe_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_enrollment`
--
ALTER TABLE `class_enrollment`
  ADD CONSTRAINT `Enrolled_Class` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Enrolled_User` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Comment_Recipe` FOREIGN KEY (`Recipe_ID`) REFERENCES `recipes` (`Recipe_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comment_user` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `Recipe_User` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
