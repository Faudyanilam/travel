-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 17, 2024 at 06:50 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wisata`
--

-- --------------------------------------------------------

--
-- Table structure for table `mandiri`
--

CREATE TABLE `mandiri` (
  `id_mandiri` int(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `resort` varchar(100) NOT NULL,
  `durasi` int(50) NOT NULL,
  `tambahan` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mandiri`
--

INSERT INTO `mandiri` (`id_mandiri`, `nama`, `nomor_telp`, `email`, `alamat`, `jumlah`, `tanggal_pemesanan`, `resort`, `durasi`, `tambahan`, `harga`) VALUES
(1, 'nisa', '44444444', 'nisa@gmail.com', 'riau', 4, '2024-08-21', 'Panbil Nature Reserve', 5, 'Penginapan', '11000000'),
(2, 'ilham', '5555555', 'ilham@gmail.com', 'kalimantan', 2, '2024-08-13', 'Nongsa Point Marina', 3, 'Penginapan, Transportasi, Makanan', '5700000'),
(3, 'steven', '6666666', 'steven@gmail.com', 'maluku', 5, '2024-08-28', 'Nuvasa', 3, 'Transportasi', '8700000'),
(4, 'gina', '080000000', 'gina@gmail.com', 'batam', 2, '2024-08-16', 'Panbil Nature Reserve', 1, 'Penginapan', '2000000');

-- --------------------------------------------------------

--
-- Table structure for table `paket_liburan`
--

CREATE TABLE `paket_liburan` (
  `id_paket` int(50) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `nomor_telp` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `jumlah` varchar(100) NOT NULL,
  `tanggal_pemesanan` date NOT NULL,
  `paket` varchar(100) NOT NULL,
  `harga` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `paket_liburan`
--

INSERT INTO `paket_liburan` (`id_paket`, `nama`, `nomor_telp`, `email`, `alamat`, `jumlah`, `tanggal_pemesanan`, `paket`, `harga`) VALUES
(1, 'ayu', '00000000', 'ayu@gmail.com', 'jawa timur', '2', '2024-08-19', 'Jelajah Santai', '6000000'),
(2, 'bayu', '11111111', 'bayu@gmail.com', 'jakarta', '3', '2024-08-16', 'Jelajah Eksplorasi', '12000000'),
(3, 'indah', '22222222', 'indah@gmail.com', 'yogyakarta', '3', '2024-08-20', 'Jelajah Santai', '9000000'),
(5, 'yandra', '08128839', 'yandra@gmail.com', 'jawa', '1', '2024-08-16', 'Jelajah Santai', '3000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mandiri`
--
ALTER TABLE `mandiri`
  ADD PRIMARY KEY (`id_mandiri`);

--
-- Indexes for table `paket_liburan`
--
ALTER TABLE `paket_liburan`
  ADD PRIMARY KEY (`id_paket`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mandiri`
--
ALTER TABLE `mandiri`
  MODIFY `id_mandiri` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `paket_liburan`
--
ALTER TABLE `paket_liburan`
  MODIFY `id_paket` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
