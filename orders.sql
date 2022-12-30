-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2022 at 12:49 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `orders`
--

-- --------------------------------------------------------

--
-- Table structure for table `operator`
--

CREATE TABLE `operator` (
  `operator_id` int(11) NOT NULL,
  `operator_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `operator`
--

INSERT INTO `operator` (`operator_id`, `operator_name`) VALUES
(1, 'Oliver Trag'),
(2, 'Jacob Miller'),
(3, 'George Wilson'),
(4, 'William Aung'),
(5, 'Harry Ryan'),
(6, 'Michael Jones'),
(7, 'Timmy Davis'),
(8, 'Oscar Phyo'),
(9, 'Charlie Brown');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `order_number` varchar(45) NOT NULL,
  `order_date` datetime NOT NULL,
  `est_delivery` datetime NOT NULL,
  `status_id` int(11) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `order_number`, `order_date`, `est_delivery`, `status_id`, `operator_id`, `location_id`) VALUES
(1, '#1', '2022-07-14 13:15:24', '2022-07-24 08:45:00', 1, 2, 1),
(4, 'asd', '2022-12-29 16:00:00', '2022-12-31 08:00:00', 2, 7, 5),
(5, 'BBBBBB', '2022-12-29 16:00:00', '2022-12-31 08:00:00', 2, 7, 4),
(10, '111111', '2022-12-29 16:00:00', '2022-12-31 08:00:00', 3, 1, 1),
(11, '22222', '2022-12-29 16:00:00', '2022-12-31 08:00:00', 1, 2, 2),
(12, 'AAAAAA', '2022-12-29 16:00:00', '2022-12-31 08:00:00', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_location`
--

CREATE TABLE `order_location` (
  `order_location_id` int(11) NOT NULL,
  `city` varchar(45) NOT NULL,
  `distance` int(11) NOT NULL,
  `country` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_location`
--

INSERT INTO `order_location` (`order_location_id`, `city`, `distance`, `country`) VALUES
(1, 'London', 218, 'UK'),
(2, 'Oxford', 430, 'UK'),
(3, 'Watford', 280, 'UK'),
(4, 'Dover', 530, 'UK'),
(5, 'Windsor', 475, 'UK');

-- --------------------------------------------------------

--
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL,
  `status_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`order_status_id`, `status_name`) VALUES
(1, 'Moving'),
(2, 'Pending'),
(3, 'Cancelled');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `operator`
--
ALTER TABLE `operator`
  ADD PRIMARY KEY (`operator_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_status_idx` (`status_id`),
  ADD KEY `fk_order_operator1_idx` (`operator_id`),
  ADD KEY `fk_order_location1_idx` (`location_id`);

--
-- Indexes for table `order_location`
--
ALTER TABLE `order_location`
  ADD PRIMARY KEY (`order_location_id`);

--
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`order_status_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `operator`
--
ALTER TABLE `operator`
  MODIFY `operator_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `order_location`
--
ALTER TABLE `order_location`
  MODIFY `order_location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `order_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_location1` FOREIGN KEY (`location_id`) REFERENCES `order_location` (`order_location_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_operator1` FOREIGN KEY (`operator_id`) REFERENCES `operator` (`operator_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_order_status` FOREIGN KEY (`status_id`) REFERENCES `order_status` (`order_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
