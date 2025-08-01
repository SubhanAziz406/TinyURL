-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2024 at 09:22 PM
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
-- Database: `thetinyurls`
--

-- --------------------------------------------------------

--
-- Table structure for table `urls`
--

CREATE TABLE `urls` (
  `url_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `original_url` text NOT NULL,
  `short_url` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `urls`
--

INSERT INTO `urls` (`url_id`, `user_id`, `original_url`, `short_url`, `created_at`) VALUES
(1, 7, 'https://www.youtube.com/watch?v=B7TPfEIhSDY&list=RDa5aOM1EpJmE&index=19', '102f87', '2024-09-25 18:14:08'),
(2, 7, 'https://www.youtube.com/watch?v=B7TPfEIhSDY&list=RDa5aOM1EpJmE&index=19', 'nMVhd6', '2024-09-25 18:19:23'),
(3, 7, 'https://www.youtube.com/watch?v=B7TPfEIhSDY&list=RDa5aOM1EpJmE&index=19', 'JVtEu5', '2024-09-25 18:23:20'),
(4, 7, 'https://www.youtube.com/watch?v=B7TPfEIhSDY&list=RDa5aOM1EpJmE&index=19', 'Wi0lfQ', '2024-09-25 18:49:48'),
(5, 7, 'https://www.youtube.com/watch?v=B7TPfEIhSDY&list=RDa5aOM1EpJmE&index=19', 'ZP4Oa7', '2024-09-25 18:52:23'),
(6, 7, 'https://www.youtube.com/watch?v=B7TPfEIhSDY&list=RDa5aOM1EpJmE&index=19', 'y3V9iK', '2024-09-25 18:54:18'),
(7, 7, 'https://www.youtube.com/watch?v=B7TPfEIhSDY&list=RDa5aOM1EpJmE&index=19', 'W8viJy', '2024-09-25 18:54:34'),
(8, 7, 'https://www.youtube.com/watch?v=B7TPfEIhSDY&list=RDa5aOM1EpJmE&index=19', 'BIp0Xg', '2024-09-25 18:55:59');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(225) NOT NULL,
  `url_count` int(11) DEFAULT NULL,
  `max_urls` int(10) NOT NULL,
  `reset_token` varchar(64) NOT NULL,
  `token_expiration` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `url_count`, `max_urls`, `reset_token`, `token_expiration`) VALUES
(1, 'test02', 'test02@gmail.com', '$2y$10$xAovuck2aBRpc02YzT6ZE.p.DzzU2SJLAvhGn2IPU2ZD9IdmEY31y', NULL, 0, '', '2024-09-25 22:04:19'),
(2, 'test01', 'test@gmail.com', 'Cheeda@1234', NULL, 0, '', '2024-09-25 22:04:19'),
(7, 'mrsubhan', 'subhanaziz406@gmail.com', '$2y$10$1QjGN/xLijE1tMJbGFhpk.wr3bLXdpVS0WLWrTJZ.nRnWtn9FVgJ6', NULL, 0, '', '2024-09-25 22:04:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`url_id`),
  ADD UNIQUE KEY `short_url` (`short_url`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `urls`
--
ALTER TABLE `urls`
  MODIFY `url_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `urls`
--
ALTER TABLE `urls`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
