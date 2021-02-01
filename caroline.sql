-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.6.34 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             10.3.0.5771
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table ananti.aux_job_aid
CREATE TABLE IF NOT EXISTS `aux_job_aid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(64) DEFAULT NULL,
  `kategori` varchar(64) DEFAULT NULL,
  `nama` varchar(512) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `Index 1` (`id`,`nomor`,`kategori`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.aux_job_aid: ~2 rows (approximately)
/*!40000 ALTER TABLE `aux_job_aid` DISABLE KEYS */;
INSERT INTO `aux_job_aid` (`id`, `nomor`, `kategori`, `nama`, `comment`) VALUES
	(1, 'J4', 'Transformer', 'Transformer, Oil-Filled >500 KVA (incl. OLTC)', NULL),
	(2, 'J5', 'Transformer', 'Transformer, Oil-Filled >= 5000 KVA (incl. OLTC)', NULL);
/*!40000 ALTER TABLE `aux_job_aid` ENABLE KEYS */;

-- Dumping structure for table ananti.aux_unit_type
CREATE TABLE IF NOT EXISTS `aux_unit_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) DEFAULT NULL,
  `nama` varchar(128) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.aux_unit_type: ~5 rows (approximately)
/*!40000 ALTER TABLE `aux_unit_type` DISABLE KEYS */;
INSERT INTO `aux_unit_type` (`id`, `type`, `nama`, `comment`) VALUES
	(1, 'A', 'Agitators', NULL),
	(2, 'B', 'Blowers, Fans', NULL),
	(3, 'C', 'Compressors', NULL),
	(4, 'CF', 'Centrifuges, Purifier and Decanter', NULL),
	(5, 'CV', 'Conveyors, elevator', NULL);
/*!40000 ALTER TABLE `aux_unit_type` ENABLE KEYS */;

-- Dumping structure for table ananti.aux_work_execution
CREATE TABLE IF NOT EXISTS `aux_work_execution` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(50) DEFAULT NULL,
  `mode` varchar(50) DEFAULT NULL,
  `nama` varchar(512) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `Index 1` (`id`,`nomor`,`mode`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.aux_work_execution: ~1 rows (approximately)
/*!40000 ALTER TABLE `aux_work_execution` DISABLE KEYS */;
INSERT INTO `aux_work_execution` (`id`, `nomor`, `mode`, `nama`, `comment`) VALUES
	(1, 'A0', 'Online', 'Visual Inspection  (during operation)', '<p>\n	The individual job aids do not distinguish between Safety and RE specific inspeciton points. While only the safety relevant points are required to be checked during the visual inspection it is recommended to include all RE ones as the addional required to execute the task is usually estimated to be minimal&nbsp;</p>\n');
/*!40000 ALTER TABLE `aux_work_execution` ENABLE KEYS */;

-- Dumping structure for table ananti.master_attachment
CREATE TABLE IF NOT EXISTS `master_attachment` (
  `id_pabrik` varchar(8) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `id_sub_unit` varchar(64) NOT NULL,
  `nomor` varchar(64) NOT NULL,
  `attachment` varchar(64) NOT NULL,
  `cm` varchar(1024) NOT NULL,
  `job_aid` varchar(1024) NOT NULL,
  `work_exec` varchar(1024) NOT NULL,
  KEY `id_pabrik` (`id_pabrik`),
  KEY `id_station` (`id_station`),
  KEY `id_unit` (`id_unit`),
  KEY `id_sub_unit` (`id_sub_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_attachment: ~7 rows (approximately)
/*!40000 ALTER TABLE `master_attachment` DISABLE KEYS */;
INSERT INTO `master_attachment` (`id_pabrik`, `id_station`, `id_unit`, `id_sub_unit`, `nomor`, `attachment`, `cm`, `job_aid`, `work_exec`) VALUES
	('MSL', '100', '1', '1', '1', 'Screw Press', '', '', ''),
	('MSL', '100', '1', '1', '2', 'Elektromotor', '', '', ''),
	('MSL', '100', '1', '1', '3', 'Gearbox', '', '', ''),
	('MSL', '100', '1', '1', '4', 'Coupling', '', '', ''),
	('MSL', '100', '1', '2', '1', 'Power Pack', '', '', ''),
	('MSL', '100', '1', '2', '2', 'Elektromotor', '', '', ''),
	('MSL', '100', '1', '2', '3', 'Cylinder Rod', '', '', '');
/*!40000 ALTER TABLE `master_attachment` ENABLE KEYS */;

-- Dumping structure for table ananti.master_group
CREATE TABLE IF NOT EXISTS `master_group` (
  `id_pabrik` varchar(8) NOT NULL,
  `nama` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_group` ENABLE KEYS */;

-- Dumping structure for table ananti.master_grouping
CREATE TABLE IF NOT EXISTS `master_grouping` (
  `id_pabrik` varchar(8) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `id_sub_unit` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_grouping: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_grouping` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_grouping` ENABLE KEYS */;

-- Dumping structure for table ananti.master_karyawan
CREATE TABLE IF NOT EXISTS `master_karyawan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `bagian` varchar(64) NOT NULL,
  `sync` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_karyawan: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_karyawan` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_karyawan` ENABLE KEYS */;

-- Dumping structure for table ananti.master_pabrik
CREATE TABLE IF NOT EXISTS `master_pabrik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(64) NOT NULL,
  `kapasitas` varchar(64) NOT NULL,
  `area` varchar(8) NOT NULL,
  `sync` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_pabrik: ~10 rows (approximately)
/*!40000 ALTER TABLE `master_pabrik` DISABLE KEYS */;
INSERT INTO `master_pabrik` (`id`, `nama`, `kapasitas`, `area`, `sync`) VALUES
	(1, 'MSL', '', '', 0),
	(2, 'MMK', '', '', 0),
	(3, 'MTD', '', '', 0),
	(4, 'MMM', '', '', 0),
	(5, 'PJM', '', '', 0),
	(6, 'RVM', '', '', 0),
	(7, 'SKIM', '', '', 0),
	(8, 'KDIM', '', '', 0),
	(9, 'SHMM', '', '', 0),
	(10, 'AMRG', '', 'Sulawesi', 0);
/*!40000 ALTER TABLE `master_pabrik` ENABLE KEYS */;

-- Dumping structure for table ananti.master_part
CREATE TABLE IF NOT EXISTS `master_part` (
  `id_pabrik` varchar(50) DEFAULT NULL,
  `id_station` varchar(50) DEFAULT NULL,
  `id_unit` varchar(64) DEFAULT NULL,
  `id_sub_unit` varchar(64) DEFAULT NULL,
  `id_attachment` varchar(64) DEFAULT NULL,
  `part` varchar(64) DEFAULT NULL,
  `spesifikasi` varchar(128) NOT NULL,
  `lifetime` float DEFAULT NULL,
  KEY `id_pabrik` (`id_pabrik`),
  KEY `id_pabrik_2` (`id_pabrik`,`id_station`,`id_unit`,`id_sub_unit`,`id_attachment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_part: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_part` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_part` ENABLE KEYS */;

-- Dumping structure for table ananti.master_part_catalog
CREATE TABLE IF NOT EXISTS `master_part_catalog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nomor` varchar(64) DEFAULT NULL,
  `nama` varchar(64) DEFAULT NULL,
  `spec` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_part_catalog: ~1 rows (approximately)
/*!40000 ALTER TABLE `master_part_catalog` DISABLE KEYS */;
INSERT INTO `master_part_catalog` (`id`, `nomor`, `nama`, `spec`) VALUES
	(1, 'x345-yz', 'bearing 6205', 'high speed bearing');
/*!40000 ALTER TABLE `master_part_catalog` ENABLE KEYS */;

-- Dumping structure for table ananti.master_plant
CREATE TABLE IF NOT EXISTS `master_plant` (
  `id_pabrik` varchar(8) NOT NULL,
  `plant_code` varchar(16) NOT NULL,
  `plant_name` varchar(16) NOT NULL,
  `b` int(11) NOT NULL,
  `sync` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_plant: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_plant` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_plant` ENABLE KEYS */;

-- Dumping structure for table ananti.master_schedule
CREATE TABLE IF NOT EXISTS `master_schedule` (
  `id_pabrik` varchar(16) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `id_sub_unit` varchar(64) NOT NULL,
  `monitoring_item` varchar(128) NOT NULL,
  `standard` varchar(64) NOT NULL,
  `parameter` varchar(128) NOT NULL,
  `waktu` smallint(6) NOT NULL,
  `frekuensi` varchar(128) NOT NULL,
  `sync` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_schedule: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_schedule` ENABLE KEYS */;

-- Dumping structure for table ananti.master_schedule_monitoring
CREATE TABLE IF NOT EXISTS `master_schedule_monitoring` (
  `tahun` int(11) NOT NULL,
  `id_pabrik` varchar(16) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `id_sub_unit` varchar(64) NOT NULL,
  `item` varchar(64) NOT NULL,
  `start` date NOT NULL,
  `stop` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_schedule_monitoring: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_schedule_monitoring` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_schedule_monitoring` ENABLE KEYS */;

-- Dumping structure for table ananti.master_station
CREATE TABLE IF NOT EXISTS `master_station` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(64) NOT NULL,
  `nomor` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `sync` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_station: ~21 rows (approximately)
/*!40000 ALTER TABLE `master_station` DISABLE KEYS */;
INSERT INTO `master_station` (`id`, `id_pabrik`, `nomor`, `nama`, `sync`) VALUES
	(33, 'MSL', '100', 'Palm Oil Mill Common', 0),
	(34, 'MSL', '101', 'Fruit Reception Station', 0),
	(35, 'MSL', '102', 'Sterilizer Station', 0),
	(36, 'MSL', '103', 'Threshing Station', 0),
	(37, 'MSL', '104', 'Press Station', 0),
	(38, 'MSL', '105', 'Clarification Station', 0),
	(39, 'MSL', '106', 'Depericarper &amp; Kernel Recovery  Station', 0),
	(40, 'MSL', '107', 'Empty Bunch Press Station', 0),
	(41, 'MSL', '108', 'Effluent Treatment Plant', 0),
	(42, 'MSL', '109', 'Biogas Treatment Plant', 0),
	(43, 'MSL', '111', 'Kernel Crushing Plant', 0),
	(44, 'MSL', '90', 'Utilities (Boiler/Steam)', 0),
	(45, 'MSL', '91', 'Utilities (Waste Water)', 0),
	(46, 'MSL', '92', 'Utilities (Incomming Water Pretreatment)', 0),
	(47, 'MSL', '93', 'Utilities (Electical Distribution, Power House)', 0),
	(48, 'MSL', '94', 'Utilities (Fire Systems)', 0),
	(49, 'MSL', '95', 'Utilities (Refrigeration/chiller Systems Including HVAC )', 0),
	(50, 'MSL', '96', 'Utilities (Cooling Water Tower Systems)', 0),
	(51, 'MSL', '97', 'Utilities (Gasses Including Plant Air, Nitrogen, CO2 Etc )', 0),
	(52, 'MSL', '98', 'Utilities (Weighbridges)', 0),
	(53, 'MSL', '99', 'Utilities (Chemicals)', 0);
/*!40000 ALTER TABLE `master_station` ENABLE KEYS */;

-- Dumping structure for table ananti.master_sub_unit
CREATE TABLE IF NOT EXISTS `master_sub_unit` (
  `id_pabrik` varchar(8) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `nomor` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `klasifikasi` varchar(64) NOT NULL,
  `critical_unit` tinyint(4) NOT NULL,
  `hourmeter_mod` tinyint(4) NOT NULL,
  `vibration_mod` tinyint(4) NOT NULL,
  `temperature_mod` tinyint(4) NOT NULL,
  `oiling_mod` tinyint(4) NOT NULL,
  `electromotor_mod` tinyint(4) NOT NULL,
  `sync` int(11) NOT NULL DEFAULT '0',
  KEY `Id pabrik` (`id_pabrik`),
  KEY `unit` (`id_station`,`id_unit`,`nama`,`nomor`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_sub_unit: ~2 rows (approximately)
/*!40000 ALTER TABLE `master_sub_unit` DISABLE KEYS */;
INSERT INTO `master_sub_unit` (`id_pabrik`, `id_station`, `id_unit`, `nomor`, `nama`, `klasifikasi`, `critical_unit`, `hourmeter_mod`, `vibration_mod`, `temperature_mod`, `oiling_mod`, `electromotor_mod`, `sync`) VALUES
	('MSL', '100', '1', '1', 'Mekanikal System', '', 0, 0, 0, 0, 0, 0, 0),
	('MSL', '100', '1', '2', 'Hydraulic System', '', 0, 0, 0, 0, 0, 0, 0);
/*!40000 ALTER TABLE `master_sub_unit` ENABLE KEYS */;

-- Dumping structure for table ananti.master_unit
CREATE TABLE IF NOT EXISTS `master_unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(64) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `nomor` varchar(64) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `sync` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_pabrik` (`id_pabrik`,`id_station`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_unit: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_unit` DISABLE KEYS */;
INSERT INTO `master_unit` (`id`, `id_pabrik`, `id_station`, `nomor`, `nama`, `sync`) VALUES
	(2, 'MSL', '100', '1', 'Screw Press No 1', 0);
/*!40000 ALTER TABLE `master_unit` ENABLE KEYS */;

-- Dumping structure for table ananti.master_unit_elektrik
CREATE TABLE IF NOT EXISTS `master_unit_elektrik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(32) NOT NULL,
  `id_station` varchar(32) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `sub_unit` varchar(64) NOT NULL,
  `merk` varchar(64) NOT NULL,
  `kw` float NOT NULL,
  `class` varchar(2) NOT NULL,
  `starter` varchar(16) NOT NULL,
  `mccb` int(11) NOT NULL,
  `kontaktor_line` int(11) NOT NULL,
  `kontaktor_delta` int(11) NOT NULL,
  `kontaktor_star` int(11) NOT NULL,
  `kabel` float NOT NULL,
  `jumlah_kabel` int(11) NOT NULL,
  `sync` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_unit_elektrik: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_unit_elektrik` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_unit_elektrik` ENABLE KEYS */;

-- Dumping structure for table ananti.master_unit_mekanik
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
  `kapasitas_pompa` varchar(64) NOT NULL,
  `sync` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_unit_mekanik: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_unit_mekanik` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_unit_mekanik` ENABLE KEYS */;

-- Dumping structure for table ananti.master_vendor
CREATE TABLE IF NOT EXISTS `master_vendor` (
  `id_pabrik` varchar(8) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `bidang` varchar(512) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.master_vendor: ~0 rows (approximately)
/*!40000 ALTER TABLE `master_vendor` DISABLE KEYS */;
/*!40000 ALTER TABLE `master_vendor` ENABLE KEYS */;

-- Dumping structure for table ananti.m_acm
CREATE TABLE IF NOT EXISTS `m_acm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `acm` int(2) NOT NULL,
  `keterangan` varchar(64) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_acm: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_acm` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_acm` ENABLE KEYS */;

-- Dumping structure for table ananti.m_act
CREATE TABLE IF NOT EXISTS `m_act` (
  `id_pabrik` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `mpp` varchar(64) NOT NULL,
  `no_wo` varchar(32) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `id_sub_unit` varchar(64) NOT NULL,
  `problem` varchar(64) NOT NULL,
  `penyelesaian` varchar(64) NOT NULL,
  `start` varchar(6) NOT NULL,
  `stop` varchar(6) NOT NULL,
  `status` varchar(16) NOT NULL,
  `sparepart` varchar(256) NOT NULL,
  `verify` tinyint(4) NOT NULL DEFAULT '0',
  KEY `Index 1` (`id_pabrik`,`tanggal`,`mpp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_act: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_act` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_act` ENABLE KEYS */;

-- Dumping structure for table ananti.m_activity
CREATE TABLE IF NOT EXISTS `m_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(64) NOT NULL,
  `no_wo` varchar(64) NOT NULL,
  `tanggal` date NOT NULL,
  `perbaikan` varchar(160) NOT NULL,
  `status_perbaikan` varchar(32) NOT NULL,
  `unplan` tinyint(4) NOT NULL DEFAULT '0',
  `jenis_problem` enum('alat','proses') NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_activity: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_activity` ENABLE KEYS */;

-- Dumping structure for table ananti.m_activity_detail
CREATE TABLE IF NOT EXISTS `m_activity_detail` (
  `id_pabrik` varchar(32) NOT NULL,
  `tanggal` date NOT NULL,
  `no_wo` varchar(32) NOT NULL,
  `nama_teknisi` varchar(32) DEFAULT NULL,
  `t_mulai` varchar(8) NOT NULL,
  `t_selesai` varchar(8) NOT NULL,
  `r_mulai` varchar(8) NOT NULL,
  `r_selesai` varchar(8) NOT NULL,
  `realisasi` varchar(8) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id_pabrik` (`id_pabrik`),
  KEY `tanggal` (`tanggal`),
  KEY `no_wo` (`no_wo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_activity_detail: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_activity_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_activity_detail` ENABLE KEYS */;

-- Dumping structure for table ananti.m_breakdown_pabrik
CREATE TABLE IF NOT EXISTS `m_breakdown_pabrik` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `station` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `sub_unit` varchar(32) NOT NULL,
  `problem` varchar(64) NOT NULL,
  `jenis` varchar(64) NOT NULL,
  `tipe` varchar(64) NOT NULL,
  `tindakan` varchar(64) NOT NULL,
  `mulai` datetime NOT NULL,
  `selesai` datetime NOT NULL,
  `keterangan` text NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_breakdown_pabrik: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_breakdown_pabrik` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_breakdown_pabrik` ENABLE KEYS */;

-- Dumping structure for table ananti.m_capex_pi
CREATE TABLE IF NOT EXISTS `m_capex_pi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `progress` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_capex_pi: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_capex_pi` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_capex_pi` ENABLE KEYS */;

-- Dumping structure for table ananti.m_capex_prpo
CREATE TABLE IF NOT EXISTS `m_capex_prpo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(64) NOT NULL,
  `tahun` int(11) NOT NULL,
  `project_id` varchar(64) NOT NULL,
  `no_pr` varchar(64) NOT NULL,
  `nominal_pr` bigint(20) NOT NULL,
  `status` varchar(64) NOT NULL,
  `no_po` varchar(64) NOT NULL,
  `nominal_po` bigint(20) NOT NULL,
  `vendor` varchar(64) NOT NULL,
  `keterangan` varchar(128) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_capex_prpo: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_capex_prpo` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_capex_prpo` ENABLE KEYS */;

-- Dumping structure for table ananti.m_cost
CREATE TABLE IF NOT EXISTS `m_cost` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(8) NOT NULL,
  `pkrm` float NOT NULL,
  `porm` float NOT NULL,
  `pkolah` float NOT NULL,
  `poolah` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_cost: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_cost` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_cost` ENABLE KEYS */;

-- Dumping structure for table ananti.m_feedback
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

-- Dumping data for table ananti.m_feedback: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_feedback` ENABLE KEYS */;

-- Dumping structure for table ananti.m_grounding
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
  `keterangan` varchar(128) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_grounding: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_grounding` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_grounding` ENABLE KEYS */;

-- Dumping structure for table ananti.m_highlight
CREATE TABLE IF NOT EXISTS `m_highlight` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `penyelesaian` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_highlight: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_highlight` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_highlight` ENABLE KEYS */;

-- Dumping structure for table ananti.m_inventory
CREATE TABLE IF NOT EXISTS `m_inventory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(64) NOT NULL,
  `nama_barang` varchar(64) NOT NULL,
  `stok` int(11) NOT NULL,
  `min_stok` int(11) NOT NULL,
  `max_stok` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_inventory: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_inventory` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_inventory` ENABLE KEYS */;

-- Dumping structure for table ananti.m_inventory_keluar
CREATE TABLE IF NOT EXISTS `m_inventory_keluar` (
  `id_pabrik` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `wo` int(11) NOT NULL,
  `id_inventory` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_inventory_keluar: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_inventory_keluar` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_inventory_keluar` ENABLE KEYS */;

-- Dumping structure for table ananti.m_inventory_masuk
CREATE TABLE IF NOT EXISTS `m_inventory_masuk` (
  `id` int(11) DEFAULT NULL,
  `id_pabrik` varchar(16) NOT NULL,
  `tanggal` datetime NOT NULL,
  `kode_inventory` varchar(16) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_inventory_masuk: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_inventory_masuk` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_inventory_masuk` ENABLE KEYS */;

-- Dumping structure for table ananti.m_kapasitor
CREATE TABLE IF NOT EXISTS `m_kapasitor` (
  `id_pabrik` varchar(8) NOT NULL,
  `tahun` int(11) NOT NULL,
  `kapasitor` varchar(32) NOT NULL,
  `kvar` int(11) NOT NULL,
  `jan_r` float DEFAULT NULL,
  `jan_s` float DEFAULT NULL,
  `jan_t` float DEFAULT NULL,
  `feb_r` float DEFAULT NULL,
  `feb_s` float DEFAULT NULL,
  `feb_t` float DEFAULT NULL,
  `mar_r` float DEFAULT NULL,
  `mar_s` float DEFAULT NULL,
  `mar_t` float DEFAULT NULL,
  `apr_r` float DEFAULT NULL,
  `apr_s` float DEFAULT NULL,
  `apr_t` float DEFAULT NULL,
  `mei_r` float DEFAULT NULL,
  `mei_s` float DEFAULT NULL,
  `mei_t` float DEFAULT NULL,
  `jun_r` float DEFAULT NULL,
  `jun_s` float DEFAULT NULL,
  `jun_t` float DEFAULT NULL,
  `jul_r` float DEFAULT NULL,
  `jul_s` float DEFAULT NULL,
  `jul_t` float DEFAULT NULL,
  `agt_r` float DEFAULT NULL,
  `agt_s` float DEFAULT NULL,
  `agt_t` float DEFAULT NULL,
  `sep_r` float DEFAULT NULL,
  `sep_s` float DEFAULT NULL,
  `sep_t` float DEFAULT NULL,
  `okt_r` float DEFAULT NULL,
  `okt_s` float DEFAULT NULL,
  `okt_t` float DEFAULT NULL,
  `nov_r` float DEFAULT NULL,
  `nov_s` float DEFAULT NULL,
  `nov_t` float DEFAULT NULL,
  `des_r` float DEFAULT NULL,
  `des_s` float DEFAULT NULL,
  `des_t` float DEFAULT NULL,
  `keterangan` varchar(64) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_kapasitor: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_kapasitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_kapasitor` ENABLE KEYS */;

-- Dumping structure for table ananti.m_lkpmp
CREATE TABLE IF NOT EXISTS `m_lkpmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `keterangan` varchar(128) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_lkpmp: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_lkpmp` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_lkpmp` ENABLE KEYS */;

-- Dumping structure for table ananti.m_megger
CREATE TABLE IF NOT EXISTS `m_megger` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(8) NOT NULL,
  `tahun` int(11) NOT NULL,
  `station` varchar(16) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `sub_unit` varchar(64) NOT NULL,
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
  `motor_te` varchar(8) DEFAULT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_megger: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_megger` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_megger` ENABLE KEYS */;

-- Dumping structure for table ananti.m_motor
CREATE TABLE IF NOT EXISTS `m_motor` (
  `tahun` varchar(4) NOT NULL,
  `periode` tinyint(4) NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `station` varchar(16) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `sub_unit` varchar(64) NOT NULL,
  `ampere` float NOT NULL,
  `bearing_depan` float NOT NULL,
  `bearing_belakang` float NOT NULL,
  `suhu_body` float NOT NULL,
  `kondisi_fan` tinyint(4) NOT NULL,
  `seal_terminal` tinyint(4) NOT NULL,
  `kabel_gland` tinyint(4) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_motor: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_motor` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_motor` ENABLE KEYS */;

-- Dumping structure for table ananti.m_mr
CREATE TABLE IF NOT EXISTS `m_mr` (
  `id_pabrik` varchar(8) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `part_no` int(11) DEFAULT NULL,
  `part_desc` varchar(64) DEFAULT NULL,
  `spec1` varchar(64) DEFAULT NULL,
  `um` varchar(10) DEFAULT NULL,
  `qty` mediumint(9) DEFAULT NULL,
  `total_cost` float DEFAULT NULL,
  `cost_center` varchar(64) DEFAULT NULL,
  `kategori` varchar(64) DEFAULT NULL,
  `no_wo` varchar(64) DEFAULT NULL,
  `station` varchar(64) DEFAULT NULL,
  `unit` varchar(64) DEFAULT NULL,
  `sub_unit` varchar(64) DEFAULT NULL,
  KEY `no_wo` (`no_wo`),
  KEY `id_pabrik` (`id_pabrik`),
  KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_mr: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_mr` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_mr` ENABLE KEYS */;

-- Dumping structure for table ananti.m_oiling
CREATE TABLE IF NOT EXISTS `m_oiling` (
  `id_pabrik` varchar(8) NOT NULL,
  `id_station` varchar(32) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_unit` varchar(32) NOT NULL,
  `gearbox` varchar(64) NOT NULL,
  `powerpack` varchar(64) NOT NULL,
  `keterangan` varchar(64) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_oiling: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_oiling` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_oiling` ENABLE KEYS */;

-- Dumping structure for table ananti.m_planing
CREATE TABLE IF NOT EXISTS `m_planing` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `no_wo` varchar(64) NOT NULL,
  `station` varchar(32) NOT NULL,
  `unit` varchar(32) NOT NULL,
  `sub_unit` varchar(64) NOT NULL,
  `problem` varchar(32) NOT NULL,
  `plan` varchar(32) NOT NULL,
  `mpp` varchar(32) NOT NULL,
  `nama_mpp` varchar(512) NOT NULL,
  `mek_el` varchar(32) NOT NULL,
  `start` varchar(32) NOT NULL,
  `stop` varchar(32) NOT NULL,
  `time` varchar(32) NOT NULL,
  `istirahat` tinyint(4) NOT NULL DEFAULT '0',
  `tipe` varchar(16) NOT NULL,
  `ket` varchar(32) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_planing: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_planing` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_planing` ENABLE KEYS */;

-- Dumping structure for table ananti.m_polarisasi
CREATE TABLE IF NOT EXISTS `m_polarisasi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `result` varchar(16) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_polarisasi: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_polarisasi` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_polarisasi` ENABLE KEYS */;

-- Dumping structure for table ananti.m_recordhm
CREATE TABLE IF NOT EXISTS `m_recordhm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `id_sub_unit` varchar(64) NOT NULL,
  `hm` float NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `Index 2` (`tanggal`),
  KEY `Index 3` (`id_pabrik`,`id_station`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_recordhm: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_recordhm` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_recordhm` ENABLE KEYS */;

-- Dumping structure for table ananti.m_recordhm_bunchpress
CREATE TABLE IF NOT EXISTS `m_recordhm_bunchpress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `scroll` float NOT NULL,
  `top_semi_cage_ring` float NOT NULL,
  `bottom_semi_cage_ring` float NOT NULL,
  `semi_press_cone` float NOT NULL,
  `adjusting_knife` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_recordhm_bunchpress: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_recordhm_bunchpress` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_recordhm_bunchpress` ENABLE KEYS */;

-- Dumping structure for table ananti.m_recordhm_hydraulic
CREATE TABLE IF NOT EXISTS `m_recordhm_hydraulic` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `oli` float NOT NULL,
  `filter_inlet` float NOT NULL,
  `filter_outlet` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_recordhm_hydraulic: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_recordhm_hydraulic` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_recordhm_hydraulic` ENABLE KEYS */;

-- Dumping structure for table ananti.m_recordhm_hydrocyclone
CREATE TABLE IF NOT EXISTS `m_recordhm_hydrocyclone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(32) NOT NULL,
  `tanggal` date NOT NULL,
  `unit` varchar(64) NOT NULL,
  `cone` float NOT NULL,
  `dome` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_recordhm_hydrocyclone: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_recordhm_hydrocyclone` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_recordhm_hydrocyclone` ENABLE KEYS */;

-- Dumping structure for table ananti.m_recordhm_kcp
CREATE TABLE IF NOT EXISTS `m_recordhm_kcp` (
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(32) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `screw` float NOT NULL,
  `body_cage` float NOT NULL,
  `tupperhead` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_recordhm_kcp: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_recordhm_kcp` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_recordhm_kcp` ENABLE KEYS */;

-- Dumping structure for table ananti.m_recordhm_oil
CREATE TABLE IF NOT EXISTS `m_recordhm_oil` (
  `id_pabrik` varchar(8) NOT NULL,
  `id_station` varchar(16) NOT NULL,
  `id_unit` varchar(32) NOT NULL,
  `tanggal` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_recordhm_oil: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_recordhm_oil` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_recordhm_oil` ENABLE KEYS */;

-- Dumping structure for table ananti.m_recordhm_screwpress
CREATE TABLE IF NOT EXISTS `m_recordhm_screwpress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `id_pabrik` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `ab` float NOT NULL,
  `cd` float NOT NULL,
  `presscage` float NOT NULL,
  `wearpipe` float NOT NULL,
  `shaft` float NOT NULL,
  `cone_guide` float NOT NULL,
  `adjusting_cone_guide` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_recordhm_screwpress: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_recordhm_screwpress` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_recordhm_screwpress` ENABLE KEYS */;

-- Dumping structure for table ananti.m_schedule
CREATE TABLE IF NOT EXISTS `m_schedule` (
  `id_pabrik` varchar(8) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `id_sub_unit` varchar(64) NOT NULL,
  `tahun` smallint(6) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_stop` datetime NOT NULL,
  `item` varchar(64) NOT NULL,
  `action` varchar(64) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_schedule: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_schedule` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_schedule` ENABLE KEYS */;

-- Dumping structure for table ananti.m_sparepart_usage
CREATE TABLE IF NOT EXISTS `m_sparepart_usage` (
  `id_pabrik` varchar(8) NOT NULL,
  `no_wo` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `material` varchar(64) NOT NULL,
  `spek` varchar(128) NOT NULL,
  `satuan` varchar(16) NOT NULL,
  `qty` int(11) NOT NULL,
  `cost` float NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  KEY `id_pabrik` (`id_pabrik`),
  KEY `tanggal` (`tanggal`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_sparepart_usage: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_sparepart_usage` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_sparepart_usage` ENABLE KEYS */;

-- Dumping structure for table ananti.m_temperature
CREATE TABLE IF NOT EXISTS `m_temperature` (
  `id_pabrik` varchar(8) NOT NULL,
  `id_station` varchar(16) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_unit` varchar(16) NOT NULL,
  `id_sub_unit` varchar(32) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  `gearbox` float NOT NULL,
  `bearing` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_temperature: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_temperature` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_temperature` ENABLE KEYS */;

-- Dumping structure for table ananti.m_thickness
CREATE TABLE IF NOT EXISTS `m_thickness` (
  `id_pabrik` int(8) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `id_station` varchar(64) NOT NULL,
  `id_unit` varchar(64) NOT NULL,
  `id_sub_unit` varchar(64) NOT NULL,
  `t1` float NOT NULL,
  `t2` float NOT NULL,
  `t3` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_thickness: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_thickness` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_thickness` ENABLE KEYS */;

-- Dumping structure for table ananti.m_vibration
CREATE TABLE IF NOT EXISTS `m_vibration` (
  `id_pabrik` varchar(8) NOT NULL,
  `tahun` int(11) NOT NULL,
  `bulan` int(11) NOT NULL,
  `minggu` int(11) NOT NULL,
  `id_station` varchar(32) NOT NULL,
  `id_unit` varchar(32) NOT NULL,
  `id_sub_unit` varchar(32) NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  `h_mm` float NOT NULL,
  `h_env` float NOT NULL,
  `v_mm` float NOT NULL,
  `v_env` float NOT NULL,
  `a_mm` float NOT NULL,
  `a_env` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_vibration: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_vibration` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_vibration` ENABLE KEYS */;

-- Dumping structure for table ananti.m_wo
CREATE TABLE IF NOT EXISTS `m_wo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(64) NOT NULL,
  `tanggal` date NOT NULL,
  `no_wo` varchar(64) NOT NULL,
  `station` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `sub_unit` varchar(64) NOT NULL,
  `problem` varchar(64) NOT NULL,
  `desc_masalah` varchar(256) NOT NULL,
  `hm` float NOT NULL,
  `kategori` varchar(16) NOT NULL,
  `tipe` varchar(16) NOT NULL,
  `jenis` varchar(16) NOT NULL,
  `status` enum('open','close') NOT NULL DEFAULT 'open',
  `tanggal_closing` date NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_pabrik` (`id_pabrik`),
  KEY `no_wo` (`no_wo`),
  KEY `tanggal` (`tanggal`),
  KEY `station` (`station`,`unit`,`sub_unit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.m_wo: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_wo` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_wo` ENABLE KEYS */;

-- Dumping structure for table ananti.m_wo_process
CREATE TABLE IF NOT EXISTS `m_wo_process` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(64) NOT NULL,
  `tanggal` date NOT NULL,
  `no_wo` varchar(64) NOT NULL,
  `station` varchar(64) NOT NULL,
  `unit` varchar(64) NOT NULL,
  `sub_unit` varchar(64) NOT NULL,
  `problem` varchar(64) NOT NULL,
  `desc_masalah` varchar(256) NOT NULL,
  `hm` float NOT NULL,
  `kategori` varchar(16) NOT NULL,
  `tipe` varchar(2) NOT NULL,
  `status` enum('open','close') NOT NULL DEFAULT 'open',
  `tanggal_closing` date NOT NULL,
  `sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id_pabrik` (`id_pabrik`),
  KEY `no_wo` (`no_wo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- Dumping data for table ananti.m_wo_process: ~0 rows (approximately)
/*!40000 ALTER TABLE `m_wo_process` DISABLE KEYS */;
/*!40000 ALTER TABLE `m_wo_process` ENABLE KEYS */;

-- Dumping structure for table ananti.o_feedback_boiler
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

-- Dumping data for table ananti.o_feedback_boiler: ~0 rows (approximately)
/*!40000 ALTER TABLE `o_feedback_boiler` DISABLE KEYS */;
/*!40000 ALTER TABLE `o_feedback_boiler` ENABLE KEYS */;

-- Dumping structure for table ananti.o_feedback_effluent
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

-- Dumping data for table ananti.o_feedback_effluent: ~0 rows (approximately)
/*!40000 ALTER TABLE `o_feedback_effluent` DISABLE KEYS */;
/*!40000 ALTER TABLE `o_feedback_effluent` ENABLE KEYS */;

-- Dumping structure for table ananti.o_feedback_kcp
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

-- Dumping data for table ananti.o_feedback_kcp: ~0 rows (approximately)
/*!40000 ALTER TABLE `o_feedback_kcp` DISABLE KEYS */;
/*!40000 ALTER TABLE `o_feedback_kcp` ENABLE KEYS */;

-- Dumping structure for table ananti.o_feedback_olah
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

-- Dumping data for table ananti.o_feedback_olah: ~0 rows (approximately)
/*!40000 ALTER TABLE `o_feedback_olah` DISABLE KEYS */;
/*!40000 ALTER TABLE `o_feedback_olah` ENABLE KEYS */;

-- Dumping structure for table ananti.o_feedback_pks
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

-- Dumping data for table ananti.o_feedback_pks: ~0 rows (approximately)
/*!40000 ALTER TABLE `o_feedback_pks` DISABLE KEYS */;
/*!40000 ALTER TABLE `o_feedback_pks` ENABLE KEYS */;

-- Dumping structure for table ananti.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(64) NOT NULL,
  `password` varchar(128) NOT NULL,
  `kategori` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=316 DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.user: ~26 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `user`, `password`, `kategori`) VALUES
	(290, 'ananti', 'ananti', 0),
	(291, 'amrul', 'adam', 1),
	(292, 'fajar', 'anggoro', 1),
	(293, 'zakky', 'subarkah', 1),
	(294, 'hasanul', 'purba', 1),
	(295, 'haris', 'ramadhani', 1),
	(296, 'morin', 'sitompul', 1),
	(297, 'eben', 'purba', 1),
	(298, 'MSL', 'MSL', 2),
	(299, 'MMK', 'MMK', 2),
	(300, 'MTD', 'MTD', 2),
	(301, 'MMM', 'MMM', 2),
	(302, 'PJM', 'PJM', 2),
	(303, 'RVM', 'RVM', 2),
	(304, 'SKIM', 'SKIM', 2),
	(305, 'KDIM', 'KDIM', 2),
	(306, 'SHMM', 'SHMM', 2),
	(307, 'PRO_MSL', 'PRO_MSL', 3),
	(308, 'PRO_MMK', 'PRO_MMK', 3),
	(309, 'PRO_MTD', 'PRO_MTD', 3),
	(310, 'PRO_MMM', 'PRO_MMM', 3),
	(311, 'PRO_PJM', 'PRO_PJM', 3),
	(312, 'PRO_RVM', 'PRO_RVM', 3),
	(313, 'PRO_SKIM', 'PRO_SKIM', 3),
	(314, 'PRO_KDIM', 'PRO_KDIM', 3),
	(315, 'PRO_SHMM', 'PRO_SHMM', 3);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

-- Dumping structure for table ananti.w_act
CREATE TABLE IF NOT EXISTS `w_act` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `project_id` varchar(32) NOT NULL,
  `pt` varchar(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `activity` varchar(64) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `mpp` varchar(64) NOT NULL,
  `start` varchar(8) NOT NULL,
  `stop` varchar(8) NOT NULL,
  `verify` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.w_act: ~0 rows (approximately)
/*!40000 ALTER TABLE `w_act` DISABLE KEYS */;
/*!40000 ALTER TABLE `w_act` ENABLE KEYS */;

-- Dumping structure for table ananti.w_activity
CREATE TABLE IF NOT EXISTS `w_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `project_id` varchar(32) NOT NULL,
  `pt` varchar(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `activity` varchar(64) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `mpp` varchar(64) NOT NULL,
  `start` varchar(8) NOT NULL,
  `stop` varchar(8) NOT NULL,
  `total_time` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.w_activity: ~0 rows (approximately)
/*!40000 ALTER TABLE `w_activity` DISABLE KEYS */;
/*!40000 ALTER TABLE `w_activity` ENABLE KEYS */;

-- Dumping structure for table ananti.w_plan
CREATE TABLE IF NOT EXISTS `w_plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `project_id` varchar(32) NOT NULL,
  `pt` varchar(16) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `activity` varchar(64) NOT NULL,
  `keterangan` varchar(512) NOT NULL,
  `mpp` varchar(1024) NOT NULL,
  `start` varchar(8) NOT NULL,
  `stop` varchar(8) NOT NULL,
  `total_time` varchar(8) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.w_plan: ~0 rows (approximately)
/*!40000 ALTER TABLE `w_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `w_plan` ENABLE KEYS */;

-- Dumping structure for table ananti.w_project
CREATE TABLE IF NOT EXISTS `w_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pabrik` varchar(8) NOT NULL,
  `tanggal` date NOT NULL,
  `no_wo` varchar(64) NOT NULL,
  `project_id` varchar(64) NOT NULL,
  `pt` varchar(16) NOT NULL,
  `nama` varchar(256) NOT NULL,
  `deskripsi` varchar(512) NOT NULL,
  `tgl_start` date NOT NULL,
  `status` varchar(16) NOT NULL,
  `tgl_close` date NOT NULL,
  `marking` int(11) NOT NULL,
  `cutting` int(11) NOT NULL,
  `machining` int(11) NOT NULL,
  `assembly` int(11) NOT NULL,
  `welding` int(11) NOT NULL,
  `painting` int(11) NOT NULL,
  `balancing` int(11) NOT NULL,
  `finishing` int(11) NOT NULL,
  `install` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table ananti.w_project: ~0 rows (approximately)
/*!40000 ALTER TABLE `w_project` DISABLE KEYS */;
/*!40000 ALTER TABLE `w_project` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
