-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 23, 2019 at 02:07 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db5b24`
--

-- --------------------------------------------------------

--
-- Table structure for table `arubaito`
--

CREATE TABLE `arubaito` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET cp932 NOT NULL,
  `datatype` varchar(30) NOT NULL,
  `time_start` datetime(6) NOT NULL,
  `date` date NOT NULL,
  `time_stop` datetime(6) NOT NULL,
  `workhour` time(6) NOT NULL,
  `overtime` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `overtimepayment` int(11) NOT NULL,
  `resultpayment` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `arubaito`
--

INSERT INTO `arubaito` (`id`, `username`, `datatype`, `time_start`, `date`, `time_stop`, `workhour`, `overtime`, `payment`, `overtimepayment`, `resultpayment`, `status`) VALUES
(72, 'tama', 'OUT', '2019-01-23 20:14:25.000000', '2019-01-23', '2019-01-23 21:17:34.000000', '01:03:09.000000', 0, 1050, 142, 1192, 2),
(73, 'kato', 'OUT', '2019-01-23 21:24:24.000000', '2019-01-23', '2019-01-23 21:24:34.000000', '00:00:10.000000', 0, 0, 200, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET cp932 NOT NULL,
  `password` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`) VALUES
(2, 'kato', 0x243279243130246666535367583355794169357269722f635866706e752f42375152796e44396c32316c4f6b4166496c576d4f376a69346853374336),
(4, 'tama', 0x2432792431302456343233325741473457737465374a6961446d67554f597755396e774258734c71684f47434a2f77552e7632574a4e46763643644f);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `arubaito`
--
ALTER TABLE `arubaito`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `arubaito`
--
ALTER TABLE `arubaito`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
