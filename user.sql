-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Apr 25, 2025 at 04:01 PM
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
-- Database: `dadproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `nama_depan` varchar(50) DEFAULT NULL,
  `nama_belakang` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `role` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `nama_depan`, `nama_belakang`, `nama_lengkap`, `username`, `email`, `password`, `role`) VALUES
(1, 'Aditya', 'Wijayanto', 'Aditya Wijayanto', 'admin1', 'aditya@gmail.com', '$2y$10$GEv0Umi9HzSw/8D03XlJIu1l0uxO26sbQFvRiPWL0pItq4XBZHgXy', 'admin'),
(2, 'Daniel', 'Jefry', 'Daniel Jefry', 'admin2', 'daniel@gmail.com', '$2y$10$nYZmLrocMyaS48nK.tFeeOkWoCr2R1OvtFdXwtloKq.Vrtgxig.c2', 'admin'),
(3, 'Mohammad', 'David', 'Mohammad David', 'admin3', 'david@gmail.com', '$2y$10$hx8wSbvxIHgVUXRavUuwIe/7171xo36sGvTop3oaf7.KZMAzdUmm6', 'admin'),
(4, 'Rani', 'Wijaya', 'Rani Wijaya', 'mentor123', 'rani@gmail.com', '$2y$10$1o6fRg3DYV5O8LxJ3Fv4tuF99gayg1.LYou/i0XKod7mmVrbSYZ7q', 'mentor'),
(5, 'Daniel', 'Alfero', 'Daniel Alfero', 'alfero123', 'dandan@gmail.com', '$2y$10$zBOmUeUjbShyOloua9ZtoOJDAaCLHp2Htavo6Ag0IEP0n.xp9OLgy', 'student'),
(6, 'Daffa', 'Ahmad', 'Damad', 'damdam', 'damad@gmail.com', '$2y$10$3KhsLR7ibCy/rJ2IDFJTsuJ9fIj/MVv.rf2tMzldXaWFg8YFt/A2C', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
