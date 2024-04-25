-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2024 at 01:13 PM
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
('I00002', 'nirman ', 'nirman@gmail.com', 'nirmna', 'vastrapur', '8019220948');

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
