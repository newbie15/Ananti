-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 25 Okt 2019 pada 13.22
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ananti`
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_pabrik`
--

CREATE TABLE IF NOT EXISTS `master_pabrik` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `tipe` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_pabrik`
--

INSERT INTO `master_pabrik` (`id`, `nama`, `tipe`) VALUES
(1, 'GSDI', 'Mill 60 Tph');

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `master_station`
--

CREATE TABLE IF NOT EXISTS `master_station` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_station`
--

INSERT INTO `master_station` (`id`, `id_pabrik`, `nama`) VALUES
(1, 'GSDI', 'Loading Ramp');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_unit`
--

INSERT INTO `master_unit` (`id`, `id_pabrik`, `id_station`, `kode_asset`, `nama`, `hm_installed`, `oil_monitoring`, `screwpress_monitoring`, `bunchpress_monitoring`, `hydrocyclone_monitoring`, `kcp_monitoring`) VALUES
(1, 'GSDI', 'Loading Ramp', '', 'FFB Conveyor', 1, 0, 0, 0, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `master_unit_elektrik`
--

INSERT INTO `master_unit_elektrik` (`id`, `id_pabrik`, `id_station`, `unit`, `merk`, `kw`, `class`, `starter`, `mccb`, `kontaktor_line`, `kontaktor_delta`, `kontaktor_star`, `kabel`, `jumlah_kabel`) VALUES
(1, 'GSDI', 'Loading Ramp', 'FFB Conveyor', '', 7.5, '', 'Star-Delta', 20, 20, 18, 0, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_acm`
--

INSERT INTO `m_acm` (`id`, `tanggal`, `id_pabrik`, `id_station`, `unit`, `acm`, `keterangan`) VALUES
(3, '2019-10-25', 'GSDI', 'Loading Ramp', 'FFB Conveyor', 1, '');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_megger`
--

CREATE TABLE IF NOT EXISTS `m_megger` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(8) NOT NULL,
  `tahun` int(11) NOT NULL,
  `station` varchar(16) NOT NULL,
  `unit` varchar(32) NOT NULL,
  `kabel_rs` varchar(8) DEFAULT NULL,
  `kabel_st` varchar(8) DEFAULT NULL,
  `kabel_tr` varchar(8) DEFAULT NULL,
  `kabel_rn` varchar(8) DEFAULT NULL,
  `kabel_sn` varchar(8) DEFAULT NULL,
  `kabel_tn` varchar(8) DEFAULT NULL,
  `motor_rs` varchar(8) DEFAULT NULL,
  `motor_st` varchar(8) DEFAULT NULL,
  `motor_tr` varchar(8) DEFAULT NULL,
  `motor_re` varchar(8) DEFAULT NULL,
  `motor_se` varchar(8) DEFAULT NULL,
  `motor_te` varchar(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_motor`
--

CREATE TABLE IF NOT EXISTS `m_motor` (
  `tahun` varchar(4) NOT NULL,
  `periode` tinyint(4) NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `station` varchar(16) NOT NULL,
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
-- Struktur dari tabel `m_planing`
--

CREATE TABLE IF NOT EXISTS `m_planing` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `station` varchar(32) NOT NULL,
  `unit` varchar(32) NOT NULL,
  `problem` varchar(32) NOT NULL,
  `plan` varchar(32) NOT NULL,
  `mpp` varchar(32) NOT NULL,
  `nama_mpp` varchar(32) NOT NULL,
  `mek_el` varchar(32) NOT NULL,
  `start` varchar(32) NOT NULL,
  `stop` varchar(32) NOT NULL,
  `time` varchar(32) NOT NULL,
  `ket` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_planing`
--

INSERT INTO `m_planing` (`id`, `id_pabrik`, `tanggal`, `station`, `unit`, `problem`, `plan`, `mpp`, `nama_mpp`, `mek_el`, `start`, `stop`, `time`, `ket`) VALUES
(3, 'GSDI', '2019-10-25', 'Loading Ramp', 'FFB conveyor', 'Shaft Geser', '', '2', '', '', '', '', '', ''),
(4, 'GSDI', '2019-10-25', 'Loading Ramp', 'winch', 'putus', '', '1', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `m_polarisasi`
--

CREATE TABLE IF NOT EXISTS `m_polarisasi` (
  `id` int(11) NOT NULL,
  `id_pabrik` varchar(8) NOT NULL,
  `tahun` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `unit` varchar(32) NOT NULL,
  `fase` varchar(5) NOT NULL,
  `detik_0` float NOT NULL,
  `detik_30` float NOT NULL,
  `menit_1` float NOT NULL,
  `menit_10` float NOT NULL,
  `ratio_IP1` float NOT NULL,
  `ratio_IP2` float NOT NULL,
  `hasil_IP1` float NOT NULL,
  `hasil_IP2` float NOT NULL,
  `result` varchar(16) NOT NULL
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `m_wo`
--

INSERT INTO `m_wo` (`id`, `id_pabrik`, `tanggal`, `no_wo`, `station`, `unit`, `problem`, `desc_masalah`, `hm`, `kategori`, `status`) VALUES
(1, 'GSDI', '2019-10-25', 'GSDI-2019-10-25-01', 'Loading Ramp', 'FFB Conveyor', 'shaft geser', '', 0, 'unplan', 'open');

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
  `total_kernel_loss` float NOT NULL,
  `s_cpo` float NOT NULL,
  `s_pko` float NOT NULL,
  `s_kernel` float NOT NULL,
  `s_pke` float NOT NULL,
  `breakdown` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `user` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `kategori` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `user`, `password`, `kategori`) VALUES
(4, 'franggoro', '123', 0),
(5, 'ananti', 'ananti', 0),
(6, 'GSDI', 'GSDI', 2);

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
-- Indexes for table `m_megger`
--
ALTER TABLE `m_megger`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_planing`
--
ALTER TABLE `m_planing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `m_polarisasi`
--
ALTER TABLE `m_polarisasi`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_pabrik`
--
ALTER TABLE `master_pabrik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_station`
--
ALTER TABLE `master_station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_unit`
--
ALTER TABLE `master_unit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_unit_elektrik`
--
ALTER TABLE `master_unit_elektrik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `m_acm`
--
ALTER TABLE `m_acm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `m_activity`
--
ALTER TABLE `m_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_breakdown_pabrik`
--
ALTER TABLE `m_breakdown_pabrik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_capex_pi`
--
ALTER TABLE `m_capex_pi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_capex_prpo`
--
ALTER TABLE `m_capex_prpo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_highlight`
--
ALTER TABLE `m_highlight`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_inventory`
--
ALTER TABLE `m_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_lkpmp`
--
ALTER TABLE `m_lkpmp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_megger`
--
ALTER TABLE `m_megger`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_planing`
--
ALTER TABLE `m_planing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `m_polarisasi`
--
ALTER TABLE `m_polarisasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_recordhm`
--
ALTER TABLE `m_recordhm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_recordhm_bunchpress`
--
ALTER TABLE `m_recordhm_bunchpress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_recordhm_hydrocyclone`
--
ALTER TABLE `m_recordhm_hydrocyclone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_recordhm_screwpress`
--
ALTER TABLE `m_recordhm_screwpress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `m_wo`
--
ALTER TABLE `m_wo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
