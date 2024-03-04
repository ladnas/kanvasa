-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 13, 2024 at 07:45 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `galeri`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `album_id` int(11) NOT NULL,
  `nama_album` varchar(225) NOT NULL,
  `deskripsi` text NOT NULL,
  `tgl_dibuat` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`album_id`, `nama_album`, `deskripsi`, `tgl_dibuat`, `user_id`) VALUES
(23, 'Wallpappers', 'wallpapper', '2024-02-12', 1),
(24, 'Wallpappers', 'wallpapper', '2024-02-13', 13);

-- --------------------------------------------------------

--
-- Table structure for table `albumitem`
--

CREATE TABLE `albumitem` (
  `albumitem_id` int(11) NOT NULL,
  `album_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `albumitem`
--

INSERT INTO `albumitem` (`albumitem_id`, `album_id`, `foto_id`, `user_id`) VALUES
(35, 23, 14, 1),
(36, 23, 13, 1),
(37, 23, 20, 1),
(38, 23, 22, 1),
(39, 24, 32, 13);

-- --------------------------------------------------------

--
-- Table structure for table `foto`
--

CREATE TABLE `foto` (
  `foto_id` int(11) NOT NULL,
  `judul_foto` varchar(255) NOT NULL,
  `desk_foto` varchar(255) NOT NULL,
  `tgl_unggah` date NOT NULL,
  `lokasi_file` varchar(255) NOT NULL,
  `album_id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `foto`
--

INSERT INTO `foto` (`foto_id`, `judul_foto`, `desk_foto`, `tgl_unggah`, `lokasi_file`, `album_id`, `id_user`) VALUES
(13, 'Torii', 'gapura jepang', '2024-02-10', '1707550667_bf11ffa01fa5d37cefd6.jpg', 0, 1),
(14, 'Lights', 'A lot of lights!', '2024-02-10', '1707550705_2f626e354c481d24e420.png', 0, 1),
(15, 'Your name', 'Kimi no namaewa', '2024-02-10', '1707550754_d856deced1c8f49c1fec.jpg', 0, 5),
(16, 'Some fantasy knight', 'its kinda cool tho', '2024-02-10', '1707550806_ab2b1d83ef2469fe4c6b.jpg', 0, 5),
(17, 'random sky', 'idk, just random', '2024-02-10', '1707550828_052f4eaeecb77b3be5b2.jpg', 0, 5),
(18, 'A dawn scenery', 'is it cool?', '2024-02-10', '1707550881_dfe342134248a9bfb947.jpg', 0, 2),
(19, 'Just some kid with an umbrella', 'its cool tbh', '2024-02-10', '1707550958_d72169c6feaf56c099dc.jpg', 0, 3),
(20, 'A big tree in the middle of a city', 'Inspired by nier automata', '2024-02-10', '1707551017_de3b1e76678aaa261703.jpg', 0, 3),
(21, 'A dusk beach', 'relaxing tho', '2024-02-10', '1707551046_b92ebc24e554e6ca2e0c.jpg', 0, 3),
(22, 'Unknown world', 'Looks cool', '2024-02-10', '1707551091_f8aac7ca5a2bf6cb15cf.jpg', 0, 3),
(23, 'Just some sketch', 'Its cool to combine some anime girl with a motorcylce tho', '2024-02-10', '1707551156_245f44e3e5e4955c2f63.jpg', 0, 3),
(24, 'A japanese new year', 'Fireworks and more', '2024-02-10', '1707551199_d126ece1fc5e25b58cb0.jpg', 0, 2),
(25, 'A night city', 'Really hard to draw bruh', '2024-02-10', '1707551245_e98a13d205576c35b187.jpg', 0, 2),
(26, 'North pole', 'kutub utara', '2024-02-10', '1707551268_f3e3fe0b1c29dcb84d0a.jpg', 0, 2),
(27, 'Roots and Swamp', 'idk', '2024-02-10', '1707551306_d96004bb5b376829bb74.jpg', 0, 2),
(28, 'Tiang listrik', 'gtw', '2024-02-10', '1707551345_9a318c932ffefd0dff51.jpg', 0, 1),
(29, 'Fantasy land', 'kinda cool', '2024-02-10', '1707551381_b8c4ffa02365dba721a9.jpg', 0, 1),
(30, 'A pixel art!', 'pixel art are cool!', '2024-02-10', '1707551422_8d2f11635f0a46ecf184.jpg', 0, 5),
(31, 'Nightview', 'idk', '2024-02-12', '1707706822_38d326807d08ac36ff02.jpg', 0, 1),
(32, 'Fantasy village above the clouds', 'Idk its kinda cool tho', '2024-02-13', '1707795218_008e5fb824f18bd44a18.jpg', 0, 13);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `isi_komentar` varchar(225) NOT NULL,
  `tgl_komentar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `foto_id`, `user_id`, `isi_komentar`, `tgl_komentar`) VALUES
(16, 14, 1, 'testing', '2024-02-12'),
(17, 24, 1, 'Keren cuy', '2024-02-12'),
(18, 15, 1, 'keren', '2024-02-12'),
(19, 31, 1, 'Tes', '2024-02-12'),
(20, 13, 1, 'adas', '2024-02-12');

-- --------------------------------------------------------

--
-- Table structure for table `likefoto`
--

CREATE TABLE `likefoto` (
  `like_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tgl_like` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `likefoto`
--

INSERT INTO `likefoto` (`like_id`, `foto_id`, `user_id`, `tgl_like`) VALUES
(13, 14, 1, '2024-02-12 02:01:47'),
(14, 24, 1, '2024-02-12 02:09:07'),
(15, 15, 1, '2024-02-12 02:49:12'),
(16, 31, 1, '2024-02-12 03:01:55'),
(17, 32, 13, '2024-02-13 03:34:13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(225) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `foto_profil` varchar(255) NOT NULL,
  `bio` varchar(255) NOT NULL,
  `verified` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `foto_profil`, `bio`, `verified`) VALUES
(1, 'rapin', '25d55ad283aa400af464c76d713c07ad', 'rapin@gmail.com', 'rapinda', 'jln anyelir no 13', '/profile/1706940957_71e62d6b3fba22b3baea.jpg', 'Aku rapin, salken', NULL),
(2, 'dumi', '25d55ad283aa400af464c76d713c07ad', 'dumdum@gmail.com', 'dumdumdum', 'jl awan kinton', '/profile/1707180882_37f3a7f45d0daca77c69.jpg', 'Just some dummy for testing this website', NULL),
(3, 'made', '25d55ad283aa400af464c76d713c07ad', 'made@gmail.com', 'madeee', 'jln anyelir no 13', '/profile/1707100943_294b544e474f3ea5111a.webp', 'halo', NULL),
(4, 'March7th', 'a0c05a0a0cc1b4414378bdd00e8e9601', 'marettujuh@gmail.com', 'March 7th', 'Astral Express', '/profile/1707181007_a489eee9968a01b7fa27.jpg', 'Halo! Aku March! Senang bertemu denganmu', NULL),
(5, 'dimas', '25d55ad283aa400af464c76d713c07ad', 'dimas@gmail.com', '', '', '/profile/1707192462_8f90f189fab3fda0f346.png', '', NULL),
(13, 'ravindra', 'ad4fb3d5433e42c363ed98c752080819', 'ravinpraditya@gmail.com', 'Rapindrul', 'jln pungutan no 11', '/profile/1707792723_a5f933f929ac48409473.jpg', 'Jika kamu gagal hari ini. Percayalah, bahwa besok adalah tommorow', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`album_id`);

--
-- Indexes for table `albumitem`
--
ALTER TABLE `albumitem`
  ADD PRIMARY KEY (`albumitem_id`);

--
-- Indexes for table `foto`
--
ALTER TABLE `foto`
  ADD PRIMARY KEY (`foto_id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `likefoto`
--
ALTER TABLE `likefoto`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `album_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `albumitem`
--
ALTER TABLE `albumitem`
  MODIFY `albumitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `foto`
--
ALTER TABLE `foto`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `likefoto`
--
ALTER TABLE `likefoto`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
