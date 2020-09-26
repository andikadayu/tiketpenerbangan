-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2020 at 08:24 AM
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

--
-- Dumping data for table `bandara`
--

INSERT INTO `bandara` (`id_bandara`, `nama_bandara`, `lokasi_bandara`) VALUES
('BTJ', 'Sultan Iskandar Muda', 'Aceh'),
('JOG', 'Adisutjipto', 'Yogyakarta'),
('MLG', 'Abdurrahman Saleh', 'Malang'),
('SUB', 'Juanda', 'Surabaya'),
('TRK', 'Juwata', 'Tarakan'),
('TTE', 'Sultan Babullah', 'Ternate');

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

--
-- Dumping data for table `jadwal_penerbangan`
--

INSERT INTO `jadwal_penerbangan` (`id_jadwal`, `id_pesawat`, `id_bandara_asal`, `id_bandara_tujuan`, `tgl_jadwal`) VALUES
(1, 'A9323', 'JOG', 'MLG', '2020-09-08'),
(2, 'L1233', 'MLG', 'TRK', '2020-09-02'),
(3, 'S1343', 'BTJ', 'TTE', '2020-09-12'),
(4, 'R1355', 'MLG', 'TTE', '2020-09-30'),
(5, 'G3123', 'SUB', 'TTE', '2020-09-28'),
(6, 'R1355', 'TTE', 'TRK', '2020-09-16');

-- --------------------------------------------------------

--
-- Table structure for table `pesawat`
--

CREATE TABLE `pesawat` (
  `id_pesawat` varchar(5) NOT NULL,
  `nama_pesawat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesawat`
--

INSERT INTO `pesawat` (`id_pesawat`, `nama_pesawat`) VALUES
('A9323', 'Alucard'),
('G3123', 'Garuda'),
('L1233', 'Laksamana'),
('R1355', 'Royal'),
('S1343', 'Senior');

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
  MODIFY `id_jadwal` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
