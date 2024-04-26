-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 11:02 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` varchar(6) NOT NULL,
  `activity_name` varchar(150) NOT NULL,
  `place` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `activity`
--
DELIMITER $$
CREATE TRIGGER `activity_id` BEFORE INSERT ON `activity` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum institute_id from the registration table
    SELECT MAX(CAST(SUBSTRING(faq_id, 2) AS UNSIGNED)) INTO last_id FROM activity;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new institute_id
    SET new_id = CONCAT("A", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new institute_id for the current insertion
    SET NEW.activity_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` varchar(6) NOT NULL,
  `booking_date` datetime NOT NULL,
  `customer_id` varchar(100) NOT NULL,
  `trip_id` varchar(100) NOT NULL,
  `amount` decimal(20,0) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `faq_id` varchar(6) NOT NULL,
  `faq_question` varchar(100) NOT NULL,
  `faq_answer` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `faq_question`, `faq_answer`) VALUES
('F00001', 'What types of educational trips do you offer?', 'We offer a wide range of educational trips tailored to various interests and age groups. These inclu'),
('F00002', 'Who can participate in your educational trips?', 'Our trips are designed for students of all ages, from elementary school to university level. We also'),
('F00003', 'What destinations do you offer for educational trips?', 'We organize trips to various destinations in India, including historic cities, natural wonders, cult'),
('F00004', 'Can you accommodate special dietary requirements or accessibility needs?', 'Yes, we strive to accommodate all dietary preferences and accessibility needs. Please inform us of a'),
('F00005', 'Are there safety measures in place during the trips?', 'Safety is our top priority. We work with experienced guides and follow strict safety protocols to en'),
('F00006', 'What should students pack for the trip?', 'We provide a packing list detailing essential items to bring on the trip, such as clothing appropria'),
('F00007', 'Are there opportunities for students to interact with locals during the trip?', 'Yes, we incorporate opportunities for cultural exchange and interaction with locals into our itinera'),
('F00008', 'How are the educational aspects of the trip integrated into the itinerary?', 'Our educational content is seamlessly woven into the itinerary through guided tours, workshops, gues'),
('F00009', 'What measures do you take to minimize the environmental impact of your trips?', 'We are committed to sustainable travel practices and minimizing our environmental footprint. This in'),
('F00010', 'What is the average group size for your educational trips?', 'Group sizes vary depending on the destination and program, but we aim to keep our groups small to fa'),
('F00011', 'Can you provide references or testimonials from previous participants?', 'Certainly! We have a collection of testimonials and references from previous participants who have s');

--
-- Triggers `faq`
--
DELIMITER $$
CREATE TRIGGER `faq_id` BEFORE INSERT ON `faq` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum institute_id from the registration table
    SELECT MAX(CAST(SUBSTRING(faq_id, 2) AS UNSIGNED)) INTO last_id FROM faq;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new institute_id
    SET new_id = CONCAT("F", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new institute_id for the current insertion
    SET NEW.faq_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` varchar(6) NOT NULL,
  `booking_id` varchar(6) NOT NULL,
  `customer_id` varchar(6) NOT NULL,
  `remarks` varchar(400) NOT NULL,
  `rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `sr_no` varchar(6) NOT NULL,
  `image_id` varchar(6) NOT NULL,
  `path_1` varchar(100) NOT NULL,
  `path_2` varchar(100) NOT NULL,
  `path_3` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `itinerary`
--

CREATE TABLE `itinerary` (
  `itinerary_id` varchar(6) NOT NULL,
  `itinerary_title` varchar(100) NOT NULL,
  `day` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `distance` mediumint(9) NOT NULL,
  `description` varchar(500) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `activity_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` varchar(6) NOT NULL,
  `package_type` varchar(100) NOT NULL,
  `trip_type` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `grade` varchar(100) NOT NULL,
  `season` varchar(100) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `duration` varchar(10) NOT NULL,
  `date1` datetime NOT NULL,
  `date2` datetime NOT NULL,
  `date3` datetime NOT NULL,
  `price` varchar(100) NOT NULL,
  `itenerary_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `institute_id` varchar(6) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(500) NOT NULL,
  `phone_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`institute_id`, `institute_name`, `email`, `password`, `address`, `phone_number`) VALUES
('I00001', 'abc', 'abc@gmail.com', 'abc', 'abc', '1234567890'),
('I00002', 'nirman ', 'nirman@gmail.com', 'nirmna', 'vastrapur', '8019220948'),
('I00003', 'a', 'a@gmail.com', 'a', 'a', '1234567890'),
('I00004', 'purav', 'puravshah73@gmail.com', 'purav73', 'paldi', '8160662390'),
('I00005', 'nigam', 'nnigamsanghvi@gmail.com', 'nigam', 'nikol', '9382649034');

--
-- Triggers `registration`
--
DELIMITER $$
CREATE TRIGGER `institute_id` BEFORE INSERT ON `registration` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum institute_id from the registration table
    SELECT MAX(CAST(SUBSTRING(institute_id, 2) AS UNSIGNED)) INTO last_id FROM registration;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new institute_id
    SET new_id = CONCAT("I", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new institute_id for the current insertion
    SET NEW.institute_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `stu_id` varchar(6) NOT NULL,
  `stu_name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `guardian_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`booking_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
