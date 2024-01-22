-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 22, 2022 at 01:26 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eindopdracht`
--

-- --------------------------------------------------------

--
-- Table structure for table `skyscrapers`
--

CREATE TABLE `skyscrapers` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `architect_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `built_year` varchar(4) NOT NULL,
  `floors` int(3) NOT NULL,
  `image` varchar(150) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `skyscraper_usage`
--

CREATE TABLE `skyscraper_usage` (
  `usage_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `skyscraper_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `architect`
--

CREATE TABLE `architects` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `architect`
--

INSERT INTO `architects` (`id`, `user_id`, `name`) VALUES
(1, 1, 'Skidmore'),
(2, 1, 'Adrian Smith'),
(3, 1, 'SHoP Architects'),
(4, 1, 'Kohn Pedersen Fox Associates'),
(6, 3, 'Rafael Viñoly Architects');

-- --------------------------------------------------------

--
-- Table structure for table `usages`
--

CREATE TABLE `usages` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usages`
--

INSERT INTO `usages` (`id`, `name`) VALUES
(1, 'Residential'),
(2, 'Retail'),
(3, 'Office'),
(4, 'Hotel'),
(5, 'Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(150) NOT NULL DEFAULT '',
  `name` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`) VALUES
(1, 'bla@hr.nl', '$argon2i$v=19$m=1024,t=2,p=2$S1ZsYkdVLjc0VnpZQWNRUA$gmEb3/qvt/6YMF14uLXG2Wtz8XuB+LrAwAEf+olIyw8', 'Bla'),
(3, 'moora@hr.nl', '$2y$10$JLLNSkMOzL82lcUDTv2PEOG0bilOLk58QanZraQIBIKZWJxECOJzW', 'Antwan');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `skyscrapers`
--
ALTER TABLE `skyscrapers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `architect_id` (`architect_id`);

--
-- Indexes for table `skyscraper_usage`
--
ALTER TABLE `skyscraper_usage`
  ADD PRIMARY KEY (`usage_id`,`skyscraper_id`),
  ADD KEY `usage_id` (`usage_id`),
  ADD KEY `skyscraper_id` (`skyscraper_id`);

--
-- Indexes for table `architect`
--
ALTER TABLE `architects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `usages`
--
ALTER TABLE `usages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `skyscraper`
--
ALTER TABLE `skyscrapers`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `architect`
--
ALTER TABLE `architects`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `usages`
--
ALTER TABLE `usages`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `skyscrapers`
--
ALTER TABLE `skyscrapers`
  ADD CONSTRAINT `skyscrapers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skyscrapers_ibfk_2` FOREIGN KEY (`architect_id`) REFERENCES `architects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `skyscraper_usage`
--
ALTER TABLE `skyscraper_usage`
  ADD CONSTRAINT `skyscraper_usage_ibfk_1` FOREIGN KEY (`usage_id`) REFERENCES `usages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `skyscraper_usage_ibfk_2` FOREIGN KEY (`skyscraper_id`) REFERENCES `skyscrapers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `Buildingss`
--
ALTER TABLE `architects`
  ADD CONSTRAINT `architects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
