-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 29, 2023 at 04:55 AM
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
-- Database: `pawheaven`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `appointment_service` varchar(255) DEFAULT NULL,
  `appointment_status` varchar(255) DEFAULT NULL,
  `start_event_date` datetime DEFAULT NULL,
  `end_event_date` datetime DEFAULT NULL,
  `animals_id` int(11) DEFAULT NULL,
  `staff_id` int(11) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `appoint_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `appointment_service`, `appointment_status`, `start_event_date`, `end_event_date`, `animals_id`, `staff_id`, `customer_id`, `appoint_status`) VALUES
(1, 'Groom', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 1, 2001401, 'BAGJA', 1),
(2, 'Surgery', 'Ongoing', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 2, 2001402, 'BAGJA', 1),
(3, 'Deworming', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 3, 2001403, 'LADAL', 1),
(4, 'Checkup', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 4, 2001404, 'LADAL', 1),
(5, 'Vaccine', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 5, 2001401, 'LAOCH', 1),
(6, 'Groom', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 6, 2001401, 'LAOCH', 1),
(7, 'Surgery', 'Ongoing', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 7, 2001402, 'TAQNA', 1),
(8, 'Deworming', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 8, 2001403, 'TAQNA', 1),
(9, 'Checkup', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 9, 2001404, 'SUCLE', 1),
(10, 'Vaccine', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 10, 2001401, 'SUCLE', 1),
(11, 'Groom', 'Done', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 1, 2001401, 'BAGJA', 1),
(12, 'Surgery', 'Ongoing', '2001-10-04 00:00:00', '2001-10-04 00:00:00', 2, 2001402, 'BAGJA', 1),
(50, 'consultation', 'Reserve', '2023-10-30 00:00:00', '2023-10-30 00:00:00', 94, 2001402, 'KANGDO', 1),
(51, 'consultation', 'Reserve', '2023-10-30 00:00:00', '2023-10-30 00:00:00', 94, 2001402, 'KANGDO', 1),
(52, 'consultation', 'Reserve', '2023-10-31 00:00:00', '2023-10-31 00:00:00', 96, 2001402, 'JANREIMARJA', 1),
(53, 'treatment', 'Reserve', '2023-10-30 00:00:00', '2023-10-30 00:00:00', 97, 2001401, 'JANREIMARJA', 1),
(54, 'treatment', 'Reserve', '2023-10-30 00:00:00', '2023-10-30 00:00:00', 97, 2001401, 'JANREIMARJA', 1),
(57, 'grooming', 'Reserve', '2023-10-30 00:00:00', '2023-10-30 00:00:00', 98, 2001402, 'JANREIMARJA', 1),
(58, 'grooming', 'Reserve', '2023-10-30 00:00:00', '2023-10-30 00:00:00', 98, 2001402, 'JANREIMARJA', 1),
(72, 'treatment', 'Reserve', '2023-10-31 00:00:00', '2023-10-31 00:00:00', 100, 2001402, 'JANREIMARJA', 1),
(78, 'surgery', 'Reserve', '2023-10-31 00:00:00', '2023-10-31 00:00:00', 105, 2001402, 'JANREIMARJA', 1),
(79, 'consultation', 'Reserve', '2023-10-31 00:00:00', '2023-10-31 00:00:00', 95, 2001401, 'JANREIMARJA', 1),
(80, 'surgery', 'Reserve', '2023-10-30 00:00:00', '2023-10-30 00:00:00', 106, 2001401, 'JANREIMARJA', 1),
(99, 'TRIAL', NULL, '2023-10-11 04:00:00', '2023-10-14 05:00:00', NULL, NULL, NULL, 1),
(101, 'TRIAL3', NULL, '2023-10-02 00:00:00', '2023-10-04 00:00:00', NULL, NULL, NULL, 1),
(102, 'TRIAL2', NULL, '2023-10-29 00:00:00', '2023-10-29 00:00:00', NULL, NULL, NULL, 0),
(103, 'TRIAL4', NULL, '2023-10-05 11:33:00', '2023-10-05 11:33:00', NULL, NULL, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `animals_id` (`animals_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`animals_id`) REFERENCES `animals` (`animals_id`),
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`staff_id`),
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
