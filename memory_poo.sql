-- phpMyAdmin SQL Dump
-- version 6.0.0-dev+20250718.d42db65a1e
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 19, 2025 at 01:31 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.16
CREATE DATABASE IF NOT EXISTS memory_poo CHARACTER SET utf8 COLLATE utf8_general_ci;
USE memory_poo;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `memory_poo`
--

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `user_id` int NOT NULL,
  `pair_amount` int NOT NULL,
  `move_amount` int NOT NULL,
  `win_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`user_id`, `pair_amount`, `move_amount`, `win_date`) VALUES
(4, 3, 6, '2025-12-19');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3, 'Pierre', '$2y$10$c6b4TdDSW3j4UjBoeWvLUen.kfcrVl3PJq25kTcGbWRTM9NSvAIH6'),
(4, 'Gaïtan', '$2y$10$udcmYf3p9QTK9hcbV/jcYuv3nEyvuRQHouD4beKbbCja.b6AxvLPu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
