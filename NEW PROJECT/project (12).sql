-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 07:09 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `activity_name`, `activity_place`, `activity_price`) VALUES
('A00001', 'Jungle-safari', 'SasanGir', 400),
('A00002', 'Museum-Visit', 'Ahmedabad', 200),
('A00003', 'Art', 'Ahmedabad', 150),
('A00004', 'Music Concert', 'Bhuj', 450),
('A00005', 'Camping', 'Junagadh', 350),
('A00006', 'Rock-Climbing', 'Junagadh', 250),
('A00007', 'ZipLine', 'Kutch', 200),
('A00008', 'River Rafting ', 'Ahmedabad ', 500);

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
-- Table structure for table `admin_login`
--

CREATE TABLE `admin_login` (
  `admin_id` varchar(6) NOT NULL,
  `admin_name` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`admin_id`, `admin_name`, `admin_password`) VALUES
('AD0001', 'purav', '1234'),
('AD0002', 'diya', 'diya'),
('AD0003', 'nigam', 'nigam\r\n'),
('AD0004', 'heer', 'heer');

--
-- Triggers `admin_login`
--
DELIMITER $$
CREATE TRIGGER `admin_id` BEFORE INSERT ON `admin_login` FOR EACH ROW BEGIN
    DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum admin_id from the admin_login table
    SELECT MAX(CAST(SUBSTRING(admin_id, 3) AS UNSIGNED)) INTO last_id FROM admin_login;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new admin_id
    SET new_id = CONCAT("AD", LPAD(last_id + 1, 4, "0"));
    
    -- Set the new admin_id for the current insertion
    SET NEW.admin_id = new_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `booking_id` varchar(6) NOT NULL,
  `institute_id` varchar(6) NOT NULL,
  `package_id` varchar(6) NOT NULL,
  `institution_name` varchar(35) NOT NULL,
  `institution_email` varchar(30) NOT NULL,
  `institution_phone_no` text NOT NULL,
  `institution_address` varchar(50) NOT NULL,
  `number_of_student` int(5) NOT NULL,
  `arrival_date` date NOT NULL,
  `leaving_date` date NOT NULL,
  `booking_date` datetime NOT NULL,
  `total_payment` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`booking_id`, `institute_id`, `package_id`, `institution_name`, `institution_email`, `institution_phone_no`, `institution_address`, `number_of_student`, `arrival_date`, `leaving_date`, `booking_date`, `total_payment`) VALUES
('B00001', 'I00001', 'P00003', 'Delhi Public School', 'DPS2510@gmail.com', '9664651345', 'Sarkhej,Ahmedabad', 4, '2024-08-06', '2024-08-07', '2024-06-22 18:44:53', 6000);

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
  `faq_question` varchar(1000) NOT NULL,
  `faq_answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`faq_id`, `faq_question`, `faq_answer`) VALUES
('F00001', 'What should I pack for the trip?', 'Pack comfortable clothing, sturdy walking shoes, sunscreen, a reusable water bottle, any necessary medications, and a small backpack.'),
('F00002', 'Will food be provided during the trip?', 'Yes, meals will be provided, including breakfast, lunch, and dinner. Snacks will also be available during breaks.\r\n'),
('F00003', 'How will we get there?', 'You directly need to reach at the destination. Transportation would not be provided from our side'),
('F00004', 'What activities are planned?', 'Activities include guided tours, interactive workshops, and opportunities to engage with locals for a richer cultural experience.'),
('F00005', 'Will there be free time to explore on our own?', 'No free time will be provided keeping in mind the safety & security of the students/participants'),
('F00006', 'Can I see the itinerary?', 'Certainly! You can find the detailed itinerary on our website or by contacting our team directly.'),
('F00007', 'Who do I contact in case of an emergency?', 'In case of emergency, please contact Anish Bhai at [9664551845]. This information will also be provided during the trip.'),
('F00008', 'What behavior is expected from participants?', 'We expect participants to respect each other, follow instructions from trip leaders, and adhere to local customs and regulations.');

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
  `institute_id` varchar(6) NOT NULL,
  `remarks` varchar(400) NOT NULL,
  `feedback_rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `institute_id`, `remarks`, `feedback_rating`) VALUES
('FD0001', '', 'Limited educational value. The activities planned were shallow and didnt delve deep into the subject matter. It felt more like a vacation than an educational trip. We expected more substance.', 2),
('FD0002', '', 'Fantastic experience! The educational trip organized by [website name] was incredibly well-planned. The itinerary covered a wide range of educational activities, and the guides were knowledgeable and engaging.', 5),
('FD0003', '', 'Impressive attention to detail!Ensured that every aspect of the trip, from accommodations to transportation and educational content, was top-notch. Our students learned so much and thoroughly enjoyed themselves.', 4),
('FD0004', '', 'Outstanding value for money! Compared to other educational trip providers, you offered competitive pricing without compromising on quality. Our students had an amazing time without breaking the bank.', 5),
('FD0005', '', 'Disorganized and disappointing. The educational trip arranged by lacked structure, and many of the promised activities were either canceled or poorly executed. Not worth the investment.', 1),
('FD0006', '', 'Poor communication. We encountered numerous issues during our trip, and was unresponsive to our inquiries and complaints. It felt like once they had our money, they didn\'t care about our experience.', 1),
('FD0007', '', 'Excellent customer service! Is was responsive to our needs and worked closely with us to tailor the trip to our curriculum. The result was an enriching educational experience that exceeded our expectations.', 5),
('FD0008', '', 'Kudos to the team behind this website! It\'s refreshing to come across a platform that prioritizes quality over quantity. Every article, package and trip is well-researched and thoughtfully curated. But more better results can be obtained to users....', 3),
('FD0009', '', 'I absolutely love this website! It\'s user-friendly, informative, and has everything I need. Whether I\'m looking for educational resources, entertainment, or shopping deals, this site has it all in one place.', 4),
('FD0010', '', 'I had high hopes for this travel website, but it fell short. The search filters were glitchy, and the results were inaccurate. I wasted hours trying to find a suitable hotel, only to find better options on other sites.', 2);

--
-- Triggers `feedback`
--
DELIMITER $$
CREATE TRIGGER `feedback_id` BEFORE INSERT ON `feedback` FOR EACH ROW BEGIN
    DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum feedback_id from the feedback table
    SELECT MAX(CAST(SUBSTRING(feedback_id, 3) AS UNSIGNED)) INTO last_id FROM feedback;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Increment last_id by 1
    SET last_id = last_id + 1;
    
    -- Generate the new feedback_id
    SET new_id = CONCAT("FD", LPAD(last_id, 4, "0"));
    
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
-- Dumping data for table `guide`
--

INSERT INTO `guide` (`guide_id`, `guide_name`, `guide_ph_number`, `guide_state`, `guide_city`, `guide_work_experience`) VALUES
('G00001', 'Hiren Shrivastav', '9823548906', 'Gujarat', 'Ahmedabad', '2'),
('G00002', 'Rahul Sharma', '8867435602', 'Gujarat', 'Junagadh', '5'),
('G00003', 'Aatri Shukla', '9734532789', 'Gujarat', 'Ahmedabad', '1'),
('G00004', 'saiie saikh', '9876898767', 'Gujarat', 'Baroda', '4'),
('G00005', 'Toran Patel', '8767590954', 'Gujarat', 'Bhuj', '3'),
('G00006', 'Gaurav Shah', '7689870987', 'Gujarat', 'Kutch', '1'),
('G00007', 'Ved Parikh', '4567859435', 'Gujarat', 'Anand', '2'),
('G00008', 'Roy Kapoor', '4567876554', 'Gujarat', 'Ahmedabad', '2'),
('G00009', 'Amar kothari', '9890978765', 'Gujarat', 'Ahmedabad', '3'),
('G00010', 'Rihana Sheikh', '8976850976', 'Gujarat', 'Junagadh', '2'),
('G00011', 'Deep Jaiswal', '7689787656', 'Gujarat', 'Ahmedabad', '2'),
('G00012', 'Samay Shah', '6789876567', 'Gujarat', 'Anand', '1'),
('G00013', 'Biraj Patel', '9878098765', 'Gujarat', 'Palanpur', '4');

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
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`hotel_id`, `hotel_name`, `hotel_state`, `hotel_city`, `hotel_price`, `hotel_ratings`) VALUES
('H00001', 'Seneria ', 'Gujarat', 'Ahmedabad', 1000, 3),
('H00002', 'High Skies', 'Gujarat', 'Junagadh', 1000, 3),
('H00003', 'Lake View', 'Gujarat', 'Ahmedabad', 1300, 5),
('H00004', 'HolyWood Feels', 'Gujarat', 'Bhuj', 1000, 4),
('H00005', 'Green Vally', 'Gujarat', 'Dwarka', 850, 3),
('H00006', 'The Taj Palace ', 'Gujarat', 'Surat', 1000, 5),
('H00007', 'May Flower', 'Gujarat', 'Anand', 950, 3),
('H00008', 'Day Night', 'Gujarat', 'Bhuj', 1000, 4),
('H00009', 'Ghat View', 'Gujarat', 'Kutch', 1300, 4),
('H00010', 'Dream Palace', 'Gujarat', 'Anand', 900, 3),
('H00011', 'Green Woods', 'Gujarat', 'Ahmedabad ', 1500, 4),
('H00012', 'Homly Vibes', 'Gujarat', 'Junagadh', 1900, 3),
('H00013', 'The Oberoi', 'Gujarat', 'Surat', 2000, 5),
('H00014', 'Mani Mansion', 'Rajasthan', 'Jaipur', 1300, 4),
('H00015', 'Rao mahal', 'Rajasthan', 'Udaipur', 2000, 4),
('H00016', 'Nalanda', 'Uttar pradesh', 'Varansi', 1600, 4);

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
  `image_path_4` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_path_1`, `image_path_2`, `image_path_3`, `image_path_4`) VALUES
('IMG001', 'images/trip/t11.jpg', 'images/trip/t12.jpg', 'images/trip/t13.jpg', 'images/trip/t14.jpg'),
('IMG002', 'images/trip/t21.jpg\r\n', 'images/trip/t22.jpg', 'images/trip/t23.jpg', 'images/trip/t24.jpg'),
('IMG003', 'images/trip/t31.jpg\r\n', 'images/trip/t32.jpg', 'images/trip/t33.jpg', 'images/trip/t34.jpg'),
('IMG004', 'images/trip/t41.jpg', 'images/trip/t42.jpg', 'images/trip/t43.jpg', 'images/trip/t44.jpg'),
('IMG005', 'images/trip/t51.jpg', 'images/trip/t52.jpg', 'images/trip/t53.jpg', 'images/trip/t54.jpg'),
('IMG006', 'images/trip/t61.jpg', 'images/trip/t62.jpg', 'images/trip/t63.jpg', 'images/trip/t64.jpg'),
('IMG007', 'images/trip/t71.jpg', 'images/trip/t72.jpg', 'images/trip/t73.jpg', 'images/trip/t74.jpg'),
('IMG008', 'images/trip/t81.jpg', 'images/trip/t82.jpg', 'images/trip/t83.jpg', 'images/trip/t84.jpg'),
('IMG014', 'images/trip/t141.jpg', 'images/trip/t142.jpg', 'images/trip/t143.jpg', 'images/trip/t144.jpg'),
('IMG015', 'images/trip/t151.jpg', 'images/trip/t152.jpg', 'images/trip/t153.jpg', 'images/trip/t154.jpg'),
('IMG016', 'images/trip/t161.jpg', 'images/trip/t162.jpg', 'images/trip/t163.jpg', 'images/trip/t164.jpg');

--
-- Triggers `images`
--
DELIMITER $$
CREATE TRIGGER `image_id` BEFORE INSERT ON `images` FOR EACH ROW BEGIN
    DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);

    -- Get the maximum image_id from the images table
    SELECT MAX(CAST(SUBSTRING(image_id, 4) AS UNSIGNED)) INTO last_id FROM images;

    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;

    -- Increment last_id by 1
    SET last_id = last_id + 1;

    -- Generate the new image_id
    SET new_id = CONCAT('IMG', LPAD(last_id, 3, '0'));

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
  `package_id` varchar(6) NOT NULL,
  `day` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `distance` mediumint(9) NOT NULL,
  `description` varchar(10000) NOT NULL,
  `activity_id` varchar(6) NOT NULL,
  `hotel_id` varchar(6) NOT NULL,
  `images_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `itinerary`
--

INSERT INTO `itinerary` (`itinerary_id`, `package_id`, `day`, `location`, `distance`, `description`, `activity_id`, `hotel_id`, `images_id`) VALUES
('I00001', 'P00001', 1, 'Ahmedabad  - SasanGir', 380, 'National Jungle Safari', 'A00001', 'H00001', 'IMG001'),
('I00002', 'P00001', 2, 'SasanGir', 45, 'Interpretation Zone at Devaliya', 'A00001', 'H00001', 'IMG001'),
('I00003', 'P00001', 3, 'SasanGir - Diu', 100, 'Paul\'s Church,Diu Museum,Naida Caves,Gangeshwar Mahadev Temple,Diu Fort', 'A00001', 'H00001', 'IMG001'),
('I00004', 'P00001', 4, 'Diu - Ahmedabad', 140, 'Return', 'A00001', 'H00001', 'IMG001'),
('I00005', 'P00002', 1, 'Ahmedabad Day Tour', 35, 'Sabarmati Ashram - Sabarmati Riverfront - Adalaj Stepwell - Trimandir', 'A00002', 'H00002', 'IMG002'),
('I00006', 'P00002', 2, 'Ahmedabad', 12, 'Huthesingh jain temple - Dada hari ni vav - Julta Minara - Sidi saiyad Mosque, Rani Sipri Mosque - Sarkhej Roza - Iscon Temple', 'A00002', 'H00002', 'IMG002'),
('I00007', 'P00002', 3, 'Ahmedabad - Modhera - Patan', 120, 'Modhera Sun Temple - Queen of Bhimdev', 'A00002', 'H00002', 'IMG002'),
('I00008', 'P00002', 4, 'Ahmedabad', 120, 'Return', 'A00002', 'H00002', 'IMG002'),
('I00010', 'P00003', 1, 'Gandhi Ashram - Hutheesing Jain Temple - Sidi Saiyad Mosque - Bhadra Fort - Ellis Bridge - Riverfron', 26, 'Gandhi Ashram:  Visit Gandhi Ashram and explore Hriday Kunj (Where Mahatma Gandhi Lived), Upasana Bhoomi and Museum.  Hutheesing Jain Temple:  The Jain Temple know as Derasar in Gujarati.   Sidi Saiyad Mosque:  The Mosque Is Famouse Jhali.  Bhadra Fort:  Oldest part of City and Most Vibrant Part too.  Ellis Bridge:  Than We Will Pass From Ellis Bridge Which Is Oldest Bridge in City.   Riverfront Flower Garden:  Now ready to visit Beautiful Flower Garden at Sabarmati Riverfront.   Sanskar Kendra:  Visit Sanskar Kendra Museum Means Visit Three Different Kind of Museums   kankaria Lake:  Kankariya Lake is One Of The Most Favourite Picnic Place In Eastern Part Of City.', 'A00003', 'H00003', 'IMG003'),
('I00011', 'P00004', 1, 'Ahmedabad - Baroda', 310, 'Baroda Museum - Sursagar lake', 'A00004', 'H00004', 'IMG004'),
('I00012', 'P00004', 2, 'Baroda - Gondal - Junagadh', 445, 'Naulakha palace - Vintage car museum', 'A00004', 'H00004', 'IMG004'),
('I00013', 'P00004', 3, 'Junagadh - Somnath', 98, 'Bahauddin arts - scince collage - juma masjid - Uparkot Fort', 'A00004', 'H00004', 'IMG004'),
('I00014', 'P00004', 4, 'Somnath - Ahmedabad', 350, 'Return', 'A00004', 'H00004', 'IMG004'),
('I00015', 'P00005', 1, 'Ahmedabad – Little Rann of Kutch', 670, 'desert by open jeep in the Little Rann of Kutch\r\n', 'A00005', 'H00005', 'IMG005'),
('I00016', 'P00005', 2, ' Little Rann of Kutch – Bhuj', 210, 'Aina Mahal Museu -  Pragmahal Museum\r\n', 'A00005', 'H00005', 'IMG005'),
('I00017', 'P00005', 3, ' Bhuj – Hodka Village', 36, 'Traditional dinners -  Folk music performances - Bonfire nights -  Star-gazing\r\n', 'A00005', 'H00005', 'IMG005'),
('I00018', 'P00005', 4, 'Hodka – Banni & Pachcham Region - Hodka', 20, 'Dhordo village -  Bhirandiyara village - Ludiya village and Khavda village\r\n\r\n', 'A00005', 'H00005', 'IMG005'),
('I00019', 'P00005', 5, 'Ahmedabad', 670, 'Return', 'A00005', 'H00005', 'IMG005'),
('I00020', 'P00006', 1, 'Ahmedabad - Bhuj\r\n', 560, 'Bhuj Tour', 'A00006', 'H00006', 'IMG006'),
('I00021', 'P00006', 2, 'Bhuj – mata no madh', 20, 'Mata no madh, - take a darshan at madh\r\n', 'A00006', 'H00006', 'IMG006'),
('I00022', 'P00006', 3, 'White Rann - Kalo dungar –Ahmedabad\r\n', 80, 'Kalo Dungar - Great Rann of Kutch - return\r\n', 'A00006', 'H00006', 'IMG006'),
('I00023', 'P00007', 1, 'Ahmedabad - Jamnagar\r\n', 340, 'Ahmedabad - Jamnagar\r\n', 'A00007', 'H00007', 'IMG007'),
('I00024', 'P00007', 2, 'Reliance Ind. - Ahmedabad', 290, 'Reliance industries - Jamnagar sightseeing - return\r\n\r\n', 'A00007', 'H00007', 'IMG007'),
('I00025', 'P00008', 1, 'Ahmedabad - Anand\r\n', 200, 'Anand Night stay', 'A00008', 'H00008', 'IMG008'),
('I00026', 'P00008', 2, 'Anand - Amul - Ahmedabad\r\n', 10, 'Amul dairy - Anand sightseeing - return\r\n', 'A00008', 'H00008', 'IMG008'),
('I00027', 'P00009', 1, 'Ahmedabad - Sanand - Rajkot', 440, 'Arvind Mill - Tata neno factory\r\n', 'A00009', 'H00009', 'IMG009'),
('I00028', 'P00009', 2, ' Rajkot - Morbi - Jamnagar\r\n', 130, 'Ajanta Clock factory - Reliance Petroleum industry\r\n', 'A00009', 'H00009', 'IMG009'),
('I00029', 'P00009', 3, 'Jamnagar - Pipavav - Ahmedabad', 370, 'Stay - bulk and liquid cargo - return\r\n', 'A00009', 'H00009', 'IMG009'),
('I00030', 'P00010', 1, 'Ahmedabad - Anand\r\n', 220, 'Anand Night stay', 'A00010', 'H00010', 'IMG010'),
('I00031', 'P00010', 2, 'Anand - Amul - Ahmedabad\r\n', 240, 'Amul dairy - Anand sightseeing - return', 'A00010', 'H00010', 'IMG010'),
('I00032', 'P00011', 1, 'Ahmedabad - Anand - Baroda\r\n', 310, 'Amul - Stay\r\n\r\n', 'A00011', 'H00011', 'IMG011'),
('I00033', 'P00011', 2, 'Baroda - Ankleshwar - Surat\r\n', 410, 'Asian Paints - Stay', 'A00011', 'H00011', 'IMG011'),
('I00034', 'P00011', 3, 'Surat - Ahmedabad\r\n', 450, 'Diamond Polishing - Return\r\n', 'A00011', 'H00011', 'IMG011'),
('I00035', 'P00012', 1, 'Ahmedabad - Statue of Unity', 150, 'Some Activities\r\n', 'A00012', 'H00012', ''),
('I00036', 'P00012', 2, 'Statue of Unity - Amedabad', 160, 'Other Activities - return\r\n', 'A00012', 'H00012', ''),
('I00037', 'P00013', 1, 'Ahmedabad - Jamnagar - Dwarka\r\n', 360, 'Lakhota Lake and Bala Human Temple - stay', 'A00013', 'H00013', ''),
('I00038', 'P00013', 2, 'Dwarka\r\n', 10, 'Temple Visit ', 'A00013', 'H00013', ''),
('I00039', 'P00013', 3, 'Dwarka - Porbandar - Somnath', 110, 'Some Activites', 'A00013', 'H00013', ''),
('I00040', 'P00013', 4, 'Somnath - Ahmedabad\r\n', 300, 'Temple Visit - Return', 'A00013', 'H00013', ''),
('I00041', 'P00014', 1, 'Arrival in Jaipur', 649, 'Arrive in Jaipur, the capital city known for its vibrant culture and majestic architecture.', 'A00002', 'H00014', 'IMG014'),
('I00042', 'P00014', 2, 'Jaipur Sightseeing', 10, ' Amber Fort, located on the outskirts of Jaipur.', 'A00002', 'H00014', 'IMG014'),
('I00043', 'P00014', 3, ' Jaipur - Pushkar - Departure', 56, 'Visit the Brahma Temple, dedicated to Lord Brahma', '', 'H00014', 'IMG014'),
('I00044', 'P00015', 1, 'Udaipur', 458, 'Arrival at Udaipur', 'A00004', 'H00015', 'IMG015'),
('I00045', 'P00015', 2, 'Udaipur', 8, 'visit Moti Magri- City palace-Boat Ride to Jag Mandir', 'A00004', 'H00015', 'IMG015'),
('I00046', 'P00015', 3, 'Chittorgarh – Pushkar', 40, 'Chittorgarh Fort – a UNESCO World Heritage Site', '', 'H00015', 'IMG015'),
('I00047', 'P00015', 4, 'Pushkar – Jaipur', 80, 'visit Brahma Mandir-Puskar Tirth-Kishangarh', 'A00004', 'H00015', 'IMG015'),
('I00048', 'P00014', 5, 'Jaipur', 10, 'Hawa Mahal-Jantar Mantar\r\nCity Palace\r\nPanna Meena ka Kund\r\nAmer Fort', '', 'H00015', 'IMG015'),
('I00049', 'P00015', 6, 'Jaipur – Departure to hometown', 580, 'Back to Ahmedabad', '', 'H00015', 'IMG015'),
('I00050', 'P00016', 1, 'Varanasi', 1389, 'ARRIVE – VARANASI ( BREAKFAST - LUNCH - DINNER)', '', 'H00016', 'IMG016'),
('I00051', 'P00016', 2, 'VARANASI', 20, 'Bharat Mata Temple, Banaras Hindu University', '', 'H00016', 'IMG016'),
('I00052', 'P00016', 3, 'VARANASI - BODHGAYA', 40, 'Bodhgaya in the state of Bihar', '', 'H00016', 'IMG016'),
('I00053', 'P00016', 4, 'BODHGAYA (BREAKFAST - LUNCH - DINNER)', 8, 'Mahabodhi Temple & Bodhi Tree, Great Buddha Statue', '', 'H00016', 'IMG016'),
('I00054', 'P00016', 5, 'BODHGAYA', 40, 'Day Free in Bodhgaya', '', 'H00016', 'IMG016'),
('I00055', 'P00016', 6, 'BODHGAYA - RAJGIR – NALANDA - RAJGIR - PATNA', 80, 'Rajgir the Vulture Hill, World Peace Stupa, Bamboo\'s Garden', '', 'H00016', 'IMG016'),
('I00056', 'P00016', 7, 'PATNA – VAISHALI -KUSHINAGAR', 40, 'Mahaparinirwana Temple and Rambhar Stupa, Japan Temple', '', 'H00016', 'IMG016'),
('I00057', 'P00016', 8, ' KUSHINAGAR - LUMBINI', 8, 'Visit Lumbini, the Birth place of Lord Buddha', 'A00004', 'H00016', 'IMG016'),
('I00058', 'P00016', 9, ' LUMBINI - SRAVASTI', 5, 'kingdom of Kosala, Jetawana Gardens Buddhist temples', '', 'H00016', 'IMG016'),
('I00059', 'P00016', 10, 'SRAVASTI – Ahmedabad', 580, 'Arrive Lucknow, transfer to airport to board flight to Ahmedabad', '', 'H00015', 'IMG016'),
('I00060', 'P00016', 11, 'DEPARTURE', 1200, 'Arrival to ahmedabad', '', 'H00016', 'IMG016');

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
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` varchar(6) NOT NULL,
  `package_type` varchar(100) NOT NULL,
  `filter_category` varchar(100) NOT NULL,
  `filter_state` varchar(100) NOT NULL,
  `filter_grade` varchar(100) NOT NULL,
  `filter_month` varchar(100) NOT NULL,
  `package_name` varchar(100) NOT NULL,
  `package_duration` varchar(10) NOT NULL,
  `package_date1` date NOT NULL,
  `package_date2` date NOT NULL,
  `package_date3` date NOT NULL,
  `package_price` varchar(100) NOT NULL,
  `image_id` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `package_type`, `filter_category`, `filter_state`, `filter_grade`, `filter_month`, `package_name`, `package_duration`, `package_date1`, `package_date2`, `package_date3`, `package_price`, `image_id`) VALUES
('P00001', 'Standard', 'Wildlife', 'Gujarat', 'Higher-Secondary', 'Monsoon', 'Wildlife-beaches', '4', '2024-06-27', '2024-06-30', '2024-07-16', '8500', 'images/imagee1.jpeg'),
('P00002', 'Economic', 'Heritage', 'Gujarat', 'Secondary', 'Summer', 'Ahmedabad city tour', '4', '2024-06-28', '2024-07-02', '2024-08-05', '2000', 'images/imagee2.jpeg'),
('P00003', 'Economic', 'Cultural', 'Gujarat', 'Secondary', 'Summer', 'Gandhi Ashram', '1', '2024-07-02', '2024-08-06', '2024-08-15', '1500', 'images/imagee3.jpeg'),
('P00004', 'Premium', 'Religious', 'Gujarat', 'Higher-secondary', 'Winter', 'Somnath-Junaghdh', '4', '2024-06-28', '2024-07-03', '2024-07-10', '9000', 'images/imagee4.jpeg'),
('P00005', 'Premium', 'Heritage', 'Gujarat', 'Higher-Secondary', 'Winter', 'Little Rann of Kutch', '5', '2024-06-29', '2024-07-10', '2024-07-12', '11000', 'images/imagee5.jpeg'),
('P00006', 'Economic', 'Cultural', 'Gujarat', 'Primary', 'Winter', 'Ahmedabad-Bhuj', '3', '2024-07-10', '2024-07-24', '2024-08-14', '12000', 'images/imagee6.jpeg'),
('P00007', 'Standard', 'Industrial', 'Gujarat', 'Primary', 'Monsoon', 'Reliance Inductries Visit', '2', '2024-07-09', '2024-08-19', '2024-08-24', '3000', 'images/imagee7.jpeg'),
('P00008', 'Premium', 'Industrial', 'Gujarat', 'Secondary', 'Summer', 'Amul Dairy Visit', '2', '2024-07-22', '2024-07-31', '2024-08-12', '2000', 'images/imagee8.jpeg'),
('P00009', 'Standard', 'Industrial', 'Gujarat', 'Higher-Secondary', 'Summer', 'Visit Industries-I', '3', '2024-06-30', '2024-07-12', '2024-07-24', '6000', 'images/imagee9.jpeg'),
('P00010', 'Economic', 'Insdustrial', 'Gujarat', 'Secondary', 'Monsoon', 'Amul Dairy Visit', '2', '2024-07-08', '2024-07-18', '2024-08-13', '1500', 'images/imagee10.jpeg'),
('P00011', 'Standard', 'Industrial', 'Gujarat', 'Higher-Secondary', 'Winter', 'Visit Induwstries-II', '3', '2024-06-29', '2024-07-10', '2024-08-13', '6000', 'images/imagee11.jpeg'),
('P00012', 'Economic', 'Historial', 'Gujarat', 'Secondary', 'Winter', 'Statue of Unity Visit', '2', '2024-07-31', '2024-08-06', '2024-09-10', '2000', 'images/imagee12.jpeg'),
('P00013', 'Premium ', 'Religious', 'Gujarat', 'Primary', 'Monsoon', 'Dwarka-Somnath Visit', '4', '2024-07-31', '2024-08-14', '2024-09-18', '9000', 'images/imagee13.jpeg'),
('P00014', 'Premium', 'Heritage', 'Rajasthan', 'Higher-Secondary', 'Summer', 'Heritage Rajasthan', '3', '2024-07-16', '2024-08-21', '2024-09-17', '18000', 'images/imagee14.jpeg'),
('P00015', 'Premium', 'Heritage', 'Rajasthan', 'Higher-Secondary', 'Winter', 'Highlights of Rajasthan', '6', '2024-07-08', '2024-07-17', '2024-08-05', '30000', 'images/imagee15.jpeg'),
('P00016', 'Premium', 'Historial', 'Uttar-Pradesh', 'Higher-Secondary', 'Summer', 'Buddhist Study Tour', '11', '2024-07-09', '2024-07-25', '2024-08-13', '45000', 'images/imagee16.jpeg');

--
-- Triggers `package`
--
DELIMITER $$
CREATE TRIGGER `package_id` BEFORE INSERT ON `package` FOR EACH ROW BEGIN
  DECLARE last_id INT;
    DECLARE new_id VARCHAR(15);
    
    -- Get the maximum package_id from the package table
    SELECT MAX(CAST(SUBSTRING(package_id, 2) AS UNSIGNED)) INTO last_id FROM package;
    
    -- If no records are present, initialize last_id to 0
    IF last_id IS NULL THEN
        SET last_id = 0;
    END IF;
    
    -- Generate the new package_id
    SET new_id = CONCAT("P", LPAD(last_id + 1, 5, "0"));
    
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
('I00001', 'Delhi Public School', 'DPS2510@gmail.com', 'Dps@123', 'Sarkhej,Ahmedabad', '9664651345'),
('I00002', 'Prerna High School', 'phs000@gmail.com', 'phs', 'Naranpura, Ahmedabad', '9825400254'),
('I00003', 'St.Kabir School', 'stkabir@gmail.com', 'stkabir25', 'Drive-in, Ahmedabad', '9686532025'),
('I00004', 'Niyati Primary School', 'Niyatips@gmail.com', 'nps100@gmail.com', 'Krishnanagar, Ahmedabad', '9444510145'),
('I00005', 'Nirman High School', 'nirmanschool@gmail.com', 'nirman@222', 'Vastrapur, Ahmedabad', '9584523101'),
('I00006', 'Little Flower School', 'lfs1989@gmail.com', 'lfs123', 'Paldi, Ahmedabad', '9894501002'),
('I00007', 'CN VidhyaPith', 'cnvps@gmail.com', 'cnvps', 'Manekbaug, Ahmedabad', '9885858002'),
('I00008', 'Zydus School for Excellence', 'zydusgodhavi@gmail.com', 'zygo@1980', 'Godhavi, Ahmedabad', '9765858345'),
('I00009', 'AG High School', 'AGHS@gmail.com', 'aghs145', 'Navrangpura, Ahmedabad', '9885856565'),
('I00010', 'Udgam High School', 'udgamdrivein@gmail.com', 'uhs@1985', 'Drive-In, Ahmedabad', '9865400038'),
('I00011', 'S H Kharawala', 'shk@gmail.com', 'shk', 'Navrangpura', '9898566740');

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
  `institute_id` varchar(30) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_age` int(11) NOT NULL,
  `guardian_num` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `institute_id`, `student_name`, `student_age`, `guardian_num`) VALUES
('S00001', 'I00001', 'ABC', 22, '1234567890'),
('S00002', 'I00001', 'DEF', 21, '1234567890'),
('S00003', 'I00001', 'GHI', 18, '1234567890'),
('S00004', 'I00001', 'JKL', 15, '1234567890');

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
-- Indexes for table `admin_login`
--
ALTER TABLE `admin_login`
  ADD PRIMARY KEY (`admin_id`);

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
-- Indexes for table `package`
--
ALTER TABLE `package`
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
