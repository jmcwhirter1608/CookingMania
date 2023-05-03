-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 23, 2023 at 10:28 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `CookingMania`
--

-- --------------------------------------------------------

--
-- Table structure for table `Classes`
--

CREATE TABLE `Classes` (
  `Class_ID` int(11) NOT NULL,
  `Recipe_ID` int(11) DEFAULT NULL,
  `Class_duration` double DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `Class_Size_Limit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Classes`
--

INSERT INTO `Classes` (`Class_ID`, `Recipe_ID`, `Class_duration`, `User_ID`, `Class_Size_Limit`) VALUES
(1, 1, 3, 1, 5),
(2, 1, 4, 1, 43);

-- --------------------------------------------------------

--
-- Table structure for table `Class_Enrollment`
--

CREATE TABLE `Class_Enrollment` (
  `User_ID` int(11) NOT NULL,
  `Class_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Class_Enrollment`
--

INSERT INTO `Class_Enrollment` (`User_ID`, `Class_ID`) VALUES
(1, 1),
(2, 1),
(1, 2),
(2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Class_Scheduler`
--

CREATE TABLE `Class_Scheduler` (
  `Class_ID` int(11) NOT NULL,
  `DateClass` date NOT NULL,
  `Class_StartTime` time DEFAULT NULL,
  `Class_EndTime` time DEFAULT NULL,
  `Class_RoomNum` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Class_Scheduler`
--

INSERT INTO `Class_Scheduler` (`Class_ID`, `DateClass`, `Class_StartTime`, `Class_EndTime`, `Class_RoomNum`) VALUES
(1, '2023-04-22', '13:00:00', '14:00:00', '123'),
(1, '2023-05-22', '13:00:00', '14:00:00', '123'),
(2, '2023-05-22', '13:00:00', '14:00:00', '123');

-- --------------------------------------------------------

--
-- Table structure for table `Comments`
--

CREATE TABLE `Comments` (
  `Comment_ID` int(11) NOT NULL,
  `Recipe_ID` int(11) DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL,
  `CommentText` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Comments`
--

INSERT INTO `Comments` (`Comment_ID`, `Recipe_ID`, `User_ID`, `CommentText`) VALUES
(1, 1, 1, 'I like this.'),
(2, 1, 1, 'I dont like this.');

-- --------------------------------------------------------

--
-- Table structure for table `Ingredients`
--

CREATE TABLE `Ingredients` (
  `Ingredient_ID` int(11) NOT NULL,
  `Ingredient_Name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Ingredients`
--

INSERT INTO `Ingredients` (`Ingredient_ID`, `Ingredient_Name`) VALUES
(1, 'Carrot'),
(2, 'Chicken');

-- --------------------------------------------------------

--
-- Table structure for table `Ingredient_List`
--

CREATE TABLE `Ingredient_List` (
  `Recipe_ID` int(11) NOT NULL,
  `Ingredient_ID` int(11) NOT NULL,
  `Ingredient_Quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Ingredient_List`
--

INSERT INTO `Ingredient_List` (`Recipe_ID`, `Ingredient_ID`, `Ingredient_Quantity`) VALUES
(1, 1, 3),
(44, 1, 2),
(44, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `Recipes`
--

CREATE TABLE `Recipes` (
  `Recipe_ID` int(11) NOT NULL,
  `Recipe_name` varchar(255) DEFAULT NULL,
  `Recipe_time` varchar(255) DEFAULT NULL,
  `Recipe_level` int(11) DEFAULT NULL,
  `Recipe_instructions` mediumtext DEFAULT NULL,
  `last_update_date` date DEFAULT NULL,
  `User_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Recipes`
--

INSERT INTO `Recipes` (`Recipe_ID`, `Recipe_name`, `Recipe_time`, `Recipe_level`, `Recipe_instructions`, `last_update_date`, `User_ID`) VALUES
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
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `User_ID` int(11) NOT NULL,
  `User_type` int(11) DEFAULT NULL,
  `User_fname` varchar(255) DEFAULT NULL,
  `User_lname` varchar(255) DEFAULT NULL,
  `User_email` varchar(255) DEFAULT NULL,
  `User_phonenumber` varchar(255) DEFAULT NULL,
  `User_password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`User_ID`, `User_type`, `User_fname`, `User_lname`, `User_email`, `User_phonenumber`, `User_password`) VALUES
(1, 3, 'Preksha', 'Vaghela', 'prekshavaghela@gmail.com', '12234567890', 'preksha'),
(2, 1, 'Ella', 'Hello', 'helloella@gmail.com', '21321231', 'hello'),
(5, 3, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Classes`
--
ALTER TABLE `Classes`
  ADD PRIMARY KEY (`Class_ID`),
  ADD UNIQUE KEY `Class_ID` (`Class_ID`),
  ADD KEY `Class_User` (`User_ID`),
  ADD KEY `Class_recipe` (`Recipe_ID`);

--
-- Indexes for table `Class_Enrollment`
--
ALTER TABLE `Class_Enrollment`
  ADD PRIMARY KEY (`Class_ID`,`User_ID`),
  ADD KEY `Class_enrollment_user` (`User_ID`);

--
-- Indexes for table `Class_Scheduler`
--
ALTER TABLE `Class_Scheduler`
  ADD PRIMARY KEY (`Class_ID`,`DateClass`);

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`Comment_ID`),
  ADD UNIQUE KEY `Comment_ID` (`Comment_ID`),
  ADD KEY `Comment_Recipe` (`Recipe_ID`),
  ADD KEY `Comment_user` (`User_ID`);

--
-- Indexes for table `Ingredients`
--
ALTER TABLE `Ingredients`
  ADD PRIMARY KEY (`Ingredient_ID`),
  ADD UNIQUE KEY `Ingredient_ID` (`Ingredient_ID`),
  ADD UNIQUE KEY `Ingredient_Name` (`Ingredient_Name`);

--
-- Indexes for table `Ingredient_List`
--
ALTER TABLE `Ingredient_List`
  ADD PRIMARY KEY (`Recipe_ID`,`Ingredient_ID`),
  ADD KEY `Ingredient_ID_list` (`Ingredient_ID`);

--
-- Indexes for table `Recipes`
--
ALTER TABLE `Recipes`
  ADD PRIMARY KEY (`Recipe_ID`),
  ADD UNIQUE KEY `Recipe_ID` (`Recipe_ID`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`User_ID`),
  ADD UNIQUE KEY `User_ID` (`User_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Classes`
--
ALTER TABLE `Classes`
  MODIFY `Class_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Comments`
--
ALTER TABLE `Comments`
  MODIFY `Comment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Ingredients`
--
ALTER TABLE `Ingredients`
  MODIFY `Ingredient_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Recipes`
--
ALTER TABLE `Recipes`
  MODIFY `Recipe_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Classes`
--
ALTER TABLE `Classes`
  ADD CONSTRAINT `Class_User` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`),
  ADD CONSTRAINT `Class_recipe` FOREIGN KEY (`Recipe_ID`) REFERENCES `Recipes` (`Recipe_ID`);

--
-- Constraints for table `Class_Enrollment`
--
ALTER TABLE `Class_Enrollment`
  ADD CONSTRAINT `Class_enrollment_class` FOREIGN KEY (`Class_ID`) REFERENCES `Classes` (`Class_ID`),
  ADD CONSTRAINT `Class_enrollment_user` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`);

--
-- Constraints for table `Class_Scheduler`
--
ALTER TABLE `Class_Scheduler`
  ADD CONSTRAINT `ClassID_scheduler` FOREIGN KEY (`Class_ID`) REFERENCES `Classes` (`Class_ID`);

--
-- Constraints for table `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `Comment_Recipe` FOREIGN KEY (`Recipe_ID`) REFERENCES `Recipes` (`Recipe_ID`),
  ADD CONSTRAINT `Comment_user` FOREIGN KEY (`User_ID`) REFERENCES `Users` (`User_ID`);

--
-- Constraints for table `Ingredient_List`
--
ALTER TABLE `Ingredient_List`
  ADD CONSTRAINT `Ingredient_ID_list` FOREIGN KEY (`Ingredient_ID`) REFERENCES `Ingredients` (`Ingredient_ID`),
  ADD CONSTRAINT `Recipe_ID_list` FOREIGN KEY (`Recipe_ID`) REFERENCES `Recipes` (`Recipe_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;