-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 15 Feb 2022 pada 04.33
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_penjualan`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` varchar(255) NOT NULL,
  `foto_barang` varchar(255) NOT NULL,
  `tanggal_masuk` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`id`, `nama`, `stok`, `harga`, `foto_barang`, `tanggal_masuk`) VALUES
(3, '1232421', 2, '200000', '99a217da45da74ab2ac4b2060345d0db.jpeg', '2022-02-14 00:00:00'),
(7, 'test', 2, '20000', '80122816d9a21dbc3e5640964b50bc5b.png', '2022-02-16 00:00:00'),
(8, 'test', 2, '10000', '46be99d3beccfce91a0405d204a93557.png', '2022-02-14 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(3) NOT NULL,
  `id_pelanggan` int(3) NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `id_produk` int(3) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `tanggal_transaksi` datetime NOT NULL,
  `tanggal_update` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_pelanggan`, `kode_transaksi`, `id_produk`, `harga`, `jumlah`, `total_harga`, `tanggal_transaksi`, `tanggal_update`) VALUES
(2, 25, 'VUHCJ1', 37, 40000, 1, 40000, '2021-07-01 00:00:00', '2021-07-01 12:53:22');

--
-- Trigger `transaksi`
--
DELIMITER $$
CREATE TRIGGER `pesanan_penjualan` AFTER INSERT ON `transaksi` FOR EACH ROW BEGIN
	UPDATE produk SET stok = stok-NEW.jumlah
    WHERE id_produk = NEW.id_produk;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'admin', 'admin@admin.com', '1bdc910ff87796f14ae6e7215cbe8918.jpeg', '$2y$10$IGeqy4TOgVM4R3d4Jyx6wu1R.ThO06fihV.zx.Aj7BWKs3iR11rCi', 1, 1, 1742497878),
(4, 'Gian Akbar', 'akbarigi20@gmail.com', 'default.jpeg', '$2y$10$IGeqy4TOgVM4R3d4Jyx6wu1R.ThO06fihV.zx.Aj7BWKs3iR11rCi', 2, 1, 1644567263);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `token` varchar(128) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'admin@admin.com', 'u4VJEPLGNUjT8GIMGOnE7Fz9qIXwFxCcXbIQv1GeVP8=', 1640139944),
(4, 'akbarigi20@gmail.com', 'Auaw7RsMGtlLAUgx0wsoG6nFdj6lxaGn71fhHqZd/Tk=', 1644567263);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_transaksi` (`id_transaksi`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `barang`
--
ALTER TABLE `barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
