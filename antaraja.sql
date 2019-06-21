-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2019 at 04:17 AM
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
-- Database: `antaraja`
--

-- --------------------------------------------------------

--
-- Table structure for table `auth_active`
--

CREATE TABLE `auth_active` (
  `id_assign` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_active`
--

INSERT INTO `auth_active` (`id_assign`) VALUES
(1);

-- --------------------------------------------------------

--
-- Table structure for table `auth_assign`
--

CREATE TABLE `auth_assign` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `assign` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assign`
--

INSERT INTO `auth_assign` (`id`, `id_user`, `assign`) VALUES
(1, 1, 'administrator');

-- --------------------------------------------------------

--
-- Table structure for table `auth_ref`
--

CREATE TABLE `auth_ref` (
  `assign` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_ref`
--

INSERT INTO `auth_ref` (`assign`) VALUES
('administrator'),
('pembeli'),
('penjual');

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `nama` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_sim` bigint(12) NOT NULL,
  `no_ktp` bigint(16) NOT NULL,
  `pendidikan` varchar(32) NOT NULL,
  `jenis_kelamin` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `usia` int(3) NOT NULL,
  `no_rek_mandiri` int(20) DEFAULT NULL,
  `alamat_tinggal` varchar(30) NOT NULL,
  `alamat_ktp` varchar(30) NOT NULL,
  `merk_motor` varchar(20) NOT NULL,
  `pekerjaan` varchar(20) NOT NULL,
  `nopol_kendaraan` varchar(10) NOT NULL,
  `files` varchar(50) DEFAULT NULL,
  `ojol` varchar(32) NOT NULL,
  `berkas` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`id`, `tanggal`, `nama`, `email`, `no_sim`, `no_ktp`, `pendidikan`, `jenis_kelamin`, `status`, `usia`, `no_rek_mandiri`, `alamat_tinggal`, `alamat_ktp`, `merk_motor`, `pekerjaan`, `nopol_kendaraan`, `files`, `ojol`, `berkas`) VALUES
(13, '2019-02-14', 'agung', 'agung@gmail.com', 987654321, 12345678, 'SMA', 'LAKI - LAKI', 'BELUM MENIKAH', 21, NULL, 'solo', 'solo', 'vario', 'Mahasiswa', 'AD 1234 BA', NULL, 'TIDAK', 'Pending'),
(14, '2019-02-11', 'tito', 'tito@gmail.com', 234443223, 444434222, 'SMA', 'LAKI - LAKI', 'BELUM MENIKAH', 21, NULL, 'jogja', 'jogja', 'vario', 'pedagang', 'ab 1234 nh', '444434222.pdf', 'TIDAK', 'Ditolak'),
(15, '2019-02-11', 'deni', 'deni@gmail.com', 324234111, 32479848342, 'SMA', 'LAKI - LAKI', 'BELUM MENIKAH', 25, NULL, 'solo', 'solo', 'mio', 'mahasiswa', 'ag 1232 bg', 'deni.pdf', 'TIDAK', 'Dihapus'),
(16, '2019-02-11', 'ana', 'ana@gmail.com', 334224552, 333442344, 'SMA', 'PEREMPUAN', 'BELUM MENIKAH', 22, NULL, 'sleman', 'sleman', 'mio', 'Mahasiswa', 'ab 1234 we', '333442344.pdf', 'TIDAK', 'Diterima'),
(17, '2019-02-11', 'hai', 'hai@gmail.com', 2324234344, 23123343455, 'SMA', 'LAKI - LAKI', 'BELUM MENIKAH', 23, NULL, 'solo', 'solo', 'mio', 'mahasiswa', 'ab 1213 fg', '23123343455.pdf', 'TIDAK', 'Ditolak'),
(18, '2019-02-14', 'nia', 'nia@gmail.com', 23838444, 23838821, 'SD', 'PEREMPUAN', 'BELUM MENIKAH', 22, NULL, 'sleman', 'sleman', 'mio', 'mahasiswa', 'ab 1239 bn', NULL, 'YA', 'Pending'),
(19, '2019-02-14', 'dana', 'dana@gmail.com', 2340324031, 3424234230, 'SMP', 'LAKI - LAKI', 'BELUM MENIKAH', 20, NULL, 'solo', 'solo', 'vario', 'pedagang', 'ab 2323 er', NULL, 'TIDAK', 'Diterima'),
(20, '2019-02-14', 'nana', 'nana@gmail.com', 34234234222, 32423454534, 'SMP', 'PEREMPUAN', 'MENIKAH', 32, NULL, 'solo', 'solo', 'mio', 'ibu rt', 'ab 2132 er', NULL, 'TIDAK', 'Diterima'),
(21, '2019-02-14', 'ali', 'ali@gmail.com', 123123123, 123213213, 'SMP', 'LAKI - LAKI', 'BELUM MENIKAH', 23, NULL, 'jogja', 'jogja', 'mio', 'pedagang', 'ab 1322 tg', NULL, 'TIDAK', 'Pending'),
(22, '2019-02-14', 'anton', 'anton@gmail.com', 3424222224442, 23423423434, 'Tidak Sekolah', 'LAKI - LAKI', 'BELUM MENIKAH', 22, NULL, 'jogja', 'jogja', 'vario', 'wiraswasta', 'ab 3242 er', '23423423434.pdf', 'TIDAK', 'Pending'),
(23, '2019-02-14', 'ani', 'ani@gmail.com', 384832484884, 234324747739, 'SMA', 'PEREMPUAN', 'BELUM MENIKAH', 21, NULL, 'sleman', 'sleman', 'mio', 'mahasiswa', 'ab 2443 fr', NULL, 'TIDAK', 'Dihapus'),
(24, '2019-02-14', 'a', 'a', 1, 1, 'SD', 'PEREMPUAN', 'BELUM MENIKAH', 1, NULL, 'a', 'a', '1', 'a', '1', '1.pdf', 'TIDAK', 'Dihapus');

-- --------------------------------------------------------

--
-- Table structure for table `merk_hp`
--

CREATE TABLE `merk_hp` (
  `id` int(11) NOT NULL,
  `id_driver` int(11) NOT NULL,
  `merk` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merk_hp`
--

INSERT INTO `merk_hp` (`id`, `id_driver`, `merk`, `type`) VALUES
(1, 13, 'Nokia', 'X2'),
(2, 14, 'oppo', 'A37'),
(3, 15, 'A1', 'xiomi'),
(4, 16, 'Asus', 'M2'),
(5, 17, 'oppo', 'neo9'),
(6, 13, 'hp', '12'),
(7, 18, 'asus', 'A1'),
(8, 19, 'xiaomi', 'mi 4'),
(9, 20, 'xiaomi', 'mi A1'),
(10, 21, 'xiaomi', 'MI a2'),
(11, 22, 'oppo', 'Neo5'),
(12, 23, 'mito', 'M2'),
(13, 24, '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `no_hp`
--

CREATE TABLE `no_hp` (
  `id` int(11) NOT NULL,
  `id_driver` int(11) NOT NULL,
  `nomer` bigint(15) NOT NULL,
  `type` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `no_hp`
--

INSERT INTO `no_hp` (`id`, `id_driver`, `nomer`, `type`) VALUES
(1, 13, 87885742400, 'Utama'),
(2, 13, 8838834432, 'Alternatif'),
(3, 14, 987789990008, 'Utama'),
(4, 14, 865444677644, 'Alternatif'),
(5, 15, 873344423473, 'Utama'),
(6, 15, 855553383930, 'Alternatif'),
(7, 16, 8536472773, 'Utama'),
(8, 16, 82347478322, 'Alternatif'),
(9, 17, 854474774484, 'Utama'),
(10, 17, 85234234234, 'Alternatif'),
(11, 18, 8627232333, 'Utama'),
(12, 18, 8243498349, 'Alternatif'),
(13, 19, 865237373, 'Utama'),
(14, 19, 85337743333, 'Alternatif'),
(15, 20, 8766665546, 'Utama'),
(16, 20, 8556563545, 'Alternatif'),
(17, 21, 83432434324, 'Utama'),
(18, 21, 85234234324, 'Alternatif'),
(19, 22, 8354757545, 'Utama'),
(20, 22, 8563266373, 'Alternatif'),
(21, 23, 8347748339, 'Utama'),
(22, 23, 8534324324, 'Alternatif'),
(23, 24, 1, 'Utama'),
(24, 24, 1, 'Alternatif');

-- --------------------------------------------------------

--
-- Table structure for table `pendidikan`
--

CREATE TABLE `pendidikan` (
  `id` int(3) NOT NULL,
  `value` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pendidikan`
--

INSERT INTO `pendidikan` (`id`, `value`) VALUES
(1, 'SD'),
(2, 'SMP'),
(3, 'SMA'),
(4, 'Strata-1'),
(5, 'Strata-2'),
(6, 'Strata-3'),
(7, 'Tidak Sekolah');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'RV-mBWbro_LnUgXaylcFFFZm8TWDwlnG', '$2y$13$CBH8vc1uswnI6kk4bLJFkOqoN4uUOR7fQKc6aTi9BKQciuN6h.UwW', NULL, 'admin@gmail.com', 10, 1542615605, 1542615605);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_active`
--
ALTER TABLE `auth_active`
  ADD PRIMARY KEY (`id_assign`) USING BTREE,
  ADD KEY `id_assign` (`id_assign`) USING BTREE;

--
-- Indexes for table `auth_assign`
--
ALTER TABLE `auth_assign`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `id_user` (`id_user`) USING BTREE,
  ADD KEY `assign` (`assign`) USING BTREE;

--
-- Indexes for table `auth_ref`
--
ALTER TABLE `auth_ref`
  ADD PRIMARY KEY (`assign`) USING BTREE,
  ADD KEY `assign` (`assign`) USING BTREE;

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_sim` (`no_sim`),
  ADD UNIQUE KEY `no_ktp` (`no_ktp`);

--
-- Indexes for table `merk_hp`
--
ALTER TABLE `merk_hp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_driver` (`id_driver`);

--
-- Indexes for table `no_hp`
--
ALTER TABLE `no_hp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_driver` (`id_driver`);

--
-- Indexes for table `pendidikan`
--
ALTER TABLE `pendidikan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `username` (`username`) USING BTREE,
  ADD UNIQUE KEY `email` (`email`) USING BTREE,
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_assign`
--
ALTER TABLE `auth_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `merk_hp`
--
ALTER TABLE `merk_hp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `no_hp`
--
ALTER TABLE `no_hp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `pendidikan`
--
ALTER TABLE `pendidikan`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auth_active`
--
ALTER TABLE `auth_active`
  ADD CONSTRAINT `auth_active_ibfk_1` FOREIGN KEY (`id_assign`) REFERENCES `auth_assign` (`id`);

--
-- Constraints for table `auth_assign`
--
ALTER TABLE `auth_assign`
  ADD CONSTRAINT `auth_assign_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `auth_assign_ibfk_2` FOREIGN KEY (`assign`) REFERENCES `auth_ref` (`assign`);

--
-- Constraints for table `merk_hp`
--
ALTER TABLE `merk_hp`
  ADD CONSTRAINT `merk_hp_ibfk_1` FOREIGN KEY (`id_driver`) REFERENCES `driver` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `no_hp`
--
ALTER TABLE `no_hp`
  ADD CONSTRAINT `no_hp_ibfk_1` FOREIGN KEY (`id_driver`) REFERENCES `driver` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
