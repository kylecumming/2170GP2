-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: db.cs.dal.ca
-- Generation Time: Apr 08, 2021 at 05:48 PM
-- Server version: 10.3.21-MariaDB
-- PHP Version: 7.3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cumming`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `first_name`, `last_name`, `email`, `password`, `admin`) VALUES
(1, 'Scott_Myrden', 'Scott', 'Myrden', 'Scott_Myrden@dal.ca', 'Scott_password', 1),
(2, 'Eric_Dowell', 'Eric', 'Dowell', 'Eric_Dowell@dal.ca', 'Eric_password', 1),
(3, 'Keaton_Gibb', 'Keaton', 'Gibb', 'Keaton_Gibb@dal.ca', 'Keaton_password', 1),
(4, 'Sahil_Sorathiya', 'Sahil', 'Sorathiya', 'Sahil_Sorathiya@dal.ca', 'Sahil_password', 1),
(5, 'Kyle_Cumming', 'Kyle', 'Cumming', 'Kyle_Cumming@dal.ca', 'Kyle_password', 0),
(6, 'Jake_Coyne', 'Jake', 'Coyne', 'Jake_Coyne@dal.ca', 'Jake_password', 0),
(7, 'Ben_Lee', 'Ben', 'Lee', 'Ben_Lee@dal.ca', 'Ben_password', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
