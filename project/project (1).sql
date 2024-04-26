-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 02:45 PM
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
  `activity_place` varchar(150) NOT NULL,
  `activity_price` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `activity`
--
DELIMITER $$
CREATE TRIGGER `activity_id` BEFORE INSERT ON `activity` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum institute_id from the registration table
    SELECT MAX(CAST(SUBSTRING(activity_id, 2) AS UNSIGNED)) INTO last_id FROM activity;
    
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
  `institute_id` varchar(6) NOT NULL,
  `package_id` varchar(6) NOT NULL,
  `institution_name` varchar(35) NOT NULL,
  `institution_email` varchar(30) NOT NULL,
  `institution_phone_no` text NOT NULL,
  `institution_address` varchar(50) NOT NULL,
  `number_of_student` int(5) NOT NULL,
  `arrival_date` datetime NOT NULL,
  `leaving_date` datetime NOT NULL,
  `guide_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `booking`
--
DELIMITER $$
CREATE TRIGGER `booking_id` BEFORE INSERT ON `booking` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum booking_id from the booking table
    SELECT MAX(CAST(SUBSTRING(booking_id, 2) AS UNSIGNED)) INTO last_id FROM booking;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new institute_id
    SET new_id = CONCAT("B", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new institute_id for the current insertion
    SET NEW.booking_id = new_id;
END
$$
DELIMITER ;

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
  `feedback_rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `feedback`
--
DELIMITER $$
CREATE TRIGGER `feedback_id` BEFORE INSERT ON `feedback` FOR EACH ROW BEGIN
    DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum feedback_id from the registration table
    SELECT MAX(CAST(SUBSTRING(feedback_id, 2) AS UNSIGNED)) INTO last_id FROM feedback;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new feedback_id
    SET new_id = CONCAT("F", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new feedback_id for the current insertion
    SET NEW.feedback_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `guide`
--

CREATE TABLE `guide` (
  `guide_id` varchar(6) NOT NULL,
  `guide_name` varchar(35) NOT NULL,
  `guide_ph_number` text NOT NULL,
  `guide_state` varchar(25) NOT NULL,
  `guide_city` varchar(25) NOT NULL,
  `guide_work_experience` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `guide`
--
DELIMITER $$
CREATE TRIGGER `guide_id` BEFORE INSERT ON `guide` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum guide_id from the guidetable
    SELECT MAX(CAST(SUBSTRING(guide_id, 2) AS UNSIGNED)) INTO last_id FROM guide;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new guide_id
    SET new_id = CONCAT("G", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new guide_id for the current insertion
    SET NEW.guide_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `hotel_id` varchar(6) NOT NULL,
  `hotel_name` varchar(35) NOT NULL,
  `hotel_state` varchar(20) NOT NULL,
  `hotel_city` varchar(20) NOT NULL,
  `hotel_price` int(10) NOT NULL,
  `hotel_ratings` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `hotel`
--
DELIMITER $$
CREATE TRIGGER `hotel_id` BEFORE INSERT ON `hotel` FOR EACH ROW BEGIN
    DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum hotel_id from the hotel table
    SELECT MAX(CAST(SUBSTRING(hotel_id, 2) AS UNSIGNED)) INTO last_id FROM hotel;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new hotel_id
    SET new_id = CONCAT("H", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new image_id for the current insertion
    SET NEW.hotel_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` varchar(6) NOT NULL,
  `image_path_1` varchar(100) NOT NULL,
  `image_path_2` varchar(100) NOT NULL,
  `image_path_3` varchar(100) NOT NULL,
  `image_path_4` varchar(100) NOT NULL,
  `image_path_5` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `images`
--
DELIMITER $$
CREATE TRIGGER `image_id` BEFORE INSERT ON `images` FOR EACH ROW BEGIN
    DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum image_id from the registration table
    SELECT MAX(CAST(SUBSTRING(image_id, 2) AS UNSIGNED)) INTO last_id FROM images;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new image_id
    SET new_id = CONCAT("IMG", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new image_id for the current insertion
    SET NEW.image_id = new_id;
END
$$
DELIMITER ;

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
  `activity_id` varchar(6) NOT NULL,
  `hotel_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `itinerary`
--
DELIMITER $$
CREATE TRIGGER `itinerary_id` BEFORE INSERT ON `itinerary` FOR EACH ROW BEGIN
    DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum itinerary_id from the registration table
    SELECT MAX(CAST(SUBSTRING(itinerary_id, 2) AS UNSIGNED)) INTO last_id FROM itinerary;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new itinerary_id
    SET new_id = CONCAT("I", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new itinerary_id for the current insertion
    SET NEW.itinerary_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` varchar(6) NOT NULL,
  `package_type` varchar(100) NOT NULL,
  `filter_category` varchar(100) NOT NULL,
  `filter_state` varchar(100) NOT NULL,
  `filter_grade` varchar(100) NOT NULL,
  `filter_season` varchar(100) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_duration` varchar(10) NOT NULL,
  `package_date1` datetime NOT NULL,
  `package_date2` datetime NOT NULL,
  `package_date3` datetime NOT NULL,
  `package_price` varchar(100) NOT NULL,
  `itenerary_id` varchar(6) NOT NULL,
  `image_id` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `packages`
--
DELIMITER $$
CREATE TRIGGER `package_id` BEFORE INSERT ON `packages` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum package_id from the package table
    SELECT MAX(CAST(SUBSTRING(package_id, 2) AS UNSIGNED)) INTO last_id FROM package;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new package_id
    SET new_id = CONCAT("F", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new package_id for the current insertion
    SET NEW.package_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `registration`
--

CREATE TABLE `registration` (
  `institute_id` varchar(6) NOT NULL,
  `institute_name` varchar(100) NOT NULL,
  `institute_email` varchar(100) NOT NULL,
  `institute_password` varchar(100) NOT NULL,
  `institute_address` varchar(500) NOT NULL,
  `institute_phone_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `registration`
--

INSERT INTO `registration` (`institute_id`, `institute_name`, `institute_email`, `institute_password`, `institute_address`, `institute_phone_number`) VALUES
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
  `student_id` varchar(6) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_age` int(11) NOT NULL,
  `guardian_num` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Triggers `student`
--
DELIMITER $$
CREATE TRIGGER `student_id` BEFORE INSERT ON `student` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum student_id from the student table
    SELECT MAX(CAST(SUBSTRING(student_id, 2) AS UNSIGNED)) INTO last_id FROM student;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new student_id
    SET new_id = CONCAT("S", LPAD(last_id + 1, 5, "0"));
    
    -- Set the new student_id for the current insertion
    SET NEW.student_id = new_id;
END
$$
DELIMITER ;

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

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `guide`
--
ALTER TABLE `guide`
  ADD PRIMARY KEY (`guide_id`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `itinerary`
--
ALTER TABLE `itinerary`
  ADD PRIMARY KEY (`itinerary_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `registration`
--
ALTER TABLE `registration`
  ADD PRIMARY KEY (`institute_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
