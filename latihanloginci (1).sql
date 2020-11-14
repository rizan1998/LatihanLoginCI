-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jul 2020 pada 12.38
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latihanloginci`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `year` year(4) DEFAULT NULL,
  `purchase` int(11) DEFAULT NULL,
  `sale` int(11) DEFAULT NULL,
  `profit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `account`
--

INSERT INTO `account` (`id`, `year`, `purchase`, `sale`, `profit`) VALUES
(1, 2013, 2000, 3000, 1000),
(2, 2014, 4500, 5000, 500),
(3, 2015, 3000, 4500, 1500),
(4, 2016, 2000, 3000, 1000),
(5, 2017, 2000, 4000, 2000),
(6, 2018, 2200, 3000, 800),
(7, 2019, 5000, 7000, 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `alamat` text NOT NULL,
  `pekerjaan` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pelanggan`
--

INSERT INTO `pelanggan` (`id`, `nama`, `alamat`, `pekerjaan`) VALUES
(1, 'Andi', 'Surabaya', 'web programmer'),
(2, 'Santoso', 'Jakarta', 'Web Designer'),
(6, 'Samsul', 'Sumedang', 'Pegawai'),
(7, 'Bob', 'jakarta', 'penyanyi'),
(8, 'marley', 'afrika', 'penyanyi'),
(9, 'Bob', 'jakarta', 'penyanyi'),
(10, 'Bob', 'jakarta', 'penyanyi'),
(11, 'Bob', 'jakarta', 'penyanyi'),
(12, 'Bob', 'jakarta', 'penyanyi'),
(13, 'Bob', 'jakarta', 'penyanyi'),
(14, 'Bob', 'jakarta', 'penyanyi'),
(15, 'Bob', 'jakarta', 'penyanyi'),
(16, 'Bob', 'jakarta', 'penyanyi'),
(17, 'Bob', 'jakarta', 'penyanyi'),
(18, 'marley', 'afrika', 'penyanyi'),
(19, 'Bob', 'jakarta', 'penyanyi'),
(20, 'Bob', 'jakarta', 'penyanyi'),
(21, 'Bob', 'jakarta', 'penyanyi'),
(22, 'Bob', 'jakarta', 'penyanyi'),
(23, 'Bob', 'jakarta', 'penyanyi'),
(24, 'Bob', 'jakarta', 'penyanyi'),
(25, 'Bob', 'jakarta', 'penyanyi'),
(26, 'Bob', 'jakarta', 'penyanyi'),
(27, 'Bob', 'jakarta', 'penyanyi'),
(28, 'Bob', 'jakarta', 'penyanyi'),
(29, 'Bob', 'jakarta', 'penyanyi'),
(30, 'Bob', 'jakarta', 'penyanyi'),
(31, 'Bob', 'jakarta', 'penyanyi'),
(32, 'marley', 'afrika', 'penyanyi'),
(33, 'Bob', 'jakarta', 'penyanyi'),
(34, 'Bob', 'jakarta', 'penyanyi'),
(35, 'Bob', 'jakarta', 'penyanyi'),
(36, 'Bob', 'jakarta', 'penyanyi'),
(37, 'Bob', 'jakarta', 'penyanyi'),
(38, 'Bob', 'jakarta', 'penyanyi'),
(39, 'Bob', 'jakarta', 'penyanyi'),
(40, 'Bob', 'jakarta', 'penyanyi'),
(41, 'Bob', 'jakarta', 'penyanyi'),
(42, 'Bob', 'jakarta', 'penyanyi'),
(43, 'Bob', 'jakarta', 'penyanyi'),
(44, 'Bob', 'jakarta', 'penyanyi'),
(45, 'Bob', 'jakarta', 'penyanyi'),
(46, 'Bob', 'jakarta', 'penyanyi'),
(47, 'marley', 'afrika', 'penyanyi'),
(48, 'Bob', 'jakarta', 'penyanyi'),
(49, 'Bob', 'jakarta', 'penyanyi'),
(50, 'Bob', 'jakarta', 'penyanyi'),
(51, 'Bob', 'jakarta', 'penyanyi'),
(52, 'Bob', 'jakarta', 'penyanyi'),
(53, 'Bob', 'jakarta', 'penyanyi'),
(54, 'Bob', 'jakarta', 'penyanyi'),
(55, 'Bob', 'jakarta', 'penyanyi'),
(56, 'Bob', 'jakarta', 'penyanyi'),
(57, 'Bob', 'jakarta', 'penyanyi'),
(58, 'Bob', 'jakarta', 'penyanyi'),
(59, 'Bob', 'jakarta', 'penyanyi'),
(60, 'Bob', 'jakarta', 'penyanyi'),
(61, 'Bob', 'jakarta', 'penyanyi'),
(62, 'marley', 'afrika', 'penyanyi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_create` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_create`) VALUES
(3, 'muhamad rijan alpalah', 'rizanalfalah@gmail.com', 'chillgirl.jpg', '$2y$10$JekVckJJsJkHAVV13kWDM.JObNwvZ6gyFum3m/1g8KPO5Ah8zLiVu', 1, 1, 1574773177),
(13, 'Ahmad Hamdire', 'redeyes199802@gmail.com', 'default.jpg', '$2y$10$pRzQCWhBjlIo2pC5EQ.pu.lMS6E8gz.rFPNZ0h8RbS6ot9yY9go4q', 2, 1, 1575646070),
(14, 'Wanda Akina Rahman', 'WandaSalon199802@gmail.com', 'default.jpg', '$2y$10$0nuxwKQDIET5.36dnZVT1upm0Ru4aPb.z9xVZvgpL9WtWy6UW.ONG', 2, 0, 1580951479),
(22, 'aryn dinda', 'ArynGrande199802@gmail.com', 'default.jpg', '$2y$10$qbMqhsX9wQet/aSCkR0DLuHdNoLGawsL9fbSW6juZYWCo9SPfngZe', 2, 1, 1593069297);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3),
(5, 1, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'menu'),
(4, 'Admin'),
(5, 'Guide');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'administrator'),
(2, 'member'),
(3, 'Guide'),
(4, 'Porter');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'youtube', 'coba', 'fab fa-fw fa-youtube', 0),
(9, 1, 'Role', 'admin/role', 'fas fa-user-tie', 1),
(12, 2, 'change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(13, 5, 'daftar paket pendakian', 'admin/youtube', 'fas fa-fw fa-key', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(1, 'redeyes199802@gmail.com', 'JrvrsQ0ANzHkUJveqgQWTbRSpFPVyqD8KGIjlZIK6LY=', 1575685080),
(2, 'WandaSalon199802@gmail.com', 'HpcP6W70vYzZq003j8H8iZXr4RoEqjKE6VGYpQyCVr0=', 1580951479),
(3, 'rizanalfalah@gmail.com', '3mciATjXTdiYuYsW8stJn1hAm2M8j0YfSRI4j1l2TnE=', 1582888465),
(6, 'ArynGrande199802@gmail.com', '4NV6Af8vj6DSEhPo7sif7zvnmChk1q81JTO+A/otjJs=', 1593069473);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
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
-- AUTO_INCREMENT untuk tabel `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
