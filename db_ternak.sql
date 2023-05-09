-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Bulan Mei 2023 pada 14.15
-- Versi server: 10.4.25-MariaDB
-- Versi PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ternak`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `hewan`
--

CREATE TABLE `hewan` (
  `id_hewan` int(5) NOT NULL,
  `nama_hewan` varchar(50) NOT NULL,
  `desc_hewan` varchar(200) NOT NULL,
  `harga_hewan` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `hewan`
--

INSERT INTO `hewan` (`id_hewan`, `nama_hewan`, `desc_hewan`, `harga_hewan`) VALUES
(18, 'anjing', 'bau', 120000),
(19, 'Sapi', 'Sapi Murni Langsung dari india', 1200000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komplain`
--

CREATE TABLE `komplain` (
  `id_pesan` int(11) NOT NULL,
  `nama_pesan` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `no_pesan` varchar(20) NOT NULL,
  `pesan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_antrian` int(5) NOT NULL,
  `id_hewan` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `waktu` time NOT NULL,
  `status` varchar(15) NOT NULL,
  `status_data` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_antrian` int(5) NOT NULL,
  `id_group` int(10) NOT NULL,
  `no_nota` varchar(20) NOT NULL,
  `biaya` int(11) NOT NULL,
  `extra_biaya` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `status_data` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id_user` int(5) NOT NULL,
  `nama_user` varchar(25) NOT NULL,
  `no_user` varchar(15) NOT NULL,
  `alamat_user` varchar(80) NOT NULL,
  `status` varchar(10) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status_data` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id_user`, `nama_user`, `no_user`, `alamat_user`, `status`, `jenis_kelamin`, `username`, `password`, `status_data`) VALUES
(52, 'Dapa', '085349425454', 'Jl. Lorem Ipsum', 'admin', 'L', 'admin', '21232f297a57a5a743894a0e4a801fc3', '1'),
(62, 'Budi', '123', 'Jl.A. Wahab Syahranie Perum Pondok Alam Indah No.D04', 'manager', 'L', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '1'),
(63, 'Baba', '123', 'HAH', 'user', 'L', 'user', 'ee11cbb19052e40b07aac0ca060c23ee', '0');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `hewan`
--
ALTER TABLE `hewan`
  ADD PRIMARY KEY (`id_hewan`);

--
-- Indeks untuk tabel `komplain`
--
ALTER TABLE `komplain`
  ADD PRIMARY KEY (`id_pesan`);

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_paket` (`id_hewan`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_antrian`),
  ADD KEY `id_group` (`id_group`),
  ADD KEY `id_antrian` (`id_antrian`),
  ADD KEY `id_group_2` (`id_group`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `hewan`
--
ALTER TABLE `hewan`
  MODIFY `id_hewan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `komplain`
--
ALTER TABLE `komplain`
  MODIFY `id_pesan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_antrian` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15467;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD CONSTRAINT `pemesanan_ibfk_3` FOREIGN KEY (`id_hewan`) REFERENCES `hewan` (`id_hewan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_antrian`) REFERENCES `pemesanan` (`id_antrian`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
