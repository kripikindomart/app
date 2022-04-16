-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 16, 2022 at 03:48 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `app_cbt`
--

-- --------------------------------------------------------

--
-- Table structure for table `aauth_departement`
--

CREATE TABLE `aauth_departement` (
  `id` int(4) NOT NULL,
  `departement` varchar(255) NOT NULL,
  `definition` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aauth_departement`
--

INSERT INTO `aauth_departement` (`id`, `departement`, `definition`) VALUES
(1, 'DPI', 'Doktor Pendidikan Islam'),
(2, 'MPI', 'Magister Pendidikan Islam'),
(3, 'MTP', 'Magister Teknologi Pendidikan'),
(4, 'MES', 'Magister Ekonomi Syariah'),
(5, 'MMN', 'Magister Manajemen');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_groups`
--

CREATE TABLE `aauth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_groups`
--

INSERT INTO `aauth_groups` (`id`, `name`, `definition`) VALUES
(1, 'Admin', 'Super Admin Group'),
(2, 'Public', 'Public Access Group'),
(3, 'Mahasiswa', 'Mahasiswa Access Group');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_group_to_group`
--

CREATE TABLE `aauth_group_to_group` (
  `group_id` int(11) UNSIGNED NOT NULL,
  `subgroup_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_login_attempts`
--

CREATE TABLE `aauth_login_attempts` (
  `id` int(11) NOT NULL,
  `ip_address` varchar(39) DEFAULT '0',
  `timestamp` datetime DEFAULT NULL,
  `login_attempts` tinyint(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aauth_login_attempts`
--

INSERT INTO `aauth_login_attempts` (`id`, `ip_address`, `timestamp`, `login_attempts`) VALUES
(2, '127.0.0.1', '2020-09-27 00:10:54', 4),
(3, '127.0.0.1', '2022-03-08 10:46:18', 2);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perms`
--

CREATE TABLE `aauth_perms` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `definition` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perms`
--

INSERT INTO `aauth_perms` (`id`, `name`, `definition`) VALUES
(1, 'group_list', ''),
(2, 'group_add', NULL),
(3, 'group_update', NULL),
(4, 'group_delete', NULL),
(5, 'group_view', NULL),
(6, 'group_export', NULL),
(7, 'dashboard', NULL),
(9, 'users_list', NULL),
(10, 'users_update', NULL),
(11, 'users_delete', NULL),
(12, 'users_add', NULL),
(13, 'user_benned', NULL),
(14, 'master_angkatan_delete', ''),
(15, 'master_angkatan_list', ''),
(16, 'master_angkatan_add', ''),
(17, 'master_angkatan_update', ''),
(18, 'master_angkatan_view', ''),
(24, 'Dosen_add', ''),
(25, 'Dosen_update', ''),
(26, 'Dosen_view', ''),
(27, 'Dosen_delete', ''),
(28, 'Dosen_list', ''),
(29, 'Master_dosen_add', ''),
(30, 'Master_dosen_update', ''),
(31, 'Master_dosen_view', ''),
(32, 'Master_dosen_delete', ''),
(33, 'Master_dosen_list', ''),
(34, 'Karyawan_add', ''),
(35, 'Karyawan_update', ''),
(36, 'Karyawan_view', ''),
(37, 'Karyawan_delete', ''),
(38, 'Karyawan_list', ''),
(39, 'Karyawans_add', ''),
(40, 'Karyawans_update', ''),
(41, 'Karyawans_view', ''),
(42, 'Karyawans_delete', ''),
(43, 'Karyawans_list', ''),
(44, 'Student_add', ''),
(45, 'Student_update', ''),
(46, 'Student_view', ''),
(47, 'Student_delete', ''),
(48, 'Student_list', ''),
(49, 'Pejabats_add', ''),
(50, 'Pejabats_update', ''),
(51, 'Pejabats_view', ''),
(52, 'Pejabats_delete', ''),
(53, 'Pejabats_list', ''),
(54, 'Pejabat_add', ''),
(55, 'Pejabat_update', ''),
(56, 'Pejabat_view', ''),
(57, 'Pejabat_delete', ''),
(58, 'Pejabat_list', ''),
(64, 'form_template_add', ''),
(65, 'form_template_update', ''),
(66, 'form_template_view', ''),
(67, 'form_template_delete', ''),
(68, 'form_template_list', ''),
(69, 'daftar_add', ''),
(70, 'daftar_update', ''),
(71, 'daftar_view', ''),
(72, 'daftar_delete', ''),
(73, 'daftar_list', '');

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_group`
--

CREATE TABLE `aauth_perm_to_group` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_perm_to_group`
--

INSERT INTO `aauth_perm_to_group` (`perm_id`, `group_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(6, 1),
(7, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 1),
(7, 3),
(69, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_perm_to_user`
--

CREATE TABLE `aauth_perm_to_user` (
  `perm_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_pms`
--

CREATE TABLE `aauth_pms` (
  `id` int(11) UNSIGNED NOT NULL,
  `sender_id` int(11) UNSIGNED NOT NULL,
  `receiver_id` int(11) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `message` text,
  `date_sent` datetime DEFAULT NULL,
  `date_read` datetime DEFAULT NULL,
  `pm_deleted_sender` int(1) DEFAULT NULL,
  `pm_deleted_receiver` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `aauth_users`
--

CREATE TABLE `aauth_users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pass` varchar(64) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `full_name` varchar(128) NOT NULL,
  `banned` tinyint(1) DEFAULT '0',
  `avatar` varchar(128) NOT NULL DEFAULT 'default.png',
  `last_login` datetime DEFAULT NULL,
  `last_activity` datetime DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `forgot_exp` text,
  `remember_time` datetime DEFAULT NULL,
  `remember_exp` text,
  `verification_code` text,
  `totp_secret` varchar(16) DEFAULT NULL,
  `ip_address` text,
  `id_master_prodi` varchar(50) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `delete_at` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_users`
--

INSERT INTO `aauth_users` (`id`, `email`, `pass`, `username`, `full_name`, `banned`, `avatar`, `last_login`, `last_activity`, `date_created`, `forgot_exp`, `remember_time`, `remember_exp`, `verification_code`, `totp_secret`, `ip_address`, `id_master_prodi`, `id_mahasiswa`, `delete_at`) VALUES
(1, 'asrulanwar99@gmail.com', '$2y$10$21ll73aUDDLk5kmW/rfpVOKHmSijxZjmBKxDZ028aNmWjQ2ff8hZ2', 'asrul', 'Muhammad Asrul Anwar', 0, '20200729093029-LOGO_UIKA_Terbaru2.png', '2022-04-16 09:59:12', '2022-04-16 09:59:12', '2020-07-29 09:30:29', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '6', 100, ''),
(2, 'user@local.com', '$2y$10$s8A74MVHxPrwnAThy/D5B.ZAg8kHt5H.1X4.mDnseAcicpBaC8dy2', 'user', 'user', 0, 'default.png', '2022-03-10 14:29:03', '2022-03-10 14:29:03', '2022-03-10 14:27:10', NULL, NULL, NULL, NULL, NULL, '192.168.112.59', '6', 100, ''),
(4, 'ahmad@gmail.com', '$2y$10$21ll73aUDDLk5kmW/rfpVOKHmSijxZjmBKxDZ028aNmWjQ2ff8hZ2', 'ahmad', 'Ahmad', 0, '20200729093029-LOGO_UIKA_Terbaru2.png', '2022-04-14 14:57:39', '2022-04-14 14:57:39', '2020-07-29 09:30:29', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '6', 100, NULL),
(5, 'student@student.com', '$2y$10$CsRTelivtChsJ3eNxhFo6.5zuGW1GYBB/iRFzEQxbUlBNUQotMY2C', 'student', 'Rusti', 0, '20220416100005-167858841_4384478648233717_7020433269666150664_n.png', '2022-04-16 10:00:37', '2022-04-16 10:00:37', '2022-04-16 10:00:05', NULL, NULL, NULL, NULL, NULL, '127.0.0.1', '6', 100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_departement`
--

CREATE TABLE `aauth_user_to_departement` (
  `id` int(11) NOT NULL,
  `id_departement` int(11) NOT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aauth_user_to_departement`
--

INSERT INTO `aauth_user_to_departement` (`id`, `id_departement`, `id_users`) VALUES
(1, 2, 4),
(2, 6, 5),
(3, 3, 6),
(4, 1, 7),
(5, 1, 8),
(6, 5, 9),
(7, 3, 10),
(8, 2, 11),
(9, 1, 3),
(10, 6, 355),
(11, 6, 356),
(12, 6, 357),
(13, 6, 358),
(14, 6, 359),
(15, 6, 360),
(16, 6, 361),
(17, 6, 362),
(18, 6, 363),
(19, 6, 364),
(20, 3, 432),
(21, 6, 433),
(22, 6, 2),
(23, 4, 3),
(24, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_to_group`
--

CREATE TABLE `aauth_user_to_group` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `aauth_user_to_group`
--

INSERT INTO `aauth_user_to_group` (`user_id`, `group_id`) VALUES
(1, 1),
(2, 1),
(4, 3),
(5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `aauth_user_variables`
--

CREATE TABLE `aauth_user_variables` (
  `id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `data_key` varchar(100) NOT NULL,
  `value` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `app_kegiatan`
--

CREATE TABLE `app_kegiatan` (
  `id` int(11) NOT NULL,
  `uri` varchar(255) NOT NULL,
  `jenis_kegiatan` varchar(255) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `nama_kegiatan` varchar(255) NOT NULL,
  `konten` text NOT NULL,
  `biaya_registrasi` float NOT NULL,
  `banner` varchar(255) NOT NULL,
  `tanggal_kegiatan` datetime NOT NULL,
  `tanggal_registrasi_awal` datetime NOT NULL,
  `tanggal_registrasi_akhir` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_kegiatan`
--

INSERT INTO `app_kegiatan` (`id`, `uri`, `jenis_kegiatan`, `prodi_id`, `nama_kegiatan`, `konten`, `biaya_registrasi`, `banner`, `tanggal_kegiatan`, `tanggal_registrasi_awal`, `tanggal_registrasi_akhir`, `created_at`, `update_at`) VALUES
(16, 'workshop-penulisan-jurnal-ilmiah-dan-pencegahan-plagiasi-1639188000', 'Workshop', 4, 'Workshop Penulisan Jurnal Ilmiah dan Pencegahan Plagiasi ', '', 202000, '20211208134734-whatsapp_image_2021-12-07_at_21_58_02.jpeg', '2021-12-11 09:00:00', '2021-12-07 09:00:00', '2021-12-10 23:00:00', '2021-12-07 06:10:25', 0);

-- --------------------------------------------------------

--
-- Table structure for table `app_konfirmasi`
--

CREATE TABLE `app_konfirmasi` (
  `id` int(11) NOT NULL,
  `registrasi_id` int(11) NOT NULL,
  `register_uid` varchar(20) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `bukti_pembayaran` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '2',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_konfirmasi`
--

INSERT INTO `app_konfirmasi` (`id`, `registrasi_id`, `register_uid`, `total_bayar`, `bukti_pembayaran`, `status`, `created_at`, `update_at`) VALUES
(4, 43, 'MMN016100', 202100, 'MMN016100-20211207215545-screenshot_20211207-215503_bsi_mobile.jpg', 2, '2021-12-07 14:55:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_menu`
--

CREATE TABLE `app_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `type` enum('menu','label') NOT NULL DEFAULT 'menu',
  `menu_category` enum('backend','frontend') NOT NULL DEFAULT 'frontend',
  `menu_parent` int(11) DEFAULT NULL,
  `menu_icon` varchar(128) NOT NULL DEFAULT 'fa fa-circle-o',
  `menu_position` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_menu`
--

INSERT INTO `app_menu` (`id`, `name`, `url`, `slug`, `type`, `menu_category`, `menu_parent`, `menu_icon`, `menu_position`, `created_at`, `update_at`, `delete_at`) VALUES
(1, 'Dashboard', 'admin/dashboard', 'admin/dashboard', 'menu', 'backend', NULL, 'fa fa-dashboard', 0, '2020-07-26 07:56:56', NULL, NULL),
(2, 'Buat Jadwal', 'admin/jadwal', 'admin/jadwal', 'menu', 'frontend', NULL, 'fa fa-calendar-plus-o ', 1, '2020-07-26 07:56:56', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `app_pengajuan`
--

CREATE TABLE `app_pengajuan` (
  `id` int(11) NOT NULL,
  `npm` varchar(50) DEFAULT NULL,
  `ujian` varchar(50) DEFAULT NULL,
  `angkatan_id` int(11) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `thesis` text,
  `status` enum('Y','N') DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_pengajuan`
--

INSERT INTO `app_pengajuan` (`id`, `npm`, `ujian`, `angkatan_id`, `prodi_id`, `thesis`, `status`) VALUES
(6, '662651', 'kompre', 2, 1, 'tracer', 'N'),
(7, '662660', 'kompre', 1, 2, 'Fery sidang ', 'N');

-- --------------------------------------------------------

--
-- Table structure for table `app_registrasi`
--

CREATE TABLE `app_registrasi` (
  `id` int(11) NOT NULL,
  `uid` varchar(11) NOT NULL,
  `unom` int(11) NOT NULL,
  `kegiatan_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `instansi` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status_pembayaran` int(11) NOT NULL DEFAULT '0',
  `register_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_registrasi`
--

INSERT INTO `app_registrasi` (`id`, `uid`, `unom`, `kegiatan_id`, `nama`, `no_hp`, `instansi`, `email`, `status_pembayaran`, `register_date`, `created_at`, `update_at`) VALUES
(43, 'MMN016100', 100, 16, 'Erry Nugroho Himawan', '08121910697', 'Magister Manajemen Sekolah Pascasarjana Universitas Ibnu Khaldun', 'errynhimawan@gmail.com', 2, '2021-12-07', '2021-12-07 14:53:03', '0000-00-00 00:00:00'),
(44, 'MMN016101', 101, 16, 'Darwis Sunandar', '087878767678', 'IPB', 'darwisfpik@gmail.com', 4, '2021-12-07', '2021-12-07 15:13:10', '0000-00-00 00:00:00'),
(45, 'MMN016102', 102, 16, 'Cicih Sukarsih', '087872136707', 'MM', 'cicih.rsib@gmail.com', 4, '2021-12-08', '2021-12-07 20:52:17', '0000-00-00 00:00:00'),
(46, 'MMN016103', 103, 16, 'Ranti Sugiarti', '085893817358', 'IBI Kesatuan', 'rantirulhnedri@gmail.com', 4, '2021-12-08', '2021-12-07 22:30:18', '0000-00-00 00:00:00'),
(47, 'MMN016104', 104, 16, 'Maryani', '082228198055', 'Departemen MSP FPIK IPB', 'caca_milania23@apps.ipb.ac.id', 4, '2021-12-09', '2021-12-09 06:29:29', '0000-00-00 00:00:00'),
(48, 'MMN016105', 105, 16, 'Muhammad Fadhlansyah', '081380248795', 'Universitas Ibnu Khaldun', 'fadelann@gmail.com', 4, '2021-12-09', '2021-12-09 06:33:04', '0000-00-00 00:00:00'),
(49, 'MMN016106', 106, 16, 'Darwis Sunandar', '087878767668', 'IPB', 'darwisfpik@gmail.com', 4, '2021-12-09', '2021-12-09 08:55:11', '0000-00-00 00:00:00'),
(50, 'MMN016107', 107, 16, 'Dini Damayanti', '085773832281', 'Pemkab bogor', 'dini0620@gmail.com', 4, '2021-12-09', '2021-12-09 08:59:30', '0000-00-00 00:00:00'),
(51, 'MMN016108', 108, 16, 'Drg Sonia Redmana ', '085772400599', 'RSUD Kota Bogor/Sekolah Pasca Sarjana UIKA', 'sizuka2016@gmail.com', 4, '2021-12-09', '2021-12-09 09:06:26', '0000-00-00 00:00:00'),
(52, 'MMN016109', 109, 16, 'Darwis Sunandar ', '087878767678', 'IPB', 'darwisfpik@gmail.com', 4, '2021-12-09', '2021-12-09 09:09:53', '0000-00-00 00:00:00'),
(54, 'MMN016110', 110, 16, 'Benawa', '081315735899', '', 'eliza.nawa@gmail.com', 4, '2021-12-09', '2021-12-09 15:16:58', '0000-00-00 00:00:00'),
(55, 'MMN016111', 111, 16, 'Taufik Hidayat', '087711172026', 'Magister Manajemen UIKA', 'taufik_hidayat_81@yahoo.com', 4, '2021-12-10', '2021-12-10 03:20:29', '0000-00-00 00:00:00'),
(56, 'MMN016112', 112, 16, 'Puri Noviarti SE', '081389734548', 'RSUP Nasional dr Cipto Mangunkusumo', 'puri0211@gmail.com', 4, '2021-12-10', '2021-12-10 05:21:46', '0000-00-00 00:00:00'),
(57, 'MMN016113', 113, 16, 'Niar Yuniarsih', '082226383379', 'IPB', 'nniary_ipb@apps.ipb.ac.id', 4, '2021-12-10', '2021-12-10 05:27:02', '0000-00-00 00:00:00'),
(58, 'MMN016114', 114, 16, 'Yuli Rohmalia, S.M.', '08128932078', 'MM UIKA', 'rohmaliayuli@gmail.com', 4, '2021-12-10', '2021-12-10 05:36:29', '0000-00-00 00:00:00'),
(59, 'MMN016115', 115, 16, 'Soejarwati', '082170245392', 'Universitas Ibn Khaldun Bogor', 's.watie1081@gmail.com', 4, '2021-12-10', '2021-12-10 06:46:36', '0000-00-00 00:00:00'),
(60, 'MMN016116', 116, 16, 'Riviega Rosihan', '08561160780', 'PT.PP (Persero), Tbk', 'riviega@gmail.com', 4, '2021-12-10', '2021-12-10 08:34:56', '0000-00-00 00:00:00'),
(61, 'MMN016117', 117, 16, 'Benawa', '081315735899', '', 'eliza.nawa@gmail.com', 4, '2021-12-10', '2021-12-10 15:42:19', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(11) NOT NULL,
  `app_name` varchar(255) NOT NULL DEFAULT 'SICICMS',
  `description` text,
  `institute` varchar(255) DEFAULT NULL,
  `address` text,
  `logo` varchar(128) NOT NULL DEFAULT 'default.png',
  `favicon` varchar(128) NOT NULL DEFAULT 'default.ico',
  `setting_optional` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `app_name`, `description`, `institute`, `address`, `logo`, `favicon`, `setting_optional`) VALUES
(1, 'APP - JADWAL', NULL, 'Sekolah Pascasarjana UIKA BOGOR', 'Jl. KH. Sholeh Iskandar Km, 2', 'default.png', 'default.ico', '');

-- --------------------------------------------------------

--
-- Table structure for table `bank_soal`
--

CREATE TABLE `bank_soal` (
  `id` int(11) NOT NULL,
  `id_master_prodi` int(11) NOT NULL,
  `title_soal` varchar(255) DEFAULT NULL,
  `bobot` int(11) NOT NULL,
  `type_soal` enum('multiplechoice','essay') NOT NULL,
  `file` varchar(255) NOT NULL,
  `tipe_file` varchar(255) NOT NULL,
  `pertanyaan` longtext NOT NULL,
  `opsi_a` longtext NOT NULL,
  `opsi_b` longtext NOT NULL,
  `opsi_c` longtext NOT NULL,
  `opsi_d` longtext NOT NULL,
  `opsi_e` longtext NOT NULL,
  `file_a` varchar(255) DEFAULT NULL,
  `file_b` varchar(255) DEFAULT NULL,
  `file_c` varchar(255) DEFAULT NULL,
  `file_d` varchar(255) DEFAULT NULL,
  `file_e` varchar(255) DEFAULT NULL,
  `jawaban` varchar(255) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  `update_at` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank_soal`
--

INSERT INTO `bank_soal` (`id`, `id_master_prodi`, `title_soal`, `bobot`, `type_soal`, `file`, `tipe_file`, `pertanyaan`, `opsi_a`, `opsi_b`, `opsi_c`, `opsi_d`, `opsi_e`, `file_a`, `file_b`, `file_c`, `file_d`, `file_e`, `jawaban`, `created_at`, `update_at`, `created_by`) VALUES
(53, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n  94  88  82  76  70  64  ...  Ã¢â‚¬Â¦', '60 dan 54', '70 dan 68', '56 dan 50', '52 dan 60', '58 dan 52', NULL, NULL, NULL, NULL, NULL, 'E', 1591517741, 1591517741, 35),
(54, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 18Ã‚Â  20Ã‚Â  24Ã‚Â  32 ...  ...', '34 dan 36', '40 dan 48', '29 dan 45', '46 dan 80Ã‚Â ', '64 dan 128', NULL, NULL, NULL, NULL, NULL, 'D', 1591517741, 1591517741, 35),
(55, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 6Ã‚Â  7Ã‚Â  9Ã‚Â  13Ã‚Â  21 ...  ...', '37 dan 69', '37 dan 53', '29 dan 45', '29 dan 37', '23 dan 25', NULL, NULL, NULL, NULL, NULL, 'A', 1591517741, 1591517741, 35),
(56, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 96Ã‚Â  64Ã‚Â  48Ã‚Â  40 36 ...  ...', '35 dan 34', '34 dan 33', '34 dan 32', '33 dan 32', '32 dan 30', NULL, NULL, NULL, NULL, NULL, 'B', 1591517741, 1591517741, 35),
(57, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 1/9  1/3  1   3  9  27 ...  ...', '9 dan 1', '27 dan 89', '81 dan 243', '21 dan 35', '90 dan 210', NULL, NULL, NULL, NULL, NULL, 'C', 1591517741, 1591517741, 35),
(58, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 12  9  10  9  8  9 ...  ...', '10 dan 9', '12 dan 9', '7 dan 9', '9 dan 8', '6 dan 9', NULL, NULL, NULL, NULL, NULL, 'E', 1591517741, 1591517741, 35),
(59, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 4   4  8  4  16   4 ...  ...', '12 dan 44', '32 dan 4', '4 dan 8', '16 dan 20', '4 dan 16', NULL, NULL, NULL, NULL, NULL, 'B', 1591517741, 1591517741, 35),
(60, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 18   10  20  12   24  16 ...  ...', '8 dan 16', '20 dan 28', '32 dan 24', '32 dan 40', '9 dan 3', NULL, NULL, NULL, NULL, NULL, 'C', 1591517741, 1591517741, 35),
(61, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 5  6  10  12  20  24 ...  ...', '28 dan 32', '40 dan 48', '12 dan 40', '28 dan 40', '48 dan 64', NULL, NULL, NULL, NULL, NULL, 'B', 1591517741, 1591517741, 35),
(62, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 9   9   9   6   9    3 ...  ...', '9 dan 9', '3 dan 9', '3 dan 6', '6 dan 3', '9 dan 10', NULL, NULL, NULL, NULL, NULL, 'E', 1591517741, 1591517741, 35),
(63, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 20  24  12  16  8   12  ...  ...', '6 dan 10', '18 dan 9', '22 dan 32', '4 dan 24', '20 dan 32', NULL, NULL, NULL, NULL, NULL, 'A', 1591517741, 1591517741, 35),
(64, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 5   6  7   8   9   10  11   14 ...  ...', '17 dan 58', '16 dan 20', '14 dan 18', '15 dan 19', '16 dan 24', NULL, NULL, NULL, NULL, NULL, 'D', 1591517741, 1591517741, 35),
(65, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 1   2    4   5   25   26 ...  ...', '254 dan 125', '26 dan 30', '12 dan 104', '27 dan 28', '676 dan 677', NULL, NULL, NULL, NULL, NULL, 'E', 1591517741, 1591517741, 35),
(66, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 3  7   16   35   74  ...  ...', '148 dan 296', '148 dan 301', '153 dan 312', '158 dan 328', '158 dan 322', NULL, NULL, NULL, NULL, NULL, 'C', 1591517741, 1591517741, 35),
(67, 1, '', 1, 'multiplechoice', '', '', 'Lanjutkan irama dari bilangan-bilangan pada tiap nomor soal dengan memilih sepasang bilangan dari lima pasang bilangan yang tersedia sebagai jawaban. \\n 1   1   2   3    5    8 ...  ...', '12 dan 17', '13 dan 21', '17 dan 21', '14 dan  25', '15 dan 28', NULL, NULL, NULL, NULL, NULL, 'B', 1591517741, 1591517741, 35),
(68, 1, '', 1, 'multiplechoice', '35618a1f8b4bd8c6cd50e1969945f89d.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', '08890ede106007cc7b664415c9f774bc.PNG', '095bf740263794118a63094be81a29d3.PNG', 'c1e1980f8a8641147b734fdecb66c813.PNG', 'ea98647695788b7d6283be85b5b8dfda.PNG', 'd52dca1087e97809d6589dfd4830b449.PNG', 'E', 1591519214, 1591519214, 35),
(69, 1, '', 1, 'multiplechoice', '7b3ce597e86026b4145e4fe3bc96926f.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', 'dc2a8bae442defb4a2ab7053182e2f45.PNG', '8e0a2926b09108427f7fe44cd714cfa8.PNG', '48e3c38d547c3d4f03016773c3058490.PNG', '59d0fdfa9cae9b9173ea92dec4252f9e.PNG', '4df2c89fbaab35a48c33bf692ab47f39.PNG', 'C', 1591519295, 1591519295, 35),
(70, 1, '', 1, 'multiplechoice', '76cadf1435790cc714bcddbf31fd5675.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', 'da87a3c6f9d77280ae272ae220a7f50c.PNG', 'a184aab3c82e464ca80986ab82bc1cd5.PNG', '8c0678428502c7270bbac2b3b12bc661.PNG', 'd8050d0bade045ecc27952ca04fd774d.PNG', '40508eb4ff4b75f5368ec4847ca2b0b3.PNG', 'A', 1591519379, 1591519379, 35),
(71, 1, '', 1, 'multiplechoice', '82662d7f3a6313730bf849a25952a311.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Ã‚Â </p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', '870cef8c6512d43c0a3730ff46eae968.PNG', '8a223cad4a36e6781630ca224b4a8b66.PNG', '172124c202d5df601cd5cd10008713e8.PNG', '7e23ebf3265be7fcbc72d65dc86e3403.PNG', '0c21d78e16b664c866238056e5280b89.PNG', 'D', 1591519465, 1591519465, 35),
(72, 1, '', 1, 'multiplechoice', 'e49399ded56f4fbba655262b255ae427.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', '98782f68c99cc78b9684637af9821bb7.PNG', '8950cc09c4129fe89166f862452e13f6.PNG', 'd464c25963e2e895141247c06194348b.PNG', '989a6f70f7652fa3ef02d01a7586e059.PNG', '074cfb45be8a6a77852e130f691f90bb.PNG', 'C', 1591519558, 1591519558, 35),
(73, 1, '', 1, 'multiplechoice', 'b0e09edb5dd3ea77a6405daa2f49a0a2.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', 'ab3eab610e2664cd729fee10c561b6be.PNG', '6837c32025401bd2515f04eafcc4f314.PNG', '2bf5eec74de7f2ff882a7957eeb01b11.PNG', '0916412994b76a5ca1b7d7741e085691.PNG', 'fe6e72939db9bf31c49264de5e9d3a7e.PNG', 'C', 1591519650, 1591519650, 35),
(74, 1, '', 1, 'multiplechoice', 'f5a8257422f876f6e1b1eaddfde4d4ad.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', '15fc4b843586bd1e31d5cf8aab60e4a1.PNG', '265f31ec384128daafba98eafc6d6ba3.PNG', '6c56c0f26baab53f3fbb72b54d8b0ea6.PNG', '3dbb19288708c09bf6b5af313cd5a6c6.PNG', 'de0748cb7ae2e75669eb6ade7b3270df.PNG', 'A', 1591519710, 1591519710, 35),
(75, 1, '', 1, 'multiplechoice', '6cba86a6d820aca862068cddc21e39f4.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', 'e019727d4b2f1f9331482a27e500c550.PNG', '46cb161adab70d57077b53232d5b39f7.PNG', 'ee130992bb55d69f4e5b3878e9f5fc75.PNG', '2a6cfc30af714b70c3445625bd6e88b1.PNG', '6e27fe1914b28a50f3cc133aa89b3f7f.PNG', 'C', 1591519854, 1591519854, 35),
(76, 1, '', 1, 'multiplechoice', 'd5ea22dd9767bf974f4b5ae887bc0cdb.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', '1fe2974cef377de9eee75a298a6f745d.PNG', '327dc6f8126b45147c4e37fcde7146ac.PNG', 'bcd775a3a16472153c714fdaa22fdae4.PNG', '6637ff792d3a0b36dd66956a67b02de7.PNG', '5a81b83e43ff77b8a9257ebc719a4f02.PNG', 'C', 1591519922, 1591519922, 35),
(77, 1, '', 1, 'multiplechoice', 'c71098484a90e1353e2e4496405141dd.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', '41b0befb623d98f6508accc9acb3a1af.PNG', 'b35bd5207adf2189b3ec817b0ca9a58a.PNG', '88dd8caaa7964aa99f3eb704586e7b25.PNG', 'c651e548694635029b37e396f779fdf8.PNG', 'eef03c28a8222a8e9c565c73aa41fb0e.PNG', 'E', 1591519980, 1591519980, 35),
(78, 1, '', 1, 'multiplechoice', '8acff00548887111a4f4300e808a4dcd.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', 'b291d0d5034835afcdee5e33a322017b.PNG', '8a0d19c6fd236884fda848a57628dfe0.PNG', '39faca9465b316443d24dcad792d8394.PNG', 'f3bed563cb7d6eeacd33388a3e9aaab0.PNG', NULL, 'D', 1591520076, 1591520076, 35),
(79, 1, '', 1, 'multiplechoice', '2f4798c2a1f8dc01c55082d48135c50b.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', 'f17ba1cc28f8d47be8564d760cef47aa.PNG', '24d529fbac85117ffb6245a8952b079c.PNG', '5a40af7e6c94b5c46be5c637caf310ee.PNG', 'c6c527adb7f9a860045c8958cb98c2a5.PNG', NULL, 'A', 1591520174, 1591520174, 35),
(80, 1, '', 1, 'multiplechoice', 'b33dac6c09a8e4ac5c439c9d5386ffbf.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', '38ed558fbcfcda5128821eaa5393149f.PNG', '5ec58496acba3e5eac07730d55c6747b.PNG', 'eea4eab325caa835371f34583ff9f28d.PNG', '03ae24f49871309196378bd9ab293c47.PNG', NULL, 'B', 1591520248, 1591520248, 35),
(81, 1, '', 1, 'multiplechoice', 'a4efd2c68b565fa4ce89f3d629df4b3c.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', 'e34f4af0b4b597b05329e976f3e62bf4.PNG', '5efccc2ac39b75d7bc242aca6d560fab.PNG', 'fc8ca08e09d5caa9d5f1f9180ecbca13.PNG', 'a8110b12c7ce8beb3a8f55dd0063dddf.PNG', NULL, 'A', 1591520309, 1591520309, 35),
(82, 1, '', 1, 'multiplechoice', 'a2a91658370f829d0752c4fca2630c48.PNG', 'image/png', '<p><strong>TES VISUALISASI SPASIAL</strong></p>\r\n\r\n<p>Lanjutkan gambar berikut:</p>\r\n', '', '', '', '', '', '4a9071a87094142e005e403cf1b18cfe.PNG', 'e0f35dd291dd531e6e3b390d36b2c8a6.PNG', 'ab7dd772b56c39b57ce59dbef385f99a.PNG', '276ddf6eba221e77b48e5d482406bfe1.PNG', NULL, 'B', 1591520353, 1591520353, 35),
(83, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Menurut saya, tokoh Pendidikan terhebat di Indonesia adalah: ', 'Ki Hajar Dewantoro  ', 'Ki Mangun Sarkoro', 'Kyai Haji Ahmad Dahlan ', 'Kyai Slamet dari Surakarta', '', NULL, NULL, NULL, NULL, NULL, 'C', 1591529995, 1591529995, 35),
(84, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Paham yang selamat adalah: ', 'ahlul kitab wal-risalah', 'ahlus sunnah wal-hikmah   ', 'ahlus sunnah wal-jamaah   ', 'ahlus sunnah wal-syiah', '', NULL, NULL, NULL, NULL, NULL, 'C', 1591529995, 1591529995, 35),
(85, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Ilmu yang menjadi dasar untuk menetapkan hukum Islam adalah:', 'Ilmu muamalah   ', 'ilmu ushuluddin     ', 'ilmu ushul fiqh    ', 'ilmu ushulul-ashl', '', NULL, NULL, NULL, NULL, NULL, 'C', 1591529995, 1591529995, 35),
(86, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Hadits Nabi saw mulai dicatat di masa:', 'Umar bin Abdul Aziz   ', 'Umar bin Khathab    ', 'Imam Bukhari      ', 'Umar  Mukhtar', '', NULL, NULL, NULL, NULL, NULL, 'B', 1591529995, 1591529995, 35),
(87, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Al-Quran yang kita warisi sekarang ini dikodifikasi di masa: ', 'Utsman bin Affan   ', 'Utsman Shihab   ', 'Ali bin Abi Thalib   ', 'Utsman Raliby', '', NULL, NULL, NULL, NULL, NULL, 'A', 1591529995, 1591529995, 35),
(88, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Penulis Tafsir al-Azhar di Indonesia adalah: ', 'Haji Abdul Malik  ', 'KH Hasyim Asyari    ', 'Prof Dr Thahir Azhary     ', 'KH Azhar Zainuddin', '', NULL, NULL, NULL, NULL, NULL, 'A', 1591529995, 1591529995, 35),
(89, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Tokoh Islam pendiri pesantren Tebu Ireng di Jombang adalah:', 'KH Wahab Hasbullah   ', 'KH Hasyim AsyÃ¢â‚¬â„¢ari   ', 'KH Hasyim Latif    ', 'KH Wahid Hasyim', '', NULL, NULL, NULL, NULL, NULL, 'B', 1591529995, 1591529995, 35),
(90, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Kata yang dekat dengan pendidikan dalam Islam adalah:', 'thalabul ilmi   ', 'tarjih   ', 'thalabul kalam     ', 'thalabul jah.', '', NULL, NULL, NULL, NULL, NULL, 'A', 1591529995, 1591529995, 35),
(91, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n The aim of education in Islam is to create a good man according   to the aspiration of the student. Terhadap pernyataan itu, saya : ', 'setuju    ', 'tidak setuju   ', 'ragu-ragu   ', '', '', NULL, NULL, NULL, NULL, NULL, 'B', 1591529995, 1591529995, 35),
(92, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Makna Ã¢â‚¬Å“Innad diina Ã¢â‚¬Ëœindallaahil-islamÃ¢â‚¬Â adalah:', 'Islam satu-satunya agama yang diturunkan Allah kepada para nabi-Nya,', 'Agama-agama yang benar bisa disebut Islam,', 'Semua agama yang berserah diri pada Tuhan dapat disebut Islam', 'Orang yang beragama Islam pasti masuk sorga.', '', NULL, NULL, NULL, NULL, NULL, 'A', 1591529995, 1591529995, 35),
(93, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Agama yang dibawa oleh Nabi Isa adalah: ', 'Kristen   ', 'ad-Dinul Masih  ', 'ad-Dinul Yahuud    ', 'agama Nasrani', '', NULL, NULL, NULL, NULL, NULL, 'B', 1591529995, 1591529995, 35),
(94, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Nabi yang terkenal karena mengajak ayahnya untuk tidak menyembah setan adalah:', 'Nabi Nuh     ', 'Nabi Ishak      ', 'Nabi Yahya    ', 'Nabi Ibrahim', '', NULL, NULL, NULL, NULL, NULL, 'D', 1591529995, 1591529995, 35),
(95, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Nabi yang oleh kaum Kristen sangat diagungkan sebagai Raja yang agung adalah:', 'Nabi Daniel   ', 'Nabi Dawud    ', 'Nabi Israel   ', 'Nabi Yoshua', '', NULL, NULL, NULL, NULL, NULL, 'B', 1591529995, 1591529995, 35),
(96, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Aliran yang mengajarkan ada Nabi lagi setelah Nabi Muhammad menamakan dirinya:', 'Muhammadiyah', 'Ahmadiyah     ', 'Jahiliyyah   ', 'Wahabiyyah', '', NULL, NULL, NULL, NULL, NULL, 'B', 1591529995, 1591529995, 35),
(97, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Pahlawan Nasional yang dikenal dengan Ã¢â‚¬Å“Mosi IntegralÃ¢â‚¬Â untuk menyatukan kembali NKRI adalah:', 'KH Sholeh Iskandar    ', 'Moh. Hatta    ', 'Moh. Yamin      ', 'Moh. Natsir', '', NULL, NULL, NULL, NULL, NULL, 'D', 1591529995, 1591529995, 35),
(98, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Penulis Kitab IhyaÃ¢â‚¬â„¢ Ulumiddin adalah:', 'Syeikh Nawawi al-Bantani    ', 'Imam Nawawi     ', 'Imam al-Ghazali   ', 'Imam Syafii.', '', NULL, NULL, NULL, NULL, NULL, 'C', 1591529995, 1591529995, 35),
(99, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Sahabat Rasulullah saw yang menjadi duta Islam pertama berdakwah di  Madinah adalah:', 'Ali bin Abi Thalib   ', 'Ammar bin Yasir   ', 'MushÃ¢â‚¬â„¢ab bin Umair    ', 'Utsman bin Affan', '', NULL, NULL, NULL, NULL, NULL, 'C', 1591529995, 1591529995, 35),
(100, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Sahabat Nabi saw yang dijuluki sebagai Singa Allah adalah: ', 'Hamzah bin Abi Thalib   ', 'Hamzah bin Abdul Muthalib    ', 'Hamzah al-Fansury   ', 'Hamzah YaÃ¢â‚¬â„¢qub', '', NULL, NULL, NULL, NULL, NULL, 'B', 1591529995, 1591529995, 35),
(101, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Ulama penulis Kitab  Ushul Fiqih  Ã¢â‚¬Å“ar-RisalahÃ¢â‚¬Â  adalah:', 'Imam Syaukani', 'Imam al-Ghazali   ', 'Imam al-Syafii    ', 'Imam Maliki.', '', NULL, NULL, NULL, NULL, NULL, 'C', 1591529995, 1591529995, 35),
(102, 1, '', 1, 'multiplechoice', '', '', 'WAWASAN KEISLAMAN \\n Ilmu yang wajib dimiliki oleh setiap muslim disebut:', 'ilmu ushul fiqih   ', 'ilmu ladunni    ', 'ilmu riyadhiyyat    ', 'ilmu fardhu Ã¢â‚¬Ëœain.', '', NULL, NULL, NULL, NULL, NULL, 'D', 1591529995, 1591529995, 35);

-- --------------------------------------------------------

--
-- Table structure for table `crud`
--

CREATE TABLE `crud` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(200) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `table_name` varchar(200) NOT NULL,
  `primary_key` varchar(200) NOT NULL,
  `page_read` varchar(20) DEFAULT NULL,
  `page_create` varchar(20) DEFAULT NULL,
  `page_update` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud`
--

INSERT INTO `crud` (`id`, `title`, `subject`, `table_name`, `primary_key`, `page_read`, `page_create`, `page_update`) VALUES
(4, 'Blog Category', 'Blog Category', 'blog_category', 'category_id', 'yes', 'yes', 'yes'),
(5, 'Dosen', 'Dosen', 'master_dosen', 'id', 'yes', 'yes', 'yes'),
(6, 'Data Karyawan', 'Data Karyawan', 'karyawans', 'id', 'yes', 'yes', 'yes'),
(7, 'Data Siswa', 'Data Siswa', 'students', 'id', 'yes', 'yes', 'yes'),
(8, 'Pejabats', 'Pejabats', 'pejabats', 'id', 'yes', 'yes', 'yes'),
(9, 'Template Form', 'Template Form', 'mdtemplate_form', 'id', 'yes', 'yes', 'yes'),
(10, 'Pendaftaran Ujian', 'Pendaftaran Ujian', 'mhs_daftar', 'id', 'yes', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `crud_custom_option`
--

CREATE TABLE `crud_custom_option` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `option_value` text NOT NULL,
  `option_label` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_custom_option`
--

INSERT INTO `crud_custom_option` (`id`, `crud_field_id`, `crud_id`, `option_value`, `option_label`) VALUES
(129, 3331, 6, 'KONTRAK', 'KONTRAK'),
(130, 3331, 6, 'KONTRAN FAKULTAS', 'KONTRAN FAKULTAS'),
(131, 3331, 6, 'TETAP', 'TETAP');

-- --------------------------------------------------------

--
-- Table structure for table `crud_field`
--

CREATE TABLE `crud_field` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_id` int(11) NOT NULL,
  `field_name` varchar(200) NOT NULL,
  `field_label` varchar(200) DEFAULT NULL,
  `input_type` varchar(200) NOT NULL,
  `show_column` varchar(10) DEFAULT NULL,
  `show_add_form` varchar(10) DEFAULT NULL,
  `show_update_form` varchar(10) DEFAULT NULL,
  `show_detail_page` varchar(10) DEFAULT NULL,
  `sort` int(11) NOT NULL,
  `relation_table` varchar(200) DEFAULT NULL,
  `relation_value` varchar(200) DEFAULT NULL,
  `relation_label` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_field`
--

INSERT INTO `crud_field` (`id`, `crud_id`, `field_name`, `field_label`, `input_type`, `show_column`, `show_add_form`, `show_update_form`, `show_detail_page`, `sort`, `relation_table`, `relation_value`, `relation_label`) VALUES
(1, 1, 'category_id', 'category_id', 'number', '', '', '', 'yes', 1, '', '', ''),
(2, 1, 'category_name', 'category_name', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(3, 1, 'category_desc', 'category_desc', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(7, 2, 'category_id', 'category_id', 'select', '', '', '', 'yes', 1, 'aauth_groups', 'id', 'name'),
(8, 2, 'category_name', 'category_name', 'options', 'yes', 'yes', 'yes', 'yes', 2, 'aauth_groups', 'id', 'name'),
(9, 2, 'category_desc', 'category_desc', 'textarea', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(10, 3, 'category_id', 'category_id', 'number', '', '', '', 'yes', 1, '', '', ''),
(11, 3, 'category_name', 'category_name', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(12, 3, 'category_desc', 'category_desc', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(13, 4, 'category_id', 'category_id', 'number', '', '', '', 'yes', 1, '', '', ''),
(14, 4, 'category_name', 'category_name', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(15, 4, 'category_desc', 'category_desc', 'datetime', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(2516, 7, 'id', 'id', 'input', '', '', '', 'yes', 1, '', '', ''),
(2517, 7, 'program_studi_id', 'program studi', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'program_studis', 'id', 'nama'),
(2518, 7, 'kelas_id', 'kelas_id', 'number', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(2519, 7, 'subkelas_id', 'subkelas_id', 'number', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(2520, 7, 'total_semester', 'total_semester', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(2521, 7, 'code', 'code', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(2522, 7, 'nik', 'nik', 'input', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(2523, 7, 'nama', 'nama', 'input', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(2524, 7, 'email', 'email', 'input', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(2525, 7, 'status_mahasiswa', 'status_mahasiswa', 'input', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(2526, 7, 'status_penerimaan', 'status_penerimaan', 'input', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(2527, 7, 'jenis_kelamin', 'jenis_kelamin', 'input', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(2528, 7, 'tempat_lahir', 'tempat_lahir', 'input', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(2529, 7, 'tanggal_lahir', 'tanggal_lahir', 'date', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(2530, 7, 'alamat', 'alamat', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 15, '', '', ''),
(2531, 7, 'kode_pos', 'kode_pos', 'input', 'yes', 'yes', 'yes', 'yes', 16, '', '', ''),
(2532, 7, 'no_hp', 'no_hp', 'input', 'yes', 'yes', 'yes', 'yes', 17, '', '', ''),
(2533, 7, 'pendidikan_terakhir', 'pendidikan_terakhir', 'input', 'yes', 'yes', 'yes', 'yes', 18, '', '', ''),
(2534, 7, 'asal_universitas_s1', 'asal_universitas_s1', 'input', 'yes', 'yes', 'yes', 'yes', 19, '', '', ''),
(2535, 7, 'asal_universitas_s2', 'asal_universitas_s2', 'input', 'yes', 'yes', 'yes', 'yes', 20, '', '', ''),
(2536, 7, 'asal_universitas_s3', 'asal_universitas_s3', 'input', 'yes', 'yes', 'yes', 'yes', 21, '', '', ''),
(2537, 7, 'gelar_terakhir', 'gelar_terakhir', 'input', 'yes', 'yes', 'yes', 'yes', 22, '', '', ''),
(2538, 7, 'pekerjaan', 'pekerjaan', 'input', 'yes', 'yes', 'yes', 'yes', 23, '', '', ''),
(2539, 7, 'alamat_pekerjaan', 'alamat_pekerjaan', 'input', 'yes', 'yes', 'yes', 'yes', 24, '', '', ''),
(2540, 7, 'nama_ibu', 'nama_ibu', 'input', 'yes', 'yes', 'yes', 'yes', 25, '', '', ''),
(2541, 7, 'photo', 'photo', 'file', 'yes', 'yes', 'yes', 'yes', 26, '', '', ''),
(2542, 7, 'judul_thesis', 'judul_thesis', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 27, '', '', ''),
(2543, 7, 'status_akun', 'status_akun', 'input', 'yes', 'yes', 'yes', 'yes', 28, '', '', ''),
(2544, 7, 'daftar_tgl', 'daftar_tgl', 'date', 'yes', 'yes', 'yes', 'yes', 29, '', '', ''),
(2545, 7, 'diterima_tgl', 'diterima_tgl', 'date', 'yes', 'yes', 'yes', 'yes', 30, '', '', ''),
(2546, 7, 'created_at', 'created_at', 'timestamp', 'yes', 'yes', 'yes', 'yes', 31, '', '', ''),
(2547, 7, 'updated_at', 'updated_at', 'timestamp', 'yes', 'yes', 'yes', 'yes', 32, '', '', ''),
(3169, 8, 'id', 'id', 'input', 'yes', '', '', 'yes', 1, '', '', ''),
(3170, 8, 'karyawan_id', 'Karyawan', 'select', 'yes', 'yes', 'yes', 'yes', 2, 'karyawans', 'id', 'nama'),
(3171, 8, 'pengajar_id', 'Pengajar', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'pengajars', 'id', 'nama'),
(3172, 8, 'departement_id', 'departemen', 'select', 'yes', 'yes', 'yes', 'yes', 4, 'departements', 'id', 'nama'),
(3173, 8, 'jabatan', 'jabatan', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(3174, 8, 'ttd', 'ttd', 'file', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(3175, 8, 'status', 'status', 'yes_no', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(3176, 8, 'created_at', 'created_at', 'timestamp', '', '', '', 'yes', 8, '', '', ''),
(3177, 8, 'updated_at', 'updated_at', 'timestamp', '', '', '', 'yes', 9, '', '', ''),
(3238, 5, 'id', 'id', 'number', 'yes', '', '', 'yes', 1, '', '', ''),
(3239, 5, 'nik', 'nik', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(3240, 5, 'nama_lengkap', 'nama_lengkap', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(3241, 5, 'jenis_kelamin', 'jenis_kelamin', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(3242, 5, 'no_ktp', 'no_ktp', 'input', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(3243, 5, 'gelar_kesarjanaan', 'gelar_kesarjanaan', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(3244, 5, 'tempat_lahir', 'tempat_lahir', 'input', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(3245, 5, 'tanggal_lahir', 'tanggal_lahir', 'date', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(3246, 5, 'status_kawin', 'status_kawin', 'input', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(3247, 5, 'alamat_rumah', 'alamat_rumah', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(3248, 5, 'email', 'email', 'input', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(3249, 5, 'no_hp', 'no_hp', 'input', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(3250, 5, 'id_master_prodi', 'prodi', 'select', 'yes', 'yes', 'yes', 'yes', 13, 'program_studis', 'id', 'nama'),
(3251, 5, 'fungsional', 'fungsional', 'input', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(3252, 5, 'golongan', 'golongan', 'input', 'yes', 'yes', 'yes', 'yes', 15, '', '', ''),
(3253, 5, 'foto', 'foto', 'input', 'yes', 'yes', 'yes', 'yes', 16, '', '', ''),
(3254, 5, 'status_dosen', 'status_dosen', 'input', 'yes', 'yes', 'yes', 'yes', 17, '', '', ''),
(3255, 5, 'created_at', 'created_at', 'timestamp', '', 'yes', 'yes', 'yes', 18, '', '', ''),
(3256, 5, 'update_at', 'update_at', 'timestamp', '', 'yes', 'yes', 'yes', 19, '', '', ''),
(3257, 5, 'created_by', 'created_by', 'number', '', 'yes', 'yes', 'yes', 20, '', '', ''),
(3322, 9, 'id', 'id', 'number', 'yes', '', '', 'yes', 1, '', '', ''),
(3323, 9, 'nama_template', 'Nama Form', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(3324, 9, 'pejabat_id', 'Penaggung jawab', 'select', 'yes', 'yes', 'yes', 'yes', 3, 'pejabats', 'id', 'jabatan'),
(3325, 9, 'aktif', 'aktif', 'yes_no', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(3326, 6, 'id', 'id', 'input', 'yes', '', '', 'yes', 1, '', '', ''),
(3327, 6, 'code', 'code', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(3328, 6, 'nik', 'nik', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(3329, 6, 'nama', 'nama', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(3330, 6, 'email', 'email', 'email', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(3331, 6, 'status_karyawan', 'status_karyawan', 'input', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(3332, 6, 'jenis_kelamin', 'jenis_kelamin', 'input', 'yes', 'yes', 'yes', 'yes', 7, '', '', ''),
(3333, 6, 'tempat_lahir', 'tempat_lahir', 'input', 'yes', 'yes', 'yes', 'yes', 8, '', '', ''),
(3334, 6, 'tanggal_lahir', 'tanggal_lahir', 'date', 'yes', 'yes', 'yes', 'yes', 9, '', '', ''),
(3335, 6, 'alamat', 'alamat', 'editor_wysiwyg', 'yes', 'yes', 'yes', 'yes', 10, '', '', ''),
(3336, 6, 'kode_pos', 'kode_pos', 'input', 'yes', 'yes', 'yes', 'yes', 11, '', '', ''),
(3337, 6, 'pendidikan_terakhir', 'pendidikan_terakhir', 'input', 'yes', 'yes', 'yes', 'yes', 12, '', '', ''),
(3338, 6, 'asal_pendidikan', 'asal_pendidikan', 'input', 'yes', 'yes', 'yes', 'yes', 13, '', '', ''),
(3339, 6, 'no_hp', 'no_hp', 'input', 'yes', 'yes', 'yes', 'yes', 14, '', '', ''),
(3340, 6, 'photo', 'photo', 'file', 'yes', 'yes', 'yes', 'yes', 15, '', '', ''),
(3341, 6, 'program_studi_id', 'program_studi_id', 'number', 'yes', 'yes', 'yes', 'yes', 16, '', '', ''),
(3342, 6, 'departement_id', 'departement_id', 'number', 'yes', 'yes', 'yes', 'yes', 17, '', '', ''),
(3343, 6, 'status_akun', 'status_akun', 'input', 'yes', 'yes', 'yes', 'yes', 18, '', '', ''),
(3344, 6, 'created_at', 'created_at', 'timestamp', '', '', '', '', 19, '', '', ''),
(3345, 6, 'updated_at', 'updated_at', 'timestamp', '', '', '', '', 20, '', '', ''),
(3346, 10, 'id', 'id', 'number', 'yes', '', '', 'yes', 1, '', '', ''),
(3347, 10, 'kode', 'kode', 'input', 'yes', 'yes', 'yes', 'yes', 2, '', '', ''),
(3348, 10, 'npm', 'npm', 'input', 'yes', 'yes', 'yes', 'yes', 3, '', '', ''),
(3349, 10, 'ujian_id', 'Ujian', 'input', 'yes', 'yes', 'yes', 'yes', 4, '', '', ''),
(3350, 10, 'form_id', 'Form', 'number', 'yes', 'yes', 'yes', 'yes', 5, '', '', ''),
(3351, 10, 'tanggal_daftar', 'Tanggal Pendaftaran', 'date', 'yes', 'yes', 'yes', 'yes', 6, '', '', ''),
(3352, 10, 'tanggal_ujian', 'Tanggal Ujian', 'date', 'yes', 'yes', 'yes', 'yes', 7, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `crud_field_validation`
--

CREATE TABLE `crud_field_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `crud_field_id` int(11) NOT NULL,
  `crud_id` int(11) NOT NULL,
  `validation_name` varchar(200) NOT NULL,
  `validation_value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_field_validation`
--

INSERT INTO `crud_field_validation` (`id`, `crud_field_id`, `crud_id`, `validation_name`, `validation_value`) VALUES
(1, 2, 1, 'required', ''),
(2, 2, 1, 'max_length', '200'),
(3, 3, 1, 'required', ''),
(7, 8, 2, 'required', ''),
(8, 8, 2, 'max_length', '200'),
(9, 9, 2, 'required', ''),
(10, 11, 3, 'required', ''),
(11, 11, 3, 'max_length', '200'),
(12, 12, 3, 'required', ''),
(13, 14, 4, 'required', ''),
(14, 14, 4, 'max_length', '200'),
(15, 15, 4, 'required', ''),
(3784, 2517, 7, 'required', ''),
(3785, 2517, 7, 'max_length', '11'),
(3786, 2518, 7, 'required', ''),
(3787, 2518, 7, 'max_length', '11'),
(3788, 2519, 7, 'required', ''),
(3789, 2519, 7, 'max_length', '11'),
(3790, 2520, 7, 'required', ''),
(3791, 2520, 7, 'max_length', '11'),
(3792, 2521, 7, 'required', ''),
(3793, 2521, 7, 'max_length', '10'),
(3794, 2522, 7, 'required', ''),
(3795, 2522, 7, 'max_length', '75'),
(3796, 2523, 7, 'required', ''),
(3797, 2523, 7, 'max_length', '75'),
(3798, 2524, 7, 'required', ''),
(3799, 2524, 7, 'max_length', '255'),
(3800, 2525, 7, 'required', ''),
(3801, 2526, 7, 'required', ''),
(3802, 2527, 7, 'required', ''),
(3803, 2528, 7, 'required', ''),
(3804, 2528, 7, 'max_length', '255'),
(3805, 2529, 7, 'required', ''),
(3806, 2530, 7, 'required', ''),
(3807, 2531, 7, 'required', ''),
(3808, 2531, 7, 'max_length', '255'),
(3809, 2532, 7, 'required', ''),
(3810, 2532, 7, 'max_length', '255'),
(3811, 2533, 7, 'required', ''),
(3812, 2534, 7, 'required', ''),
(3813, 2534, 7, 'max_length', '255'),
(3814, 2535, 7, 'required', ''),
(3815, 2535, 7, 'max_length', '255'),
(3816, 2536, 7, 'required', ''),
(3817, 2536, 7, 'max_length', '255'),
(3818, 2537, 7, 'required', ''),
(3819, 2537, 7, 'max_length', '255'),
(3820, 2538, 7, 'required', ''),
(3821, 2538, 7, 'max_length', '255'),
(3822, 2539, 7, 'required', ''),
(3823, 2539, 7, 'max_length', '255'),
(3824, 2540, 7, 'required', ''),
(3825, 2540, 7, 'max_length', '255'),
(3826, 2541, 7, 'required', ''),
(3827, 2541, 7, 'max_length', '255'),
(3828, 2542, 7, 'required', ''),
(3829, 2543, 7, 'required', ''),
(3830, 2544, 7, 'required', ''),
(3831, 2545, 7, 'required', ''),
(3832, 2546, 7, 'required', ''),
(3833, 2547, 7, 'required', ''),
(4397, 3172, 8, 'required', ''),
(4398, 3172, 8, 'max_length', '255'),
(4399, 3173, 8, 'required', ''),
(4400, 3173, 8, 'max_length', '255'),
(4401, 3174, 8, 'required', ''),
(4402, 3174, 8, 'max_length', '255'),
(4403, 3175, 8, 'required', ''),
(4404, 3176, 8, 'required', ''),
(4405, 3177, 8, 'required', ''),
(4499, 3239, 5, 'required', ''),
(4500, 3239, 5, 'max_length', '11'),
(4501, 3240, 5, 'required', ''),
(4502, 3240, 5, 'max_length', '128'),
(4503, 3241, 5, 'required', ''),
(4504, 3242, 5, 'required', ''),
(4505, 3242, 5, 'max_length', '128'),
(4506, 3243, 5, 'required', ''),
(4507, 3243, 5, 'max_length', '128'),
(4508, 3244, 5, 'required', ''),
(4509, 3244, 5, 'max_length', '128'),
(4510, 3245, 5, 'required', ''),
(4511, 3246, 5, 'required', ''),
(4512, 3247, 5, 'required', ''),
(4513, 3248, 5, 'required', ''),
(4514, 3248, 5, 'max_length', '128'),
(4515, 3249, 5, 'required', ''),
(4516, 3249, 5, 'max_length', '13'),
(4517, 3250, 5, 'required', ''),
(4518, 3250, 5, 'max_length', '128'),
(4519, 3251, 5, 'required', ''),
(4520, 3251, 5, 'max_length', '50'),
(4521, 3252, 5, 'required', ''),
(4522, 3252, 5, 'max_length', '50'),
(4523, 3253, 5, 'required', ''),
(4524, 3253, 5, 'max_length', '128'),
(4525, 3254, 5, 'required', ''),
(4526, 3255, 5, 'required', ''),
(4527, 3256, 5, 'required', ''),
(4528, 3257, 5, 'required', ''),
(4529, 3257, 5, 'max_length', '11'),
(4578, 3323, 9, 'required', ''),
(4579, 3324, 9, 'required', ''),
(4580, 3325, 9, 'required', ''),
(4581, 3327, 6, 'required', ''),
(4582, 3327, 6, 'max_length', '10'),
(4583, 3328, 6, 'required', ''),
(4584, 3328, 6, 'max_length', '255'),
(4585, 3329, 6, 'required', ''),
(4586, 3329, 6, 'max_length', '255'),
(4587, 3330, 6, 'required', ''),
(4588, 3330, 6, 'max_length', '255'),
(4589, 3331, 6, 'required', ''),
(4590, 3332, 6, 'required', ''),
(4591, 3333, 6, 'required', ''),
(4592, 3333, 6, 'max_length', '255'),
(4593, 3334, 6, 'required', ''),
(4594, 3335, 6, 'required', ''),
(4595, 3336, 6, 'required', ''),
(4596, 3336, 6, 'max_length', '255'),
(4597, 3337, 6, 'required', ''),
(4598, 3338, 6, 'required', ''),
(4599, 3338, 6, 'max_length', '255'),
(4600, 3339, 6, 'required', ''),
(4601, 3339, 6, 'max_length', '255'),
(4602, 3340, 6, 'required', ''),
(4603, 3340, 6, 'max_length', '255'),
(4604, 3341, 6, 'required', ''),
(4605, 3341, 6, 'max_length', '11'),
(4606, 3342, 6, 'required', ''),
(4607, 3342, 6, 'max_length', '11'),
(4608, 3343, 6, 'required', ''),
(4609, 3344, 6, 'required', ''),
(4610, 3345, 6, 'required', ''),
(4611, 3347, 10, 'required', ''),
(4612, 3347, 10, 'max_length', '50'),
(4613, 3348, 10, 'required', ''),
(4614, 3348, 10, 'max_length', '50'),
(4615, 3349, 10, 'required', ''),
(4616, 3349, 10, 'max_length', '11'),
(4617, 3350, 10, 'required', ''),
(4618, 3350, 10, 'max_length', '11'),
(4619, 3351, 10, 'required', ''),
(4620, 3352, 10, 'required', '');

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_type`
--

CREATE TABLE `crud_input_type` (
  `id` int(11) UNSIGNED NOT NULL,
  `type` varchar(200) NOT NULL,
  `relation` varchar(20) NOT NULL,
  `custom_value` int(11) NOT NULL,
  `validation_group` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_input_type`
--

INSERT INTO `crud_input_type` (`id`, `type`, `relation`, `custom_value`, `validation_group`) VALUES
(1, 'input', '0', 0, 'input'),
(2, 'textarea', '0', 0, 'text'),
(3, 'select', '1', 0, 'select'),
(4, 'editor_wysiwyg', '0', 0, 'editor'),
(5, 'password', '0', 0, 'password'),
(6, 'email', '0', 0, 'email'),
(7, 'address_map', '0', 0, 'address_map'),
(8, 'file', '0', 0, 'file'),
(9, 'file_multiple', '0', 0, 'file_multiple'),
(10, 'datetime', '0', 0, 'datetime'),
(11, 'date', '0', 0, 'date'),
(12, 'timestamp', '0', 0, 'timestamp'),
(13, 'number', '0', 0, 'number'),
(14, 'yes_no', '0', 0, 'yes_no'),
(15, 'time', '0', 0, 'time'),
(16, 'year', '0', 0, 'year'),
(17, 'select_multiple', '1', 0, 'select_multiple'),
(18, 'checkboxes', '1', 0, 'checkboxes'),
(19, 'options', '1', 0, 'options'),
(20, 'true_false', '0', 0, 'true_false'),
(21, 'current_user_username', '0', 0, 'user_username'),
(22, 'current_user_id', '0', 0, 'current_user_id'),
(23, 'custom_option', '0', 1, 'custom_option'),
(24, 'custom_checkbox', '0', 1, 'custom_checkbox'),
(25, 'custom_select_multiple', '0', 1, 'custom_select_multiple'),
(26, 'custom_select', '0', 1, 'custom_select');

-- --------------------------------------------------------

--
-- Table structure for table `crud_input_validation`
--

CREATE TABLE `crud_input_validation` (
  `id` int(11) UNSIGNED NOT NULL,
  `validation` varchar(200) NOT NULL,
  `input_able` varchar(20) NOT NULL,
  `group_input` text NOT NULL,
  `input_placeholder` text NOT NULL,
  `call_back` varchar(10) NOT NULL,
  `input_validation` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `crud_input_validation`
--

INSERT INTO `crud_input_validation` (`id`, `validation`, `input_able`, `group_input`, `input_placeholder`, `call_back`, `input_validation`) VALUES
(1, 'required', 'no', 'input, file, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes, true_false, address_map, custom_option, custom_checkbox, custom_select_multiple, custom_select, file_multiple', '', '', ''),
(2, 'max_length', 'yes', 'input, number, text, select, password, email, editor, yes_no, time, year, select_multiple, options, checkboxes, address_map', '', '', 'numeric'),
(3, 'min_length', 'yes', 'input, number, text, select, password, email, editor, time, year, select_multiple, address_map', '', '', 'numeric'),
(4, 'valid_email', 'no', 'input, email', '', '', ''),
(5, 'valid_emails', 'no', 'input, email', '', '', ''),
(6, 'regex', 'yes', 'input, number, text, datetime, select, password, email, editor, date, yes_no, time, year, select_multiple, options, checkboxes', '', 'yes', 'callback_valid_regex'),
(7, 'decimal', 'no', 'input, number, text, select', '', '', ''),
(8, 'allowed_extension', 'yes', 'file, file_multiple', 'ex : jpg,png,..', '', 'callback_valid_extension_list'),
(9, 'max_width', 'yes', 'file, file_multiple', '', '', 'numeric'),
(10, 'max_height', 'yes', 'file, file_multiple', '', '', 'numeric'),
(11, 'max_size', 'yes', 'file, file_multiple', '... kb', '', 'numeric'),
(12, 'max_item', 'yes', 'file_multiple', '', '', 'numeric'),
(13, 'valid_url', 'no', 'input, text', '', '', ''),
(14, 'alpha', 'no', 'input, text, select, password, editor, yes_no', '', '', ''),
(15, 'alpha_numeric', 'no', 'input, number, text, select, password, editor', '', '', ''),
(16, 'alpha_numeric_spaces', 'no', 'input, number, text,select, password, editor', '', '', ''),
(17, 'valid_number', 'no', 'input, number, text, password, editor, true_false', '', 'yes', ''),
(18, 'valid_datetime', 'no', 'input, datetime, text', '', 'yes', ''),
(19, 'valid_date', 'no', 'input, datetime, date, text', '', 'yes', ''),
(20, 'valid_max_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric'),
(21, 'valid_min_selected_option', 'yes', 'select_multiple, custom_select_multiple, custom_checkbox, checkboxes', '', 'yes', 'numeric'),
(22, 'valid_alpha_numeric_spaces_underscores', 'no', 'input, text,select, password, editor', '', 'yes', ''),
(23, 'matches', 'yes', 'input, number, text, password, email', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores'),
(24, 'valid_json', 'no', 'input, text, editor', '', 'yes', ' '),
(25, 'valid_url', 'no', 'input, text, editor', '', 'no', ' '),
(26, 'exact_length', 'yes', 'input, text, number', '0 - 99999*', 'no', 'numeric'),
(27, 'alpha_dash', 'no', 'input, text', '', 'no', ''),
(28, 'integer', 'no', 'input, text, number', '', 'no', ''),
(29, 'differs', 'yes', 'input, text, number, email, password, editor, options, select', 'any field', 'no', 'callback_valid_alpha_numeric_spaces_underscores'),
(30, 'is_natural', 'no', 'input, text, number', '', 'no', ''),
(31, 'is_natural_no_zero', 'no', 'input, text, number', '', 'no', ''),
(32, 'less_than', 'yes', 'input, text, number', '', 'no', 'numeric'),
(33, 'less_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric'),
(34, 'greater_than', 'yes', 'input, text, number', '', 'no', 'numeric'),
(35, 'greater_than_equal_to', 'yes', 'input, text, number', '', 'no', 'numeric'),
(36, 'in_list', 'yes', 'input, text, number, select, options', '', 'no', 'callback_valid_multiple_value'),
(37, 'valid_ip', 'no', 'input, text', '', 'no', '');

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(75) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `code`, `nama`, `created_at`, `updated_at`) VALUES
(1, '001', 'UPTTIK', '2022-03-25 03:32:38', NULL),
(2, '002', 'PRODI', '2022-03-25 07:39:34', NULL),
(3, '003', 'TATA USAHA', '2022-04-11 02:50:34', NULL),
(4, '004', 'KEUANGAN', '2022-04-11 02:50:55', NULL),
(5, '005', 'AKADEMIK', '2022-04-11 02:51:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

CREATE TABLE `enroll` (
  `id` int(11) NOT NULL,
  `prodiID` varchar(4) NOT NULL,
  `id_group_soal` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`id`, `prodiID`, `id_group_soal`, `created_at`) VALUES
(1, 'MPI', 1, '2022-03-10 06:47:15'),
(2, 'MES', 1, '2022-03-10 06:47:15'),
(3, 'MTP', 1, '2022-03-10 06:47:15'),
(4, 'MMN', 1, '2022-03-10 06:47:15'),
(5, 'DPI', 1, '2022-03-10 06:47:15'),
(6, 'ADM', 1, '2022-03-10 06:47:15');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `asal_instansi` varchar(255) NOT NULL,
  `email` varchar(80) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `delete_at` datetime NOT NULL,
  `soft_delete` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `uid`, `prodi_id`, `nama`, `no_hp`, `asal_instansi`, `email`, `status`, `created_at`, `delete_at`, `soft_delete`) VALUES
(1, 100, 3, 'Ahmad', '081381100046', 'asd', 'asrul@local.com', 0, '2021-12-01 16:03:12', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `group_soal`
--

CREATE TABLE `group_soal` (
  `id` int(11) NOT NULL,
  `id_master_prodi` int(11) DEFAULT NULL,
  `title_ujian` longtext NOT NULL,
  `jumlah_soal` varchar(255) NOT NULL,
  `waktu_pengerjaan` int(11) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_berakhir` datetime NOT NULL,
  `token` varchar(5) DEFAULT NULL,
  `jenis` enum('acak','urut') NOT NULL DEFAULT 'urut'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `group_soal`
--

INSERT INTO `group_soal` (`id`, `id_master_prodi`, `title_ujian`, `jumlah_soal`, `waktu_pengerjaan`, `tgl_mulai`, `tgl_berakhir`, `token`, `jenis`) VALUES
(1, NULL, 'asd', '40', 12, '2022-02-24 13:26:00', '2022-02-24 13:26:00', NULL, 'acak');

-- --------------------------------------------------------

--
-- Table structure for table `h_ujian`
--

CREATE TABLE `h_ujian` (
  `id` int(11) NOT NULL,
  `id_group_soal` int(11) NOT NULL,
  `id_master_mahasiswa` int(11) NOT NULL,
  `list_soal` longtext NOT NULL,
  `list_jawaban` longtext NOT NULL,
  `jml_benar` int(11) NOT NULL,
  `nilai` decimal(10,2) NOT NULL,
  `nilai_bobot` decimal(10,2) NOT NULL,
  `tgl_mulai` datetime NOT NULL,
  `tgl_selesai` datetime NOT NULL,
  `status` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `h_ujian`
--

INSERT INTO `h_ujian` (`id`, `id_group_soal`, `id_master_mahasiswa`, `list_soal`, `list_jawaban`, `jml_benar`, `nilai`, `nilai_bobot`, `tgl_mulai`, `tgl_selesai`, `status`) VALUES
(174, 32, 298, '54,60,95,74,69,61,85,98,58,64,96,90,91,100,94,99,56,62,65,77,86,67,88,92,63,78,68,93,66,73,72,101,81,75,57,84,59,55,82,71,97,80,87,83,53,76,89,102,70,79', '54:E:N,60:B:N,95:B:N,74:A:N,69:E:N,61:B:N,85:C:N,98:C:N,58:E:N,64:A:N,96:B:N,90:A:N,91:A:N,100:B:N,94:D:N,99:C:N,56:B:N,62::Y,65:E:N,77:E:N,86:C:N,67:B:N,88:A:N,92:A:N,63:A:N,78:B:N,68:D:N,93:D:N,66:C:N,73:C:N,72:C:N,101:C:N,81:A:N,75:D:N,57::N,84::N,59::N,55::N,82::N,71::N,97::N,80::N,87::N,83::N,53::N,76::N,89::N,102::N,70::N,79::N', 23, '46.00', '100.00', '2020-09-30 08:43:34', '2020-09-30 09:13:34', 'N'),
(175, 32, 293, '78,65,72,86,100,88,81,91,57,83,89,75,85,66,67,93,69,59,63,101,62,95,96,71,87,102,92,58,79,64,68,70,99,76,82,84,90,56,97,98,77,74,61,94,53,55,54,60,80,73', '78:D:N,65:A:N,72:C:N,86:A:N,100:B:N,88:A:Y,81:A:N,91:A:N,57:B:N,83:A:N,89:B:N,75:C:N,85:C:N,66::N,67:A:N,93:D:N,69:A:Y,59:B:N,63:A:Y,101:C:N,62::N,95:B:N,96:B:N,71:A:N,87:A:N,102:A:N,92:A:N,58::N,79:A:N,64::N,68::N,70::N,99::N,76::N,82::N,84::N,90::N,56::N,97::N,98::N,77::N,74::N,61::N,94::N,53::N,55::N,54::N,60::N,80::N,73::N', 16, '32.00', '100.00', '2020-09-30 08:43:36', '2020-09-30 09:13:36', 'N'),
(176, 32, 304, '58,101,64,88,100,80,85,57,63,78,82,95,67,68,84,79,93,98,87,99,76,81,59,94,90,75,61,92,70,60,97,56,55,72,69,66,73,74,86,65,83,91,71,96,102,54,89,77,53,62', '58:E:N,101::Y,64::Y,88::Y,100::Y,80:B:N,85:C:N,57:C:N,63:A:N,78:B:Y,82:B:N,95::Y,67:B:N,68:C:N,84:C:N,79:A:N,93:D:Y,98::Y,87::Y,99::Y,76:A:N,81:A:N,59:B:N,94::Y,90:A:N,75:C:N,61:B:N,92::Y,70:A:N,60:C:N,97::Y,56:B:N,55:A:N,72:C:N,69:E:N,66:C:N,73:C:N,74:A:N,86:B:N,65::Y,83:C:N,91:B:N,71:D:N,96:D:N,102::N,54::N,89::N,77::N,53::N,62::N', 26, '52.00', '100.00', '2020-09-30 08:44:08', '2020-09-30 09:14:08', 'N'),
(177, 32, 310, '78,91,89,100,79,75,70,96,56,69,64,74,71,98,68,81,54,80,102,92,67,77,65,55,61,66,59,82,88,97,99,87,93,60,73,90,57,72,84,62,58,53,101,85,86,95,63,83,94,76', '78::N,91:B:N,89:B:N,100:B:N,79:D:N,75:C:N,70:C:N,96:A:N,56:B:N,69::N,64::N,74:A:N,71::N,98:C:N,68::N,81::N,54:A:N,80::N,102:A:N,92:C:N,67:B:N,77:E:N,65::N,55::N,61::N,66::N,59::N,82::N,88:B:N,97:D:N,99:C:N,87:C:N,93:A:N,60::N,73::N,90::N,57:C:N,72:C:N,84::N,62::N,58::N,53::N,101::N,85::N,86::N,95::N,63::N,83::N,94::N,76:C:N', 14, '28.00', '100.00', '2020-09-30 08:44:18', '2020-09-30 09:14:18', 'N'),
(178, 32, 281, '58,69,78,54,77,93,55,76,83,60,99,65,61,79,94,59,73,74,101,100,56,89,71,64,92,53,70,102,68,75,98,67,57,84,62,63,72,96,85,91,82,88,90,86,87,66,95,81,80,97', '58:E:N,69:B:N,78:C:N,54:E:N,77:B:N,93:D:N,55:C:N,76:D:N,83:A:N,60:C:N,99:A:N,65:C:N,61:C:N,79:A:N,94:D:N,59:E:N,73:D:N,74:A:N,101:C:N,100:A:N,56:C:N,89:B:N,71:B:N,64:B:N,92:A:N,53:A:N,70:A:N,102:A:N,68:A:N,75:C:N,98:C:N,67:A:N,57:A:N,84:C:N,62:D:N,63:B:N,72:B:N,96:B:N,85:B:N,91::N,82:B:N,88:D:N,90:A:N,86:C:N,87:A:N,66:B:N,95:B:N,81:B:N,80:C:N,97:A:N', 17, '34.00', '100.00', '2020-09-30 08:44:32', '2020-09-30 09:14:32', 'Y'),
(180, 32, 294, '69,53,88,72,59,58,60,64,73,79,61,92,78,85,75,70,80,54,83,65,56,71,90,66,57,98,55,95,97,93,74,101,100,68,82,77,76,89,86,63,99,94,87,84,62,91,81,102,67,96', '69:C:N,53:E:N,88:B:N,72:E:N,59:B:N,58:E:N,60:A:N,64:A:N,73:C:N,79:A:N,61:A:N,92:A:N,78:D:N,85:C:N,75:C:N,70:B:N,80:A:N,54:B:N,83:A:N,65:D:N,56:E:N,71:A:N,90:A:N,66:C:N,57:C:N,98:D:N,55:C:N,95:D:N,97:A:N,93:A:N,74:A:N,101:C:N,100:A:N,68:A:N,82:D:N,77:E:N,76:E:N,89:D:N,86:B:N,63:D:N,99:A:N,94:D:N,87:C:N,84:C:N,62:B:N,91:B:N,81:B:N,102:A:N,67:A:N,96:B:N', 21, '42.00', '100.00', '2020-09-30 08:44:50', '2020-09-30 09:14:50', 'Y'),
(181, 32, 297, '63,95,99,101,71,86,65,88,72,77,98,61,64,94,55,87,102,54,83,96,56,76,81,70,79,53,74,92,67,84,75,73,100,97,68,90,69,82,60,80,58,93,85,59,78,89,91,62,57,66', '63:A:N,95:D:N,99:C:N,101:C:N,71:A:N,86:A:N,65:A:N,88:B:N,72:C:N,77:E:N,98:A:N,61:D:N,64:D:N,94:D:N,55:C:N,87:A:N,102:A:N,54:A:N,83:A:N,96:C:N,56:C:N,76::N,81::N,70:B:N,79:A:N,53::N,74:B:N,92:A:N,67::N,84:C:N,75:E:N,73:C:N,100:A:N,97:C:N,68:A:N,90:A:N,69:D:N,82:D:N,60:E:N,80:B:N,58:A:N,93:B:N,85:C:N,59::N,78:D:N,89:B:N,91:A:N,62::N,57::N,66::N', 18, '36.00', '100.00', '2020-09-30 08:45:00', '2020-09-30 09:15:00', 'Y'),
(182, 32, 287, '68,62,65,53,87,94,56,89,80,98,86,78,66,77,55,96,60,71,99,67,100,79,85,91,76,73,54,74,58,70,59,75,64,88,81,63,83,90,101,61,57,97,92,102,72,69,93,84,95,82', '68::Y,62::N,65::N,53:E:N,87:A:N,94:D:N,56:B:N,89:B:N,80:B:N,98:C:N,86:A:N,78::N,66:C:N,77:E:N,55:A:N,96:B:N,60:C:N,71:D:N,99:C:N,67::N,100:B:N,79:D:N,85:C:N,91::N,76:C:N,73:C:N,54:D:N,74:A:N,58:E:N,70:C:N,59::N,75::N,64::N,88::N,81::N,63::N,83::N,90::N,101::N,61::N,57::N,97::N,92::N,102::N,72::N,69::N,93::N,84::N,95::N,82::N', 21, '42.00', '100.00', '2020-09-30 08:45:03', '2020-09-30 09:15:03', 'Y'),
(183, 32, 282, '87,90,68,57,67,69,60,61,66,59,63,72,65,86,79,77,96,70,74,100,62,85,83,93,82,94,97,98,84,88,56,89,75,92,102,80,101,91,76,78,55,53,58,54,95,81,99,64,73,71', '87:A:N,90:A:N,68:A:N,57:A:N,67:C:N,69:A:N,60:B:N,61:A:N,66:D:N,59:D:N,63:C:N,72:C:N,65:B:N,86:B:N,79:D:N,77:E:N,96:B:N,70:A:N,74:A:N,100:B:N,62:D:N,85:C:N,83:A:N,93:D:N,82:B:N,94:D:N,97:B:N,98:C:N,84:C:N,88:C:N,56:D:N,89:B:N,75:C:N,92:A:N,102:D:N,80:B:N,101:C:N,91:A:N,76:B:N,78:D:N,55:B:N,53:E:N,58:B:N,54:B:N,95:D:N,81:C:N,99:C:N,64:C:N,73:C:N,71:D:N', 25, '50.00', '100.00', '2020-09-30 08:45:13', '2020-09-30 09:15:13', 'Y'),
(185, 32, 266, '92,75,87,84,56,62,101,59,96,58,74,53,60,57,79,71,93,76,73,63,80,99,64,68,98,69,86,95,89,66,54,91,67,90,97,100,94,78,55,85,77,82,61,102,83,72,88,70,65,81', '92:A:N,75:D:N,87:A:N,84:C:N,56:B:N,62:C:N,101:C:N,59::N,96:B:N,58:E:N,74:A:N,53:E:N,60:A:N,57::N,79::N,71:B:N,93:D:N,76:E:N,73:C:N,63:B:N,80:A:N,99:C:N,64:B:N,68:C:N,98:C:N,69:D:N,86:A:N,95:B:N,89:B:N,66:C:N,54:B:N,91:A:N,67::N,90:A:N,97:D:N,100:B:N,94:D:N,78:C:N,55:A:N,85:C:N,77:A:N,82:B:N,61:A:N,102:D:N,83:C:N,72:B:N,88:A:N,70:D:N,65:C:N,81:A:N', 26, '52.00', '100.00', '2020-09-30 08:45:43', '2020-09-30 09:15:43', 'N'),
(186, 32, 289, '72,57,85,79,75,93,82,102,99,68,71,94,88,73,90,78,86,81,91,65,61,56,66,89,100,97,69,59,98,77,80,62,74,96,87,101,70,53,60,76,54,64,92,67,95,58,83,63,84,55', '72:C:N,57:D:N,85:C:N,79:A:N,75:C:N,93:D:N,82:D:N,102:D:N,99:C:N,68:C:N,71:D:N,94:D:N,88:A:N,73:C:N,90:A:N,78:D:N,86:A:N,81:D:N,91:B:N,65:D:N,61:A:N,56:E:N,66:C:N,89:B:N,100:B:N,97:D:N,69:E:N,59:C:N,98:C:N,77:E:N,80:D:N,62:A:N,74:D:N,96:B:N,87:A:N,101:C:N,70:B:N,53:E:N,60:C:N,76:A:N,54:A:N,64:D:N,92::N,67:B:N,95:B:N,58:A:N,83:C:N,63:A:N,84:C:N,55:A:N', 31, '62.00', '100.00', '2020-09-30 08:45:44', '2020-09-30 09:15:44', 'Y'),
(187, 32, 276, '54,55,63,98,82,87,56,69,91,78,70,64,101,57,53,93,75,102,65,58,74,88,100,72,97,90,73,60,76,92,85,84,95,96,89,81,67,77,71,68,99,80,61,59,79,94,62,83,66,86', '54:A:N,55:D:N,63:A:N,98:C:N,82::N,87:A:N,56:C:N,69::N,91:A:N,78::N,70::Y,64:B:N,101:A:N,57:A:N,53:B:N,93:D:N,75::Y,102:D:N,65:D:N,58:B:N,74::Y,88:B:N,100:A:N,72::Y,97:D:N,90:A:N,73::Y,60:B:N,76::Y,92:A:N,85:C:N,84:C:N,95:B:N,96:B:N,89:B:N,81::Y,67:A:N,77::Y,71::Y,68::Y,99:C:N,80::Y,61:A:N,59:A:N,79::Y,94:D:N,62:C:N,83:C:N,66:B:N,86:B:N', 16, '32.00', '100.00', '2020-09-30 08:46:03', '2020-09-30 09:16:03', 'Y'),
(188, 32, 288, '79,77,54,64,72,102,65,76,81,68,60,75,94,95,85,66,99,98,87,70,86,73,53,96,62,88,100,59,92,93,84,80,71,82,57,89,63,97,69,90,55,91,56,78,74,83,58,101,67,61', '79:D:N,77:E:N,54:B:Y,64:D:N,72:C:N,102:C:Y,65:D:N,76:C:N,81:C:N,68:B:N,60::N,75:E:N,94:E:N,95:E:N,85:D:N,66::N,99::N,98::N,87:A:N,70::N,86::N,73:C:N,53::N,96:B:N,62::N,88::N,100::N,59::N,92:A:N,93:D:N,84:C:N,80::N,71::N,82::N,57::N,89:B:N,63::N,97:D:N,69:D:N,90:A:N,55::N,91::N,56:E:N,78::N,74:A:N,83::N,58::N,101:C:N,67::N,61::N', 14, '28.00', '100.00', '2020-09-30 08:46:20', '2020-09-30 09:16:20', 'Y'),
(189, 32, 274, '80,87,74,93,98,57,82,65,56,95,96,69,55,85,81,59,88,67,97,89,99,102,101,63,92,100,70,66,61,78,60,64,73,91,84,90,76,68,83,62,94,53,71,72,58,86,79,54,75,77', '80:A:N,87:A:N,74:A:N,93:B:N,98:C:N,57:C:N,82:A:N,65:D:N,56:B:N,95:B:N,96:B:N,69:B:N,55:E:N,85:C:N,81:C:N,59:B:N,88:B:N,67:A:N,97:D:N,89:D:N,99:D:N,102:D:N,101:C:N,63:B:N,92:A:N,100:B:N,70:D:N,66:A:N,61:A:N,78:A:N,60:B:N,64:B:N,73:C:N,91:A:N,84:C:N,90:A:N,76:C:N,68:D:N,83:C:N,62:D:N,94:D:N,53:B:N,71:C:N,72:C:N,58:C:N,86:B:N,79:B:N,54:E:N,75:B:N,77:E:N', 24, '48.00', '100.00', '2020-09-30 08:46:27', '2020-09-30 09:16:27', 'Y'),
(190, 32, 311, '91,57,53,61,88,63,59,102,75,87,95,100,56,74,78,80,69,99,93,81,67,70,94,77,96,60,84,86,83,73,55,58,68,92,82,98,85,90,97,64,62,65,101,72,76,54,89,71,79,66', '91:A:N,57:B:N,53:A:Y,61:A:N,88:C:N,63:A:N,59:E:N,102:A:N,75:E:N,87:A:N,95:A:N,100:B:N,56:E:N,74:A:N,78:A:N,80:B:N,69:B:N,99:C:N,93:D:N,81:A:N,67:C:N,70:B:N,94:D:N,77:A:N,96:B:N,60:B:N,84:C:N,86:A:N,83:A:N,73:D:N,55:C:N,58:C:N,68:C:N,92:A:N,82:B:N,98:B:N,85:C:N,90:A:N,97:D:N,64:D:N,62:A:N,65:D:N,101:C:N,72:E:N,76:B:N,54:B:N,89:D:N,71:B:N,79:A:N,66:E:Y', 18, '36.00', '100.00', '2020-09-30 08:46:32', '2020-09-30 09:16:32', 'Y'),
(192, 32, 265, '102,55,71,53,57,63,93,60,98,100,65,88,76,82,68,59,75,69,90,84,94,97,85,89,79,67,80,92,77,58,64,95,78,73,96,66,56,91,62,72,99,70,86,74,61,54,83,81,101,87', '102:D:N,55::N,71:D:N,53::N,57::N,63::N,93:C:N,60::N,98:C:N,100:B:N,65:E:N,88:A:N,76:C:N,82:B:N,68:E:N,59:B:N,75:C:N,69:B:N,90:A:N,84:C:N,94:D:N,97:D:N,85:C:N,89:B:N,79:D:N,67:A:N,80:B:N,92:A:N,77:E:N,58::N,64::N,95:B:N,78::N,73:C:N,96:B:N,66:B:N,56:B:N,91:B:N,62:D:N,72:C:N,99:C:N,70:A:N,86:B:N,74:A:N,61:B:N,54:D:N,83:A:N,81:A:N,101:B:N,87:A:N', 34, '68.00', '100.00', '2020-09-30 08:46:48', '2020-09-30 09:16:48', 'Y'),
(193, 32, 279, '73,102,88,80,64,61,89,55,91,74,63,93,53,90,98,97,79,58,54,81,96,83,56,67,71,59,70,101,78,60,99,75,94,72,66,69,92,57,82,87,76,77,84,100,85,86,95,62,68,65', '73:C:N,102:D:N,88:C:N,80:C:N,64:E:N,61:A:N,89:B:N,55:E:N,91:A:N,74:A:N,63:D:N,93:B:N,53:C:N,90:A:N,98:C:N,97:A:N,79:D:N,58:C:N,54:D:N,81:B:N,96:A:N,83:A:N,56:C:N,67:A:N,71:D:N,59:D:N,70:E:N,101:C:N,78:C:N,60:A:N,99:C:N,75:E:N,94:D:N,72:C:N,66:B:N,69:D:N,92:B:N,57:B:N,82:D:N,87:A:N,76:C:N,77:E:N,84:C:N,100:B:N,85:B:N,86:A:N,95:B:N,62:B:N,68:A:N,65:B:N', 19, '38.00', '100.00', '2020-09-30 08:46:52', '2020-09-30 09:16:52', 'Y'),
(194, 32, 277, '56,101,87,86,53,88,70,99,65,90,58,83,92,89,80,76,73,75,98,62,68,100,67,74,59,77,81,63,64,93,54,78,79,96,102,85,72,55,82,61,71,60,57,95,84,69,97,94,91,66', '56:E:N,101:C:N,87:A:N,86:B:N,53:E:N,88:A:N,70:C:N,99:C:N,65:D:N,90:A:N,58:A:N,83:C:N,92:E:N,89:B:N,80:B:N,76:E:N,73:D:N,75:C:N,98:C:N,62:C:N,68:A:N,100:B:N,67:A:N,74:E:N,59:B:N,77:E:N,81:C:N,63:E:N,64:A:N,93:E:N,54:E:N,78:D:N,79:D:N,96:B:N,102:D:N,85:C:N,72:E:N,55:A:N,82:E:N,61:E:N,71:D:N,60:C:N,57:E:N,95:E:N,84:C:N,69:A:N,97:D:N,94:D:N,91:A:N,66:A:N', 25, '50.00', '100.00', '2020-09-30 08:46:54', '2020-09-30 09:16:54', 'Y'),
(195, 32, 285, '77,90,74,101,84,70,76,96,87,68,83,58,54,95,69,60,89,72,66,80,73,67,55,63,57,71,100,93,59,82,98,92,64,102,79,78,61,94,56,97,85,75,65,53,99,86,91,88,62,81', '77:E:N,90:A:N,74:A:N,101:C:N,84:C:N,70:D:N,76:C:N,96:B:N,87:A:N,68:B:N,83:C:N,58:E:N,54:B:N,95:B:N,69:C:N,60:B:N,89:B:N,72:C:N,66:B:N,80:A:N,73:C:N,67:B:N,55:A:N,63:D:N,57:A:N,71:D:N,100:B:N,93:D:N,59:B:N,82:B:N,98:C:N,92:B:N,64:D:N,102:D:N,79:D:N,78:D:N,61:B:N,94:D:N,56:C:N,97:D:N,85:C:N,75:A:N,65:E:N,53:E:N,99:C:N,86:A:N,91:B:N,88:A:N,62:A:N,81:C:N', 34, '68.00', '100.00', '2020-09-30 08:46:54', '2020-09-30 09:16:54', 'Y'),
(197, 32, 264, '56,61,55,72,87,79,85,71,97,70,59,90,91,86,95,63,67,102,69,89,54,77,101,84,93,88,94,80,53,78,100,92,81,65,98,60,83,82,73,76,96,58,74,68,75,62,66,64,99,57', '56:C:N,61:A:N,55:E:N,72:A:N,87:A:N,79:B:N,85:D:N,71:E:N,97:C:N,70:C:N,59:E:N,90:A:N,91:A:N,86:A:N,95:B:N,63:C:N,67:A:N,102:D:N,69:A:N,89:B:N,54:B:N,77:E:N,101:C:N,84:C:N,93:D:N,88:A:N,94:D:N,80:C:N,53:D:N,78:A:N,100:B:N,92:A:N,81:C:N,65:D:N,98:C:N,60:C:N,83:C:N,82:C:N,73:D:N,76:E:N,96:B:N,58:A:N,74:E:N,68:E:N,75:B:N,62:A:N,66:A:N,64:B:N,99::N,57::N', 17, '34.00', '100.00', '2020-09-30 08:47:43', '2020-09-30 09:17:43', 'Y'),
(198, 32, 305, '62,82,72,54,66,53,102,63,99,76,97,84,68,55,100,93,83,86,87,89,71,73,58,85,60,92,59,67,74,98,88,81,61,95,77,79,69,65,91,90,80,75,101,57,64,96,94,70,56,78', '62:E:N,82:B:N,72:D:N,54:A:N,66:B:N,53:C:N,102:B:N,63:E:N,99:C:N,76:D:N,97:C:N,84:B:N,68:C:N,55:D:N,100:B:N,93:D:N,83:C:N,86:C:N,87:A:N,89:B:N,71:B:N,73:D:N,58:A:N,85:C:N,60:C:N,92:A:N,59:C:N,67:A:N,74:A:N,98:D:N,88:B:N,81:D:N,61:A:N,95:B:N,77:D:N,79:A:N,69:B:N,65:D:N,91:A:N,90:A:N,80:B:N,75:E:N,101:C:N,57:B:N,64:D:N,96:B:N,94:C:N,70:E:N,56:E:N,78:D:N', 19, '38.00', '100.00', '2020-09-30 08:47:44', '2020-09-30 09:17:44', 'Y'),
(199, 32, 316, '61,101,87,77,76,98,72,59,85,89,81,84,63,78,65,96,83,86,82,94,70,90,66,62,69,88,64,53,97,91,67,102,68,73,71,79,92,93,54,55,75,80,99,56,95,60,57,100,74,58', '61:B:N,101:B:N,87:A:N,77:E:N,76:E:N,98:C:N,72:C:N,59:B:N,85:C:N,89:B:N,81:D:N,84:C:N,63:A:N,78:D:N,65:D:N,96:B:N,83:C:N,86:A:N,82:D:N,94:D:N,70:A:N,90:A:N,66:D:N,62:D:N,69:E:N,88:B:N,64:B:N,53:E:N,97:D:N,91:A:N,67:A:N,102:D:N,68:D:N,73:D:N,71:B:N,79:C:N,92:A:N,93:D:N,54:B:N,55:A:N,75:C:N,80:C:N,99:C:N,56:C:N,95:C:N,60:C:N,57:C:N,100:A:N,74:A:N,58:E:N', 27, '54.00', '100.00', '2020-09-30 08:47:54', '2020-09-30 09:17:54', 'N'),
(201, 32, 306, '62,100,85,92,97,56,58,71,87,99,59,69,61,76,88,67,60,53,81,90,73,91,86,66,57,79,96,64,63,94,102,55,75,54,101,72,82,74,89,95,78,83,98,77,84,93,70,80,65,68', '62:C:N,100:B:N,85:C:N,92:A:N,97:D:N,56::N,58:E:N,71:D:N,87:A:N,99:C:N,59:B:N,69:B:N,61:B:N,76:E:N,88:D:N,67:B:N,60:C:N,53:E:N,81:B:N,90:A:N,73:C:N,91:A:N,86:B:N,66::N,57:C:N,79:B:N,96:B:N,64:E:N,63:D:N,94:C:N,102:D:N,55:A:N,75:C:N,54:B:N,101:C:N,72:C:N,82:D:N,74:A:N,89:B:N,95:B:N,78::N,83:A:N,98:C:N,77:E:N,84:C:N,93:D:N,70:A:N,80::N,65::N,68::N', 30, '60.00', '100.00', '2020-09-30 08:48:21', '2020-09-30 09:18:21', 'N'),
(202, 32, 286, '62,84,97,74,82,68,90,79,75,96,64,63,61,53,54,95,89,70,87,92,83,102,65,56,91,59,72,93,76,78,57,55,58,77,81,86,69,71,85,73,60,98,101,80,94,99,100,66,88,67', '62:D:N,84:C:N,97:A:N,74:A:N,82:B:N,68:A:N,90:A:N,79:D:N,75:E:N,96:B:N,64:D:N,63:A:N,61:B:N,53:E:N,54:A:N,95:D:N,89:B:N,70:A:N,87:A:N,92:A:N,83:A:N,102:D:N,65:D:N,56:E:N,91:A:N,59:B:N,72:C:N,93:D:N,76:C:N,78::N,57::N,55::N,58::N,77::N,81::N,86::N,69::N,71::N,85::N,73::N,60::N,98::N,101::N,80::N,94::N,99::N,100::N,66::N,88::N,67::N', 17, '34.00', '100.00', '2020-09-30 08:48:28', '2020-09-30 09:18:28', 'N'),
(203, 32, 278, '57,99,87,67,98,76,54,66,94,88,72,81,80,53,58,83,86,71,82,95,61,101,69,102,84,59,70,85,78,79,75,96,91,74,89,62,90,64,97,93,77,60,73,55,65,100,92,56,63,68', '57:B:N,99:C:N,87:A:N,67:A:N,98:B:N,76:B:N,54:B:N,66:A:N,94:D:N,88:B:N,72:C:N,81:B:N,80:B:N,53:A:N,58:E:N,83:C:N,86:A:N,71:D:N,82:B:N,95:B:N,61:B:N,101:C:N,69:E:N,102:A:N,84:C:N,59:B:N,70:A:N,85:C:N,78:C:N,79:D:N,75:E:N,96:B:N,91:C:N,74:A:N,89:B:N,62:A:N,90:A:N,64:D:N,97:A:N,93:B:N,77:E:N,60:C:N,73:B:N,55:C:Y,65:D:N,100:B:N,92:A:N,56:E:N,63:A:N,68:A:N', 27, '54.00', '100.00', '2020-09-30 08:48:51', '2020-09-30 09:18:51', 'N'),
(204, 32, 312, '69,86,68,67,63,101,102,75,78,53,57,56,83,95,80,55,62,72,64,59,77,58,82,91,90,100,61,85,79,65,87,89,71,81,93,60,99,66,98,96,54,73,92,94,84,88,74,70,76,97', '69:C:N,86:B:N,68:B:N,67:B:N,63:B:N,101:C:N,102:A:N,75:C:N,78:C:N,53:E:N,57:C:N,56:B:N,83:C:N,95:C:N,80:B:N,55:A:N,62:E:N,72:C:N,64:A:N,59:B:N,77:D:N,58:E:N,82:B:N,91:A:N,90:A:N,100:B:N,61:B:N,85:B:N,79:D:N,65:E:N,87:C:N,89:B:N,71:D:N,81:C:N,93:D:N,60:B:N,99:A:N,66:B:N,98:B:N,96:B:N,54:D:N,73:B:N,92:A:N,94:D:N,84:C:N,88:B:N,74:A:N,70:A:N,76:D:N,97:D:N', 30, '60.00', '100.00', '2020-09-30 08:49:01', '2020-09-30 09:19:01', 'Y'),
(205, 32, 307, '67,78,87,63,93,97,74,100,89,80,58,73,75,79,88,96,68,90,60,95,102,81,56,69,83,57,92,82,77,59,55,70,76,72,71,99,64,62,101,98,65,54,91,84,66,85,53,94,86,61', '67:B:N,78:C:N,87:A:N,63:A:N,93:B:N,97:D:N,74:A:N,100:B:N,89:B:N,80:B:N,58:E:N,73:C:N,75:C:N,79:D:N,88:A:N,96:B:N,68:E:N,90:A:N,60:B:N,95:C:N,102:D:N,81::N,56::N,69::N,83::N,57::N,92::N,82::N,77::N,59::N,55::N,70::N,76::N,72::N,71::N,99::N,64::N,62::N,101::N,98::N,65::N,54::N,91::N,84::N,66::N,85::N,53::N,94::N,86::N,61::N', 17, '34.00', '100.00', '2020-09-30 08:49:08', '2020-09-30 09:19:08', 'Y'),
(206, 32, 262, '73,92,100,91,90,89,66,69,99,57,77,76,102,54,78,75,53,59,58,71,95,65,74,55,81,56,61,96,101,84,88,62,70,97,60,64,85,63,67,86,87,72,83,98,82,94,80,68,79,93', '73:D:N,92::N,100:B:N,91:A:N,90::N,89:B:N,66:B:N,69:A:N,99::N,57::N,77:E:N,76:E:N,102::N,54:A:N,78:D:N,75:E:N,53:E:N,59::N,58::N,71:B:N,95:B:N,65:D:N,74:A:N,55::N,81:D:N,56::N,61:A:N,96:B:N,101::N,84:C:N,88:A:N,62:D:N,70:E:N,97:D:N,60:C:N,64:D:N,85:C:N,63:B:N,67:D:N,86:B:N,87::N,72:B:N,83:C:N,98:C:N,82:C:N,94:D:N,80:B:N,68:D:N,79:C:N,93:D:N', 19, '38.00', '100.00', '2020-09-30 08:49:11', '2020-09-30 09:19:11', 'Y'),
(207, 32, 299, '92,60,55,88,72,59,66,70,94,54,101,78,67,83,75,71,82,56,63,74,64,99,97,96,86,81,62,76,73,77,84,69,89,95,102,79,61,80,98,91,53,57,85,93,65,68,87,100,58,90', '92:A:N,60:B:N,55:E:N,88:A:N,72:C:N,59:B:N,66::Y,70:C:N,94:D:N,54:E:N,101:C:N,78:B:N,67:B:N,83:A:N,75:E:N,71:D:N,82:B:N,56:E:N,63:B:N,74:A:N,64:A:N,99:C:N,97:D:N,96:B:N,86:A:N,81:D:N,62:B:N,76:D:N,73:A:N,77:A:N,84::Y,69::N,89::N,95::N,102::N,79::N,61::N,80::N,98::N,91::N,53::N,57::N,85::N,93::N,65::N,68::N,87::N,100::N,58::N,90::N', 13, '26.00', '100.00', '2020-09-30 08:49:12', '2020-09-30 09:19:12', 'Y'),
(208, 32, 259, '73,67,82,55,92,62,66,84,88,102,64,85,96,54,72,56,98,59,101,58,61,60,90,68,65,71,76,95,89,93,97,100,75,57,81,87,53,83,70,94,80,63,86,69,74,77,99,78,79,91', '73:D:N,67:B:N,82:B:N,55:C:N,92:A:N,62:A:N,66:C:N,84:C:N,88:A:N,102:D:N,64:A:N,85:C:N,96:B:N,54:B:N,72:C:N,56:E:N,98:C:N,59:D:N,101:C:N,58:E:N,61:B:N,60:B:N,90:A:N,68:D:N,65:E:N,71:D:N,76:C:N,95:B:N,89:D:N,93:D:N,97:D:N,100:B:N,75:C:N,57:C:N,81:A:N,87:A:N,53:E:N,83:A:N,70:C:N,94:D:N,80:B:N,63:A:N,86:A:N,69:B:N,74:D:N,77:E:N,99:C:N,78:D:Y,79:D:Y,91:A:N', 32, '64.00', '100.00', '2020-09-30 08:49:16', '2020-09-30 09:19:16', 'Y'),
(209, 32, 271, '60,74,81,84,87,97,54,67,58,93,69,70,68,101,64,62,88,98,66,73,102,59,94,76,83,79,82,53,89,78,63,61,86,65,91,72,71,96,57,100,85,99,77,55,95,56,92,90,75,80', '60:C:N,74:A:N,81:A:N,84:C:N,87:A:N,97:D:N,54:D:N,67:A:N,58:E:N,93:B:N,69:D:N,70:D:N,68:C:N,101:C:N,64:B:N,62:B:N,88:A:N,98:C:N,66:C:N,73:C:N,102:D:N,59:C:N,94:D:N,76:B:N,83:A:N,79:D:N,82:B:N,53:E:N,89:D:N,78:D:N,63:B:N,61:A:N,86:A:N,65:D:N,91:B:N,72:C:N,71:D:N,96:B:N,57:C:N,100:B:N,85:C:N,99:C:N,77:E:N,55:D:N,95:B:N,56:E:N,92:A:N,90:A:N,75:C:N,80:B:N', 33, '66.00', '100.00', '2020-09-30 08:49:19', '2020-09-30 09:19:19', 'N'),
(210, 32, 295, '71,64,76,77,57,84,70,91,83,95,78,102,63,69,60,68,62,100,56,74,96,67,97,88,61,89,75,58,79,87,82,66,93,54,101,86,53,73,65,94,72,81,55,98,80,90,59,99,92,85', '71:E:N,64:D:N,76:B:N,77:E:N,57:C:N,84:C:N,70:B:N,91:A:N,83:A:N,95:B:N,78:D:N,102:D:N,63:D:N,69:B:N,60:D:N,68:C:N,62:B:N,100:B:N,56:E:N,74:A:N,96:B:N,67:B:Y,97:B:N,88:D:N,61:B:N,89:B:N,75:C:N,58:E:N,79:D:N,87:C:N,82:B:N,66:C:N,93:D:N,54:D:N,101:C:Y,86:C:N,53:E:N,73:C:N,65:D:Y,94:D:N,72:C:N,81:A:N,55:B:N,98:B:Y,80:B:N,90:A:N,59:C:N,99:D:N,92:A:N,85:A:N', 27, '54.00', '100.00', '2020-09-30 08:49:38', '2020-09-30 09:19:38', 'N'),
(211, 32, 309, '60,65,77,73,63,69,81,66,68,92,99,70,96,101,57,59,98,56,75,74,102,90,61,93,87,72,97,54,80,58,94,53,89,78,91,82,67,71,76,62,86,84,64,55,83,95,88,85,79,100', '60:B:N,65::Y,77:A:N,73:A:N,63:C:N,69:A:N,81:B:N,66:E:N,68:E:N,92::N,99:C:N,70:A:N,96:B:N,101:C:N,57:C:N,59::N,98:C:N,56:E:N,75:A:N,74::N,102:D:N,90::N,61:A:N,93:A:N,87:A:N,72:B:N,97:D:N,54:A:N,80:A:N,58:A:N,94::N,53:E:N,89:B:N,78:D:N,91:A:N,82:B:N,67:A:N,71:B:N,76:B:N,62:C:N,86:A:N,84:C:N,64:B:N,55::N,83::N,95::N,88::N,85::N,79::N,100::N', 15, '30.00', '100.00', '2020-09-30 08:49:51', '2020-09-30 09:19:51', 'Y'),
(212, 32, 300, '65,61,83,100,79,71,53,55,102,90,77,59,63,93,99,95,97,85,73,88,96,91,81,89,82,70,62,92,86,80,64,66,94,56,76,101,58,54,67,75,57,69,68,87,84,72,60,78,74,98', '65:E:N,61:B:N,83:C:N,100:B:N,79::N,71::N,53:E:N,55::N,102:D:N,90::N,77:E:N,59:B:N,63::N,93::N,99:C:N,95::N,97:B:N,85:C:N,73::N,88::N,96:B:N,91::N,81::N,89:B:N,82::N,70:A:N,62:A:N,92:A:N,86:A:N,80:B:N,64::N,66::N,94:D:N,56:B:N,76::N,101::N,58:E:N,54:D:N,67:B:N,75::N,57::N,69::N,68::N,87:A:N,84:C:N,72::N,60::N,78::N,74:A:N,98:C:N', 24, '48.00', '100.00', '2020-09-30 08:49:52', '2020-09-30 09:19:52', 'N'),
(213, 32, 313, '89,62,56,53,55,76,70,57,87,101,59,63,80,81,79,97,58,100,92,75,71,90,69,77,82,99,54,72,66,68,83,64,98,78,65,61,73,84,95,102,85,60,88,67,91,96,74,86,94,93', '89:B:N,62:C:Y,56:B:N,53:E:N,55:D:N,76:A:N,70:D:N,57:C:N,87:A:N,101:C:N,59:D:N,63:B:N,80:B:N,81:B:N,79:C:N,97:D:N,58:D:N,100:B:N,92:A:N,75:C:N,71:B:N,90:A:N,69:B:N,77:A:N,82:B:N,99:C:N,54:B:N,72:A:N,66:C:N,68:D:N,83:C:N,64:C:N,98:C:N,78:D:N,65:D:N,61:D:N,73:D:N,84:C:N,95:B:N,102:D:N,85:C:N,60:D:N,88:A:N,67:B:N,91:A:N,96:B:N,74:A:N,86:B:N,94:D:N,93:E:N', 28, '56.00', '100.00', '2020-09-30 08:49:56', '2020-09-30 09:19:56', 'N'),
(214, 32, 302, '74,101,87,69,64,70,86,53,83,67,57,100,97,84,72,76,93,90,94,59,96,58,92,61,55,75,102,56,71,73,81,85,82,54,63,79,60,80,68,66,65,88,91,95,78,98,77,89,62,99', '74:A:N,101:C:N,87:A:N,69:C:N,64:B:N,70:B:N,86:A:N,53:E:N,83:C:N,67:B:N,57:A:N,100:B:N,97:A:N,84:A:N,72:C:N,76:A:N,93:B:N,90:A:N,94:D:N,59:C:N,96:D:N,58:A:N,92:A:N,61:D:N,55:D:N,75:D:N,102:D:N,56:E:N,71:D:N,73:B:N,81:B:N,85:C:N,82:B:N,54:B:N,63:A:N,79:D:N,60:B:N,80:A:N,68:B:N,66:C:N,65:E:N,88:B:N,91:A:N,95:D:N,78:B:N,98:C:N,77:C:N,89:A:N,62:D:N,99:C:N', 22, '44.00', '100.00', '2020-09-30 08:50:03', '2020-09-30 09:20:03', 'Y'),
(215, 32, 263, '69,89,100,55,98,64,65,78,77,87,93,76,79,68,56,92,90,73,63,66,71,102,82,53,58,81,83,96,60,86,101,75,84,62,57,61,72,85,74,97,99,95,80,70,94,91,59,88,67,54', '69:C:N,89:B:N,100:B:N,55:A:N,98:C:N,64:B:Y,65:D:N,78:D:N,77:E:N,87:A:N,93:D:N,76:E:N,79:D:N,68:D:N,56:C:N,92:A:N,90:A:N,73:A:N,63:A:N,66:A:N,71:D:N,102:D:N,82:B:N,53:E:N,58:D:N,81:D:N,83::N,96::N,60::N,86::N,101::N,75::N,84::N,62::N,57::N,61::N,72::N,85::N,74::N,97::N,99::N,95::N,80::N,70::N,94::N,91::N,59::N,88::N,67::N,54::N', 15, '30.00', '100.00', '2020-09-30 08:50:53', '2020-09-30 09:20:53', 'N'),
(216, 32, 296, '101,58,69,95,68,73,70,83,87,78,74,85,88,102,71,61,97,54,80,72,91,84,94,86,81,55,66,60,92,96,63,89,57,77,82,53,67,64,98,65,79,99,76,100,93,56,75,90,59,62', '101:C:N,58:E:N,69:E:N,95:B:Y,68:B:N,73:C:N,70:A:N,83:A:N,87:A:N,78:D:N,74:A:N,85:C:N,88:B:Y,102:D:N,71:D:Y,61:B:N,97:D:Y,54:A:N,80:B:N,72:C:N,91:C:N,84:C:N,94:D:N,86:A:N,81:A:N,55:E:N,66::N,60::N,92:A:N,96:B:N,63::N,89:D:N,57:C:N,77:E:N,82:B:N,53:E:N,67:B:N,64:B:N,98:C:N,65:D:Y,79::N,99:C:Y,76:B:N,100:B:N,93:D:N,56:C:N,75:C:N,90:A:N,59:C:N,62:D:N', 30, '60.00', '100.00', '2020-09-30 08:52:02', '2020-09-30 09:22:02', 'N'),
(217, 32, 314, '65,97,73,74,85,60,91,63,67,75,90,87,94,58,54,57,83,96,98,56,59,99,72,102,93,68,66,61,78,86,88,80,79,71,69,76,95,82,53,55,64,81,101,62,70,77,89,92,84,100', '65:E:N,97:D:N,73:C:N,74:A:N,85:C:N,60:C:N,91:A:N,63:A:N,67:A:N,75:C:N,90:A:N,87:A:N,94:D:N,58:E:N,54:D:N,57:C:N,83:A:N,96:B:N,98:C:N,56:B:N,59:B:N,99:D:N,72:C:N,102:A:N,93:D:N,68:E:N,66:C:N,61:B:N,78:D:N,86:C:N,88:A:N,80:B:N,79:D:N,71:D:N,69:E:N,76:C:N,95::N,82:B:N,53:E:N,55:A:N,64::N,81::N,101::N,62::N,70::N,77::N,89::N,92::N,84::N,100::N', 30, '60.00', '100.00', '2020-09-30 08:52:09', '2020-09-30 09:22:09', 'Y'),
(219, 32, 261, '68,92,66,60,73,64,72,61,71,89,67,88,81,83,90,98,76,101,69,95,55,62,85,97,77,100,75,65,54,59,94,96,93,57,91,82,58,80,84,70,63,99,86,79,78,102,74,87,53,56', '68::Y,92:B:N,66:B:N,60:B:N,73::N,64:B:N,72::N,61:D:N,71::N,89:B:N,67:B:N,88:A:N,81::N,83:A:N,90:A:N,98:C:N,76::N,101:C:N,69::N,95:B:N,55:A:N,62:C:N,85:C:N,97:D:N,77::N,100:A:N,75::N,65:B:N,54:B:N,59:B:N,94:C:N,96:B:N,93:D:N,57:B:N,91:A:N,82::N,58:B:N,80::N,84::N,70::N,63::N,99::N,86::N,79::N,78::N,102::N,74::N,87::N,53::N,56::N', 12, '24.00', '100.00', '2020-09-30 08:53:37', '2020-09-30 09:23:37', 'Y'),
(221, 32, 268, '76,96,80,90,94,61,65,82,77,95,59,97,72,75,67,57,88,53,98,54,84,70,89,93,100,101,58,86,79,69,71,85,64,81,92,62,68,56,87,83,55,78,74,102,99,63,73,66,91,60', '76::N,96:B:N,80::N,90:A:N,94:D:N,61:A:N,65:D:N,82::N,77:E:N,95::N,59:B:N,97:D:N,72:C:N,75:C:N,67:A:N,57:B:N,88::N,53:B:N,98:B:N,54:B:N,84:C:N,70:D:N,89:B:N,93:D:N,100:B:N,101::N,58:C:N,86:B:N,79::N,69:E:N,71:A:N,85:C:N,64:A:N,81::N,92:A:N,62:B:N,68:D:N,56::N,87:A:N,83:A:N,55:A:N,78::N,74:B:N,102:D:N,99:C:N,63:A:N,73:A:N,66:A:N,91:B:N,60:C:N', 21, '42.00', '100.00', '2020-09-30 08:53:50', '2020-09-30 09:23:50', 'N'),
(223, 32, 280, '100,80,68,55,94,72,58,76,83,77,75,53,63,101,102,87,82,78,79,67,73,89,70,92,56,57,60,99,84,90,64,96,98,71,66,65,85,62,95,88,81,61,91,74,54,86,69,97,93,59', '100:B:N,80:B:N,68::N,55:A:N,94::N,72:C:N,58:E:N,76:B:N,83:A:N,77:E:N,75:C:N,53:E:N,63::N,101:C:N,102:D:N,87:A:N,82:C:N,78::N,79:C:N,67:B:N,73:C:N,89:B:N,70:C:N,92:E:N,56::N,57::N,60::N,99:C:N,84:C:N,90:A:N,64::N,96:B:N,98:C:N,71::N,66::N,65::N,85:B:N,62::N,95::N,88:E:N,81:D:N,61:B:N,91::N,74:A:N,54::N,86:A:N,69:C:N,97:D:N,93:A:N,59:B:N', 24, '48.00', '100.00', '2020-09-30 08:54:44', '2020-09-30 09:24:44', 'Y'),
(224, 32, 267, '100,65,94,70,73,98,59,84,79,57,56,64,86,69,97,66,58,88,76,71,75,68,62,93,85,81,95,91,77,53,87,80,55,60,99,90,54,67,63,83,78,96,92,72,82,61,74,89,102,101', '100:B:N,65:E:N,94:D:N,70:A:N,73:C:N,98:C:N,59:C:N,84:C:N,79:C:N,57:C:N,56:E:N,64:A:N,86:B:N,69:E:N,97:D:N,66:C:N,58::N,88:A:N,76:B:N,71:D:N,75:C:N,68:B:N,62:A:N,93:D:N,85:B:N,81:A:N,95:B:N,91:A:N,77:E:N,53::N,87:A:N,80:C:N,55::N,60::N,99:B:N,90:A:N,54::N,67::N,63::N,83:A:N,78:D:N,96:B:N,92:A:N,72:C:N,82:B:N,61:A:N,74:A:N,89:B:N,102:D:N,101:C:N', 28, '56.00', '100.00', '2020-09-30 08:55:38', '2020-09-30 09:25:38', 'N'),
(231, 32, 292, '80,56,84,86,57,60,90,88,85,78,67,62,77,68,96,83,55,53,66,94,93,79,92,73,71,75,63,97,101,59,74,58,72,99,95,87,100,102,76,69,65,82,54,98,64,61,89,70,81,91', '80:B:N,56:B:N,84:C:N,86:A:N,57:C:N,60:C:N,90:A:N,88::Y,85:C:N,78::Y,67::Y,62::N,77:E:N,68:B:N,96:B:N,83:A:N,55::Y,53::Y,66::Y,94:D:N,93:D:N,79:A:N,92:A:N,73:C:N,71:D:N,75:C:N,63:A:N,97:D:N,101:C:N,59:B:N,74:A:N,58:E:N,72:C:N,99:C:N,95:B:N,87:A:N,100:B:N,102:D:N,76:C:N,69:B:N,65:B:Y,82::N,54::N,98::N,64::N,61::N,89::N,70::N,81::N,91::N', 28, '56.00', '100.00', '2020-09-30 09:00:40', '2020-09-30 09:30:40', 'Y'),
(234, 32, 275, '90,101,62,58,72,79,74,76,88,94,84,67,96,71,91,102,57,69,80,65,99,77,73,98,70,63,66,89,75,87,64,82,95,97,78,54,60,81,92,83,55,61,68,86,100,93,85,59,53,56', '90:A:N,101:C:N,62:B:N,58:B:N,72:C:N,79:C:N,74:A:N,76:B:N,88:A:N,94:D:N,84:C:N,67:A:N,96:B:N,71:D:N,91:A:N,102:D:N,57:C:N,69:B:N,80:B:N,65:D:N,99:C:N,77:D:N,73:A:N,98:C:N,70:D:N,63:D:N,66:B:N,89:B:N,75:C:N,87:A:N,64:D:N,82:C:N,95:B:N,97:C:N,78:D:N,54:B:N,60:D:N,81:C:N,92:A:N,83:C:N,55:D:N,61:D:N,68:A:N,86:C:N,100:B:N,93:B:N,85:B:N,59:D:N,53:E:N,56:E:N', 25, '50.00', '100.00', '2020-09-30 09:02:34', '2020-09-30 09:32:34', 'Y'),
(237, 32, 270, '94,62,78,85,60,93,81,79,101,102,83,55,96,67,56,59,77,91,92,61,58,90,75,99,98,68,82,84,76,86,65,71,66,69,54,97,53,57,70,87,80,73,63,64,88,95,72,100,74,89', '94:D:N,62:A:N,78:C:N,85:B:N,60:D:N,93:B:N,81:D:N,79::N,101:C:N,102::N,83:A:N,55:A:N,96:C:N,67:C:N,56:E:N,59:E:N,77:E:N,91:A:N,92:A:N,61:A:N,58::N,90:A:N,75:E:N,99:B:N,98:C:N,68:D:N,82:B:N,84:C:N,76:C:N,86:B:N,65:D:N,71:A:N,66:A:N,69:A:N,54:A:N,97:B:N,53:E:N,57:A:N,70:A:N,87:D:N,80:B:N,73:E:N,63::N,64:E:N,88:A:N,95::N,72::N,100::N,74::N,89::N', 16, '32.00', '100.00', '2020-09-30 09:08:06', '2020-09-30 09:38:06', 'N'),
(238, 32, 308, '76,61,58,94,87,83,91,77,60,88,100,85,96,64,63,98,66,102,86,68,69,97,92,99,62,56,57,71,73,82,72,81,59,65,95,84,90,54,101,80,78,89,93,79,74,67,75,55,70,53', '76:B:N,61:A:N,58:C:N,94:D:N,87:A:N,83:C:N,91:A:N,77:E:N,60:C:N,88:C:N,100:B:N,85:C:N,96:B:N,64:A:N,63:A:N,98:B:N,66:D:Y,102:D:N,86:C:N,68:C:N,69:E:N,97:B:N,92:B:N,99:B:N,62:D:N,56:E:Y,57:D:N,71:B:N,73:C:N,82:B:N,72:C:N,81:B:N,59:B:N,65:E:N,95:B:N,84:C:N,90:A:N,54:A:N,101:C:N,80:B:N,78:B:Y,89:D:N,93:B:N,79:D:N,74:A:N,67:E:Y,75:E:N,55:C:Y,70:A:N,53:C:Y', 23, '46.00', '100.00', '2020-09-30 09:09:14', '2020-09-30 09:39:14', 'Y'),
(240, 32, 272, '67,81,69,54,83,89,99,65,76,82,72,53,87,101,100,97,85,80,61,88,77,98,96,90,60,73,66,58,78,55,62,79,59,92,74,102,86,56,57,84,94,91,64,75,70,68,63,95,93,71', '67:C:N,81:A:N,69:A:N,54:A:N,83:C:N,89:B:N,99:C:N,65:D:N,76:E:N,82:D:N,72:E:N,53:E:N,87:A:N,101:C:N,100:B:N,97:D:N,85:C:N,80:C:N,61:A:N,88:A:N,77:C:N,98:C:N,96:B:N,90:A:N,60:A:N,73:D:N,66:C:N,58:B:N,78:D:N,55:D:N,62:D:N,79:D:N,59:C:N,92:A:N,74:A:N,102:D:N,86:A:N,56:B:N,57:C:N,84:C:N,94:D:N,91:A:N,64:D:N,75:C:N,70:A:N,68:C:N,63:D:N,95:B:N,93:D:N,71:B:N', 27, '54.00', '100.00', '2020-09-30 09:13:54', '2020-09-30 09:43:54', 'Y'),
(243, 32, 284, '59,96,101,62,53,70,67,56,98,81,61,74,55,92,69,78,60,87,94,99,102,54,68,65,85,73,76,66,97,83,77,72,95,93,58,90,80,79,88,64,89,71,82,75,63,91,86,84,100,57', '59:B:N,96:B:N,101:D:N,62:B:N,53:B:N,70:D:N,67:D:N,56:C:N,98:C:N,81:A:N,61:D:N,74:C:N,55:B:N,92:A:N,69:D:N,78:B:N,60:D:N,87:A:N,94:B:N,99:D:N,102:D:N,54:A:N,68:A:N,65:B:N,85:C:N,73:C:N,76::N,66:A:N,97:A:N,83:A:N,77:D:N,72:B:N,95:B:N,93:D:N,58:B:N,90:A:N,80:A:N,79:B:N,88:C:N,64:E:N,89:B:N,71:B:N,82:A:N,75:C:N,63:C:N,91:A:N,86:A:N,84:C:N,100:B:N,57:A:N', 15, '30.00', '100.00', '2020-09-30 09:22:24', '2020-09-30 09:52:24', 'N'),
(248, 32, 283, '67,75,100,65,84,56,95,80,74,62,94,101,87,93,70,89,99,97,61,55,81,79,57,77,91,90,53,64,82,83,73,54,68,58,76,92,86,63,85,69,60,66,98,72,102,78,96,59,71,88', '67:B:N,75:A:N,100:B:N,65:A:N,84:C:N,56:A:N,95:C:N,80:B:N,74:A:N,62:A:N,94:B:N,101:C:N,87:A:N,93:B:N,70:A:N,89:D:N,99:C:N,97:B:N,61:A:N,55:C:N,81:A:N,79:A:N,57:D:N,77:A:N,91:A:N,90:A:N,53:A:N,64:A:N,82:A:N,83:C:N,73:C:N,54:A:N,68:A:N,58:D:N,76:A:N,92:A:N,86:B:N,63:A:N,85:C:N,69:B:N,60:B:N,66:C:N,98:C:N,72:A:N,102:A:N,78:A:N,96:B:N,59:B:N,71:A:N,88:A:N', 24, '48.00', '100.00', '2020-09-30 10:35:44', '2020-09-30 11:05:44', 'Y'),
(249, 32, 260, '68,58,84,97,89,81,54,70,83,95,102,60,64,56,72,101,94,92,98,100,91,59,63,79,93,53,80,71,57,76,69,86,61,62,74,75,65,85,77,88,67,82,55,73,96,90,99,87,78,66', '68:D:N,58:A:N,84:C:N,97:D:N,89:B:N,81:B:N,54:A:N,70:B:N,83:C:N,95:D:N,102:D:N,60:B:N,64:A:N,56:C:N,72:C:N,101:C:N,94:D:N,92:A:N,98:C:N,100:B:N,91:A:N,59:A:N,63:D:N,79:A:N,93:B:N,53:D:N,80:A:N,71:D:N,57:A:N,76:C:N,69:B:N,86:A:N,61:A:N,62:D:N,74:A:N,75:E:N,65:B:N,85:B:N,77:C:N,88:A:N,67:D:N,82:A:N,55:C:N,73:A:N,96:B:N,90:A:N,99:C:N,87:A:N,78:B:N,66:D:N', 21, '42.00', '100.00', '2020-09-30 12:25:23', '2020-09-30 12:55:23', 'Y'),
(251, 32, 315, '66,70,62,68,77,76,74,87,102,78,97,94,55,90,67,95,98,72,71,100,65,91,56,81,73,79,88,75,85,61,82,96,93,63,101,99,69,83,86,80,53,64,60,54,92,89,84,59,58,57', '66:E:N,70:D:N,62:A:N,68:A:N,77:E:N,76:E:N,74:A:N,87:C:N,102:A:N,78:E:N,97:D:N,94:D:N,55:C:N,90:A:N,67:B:N,95:B:N,98:C:N,72:C:N,71:D:N,100:B:N,65:C:N,91:A:N,56:C:N,81:C:N,73:E:N,79:D:N,88:E:N,75:B:N,85:C:N,61:B:N,82:C:N,96:C:N,93:D:N,63:B:N,101:C:N,99:C:N,69:B:N,83:A:N,86:B:N,80:A:N,53:B:N,64:D:N,60:B:N,54:B:N,92:E:N,89:C:N,84:C:N,59:C:N,58:B:N,57:A:N', 18, '36.00', '100.00', '2020-09-30 19:05:43', '2020-09-30 19:35:43', 'N'),
(252, 32, 291, '79,68,82,73,92,80,63,95,72,94,87,96,91,71,69,54,55,84,90,53,61,65,89,77,86,97,81,59,56,75,88,62,66,99,85,78,64,100,102,101,76,98,58,57,93,83,60,74,70,67', '79:A:N,68:E:N,82:B:N,73:C:N,92:E:N,80:B:N,63:A:N,95:D:N,72:C:N,94:D:N,87:E:Y,96:B:N,91:A:N,71:D:N,69:E:N,54::N,55::N,84:C:N,90:A:N,53:E:N,61:B:N,65::N,89::N,77:E:N,86:C:N,97::N,81:A:N,59:B:N,56:B:N,75:C:Y,88:E:N,62::N,66::N,99:C:N,85:C:N,78:E:N,64::N,100:B:N,102:D:N,101::N,76:B:N,98::N,58:E:N,57::N,93:E:N,83:A:N,60:C:N,74:A:N,70:A:N,67:B:N', 28, '56.00', '100.00', '2020-10-03 11:26:13', '2020-10-03 11:56:13', 'Y'),
(253, 32, 317, '78,56,77,73,87,86,102,96,94,85,57,60,100,84,88,82,93,74,70,69,61,65,62,98,90,64,80,99,59,92,101,75,97,67,54,72,95,81,76,53,71,91,66,58,89,68,79,63,83,55', '78:D:N,56:C:N,77:E:N,73:C:N,87:C:N,86:C:N,102:A:N,96:B:N,94:B:N,85:C:N,57:A:N,60:B:N,100:B:N,84:C:N,88:B:N,82:A:N,93:D:N,74:A:N,70:D:N,69:E:N,61:D:N,65:D:N,62:D:N,98:A:N,90:A:N,64:B:N,80:B:N,99:A:N,59::N,92:A:N,101:B:N,75:E:N,97:D:N,67:A:N,54:B:N,72:C:N,95:D:N,81:A:N,76:A:N,53:A:N,71:B:N,91:A:N,66:C:N,58:C:N,89:D:N,68:D:N,79:D:N,63:A:N,83::N,55::N', 16, '32.00', '100.00', '2020-10-05 15:58:53', '2020-10-05 16:28:53', 'Y'),
(255, 32, 319, '88,100,76,91,98,59,63,65,66,80,82,85,77,83,86,101,58,90,70,62,57,54,94,92,67,74,73,89,64,56,61,81,87,97,96,84,68,69,99,75,53,93,55,95,79,60,71,78,72,102', '88:B:N,100:A:N,76:E:N,91:B:N,98:B:N,59:E:N,63:D:N,65:D:N,66:D:N,80:C:N,82:B:N,85:B:N,77:E:N,83:A:N,86:B:N,101:B:N,58:A:N,90:A:N,70:D:N,62:A:N,57:A:N,54:A:N,94:D:N,92:A:N,67:A:N,74:A:N,73:C:N,89:B:N,64:D:N,56:E:N,61:A:N,81:D:N,87:A:N,97:B:N,96:B:N,84:C:N,68:C:N,69:D:N,99:B:N,75:E:N,53:D:N,93:A:N,55:E:N,95:B:N,79:D:N,60:C:N,71:D:N,78:D:N,72:E:N,102:A:N', 18, '36.00', '100.00', '2020-10-05 21:23:29', '2020-10-05 21:53:29', 'N'),
(256, 32, 321, '63,53,71,74,88,69,78,61,98,64,73,92,99,90,72,55,96,89,56,77,87,84,91,79,101,76,58,68,83,60,59,70,62,54,57,65,93,75,97,80,82,100,86,95,81,102,67,85,94,66', '63:A:N,53:E:N,71:D:N,74:A:N,88:A:Y,69:C:N,78:D:N,61:B:N,98:C:N,64:E:Y,73:C:N,92:A:N,99:C:N,90:A:N,72:C:N,55:A:N,96:B:N,89:B:N,56:B:N,77:E:N,87:A:N,84:C:N,91:A:N,79:D:N,101:C:N,76:C:N,58:E:N,68:E:N,83:A:N,60:C:N,59:B:N,70:B:N,62:A:N,54:B:N,57:C:N,65:E:N,93:B:N,75:C:N,97:B:N,80:B:N,82:B:N,100:B:N,86:B:N,95:B:N,81:A:N,102:D:N,67:B:N,85:C:N,94:D:N,66:D:N', 41, '82.00', '100.00', '2020-10-05 21:39:18', '2020-10-05 22:09:18', 'Y'),
(257, 32, 318, '62,102,70,60,76,78,94,93,74,101,92,64,61,69,95,88,57,85,98,55,79,71,63,56,53,90,100,97,73,77,65,83,68,66,54,67,80,87,82,81,89,96,84,75,99,91,86,58,72,59', '62:B:N,102:D:N,70:A:N,60:A:N,76:E:N,78:C:N,94:D:N,93:D:N,74:A:N,101:C:N,92:A:N,64:B:N,61:D:N,69:B:N,95:B:N,88:A:N,57:A:N,85:C:N,98:C:N,55:C:N,79:C:N,71:D:N,63:C:N,56:C:Y,53::N,90:B:N,100:B:N,97:D:N,73::N,77::N,65::N,83:A:N,68:A:N,66::N,54::N,67::N,80::N,87:A:N,82::N,81::N,89:B:N,96:B:N,84:C:N,75:C:N,99::N,91::N,86::N,58::N,72::N,59::N', 18, '36.00', '100.00', '2020-10-05 21:45:19', '2020-10-05 22:15:19', 'Y'),
(259, 32, 320, '53,71,85,76,73,62,90,87,65,72,94,97,70,98,59,77,82,58,63,75,81,88,101,61,69,64,86,57,78,83,102,96,95,68,91,89,60,55,79,56,66,93,100,80,54,74,67,92,99,84', '53:E:N,71:B:N,85:C:N,76:A:Y,73:B:N,62:E:N,90:A:N,87:C:Y,65:E:N,72:D:N,94:D:N,97:D:N,70:C:N,98:C:N,59:B:N,77:C:N,82:A:N,58:E:N,63:E:N,75:E:Y,81:B:N,88:D:N,101:C:N,61:B:N,69:B:N,64:D:N,86:B:N,57:A:N,78:D:N,83:A:N,102:A:N,96::N,95::N,68::N,91::N,89::N,60::N,55::N,79::N,56::N,66::N,93::N,100::N,80::N,54::N,74::N,67::N,92::N,99::N,84::N', 15, '30.00', '100.00', '2020-10-06 11:13:54', '2020-10-06 11:43:54', 'N'),
(260, 32, 323, '100,75,65,64,57,83,66,99,60,59,95,71,91,98,58,87,80,69,79,68,56,70,78,61,96,94,101,89,67,81,85,86,62,55,73,88,53,97,90,63,84,102,74,76,93,72,92,82,54,77', '100:B:N,75:C:N,65:D:N,64:D:N,57:C:N,83:C:N,66:A:N,99:C:N,60:C:N,59:B:N,95:C:N,71:D:N,91:B:N,98:C:N,58:D:N,87:A:N,80:A:N,69:C:N,79:A:N,68:C:N,56:B:N,70:A:N,78:D:N,61:B:N,96:B:N,94:D:N,101:C:N,89:B:N,67:B:N,81::N,85::N,86::N,62::N,55::N,73::N,88::N,53::N,97::N,90::N,63::N,84::N,102::N,74::N,76::N,93::N,72::N,92::N,82::N,54::N,77::N', 23, '46.00', '100.00', '2020-10-08 07:27:27', '2020-10-08 07:57:27', 'Y'),
(261, 32, 322, '86,100,67,77,76,85,56,78,62,99,95,53,90,80,60,93,79,83,59,96,63,72,97,61,75,69,84,89,81,64,92,55,57,54,88,74,71,68,65,82,101,94,66,58,91,98,102,87,73,70', '86:B:N,100:A:N,67::N,77:E:N,76:E:N,85:C:N,56:C:N,78:D:N,62:A:N,99:C:N,95:D:N,53:E:N,90:A:N,80:A:N,60:C:N,93:D:N,79:B:N,83:C:N,59:B:N,96:B:N,63:E:N,72:D:N,97:D:N,61:B:N,75:C:N,69:D:N,84:C:N,89:B:N,81:A:N,64:A:Y,92:A:N,55:D:N,57:C:N,54:C:N,88:A:N,74:A:N,71:B:N,68::N,65:A:N,82:A:N,101:C:N,94:D:N,66:D:N,58:E:N,91::N,98::N,102::N,87::N,73::N,70::N', 24, '48.00', '100.00', '2020-10-08 10:40:45', '2020-10-08 11:10:45', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `karyawans`
--

CREATE TABLE `karyawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_karyawan` enum('TETAP','KONTRAK','KONTRAK FAKULTAS') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'KONTRAK',
  `jenis_kelamin` enum('L','p') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'L',
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_terakhir` enum('-','SD','SMP','SMA/SEDERAJAT','S1','S2','S3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '-',
  `asal_pendidikan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'profile.png',
  `program_studi_id` int(11) DEFAULT NULL,
  `departement_id` int(11) DEFAULT NULL,
  `status_akun` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `karyawans`
--

INSERT INTO `karyawans` (`id`, `code`, `nik`, `nama`, `email`, `status_karyawan`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `kode_pos`, `pendidikan_terakhir`, `asal_pendidikan`, `no_hp`, `photo`, `program_studi_id`, `departement_id`, `status_akun`, `created_at`, `updated_at`) VALUES
(5, 'PPS024', '3201302410960001', 'Muhamamd Anwa Asrul', 'asrulanwar16@gmail.com', 'KONTRAK FAKULTAS', '', 'Bogor', '1996-01-24', 'Jl. Cibereum Kalong Rt 07/05', NULL, '-', NULL, NULL, '20220412104313-167858841_4384478648233717_7020433269666150664_n.png', NULL, 1, 'N', '2022-04-12 03:43:13', NULL),
(6, 'PPS025', '321321', 'Nuzulhadi Zamaran, S.H', 'nuzulhadi@ppsuika.ac.id', 'TETAP', '', 'Bogor', '0000-00-00', '-', NULL, '-', NULL, NULL, '20220412104449-167858841_4384478648233717_7020433269666150664_n.png', NULL, 3, 'N', '2022-04-12 03:44:49', NULL),
(7, 'PPS026', '3222122', 'Hendri Walika, SE., MPd', 'walika@ppsuika.ac.id', 'TETAP', '', 'Bogor', '0000-00-00', '-', NULL, '-', NULL, NULL, '20220412104544-167858841_4384478648233717_7020433269666150664_n.png', NULL, 4, 'N', '2022-04-12 03:45:44', NULL),
(8, 'PPS027', '325251', 'Ahmad Mukhsinudin, SH', 'fadhey@ppsuika.ac.id', 'TETAP', '', '-', '0000-00-00', '-', NULL, '-', NULL, NULL, '20220412104644-167858841_4384478648233717_7020433269666150664_n.png', NULL, 5, 'N', '2022-04-12 03:46:44', NULL),
(9, 'PPS001', '232323', 'Prof. Dr. KH. Didin Hafidhuddin, M.S', 'didin@ppsuika.ac.id', 'TETAP', '', '-', '0000-00-00', '-', NULL, '-', NULL, NULL, '20220412104737-167858841_4384478648233717_7020433269666150664_n.png', NULL, 5, 'N', '2022-04-12 03:47:37', NULL),
(10, 'PPS002', '323235588', 'H. Hendri Tanjung, P.Hd', 'tanjung@ppsuika.ac.id', 'TETAP', '', '', '0000-00-00', '', NULL, '-', NULL, NULL, '20220412104824-167858841_4384478648233717_7020433269666150664_n.png', NULL, 5, 'N', '2022-04-12 03:48:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `kategori_komponen`
--

CREATE TABLE `kategori_komponen` (
  `id` int(11) NOT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y',
  `pejabat_id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_komponen`
--

INSERT INTO `kategori_komponen` (`id`, `kategori`, `aktif`, `pejabat_id`) VALUES
(5, 'Administrasi Keuangan Sidang Tesis', 'Y', NULL),
(9, 'Administrasi Seminar Proposal (S2)', 'Y', 8),
(11, 'Administrasi Keuangan Seminar Proposal (S2)', 'Y', 7),
(12, 'Administrasi Keuangan Seminar Proposal (S3)', 'Y', 7);

-- --------------------------------------------------------

--
-- Table structure for table `kelengkapan`
--

CREATE TABLE `kelengkapan` (
  `id` int(11) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `komponen_kategori` int(11) DEFAULT NULL,
  `penanggungjawab` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `komponen`
--

CREATE TABLE `komponen` (
  `id` int(11) NOT NULL,
  `id_kategori_komponen` int(11) DEFAULT NULL,
  `komponen` varchar(255) DEFAULT NULL,
  `jenis` enum('check','upload','input') NOT NULL DEFAULT 'check'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id`, `id_kategori_komponen`, `komponen`, `jenis`) VALUES
(28, 9, 'Mengupload Berkas Proposal seminar', 'upload'),
(29, 9, 'Lunas SPP SMT II & III', 'check'),
(31, 11, 'Telah Melunasi Biaya semeter II & III', 'check'),
(32, 12, 'TELAH MELUNASI KEUANGAN SEMETER II', 'check'),
(33, 11, 'Lulus semua mata kuliah (Perlihatkan Transkrip Nilai S2)', 'check');

-- --------------------------------------------------------

--
-- Table structure for table `master_angkatan`
--

CREATE TABLE `master_angkatan` (
  `id` int(11) NOT NULL,
  `keterangan` varchar(50) DEFAULT NULL,
  `aktif` enum('Y','N') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_angkatan`
--

INSERT INTO `master_angkatan` (`id`, `keterangan`, `aktif`) VALUES
(1, '2020-2021', 'Y'),
(2, '2022-2023', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `master_dosen`
--

CREATE TABLE `master_dosen` (
  `id` int(11) NOT NULL,
  `nik` varchar(11) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `no_ktp` varchar(128) NOT NULL,
  `gelar_kesarjanaan` varchar(128) DEFAULT NULL,
  `tempat_lahir` varchar(128) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_kawin` enum('menikah','belum menikah') DEFAULT NULL,
  `alamat_rumah` text,
  `email` varchar(128) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `id_master_prodi` int(128) DEFAULT NULL,
  `fungsional` varchar(50) DEFAULT NULL,
  `golongan` varchar(50) DEFAULT NULL,
  `foto` varchar(128) DEFAULT 'default.png',
  `status_dosen` enum('TETAP','LB') NOT NULL DEFAULT 'TETAP',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `master_dosen`
--

INSERT INTO `master_dosen` (`id`, `nik`, `nama_lengkap`, `jenis_kelamin`, `no_ktp`, `gelar_kesarjanaan`, `tempat_lahir`, `tanggal_lahir`, `status_kawin`, `alamat_rumah`, `email`, `no_hp`, `id_master_prodi`, `fungsional`, `golongan`, `foto`, `status_dosen`, `created_at`, `update_at`, `created_by`) VALUES
(1, '001', 'Muhamamd Asrul anwar', 'L', '3201302410960001', 'Dr.', 'Bogor', '1996-01-24', 'belum menikah', 'Kp. Cibereum Kalong Rt 07', 'asrul.maa99@gmail.com', '081381100046', 1, '1', '1', 'default.png', 'TETAP', '2022-03-23 06:41:16', '2022-03-23 06:42:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_mahasiswa`
--

CREATE TABLE `master_mahasiswa` (
  `id` int(11) NOT NULL,
  `npm` varchar(11) NOT NULL,
  `nama_lengkap` varchar(128) NOT NULL,
  `jenis_kelamin` enum('L','P') DEFAULT NULL,
  `no_ktp` varchar(128) NOT NULL,
  `gelar_kesarjanaan` varchar(128) DEFAULT NULL,
  `tempat_lahir` varchar(128) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `status_kawin` enum('menikah','belum menikah') DEFAULT NULL,
  `alamat_rumah` text,
  `email` varchar(128) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `nama_ayah` varchar(128) NOT NULL,
  `nama_ibu` varchar(128) NOT NULL,
  `id_master_prodi` int(128) NOT NULL,
  `id_angkatan` int(128) NOT NULL,
  `konsentrasi` varchar(128) NOT NULL,
  `foto` varchar(128) DEFAULT 'default.png',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_mahasiswa`
--

INSERT INTO `master_mahasiswa` (`id`, `npm`, `nama_lengkap`, `jenis_kelamin`, `no_ktp`, `gelar_kesarjanaan`, `tempat_lahir`, `tanggal_lahir`, `status_kawin`, `alamat_rumah`, `email`, `no_hp`, `nama_ayah`, `nama_ibu`, `id_master_prodi`, `id_angkatan`, `konsentrasi`, `foto`, `status`, `created_at`, `update_at`, `created_by`) VALUES
(100, '662651', 'Ahmad', NULL, '3201302410960001', 'ST', 'Bogor', '2022-04-14', 'belum menikah', 'Jl. Cibereum', 'ahmad@gmail.com', '081392110025', 'ahmadi', 'madi', 1, 2, '', 'Untitled-1.jpg', 1, '2022-02-23 07:39:12', '2022-04-16 03:18:53', NULL),
(101, '662652', 'Ali', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110026', '', '', 1, 2, '', 'default.png', 0, '2022-02-23 07:39:12', '2022-02-24 03:53:38', NULL),
(102, '662653', 'untung', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110027', '', '', 1, 2, '', 'default.png', 0, '2022-02-23 07:39:12', '2022-02-24 03:53:39', NULL),
(103, '662654', 'sugeng', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110028', '', '', 1, 2, '', 'default.png', 0, '2022-02-23 07:39:12', '2022-02-24 03:53:40', NULL),
(104, '662655', 'yahya', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110029', '', '', 1, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(105, '662656', 'ayas', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110030', '', '', 1, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(106, '662657', 'ilyas', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110031', '', '', 1, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(107, '662658', 'mahmud', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110032', '', '', 1, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(108, '662659', 'randi', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110033', '', '', 1, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(109, '662660', 'fery', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110034', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(110, '662661', 'rafa', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110035', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(111, '662662', 'iis', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110036', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(112, '662663', 'safira', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110037', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(113, '662664', 'sahara', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110038', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(114, '662665', 'sri', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110039', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(115, '662666', 'wanda', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110040', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(116, '662667', 'wawan', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110041', '', '', 3, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(117, '662668', 'burhan', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110042', '', '', 3, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(118, '662669', 'lana', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110043', '', '', 3, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(119, '662670', 'lini', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110044', '', '', 3, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(120, '662671', 'lunu', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110045', '', '', 3, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(121, '662672', 'lene', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110046', '', '', 4, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(122, '662673', 'lele', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110047', '', '', 4, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(123, '662674', 'ricky', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110048', '', '', 4, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(124, '662675', 'ricko', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110049', '', '', 4, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(125, '662676', 'roy', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110050', '', '', 4, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(126, '662677', 'rahmat', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110051', '', '', 1, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(127, '662678', 'rohmat', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110052', '', '', 1, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(128, '662679', 'raka', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110053', '', '', 3, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(129, '662680', 'rara', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110054', '', '', 3, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(130, '662681', 'riri', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110055', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(131, '662682', 'rustam', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110056', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL),
(132, '662683', 'rustim', NULL, '', NULL, NULL, NULL, NULL, NULL, '', '081392110057', '', '', 2, 1, '', 'default.png', 0, '2022-02-23 07:39:12', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `master_prodi`
--

CREATE TABLE `master_prodi` (
  `id` int(11) NOT NULL,
  `prodiID` varchar(4) NOT NULL,
  `program_studi` varchar(255) NOT NULL,
  `jenjang` varchar(3) DEFAULT 'S2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `master_prodi`
--

INSERT INTO `master_prodi` (`id`, `prodiID`, `program_studi`, `jenjang`) VALUES
(1, 'MPAI', 'Magister Pendidikan Agama Islam', 'S2'),
(2, 'MES', 'Magister Ekonomi Syari\'ah', 'S2'),
(3, 'MTP', 'Magister Teknologi Pendidikan', 'S2'),
(4, 'MM', 'Magister Manajemen', 'S2'),
(5, 'DPAI', 'Doktor Pendidikan Agama Islam', 'S3'),
(6, 'ADM', 'Administrator', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mdapp_pengajuan`
--

CREATE TABLE `mdapp_pengajuan` (
  `id` int(11) NOT NULL,
  `npm` varchar(50) DEFAULT NULL,
  `ujian` varchar(50) DEFAULT NULL,
  `tanggal_pengajuan` date DEFAULT NULL,
  `angkatan_id` int(11) DEFAULT NULL,
  `prodi_id` int(11) DEFAULT NULL,
  `thesis` text,
  `status` enum('Y','N') DEFAULT 'N',
  `pengajuan_ke` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdapp_pengajuan`
--

INSERT INTO `mdapp_pengajuan` (`id`, `npm`, `ujian`, `tanggal_pengajuan`, `angkatan_id`, `prodi_id`, `thesis`, `status`, `pengajuan_ke`) VALUES
(6, '662651', 'kompre', NULL, 2, 1, 'tracer', 'N', NULL),
(7, '662660', 'kompre', NULL, 1, 2, 'Fery sidang ', 'N', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mdapp_pengajuan_kelengkapan`
--

CREATE TABLE `mdapp_pengajuan_kelengkapan` (
  `id_pengajuan` int(11) DEFAULT NULL,
  `id_kategori_komponen` int(11) DEFAULT NULL,
  `status` enum('Diperiksa','Menunggu','Diulang') DEFAULT 'Menunggu',
  `file` text,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mdapp_penguji_ujian`
--

CREATE TABLE `mdapp_penguji_ujian` (
  `id_ujian` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mdapp_penilaian`
--

CREATE TABLE `mdapp_penilaian` (
  `npm` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `id_ujian` int(11) DEFAULT NULL,
  `id_komponen` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `catatan` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mdapp_ujian`
--

CREATE TABLE `mdapp_ujian` (
  `id` int(11) NOT NULL,
  `npm` varchar(50) DEFAULT NULL,
  `judul_thesis` text,
  `tgl_ujian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mdsetup_komponen`
--

CREATE TABLE `mdsetup_komponen` (
  `id_kategori_komponen` int(11) DEFAULT NULL,
  `id_komponen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mdtemplate_form`
--

CREATE TABLE `mdtemplate_form` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `nama_template` varchar(255) DEFAULT NULL,
  `pejabat_id` varchar(255) DEFAULT NULL,
  `aktif` enum('Y','N') NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdtemplate_form`
--

INSERT INTO `mdtemplate_form` (`id`, `title`, `nama_template`, `pejabat_id`, `aktif`) VALUES
(14, 'Form Pendaftaran Seminar Proposal', 'proposal', '6', 'Y'),
(15, NULL, 'SIDANG DISERTASI', '6', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `mdtemplate_komponen`
--

CREATE TABLE `mdtemplate_komponen` (
  `id_template` int(11) DEFAULT NULL,
  `id_kategori_komponen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdtemplate_komponen`
--

INSERT INTO `mdtemplate_komponen` (`id_template`, `id_kategori_komponen`) VALUES
(14, 11),
(14, 9),
(15, 12);

-- --------------------------------------------------------

--
-- Table structure for table `mhs_daftar`
--

CREATE TABLE `mhs_daftar` (
  `id` int(11) NOT NULL,
  `kode` varchar(50) DEFAULT NULL,
  `npm` varchar(50) DEFAULT NULL,
  `ujian_id` int(11) DEFAULT NULL,
  `form_id` int(11) DEFAULT NULL,
  `tanggal_daftar` date DEFAULT NULL,
  `tanggal_ujian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pejabats`
--

CREATE TABLE `pejabats` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `karyawan_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pengajar_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `departement_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ttd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pejabats`
--

INSERT INTO `pejabats` (`id`, `karyawan_id`, `pengajar_id`, `departement_id`, `jabatan`, `ttd`, `status`, `created_at`, `updated_at`) VALUES
(6, '6', '', '3', 'KEPALA TATA USAHA', '20220412105220-ig.png', 'Y', '2022-04-12 03:52:20', NULL),
(7, '7', '', '4', 'KASUBAG KEUANGAN', '20220412105235-167858841_4384478648233717_7020433269666150664_n.png', 'Y', '2022-04-12 03:52:35', NULL),
(8, '8', '', '5', 'KASUBAG AKADEMIK', '20220412105250-167858841_4384478648233717_7020433269666150664_n.png', 'Y', '2022-04-12 03:52:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengajars`
--

CREATE TABLE `pengajars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_pengajar` enum('DOSEN TETAP','DOSEN TIDAK TETAP') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'DOSEN TETAP',
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'L',
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jabatan_fungsional` enum('-','ASISTEN AHLI','LEKTOR','LEKTOR KEPALA','GURU BESAR') COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pangkat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `golongan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_akun` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `program_studis`
--

CREATE TABLE `program_studis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` text COLLATE utf8mb4_unicode_ci,
  `jenjang` enum('S2','S3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S2',
  `kaprodi` int(11) DEFAULT NULL,
  `sekprodi` int(11) DEFAULT NULL,
  `ttd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `program_studis`
--

INSERT INTO `program_studis` (`id`, `code`, `nama`, `jenjang`, `kaprodi`, `sekprodi`, `ttd`, `created_at`, `updated_at`) VALUES
(1, '001', 'TEKNOLOGI PENDIDIKAN', 'S2', 1, 1, NULL, '2022-03-25 03:26:04', NULL),
(2, '002', 'Manajemen', 'S2', 1, 1, NULL, '2022-03-25 03:26:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `soal_to_gorupsoal`
--

CREATE TABLE `soal_to_gorupsoal` (
  `id` int(11) NOT NULL,
  `id_bank_soal` int(11) NOT NULL,
  `id_group_soal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `soal_to_gorupsoal`
--

INSERT INTO `soal_to_gorupsoal` (`id`, `id_bank_soal`, `id_group_soal`) VALUES
(1, 53, 1),
(2, 54, 1),
(3, 55, 1),
(4, 56, 1),
(5, 57, 1),
(6, 58, 1),
(7, 59, 1),
(8, 60, 1),
(9, 61, 1),
(10, 62, 1),
(11, 63, 1),
(12, 64, 1),
(13, 65, 1),
(14, 66, 1),
(15, 67, 1),
(16, 68, 1),
(17, 69, 1),
(18, 70, 1),
(19, 71, 1),
(20, 72, 1),
(21, 73, 1),
(22, 74, 1),
(23, 75, 1),
(24, 76, 1),
(25, 77, 1),
(26, 78, 1),
(27, 79, 1),
(28, 80, 1),
(29, 81, 1),
(30, 82, 1),
(31, 83, 1),
(32, 84, 1),
(33, 85, 1),
(34, 86, 1),
(35, 87, 1),
(36, 88, 1),
(37, 89, 1),
(38, 90, 1),
(39, 91, 1),
(40, 92, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `program_studi_id` int(11) DEFAULT NULL,
  `kelas_id` int(11) NOT NULL DEFAULT '0',
  `subkelas_id` int(11) NOT NULL DEFAULT '0',
  `total_semester` int(11) NOT NULL DEFAULT '4',
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(75) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_mahasiswa` enum('ACTIVE','PERMIT','INACTIVE','QUIT','MOVED','GRADUATED','DROPPED-OUT') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `status_penerimaan` enum('MAHASISWA BARU','PINDAHAN') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MAHASISWA BARU',
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'L',
  `tempat_lahir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kode_pos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pendidikan_terakhir` enum('S1','S2','S3') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'S1',
  `asal_universitas_s1` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_universitas_s2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `asal_universitas_s3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gelar_terakhir` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alamat_pekerjaan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `judul_thesis` text COLLATE utf8mb4_unicode_ci,
  `status_akun` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL,
  `daftar_tgl` date DEFAULT NULL,
  `diterima_tgl` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `template_to_form`
--

CREATE TABLE `template_to_form` (
  `id_mdtemplate_komponen` int(11) DEFAULT NULL,
  `form` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aauth_departement`
--
ALTER TABLE `aauth_departement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_group_to_group`
--
ALTER TABLE `aauth_group_to_group`
  ADD PRIMARY KEY (`group_id`,`subgroup_id`);

--
-- Indexes for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_perm_to_group`
--
ALTER TABLE `aauth_perm_to_group`
  ADD PRIMARY KEY (`perm_id`,`group_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `aauth_perm_to_user`
--
ALTER TABLE `aauth_perm_to_user`
  ADD PRIMARY KEY (`perm_id`,`user_id`);

--
-- Indexes for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `full_index` (`id`,`sender_id`,`receiver_id`,`date_read`);

--
-- Indexes for table `aauth_users`
--
ALTER TABLE `aauth_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_departement`
--
ALTER TABLE `aauth_user_to_departement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aauth_user_to_group`
--
ALTER TABLE `aauth_user_to_group`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id_index` (`user_id`);

--
-- Indexes for table `app_kegiatan`
--
ALTER TABLE `app_kegiatan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `app_konfirmasi`
--
ALTER TABLE `app_konfirmasi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `registrasi_id` (`registrasi_id`),
  ADD KEY `register_uid` (`register_uid`);

--
-- Indexes for table `app_menu`
--
ALTER TABLE `app_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_pengajuan`
--
ALTER TABLE `app_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `app_registrasi`
--
ALTER TABLE `app_registrasi`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uid` (`uid`),
  ADD KEY `kegiatan_id` (`kegiatan_id`);

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_soal`
--
ALTER TABLE `bank_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud`
--
ALTER TABLE `crud`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_custom_option`
--
ALTER TABLE `crud_custom_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_field`
--
ALTER TABLE `crud_field`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_field_validation`
--
ALTER TABLE `crud_field_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_input_type`
--
ALTER TABLE `crud_input_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crud_input_validation`
--
ALTER TABLE `crud_input_validation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departements_code_unique` (`code`);

--
-- Indexes for table `enroll`
--
ALTER TABLE `enroll`
  ADD PRIMARY KEY (`id`),
  ADD KEY `enroll_ibfk_1` (`id_group_soal`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prodi_id` (`prodi_id`);

--
-- Indexes for table `group_soal`
--
ALTER TABLE `group_soal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `h_ujian`
--
ALTER TABLE `h_ujian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_group_soal` (`id_group_soal`),
  ADD KEY `id_master_mahasiswa` (`id_master_mahasiswa`);

--
-- Indexes for table `karyawans`
--
ALTER TABLE `karyawans`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `karyawans_code_unique` (`code`),
  ADD UNIQUE KEY `karyawans_email_unique` (`email`);

--
-- Indexes for table `kategori_komponen`
--
ALTER TABLE `kategori_komponen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelengkapan`
--
ALTER TABLE `kelengkapan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komponen`
--
ALTER TABLE `komponen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_kategori_komponen` (`id_kategori_komponen`);

--
-- Indexes for table `master_angkatan`
--
ALTER TABLE `master_angkatan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_dosen`
--
ALTER TABLE `master_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_mahasiswa`
--
ALTER TABLE `master_mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `no_registrasi` (`npm`) USING BTREE,
  ADD KEY `id_master_prodi` (`id_master_prodi`),
  ADD KEY `no_registrasi_2` (`npm`) USING BTREE;

--
-- Indexes for table `master_prodi`
--
ALTER TABLE `master_prodi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdapp_pengajuan`
--
ALTER TABLE `mdapp_pengajuan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdapp_ujian`
--
ALTER TABLE `mdapp_ujian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdtemplate_form`
--
ALTER TABLE `mdtemplate_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mhs_daftar`
--
ALTER TABLE `mhs_daftar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pejabats`
--
ALTER TABLE `pejabats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengajars`
--
ALTER TABLE `pengajars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pengajars_code_unique` (`code`),
  ADD UNIQUE KEY `pengajars_email_unique` (`email`);

--
-- Indexes for table `program_studis`
--
ALTER TABLE `program_studis`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `program_studis_code_unique` (`code`);

--
-- Indexes for table `soal_to_gorupsoal`
--
ALTER TABLE `soal_to_gorupsoal`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_group_soal` (`id_group_soal`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_code_unique` (`code`),
  ADD UNIQUE KEY `students_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aauth_departement`
--
ALTER TABLE `aauth_departement`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `aauth_groups`
--
ALTER TABLE `aauth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `aauth_login_attempts`
--
ALTER TABLE `aauth_login_attempts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `aauth_perms`
--
ALTER TABLE `aauth_perms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `aauth_pms`
--
ALTER TABLE `aauth_pms`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `aauth_users`
--
ALTER TABLE `aauth_users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `aauth_user_to_departement`
--
ALTER TABLE `aauth_user_to_departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `aauth_user_variables`
--
ALTER TABLE `aauth_user_variables`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `app_kegiatan`
--
ALTER TABLE `app_kegiatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `app_konfirmasi`
--
ALTER TABLE `app_konfirmasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `app_menu`
--
ALTER TABLE `app_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `app_pengajuan`
--
ALTER TABLE `app_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `app_registrasi`
--
ALTER TABLE `app_registrasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `app_settings`
--
ALTER TABLE `app_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bank_soal`
--
ALTER TABLE `bank_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `crud`
--
ALTER TABLE `crud`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `crud_custom_option`
--
ALTER TABLE `crud_custom_option`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `crud_field`
--
ALTER TABLE `crud_field`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3353;

--
-- AUTO_INCREMENT for table `crud_field_validation`
--
ALTER TABLE `crud_field_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4621;

--
-- AUTO_INCREMENT for table `crud_input_type`
--
ALTER TABLE `crud_input_type`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `crud_input_validation`
--
ALTER TABLE `crud_input_validation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `enroll`
--
ALTER TABLE `enroll`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `group_soal`
--
ALTER TABLE `group_soal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `h_ujian`
--
ALTER TABLE `h_ujian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT for table `karyawans`
--
ALTER TABLE `karyawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `kategori_komponen`
--
ALTER TABLE `kategori_komponen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kelengkapan`
--
ALTER TABLE `kelengkapan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `komponen`
--
ALTER TABLE `komponen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `master_angkatan`
--
ALTER TABLE `master_angkatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `master_dosen`
--
ALTER TABLE `master_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `master_mahasiswa`
--
ALTER TABLE `master_mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=133;

--
-- AUTO_INCREMENT for table `master_prodi`
--
ALTER TABLE `master_prodi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `mdapp_pengajuan`
--
ALTER TABLE `mdapp_pengajuan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mdtemplate_form`
--
ALTER TABLE `mdtemplate_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `mhs_daftar`
--
ALTER TABLE `mhs_daftar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pejabats`
--
ALTER TABLE `pejabats`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengajars`
--
ALTER TABLE `pengajars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `program_studis`
--
ALTER TABLE `program_studis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `soal_to_gorupsoal`
--
ALTER TABLE `soal_to_gorupsoal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aauth_perm_to_group`
--
ALTER TABLE `aauth_perm_to_group`
  ADD CONSTRAINT `aauth_perm_to_group_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `aauth_groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `aauth_perm_to_group_ibfk_2` FOREIGN KEY (`perm_id`) REFERENCES `aauth_perms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `app_kegiatan`
--
ALTER TABLE `app_kegiatan`
  ADD CONSTRAINT `app_kegiatan_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `master_prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `app_konfirmasi`
--
ALTER TABLE `app_konfirmasi`
  ADD CONSTRAINT `app_konfirmasi_ibfk_1` FOREIGN KEY (`registrasi_id`) REFERENCES `app_registrasi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `app_konfirmasi_ibfk_2` FOREIGN KEY (`register_uid`) REFERENCES `app_registrasi` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `app_registrasi`
--
ALTER TABLE `app_registrasi`
  ADD CONSTRAINT `app_registrasi_ibfk_1` FOREIGN KEY (`kegiatan_id`) REFERENCES `app_kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `enroll`
--
ALTER TABLE `enroll`
  ADD CONSTRAINT `enroll_ibfk_1` FOREIGN KEY (`id_group_soal`) REFERENCES `group_soal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`prodi_id`) REFERENCES `master_prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `komponen`
--
ALTER TABLE `komponen`
  ADD CONSTRAINT `komponen_ibfk_1` FOREIGN KEY (`id_kategori_komponen`) REFERENCES `kategori_komponen` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `master_mahasiswa`
--
ALTER TABLE `master_mahasiswa`
  ADD CONSTRAINT `master_mahasiswa_ibfk_1` FOREIGN KEY (`id_master_prodi`) REFERENCES `master_prodi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
