-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 10 Jul 2020 pada 15.06
-- Versi server: 5.7.30-cll-lve
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sobatsho_debitair`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cth_hari`
--

CREATE TABLE `cth_hari` (
  `id_hari` int(25) NOT NULL,
  `hitungan_hari` int(30) DEFAULT NULL,
  `periode` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cth_hari`
--

INSERT INTO `cth_hari` (`id_hari`, `hitungan_hari`, `periode`) VALUES
(1, 1, 'Periode 1'),
(2, 2, 'Periode 1'),
(3, 3, 'Periode 1'),
(4, 4, 'Periode 1'),
(5, 5, 'Periode 1'),
(6, 6, 'Periode 1'),
(7, 7, 'Periode 1'),
(8, 8, 'Periode 1'),
(9, 9, 'Periode 1'),
(10, 10, 'Periode 1'),
(11, 11, 'Periode 2'),
(12, 12, 'Periode 2'),
(13, 13, 'Periode 2'),
(14, 14, 'Periode 2'),
(15, 15, 'Periode 2'),
(16, 16, 'Periode 2'),
(17, 17, 'Periode 2'),
(18, 18, 'Periode 2'),
(19, 19, 'Periode 2'),
(20, 20, 'Periode 2'),
(21, 21, 'Periode 3'),
(22, 22, 'Periode 3'),
(23, 23, 'Periode 3'),
(24, 24, 'Periode 3'),
(25, 25, 'Periode 3'),
(26, 26, 'Periode 3'),
(27, 27, 'Periode 3'),
(28, 28, 'Periode 3'),
(29, 29, 'Periode 3'),
(30, 30, 'Periode 3'),
(31, 31, 'Periode 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cth_laporan`
--

CREATE TABLE `cth_laporan` (
  `id_laporan` int(25) NOT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `id_daerah` varchar(25) DEFAULT NULL,
  `id_hari` int(25) DEFAULT NULL,
  `nama_sungai` varchar(250) DEFAULT NULL,
  `nama_bendungan` varchar(250) DEFAULT NULL,
  `intake_kanan` int(30) DEFAULT NULL,
  `intake_kiri` int(30) DEFAULT NULL,
  `jumlah_debit` int(30) DEFAULT NULL,
  `l_total` int(30) DEFAULT NULL,
  `l_eff` int(30) DEFAULT NULL,
  `date_laporan` date NOT NULL,
  `jam_laporan` time DEFAULT NULL,
  `foto_laporan` varchar(250) DEFAULT NULL,
  `lokasi_laporan` text,
  `status_laporan` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `cth_laporan`
--

INSERT INTO `cth_laporan` (`id_laporan`, `id_user`, `id_daerah`, `id_hari`, `nama_sungai`, `nama_bendungan`, `intake_kanan`, `intake_kiri`, `jumlah_debit`, `l_total`, `l_eff`, `date_laporan`, `jam_laporan`, `foto_laporan`, `lokasi_laporan`, `status_laporan`) VALUES
(81, 'RAP008', 'DT002', 1, 'PATALAN', 'TUNGGAK 207 Ha', 235, 242, 50, 1, 1, '2020-06-19', '14:38:01', '', '-7.7799626, 113.4054495', 'Dikonfirmasi'),
(82, 'RAP008', 'DT002', 11, 'PATALAN', 'TUNGGAK 207 Ha', 225, 227, 44, 2, 2, '2020-06-19', '14:38:47', '', '-7.7799824, 113.4054641', 'Dikonfirmasi'),
(83, 'RAP008', 'DT002', 21, 'PATALAN', 'TUNGGAK 207 Ha', 47, 49, 46, 3, 3, '2020-06-19', '14:39:04', '', '-7.7799829, 113.4054644', 'Dikonfirmasi'),
(84, 'RAP008', 'DT002', 1, 'PATALAN', 'KRASAK 562 Ha', 229, 221, 42, 16, 15, '2020-06-19', '15:01:04', '', '-7.7799823, 113.4054627', 'Dikonfirmasi'),
(85, 'RAP008', 'DT002', 11, 'PATALAN', 'KRASAK 562 Ha', 252, 241, 64, 16, 15, '2020-06-19', '15:01:19', '', '-7.7799823, 113.4054627', 'Dikonfirmasi'),
(86, 'RAP008', 'DT002', 21, 'PATALAN', 'KRASAK 562 Ha', 48, 50, 64, 19, 45, '2020-06-19', '15:01:41', '', '-7.7799831, 113.4054639', 'Dikonfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `daerah_tugas`
--

CREATE TABLE `daerah_tugas` (
  `id_daerah` varchar(25) NOT NULL,
  `daerah_tugas` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `daerah_tugas`
--

INSERT INTO `daerah_tugas` (`id_daerah`, `daerah_tugas`) VALUES
('DT001', 'Paiton'),
('DT002', 'Besuk'),
('DT003', 'Krejengan'),
('DT004', 'Pekalen'),
('DT005', 'Sebaung'),
('DT006', 'Probolinggo'),
('DT007', 'Sumberasih'),
('DT008', 'Kraksaan'),
('DT009', 'Banyuanyar'),
('DT010', 'Gading'),
('DT011', 'Pakuniran');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_akses`
--

CREATE TABLE `db_akses` (
  `id_akses` varchar(25) NOT NULL,
  `nama_akses` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_akses`
--

INSERT INTO `db_akses` (`id_akses`, `nama_akses`) VALUES
('1', 'Dinas PUPR'),
('2', 'Kordinator Wilayah'),
('3', 'Pengawas Lapangan');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_pengaduan`
--

CREATE TABLE `db_pengaduan` (
  `id_pengaduan` int(25) NOT NULL,
  `id_user` varchar(25) DEFAULT NULL,
  `id_daerah` varchar(25) DEFAULT NULL,
  `nama_sungaiPeng` varchar(250) NOT NULL,
  `nama_bendungPeng` varchar(250) NOT NULL,
  `pengaduan` text,
  `foto_pengaduan` varchar(250) DEFAULT NULL,
  `respon_pengaduan` text,
  `date_pengaduan` date DEFAULT NULL,
  `waktu_pengaduan` time DEFAULT NULL,
  `lokasi_pengaduan` text NOT NULL,
  `status_pengaduan` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_pengaduan`
--

INSERT INTO `db_pengaduan` (`id_pengaduan`, `id_user`, `id_daerah`, `nama_sungaiPeng`, `nama_bendungPeng`, `pengaduan`, `foto_pengaduan`, `respon_pengaduan`, `date_pengaduan`, `waktu_pengaduan`, `lokasi_pengaduan`, `status_pengaduan`) VALUES
(11, 'RAP008', 'DT002', 'PATALAN', 'PATALAN 16Ha', 'Terjadi sesuatu', '1591785972486_image.jpeg', 'Aman pak', '2020-06-10', '18:46:14', '-7.7644143, 113.4204333', 'Direspon');

-- --------------------------------------------------------

--
-- Struktur dari tabel `db_user`
--

CREATE TABLE `db_user` (
  `id_user` varchar(25) NOT NULL,
  `nip_user` varchar(30) DEFAULT NULL,
  `nama_user` varchar(30) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `tgl_lahir_user` date DEFAULT NULL,
  `alamat_user` varchar(30) DEFAULT NULL,
  `id_akses` varchar(25) DEFAULT NULL,
  `id_daerah` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `db_user`
--

INSERT INTO `db_user` (`id_user`, `nip_user`, `nama_user`, `username`, `password`, `tgl_lahir_user`, `alamat_user`, `id_akses`, `id_daerah`) VALUES
('RAD001', '1731710001', 'Admin Dinas PUPR', 'adminpupr', '$2y$10$7aJqTka5ZjcIHiFwsNuOmOJF7bM00eHFCNvpoOY1KskYLSnRS1J0W', '1998-07-15', 'JL Kyai Mugi no 99', '1', NULL),
('RAD002', '123456', 'Useradmin1', 'useradmin1', '$2y$10$ROF.pkk0hQqDJLuf0e7aSeE5UO4y/VlP2KhHvv4pkex0fODNVYlHK', '2020-05-19', 'sini', '1', NULL),
('RAD003', '21345', 'Useradmin2', 'useradmin2', '$2y$10$g1XliWWs3RKTTmXJnhtcAeHRNoyiIcVWvNx8H62/1zjzUV3Ed4eem', '2020-05-04', 'sini', '1', NULL),
('RAD004', '343121', 'Useradmin', 'useradmin', '$2y$10$z/mnRgX88yqDefaeM/5kAu1bl5VY1EFWmEkdHZpnPmfVAr9nWXoyG', '2020-05-14', 'sini', '1', NULL),
('RAK003', '1731710003', 'Admin Kordinator Wilayah', 'adminkorwil', '$2y$10$qYV/UvPEksH2UIOzhTR82u2Zne9kSdM/B2GWvz6G6JeeyfclwqZ.e', '1998-07-15', 'JL Kyai Mugi no 99', '2', 'DT002'),
('RAK005', '12313', 'adminkor1', 'adminkor1', '$2y$10$/BHv7PYgi42ESrm01WopMO5laGm8pYMizMSYsLpOhm0EarGsnmZSi', '2020-05-12', 'sini', '2', 'DT004'),
('RAK006', '12342', 'adminkor2', 'adminkor2', '$2y$10$/QA.vJETTMg/ZuMqEylfCejSDgd0UY9BWXIX2CMgtcJJSSFI98hE2', '2020-05-19', 'sini', '2', 'DT008'),
('RAK007', '2123423', 'adminkor', 'adminkor', '$2y$10$To.LKBEWk3GbXPnMVfeOreJvaOufJsXQpnlRGmGydhJ7lgirSDz.m', '2020-05-12', 'sini', '2', 'DT006'),
('RAP008', '1731710001', 'coba', 'coba', '$2y$10$m4FqvdSYqB3QkW6OiN4hSesC2GUYqVcs3pL3h/LiboWOE.LnhXVMq', '1998-07-15', 'JL Kyai Mugi no 99', '3', 'DT002'),
('RAP009', '13423', 'userpengawas1', 'userpengawas1', '$2y$10$BcABNsTLvuIpjPWjU3ZEBupvLoeuR6yjNTvLZ6xUJFQqKlBiVYDva', '2020-05-12', 'sini', '3', 'DT002'),
('RAP010', '231234', 'userpengawas2', 'userpengawas2', '$2y$10$GSDt24Wixv0bW7o1dQ8rh.P0pKJatzxGgOobm7wgsXWFaFU6UK7Ie', '2020-05-15', 'sini', '3', 'DT002'),
('RAP011', '213442', 'userpengawas', 'userpengawas', '$2y$10$MOfzyxlAm2Ne7bzGgqUp6e1fpyGNF050wQmYR8QWi8WOfhr3grRPS', '2020-05-19', 'sini', '3', 'DT002');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cth_hari`
--
ALTER TABLE `cth_hari`
  ADD PRIMARY KEY (`id_hari`);

--
-- Indeks untuk tabel `cth_laporan`
--
ALTER TABLE `cth_laporan`
  ADD PRIMARY KEY (`id_laporan`),
  ADD KEY `id_hari_laporan` (`id_hari`),
  ADD KEY `id_user` (`id_user`);

--
-- Indeks untuk tabel `daerah_tugas`
--
ALTER TABLE `daerah_tugas`
  ADD PRIMARY KEY (`id_daerah`);

--
-- Indeks untuk tabel `db_akses`
--
ALTER TABLE `db_akses`
  ADD PRIMARY KEY (`id_akses`);

--
-- Indeks untuk tabel `db_pengaduan`
--
ALTER TABLE `db_pengaduan`
  ADD PRIMARY KEY (`id_pengaduan`),
  ADD KEY `id_user_pengaduan` (`id_user`),
  ADD KEY `id_daerah_pengaduan` (`id_daerah`);

--
-- Indeks untuk tabel `db_user`
--
ALTER TABLE `db_user`
  ADD PRIMARY KEY (`id_user`),
  ADD KEY `id_akses` (`id_akses`),
  ADD KEY `id_daerah` (`id_daerah`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cth_hari`
--
ALTER TABLE `cth_hari`
  MODIFY `id_hari` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT untuk tabel `cth_laporan`
--
ALTER TABLE `cth_laporan`
  MODIFY `id_laporan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT untuk tabel `db_pengaduan`
--
ALTER TABLE `db_pengaduan`
  MODIFY `id_pengaduan` int(25) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cth_laporan`
--
ALTER TABLE `cth_laporan`
  ADD CONSTRAINT `id_hari_laporan` FOREIGN KEY (`id_hari`) REFERENCES `cth_hari` (`id_hari`),
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `db_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `db_pengaduan`
--
ALTER TABLE `db_pengaduan`
  ADD CONSTRAINT `id_daerah_pengaduan` FOREIGN KEY (`id_daerah`) REFERENCES `daerah_tugas` (`id_daerah`),
  ADD CONSTRAINT `id_user_pengaduan` FOREIGN KEY (`id_user`) REFERENCES `db_user` (`id_user`);

--
-- Ketidakleluasaan untuk tabel `db_user`
--
ALTER TABLE `db_user`
  ADD CONSTRAINT `id_akses` FOREIGN KEY (`id_akses`) REFERENCES `db_akses` (`id_akses`),
  ADD CONSTRAINT `id_daerah` FOREIGN KEY (`id_daerah`) REFERENCES `daerah_tugas` (`id_daerah`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
