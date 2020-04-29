-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 29 Apr 2020 pada 08.14
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
('6dpglbtclk7dh3f28qd9lj19gqo5gmkg', '::1', 1588140772, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538383134303737323b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b),
('ecdtsdn4f3de1ncggu8j7hv6k2ev5i4s', '::1', 1588140751, 0x5f5f63695f6c6173745f726567656e65726174657c693a313538383134303435313b757365725f69647c733a313a2231223b757365725f757365726e616d657c733a353a2261646d696e223b757365725f6c6576656c7c733a353a2241444d494e223b);

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
(1, 'A1', 'GURU', '11', '6512bd43d9caa6e02c990b0a82652dca', 'Ahmad', 'L', 'Banyuwangi', 'ahmad@gmail.com', '879', '95023-guru.png', NULL, '2020-04-27 16:59:15', NULL, 'YA', NULL, NULL),
(2, 'A2', 'GURU', '12', 'c20ad4d76fe97759aa27a0c99bff6710', 'Anisa', 'P', 'Banyuwangi', 'anisa@gmail.com', '745', '644cc-guru-piket.jpg', NULL, '2020-04-27 16:59:58', NULL, 'YA', NULL, NULL);

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
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin@gmail.com', NULL, NULL, 'ADMIN', '2020-04-27 17:01:14', '2020-04-27 17:03:06', NULL, NULL),
(2, 'kurikulum', '4e7f2477836fa0c289105740fee0ebb1', 'kurikulum', 'kurikulum@gmail.com', NULL, NULL, 'KURIKULUM', '2020-04-27 17:02:28', '2020-04-27 17:04:18', NULL, NULL);

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
-- AUTO_INCREMENT untuk tabel `matapelajaran`
--
ALTER TABLE `matapelajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
