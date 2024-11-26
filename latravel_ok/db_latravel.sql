-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2024 at 06:05 AM
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
CREATE DATABASE IF NOT EXISTS `db_latravel` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_latravel`;

-- --------------------------------------------------------

--
-- Table structure for table `destinasi`
--

CREATE TABLE `destinasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `subjudul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinasi`
--

INSERT INTO `destinasi` (`id`, `judul`, `subjudul`, `deskripsi`, `foto`) VALUES
(0, 'adad', 'adad', 'adad', 'adaad'),
(10, 'Islamic Center', 'Samarinda', 'Islamic Center Samarinda adalah salah satu masjid terbesar dan termegah di Indonesia, yang terletak di tepi Sungai Mahakam, Samarinda, Kalimantan Timur. Masjid ini menjadi ikon religi sekaligus destinasi wisata yang menarik perhatian banyak pengunjung lokal maupun mancanegara.', '2024-11-25 23.22.02.jpg'),
(11, 'Pantai Manggar', 'Balikpapan', 'Pantai Manggar adalah destinasi wisata pantai yang terkenal di Balikpapan, Kalimantan Timur. Terletak sekitar 9 km dari pusat kota Balikpapan, pantai ini menawarkan suasana santai yang sempurna untuk rekreasi bersama keluarga atau teman. Dengan suasana yang asri dan fasilitas lengkap, Pantai Manggar menjadi salah satu destinasi wisata wajib saat berkunjung ke Balikpapan.', '2024-11-25 23.25.07.jpg'),
(12, 'Pulau Derawan', 'Berau', 'Pulau Derawan, yang terletak di Kabupaten Berau, Kalimantan Timur, adalah salah satu destinasi wisata bahari terbaik di Indonesia. Pulau ini terkenal dengan keindahan alam bawah lautnya yang luar biasa, menjadikannya surga bagi para penyelam dan pecinta snorkeling dari seluruh dunia.', '2024-11-25 23.26.54.jpg'),
(13, 'Pulau Kakaban', 'Berau', 'Pulau Kakaban, yang terletak di Kepulauan Derawan, Kabupaten Berau, Kalimantan Timur, adalah destinasi wisata unik yang dikenal karena Danau Kakaban, sebuah danau purba yang menjadi rumah bagi ubur-ubur tanpa sengat. Pulau ini adalah salah satu dari sedikit tempat di dunia di mana fenomena alam langka ini dapat ditemukan, menjadikannya surga bagi pecinta alam dan wisatawan yang mencari pengalaman berbeda.', '2024-11-25 23.30.23.jpeg'),
(14, 'Kampung Kutai', 'Kutai Kartanegara', 'Abrasi Kampung Kutai, yang terletak di Kabupaten Kutai Kartanegara, Kalimantan Timur, adalah destinasi unik yang menawarkan kombinasi keindahan alam, nilai sejarah, dan edukasi lingkungan. Tempat ini dinamakan demikian karena fenomena abrasi yang secara alami membentuk garis pantai di sekitar wilayah tersebut, menciptakan pemandangan yang unik dan memukau.', '2024-11-25 23.34.45.jpeg'),
(15, 'Loksado', 'Hulu Sungai Selatan', 'Loksado, yang terletak di Kabupaten Hulu Sungai Selatan, Kalimantan Selatan, adalah destinasi wisata alam yang menawarkan pesona keindahan pegunungan, sungai jernih, dan budaya Dayak Meratus yang kaya. Daya tarik utama Loksado adalah arung jeram tradisional menggunakan rakit bambu.', '2024-11-25 23.38.55.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `favorit`
--

CREATE TABLE `favorit` (
  `id` int(11) NOT NULL,
  `fk_id_destinasi` int(11) NOT NULL,
  `fk_username` varchar(100) NOT NULL,
  `favoritkan` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id` int(11) NOT NULL,
  `komen` varchar(255) NOT NULL,
  `fk_username` varchar(100) NOT NULL,
  `fk_id_rekomen` int(11) NOT NULL DEFAULT 0,
  `fk_id_destinasi` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id`, `komen`, `fk_username`, `fk_id_rekomen`, `fk_id_destinasi`) VALUES
(4, 'kerennnn', 'arya', 5, 0),
(5, 'aku mau ini', 'arya', 5, 0),
(6, 'hello world', 'arya', 5, 0),
(7, 'aaaaa', 'arya', 5, 0),
(9, 'haloooo', 'arya', 5, 0);

-- --------------------------------------------------------

--
-- Table structure for table `panduan`
--

CREATE TABLE `panduan` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `panduan`
--

INSERT INTO `panduan` (`id`, `judul`, `deskripsi`, `foto`) VALUES
(4, 'Jelajahi Pulau Kakaban yang Menakjubkan', 'Pulau Kakaban, terletak di Kepulauan Derawan, Kalimantan Timur, adalah salah satu destinasi wisata unik di Indonesia yang menawarkan keindahan alam bawah laut dan pengalaman yang tak terlupakan. Waktu terbaik untuk mengunjungi Kakaban adalah antara April hingga Oktober saat cuaca cenderung cerah dan ombak lebih tenang. Anda bisa snorkeling atau menyelam di perairan sekitar Kakaban untuk melihat terumbu karang dan ikan tropis yang beraneka ragam.', '2024-11-25 23.10.12.jpeg'),
(5, 'Santai dan Nikmati Keindahan Alami Kampung Kutai', 'Kampung Kutai adalah salah satu kawasan di Kalimantan Timur yang terkena dampak abrasi laut. Meskipun tantangan abrasi menjadi masalah lingkungan yang serius, kawasan ini tetap menarik untuk dikunjungi karena kearifan lokal masyarakat, sejarahnya, dan keindahan pesisirnya. Waktu terbaik untuk berkunjung adalah pada musim kemarau agar kondisi cuaca lebih bersahabat. Pastikan anda memakai pakaian outdoor, menggunakan sunblock dan alas kaki yang tahan air.', '2024-11-25 23.15.42.jpeg'),
(6, 'Kunjungi Wisata Arung Jeram Loksado yang Menarik', 'Arung Jeram Laksadao, yang terletak di Kalimantan Selatan, menawarkan pengalaman arung jeram mendebarkan di aliran Sungai Amandit. Waktu terbaik untuk berkunjung adalah antara April hingga Oktober saat kondisi sungai optimal untuk petualangan ini. Cocok bagi pemula hingga ahli, Laksadao menyuguhkan jeram-jeram yang beragam, lengkap dengan pemandangan hutan tropis yang lebat. Dilengkapi peralatan keselamatan dan dipandu oleh instruktur berpengalaman.', '2024-11-25 23.17.06.jpeg');

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
('arya', 'arya@gmail.com', '$2y$10$3Y68/Obpoucerb7SBmEKhOi5XzCUgcIAcMJHKwyO0y.eZtP2XZdGW', 'Saya adalah mahasiswa informatika angkatan 2023', '2024-11-21 11.14.34.png'),
('coba', 'coba@gmail.com', '$2y$10$rCM9.g6UyhQ16Kn3zSh2oOtrCBl1Ko2UaogPmHcCkhQKdxWhBCosW', '', ''),
('davina', 'davina@gmail.com', '$2y$10$B4zhprHBxCg39Vct1v8N4OQlhfPdm5A.tRUc1nwkQ65Jx7fyMMezq', 'saya dapin', '2024-11-21 11.16.36.png'),
('rava', 'rava@gmail.com', '$2y$10$zgw/tXXQgjGy7/OptUfYze6HYlYLpkNE1LtrQZpG1e/hTFJ4XdAIi', '', ''),
('rizal', 'rizal@gmail.com', '$2y$10$teM.tOYGIyvFTl28ilnuiOsPG/NbIeeb3yVJzAM3y7g6Pxc6Zlzhq', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi`
--

CREATE TABLE `rekomendasi` (
  `id` int(11) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) NOT NULL,
  `stat` varchar(50) NOT NULL,
  `fk_username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rekomendasi`
--

INSERT INTO `rekomendasi` (`id`, `judul`, `deskripsi`, `foto`, `stat`, `fk_username`) VALUES
(0, 'test', 'test', 'test', 'Belum Disetujui', 'rizal'),
(5, 'Samarinda Kota Tepian', 'Samarinda, ibu kota Provinsi Kalimantan Timur, adalah salah satu permata Indonesia yang sarat dengan keindahan alam, budaya, dan sejarah. Kota ini dikenal dengan julukan \"Kota Tepian\" karena lokasinya yang strategis di tepi Sungai Mahakam, sungai terbesar di Kalimantan. Pemandangan indah sungai yang mengalir tenang, lengkap dengan perahu-perahu kecil.', 'sample1.jpeg', 'Disetujui', 'rizal'),
(8, 'Lapangan Kinibalu', 'Lapangan Kinibalu, sebuah ruang hijau yang terletak di jantung Kota Samarinda, adalah tempat yang sempurna untuk melepas penat dan menikmati udara segar. Dengan suasana yang asri dan terbuka, lapangan ini menjadi destinasi favorit untuk berolahraga, bersantai, atau sekadar menghabiskan waktu bersama keluarga dan teman.', '2024-11-21 12.37.54.jpg', 'Disetujui', 'rizal');

-- --------------------------------------------------------

--
-- Table structure for table `suka`
--

CREATE TABLE `suka` (
  `id` int(11) NOT NULL,
  `fk_username` varchar(100) NOT NULL,
  `fk_id_destinasi` int(11) NOT NULL,
  `fk_id_rekomen` int(11) NOT NULL,
  `disukai` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suka`
--

INSERT INTO `suka` (`id`, `fk_username`, `fk_id_destinasi`, `fk_id_rekomen`, `disukai`) VALUES
(2, 'arya', 0, 5, 1),
(3, 'arya', 0, 8, 1),
(6, 'arya', 10, 0, 1),
(7, 'arya', 11, 0, 1);

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
  ADD KEY `FK_rekomen_komen` (`fk_id_rekomen`),
  ADD KEY `FK_destinasi_komen` (`fk_id_destinasi`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `favorit`
--
ALTER TABLE `favorit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `panduan`
--
ALTER TABLE `panduan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rekomendasi`
--
ALTER TABLE `rekomendasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `suka`
--
ALTER TABLE `suka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
