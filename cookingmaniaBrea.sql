-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 06:15 AM
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
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `Class_ID` int(11) NOT NULL,
  `Recipe_ID` int(11) DEFAULT NULL,
  `Class_duration` double DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Class_Size_Limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`Class_ID`, `Recipe_ID`, `Class_duration`, `User_ID`, `Class_Size_Limit`) VALUES
(1, 1, 3, 1, 5),
(2, 1, 4, 1, 43);

-- --------------------------------------------------------

--
-- Table structure for table `class_enrollment`
--

CREATE TABLE `class_enrollment` (
  `User_ID` int(11) NOT NULL,
  `Class_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_enrollment`
--

INSERT INTO `class_enrollment` (`User_ID`, `Class_ID`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `class_scheduler`
--

CREATE TABLE `class_scheduler` (
  `Class_ID` int(11) NOT NULL,
  `DateClass` date NOT NULL,
  `Class_StartTime` time DEFAULT NULL,
  `Class_EndTime` time DEFAULT NULL,
  `Class_RoomNum` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_scheduler`
--

INSERT INTO `class_scheduler` (`Class_ID`, `DateClass`, `Class_StartTime`, `Class_EndTime`, `Class_RoomNum`) VALUES
(1, '2023-04-22', '13:00:00', '14:00:00', '123'),
(1, '2023-05-22', '13:00:00', '14:00:00', '123'),
(2, '2023-05-22', '13:00:00', '14:00:00', '123');

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
(1, 1, 1, 'I like this.'),
(2, 1, 1, 'I dont like this.');

-- --------------------------------------------------------

--
-- Table structure for table `ingredients`
--

CREATE TABLE `ingredients` (
  `Ingredient_ID` int(11) NOT NULL,
  `Ingredient_Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredients`
--

INSERT INTO `ingredients` (`Ingredient_ID`, `Ingredient_Name`) VALUES
(1, 'Carrot'),
(2, 'Chicken');

-- --------------------------------------------------------

--
-- Table structure for table `ingredient_list`
--

CREATE TABLE `ingredient_list` (
  `Recipe_ID` int(11) NOT NULL,
  `Ingredient_ID` int(11) NOT NULL,
  `Ingredient_Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ingredient_list`
--

INSERT INTO `ingredient_list` (`Recipe_ID`, `Ingredient_ID`, `Ingredient_Quantity`) VALUES
(1, 1, 3),
(44, 1, 2),
(44, 2, 2);

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
  `last_update_date` date DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`Recipe_ID`, `Recipe_name`, `Recipe_time`, `Recipe_level`, `Recipe_instructions`, `last_update_date`, `User_ID`) VALUES
(1, 'Chicken Preksha', '0.23', 3, 'Cook the chicken. Make sure its not raw or burning. ', '2023-04-16', 1),
(2, 'Meat', '0.23', 1, 'Cook the meat', NULL, 1),
(4, 'meatballs', '1', 1, 'reheat the meatballs and then add some salt and pepper. Then, after a bit it is ready. ', '2023-04-23', 1),
(5, 'Chicken tacos', '1', 1, 'make chicken, tacos and pico.        ', '2023-04-23', 1),
(7, 'meatballs', '0.1', 1, ' cook them.', '2023-04-23', 1),
(14, 'cake', '4', 4, '    get a box from the grocery store and make it.', '2023-04-23', 1),
(15, 'cake', '4', 4, '    get a box from the grocery store and make it.', '2023-04-23', 1),
(16, 'cake', '4', 4, '    get a box from the grocery store and make it.', '2023-04-23', 1),
(28, 'veggie taco', '2', 2, '     chicken and add taco and carrot. ', '2023-04-23', 1),
(37, 'veggie taco', '2', 2, '     chicken and add taco and carrot. ', '2023-04-23', 1),
(44, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1),
(49, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1),
(50, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1),
(51, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1),
(52, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1),
(53, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1),
(54, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1),
(55, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1),
(56, 'chicken carrots', '1', 2, '     chicken and carrots. ', '2023-04-23', 1);

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
(1, 3, 'Preksha', 'Vaghela', 'prekshavaghela@gmail.com', '12234567890', 'preksha'),
(2, 1, 'Ella', 'Hello', 'helloella@gmail.com', '21321231', 'hello'),
(5, 3, NULL, NULL, NULL, NULL, NULL);

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
  ADD KEY `Class_enrollment_user` (`User_ID`);

--
-- Indexes for table `class_scheduler`
--
ALTER TABLE `class_scheduler`
  ADD PRIMARY KEY (`Class_ID`,`DateClass`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD UNIQUE KEY `Comment_ID` (`Comment_ID`),
  ADD KEY `Comment_Recipe` (`Recipe_ID`),
  ADD KEY `Comment_user` (`User_ID`);

--
-- Indexes for table `ingredients`
--
ALTER TABLE `ingredients`
  ADD PRIMARY KEY (`Ingredient_ID`),
  ADD UNIQUE KEY `Ingredient_ID` (`Ingredient_ID`),
  ADD UNIQUE KEY `Ingredient_Name` (`Ingredient_Name`);

--
-- Indexes for table `ingredient_list`
--
ALTER TABLE `ingredient_list`
  ADD PRIMARY KEY (`Recipe_ID`,`Ingredient_ID`),
  ADD KEY `Ingredient_ID_list` (`Ingredient_ID`);

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`Recipe_ID`),
  ADD UNIQUE KEY `Recipe_ID` (`Recipe_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`);

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
-- AUTO_INCREMENT for table `ingredients`
--
ALTER TABLE `ingredients`
  MODIFY `Ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `Recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
  ADD CONSTRAINT `Class_enrollment_class` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Class_enrollment_user` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `class_scheduler`
--
ALTER TABLE `class_scheduler`
  ADD CONSTRAINT `ClassID_scheduler` FOREIGN KEY (`Class_ID`) REFERENCES `classes` (`Class_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `Comment_Recipe` FOREIGN KEY (`Recipe_ID`) REFERENCES `recipes` (`Recipe_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Comment_user` FOREIGN KEY (`User_ID`) REFERENCES `users` (`User_ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ingredient_list`
--
ALTER TABLE `ingredient_list`
  ADD CONSTRAINT `Ingredient_ID_list` FOREIGN KEY (`Ingredient_ID`) REFERENCES `ingredients` (`Ingredient_ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Recipe_ID_list` FOREIGN KEY (`Recipe_ID`) REFERENCES `recipes` (`Recipe_ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
