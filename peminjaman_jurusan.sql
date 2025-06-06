-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Jun 2025 pada 03.05
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `peminjaman_jurusan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `lokasi` varchar(100) NOT NULL,
  `kondisi` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `gambar`, `nama_barang`, `stok`, `kategori`, `lokasi`, `kondisi`) VALUES
(6, '68351492ca3a9.jpg', 'Crimping', 5, '', 'Ruang Alat', 'good'),
(7, '6834fdcf12706.jpg', 'Projector', 5, '', 'Ruang Alat(lemari)', 'Good'),
(8, '6835151e60cc0.jpg', 'solder', 2, '', 'Ruang Alat', 'good'),
(9, '6835165d5d008.jpg', 'speaker', 3, '', 'Ruang Alat', 'Good'),
(10, '68351708123e5.jpg', 'Obeng', 3, '', 'Ruang Alat', 'Good'),
(11, '6834fccac8f5f.jpg', 'Mikrotik', 50, '', 'Ruang Alat(lemari)', 'Good'),
(12, '683519b9c9f62.png', 'LAN Tester', 5, '', 'Ruang Alat', 'good'),
(13, '68351a4dcf0c7.jpg', 'Router', 10, '', 'Ruang Alat', 'Good');

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifikasi`
--

CREATE TABLE `notifikasi` (
  `id` int(11) NOT NULL,
  `nomor_id` varchar(100) NOT NULL,
  `pesan` text NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'belum_dibaca',
  `crated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `notifikasi`
--

INSERT INTO `notifikasi` (`id`, `nomor_id`, `pesan`, `status`, `crated_at`) VALUES
(1, '33333333', 'Segera kembalikan barang \"Tas\" karena waktu pinjam telah habis.', 'dibaca', '2025-05-23 15:02:07'),
(2, '33333333', 'Segera kembalikan barang \"Tas\" karena waktu pinjam telah habis.', 'dibaca', '2025-05-23 15:02:21'),
(3, '33333333', 'Segera kembalikan barang \"Tas\" karena waktu pinjam telah habis.', 'dibaca', '2025-05-23 15:02:31'),
(4, '33333333', 'Segera kembalikan barang \"Tas\" karena waktu pinjam telah habis.', 'dibaca', '2025-05-23 15:21:38'),
(5, '33333333', 'Segera kembalikan barang \"Tas\" karena waktu pinjam telah habis.', 'dibaca', '2025-05-23 15:21:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `nomor_id` int(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` varchar(50) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `alasan` text NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` enum('menunggu','disetujui','ditolak','dipinjam','dikembalikan') NOT NULL,
  `tanggal_pinjam` datetime NOT NULL,
  `tanggal_kembali` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `nomor_id`, `nama`, `kelas`, `id_barang`, `alasan`, `jumlah`, `status`, `tanggal_pinjam`, `tanggal_kembali`, `created_at`) VALUES
(50, 33333333, 'aji', '', 6, '1', 400, 'dikembalikan', '2025-05-25 22:22:00', '2025-05-25 23:15:00', '2025-05-25 16:11:36'),
(51, 33333333, 'aji', '', 6, '2', 60, 'dikembalikan', '2025-05-25 22:22:00', '2025-05-25 23:15:00', '2025-05-25 16:11:47'),
(52, 33333333, 'aji', '', 7, '1', 10, 'ditolak', '2025-05-25 22:22:00', '2025-05-25 23:15:00', '2025-05-25 16:12:07'),
(53, 33333333, 'aji', '', 10, '2', 2, 'dikembalikan', '2025-05-25 22:22:00', '2025-05-25 23:15:00', '2025-05-25 16:12:21'),
(54, 33333333, 'aji', '', 6, '2', 400, 'ditolak', '2025-05-25 22:22:00', '2025-05-25 23:50:00', '2025-05-25 16:44:17'),
(55, 33333333, 'aji', '', 7, '1', 1, 'ditolak', '2025-05-25 23:33:00', '2025-05-25 23:50:00', '2025-05-25 16:44:40'),
(56, 33333333, 'aji', '', 8, '2', 2, 'ditolak', '2025-05-25 23:40:00', '2025-05-25 23:50:00', '2025-05-25 16:45:07'),
(57, 33333333, 'aji', '', 9, '2', 3, 'dikembalikan', '2025-05-25 23:44:00', '2025-05-25 23:50:00', '2025-05-25 16:45:23'),
(58, 33333333, 'aji', '', 10, '1', 1, 'ditolak', '2025-05-25 11:11:00', '2025-05-25 23:50:00', '2025-05-25 16:47:59'),
(59, 33333333, 'aji', '', 6, '1', 1, 'ditolak', '2025-05-25 22:22:00', '2025-05-25 23:50:00', '2025-05-25 16:48:10'),
(60, 33333333, 'aji', '', 10, '1', 1, 'ditolak', '2025-05-25 22:22:00', '2025-05-25 23:50:00', '2025-05-25 16:48:25'),
(61, 33333333, 'aji', '', 10, '1', 1, 'ditolak', '2025-05-25 22:22:00', '2025-05-25 23:50:00', '2025-05-25 16:48:40'),
(62, 33333333, 'aji', '', 10, '1', 2, 'ditolak', '2025-05-25 23:33:00', '2025-05-25 23:50:00', '2025-05-25 16:48:52'),
(63, 33333333, 'aji', '', 6, '12', 8, 'dikembalikan', '2025-05-26 20:46:00', '2025-05-26 23:00:00', '2025-05-26 13:47:21'),
(64, 33333333, 'aji', '', 6, 'coba coba', 1, 'dikembalikan', '2025-05-27 09:03:00', '2025-05-27 09:06:00', '2025-05-27 02:03:48'),
(65, 33333333, 'aji', '', 7, 'belajar', 1, '', '2025-05-27 10:04:00', '2025-05-27 10:10:00', '2025-05-27 03:04:45'),
(66, 33333333, 'aji', '', 11, 'belajar', 10, 'menunggu', '2025-05-27 10:08:00', '2025-05-27 10:16:00', '2025-05-27 03:08:33');

-- --------------------------------------------------------

--
-- Struktur dari tabel `stock`
--

CREATE TABLE `stock` (
  `idBarang` int(11) NOT NULL,
  `namaBarang` varchar(25) NOT NULL,
  `deskripsi` varchar(25) NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nomor_id` int(8) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kelas` enum('X SIJA 1','X SIJA 2','XI SIJA 1','XI SIJA 2','XII SIJA 1','XII SIJA 2','Admin') NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `nomor_id`, `nama`, `kelas`, `password`, `role`) VALUES
(4, 22222222, 'Aji', 'Admin', 'admin222', 'admin'),
(6, 33333333, 'aji', '', 'siswa333', 'siswa'),
(8, 2, '12', '', '$2y$10$wlp5ZsO1kHjB4YNwd3iQLOCq8opWFitNBGdxWIDm9sDYXy2lkHsge', 'admin'),
(9, 21, '1', '', '1', 'admin'),
(11, 1, 'a', '', 'a', 'siswa');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idBarang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nomor_id` (`nomor_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `notifikasi`
--
ALTER TABLE `notifikasi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT untuk tabel `stock`
--
ALTER TABLE `stock`
  MODIFY `idBarang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
