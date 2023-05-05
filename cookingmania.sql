-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2023 at 08:56 PM
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
  `Class_EndTime` time NOT NULL,
  `Class_Enrollment` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Class_ID`, `Recipe_ID`, `User_ID`, `Class_Date`, `Class_StartTime`, `Class_RoomNum`, `Class_EndTime`, `Class_Enrollment`) VALUES
(1, 1, 19, '2023-05-16', '09:00:00', 201, '10:00:00', 13),
(2, 1, 19, '2023-05-22', '10:30:00', 201, '11:00:00', 16),
(3, 2, NULL, '2023-05-22', '15:10:00', 432, '16:10:00', 20),
(4, 1, NULL, '2023-05-17', '09:30:00', 312, '10:10:00', 44),
(5, 2, 7, '2023-05-20', '12:00:00', 432, '12:40:00', 24);

-- --------------------------------------------------------

--
-- Stand-in structure for view `classes_recipes_matching`
-- (See below for the actual view)
--
CREATE TABLE `classes_recipes_matching` (
`User_ID` int(11)
,`Recipe_name` varchar(255)
,`Class_Date` date
,`Class_StartTime` time
,`Class_EndTime` time
,`Class_RoomNum` int(11)
,`Class_Enrollment` int(3)
,`Class_ID` int(11)
,`Recipe_time` varchar(255)
,`Recipe_level` int(11)
,`Recipe_instructions` mediumtext
);

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
(1, 20),
(2, 15),
(2, 16),
(3, 18);

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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`Comment_ID`, `Recipe_ID`, `User_ID`, `CommentText`) VALUES
(3, 1, 19, 'Very Delicious! I loved teaching this class!'),
(4, 1, 18, 'Thank you for teaching professor!'),
(5, 2, 18, 'This was a horrible dish'),
(6, 2, 20, 'I agree with Hermione'),
(7, 57, 21, 'Make this Harry Potter it will help.');

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
(2, 'Chicken Parmesan', '45', 2, 'Cook Chicken Till Burnt\r\nPlace marinara in air fryer\r\nStir up the sauce\r\nRun it with the crew', '', '2023-05-01', 19),
(57, 'Hamburger', '0.4', 1, 'Cook the Burger for 15 minutes on each side at medium high heat. Use my homemade werstechire sauce.', 'Beef 85/15\r\nbuns\r\nketchup\r\nlettuce\r\ntomato\r\nonion\r\n', '2023-05-05', 21);

-- --------------------------------------------------------

--
-- Stand-in structure for view `registration_to_classes`
-- (See below for the actual view)
--
CREATE TABLE `registration_to_classes` (
`Class_ID` int(11)
,`User_ID` int(11)
,`Class_Date` date
,`Class_RoomNum` int(11)
,`Class_StartTime` time
,`Class_EndTime` time
,`Recipe_ID` int(11)
,`Class_Enrollment` int(3)
);

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
(19, 2, 'Severus', 'Snape', 'HalfBlodP@gmail.com', '1234567890', 'asdf'),
(20, 3, 'Harry', 'Potter', 'hpt@gmail.com', '1234567890', 'asdf'),
(21, 2, 'Albus', 'Dumbledore', 'hmaster@gmail.com', '1234567890', 'asdf');

-- --------------------------------------------------------

--
-- Structure for view `admins`
--
DROP TABLE IF EXISTS `admins`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `admins`  AS SELECT `users`.`User_ID` AS `User_ID`, `users`.`User_type` AS `User_type`, `users`.`User_fname` AS `User_fname`, `users`.`User_lname` AS `User_lname`, `users`.`User_email` AS `User_email`, `users`.`User_phonenumber` AS `User_phonenumber`, `users`.`User_password` AS `User_password` FROM `users` WHERE `users`.`User_type` = 11 ;

-- --------------------------------------------------------

--
-- Structure for view `classes_recipes_matching`
--
DROP TABLE IF EXISTS `classes_recipes_matching`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `classes_recipes_matching`  AS SELECT `classes`.`User_ID` AS `User_ID`, `recipes`.`Recipe_name` AS `Recipe_name`, `classes`.`Class_Date` AS `Class_Date`, `classes`.`Class_StartTime` AS `Class_StartTime`, `classes`.`Class_EndTime` AS `Class_EndTime`, `classes`.`Class_RoomNum` AS `Class_RoomNum`, `classes`.`Class_Enrollment` AS `Class_Enrollment`, `classes`.`Class_ID` AS `Class_ID`, `recipes`.`Recipe_time` AS `Recipe_time`, `recipes`.`Recipe_level` AS `Recipe_level`, `recipes`.`Recipe_instructions` AS `Recipe_instructions` FROM (`classes` join `recipes` on(`classes`.`Recipe_ID` = `recipes`.`Recipe_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `registration_to_classes`
--
DROP TABLE IF EXISTS `registration_to_classes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `registration_to_classes`  AS SELECT `classes`.`Class_ID` AS `Class_ID`, `class_enrollment`.`User_ID` AS `User_ID`, `classes`.`Class_Date` AS `Class_Date`, `classes`.`Class_RoomNum` AS `Class_RoomNum`, `classes`.`Class_StartTime` AS `Class_StartTime`, `classes`.`Class_EndTime` AS `Class_EndTime`, `classes`.`Recipe_ID` AS `Recipe_ID`, `classes`.`Class_Enrollment` AS `Class_Enrollment` FROM (`classes` join `class_enrollment` on(`classes`.`Class_ID` = `class_enrollment`.`Class_ID`)) ;

-- --------------------------------------------------------

--
-- Structure for view `students`
--
DROP TABLE IF EXISTS `students`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `students`  AS SELECT `users`.`User_ID` AS `User_ID`, `users`.`User_type` AS `User_type`, `users`.`User_fname` AS `User_fname`, `users`.`User_lname` AS `User_lname`, `users`.`User_email` AS `User_email`, `users`.`User_phonenumber` AS `User_phonenumber`, `users`.`User_password` AS `User_password` FROM `users` WHERE `users`.`User_type` = 33 ;

-- --------------------------------------------------------

--
-- Structure for view `teachers`
--
DROP TABLE IF EXISTS `teachers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `teachers`  AS SELECT `users`.`User_ID` AS `User_ID`, `users`.`User_type` AS `User_type`, `users`.`User_fname` AS `User_fname`, `users`.`User_lname` AS `User_lname`, `users`.`User_email` AS `User_email`, `users`.`User_phonenumber` AS `User_phonenumber`, `users`.`User_password` AS `User_password` FROM `users` WHERE `users`.`User_type` = 22 ;

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
  ADD KEY `Class_recipe` (`Recipe_ID`),
  ADD KEY `Class_RoomNum` (`Class_RoomNum`);

--
-- Indexes for table `class_enrollment`
--
ALTER TABLE `class_enrollment`
  ADD PRIMARY KEY (`Class_ID`,`User_ID`),
  ADD UNIQUE KEY `Class_ID` (`Class_ID`,`User_ID`),
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
  MODIFY `Class_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `Recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

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
