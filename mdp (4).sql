-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 22 Mar 2019 pada 04.00
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_karyawan`
--

CREATE TABLE IF NOT EXISTS `master_karyawan` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `bagian` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_karyawan`
--

INSERT INTO `master_karyawan` (`id`, `id_pabrik`, `nama`, `bagian`) VALUES
(3, 'GSIP', 'Sis', 'elektrik'),
(4, 'GSIP', 'Har', 'elektrik'),
(5, 'GSIP', 'eko', 'elektrik'),
(6, 'GSIP', 'kik', 'mekanik'),
(7, 'GSPP', 'Sigit', 'elektrik'),
(10, 'BCL2', 'andi', 'elektrik'),
(11, 'BCL2', 'barkah', 'mekanik'),
(16, 'GSDI', 'Suharyanto', 'elektrik'),
(17, 'GSDI', 'Sismadi', 'elektrik'),
(18, 'GSDI', 'Eko Nugroho', 'elektrik'),
(19, 'GSDI', 'Iwan Yulianto', 'mekanik'),
(20, 'GSDI', 'Sangadun', 'mekanik'),
(21, 'GSDI', 'Ana Nugroho', 'mekanik'),
(22, 'GSDI', 'Eko Junianto', 'mekanik'),
(23, 'GSDI', 'Ahmad Fatoni', 'mekanik'),
(24, 'GSDI', 'Bayu Setiawan', 'mekanik'),
(25, 'GSDI', 'Catur Riyatno', 'mekanik'),
(26, 'GSDI', 'Denis Prayoga', 'mekanik'),
(27, 'GSDI', 'Eko Hadi Susanto', 'mekanik'),
(28, 'GSDI', 'Endang Supriyatno', 'mekanik'),
(29, 'GSDI', 'Hariyanto', 'mekanik'),
(30, 'GSDI', 'Setiawan', 'mekanik'),
(31, 'GSDI', 'Slamet Arianto', 'mekanik'),
(32, 'GSDI', 'Sri Rohmadi', 'mekanik'),
(33, 'GSDI', 'Sudarwinto', 'mekanik'),
(34, 'GSDI', 'Sukasdianto', 'mekanik'),
(35, 'GSDI', 'Sungkono', 'mekanik'),
(36, 'GSDI', 'Umarrudin', 'mekanik'),
(37, 'GSDI', 'Widodo Roziqin', 'mekanik'),
(60, 'ANA', 'Suharyanto', 'elektrik'),
(61, 'ANA', 'Sismadi', 'elektrik'),
(62, 'ANA', 'Eko Nugroho', 'elektrik'),
(63, 'ANA', 'Iwan Yulianto', 'mekanik'),
(64, 'ANA', 'Sangadun', 'mekanik'),
(65, 'ANA', 'Ana Nugroho', 'mekanik'),
(66, 'ANA', 'Eko Junianto', 'mekanik'),
(67, 'ANA', 'Ahmad Fatoni', 'mekanik'),
(68, 'ANA', 'Bayu Setiawan', 'mekanik'),
(69, 'ANA', 'Catur Riyatno', 'mekanik'),
(70, 'ANA', 'Denis Prayoga', 'mekanik'),
(71, 'ANA', 'Eko Hadi Susanto', 'mekanik'),
(72, 'ANA', 'Endang Supriyatno', 'mekanik'),
(73, 'ANA', 'Hariyanto', 'mekanik'),
(74, 'ANA', 'Setiawan', 'mekanik'),
(75, 'ANA', 'Slamet Arianto', 'mekanik'),
(76, 'ANA', 'Sri Rohmadi', 'mekanik'),
(77, 'ANA', 'Sudarwinto', 'mekanik'),
(78, 'ANA', 'Sukasdianto', 'mekanik'),
(79, 'ANA', 'Sungkono', 'mekanik'),
(80, 'ANA', 'Umarrudin', 'mekanik'),
(81, 'ANA', 'Widodo Roziqin', 'mekanik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pabrik`
--

CREATE TABLE IF NOT EXISTS `master_pabrik` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `tipe` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_pabrik`
--

INSERT INTO `master_pabrik` (`id`, `nama`, `tipe`) VALUES
(1, 'ANA', 'Mill 45 Tph'),
(2, 'BCL2 ', 'Mill 45 Tph'),
(3, 'BIM', 'Mill 45 Tph'),
(4, 'SINP', 'Mill 45 Tph'),
(5, 'CAN3', 'Mill 45 Tph'),
(6, 'CAP2', 'NPK'),
(7, 'CPN', 'Mill 45 Tph'),
(8, 'EDC', 'Mill 45 Tph'),
(9, 'EDI', 'Mill 45 Tph'),
(10, 'EDP', 'Mill 45 Tph'),
(11, 'KED', 'Refinery'),
(12, 'KED2', 'Mill 45 Tph'),
(13, 'KTS', 'Mill 45 Tph'),
(14, 'KTU', 'Mill 45 Tph'),
(15, 'LTT', 'Mill 45 Tph'),
(16, 'LTW', 'Mill 60 Tph'),
(17, 'NAL', 'Mill 60 Tph'),
(18, 'PLB', 'Mill 60 Tph'),
(19, 'PLB2', 'Mill 60 Tph'),
(20, 'PSK', 'Mill 60 Tph'),
(21, 'PWR', 'Mill 60 Tph'),
(22, 'SAI', 'Mill 60 Tph'),
(23, 'SAL1', 'Mill 60 Tph'),
(24, 'SAL2', 'Mill 60 Tph'),
(25, 'SAM', 'Mill 60 Tph'),
(26, 'GSDI', 'Mill 80 Tph'),
(27, 'GSIP', 'Mill 70 Tph'),
(28, 'SJA2', 'Mill 70 Tph'),
(29, 'SKP', 'Mill 70 Tph'),
(30, 'SLS1', 'Mill 70 Tph'),
(31, 'SLS2', 'Mill 70 Tph'),
(32, 'GSPP', 'Mill 70 Tph'),
(33, 'SRL1', 'Mill 70 Tph'),
(34, 'SRL2', 'Mill 70 Tph'),
(35, 'STN', 'Mill 70 Tph'),
(36, 'TBM', 'Mill 70 Tph'),
(37, 'TPP', 'Mill 70 Tph');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_schedule`
--

CREATE TABLE IF NOT EXISTS `master_schedule` (
  `id_pabrik` varchar(16) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `monitoring_item` varchar(128) NOT NULL,
  `standard` varchar(64) NOT NULL,
  `parameter` varchar(128) NOT NULL,
  `frekuensi` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_schedule`
--

INSERT INTO `master_schedule` (`id_pabrik`, `id_station`, `id_unit`, `monitoring_item`, `standard`, `parameter`, `frekuensi`) VALUES
('GSDI', 'Fruit Reception', 'Tipping dump line B', 'Greasing', '', 'terlumasi', 'Bulanan'),
('GSDI', 'Fruit Reception', 'Tipping dump line B', 'Cek Oli gearbox', '', 'level terpenuhi', '2 Bulanan'),
('GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 'Greasing', 'Terlumasi', '', '4 Bulanan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_station`
--

CREATE TABLE IF NOT EXISTS `master_station` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_station`
--

INSERT INTO `master_station` (`id`, `id_pabrik`, `nama`) VALUES
(10, 'GSIP', 'Loading Ramp'),
(11, 'GSIP', 'Sterilizer'),
(12, 'GSIP', 'Threser'),
(13, 'GSIP', 'Press'),
(14, 'GSIP', 'Bunch Press'),
(15, 'GSIP', 'Kernel'),
(16, 'GSIP', 'Klarifikasi'),
(17, 'GSIP', 'Boiler'),
(18, 'GSIP', 'Effluent'),
(29, 'GSPP', 'Loading Ramp'),
(30, 'GSPP', 'Sterilizer'),
(31, 'GSPP', 'Threser'),
(32, 'GSPP', 'Press'),
(33, 'GSPP', 'Bunch Press'),
(34, 'GSPP', 'Kernel'),
(35, 'GSPP', 'Klarifikasi'),
(36, 'GSPP', 'Boiler'),
(37, 'GSPP', 'Effluent'),
(39, 'STN', 'Effluent'),
(65, 'ANA', 'Fruit Reception'),
(66, 'ANA', 'Threshing'),
(67, 'ANA', 'Pressing'),
(68, 'ANA', 'Bunch Press'),
(69, 'ANA', 'Kernel Line A'),
(70, 'ANA', 'Kernel Line B'),
(71, 'ANA', 'Klarifikasi'),
(72, 'ANA', 'Boiler 1 &amp; Softener'),
(73, 'ANA', 'BOILER 2'),
(74, 'ANA', 'BOILER 3'),
(75, 'ANA', 'KCP'),
(76, 'ANA', 'WTP'),
(77, 'ANA', 'Effluent'),
(78, 'ANA', 'Komposting'),
(79, 'ANA', 'Biodiesel'),
(80, 'ANA', 'Despatch'),
(81, 'GSDI', 'Fruit Reception'),
(82, 'GSDI', 'Threshing'),
(83, 'GSDI', 'Pressing'),
(84, 'GSDI', 'Bunch Press'),
(85, 'GSDI', 'Kernel Line A'),
(86, 'GSDI', 'Kernel Line B'),
(87, 'GSDI', 'Klarifikasi'),
(88, 'GSDI', 'Boiler 1 &amp; Softener'),
(89, 'GSDI', 'BOILER 2'),
(90, 'GSDI', 'BOILER 3'),
(91, 'GSDI', 'KCP'),
(92, 'GSDI', 'WTP'),
(93, 'GSDI', 'Effluent'),
(94, 'GSDI', 'Komposting'),
(95, 'GSDI', 'Biodiesel'),
(96, 'GSDI', 'Despatch'),
(97, 'GSDI', 'General'),
(98, 'BCL2', 'Feeding'),
(99, 'BCL2', 'Mixing'),
(100, 'BCL2', 'Granulating'),
(101, 'BCL2', 'Drying'),
(102, 'BCL2', 'Cooling'),
(103, 'BCL2', 'Seiving'),
(104, 'BCL2', 'Coating'),
(105, 'BCL2', 'Packaging'),
(106, 'BCL2', 'Boiler'),
(107, 'BCL2', 'WTP'),
(108, 'BCL2', 'Power House'),
(109, 'SINP', 'Fruit Reception'),
(110, 'SINP', 'Threshing'),
(111, 'SINP', 'Pressing'),
(112, 'SINP', 'Bunch Press'),
(113, 'SINP', 'Kernel Line A'),
(114, 'SINP', 'Kernel Line B'),
(115, 'SINP', 'Klarifikasi'),
(116, 'SINP', 'Boiler 1 &amp; Softener'),
(117, 'SINP', 'BOILER 2'),
(118, 'SINP', 'BOILER 3'),
(119, 'SINP', 'KCP'),
(120, 'SINP', 'WTP'),
(121, 'SINP', 'Effluent'),
(122, 'SINP', 'Komposting'),
(123, 'SINP', 'Biodiesel'),
(124, 'SINP', 'Despatch');

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_unit`
--

CREATE TABLE IF NOT EXISTS `master_unit` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `kode_asset` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `hm_installed` int(11) NOT NULL,
  `oil_monitoring` int(11) NOT NULL,
  `screwpress_monitoring` int(11) NOT NULL,
  `bunchpress_monitoring` int(11) NOT NULL,
  `hydrocyclone_monitoring` int(11) NOT NULL,
  `kcp_monitoring` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=1055 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_unit`
--

INSERT INTO `master_unit` (`id`, `id_pabrik`, `id_station`, `kode_asset`, `nama`, `hm_installed`, `oil_monitoring`, `screwpress_monitoring`, `bunchpress_monitoring`, `hydrocyclone_monitoring`, `kcp_monitoring`) VALUES
(2, 'GSPP', 'Threser', 't1', 'Threser 1', 0, 0, 0, 0, 0, 0),
(23, 'GSIP', 'Press', 'p1', 'Press 1', 0, 0, 0, 0, 0, 0),
(24, 'GSIP', 'Press', '', 'Press 2', 0, 0, 0, 0, 0, 0),
(25, 'GSIP', 'Press', '', 'Press 3', 0, 0, 0, 0, 0, 0),
(26, 'GSIP', 'Press', '', 'Press 4', 0, 0, 0, 0, 0, 0),
(27, 'GSIP', 'Press', '', 'Press 5', 0, 0, 0, 0, 0, 0),
(28, 'GSIP', 'Press', '', 'Press 6', 0, 0, 0, 0, 0, 0),
(29, 'GSIP', '', '', 'Press 7', 0, 0, 0, 0, 0, 0),
(30, 'GSIP', '', '', 'Press 8', 0, 0, 0, 0, 0, 0),
(31, 'GSIP', '', '', 'Press 9', 0, 0, 0, 0, 0, 0),
(32, 'GSIP', '', '', 'Press 10', 0, 0, 0, 0, 0, 0),
(33, 'GSIP', '', '', 'Press 11', 0, 0, 0, 0, 0, 0),
(34, 'GSIP', '', '', 'Press 12', 0, 0, 0, 0, 0, 0),
(35, 'GSIP', '', '', 'Press 13', 0, 0, 0, 0, 0, 0),
(36, 'GSIP', '', '', 'Press 14', 0, 0, 0, 0, 0, 0),
(37, 'GSIP', '', '', 'Press 15', 0, 0, 0, 0, 0, 0),
(68, 'GSDI', '', '', '', 0, 0, 0, 0, 0, 0),
(211, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 1', 0, 0, 0, 0, 0, 0),
(212, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 2', 0, 0, 0, 0, 0, 0),
(213, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 3', 0, 0, 0, 0, 0, 0),
(214, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 4', 0, 0, 0, 0, 0, 0),
(215, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 5', 0, 0, 0, 0, 0, 0),
(216, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 6', 0, 0, 0, 0, 0, 0),
(217, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 7', 0, 0, 0, 0, 0, 0),
(218, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 8', 0, 0, 0, 0, 0, 0),
(219, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 9', 0, 0, 0, 0, 0, 0),
(220, 'GSDI', 'Klarifikasi', '', 'Sludge Sparator No. 10', 0, 0, 0, 0, 0, 0),
(221, 'GSDI', 'Klarifikasi', '', 'CO Pump No. 1', 0, 0, 0, 0, 0, 0),
(222, 'GSDI', 'Klarifikasi', '', 'CO Pump No. 2', 0, 0, 0, 0, 0, 0),
(223, 'GSDI', 'Klarifikasi', '', 'CO Pump No   3', 0, 0, 0, 0, 0, 0),
(224, 'GSDI', 'Klarifikasi', '', 'CCT Motor No. 1', 0, 0, 0, 0, 0, 0),
(225, 'GSDI', 'Klarifikasi', '', 'CCT Motor No. 2', 0, 0, 0, 0, 0, 0),
(226, 'GSDI', 'Klarifikasi', '', 'CCT Motor No. 3', 0, 0, 0, 0, 0, 0),
(227, 'GSDI', 'Klarifikasi', '', 'Desanding Pump No. 1', 0, 0, 0, 0, 0, 0),
(228, 'GSDI', 'Klarifikasi', '', 'Desanding Pump No. 2', 0, 0, 0, 0, 0, 0),
(229, 'GSDI', 'Klarifikasi', '', 'Desanding Pump No. 3', 0, 0, 0, 0, 0, 0),
(230, 'GSDI', 'Klarifikasi', '', 'Brush Strainer No. 1', 0, 0, 0, 0, 0, 0),
(231, 'GSDI', 'Klarifikasi', '', 'Brush Strainer No. 2', 0, 0, 0, 0, 0, 0),
(232, 'GSDI', 'Klarifikasi', '', 'Brush Strainer No. 3', 0, 0, 0, 0, 0, 0),
(233, 'GSDI', 'Klarifikasi', '', 'Brush Strainer No. 4', 0, 0, 0, 0, 0, 0),
(234, 'GSDI', 'Klarifikasi', '', 'Brush Strainer No. 5', 0, 0, 0, 0, 0, 0),
(235, 'GSDI', 'Klarifikasi', '', 'Tailing conveyor no 1', 0, 0, 0, 0, 0, 0),
(236, 'GSDI', 'Klarifikasi', '', 'Tailing conveyor no 2', 0, 0, 0, 0, 0, 0),
(237, 'GSDI', 'Klarifikasi', '', 'Hot Well Pump No.1', 0, 0, 0, 0, 0, 0),
(238, 'GSDI', 'Klarifikasi', '', 'Hot Wel Pump No. 2', 0, 0, 0, 0, 0, 0),
(239, 'GSDI', 'Klarifikasi', '', 'Furifier No. 1', 0, 0, 0, 0, 0, 0),
(240, 'GSDI', 'Klarifikasi', '', 'Furifier No. 2', 0, 0, 0, 0, 0, 0),
(241, 'GSDI', 'Klarifikasi', '', 'Furifier No. 3', 0, 0, 0, 0, 0, 0),
(242, 'GSDI', 'Klarifikasi', '', 'Feed Purifier no. 1', 0, 0, 0, 0, 0, 0),
(243, 'GSDI', 'Klarifikasi', '', 'Feed Purifier no. 2', 0, 0, 0, 0, 0, 0),
(244, 'GSDI', 'Klarifikasi', '', 'Feed Purifier no. 3', 0, 0, 0, 0, 0, 0),
(245, 'GSDI', 'Klarifikasi', '', 'Waste Colection Pump', 0, 0, 0, 0, 0, 0),
(246, 'GSDI', 'Klarifikasi', '', 'Recycle Oil Pump No. 1', 0, 0, 0, 0, 0, 0),
(247, 'GSDI', 'Klarifikasi', '', 'Recycle Oil Pump No. 2', 0, 0, 0, 0, 0, 0),
(248, 'GSDI', 'Klarifikasi', '', 'Vacum Oil Pump No. 1', 0, 0, 0, 0, 0, 0),
(249, 'GSDI', 'Klarifikasi', '', 'Vacum Oil Pump No. 2', 0, 0, 0, 0, 0, 0),
(250, 'GSDI', 'Klarifikasi', '', 'Sludge Pit Pump No. 1', 0, 0, 0, 0, 0, 0),
(251, 'GSDI', 'Klarifikasi', '', 'Sludge Pit Pump No. 2', 0, 0, 0, 0, 0, 0),
(252, 'GSDI', 'Klarifikasi', '', 'Oil transfer pump no. 1', 0, 0, 0, 0, 0, 0),
(253, 'GSDI', 'Klarifikasi', '', 'Oil transfer pump no. 2', 0, 0, 0, 0, 0, 0),
(254, 'GSDI', 'Klarifikasi', '', 'Oil transfer pump no. 3', 0, 0, 0, 0, 0, 0),
(255, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 1', 0, 0, 0, 0, 0, 0),
(256, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 2', 0, 0, 0, 0, 0, 0),
(257, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 3', 0, 0, 0, 0, 0, 0),
(258, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 4', 0, 0, 0, 0, 0, 0),
(259, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 5', 0, 0, 0, 0, 0, 0),
(260, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 6', 0, 0, 0, 0, 0, 0),
(261, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 7', 0, 0, 0, 0, 0, 0),
(262, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 8', 0, 0, 0, 0, 0, 0),
(263, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 9', 0, 0, 0, 0, 0, 0),
(264, 'GSDI', 'Klarifikasi', '', 'Vibrating Screen No. 10', 0, 0, 0, 0, 0, 0),
(265, 'GSDI', 'Klarifikasi', '', 'Under setlink conveyor', 0, 0, 0, 0, 0, 0),
(266, 'GSDI', 'Klarifikasi', '', 'Distribusi Under setlink conveyor', 0, 0, 0, 0, 0, 0),
(267, 'GSDI', 'Klarifikasi', '', 'Air Compressor', 0, 0, 0, 0, 0, 0),
(268, 'GSDI', 'Boiler 1 & Softener', '', 'Undercyclone Conveyor', 0, 0, 0, 0, 0, 0),
(269, 'GSDI', 'Boiler 1 & Softener', '', 'Inclined Fibershell conveyor no. 1', 0, 0, 0, 0, 0, 0),
(270, 'GSDI', 'Boiler 1 & Softener', '', 'Fuel distributing conv. Boiler no. 3', 0, 0, 0, 0, 0, 0),
(271, 'GSDI', 'Boiler 1 & Softener', '', 'Excess recovery scraper coveyor no. 2', 0, 0, 0, 0, 0, 0),
(272, 'GSDI', 'Boiler 1 & Softener', '', 'Softener no. 1', 0, 0, 0, 0, 0, 0),
(273, 'GSDI', 'Boiler 1 & Softener', '', 'Softener no. 2', 0, 0, 0, 0, 0, 0),
(274, 'GSDI', 'Boiler 1 & Softener', '', 'Dearator pump no. 1', 0, 0, 0, 0, 0, 0),
(275, 'GSDI', 'Boiler 1 & Softener', '', 'Dearator pump no. 2', 0, 0, 0, 0, 0, 0),
(276, 'GSDI', 'Boiler 1 & Softener', '', 'Dearator pump no. 3', 0, 0, 0, 0, 0, 0),
(277, 'GSDI', 'Boiler 1 & Softener', '', 'BPV Feed pump ', 0, 0, 0, 0, 0, 0),
(278, 'GSDI', 'Boiler 1 & Softener', '', 'Feed Water Pump no. 1', 0, 0, 0, 0, 0, 0),
(279, 'GSDI', 'Boiler 1 & Softener', '', 'Feed Water Pump no. 2', 0, 0, 0, 0, 0, 0),
(280, 'GSDI', 'Boiler 1 & Softener', '', 'Feed Water Pump no. 3', 0, 0, 0, 0, 0, 0),
(281, 'GSDI', 'Boiler 1 & Softener', '', 'Thermal Dearator pump no. 2', 0, 0, 0, 0, 0, 0),
(282, 'GSDI', 'Boiler 1 & Softener', '', 'Inclined Fibershell conveyor no. 2', 0, 0, 0, 0, 0, 0),
(283, 'GSDI', 'Boiler 1 & Softener', '', 'Fuel distributing conv. Boiler no. 1.2', 0, 0, 0, 0, 0, 0),
(284, 'GSDI', 'Boiler 1 & Softener', '', 'Hydraulic power pack boiler ', 0, 0, 0, 0, 0, 0),
(285, 'GSDI', 'Boiler 1 & Softener', '', 'Ash Scraper conveyor ', 0, 0, 0, 0, 0, 0),
(286, 'GSDI', 'Boiler 1 & Softener', '', 'Thermal Dearator pump no. 1', 0, 0, 0, 0, 0, 0),
(287, 'GSDI', 'Boiler 1 & Softener', '', 'Dosing pump no. 1', 0, 0, 0, 0, 0, 0),
(288, 'GSDI', 'Boiler 1 & Softener', '', 'Dosing pump no. 2', 0, 0, 0, 0, 0, 0),
(289, 'GSDI', 'Boiler 1 & Softener', '', 'IDF ', 0, 0, 0, 0, 0, 0),
(290, 'GSDI', 'Boiler 1 & Softener', '', 'FDF ', 0, 0, 0, 0, 0, 0),
(291, 'GSDI', 'Boiler 1 & Softener', '', 'Secondary air fan', 0, 0, 0, 0, 0, 0),
(292, 'GSDI', 'Boiler 1 & Softener', '', 'CAF / Air Duct', 0, 0, 0, 0, 0, 0),
(293, 'GSDI', 'Boiler 1 & Softener', '', 'Ash screw conveyor AT Drump', 0, 0, 0, 0, 0, 0),
(294, 'GSDI', 'Boiler 1 & Softener', '', 'Dust screw conveyor AT /DC', 0, 0, 0, 0, 0, 0),
(295, 'GSDI', 'Boiler 1 & Softener', '', 'Ash &amp; dust conveyor ', 0, 0, 0, 0, 0, 0),
(296, 'GSDI', 'Boiler 1 & Softener', '', 'Air lock ash hopper no. 1 ', 0, 0, 0, 0, 0, 0),
(297, 'GSDI', 'Boiler 1 & Softener', '', 'Air lock ash hopper no. 2', 0, 0, 0, 0, 0, 0),
(298, 'GSDI', 'Boiler 1 & Softener', '', 'Air lock Dust hopper', 0, 0, 0, 0, 0, 0),
(299, 'GSDI', 'Boiler 1 & Softener', '', 'Air lock no. 1 fuel feeder', 0, 0, 0, 0, 0, 0),
(300, 'GSDI', 'Boiler 1 & Softener', '', 'Air lock no. 2 fuel feeder', 0, 0, 0, 0, 0, 0),
(301, 'GSDI', 'Boiler 1 & Softener', '', 'Air lock no. 3 fuel feeder', 0, 0, 0, 0, 0, 0),
(302, 'GSDI', 'Boiler 1 & Softener', '', 'Thermal dearator pump no. 3', 0, 0, 0, 0, 0, 0),
(303, 'GSDI', 'BOILER 2', '', 'Hydraulic power pack boiler ', 0, 0, 0, 0, 0, 0),
(304, 'GSDI', 'BOILER 2', '', 'IDF ', 0, 0, 0, 0, 0, 0),
(305, 'GSDI', 'BOILER 2', '', 'FDF ', 0, 0, 0, 0, 0, 0),
(306, 'GSDI', 'BOILER 2', '', 'Secondary fan ', 0, 0, 0, 0, 0, 0),
(307, 'GSDI', 'BOILER 2', '', 'CAF Boiler no. ', 0, 0, 0, 0, 0, 0),
(308, 'GSDI', 'BOILER 2', '', 'Ash Scraper Conveyor ', 0, 0, 0, 0, 0, 0),
(309, 'GSDI', 'BOILER 2', '', 'Ash screw conveyor AT drum', 0, 0, 0, 0, 0, 0),
(310, 'GSDI', 'BOILER 2', '', 'Dust screw conveyor AT /DC', 0, 0, 0, 0, 0, 0),
(311, 'GSDI', 'BOILER 2', '', 'Ash &amp; dust conveyor no. 1', 0, 0, 0, 0, 0, 0),
(312, 'GSDI', 'BOILER 2', '', 'Ash &amp; dust conveyor no. 2', 0, 0, 0, 0, 0, 0),
(313, 'GSDI', 'BOILER 2', '', 'Rotary valve AT drum 1', 0, 0, 0, 0, 0, 0),
(314, 'GSDI', 'BOILER 2', '', 'Rotary valve AT drum 2', 0, 0, 0, 0, 0, 0),
(315, 'GSDI', 'BOILER 2', '', 'Rotary valve AT / DC 1', 0, 0, 0, 0, 0, 0),
(316, 'GSDI', 'BOILER 2', '', 'Air lock no. 1 fuel feeder', 0, 0, 0, 0, 0, 0),
(317, 'GSDI', 'BOILER 2', '', 'Air lock no. 2 fuel feeder', 0, 0, 0, 0, 0, 0),
(318, 'GSDI', 'BOILER 2', '', 'Air lock no. 3 fuel feeder', 0, 0, 0, 0, 0, 0),
(319, 'GSDI', 'BOILER 2', '', 'Recycle fibre conveyor', 0, 0, 0, 0, 0, 0),
(320, 'GSDI', 'BOILER 2', '', 'Exces Fuel Conveyor no. 1', 0, 0, 0, 0, 0, 0),
(321, 'GSDI', 'BOILER 2', '', 'Exces Fuel Conveyor no. 2', 0, 0, 0, 0, 0, 0),
(322, 'GSDI', 'BOILER 3', '', 'Hydraulic power pack', 0, 0, 0, 0, 0, 0),
(323, 'GSDI', 'BOILER 3', '', 'Scraper Conveyor AT grade ', 0, 0, 0, 0, 0, 0),
(324, 'GSDI', 'BOILER 3', '', 'Feed water pump 1 ', 0, 0, 0, 0, 0, 0),
(325, 'GSDI', 'BOILER 3', '', 'Feed water pump 2', 0, 0, 0, 0, 0, 0),
(326, 'GSDI', 'BOILER 3', '', 'IDF ', 0, 0, 0, 0, 0, 0),
(327, 'GSDI', 'BOILER 3', '', 'FDF ', 0, 0, 0, 0, 0, 0),
(328, 'GSDI', 'BOILER 3', '', 'Secondary fan ', 0, 0, 0, 0, 0, 0),
(329, 'GSDI', 'BOILER 3', '', 'Fuel feeder fan', 0, 0, 0, 0, 0, 0),
(330, 'GSDI', 'BOILER 3', '', 'Ash screw conveyor AT drum', 0, 0, 0, 0, 0, 0),
(331, 'GSDI', 'BOILER 3', '', 'Dust screw conveyor AT /DC', 0, 0, 0, 0, 0, 0),
(332, 'GSDI', 'BOILER 3', '', 'Ash &amp; dust screw conveyor 1 ', 0, 0, 0, 0, 0, 0),
(333, 'GSDI', 'BOILER 3', '', 'Ash &amp; dust screw conveyor 2 ', 0, 0, 0, 0, 0, 0),
(334, 'GSDI', 'BOILER 3', '', 'Ash  &amp; dust screw conveyor 3', 0, 0, 0, 0, 0, 0),
(335, 'GSDI', 'BOILER 3', '', 'Rotary valve AT drum 1', 0, 0, 0, 0, 0, 0),
(336, 'GSDI', 'BOILER 3', '', 'Rotary valve AT drum 2', 0, 0, 0, 0, 0, 0),
(337, 'GSDI', 'BOILER 3', '', 'Rotary valve AT/ DC  1', 0, 0, 0, 0, 0, 0),
(338, 'GSDI', 'BOILER 3', '', 'Rotary valve AT / DC 2', 0, 0, 0, 0, 0, 0),
(339, 'GSDI', 'BOILER 3', '', 'Rotary fuel feeder 1 ', 0, 0, 0, 0, 0, 0),
(340, 'GSDI', 'BOILER 3', '', 'Rotary fuel feeder 2 ', 0, 0, 0, 0, 0, 0),
(341, 'GSDI', 'BOILER 3', '', 'Rotary fuel feeder 3', 0, 0, 0, 0, 0, 0),
(342, 'GSDI', 'BOILER 3', '', 'Rotary fuel feeder 4', 0, 0, 0, 0, 0, 0),
(343, 'GSDI', 'BOILER 3', '', 'Exces recovery scraper no. 1', 0, 0, 0, 0, 0, 0),
(344, 'GSDI', 'BOILER 3', '', 'Air compressor', 0, 0, 0, 0, 0, 0),
(386, 'GSDI', 'WTP', '', 'Raw Watter Pump 1', 0, 0, 0, 0, 0, 0),
(387, 'GSDI', 'WTP', '', 'Raw Watter Pump 2', 0, 0, 0, 0, 0, 0),
(388, 'GSDI', 'WTP', '', 'Sedimen Pump 1', 0, 0, 0, 0, 0, 0),
(389, 'GSDI', 'WTP', '', 'Sedimen Pump 2', 0, 0, 0, 0, 0, 0),
(390, 'GSDI', 'WTP', '', 'Dosing Pump 1 (Alum)', 0, 0, 0, 0, 0, 0),
(391, 'GSDI', 'WTP', '', 'Dosing Pump 2 (Soda)', 0, 0, 0, 0, 0, 0),
(392, 'GSDI', 'WTP', '', 'Dosing pump 3 ( casflog )', 0, 0, 0, 0, 0, 0),
(393, 'GSDI', 'WTP', '', 'Pengaduk Alum', 0, 0, 0, 0, 0, 0),
(394, 'GSDI', 'WTP', '', 'Pengaduk Soda', 0, 0, 0, 0, 0, 0),
(395, 'GSDI', 'WTP', '', 'Pengaduk casflog', 0, 0, 0, 0, 0, 0),
(396, 'GSDI', 'WTP', '', 'Elektrik Hydrant Pump no. 1', 0, 0, 0, 0, 0, 0),
(397, 'GSDI', 'WTP', '', 'Elektrik Hydrant Pump no. 2', 0, 0, 0, 0, 0, 0),
(398, 'GSDI', 'WTP', '', 'Pompa bak sedimen no 1 ke no 2', 0, 0, 0, 0, 0, 0),
(399, 'GSDI', 'Effluent', '', 'Anairobic Pond 1', 0, 0, 0, 0, 0, 0),
(400, 'GSDI', 'Effluent', '', 'Anairobic Pond 2', 0, 0, 0, 0, 0, 0),
(401, 'GSDI', 'Effluent', '', 'Anairobic Pond 3', 0, 0, 0, 0, 0, 0),
(402, 'GSDI', 'Effluent', '', 'Anairobic Pond 4', 0, 0, 0, 0, 0, 0),
(403, 'GSDI', 'Effluent', '', 'Buffer Pond', 0, 0, 0, 0, 0, 0),
(404, 'GSDI', 'Effluent', '', 'Contact pond', 0, 0, 0, 0, 0, 0),
(405, 'GSDI', 'Effluent', '', 'Agitator no 1', 0, 0, 0, 0, 0, 0),
(406, 'GSDI', 'Effluent', '', 'Agitator no 2', 0, 0, 0, 0, 0, 0),
(407, 'GSDI', 'Effluent', '', 'Agitator no 3', 0, 0, 0, 0, 0, 0),
(408, 'GSDI', 'Effluent', '', 'Agitator no 4', 0, 0, 0, 0, 0, 0),
(409, 'GSDI', 'Komposting', '', 'Pompa Siram', 0, 0, 0, 0, 0, 0),
(410, 'GSDI', 'Komposting', '', 'Recycle pump', 0, 0, 0, 0, 0, 0),
(411, 'GSDI', 'Biodiesel', '', 'Methanol Pump ', 0, 0, 0, 0, 0, 0),
(412, 'GSDI', 'Biodiesel', '', 'Methoxioe Storage Pump', 0, 0, 0, 0, 0, 0),
(413, 'GSDI', 'Biodiesel', '', 'Reaktor Tank 1', 0, 0, 0, 0, 0, 0),
(414, 'GSDI', 'Biodiesel', '', 'SettlinkTank 1', 0, 0, 0, 0, 0, 0),
(415, 'GSDI', 'Biodiesel', '', 'Reaktor Tank 2', 0, 0, 0, 0, 0, 0),
(416, 'GSDI', 'Biodiesel', '', 'SettlinkTank 2', 0, 0, 0, 0, 0, 0),
(417, 'GSDI', 'Biodiesel', '', 'Biodiesel Pump', 0, 0, 0, 0, 0, 0),
(418, 'GSDI', 'Biodiesel', '', 'Washing Tank', 0, 0, 0, 0, 0, 0),
(419, 'GSDI', 'Biodiesel', '', 'Flash Epaporator ', 0, 0, 0, 0, 0, 0),
(420, 'GSDI', 'Biodiesel', '', 'Biodiesel storage', 0, 0, 0, 0, 0, 0),
(421, 'GSDI', 'Biodiesel', '', 'Condensor methanol', 0, 0, 0, 0, 0, 0),
(422, 'GSDI', 'Biodiesel', '', 'Reaktor Tank 1', 0, 0, 0, 0, 0, 0),
(423, 'GSDI', 'Biodiesel', '', 'Reaktor Tank 2', 0, 0, 0, 0, 0, 0),
(424, 'GSDI', 'Biodiesel', '', 'Washing tank', 0, 0, 0, 0, 0, 0),
(425, 'GSDI', 'Biodiesel', '', 'KOH Methanol Mixer', 0, 0, 0, 0, 0, 0),
(426, 'GSDI', 'Biodiesel', '', 'Oil Tank', 0, 0, 0, 0, 0, 0),
(431, 'GSDI', 'Threshing', '', 'Power Pack Tipper No. 1', 0, 0, 0, 0, 0, 0),
(432, 'GSDI', 'Threshing', '', 'Sterilizer Bunch Conveyor', 0, 0, 0, 0, 0, 0),
(433, 'GSDI', 'Threshing', '', 'Distribusi Bunch Conveyor', 0, 0, 0, 0, 0, 0),
(434, 'GSDI', 'Threshing', '', 'Horizontal Empty Bunch Conveyor', 0, 0, 0, 0, 0, 0),
(435, 'GSDI', 'Threshing', '', 'Inclined Empty Bunch Conveyor', 0, 0, 0, 0, 0, 0),
(436, 'GSDI', 'Threshing', '', 'Thresher No. 4', 0, 0, 0, 0, 0, 0),
(437, 'GSDI', 'Threshing', '', 'Thresher No. 2', 0, 0, 0, 0, 0, 0),
(438, 'GSDI', 'Threshing', '', 'Thresher No. 3', 0, 0, 0, 0, 0, 0),
(439, 'GSDI', 'Threshing', '', 'Thresher No. 1', 0, 0, 0, 0, 0, 0),
(440, 'GSDI', 'Threshing', '', 'Bellow Thresher no. 1', 0, 0, 0, 0, 0, 0),
(441, 'GSDI', 'Threshing', '', 'Bellow Thresher no. 2', 0, 0, 0, 0, 0, 0),
(442, 'GSDI', 'Threshing', '', 'Bellow Thresher no. 3', 0, 0, 0, 0, 0, 0),
(443, 'GSDI', 'Threshing', '', 'Bellow Thresher no. 4', 0, 0, 0, 0, 0, 0),
(444, 'GSDI', 'Threshing', '', 'Re Treshing', 0, 0, 0, 0, 0, 0),
(445, 'GSDI', 'Threshing', '', 'Bunch crusher', 0, 0, 0, 0, 0, 0),
(446, 'GSDI', 'Threshing', '', 'Bottom Cross Conveyor', 0, 0, 0, 0, 0, 0),
(447, 'GSDI', 'Threshing', '', 'Auto feeder  ', 0, 0, 0, 0, 0, 0),
(448, 'GSDI', 'Threshing', '', 'Doble wins no 7 - 8', 0, 0, 0, 0, 0, 0),
(449, 'GSDI', 'Threshing', '', 'Transfer cariage 3', 0, 0, 0, 0, 0, 0),
(450, 'GSDI', 'Threshing', '', 'Transfer cariage 4', 0, 0, 0, 0, 0, 0),
(544, 'GSDI', 'Fruit Reception', '', 'Tipping dump line B', 1, 0, 0, 0, 0, 0),
(545, 'GSDI', 'Fruit Reception', '', 'Motor Power Pack L/R line A', 1, 0, 0, 0, 0, 0),
(546, 'GSDI', 'Fruit Reception', '', 'Motor Power Pack L/R   line B', 1, 0, 0, 0, 0, 0),
(547, 'GSDI', 'Fruit Reception', '', 'Motor Transfer Carryage I', 1, 0, 0, 0, 0, 0),
(548, 'GSDI', 'Fruit Reception', '', 'Motor Transfer Carryage II', 1, 0, 0, 0, 0, 0),
(549, 'GSDI', 'Fruit Reception', '', 'Motor Hydrolic Double Winch No. 1', 1, 0, 0, 0, 0, 0),
(550, 'GSDI', 'Fruit Reception', '', 'Motor Hydrolic Double Winch No. 2', 1, 0, 0, 0, 0, 0),
(551, 'GSDI', 'Fruit Reception', '', 'FFB HorizontalConveyor', 1, 0, 0, 0, 0, 0),
(552, 'GSDI', 'Fruit Reception', '', 'FFB Cross Conveyor', 1, 0, 0, 0, 0, 0),
(553, 'GSDI', 'Fruit Reception', '', 'Hydraulic sliding FFB Cross', 1, 0, 0, 0, 0, 0),
(554, 'GSDI', 'Fruit Reception', '', 'Motor Distributing calig conveyor no. 1 line A', 1, 0, 0, 0, 0, 0),
(555, 'GSDI', 'Fruit Reception', '', 'Inklined screper calig line A', 1, 0, 0, 0, 0, 0),
(556, 'GSDI', 'Fruit Reception', '', 'Inklined conveor calic line A', 1, 0, 0, 0, 0, 0),
(557, 'GSDI', 'Fruit Reception', '', 'Distribusi conveyor calig line B', 1, 0, 0, 0, 0, 0),
(558, 'GSDI', 'Fruit Reception', '', 'Power pack winch atas', 1, 0, 0, 0, 0, 0),
(559, 'GSDI', 'Fruit Reception', '', 'Singgle Winch no 3', 1, 0, 0, 0, 0, 0),
(560, 'GSDI', 'Fruit Reception', '', 'Singgle Winch 5 / undertow', 1, 0, 0, 0, 0, 0),
(561, 'GSDI', 'Fruit Reception', '', 'Singgle Winch 6', 1, 0, 0, 0, 0, 0),
(562, 'GSDI', 'Fruit Reception', '', 'Condensat Pump No. 2', 1, 0, 0, 0, 0, 0),
(563, 'GSDI', 'Fruit Reception', '', 'Condensat Pump No. 1', 1, 0, 0, 0, 0, 0),
(564, 'GSDI', 'Fruit Reception', '', 'Condensat Pump No. 3', 1, 0, 0, 0, 0, 0),
(565, 'GSDI', 'Fruit Reception', '', 'Power pack cantilever no. 1 &amp; 2', 1, 0, 0, 0, 0, 0),
(566, 'GSDI', 'Fruit Reception', '', 'Power pack cantilever no. 3 &amp; 4', 1, 0, 0, 0, 0, 0),
(567, 'GSDI', 'Fruit Reception', '', 'Drainase sterililzer pump', 1, 0, 0, 0, 0, 0),
(568, 'GSDI', 'Fruit Reception', '', 'Air compressor sterilizer', 1, 0, 0, 0, 0, 0),
(569, 'GSDI', 'Fruit Reception', '', 'Bang dong Cagemen', 1, 0, 0, 0, 0, 0),
(570, 'GSDI', 'Fruit Reception', '', 'Indekser ', 1, 0, 0, 0, 0, 0),
(571, 'GSDI', 'Fruit Reception', '', 'Singgle Winch no 4', 1, 0, 0, 0, 0, 0),
(572, 'GSDI', 'Fruit Reception', '', 'Bangdong  L/R ', 1, 0, 0, 0, 0, 0),
(573, 'GSDI', 'Fruit Reception', '', 'Motor Distributing calig conveyor no. 2 line A', 1, 0, 0, 0, 0, 0),
(645, 'GSDI', 'Bunch Press', '', 'Distributing bunch press no. 1', 0, 0, 0, 0, 0, 0),
(646, 'GSDI', 'Bunch Press', '', 'Distributing bunch press no. 2', 0, 0, 0, 0, 0, 0),
(647, 'GSDI', 'Bunch Press', '', 'Bunch Press no. 1', 1, 0, 0, 1, 0, 0),
(648, 'GSDI', 'Bunch Press', '', 'Bunch Press no. 2', 1, 0, 0, 1, 0, 0),
(649, 'GSDI', 'Bunch Press', '', 'Bunch Press no. 3', 1, 0, 0, 1, 0, 0),
(650, 'GSDI', 'Bunch Press', '', 'Bunch Press no. 4', 1, 0, 0, 1, 0, 0),
(651, 'GSDI', 'Bunch Press', '', 'Bunch Press no. 5', 1, 0, 0, 1, 0, 0),
(652, 'GSDI', 'Bunch Press', '', 'Power pack bunch press no. 2', 0, 0, 0, 0, 0, 0),
(653, 'GSDI', 'Bunch Press', '', 'Power pack bunch press no. 3', 0, 0, 0, 0, 0, 0),
(654, 'GSDI', 'Bunch Press', '', 'Power pack bunch press no. 4', 0, 0, 0, 0, 0, 0),
(655, 'GSDI', 'Bunch Press', '', 'Power pack bunch press no. 5', 0, 0, 0, 0, 0, 0),
(656, 'GSDI', 'Bunch Press', '', 'Distributing bunch shreder', 0, 0, 0, 0, 0, 0),
(657, 'GSDI', 'Bunch Press', '', 'Bunch shreder no. 1', 0, 0, 0, 0, 0, 0),
(658, 'GSDI', 'Bunch Press', '', 'Bunch shreder no. 2', 0, 0, 0, 0, 0, 0),
(659, 'GSDI', 'Bunch Press', '', 'Bunch shreder no. 3', 0, 0, 0, 0, 0, 0),
(660, 'GSDI', 'Bunch Press', '', 'Bunch shreder no. 4', 0, 0, 0, 0, 0, 0),
(661, 'GSDI', 'Bunch Press', '', 'Bunch shreder no. 5', 0, 0, 0, 0, 0, 0),
(662, 'GSDI', 'Bunch Press', '', 'Bunch shreder no. 6', 0, 0, 0, 0, 0, 0),
(663, 'GSDI', 'Bunch Press', '', 'Oil Bunch Press Pump', 0, 0, 0, 0, 0, 0),
(664, 'GSDI', 'Bunch Press', '', 'Vibrating bunch press', 0, 0, 0, 0, 0, 0),
(736, 'GSDI', 'Pressing', '', 'Inclined Fruit Scraper Conveyor', 0, 0, 0, 0, 0, 0),
(737, 'GSDI', 'Pressing', '', 'Top Cross Conveyor', 0, 0, 0, 0, 0, 0),
(738, 'GSDI', 'Pressing', '', 'Fruit Distributing Conveyor', 0, 0, 0, 0, 0, 0),
(739, 'GSDI', 'Pressing', '', 'Digester No. 1', 0, 0, 0, 0, 0, 0),
(740, 'GSDI', 'Pressing', '', 'Digester No. 2', 0, 0, 0, 0, 0, 0),
(741, 'GSDI', 'Pressing', '', 'Digester No. 3', 0, 0, 0, 0, 0, 0),
(742, 'GSDI', 'Pressing', '', 'Digester No. 4', 0, 0, 0, 0, 0, 0),
(743, 'GSDI', 'Pressing', '', 'Digester No. 5', 0, 0, 0, 0, 0, 0),
(744, 'GSDI', 'Pressing', '', 'Digester No. 6', 0, 0, 0, 0, 0, 0),
(745, 'GSDI', 'Pressing', '', 'Screw Press No. 1', 1, 0, 1, 0, 0, 0),
(746, 'GSDI', 'Pressing', '', 'Screw Press No. 2', 1, 0, 1, 0, 0, 0),
(747, 'GSDI', 'Pressing', '', 'Screw Press No. 3', 1, 0, 1, 0, 0, 0),
(748, 'GSDI', 'Pressing', '', 'Screw Press No. 4', 1, 0, 1, 0, 0, 0),
(749, 'GSDI', 'Pressing', '', 'Screw Press No. 5', 1, 0, 1, 0, 0, 0),
(750, 'GSDI', 'Pressing', '', 'Screw Press No. 6', 1, 0, 1, 0, 0, 0),
(751, 'GSDI', 'Pressing', '', 'Power Pack Hydraulic Press No. 1 ', 0, 0, 0, 0, 0, 0),
(752, 'GSDI', 'Pressing', '', 'Power Pack Hydraulic Press No. 2', 0, 0, 0, 0, 0, 0),
(753, 'GSDI', 'Pressing', '', 'Power Pack Hydraulic Press No. 3', 0, 0, 0, 0, 0, 0),
(754, 'GSDI', 'Pressing', '', 'Power Pack Hydraulic Press No. 4', 0, 0, 0, 0, 0, 0),
(755, 'GSDI', 'Pressing', '', 'Power Pack Hydraulic Press No. 5', 0, 0, 0, 0, 0, 0),
(756, 'GSDI', 'Pressing', '', 'Power Pack Hydraulic Press No. 6', 0, 0, 0, 0, 0, 0),
(757, 'GSDI', 'Pressing', '', 'CBC line A', 0, 0, 0, 0, 0, 0),
(758, 'GSDI', 'Pressing', '', 'CBC line B', 0, 0, 0, 0, 0, 0),
(759, 'GSDI', 'Pressing', '', 'Under sandtrap conveyor no. 1', 0, 0, 0, 0, 0, 0),
(760, 'GSDI', 'Pressing', '', 'Under sandtrap conveyor no. 2', 0, 0, 0, 0, 0, 0),
(761, 'GSDI', 'Pressing', '', 'Fibrecyclone fan line A', 0, 0, 0, 0, 0, 0),
(762, 'GSDI', 'Pressing', '', 'Fibrecyclone fan line B', 0, 0, 0, 0, 0, 0),
(763, 'GSDI', 'Pressing', '', 'Air lock fibrecyclone line A', 0, 0, 0, 0, 0, 0),
(764, 'GSDI', 'Pressing', '', 'Air lock fibrecyclone line B', 0, 0, 0, 0, 0, 0),
(765, 'GSDI', 'Pressing', '', 'Nut Polishing Drum  A', 0, 0, 0, 0, 0, 0),
(766, 'GSDI', 'Pressing', '', 'Nut Polishing Drum  B', 0, 0, 0, 0, 0, 0),
(890, 'GSDI', 'Kernel Line A', '', 'Distributing inclined nut conv ', 0, 0, 0, 0, 0, 0),
(891, 'GSDI', 'Kernel Line A', '', 'Inclined Nut Conveyor  ', 0, 0, 0, 0, 0, 0),
(892, 'GSDI', 'Kernel Line A', '', 'Destoner fan ', 0, 0, 0, 0, 0, 0),
(893, 'GSDI', 'Kernel Line A', '', 'Air lock no. 1 Destoner ', 0, 0, 0, 0, 0, 0),
(894, 'GSDI', 'Kernel Line A', '', 'Air lock no. 2 Destoner ', 0, 0, 0, 0, 0, 0),
(895, 'GSDI', 'Kernel Line A', '', 'Vibrating Trought ', 0, 0, 0, 0, 0, 0),
(896, 'GSDI', 'Kernel Line A', '', 'Riple mill No. 1', 0, 0, 0, 0, 0, 0),
(897, 'GSDI', 'Kernel Line A', '', 'Riple mill No. 2', 0, 0, 0, 0, 0, 0),
(898, 'GSDI', 'Kernel Line A', '', 'CM Conveyor line A', 0, 0, 0, 0, 0, 0),
(899, 'GSDI', 'Kernel Line A', '', 'CM Elevator 1', 0, 0, 0, 0, 0, 0),
(900, 'GSDI', 'Kernel Line A', '', 'LTDS 1 Fan ', 0, 0, 0, 0, 0, 0),
(901, 'GSDI', 'Kernel Line A', '', 'LTDS 2 Fan ', 0, 0, 0, 0, 0, 0),
(902, 'GSDI', 'Kernel Line A', '', 'Air lock no. 1 LTDS 1 ', 0, 0, 0, 0, 0, 0),
(903, 'GSDI', 'Kernel Line A', '', 'Air lock no. 2 LTDS 1 ', 0, 0, 0, 0, 0, 0),
(904, 'GSDI', 'Kernel Line A', '', 'Air lock LTDS 2 ', 0, 0, 0, 0, 0, 0),
(905, 'GSDI', 'Kernel Line A', '', 'Vibratory feeder riple mill 1', 0, 0, 0, 0, 0, 0),
(906, 'GSDI', 'Kernel Line A', '', 'Vibratory feeder riple mill 2', 0, 0, 0, 0, 0, 0),
(907, 'GSDI', 'Kernel Line A', '', 'Wet Kernel Conveyor ', 0, 0, 0, 0, 0, 0),
(908, 'GSDI', 'Kernel Line A', '', 'Wet Shell Conveyor ', 0, 0, 0, 0, 0, 0),
(909, 'GSDI', 'Kernel Line A', '', 'Air lock CM elevator ', 0, 0, 0, 0, 0, 0),
(910, 'GSDI', 'Kernel Line A', '', 'Hydrocyclone Kernel pump A', 1, 0, 0, 0, 1, 0),
(911, 'GSDI', 'Kernel Line A', '', 'Hydrocyclone Shell pump A', 1, 0, 0, 0, 1, 0),
(912, 'GSDI', 'Kernel Line A', '', 'Washing drump Hydrocyclone ', 0, 0, 0, 0, 0, 0),
(913, 'GSDI', 'Kernel Line A', '', 'Wet Shell Elevator ', 0, 0, 0, 0, 0, 0),
(914, 'GSDI', 'Kernel Line A', '', 'Wet Kernel Elevator ', 0, 0, 0, 0, 0, 0),
(915, 'GSDI', 'Kernel Line A', '', 'Distributing Silo Conveyor 1', 0, 0, 0, 0, 0, 0),
(916, 'GSDI', 'Kernel Line A', '', 'Distributing Silo Conveyor 2', 0, 0, 0, 0, 0, 0),
(917, 'GSDI', 'Kernel Line A', '', 'Fan Dryer Silo 3', 0, 0, 0, 0, 0, 0),
(918, 'GSDI', 'Kernel Line A', '', 'Fan Dryer Silo 4', 0, 0, 0, 0, 0, 0),
(919, 'GSDI', 'Kernel Line A', '', 'Fan Dryer Silo 5', 0, 0, 0, 0, 0, 0),
(920, 'GSDI', 'Kernel Line A', '', 'Fan Dryer Silo 6', 0, 0, 0, 0, 0, 0),
(921, 'GSDI', 'Kernel Line A', '', 'Winowing fan', 0, 0, 0, 0, 0, 0),
(922, 'GSDI', 'Kernel Line A', '', 'Air lock winowing fan', 0, 0, 0, 0, 0, 0),
(923, 'GSDI', 'Kernel Line A', '', 'Under Silo Kernel 1', 0, 0, 0, 0, 0, 0),
(924, 'GSDI', 'Kernel Line A', '', 'Under Silo Kernel 2', 0, 0, 0, 0, 0, 0),
(925, 'GSDI', 'Kernel Line A', '', 'Kompresor', 0, 0, 0, 0, 0, 0),
(926, 'GSDI', 'Kernel Line A', '', 'Dustributing nut hopper conv.', 0, 0, 0, 0, 0, 0),
(927, 'GSDI', 'Kernel Line B', '', 'Distributing inclined nut conv ', 0, 0, 0, 0, 0, 0),
(928, 'GSDI', 'Kernel Line B', '', 'Inclined Nut Conveyor  2', 0, 0, 0, 0, 0, 0),
(929, 'GSDI', 'Kernel Line B', '', 'Destoner fan ', 0, 0, 0, 0, 0, 0),
(930, 'GSDI', 'Kernel Line B', '', 'Air lock no. 1 Destoner ', 0, 0, 0, 0, 0, 0),
(931, 'GSDI', 'Kernel Line B', '', 'Air lock no. 2 Destoner line B', 0, 0, 0, 0, 0, 0),
(932, 'GSDI', 'Kernel Line B', '', 'Vibrating Trought ', 0, 0, 0, 0, 0, 0),
(933, 'GSDI', 'Kernel Line B', '', 'Riple mill No. 3', 0, 0, 0, 0, 0, 0),
(934, 'GSDI', 'Kernel Line B', '', 'Riple mill No. 4', 0, 0, 0, 0, 0, 0),
(935, 'GSDI', 'Kernel Line B', '', 'CM Conveyor ', 0, 0, 0, 0, 0, 0),
(936, 'GSDI', 'Kernel Line B', '', 'CM Elevator ', 0, 0, 0, 0, 0, 0),
(937, 'GSDI', 'Kernel Line B', '', 'LTDS 1 Fan ', 0, 0, 0, 0, 0, 0),
(938, 'GSDI', 'Kernel Line B', '', 'LTDS 2 Fan ', 0, 0, 0, 0, 0, 0),
(939, 'GSDI', 'Kernel Line B', '', 'Air lock no. 1 LTDS 1 ', 0, 0, 0, 0, 0, 0),
(940, 'GSDI', 'Kernel Line B', '', 'Air lock no. 2 LTDS 1 ', 0, 0, 0, 0, 0, 0),
(941, 'GSDI', 'Kernel Line B', '', 'Air lock LTDS 2 ', 0, 0, 0, 0, 0, 0),
(942, 'GSDI', 'Kernel Line B', '', 'Vibratory feeder riple miil no 3', 0, 0, 0, 0, 0, 0),
(943, 'GSDI', 'Kernel Line B', '', 'Vibratory feeder riple miil no 4', 0, 0, 0, 0, 0, 0),
(944, 'GSDI', 'Kernel Line B', '', 'Wet Kernel Conveyor ', 0, 0, 0, 0, 0, 0),
(945, 'GSDI', 'Kernel Line B', '', 'Wet Shell Conveyor ', 0, 0, 0, 0, 0, 0),
(946, 'GSDI', 'Kernel Line B', '', 'Air lock CM elevator ', 0, 0, 0, 0, 0, 0),
(947, 'GSDI', 'Kernel Line B', '', 'Hydrocyclone Shell Pump B', 1, 0, 0, 0, 1, 0),
(948, 'GSDI', 'Kernel Line B', '', 'Hydrocyclone Kernel Pump B', 1, 0, 0, 0, 1, 0),
(949, 'GSDI', 'Kernel Line B', '', 'Washing drump Hydrocyclone ', 0, 0, 0, 0, 0, 0),
(950, 'GSDI', 'Kernel Line B', '', 'Wet Shell Elevator ', 0, 0, 0, 0, 0, 0),
(951, 'GSDI', 'Kernel Line B', '', 'Wet Kernel Elevator ', 0, 0, 0, 0, 0, 0),
(952, 'GSDI', 'Kernel Line B', '', 'Distributing Silo Conveyor 2', 0, 0, 0, 0, 0, 0),
(953, 'GSDI', 'Kernel Line B', '', 'Fan Dryer Silo 1', 0, 0, 0, 0, 0, 0),
(954, 'GSDI', 'Kernel Line B', '', 'Fan Dryer Silo 2', 0, 0, 0, 0, 0, 0),
(955, 'GSDI', 'Kernel Line B', '', 'Ex Hydro cyclone pump', 0, 0, 0, 0, 0, 0),
(956, 'GSDI', 'Kernel Line B', '', 'Kernel bunker conveyor', 0, 0, 0, 0, 0, 0),
(957, 'GSDI', 'Kernel Line B', '', 'Under sheell hopper', 0, 0, 0, 0, 0, 0),
(958, 'GSDI', 'Kernel Line B', '', 'Riple mill no. 5', 0, 0, 0, 0, 0, 0),
(959, 'GSDI', 'Kernel Line B', '', 'Riple mill no. 6', 0, 0, 0, 0, 0, 0),
(960, 'GSDI', 'Kernel Line B', '', 'Distributing nut hopper conv.', 0, 0, 0, 0, 0, 0),
(961, 'GSDI', 'KCP', '', 'Kernel Feed Conveyor A', 0, 0, 0, 0, 0, 0),
(962, 'GSDI', 'KCP', '', 'Kernel Feed Conveyor B', 0, 0, 0, 0, 0, 0),
(963, 'GSDI', 'KCP', '', 'Kernel Intake Elevator', 0, 0, 0, 0, 0, 0),
(964, 'GSDI', 'KCP', '', 'Over heat Kernel Transfer Conveyor', 0, 0, 0, 0, 0, 0),
(965, 'GSDI', 'KCP', '', 'Kernel Distributing Coveyor', 0, 0, 0, 0, 0, 0),
(966, 'GSDI', 'KCP', '', '1st Oil Conveyor Under Expeller', 0, 0, 0, 0, 0, 0),
(967, 'GSDI', 'KCP', '', 'Cake Conveyor', 0, 0, 0, 0, 0, 0),
(968, 'GSDI', 'KCP', '', 'Cake Buckat Elevator', 0, 0, 0, 0, 0, 0),
(969, 'GSDI', 'KCP', '', 'Cake Cross Conveyor', 0, 0, 0, 0, 0, 0),
(970, 'GSDI', 'KCP', '', 'Residu Return Conveyor', 0, 0, 0, 0, 0, 0),
(971, 'GSDI', 'KCP', '', '2nd Oil Conveyor Under Expeller', 0, 0, 0, 0, 0, 0),
(972, 'GSDI', 'KCP', '', 'Cross Oil Conveyor', 0, 0, 0, 0, 0, 0),
(973, 'GSDI', 'KCP', '', 'Elevating Scoop', 0, 0, 0, 0, 0, 0),
(974, 'GSDI', 'KCP', '', 'Meal Conveyor', 0, 0, 0, 0, 0, 0),
(975, 'GSDI', 'KCP', '', 'Meal Elevator 1', 0, 0, 0, 0, 0, 0),
(976, 'GSDI', 'KCP', '', 'Meal Elevator 2', 0, 0, 0, 0, 0, 0),
(977, 'GSDI', 'KCP', '', 'Meal Distributing Conveyor', 0, 0, 0, 0, 0, 0),
(978, 'GSDI', 'KCP', '', 'Meal Transfer Conveyor', 0, 0, 0, 0, 0, 0),
(979, 'GSDI', 'KCP', '', 'Pressure Leaf Filter Pump A', 0, 0, 0, 0, 0, 0),
(980, 'GSDI', 'KCP', '', 'Pressure Leap Filter Pump B', 0, 0, 0, 0, 0, 0),
(981, 'GSDI', 'KCP', '', 'Cake Dist Conveyor', 0, 0, 0, 0, 0, 0),
(982, 'GSDI', 'KCP', '', 'Filtered Oil transfer Pump A', 0, 0, 0, 0, 0, 0),
(983, 'GSDI', 'KCP', '', 'Filtered Oil transfer Pump B', 0, 0, 0, 0, 0, 0),
(984, 'GSDI', 'KCP', '', 'Residu Return Conveyor no. 2', 0, 0, 0, 0, 0, 0),
(985, 'GSDI', 'KCP', '', 'Air Compresor', 0, 0, 0, 0, 0, 0),
(986, 'GSDI', 'KCP', '', 'Pressing 1 st No. 1', 1, 0, 0, 0, 0, 1),
(987, 'GSDI', 'KCP', '', 'Pressing 1 st No. 2', 1, 0, 0, 0, 0, 1),
(988, 'GSDI', 'KCP', '', 'Pressing 1 st No. 3', 1, 0, 0, 0, 0, 1),
(989, 'GSDI', 'KCP', '', 'Pressing 1 st No. 4', 1, 0, 0, 0, 0, 1),
(990, 'GSDI', 'KCP', '', 'Pressing 1 st No. 5', 1, 0, 0, 0, 0, 1),
(991, 'GSDI', 'KCP', '', 'Pressing 1 st No. 6', 1, 0, 0, 0, 0, 1),
(992, 'GSDI', 'KCP', '', 'Pressing 1 st No. 7', 1, 0, 0, 0, 0, 1),
(993, 'GSDI', 'KCP', '', '2nd Press No. 1 ', 1, 0, 0, 0, 0, 1),
(994, 'GSDI', 'KCP', '', '2nd Press No. 2', 1, 0, 0, 0, 0, 1),
(995, 'GSDI', 'KCP', '', '2nd Press No. 3', 1, 0, 0, 0, 0, 1),
(996, 'GSDI', 'KCP', '', '2nd Press No. 4', 1, 0, 0, 0, 0, 1),
(997, 'GSDI', 'KCP', '', '2nd Press No. 5', 1, 0, 0, 0, 0, 1),
(998, 'GSDI', 'KCP', '', '2nd Press No. 6', 1, 0, 0, 0, 0, 1),
(999, 'GSDI', 'KCP', '', 'Fan dryer 1st', 0, 0, 0, 0, 0, 0),
(1000, 'GSDI', 'KCP', '', 'Kernel bunker fan', 0, 0, 0, 0, 0, 0),
(1001, 'GSDI', 'KCP', '', 'Air lock kernel bunker fan', 0, 0, 0, 0, 0, 0),
(1002, 'GSDI', 'Despatch', '', 'Dispatch Pump CPO No. 1', 0, 0, 0, 0, 0, 0),
(1003, 'GSDI', 'Despatch', '', 'Dispatch Pump CPO No. 2', 0, 0, 0, 0, 0, 0),
(1004, 'GSDI', 'Despatch', '', 'Dispatch pump PKO no 1', 0, 0, 0, 0, 0, 0),
(1005, 'GSDI', 'Despatch', '', 'Dispatch pump PKO no 2', 0, 0, 0, 0, 0, 0),
(1006, 'BCL2', 'Feeding', '', 'Hopper 1', 0, 0, 0, 0, 0, 0),
(1007, 'BCL2', 'Feeding', '', 'Hopper 2', 0, 0, 0, 0, 0, 0),
(1008, 'BCL2', 'Feeding', '', 'Hopper 3', 0, 0, 0, 0, 0, 0),
(1009, 'BCL2', 'Feeding', '', 'Hopper 4', 0, 0, 0, 0, 0, 0),
(1010, 'BCL2', 'Feeding', '', 'Hopper 5', 0, 0, 0, 0, 0, 0),
(1011, 'BCL2', 'Feeding', '', 'Hopper 6', 0, 0, 0, 0, 0, 0),
(1012, 'BCL2', 'Feeding', '', 'Hopper 7', 0, 0, 0, 0, 0, 0),
(1041, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1042, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1043, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1044, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1045, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1046, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1047, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1048, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1049, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1050, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1051, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1052, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1053, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0),
(1054, 'SINP', 'Fruit Reception', '', '', 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_unit_elektrik`
--

CREATE TABLE IF NOT EXISTS `master_unit_elektrik` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `id_station` varchar(32) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `merk` varchar(64) NOT NULL,
  `kw` float NOT NULL,
  `class` varchar(2) NOT NULL,
  `starter` varchar(16) NOT NULL,
  `mccb` int(11) NOT NULL,
  `kontaktor_line` int(11) NOT NULL,
  `kontaktor_delta` int(11) NOT NULL,
  `kontaktor_star` int(11) NOT NULL,
  `kabel` float NOT NULL,
  `jumlah_kabel` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=933 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_unit_elektrik`
--

INSERT INTO `master_unit_elektrik` (`id`, `id_pabrik`, `id_station`, `unit`, `merk`, `kw`, `class`, `starter`, `mccb`, `kontaktor_line`, `kontaktor_delta`, `kontaktor_star`, `kabel`, `jumlah_kabel`) VALUES
(31, 'GSDI', 'Fruit Reception', 'Tipping dump line B', '', 11, '', 'DOL', 32, 32, 0, 0, 4, 1),
(32, 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', '', 11, '', 'DOL', 32, 50, 0, 0, 4, 1),
(33, 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', '', 0, '', 'DOL', 32, 20, 0, 0, 4, 1),
(34, 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', '', 7.5, '', 'Star-Delta', 75, 25, 25, 25, 4, 1),
(35, 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', '', 7.5, '', 'Star-Delta', 32, 20, 20, 20, 4, 1),
(36, 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 10, 1),
(37, 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', '', 22, '', 'Star-Delta', 100, 80, 50, 50, 10, 1),
(38, 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', '', 7.5, '', 'Star-Delta', 40, 32, 20, 20, 4, 1),
(39, 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', '', 7.5, '', 'Star-Delta', 25, 25, 25, 25, 4, 1),
(40, 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', '', 0, '', '', 0, 0, 0, 0, 0, 0),
(41, 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', '', 5.5, '', 'DOL', 16, 20, 0, 0, 4, 1),
(42, 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', '', 7.5, '', 'DOL', 32, 20, 0, 0, 4, 1),
(43, 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', '', 5.5, '', 'DOL', 32, 20, 0, 0, 4, 1),
(44, 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', '', 5.5, '', 'DOL', 30, 20, 0, 0, 4, 1),
(45, 'GSDI', 'Fruit Reception', 'Power pack winch atas', '', 22, '', 'Star-Delta', 75, 50, 32, 32, 6, 1),
(46, 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', '', 22, '', 'Star-Delta', 100, 50, 80, 80, 10, 1),
(47, 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', '', 18.5, '', 'Star-Delta', 100, 50, 50, 50, 10, 1),
(48, 'GSDI', 'Fruit Reception', 'Singgle Winch 6', '', 0, '', '', 0, 0, 0, 0, 0, 0),
(49, 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', '', 22, '', 'Star-Delta', 50, 50, 20, 20, 4, 1),
(50, 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', '', 18.5, '', 'Star-Delta', 50, 50, 20, 20, 4, 1),
(51, 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 4, 1),
(52, 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', '', 5.5, '', 'DOL', 16, 20, 0, 0, 4, 1),
(53, 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', '', 5.5, '', 'DOL', 16, 20, 0, 0, 4, 1),
(54, 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', '', 7.5, '', 'DOL', 40, 20, 0, 0, 4, 1),
(55, 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', '', 7.5, '', 'DOL', 50, 20, 0, 0, 4, 1),
(56, 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', '', 1.5, '', 'DOL', 32, 20, 0, 0, 1.5, 1),
(57, 'GSDI', 'Fruit Reception', 'Indekser ', '', 22, '', 'DOL', 100, 80, 0, 0, 6, 1),
(58, 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 25, 1),
(59, 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', '', 2.2, '', 'DOL', 16, 25, 0, 0, 4, 1),
(60, 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', '', 5.5, '', 'DOL', 32, 20, 0, 0, 4, 1),
(61, 'GSDI', 'Threshing', 'Power Pack Tipper No. 1', '', 11, '', 'Star-Delta', 100, 25, 25, 25, 4, 1),
(62, 'GSDI', 'Threshing', 'Sterilizer Bunch Conveyor', '', 22, '', 'Inverter', 80, 50, 0, 0, 6, 1),
(63, 'GSDI', 'Threshing', 'Distribusi Bunch Conveyor', '', 7.5, '', 'Star-Delta', 30, 50, 20, 20, 4, 1),
(64, 'GSDI', 'Threshing', 'Horizontal Empty Bunch Conveyor', '', 7.5, '', 'Star-Delta', 30, 50, 20, 20, 4, 1),
(65, 'GSDI', 'Threshing', 'Inclined Empty Bunch Conveyor', '', 7.5, '', 'Star-Delta', 40, 50, 20, 20, 4, 1),
(66, 'GSDI', 'Threshing', 'Thresher No. 4', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 16, 1),
(67, 'GSDI', 'Threshing', 'Thresher No. 2', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 16, 1),
(68, 'GSDI', 'Threshing', 'Thresher No. 3', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 16, 1),
(69, 'GSDI', 'Threshing', 'Thresher No. 1', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 16, 1),
(70, 'GSDI', 'Threshing', 'Bellow Thresher no. 1', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(71, 'GSDI', 'Threshing', 'Bellow Thresher no. 2', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(72, 'GSDI', 'Threshing', 'Bellow Thresher no. 3', '', 7.5, '', 'DOL', 16, 20, 0, 0, 4, 1),
(73, 'GSDI', 'Threshing', 'Bellow Thresher no. 4', '', 5.5, '', 'DOL', 30, 20, 0, 0, 4, 1),
(74, 'GSDI', 'Threshing', 'Re Treshing', '', 5.5, '', 'DOL', 32, 100, 0, 0, 2.5, 1),
(75, 'GSDI', 'Threshing', 'Bunch crusher', '', 15, '', 'Star-Delta', 30, 100, 50, 50, 2.5, 1),
(76, 'GSDI', 'Threshing', 'Bottom Cross Conveyor', '', 11, '', 'DOL', 40, 50, 0, 0, 4, 1),
(77, 'GSDI', 'Threshing', 'Auto feeder  ', '', 22, '', 'Inverter', 100, 0, 0, 0, 25, 1),
(78, 'GSDI', 'Threshing', 'Doble wins no 7 - 8', '', 22, '', 'Star-Delta', 100, 80, 80, 50, 10, 1),
(79, 'GSDI', 'Threshing', 'Transfer cariage 3', '', 7.5, '', 'Star-Delta', 75, 50, 25, 25, 4, 1),
(80, 'GSDI', 'Threshing', 'Transfer cariage 4', '', 7.5, '', 'Star-Delta', 75, 25, 25, 25, 4, 1),
(205, 'GSDI', 'Pressing', 'Inclined Fruit Scraper Conveyor', '', 22, '', 'Star-Delta', 50, 50, 50, 32, 4, 1),
(206, 'GSDI', 'Pressing', 'Top Cross Conveyor', '', 11, '', 'DOL', 50, 50, 0, 0, 4, 1),
(207, 'GSDI', 'Pressing', 'Fruit Distributing Conveyor', '', 15, '', 'DOL', 100, 100, 0, 0, 4, 1),
(208, 'GSDI', 'Pressing', 'Digester No. 1', '', 55, '', 'Star-Delta', 125, 80, 100, 80, 25, 1),
(209, 'GSDI', 'Pressing', 'Digester No. 2', '', 55, '', 'Star-Delta', 200, 135, 80, 50, 25, 1),
(210, 'GSDI', 'Pressing', 'Digester No. 3', '', 55, '', 'Star-Delta', 150, 150, 135, 80, 16, 1),
(211, 'GSDI', 'Pressing', 'Digester No. 4', '', 55, '', 'Star-Delta', 150, 80, 80, 50, 16, 1),
(212, 'GSDI', 'Pressing', 'Digester No. 5', '', 55, '', 'Star-Delta', 150, 80, 80, 50, 16, 1),
(213, 'GSDI', 'Pressing', 'Digester No. 6', '', 55, '', 'Star-Delta', 200, 80, 80, 50, 16, 1),
(214, 'GSDI', 'Pressing', 'Screw Press No. 1', '', 37, '', 'Inverter', 100, 0, 0, 0, 16, 1),
(215, 'GSDI', 'Pressing', 'Screw Press No. 2', '', 37, '', 'Inverter', 100, 0, 0, 0, 16, 1),
(216, 'GSDI', 'Pressing', 'Screw Press No. 3', '', 37, '', 'Inverter', 100, 0, 0, 0, 16, 1),
(217, 'GSDI', 'Pressing', 'Screw Press No. 4', '', 37, '', 'Inverter', 100, 0, 0, 0, 16, 1),
(218, 'GSDI', 'Pressing', 'Screw Press No. 5', '', 37, '', 'Inverter', 100, 0, 0, 0, 16, 1),
(219, 'GSDI', 'Pressing', 'Screw Press No. 6', '', 37, '', 'Inverter', 150, 0, 0, 0, 16, 1),
(220, 'GSDI', 'Pressing', 'Power Pack Hydraulic Press No. 1 ', '', 1.5, '', 'DOL', 16, 20, 0, 0, 1.5, 1),
(221, 'GSDI', 'Pressing', 'Power Pack Hydraulic Press No. 2', '', 1.5, '', 'DOL', 10, 20, 0, 0, 1.5, 1),
(222, 'GSDI', 'Pressing', 'Power Pack Hydraulic Press No. 3', '', 1.5, '', 'DOL', 16, 20, 0, 0, 1.5, 1),
(223, 'GSDI', 'Pressing', 'Power Pack Hydraulic Press No. 4', '', 1.5, '', 'DOL', 16, 20, 0, 0, 1.5, 1),
(224, 'GSDI', 'Pressing', 'Power Pack Hydraulic Press No. 5', '', 1.5, '', 'DOL', 16, 20, 0, 0, 1.5, 1),
(225, 'GSDI', 'Pressing', 'Power Pack Hydraulic Press No. 6', '', 1.5, '', 'DOL', 16, 20, 0, 0, 1.5, 1),
(226, 'GSDI', 'Pressing', 'CBC line A', '', 30, '', 'Star-Delta', 100, 50, 80, 32, 6, 1),
(227, 'GSDI', 'Pressing', 'CBC line B', '', 30, '', 'Star-Delta', 100, 50, 80, 32, 6, 1),
(228, 'GSDI', 'Pressing', 'Under sandtrap conveyor no. 1', '', 4, '', 'DOL', 30, 50, 0, 0, 2.5, 1),
(229, 'GSDI', 'Pressing', 'Under sandtrap conveyor no. 2', '', 3, '', 'DOL', 30, 50, 0, 0, 2.5, 1),
(230, 'GSDI', 'Pressing', 'Fibrecyclone fan line A', '', 45, '', 'Star-Delta', 150, 100, 100, 80, 25, 1),
(231, 'GSDI', 'Pressing', 'Fibrecyclone fan line B', '', 45, '', 'Star-Delta', 150, 100, 80, 100, 25, 1),
(232, 'GSDI', 'Pressing', 'Air lock fibrecyclone line A', '', 5.5, '', 'DOL', 16, 32, 0, 0, 4, 1),
(233, 'GSDI', 'Pressing', 'Air lock fibrecyclone line B', '', 5.5, '', 'DOL', 16, 32, 0, 0, 4, 1),
(234, 'GSDI', 'Pressing', 'Nut Polishing Drum  A', '', 7.5, '', 'DOL', 16, 32, 20, 20, 4, 1),
(235, 'GSDI', 'Pressing', 'Nut Polishing Drum  B', '', 7.5, '', 'DOL', 16, 20, 20, 20, 4, 1),
(384, 'GSDI', 'Kernel Line A', 'Distributing inclined nut conv ', '', 5.5, '', 'DOL', 40, 0, 0, 0, 4, 1),
(385, 'GSDI', 'Kernel Line A', 'Inclined Nut Conveyor  ', '', 2.2, '', 'DOL', 10, 0, 0, 0, 4, 1),
(386, 'GSDI', 'Kernel Line A', 'Destoner fan ', '', 37, '', 'Star-Delta', 125, 80, 80, 50, 16, 1),
(387, 'GSDI', 'Kernel Line A', 'Air lock no. 1 Destoner ', '', 0, '', 'DOL', 16, 0, 0, 0, 4, 1),
(388, 'GSDI', 'Kernel Line A', 'Air lock no. 2 Destoner ', '', 0, '', 'DOL', 16, 0, 0, 0, 4, 1),
(389, 'GSDI', 'Kernel Line A', 'Vibrating Trought ', '', 1.5, '', 'DOL', 10, 0, 0, 0, 4, 1),
(390, 'GSDI', 'Kernel Line A', 'Riple mill No. 1', '', 11, '', 'Star-Delta', 30, 50, 50, 20, 4, 1),
(391, 'GSDI', 'Kernel Line A', 'Riple mill No. 2', '', 11, '', 'Star-Delta', 30, 50, 20, 20, 4, 1),
(392, 'GSDI', 'Kernel Line A', 'CM Conveyor line A', '', 2.2, '', 'DOL', 10, 0, 0, 0, 4, 1),
(393, 'GSDI', 'Kernel Line A', 'CM Elevator 1', '', 2.2, '', 'DOL', 10, 0, 0, 0, 4, 1),
(394, 'GSDI', 'Kernel Line A', 'LTDS 1 Fan ', '', 30, '', 'Star-Delta', 160, 80, 80, 50, 10, 1),
(395, 'GSDI', 'Kernel Line A', 'LTDS 2 Fan ', '', 30, '', 'Star-Delta', 160, 100, 100, 65, 10, 1),
(396, 'GSDI', 'Kernel Line A', 'Air lock no. 1 LTDS 1 ', '', 0, '', 'DOL', 20, 0, 0, 0, 4, 1),
(397, 'GSDI', 'Kernel Line A', 'Air lock no. 2 LTDS 1 ', '', 1.5, '', 'DOL', 10, 0, 0, 0, 4, 1),
(398, 'GSDI', 'Kernel Line A', 'Air lock LTDS 2 ', '', 1.5, '', 'DOL', 10, 0, 0, 0, 4, 1),
(399, 'GSDI', 'Kernel Line A', 'Vibratory feeder riple mill 1', '', 0, '', '', 0, 0, 0, 0, 0, 1),
(400, 'GSDI', 'Kernel Line A', 'Vibratory feeder riple mill 2', '', 0, '', '', 0, 0, 0, 0, 0, 1),
(401, 'GSDI', 'Kernel Line A', 'Wet Kernel Conveyor ', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(402, 'GSDI', 'Kernel Line A', 'Wet Shell Conveyor ', '', 2.2, '', 'DOL', 16, 20, 0, 0, 4, 1),
(403, 'GSDI', 'Kernel Line A', 'Air lock CM elevator ', '', 1.5, '', 'DOL', 10, 20, 0, 0, 4, 1),
(404, 'GSDI', 'Kernel Line A', 'Hydrocyclone Kernel pump A', '', 30, '', 'Inverter', 100, 0, 0, 0, 0, 1),
(405, 'GSDI', 'Kernel Line A', 'Hydrocyclone Shell pump A', '', 30, '', 'Inverter', 100, 0, 0, 0, 0, 1),
(406, 'GSDI', 'Kernel Line A', 'Washing drump Hydrocyclone ', '', 2.2, '', 'DOL', 16, 20, 0, 0, 4, 1),
(407, 'GSDI', 'Kernel Line A', 'Wet Shell Elevator ', '', 0, '', 'DOL', 20, 20, 0, 0, 4, 1),
(408, 'GSDI', 'Kernel Line A', 'Wet Kernel Elevator ', '', 0, '', 'DOL', 20, 20, 0, 0, 4, 1),
(409, 'GSDI', 'Kernel Line A', 'Distributing Silo Conveyor 1', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(410, 'GSDI', 'Kernel Line A', 'Distributing Silo Conveyor 2', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(411, 'GSDI', 'Kernel Line A', 'Fan Dryer Silo 3', '', 15, '', 'Star-Delta', 60, 50, 20, 20, 6, 1),
(412, 'GSDI', 'Kernel Line A', 'Fan Dryer Silo 4', '', 15, '', 'Star-Delta', 60, 50, 50, 50, 6, 1),
(413, 'GSDI', 'Kernel Line A', 'Fan Dryer Silo 5', '', 15, '', 'Star-Delta', 100, 50, 50, 20, 6, 1),
(414, 'GSDI', 'Kernel Line A', 'Fan Dryer Silo 6', '', 15, '', 'Star-Delta', 150, 50, 50, 20, 6, 1),
(415, 'GSDI', 'Kernel Line A', 'Winowing fan', '', 37, '', 'Star-Delta', 160, 100, 100, 100, 10, 1),
(416, 'GSDI', 'Kernel Line A', 'Air lock winowing fan', '', 3, '', 'DOL', 10, 20, 0, 0, 4, 1),
(417, 'GSDI', 'Kernel Line A', 'Under Silo Kernel 1', '', 2.2, '', 'DOL', 16, 20, 0, 0, 4, 1),
(418, 'GSDI', 'Kernel Line A', 'Under Silo Kernel 2', '', 0, '', 'DOL', 10, 20, 0, 0, 4, 1),
(419, 'GSDI', 'Kernel Line A', 'Kompresor', '', 11, '', 'DOL', 30, 80, 0, 0, 4, 1),
(420, 'GSDI', 'Kernel Line A', 'Dustributing nut hopper conv.', '', 0, '', 'DOL', 10, 20, 0, 0, 4, 1),
(557, 'GSDI', 'Kernel Line B', 'Distributing inclined nut conv ', '', 5.5, '', 'DOL', 10, 50, 0, 0, 4, 1),
(558, 'GSDI', 'Kernel Line B', 'Inclined Nut Conveyor  2', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(559, 'GSDI', 'Kernel Line B', 'Destoner fan ', '', 37, '', 'Star-Delta', 125, 80, 80, 50, 16, 1),
(560, 'GSDI', 'Kernel Line B', 'Air lock no. 1 Destoner ', '', 0, '', 'DOL', 16, 20, 0, 0, 4, 1),
(561, 'GSDI', 'Kernel Line B', 'Air lock no. 2 Destoner line B', '', 0, '', 'DOL', 16, 20, 0, 0, 4, 1),
(562, 'GSDI', 'Kernel Line B', 'Vibrating Trought ', '', 1.5, '', 'DOL', 10, 20, 0, 0, 4, 1),
(563, 'GSDI', 'Kernel Line B', 'Riple mill No. 3', '', 11, '', 'DOL', 30, 80, 0, 0, 4, 1),
(564, 'GSDI', 'Kernel Line B', 'Riple mill No. 4', '', 11, '', 'Star-Delta', 30, 50, 50, 20, 4, 1),
(565, 'GSDI', 'Kernel Line B', 'CM Conveyor ', '', 0, '', 'DOL', 10, 20, 0, 0, 4, 1),
(566, 'GSDI', 'Kernel Line B', 'CM Elevator ', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(567, 'GSDI', 'Kernel Line B', 'LTDS 1 Fan ', '', 30, '', 'Star-Delta', 125, 80, 80, 50, 10, 1),
(568, 'GSDI', 'Kernel Line B', 'LTDS 2 Fan ', '', 30, '', 'Star-Delta', 125, 65, 80, 50, 10, 1),
(569, 'GSDI', 'Kernel Line B', 'Air lock no. 1 LTDS 1 ', '', 1.5, '', 'DOL', 20, 20, 0, 0, 4, 1),
(570, 'GSDI', 'Kernel Line B', 'Air lock no. 2 LTDS 1 ', '', 0, '', 'DOL', 10, 20, 0, 0, 4, 1),
(571, 'GSDI', 'Kernel Line B', 'Air lock LTDS 2 ', '', 1.5, '', 'DOL', 10, 20, 0, 0, 4, 1),
(572, 'GSDI', 'Kernel Line B', 'Vibratory feeder riple miil no 3', '', 0, '', '', 0, 0, 0, 0, 0, 1),
(573, 'GSDI', 'Kernel Line B', 'Vibratory feeder riple miil no 4', '', 0, '', '', 0, 0, 0, 0, 0, 1),
(574, 'GSDI', 'Kernel Line B', 'Wet Kernel Conveyor ', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(575, 'GSDI', 'Kernel Line B', 'Wet Shell Conveyor ', '', 0, '', 'DOL', 20, 20, 0, 0, 4, 1),
(576, 'GSDI', 'Kernel Line B', 'Air lock CM elevator ', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(577, 'GSDI', 'Kernel Line B', 'Hydrocyclone Shell Pump B', '', 30, '', 'Inverter', 100, 0, 0, 0, 4, 1),
(578, 'GSDI', 'Kernel Line B', 'Hydrocyclone Kernel Pump B', '', 30, '', 'Inverter', 100, 0, 0, 0, 4, 1),
(579, 'GSDI', 'Kernel Line B', 'Washing drump Hydrocyclone ', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(580, 'GSDI', 'Kernel Line B', 'Wet Shell Elevator ', '', 0, '', 'DOL', 16, 20, 0, 0, 4, 1),
(581, 'GSDI', 'Kernel Line B', 'Wet Kernel Elevator ', '', 0, '', 'DOL', 20, 20, 0, 0, 4, 1),
(582, 'GSDI', 'Kernel Line B', 'Distributing Silo Conveyor 2', '', 2.2, '', 'DOL', 50, 20, 0, 0, 4, 1),
(583, 'GSDI', 'Kernel Line B', 'Fan Dryer Silo 1', '', 15, '', 'Star-Delta', 60, 32, 32, 20, 6, 1),
(584, 'GSDI', 'Kernel Line B', 'Fan Dryer Silo 2', '', 15, '', 'Star-Delta', 60, 50, 50, 20, 6, 1),
(585, 'GSDI', 'Kernel Line B', 'Ex Hydro cyclone pump', '', 7.5, '', 'Star-Delta', 30, 20, 0, 0, 4, 1),
(586, 'GSDI', 'Kernel Line B', 'Kernel bunker conveyor', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(587, 'GSDI', 'Kernel Line B', 'Under sheell hopper', '', 0, '', '', 0, 0, 0, 0, 0, 1),
(588, 'GSDI', 'Kernel Line B', 'Riple mill no. 5', '', 11, '', 'Star-Delta', 30, 50, 50, 20, 4, 1),
(589, 'GSDI', 'Kernel Line B', 'Riple mill no. 6', '', 1.1, '', 'DOL', 50, 50, 0, 0, 4, 1),
(590, 'GSDI', 'Kernel Line B', 'Distributing nut hopper conv.', '', 1.5, '', 'DOL', 10, 20, 0, 0, 4, 1),
(876, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 1', '', 22, '', 'Star-Delta', 100, 80, 50, 50, 25, 1),
(877, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 2', '', 22, '', 'Inverter', 100, 0, 0, 0, 25, 1),
(878, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 3', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 25, 1),
(879, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 4', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 25, 1),
(880, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 5', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 25, 1),
(881, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 6', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 25, 1),
(882, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 7', '', 22, '', 'Star-Delta', 100, 50, 50, 80, 25, 1),
(883, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 8', '', 22, '', 'Star-Delta', 100, 50, 50, 50, 25, 1),
(884, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 9', '', 22, '', 'Inverter', 100, 0, 0, 0, 25, 1),
(885, 'GSDI', 'Klarifikasi', 'Sludge Sparator No. 10', '', 22, '', 'Star-Delta', 100, 100, 80, 50, 25, 1),
(886, 'GSDI', 'Klarifikasi', 'CO Pump No. 1', '', 18.5, '', 'Inverter', 100, 65, 0, 0, 4, 1),
(887, 'GSDI', 'Klarifikasi', 'CO Pump No. 2', '', 15, '', 'Inverter', 75, 50, 0, 0, 4, 1),
(888, 'GSDI', 'Klarifikasi', 'CO Pump No   3', '', 15, '', 'Inverter', 40, 80, 0, 0, 4, 1),
(889, 'GSDI', 'Klarifikasi', 'CCT Motor No. 1', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(890, 'GSDI', 'Klarifikasi', 'CCT Motor No. 2', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(891, 'GSDI', 'Klarifikasi', 'CCT Motor No. 3', '', 2.2, '', 'DOL', 10, 20, 0, 0, 4, 1),
(892, 'GSDI', 'Klarifikasi', 'Desanding Pump No. 1', '', 18.5, '', 'Star-Delta', 100, 80, 0, 0, 4, 1),
(893, 'GSDI', 'Klarifikasi', 'Desanding Pump No. 2', '', 22, '', 'Star-Delta', 100, 100, 0, 0, 4, 1),
(894, 'GSDI', 'Klarifikasi', 'Desanding Pump No. 3', '', 22, '', 'Star-Delta', 60, 50, 0, 0, 4, 1),
(895, 'GSDI', 'Klarifikasi', 'Brush Strainer No. 1', '', 0.25, '', 'DOL', 10, 0, 0, 0, 4, 1),
(896, 'GSDI', 'Klarifikasi', 'Brush Strainer No. 2', '', 0.25, '', 'DOL', 10, 0, 0, 0, 4, 1),
(897, 'GSDI', 'Klarifikasi', 'Brush Strainer No. 3', '', 0.25, '', 'DOL', 10, 0, 0, 0, 4, 1),
(898, 'GSDI', 'Klarifikasi', 'Brush Strainer No. 4', '', 0.25, '', 'DOL', 10, 0, 0, 0, 4, 1),
(899, 'GSDI', 'Klarifikasi', 'Brush Strainer No. 5', '', 0.25, '', 'DOL', 6, 0, 0, 0, 2.5, 1),
(900, 'GSDI', 'Klarifikasi', 'Tailing conveyor no 1', '', 0, '', 'DOL', 30, 0, 0, 0, 4, 1),
(901, 'GSDI', 'Klarifikasi', 'Tailing conveyor no 2', '', 0, '', 'DOL', 20, 0, 0, 0, 2.5, 1),
(902, 'GSDI', 'Klarifikasi', 'Hot Well Pump No.1', '', 0, '', 'DOL', 20, 0, 0, 0, 4, 1),
(903, 'GSDI', 'Klarifikasi', 'Hot Wel Pump No. 2', '', 0, '', 'DOL', 20, 0, 0, 0, 4, 1),
(904, 'GSDI', 'Klarifikasi', 'Furifier No. 1', '', 15, '', 'Star-Delta', 0, 0, 0, 0, 0, 1),
(905, 'GSDI', 'Klarifikasi', 'Furifier No. 2', '', 15, '', 'Star-Delta', 0, 0, 0, 0, 0, 1),
(906, 'GSDI', 'Klarifikasi', 'Furifier No. 3', '', 15, '', 'Star-Delta', 0, 0, 0, 0, 0, 1),
(907, 'GSDI', 'Klarifikasi', 'Feed Purifier no. 1', '', 4, '', 'DOL', 0, 0, 0, 0, 0, 1),
(908, 'GSDI', 'Klarifikasi', 'Feed Purifier no. 2', '', 4, '', 'DOL', 0, 0, 0, 0, 0, 1),
(909, 'GSDI', 'Klarifikasi', 'Feed Purifier no. 3', '', 4, '', 'DOL', 0, 0, 0, 0, 0, 1),
(910, 'GSDI', 'Klarifikasi', 'Waste Colection Pump', '', 7.5, '', 'DOL', 20, 20, 0, 0, 4, 1),
(911, 'GSDI', 'Klarifikasi', 'Recycle Oil Pump No. 1', '', 15, '', '', 0, 0, 0, 0, 0, 1),
(912, 'GSDI', 'Klarifikasi', 'Recycle Oil Pump No. 2', '', 22, '', '', 0, 0, 0, 0, 0, 1),
(913, 'GSDI', 'Klarifikasi', 'Vacum Oil Pump No. 1', '', 11, '', 'Star-Delta', 30, 50, 20, 20, 4, 1),
(914, 'GSDI', 'Klarifikasi', 'Vacum Oil Pump No. 2', '', 11, '', 'Star-Delta', 30, 20, 20, 20, 4, 1),
(915, 'GSDI', 'Klarifikasi', 'Sludge Pit Pump No. 1', '', 0, '', '', 0, 0, 0, 0, 0, 1),
(916, 'GSDI', 'Klarifikasi', 'Sludge Pit Pump No. 2', '', 0, '', 'Star-Delta', 30, 50, 32, 20, 4, 1),
(917, 'GSDI', 'Klarifikasi', 'Oil transfer pump no. 1', '', 11, '', 'Star-Delta', 30, 50, 20, 20, 4, 1),
(918, 'GSDI', 'Klarifikasi', 'Oil transfer pump no. 2', '', 11, '', 'Star-Delta', 30, 20, 20, 20, 4, 1),
(919, 'GSDI', 'Klarifikasi', 'Oil transfer pump no. 3', '', 11, '', 'Star-Delta', 0, 0, 0, 0, 0, 1),
(920, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 1', '', 1.85, '', 'DOL', 10, 20, 0, 0, 4, 1),
(921, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 2', '', 1.85, '', 'DOL', 10, 20, 0, 0, 4, 1),
(922, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 3', '', 1.85, '', 'DOL', 10, 20, 0, 0, 4, 1),
(923, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 4', '', 1.85, '', 'DOL', 10, 20, 0, 0, 4, 1),
(924, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 5', '', 1.85, '', 'DOL', 10, 20, 0, 0, 4, 1),
(925, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 6', '', 1.85, '', 'DOL', 10, 20, 0, 0, 4, 1),
(926, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 7', '', 1.85, '', 'DOL', 32, 20, 0, 0, 2.5, 1),
(927, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 8', '', 1.85, '', 'DOL', 32, 20, 0, 0, 4, 1),
(928, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 9', '', 1.85, '', 'DOL', 32, 20, 0, 0, 2.5, 1),
(929, 'GSDI', 'Klarifikasi', 'Vibrating Screen No. 10', '', 1.85, '', 'DOL', 32, 20, 0, 0, 4, 1),
(930, 'GSDI', 'Klarifikasi', 'Under setlink conveyor', '', 3, '', 'DOL', 16, 32, 0, 0, 2.5, 1),
(931, 'GSDI', 'Klarifikasi', 'Distribusi Under setlink conveyor', '', 4, '', 'DOL', 0, 0, 0, 0, 0, 1),
(932, 'GSDI', 'Klarifikasi', 'Air Compressor', '', 0, '', '', 0, 0, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_unit_mekanik`
--

CREATE TABLE IF NOT EXISTS `master_unit_mekanik` (
  `id_pabrik` varchar(8) NOT NULL,
  `id_station` varchar(32) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `merk_gearbox` varchar(64) NOT NULL,
  `kapasitas_gearbox` varchar(64) NOT NULL,
  `rasio_gearbox` varchar(64) NOT NULL,
  `type_gearbox` varchar(64) NOT NULL,
  `pulley_motor` varchar(64) NOT NULL,
  `pulley_driven` varchar(64) NOT NULL,
  `pulley_type` varchar(64) NOT NULL,
  `merk_pompa` varchar(64) NOT NULL,
  `type_pompa` varchar(64) NOT NULL,
  `kapasitas_pompa` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_unit_mekanik`
--

INSERT INTO `master_unit_mekanik` (`id_pabrik`, `id_station`, `unit`, `merk_gearbox`, `kapasitas_gearbox`, `rasio_gearbox`, `type_gearbox`, `pulley_motor`, `pulley_driven`, `pulley_type`, `merk_pompa`, `type_pompa`, `kapasitas_pompa`) VALUES
('GSDI', 'Boiler 1 & Softener', 'Undercyclone Conveyor', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Inclined Fibershell conveyor no. 1', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Fuel distributing conv. Boiler no. 3', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Excess recovery scraper coveyor no. 2', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Softener no. 1', '', '', '', '', '', '', '', 'KSB', 'positive suction', '40 tph'),
('GSDI', 'Boiler 1 & Softener', 'Softener no. 2', '', '', '', '', '', '', '', 'Torishima', 'negative suction', '30 tph'),
('GSDI', 'Boiler 1 & Softener', 'Dearator pump no. 1', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Dearator pump no. 2', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Dearator pump no. 3', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'BPV Feed pump ', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Feed Water Pump no. 1', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Feed Water Pump no. 2', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Feed Water Pump no. 3', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Thermal Dearator pump no. 2', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Inclined Fibershell conveyor no. 2', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Fuel distributing conv. Boiler no. 1.2', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Hydraulic power pack boiler ', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Ash Scraper conveyor ', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Thermal Dearator pump no. 1', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Dosing pump no. 1', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Dosing pump no. 2', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'IDF ', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'FDF ', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Secondary air fan', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'CAF / Air Duct', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Ash screw conveyor AT Drump', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Dust screw conveyor AT /DC', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Ash &amp; dust conveyor ', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Air lock ash hopper no. 1 ', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Air lock ash hopper no. 2', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Air lock Dust hopper', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Air lock no. 1 fuel feeder', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Air lock no. 2 fuel feeder', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Air lock no. 3 fuel feeder', '', '', '', '', '', '', '', '', '', ''),
('GSDI', 'Boiler 1 & Softener', 'Thermal dearator pump no. 3', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_acm`
--

CREATE TABLE IF NOT EXISTS `m_acm` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `acm` int(2) NOT NULL,
  `keterangan` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=453 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_acm`
--

INSERT INTO `m_acm` (`id`, `tanggal`, `id_pabrik`, `id_station`, `unit`, `acm`, `keterangan`) VALUES
(1, '2018-11-22', 'GSIP', 'Press', 'Press 1', 1, ''),
(2, '2018-11-22', 'GSIP', 'Press', 'Press 2', 0, ''),
(3, '2018-11-22', 'GSIP', 'Press', 'Press 3', 1, ''),
(4, '2018-11-22', 'GSIP', 'Press', 'Press 4', 0, ''),
(5, '2018-11-22', 'GSIP', 'Press', 'Press 5', 1, ''),
(6, '2018-11-22', 'GSIP', 'Press', 'Press 6', 0, ''),
(7, '2018-12-17', 'GSIP', 'Press', 'Press 1', 1, ''),
(8, '2018-12-17', 'GSIP', 'Press', 'Press 2', 1, ''),
(9, '2018-12-17', 'GSIP', 'Press', 'Press 3', 1, ''),
(10, '2018-12-17', 'GSIP', 'Press', 'Press 4', 1, ''),
(11, '2018-12-17', 'GSIP', 'Press', 'Press 5', 1, ''),
(12, '2018-12-17', 'GSIP', 'Press', 'Press 6', 0, 'screw patah'),
(103, '2018-12-20', 'GSDI', 'Fruit Reception', 'Tipping dump line B', 1, ''),
(104, '2018-12-20', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 1, ''),
(105, '2018-12-20', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', 1, ''),
(106, '2018-12-20', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', 1, ''),
(107, '2018-12-20', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', 1, ''),
(108, '2018-12-20', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', 1, ''),
(109, '2018-12-20', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', 1, ''),
(110, '2018-12-20', 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', 1, ''),
(111, '2018-12-20', 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', 1, ''),
(112, '2018-12-20', 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', 1, ''),
(113, '2018-12-20', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', 1, ''),
(114, '2018-12-20', 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', 1, ''),
(115, '2018-12-20', 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', 1, ''),
(116, '2018-12-20', 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', 1, ''),
(117, '2018-12-20', 'GSDI', 'Fruit Reception', 'Power pack winch atas', 1, ''),
(118, '2018-12-20', 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', 1, ''),
(119, '2018-12-20', 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', 1, ''),
(120, '2018-12-20', 'GSDI', 'Fruit Reception', 'Singgle Winch 6', 1, ''),
(121, '2018-12-20', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', 1, ''),
(122, '2018-12-20', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', 1, ''),
(123, '2018-12-20', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', 1, ''),
(124, '2018-12-20', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', 1, ''),
(125, '2018-12-20', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', 1, ''),
(126, '2018-12-20', 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', 1, ''),
(127, '2018-12-20', 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', 1, ''),
(128, '2018-12-20', 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', 1, ''),
(129, '2018-12-20', 'GSDI', 'Fruit Reception', 'Indekser ', 1, ''),
(130, '2018-12-20', 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', 1, ''),
(131, '2018-12-20', 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', 1, ''),
(132, '2018-12-20', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', 1, ''),
(133, '2018-12-21', 'GSDI', 'Fruit Reception', 'Tipping dump line B', 1, ''),
(134, '2018-12-21', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 0, ''),
(135, '2018-12-21', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', 0, ''),
(136, '2018-12-21', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', 0, ''),
(137, '2018-12-21', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', 0, ''),
(138, '2018-12-21', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', 0, ''),
(139, '2018-12-21', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', 0, ''),
(140, '2018-12-21', 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', 0, ''),
(141, '2018-12-21', 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', 0, ''),
(142, '2018-12-21', 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', 0, ''),
(143, '2018-12-21', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', 0, ''),
(144, '2018-12-21', 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', 0, ''),
(145, '2018-12-21', 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', 0, ''),
(146, '2018-12-21', 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', 0, ''),
(147, '2018-12-21', 'GSDI', 'Fruit Reception', 'Power pack winch atas', 0, ''),
(148, '2018-12-21', 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', 0, ''),
(149, '2018-12-21', 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', 0, ''),
(150, '2018-12-21', 'GSDI', 'Fruit Reception', 'Singgle Winch 6', 0, ''),
(151, '2018-12-21', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', 0, ''),
(152, '2018-12-21', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', 0, ''),
(153, '2018-12-21', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', 0, ''),
(154, '2018-12-21', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', 0, ''),
(155, '2018-12-21', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', 0, ''),
(156, '2018-12-21', 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', 0, ''),
(157, '2018-12-21', 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', 0, ''),
(158, '2018-12-21', 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', 0, ''),
(159, '2018-12-21', 'GSDI', 'Fruit Reception', 'Indekser ', 0, ''),
(160, '2018-12-21', 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', 0, ''),
(161, '2018-12-21', 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', 0, ''),
(162, '2018-12-21', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', 0, ''),
(163, '2018-12-18', 'GSDI', 'Fruit Reception', 'Tipping dump line B', 1, ''),
(164, '2018-12-18', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 0, ''),
(165, '2018-12-18', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', 0, ''),
(166, '2018-12-18', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', 0, ''),
(167, '2018-12-18', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', 0, ''),
(168, '2018-12-18', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', 0, ''),
(169, '2018-12-18', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', 0, ''),
(170, '2018-12-18', 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', 0, ''),
(171, '2018-12-18', 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', 0, ''),
(172, '2018-12-18', 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', 0, ''),
(173, '2018-12-18', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', 0, ''),
(174, '2018-12-18', 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', 0, ''),
(175, '2018-12-18', 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', 0, ''),
(176, '2018-12-18', 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', 0, ''),
(177, '2018-12-18', 'GSDI', 'Fruit Reception', 'Power pack winch atas', 0, ''),
(178, '2018-12-18', 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', 0, ''),
(179, '2018-12-18', 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', 0, ''),
(180, '2018-12-18', 'GSDI', 'Fruit Reception', 'Singgle Winch 6', 0, ''),
(181, '2018-12-18', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', 0, ''),
(182, '2018-12-18', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', 0, ''),
(183, '2018-12-18', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', 0, ''),
(184, '2018-12-18', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', 0, ''),
(185, '2018-12-18', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', 0, ''),
(186, '2018-12-18', 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', 0, ''),
(187, '2018-12-18', 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', 0, ''),
(188, '2018-12-18', 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', 0, ''),
(189, '2018-12-18', 'GSDI', 'Fruit Reception', 'Indekser ', 0, ''),
(190, '2018-12-18', 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', 0, ''),
(191, '2018-12-18', 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', 0, ''),
(192, '2018-12-18', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', 0, ''),
(193, '2018-12-19', 'GSDI', 'Fruit Reception', 'Tipping dump line B', 1, ''),
(194, '2018-12-19', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 0, ''),
(195, '2018-12-19', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', 0, ''),
(196, '2018-12-19', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', 0, ''),
(197, '2018-12-19', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', 0, ''),
(198, '2018-12-19', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', 0, ''),
(199, '2018-12-19', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', 0, ''),
(200, '2018-12-19', 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', 0, ''),
(201, '2018-12-19', 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', 0, ''),
(202, '2018-12-19', 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', 0, ''),
(203, '2018-12-19', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', 0, ''),
(204, '2018-12-19', 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', 0, ''),
(205, '2018-12-19', 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', 0, ''),
(206, '2018-12-19', 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', 0, ''),
(207, '2018-12-19', 'GSDI', 'Fruit Reception', 'Power pack winch atas', 0, ''),
(208, '2018-12-19', 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', 0, ''),
(209, '2018-12-19', 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', 0, ''),
(210, '2018-12-19', 'GSDI', 'Fruit Reception', 'Singgle Winch 6', 0, ''),
(211, '2018-12-19', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', 0, ''),
(212, '2018-12-19', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', 0, ''),
(213, '2018-12-19', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', 0, ''),
(214, '2018-12-19', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', 0, ''),
(215, '2018-12-19', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', 0, ''),
(216, '2018-12-19', 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', 0, ''),
(217, '2018-12-19', 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', 0, ''),
(218, '2018-12-19', 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', 0, ''),
(219, '2018-12-19', 'GSDI', 'Fruit Reception', 'Indekser ', 0, ''),
(220, '2018-12-19', 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', 0, ''),
(221, '2018-12-19', 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', 0, ''),
(222, '2018-12-19', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', 0, ''),
(223, '2019-01-12', 'GSDI', 'Fruit Reception', 'Tipping dump line B', 1, ''),
(224, '2019-01-12', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 1, ''),
(225, '2019-01-12', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', 1, ''),
(226, '2019-01-12', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', 1, ''),
(227, '2019-01-12', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', 1, ''),
(228, '2019-01-12', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', 1, ''),
(229, '2019-01-12', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', 1, ''),
(230, '2019-01-12', 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', 1, ''),
(231, '2019-01-12', 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', 1, ''),
(232, '2019-01-12', 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', 1, ''),
(233, '2019-01-12', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', 1, ''),
(234, '2019-01-12', 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', 1, ''),
(235, '2019-01-12', 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', 1, ''),
(236, '2019-01-12', 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', 1, ''),
(237, '2019-01-12', 'GSDI', 'Fruit Reception', 'Power pack winch atas', 1, ''),
(238, '2019-01-12', 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', 0, ''),
(239, '2019-01-12', 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', 0, ''),
(240, '2019-01-12', 'GSDI', 'Fruit Reception', 'Singgle Winch 6', 0, ''),
(241, '2019-01-12', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', 0, ''),
(242, '2019-01-12', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', 0, ''),
(243, '2019-01-12', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', 0, ''),
(244, '2019-01-12', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', 0, ''),
(245, '2019-01-12', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', 0, ''),
(246, '2019-01-12', 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', 0, ''),
(247, '2019-01-12', 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', 0, ''),
(248, '2019-01-12', 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', 0, ''),
(249, '2019-01-12', 'GSDI', 'Fruit Reception', 'Indekser ', 0, ''),
(250, '2019-01-12', 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', 0, ''),
(251, '2019-01-12', 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', 0, ''),
(252, '2019-01-12', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', 0, ''),
(253, '2019-01-12', 'GSDI', 'Threshing', 'Power Pack Tipper No. 1', 1, ''),
(254, '2019-01-12', 'GSDI', 'Threshing', 'Sterilizer Bunch Conveyor', 0, ''),
(255, '2019-01-12', 'GSDI', 'Threshing', 'Distribusi Bunch Conveyor', 0, ''),
(256, '2019-01-12', 'GSDI', 'Threshing', 'Horizontal Empty Bunch Conveyor', 0, ''),
(257, '2019-01-12', 'GSDI', 'Threshing', 'Inclined Empty Bunch Conveyor', 0, ''),
(258, '2019-01-12', 'GSDI', 'Threshing', 'Thresher No. 4', 0, ''),
(259, '2019-01-12', 'GSDI', 'Threshing', 'Thresher No. 2', 0, ''),
(260, '2019-01-12', 'GSDI', 'Threshing', 'Thresher No. 3', 0, ''),
(261, '2019-01-12', 'GSDI', 'Threshing', 'Thresher No. 1', 0, ''),
(262, '2019-01-12', 'GSDI', 'Threshing', 'Bellow Thresher no. 1', 0, ''),
(263, '2019-01-12', 'GSDI', 'Threshing', 'Bellow Thresher no. 2', 0, ''),
(264, '2019-01-12', 'GSDI', 'Threshing', 'Bellow Thresher no. 3', 0, ''),
(265, '2019-01-12', 'GSDI', 'Threshing', 'Bellow Thresher no. 4', 0, ''),
(266, '2019-01-12', 'GSDI', 'Threshing', 'Re Treshing', 0, ''),
(267, '2019-01-12', 'GSDI', 'Threshing', 'Bunch crusher', 0, ''),
(268, '2019-01-12', 'GSDI', 'Threshing', 'Bottom Cross Conveyor', 0, ''),
(269, '2019-01-12', 'GSDI', 'Threshing', 'Auto feeder  ', 0, ''),
(270, '2019-01-12', 'GSDI', 'Threshing', 'Doble wins no 7 - 8', 0, ''),
(271, '2019-01-12', 'GSDI', 'Threshing', 'Transfer cariage 3', 0, ''),
(272, '2019-01-12', 'GSDI', 'Threshing', 'Transfer cariage 4', 0, ''),
(273, '2019-01-16', 'GSDI', 'Fruit Reception', 'Tipping dump line B', 1, ''),
(274, '2019-01-16', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 1, ''),
(275, '2019-01-16', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', 1, ''),
(276, '2019-01-16', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', 1, ''),
(277, '2019-01-16', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', 1, ''),
(278, '2019-01-16', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', 1, ''),
(279, '2019-01-16', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', 1, ''),
(280, '2019-01-16', 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', 1, ''),
(281, '2019-01-16', 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', 1, ''),
(282, '2019-01-16', 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', 1, ''),
(283, '2019-01-16', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', 1, ''),
(284, '2019-01-16', 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', 1, ''),
(285, '2019-01-16', 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', 1, ''),
(286, '2019-01-16', 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', 1, ''),
(287, '2019-01-16', 'GSDI', 'Fruit Reception', 'Power pack winch atas', 1, ''),
(288, '2019-01-16', 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', 1, ''),
(289, '2019-01-16', 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', 1, ''),
(290, '2019-01-16', 'GSDI', 'Fruit Reception', 'Singgle Winch 6', 1, ''),
(291, '2019-01-16', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', 1, ''),
(292, '2019-01-16', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', 1, ''),
(293, '2019-01-16', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', 1, ''),
(294, '2019-01-16', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', 1, ''),
(295, '2019-01-16', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', 1, ''),
(296, '2019-01-16', 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', 1, ''),
(297, '2019-01-16', 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', 0, 'sering trip'),
(298, '2019-01-16', 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', 1, ''),
(299, '2019-01-16', 'GSDI', 'Fruit Reception', 'Indekser ', 1, ''),
(300, '2019-01-16', 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', 1, ''),
(301, '2019-01-16', 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', 1, ''),
(302, '2019-01-16', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', 1, ''),
(333, '2019-01-24', 'GSDI', 'Fruit Reception', 'Tipping dump line B', 1, ''),
(334, '2019-01-24', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 1, ''),
(335, '2019-01-24', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', 1, ''),
(336, '2019-01-24', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', 1, ''),
(337, '2019-01-24', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', 1, ''),
(338, '2019-01-24', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', 1, ''),
(339, '2019-01-24', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', 1, ''),
(340, '2019-01-24', 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', 1, ''),
(341, '2019-01-24', 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', 1, ''),
(342, '2019-01-24', 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', 1, ''),
(343, '2019-01-24', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', 1, ''),
(344, '2019-01-24', 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', 1, ''),
(345, '2019-01-24', 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', 1, ''),
(346, '2019-01-24', 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', 1, ''),
(347, '2019-01-24', 'GSDI', 'Fruit Reception', 'Power pack winch atas', 1, ''),
(348, '2019-01-24', 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', 1, ''),
(349, '2019-01-24', 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', 1, ''),
(350, '2019-01-24', 'GSDI', 'Fruit Reception', 'Singgle Winch 6', 1, ''),
(351, '2019-01-24', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', 1, ''),
(352, '2019-01-24', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', 1, ''),
(353, '2019-01-24', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', 1, ''),
(354, '2019-01-24', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', 1, ''),
(355, '2019-01-24', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', 1, ''),
(356, '2019-01-24', 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', 1, ''),
(357, '2019-01-24', 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', 1, ''),
(358, '2019-01-24', 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', 1, ''),
(359, '2019-01-24', 'GSDI', 'Fruit Reception', 'Indekser ', 1, ''),
(360, '2019-01-24', 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', 1, ''),
(361, '2019-01-24', 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', 1, ''),
(362, '2019-01-24', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', 1, ''),
(423, '2019-03-12', 'GSDI', 'Fruit Reception', 'Tipping dump line B', 1, 'hidrolik bocor'),
(424, '2019-03-12', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R line A', 0, 'motor terbakar'),
(425, '2019-03-12', 'GSDI', 'Fruit Reception', 'Motor Power Pack L/R   line B', 1, ''),
(426, '2019-03-12', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage I', 1, ''),
(427, '2019-03-12', 'GSDI', 'Fruit Reception', 'Motor Transfer Carryage II', 1, ''),
(428, '2019-03-12', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 1', 1, ''),
(429, '2019-03-12', 'GSDI', 'Fruit Reception', 'Motor Hydrolic Double Winch No. 2', 1, ''),
(430, '2019-03-12', 'GSDI', 'Fruit Reception', 'FFB HorizontalConveyor', 1, ''),
(431, '2019-03-12', 'GSDI', 'Fruit Reception', 'FFB Cross Conveyor', 1, ''),
(432, '2019-03-12', 'GSDI', 'Fruit Reception', 'Hydraulic sliding FFB Cross', 1, ''),
(433, '2019-03-12', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 1 line A', 1, ''),
(434, '2019-03-12', 'GSDI', 'Fruit Reception', 'Inklined screper calig line A', 1, ''),
(435, '2019-03-12', 'GSDI', 'Fruit Reception', 'Inklined conveor calic line A', 1, ''),
(436, '2019-03-12', 'GSDI', 'Fruit Reception', 'Distribusi conveyor calig line B', 1, ''),
(437, '2019-03-12', 'GSDI', 'Fruit Reception', 'Power pack winch atas', 1, ''),
(438, '2019-03-12', 'GSDI', 'Fruit Reception', 'Singgle Winch no 3', 1, ''),
(439, '2019-03-12', 'GSDI', 'Fruit Reception', 'Singgle Winch 5 / undertow', 1, ''),
(440, '2019-03-12', 'GSDI', 'Fruit Reception', 'Singgle Winch 6', 1, ''),
(441, '2019-03-12', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 2', 1, ''),
(442, '2019-03-12', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 1', 1, ''),
(443, '2019-03-12', 'GSDI', 'Fruit Reception', 'Condensat Pump No. 3', 1, ''),
(444, '2019-03-12', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 1 &amp; 2', 1, ''),
(445, '2019-03-12', 'GSDI', 'Fruit Reception', 'Power pack cantilever no. 3 &amp; 4', 1, ''),
(446, '2019-03-12', 'GSDI', 'Fruit Reception', 'Drainase sterililzer pump', 1, ''),
(447, '2019-03-12', 'GSDI', 'Fruit Reception', 'Air compressor sterilizer', 1, ''),
(448, '2019-03-12', 'GSDI', 'Fruit Reception', 'Bang dong Cagemen', 1, ''),
(449, '2019-03-12', 'GSDI', 'Fruit Reception', 'Indekser ', 1, ''),
(450, '2019-03-12', 'GSDI', 'Fruit Reception', 'Singgle Winch no 4', 1, ''),
(451, '2019-03-12', 'GSDI', 'Fruit Reception', 'Bangdong  L/R ', 1, ''),
(452, '2019-03-12', 'GSDI', 'Fruit Reception', 'Motor Distributing calig conveyor no. 2 line A', 1, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_activity`
--

CREATE TABLE IF NOT EXISTS `m_activity` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `no_wo` varchar(64) NOT NULL,
  `tanggal` date NOT NULL,
  `perbaikan` varchar(160) NOT NULL,
  `jenis_breakdown` varchar(32) NOT NULL,
  `jenis_problem` enum('alat','proses') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_activity`
--

INSERT INTO `m_activity` (`id`, `id_pabrik`, `no_wo`, `tanggal`, `perbaikan`, `jenis_breakdown`, `jenis_problem`) VALUES
(65, 'GSIP', 'GSIP-2018-11-19-02', '2018-12-01', 'cek piping', 'unit', 'alat'),
(66, 'GSIP', 'GSIP-2018-11-12-01', '2018-12-01', 'ganti bearing', 'unit', 'alat'),
(68, 'GSDI', 'GSDI-2018-12-02-01', '2018-12-02', 'perbaiki chain', 'pabrik', 'alat'),
(69, 'GSIP', 'GSIP-2018-11-12-01', '2018-12-03', 'cek', 'unit', 'alat'),
(92, 'GSDI', 'GSDI-2018-12-18-01', '2018-12-18', 'ganti screw', '', ''),
(93, 'GSDI', 'GSDI-2018-12-18-02', '2018-12-18', 'aspal jalan', '', ''),
(94, 'GSDI', 'GSDI-2018-12-18-01', '2019-01-15', '', '', ''),
(100, 'GSDI', 'GSDI-2018-12-02-01', '2019-01-16', '', '', ''),
(101, 'GSDI', 'GSDI-2019-01-16-01', '2019-01-16', 'ganti screw', '', ''),
(102, 'GSDI', 'GSDI-2018-12-02-01', '2019-01-24', '', '', ''),
(103, 'GSDI', 'GSDI-2019-03-12-01', '2019-03-12', 'ganti bearing', 'PCM', 'alat');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_activity_detail`
--

CREATE TABLE IF NOT EXISTS `m_activity_detail` (
  `id_pabrik` varchar(32) NOT NULL,
  `tanggal` date NOT NULL,
  `no_wo` varchar(32) NOT NULL,
  `nama_teknisi` varchar(32) DEFAULT NULL,
  `t_mulai` varchar(8) NOT NULL,
  `t_selesai` varchar(8) NOT NULL,
  `r_mulai` varchar(8) NOT NULL,
  `r_selesai` varchar(8) NOT NULL,
  `realisasi` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_activity_detail`
--

INSERT INTO `m_activity_detail` (`id_pabrik`, `tanggal`, `no_wo`, `nama_teknisi`, `t_mulai`, `t_selesai`, `r_mulai`, `r_selesai`, `realisasi`) VALUES
('GSIP', '2018-12-01', 'GSIP-2018-11-19-02', 'Har', '10:10', '10:00', '10:10', '10:00', '23:50'),
('GSIP', '2018-12-01', 'GSIP-2018-11-19-02', 'Sis', '10:10', '10:00', '10:10', '10:00', '23:50'),
('GSIP', '2018-12-01', 'GSIP-2018-11-12-01', 'eko', '10:10', '12:00', '13:00', '14:00', '01:00'),
('GSDI', '2018-12-02', 'GSDI-2018-12-02-01', 'Sis', '10:00', '12:00', '10:00', '12:00', '02:00'),
('GSIP', '2018-12-03', 'GSIP-2018-11-12-01', 'kik', '06:00', '08:00', '07:00', '09:00', '02:00'),
('GSDI', '2018-12-18', 'GSDI-2018-12-18-01', 'Sangadun', '07:00', '15:00', '07:00', '15:00', '08:00'),
('GSDI', '2018-12-18', 'GSDI-2018-12-18-01', 'Ahmad Fatoni', '10:00', '17:00', '12:00', '17:00', '05:00'),
('GSDI', '2018-12-18', 'GSDI-2018-12-18-02', 'Umarrudin', '', '', '', '', ''),
('GSDI', '2019-01-15', 'GSDI-2018-12-18-01', 'Sismadi', '', '', '', '', ''),
('GSDI', '2019-01-16', 'GSDI-2018-12-02-01', 'Sangadun', '', '', '', '', ''),
('GSDI', '2019-01-16', 'GSDI-2019-01-16-01', 'Sri Rohmadi', '', '', '', '', ''),
('GSDI', '2019-01-24', 'GSDI-2018-12-02-01', 'Eko Nugroho', '', '', '', '', ''),
('GSDI', '2019-03-12', 'GSDI-2019-03-12-01', 'Iwan Yulianto', '07:00', '10:00', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_breakdown_pabrik`
--

CREATE TABLE IF NOT EXISTS `m_breakdown_pabrik` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `station` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `problem` varchar(64) NOT NULL,
  `jenis` varchar(64) NOT NULL,
  `tipe` varchar(64) NOT NULL,
  `tindakan` varchar(64) NOT NULL,
  `mulai` datetime NOT NULL,
  `selesai` datetime NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_breakdown_pabrik`
--

INSERT INTO `m_breakdown_pabrik` (`id`, `tanggal`, `id_pabrik`, `station`, `unit`, `problem`, `jenis`, `tipe`, `tindakan`, `mulai`, `selesai`, `keterangan`) VALUES
(1, '2019-03-13', 'ANA', 'a', 'b', 'c', 'unit', '', '', '2019-02-12 00:37:00', '2019-02-12 06:00:00', ''),
(2, '2019-03-12', 'ANA', '', '', '', 'line', '', '', '2019-02-12 04:48:50', '2019-02-12 06:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_capex_pi`
--

CREATE TABLE IF NOT EXISTS `m_capex_pi` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `project_id` varchar(64) NOT NULL,
  `tipe` enum('Mill Replacement','HO Project') NOT NULL,
  `deskripsi` varchar(128) NOT NULL,
  `qty` varchar(64) NOT NULL,
  `um` enum('Pcs','Lot','Unit','Meter') NOT NULL,
  `budget` bigint(20) NOT NULL,
  `pkpo` enum('PK','PO') NOT NULL,
  `status_pi` enum('Process','Approve','Cancel','Dialihkan') NOT NULL,
  `due_date` date NOT NULL,
  `PIC` enum('Site','WSC','HO') NOT NULL,
  `kategori_progress` enum('Project Id Release','Fabrikasi','Mesin On Site','Install','Testing Commisioning') NOT NULL,
  `progress` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_capex_pi`
--

INSERT INTO `m_capex_pi` (`id`, `id_pabrik`, `tahun`, `project_id`, `tipe`, `deskripsi`, `qty`, `um`, `budget`, `pkpo`, `status_pi`, `due_date`, `PIC`, `kategori_progress`, `progress`) VALUES
(13, 'GSIP', 2018, 'apem', 'Mill Replacement', 'makanana 1', '10', 'Lot', 123, 'PK', 'Approve', '2018-11-26', 'Site', 'Project Id Release', '10%'),
(14, 'GSIP', 2018, 'bakpia', 'HO Project', 'food 2', '2', 'Pcs', 12, 'PO', 'Cancel', '2018-11-27', 'WSC', 'Project Id Release', '10%'),
(15, 'GSIP', 2018, 'cakwe', 'Mill Replacement', 'food 3', '4', 'Meter', 1, 'PO', 'Dialihkan', '2018-11-30', 'HO', 'Project Id Release', '10%'),
(22, 'ANA', 2018, 'tes', 'Mill Replacement', 'ini cuma ngetes', '12', 'Pcs', 1, 'PO', 'Process', '2018-12-19', 'WSC', 'Mesin On Site', '70%'),
(23, 'GSDI', 2018, 'apem', 'Mill Replacement', 'makanana 1', '10', 'Lot', 123, 'PK', 'Approve', '2018-11-26', 'Site', 'Mesin On Site', '70%'),
(24, 'GSDI', 2018, 'bakpia', 'HO Project', 'food 2', '2', 'Pcs', 12, 'PO', 'Process', '2018-11-27', 'WSC', 'Project Id Release', '10%'),
(25, 'GSDI', 2018, 'cakwe', 'Mill Replacement', 'food 3', '4', 'Meter', 1, 'PO', 'Dialihkan', '2018-11-30', 'HO', 'Project Id Release', '10%');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_capex_prpo`
--

CREATE TABLE IF NOT EXISTS `m_capex_prpo` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `project_id` varchar(64) NOT NULL,
  `no_pr` varchar(64) NOT NULL,
  `nominal_pr` bigint(20) NOT NULL,
  `status` varchar(64) NOT NULL,
  `no_po` varchar(64) NOT NULL,
  `nominal_po` bigint(20) NOT NULL,
  `vendor` varchar(64) NOT NULL,
  `keterangan` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_capex_prpo`
--

INSERT INTO `m_capex_prpo` (`id`, `id_pabrik`, `tahun`, `project_id`, `no_pr`, `nominal_pr`, `status`, `no_po`, `nominal_po`, `vendor`, `keterangan`) VALUES
(1, 'GSIP', 2018, 'cakwe', '12', 1, 'Authorized', '123', 2, 'mamang', 'pinggir jalan'),
(4, 'ANA', 2018, 'tes', '1234', 1, 'Planned', '12345', 1, 'allun jaya', 'barang dikirim dalam satu minggu'),
(5, 'GSDI', 2018, 'apem', '1111', 1, 'Planned', '2222', 2, 'naga jaya', 'harga naik');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_cost`
--

CREATE TABLE IF NOT EXISTS `m_cost` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(8) NOT NULL,
  `pkrm` float NOT NULL,
  `porm` float NOT NULL,
  `pkolah` float NOT NULL,
  `poolah` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_cost`
--

INSERT INTO `m_cost` (`tanggal`, `id_pabrik`, `pkrm`, `porm`, `pkolah`, `poolah`) VALUES
('2019-02-13', 'ANA', 100, 50, 0, 0),
('2019-02-12', 'ANA', 100, 100, 0, 0),
('2019-02-14', 'ANA', 100, 10, 90, 76),
('2019-02-15', 'ANA', 1, 1, 1, 1),
('2019-03-12', 'ANA', 100, 100, 50, 50);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_feedback`
--

CREATE TABLE IF NOT EXISTS `m_feedback` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(16) NOT NULL,
  `deskripsi` varchar(64) NOT NULL,
  `standard` varchar(32) NOT NULL,
  `u1` float NOT NULL,
  `u2` float NOT NULL,
  `u3` float NOT NULL,
  `u4` float NOT NULL,
  `u5` float NOT NULL,
  `u6` float NOT NULL,
  `u7` float NOT NULL,
  `u8` float NOT NULL,
  `u9` float NOT NULL,
  `u10` float NOT NULL,
  `ratarata` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_grounding`
--

CREATE TABLE IF NOT EXISTS `m_grounding` (
  `id_pabrik` varchar(32) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bak_kontrol` int(11) NOT NULL,
  `titik_pengukuran` varchar(32) NOT NULL,
  `jan` float NOT NULL,
  `feb` float NOT NULL,
  `mar` float NOT NULL,
  `apr` float NOT NULL,
  `mei` float NOT NULL,
  `jun` float NOT NULL,
  `jul` float NOT NULL,
  `agt` float NOT NULL,
  `sep` float NOT NULL,
  `okt` float NOT NULL,
  `nov` float NOT NULL,
  `des` float NOT NULL,
  `keterangan` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_grounding`
--

INSERT INTO `m_grounding` (`id_pabrik`, `tahun`, `bak_kontrol`, `titik_pengukuran`, `jan`, `feb`, `mar`, `apr`, `mei`, `jun`, `jul`, `agt`, `sep`, `okt`, `nov`, `des`, `keterangan`) VALUES
('SAM', 2018, 1, 'limbah', 123, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('GSDI', 2018, 1, 'timbangan', 12, 0.1, 1.4, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('GSDI', 2018, 0, 'kcp', 0, 2.3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('GSDI', 2018, 0, 'biodiesel', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('GSDI', 2018, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ''),
('SINP', 2019, 1, 'Timbangan', 0.98, 0.8, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_highlight`
--

CREATE TABLE IF NOT EXISTS `m_highlight` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `tahun` varchar(4) NOT NULL,
  `bulan` varchar(2) NOT NULL,
  `station` varchar(32) NOT NULL,
  `unit` varchar(32) NOT NULL,
  `problem` varchar(64) NOT NULL,
  `corrective_action` varchar(64) NOT NULL,
  `due_date` varchar(32) NOT NULL,
  `PIC` varchar(32) NOT NULL,
  `account` varchar(32) NOT NULL,
  `status` varchar(32) NOT NULL,
  `penyelesaian` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_highlight`
--

INSERT INTO `m_highlight` (`id`, `id_pabrik`, `tahun`, `bulan`, `station`, `unit`, `problem`, `corrective_action`, `due_date`, `PIC`, `account`, `status`, `penyelesaian`) VALUES
(1, 'GSIP', '2018', '12', 'Loading Ramp', 'Press 4', 'asdf', 'asddd', '70 mei', 'Internal', 'RM', 'PR', 'Close'),
(2, 'GSDI', '2019', '01', 'Fruit Reception', 'Power pack bunch press no. 4', 'asdasd', 'asdasda', '', 'External', 'RM', 'PO', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_inventory`
--

CREATE TABLE IF NOT EXISTS `m_inventory` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` varchar(64) NOT NULL,
  `norma_min` varchar(64) NOT NULL,
  `norma_max` varchar(64) NOT NULL,
  `nilai_stok` varchar(64) NOT NULL,
  `shortage` varchar(64) NOT NULL,
  `normal` varchar(64) NOT NULL,
  `excess` varchar(64) NOT NULL,
  `undefined` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_inventory`
--

INSERT INTO `m_inventory` (`id`, `id_pabrik`, `tahun`, `bulan`, `norma_min`, `norma_max`, `nilai_stok`, `shortage`, `normal`, `excess`, `undefined`) VALUES
(1, 'GSIP', 2018, 'Januari', '1234', '', '', '', '', '', ''),
(2, 'GSIP', 2018, 'Februari', '5678', '', '', '', '', '', ''),
(3, 'GSIP', 2018, 'Maret', '', '', '', '', '', '', ''),
(4, 'GSIP', 2018, 'April', '', '', '', '', '', '', ''),
(5, 'GSIP', 2018, 'Mei', '', '', '', '', '', '', ''),
(6, 'GSIP', 2018, 'Juni', '', '', '', '', '', '', ''),
(7, 'GSIP', 2018, 'Juli', '', '', '', '', '', '', ''),
(8, 'GSIP', 2018, 'Agustus', '', '', '', '', '', '', ''),
(9, 'GSIP', 2018, 'September', '', '', '', '', '', '', ''),
(10, 'GSIP', 2018, 'Oktober', '', '', '', '', '', '', ''),
(11, 'GSIP', 2018, 'November', '', '', '', '', '', '', ''),
(12, 'GSIP', 2018, 'Desember', '', '', '', '', '', '', ''),
(13, 'GSPP', 2018, 'Januari', '1', '', '', '', '5', '', ''),
(14, 'GSPP', 2018, 'Februari', '', '2', '', '4', '', '6', ''),
(15, 'GSPP', 2018, 'Maret', '', '', '3', '', '', '', '7'),
(16, 'GSPP', 2018, 'April', '', '', '', '', '', '', ''),
(17, 'GSPP', 2018, 'Mei', '', '', '', '', '', '', ''),
(18, 'GSPP', 2018, 'Juni', '', '', '', '', '', '', ''),
(19, 'GSPP', 2018, 'Juli', '', '', '', '', '', '', ''),
(20, 'GSPP', 2018, 'Agustus', '', '', '', '', '', '', ''),
(21, 'GSPP', 2018, 'September', '', '', '', '', '', '', ''),
(22, 'GSPP', 2018, 'Oktober', '', '', '', '', '', '', ''),
(23, 'GSPP', 2018, 'November', '', '', '', '', '', '', ''),
(24, 'GSPP', 2018, 'Desember', '', '', '', '', '', '', ''),
(37, 'ANA', 2019, 'Januari', '', '', '', '', '', '', ''),
(38, 'ANA', 2019, 'Februari', '1000', '5000', '4500', '', '', '', ''),
(39, 'ANA', 2019, 'Maret', '', '', '', '', '', '', ''),
(40, 'ANA', 2019, 'April', '', '', '', '', '', '', ''),
(41, 'ANA', 2019, 'Mei', '', '', '', '', '', '', ''),
(42, 'ANA', 2019, 'Juni', '', '', '', '', '', '', ''),
(43, 'ANA', 2019, 'Juli', '', '', '', '', '', '', ''),
(44, 'ANA', 2019, 'Agustus', '', '', '', '', '', '', ''),
(45, 'ANA', 2019, 'September', '', '', '', '', '', '', ''),
(46, 'ANA', 2019, 'Oktober', '', '', '', '', '', '', ''),
(47, 'ANA', 2019, 'November', '', '', '', '', '', '', ''),
(48, 'ANA', 2019, 'Desember', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_kapasitor`
--

CREATE TABLE IF NOT EXISTS `m_kapasitor` (
  `id_pabrik` varchar(8) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kapasitor` varchar(32) NOT NULL,
  `kvar` int(11) NOT NULL,
  `jan` float NOT NULL,
  `feb` float NOT NULL,
  `mar` float NOT NULL,
  `apr` float NOT NULL,
  `mei` float NOT NULL,
  `jun` float NOT NULL,
  `jul` float NOT NULL,
  `agt` float NOT NULL,
  `sep` float NOT NULL,
  `okt` float NOT NULL,
  `nov` float NOT NULL,
  `des` float NOT NULL,
  `keterangan` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_kapasitor`
--

INSERT INTO `m_kapasitor` (`id_pabrik`, `tahun`, `kapasitor`, `kvar`, `jan`, `feb`, `mar`, `apr`, `mei`, `jun`, `jul`, `agt`, `sep`, `okt`, `nov`, `des`, `keterangan`) VALUES
('GSDI', 2018, 'channel 1 power house', 50, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, ''),
('GSDI', 2018, 'channel 2 power house', 50, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, ''),
('GSDI', 2018, 'channel 3 power house', 50, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, ''),
('GSDI', 2018, 'channel 4 power house', 50, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, ''),
('GSDI', 2018, 'channel 5 power house', 50, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, ''),
('GSDI', 2018, 'channel 6 power house', 50, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, ''),
('GSDI', 2018, 'channel 7 power house', 50, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, 60.8, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_lkpmp`
--

CREATE TABLE IF NOT EXISTS `m_lkpmp` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `kondisi` varchar(128) NOT NULL,
  `status` enum('Hijau','Kuning','Merah') NOT NULL,
  `identifikasi` varchar(128) NOT NULL,
  `perbaikan` varchar(128) NOT NULL,
  `pic` enum('Internal','WSC','External') NOT NULL,
  `status_sparepart` enum('Ready','Order','Progress Order') NOT NULL,
  `keterangan` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_lkpmp`
--

INSERT INTO `m_lkpmp` (`id`, `id_pabrik`, `tahun`, `bulan`, `id_station`, `id_unit`, `kondisi`, `status`, `identifikasi`, `perbaikan`, `pic`, `status_sparepart`, `keterangan`) VALUES
(3, 'GSIP', 2018, 11, 'Loading Ramp', 'Press 6', 'inverter short', 'Kuning', 'lifetime turun', 'penggantian IGBT', 'Internal', 'Progress Order', 'ke heriwell'),
(4, 'GSDI', 2018, 11, 'Loading Ramp', 'FFB conveyor', 'shaft patah', 'Kuning', 'overload', 'ganti shaft', 'Internal', 'Ready', 'pasang hari minggu'),
(5, 'GSDI', 2019, 1, 'Threshing', '', '', 'Merah', '', '', 'WSC', 'Progress Order', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_motor`
--

CREATE TABLE IF NOT EXISTS `m_motor` (
  `tahun` varchar(4) NOT NULL,
  `periode` tinyint(4) NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `suhu_coupling` float NOT NULL,
  `suhu_bearing` float NOT NULL,
  `suhu_body` float NOT NULL,
  `kondisi_fan` tinyint(4) NOT NULL,
  `seal_terminal` tinyint(4) NOT NULL,
  `kabel_gland` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_recordhm`
--

CREATE TABLE IF NOT EXISTS `m_recordhm` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `hm` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_recordhm`
--

INSERT INTO `m_recordhm` (`id`, `tanggal`, `id_pabrik`, `id_station`, `unit`, `hm`) VALUES
(67, '2018-12-30', 'GSDI', 'Pressing', 'Screw Press No. 1', 1),
(68, '2018-12-30', 'GSDI', 'Pressing', 'Screw Press No. 2', 1),
(69, '2018-12-30', 'GSDI', 'Pressing', 'Screw Press No. 3', 1),
(70, '2018-12-30', 'GSDI', 'Pressing', 'Screw Press No. 4', 1),
(71, '2018-12-30', 'GSDI', 'Pressing', 'Screw Press No. 5', 1),
(72, '2018-12-30', 'GSDI', 'Pressing', 'Screw Press No. 6', 1),
(127, '2018-12-31', 'GSDI', 'Pressing', 'Screw Press No. 1', 5),
(128, '2018-12-31', 'GSDI', 'Pressing', 'Screw Press No. 2', 5),
(129, '2018-12-31', 'GSDI', 'Pressing', 'Screw Press No. 3', 5),
(130, '2018-12-31', 'GSDI', 'Pressing', 'Screw Press No. 4', 5),
(131, '2018-12-31', 'GSDI', 'Pressing', 'Screw Press No. 5', 5),
(132, '2018-12-31', 'GSDI', 'Pressing', 'Screw Press No. 6', 5),
(133, '2019-01-01', 'GSDI', 'Pressing', 'Screw Press No. 1', 5),
(134, '2019-01-01', 'GSDI', 'Pressing', 'Screw Press No. 2', 5),
(135, '2019-01-01', 'GSDI', 'Pressing', 'Screw Press No. 3', 5),
(136, '2019-01-01', 'GSDI', 'Pressing', 'Screw Press No. 4', 7),
(137, '2019-01-01', 'GSDI', 'Pressing', 'Screw Press No. 5', 7),
(138, '2019-01-01', 'GSDI', 'Pressing', 'Screw Press No. 6', 7),
(145, '2019-01-02', 'GSDI', 'Pressing', 'Screw Press No. 1', 10),
(146, '2019-01-02', 'GSDI', 'Pressing', 'Screw Press No. 2', 10),
(147, '2019-01-02', 'GSDI', 'Pressing', 'Screw Press No. 3', 10),
(148, '2019-01-02', 'GSDI', 'Pressing', 'Screw Press No. 4', 10),
(149, '2019-01-02', 'GSDI', 'Pressing', 'Screw Press No. 5', 10),
(150, '2019-01-02', 'GSDI', 'Pressing', 'Screw Press No. 6', 10.34),
(157, '2019-01-03', 'GSDI', 'Pressing', 'Screw Press No. 1', 12),
(158, '2019-01-03', 'GSDI', 'Pressing', 'Screw Press No. 2', 12),
(159, '2019-01-03', 'GSDI', 'Pressing', 'Screw Press No. 3', 12),
(160, '2019-01-03', 'GSDI', 'Pressing', 'Screw Press No. 4', 12),
(161, '2019-01-03', 'GSDI', 'Pressing', 'Screw Press No. 5', 12),
(162, '2019-01-03', 'GSDI', 'Pressing', 'Screw Press No. 6', 12),
(203, '2019-01-02', 'GSDI', 'Bunch Press', 'Bunch Press no. 1', 1),
(204, '2019-01-02', 'GSDI', 'Bunch Press', 'Bunch Press no. 2', 1),
(205, '2019-01-02', 'GSDI', 'Bunch Press', 'Bunch Press no. 3', 1),
(206, '2019-01-02', 'GSDI', 'Bunch Press', 'Bunch Press no. 4', 1),
(207, '2019-01-02', 'GSDI', 'Bunch Press', 'Bunch Press no. 5', 1),
(208, '2019-01-03', 'GSDI', 'Bunch Press', 'Bunch Press no. 1', 2),
(209, '2019-01-03', 'GSDI', 'Bunch Press', 'Bunch Press no. 2', 3),
(210, '2019-01-03', 'GSDI', 'Bunch Press', 'Bunch Press no. 3', 4),
(211, '2019-01-03', 'GSDI', 'Bunch Press', 'Bunch Press no. 4', 5),
(212, '2019-01-03', 'GSDI', 'Bunch Press', 'Bunch Press no. 5', 6),
(213, '2019-01-04', 'GSDI', 'Pressing', 'Screw Press No. 1', 15),
(214, '2019-01-04', 'GSDI', 'Pressing', 'Screw Press No. 2', 15),
(215, '2019-01-04', 'GSDI', 'Pressing', 'Screw Press No. 3', 15),
(216, '2019-01-04', 'GSDI', 'Pressing', 'Screw Press No. 4', 15),
(217, '2019-01-04', 'GSDI', 'Pressing', 'Screw Press No. 5', 15.6),
(218, '2019-01-04', 'GSDI', 'Pressing', 'Screw Press No. 6', 14.8),
(219, '2019-01-05', 'GSDI', 'Pressing', 'Screw Press No. 1', 20),
(220, '2019-01-05', 'GSDI', 'Pressing', 'Screw Press No. 2', 20),
(221, '2019-01-05', 'GSDI', 'Pressing', 'Screw Press No. 3', 20),
(222, '2019-01-05', 'GSDI', 'Pressing', 'Screw Press No. 4', 20),
(223, '2019-01-05', 'GSDI', 'Pressing', 'Screw Press No. 5', 3000),
(224, '2019-01-05', 'GSDI', 'Pressing', 'Screw Press No. 6', 20),
(225, '2019-01-06', 'GSDI', 'Pressing', 'Screw Press No. 1', 22),
(226, '2019-01-06', 'GSDI', 'Pressing', 'Screw Press No. 2', 22),
(227, '2019-01-06', 'GSDI', 'Pressing', 'Screw Press No. 3', 22),
(228, '2019-01-06', 'GSDI', 'Pressing', 'Screw Press No. 4', 22),
(229, '2019-01-06', 'GSDI', 'Pressing', 'Screw Press No. 5', 3023.5),
(230, '2019-01-06', 'GSDI', 'Pressing', 'Screw Press No. 6', 22),
(231, '2019-01-04', 'GSDI', 'KCP', 'Pressing 1 st No. 1', 1),
(232, '2019-01-04', 'GSDI', 'KCP', 'Pressing 1 st No. 2', 0),
(233, '2019-01-04', 'GSDI', 'KCP', 'Pressing 1 st No. 3', 0),
(234, '2019-01-04', 'GSDI', 'KCP', 'Pressing 1 st No. 4', 0),
(235, '2019-01-04', 'GSDI', 'KCP', 'Pressing 1 st No. 5', 0),
(236, '2019-01-04', 'GSDI', 'KCP', 'Pressing 1 st No. 6', 0),
(237, '2019-01-04', 'GSDI', 'KCP', 'Pressing 1 st No. 7', 0),
(238, '2019-01-04', 'GSDI', 'KCP', '2nd Press No. 1 ', 1),
(239, '2019-01-04', 'GSDI', 'KCP', '2nd Press No. 2', 0),
(240, '2019-01-04', 'GSDI', 'KCP', '2nd Press No. 3', 0),
(241, '2019-01-04', 'GSDI', 'KCP', '2nd Press No. 4', 0),
(242, '2019-01-04', 'GSDI', 'KCP', '2nd Press No. 5', 0),
(243, '2019-01-04', 'GSDI', 'KCP', '2nd Press No. 6', 0),
(247, '2019-01-04', 'GSDI', 'Kernel Line A', 'Hydrocyclone Kernel pump A', 10),
(248, '2019-01-04', 'GSDI', 'Kernel Line A', 'Hydrocyclone Shell pump A', 10),
(249, '2019-01-04', 'GSDI', 'Kernel Line B', 'Hydrocyclone Shell Pump B', 5),
(250, '2019-01-04', 'GSDI', 'Kernel Line B', 'Hydrocyclone Kernel Pump B', 5),
(251, '2019-01-12', 'GSDI', 'Pressing', 'Screw Press No. 1', 5000),
(252, '2019-01-12', 'GSDI', 'Pressing', 'Screw Press No. 2', 5000),
(253, '2019-01-12', 'GSDI', 'Pressing', 'Screw Press No. 3', 5000),
(254, '2019-01-12', 'GSDI', 'Pressing', 'Screw Press No. 4', 5000),
(255, '2019-01-12', 'GSDI', 'Pressing', 'Screw Press No. 5', 5000),
(256, '2019-01-12', 'GSDI', 'Pressing', 'Screw Press No. 6', 5000),
(257, '2019-01-07', 'GSDI', 'Pressing', 'Screw Press No. 1', 30),
(258, '2019-01-07', 'GSDI', 'Pressing', 'Screw Press No. 2', 30),
(259, '2019-01-07', 'GSDI', 'Pressing', 'Screw Press No. 3', 30),
(260, '2019-01-07', 'GSDI', 'Pressing', 'Screw Press No. 4', 30),
(261, '2019-01-07', 'GSDI', 'Pressing', 'Screw Press No. 5', 3050),
(262, '2019-01-07', 'GSDI', 'Pressing', 'Screw Press No. 6', 22),
(263, '2019-01-08', 'GSDI', 'Pressing', 'Screw Press No. 1', 100),
(264, '2019-01-08', 'GSDI', 'Pressing', 'Screw Press No. 2', 100),
(265, '2019-01-08', 'GSDI', 'Pressing', 'Screw Press No. 3', 100),
(266, '2019-01-08', 'GSDI', 'Pressing', 'Screw Press No. 4', 100),
(267, '2019-01-08', 'GSDI', 'Pressing', 'Screw Press No. 5', 100),
(268, '2019-01-08', 'GSDI', 'Pressing', 'Screw Press No. 6', 100),
(281, '2019-03-12', 'GSDI', 'Pressing', 'Screw Press No. 1', 10000),
(282, '2019-03-12', 'GSDI', 'Pressing', 'Screw Press No. 2', 100001),
(283, '2019-03-12', 'GSDI', 'Pressing', 'Screw Press No. 3', 100001),
(284, '2019-03-12', 'GSDI', 'Pressing', 'Screw Press No. 4', 100001),
(285, '2019-03-12', 'GSDI', 'Pressing', 'Screw Press No. 5', 100001),
(286, '2019-03-12', 'GSDI', 'Pressing', 'Screw Press No. 6', 56398),
(287, '2019-03-13', 'GSDI', 'Pressing', 'Screw Press No. 1', 10050),
(288, '2019-03-13', 'GSDI', 'Pressing', 'Screw Press No. 2', 0),
(289, '2019-03-13', 'GSDI', 'Pressing', 'Screw Press No. 3', 0),
(290, '2019-03-13', 'GSDI', 'Pressing', 'Screw Press No. 4', 0),
(291, '2019-03-13', 'GSDI', 'Pressing', 'Screw Press No. 5', 0),
(292, '2019-03-13', 'GSDI', 'Pressing', 'Screw Press No. 6', 56498);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_recordhm_bunchpress`
--

CREATE TABLE IF NOT EXISTS `m_recordhm_bunchpress` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `scroll` float NOT NULL,
  `top_semi_cage_ring` float NOT NULL,
  `bottom_semi_cage_ring` float NOT NULL,
  `semi_press_cone` float NOT NULL,
  `adjusting_knife` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_recordhm_bunchpress`
--

INSERT INTO `m_recordhm_bunchpress` (`id`, `tanggal`, `id_pabrik`, `unit`, `scroll`, `top_semi_cage_ring`, `bottom_semi_cage_ring`, `semi_press_cone`, `adjusting_knife`) VALUES
(6, '2019-01-02', 'GSDI', 'Bunch Press no. 1', 1, 1, 1, 1, 1),
(7, '2019-01-02', 'GSDI', 'Bunch Press no. 2', 1, 1, 1, 1, 1),
(8, '2019-01-02', 'GSDI', 'Bunch Press no. 3', 1, 1, 1, 1, 1),
(9, '2019-01-02', 'GSDI', 'Bunch Press no. 4', 1, 1, 1, 1, 1),
(10, '2019-01-02', 'GSDI', 'Bunch Press no. 5', 1, 1, 1, 1, 1),
(11, '2019-01-03', 'GSDI', 'Bunch Press no. 1', 2, 2, 2, 2, 2),
(12, '2019-01-03', 'GSDI', 'Bunch Press no. 2', 3, 3, 3, 3, 3),
(13, '2019-01-03', 'GSDI', 'Bunch Press no. 3', 4, 4, 4, 4, 4),
(14, '2019-01-03', 'GSDI', 'Bunch Press no. 4', 5, 5, 5, 5, 5),
(15, '2019-01-03', 'GSDI', 'Bunch Press no. 5', 6, 6, 6, 6, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_recordhm_hydraulic`
--

CREATE TABLE IF NOT EXISTS `m_recordhm_hydraulic` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `oli` float NOT NULL,
  `filter_inlet` float NOT NULL,
  `filter_outlet` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_recordhm_hydrocyclone`
--

CREATE TABLE IF NOT EXISTS `m_recordhm_hydrocyclone` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `tanggal` date NOT NULL,
  `unit` varchar(64) NOT NULL,
  `cone` float NOT NULL,
  `dome` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_recordhm_hydrocyclone`
--

INSERT INTO `m_recordhm_hydrocyclone` (`id`, `id_pabrik`, `tanggal`, `unit`, `cone`, `dome`) VALUES
(1, 'GSDI', '2019-01-04', 'Hydrocyclone Kernel pump A', 10, 10),
(2, 'GSDI', '2019-01-04', 'Hydrocyclone Shell pump A', 10, 10),
(3, 'GSDI', '2019-01-04', 'Hydrocyclone Shell Pump B', 5, 5),
(4, 'GSDI', '2019-01-04', 'Hydrocyclone Kernel Pump B', 5, 5);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_recordhm_kcp`
--

CREATE TABLE IF NOT EXISTS `m_recordhm_kcp` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `screw` float NOT NULL,
  `body_cage` float NOT NULL,
  `tupperhead` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_recordhm_kcp`
--

INSERT INTO `m_recordhm_kcp` (`tanggal`, `id_pabrik`, `unit`, `screw`, `body_cage`, `tupperhead`) VALUES
('2019-01-04', 'GSDI', 'Pressing 1 st No. 1', 1, 1, 1),
('2019-01-04', 'GSDI', 'Pressing 1 st No. 2', 0, 0, 0),
('2019-01-04', 'GSDI', 'Pressing 1 st No. 3', 0, 0, 0),
('2019-01-04', 'GSDI', 'Pressing 1 st No. 4', 0, 0, 0),
('2019-01-04', 'GSDI', 'Pressing 1 st No. 5', 0, 0, 0),
('2019-01-04', 'GSDI', 'Pressing 1 st No. 6', 0, 0, 0),
('2019-01-04', 'GSDI', 'Pressing 1 st No. 7', 0, 0, 0),
('2019-01-04', 'GSDI', '2nd Press No. 1 ', 1, 1, 1),
('2019-01-04', 'GSDI', '2nd Press No. 2', 0, 0, 0),
('2019-01-04', 'GSDI', '2nd Press No. 3', 0, 0, 0),
('2019-01-04', 'GSDI', '2nd Press No. 4', 0, 0, 0),
('2019-01-04', 'GSDI', '2nd Press No. 5', 0, 0, 0),
('2019-01-04', 'GSDI', '2nd Press No. 6', 0, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_recordhm_screwpress`
--

CREATE TABLE IF NOT EXISTS `m_recordhm_screwpress` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `ab` float NOT NULL,
  `cd` float NOT NULL,
  `presscage` float NOT NULL,
  `wearpipe` float NOT NULL,
  `shaft` float NOT NULL,
  `cone_guide` float NOT NULL,
  `adjusting_cone_guide` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=355 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_recordhm_screwpress`
--

INSERT INTO `m_recordhm_screwpress` (`id`, `tanggal`, `id_pabrik`, `unit`, `ab`, `cd`, `presscage`, `wearpipe`, `shaft`, `cone_guide`, `adjusting_cone_guide`) VALUES
(7, '2018-12-30', 'GSDI', 'Screw Press No. 1', 1, 1, 1, 1, 1, 1, 1),
(8, '2018-12-30', 'GSDI', 'Screw Press No. 2', 1, 1, 1, 1, 1, 1, 1),
(9, '2018-12-30', 'GSDI', 'Screw Press No. 3', 1, 1, 1, 1, 1, 1, 1),
(10, '2018-12-30', 'GSDI', 'Screw Press No. 4', 1, 1, 1, 1, 1, 1, 1),
(11, '2018-12-30', 'GSDI', 'Screw Press No. 5', 1, 1, 1, 1, 1, 1, 1),
(12, '2018-12-30', 'GSDI', 'Screw Press No. 6', 1, 1, 1, 1, 1, 1, 1),
(217, '2018-12-31', 'GSDI', 'Screw Press No. 1', 5, 5, 5, 5, 5, 5, 5),
(218, '2018-12-31', 'GSDI', 'Screw Press No. 2', 5, 5, 5, 5, 5, 5, 5),
(219, '2018-12-31', 'GSDI', 'Screw Press No. 3', 5, 5, 5, 5, 5, 5, 5),
(220, '2018-12-31', 'GSDI', 'Screw Press No. 4', 5, 5, 5, 5, 5, 5, 5),
(221, '2018-12-31', 'GSDI', 'Screw Press No. 5', 5, 5, 5, 5, 5, 5, 5),
(222, '2018-12-31', 'GSDI', 'Screw Press No. 6', 5, 5, 5, 5, 5, 5, 5),
(229, '2019-01-01', 'GSDI', 'Screw Press No. 1', 0, 0, 5, 5, 5, 5, 5),
(230, '2019-01-01', 'GSDI', 'Screw Press No. 2', 0, 0, 5, 5, 5, 5, 5),
(231, '2019-01-01', 'GSDI', 'Screw Press No. 3', 0, 0, 5, 5, 5, 5, 5),
(232, '2019-01-01', 'GSDI', 'Screw Press No. 4', 7, 7, 7, 7, 7, 7, 7),
(233, '2019-01-01', 'GSDI', 'Screw Press No. 5', 7, 7, 7, 7, 7, 7, 7),
(234, '2019-01-01', 'GSDI', 'Screw Press No. 6', 7, 7, 7, 7, 7, 7, 7),
(247, '2019-01-02', 'GSDI', 'Screw Press No. 1', 5, 5, 10, 10, 10, 10, 10),
(248, '2019-01-02', 'GSDI', 'Screw Press No. 2', 5, 5, 10, 10, 10, 10, 10),
(249, '2019-01-02', 'GSDI', 'Screw Press No. 3', 5, 5, 10, 10, 10, 10, 10),
(250, '2019-01-02', 'GSDI', 'Screw Press No. 4', 10, 10, 10, 10, 10, 10, 10),
(251, '2019-01-02', 'GSDI', 'Screw Press No. 5', 10, 10, 10, 10, 10, 10, 10),
(252, '2019-01-02', 'GSDI', 'Screw Press No. 6', 0, 0, 0, 10.34, 10.34, 10.34, 10.34),
(259, '2019-01-03', 'GSDI', 'Screw Press No. 1', 7, 7, 12, 12, 12, 12, 12),
(260, '2019-01-03', 'GSDI', 'Screw Press No. 2', 7, 7, 12, 12, 12, 12, 12),
(261, '2019-01-03', 'GSDI', 'Screw Press No. 3', 7, 7, 12, 12, 12, 12, 12),
(262, '2019-01-03', 'GSDI', 'Screw Press No. 4', 12, 12, 12, 12, 12, 12, 12),
(263, '2019-01-03', 'GSDI', 'Screw Press No. 5', 12, 12, 12, 12, 12, 12, 12),
(264, '2019-01-03', 'GSDI', 'Screw Press No. 6', 1.66, 1.66, 1.66, 12, 12, 12, 12),
(271, '2019-01-04', 'GSDI', 'Screw Press No. 1', 10, 10, 15, 15, 15, 15, 15),
(272, '2019-01-04', 'GSDI', 'Screw Press No. 2', 10, 10, 15, 15, 15, 15, 15),
(273, '2019-01-04', 'GSDI', 'Screw Press No. 3', 10, 10, 15, 15, 15, 15, 15),
(274, '2019-01-04', 'GSDI', 'Screw Press No. 4', 15, 15, 15, 15, 15, 15, 15),
(275, '2019-01-04', 'GSDI', 'Screw Press No. 5', 0, 15.6, 15.6, 15.6, 15.6, 15.6, 15.6),
(276, '2019-01-04', 'GSDI', 'Screw Press No. 6', 4.46, 4.46, 4.46, 14.8, 14.8, 14.8, 14.8),
(283, '2019-01-05', 'GSDI', 'Screw Press No. 1', 15, 15, 20, 20, 20, 20, 20),
(284, '2019-01-05', 'GSDI', 'Screw Press No. 2', 15, 15, 20, 20, 20, 20, 20),
(285, '2019-01-05', 'GSDI', 'Screw Press No. 3', 15, 15, 20, 20, 20, 20, 20),
(286, '2019-01-05', 'GSDI', 'Screw Press No. 4', 20, 20, 20, 20, 20, 20, 20),
(287, '2019-01-05', 'GSDI', 'Screw Press No. 5', 2984.4, 0, 0, 0, 0, 0, 0),
(288, '2019-01-05', 'GSDI', 'Screw Press No. 6', 9.66, 9.66, 9.66, 20, 20, 20, 20),
(289, '2019-01-06', 'GSDI', 'Screw Press No. 1', 17, 17, 22, 22, 22, 22, 22),
(290, '2019-01-06', 'GSDI', 'Screw Press No. 2', 17, 17, 22, 22, 22, 22, 22),
(291, '2019-01-06', 'GSDI', 'Screw Press No. 3', 17, 17, 22, 22, 22, 22, 22),
(292, '2019-01-06', 'GSDI', 'Screw Press No. 4', 22, 22, 22, 22, 22, 22, 22),
(293, '2019-01-06', 'GSDI', 'Screw Press No. 5', 3007.9, 23.5, 23.5, 23.5, 23.5, 23.5, 23.5),
(294, '2019-01-06', 'GSDI', 'Screw Press No. 6', 11.66, 11.66, 11.66, 22, 22, 22, 22),
(295, '2019-01-12', 'GSDI', 'Screw Press No. 1', 4995, 4995, 5000, 5000, 5000, 5000, 5000),
(296, '2019-01-12', 'GSDI', 'Screw Press No. 2', 4995, 4995, 5000, 5000, 5000, 5000, 5000),
(297, '2019-01-12', 'GSDI', 'Screw Press No. 3', 4995, 4995, 5000, 5000, 5000, 5000, 5000),
(298, '2019-01-12', 'GSDI', 'Screw Press No. 4', 5000, 5000, 5000, 5000, 5000, 5000, 5000),
(299, '2019-01-12', 'GSDI', 'Screw Press No. 5', 4984.4, 2000, 2000, 2000, 2000, 2000, 2000),
(300, '2019-01-12', 'GSDI', 'Screw Press No. 6', 4989.66, 4989.66, 4989.66, 5000, 5000, 5000, 5000),
(307, '2019-01-07', 'GSDI', 'Screw Press No. 1', 0, 0, 30, 30, 30, 30, 30),
(308, '2019-01-07', 'GSDI', 'Screw Press No. 2', 25, 25, 30, 30, 30, 30, 30),
(309, '2019-01-07', 'GSDI', 'Screw Press No. 3', 25, 25, 30, 30, 30, 30, 30),
(310, '2019-01-07', 'GSDI', 'Screw Press No. 4', 30, 30, 30, 30, 30, 30, 30),
(311, '2019-01-07', 'GSDI', 'Screw Press No. 5', 3034.4, 50, 50, 50, 50, 50, 50),
(312, '2019-01-07', 'GSDI', 'Screw Press No. 6', 11.66, 11.66, 11.66, 22, 22, 22, 22),
(313, '2019-01-08', 'GSDI', 'Screw Press No. 1', 70, 70, 100, 100, 100, 100, 100),
(314, '2019-01-08', 'GSDI', 'Screw Press No. 2', 95, 95, 100, 100, 100, 100, 100),
(315, '2019-01-08', 'GSDI', 'Screw Press No. 3', 95, 95, 100, 100, 100, 100, 100),
(316, '2019-01-08', 'GSDI', 'Screw Press No. 4', 100, 100, 100, 100, 100, 100, 100),
(317, '2019-01-08', 'GSDI', 'Screw Press No. 5', 84.4, -2900, -2900, -2900, -2900, -2900, -2900),
(318, '2019-01-08', 'GSDI', 'Screw Press No. 6', 89.66, 89.66, 89.66, 100, 100, 100, 100),
(343, '2019-03-12', 'GSDI', 'Screw Press No. 1', 9995, 9995, 10000, 10000, 10000, 10000, 10000),
(344, '2019-03-12', 'GSDI', 'Screw Press No. 2', 99996, 99996, 100001, 100001, 100001, 100001, 100001),
(345, '2019-03-12', 'GSDI', 'Screw Press No. 3', 99996, 99996, 100001, 100001, 100001, 100001, 100001),
(346, '2019-03-12', 'GSDI', 'Screw Press No. 4', 100001, 100001, 100001, 100001, 100001, 100001, 100001),
(347, '2019-03-12', 'GSDI', 'Screw Press No. 5', 99985.4, 97001, 97001, 97001, 97001, 97001, 97001),
(348, '2019-03-12', 'GSDI', 'Screw Press No. 6', 0, 0, 0, 0, 0, 0, 56398),
(349, '2019-03-13', 'GSDI', 'Screw Press No. 1', 10045, 10045, 10050, 10050, 10050, 10050, 10050),
(350, '2019-03-13', 'GSDI', 'Screw Press No. 2', -5, -5, 0, 0, 0, 0, 0),
(351, '2019-03-13', 'GSDI', 'Screw Press No. 3', -5, -5, 0, 0, 0, 0, 0),
(352, '2019-03-13', 'GSDI', 'Screw Press No. 4', 0, 0, 0, 0, 0, 0, 0),
(353, '2019-03-13', 'GSDI', 'Screw Press No. 5', -15.6, -3000, -3000, -3000, -3000, -3000, -3000),
(354, '2019-03-13', 'GSDI', 'Screw Press No. 6', 100, 100, 100, 100, 100, 100, 56498);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_sparepart_usage`
--

CREATE TABLE IF NOT EXISTS `m_sparepart_usage` (
  `no_wo` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `material` varchar(64) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_sparepart_usage`
--

INSERT INTO `m_sparepart_usage` (`no_wo`, `tanggal`, `material`, `qty`) VALUES
('GSDI-2018-12-18-01', '2018-12-18', 'screw AB', 3),
('GSDI-2018-12-18-02', '2018-12-18', 'aspal', 20),
('GSDI-2018-12-18-01', '2019-01-15', '', 0),
('GSDI-2018-12-02-01', '2019-01-16', 'ganti chain 6"', 6),
('GSDI-2019-01-16-01', '2019-01-16', 'screw mohusindo', 1),
('GSDI-2019-01-16-01', '2019-01-16', 'baut 3/5" 6"', 10),
('GSDI-2018-12-02-01', '2019-01-24', '', 0),
('GSDI-2019-03-12-01', '2019-03-12', 'bearing SKF tipe xxxxx', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_wo`
--

CREATE TABLE IF NOT EXISTS `m_wo` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `tanggal` date NOT NULL,
  `no_wo` varchar(64) NOT NULL,
  `station` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `problem` varchar(64) NOT NULL,
  `desc_masalah` varchar(256) NOT NULL,
  `hm` float NOT NULL,
  `kategori` enum('plan','unplan') NOT NULL,
  `status` enum('open','close') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_wo`
--

INSERT INTO `m_wo` (`id`, `id_pabrik`, `tanggal`, `no_wo`, `station`, `unit`, `problem`, `desc_masalah`, `hm`, `kategori`, `status`) VALUES
(5, 'GSIP', '2018-11-12', 'GSIP-2018-11-12-01', 'Press', 'Press 1', 'bearing pecah', 'bearing screw press pecah', 5000, 'unplan', 'open'),
(6, 'GSIP', '2018-11-19', 'GSIP-2018-11-19-02', 'Sterilizer', '', 'grafik rebusan no 1 tidak terbaca', '', 10000, 'plan', 'open'),
(7, 'GSIP', '2018-11-22', 'GSIP-2018-11-22-01', 'Press', 'Press 1', 'screw patah', '', 3500, 'plan', 'open'),
(8, 'GSDI', '2018-12-02', 'GSDI-2018-12-02-01', 'Loading Ramp', 'FFB conveyor', 'chain putus', '', 4500, 'unplan', 'open'),
(9, 'GSIP', '2018-12-10', 'GSIP-2018-12-10-01', 'Press', 'Press 2', 'bearing press pecah', '', 8000, 'plan', 'open'),
(18, 'GSIP', '2018-12-13', 'GSIP-2018-12-13-01', 'Loading Ramp', '', 'Winch captan', 'Ganti motor bintang winch capstan no 1', 8000, 'plan', 'open'),
(19, 'GSIP', '2018-12-13', 'GSIP-2018-12-13-02', 'Loading Ramp', '', 'Tipping dump', 'Service tipping dump hidrolik no 1', 9000, '', ''),
(20, 'GSIP', '2018-12-13', 'GSIP-2018-12-13-03', 'Loading Ramp', '', 'Pintu loading ramp no 7', 'Penggantian bearing pintu loading ramp ', 0, '', ''),
(21, 'GSIP', '2018-12-13', 'GSIP-2018-12-13-04', 'Loading Ramp', '', 'Rail ', 'Penggantian rail lori kosong loading ramp line A', 0, '', ''),
(23, 'GSDI', '2018-12-18', 'GSDI-2018-12-18-01', 'Pressing', 'Screw Press No. 1', 'screw patah', 'patah rek ra sah dijelasne', 23908, 'plan', 'open'),
(24, 'GSDI', '2018-12-18', 'GSDI-2018-12-18-02', 'General', '', '', '', 0, 'plan', 'open'),
(25, 'GSDI', '2019-01-12', 'GSDI-2019-01-12-01', 'Pressing', 'Screw Press No. 6', 'inverter salah hz', '', 9089, 'plan', 'open'),
(26, 'GSDI', '2019-01-16', 'GSDI-2019-01-16-01', 'Pressing', 'Screw Press No. 1', 'patah', '', 10000, 'plan', 'open'),
(27, 'GSDI', '2019-01-27', 'GSDI-2019-01-27-01', 'Fruit Reception', 'FFB HorizontalConveyor', 'aus', 'waktunya ganti', 0, '', ''),
(29, 'GSDI', '2019-03-12', 'GSDI-2019-03-12-01', 'Pressing', 'Screw Press No. 5', 'bearing suara kasar', '', 14568, 'plan', 'close');

-- --------------------------------------------------------

--
-- Struktur dari tabel `o_feedback_boiler`
--

CREATE TABLE IF NOT EXISTS `o_feedback_boiler` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(11) NOT NULL,
  `parameter` varchar(16) NOT NULL,
  `softener_1` float NOT NULL,
  `softener_2` float NOT NULL,
  `std_feed` varchar(11) NOT NULL,
  `feed_1` float NOT NULL,
  `std_boiler` varchar(11) NOT NULL,
  `boiler_1` float NOT NULL,
  `boiler_2` float NOT NULL,
  `boiler_3` float NOT NULL,
  `boiler_4` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `o_feedback_boiler`
--

INSERT INTO `o_feedback_boiler` (`tanggal`, `id_pabrik`, `parameter`, `softener_1`, `softener_2`, `std_feed`, `feed_1`, `std_boiler`, `boiler_1`, `boiler_2`, `boiler_3`, `boiler_4`) VALUES
('2019-02-07', 'ANA', 'pH', 7, 7, '7.0-8.0', 7, '10.5-11.5', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'Cond/TDS', 7, 7, 'Maks 100', 0, 'Maks 2000', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'P.Alk', 7, 7, '', 0, '', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'C.Alk', 7, 7, '', 0, 'Min 2.5XSiO', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'M.Alk', 7, 7, '', 0, 'Maks 700', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'Tot.Hardnes', 7, 7, 'trace', 0, 'trace', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'Sulfite', 7, 7, '', 0, '30 - 50', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'Silica', 7, 7, 'Maks 5', 0, 'Maks 150', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'Phospate', 7, 7, '', 0, '20 - 30', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'Fe / Iron', 7, 7, '', 0, '', 11, 11, 0, 0),
('2019-02-07', 'ANA', 'Turbidity', 7, 7, 'Maks 1', 0, '', 11, 11, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `o_feedback_effluent`
--

CREATE TABLE IF NOT EXISTS `o_feedback_effluent` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `item` varchar(32) NOT NULL,
  `standard` varchar(32) NOT NULL,
  `anaerobic_1` float NOT NULL,
  `anaerobic_2` float NOT NULL,
  `anaerobic_3` float NOT NULL,
  `anaerobic_4` float NOT NULL,
  `rata` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `o_feedback_effluent`
--

INSERT INTO `o_feedback_effluent` (`tanggal`, `id_pabrik`, `item`, `standard`, `anaerobic_1`, `anaerobic_2`, `anaerobic_3`, `anaerobic_4`, `rata`) VALUES
('2019-02-07', 'ANA', 'pH', '7.0 - 7.4', 5, 55, 555, 5555, 1),
('2019-02-07', 'ANA', 'VFA', '&lt; 1000', 5, 55, 555, 5555, 1),
('2019-02-07', 'ANA', 'Alkalinity', '&gt; 4000', 5, 55, 555, 5555, 1),
('2019-02-07', 'ANA', 'VFA/Alk', '&lt; 0.25', 5, 55, 555, 5555, 1),
('2019-02-07', 'ANA', 'Feeding', '', 5, 55, 555, 5555, 1),
('2019-02-07', 'ANA', 'HRD', '', 5, 55, 555, 5555, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `o_feedback_kcp`
--

CREATE TABLE IF NOT EXISTS `o_feedback_kcp` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `item` varchar(32) NOT NULL,
  `deskripsi` varchar(32) NOT NULL,
  `standard` varchar(32) NOT NULL,
  `unit_1` float NOT NULL,
  `unit_2` float NOT NULL,
  `unit_3` float NOT NULL,
  `unit_4` float NOT NULL,
  `unit_5` float NOT NULL,
  `unit_6` float NOT NULL,
  `unit_7` float NOT NULL,
  `unit_8` float NOT NULL,
  `unit_9` float NOT NULL,
  `unit_10` float NOT NULL,
  `rata` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `o_feedback_kcp`
--

INSERT INTO `o_feedback_kcp` (`tanggal`, `id_pabrik`, `item`, `deskripsi`, `standard`, `unit_1`, `unit_2`, `unit_3`, `unit_4`, `unit_5`, `unit_6`, `unit_7`, `unit_8`, `unit_9`, `unit_10`, `rata`) VALUES
('2019-02-07', 'ANA', 'Kernel Olah', 'Dirty', 'Maks 6', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('2019-02-07', 'ANA', 'Kernel Olah', 'Moisture', 'Maks 6', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
('2019-02-07', 'ANA', 'Kernel Olah', 'Kernel Pecah', 'Maks 15', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('2019-02-07', 'ANA', 'First Press', 'Moisture', 'Maks 7.0', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
('2019-02-07', 'ANA', 'First Press', 'Oil losses', '12.0-14.0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('2019-02-07', 'ANA', 'Second Press', 'Moisture', 'Maks 7.0', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
('2019-02-07', 'ANA', 'Second Press', 'Oil losses', 'Maks 7.0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('2019-02-07', 'ANA', 'PKO After Filter', 'FFA', 'Maks 2.0', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
('2019-02-07', 'ANA', 'PKO After Filter', 'Moisture', 'Maks 0.20', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('2019-02-07', 'ANA', 'PKO After Filter', 'Dirty', 'Maks 0.020', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
('2019-02-07', 'ANA', 'Storage Tank', 'FFA', 'Maks 2.0', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('2019-02-07', 'ANA', 'Storage Tank', 'Moisture', 'Maks 0.20', 2, 2, 2, 2, 2, 2, 2, 2, 2, 2, 2),
('2019-02-07', 'ANA', 'Storage Tank', 'Dirty', 'Maks 0.020', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `o_feedback_olah`
--

CREATE TABLE IF NOT EXISTS `o_feedback_olah` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `tbs_olah` float NOT NULL,
  `tbs_terima` float NOT NULL,
  `taksasi` float NOT NULL,
  `rata_lori` float NOT NULL,
  `er_cpo` float NOT NULL,
  `er_kernel` float NOT NULL,
  `er_pko` float NOT NULL,
  `troughput_pom` float NOT NULL,
  `troughtput_kcp` float NOT NULL,
  `pemakaian_air` float NOT NULL,
  `oil_content_kernel` float NOT NULL,
  `sludge_olah` float NOT NULL,
  `usb` float NOT NULL,
  `press_cake` float NOT NULL,
  `tandan_kosong` float NOT NULL,
  `heavy_phase` float NOT NULL,
  `wet_nut` float NOT NULL,
  `total_abs_loss` float NOT NULL,
  `destoner` float NOT NULL,
  `fiber_cyclone` float NOT NULL,
  `ltds1` float NOT NULL,
  `ltds2` float NOT NULL,
  `hydrocyclone` float NOT NULL,
  `total_kernel_loss` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `o_feedback_olah`
--

INSERT INTO `o_feedback_olah` (`tanggal`, `id_pabrik`, `tbs_olah`, `tbs_terima`, `taksasi`, `rata_lori`, `er_cpo`, `er_kernel`, `er_pko`, `troughput_pom`, `troughtput_kcp`, `pemakaian_air`, `oil_content_kernel`, `sludge_olah`, `usb`, `press_cake`, `tandan_kosong`, `heavy_phase`, `wet_nut`, `total_abs_loss`, `destoner`, `fiber_cyclone`, `ltds1`, `ltds2`, `hydrocyclone`, `total_kernel_loss`) VALUES
('2019-02-07', 'ANA', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24);

-- --------------------------------------------------------

--
-- Struktur dari tabel `o_feedback_pks`
--

CREATE TABLE IF NOT EXISTS `o_feedback_pks` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `item` varchar(32) NOT NULL,
  `deskripsi` varchar(32) NOT NULL,
  `standard` varchar(64) NOT NULL,
  `unit_1` float NOT NULL,
  `unit_2` float NOT NULL,
  `unit_3` float NOT NULL,
  `unit_4` float NOT NULL,
  `unit_5` float NOT NULL,
  `unit_6` float NOT NULL,
  `unit_7` float NOT NULL,
  `unit_8` float NOT NULL,
  `unit_9` float NOT NULL,
  `unit_10` float NOT NULL,
  `rata` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `o_feedback_pks`
--

INSERT INTO `o_feedback_pks` (`tanggal`, `id_pabrik`, `item`, `deskripsi`, `standard`, `unit_1`, `unit_2`, `unit_3`, `unit_4`, `unit_5`, `unit_6`, `unit_7`, `unit_8`, `unit_9`, `unit_10`, `rata`) VALUES
('2019-02-07', 'ANA', 'USB', '', 'Maks 1', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Tankos', 'Oil Wet Basis', '? 0,80', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'USB Recyciling', 'Efficiensi', '? 95', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Press Cake', 'Oil Wet Basis', 'Maks 3.6', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Press Cake', 'Oil Dry Basis', 'Maks 6', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Press Cake', 'B.Nut/Tot Nut', 'Maks 18', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Nut', 'Oil Wet Basis', '? 0.5', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Riple Mill', 'BROKEN KERNEL', 'Maks 14', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Riple Mill', 'Efficiensi', '&gt;95', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Fibre Cyclone', 'Kernel Losses', 'Maks 1', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'LTDS 1', 'Kernel Losses', 'Maks 1', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'LTDS 2', 'Kernel Losses', 'Maks 1', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Dekstoner', 'Kernel Losses', 'Maks 1', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Shell Exs HDC', 'Kernel Losses', 'Maks 2', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Kernel Exs HDC', 'Dirty', 'Maks 7.5', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Kernel Exs LTDS 1', 'Dirty', 'Maks 7.5', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Kernel Exs LTDS 2', 'Dirty', 'Maks 7.5', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Kernel Gabungan', 'Dirty', 'Maks 7.5', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Kernel Produksi', 'Dirty', 'Maks 5,0', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Kernel Produksi', 'Moisture', '5,0 - 6,0', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Kernel Produksi', 'Kernel Pecah', 'Maks 15', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Condensate', 'Oil Wet Basis', 'Maks 1', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Condensate', 'Oil Dry Basis', '12.0 - 14.0', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Sludge Under flow', 'Moisture', '&gt; 85', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Sludge Under flow', 'Oil Wet Basis', 'Maks 6.0', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Sludge Sparator', 'Oil Wet Basis', 'Maks 0.7', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Sludge Sparator', 'Oil Dry Basis', 'Maks 10', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Sludge Pit', 'Oil Wet Basis', 'Maks 1', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Sludge Pit', 'Oil Dry Basis', 'Maks 14', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Feed Purifier', 'Moisture', '? 0.90', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Feed Purifier', 'Dirty', '? 0.06', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'After Purifier', 'Moisture', '? 0.50', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'After Purifier', 'Dirty', '? 0.02', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'CPO Produksi', 'FFA', 'Maks 3.0', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'CPO Produksi', 'Moisture', '? 0.20', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'CPO Produksi', 'Dirty', '? 0.02', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'CPO Produksi', 'DOBI', 'Min 2.5', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'CPO Produksi', 'CAROTEN', '± 500', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Storage Tank', 'FFA', 'Maks 3.0', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Storage Tank', 'Moisture', '? 0.20', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Storage Tank', 'Dirty', '? 0.02', 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 5.5),
('2019-02-07', 'ANA', 'Kernel Olah', 'Dirty', 'Maks 6', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'Kernel Olah', 'Moisture', 'Maks 6', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'Kernel Olah', 'Kernel Pecah', 'Maks 15', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'First Press', 'Moisture', 'Maks 7.0', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'First Press', 'Oil losses', '12.0-14.0', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'Second Press', 'Moisture', 'Maks 7.0', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'Second Press', 'Oil losses', 'Maks 7.0', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'PKO After Filter', 'FFA', 'Maks 2.0', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'PKO After Filter', 'Moisture', 'Maks 0.20', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'PKO After Filter', 'Dirty', 'Maks 0.020', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'Storage Tank', 'FFA', 'Maks 2.0', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'Storage Tank', 'Moisture', 'Maks 0.20', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'Storage Tank', 'Dirty', 'Maks 0.020', 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 11.5),
('2019-02-07', 'ANA', 'Kernel Olah', 'Dirty', 'Maks 6', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'Kernel Olah', 'Moisture', 'Maks 6', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'Kernel Olah', 'Kernel Pecah', 'Maks 15', 66, 66, 66, 66, 66, 66, 66, 66, 66, 66, 66),
('2019-02-07', 'ANA', 'First Press', 'Moisture', 'Maks 7.0', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'First Press', 'Oil losses', '12.0-14.0', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'Second Press', 'Moisture', 'Maks 7.0', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'Second Press', 'Oil losses', 'Maks 7.0', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'PKO After Filter', 'FFA', 'Maks 2.0', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'PKO After Filter', 'Moisture', 'Maks 0.20', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'PKO After Filter', 'Dirty', 'Maks 0.020', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'Storage Tank', 'FFA', 'Maks 2.0', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'Storage Tank', 'Moisture', 'Maks 0.20', 6, 6, 6, 6, 6, 6, 6, 6, 6, 6, 6),
('2019-02-07', 'ANA', 'Storage Tank', 'Dirty', 'Maks 0.020', 12, 13, 14, 15, 16, 17, 18, 19, 20, 22, 25);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `user` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=389 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `kategori`) VALUES
(350, 'franggoro', '123', 0),
(351, 'bdpermana', '123', 1),
(352, 'ANA', '123', 2),
(353, 'BCL2 ', '123', 2),
(354, 'BIM', '123', 2),
(355, 'SINP', '123', 2),
(356, 'CAN3', '123', 2),
(357, 'CAP2', '123', 2),
(358, 'CPN', '123', 2),
(359, 'EDC', '123', 2),
(360, 'EDI', '123', 2),
(361, 'EDP', '123', 2),
(362, 'KED', '123', 2),
(363, 'KED2', '123', 2),
(364, 'KTS', '123', 2),
(365, 'KTU', '123', 2),
(366, 'LTT', '123', 2),
(367, 'LTW', '123', 2),
(368, 'NAL', '123', 2),
(369, 'PLB', '123', 2),
(370, 'PLB2', '123', 2),
(371, 'PSK', '123', 2),
(372, 'PWR', '123', 2),
(373, 'SAI', '123', 2),
(374, 'SAL1', '123', 2),
(375, 'SAL2', '123', 2),
(376, 'SAM', '123', 2),
(377, 'GSDI', '123', 2),
(378, 'GSIP', '123', 2),
(379, 'SJA2', '123', 2),
(380, 'SKP', '123', 2),
(381, 'SLS1', '123', 2),
(382, 'SLS2', '123', 2),
(383, 'GSPP', '123', 2),
(384, 'SRL1', '123', 2),
(385, 'SRL2', '123', 2),
(386, 'STN', '123', 2),
(387, 'TBM', '123', 2),
(388, 'TPP', '123', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `master_karyawan`
--
ALTER TABLE `master_karyawan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_pabrik`
--
ALTER TABLE `master_pabrik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_station`
--
ALTER TABLE `master_station`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_unit`
--
ALTER TABLE `master_unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_unit_elektrik`
--
ALTER TABLE `master_unit_elektrik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_acm`
--
ALTER TABLE `m_acm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_activity`
--
ALTER TABLE `m_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_activity_detail`
--
ALTER TABLE `m_activity_detail`
  ADD KEY `id_pabrik` (`id_pabrik`),
  ADD KEY `tanggal` (`tanggal`),
  ADD KEY `no_wo` (`no_wo`);

--
-- Indexes for table `m_breakdown_pabrik`
--
ALTER TABLE `m_breakdown_pabrik`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_capex_pi`
--
ALTER TABLE `m_capex_pi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_capex_prpo`
--
ALTER TABLE `m_capex_prpo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_highlight`
--
ALTER TABLE `m_highlight`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_inventory`
--
ALTER TABLE `m_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_lkpmp`
--
ALTER TABLE `m_lkpmp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_recordhm`
--
ALTER TABLE `m_recordhm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_recordhm_bunchpress`
--
ALTER TABLE `m_recordhm_bunchpress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_recordhm_hydrocyclone`
--
ALTER TABLE `m_recordhm_hydrocyclone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_recordhm_screwpress`
--
ALTER TABLE `m_recordhm_screwpress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_wo`
--
ALTER TABLE `m_wo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pabrik` (`id_pabrik`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user` (`user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `master_karyawan`
--
ALTER TABLE `master_karyawan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `master_pabrik`
--
ALTER TABLE `master_pabrik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `master_station`
--
ALTER TABLE `master_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=125;
--
-- AUTO_INCREMENT for table `master_unit`
--
ALTER TABLE `master_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=1055;
--
-- AUTO_INCREMENT for table `master_unit_elektrik`
--
ALTER TABLE `master_unit_elektrik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=933;
--
-- AUTO_INCREMENT for table `m_acm`
--
ALTER TABLE `m_acm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=453;
--
-- AUTO_INCREMENT for table `m_activity`
--
ALTER TABLE `m_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=104;
--
-- AUTO_INCREMENT for table `m_breakdown_pabrik`
--
ALTER TABLE `m_breakdown_pabrik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `m_capex_pi`
--
ALTER TABLE `m_capex_pi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `m_capex_prpo`
--
ALTER TABLE `m_capex_prpo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `m_highlight`
--
ALTER TABLE `m_highlight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `m_inventory`
--
ALTER TABLE `m_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=49;
--
-- AUTO_INCREMENT for table `m_lkpmp`
--
ALTER TABLE `m_lkpmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `m_recordhm`
--
ALTER TABLE `m_recordhm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=293;
--
-- AUTO_INCREMENT for table `m_recordhm_bunchpress`
--
ALTER TABLE `m_recordhm_bunchpress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `m_recordhm_hydrocyclone`
--
ALTER TABLE `m_recordhm_hydrocyclone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_recordhm_screwpress`
--
ALTER TABLE `m_recordhm_screwpress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=355;
--
-- AUTO_INCREMENT for table `m_wo`
--
ALTER TABLE `m_wo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=389;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
