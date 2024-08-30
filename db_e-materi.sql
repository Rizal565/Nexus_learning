-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 02 Jan 2024 pada 14.36
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_e-materi`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `nama_kategori` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `nama_kategori`) VALUES
(1, 'Matematika'),
(2, 'Kimia'),
(3, 'Fisika'),
(5, 'Biologi'),
(6, 'Ekonomi'),
(7, 'Sejarah'),
(8, 'bahasa arab'),
(9, 'abc');

-- --------------------------------------------------------

--
-- Struktur dari tabel `materi`
--

CREATE TABLE `materi` (
  `id_materi` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `judul_materi` varchar(25) NOT NULL,
  `file_uploaded` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `materi`
--

INSERT INTO `materi` (`id_materi`, `id_kategori`, `judul_materi`, `file_uploaded`) VALUES
(1, 1, 'Logika Matematika', 'logik_mat2_2_1704127772.pdf'),
(2, 1, 'Statiska', 'stati_mat2_2_1704127815.pdf'),
(4, 1, 'Baris dan Deret', '6592edd7a3dd3_1704127959.pdf'),
(5, 2, 'Sifat Tabel Periodik', '6592ee509b93b_1704128080.pdf'),
(6, 2, 'Bilangan Kuantum', '6592ee80efe1c_1704128128.pdf'),
(7, 2, 'Ikatan Kimia', '6592ee9899905_1704128152.pdf'),
(8, 3, 'Besaran dan Pengukuran', '6592eeca628b8_1704128202.pdf'),
(9, 3, 'Vektor', '6592eedea998a_1704128222.pdf'),
(10, 3, 'Kinematika Gerak Lurus', '6592ef1a9e908_1704128282.pdf'),
(11, 5, 'Animalia', '6592ef3b07355_1704128315.pdf'),
(12, 5, 'Porifera dan Coelenterata', '6592ef7020ca1_1704128368.pdf'),
(13, 3, 'Vermes', '6592ef885326a_1704128392.pdf'),
(14, 5, 'Arthropoda', '6592efacb2f31_1704128428.pdf'),
(15, 6, 'Kebutuhan dan kelangkaan', '6592efdfc0d72_1704128479.pdf'),
(16, 6, 'Permasalahan Ekonomi', '6592f0019f33c_1704128513.pdf'),
(17, 6, 'Sistem Perekonomian', '6592f01f27c0f_1704128543.pdf'),
(18, 7, 'Ilmu Sejarah', '6592f03fc329f_1704128575.pdf'),
(19, 7, 'Tradisi Sejarah Masa Praa', '6592f06fa5ef5_1704128623.pdf'),
(20, 7, 'Manusia Purba', '6592f086ab779_1704128646.pdf'),
(21, 7, 'Kehidupan Awal Masyarakat', '6592f0b87bd38_1704128696.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `email` varchar(150) NOT NULL,
  `image` varchar(128) NOT NULL DEFAULT 'default.png',
  `password` varchar(150) NOT NULL,
  `role` enum('administrator','pengunjung') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin1', 'admin1@gmail.com', 'default.png', 'admin01', 'administrator', '2023-12-15 18:56:57', '2023-12-15 18:56:57'),
(2, 'Admin2', 'admin2@gmail.com', 'default_1704129497.png', 'admin2', 'administrator', '2023-12-15 18:59:45', '2023-12-15 18:59:45'),
(7, 'rizal', 'firmanz565@gmail.com', 'avatar_1704128931.png', 'abc', 'pengunjung', '2023-12-17 13:14:59', '2023-12-17 13:14:59'),
(8, 'algi', 'algi@gmail.com', 'avatar4_1704129416.png', 'abc', 'pengunjung', '2023-12-18 21:13:34', '2023-12-18 21:13:34'),
(9, 'pendi', 'pendi@gmail.com', 'avatar5_1704129426.png', 'abc', 'pengunjung', '2023-12-18 21:27:40', '2023-12-18 21:27:40'),
(10, 'miun', 'miun@gmail.com', 'avatar2_1704129439.png', '123', 'pengunjung', '2023-12-22 09:39:07', '2023-12-22 09:39:07'),
(11, 'Aldi', 'Aldi@gmail.com', '65939caf1cbfd_1704172719.png', 'abc', 'pengunjung', '2024-01-02 12:18:39', '2024-01-02 12:18:39');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `materi`
--
ALTER TABLE `materi`
  ADD PRIMARY KEY (`id_materi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `materi`
--
ALTER TABLE `materi`
  MODIFY `id_materi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
