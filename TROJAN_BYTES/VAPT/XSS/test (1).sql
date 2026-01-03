-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2026 at 07:09 AM
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
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `emp`
--

CREATE TABLE `emp` (
  `uid` int(12) NOT NULL,
  `id` int(12) NOT NULL,
  `name` varchar(15) NOT NULL,
  `email` varchar(34) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `emp`
--

INSERT INTO `emp` (`uid`, `id`, `name`, `email`) VALUES
(1, 23, 'harshit_tcs', 'hrashit.t@tcx.com'),
(2, 32, 'santa', 'hrashit2.t@tcx.com');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `feedback`, `created_at`) VALUES
(1, 'hello', '2026-01-02 18:19:05'),
(2, 'kai haal hche', '2026-01-02 18:19:12'),
(5, 'adfsadf', '2026-01-02 18:20:30'),
(6, 'asfadsf', '2026-01-02 19:26:42');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_easy`
--

CREATE TABLE `feedback_easy` (
  `id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_easy`
--

INSERT INTO `feedback_easy` (`id`, `feedback`, `created_at`) VALUES
(1, 'hi', '2026-01-03 09:34:28');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_hard`
--

CREATE TABLE `feedback_hard` (
  `id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_hard`
--

INSERT INTO `feedback_hard` (`id`, `feedback`, `created_at`) VALUES
(1, 'hard level', '2026-01-03 09:33:12');

-- --------------------------------------------------------

--
-- Table structure for table `feedback_medium`
--

CREATE TABLE `feedback_medium` (
  `id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_medium`
--

INSERT INTO `feedback_medium` (`id`, `feedback`, `created_at`) VALUES
(1, 'this is meiudm', '2026-01-03 09:34:21');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `image_path`) VALUES
(1, 'Product 1', 'A sample product description.', 'images/monitor.png'),
(2, 'Product 2', 'Another description with potential XSS.', 'images/phone.jpg'),
(3, 'Product 3', 'Test product.', 'images/headphones.jpg'),
(4, 'hello', 'lsakdfsadf', 'images/mouse.jpg'),
(5, 'Laptop Pro', 'High-performance laptop for professionals.', 'images/mouse.jpg'),
(6, 'Smartphone X', 'Latest smartphone with advanced features.', 'images/phone.jpg'),
(7, 'Wireless Headphones', 'Noise-cancelling headphones.', 'images/headphones.jpg'),
(8, 'Gaming Mouse', 'Precision mouse for gamers.', 'images/mouse.jpg'),
(9, '4K Monitor', 'Ultra HD display for creators.', 'images/monitor.png');

-- --------------------------------------------------------

--
-- Table structure for table `rate_limits`
--

CREATE TABLE `rate_limits` (
  `user_agent` varchar(255) NOT NULL,
  `request_count` int(11) DEFAULT 0,
  `last_request` timestamp NOT NULL DEFAULT current_timestamp(),
  `blocked_until` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rate_limits`
--

INSERT INTO `rate_limits` (`user_agent`, `request_count`, `last_request`, `blocked_until`) VALUES
('Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 1, '2026-01-03 04:51:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`) VALUES
(0, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `emp`
--
ALTER TABLE `emp`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_easy`
--
ALTER TABLE `feedback_easy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_hard`
--
ALTER TABLE `feedback_hard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback_medium`
--
ALTER TABLE `feedback_medium`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rate_limits`
--
ALTER TABLE `rate_limits`
  ADD PRIMARY KEY (`user_agent`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `emp`
--
ALTER TABLE `emp`
  MODIFY `uid` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback_easy`
--
ALTER TABLE `feedback_easy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback_hard`
--
ALTER TABLE `feedback_hard`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback_medium`
--
ALTER TABLE `feedback_medium`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
