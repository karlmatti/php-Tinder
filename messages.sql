-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2018 at 09:36 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prax4`
--

-- --------------------------------------------------------

--
-- Table structure for table `kamatt_messages`
--

CREATE TABLE `kamatt_messages` (
  `user_id` int(11) NOT NULL,
  `other_id` int(11) NOT NULL,
  `message` varchar(255) COLLATE utf8_bin NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `messager` varchar(100) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kamatt_messages`
--

INSERT INTO `kamatt_messages` (`user_id`, `other_id`, `message`, `created_at`, `messager`) VALUES
(39, 37, '39 wrote something!', '2018-12-10 12:12:30', '39'),
(39, 37, '37 wrote something!', '2018-12-10 12:12:39', '37'),
(39, 37, 'aa', '2018-12-10 12:35:57', '0'),
(39, 37, 'bb', '2018-12-10 12:37:43', 'boy1'),
(39, 37, 'toimib', '2018-12-10 12:37:48', 'boy1'),
(40, 37, 'kirjutan', '2018-12-10 12:38:42', 'girl1'),
(41, 37, 'noni', '2018-12-10 12:39:27', 'girl1'),
(41, 37, 'noni', '2018-12-10 12:41:19', 'girl1'),
(41, 37, 'aaa', '2018-12-10 12:41:21', 'girl1'),
(40, 37, 'sonum1', '2018-12-10 12:41:27', 'girl1'),
(39, 37, 'sonum2', '2018-12-10 12:41:34', 'girl1'),
(39, 37, 'noni', '2018-12-10 12:50:57', 'girl1'),
(39, 37, 'oba', '2018-12-10 12:51:16', 'boy1'),
(44, 43, 'jou', '2018-12-10 12:53:05', 'poiss'),
(44, 43, '', '2018-12-10 12:53:17', 'tydruk'),
(44, 43, 'aa', '2018-12-10 12:53:20', 'tydruk'),
(44, 43, 'jou', '2018-12-10 12:53:23', 'tydruk'),
(44, 43, 'jou', '2018-12-10 12:53:36', 'poiss');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
