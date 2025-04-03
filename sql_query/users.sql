-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 03, 2025 at 07:41 AM
-- Server version: 9.1.0
-- PHP Version: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_management_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(3, 'sss', 'sasasa@gmail.com', '$2y$10$66Uo5XfkySc3RppzN9OpCeIqYHioWWqCAzcMW8.v4K.kmAByNCfxO', 'user'),
(4, 'sasasasasa', 'yetiwef548@chansd.com', '$2y$10$QKuWmCGsorANlt12LZuNNuu1e5o.jD75S0D554XJodDtJ7G3qBaTG', 'user'),
(5, 'ssssssssssssssssssssss', 'gagagaga@gmail.com', '$2y$10$1PvjpQYci1tWony0aLhRkOemhqpz7irdy7bD3tUm71haxs9NOj/d.', 'user'),
(7, 'ssssasasasa', 'sasasasasa@gmail.com', '$2y$10$Bqxww6uBh6AqX.nXqqw9gOpKyQzn6mM1r2Sl8pEmamCT6ekmNonU6', 'user'),
(8, 'b', 'simon.KKK@gmail.com', '$2y$10$7fuv7EnlKhiEqY9DuAbGSOPngximLX3OFxQ9v4c0mkkV/klXrj4lK', 'user'),
(9, 'c', 'simon.KKKK@gmail.com', '$2y$10$tHmZyiPHWMGkggp/vT23kObJHQockRvyfJWlwvAXPNgVfS7Lv.qRK', 'user'),
(10, 'd', 'simon.KKKKK@gmail.com', '$2y$10$jG5O/2VVrriWwEaLviod.Oaf63wJb9Z3Neq/.WUVijSX5njap68/G', 'user'),
(11, 'f', 'simon.KKKKKK@gmail.com', '$2y$10$A418M5zpvlTEvB4o6cmiCOs2VHNi8u.esPtxkTVndFDzIzvlr8OC2', 'user');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
