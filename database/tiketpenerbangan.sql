-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2020 at 07:40 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tiketpenerbangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `bandara`
--

CREATE TABLE `bandara` (
  `id_bandara` varchar(5) NOT NULL,
  `nama_bandara` varchar(50) NOT NULL,
  `lokasi_bandara` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_penerbangan`
--

CREATE TABLE `jadwal_penerbangan` (
  `id_jadwal` int(5) NOT NULL,
  `id_pesawat` varchar(5) NOT NULL,
  `id_bandara_asal` varchar(5) NOT NULL,
  `id_bandara_tujuan` varchar(5) NOT NULL,
  `tgl_jadwal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pesawat`
--

CREATE TABLE `pesawat` (
  `id_pesawat` varchar(5) NOT NULL,
  `nama_pesawat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bandara`
--
ALTER TABLE `bandara`
  ADD PRIMARY KEY (`id_bandara`);

--
-- Indexes for table `jadwal_penerbangan`
--
ALTER TABLE `jadwal_penerbangan`
  ADD PRIMARY KEY (`id_jadwal`);

--
-- Indexes for table `pesawat`
--
ALTER TABLE `pesawat`
  ADD PRIMARY KEY (`id_pesawat`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jadwal_penerbangan`
--
ALTER TABLE `jadwal_penerbangan`
  MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
