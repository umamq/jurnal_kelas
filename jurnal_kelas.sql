-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Bulan Mei 2020 pada 06.53
-- Versi server: 10.1.34-MariaDB
-- Versi PHP: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jurnal_kelas`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `ci_session`
--

CREATE TABLE `ci_session` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `timestamp` int(10) UNSIGNED DEFAULT NULL,
  `data` blob
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `ci_session`
--

INSERT INTO `ci_session` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('15vhmj5f8l9be07gb902oprrh0q4kjju', '::1', 1586492126, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363439313834343b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('17rgnvhovgud975faanhtirpt05otdji', '::1', 1586442774, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434323530323b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('2a239d8qo7dpnht2m4fe249vp9alrncr', '::1', 1586447626, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434373332383b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('2ubite41kgel21r8rcsihvht3q7pi8h2', '::1', 1586416968, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431363632383b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('3if9grgb9945dgpg7ck8duo65tgr8apu', '::1', 1586447720, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434373638313b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('5lojuekin1ai329i5o49q2agv3ldsp5d', '::1', 1586489030, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363438383831343b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('6270bjijlioa4p5hqcdffomcohtnglua', '::1', 1586486990, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363438363734303b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('6sffif7g1jcn2ja7h5t1tp8ag7g3thtt', '::1', 1589550611, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538393535303431333b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b),
('75u7jjc1p3094fu7frorba9gffgmk3l5', '::1', 1586487396, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363438373135353b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('7a7kr66ro4uja3jkr7e439hprvk5osu7', '::1', 1586415913, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431353436333b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('7nli57laoqb85cfsk499q6ir8h7vb3uc', '::1', 1586416244, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431353932333b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('9n79kk26r324l0106dfjaihu5l9fv2de', '::1', 1586440758, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434303630303b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('aafqj9p2e291g9itejabrbtcqfk1lsc7', '::1', 1589554053, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538393535343035333b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b),
('aupbjke9ui8dhe3g9iiikbu4s306ad7g', '::1', 1586415462, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431353038383b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('dv57fij0pkuc6o26cg8cnjqrrkq6f61e', '::1', 1589553695, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538393535333638373b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b),
('ea8lboo48heu5f540ufmt626ll42dqop', '::1', 1586417603, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431373336373b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('gl5aaj67jeho98rpi58k5ve2u24a4d9h', '::1', 1589552438, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538393535323432393b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b),
('h6usjdhl4c5t87ue69u4iiue6f8okb3u', '::1', 1586416626, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431363234373b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('mf2srm5qe95tna5meaeqsh7oh00hfrhg', '::1', 1586488701, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363438383434343b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('npoi5sippru938e1iafkkumfcgb6osm0', '::1', 1586417364, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431363937333b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('o4obir67bojbqsq7h43658enqb3ne3pc', '::1', 1586415087, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431343339373b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('offdhdpbvnv19492729b3nubs9f8emv7', '::1', 1586445092, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434353039323b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('oq0c5uvautrrugvdorjjnqmt6uo6mrgg', '::1', 1586442820, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434323831333b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('paujgcovobofuf6t6hl9c4kui6nj9vrn', '::1', 1589549981, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538393534393638323b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b),
('qnq30csv5s9muro9c2ea9i131avp2eku', '::1', 1586413041, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363431323930323b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('rbu0gndhe4s1p8km0tedrct92qgnt073', '::1', 1586441232, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434303935343b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('rk82ho4g4ct2vung1pmbj4rklj1nl4du', '::1', 1586412901, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363430333431343b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('rri3a6nbf4a8heqvhfq2sir1g972n8sr', '::1', 1586445493, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363434353439333b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('s347kpv9ih5vpu6tdn0oa0cu9kn6tmes', '::1', 1586488254, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363438383131333b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('s85ck4tsvr1skvho7rujc67g58vokrbg', '::1', 1586491513, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363439313438393b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('t8cv7a0obm8p91gsagbe4t2ou9ocjgvm', '::1', 1589550173, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538393534393938343b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b),
('u2iek03q0uvfu9ee72kgf8b2a99q0g49', '::1', 1586492385, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538363439323136313b757365725f69647c733a313a2232223b757365725f757365726e616d657c733a393a226b7572696b756c756d223b757365725f6c6576656c7c733a393a224b5552494b554c554d223b),
('vargudvnspdunj9o4ohp8n0rdosmumdr', '::1', 1589557612, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538393535373430333b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b),
('vpcmmfjirqpe5tkg8me6ucm3ql966as0', '::1', 1589549279, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538393534393234333b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jadwal_mengajar`
--

CREATE TABLE `jadwal_mengajar` (
  `id` int(11) NOT NULL,
  `hari` enum('SENIN','SELASA','RABU','KAMIS','JUMAT','SABTU') DEFAULT NULL,
  `matapelajaran_id` int(11) DEFAULT NULL,
  `pegawai_id` int(11) DEFAULT NULL,
  `jam` varchar(50) DEFAULT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='jadwal mengajar guru';

--
-- Dumping data untuk tabel `jadwal_mengajar`
--

INSERT INTO `jadwal_mengajar` (`id`, `hari`, `matapelajaran_id`, `pegawai_id`, `jam`, `kelas_id`, `tgl_update`) VALUES
(3, 'SENIN', 1, 1, '1,2', 1, NULL),
(4, 'SENIN', 2, 2, '3,4', 1, NULL),
(5, 'SENIN', 3, 3, '5,6', 1, NULL),
(6, 'SENIN', 4, 4, '7,8', 1, NULL),
(7, 'SELASA', 5, 5, '1,2', 1, NULL),
(8, 'SELASA', 3, 3, '3,4', 1, NULL),
(9, 'SELASA', 6, 6, '5,6', 1, NULL),
(10, 'SELASA', 1, 1, '7,8', 1, NULL),
(11, 'RABU', 2, 2, '1,2', 1, NULL),
(12, 'RABU', 4, 4, '3,4', 1, NULL),
(13, 'RABU', 7, 7, '5,6', 1, NULL),
(14, 'RABU', 3, 3, '7,8', 1, NULL),
(15, 'KAMIS', 7, 7, '1,2', 1, NULL),
(16, 'KAMIS', 2, 2, '3,4', 1, NULL),
(17, 'KAMIS', 4, 4, '5,6', 1, NULL),
(18, 'KAMIS', 1, 1, '7,8', 1, NULL),
(19, 'JUMAT', 1, 1, '1,2', 1, NULL),
(20, 'JUMAT', 7, 7, '3,4', 1, NULL),
(21, 'SABTU', 5, 5, '1,2', 1, NULL),
(22, 'SABTU', 3, 3, '3,4', 1, NULL),
(23, 'SABTU', 6, 6, '5,6', 1, NULL),
(24, 'SABTU', 8, 8, '7,8', 1, NULL),
(25, 'SENIN', 1, 9, '1,2', 2, NULL),
(26, 'SENIN', 2, 10, '3,4', 2, NULL),
(27, 'SENIN', 3, 11, '5,6', 2, NULL),
(28, 'SENIN', 4, 14, '7,8', 2, NULL),
(29, 'SELASA', 5, 12, '1,2', 2, NULL),
(30, 'SELASA', 3, 11, '3,4', 2, NULL),
(31, 'SELASA', 6, 13, '5,6', 2, NULL),
(32, 'SELASA', 1, 9, '7,8', 2, NULL),
(33, 'RABU', 9, 15, '1,2', 2, NULL),
(34, 'RABU', 7, 16, '3,4', 2, NULL),
(35, 'RABU', 4, 14, '5,6', 2, NULL),
(36, 'RABU', 1, 9, '7,8', 2, NULL),
(37, 'KAMIS', 1, 9, '1,2', 2, NULL),
(38, 'KAMIS', 8, 17, '3,4', 2, NULL),
(39, 'KAMIS', 3, 11, '5,6', 2, NULL),
(40, 'KAMIS', 2, 10, '7,8', 2, NULL),
(41, 'JUMAT', 2, 10, '1,2', 2, NULL),
(42, 'JUMAT', 1, 9, '3,4', 2, NULL),
(43, 'SABTU', 5, 12, '1,2', 2, NULL),
(44, 'SABTU', 3, 11, '3,4', 2, NULL),
(45, 'SABTU', 6, 13, '5,6', 2, NULL),
(46, 'SABTU', 3, 17, '7,8', 2, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jam_aktif`
--

CREATE TABLE `jam_aktif` (
  `id` int(11) NOT NULL,
  `jam_ke` int(11) DEFAULT '0',
  `mulai` time DEFAULT '00:00:00',
  `selesai` time DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jam_aktif`
--

INSERT INTO `jam_aktif` (`id`, `jam_ke`, `mulai`, `selesai`) VALUES
(1, 1, '07:00:00', '07:40:00'),
(2, 2, '07:40:00', '08:20:00'),
(3, 3, '08:20:00', '09:00:00'),
(4, 4, '09:00:00', '09:40:00'),
(5, 5, '09:40:00', '10:20:00'),
(6, 6, '10:40:00', '11:20:00'),
(7, 7, '11:20:00', '12:00:00'),
(8, 8, '12:00:00', '12:40:00'),
(9, 9, '12:40:00', '13:20:00'),
(10, 10, '13:20:00', '14:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jurusan`
--

CREATE TABLE `jurusan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jurusan`
--

INSERT INTO `jurusan` (`id`, `nama`) VALUES
(1, 'Teknik Bangunan'),
(2, 'Teknik Ketenagalistrikan'),
(3, 'Teknik Mesin'),
(4, 'Teknik Otomotif'),
(5, 'Pelayaran'),
(6, 'Teknik Elektronika'),
(7, 'Teknik Komputer dan Informatika'),
(8, 'Agribisnis Produksi Sumberdaya'),
(9, 'Agribisnis Hasil Pertanian');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `jurusan_id` tinyint(4) DEFAULT NULL,
  `nama_kelas` varchar(50) DEFAULT NULL,
  `keterangan` text,
  `tgl_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `jurusan_id`, `nama_kelas`, `keterangan`, `tgl_update`) VALUES
(1, 1, 'Kelas A', NULL, NULL),
(2, 9, 'Kelas B', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `matapelajaran`
--

CREATE TABLE `matapelajaran` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `matapelajaran`
--

INSERT INTO `matapelajaran` (`id`, `nama`) VALUES
(1, 'Bahasa Indonesia'),
(2, 'Matematika'),
(3, 'Sejarah'),
(4, 'Bahasa Inggris'),
(5, 'PKN'),
(6, 'Agama'),
(7, 'Ekonomi'),
(8, 'Seni Budaya'),
(9, 'Olahraga');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(11) NOT NULL,
  `kode_pegawai` varchar(50) DEFAULT NULL,
  `jabatan` enum('GURU','KASI','KASEK') DEFAULT NULL,
  `nuptk` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `wali_kelas` varchar(50) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `terakhir_login` datetime DEFAULT NULL,
  `aktif` enum('YA','TIDAK') DEFAULT 'YA',
  `token_firebase` varchar(250) DEFAULT NULL,
  `token_login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `kode_pegawai`, `jabatan`, `nuptk`, `password`, `nama_lengkap`, `jk`, `alamat`, `email`, `telp`, `foto`, `wali_kelas`, `tgl_update`, `terakhir_login`, `aktif`, `token_firebase`, `token_login`) VALUES
(1, NULL, 'GURU', NULL, NULL, 'Supanji', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(2, NULL, 'GURU', NULL, NULL, 'Obby Istiyono', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(3, NULL, 'GURU', NULL, NULL, 'Helmi Isrofi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(4, NULL, 'GURU', NULL, NULL, 'Erika Aprilia', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(5, NULL, 'GURU', NULL, NULL, 'Friska Haliza', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(6, NULL, 'GURU', NULL, NULL, 'Nur Alvi N', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(7, NULL, 'GURU', NULL, NULL, 'Nurhidayati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(8, NULL, 'GURU', NULL, NULL, 'Anisa Rohim', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(9, NULL, 'GURU', NULL, NULL, 'Nurhayatik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(10, NULL, 'GURU', NULL, NULL, 'Rofi\'ah', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(11, NULL, 'GURU', NULL, NULL, 'Umi Kulsum', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(12, NULL, 'GURU', NULL, NULL, 'Suparman', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(13, NULL, 'GURU', NULL, NULL, 'Yeni Nurhayati', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(14, NULL, 'GURU', NULL, NULL, 'Muhsin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(15, NULL, 'GURU', NULL, NULL, 'Ahmad Suyuti', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(16, NULL, 'GURU', NULL, NULL, 'Tri Astutik', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL),
(17, NULL, 'GURU', NULL, NULL, 'Hanafi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `id` int(11) NOT NULL,
  `kelas_id` int(11) DEFAULT NULL,
  `petugas_jurnal` enum('YA','TIDAK') DEFAULT 'TIDAK',
  `nisn` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `jk` enum('L','P') DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `alamat` varchar(250) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `terakhir_login` datetime DEFAULT NULL,
  `aktif` enum('YA','TIDAK') DEFAULT 'YA',
  `token_firebase` varchar(250) DEFAULT NULL,
  `token_login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='operator sekolah masukin siswa => sekolah_id\r\ntrus pegawai (guru kelas) masukin siswa ke kelas => set kelas_id';

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`id`, `kelas_id`, `petugas_jurnal`, `nisn`, `password`, `nama_lengkap`, `jk`, `email`, `telp`, `alamat`, `foto`, `tgl_update`, `terakhir_login`, `aktif`, `token_firebase`, `token_login`) VALUES
(1, 1, 'YA', '124558745', 'b0d0a43e31ed93753e801c65d859a7e5', 'Budi', 'L', 'budi@gmail.com', NULL, NULL, NULL, NULL, NULL, 'YA', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `foto` varchar(50) DEFAULT NULL,
  `level` enum('ADMIN','KURIKULUM') DEFAULT NULL,
  `tgl_update` datetime DEFAULT NULL,
  `terakhir_login` datetime DEFAULT NULL,
  `token_firebase` varchar(250) DEFAULT NULL,
  `token_login` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `nama_lengkap`, `email`, `telp`, `foto`, `level`, `tgl_update`, `terakhir_login`, `token_firebase`, `token_login`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@gmail.com', NULL, NULL, 'ADMIN', '2020-05-15 21:43:45', '2020-05-15 21:43:45', NULL, NULL),
(2, 'kurikulum', '4e7f2477836fa0c289105740fee0ebb1', 'kurikulum', 'kurikulum@gmail.com', NULL, NULL, 'KURIKULUM', '2020-05-15 21:45:28', '2020-05-15 21:45:28', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `ci_session`
--
ALTER TABLE `ci_session`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indeks untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `hari_jam_mulai_jam_selesai_kelas_id` (`hari`,`jam`,`kelas_id`);

--
-- Indeks untuk tabel `jam_aktif`
--
ALTER TABLE `jam_aktif`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `matapelajaran`
--
ALTER TABLE `matapelajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `jadwal_mengajar`
--
ALTER TABLE `jadwal_mengajar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT untuk tabel `jam_aktif`
--
ALTER TABLE `jam_aktif`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `jurusan`
--
ALTER TABLE `jurusan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
