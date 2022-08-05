-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Agu 2022 pada 17.51
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `abyan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `username` varchar(5) NOT NULL,
  `pass` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`username`, `pass`, `nama`) VALUES
('admin', 'admin123', 'administrator');

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `id_golongan` varchar(1) NOT NULL,
  `nama_golongan` varchar(4) NOT NULL,
  `tunjangan_golongan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`id_golongan`, `nama_golongan`, `tunjangan_golongan`) VALUES
('1', 'I', 500000),
('2', 'II', 2000000),
('3', 'III', 5000000),
('4', 'IV', 10000000),
('5', 'V', 1500000),
('8', 'dd', 1500000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id_jabatan` varchar(2) NOT NULL,
  `nama_jabatan` varchar(30) NOT NULL,
  `gaji` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `gaji`) VALUES
('01', 'manajer', 30000000),
('02', 'asisten manajer', 15000000),
('03', 'sekretaris', 10000000),
('04', 'staff', 5000000),
('05', 'Cleaning Service', 3000000),
('06', 'Magang', 15000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_perubahan_golongan_pegawai`
--

CREATE TABLE `log_perubahan_golongan_pegawai` (
  `nip` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_golongan_sebelum` varchar(1) NOT NULL,
  `id_golongan_sesudah` varchar(1) NOT NULL,
  `tanggal_perubahan` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_perubahan_golongan_pegawai`
--

INSERT INTO `log_perubahan_golongan_pegawai` (`nip`, `nama`, `id_golongan_sebelum`, `id_golongan_sesudah`, `tanggal_perubahan`) VALUES
('10120240', 'Rina Nissa', '2', '3', '02:21:57'),
('10101101', 'rizky', '1', '1', '16:31:42'),
('1012022', 'rizky', '1', '1', '16:42:21'),
('1012022', 'fajar', '1', '1', '22:18:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `log_perubahan_jabatan_pegawai`
--

CREATE TABLE `log_perubahan_jabatan_pegawai` (
  `nip` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `id_jabatan_sebelum` int(2) NOT NULL,
  `id_jabatan_sesudah` int(2) NOT NULL,
  `tanggal_perubahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `log_perubahan_jabatan_pegawai`
--

INSERT INTO `log_perubahan_jabatan_pegawai` (`nip`, `nama`, `id_jabatan_sebelum`, `id_jabatan_sesudah`, `tanggal_perubahan`) VALUES
('10120245', 'Hafiz Herla Firmansyah', 2, 4, '2022-08-04'),
('10120240', 'Rina Nissa', 4, 4, '2022-08-04'),
('10101101', 'rizky', 1, 1, '2022-08-05'),
('1012022', 'rizky', 1, 1, '2022-08-05'),
('1012022', 'fajar', 1, 1, '2022-08-05');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(8) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jk` varchar(10) NOT NULL,
  `id_jabatan` varchar(2) NOT NULL,
  `id_golongan` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`nip`, `nama`, `alamat`, `tanggal_lahir`, `jk`, `id_jabatan`, `id_golongan`) VALUES
('10120209', 'Abyan Altoriandi Yazid', 'Halteu Selatan no 4/76', '1998-07-15', 'Pria', '01', '4'),
('10120210', 'Diva Putra', 'Soreang City no 98', '2002-08-01', 'Pria', '04', '4'),
('1012022', 'rizky', 'kopo mas', '0000-00-00', 'Laki Laki', '01', '1'),
('10120222', 'ki', '90000000', '2022-08-23', 'pira', '03', '3'),
('10120240', 'Rina Nissa', 'Sudirman Barat no 90', '1999-01-01', 'Wanita', '04', '3'),
('12345678', 'rizky', 'cibaduyut', '2012-12-12', 'Laki Laki', '01', '2');

--
-- Trigger `pegawai`
--
DELIMITER $$
CREATE TRIGGER `PERUBAHAN_GOLONGAN` AFTER UPDATE ON `pegawai` FOR EACH ROW insert into log_perubahan_golongan_pegawai
set nip=OLD.nip,
nama=OLD.nama,
id_golongan_sebelum=OLD.id_golongan,
id_golongan_sesudah=NEW.id_golongan,
tanggal_perubahan=now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `PERUBAHAN_JABATAN` AFTER UPDATE ON `pegawai` FOR EACH ROW insert into log_perubahan_jabatan_pegawai
set nip=OLD.nip,
nama=OLD.nama,
id_jabatan_sebelum=OLD.id_jabatan,
id_jabatan_sesudah=NEW.id_jabatan,
tanggal_perubahan=now()
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`username`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id_golongan`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id_jabatan`);

--
-- Indeks untuk tabel `log_perubahan_jabatan_pegawai`
--
ALTER TABLE `log_perubahan_jabatan_pegawai`
  ADD KEY `nip` (`nip`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `id_jabatan` (`id_jabatan`),
  ADD KEY `id_golongan` (`id_golongan`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `pegawai_ibfk_1` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`),
  ADD CONSTRAINT `pegawai_ibfk_3` FOREIGN KEY (`id_golongan`) REFERENCES `golongan` (`id_golongan`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
