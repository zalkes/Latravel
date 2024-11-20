-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2024 at 01:35 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_latravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `subjudul` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinasi`
--

INSERT INTO `destinasi` (`id`, `judul`, `subjudul`, `deskripsi`, `foto`) VALUES
(3, 'Sungai Mahakam', 'Samarinda', 'Sungai Keren', '2024-11-12 17.26.03.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id` int(11) NOT NULL,
  `fk_id_destinasi` int(11) NOT NULL,
  `fk_username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `komen` varchar(255) NOT NULL,
  `fk_username` varchar(100) NOT NULL,
  `fk_id_destinasi` int(11) NOT NULL,
  `fk_id_rekomen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `panduan`
--

CREATE TABLE `panduan` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panduan`
--

INSERT INTO `panduan` (`id`, `judul`, `deskripsi`, `foto`) VALUES
(3, 'Panduan Menjelajah Asli', '1232131232313', '2024-11-12 17.23.13.png');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `pw` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`username`, `email`, `pw`, `bio`, `foto`) VALUES
('rizal', 'rizal@gmail.com', '$2y$10$350g4HI.fxMX97SVrXy4Tu7PdbC3Q/5OiiAvZaKNUvayAcGvpcOJy', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` varchar(100) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `stat` varchar(50) NOT NULL,
  `fk_username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suka`
--

CREATE TABLE `suka` (
  `id` int(11) NOT NULL,
  `fk_username` varchar(100) NOT NULL,
  `fk_id_destinasi` int(11) NOT NULL,
  `fk_id_rekomen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `destinasi`
--
ALTER TABLE `destinasi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorit`
--
ALTER TABLE `favorit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_fav` (`fk_username`),
  ADD KEY `FK_destinasi_fav` (`fk_id_destinasi`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_komen` (`fk_username`),
  ADD KEY `FK_destinasi_komen` (`fk_id_destinasi`),
  ADD KEY `FK_rekomen_komen` (`fk_id_rekomen`);

--
-- Indexes for table `panduan`
--
ALTER TABLE `panduan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_username` (`fk_username`);

--
-- Indexes for table `suka`
--
ALTER TABLE `suka`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_like` (`fk_username`),
  ADD KEY `FK_destinasi_like` (`fk_id_destinasi`),
  ADD KEY `FK_rekomen_like` (`fk_id_rekomen`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `destinasi`
--
ALTER TABLE `destinasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `panduan`
--
ALTER TABLE `panduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suka`
--
ALTER TABLE `suka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `favorit`
--
ALTER TABLE `favorit`
  ADD CONSTRAINT `FK_destinasi_fav` FOREIGN KEY (`fk_id_destinasi`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_fav` FOREIGN KEY (`fk_username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `FK_destinasi_komen` FOREIGN KEY (`fk_id_destinasi`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rekomen_komen` FOREIGN KEY (`fk_id_rekomen`) REFERENCES `rekomendasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_komen` FOREIGN KEY (`fk_username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  ADD CONSTRAINT `FK_username` FOREIGN KEY (`fk_username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `suka`
--
ALTER TABLE `suka`
  ADD CONSTRAINT `FK_destinasi_like` FOREIGN KEY (`fk_id_destinasi`) REFERENCES `destinasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_rekomen_like` FOREIGN KEY (`fk_id_rekomen`) REFERENCES `rekomendasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_user_like` FOREIGN KEY (`fk_username`) REFERENCES `pengguna` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
