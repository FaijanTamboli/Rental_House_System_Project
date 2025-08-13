-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2025 at 08:10 AM
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
-- Database: `rentalhousesystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `addproperty`
--

CREATE TABLE `addproperty` (
  `property_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `city` varchar(100) NOT NULL,
  `locality` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `propertyType` varchar(50) NOT NULL,
  `floor` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `balconies` int(11) NOT NULL,
  `furnishing` varchar(20) NOT NULL,
  `parking` varchar(10) NOT NULL,
  `wifi` varchar(20) NOT NULL,
  `electricity` varchar(20) NOT NULL,
  `water` varchar(20) NOT NULL,
  `availability` varchar(20) NOT NULL,
  `availabilityDate` date DEFAULT NULL,
  `age` varchar(50) NOT NULL,
  `rent` varchar(50) NOT NULL,
  `security` varchar(50) NOT NULL,
  `maintenanceAmount` varchar(50) NOT NULL,
  `maintenanceType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `addproperty`
--

INSERT INTO `addproperty` (`property_id`, `owner_id`, `name`, `mobile`, `email`, `city`, `locality`, `address`, `propertyType`, `floor`, `bathrooms`, `balconies`, `furnishing`, `parking`, `wifi`, `electricity`, `water`, `availability`, `availabilityDate`, `age`, `rent`, `security`, `maintenanceAmount`, `maintenanceType`) VALUES
(1, 1, 'Sanika Shetve', '9405694006', 'sanika20@gmail.com', 'Pune ', 'Kothrud', 'Ideal Colony, Kothrud, Near Hotel Taj, flat No - 101 ', '1BHK', 2, 1, 1, 'Semi-Furnished', 'Yes', 'Available', 'Available', '24x7', 'Immediate', NULL, 'Less than 5 years', '20000', '40000', '500', 'Monthly'),
(2, 2, 'Pankaj Kale', '9021373247', 'pankajkale25@gmail.com', 'Ahmednagar', 'Savedi', 'Located in Savedi, Ahmadnagar,Near Chatrapati Sambhaji Nagar Highway.', '2BHK', 3, 1, 1, 'Furnished', 'Yes', 'Available', 'Available', 'Limited', 'Select Date', '2025-04-16', 'New Construction', '20000', '30000', '500', 'Monthly'),
(3, 3, 'Krushna Pawar', '9870563927', 'krushna20@gmail.com', 'Pune', 'Wagholi', 'Ubale nagar wagholi, Standalone building, Kharadi Jakat Naka, near Punjabi Spice', '1RK', 2, 1, 0, 'Semi-Furnished', 'Yes', 'Not Available', 'Available', 'Limited', 'Immediate', NULL, '5 to 10 years', '12000', '10000', '500', 'Monthly'),
(4, 4, 'Varsha Shirsath', '9529205019', 'varsha18@gmail.com', 'Nashik', ' Indira Nagar, Nashik', 'Amrutdhara Housing Complex\r\nIndira Nagar, Nashik, Maharashtra', '1BHK', 3, 1, 1, 'Furnished', 'Yes', 'Available', 'Available', '24x7', 'Select Date', '2025-03-28', 'Less than 5 years', '16000', '20000', '400', 'Monthly'),
(5, 1, 'Devendra Deshmukh', '8976504321', 'devendra03@gmail.com', 'Pune', 'Swarget', 'Green park society, Ghorpade Peth, Swargate, Pune', '1BHK', 5, 5, 1, 'Semi-Furnished', 'Yes', 'Available', 'Available', '24x7', 'Immediate', NULL, '5 to 10 years', '20000', '20000', '500', 'Monthly'),
(6, 6, 'Avinash Dhawale', '8767301054', 'avinashdhawale17@gmail.com', 'Ahmednagar', 'Sangamner', 'Gajanan villa , Sangamner, Ahmednagar, Maharashtra', '2BHK', 2, 1, 1, 'Semi-Furnished', 'Yes', 'Available', 'Available', 'Limited', 'Immediate', NULL, '10 to 15 years', '18000', '15000', '400', 'Monthly'),
(7, 7, 'Sakshi Gaikwad', '9152299297', 'sakshi09@gmail.com', 'Nashik', 'Tarwala Nagar, Nashik', ' A102., Tarwala Nagar, Nashik, Maharashtra, Opposite Royal Fitness gym', '3BHK', 5, 2, 2, 'Furnished', 'Yes', 'Available', 'Available', '24x7', 'Immediate', NULL, 'New Construction', '35000', '50000', '1000', 'Monthly'),
(8, 8, 'Rahul Patil', '8669405476', 'rahulpatil12@gmail.com', 'Mumbai', 'Powai, Mumbai', 'Nahar Amrit Shakti, Chandivali, Powai, Mumbai', '1BHK', 11, 1, 1, 'Furnished', 'Yes', 'Available', 'Available', 'Limited', 'Select Date', '2025-06-20', 'Less than 5 years', '30000', '30000', '1000', 'Monthly'),
(9, 9, 'Nishant Malwade', '8767409081', 'nishant0705@gmail.com', 'Ahmednagar', 'Shirdi', 'Sai Township, in front of Shirdi international airport gate no 2, Shirdi, Ahmednagar', '1BHK', 3, 1, 1, 'Semi-Furnished', 'Yes', 'Not Available', 'Available', '24x7', 'Immediate', NULL, '5 to 10 years', '15000', '20000', '700', 'Monthly'),
(10, 10, 'Nikita Nawale', '8669615092', 'nikitanawale@gmail.com', 'Mumbai', 'Borivali East', 'AVA Maple by AVA Lifespaces, next to Raheja Cascade, off Western Express Highway, Kulupwadi, Borivali East, Borivali, Mumbai', '1RK', 0, 1, 0, 'Semi-Furnished', 'No', 'Not Available', 'Available', 'Limited', 'Select Date', '2025-04-05', '10 to 15 years', '20000', '20000', '1000', 'Monthly'),
(13, 1, 'Sanika Shetve', '9876543219', 'sanika20@gmail.com', 'Nashik', 'Nashik Road', 'navkar heights, Nashik', '1BHK', 3, 1, 1, 'Semi-Furnished', 'Yes', 'Available', 'Available', '24x7', 'Select Date', '2025-05-30', '10 to 15 years', '27000', '20000', '500', 'Monthly'),
(14, 11, 'Sushant Patil', '7350136260', 'sushantpatil15@gmail.com', 'Mumbai', 'Panvel, Navi Mumbai', 'Gut No. 99/2 &amp; 99/3 at Palaspe Phata (Giravale), Panvel, Navi Mumbai', '2BHK', 12, 1, 1, 'Furnished', 'Yes', 'Available', 'Available', 'Limited', 'Immediate', NULL, '10 to 15 years', '45000', '50000', '1500', 'Monthly');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `tenant_id` int(11) DEFAULT NULL,
  `property_id` int(11) DEFAULT NULL,
  `check_in` date DEFAULT NULL,
  `check_out` date DEFAULT NULL,
  `booking_date` date DEFAULT curdate(),
  `status` enum('Pending','Confirmed','Cancelled','Checked-in','Checked-out','Expired') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `tenant_id`, `property_id`, `check_in`, `check_out`, `booking_date`, `status`) VALUES
(15, 9, 4, '2025-04-15', '2025-07-15', '2025-03-22', 'Confirmed'),
(16, 4, 5, '2025-03-20', '2025-09-30', '2025-03-23', 'Confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `payment_date` date DEFAULT curdate(),
  `payment_method` enum('Credit Card','UPI','Net Banking','Cash') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `booking_id`, `tenant_id`, `amount`, `payment_date`, `payment_method`) VALUES
(14, 15, 9, 36000.00, '2025-03-22', 'Cash'),
(15, 16, 4, 40000.00, '2025-03-23', 'Credit Card');

-- --------------------------------------------------------

--
-- Table structure for table `property_owner`
--

CREATE TABLE `property_owner` (
  `owner_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(12) NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_owner`
--

INSERT INTO `property_owner` (`owner_id`, `full_name`, `email`, `password`, `mobile`) VALUES
(1, 'Sanika Shetve', 'sanika20@gmail.com', 'Sanu$2000', '9876548976'),
(2, 'Pankaj Kale', 'pankajkale25@gmail.com', 'Pankaj$25', '9576542310'),
(3, 'Krushna Pawar', 'krushna20@gmail.com', 'Krushna$20', '9768543654'),
(4, 'Varsha Shirsath', 'varsha18@gmail.com', 'Varsha$18', '9087654120'),
(5, 'Devendra Deshmukh', 'devendra03@gmail.com', 'Devendra$03', '8976504321'),
(6, 'Avinash Dhawale', 'avinashdhawale17@gmail.com', 'Avinash@1711', '8767301053'),
(7, 'Sakshi Gaikwad', 'sakshi09@gmail.com', 'Sakshi&09', '9152299297'),
(8, 'Rahul Patil', 'rahulpatil12@gmail.com', 'R@hul12', '8669405476'),
(9, 'Nishant Malwade', 'nishant0705@gmail.com', 'Nishant@07', '8767409081'),
(10, 'Nikita Nawale', 'nikitanawale@gmail.com', 'Nikita%90', '8669615092'),
(11, 'Sushant Patil', 'sushantpatil15@gmail.com', 'Patil$15', '7350136260');

-- --------------------------------------------------------

--
-- Table structure for table `property_photos`
--

CREATE TABLE `property_photos` (
  `id` int(11) NOT NULL,
  `property_id` int(11) NOT NULL,
  `photo_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_photos`
--

INSERT INTO `property_photos` (`id`, `property_id`, `photo_path`) VALUES
(1, 1, 'uploads/1741260461_1740820098_K2.jpg'),
(2, 1, 'uploads/1741260461_1740820098_K3.jpg'),
(3, 1, 'uploads/1741260461_1740820098_K4.jpg'),
(4, 1, 'uploads/1741260461_1740820098_K5.jpg'),
(5, 1, 'uploads/1741260461_1740820098_K6.png'),
(6, 2, 'uploads/1741415402_K8.jpg'),
(7, 2, 'uploads/1741415402_K11.jpg'),
(8, 2, 'uploads/1741415402_K12.jpg'),
(9, 2, 'uploads/1741415402_K15.jpg'),
(10, 2, 'uploads/1741415402_K17.jpg'),
(11, 3, 'uploads/1741427973_K22.jpg'),
(12, 3, 'uploads/1741427973_1740820098_K1.jpg'),
(13, 3, 'uploads/1741427973_K6.png'),
(14, 4, 'uploads/1741428446_K12.jpg'),
(15, 4, 'uploads/1741428446_K13.jpeg'),
(16, 4, 'uploads/1741428446_K15.jpg'),
(17, 4, 'uploads/1741428446_K20.jpg'),
(18, 5, 'uploads/1741428804_K14.jpg'),
(19, 5, 'uploads/1741428804_K19.png'),
(20, 5, 'uploads/1741428804_K3.jpg'),
(21, 5, 'uploads/1741428804_K10.jpg'),
(22, 6, 'uploads/1741429893_1741428446_K20.jpg'),
(23, 6, 'uploads/1741429893_K10.jpg'),
(24, 6, 'uploads/1741429893_K15.jpg'),
(25, 6, 'uploads/1741429894_K23.jpg'),
(26, 6, 'uploads/1741429894_K26.jpg'),
(27, 7, 'uploads/1742579477_Im1.jpeg'),
(28, 8, 'uploads/1742580336_Im2.jpeg'),
(29, 8, 'uploads/1742580336_Im3.jpg'),
(30, 8, 'uploads/1742580336_Im4.jpeg'),
(31, 8, 'uploads/1742580336_Im5.jpeg'),
(32, 9, 'uploads/1742639505_K10.jpg'),
(33, 9, 'uploads/1742639505_K15.jpg'),
(34, 9, 'uploads/1742639505_K19.png'),
(35, 9, 'uploads/1742639505_K22.jpg'),
(36, 9, 'uploads/1742639505_K26.jpg'),
(37, 10, 'uploads/1742640159_1740931481_1740912288_1740820098_K2.jpg'),
(38, 10, 'uploads/1742640159_1741428804_K14.jpg'),
(39, 10, 'uploads/1742640159_1742639505_K22.jpg'),
(45, 13, 'uploads/1742709795_1741415402_K12.jpg'),
(46, 13, 'uploads/1742709795_1741415402_K17.jpg'),
(47, 13, 'uploads/1742709795_1741427973_K6.png'),
(48, 13, 'uploads/1742709795_1741427973_K22.jpg'),
(49, 13, 'uploads/1742709795_1741428446_K13.jpeg'),
(50, 14, 'uploads/1742711634_K14.jpg'),
(51, 14, 'uploads/1742711634_K19.png'),
(52, 14, 'uploads/1742711634_K23.jpg'),
(53, 14, 'uploads/1742711634_M1.jpg'),
(54, 14, 'uploads/1742711634_M2.jpg'),
(55, 14, 'uploads/1742711634_M3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tenant`
--

CREATE TABLE `tenant` (
  `tenant_id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(12) NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tenant`
--

INSERT INTO `tenant` (`tenant_id`, `full_name`, `email`, `password`, `mobile`) VALUES
(1, 'Pratibha Dhawale', 'pratibhadhawale0707@gmail.com', 'Pratibha@07', '9322166627'),
(2, 'Anil Akolkar', 'anilakolkar45@gmail.com', 'Anil$450', '9270719400'),
(3, 'Artik Dhawale', 'artikdhawale30@gmail.com', 'ArtikD30$', '9834401602'),
(4, 'Suraj Mete', 'surajmete04@gmail.com', 'Suraj@04', '8308906830'),
(5, 'Leepakshi Patankar', 'leepakshi20@gmail.com', 'Leepakshi$20', '9049482507'),
(6, 'Jalindar Nimse', 'jalindarnimse31@gmail.com', 'Jalindar*31', '7876506760'),
(7, 'Vaishnavi Raykar', 'vaishnavi0602@gmail.com', 'Vaishu@0602', '9322050701'),
(8, 'Sunil Kumar', 'sunilkumar36@gmail.com', 'SunilK36$', '9737735737'),
(9, 'Suhas Shelke', 'suhas12@gmail.com', 'Suhas$12', '9075252083');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addproperty`
--
ALTER TABLE `addproperty`
  ADD PRIMARY KEY (`property_id`),
  ADD KEY `fk_owner` (`owner_id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `tenant_id` (`tenant_id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `tenant_id` (`tenant_id`);

--
-- Indexes for table `property_owner`
--
ALTER TABLE `property_owner`
  ADD PRIMARY KEY (`owner_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- Indexes for table `property_photos`
--
ALTER TABLE `property_photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `tenant`
--
ALTER TABLE `tenant`
  ADD PRIMARY KEY (`tenant_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `mobile` (`mobile`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addproperty`
--
ALTER TABLE `addproperty`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `property_owner`
--
ALTER TABLE `property_owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `property_photos`
--
ALTER TABLE `property_photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `tenant`
--
ALTER TABLE `tenant`
  MODIFY `tenant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addproperty`
--
ALTER TABLE `addproperty`
  ADD CONSTRAINT `fk_owner` FOREIGN KEY (`owner_id`) REFERENCES `property_owner` (`owner_id`) ON DELETE CASCADE;

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`tenant_id`) REFERENCES `tenant` (`tenant_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`property_id`) REFERENCES `addproperty` (`property_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`booking_id`) REFERENCES `bookings` (`booking_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`tenant_id`) REFERENCES `bookings` (`tenant_id`) ON DELETE CASCADE;

--
-- Constraints for table `property_photos`
--
ALTER TABLE `property_photos`
  ADD CONSTRAINT `property_photos_ibfk_1` FOREIGN KEY (`property_id`) REFERENCES `addproperty` (`property_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
